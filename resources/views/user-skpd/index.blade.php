{{-- resources/views/user-skpd/index.blade.php --}}
@extends('manajemen.app')

@section('title', 'User SKPD')

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
    }
    .entries-selector {
        display: flex;
        align-items: center;
        gap: 10px;
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
    .action-icons i {
        margin: 0 8px;
        color: #6c757d;
        cursor: pointer;
        font-size: 18px;
    }
    .action-icons i:hover {
        color: #0d6efd;
    }
    .pagination {
        margin-bottom: 0;
    }
    .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    .badge-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    .badge-active {
        background-color: #d1e7dd;
        color: #0a3622;
    }
    .badge-inactive {
        background-color: #f8d7da;
        color: #58151c;
    }
</style>
@endpush

@section('content')
<div class="content-section">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>User SKPD</h1>
        <a href="{{ url('/manajemen/user-skpd/create') }}" class="btn-tambah">
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
                    <th width="20%">Username</th>
                    <th width="15%">User Group</th>
                    <th width="45%">SKPD</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                <tr>
                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle fw-semibold">{{ $user->username }}</td>
                    <td class="align-middle">
                        <span class="badge bg-info text-dark">{{ $user->user_group }}</span>
                    </td>
                    <td class="align-middle">{{ $user->nama_skpd ?? '-' }}</td>
                        <a href="{{ url('/manajemen/user-skpd/' . $user->id) }}" class="text-decoration-none">
                            {{-- <span class="badge bg-primary me-1 p-2" style="cursor: pointer;">
                                <i class="bi bi-eye text-white"></i>
                            </span> --}}
                        </a>
                        <a href="{{ url('/manajemen/user-skpd/' . $user->id . '/edit') }}" class="text-decoration-none">
                            {{-- <span class="badge bg-warning me-1 p-2" style="cursor: pointer;">
                                <i class="bi bi-pencil text-white"></i>
                            </span> --}}
                        </a>
                        {{-- <span class="badge bg-danger p-2" style="cursor: pointer;" 
                              onclick="if(confirm('Hapus user {{ $user->username }}?')) document.getElementById('delete-form-{{ $user->id }}').submit()">
                            <i class="bi bi-trash text-white"></i>
                        </span> --}}
                        <form id="delete-form-{{ $user->id }}" action="{{ url('/manajemen/user-skpd/' . $user->id) }}" method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <i class="bi bi-people fs-1 d-block mb-3" style="color: #dee2e6;"></i>
                        <h5 style="color: #6c757d;">Belum ada data user SKPD</h5>
                        <p style="color: #adb5bd;">Klik tombol "Tambahkan" untuk menambah data</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Footer dengan Pagination --}}
    <div class="d-flex justify-content-between align-items-center mt-4">
        <span class="text-muted">
            Menampilkan {{ $users->firstItem() ?? 0 }} sampai {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} entri
        </span>
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
</div>

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput')?.addEventListener('keyup', function() {
        let searchValue = this.value.toLowerCase();
        let tableRows = document.querySelectorAll('tbody tr');
        
        tableRows.forEach(row => {
            let username = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
            row.style.display = username.includes(searchValue) ? '' : 'none';
        });
    });

    // Entries per page
    document.getElementById('entriesPerPage')?.addEventListener('change', function() {
        let perPage = this.value;
        window.location.href = '{{ url("/manajemen/user-skpd") }}?per_page=' + perPage;
    });
</script>
@endpush
@endsection