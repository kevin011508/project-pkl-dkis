{{-- user-groups/index.blade.php --}}
@extends('manajemen.app')

@section('title', 'User Groups')

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
    .action-icons i {
        margin: 0 5px;
        color: #6c757d;
        cursor: pointer;
        font-size: 16px;
        transition: color 0.3s;
    }
    .action-icons i:hover {
        color: #0d6efd;
    }
    .table th {
        border-bottom-width: 1px;
        font-weight: 600;
        color: #495057;
        background-color: #f8f9fa;
    }
    .entries-selector {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }
    .entries-selector select {
        width: auto;
        display: inline-block;
    }
    .footer-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        color: #6c757d;
    }
    .url-bar {
        margin-top: 30px;
        padding: 15px;
        background-color: #e9ecef;
        border-radius: 8px;
        font-family: monospace;
        color: #495057;
    }
    .main-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
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
    .btn-action {
        padding: 5px 10px;
        margin: 0 2px;
        border-radius: 4px;
    }
    .pagination-info {
        color: #6c757d;
    }
    .search-box {
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 8px 15px;
        width: 250px;
    }
    .filter-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
</style>
@endpush

@section('content')
<div class="content-section">
    <div class="main-title">
        <h1>User Groups</h1>
        <a href="{{ url('/manajemen/user-groups/create') }}" class="btn-tambah">
            <i></i> Tambah
        </a>
    </div>
    

    <!-- Filter & Search -->
    <div class="filter-section">
        <div class="entries-selector">
            <span>Tampilan</span>
            <select class="form-select form-select-sm" style="width: auto;" id="entriesPerPage">
                <option selected>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
            <span>entri</span>
        </div>
        <div>
            <input type="text" class="search-box" placeholder="Cari..." id="searchInput">
        </div>
    </div>



{{-- Tabel --}}
<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th width="10%">No</th>
            <th width="60%">Nama</th>
            <th width="30%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Admin Setda</td>
      <td class="text-center align-middle">
    <button type="button" class="btn p-0 border-0 bg-transparent" onclick="location.href='{{ url('/manajemen/user-groups/1') }}'">
        <span class="badge bg-primary me-1 p-2">
            <i class="bi bi-eye text-white"></i>
        </span>
    </button>
    
    <button type="button" class="btn p-0 border-0 bg-transparent" onclick="location.href='{{ url('/manajemen/user-groups/1/edit') }}'">
        <span class="badge bg-warning me-1 p-2">
            <i class="bi bi-pencil text-white"></i>
        </span>
    </button>
    
    <button type="button" class="btn p-0 border-0 bg-transparent" onclick="if(confirm('Hapus data?')) document.getElementById('delete-form-1').submit()">
        <span class="badge bg-danger p-2">
            <i class="bi bi-trash text-white"></i>
        </span>
    </button>
    
    <form id="delete-form-1" action="{{ url('/manajemen/user-groups.index.blade.php') }}" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>
</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Administrator</td>
           <td class="text-center align-middle">
    <button type="button" class="btn p-0 border-0 bg-transparent" onclick="location.href='{{ url('/manajemen/user-groups/1') }}'">
        <span class="badge bg-primary me-1 p-2">
            <i class="bi bi-eye text-white"></i>
        </span>
    </button>
    
    <button type="button" class="btn p-0 border-0 bg-transparent" onclick="location.href='{{ url('/manajemen/user-groups/1/edit') }}'">
        <span class="badge bg-warning me-1 p-2">
            <i class="bi bi-pencil text-white"></i>
        </span>
    </button>
    
    <button type="button" class="btn p-0 border-0 bg-transparent" onclick="if(confirm('Hapus data?')) document.getElementById('delete-form-1').submit()">
        <span class="badge bg-danger p-2">
            <i class="bi bi-trash text-white"></i>
        </span>
    </button>
    
    <form id="delete-form-1" action="{{ url('/manajemen/user-groups.index.blade.php') }}" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>
</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Operator</td>
  <td class="text-center align-middle">
    <button type="button" class="btn p-0 border-0 bg-transparent" onclick="location.href='{{ url('/manajemen/user-groups/1') }}'">
        <span class="badge bg-primary me-1 p-2">
            <i class="bi bi-eye text-white"></i>
        </span>
    </button>
    
    <button type="button" class="btn p-0 border-0 bg-transparent" onclick="location.href='{{ url('/manajemen/user-groups/1/edit') }}'">
        <span class="badge bg-warning me-1 p-2">
            <i class="bi bi-pencil text-white"></i>
        </span>
    </button>
    
    <button type="button" class="btn p-0 border-0 bg-transparent" onclick="if(confirm('Hapus data?')) document.getElementById('delete-form-1').submit()">
        <span class="badge bg-danger p-2">
            <i class="bi bi-trash text-white"></i>
        </span>
    </button>
    
    <form id="delete-form-1" action="{{ url('/manajemen/user-groups.index.blade.php') }}" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>
</td>
        </tr>
    </tbody>
</table>

{{-- Footer Info --}}
<div class="d-flex justify-content-between align-items-center mt-3">
    <span>Menampilkan 1 sampai 3 dari 3 entri</span>
    
    {{-- Pagination --}}
    <nav>
        <ul class="pagination pagination-sm mb-0">
            <li class="page-item disabled">
                <span class="page-link">Sebelumnya</span>
            </li>
            <li class="page-item active">
                <span class="page-link">1</span>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">Selanjutnya</a>
            </li>
        </ul>
    </nav>
</div>

  
@endsection

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput')?.addEventListener('keyup', function() {
        let searchValue = this.value.toLowerCase();
        let tableRows = document.querySelectorAll('tbody tr');
        
        tableRows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });

    // Entries per page
    document.getElementById('entriesPerPage')?.addEventListener('change', function() {
        // Implementasi pagination
        console.log('Show entries:', this.value);
    });
</script>
@endpush