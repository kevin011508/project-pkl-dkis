@extends('manajemen.app')

@section('title', 'Dashboard - ISUN')

@push('styles')
<style>
    .dashboard-header {
        margin-bottom: 30px;
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 15px;
    }

    .stat-card {
        background-color: white;
        border-radius: var(--border-radius);
        padding: 25px 20px;
        margin-bottom: 25px;
        box-shadow: var(--box-shadow);
        transition: transform 0.3s, box-shadow 0.3s;
        border-top: 5px solid var(--secondary-color);
        text-align: center;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.091);
    }

    .stat-card:nth-child(2) { border-top-color: #2ecc71; }
    .stat-card:nth-child(3) { border-top-color: #e74c3c; }
    .stat-card:nth-child(4) { border-top-color: #f39c12; }

    .stat-number {
        font-size: 2.8rem;
        font-weight: bold;
        color: var(--primary-color);
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 1rem;
        color: #7f8c8d;
        font-weight: 500;
    }

    .stat-icon {
        font-size: 2.5rem;
        color: var(--secondary-color);
        margin-bottom: 15px;
    }

    .dashboard-title {
        color: var(--primary-color);
        font-weight: 600;
        margin-bottom: 20px;
    }
</style>
@endpush

@section('content')
    <div class="dashboard-header">
        <h1 class="dashboard-title">Dashboard</h1>
        <p class="text-muted">Ringkasan informasi agenda dan aktivitas</p>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-calendar-day"></i></div>
                <div class="stat-number">{{ $todayAgendas }}</div>
                <div class="stat-label">Agenda Hari Ini</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-calendar-week"></i></div>
                <div class="stat-number">{{ $monthAgendas }}</div>
                <div class="stat-label">Agenda Bulan Ini</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                <div class="stat-number">{{ $yearAgendas }}</div>
                <div class="stat-label">Agenda Tahun Ini</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-calendar"></i></div>
                <div class="stat-number">{{ $totalAgendas }}</div>
                <div class="stat-label">Seluruh Agenda</div>
            </div>
        </div>
    </div>
@endsection