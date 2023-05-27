<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{

    public function index()
    {
        $banner = Post::orderBy('id', 'desc')->first();
        $posts = Post::with('tags')
            ->orderBy('id', 'desc')
            ->whereNotIn('id', [$banner->id])
            ->paginate(6);

        return view('site.home', compact((['posts', 'banner'])));
    }

    public function show($lang, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

//        Log::channel('site')->emergency('==> All Good');
        $post->views += 1;
        $post->update();

        return view('site.article', compact('post'));
    }

}
