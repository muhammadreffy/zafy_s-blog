<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $userLogin = Auth::user()->writer;

        $search = $request->input('search');

        $posts = Post::orderBy('title');

        if ($search != '') {
            $posts->where('title', 'like', '%' . $search . '%');
        }

        if (Auth::user()->hasRole('owner')) {

            $posts = $posts->latest()->paginate(10);

        } else if ($userLogin) {
            $posts = $userLogin->posts()
                ->where('title', 'like', '%' . $search . '%')
                ->orderBy('title')
                ->paginate(10);

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

        $validated = $request->validated();

        DB::beginTransaction();

        try {

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $slug = Str::slug($validated['title']);

            $slugCheck = Post::where('slug', 'like', "$slug%")->count();

            if ($slugCheck > 0) {
                $slug = "{$slug}-" . ($slugCheck + 1);
            }

            $validated['slug'] = $slug;
            $validated['writer_id'] = $writer->id;

            Post::create($validated);

            DB::commit();

            return redirect()->route('dashboard.posts.index')
                ->with('successfullAddNewPost', 'Successfully add a new Post');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->route('dashboard.posts.index')
                ->with('failedAddNewPost', 'Failed to add new Post');
        }
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
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $slug = Str::slug($validated['title']);

            $slugCheck = Post::where('slug', 'like', "$slug%")->count();

            if ($slugCheck > 0) {
                $slug = "{$slug}-" . ($slugCheck + 1);
            }

            $validated['slug'] = $slug;

            $post->update($validated);

            DB::commit();

            return redirect()->route('dashboard.posts.index')
                ->with('updatedPostSuccessfully', 'Successfully updated the post');

        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->route('dashboard.posts.index')
                ->with('updatePostFailed', 'Failed to update the post');
        }
    }

    public function destroy(Post $post)
    {
        DB::beginTransaction();

        try {
            $post->delete();

            DB::commit();

            return redirect()->route('dashboard.posts.index')
                ->with('deletedPostSuccessfully', 'Post deleted successfully');
        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()->route('dashboard.posts.index')
                ->with('deletePostFailed', 'Post failed to delete');
        }

    }
}
