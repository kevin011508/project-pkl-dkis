<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Agenda | ISUN</title>

<style>

* { box-sizing: border-box; }

body {
    margin: 0;
    overflow: hidden;
    font-family: Arial, sans-serif;
    background: #1976d2;
}

/* HEADER */
.header {
    text-align: center;
    color: white;
    padding: 15px 20px;
    position: relative;
}

.logo-left {
    position: absolute;
    left: 40px;
    top: 15px;
}

.logo-right {
    position: absolute;
    right: 40px;
    top: 15px;
}

.logo-left img,
.logo-right img {
    height: 80px;
}

.title {
    font-size: 48px;
    font-weight: bold;
    letter-spacing: 10px;
    margin: 0;
}

.subtitle {
    font-size: 18px;
    margin: 4px 0 8px;
}

.dinas {
    background: #e0e0e0;
    display: inline-block;
    padding: 8px 30px;
    font-weight: bold;
    color: #0d47a1;
    font-size: 15px;
}

/* SLIDE CONTAINER */
.slide-wrapper {
    position: relative;
    height: calc(100vh - 175px);
}

.slide-container {
    height: 100%;
    overflow: hidden;
    position: relative;
}

/* SLIDES */
.slide {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 100%;
    transition: left 0.8s ease-in-out;
}

.slide.active { left: 0; }
.slide.prev { left: -100%; }

/* NAV BUTTONS */
.nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.25);
    border: 2px solid rgba(255,255,255,0.6);
    color: white;
    font-size: 18px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 100;
    transition: background 0.2s;
    user-select: none;
}

.nav-btn:hover {
    background: rgba(255,255,255,0.45);
}

.nav-prev { left: 10px; }
.nav-next { right: 10px; }

/* SLIDE COUNTER */
.slide-counter {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 100;
}

.dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255,255,255,0.4);
    cursor: pointer;
    transition: background 0.3s;
}

.dot.active {
    background: white;
}

/* TABLE */
.container {
    width: 94%;
    margin: 12px auto 0;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

thead { background: #f4b400; }

th {
    padding: 14px 16px;
    font-size: 17px;
    color: #1a1a1a;
    text-align: center;
}

td {
    padding: 16px;
    font-size: 16px;
    border-top: 1px solid #e0e0e0;
    vertical-align: middle;
    color: #1a1a1a;
}

tr:nth-child(even) td { background: #f9f9f9; }

.col-no    { width: 4%;  text-align: center; }
.col-tgl   { width: 18%; text-align: center; }
.col-keg   { width: 44%; }
.col-lok   { width: 22%; }
.col-hadir { width: 12%; text-align: center; font-weight: bold; }

/* KOSONG */
.kosong-wrapper {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.kosong-box {
    background: white;
    width: 90%;
    padding: 60px 40px;
    text-align: center;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.kosong-box p {
    font-size: 38px;
    font-family: Georgia, serif;
    color: #333;
    margin: 0;
}

</style>

</head>
<body>

<div class="header">
    <div class="logo-left"><img src="{{ asset('img/logo-cirebon.png') }}"></div>
    <div class="logo-right"><img src="{{ asset('img/logo-cirebon.png') }}"></div>
    <div class="title">I S U N</div>
    <div class="subtitle">(Informasi Surat Undangan dan Kehadiran)</div>
    <div class="dinas">DINAS KOMUNIKASI, INFORMATIKA DAN STATISTIK</div>
</div>

<div class="slide-wrapper">

    @if($agendas->isEmpty())

        <div class="slide-container">
            <div class="slide active">
                <div class="kosong-wrapper">
                    <div class="kosong-box">
                        <p>Tidak ada agenda hari ini</p>
                    </div>
                </div>
            </div>
        </div>

    @else

        {{-- Tombol navigasi --}}
        <button class="nav-btn nav-prev" onclick="changeSlide(-1)">&#8249;</button>
        <button class="nav-btn nav-next" onclick="changeSlide(1)">&#8250;</button>

        <div class="slide-container">

        @php $chunked = $agendas->chunk(5); $no = 1; @endphp

        @foreach($chunked as $key => $chunk)

        <div class="slide {{ $key == 0 ? 'active' : '' }}">
        <div class="container">
        <table>

            <thead>
                <tr>
                    <th class="col-no">NO</th>
                    <th class="col-tgl">HARI & TANGGAL</th>
                    <th class="col-keg">KEGIATAN</th>
                    <th class="col-lok">LOKASI</th>
                    <th class="col-hadir">YANG MENGHADIRI</th>
                </tr>
            </thead>

            <tbody>
            @foreach($chunk as $index => $agenda)
            @php
                $tglAwal    = \Carbon\Carbon::parse($agenda->tanggal_awal)->locale('id');
                $tglAkhir   = \Carbon\Carbon::parse($agenda->tanggal_akhir)->locale('id');
                $hari       = strtoupper($tglAwal->translatedFormat('l'));
                $tgl        = $tglAwal->translatedFormat('d F Y');
                $jamMulai   = $tglAwal->format('H:i');
                $jamSelesai = $tglAkhir->format('H:i');
            @endphp
            <tr>

                <td class="col-no">{{ $no++ }}</td>

                <td class="col-tgl">
                    <strong>{{ $hari }}</strong><br>
                    {{ $tgl }}<br>
                    <span style="font-size:14px;color:#444;">{{ $jamMulai }} s/d {{ $jamSelesai }}</span>
                </td>

                <td class="col-keg">
                    <strong style="font-size:18px;display:block;margin-bottom:4px;">{{ $agenda->nama_agenda }}</strong>
                    <span style="font-size:14px;color:#444;display:block;">Penyelenggara: {{ $agenda->penyelenggara }}</span>
                    @if($agenda->seragam)
                    <span style="font-size:14px;color:#444;display:block;">Seragam: {{ $agenda->seragam }}</span>
                    @endif
                </td>

                <td class="col-lok">
                    @if($agenda->alamat)
                        {{ $agenda->lokasi }}, {{ $agenda->alamat }}
                    @else
                        {{ $agenda->lokasi }}
                    @endif
                </td>

                <td class="col-hadir">{{ $agenda->disposisi }}</td>

            </tr>
            @endforeach
            </tbody>

        </table>
        </div>
        </div>

        @endforeach

        </div>

        {{-- Dot indicator --}}
        <div class="slide-counter" id="dotContainer"></div>

    @endif

</div>

<script>

let slides = document.querySelectorAll(".slide");
let index = 0;
let timer;

function goToSlide(i) {
    slides.forEach((slide, idx) => {
        slide.classList.remove("active", "prev");
        if (idx == i) slide.classList.add("active");
        else if (idx < i) slide.classList.add("prev");
    });
    index = i;
    updateDots();
    updateNavButtons();
}

function changeSlide(dir) {
    let next = index + dir;
    if (next < 0) next = slides.length - 1;
    if (next >= slides.length) next = 0;
    goToSlide(next);
    resetTimer();
updateNavButtons();
}

function autoSlide() {
    let next = index + 1;
    if (next >= slides.length) next = 0;
    goToSlide(next);
}

function resetTimer() {
    clearInterval(timer);
    if (slides.length > 1) {
        timer = setInterval(autoSlide, 10000);
    }
}

function updateNavButtons() {
    let prevBtn = document.querySelector(".nav-prev");
    let nextBtn = document.querySelector(".nav-next");
    if (prevBtn) prevBtn.style.visibility = index == 0 ? "hidden" : "visible";
    if (nextBtn) nextBtn.style.visibility = index == slides.length - 1 ? "hidden" : "visible";
}

function updateDots() {
    let dots = document.querySelectorAll(".dot");
    dots.forEach((dot, i) => {
        dot.classList.toggle("active", i == index);
    });
}

// Buat dots
let dotContainer = document.getElementById("dotContainer");
if (dotContainer) {
    slides.forEach((_, i) => {
        let dot = document.createElement("div");
        dot.className = "dot" + (i == 0 ? " active" : "");
        dot.onclick = () => { goToSlide(i); resetTimer(); };
        dotContainer.appendChild(dot);
    });
}

// Auto slide jika lebih dari 1
resetTimer();
updateNavButtons();

// Fullscreen on click (tapi bukan tombol navigasi)
document.body.onclick = function(e) {
    if (!e.target.closest(".nav-btn") && !e.target.closest(".dot")) {
        document.documentElement.requestFullscreen();
    }
}

</script>

</body>
</html>