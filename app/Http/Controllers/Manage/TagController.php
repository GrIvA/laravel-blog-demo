<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(20);
        return view('manage.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('manage.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        Tag::create($request->all());
        Cache::forget('all_tags');
        return redirect(route('tags.index'))->with('success', 'Tag was added');
    }

    public function edit(string $id)
    {
        $tag = Tag::find($id);
        return view('manage.tags.edit', compact('tag'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $tag = Tag::find($id);
        $tag->update($request->all());
        Cache::forget('all_tags');
        return redirect()->route('tags.index')->with('success', 'Tag was updated');
    }

    public function destroy(string $id)
    {
        $tag = Tag::find($id);
        if ($tag->posts->count()) {
            return redirect()->route('tags.index')->with('error', 'Some posts use this tag');
        }
        Tag::destroy($id);
        return redirect()->route('tags.index')->with('success', 'Tag was deleted');
    }
}
