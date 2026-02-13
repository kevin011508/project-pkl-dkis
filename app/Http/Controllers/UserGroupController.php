<?php
// app/Http/Controllers/UserGroupsController.php
// use App\Http\Controllers\Manajemen\UserGroupsController;
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{
    public function index()
    {
        // Data contoh
        $groups = [
            [
                'id' => 1,
                'nama' => 'Administrator',
                'deskripsi' => 'Group dengan akses penuh ke semua fitur sistem',
                'member_count' => 5,
                'created_at' => '2026-01-15',
                'status' => 'Active'
            ],
            [
                'id' => 2,
                'nama' => 'Editor',
                'deskripsi' => 'Dapat mengedit dan mempublish konten',
                'member_count' => 12,
                'created_at' => '2026-01-20',
                'status' => 'Active'
            ],
            [
                'id' => 3,
                'nama' => 'Contributor',
                'deskripsi' => 'Dapat menambah dan mengedit konten sendiri',
                'member_count' => 8,
                'created_at' => '2026-01-25',
                'status' => 'Active'
            ],
            [
                'id' => 4,
                'nama' => 'Viewer',
                'deskripsi' => 'Hanya dapat melihat konten',
                'member_count' => 20,
                'created_at' => '2026-02-01',
                'status' => 'Active'
            ],
            [
                'id' => 5,
                'nama' => 'Guest',
                'deskripsi' => 'Akses terbatas untuk pengunjung',
                'member_count' => 15,
                'created_at' => '2026-02-05',
                'status' => 'Inactive'
            ]
        ];

        return view('user-groups.index', compact('groups'));
    }

    public function create()
    {
        return view('user-groups.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
            'member_count' => 'nullable|integer|min:0'
        ]);

        // Logic untuk menyimpan data ke database
        // ...

        return redirect('/manajemen/user-groups')
            ->with('success', 'User Group berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Ambil data berdasarkan ID
        $group = [
            'id' => $id,
            'nama' => 'Administrator',
            'deskripsi' => 'Group dengan akses penuh',
            'member_count' => 5,
            'created_at' => '2026-01-15',
            'status' => 'Active'
        ];

        return view('user-groups.update', compact('group'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
            'member_count' => 'nullable|integer|min:0'
        ]);

        // Logic untuk update data di database
        // ...

        return redirect('/manajemen/user-groups')
            ->with('success', 'User Group berhasil diupdate');
    }

    public function destroy($id)
    {
        // Logic untuk hapus data
        // ...

        return redirect('/manajemen/user-groups')
            ->with('success', 'User Group berhasil dihapus');
    }
}