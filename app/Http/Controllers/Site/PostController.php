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
        if ($banner) {
            $posts = Post::with('tags')
                ->orderBy('id', 'desc')
                ->whereNotIn('id', [$banner->id])
                ->paginate(6);
        } else {
            $banner = [];
            $posts = [];
        }

        return view('site.home', compact((['posts', 'banner'])));
    }

    public function show($lang, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $post->views += 1;
        $post->update();

        return view('site.article', compact('post'));
    }

}
