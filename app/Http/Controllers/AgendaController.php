<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */public function index(Request $request)
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
              ->orWhere('disposisi', 'like', "%{$search}%");
    }

    // Pagination
    $perPage = $request->input('per_page', 10);

    $agendas = $query
        ->orderBy('tanggal_mulai', 'desc')
        ->paginate($perPage);

    // Total data
    $totalAgendas = Agenda::count();

    // DEBUG: Tampilkan apa yang akan dikirim ke view
    // dd([
    //     'agendas_count' => $agendas->count(),
    //     'perPage' => $perPage,
    //     'search' => $search
    // ]);

    return view('agenda', compact(
        'agendas',
        'totalAgendas',
        'search',
        'perPage'
    ));
}
    public function create()
    {
        return view('layouts.create');
    }

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
        'status_selesai' => 'boolean',
        'sifat_agenda' => 'required|in:publik,privat',
        'lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048'
    ]);

    // Handle file upload
    if ($request->hasFile('lampiran')) {
        $path = $request->file('lampiran')->store('lampiran_agenda', 'public');
        $validated['lampiran'] = $path;
    }

    // Set status
    $validated['status'] = 'belum'; // Default
    if ($request->has('status_selesai') && $request->status_selesai == 1) {
        $validated['status'] = 'selesai';
    }

    // Simpan ke database
    Agenda::create($validated);

    return redirect()->route('agenda.index')
        ->with('success', 'Agenda berhasil ditambahkan!');
}  

    public function update(Request $request, Agenda $agenda)
    {
        $validated = $request->validate([
            'nama_agenda' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'penyelenggara' => 'nullable|string|max:255',
            'lokasi' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'disposisi' => 'required|string|max:100',
            'seragam' => 'nullable|string|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date',
            'status_selesai' => 'boolean',
            'sifat_agenda' => 'required|in:publik,privat',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048'
        ]);

        if ($request->hasFile('lampiran')) {
            if ($agenda->lampiran) {
                Storage::disk('public')->delete($agenda->lampiran);
            }

            $validated['lampiran'] = $request
                ->file('lampiran')
                ->store('lampiran_agenda', 'public');
        }

        $validated['status'] = $this->getStatusAgenda(
            $validated['tanggal_mulai'],
            $validated['tanggal_selesai'] ?? null
        );

        $agenda->update($validated);

        return redirect()->route('agenda')
            ->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        if ($agenda->lampiran) {
            Storage::disk('public')->delete($agenda->lampiran);
        }

        $agenda->delete();

        return redirect()->route('agenda')
            ->with('success', 'Agenda berhasil dihapus.');
    }

    private function getStatusAgenda($tanggalMulai, $tanggalSelesai)
    {
        $now = now();
        $mulai = \Carbon\Carbon::parse($tanggalMulai);

        if ($tanggalSelesai) {
            $selesai = \Carbon\Carbon::parse($tanggalSelesai);
            if ($now->greaterThan($selesai)) {
                return 'selesai';
            }
        }

        if ($now->greaterThanOrEqualTo($mulai)) {
            return 'berjalan';
        }

        return 'belum';
    }

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

        return view('agenda.rekap', compact('agendas', 'startDate', 'endDate'));
    }
    
}
