@extends('manajemen.app')

@section('title', 'Tambah User Non SKPD - ISUN')

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

    .btn-simpan:hover {
        background-color: #3a5fd9;
        color: white;
    }

    .btn-kembali {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 8px 24px;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-kembali:hover {
        background-color: #5a6268;
        color: white;
    }
</style>
@endpush

@section('content')
    <h4 class="page-title">Tambah User Non SKPD</h4>

    <div class="form-container">
        <form action="{{ url('manajemen/user-non-skpd') }}" method="POST">
            @csrf

            <div class="form-body">

                {{-- Username --}}
                <div class="form-group">
                    <label class="form-label" for="username">Username <span class="text-danger">*</span></label>
                    <input type="text"
                           class="form-control @error('username') is-invalid @enderror"
                           id="username"
                           name="username"
                           value="{{ old('username') }}"
                           placeholder="Masukkan username">
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           id="password"
                           name="password"
                           placeholder="Masukkan password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- PIN --}}
                <div class="form-group">
                    <label class="form-label" for="pin">PIN <span class="text-danger">*</span></label>
                    <input type="number"
                           class="form-control @error('pin') is-invalid @enderror"
                           id="pin"
                           name="pin"
                           value="{{ old('pin') }}"
                           placeholder="Masukkan PIN">
                    @error('pin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- User Group --}}
                <div class="form-group">
                    <label class="form-label" for="user_group">User Group <span class="text-danger">*</span></label>
                    <select class="form-select @error('user_group') is-invalid @enderror"
                            id="user_group"
                            name="user_group">
                        <option value="" disabled selected>-- Pilih User Group --</option>
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

                {{-- Non SKPD --}}
                <div class="form-group">
                    <label class="form-label" for="non_skpd">Non SKPD <span class="text-danger">*</span></label>
                    <select class="form-select @error('non_skpd') is-invalid @enderror"
                            id="non_skpd"
                            name="non_skpd">
                        <option value="" disabled selected>-- Pilih Non SKPD --</option>
                        @foreach($nonSkpdList as $item)
                            <option value="{{ $item->id }}" {{ old('non_skpd') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('non_skpd')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Terkunci --}}
                <div class="form-group">
                    <label class="form-label">Terkunci <span class="text-danger">*</span></label>
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio"
                                   name="terkunci" id="terkunci_tidak"
                                   value="0" {{ old('terkunci', '0') == '0' ? 'checked' : '' }}>
                            <label class="form-check-label" for="terkunci_tidak">Tidak</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio"
                                   name="terkunci" id="terkunci_ya"
                                   value="1" {{ old('terkunci') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="terkunci_ya">Ya</label>
                        </div>
                    </div>
                    @error('terkunci')
                        <div class="text-danger" style="font-size:0.85rem">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- Footer --}}
            <div class="form-footer">
                <a href="{{ url('manajemen/user-non-skpd') }}" class="btn btn-kembali">
                    Kembali
                </a>
                <button type="submit" class="btn btn-simpan">
                    Simpan
                </button>
            </div>

        </form>
    </div>
@endsection