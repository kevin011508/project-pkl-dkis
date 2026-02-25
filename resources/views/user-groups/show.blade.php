@extends('manajemen.app')

@section('title', 'Detail User Group')

@section('content')
<div class="container py-4">

    <!-- Header + Card dalam satu grid agar sejajar -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">

            <!-- Page Header -->
            <div class="mb-4">
                <h2 class="fw-bold text-dark mb-0">Detail User Group</h2>
            </div>

            <!-- Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    
                    <!-- Nama Group -->
                    <div class="mb-4 pb-4 border-bottom">
                        <label class="form-label text-muted small mb-2">Nama Group</label>
                        <h4 class="fw-semibold text-dark mb-0">
                            {{ $group->nama }}
                        </h4>
                    </div>
                    
                    <!-- Detail -->
                    <div class="row">
                        
                        <!-- Left -->
                        <div class="col-md-6">
                            
                            <div class="mb-4">
                                <label class="form-label text-muted small">Deskripsi</label>
                                <p class="text-dark mb-0">
                                    {{ $group->deskripsi ?: '-' }}
                                </p>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label text-muted small">Jumlah Member</label>
                                <p class="text-dark mb-0">
                                    {{ $group->member_count ?? 0 }}
                                </p>
                            </div>
                            
                        </div>
                        
                        <!-- Right -->
                        <div class="col-md-6">
                            
                            <div class="mb-4">
                                <label class="form-label text-muted small">Status</label>
                                <div>
                                    @if($group->status == 'Active')
                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2 rounded-pill">
                                            Inactive
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label text-muted small">Tanggal Dibuat</label>
                                <p class="text-dark mb-0">
                                    {{ \Carbon\Carbon::parse($group->created_at)->format('Y-m-d H:i:s') }}
                                </p>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label text-muted small">Terakhir Update</label>
                                <p class="text-dark mb-0">
                                    {{ \Carbon\Carbon::parse($group->updated_at)->format('Y-m-d H:i:s') }}
                                </p>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            
            <!-- Tombol hanya Kembali -->
            <div class="mt-4">
                <a href="{{ route('manajemen.user-groups.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

        </div>
    </div>

</div>
@endsection