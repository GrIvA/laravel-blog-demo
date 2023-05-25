<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Translate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TranslateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data  = Translate::orderBy('id', 'desc')->paginate(25);
        return view('manage.translates.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $item = Translate::orderBy('id', 'Desc')->first();
        preg_match('/^(\D+)(\d+)/', $item->key, $matches);
        if (is_array($matches) && count($matches) == 3) {
            $key = $matches[1] . sprintf('%0'.strlen($matches[2]).'d', 1 + ($matches[2]));
            Translate::create([
                'group' => $item->group,
                'key' => $key,
                'text' => ['ur' => $key],
            ]);
            return redirect(route('translates.index'))
                ->with('success', $key . ' variable was added');
        }
        return redirect(route('translates.index'))
            ->with('error', 'Can not add variable');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $translate = Translate::find($id);
        $languages = Language::pluck('available', 'abr')->all();

        return view('manage.translates.edit', compact('translate', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'group' => 'required',
            'key'   => 'required|ascii',
            'text'  => 'required|array',
        ]);

        $item = Translate::find($id);
        $item->update($request->all());
        Cache::forget('languages');

        return redirect(route('translates.index'))
            ->with('success', 'Language key was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
