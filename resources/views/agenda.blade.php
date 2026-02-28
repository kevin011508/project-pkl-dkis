@php
    $layout = auth()->user()->role === 'superadmin' ? 'manajemen.app' : 'layouts.app';
@endphp

@extends($layout)

@section('title', 'Agenda - ISUN')

@section('content')
<div class="container-fluid px-4 py-3">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 fw-bold">Agenda</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('agenda.export-rekap') }}" class="btn btn-rekap">
                <i class="bi bi-pie-chart me-2"></i> Rekap
            </a>
            <a href="{{ route('agenda.create') }}" class="btn btn-tambah">
                <i class="bi bi-plus-circle me-2"></i> Tambah
            </a>
        </div>
    </div>

    <div class="table-container">

        {{-- Filter & Search --}}
        <div class="table-header d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

            {{-- Tampilan Entri --}}
            <form action="{{ route('agenda.index') }}" method="GET" class="d-flex align-items-center gap-2">
                <label for="entriesPerPage" class="mb-0">Tampilan</label>
                <select name="per_page"
                        class="form-select form-select-sm"
                        id="entriesPerPage"
                        style="width: auto;"
                        onchange="this.form.submit()">
                    @foreach([10, 25, 50, 100] as $opt)
                        <option value="{{ $opt }}" {{ request('per_page', 10) == $opt ? 'selected' : '' }}>
                            {{ $opt }} entri
                        </option>
                    @endforeach
                </select>
                <input type="hidden" name="search" value="{{ request('search', '') }}">
            </form>

            {{-- Search Box --}}
            <form action="{{ route('agenda.index') }}" method="GET" class="d-flex gap-1">
                <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                <div class="input-group input-group-sm">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text"
                           class="form-control"
                           name="search"
                           placeholder="Cari agenda..."
                           value="{{ request('search', '') }}">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </form>

        </div>

        {{-- TABLE --}}
        @if($agendas->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Agenda</th>
                            <th width="150">Disposisi</th>
                            <th width="160">Mulai</th>
                            <th width="110">Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agendas as $agenda)
                            <tr>
                                <td>{{ ($agendas->currentPage() - 1) * $agendas->perPage() + $loop->iteration }}</td>

                                <td>
                                    <strong>{{ $agenda->nama_agenda }}</strong>
                                    @if($agenda->sifat_agenda == 'privat')
                                        <span class="badge bg-secondary ms-2">Privat</span>
                                    @endif
                                </td>

                                <td>{{ $agenda->disposisi }}</td>

                                <td>
                                    <div>{{ $agenda->tanggal_awal->format('Y-m-d') }}</div>
                                    <small class="text-muted">{{ $agenda->tanggal_awal->format('H:i:s') }}</small>
                                </td>

                                {{-- 
                                    Gunakan $agenda->status_realtime (accessor dari model)
                                    agar status selalu akurat berdasarkan waktu WIB saat ini,
                                    tanpa bergantung pada nilai yang tersimpan di database.
                                --}}
                                <td>
                                    @php $statusNow = $agenda->status_realtime; @endphp

                                    @if($statusNow === 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif($statusNow === 'berjalan')
                                        <span class="badge bg-info text-dark">Berjalan</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Belum</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('agenda.show', $agenda->id) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('agenda.edit', $agenda->id) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('agenda.destroy', $agenda->id) }}"
                                          method="POST"
                                          style="display:inline"
                                          onsubmit="return confirm('Hapus agenda ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-center text-muted mt-3">
                Menampilkan {{ $agendas->firstItem() }} sampai {{ $agendas->lastItem() }}
                dari {{ $agendas->total() }} entri
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $agendas->appends(request()->query())->links() }}
            </div>

        @else
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i> Tidak ada data agenda.
                <a href="{{ route('agenda.create') }}" class="alert-link">Tambahkan agenda baru</a>
            </div>
        @endif

    </div>
</div>
@endsection