<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('login'); // sesuaikan dengan nama blade
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Redirect sesuai role
            if ($user->role === 'superadmin') {
                return redirect()->route('manajemen.dashboard');
            }

            if ($user->role === 'admin') {
                return redirect()->route('dashboard'); // ✅ nama route dashboard
            }

            // Role tidak dikenali
            Auth::logout();
            return redirect('/login')->withErrors([
                'username' => 'Role tidak dikenali'
            ]);
        }

        // Username / password salah
        return back()->withErrors([
            'username' => 'Username atau password salah'
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
