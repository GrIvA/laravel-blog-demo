<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * undocumented function
     *
     * @return void
     */
    public function index()
    {
//        Tag::create(['title' => 'Laravel - то є важко!']);
        $tag = new Tag();
        $tag->title = 'Laravel - то є важко!';
        $tag->save();

        return view('manage.index');
    }

}
