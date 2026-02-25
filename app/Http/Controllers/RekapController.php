<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RekapController extends Controller
{
    public function index()
    {
        return view('rekap');
    }

    public function filter(Request $request)
    {
        return view('rekap');
    }
}
