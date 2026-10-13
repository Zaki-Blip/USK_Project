<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
{
    $skemas = Skema::orderBy('nama_skema')->get();

    return view('auth.register', compact('skemas'));
}

public function register(Request $request)
{
    $data = $request->validate([
        'nik'      => ['required', 'digits:16', 'unique:pesertas,nik'],
        'name'     => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s\.\']+$/'],
        'email'    => ['required', 'email:rfc,dns', 'unique:users,email', 'unique:pesertas,email'],
        'no_hp'    => ['required', 'regex:/^08[0-9]{9,11}$/'],
        'alamat'   => ['required', 'string', 'max:500'],
        'skema_id' => ['required', 'exists:skemas,id'],
        'password' => ['required', 'min:6', 'confirmed'],
    ], [
        'nik.required'       => 'NIK wajib diisi.',
        'nik.digits'         => 'NIK harus 16 digit.',
        'nik.unique'         => 'NIK sudah terdaftar.',
        'name.required'      => 'Nama wajib diisi.',
        'name.regex'         => 'Nama hanya boleh berisi huruf, spasi, titik, dan petik.',
        'email.required'     => 'Email wajib diisi.',
        'email.email'        => 'Format email tidak valid.',
        'email.unique'       => 'Email sudah terdaftar.',
        'no_hp.required'     => 'No HP wajib diisi.',
        'no_hp.regex'        => 'No HP harus diawali 08 dan memiliki panjang 11-13 digit.',
        'alamat.required'    => 'Alamat wajib diisi.',
        'skema_id.required'  => 'Skema wajib dipilih.',
        'skema_id.exists'    => 'Skema tidak ditemukan.',
        'password.required'  => 'Password wajib diisi.',
        'password.min'       => 'Password minimal 6 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ]);

    DB::transaction(function () use ($data) {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Peserta::create([
            'user_id'        => $user->id,
            'nik'            => $data['nik'],
            'nama'           => $data['name'],
            'email'          => $data['email'],
            'no_hp'          => $data['no_hp'],
            'alamat'         => $data['alamat'],
            'skema_id'       => $data['skema_id'],
            'tanggal_daftar' => now()->toDateString(),
        ]);
    });

    return redirect()->route('halamanAwal')
        ->with('sukses', 'Registrasi berhasil. Silakan login.');
}
    // Tampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')
                             ->with('sukses', 'Selamat datang, ' . Auth::user()->name);
        }
        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->onlyInput('email');
    }
    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('danger', 'Anda berhasil logout.');
    }
}