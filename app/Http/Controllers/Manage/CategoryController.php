<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(20);
        return view('manage.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('manage.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        Category::create($request->all());
//        $request->session()->flush('success', 'Category was added'); // Next - the same
        return redirect()->route('categories.index')->with('success', 'Category was added');
    }

    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('manage.categories.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $category = Category::find($id);
        //$category->slug = null; // for automatic slug update
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Category was updated');
    }

    public function destroy(string $id)
    {
        //$category = Category::find($id);
        //$category->delete();
        Category::destroy($id);
        return redirect()->route('categories.index')->with('success', 'Category was deleted');
    }
}
