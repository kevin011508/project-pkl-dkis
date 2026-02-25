{{-- resources/views/user-permission/create.blade.php --}}
@extends('manajemen.app')

@section('title', 'Tambah User Permission')

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
    .btn-simpan {
        background-color: #0d6efd;
        color: white;
        padding: 10px 30px;
        border-radius: 8px;
        border: none;
        font-weight: 500;
    }
    .btn-batal {
        background-color: #6c757d;
        color: white;
        padding: 10px 30px;
        border-radius: 8px;
        border: none;
        font-weight: 500;
    }
</style>
@endpush

@section('content')
<div class="content-section">
    <div class="d-flex align-items-center mb-4">
        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
             style="width: 45px; height: 45px;">
            <i class="bi bi-plus-circle text-white fs-5"></i>
        </div>
        <h1 class="mb-0">Tambah User Permission</h1>
    </div>

    <form action="{{ url('/manajemen/user-permission') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Controller <span class="text-danger">*</span></label>
                    <select class="form-select @error('controller') is-invalid @enderror" name="controller">
                        <option value="">-- Pilih Controller --</option>
                        @foreach($controllers as $controller)
                            <option value="{{ $controller }}" {{ old('controller') == $controller ? 'selected' : '' }}>
                                {{ $controller }}
                            </option>
                        @endforeach
                    </select>
                    @error('controller')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Action <span class="text-danger">*</span></label>
                    <select class="form-select @error('action') is-invalid @enderror" name="action">
                        <option value="">-- Pilih Action --</option>
                        @foreach($actions as $action)
                            <option value="{{ $action }}" {{ old('action') == $action ? 'selected' : '' }}>
                                {{ $action }}
                            </option>
                        @endforeach
                    </select>
                    @error('action')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Info</label>
            <textarea class="form-control @error('info') is-invalid @enderror" 
                      name="info" rows="3" placeholder="Masukkan informasi tambahan">{{ old('info') }}</textarea>
            @error('info')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="text-muted">Opsional, bisa diisi deskripsi permission</small>
        </div>

       

        <hr class="my-4">

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ url('/manajemen/user-permission') }}" class="btn btn-batal">
                <i class="bi bi-x-circle me-2"></i>Batal
            </a>
            <button type="submit" class="btn btn-simpan">
                <i class="bi bi-check-circle me-2"></i>Simpan
            </button>
        </div>
    </form>
</div>
@endsection