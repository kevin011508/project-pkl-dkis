<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Pencarian
        $search = $request->input('search');

        // Query dasar
        $query = Agenda::query();

        // Filter pencarian
        if ($search) {
            $query->where('nama_agenda', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('disposisi', 'like', "%{$search}%")
                  ->orWhere('penyelenggara', 'like', "%{$search}%");
        }

        // Pagination
        $perPage = $request->input('per_page', 10);

        $agendas = $query
            ->orderBy('tanggal_mulai', 'desc')
            ->paginate($perPage);

        // Total data
        $totalAgendas = Agenda::count();

        return view('agenda', compact(
            'agendas',
            'totalAgendas',
            'search',
            'perPage'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('layouts.edit', compact('agenda'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'nama_agenda' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'penyelenggara' => 'nullable|string|max:255',
            'lokasi' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'disposisi' => 'required|string|max:100',
            'seragam' => 'nullable|string|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status_selesai' => 'nullable|boolean',
            'sifat_agenda' => 'required|in:publik,privat',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048'
        ]);

        // Handle file upload
        if ($request->hasFile('lampiran')) {
            $path = $request->file('lampiran')->store('lampiran_agenda', 'public');
            $validated['lampiran'] = $path;
        }

        // Set status
        if ($request->has('status_selesai') && $request->status_selesai == 1) {
            $validated['status'] = 'selesai';
        } else {
            $validated['status'] = $this->getStatusAgenda(
                $validated['tanggal_mulai'],
                $validated['tanggal_selesai'] ?? null
            );
        }

        // Simpan ke database
        Agenda::create($validated);

        return redirect()->route('agenda.index')
            ->with('success', 'Agenda berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);
        
        $validated = $request->validate([
            'nama_agenda' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'penyelenggara' => 'nullable|string|max:255',
            'lokasi' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'disposisi' => 'required|string|max:100',
            'seragam' => 'nullable|string|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status_selesai' => 'nullable|boolean',
            'sifat_agenda' => 'required|in:publik,privat',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048'
        ]);

        // Handle file upload
        if ($request->hasFile('lampiran')) {
            // Hapus file lama jika ada
            if ($agenda->lampiran) {
                Storage::disk('public')->delete($agenda->lampiran);
            }
            $validated['lampiran'] = $request->file('lampiran')->store('lampiran_agenda', 'public');
        }

        // Handle hapus lampiran
        if ($request->has('hapus_lampiran') && $request->hapus_lampiran == 1) {
            if ($agenda->lampiran) {
                Storage::disk('public')->delete($agenda->lampiran);
                $validated['lampiran'] = null;
            }
        }

        // Jika tidak ada file baru dan tidak menghapus file lama, pertahankan file lama
        if (!isset($validated['lampiran']) && !$request->has('hapus_lampiran')) {
            $validated['lampiran'] = $agenda->lampiran;
        }

        // Update status
        if ($request->has('status_selesai') && $request->status_selesai == 1) {
            $validated['status'] = 'selesai';
        } else {
            $validated['status'] = $this->getStatusAgenda(
                $validated['tanggal_mulai'],
                $validated['tanggal_selesai'] ?? null
            );
        }

        $agenda->update($validated);

        return redirect()->route('agenda.index')
            ->with('success', 'Agenda berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $agenda = Agenda::findOrFail($id);
    $agenda->delete(); // INI SOFT DELETE
    return redirect()->route('agenda.index')
        ->with('success', 'Agenda berhasil dihapus');
}
        //untuk restore data yang dihapus
   public function restore($id)
{
    $agenda = Agenda::withTrashed()->findOrFail($id);
    $agenda->restore();

    return redirect()->route('agenda.trash')
        ->with('success', 'Agenda berhasil direstore');
}

    //trash
public function trash()
{
    $agendas = Agenda::onlyTrashed()->paginate(10);
    return view('agenda.trash', compact('agendas'));
}


    /**
     * Export rekap agenda
     */
    public function exportRekap(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Agenda::query();

        if ($startDate) {
            $query->whereDate('tanggal_mulai', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('tanggal_mulai', '<=', $endDate);
        }

        $agendas = $query->get();

        return view('layouts.rekap', compact('agendas', 'startDate', 'endDate'));
    }

    /**
     * Helper method untuk menentukan status agenda
     */
    private function getStatusAgenda($tanggalMulai, $tanggalSelesai = null)
    {
        $now = Carbon::now();
        $mulai = Carbon::parse($tanggalMulai);

        if ($tanggalSelesai) {
            $selesai = Carbon::parse($tanggalSelesai);
            if ($now->greaterThan($selesai)) {
                return 'selesai';
            }
        }

        if ($now->greaterThanOrEqualTo($mulai)) {
            return 'berjalan';
        }

        return 'belum';
        
    }
    public function show($id)
{
    $agenda = Agenda::findOrFail($id);
    return view('layouts.show', compact('agenda'));
}

}