@extends('manajemen.app')

@section('title', 'Detail User Non SKPD - ISUN')

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

    .page-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }

    .detail-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 4px;
        font-size: 0.9rem;
    }

    .detail-value {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 6px;
        padding: 10px 14px;
        font-size: 0.95rem;
        color: #333;
        margin-bottom: 20px;
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
    <h4 class="page-title">Detail User Non SKPD</h4>

    <div class="form-container">
        <div class="form-body">

            {{-- Username --}}
            <div>
                <p class="detail-label">Username</p>
                <div class="detail-value">{{ $user->username }}</div>
            </div>

            {{-- PIN --}}
            <div>
                <p class="detail-label">PIN</p>
                <div class="detail-value">{{ $user->pin }}</div>
            </div>

            {{-- User Group --}}
            <div>
                <p class="detail-label">User Group</p>
                <div class="detail-value">{{ $user->user_group ?? '-' }}</div>
            </div>

            {{-- Non SKPD --}}
            <div>
                <p class="detail-label">Non SKPD</p>
               <div class="detail-value">{{ $user->nama ?? '-' }}</div>
            </div>

            {{-- Terkunci --}}
            <div>
                <p class="detail-label">Terkunci</p>
                <div class="detail-value">
                    @if($user->terkunci == 1)
                        <span class="badge bg-danger">Ya</span>
                    @else
                        <span class="badge bg-success">Tidak</span>
                    @endif
                </div>
            </div>

          

            {{-- Diupdate --}}
            <div>
                <p class="detail-label">Diupdate</p>
                <div class="detail-value">{{ optional($user->updated_at)->format('d/m/Y H:i') ?? '-' }}</div>
            </div>

        </div>

        {{-- Footer --}}
        <div class="form-footer">
            <a href="{{ url('manajemen/user-non-skpd') }}" class="btn btn-kembali">
                Kembali
            </a>
        </div>

    </div>
@endsection