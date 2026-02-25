{{-- resources/views/user-skpd/edit.blade.php --}}
@extends('manajemen.app')

@section('title', 'Edit User SKPD')

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
    .info-card {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        border-left: 4px solid #0d6efd;
    }
</style>
@endpush

@section('content')
<div class="content-section">

            <h1 class="mb-1">User SKPD</h1>

<form action="{{ url('/manajemen/user-skpd') }}" method="POST">
            @csrf

        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" 
                           name="username" value="{{ old('username') }}">
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">User Group <span class="text-danger">*</span></label>
                    <select class="form-select @error('user_group') is-invalid @enderror" name="user_group">
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

                <div class="mb-3">
                    <label class="form-label">SKPD <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('skpd') is-invalid @enderror" 
                              name="skpd" rows="3">{{ old('skpd') }}</textarea>
                    @error('skpd')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

             
            </div>

            

        <hr class="my-4">

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ url('/manajemen/user-skpd') }}" class="btn btn-batal">
                <i class="bi bi-x-circle me-2"></i>Batal
            </a>
            <button type="submit" class="btn btn-update">
                <i class="bi bi-check-circle me-2"></i>Tambah
            </button>
        </div>
    </form>
</div>
@endsection