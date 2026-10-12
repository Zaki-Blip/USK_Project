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
        'nik'      => 'required|digits:16|unique:pesertas,nik',
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'no_hp'    => 'required|string|max:20',
        'alamat'   => 'required|string',
        'skema_id' => 'required|exists:skemas,id',
        'password' => 'required|min:6|confirmed',
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