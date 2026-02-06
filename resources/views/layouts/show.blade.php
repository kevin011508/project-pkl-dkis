@extends('layouts.app')

@section('title', 'Lihat Agenda')

@section('content')
<div class="container py-4">
    
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold text-dark mb-0">Lihat Agenda</h2>
        </div>
    </div>
    
    <!-- Main Card -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    
                    <!-- Agenda Name - Highlighted -->
                    <div class="mb-4 pb-4 border-bottom">
                        <label class="form-label text-muted small mb-2">Nama Agenda</label>
                        <h4 class="fw-semibold text-dark mb-0">{{ $agenda->nama_agenda }}</h4>
                    </div>
                    
                    <!-- Details in Two Columns -->
                    <div class="row g-4">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <!-- Uraian -->
                            <div class="mb-4">
                                <label class="form-label text-muted small mb-2">Uraian</label>
                                <p class="text-dark mb-0">{{ $agenda->uraian ?: '-' }}</p>
                            </div>
                            
                            <!-- Penyelenggara -->
                            <div class="mb-4">
                                <label class="form-label text-muted small mb-2">Penyelenggara</label>
                                <p class="text-dark mb-0">{{ $agenda->penyelenggara }}</p>
                            </div>
                            
                            <!-- Lokasi -->
                            <div class="mb-4">
                                <label class="form-label text-muted small mb-2">Lokasi</label>
                                <p class="text-dark mb-0">{{ $agenda->lokasi }}</p>
                            </div>
                            
                            <!-- Alamat -->
                            <div class="mb-4">
                                <label class="form-label text-muted small mb-2">Alamat</label>
                                <p class="text-dark mb-0">{{ $agenda->alamat }}</p>
                            </div>
                        </div>
                        
                        <!-- Right Column -->
                        <div class="col-md-6">
                            <!-- Disposisi -->
                            <div class="mb-4">
                                <label class="form-label text-muted small mb-2">Disposisi</label>
                                <p class="text-dark mb-0">{{ $agenda->disposisi }}</p>
                            </div>
                            
                            <!-- Seragam -->
                            <div class="mb-4">
                                <label class="form-label text-muted small mb-2">Seragam</label>
                                <p class="text-dark mb-0">{{ $agenda->seragam ?: '-' }}</p>
                            </div>
                            
                            <!-- Tanggal Awal -->
                            <div class="mb-4">
                                <label class="form-label text-muted small mb-2">Tanggal Awal</label>
                                <p class="text-dark mb-0">
                                    {{ \Carbon\Carbon::parse($agenda->tanggal_awal)->format('Y-m-d H:i:s') }}
                                </p>
                            </div>
                            
                            <!-- Tanggal Akhir -->
                            <div class="mb-4">
                                <label class="form-label text-muted small mb-2">Tanggal Akhir</label>
                                <p class="mb-0 {{ !$agenda->tanggal_akhir ? 'text-danger fw-semibold' : 'text-dark' }}">
                                    @if($agenda->tanggal_akhir)
                                        {{ \Carbon\Carbon::parse($agenda->tanggal_akhir)->format('Y-m-d H:i:s') }}
                                    @else
                                        SELESAI
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Berkas -->
                    <div class="mb-4">
                        <label class="form-label text-muted small mb-2">Berkas</label>
                        <div>
                            @if($agenda->berkas)
                                <a href="#" class="text-primary text-decoration-none">
                                    <i class="fas fa-file-pdf me-2"></i> {{ $agenda->berkas }}
                                </a>
                            @else
                                <span class="text-dark">-</span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Status Badge -->
                    <div class="pt-4 border-top">
                        <div class="d-flex align-items-center">
                            <span class="text-muted small me-3">Status:</span>
                            @if($agenda->status == 'completed')
                                <span class="badge bg-danger px-3 py-2 rounded-pill">
                                    SELESAI
                                </span>
                            @elseif($agenda->status == 'published')
                                <span class="badge bg-primary px-3 py-2 rounded-pill">
                                    BERJALAN
                                </span>
                            @else
                                <span class="badge bg-secondary px-3 py-2 rounded-pill">
                                    DRAFT
                                </span>
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="mt-4 d-flex flex-wrap gap-2 justify-content-center justify-content-md-start">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-home me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Print Styles -->
<style>
    @media print {
        .btn, .navbar, .sidebar {
            display: none !important;
        }
        .card {
            box-shadow: none !important;
            border: 1px solid #dee2e6 !important;
        }
    }
</style>
@endsection