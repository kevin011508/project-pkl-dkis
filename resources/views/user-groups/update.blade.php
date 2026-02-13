{{-- user-groups/update.blade.php --}}
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
    .form-label {
        font-weight: 500;
        color: #495057;
    }
    .btn-update {
        background-color: #0d6efd;
        color: white;
        padding: 8px 30px;
        border-radius: 6px;
        border: none;
        font-weight: 500;
    }
    .btn-batal {
        background-color: #6c757d;
        color: white;
        padding: 8px 30px;
        border-radius: 6px;
        border: none;
        font-weight: 500;
    }
    .page-title {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 15px;
        margin-bottom: 25px;
    }
</style>
@endpush

@section('content')
<div class="content-section">
    <div class="page-title">
        <h1>Edit User Group</h1>
    </div>

    <form action="{{ url('/manajemen/user-groups/' . $group['id']) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nama Group <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                           name="nama" value="{{ old('nama', $group['nama']) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <option value="Active" {{ $group['status'] == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ $group['status'] == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" rows="4">{{ old('deskripsi', $group['deskripsi']) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah Member</label>
            <input type="number" class="form-control" name="member_count" value="{{ old('member_count', $group['member_count']) }}" min="0">
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Dibuat</label>
            <input type="text" class="form-control" value="{{ $group['created_at'] }}" readonly disabled>
        </div>

        <hr class="my-4">

        <div class="text-end">
            <a href="{{ url('/manajemen/user-groups') }}" class="btn-batal me-2">
                <i class="bi bi-x-circle"></i> Batal
            </a>
            <button type="submit" class="btn-update">
                <i class="bi bi-check-circle"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection