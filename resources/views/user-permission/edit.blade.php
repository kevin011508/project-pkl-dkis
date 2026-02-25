{{-- resources/views/user-permission/edit.blade.php --}}
@extends('manajemen.app')

@section('title', 'Edit User Permission')

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
        border-left: 4px solid #17a2b8;
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
            <h1 class="mb-1">Edit User Permission</h1>
            <p class="text-muted mb-0">
                Mengedit permission: <strong>{{ $permission->controller }} - {{ $permission->action }}</strong>
            </p>
        </div>
    </div>

    <form action="{{ url('/manajemen/user-permission/' . $permission->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Controller <span class="text-danger">*</span></label>
                            <select class="form-select @error('controller') is-invalid @enderror" name="controller">
                                @foreach($controllers as $controller)
                                    <option value="{{ $controller }}" {{ old('controller', $permission->controller) == $controller ? 'selected' : '' }}>
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
                                @foreach($actions as $action)
                                    <option value="{{ $action }}" {{ old('action', $permission->action) == $action ? 'selected' : '' }}>
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
                              name="info" rows="3">{{ old('info', $permission->info) }}</textarea>
                    @error('info')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Status</label>
                    <div class="d-flex gap-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="1" 
                                   {{ old('status', $permission->status) ? 'checked' : '' }}>
                            <label class="form-check-label">Aktif</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="0"
                                   {{ old('status', $permission->status) ? '' : 'checked' }}>
                            <label class="form-check-label">Non Aktif</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-card">
                    <h6 class="fw-semibold mb-3">
                        <i class="bi bi-info-circle text-info me-2"></i>
                        Informasi
                    </h6>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="text-muted">ID</td>
                            <td class="fw-semibold">#{{ $permission->id }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Dibuat</td>
                            <td>{{ $permission->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Diupdate</td>
                            <td>{{ $permission->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Status Saat Ini</td>
                            <td>
                                @if($permission->status)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Non Aktif</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <hr class="my-4">

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ url('/manajemen/user-permission') }}" class="btn btn-batal">
                <i class="bi bi-x-circle me-2"></i>Batal
            </a>
            <button type="submit" class="btn btn-update">
                <i class="bi bi-check-circle me-2"></i>Update
            </button>
        </div>
    </form>
</div>
@endsection