{{-- resources/views/user-non-skpd/index.blade.php --}}
@extends('manajemen.app')

@section('title', 'User Non SKPD')

@push('styles')
<style>
    .content-section {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        padding: 25px;
        margin: 30px 20px;
    }
    h1 {
        color: #2c3e50;
        font-weight: 600;
        font-size: 28px;
        margin-bottom: 10px;
    }
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #495057;
        text-align: center;
        vertical-align: middle;
    }
    .table td {
        vertical-align: middle;
    }
    .search-box {
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 8px 15px;
        width: 250px;
    }
    .btn-tambah {
        background-color: #0d6efd;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s;
    }
    .btn-tambah:hover {
        background-color: #0b5ed7;
        color: white;
    }
    .badge-pin {
        background-color: #e9ecef;
        color: #495057;
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: 600;
        font-family: monospace;
    }
    .pagination {
        margin-bottom: 0;
    }
    .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    .page-link {
        color: #0d6efd;
    }
</style>
@endpush

@section('content')
<div class="content-section">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>User Non SKPD</h1>
        <a href="{{ url('/manajemen/user-non-skpd/create') }}" class="btn-tambah">
            <i class="bi bi-plus-circle me-2"></i>Tambahkan
        </a>
    </div>

    {{-- Filter & Search --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <span class="text-muted">Tampilkan:</span>
            <select class="form-select form-select-sm" style="width: 80px;" id="entriesPerPage">
                <option selected>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
            <span class="text-muted">entri</span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="text-muted">Cari:</span>
            <input type="text" class="search-box" placeholder="Cari username..." id="searchInput">
        </div>
    </div>

    {{-- Tabel --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th width="5%">No</th>
                    <th width="15%">Username</th>
                    <th width="12%">User Group</th>
                    <th width="38%">Non SKPD</th>
                    <th width="10%">PIN</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- ✅ Hanya tampilkan yang sudah punya username --}}
                @php $ada = false; @endphp
                @foreach($users as $user)
                    @if(!is_null($user->username))
                        @php $ada = true; @endphp
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $user->username }}</td>
                            <td class="text-center">
                                <span class="badge bg-info text-dark">{{ $user->user_group }}</span>
                            </td>
                            <td>{{ $user->nama }}</td>
                            <td class="text-center">
                                <span class="badge-pin">{{ $user->pin }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ url('/manajemen/user-non-skpd/' . $user->id) }}" class="btn btn-primary btn-sm" title="Detail">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ url('/manajemen/user-non-skpd/' . $user->id . '/edit') }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" title="Hapus"
                                   onclick="event.preventDefault(); if(confirm('Hapus user {{ $user->username }}?')) document.getElementById('delete-form-{{ $user->id }}').submit()">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                                <form id="delete-form-{{ $user->id }}" action="{{ url('/manajemen/user-non-skpd/' . $user->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach

                @if(!$ada)
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <i class="bi bi-people fs-1 d-block mb-3" style="color: #dee2e6;"></i>
                        <h5 style="color: #6c757d;">Belum ada data user non SKPD</h5>
                        <p style="color: #adb5bd;">Klik tombol "Tambahkan" untuk menambah data</p>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- Footer dengan Pagination --}}
    <div class="d-flex justify-content-between align-items-center mt-4">
        <span class="text-muted">
            Menampilkan {{ $users->firstItem() ?? 0 }} sampai {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} entri
        </span>
        <nav>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $users->previousPageUrl() }}">Sebelumnya</a>
                </li>
                @for($i = 1; $i <= $users->lastPage(); $i++)
                    <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $users->nextPageUrl() }}">Selanjutnya</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('searchInput')?.addEventListener('keyup', function() {
        let searchValue = this.value.toLowerCase();
        let tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            let username = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
            row.style.display = username.includes(searchValue) ? '' : 'none';
        });
    });

    document.getElementById('entriesPerPage')?.addEventListener('change', function() {
        let perPage = this.value;
        window.location.href = '{{ url("/manajemen/user-non-skpd") }}?per_page=' + perPage;
    });
</script>
@endpush
@endsection