<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Writer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $userLogin = Auth::user()->writer;

        if (Auth::user()->hasRole('owner')) {
            $posts = Post::latest()->get();
        } else if ($userLogin) {
            $posts = $userLogin->posts;
        } else {
            $posts = collect();
        }

        return view('dashboard.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.posts.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        $writer = Writer::where('user_id', Auth::user()->id)->firstOrFail();

        DB::transaction(function () use ($request, $writer) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $validated['slug'] = Str::slug($validated['title']);
            $validated['writer_id'] = $writer->id;

            Post::create($validated);
        });

        return redirect()->route('dashboard.posts.index')
            ->with('successfullAddNewPost', 'Successfully add a new Post');
    }

    public function show(Post $post)
    {

        $category = $post->category;

        return view('dashboard.posts.show', compact('post', 'category'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('dashboard.posts.edit', compact('post', 'categories'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        DB::transaction(function () use ($request, $post) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $validated['slug'] = Str::slug($validated['title']);

            $post->update($validated);
        });

        return redirect()->route('dashboard.posts.index')
            ->with('updatedPostSuccessfully', 'Successfully updated the post');
    }

    public function destroy(Post $post)
    {
        DB::transaction(function () use ($post) {
            $post->delete();
        });

        return redirect()->route('dashboard.posts.index')
            ->with('deletedPostSuccessfully', 'Post deleted successfully');
    }
}
