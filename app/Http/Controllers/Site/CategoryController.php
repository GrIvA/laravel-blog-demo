<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{

    /**
     * Show all posts in category
     */
    public function index($lang, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->orderBy('id', 'desc')->paginate(12);
        return view('site.category', compact('category', 'posts'));
    }

}
