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
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'superadmin') {
                return redirect()->route('manajemen.dashboard');
            }
            return redirect()->route('dashboard');
        }
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
        // 1. Cek superadmin di tabel users
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
            return redirect(route('manajemen.dashboard'));
        }

        // =============================================
        // 2. Cek admin di tabel users (role = admin)
        // =============================================
        $adminUser = User::where('username', $request->username)
                         ->where('role', 'admin')
                         ->first();

        if ($adminUser && Hash::check($request->password, $adminUser->password)) {
            if (isset($adminUser->terkunci) && $adminUser->terkunci == 1) {
                return back()->withErrors(['username' => 'Akun Anda terkunci. Hubungi administrator.']);
            }

            $permissions = [];
            $skpdData = UserSkpd::where('username', $request->username)->first();
            if ($skpdData && $skpdData->user_group) {
                $group = UserGroup::where('name', $skpdData->user_group)->first();
                if ($group) {
                    $permissions = json_decode($group->permission, true) ?? [];
                }
            }

            Auth::login($adminUser);
            $request->session()->regenerate();
            session(['permissions' => $permissions]);
            return redirect(route('dashboard'));
        }

        // =============================================
        // 3. Cek non_skpd di tabel users (role = non_skpd)
        // =============================================
        $nonSkpdUser = User::where('username', $request->username)
                           ->where('role', 'non_skpd')
                           ->first();

        if ($nonSkpdUser && Hash::check($request->password, $nonSkpdUser->password)) {
            if (isset($nonSkpdUser->terkunci) && $nonSkpdUser->terkunci == 1) {
                return back()->withErrors(['username' => 'Akun Anda terkunci. Hubungi administrator.']);
            }

            $nonSkpd = UserNonSkpd::where('username', $request->username)->first();

            $permissions = [];
            if ($nonSkpd && $nonSkpd->user_group) {
                $group = UserGroup::where('name', $nonSkpd->user_group)->first();
                if ($group) {
                    $permissions = json_decode($group->permission, true) ?? [];
                }
            }

            Auth::login($nonSkpdUser);
            $request->session()->regenerate();

            session([
                'non_skpd_id'       => $nonSkpd->id ?? null,
                'non_skpd_username' => $nonSkpd->username ?? $request->username,
                'non_skpd_group'    => $nonSkpd->user_group ?? null,
                'non_skpd_nama'     => $nonSkpd->nama ?? null,
                'login_type'        => 'non_skpd',
                'permissions'       => $permissions,
            ]);

            return redirect(route('dashboard'));
        }

        // =============================================
        // 4. Cek PIN untuk non_skpd langsung dari tabel non_skpd
        // =============================================
        $nonSkpd = UserNonSkpd::where('username', $request->username)->first();

        if ($nonSkpd) {
            if ($nonSkpd->terkunci == 1) {
                return back()->withErrors(['username' => 'Akun Anda terkunci. Hubungi administrator.']);
            }

            if ($nonSkpd->pin == $request->password) {
                $permissions = [];
                if ($nonSkpd->user_group) {
                    $group = UserGroup::where('name', $nonSkpd->user_group)->first();
                    if ($group) {
                        $permissions = json_decode($group->permission, true) ?? [];
                    }
                }

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

                return redirect(route('dashboard'));
            }
        }

        // =============================================
        // 5. Semua gagal
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