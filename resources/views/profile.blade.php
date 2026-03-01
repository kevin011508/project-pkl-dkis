@php
    $layout = auth()->user()->role === 'superadmin' ? 'manajemen.app' : 'layouts.app';
@endphp

@extends($layout)

@section('title', 'Edit Akun User')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700&display=swap');

    :root {
        --primary: #4965d4;
        --primary-light: #6c83e0;
        --gray-light: #f0f2f5;
        --gray-border: #e2e5ea;
        --text-dark: #2d2d2d;
        --text-muted: #7a7f9a;
    }

    * { box-sizing: border-box; }

    body {
        font-family: 'Nunito', sans-serif;
        background: #f5f6fa;
        color: var(--text-dark);
    }

    /* ── MAIN CONTENT ── */
    .main-content {
        padding: 2rem 2.5rem;
    }

    .page-title {
        font-size: 1.65rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1.5rem;
    }

    /* ── FORM CARD ── */
    .form-card {
        background: #fff;
        border: 1px solid var(--gray-border);
        border-radius: 10px;
        overflow: hidden;
        max-width: 700px;
    }

    .form-card-body {
        padding: 1.8rem 2rem;
    }

    .form-card-footer {
        background: var(--gray-light);
        border-top: 1px solid var(--gray-border);
        padding: 1rem 2rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    /* ── FORM ELEMENTS ── */
    .form-group {
        margin-bottom: 1.4rem;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--text-dark);
        margin-bottom: 0.45rem;
    }

    .form-control {
        width: 100%;
        padding: 0.52rem 0.85rem;
        border: 1px solid var(--gray-border);
        border-radius: 6px;
        font-family: 'Nunito', sans-serif;
        font-size: 0.92rem;
        color: var(--text-dark);
        background: #fff;
        transition: border-color 0.2s, box-shadow 0.2s;
        outline: none;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(73,101,212,0.15);
    }

    .form-control.readonly-field {
        background: var(--gray-light);
        color: #555;
    }

    /* ── BUTTONS ── */
    .btn-kembali {
        padding: 0.42rem 1.1rem;
        border-radius: 6px;
        font-family: 'Nunito', sans-serif;
        font-weight: 600;
        font-size: 0.88rem;
        border: 1px solid var(--gray-border);
        background: #fff;
        color: var(--text-dark);
        cursor: pointer;
        transition: background 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-kembali:hover {
        background: #e8eaed;
        color: var(--text-dark);
    }

    .btn-simpan {
        padding: 0.42rem 1.2rem;
        border-radius: 6px;
        font-family: 'Nunito', sans-serif;
        font-weight: 700;
        font-size: 0.88rem;
        border: none;
        background: var(--primary);
        color: #fff;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-simpan:hover { background: var(--primary-light); }

    /* Alert error */
    .alert-danger {
        background: #fff0f0;
        border: 1px solid #f5c6cb;
        color: #721c24;
        border-radius: 6px;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        font-size: 0.88rem;
    }

    .alert-success {
        background: #f0fff4;
        border: 1px solid #b2dfdb;
        color: #1b5e20;
        border-radius: 6px;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        font-size: 0.88rem;
    }
</style>

<div class="main-content">
    <h1 class="page-title">Edit Akun User</h1>

    <div class="form-card">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-card-body">

                {{-- Alert error validasi --}}
                @if ($errors->any())
                    <div class="alert-danger">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Alert sukses --}}
                @if (session('success'))
                    <div class="alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Username (readonly) --}}
                <div class="form-group">
                    <label for="username">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        class="form-control readonly-field"
                        value="{{ auth()->user()->username }}"
                        readonly
                    >
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Kosongkan jika tidak ingin mengubah password"
                    >
                </div>

                {{-- Konfirmasi Password --}}
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Ulangi password baru"
                    >
                </div>

            </div>

            {{-- Footer Buttons --}}
            <div class="form-card-footer">
                <a href="{{ url()->previous() }}" class="btn-kembali">Kembali</a>
                <button type="submit" class="btn-simpan">Simpan</button>
            </div>

        </form>
    </div>
</div>

@endsection