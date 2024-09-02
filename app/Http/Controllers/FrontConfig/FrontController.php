<?php

namespace App\Http\Controllers\FrontConfig;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Writer;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();

        $writers = Writer::withCount('posts')
            ->orderBy('posts_count', 'desc')->take(3)->get();

        $categories = Category::withCount('posts')
            ->orderBy('posts_count', 'desc')->take(5)->get();

        if (!Auth::check()) {
            return view('front.home');
        }

        return view('front.posts.index', compact('categories', 'posts', 'writers'));
    }

    public function detail_post(Post $post)
    {
        return view('front.posts.detail', compact('post'));
    }

    public function user_profile(User $user)
    {
        return view('front.user.index', compact('user'));
    }

    public function category(Category $category)
    {
        $posts = $category->posts;

        return view('front.category.index', compact('category', 'posts'));
    }
}
