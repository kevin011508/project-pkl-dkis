@extends('manajemen.app')

@section('title', 'Edit SKPD')
@section('page_title', 'Edit SKPD')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Edit SKPD</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('manajemen.skpd.update', $skpd->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="uraian">Nama SKPD <span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control @error('uraian') is-invalid @enderror"
                       id="uraian"
                       name="uraian"  {{-- ✅ ganti nama -> uraian --}}
                       value="{{ old('uraian', $skpd->uraian) }}"  {{-- ✅ ganti nama -> uraian --}}
                       placeholder="Masukkan nama SKPD"
                       required>
                @error('uraian')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="alias">Alias</label>
                <input type="text"
                       class="form-control @error('alias') is-invalid @enderror"
                       id="alias"
                       name="alias"
                       value="{{ old('alias', $skpd->alias) }}"
                       placeholder="Masukkan alias (contoh: KEC.KJS)">
                @error('alias')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Singkatan atau kode SKPD</small>
            </div>

            <div class="form-group">
                <a href="{{ route('manajemen.skpd.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection