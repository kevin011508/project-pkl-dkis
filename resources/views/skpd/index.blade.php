    @extends('manajemen.app')

    @section('title', 'SKPD')
    @section('page_title', 'Data SKPD')

    @section('content')
    <style>
        .filter-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .filter-box {
            display: flex;
            align-items: center;
        }
        
        .btn-kanan {
            margin-left: auto;
        }
        
        .btn-tambah {
            background-color: #007bff;  
            border: 2px solid #007bff;  
            color: #ffffff;             
            padding: 10px 25px;
            font-size: 16px;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        
        .btn-tambah i {
            margin-right: 8px;
            font-size: 16px;
            color: #ffffff;             
        }
        
        .btn-tambah:hover {
            background-color: #007bff;    
            color: #ffffff;               
            border-color: #007bff;
            text-decoration: none;
        }
        
        .btn-tambah:hover i {
            color: #ffffff;               
        }
        
        .btn-tambah-outline {
            background-color: #ffffff;
            border: 1px solid #ced4da;    
            color: #495057;               
            padding: 10px 25px;
            font-size: 16px;
            border-radius: 6px;
            font-weight: 500;
        }
        
        .btn-tambah-outline:hover {
            background-color: #e9ecef;    
            border-color: #adb5bd;
        }
    </style>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">SKPD</h3>
        </div>
        <div class="card-body">
            <div class="filter-row">
                <div class="filter-box">
                    <form method="GET" action="{{ route('manajemen.skpd.index') }}" class="d-flex align-items-center">
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
                
                <div class="btn-kanan">
                     <a href="{{ url('/manajemen/user-skpd/create') }}" class="btn-tambah">
            <i class="bi bi-plus-circle me-2"></i>Tambahkan
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
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($skpd as $index => $item)
                        <tr>
                            <td>{{ $skpd->firstItem() + $index }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->alias ?? '-' }}</td>
                            <td>
                                <a href="{{ route('manajemen.skpd.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('manajemen.skpd.destroy', $item->id) }}" method="POST" class="d-inline">
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
                            <td colspan="4" class="text-center">Tidak ada data SKPD</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    Menampilkan {{ $skpd->firstItem() ?? 0 }} - {{ $skpd->lastItem() ?? 0 }} dari {{ $skpd->total() }} entri
                </div>
                <div>
                    {{ $skpd->links() }}
                </div>
            </div>
        </div>
    </div>
    @endsection