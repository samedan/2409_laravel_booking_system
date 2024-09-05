<?php

namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Session;

// namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class Admin_loginController extends Controller
{
    public function showloginform()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();
            if ($user->role == 'admin') {
                return redirect('business');
            }
            else{
                return response()->json('you are not an admin');
            }
        }
        return redirect('login_form');
    }
    public function admin_login(Request $request)
    {
        $credentials = request(['email', 'password']);
        // dd(Auth::attempt($credentials));
        // dd(Auth::guard('web')->attempt($credentials));
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();
            // return response()->json($user->role);
            // dd($user);
            // dd($user);
            // return response()->json($user);
            if ($user->role == 'admin') {
                return redirect('business');
            }
            else{
                return response()->json('you are not an admin');
            }
        }
        return response()->json('you suck');
        // return redirect('login_form');
    }

    public function logout()
    {
        Session::flush();

        return redirect('login_form');
    }

    public function guard()
    {
        return Auth::guard('web');
    }
}
