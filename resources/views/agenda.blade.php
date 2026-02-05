@php
    // EMERGENCY FALLBACK - Hapus nanti jika sudah fix
    if (!isset($agendas)) {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        
        $query = \App\Models\Agenda::query();
        
        if ($search) {
            $query->where('nama_agenda', 'like', "%{$search}%")
                  ->orWhere('disposisi', 'like', "%{$search}%");
        }
        
        $agendas = $query->paginate($perPage);
        $totalAgendas = \App\Models\Agenda::count();
    }
@endphp

@extends('layouts.app')

@section('title', 'Agenda - ISUN')

@section('content')
    <!-- Tombol Rekap dan Tambah -->
    <div style="margin-bottom: 20px;">
        <div class="d-flex justify-content-between align-items-center">
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
    </div>

    <div class="table-container">
        <div class="table-header">
            <!-- Tampilan Entri -->
            <form action="{{ route('agenda.index') }}" method="GET" class="entries-filter">
                <label for="entriesPerPage">Tampilan</label>
                <select name="per_page"
                        class="form-select form-select-sm"
                        id="entriesPerPage"
                        style="width: auto;"
                        onchange="this.form.submit()">
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 entri</option>
                    <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25 entri</option>
                    <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50 entri</option>
                    <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100 entri</option>
                </select>

                <input type="hidden" name="search" value="{{ request('search', '') }}">
            </form>

            <!-- Search Box -->
            <div class="search-box">
                <form action="{{ route('agenda.index') }}" method="GET">
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
        </div>

        <!-- TABLE -->
        @if(isset($agendas) && $agendas->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Agenda</th>
                        <th width="150">Disposisi</th>
                        <th width="150">Mulai</th>
                        <th width="100">Status</th>
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
                                <div>{{ $agenda->tanggal_mulai->format('Y-m-d') }}</div>
                                <small class="text-muted">{{ $agenda->tanggal_mulai->format('H:i:s') }}</small>
                            </td>
                            <td>
                                @if($agenda->status == 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif($agenda->status == 'berjalan')
                                    <span class="badge bg-info">Berjalan</span>
                                @else
                                    <span class="badge bg-warning">Belum</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('agenda.show', $agenda->id) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('agenda.edit', $agenda->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('agenda.destroy', $agenda->id) }}"
                                      method="POST"
                                      style="display:inline"
                                      onsubmit="return confirm('Hapus agenda?')">
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

            <div class="pagination-info text-center mt-3">
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
@endsection