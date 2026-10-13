<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Menampilkan dashboard sesuai dengan role pengguna yang login.
    public function index(Request $request)
    {
        // Mengambil data pengguna yang sedang login.
        $user = $request->user();

        // Memeriksa apakah pengguna memiliki role sebagai admin.
        if ($user->role === 'admin') {

            // Menghitung jumlah seluruh peserta yang terdaftar.
            $totalPeserta = Peserta::count();

            // Menghitung jumlah seluruh skema sertifikasi yang tersedia.
            $totalSkema = Skema::count();

            // Mengambil seluruh data peserta beserta informasi skemanya.
            // Data diurutkan berdasarkan ID skema, kemudian berdasarkan nama.
            $pesertas = Peserta::with('skema')
                ->orderBy('skema_id')
                ->orderBy('nama')
                ->get();

            // Menampilkan dashboard admin.
            // Mengirim jumlah peserta, jumlah skema, dan daftar peserta
            // agar dapat digunakan pada halaman dashboard.
            return view(
                'admin.dashboard',
                compact('totalPeserta', 'totalSkema', 'pesertas')
            );
        }

        // Mengambil data peserta yang terhubung dengan akun pengguna.
        // Relasi skema ikut dimuat agar informasi skema tersedia.
        // first() mengambil data peserta pertama yang ditemukan.
        $peserta = $user->peserta()
            ->with('skema')
            ->first();

        // Menampilkan dashboard pengguna dengan data biodata peserta.
        return view('user.dashboard', compact('peserta'));
    }
}
