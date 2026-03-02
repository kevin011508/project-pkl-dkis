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

    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

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

    public function create()
    {
        return view('layouts.create');
    }

    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('layouts.edit', compact('agenda'));
    }

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

        if ($request->hasFile('lampiran')) {
            $validated['berkas'] = $request->file('lampiran')->store('lampiran_agenda', 'public');
            unset($validated['lampiran']); // kolom di DB namanya 'berkas'
        }

        $validated['status'] = $this->getStatusAgenda(
            $validated['tanggal_awal'],
            $validated['tanggal_akhir'] ?? null
        );

        $validated['created_by'] = Auth::user()->id; // ✅ fix

        Agenda::create($validated);

        return redirect()->route('agenda.index')
            ->with('success', 'Agenda berhasil ditambahkan');
    }

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

        $validated['updated_by'] = Auth::user()->id; // ✅ fix

        $agenda->update($validated);

        return redirect()->route('agenda.index')
            ->with('success', 'Agenda berhasil diupdate');
    }

    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);

        $agenda->deleted_by = Auth::user()->id; // ✅ fix
        $agenda->save();

        $agenda->delete();

        return redirect()->route('agenda.index')
            ->with('success', 'Agenda berhasil dihapus');
    }

    public function trash()
    {
        $agendas = Agenda::onlyTrashed()
            ->with('deletedByUser')
            ->paginate(10);

        return view('agenda.trash', compact('agendas'));
    }

    public function restore($id)
    {
        $agenda = Agenda::withTrashed()->findOrFail($id);
        $agenda->restore();

        return redirect()->route('agenda.trash')
            ->with('success', 'Agenda berhasil direstore');
    }

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

    public function show($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('layouts.show', compact('agenda'));
    }
}