<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function create()
    {
        return view('user.create');
    }

    public function store(request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->getPassword()),
        ]);

        session()->flash('success', 'User registered');
        Auth::login($user);

        return redirect()->route('home');
    }

    /**
     * LoginForm route
     */
    public function loginForm()
    {
        return view('user.login');
    }

    /**
     * Login post handler
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            session()->flash('success', 'You are logged');

            if (Auth::user()->is_admin) {
                return redirect()->route('manage.main.index');
            } else {
                return redirect()->route('home');
            }
        }
        return redirect()->back()->with('error', 'Incorrect login or password');
    }

    /**
     * logout route
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }

}
