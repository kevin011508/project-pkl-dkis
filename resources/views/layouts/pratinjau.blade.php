@php
    $layout = auth()->user()->role === 'superadmin' ? 'manajemen.app' : 'layouts.app';

    $bulanList = [
        1 => 'JANUARI', 2 => 'FEBRUARI', 3 => 'MARET', 4 => 'APRIL',
        5 => 'MEI', 6 => 'JUNI', 7 => 'JULI', 8 => 'AGUSTUS',
        9 => 'SEPTEMBER', 10 => 'OKTOBER', 11 => 'NOVEMBER', 12 => 'DESEMBER'
    ];
    $namaBulan = $bulanList[(int)$bulan] ?? '';
@endphp

@extends($layout)

@section('content')
<div class="container py-4">

    {{-- Tombol Kembali & Export --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        {{-- ✅ Kembali ke form rekap, bukan url()->previous() --}}
        <a href="{{ route('rekap.index') }}" class="btn btn-secondary">
            &larr; Kembali
        </a>
        <a href="{{ route('rekap.export', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
           class="btn btn-success">
            ⬇ Export CSV
        </a>
    </div>

    {{-- Kertas Putih Pratinjau --}}
    <div style="background:#525659; padding:32px 24px 48px 24px; border-radius:4px;">
        <div style="
            background: white;
            max-width: 860px;
            margin: 0 auto;
            padding: 48px 56px 80px 56px;
            box-shadow: 0 2px 20px rgba(0,0,0,0.4);
            font-family: Arial, sans-serif;
        ">
            {{-- JUDUL --}}
            <div style="text-align:center; margin-bottom:18px; line-height:1.8;">
                <div style="font-size:14px; font-weight:bold;">AGENDA KEGIATAN</div>
                <div style="font-size:13px; font-weight:bold;">DINAS KOMUNIKASI, INFORMATIKA DAN STATISTIK</div>
                <div style="font-size:13px; font-weight:bold;">{{ $namaBulan }} {{ $tahun }}</div>
            </div>

            {{-- TOTAL --}}
            <p style="font-size:12px; margin-bottom:8px;">
                Total Agenda: {{ $agendas->count() }} Kegiatan
            </p>

            {{-- TABEL --}}
            <table style="width:100%; border-collapse:collapse; font-size:12px;">
                <thead>
                    <tr>
                        <th style="background:#5466d4; color:white; padding:9px 11px; border:1px solid #4055c0; width:42px; text-align:center;">No.</th>
                        <th style="background:#5466d4; color:white; padding:9px 11px; border:1px solid #4055c0; width:145px;">Waktu</th>
                        <th style="background:#5466d4; color:white; padding:9px 11px; border:1px solid #4055c0;">Kegiatan</th>
                        <th style="background:#5466d4; color:white; padding:9px 11px; border:1px solid #4055c0; width:180px;">Tempat</th>
                        <th style="background:#5466d4; color:white; padding:9px 11px; border:1px solid #4055c0; width:200px;">Dihadiri oleh</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($agendas as $index => $agenda)
                    <tr>
                        <td style="padding:9px 11px; border:1px solid #d0d0d0; text-align:center; vertical-align:top;">
                            {{ $index + 1 }}.
                        </td>
                        <td style="padding:9px 11px; border:1px solid #d0d0d0; vertical-align:top;">
                            {{ $agenda->tanggal_awal ? $agenda->tanggal_awal->format('d M Y H:i') : '-' }}
                        </td>
                        <td style="padding:9px 11px; border:1px solid #d0d0d0; vertical-align:top; line-height:1.5;">
                            {{ $agenda->nama_agenda }}
                        </td>
                        <td style="padding:9px 11px; border:1px solid #d0d0d0; vertical-align:top; line-height:1.5;">
                            {{ $agenda->lokasi ?? '-' }}
                        </td>
                        <td style="padding:9px 11px; border:1px solid #d0d0d0; vertical-align:top; line-height:1.5;">
                            {{ $agenda->disposisi ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding:20px; text-align:center; color:#aaa; font-style:italic; border:1px solid #d0d0d0;">
                            Tidak ada agenda pada periode ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection