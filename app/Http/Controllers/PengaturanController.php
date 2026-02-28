<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function edit()
    {
        $pengaturan = Pengaturan::first();
        return view('manajemen.pengaturan', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_web' => 'required|string|max:100',
        ]);

        $pengaturan = Pengaturan::firstOrNew([]);
        $pengaturan->nama_web = $request->nama_web;
        $pengaturan->save();

        return redirect()->route('manajemen.pengaturan')
                         ->with('success', 'Pengaturan berhasil disimpan!');
    }
}