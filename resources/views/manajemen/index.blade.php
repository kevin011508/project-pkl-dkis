@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="dashboard-header">
        <div class="organization-name">
            {{ $organizationName }}
        </div>
        <div class="organization-subtitle">
            Sistem Informasi Agenda Terpadu
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $todayAgenda }}</div>
                <div class="stat-label">Agenda Hari Ini</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">{{ $monthAgenda }}</div>
                <div class="stat-label">Agenda Bulan Ini</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">{{ $yearAgenda }}</div>
                <div class="stat-label">Agenda Tahun Ini</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">{{ $totalAgenda }}</div>
                <div class="stat-label">Seluruh Agenda</div>
            </div>
        </div>
    </div>
    
    <!-- Additional Dashboard Content -->
    <div class="row">
        <div class="col-12">
            <div class="card" style="border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.08);">
                <div class="card-body">
                    <h5 class="card-title">Aktivitas Terbaru</h5>
                    <p class="text-muted">Riwayat agenda yang baru ditambahkan atau diubah</p>
                    <!-- Content akan ditambahkan -->
                </div>
            </div>
        </div>
    </div>
@endsection