@extends('manajemen.app')

@section('title', 'Detail User Group')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">

            <div class="mb-4">
                <h2 class="fw-bold text-dark mb-0">Detail User Group</h2>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">

                    <div class="mb-4 pb-4 border-bottom">
                        <label class="form-label text-muted small mb-2">Nama Group</label>
                        <h4 class="fw-semibold text-dark mb-0">{{ $group->name }}</h4>
                    </div>

                    

                    <div class="mb-4">
                        <label class="form-label text-muted small mb-2">Permission</label>
                        @php
                            $permissions = json_decode($group->permission, true) ?? [];
                        @endphp
                        @if(count($permissions) > 0)
                            <div class="row">
                                @foreach($permissions as $modul => $aksi)
                                <div class="col-md-4 mb-3">
                                    <div class="border rounded p-2">
                                        <strong class="text-primary">{{ $modul }}</strong>
                                        <ul class="mb-0 mt-1 ps-3">
                                            @foreach($aksi as $a)
                                                <li>{{ $a }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">Tidak ada permission</p>
                        @endif
                    </div>

                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('manajemen.user-groups.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

        </div>
    </div>
</div>
@endsection