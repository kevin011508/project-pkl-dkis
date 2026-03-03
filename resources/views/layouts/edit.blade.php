@php   
   $layout = auth()->user()->role === 'superadmin' ? 'manajemen.app' : 'layouts.app';
@endphp
@extends($layout)

@section('title', 'Edit Agenda - ISUN')

@section('content')

{{-- Cek permission edit, kalau tidak punya redirect dengan pesan error --}}
@canDo('agenda', 'edit')

<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 pt-3">
        <div>
            <h3 class="fw-bold mb-0">Edit Agenda</h3>
            <p class="text-muted">Perbarui informasi agenda yang sudah ada</p>
        </div>
        <a href="{{ route('agenda.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Agenda
        </a>
    </div>

    <!-- Flash Messages -->
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

    <!-- Form Container -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('agenda.update', $agenda->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama Agenda -->
                <div class="mb-4">
                    <label for="nama_agenda" class="form-label fw-semibold">
                        Nama Agenda <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control form-control-lg @error('nama_agenda') is-invalid @enderror" 
                           id="nama_agenda" name="nama_agenda" 
                           value="{{ old('nama_agenda', $agenda->nama_agenda) }}" 
                           placeholder="Contoh: Rapat Koordinasi Triwulan IV"
                           required>
                    @error('nama_agenda')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Masukkan nama agenda yang jelas dan deskriptif</div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label for="deskripsi" class="form-label fw-semibold">Uraian / Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                              id="deskripsi" name="deskripsi" rows="3"
                              placeholder="Jelaskan detail agenda, tujuan, dan hal penting lainnya">{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Penyelenggara -->
                <div class="mb-4">
                    <label for="penyelenggara" class="form-label fw-semibold">Penyelenggara</label>
                    <input type="text" class="form-control @error('penyelenggara') is-invalid @enderror" 
                           id="penyelenggara" name="penyelenggara" 
                           value="{{ old('penyelenggara', $agenda->penyelenggara) }}"
                           placeholder="Contoh: PT. Almajara Indo Tama">
                    @error('penyelenggara')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Lokasi & Alamat -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="lokasi" class="form-label fw-semibold">
                            Lokasi <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                               id="lokasi" name="lokasi" 
                               value="{{ old('lokasi', $agenda->lokasi) }}"
                               placeholder="Contoh: Ruang Rapat Wali Kota Cirebon"
                               required>
                        @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="alamat" class="form-label fw-semibold">Alamat Lengkap</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" 
                               id="alamat" name="alamat" 
                               value="{{ old('alamat', $agenda->alamat) }}"
                               placeholder="Contoh: Jl. Siliwangi No. 84 Kota Cirebon">
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Disposisi & Seragam -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="disposisi" class="form-label fw-semibold">
                            Disposisi <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('disposisi') is-invalid @enderror" 
                                id="disposisi" name="disposisi" required>
                            <option value="">Pilih Disposisi...</option>
                            <option value="Kabid ITIK" {{ old('disposisi', $agenda->disposisi) == 'Kabid ITIK' ? 'selected' : '' }}>Kabid ITIK</option>
                            <option value="KA.DKIS" {{ old('disposisi', $agenda->disposisi) == 'KA.DKIS' ? 'selected' : '' }}>KA.DKIS</option>
                            <option value="Sekdis" {{ old('disposisi', $agenda->disposisi) == 'Sekdis' ? 'selected' : '' }}>Sekdis</option>
                            <option value="Egov" {{ old('disposisi', $agenda->disposisi) == 'Egov' ? 'selected' : '' }}>Egov</option>
                            <option value="Kasubag Program" {{ old('disposisi', $agenda->disposisi) == 'Kasubag Program' ? 'selected' : '' }}>Kasubag Program</option>
                        </select>
                        @error('disposisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="seragam" class="form-label fw-semibold">Seragam</label>
                        <input type="text" class="form-control @error('seragam') is-invalid @enderror" 
                               id="seragam" name="seragam" 
                               value="{{ old('seragam', $agenda->seragam) }}"
                               placeholder="Contoh: Batik, PDL, Formal">
                        @error('seragam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Tanggal & Waktu -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="tanggal_mulai" class="form-label fw-semibold">
                            Tanggal & Waktu Mulai <span class="text-danger">*</span>
                        </label>
                        <input type="datetime-local" class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                               id="tanggal_mulai" name="tanggal_mulai" 
                               value="{{ old('tanggal_mulai', date('Y-m-d\TH:i', strtotime($agenda->tanggal_mulai))) }}" required>
                        @error('tanggal_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_selesai" class="form-label fw-semibold">Tanggal & Waktu Selesai</label>
                        <input type="datetime-local" class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                               id="tanggal_selesai" name="tanggal_selesai" 
                               value="{{ old('tanggal_selesai', $agenda->tanggal_selesai ? date('Y-m-d\TH:i', strtotime($agenda->tanggal_selesai)) : '') }}">
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" 
                                   id="status_selesai" name="status_selesai" value="1"
                                   {{ old('status_selesai', $agenda->status == 'selesai') ? 'checked' : '' }}>
                            <label class="form-check-label" for="status_selesai">
                                <i class="bi bi-check-circle me-1"></i> Tandai sebagai selesai
                            </label>
                        </div>
                        @error('tanggal_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Lampiran -->
                <div class="mb-4">
                    <label for="lampiran" class="form-label fw-semibold">Lampiran / Undangan</label>
                    <div class="border rounded p-3 bg-light">
                        <div class="mb-2">
                            <i class="bi bi-paperclip me-2"></i>
                            <span class="fw-medium">Unggah File</span>
                        </div>
                        
                        @if($agenda->lampiran)
                            <div class="alert alert-info py-2 mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-file-earmark me-2"></i>
                                        <a href="{{ Storage::url($agenda->lampiran) }}" target="_blank" class="text-decoration-none">
                                            {{ basename($agenda->lampiran) }}
                                        </a>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="hapus_lampiran" id="hapus_lampiran" value="1">
                                        <label class="form-check-label small text-danger" for="hapus_lampiran">
                                            <i class="bi bi-trash me-1"></i> Hapus
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        <input type="file" class="form-control @error('lampiran') is-invalid @enderror" 
                               id="lampiran" name="lampiran">
                        @error('lampiran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text mt-2">
                            Ukuran maksimal 2MB. Format yang didukung: PDF, DOC, DOCX, JPG, PNG
                            @if($agenda->lampiran)
                                <br><span class="text-info">Kosongkan jika tidak ingin mengubah file</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sifat Agenda -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Sifat Agenda <span class="text-danger">*</span>
                    </label>
                    <div class="d-flex gap-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" 
                                   name="sifat_agenda" id="publik" value="publik"
                                   {{ old('sifat_agenda', $agenda->sifat_agenda) == 'publik' ? 'checked' : '' }}>
                            <label class="form-check-label fw-medium" for="publik">
                                <i class="bi bi-globe me-1"></i> Publik
                            </label>
                            <div class="form-text">Dapat dilihat oleh semua pengguna</div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" 
                                   name="sifat_agenda" id="privat" value="privat"
                                   {{ old('sifat_agenda', $agenda->sifat_agenda) == 'privat' ? 'checked' : '' }}>
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

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                    <a href="{{ route('agenda.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-x-circle me-2"></i> Batal
                    </a>
                    <div>
                        {{-- Tombol Hapus hanya muncul jika punya permission hapus --}}
                        @canDo('agenda', 'hapus')
                            <button type="button" class="btn btn-outline-danger me-2 px-4" onclick="confirmDelete()">
                                <i class="bi bi-trash me-2"></i> Hapus
                            </button>
                        @endCanDo
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-circle me-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Form Delete (tersembunyi) -->
@canDo('agenda', 'hapus')
    <form id="delete-form" action="{{ route('agenda.destroy', $agenda->id) }}" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>
@endCanDo

@else
    {{-- Tampil pesan jika tidak punya akses edit --}}
    <div class="container-fluid px-4 py-3">
        <div class="alert alert-danger">
            <i class="bi bi-shield-x me-2"></i> Anda tidak memiliki izin untuk mengedit agenda.
            <a href="{{ route('agenda.index') }}" class="alert-link ms-2">Kembali ke Agenda</a>
        </div>
    </div>
@endCanDo

<script>
document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().slice(0, 16);
    const tanggalMulaiInput = document.getElementById('tanggal_mulai');
    
    if (tanggalMulaiInput) {
        tanggalMulaiInput.min = today;
    }
    
    const tanggalSelesaiInput = document.getElementById('tanggal_selesai');
    if (tanggalSelesaiInput && tanggalMulaiInput) {
        tanggalMulaiInput.addEventListener('change', function() {
            tanggalSelesaiInput.min = this.value;
            if (tanggalSelesaiInput.value && tanggalSelesaiInput.value < this.value) {
                tanggalSelesaiInput.value = this.value;
            }
        });
    }
});

function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus agenda ini? Tindakan ini tidak dapat dibatalkan.')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endsection