<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Show all posts by tag
     */
    public function index($lang, $slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->orderBy('id', 'desc')->paginate(12);
        return view('site.tag', compact('tag', 'posts'));
    }
}
