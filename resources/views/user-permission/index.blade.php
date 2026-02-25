{{-- resources/views/user-permission/index.blade.php --}}
@extends('manajemen.app')

@section('title', 'User Permission')

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
    .icon-link {
        color: #6c757d;
        font-size: 18px;
        margin: 0 5px;
        text-decoration: none;
    }
    .icon-link:hover {
        color: #0d6efd;
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
    .badge-controller {
        background-color: #e9ecef;
        color: #495057;
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 13px;
    }
    .badge-action {
        background-color: #cff4fc;
        color: #055160;
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 13px;
    }
    .toggle-checkbox {
        width: 50px;
        height: 24px;
        background-color: #dc3545;
        border-radius: 30px;
        position: relative;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-block;
    }
    .toggle-checkbox.active {
        background-color: #198754;
    }
    .toggle-checkbox .toggle-circle {
        width: 20px;
        height: 20px;
        background-color: white;
        border-radius: 50%;
        position: absolute;
        top: 2px;
        left: 2px;
        transition: all 0.3s;
    }
    .toggle-checkbox.active .toggle-circle {
        left: 28px;
    }
    .info-icon {
        color: #17a2b8;
        font-size: 18px;
        cursor: help;
    }
</style>
@endpush

@section('content')
<div class="content-section">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>User Permission</h1>
        <a href="{{ url('/manajemen/user-permission/create') }}" class="btn-tambah">
            <i class="bi bi-plus-circle me-2"></i>Tambah Permission
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
            <input type="text" class="search-box" placeholder="Cari controller atau action..." id="searchInput">
        </div>
    </div>

    {{-- Tabel --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Controller</th>
                    <th width="15%">Action</th>
                    <th width="40%">Info</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($permissions as $permission)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">
                        <span class="badge-controller">{{ $permission->controller }}</span>
                    </td>
                    <td class="text-center">
                        <span class="badge-action">{{ $permission->action }}</span>
                    </td>
                    <td>
                        @if($permission->info)
                          
                        <small>{{ Str::limit($permission->info, 50) }}</small>
                        @else
                            <span class="text-muted fst-italic">-</span>
                        @endif
                    </td>
                    <td class="text-center">
            
                      
                        <a href="{{ url('/manajemen/user-permission/' . $permission->id . '/edit') }}" 
                           class="btn btn-warning btn-sm" title="Edit">
                             <i class="bi bi-pencil-fill"></i>
                        </a>
                        
                    
                        <a href="#" class="btn btn-danger btn-sm" title="Hapus" 
                           onclick="event.preventDefault(); if(confirm('Hapus permission {{ $permission->controller }} - {{ $permission->action }}?')) document.getElementById('delete-form-{{ $permission->id }}').submit()">
                            <i class="bi bi-trash"></i>
                        </a>
                        
                    
                        <form id="delete-form-{{ $permission->id }}" 
                              action="{{ url('/manajemen/user-permission/' . $permission->id) }}" 
                              method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <i class="bi bi-shield-lock fs-1 d-block mb-3" style="color: #dee2e6;"></i>
                        <h5 style="color: #6c757d;">Belum ada data permission</h5>
                        <p style="color: #adb5bd;">Klik tombol "Tambah Permission" untuk menambah data</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Footer dengan Pagination --}}
    <div class="d-flex justify-content-between align-items-center mt-4">
        <span class="text-muted">
            Menampilkan {{ $permissions->firstItem() ?? 0 }} sampai {{ $permissions->lastItem() ?? 0 }} dari {{ $permissions->total() }} entri
        </span>
        <nav>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item {{ $permissions->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $permissions->previousPageUrl() }}">Sebelumnya</a>
                </li>
                @for($i = 1; $i <= $permissions->lastPage(); $i++)
                    <li class="page-item {{ $permissions->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $permissions->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item {{ $permissions->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $permissions->nextPageUrl() }}">Selanjutnya</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

@push('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    // Toggle Status Function
    function toggleStatus(id) {
        fetch('{{ url("/manajemen/user-permission/toggle") }}/' + id, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const toggle = document.getElementById('toggle-' + id);
                if (data.status) {
                    toggle.classList.add('active');
                } else {
                    toggle.classList.remove('active');
                }
            }
        });
    }

    // Search functionality
    document.getElementById('searchInput')?.addEventListener('keyup', function() {
        let searchValue = this.value.toLowerCase();
        let tableRows = document.querySelectorAll('tbody tr');
        
        tableRows.forEach(row => {
            let controller = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
            let action = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || '';
            let info = row.querySelector('td:nth-child(4)')?.textContent.toLowerCase() || '';
            
            row.style.display = (controller.includes(searchValue) || 
                                 action.includes(searchValue) || 
                                 info.includes(searchValue)) ? '' : 'none';
        });
    });

    // Entries per page
    document.getElementById('entriesPerPage')?.addEventListener('change', function() {
        let perPage = this.value;
        window.location.href = '{{ url("/manajemen/user-permission") }}?per_page=' + perPage;
    });
</script>
@endpush
@endsection