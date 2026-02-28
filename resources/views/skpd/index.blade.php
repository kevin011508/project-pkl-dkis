@extends('manajemen.app')

@section('title', 'SKPD')

@push('styles')

<!-- Bootstrap Icons WAJIB agar icon tidak kotak -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .skpd-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        padding: 10px 5px;
    }

    .page-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .page-header-left h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1a1f36;
        margin: 0 0 4px;
        letter-spacing: -0.5px;
    }

    .page-header-left p {
        color: #8492a6;
        font-size: 0.875rem;
        margin: 0;
    }

    .search-wrapper {
        position: relative;
    }

    .search-wrapper i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
        font-size: 14px;
    }

    .search-input {
        padding: 10px 16px 10px 38px;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.875rem;
        width: 240px;
        background: #f8fafc;
    }

    .skpd-card {
        background: white;
        border-radius: 16px;
        border: 1.5px solid #e8edf5;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(26, 31, 54, 0.06);
    }

    .skpd-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 24px;
        background: #f8fafc;
        border-bottom: 1.5px solid #e8edf5;
    }

    .total-badge {
        background: linear-gradient(135deg, #3943ae, #4e73df);
        color: white;
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .skpd-list-item {
        display: flex;
        align-items: center;
        padding: 16px 24px;
        border-bottom: 1px solid #f0f4f8;
        gap: 16px;
    }

    .item-number {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: #f0f3ff;
        color: #3943ae;
        font-size: 0.8rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .item-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: linear-gradient(135deg, #e8edff, #d4dbff);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .item-icon i {
        color: #3943ae;
        font-size: 16px;
    }

    .item-nama {
        flex: 1;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .alias-badge {
        background: #f0f3ff;
        color: #3943ae;
        border: 1px solid #d4dbff;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 0.78rem;
        font-weight: 700;
    }

</style>
@endpush


@section('content')
<div class="skpd-wrapper">

    <div class="page-header">
        <div>
            <h2>🏛️ Daftar SKPD</h2>
            <p>Satuan Kerja Perangkat Daerah Kota Cirebon</p>
        </div>

        <div class="search-wrapper">
            <i class="bi bi-search"></i>
            <input type="text" class="search-input" id="searchInput" placeholder="Cari nama SKPD...">
        </div>
    </div>


    <div class="skpd-card">

        <div class="skpd-toolbar">
            <form method="GET">
                Tampilkan
                <select name="entries" onchange="this.form.submit()">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                entri
            </form>

            <span class="total-badge">{{ $skpd->total() }} SKPD</span>
        </div>


        <div id="skpdList">
            @foreach($skpd as $index => $item)

            <div class="skpd-list-item">

                <div class="item-number">
                    {{ $skpd->firstItem() + $index }}
                </div>

                <div class="item-icon">
                    <i class="bi bi-building"></i>
                </div>

                <div class="item-nama">
                    {{ $item->uraian }}
                </div>

                @if($item->alias)
                <div>
                    <span class="alias-badge">
                        {{ $item->alias }}
                    </span>
                </div>
                @endif

            </div>

            @endforeach
        </div>


        <div class="p-3">
            {{ $skpd->links('pagination::bootstrap-5') }}
        </div>

    </div>

</div>
@endsection


@push('scripts')
<script>

document.getElementById('searchInput').addEventListener('keyup', function(){

    let keyword = this.value.toLowerCase();

    document.querySelectorAll('.skpd-list-item').forEach(function(item){

        let nama = item.querySelector('.item-nama').innerText.toLowerCase();

        if(nama.includes(keyword)){
            item.style.display = '';
        }else{
            item.style.display = 'none';
        }

    });

});

</script>
@endpush