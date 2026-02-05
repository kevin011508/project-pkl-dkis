@extends('layouts.app')

@section('title', 'Trash Agenda')

@section('content')
<h3 class="fw-bold mb-3">Agenda Terhapus</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($agendas->count() > 0)
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Agenda</th>
            <th>Dihapus Pada</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach($agendas as $agenda)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $agenda->nama_agenda }}</td>
            <td>{{ $agenda->deleted_at }}</td>
            <td>
                <form action="{{ route('agenda.restore', $agenda->id) }}"
                      method="POST">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-success btn-sm">
                        Restore
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $agendas->links() }}
@else
    <div class="alert alert-info">
        Tidak ada agenda di trash
    </div>
@endif
@endsection
