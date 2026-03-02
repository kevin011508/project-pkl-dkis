@extends('manajemen.app')

@section('title', 'Trash Agenda')

@section('content')
<h3 class="fw-bold mb-3">Agenda Terhapus</h3>

{{-- @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif --}}

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if($agendas->count() > 0)
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Agenda</th>
            <th>Dihapus Pada</th>
            <th>Dihapus Oleh</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach($agendas as $agenda)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $agenda->nama_agenda }}</td>
            <td>{{ $agenda->deleted_at->format('d/m/Y H:i') }}</td>
            <td>
                @if($agenda->deletedByUser)
                    {{ $agenda->deletedByUser->name }}
                @endif
            </td>
            <td>
                <div class="d-flex gap-2">
                    <!-- Form Restore -->
                    <form action="{{ route('agenda.restore', $agenda->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Yakin ingin mengembalikan agenda ini?')">
                            <i class="bi bi-arrow-repeat"></i> Restore
                        </button>
                    </form>

                    <!-- Form Delete Permanen -->
                    <form action="{{ route('agenda.force-delete', $agenda->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('PERHATIAN! Agenda akan dihapus secara permanen. Yakin?')">
                            <i class="bi bi-trash"></i> Hapus Permanen
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="mt-3">
    {{ $agendas->links() }}
</div>

<!-- Tombol Hapus Semua Permanen -->
<div class="mt-3">
    <form action="{{ route('agenda.force-delete-all') }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-warning" onclick="return confirm('PERHATIAN! SEMUA agenda di trash akan dihapus permanen. Yakin?')">
            <i class="bi bi-trash"></i> Kosongkan Trash
        </button>
    </form>
</div>

@else
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> Tidak ada agenda di trash
    </div>
@endif
@endsection