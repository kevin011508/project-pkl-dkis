<?php
// app/Http/Controllers/Manajemen/NonSkpdController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NonSkpd;
use Illuminate\Http\Request;

class NonSkpdController extends Controller
{
    public function index(Request $request)
    {
        $entries = $request->get('entries', 10);
        
        $nonSkpd = NonSkpd::orderBy('id', 'asc')
                    ->paginate($entries)
                    ->withQueryString();
        
        return view('non-skpd.index', compact('nonSkpd', 'entries'));
    }
    
    public function create()
    {
        return view('non-skpd.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alias' => 'nullable|string|max:50'
        ]);
        
        NonSkpd::create($request->all());
        
        return redirect()->route('manajemen.non-skpd.index')
                         ->with('success', 'Data Non SKPD berhasil ditambahkan');
    }
    
    public function edit(NonSkpd $nonSkpd)
    {
        return view('non-skpd.edit', compact('nonSkpd'));
    }
    
    public function update(Request $request, NonSkpd $nonSkpd)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alias' => 'nullable|string|max:50'
        ]);
        
        $nonSkpd->update($request->all());
        
        return redirect()->route('manajemen.non-skpd.index')
                         ->with('success', 'Data Non SKPD berhasil diperbarui');
    }
    
    public function destroy(NonSkpd $nonSkpd)
    {
        $nonSkpd->delete();
        
        return redirect()->route('non-skpd.index')
                         ->with('success', 'Data Non SKPD berhasil dihapus');
    }
}
?>