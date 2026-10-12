<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;

class DashboardController extends Controller
{
    public function index()
{
    if (auth()->user()->role === 'admin') {
        return view('admin.dashboard', [
            'totalPeserta' => Peserta::count(),
            'totalSkema'   => Skema::count(),
            'pesertas'     => Peserta::with('skema')->orderBy('skema_id')->orderBy('nama')->get(),
        ]);
        return view('admin.dashboard', compact('peserta'));
    }

    $peserta = auth()->user()->peserta()->with('skema')->first();

    
}
}