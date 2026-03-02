@php   
   $layout = auth()->user()->role === 'superadmin' ? 'manajemen.app' : 'layouts.app';
@endphp
@extends($layout)

@section('content')
<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card border shadow-sm">
                <div class="card-body p-4">

                    <!-- Header dalam card -->
                    <h4 class="fw-bold text-dark mb-4">Rekap Agenda</h4>

                    {{-- method GET, tidak perlu @csrf --}}
                    <form action="{{ route('rekap.filter') }}" method="GET">

                        <div class="mb-3">
                            <label class="form-label text-muted">Tahun</label>
                            <select name="tahun" class="form-select">
                                @for ($i = date('Y') - 5; $i <= date('Y') + 5; $i++)
                                    <option value="{{ $i }}" {{ ($tahun ?? date('Y')) == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted">Bulan</label>
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

                        <!-- Kedua tombol sejajar -->
                        <div class="d-flex justify-content-between">
                            {{-- ✅ Pakai route('dashboard') langsung, bukan url()->previous() --}}
                            <a href="{{ route('agenda.index') }}" class="btn btn-secondary px-4">
    Kembali
</a>
                            <button type="submit" class="btn btn-primary px-4">
                                Pratinjau
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection