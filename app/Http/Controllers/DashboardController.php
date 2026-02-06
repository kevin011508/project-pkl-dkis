<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        
        // Today's agendas
        $todayAgendas = Agenda::whereDate('tanggal_awal', $now->toDateString())->count();
        
        // This month's agendas
        $monthAgendas = Agenda::whereMonth('tanggal_awal', $now->month)
            ->whereYear('tanggal_awal', $now->year)
            ->count();
            
        // This year's agendas
        $yearAgendas = Agenda::whereYear('tanggal_awal', $now->year)->count();
        
        // Total agendas
        $totalAgendas = Agenda::count();
        
        // Completed agendas
        $completedAgendas = Agenda::where('status', 'completed')->count();
        
        // Ongoing agendas
        $ongoingAgendas = Agenda::where('status', 'published')->count();
        
        // Upcoming agendas (next 30 days)
        $upcomingAgendas = Agenda::where('tanggal_awal', '>', $now)
            ->where('tanggal_awal', '<=', $now->copy()->addDays(30))
            ->count();
            
        // Draft agendas
        $draftAgendas = Agenda::where('status', 'draft')->count();
        
        // Recent agendas (last 5)
        $recentAgendas = Agenda::latest()->take(5)->get();

        return view('dashboard.index', compact(
            'todayAgendas',
            'monthAgendas',
            'yearAgendas',
            'totalAgendas',
            'completedAgendas',
            'ongoingAgendas',
            'upcomingAgendas',
            'draftAgendas',
            'recentAgendas'
        ));
    }
}