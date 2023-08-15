<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $posts = Post::where('status', 'Published')->orderBy('created_at', 'desc')->simplePaginate(10);

        return view('blog.home',
            ['posts' => $posts]);
    }
}
