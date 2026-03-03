<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserNonSkpd;
use App\Models\UserGroup;
use App\Models\UserSkpd;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // =============================================
        // 1. Cek apakah username ada di tabel superadmin (users)
        // =============================================
        $superadmin = User::where('username', $request->username)
                          ->where('role', 'superadmin')
                          ->first();

        if ($superadmin && Hash::check($request->password, $superadmin->password)) {
            if (isset($superadmin->terkunci) && $superadmin->terkunci == 1) {
                return back()->withErrors(['username' => 'Akun Anda terkunci. Hubungi administrator.']);
            }

            Auth::login($superadmin);
            $request->session()->regenerate();
            return redirect()->route('manajemen.dashboard');
        }

        // =============================================
        // 2. Cek apakah username ada di tabel skpd (User SKPD)
        // =============================================
        $skpd = UserSkpd::where('username', $request->username)->first();

        if ($skpd && Hash::check($request->password, $skpd->password)) {
            // Cek akun terkunci
            if ($skpd->terkunci == 1) {
                return back()->withErrors(['username' => 'Akun Anda terkunci. Hubungi administrator.']);
            }

            // Ambil permissions dari user_group
            $permissions = [];
            if ($skpd->user_group) {
                $group = UserGroup::where('name', $skpd->user_group)->first();
                if ($group) {
                    $permissions = json_decode($group->permission, true) ?? [];
                }
            }

            // Buat atau update user dummy di tabel users dengan role admin
            $user = User::updateOrCreate(
                ['username' => $skpd->username],
                [
                    'name'     => $skpd->username,
                    'password' => $skpd->password,
                    'role'     => 'admin',
                ]
            );

            Auth::login($user);
            $request->session()->regenerate();
            session(['permissions' => $permissions]);

            return redirect()->route('dashboard');
        }

        // =============================================
        // 3. Cek apakah username ada di tabel non_skpd (User Non SKPD)
        // =============================================
        $nonSkpd = UserNonSkpd::where('username', $request->username)->first();

        if ($nonSkpd) {
            // Cek akun terkunci
            if ($nonSkpd->terkunci == 1) {
                return back()->withErrors(['username' => 'Akun Anda terkunci. Hubungi administrator.']);
            }

            // Cek PIN
            if ($nonSkpd->pin == $request->password) {
                // Ambil permissions dari user_group
                $permissions = [];
                if ($nonSkpd->user_group) {
                    $group = UserGroup::where('name', $nonSkpd->user_group)->first();
                    if ($group) {
                        $permissions = json_decode($group->permission, true) ?? [];
                    }
                }

                // Buat atau update user dummy di tabel users dengan role non_skpd
                $user = User::updateOrCreate(
                    ['username' => $nonSkpd->username],
                    [
                        'name'     => $nonSkpd->nama ?? $nonSkpd->username,
                        'password' => bcrypt($nonSkpd->pin),
                        'role'     => 'non_skpd',
                    ]
                );

                Auth::login($user);
                $request->session()->regenerate();

                session([
                    'non_skpd_id'       => $nonSkpd->id,
                    'non_skpd_username' => $nonSkpd->username,
                    'non_skpd_group'    => $nonSkpd->user_group,
                    'non_skpd_nama'     => $nonSkpd->nama,
                    'login_type'        => 'non_skpd',
                    'permissions'       => $permissions,
                ]);

                return redirect()->route('dashboard');
            }
        }

        // =============================================
        // 4. Semua gagal
        // =============================================
        return back()->withErrors([
            'username' => 'Username atau password/PIN salah.'
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->forget([
            'non_skpd_id',
            'non_skpd_username',
            'non_skpd_group',
            'non_skpd_nama',
            'login_type',
            'permissions',
        ]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Update profile
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user->update(['name' => $request->name]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}