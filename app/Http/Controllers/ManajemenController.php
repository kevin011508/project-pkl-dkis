<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Carbon\Carbon;
class ManajemenController extends Controller
{
    public function index()
    {

    $now = Carbon::now();

    $todayAgendas = Agenda::whereDate('tanggal_mulai', $now->toDateString())->count();
    $monthAgendas = Agenda::whereMonth('tanggal_mulai', $now->month)
        ->whereYear('tanggal_mulai', $now->year)
        ->count();
    $yearAgendas = Agenda::whereYear('tanggal_mulai', $now->year)->count();
    $totalAgendas = Agenda::count();

    return view('manajemen.dashboard', compact(
        'todayAgendas',
        'monthAgendas',
        'yearAgendas',
        'totalAgendas'
    ));


    }

    public function user()
    {
        return view('manajemen.user');
    }

    public function organisasi()
    {
        return view('manajemen.organisasi');
    }

    public function pengaturan()
    {
        return view('manajemen.pengaturan');
    }

    
}
