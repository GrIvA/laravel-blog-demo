<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;


class PostController extends Controller
{

    public function index()
    {
        $banner = Post::orderBy('id', 'desc')->first();
        $posts = Post::with('tags')
            ->orderBy('id', 'desc')
            ->whereNotIn('id', [$banner->id])
            ->paginate(6);

        //Debugbar::info($banner);
        return view('site.home', compact((['posts', 'banner'])));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $post->views += 1;
        $post->update();

        return view('site.article', compact('post'));
    }

}