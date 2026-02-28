<?php
// app/Http/Controllers/UserSkpdController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSkpd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSkpdController extends Controller
{
    public function index()
    {
        $users = UserSkpd::whereNotNull('username')
        ->orderBy('id', 'asc')
        ->paginate(10);
    return view('user-skpd.index', compact('users'));
    }

    public function create()
    {
        $userGroups = ['Admin Setda', 'Operator', 'Administrator', 'Viewer', 'Guest'];
        $skpdList = DB::table('skpd')
            ->where('status_aktif', '1')
            ->orderBy('uraian')
            ->get();
        return view('user-skpd.create', compact('userGroups', 'skpdList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username'   => 'required|string|max:255|unique:skpd,username',
            'password'   => 'required|string|min:6',
            'user_group' => 'required|string',
            'skpd'       => 'required|string',
            'terkunci'   => 'required|in:0,1',
        ], [
            'username.required'   => 'Username wajib diisi.',
            'username.unique'     => 'Username sudah digunakan.',
            'username.max'        => 'Username maksimal 255 karakter.',
            'password.required'   => 'Password wajib diisi.',
            'password.min'        => 'Password minimal 6 karakter.',
            'user_group.required' => 'User group wajib dipilih.',
            'skpd.required'       => 'SKPD wajib dipilih.',
            'terkunci.required'   => 'Status terkunci wajib dipilih.',
        ]);

        UserSkpd::create([
            'username'   => $request->username,
            'password'   => Hash::make($request->password),
            'user_group' => $request->user_group,
            'skpd'       => $request->skpd,
            'terkunci'   => $request->terkunci,
        ]);

        return redirect('/manajemen/user-skpd')
            ->with('success', 'User SKPD berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = UserSkpd::findOrFail($id);
        $userGroups = ['Admin Setda', 'Operator', 'Administrator', 'Viewer', 'Guest'];
        $skpdList = DB::table('skpd')
            ->where('status_aktif', '1')
            ->orderBy('uraian')
            ->get();
        return view('user-skpd.edit', compact('user', 'userGroups', 'skpdList'));
    }

    public function update(Request $request, $id)
    {
        $user = UserSkpd::findOrFail($id);

        $request->validate([
            'username'   => 'required|string|max:255|unique:skpd,username,' . $id,
            'user_group' => 'required|string',
            'skpd'       => 'required|string',
            'terkunci'   => 'required|in:0,1',
        ], [
            'username.required'   => 'Username wajib diisi.',
            'username.unique'     => 'Username sudah digunakan.',
            'username.max'        => 'Username maksimal 255 karakter.',
            'user_group.required' => 'User group wajib dipilih.',
            'skpd.required'       => 'SKPD wajib dipilih.',
            'terkunci.required'   => 'Status terkunci wajib dipilih.',
        ]);

        $data = [
            'username'   => $request->username,
            'user_group' => $request->user_group,
            'skpd'       => $request->skpd,
            'terkunci'   => $request->terkunci,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect('/manajemen/user-skpd')
            ->with('success', 'User SKPD berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = UserSkpd::findOrFail($id);
        $user->delete();

        return redirect('/manajemen/user-skpd')
            ->with('success', 'User SKPD berhasil dihapus');
    }
}