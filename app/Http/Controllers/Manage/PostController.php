<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category', 'tags')->paginate(20);
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
        $data['thumbnails'] = $this->uploadImage($request);

        $post = Post::create($data);
        $post->tags()->sync($request->tags);

        return redirect(route('posts.index'))->with('success', 'Post was added');
    }

    public function edit(string $id)
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags =Tag::pluck('title', 'id')->all();
        $post = Post::find($id);

        return view('manage.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'header'      => 'required',
            'epilog'      => 'required',
            'description' => 'required',
            'content'     => 'required',
            'category_id' => 'required|integer',
            'thumbnails'  => 'nullable|image',
        ]);

        $post = Post::find($id);
        $data = $request->all();
        $data['thumbnails'] = $this->uploadImage($request, $post->thumbnails);

        $post->update($data);
        $post->tags()->sync($request->tags);

        return redirect(route('posts.index'))->with('success', 'Post was updated');
    }

    public function destroy(string $id)
    {
        $post = Post::find($id);
        $post->tags()->sync([]);
        if ($post->thumbnails) {
            Storage::delete($post->thumbnails);
        }
        Post::destroy($id);

        return redirect(route('posts.index'))->with('success', 'Post remove');
    }


    // PRIVATE

    private function uploadImage(Request $request, $img_path = null)
    {
        if ($request->hasFile('thumbnails')) {
            if ($img_path) {
                Storage::delete($img_path);
            }
            $folder = date('Y-m-d');
            return $request->file('thumbnails')->store('images/'.$folder);
        }

        return null;
    }

}
