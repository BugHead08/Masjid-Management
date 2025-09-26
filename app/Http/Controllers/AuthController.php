<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * ============================
     *  HALAMAN LOGIN (WEB)
     * ============================
     */
    public function index()
    {
        return view('login'); // resources/views/login.blade.php
    }

    /**
     * ============================
     *  REGISTER (API) - Postman
     * ============================
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:55',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'admin', // default role
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user'    => $user
        ], 201);
    }

    /**
     * ============================
     *  LOGIN (API) - Postman
     * ============================
     */
    public function apiLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Email atau password salah'
            ], 401);
        }

        $user  = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'user'    => $user,
            'token'   => $token
        ], 200);
    }

    /**
     * ============================
     *  LOGIN (WEB) - Blade
     * ============================
     */
    public function webLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Login berhasil');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->withInput();
    }

    /**
     * ============================
     *  LOGOUT (API) - Postman
     * ============================
     */
    public function apiLogout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete(); // hapus semua token Sanctum user
        }

        return response()->json([
            'message' => 'Logout berhasil'
        ], 200);
    }

    /**
     * ============================
     *  LOGOUT (WEB) - Blade
     * ============================
     */
    public function webLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil');
    }

    /**
     * ============================
     *  HAPUS USER (API) - Optional
     * ============================
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'message' => 'User berhasil dihapus'
        ], 200);
    }
}
