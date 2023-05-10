<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(20);
        return view('manage.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags =Tag::pluck('title', 'id')->all();
        return view('manage.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'header'      => 'required',
            'epilog'      => 'required',
            'description' => 'required',
            'content'     => 'required',
            'category_id' => 'required|integer',
            'thumbnails'  => 'nullable|image',
        ]);

        $data = $request->all();

        // Define available the post at the site
        $data['status'] = 1;

        if ($request->hasFile('thumbnails')) {
            $folder = date('Y-m-d');
            $data['thumbnails'] = $request->file('thumbnails')->store('images/'.$folder);
        }

        $post = Post::create($data);
        $post->tags()->sync($request->tags);

        return redirect(route('posts.index'))->with('success', 'Post was added');
    }

    public function edit(string $id)
    {
        return view('manage.posts.edit');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'header' => 'required',
        ]);

        return redirect(route('posts.index'))->with('success', 'Post was updated');
    }

    public function destroy(string $id)
    {
        Post::destroy($id);

        return redirect(route('posts.index'))->with('success', 'Post remove');
    }
}
