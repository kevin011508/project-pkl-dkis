<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DisplayController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString(); // format: 2026-02-27

        $agendas = DB::table('agenda')
            ->whereDate('tanggal_awal', $today)
            ->whereNull('deleted_at')
            ->orderBy('tanggal_awal', 'asc')
            ->get();

        return view('display', compact('agendas'));
    }
}