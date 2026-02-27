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
        $nonSkpdList = DB::table('non_skpd')->orderBy('nama')->get();
        return view('user-non-skpd.create', compact('userGroups', 'nonSkpdList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username'   => 'required|string|max:255|unique:non_skpd',
            'password'   => 'required|string|min:6',
            'pin'        => 'required|string|max:10',
            'user_group' => 'required|string',
            'non_skpd'   => 'required|string',
            'terkunci'   => 'required|in:0,1',
        ], [
            'username.required'   => 'Username wajib diisi.',
            'username.unique'     => 'Username sudah digunakan.',
            'username.max'        => 'Username maksimal 255 karakter.',
            'password.required'   => 'Password wajib diisi.',
            'password.min'        => 'Password minimal 6 karakter.',
            'pin.required'        => 'PIN wajib diisi.',
            'pin.max'             => 'PIN maksimal 10 karakter.',
            'user_group.required' => 'User group wajib dipilih.',
            'non_skpd.required'   => 'Non SKPD wajib dipilih.',
            'terkunci.required'   => 'Status terkunci wajib dipilih.',
        ]);

        UserNonSkpd::create([
            'username'   => $request->username,
            'password'   => Hash::make($request->password),
            'pin'        => $request->pin,
            'user_group' => $request->user_group,
            'non_skpd'   => $request->non_skpd,
            'terkunci'   => $request->terkunci,
        ]);

        return redirect('/manajemen/user-non-skpd')
            ->with('success', 'User Non SKPD berhasil ditambahkan');
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
            'pin'        => 'required|string|max:10',
            'user_group' => 'required|string',
            'non_skpd'   => 'required|string',
            'terkunci'   => 'required|in:0,1',
        ], [
            'username.required'   => 'Username wajib diisi.',
            'username.unique'     => 'Username sudah digunakan.',
            'username.max'        => 'Username maksimal 255 karakter.',
            'pin.required'        => 'PIN wajib diisi.',
            'pin.max'             => 'PIN maksimal 10 karakter.',
            'user_group.required' => 'User group wajib dipilih.',
            'non_skpd.required'   => 'Non SKPD wajib dipilih.',
            'terkunci.required'   => 'Status terkunci wajib dipilih.',
        ]);

        $data = [
            'username'   => $request->username,
            'pin'        => $request->pin,
            'user_group' => $request->user_group,
            'non_skpd'   => $request->non_skpd,
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
        $user->delete();

        return redirect('/manajemen/user-non-skpd')
            ->with('success', 'User Non SKPD berhasil dihapus');
    }
}