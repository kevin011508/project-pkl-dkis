<?php
// app/Http/Controllers/Manajemen/UserGroupController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserGroup;


class UserGroupController extends Controller
{

public function show($id)
{
    $group = \App\Models\UserGroup::findOrFail($id);

    return view('user-groups.show', compact('group'));
}
    public function index()
    {
        $groups = UserGroup::latest()->paginate(10);
        return view('user-groups.index', compact('groups'));
    }

    public function create()
    {
        $usergroups = ['Admin Setda', 'Operator', 'Administrator', 'Viewer', 'Guest'];
        return view('user-groups.create', compact('usergroups'));
    }

   public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'deskripsi' => 'nullable|string'
    ]);

    UserGroup::create([
        'nama' => $request->nama,
        'deskripsi' => $request->deskripsi,
        'status' => 'Active', // optional default
        'member_count' => 0   // optional default
    ]);

    return redirect('/manajemen/user-groups')
        ->with('success', 'User group berhasil ditambahkan');
}

    public function edit($id)
    {
        $user = UserGroup::findOrFail($id);
        $userGroups = ['Admin Setda', 'Operator', 'Administrator', 'Viewer', 'Guest'];
        return view('user-groups.edit', compact('user', 'userGroups'));
    }

   public function update(Request $request, $id)
{
    $user = UserGroup::findOrFail($id);

    $request->validate([
        'nama' => 'required|string|max:255',
        'deskripsi' => 'nullable|string'
    ]);

    $user->update([
        'nama' => $request->nama,
        'deskripsi' => $request->deskripsi,
    ]);

    return redirect('/manajemen/user-groups')
        ->with('success', 'User group berhasil diupdate');
}

    public function destroy($id)
    {
        $user = UserGroup::findOrFail($id);
        $user->delete();

        return redirect('/manajemen/user-groups')
            ->with('success', 'User groups berhasil dihapus');
    }

}