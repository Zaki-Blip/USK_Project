<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalPeserta' => Peserta::count(),
            'totalSkema'   => Skema::count(),
            'pesertas'     => Peserta::with('skema')->orderBy('skema_id')->orderBy('nama')->get(),
        ]);
    }
}