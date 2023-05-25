<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $langs = Language::all();
        return view('manage.lang.index', compact('langs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manage.lang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'abr'       => 'required|size:2',
            'locale'    => 'required',
        ]);
        $data = $request->all();
        $data['available'] = !empty($request->get('available'));
        Language::create($data);
        Cache::forget('languages');

        return redirect(route('languages.index'))->with('success', 'Language was created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lang = Language::find($id);
        return view('manage.lang.edit', ['language' => $lang]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'      => 'required',
            'abr'       => 'required|size:2',
            'locale'    => 'required',
        ]);
        $data = $request->all();
        $data['available'] = !empty($request->get('available'));

        $lang = Language::find($id);
        $lang->update($data);
        Cache::forget('languages');

        return redirect(route('languages.index'))->with('success', 'Language was updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Language::destroy($id);
        return redirect(route('languages.index'))->with('success', 'Language remove');
    }
}
