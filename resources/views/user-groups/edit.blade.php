{{-- user-groups/edit.blade.php --}}
@extends('manajemen.app')

@section('title', 'Edit User Group')

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
    .form-label {
        font-weight: 500;
        color: #495057;
        font-size: 14px;
        margin-bottom: 6px;
    }
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 10px 14px;
        font-size: 14px;
        transition: all 0.3s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    }
    .btn-update {
        background-color: #0d6efd;
        color: white;
        border: none;
        padding: 10px 30px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
    }
    .btn-update:hover {
        background-color: #0b5ed7;
        color: white;
    }
    .btn-batal {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 10px 30px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
    }
    .btn-batal:hover {
        background-color: #5a6268;
        color: white;
    }
    .page-title {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 15px;
        margin-bottom: 25px;
    }
    .info-card {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        border-left: 4px solid #0d6efd;
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
    .required-field::after {
        content: "*";
        color: red;
        margin-left: 4px;
    }
    .icon-box {
        width: 45px;
        height: 45px;
        background-color: #ffc107;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .icon-box i {
        color: white;
        font-size: 20px;
    }
</style>
@endpush

@section('content')
<div class="content-section">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <div class="icon-box me-3">
                <i class="bi bi-pencil-fill"></i>
            </div>
            <div>
                <h1 class="mb-1">Edit User Group</h1>
                <p class="text-muted mb-0">Ubah informasi user group #{{ $group['id'] }}</p>
            </div>
        </div>
        <a href="{{ url('/manajemen/user-groups') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- Form Edit --}}
    <form action="{{ url('/manajemen/user-groups/' . $group['id']) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            {{-- Kolom Kiri --}}
            <div class="col-md-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-4 fw-semibold">
                            <i class="bi bi-info-circle text-primary me-2"></i>
                            Informasi Dasar
                        </h5>
                        
                        {{-- Nama Group --}}
                        <div class="mb-4">
                            <label for="nama" class="form-label required-field">
                                Nama Group
                            </label>
                            <input type="text" 
                                   class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" 
                                   name="nama" 
                                   value="{{ old('nama', $group['nama']) }}" 
                                   placeholder="Masukkan nama group"
                                   required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Nama group harus unik dan mudah diingat</small>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-4">
                            <label for="deskripsi" class="form-label">
                                Deskripsi
                            </label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="4" 
                                      placeholder="Masukkan deskripsi group">{{ old('deskripsi', $group['deskripsi']) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Jelaskan fungsi dan hak akses group ini</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan --}}
            <div class="col-md-4">
                {{-- Status Card --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-4 fw-semibold">
                            <i class="bi bi-toggle-on text-primary me-2"></i>
                            Status
                        </h5>
                        
                        <div class="mb-4">
                            <label for="status" class="form-label">Status Group</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status">
                                <option value="Active" {{ old('status', $group['status']) == 'Active' ? 'selected' : '' }}>
                                    <span class="badge bg-success">Active</span> - Group Aktif
                                </option>
                                <option value="Inactive" {{ old('status', $group['status']) == 'Inactive' ? 'selected' : '' }}>
                                    <span class="badge bg-danger">Inactive</span> - Group Tidak Aktif
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="member_count" class="form-label">
                                Jumlah Member
                            </label>
                            <input type="number" 
                                   class="form-control @error('member_count') is-invalid @enderror" 
                                   id="member_count" 
                                   name="member_count" 
                                   value="{{ old('member_count', $group['member_count']) }}" 
                                   min="0">
                            @error('member_count')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Info Card --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-4 fw-semibold">
                            <i class="bi bi-clock-history text-primary me-2"></i>
                            Informasi Sistem
                        </h5>
                        
                        <div class="info-card">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td width="40%"><small class="text-muted">ID Group</small></td>
                                    <td><strong>#{{ $group['id'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td><small class="text-muted">Dibuat Pada</small></td>
                                    <td>
                                        <strong>{{ \Carbon\Carbon::parse($group['created_at'])->format('d/m/Y H:i') }}</strong>
                                        <br>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($group['created_at'])->diffForHumans() }}</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small class="text-muted">Terakhir Update</small></td>
                                    <td>
                                        <strong>{{ now()->format('d/m/Y H:i') }}</strong>
                                        <br>
                                        <small class="text-muted">Sekarang</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small class="text-muted">Status Saat Ini</small></td>
                                    <td>
                                        @if($group['status'] == 'Active')
                                            <span class="badge-status badge-active">Active</span>
                                        @else
                                            <span class="badge-status badge-inactive">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Preview Card --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="card-title fw-semibold mb-0">
                        <i class="bi bi-eye text-primary me-2"></i>
                        Preview Perubahan
                    </h5>
                    <span class="badge bg-warning text-dark">Live Preview</span>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="10%">No</th>
                                <th width="40%">Nama Group</th>
                                <th width="30%">Deskripsi</th>
                                <th width="10%">Member</th>
                                <th width="10%">Status</th>
                            </tr>
                        </thead>
                        <tbody id="previewBody">
                            <tr>
                                <td class="text-center align-middle">1</td>
                                <td class="align-middle fw-bold" id="previewNama">{{ $group['nama'] }}</td>
                                <td class="align-middle" id="previewDeskripsi">{{ $group['deskripsi'] }}</td>
                                <td class="text-center align-middle">
                                    <span class="badge bg-secondary" id="previewMember">{{ $group['member_count'] }}</span>
                                </td>
                                <td class="text-center align-middle">
                                    <span id="previewStatus">
                                        @if($group['status'] == 'Active')
                                            <span class="badge-status badge-active">Active</span>
                                        @else
                                            <span class="badge-status badge-inactive">Inactive</span>
                                        @endif
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="d-flex justify-content-end gap-3">
            <a href="{{ url('/manajemen/user-groups') }}" class="btn btn-batal">
                <i class="bi bi-x-circle me-2"></i>Batal
            </a>
            <button type="submit" class="btn btn-update">
                <i class="bi bi-check-circle me-2"></i>Update Perubahan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Live Preview Update
    document.addEventListener('DOMContentLoaded', function() {
        const namaInput = document.getElementById('nama');
        const deskripsiInput = document.getElementById('deskripsi');
        const statusSelect = document.getElementById('status');
        const memberInput = document.getElementById('member_count');
        
        const previewNama = document.getElementById('previewNama');
        const previewDeskripsi = document.getElementById('previewDeskripsi');
        const previewMember = document.getElementById('previewMember');
        const previewStatus = document.getElementById('previewStatus');

        function updatePreview() {
            // Update Nama
            previewNama.textContent = namaInput.value || '{{ $group['nama'] }}';
            
            // Update Deskripsi
            let deskripsi = deskripsiInput.value || '{{ $group['deskripsi'] }}';
            previewDeskripsi.textContent = deskripsi.length > 30 ? deskripsi.substring(0, 30) + '...' : deskripsi;
            
            // Update Member
            previewMember.textContent = memberInput.value || '{{ $group['member_count'] }}';
            
            // Update Status
            const status = statusSelect.value;
            if (status === 'Active') {
                previewStatus.innerHTML = '<span class="badge-status badge-active">Active</span>';
            } else {
                previewStatus.innerHTML = '<span class="badge-status badge-inactive">Inactive</span>';
            }
        }

        namaInput.addEventListener('keyup', updatePreview);
        deskripsiInput.addEventListener('keyup', updatePreview);
        statusSelect.addEventListener('change', updatePreview);
        memberInput.addEventListener('keyup', updatePreview);
    });

    // Confirm before update
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!confirm('Apakah Anda yakin ingin menyimpan perubahan data ini?')) {
            e.preventDefault();
        }
    });
</script>
@endpush
@endsection