{{-- resources/views/user-permission/edit.blade.php --}}
@extends('manajemen.app')

@section('title', 'Edit User Permission - ISUN')

@push('styles')
<style>
    .form-container {
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        overflow: hidden;
    }

    .form-body {
        padding: 30px;
    }

    .form-footer {
        padding: 15px 30px;
        background-color: #f8f9fa;
        border-top: 1px solid #dee2e6;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 6px;
    }

    .form-control, .form-select {
        border-radius: 6px;
        border: 1px solid #ced4da;
        padding: 10px 14px;
        font-size: 0.95rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }

    .btn-update {
        background-color: var(--secondary-color);
        color: white;
        border: none;
        padding: 8px 24px;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-update:hover { 
        background-color: #3a5fd9; 
        color: white; 
    }

    .btn-batal {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 8px 24px;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-batal:hover { 
        background-color: #5a6268; 
        color: white; 
    }

    .info-card {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        margin-top: 8px;
    }

    .info-card table {
        margin-bottom: 0;
    }

    .info-card td {
        padding: 8px 0;
        border: none;
    }

    .badge {
        padding: 6px 12px;
        font-weight: 500;
        border-radius: 6px;
    }

    .badge.bg-success {
        background-color: #28a745 !important;
    }

    .badge.bg-danger {
        background-color: #dc3545 !important;
    }

    .radio-group {
        display: flex;
        gap: 20px;
        background-color: #f8f9fa;
        padding: 12px 16px;
        border-radius: 6px;
        border: 1px solid #ced4da;
    }

    .form-check {
        display: flex;
        align-items: center;
        gap: 6px;
        margin: 0;
    }

    .form-check-input {
        margin: 0;
        width: 16px;
        height: 16px;
        cursor: pointer;
    }

    .form-check-label {
        color: #495057;
        cursor: pointer;
        font-weight: 400;
    }

    .permission-info {
        color: #6c757d;
        font-size: 0.95rem;
        margin-top: -10px;
        margin-bottom: 25px;
    }

    /* Style untuk readonly field */
    .form-control[readonly] {
        background-color: #e9ecef;
        opacity: 1;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h4 class="page-title">Edit User Permission</h4>
    

    <div class="form-container">
        <form action="{{ url('/manajemen/user-permission/' . $permission->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-body">
                {{-- Controller --}}
                <div class="form-group">
                    <label class="form-label" for="controller">Controller <span class="text-danger">*</span></label>
                    <input type="text"
                           class="form-control @error('controller') is-invalid @enderror"
                           id="controller"
                           name="controller"
                           value="{{ old('controller', $permission->controller) }}"
                           placeholder="Masukkan nama controller"
                           {{-- Tambahkan readonly jika ingin tidak bisa diedit --}}
                           {{-- readonly --}}>
                    @error('controller')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Contoh: UserController, HomeController, dll.</small>
                </div>

                {{-- Action --}}
                <div class="form-group">
                    <label class="form-label" for="action">Action <span class="text-danger">*</span></label>
                    <input type="text"
                           class="form-control @error('action') is-invalid @enderror"
                           id="action"
                           name="action"
                           value="{{ old('action', $permission->action) }}"
                           placeholder="Masukkan nama action"
                           {{-- Tambahkan readonly jika ingin tidak bisa diedit --}}
                           {{-- readonly --}}>
                    @error('action')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Contoh: index, create, store, edit, update, delete</small>
                </div>

                {{-- Info --}}
                <div class="form-group">
                    <label class="form-label" for="info">Info</label>
                    <input type="text"
                           class="form-control @error('info') is-invalid @enderror"
                           id="info"
                           name="info"
                           value="{{ old('info', $permission->info) }}"
                           placeholder="Masukkan info">
                    @error('info')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Footer --}}
            <div class="form-footer">
                <a href="{{ url('/manajemen/user-permission') }}" class="btn btn-batal">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
                <button type="submit" class="btn btn-update">
                    <i class="bi bi-check-circle me-2"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection