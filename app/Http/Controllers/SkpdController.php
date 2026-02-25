<?php
// app/Http/Controllers/SkpdController.php

namespace App\Http\Controllers;

use App\Models\Skpd;
use Illuminate\Http\Request;

class SkpdController extends Controller
{
    public function index(Request $request)
    {
        $entries = $request->get('entries', 10);
        
        $skpd = Skpd::orderBy('id', 'asc')
                    ->paginate($entries)
                    ->withQueryString();
        
        return view('skpd.index', compact('skpd', 'entries'));
    }
    

    public function create()
    {
        return view('skpd.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alias' => 'nullable|string|max:50'
        ]);
        
        Skpd::create($request->all());
        
        return redirect()->route('manajemen.skpd.index')
                         ->with('success', 'SKPD berhasil ditambahkan');
    }
    
    public function edit(Skpd $skpd)
    {
        return view('skpd.edit', compact('skpd'));
    }
    
    public function update(Request $request, Skpd $skpd)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alias' => 'nullable|string|max:50'
        ]);
        
        $skpd->update($request->all());
        
        return redirect()->route('manajemen.skpd.index')
                         ->with('success', 'SKPD berhasil diperbarui');
    }
    
    public function destroy(Skpd $skpd)
    {
        $skpd->delete();
        
        return redirect()->route('skpd.index')
                         ->with('success', 'SKPD berhasil dihapus');
    }
}