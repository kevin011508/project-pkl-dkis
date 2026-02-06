@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="w-100" style="max-width: 450px;">
        <div class="text-center mb-4">
            <h4 class="fw-bold text-primary">Rekap Agenda</h4>
            <p class="text-muted">Pilih periode untuk melihat rekap</p>
        </div>
        
        <div class="card shadow-lg border-0">
            <div class="card-body p-4">
                <form action="{{ route('rekap') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tahun</label>
                        <select name="tahun" class="form-select">
                            @for ($i = date('Y') - 5; $i <= date('Y') + 5; $i++)
                                <option value="{{ $i }}" {{ ($tahun ?? date('Y')) == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>    
                            @endfor
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Bulan</label>
                        <select name="bulan" class="form-select">
                            @php 
                                $bulanList = [
                                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                ];
                            @endphp
                            @foreach ($bulanList as $index => $namaBulan)
                                <option value="{{ $index + 1 }}"
                                    {{ ($bulan ?? date('n')) == $index + 1 ? 'selected' : '' }}>
                                    {{ $namaBulan }}
                                </option>    
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-search me-2"></i>Lihat Rekap
                        </button>
                        <a href="{{ url()->previous() ?: route('dashboard') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-x-circle me-2"></i>Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Info kecil di bawah -->
        <div class="text-center mt-4">
            <small class="text-muted">
                <i class="bi bi-info-circle me-1"></i>
                Data akan ditampilkan berdasarkan filter yang dipilih
            </small>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    
    .form-select {
        border-radius: 10px;
        padding: 10px 15px;
    }
    
    .btn {
        border-radius: 10px;
        padding: 10px 25px;
    }
</style>
@endsection