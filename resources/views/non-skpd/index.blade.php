<!-- resources/views/manajemen/non-skpd/index.blade.php -->
@extends('manajemen.app')

@section('title', 'Non SKPD')
@section('page_title', 'Non SKPD')

@section('content')
<style>
    .filter-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .filter-box {
        display: flex;
        align-items: center;
    }
    
    .btn-tambah {
        background-color: #007bff;
        border: none;
        color: #ffffff;
        padding: 8px 20px;
        font-size: 14px;
        border-radius: 4px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-tambah i {
        margin-right: 5px;
    }
    
    .btn-tambah:hover {
        background-color: #0056b3;
        color: #ffffff;
        text-decoration: none;
    }
    
    .pagination-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
    }
    
    .btn-action {
        padding: 3px 8px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
    
    .btn-action:hover {
        background-color: #218838;
    }
</style>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Non SKPD</h3>
    </div>
    <div class="card-body">
        <div class="filter-row">
            <div class="filter-box">
                <form method="GET" action="{{ route('manajemen.non-skpd.index') }}" class="d-flex align-items-center">
                    <label for="entries" class="me-2">Tampilkan</label>
                    <select name="entries" id="entries" class="form-control form-control-sm w-auto" onchange="this.form.submit()">
                        <option value="10" {{ $entries == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ $entries == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $entries == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $entries == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <span class="ms-2">entri</span>
                </form>
            </div>
            
            <div>
                <a href="{{ route('manajemen.non-skpd.create') }}" class="btn-tambah">
                    <i class="fas fa-plus"></i> Tambah
                </a>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama</th>
                        <th width="150">Alias</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($nonSkpd as $index => $item)
                    <tr>
                      <td>{{ $nonSkpd->firstItem() + $index }}</td>
<td>{{ $item->nama }}</td>
<td>{{ $item->alias ?? '-' }}</td>
<td>
    <a href="{{ route('manajemen.non-skpd.edit', $item->id) }}" class="btn btn-warning btn-sm">
        <i class="bi bi-pencil"></i>
    </a>
    <form action="{{ route('manajemen.non-skpd.destroy', $item->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
            <i class="bi bi-trash"></i>
        </button>
    </form>
</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data Non SKPD</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($nonSkpd->total() > 0)
        <div class="pagination-info">
            <div>
                Menampilkan {{ $nonSkpd->firstItem() }} sampai {{ $nonSkpd->lastItem() }} dari {{ $nonSkpd->total() }} entri
            </div>
            <div>
                @if ($nonSkpd->onFirstPage())
                    <span class="btn btn-secondary btn-sm disabled">Sebelumnya</span>
                @else
                    <a href="{{ $nonSkpd->previousPageUrl() }}" class="btn btn-primary btn-sm">Sebelumnya</a>
                @endif
                
                <span class="mx-2">{{ $nonSkpd->currentPage() }}</span>
                
                @if ($nonSkpd->hasMorePages())
                    <a href="{{ $nonSkpd->nextPageUrl() }}" class="btn btn-primary btn-sm">Selanjutnya</a>
                @else
                    <span class="btn btn-secondary btn-sm disabled">Selanjutnya</span>
                @endif
            </div>
        </div>
        @else
        <div class="text-center text-muted mt-3">
            Menampilkan 0 sampai 0 dari 0 entri
        </div>
        @endif
    </div>
</div>
@endsection