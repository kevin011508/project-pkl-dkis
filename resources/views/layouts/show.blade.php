@php   
   $layout = auth()->user()->role === 'superadmin' ? 'manajemen.app' : 'layouts.app';
@endphp
@extends($layout)

@section('title', 'Lihat Agenda')

@section('content')
<div class="container py-4">

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold text-dark mb-0">Lihat Agenda</h2>
        </div>
    </div>

    <!-- Main Card -->
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card border shadow-sm">
                <div class="card-body p-4">

                    <table class="table table-borderless mb-4">
                        <tbody>
                            <tr>
                                <td class="fw-bold text-dark" style="width: 160px; vertical-align: top;">Nama Agenda</td>
                                <td class="text-dark">{{ $agenda->nama_agenda ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark" style="vertical-align: top;">Uraian</td>
                                <td class="text-dark">{{ $agenda->deskripsi ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark" style="vertical-align: top;">Penyelenggara</td>
                                <td class="text-dark">{{ $agenda->penyelenggara ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark" style="vertical-align: top;">Lokasi</td>
                                <td class="text-dark">{{ $agenda->lokasi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark" style="vertical-align: top;">Alamat</td>
                                <td class="text-dark">{{ $agenda->alamat ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark" style="vertical-align: top;">Disposisi</td>
                                <td class="text-dark">{{ $agenda->disposisi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark" style="vertical-align: top;">Seragam</td>
                                <td class="text-dark">{{ $agenda->seragam ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark" style="vertical-align: top;">Tanggal Awal</td>
                                <td class="text-dark">
                                    {{ $agenda->tanggal_awal 
                                        ? \Carbon\Carbon::parse($agenda->tanggal_awal)->format('Y-m-d H:i:s') 
                                        : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark" style="vertical-align: top;">Tanggal Akhir</td>
                                <td class="text-dark">
                                    @if($agenda->tanggal_akhir)
                                        {{ \Carbon\Carbon::parse($agenda->tanggal_akhir)->format('Y-m-d H:i:s') }}
                                    @else
                                        SELESAI
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark" style="vertical-align: top;">Berkas</td>
                                <td class="text-dark">
                                    @if($agenda->berkas)
                                        <a href="#" class="text-primary text-decoration-none">
                                            <i class="fas fa-file-pdf me-1"></i>{{ $agenda->berkas }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Tombol Kembali -->
                    <div class="mt-2">
                        <a href="{{ route('agenda.index') }}" class="btn btn-secondary px-4">
                            Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table td {
        padding: 8px 12px;
    }
    .table tbody tr:not(:last-child) td {
        border-bottom: none;
    }
    .btn-secondary {
        background-color: #555;
        border-color: #555;
    }
    .btn-secondary:hover {
        background-color: #444;
        border-color: #444;
    }
</style>
@endsection