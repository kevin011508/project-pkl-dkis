<?php
// app/Http/Controllers/Manajemen/UserPermissionController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserPermission;

class UserPermissionController extends Controller
{
    public function index()
    {
        $permissions = UserPermission::latest()->paginate(10);
        return view('user-permission.index', compact('permissions'));
    }

    public function create()
    {
        $controllers = ['pedoman', 'galeri', 'rilis', 'agenda', 'user-groups', 'user-skpd', 'user-non-skpd'];
        $actions = ['lihat', 'tambah', 'edit', 'hapus'];
        return view('user-permission.create', compact('controllers', 'actions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'controller' => 'required|string',
            'action' => 'required|string',
            'info' => 'nullable|string',
        ]);

        UserPermission::create($request->all());

        return redirect('/manajemen/user-permission')
            ->with('success', 'User Permission berhasil ditambahkan');
    }

    public function edit($id)
    {
        $permission = UserPermission::findOrFail($id);
        $controllers = ['pedoman', 'galeri', 'rilis', 'agenda', 'user-groups', 'user-skpd', 'user-non-skpd'];
        $actions = ['lihat', 'tambah', 'edit', 'hapus'];
        return view('user-permission.edit', compact('permission', 'controllers', 'actions'));
    }

    public function update(Request $request, $id)
    {
        $permission = UserPermission::findOrFail($id);

        $request->validate([
            'controller' => 'required|string',
            'action' => 'required|string',
            'info' => 'nullable|string',
        ]);

        $permission->update($request->all());

        return redirect('/manajemen/user-permission')
            ->with('success', 'User Permission berhasil diupdate');
    }

    public function destroy($id)
    {
        $permission = UserPermission::findOrFail($id);
        $permission->delete();

        return redirect('/manajemen/user-permission')
            ->with('success', 'User Permission berhasil dihapus');
    }

    public function toggleStatus($id)
    {
        $permission = UserPermission::findOrFail($id);
        $permission->status = !$permission->status;
        $permission->save();

        return response()->json(['success' => true, 'status' => $permission->status]);
    }
}