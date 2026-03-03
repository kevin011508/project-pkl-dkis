{{-- resources/views/user-permission/index.blade.php --}}

@extends('manajemen.app')

@section('title', 'User Permission')

@push('styles')
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<style>
    .content-section {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        padding: 25px;
        margin: 30px 20px;
    }
    h1 {
        color: #2c3e50;
        font-weight: 600;
        font-size: 28px;
        margin-bottom: 10px;
    }
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #495057;
        text-align: center;
        vertical-align: middle;
    }
    .table td {
        vertical-align: middle;
    }
    .btn-tambah {
        background-color: #0d6efd;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s;
        text-decoration: none;
    }
    .btn-tambah:hover {
        background-color: #0b5ed7;
        color: white;
    }
    .badge-controller {
        background-color: #e9ecef;
        color: #495057;
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 13px;
    }
    .badge-action {
        background-color: #cff4fc;
        color: #055160;
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 13px;
    }
    #tabelPermission_wrapper .dataTables_length label,
    #tabelPermission_wrapper .dataTables_filter label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #6c757d;
    }
    #tabelPermission_wrapper .dataTables_filter input {
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 6px 12px;
        width: 250px;
    }
    #tabelPermission_wrapper .dataTables_length select {
        width: 70px;
        padding: 5px 8px;
        border-radius: 6px;
        border: 1px solid #dee2e6;
    }
    #tabelPermission_wrapper .dataTables_info,
    #tabelPermission_wrapper .dataTables_paginate {
        margin-top: 14px;
        font-size: 13px;
    }
    #tabelPermission_wrapper .paginate_button.current,
    #tabelPermission_wrapper .paginate_button.current:hover {
        background: #0d6efd !important;
        color: white !important;
        border-color: #0d6efd !important;
        border-radius: 5px;
    }
    #tabelPermission_wrapper .paginate_button:hover {
        background: #e9ecef !important;
        color: #333 !important;
        border-color: #dee2e6 !important;
        border-radius: 5px;
    }
</style>
@endpush

@section('content')
<div class="content-section">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>User Permission</h1>
        <a href="{{ url('/manajemen/user-permission/create') }}" class="btn-tambah">
            <i class="bi bi-plus-circle me-2"></i>Tambahkan
        </a>
    </div>

    <div class="table-responsive">
        <table id="tabelPermission" class="table table-bordered table-hover w-100">
            <thead class="table-light">
                <tr>
                    <th width="5%">No</th>
                    <th>Controller</th>
                    <th>Action</th>
                    <th>Info</th>
                    <th width="15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

</div>
@endsection

@push('scripts')
{{-- 
    PENTING: Jangan load jQuery lagi di sini kalau layout manajemen.app sudah include jQuery!
    Kalau layout belum ada jQuery, baru uncomment baris di bawah ini:
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
--}}

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {

    // Cek apakah jQuery sudah ada
    if (typeof $.fn.DataTable === 'undefined') {
        console.error('DataTables belum termuat!');
        return;
    }

    $('#tabelPermission').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ url("/manajemen/user-permission/data") }}',
            type: 'GET',
            error: function (xhr, error, thrown) {
                console.error('AJAX Error:', xhr.status, xhr.responseText);
                alert('Gagal memuat data. Status: ' + xhr.status + '. Cek console untuk detail.');
            }
        },
        columns: [
            { data: 0, orderable: false, className: 'text-center' },
            { data: 1, className: 'text-center' },
            { data: 2, className: 'text-center' },
            { data: 3 },
            { data: 4, orderable: false, className: 'text-center' },
        ],
        language: {
            search:           "Cari:",
            searchPlaceholder: "Cari controller atau action...",
            lengthMenu:       "Tampilkan _MENU_ entri",
            info:             "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            infoEmpty:        "Tidak ada data",
            infoFiltered:     "(difilter dari _MAX_ total entri)",
            paginate: {
                first:    "Pertama",
                last:     "Terakhir",
                next:     "Selanjutnya",
                previous: "Sebelumnya",
            },
            processing:  "Memuat data...",
            emptyTable:  "Belum ada data permission",
            zeroRecords: "Data tidak ditemukan",
        },
        order: [[1, 'asc']],
        pageLength: 10,
    });

});
</script>
@endpush