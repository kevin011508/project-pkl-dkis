@extends('manajemen.app')

@section('title', 'Tambah User Permission - ISUN')

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

    .btn-simpan {
        background-color: var(--secondary-color);
        color: white;
        border: none;
        padding: 8px 24px;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-simpan:hover { background-color: #3a5fd9; color: white; }

    .btn-kembali {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 8px 24px;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-kembali:hover { background-color: #5a6268; color: white; }
</style>
@endpush

@section('content')
    <h4 class="page-title">Tambah User Permission</h4>

    <div class="form-container">
        <form action="{{ url('manajemen/user-permission') }}" method="POST">
            @csrf

            <div class="form-body">

                {{-- Controller --}}
                <div class="form-group">
                    <label class="form-label" for="controller">Controller <span class="text-danger">*</span></label>
                    <input type="text"
                           class="form-control @error('controller') is-invalid @enderror"
                           id="controller"
                           name="controller"
                           value="{{ old('controller') }}"
                           placeholder="Cari controller atau action...">
                    @error('controller')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Action --}}
                <div class="form-group">
                    <label class="form-label" for="action">Action <span class="text-danger">*</span></label>
                    <input type="text"
                           class="form-control @error('action') is-invalid @enderror"
                           id="action"
                           name="action"
                           value="{{ old('action') }}"
                           placeholder="Masukkan action">
                    @error('action')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Info --}}
                <div class="form-group">
                    <label class="form-label" for="info">Info</label>
                    <input type="text"
                           class="form-control @error('info') is-invalid @enderror"
                           id="info"
                           name="info"
                           value="{{ old('info') }}"
                           placeholder="Masukkan info">
                    @error('info')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- Footer --}}
            <div class="form-footer">
                <a href="{{ url('manajemen/user-permission') }}" class="btn btn-kembali">Kembali</a>
                <button type="submit" class="btn btn-simpan">Simpan</button>
            </div>

        </form>
    </div>
@endsection