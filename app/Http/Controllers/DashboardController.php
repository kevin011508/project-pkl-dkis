<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        // Agenda Hari Ini
        $todayAgendas = Agenda::whereDate('tanggal_mulai', $now->toDateString())->count();

        // Agenda Bulan Ini
        $monthAgendas = Agenda::whereMonth('tanggal_mulai', $now->month)
            ->whereYear('tanggal_mulai', $now->year)
            ->count();

        // Agenda Tahun Ini
        $yearAgendas = Agenda::whereYear('tanggal_mulai', $now->year)->count();

        // Total Agenda
        $totalAgendas = Agenda::count();

        return view('index', compact(
            'todayAgendas',
            'monthAgendas',
            'yearAgendas',
            'totalAgendas'
        ));
    }
}
