@php   
   $layout = auth()->user()->role === 'superadmin' ? 'manajemen.app' : 'layouts.app';
@endphp
@extends($layout)

@section('title', 'Tambah Agenda Baru - ISUN')

@section('content')
<div class="container-fluid px-4 py-3">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Tambah Agenda Baru</h3>
            <p class="text-muted mb-0">Isi form di bawah untuk menambahkan agenda baru</p>
        </div>
        <a href="{{ route('agenda.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Form Container --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nama Agenda --}}
                <div class="mb-4">
                    <label for="nama_agenda" class="form-label fw-semibold">
                        Nama Agenda <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           class="form-control form-control-lg @error('nama_agenda') is-invalid @enderror" 
                           id="nama_agenda" 
                           name="nama_agenda" 
                           value="{{ old('nama_agenda') }}" 
                           placeholder="Contoh: Rapat Koordinasi Triwulan IV"
                           required>
                    @error('nama_agenda')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Masukkan nama agenda yang jelas dan deskriptif</div>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label for="deskripsi" class="form-label fw-semibold">Uraian / Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                              id="deskripsi" 
                              name="deskripsi" 
                              rows="3"
                              placeholder="Jelaskan detail agenda, tujuan, dan hal penting lainnya">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Penyelenggara --}}
                <div class="mb-4">
                    <label for="penyelenggara" class="form-label fw-semibold">Penyelenggara</label>
                    <input type="text" 
                           class="form-control @error('penyelenggara') is-invalid @enderror" 
                           id="penyelenggara" 
                           name="penyelenggara" 
                           value="{{ old('penyelenggara') }}"
                           placeholder="Contoh: PT. Almajara Indo Tama">
                    @error('penyelenggara')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Lokasi & Alamat --}}
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="lokasi" class="form-label fw-semibold">
                            Lokasi <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('lokasi') is-invalid @enderror" 
                               id="lokasi" 
                               name="lokasi" 
                               value="{{ old('lokasi') }}"
                               placeholder="Contoh: Ruang Rapat Wali Kota Cirebon"
                               required>
                        @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="alamat" class="form-label fw-semibold">Alamat Lengkap</label>
                        <input type="text" 
                               class="form-control @error('alamat') is-invalid @enderror" 
                               id="alamat" 
                               name="alamat" 
                               value="{{ old('alamat') }}"
                               placeholder="Contoh: Jl. Siliwangi No. 84 Kota Cirebon">
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Disposisi & Seragam --}}
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="disposisi" class="form-label fw-semibold">
                            Disposisi <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('disposisi') is-invalid @enderror" 
                                id="disposisi" 
                                name="disposisi" 
                                required>
                            <option value="">Pilih Disposisi...</option>
                            @foreach(['Kabid ITIK', 'KA.DKIS', 'Sekdis', 'Egov', 'Kasubag Program'] as $d)
                                <option value="{{ $d }}" {{ old('disposisi') == $d ? 'selected' : '' }}>
                                    {{ $d }}
                                </option>
                            @endforeach
                        </select>
                        @error('disposisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="seragam" class="form-label fw-semibold">Seragam</label>
                        <input type="text" 
                               class="form-control @error('seragam') is-invalid @enderror" 
                               id="seragam" 
                               name="seragam" 
                               value="{{ old('seragam') }}"
                               placeholder="Contoh: Batik, PDL, Formal">
                        @error('seragam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tanggal & Waktu --}}
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="tanggal_awal" class="form-label fw-semibold">
                            Tanggal & Waktu Mulai <span class="text-danger">*</span>
                        </label>
                        <input type="datetime-local" 
                               class="form-control @error('tanggal_awal') is-invalid @enderror" 
                               id="tanggal_awal" 
                               name="tanggal_awal" 
                               value="{{ old('tanggal_awal') }}" 
                               required>
                        @error('tanggal_awal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_akhir" class="form-label fw-semibold">
                            Tanggal & Waktu Selesai
                        </label>
                        <input type="datetime-local" 
                               class="form-control @error('tanggal_akhir') is-invalid @enderror" 
                               id="tanggal_akhir" 
                               name="tanggal_akhir" 
                               value="{{ old('tanggal_akhir') }}">
                        <div class="form-check mt-2">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="status_selesai" 
                                   name="status_selesai" 
                                   value="1"
                                   {{ old('status_selesai') ? 'checked' : '' }}>
                            <label class="form-check-label" for="status_selesai">
                                <i class="bi bi-check-circle me-1"></i> Tandai sebagai selesai
                            </label>
                        </div>
                        @error('tanggal_akhir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Lampiran --}}
                <div class="mb-4">
                    <label for="lampiran" class="form-label fw-semibold">Lampiran / Undangan</label>
                    <div class="border rounded p-3 bg-light">
                        <div class="mb-2">
                            <i class="bi bi-paperclip me-2"></i>
                            <span class="fw-medium">Unggah File</span>
                        </div>
                        <input type="file" 
                               class="form-control @error('lampiran') is-invalid @enderror" 
                               id="lampiran" 
                               name="lampiran">
                        @error('lampiran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text mt-2">
                            Ukuran maksimal 2MB. Format: PDF, DOC, DOCX, JPG, PNG
                        </div>
                    </div>
                </div>

                {{-- Sifat Agenda --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Sifat Agenda <span class="text-danger">*</span>
                    </label>
                    <div class="d-flex flex-wrap gap-4">
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="radio" 
                                   name="sifat_agenda" 
                                   id="publik" 
                                   value="publik"
                                   {{ old('sifat_agenda', 'publik') == 'publik' ? 'checked' : '' }}>
                            <label class="form-check-label fw-medium" for="publik">
                                <i class="bi bi-globe me-1"></i> Publik
                            </label>
                            <div class="form-text">Dapat dilihat oleh semua pengguna</div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="radio" 
                                   name="sifat_agenda" 
                                   id="privat" 
                                   value="privat"
                                   {{ old('sifat_agenda') == 'privat' ? 'checked' : '' }}>
                            <label class="form-check-label fw-medium" for="privat">
                                <i class="bi bi-lock me-1"></i> Privat
                            </label>
                            <div class="form-text">Hanya dapat dilihat oleh pengguna tertentu</div>
                        </div>
                    </div>
                    @error('sifat_agenda')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                    <a href="{{ route('agenda.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-x-circle me-2"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-check-circle me-2"></i> Simpan Agenda
                    </button>
                </div>

            </form>
        </div>{{-- end card-body --}}
    </div>{{-- end card --}}

</div>{{-- end container-fluid --}}
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tanggalMulai  = document.getElementById('tanggal_awal');
    const tanggalSelesai = document.getElementById('tanggal_akhir');

    if (tanggalMulai) {
        const now = new Date().toISOString().slice(0, 16);
        tanggalMulai.min = now;

        if (!tanggalMulai.value) {
            tanggalMulai.value = now;
        }

        tanggalMulai.addEventListener('change', function () {
            if (tanggalSelesai) {
                tanggalSelesai.min = this.value;

                // Reset tanggal selesai jika lebih kecil dari tanggal mulai
                if (tanggalSelesai.value && tanggalSelesai.value < this.value) {
                    tanggalSelesai.value = this.value;
                }
            }
        });
    }
});
</script>
@endpush