<?php
// app/Http/Controllers/Manajemen/UserSkpdController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSkpd;

class UserSkpdController extends Controller
{
    public function index()
    {
        $users = UserSkpd::latest()->paginate(10);
        return view('user-skpd.index', compact('users'));
    }

    public function create()
    {
        $userGroups = ['Admin Setda', 'Operator', 'Administrator', 'Viewer', 'Guest'];
        return view('user-skpd.create', compact('userGroups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:user_skpd',
            'user_group' => 'required|string',
            'skpd' => 'required|string',
        ]);

        UserSkpd::create($request->all());

        return redirect('/manajemen/user-skpd')
            ->with('success', 'User SKPD berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = UserSkpd::findOrFail($id);
        $userGroups = ['Admin Setda', 'Operator', 'Administrator', 'Viewer', 'Guest'];
        return view('user-skpd.edit', compact('user', 'userGroups'));
    }

    public function update(Request $request, $id)
    {
        $user = UserSkpd::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:255|unique:user_skpd,username,' . $id,
            'user_group' => 'required|string',
            'skpd' => 'required|string',
        ]);

        $user->update($request->all());

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