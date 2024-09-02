<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userLogin = Auth::user()->writer;

        if (Auth::user()->hasRole('owner')) {
            $posts = Post::latest()->take(4)->get();
        } else if ($userLogin) {
            $posts = $userLogin->posts;
        } else {
            $posts = collect();
        }
        return view('dashboard.index', compact('posts'));
    }
}
