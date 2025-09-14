<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    function index(){
        return view('login');
    }

    function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ],[
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.min' => 'Password harus terdiri dari minimal 6 karakter',
            'password.required' => 'Password wajib diisi',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Redirect ke halaman dashboard jika login berhasil
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }
        return redirect()->back()
        ->withErrors(['login' => 'Email atau Password tidak sesuai'])
        ->withInput($request->except('password'));
    }

    public function logout()
    {
        // Proses logout
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}
