<?php
// app/Http/Controllers/Manajemen/UserGroupController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserGroup;

class UserGroupController extends Controller
{
    public function index()
    {
        $groups = UserGroup::latest()->paginate(10);
        return view('user-groups.index', compact('groups'));
    }

    public function show($id)
    {
        $group = UserGroup::findOrFail($id);
        return view('user-groups.show', compact('group'));
    }

    public function create()
    {
        return view('user-groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'permission' => 'required|string',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 100 karakter.',
            'permission.required' => 'permission wajib dipilih.',
        ]);

        UserGroup::create([
            'name' => $request->name,
            'permission' => $request->permission,
            'level' => 1,
            'created_by' => auth()->id(),
        ]);

        return redirect('/manajemen/user-groups')
            ->with('success', 'User group berhasil ditambahkan');
    }

    public function edit($id)
    {
        $group = UserGroup::findOrFail($id);
        return view('user-groups.edit', compact('group'));
    }

    public function update(Request $request, $id)
    {
        $group = UserGroup::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'permission' => 'required|string',
            'level' => 'required|integer',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 100 karakter.',
            'permission.required' => 'Izin wajib dipilih.',
            'level.required' => 'Level wajib diisi.',
            'level.integer' => 'Level harus berupa angka.',
        ]);

        $group->update([
            'name' => $request->name,
            'permission' => $request->permission,
            'level' => $request->level,
            'updated_by' => auth()->id(),
        ]);

        return redirect('/manajemen/user-groups')
            ->with('success', 'User group berhasil diupdate');
    }

    public function destroy($id)
    {
        $group = UserGroup::findOrFail($id);
        $group->delete();

        return redirect('/manajemen/user-groups')
            ->with('success', 'User group berhasil dihapus');
    }
}