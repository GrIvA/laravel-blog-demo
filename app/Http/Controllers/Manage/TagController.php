<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

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
        return redirect()->route('tags.index')->with('success', 'Tag was updated');
    }

    public function destroy(string $id)
    {
        Tag::destroy($id);
        return redirect()->route('tags.index')->with('success', 'Tag was deleted');
    }
}
