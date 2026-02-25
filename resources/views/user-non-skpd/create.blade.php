{{-- resources/views/user-non-skpd/create.blade.php --}}
@extends('manajemen.app')

@section('title', 'Tambah User Non SKPD')

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
        transition: all 0.3s;
    }
    .btn-simpan:hover {
        background-color: #0b5ed7;
    }
    .btn-batal {
        background-color: #6c757d;
        color: white;
        padding: 10px 30px;
        border-radius: 8px;
        border: none;
        font-weight: 500;
        transition: all 0.3s;
    }
    .btn-batal:hover {
        background-color: #5a6268;
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
        <h1 class="mb-0">Tambah User Non SKPD</h1>
    </div>

    <form action="{{ url('/manajemen/user-non-skpd') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" 
                           name="username" value="{{ old('username') }}" placeholder="Masukkan username">
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Contoh: kel_kecapi, pkmkesunean</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">User Group <span class="text-danger">*</span></label>
                    <select class="form-select @error('user_group') is-invalid @enderror" name="user_group">
                        <option value="">-- Pilih Group --</option>
                        @foreach($userGroups as $group)
                            <option value="{{ $group }}" {{ old('user_group') == $group ? 'selected' : '' }}>
                                {{ $group }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_group')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Non SKPD <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('non_skpd') is-invalid @enderror" 
                           name="non_skpd" value="{{ old('non_skpd') }}" placeholder="Masukkan nama instansi">
                    @error('non_skpd')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Contoh: Kelurahan Kecapi, Puskesmas Kesunean</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">PIN <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('pin') is-invalid @enderror" 
                           name="pin" value="{{ old('pin') }}" placeholder="Masukkan PIN">
                    @error('pin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

       

        <hr class="my-4">

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ url('/manajemen/user-non-skpd') }}" class="btn btn-batal">
                <i class="bi bi-x-circle me-2"></i>Batal
            </a>
            <button type="submit" class="btn btn-simpan">
                <i class="bi bi-check-circle me-2"></i>Simpan
            </button>
        </div>
    </form>
</div>
@endsection