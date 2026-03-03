<?php
// app/Http/Controllers/UserPermissionController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\UserPermission;

class UserPermissionController extends Controller
{
    /**
     * Otomatis baca semua route yang pakai middleware permission:controller,action
     * lalu insert ke tabel permissions kalau belum ada.
     */
    private function syncFromRoutes(): void
    {
        foreach (Route::getRoutes() as $route) {
            foreach ($route->gatherMiddleware() as $middleware) {
                if (str_starts_with($middleware, 'permission:')) {
                    $params = str_replace('permission:', '', $middleware);
                    [$controller, $action] = array_pad(explode(',', $params), 2, null);

                    if ($controller && $action) {
                        UserPermission::firstOrCreate(
                            [
                                'controller' => trim($controller),
                                'action'     => trim($action),
                            ],
                            [
                                'info' => '', // default kosong agar tidak error
                            ]
                        );
                    }
                }
            }
        }
    }

    public function index()
    {
        // Sync otomatis dari routes setiap kali halaman dibuka
        $this->syncFromRoutes();

        return view('user-permission.index');
    }

    public function create()
    {
        return view('user-permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'controller' => 'required|string|max:100',
            'action'     => 'required|string|max:100',
            'info'       => 'nullable|string|max:255',
        ], [
            'controller.required' => 'Controller wajib diisi.',
            'action.required'     => 'Aksi wajib diisi.',
        ]);

        $exists = UserPermission::where('controller', $request->controller)
                                ->where('action', $request->action)
                                ->exists();

        if ($exists) {
            return back()->withInput()
                ->withErrors(['controller' => 'Kombinasi controller + action sudah ada.']);
        }

        UserPermission::create($request->only(['controller', 'action', 'info']));

        return redirect('/manajemen/user-permission')
            ->with('success', 'Permission berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $permission = UserPermission::findOrFail($id);
        return view('user-permission.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $permission = UserPermission::findOrFail($id);

        $request->validate([
            'controller' => 'required|string|max:100',
            'action'     => 'required|string|max:100',
            'info'       => 'nullable|string|max:255',
        ], [
            'controller.required' => 'Controller wajib diisi.',
            'action.required'     => 'Aksi wajib diisi.',
        ]);

        $exists = UserPermission::where('controller', $request->controller)
                                ->where('action', $request->action)
                                ->where('id', '!=', $id)
                                ->exists();

        if ($exists) {
            return back()->withInput()
                ->withErrors(['controller' => 'Kombinasi controller + action sudah ada.']);
        }

        $permission->update($request->only(['controller', 'action', 'info']));

        return redirect('/manajemen/user-permission')
            ->with('success', 'Permission berhasil diupdate.');
    }

    public function destroy($id)
    {
        UserPermission::findOrFail($id)->delete();

        return redirect('/manajemen/user-permission')
            ->with('success', 'Permission berhasil dihapus.');
    }

    // Dipanggil DataTables via AJAX
    public function getData(Request $request)
    {
        $query = UserPermission::query();

        if ($request->filled('search.value')) {
            $search = $request->input('search.value');
            $query->where(function ($q) use ($search) {
                $q->where('controller', 'like', "%{$search}%")
                  ->orWhere('action',     'like', "%{$search}%")
                  ->orWhere('info',       'like', "%{$search}%");
            });
        }

        $totalFiltered = $query->count();
        $totalData     = UserPermission::count();

        $columnIndex = $request->input('order.0.column', 1);
        $columnMap   = [0 => 'id', 1 => 'controller', 2 => 'action', 3 => 'info'];
        $orderColumn = $columnMap[$columnIndex] ?? 'controller';
        $orderDir    = $request->input('order.0.dir', 'asc') === 'desc' ? 'desc' : 'asc';
        $query->orderBy($orderColumn, $orderDir);

        $start  = (int) $request->input('start', 0);
        $length = (int) $request->input('length', 10);
        $data   = $query->offset($start)->limit($length)->get();

        $rows = $data->map(function ($item, $index) use ($start) {
            $no           = $start + $index + 1;
            $editUrl      = url('/manajemen/user-permission/' . $item->id . '/edit');
            $deleteUrl    = url('/manajemen/user-permission/' . $item->id);
            $deleteFormId = 'delete-form-' . $item->id;

            $aksi = '
                <a href="' . $editUrl . '" class="btn btn-warning btn-sm" title="Edit">
                    <i class="bi bi-pencil-fill"></i>
                </a>
                <a href="#" class="btn btn-danger btn-sm" title="Hapus"
                   onclick="event.preventDefault();
                            if(confirm(\'Hapus permission ' . e($item->controller) . ' - ' . e($item->action) . '?\'))
                            document.getElementById(\'' . $deleteFormId . '\').submit();">
                    <i class="bi bi-trash"></i>
                </a>
                <form id="' . $deleteFormId . '" action="' . $deleteUrl . '" method="POST" style="display:none;">
                    ' . csrf_field() . method_field('DELETE') . '
                </form>
            ';

            return [
                $no,
                '<span class="badge-controller">' . e($item->controller) . '</span>',
                '<span class="badge-action">' . e($item->action) . '</span>',
                $item->info
                    ? e(\Illuminate\Support\Str::limit($item->info, 60))
                    : '<span class="text-muted fst-italic">-</span>',
                $aksi,
            ];
        });

        return response()->json([
            'draw'            => intval($request->input('draw')),
            'recordsTotal'    => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data'            => $rows,
        ]);
    }
}