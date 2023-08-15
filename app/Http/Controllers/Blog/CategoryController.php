<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function show(Category $category)
    {

//        dd($category->posts);

        return view('blog.category',
            ['category' => $category]);
//        dd($post);

    }
}
