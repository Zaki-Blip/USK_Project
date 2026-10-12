<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $totalPeserta = Peserta::count();
            $totalSkema   = Skema::count();
            $pesertas     = Peserta::with('skema')->orderBy('skema_id')->orderBy('nama')->get();

            return view('admin.dashboard', compact('totalPeserta', 'totalSkema', 'pesertas'));
        }

        $peserta = auth()->user()->peserta()->with('skema')->first();
        return view('user.dashboard', compact('peserta'));
    }

}
