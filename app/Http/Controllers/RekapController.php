<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;

class RekapController extends Controller
{
    public function index()
    {
        return view('layouts.rekap');
    }

    public function filter(Request $request)
    {
        $bulan = $request->input('bulan', date('n'));
        $tahun = $request->input('tahun', date('Y'));

        $agendas = Agenda::whereMonth('tanggal_awal', $bulan)
            ->whereYear('tanggal_awal', $tahun)
            ->orderBy('tanggal_awal', 'asc')
            ->get();

        // ✅ Arahkan ke view pratinjau yang baru
        return view('layouts.pratinjau', compact('agendas', 'bulan', 'tahun'));
    }

    public function exportRekap(Request $request)
    {
        $bulan = $request->input('bulan', date('n'));
        $tahun = $request->input('tahun', date('Y'));

        $agendas = Agenda::whereMonth('tanggal_awal', $bulan)
            ->whereYear('tanggal_awal', $tahun)
            ->orderBy('tanggal_awal', 'asc')
            ->get();

        $filename = 'rekap_agenda_' . $tahun . '_' . str_pad($bulan, 2, '0', STR_PAD_LEFT) . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($agendas) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'No', 'Nama Agenda', 'Tanggal Mulai', 'Tanggal Selesai',
                'Lokasi', 'Penyelenggara', 'Disposisi', 'Status', 'Sifat'
            ]);

            foreach ($agendas as $i => $agenda) {
                fputcsv($file, [
                    $i + 1,
                    $agenda->nama_agenda,
                    $agenda->tanggal_awal ? $agenda->tanggal_awal->format('d/m/Y H:i') : '-',
                    $agenda->tanggal_akhir ? $agenda->tanggal_akhir->format('d/m/Y H:i') : '-',
                    $agenda->lokasi,
                    $agenda->penyelenggara ?? '-',
                    $agenda->disposisi,
                    $agenda->status,
                    $agenda->sifat_agenda,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}