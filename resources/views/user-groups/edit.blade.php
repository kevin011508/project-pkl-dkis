@extends('manajemen.app')

@section('title', 'Edit User Group - ISUN')

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

    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 6px;
    }

    .form-control, .form-select {
        border-radius: 6px;
        border: 1px solid #ced4da;
        padding: 10px 14px;
        font-size: 0.95rem;
    }

    .form-control:focus {
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }

    .btn-simpan {
        background-color: var(--secondary-color);
        color: white;
        border: none;
        padding: 8px 24px;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-simpan:hover { background-color: #3a5fd9; color: white; }

    .btn-kembali {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 8px 24px;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-kembali:hover { background-color: #5a6268; color: white; }

    /* Permission Grid */
    .permission-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-top: 15px;
    }

    .permission-module {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 15px;
        background-color: #fafafa;
    }

    .permission-module-title {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 10px;
        font-size: 0.95rem;
    }

    .permission-module .form-check {
        margin-bottom: 5px;
    }

    .permission-module .form-check-label {
        font-size: 0.9rem;
        color: #555;
    }

    .pilih-semua-wrapper {
        margin-bottom: 15px;
    }

    .pilih-semua-wrapper .form-check-label {
        font-weight: 600;
        color: #333;
    }

    @media (max-width: 768px) {
        .permission-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .permission-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
    <h4 class="page-title">Edit User Group</h4>

    @php
        $existingPermissions = json_decode($group->permission, true) ?? [];
    @endphp

    <div class="form-container">
        <form action="{{ route('manajemen.user-groups.update', $group->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-body">

                {{-- Nama --}}
                <div class="form-group">
                    <label class="form-label" for="name">Nama <span class="text-danger">*</span></label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name"
                           name="name"
                           value="{{ old('name', $group->name) }}"
                           placeholder="Masukkan nama group">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Permissions --}}
                <div class="form-group">
                    <label class="form-label">Permission <span class="text-danger">*</span></label>

                    {{-- Pilih Semua --}}
                    <div class="pilih-semua-wrapper">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="pilihSemua">
                            <label class="form-check-label" for="pilihSemua">Pilih Semua</label>
                        </div>
                    </div>

                    {{-- Grid Permission per Modul --}}
                    <div class="permission-grid">

                        {{-- Agenda --}}
                        <div class="permission-module">
                            <div class="permission-module-title">agenda</div>
                            @foreach(['lihat', 'tambah', 'edit', 'hapus', 'laporan'] as $aksi)
                            <div class="form-check">
                                <input class="form-check-input permission-cb" type="checkbox"
                                       name="permissions[agenda][]"
                                       value="{{ $aksi }}"
                                       id="agenda_{{ $aksi }}"
                                       {{ (isset($existingPermissions['agenda']) && in_array($aksi, $existingPermissions['agenda'])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="agenda_{{ $aksi }}">{{ $aksi }}</label>
                            </div>
                            @endforeach
                        </div>

                        {{-- Agenda Pimpinan --}}
                        <div class="permission-module">
                            <div class="permission-module-title">agenda_pimpinan</div>
                            @foreach(['lihat', 'tambah', 'edit', 'hapus', 'verifikasi', 'usulan'] as $aksi)
                            <div class="form-check">
                                <input class="form-check-input permission-cb" type="checkbox"
                                       name="permissions[agenda_pimpinan][]"
                                       value="{{ $aksi }}"
                                       id="agenda_pimpinan_{{ $aksi }}"
                                       {{ (isset($existingPermissions['agenda_pimpinan']) && in_array($aksi, $existingPermissions['agenda_pimpinan'])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="agenda_pimpinan_{{ $aksi }}">{{ $aksi }}</label>
                            </div>
                            @endforeach
                        </div>

                        {{-- Galeri --}}
                        <div class="permission-module">
                            <div class="permission-module-title">galeri</div>
                            @foreach(['tambah', 'edit', 'hapus', 'lihat'] as $aksi)
                            <div class="form-check">
                                <input class="form-check-input permission-cb" type="checkbox"
                                       name="permissions[galeri][]"
                                       value="{{ $aksi }}"
                                       id="galeri_{{ $aksi }}"
                                       {{ (isset($existingPermissions['galeri']) && in_array($aksi, $existingPermissions['galeri'])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="galeri_{{ $aksi }}">{{ $aksi }}</label>
                            </div>
                            @endforeach
                        </div>

                        {{-- Non SKPD --}}
                        <div class="permission-module">
                            <div class="permission-module-title">non_skpd</div>
                            @foreach(['lihat', 'tambah', 'edit', 'hapus'] as $aksi)
                            <div class="form-check">
                                <input class="form-check-input permission-cb" type="checkbox"
                                       name="permissions[non_skpd][]"
                                       value="{{ $aksi }}"
                                       id="non_skpd_{{ $aksi }}"
                                       {{ (isset($existingPermissions['non_skpd']) && in_array($aksi, $existingPermissions['non_skpd'])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="non_skpd_{{ $aksi }}">{{ $aksi }}</label>
                            </div>
                            @endforeach
                        </div>

                        {{-- Pedoman --}}
                        <div class="permission-module">
                            <div class="permission-module-title">pedoman</div>
                            @foreach(['lihat', 'tambah', 'edit', 'hapus'] as $aksi)
                            <div class="form-check">
                                <input class="form-check-input permission-cb" type="checkbox"
                                       name="permissions[pedoman][]"
                                       value="{{ $aksi }}"
                                       id="pedoman_{{ $aksi }}"
                                       {{ (isset($existingPermissions['pedoman']) && in_array($aksi, $existingPermissions['pedoman'])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="pedoman_{{ $aksi }}">{{ $aksi }}</label>
                            </div>
                            @endforeach
                        </div>

                        {{-- Pengaturan --}}
                        <div class="permission-module">
                            <div class="permission-module-title">pengaturan</div>
                            @foreach(['edit'] as $aksi)
                            <div class="form-check">
                                <input class="form-check-input permission-cb" type="checkbox"
                                       name="permissions[pengaturan][]"
                                       value="{{ $aksi }}"
                                       id="pengaturan_{{ $aksi }}"
                                       {{ (isset($existingPermissions['pengaturan']) && in_array($aksi, $existingPermissions['pengaturan'])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="pengaturan_{{ $aksi }}">{{ $aksi }}</label>
                            </div>
                            @endforeach
                        </div>

                        {{-- Rilis --}}
                        <div class="permission-module">
                            <div class="permission-module-title">rilis</div>
                            @foreach(['lihat', 'tambah', 'edit', 'hapus'] as $aksi)
                            <div class="form-check">
                                <input class="form-check-input permission-cb" type="checkbox"
                                       name="permissions[rilis][]"
                                       value="{{ $aksi }}"
                                       id="rilis_{{ $aksi }}"
                                       {{ (isset($existingPermissions['rilis']) && in_array($aksi, $existingPermissions['rilis'])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="rilis_{{ $aksi }}">{{ $aksi }}</label>
                            </div>
                            @endforeach
                        </div>

                        {{-- SKPD --}}
                        <div class="permission-module">
                            <div class="permission-module-title">skpd</div>
                            @foreach(['lihat', 'tambah', 'edit', 'hapus'] as $aksi)
                            <div class="form-check">
                                <input class="form-check-input permission-cb" type="checkbox"
                                       name="permissions[skpd][]"
                                       value="{{ $aksi }}"
                                       id="skpd_{{ $aksi }}"
                                       {{ (isset($existingPermissions['skpd']) && in_array($aksi, $existingPermissions['skpd'])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="skpd_{{ $aksi }}">{{ $aksi }}</label>
                            </div>
                            @endforeach
                        </div>

                        {{-- User Group --}}
                        <div class="permission-module">
                            <div class="permission-module-title">user_group</div>
                            @foreach(['lihat', 'tambah', 'edit', 'hapus'] as $aksi)
                            <div class="form-check">
                                <input class="form-check-input permission-cb" type="checkbox"
                                       name="permissions[user_group][]"
                                       value="{{ $aksi }}"
                                       id="user_group_{{ $aksi }}"
                                       {{ (isset($existingPermissions['user_group']) && in_array($aksi, $existingPermissions['user_group'])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="user_group_{{ $aksi }}">{{ $aksi }}</label>
                            </div>
                            @endforeach
                        </div>

                        {{-- User Non SKPD --}}
                        <div class="permission-module">
                            <div class="permission-module-title">user_non_skpd</div>
                            @foreach(['lihat', 'tambah', 'edit', 'hapus'] as $aksi)
                            <div class="form-check">
                                <input class="form-check-input permission-cb" type="checkbox"
                                       name="permissions[user_non_skpd][]"
                                       value="{{ $aksi }}"
                                       id="user_non_skpd_{{ $aksi }}"
                                       {{ (isset($existingPermissions['user_non_skpd']) && in_array($aksi, $existingPermissions['user_non_skpd'])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="user_non_skpd_{{ $aksi }}">{{ $aksi }}</label>
                            </div>
                            @endforeach
                        </div>

                        {{-- User Permission --}}
                        <div class="permission-module">
                            <div class="permission-module-title">user_permission</div>
                            @foreach(['lihat', 'tambah', 'edit', 'hapus'] as $aksi)
                            <div class="form-check">
                                <input class="form-check-input permission-cb" type="checkbox"
                                       name="permissions[user_permission][]"
                                       value="{{ $aksi }}"
                                       id="user_permission_{{ $aksi }}"
                                       {{ (isset($existingPermissions['user_permission']) && in_array($aksi, $existingPermissions['user_permission'])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="user_permission_{{ $aksi }}">{{ $aksi }}</label>
                            </div>
                            @endforeach
                        </div>

                        {{-- User SKPD --}}
                        <div class="permission-module">
                            <div class="permission-module-title">user_skpd</div>
                            @foreach(['lihat', 'tambah', 'edit', 'hapus'] as $aksi)
                            <div class="form-check">
                                <input class="form-check-input permission-cb" type="checkbox"
                                       name="permissions[user_skpd][]"
                                       value="{{ $aksi }}"
                                       id="user_skpd_{{ $aksi }}"
                                       {{ (isset($existingPermissions['user_skpd']) && in_array($aksi, $existingPermissions['user_skpd'])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="user_skpd_{{ $aksi }}">{{ $aksi }}</label>
                            </div>
                            @endforeach
                        </div>

                    </div>

                    @error('permission')
                        <div class="text-danger mt-2" style="font-size:0.85rem">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Hidden input permission sebagai JSON --}}
                <input type="hidden" name="permission" id="permissionJson">

            </div>

            {{-- Footer --}}
            <div class="form-footer">
                <a href="{{ url('manajemen/user-groups') }}" class="btn btn-kembali">Kembali</a>
                <button type="submit" class="btn btn-simpan">Simpan</button>
            </div>

        </form>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const pilihSemua = document.getElementById('pilihSemua');
    const allCb = document.querySelectorAll('.permission-cb');

    // Centang semua jika permission yang tersimpan sudah semua
    pilihSemua.checked = [...allCb].every(c => c.checked);

    // Pilih Semua
    pilihSemua.addEventListener('change', function () {
        allCb.forEach(cb => cb.checked = this.checked);
    });

    // Sinkron pilih semua jika semua sudah dicentang
    allCb.forEach(cb => {
        cb.addEventListener('change', function () {
            pilihSemua.checked = [...allCb].every(c => c.checked);
        });
    });

    // Convert checkbox ke JSON sebelum submit
    document.querySelector('form').addEventListener('submit', function () {
        const permissions = {};

        allCb.forEach(cb => {
            if (cb.checked) {
                const nameParts = cb.name.match(/permissions\[(\w+)\]\[\]/);
                if (nameParts) {
                    const modul = nameParts[1];
                    if (!permissions[modul]) permissions[modul] = [];
                    permissions[modul].push(cb.value);
                }
            }
        });

        document.getElementById('permissionJson').value = JSON.stringify(permissions);

        // Disable semua checkbox agar tidak ikut tersubmit (sudah ada di JSON)
        allCb.forEach(cb => cb.disabled = true);
    });

});
</script>
@endpush