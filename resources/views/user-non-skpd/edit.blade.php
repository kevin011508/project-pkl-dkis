{{-- resources/views/user-non-skpd/edit.blade.php --}}
@extends('manajemen.app')

@section('title', 'Edit User Non SKPD')

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
        border-left: 4px solid #ffc107;
    }
</style>
@endpush

@section('content')
<div class="content-section">
    <div class="d-flex align-items-center mb-4">
        <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center me-3" 
             style="width: 45px; height: 45px;">
            <i class="bi bi-pencil-fill text-white fs-5"></i>
        </div>
        <div>
            <h1 class="mb-1">Edit User Non SKPD</h1>
            <p class="text-muted mb-0">Mengedit user: <strong>{{ $user->username }}</strong></p>
        </div>
    </div>

    <form action="{{ url('/manajemen/user-non-skpd/' . $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" 
                                   name="username" value="{{ old('username', $user->username) }}">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">User Group <span class="text-danger">*</span></label>
                            <select class="form-select @error('user_group') is-invalid @enderror" name="user_group">
                                @foreach($userGroups as $group)
                                    <option value="{{ $group }}" {{ old('user_group', $user->user_group) == $group ? 'selected' : '' }}>
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
                                   name="non_skpd" value="{{ old('non_skpd', $user->non_skpd) }}">
                            @error('non_skpd')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">PIN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('pin') is-invalid @enderror" 
                                   name="pin" value="{{ old('pin', $user->pin) }}">
                            @error('pin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Status</label>
                    <div class="d-flex gap-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="Active" 
                                   {{ old('status', $user->status) == 'Active' ? 'checked' : '' }}>
                            <label class="form-check-label">Active</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="Inactive"
                                   {{ old('status', $user->status) == 'Inactive' ? 'checked' : '' }}>
                            <label class="form-check-label">Inactive</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-card">
                    <h6 class="fw-semibold mb-3">
                        <i class="bi bi-info-circle text-warning me-2"></i>
                        Informasi
                    </h6>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="text-muted">ID</td>
                            <td class="fw-semibold">#{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Dibuat</td>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Diupdate</td>
                            <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">PIN Saat Ini</td>
                            <td><span class="badge bg-secondary">{{ $user->pin }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <hr class="my-4">

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ url('/manajemen/user-non-skpd') }}" class="btn btn-batal">
                <i class="bi bi-x-circle me-2"></i>Batal
            </a>
            <button type="submit" class="btn btn-update">
                <i class="bi bi-check-circle me-2"></i>Update
            </button>
        </div>
    </form>
</div>
@endsection