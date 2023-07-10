<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() {
    if (!empty (Auth::check())) {
      if (Auth::user() -> user_type == 1) {
        return redirect('admin/dashboard');
      } else if (Auth::user() -> user_type == 2) {
        return redirect('student/dashboard');
      }
    }
    return view('auth.login');
  }

  public function AuthLogin(Request $request) {
    $remember = !empty($request->remember) ? true : false;
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
      if (Auth::user() -> user_type == 1) {
        return redirect('admin/dashboard');
      } else if (Auth::user() -> user_type == 2) {
        return redirect('student/dashboard');
      } 
    } else
    {
      return redirect()->back()->with('error', 'Please enter currect email and password');
    }
  }


    public function logout()
    {
        Auth::logout();

        return redirect(url('/login'));
    }
}