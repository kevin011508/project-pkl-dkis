@extends('manajemen.app')

@section('title', 'Pengaturan')

@push('styles')
<style>
  .page-title {
    font-size: 1.45rem;
    font-weight: 700;
    color: #222;
    margin-bottom: 24px;
  }

  .card {
    background: #fff;
    border-radius: 6px;
    border: 1px solid #ddd;
    overflow: hidden;
    max-width: 760px;
  }

  .card-body { padding: 24px 24px 0; }

  .form-group { margin-bottom: 20px; }

  .form-label {
    display: block;
    font-size: 0.83rem;
    font-weight: 600;
    color: #777;
    margin-bottom: 7px;
  }

  .form-control {
    width: 100%;
    padding: 9px 13px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-family: inherit;
    font-size: 0.9rem;
    color: #333;
    background: #fff;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
  }

  .form-control:focus {
    border-color: #5c6bc0;
    box-shadow: 0 0 0 3px rgba(92,107,192,0.12);
  }

  .card-footer {
    background: #f5f5f5;
    border-top: 1px solid #ddd;
    padding: 14px 24px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
  }

  .btn-simpan {
    padding: 8px 22px;
    background: #5c6bc0;
    color: #fff;
    border: none;
    border-radius: 4px;
    font-family: inherit;
    font-size: 0.88rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.15s;
  }

  .btn-simpan:hover { background: #3949ab; }

  /* Alert sukses dari session */
  .alert-success {
    background: #e8f5e9;
    border: 1px solid #a5d6a7;
    color: #2e7d32;
    padding: 10px 16px;
    border-radius: 4px;
    margin-bottom: 18px;
    font-size: 0.88rem;
  }
</style>
@endpush

@section('content')

  <h1 class="page-title">Edit Pengaturan</h1>

  {{-- Alert sukses setelah simpan --}}
  @if(session('success'))
    <div class="alert-success">
      <i class="fa fa-check-circle"></i> {{ session('success') }}
    </div>
  @endif

  <div class="card">
    <form action="{{ route('manajemen.pengaturan.update') }}" method="POST">
      @csrf
      @method('PUT')

      <div class="card-body">

        <div class="form-group">
          <label class="form-label" for="nama_web">Nama Web</label>
          <input
            type="text"
            id="nama_web"
            name="nama_web"
            class="form-control @error('nama_web') is-invalid @enderror"
            value="{{ old('nama_web', $pengaturan->nama_web ?? '') }}"
            placeholder="Masukkan nama web..."
          />
          @error('nama_web')
            <small style="color: #e53935; font-size: 0.8rem; margin-top: 4px; display: block;">
              {{ $message }}
            </small>
          @enderror
        </div>

        {{-- Tambahkan field lain di sini bila perlu --}}

      </div>

      <div class="card-footer">
        <button type="submit" class="btn-simpan">
          <i class="fa fa-save"></i> Simpan
        </button>
      </div>

    </form>
  </div>

@endsection