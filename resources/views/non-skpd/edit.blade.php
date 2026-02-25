<!-- resources/views/manajemen/non-skpd/edit.blade.php -->
@extends('manajemen.app')

@section('title', 'Edit Non SKPD')
@section('page_title', 'Edit Non SKPD')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Edit Non SKPD</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('manajemen.non-skpd.update', $nonSkpd->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group mb-3">
                <label for="nama">Nama <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control @error('nama') is-invalid @enderror" 
                       id="nama" 
                       name="nama" 
                       value="{{ old('nama', $nonSkpd->nama) }}" 
                       placeholder="Masukkan nama"
                       required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group mb-3">
                <label for="alias">Alias</label>
                <input type="text" 
                       class="form-control @error('alias') is-invalid @enderror" 
                       id="alias" 
                       name="alias" 
                       value="{{ old('alias', $nonSkpd->alias) }}" 
                       placeholder="Masukkan alias">
                @error('alias')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <a href="{{ route('manajemen.non-skpd.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection