<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{


    /**
     * change language controller
     *
     * @return void
     */
    public function store($locale)
    {
        Session::put('locale', $locale);

        return redirect()->back();
    }

}
