<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserNonSkpd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserNonSkpdController extends Controller
{
    public function index()
    {
        $users = UserNonSkpd::latest()->paginate(10);
        return view('user-non-skpd.index', compact('users'));
    }

    public function create()
    {
        $userGroups = ['Operator', 'Admin', 'Viewer', 'Guest'];
        // Hanya tampilkan organisasi yang belum punya username
        $nonSkpdList = UserNonSkpd::whereNull('username')->orderBy('nama')->get();
        return view('user-non-skpd.create', compact('userGroups', 'nonSkpdList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username'   => 'required|string|max:255|unique:non_skpd,username',
            'password'   => 'required|string|min:6',
            'pin'        => 'required|max:10',
            'user_group' => 'required|string',
            'non_skpd'   => 'required|exists:non_skpd,id', // ✅ non_skpd berisi id organisasi
            'terkunci'   => 'required|in:0,1',
        ], [
            'username.required'   => 'Username wajib diisi.',
            'username.unique'     => 'Username sudah digunakan.',
            'password.required'   => 'Password wajib diisi.',
            'password.min'        => 'Password minimal 6 karakter.',
            'pin.required'        => 'PIN wajib diisi.',
            'user_group.required' => 'User group wajib dipilih.',
            'non_skpd.required'   => 'Non SKPD wajib dipilih.',
            'non_skpd.exists'     => 'Organisasi tidak ditemukan.',
            'terkunci.required'   => 'Status terkunci wajib dipilih.',
        ]);

        // ✅ Update baris organisasi yang dipilih dengan data user
        $organisasi = UserNonSkpd::findOrFail($request->non_skpd);
        $organisasi->update([
            'username'   => $request->username,
            'password'   => Hash::make($request->password),
            'pin'        => $request->pin,
            'user_group' => $request->user_group,
            'terkunci'   => $request->terkunci,
        ]);

        return redirect('/manajemen/user-non-skpd')
            ->with('success', 'User Non SKPD berhasil ditambahkan');
    }

    public function show($id)
    {
        $user = UserNonSkpd::findOrFail($id);
        return view('user-non-skpd.show', compact('user'));
    }

    public function edit($id)
    {
        $user = UserNonSkpd::findOrFail($id);
        $userGroups = ['Operator', 'Admin', 'Viewer', 'Guest'];
        $nonSkpdList = DB::table('non_skpd')->orderBy('nama')->get();
        return view('user-non-skpd.edit', compact('user', 'userGroups', 'nonSkpdList'));
    }

    public function update(Request $request, $id)
    {
        $user = UserNonSkpd::findOrFail($id);

        $request->validate([
            'username'   => 'required|string|max:255|unique:non_skpd,username,' . $id,
            'pin'        => 'required|max:10',
            'user_group' => 'required|string',
            'terkunci'   => 'required|in:0,1',
        ], [
            'username.required'   => 'Username wajib diisi.',
            'username.unique'     => 'Username sudah digunakan.',
            'pin.required'        => 'PIN wajib diisi.',
            'user_group.required' => 'User group wajib dipilih.',
            'terkunci.required'   => 'Status terkunci wajib dipilih.',
        ]);

        $data = [
            'username'   => $request->username,
            'pin'        => $request->pin,
            'user_group' => $request->user_group,
            'terkunci'   => $request->terkunci,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect('/manajemen/user-non-skpd')
            ->with('success', 'User Non SKPD berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = UserNonSkpd::findOrFail($id);

        // ✅ Reset kolom user saja, baris organisasi tetap ada
        $user->update([
            'username'   => null,
            'password'   => null,
            'pin'        => null,
            'user_group' => null,
            'terkunci'   => 0,
        ]);

        return redirect('/manajemen/user-non-skpd')
            ->with('success', 'User Non SKPD berhasil dihapus');
    }
}