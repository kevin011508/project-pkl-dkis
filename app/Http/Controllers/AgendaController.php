<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    /**
     * Helper: hitung status agenda
     */
    private function getStatusAgenda($tanggalMulai, $tanggalSelesai = null): string
    {
        $now = Carbon::now('Asia/Jakarta');
        $mulai = Carbon::parse($tanggalMulai)->setTimezone('Asia/Jakarta');

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
     * List agenda
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        // Update status otomatis
        Agenda::whereIn('status', ['belum', 'berjalan'])->each(function ($agenda) {
            $newStatus = $this->getStatusAgenda(
                $agenda->tanggal_awal,
                $agenda->tanggal_akhir
            );

            if ($agenda->status !== $newStatus) {
                $agenda->timestamps = false;
                $agenda->status = $newStatus;
                $agenda->save();
            }
        });

        $query = Agenda::query();

        if ($search) {
            $query->where('nama_agenda', 'like', "%{$search}%");
        }

        $agendas = $query->orderBy('tanggal_awal', 'desc')->paginate($perPage);
        $totalAgendas = Agenda::count();

        return view('agenda', compact('agendas', 'totalAgendas', 'search', 'perPage'));
    }


    /**
     * Form create
     */
    public function create()
    {
        return view('layouts.create');
    }


    /**
     * Simpan agenda
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_agenda'   => 'required|string|max:191',
            'tanggal_awal'  => 'required|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_awal',
            'lokasi'        => 'required|string|max:191',
            'alamat'        => 'nullable|string',
            'deskripsi'     => 'nullable|string',
            'penyelenggara' => 'nullable|string|max:191',
            'disposisi'     => 'required|string|max:191',
            'seragam'       => 'nullable|string|max:191',
            'sifat_agenda'  => 'required|in:publik,privat',
            'lampiran'      => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        // Upload file
        if ($request->hasFile('lampiran')) {
            $validated['berkas'] = $request->file('lampiran')
                ->store('lampiran_agenda', 'public');

            unset($validated['lampiran']);
        }

        // Status
        $validated['status'] = $this->getStatusAgenda(
            $validated['tanggal_awal'],
            $validated['tanggal_akhir'] ?? null
        );

        // Created by — pakai getAttribute('id') agar tidak terpengaruh override getAuthIdentifier()
        $validated['created_by'] = Auth::user()->getAttribute('id');

        Agenda::create($validated);

        return redirect()->route('agenda.index')
            ->with('success', 'Agenda berhasil ditambahkan');
    }


    /**
     * Detail agenda
     */
    public function show($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('layouts.show', compact('agenda'));
    }


    /**
     * Form edit
     */
    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('layouts.edit', compact('agenda'));
    }


    /**
     * Update agenda
     */
    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);

        $validated = $request->validate([
            'nama_agenda'   => 'required|string|max:191',
            'tanggal_awal'  => 'required|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_awal',
            'lokasi'        => 'required|string|max:191',
            'alamat'        => 'nullable|string',
            'deskripsi'     => 'nullable|string',
            'penyelenggara' => 'nullable|string|max:191',
            'disposisi'     => 'required|string|max:191',
            'seragam'       => 'nullable|string|max:191',
            'sifat_agenda'  => 'required|in:publik,privat',
        ]);

        $validated['status'] = $this->getStatusAgenda(
            $validated['tanggal_awal'],
            $validated['tanggal_akhir'] ?? null
        );

        // Updated by — pakai getAttribute('id') agar tidak terpengaruh override getAuthIdentifier()
        $validated['updated_by'] = Auth::user()->getAttribute('id');

        $agenda->update($validated);

        return redirect()->route('agenda.index')
            ->with('success', 'Agenda berhasil diupdate');
    }


    /**
     * Soft delete
     */
    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);

        // Deleted by — pakai getAttribute('id') agar tidak terpengaruh override getAuthIdentifier()
        $agenda->deleted_by = Auth::user()->getAttribute('id');
        $agenda->save();

        $agenda->delete();

        return redirect()->route('agenda.index')
            ->with('success', 'Agenda berhasil dihapus');
    }


    /**
     * Halaman trash
     */
    public function trash()
    {
        $agendas = Agenda::onlyTrashed()
            ->paginate(10);

        return view('agenda.trash', compact('agendas'));
    }


    /**
     * Restore dari trash
     */
    public function restore($id)
    {
        $agenda = Agenda::withTrashed()->findOrFail($id);

        $agenda->restore();

        return redirect()->route('agenda.trash')
            ->with('success', 'Agenda berhasil direstore');
    }


    /**
     * Force delete satu
     */
    public function forceDelete($id)
    {
        $agenda = Agenda::withTrashed()->findOrFail($id);

        if ($agenda->berkas) {
            Storage::disk('public')->delete($agenda->berkas);
        }

        $agenda->forceDelete();

        return redirect()->route('agenda.trash')
            ->with('success', 'Agenda dihapus permanen');
    }


    /**
     * Force delete semua
     */
    public function forceDeleteAll()
    {
        $agendas = Agenda::onlyTrashed()->get();

        foreach ($agendas as $agenda) {

            if ($agenda->berkas) {
                Storage::disk('public')->delete($agenda->berkas);
            }

            $agenda->forceDelete();
        }

        return redirect()->route('agenda.trash')
            ->with('success', 'Semua agenda berhasil dihapus permanen');
    }
}