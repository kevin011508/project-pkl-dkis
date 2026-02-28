<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AgendaController extends Controller
{
    /**
     * Helper: hitung status berdasarkan waktu sekarang (WIB)
     */
    private function getStatusAgenda($tanggalMulai, $tanggalSelesai = null): string
    {
        $now    = Carbon::now('Asia/Jakarta');
        $mulai  = Carbon::parse($tanggalMulai)->setTimezone('Asia/Jakarta');

        if ($tanggalSelesai) {
            $selesai = Carbon::parse($tanggalSelesai)->setTimezone('Asia/Jakarta');
            if ($now->greaterThan($selesai)) {
                return 'selesai';
            }
        }

        if ($now->greaterThanOrEqualTo($mulai)) {
            return 'berjalan';
        }

        return 'belum';
    }

    /**
     * Display a listing of the resource.
     * Status di-refresh otomatis setiap kali halaman dibuka.
     */
    public function index(Request $request)
    {
        $search  = $request->input('search');
        $perPage = $request->input('per_page', 10);

        // ── Auto-update status semua agenda yang belum selesai manual ──
        // Ambil semua agenda yang status-nya bukan 'selesai' (supaya tidak
        // menimpa agenda yang sudah ditandai selesai secara manual).
        Agenda::whereIn('status', ['belum', 'berjalan'])->each(function ($agenda) {
            $newStatus = $this->getStatusAgenda(
                $agenda->tanggal_awal,
                $agenda->tanggal_akhir
            );
            if ($agenda->status !== $newStatus) {
                $agenda->timestamps = false; // jangan ubah updated_at
                $agenda->status     = $newStatus;
                $agenda->save();
            }
        });
        // ────────────────────────────────────────────────────────────────

        $query = Agenda::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_agenda',   'like', "%{$search}%")
                  ->orWhere('deskripsi',   'like', "%{$search}%")
                  ->orWhere('lokasi',      'like', "%{$search}%")
                  ->orWhere('disposisi',   'like', "%{$search}%")
                  ->orWhere('penyelenggara', 'like', "%{$search}%");
            });
        }

        $agendas      = $query->orderBy('tanggal_awal', 'desc')->paginate($perPage);
        $totalAgendas = Agenda::count();

        return view('agenda', compact('agendas', 'totalAgendas', 'search', 'perPage'));
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
        $validated = $request->validate([
            'nama_agenda'   => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
            'penyelenggara' => 'nullable|string|max:255',
            'lokasi'        => 'required|string|max:255',
            'alamat'        => 'nullable|string',
            'disposisi'     => 'required|string|max:100',
            'seragam'       => 'nullable|string|max:100',
            'tanggal_awal'  => 'required|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_awal',
            'status_selesai'=> 'nullable|boolean',
            'sifat_agenda'  => 'required|in:publik,privat',
            'lampiran'      => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('lampiran')) {
            $validated['lampiran'] = $request->file('lampiran')
                ->store('lampiran_agenda', 'public');
        }

        // Jika ditandai selesai manual, langsung selesai; kalau tidak, hitung otomatis
        if ($request->boolean('status_selesai')) {
            $validated['status'] = 'selesai';
        } else {
            $validated['status'] = $this->getStatusAgenda(
                $validated['tanggal_awal'],
                $validated['tanggal_akhir'] ?? null
            );
        }

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
            'nama_agenda'   => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
            'penyelenggara' => 'nullable|string|max:255',
            'lokasi'        => 'required|string|max:255',
            'alamat'        => 'nullable|string',
            'disposisi'     => 'required|string|max:100',
            'seragam'       => 'nullable|string|max:100',
            'tanggal_awal'  => 'required|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_awal',
            'status_selesai'=> 'nullable|boolean',
            'sifat_agenda'  => 'required|in:publik,privat',
            'lampiran'      => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('lampiran')) {
            if ($agenda->lampiran) {
                Storage::disk('public')->delete($agenda->lampiran);
            }
            $validated['lampiran'] = $request->file('lampiran')
                ->store('lampiran_agenda', 'public');
        } elseif ($request->boolean('hapus_lampiran')) {
            if ($agenda->lampiran) {
                Storage::disk('public')->delete($agenda->lampiran);
            }
            $validated['lampiran'] = null;
        } else {
            $validated['lampiran'] = $agenda->lampiran;
        }

        // Update status
        if ($request->boolean('status_selesai')) {
            $validated['status'] = 'selesai';
        } else {
            $validated['status'] = $this->getStatusAgenda(
                $validated['tanggal_awal'],
                $validated['tanggal_akhir'] ?? null
            );
        }

        $agenda->update($validated);

        return redirect()->route('agenda.index')
            ->with('success', 'Agenda berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();

        return redirect()->route('agenda.index')
            ->with('success', 'Agenda berhasil dihapus');
    }

    /**
     * Restore soft-deleted agenda.
     */
    public function restore($id)
    {
        $agenda = Agenda::withTrashed()->findOrFail($id);
        $agenda->restore();

        return redirect()->route('agenda.trash')
            ->with('success', 'Agenda berhasil direstore');
    }

    /**
     * Trash list.
     */
    public function trash()
    {
        $agendas = Agenda::onlyTrashed()->paginate(10);
        return view('agenda.trash', compact('agendas'));
    }

    /**
     * Export rekap agenda.
     */
    public function exportRekap(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');

        $query = Agenda::query();

        if ($startDate) {
            $query->whereDate('tanggal_awal', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('tanggal_awal', '<=', $endDate);
        }

        $agendas = $query->get();

        return view('layouts.rekap', compact('agendas', 'startDate', 'endDate'));
    }

    /**
     * Show detail agenda.
     */
    public function show($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('layouts.show', compact('agenda'));
    }
}