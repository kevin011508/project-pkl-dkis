<?php
// app/Http/Controllers/Manajemen/UserNonSkpdController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserNonSkpd;

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
        return view('user-non-skpd.create', compact('userGroups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:user_non_skpd',
            'user_group' => 'required|string',
            'non_skpd' => 'required|string',
            'pin' => 'required|string|max:10',
        ]);

        UserNonSkpd::create($request->all());

        return redirect('/manajemen/user-non-skpd')
            ->with('success', 'User Non SKPD berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = UserNonSkpd::findOrFail($id);
        $userGroups = ['Operator', 'Admin', 'Viewer', 'Guest'];
        return view('user-non-skpd.edit', compact('user', 'userGroups'));
    }

    public function update(Request $request, $id)
    {
        $user = UserNonSkpd::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:255|unique:user_non_skpd,username,' . $id,
            'user_group' => 'required|string',
            'non_skpd' => 'required|string',
            'pin' => 'required|string|max:10',
        ]);

        $user->update($request->all());

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