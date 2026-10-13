<?php

namespace App\Http\Controllers;

//use App\Models\Peserta;
use App\Models\Skema;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
{
    return view('auth.register', compact('skemas'));
}
public function register(Request $request)
{
    $validated = $request->validate([
        'name'     => ['required', 'max:100'],
        'email'    => ['required', 'email', 'unique:users,email'],
        'password' => ['required', 'min:6', 'confirmed'],
    ], [
        'name.required'      => 'Nama wajib diisi.',
        'email.required'     => 'Email wajib diisi.',
        'email.email'        => 'Format email tidak valid.',
        'email.unique'       => 'Email sudah terdaftar.',
        'password.required'  => 'Password wajib diisi.',
        'password.min'       => 'Password minimal 6 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ]);

    $user = User::create([
        'name'     => $validated['name'],
        'email'    => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role'     => 'user',
    ]);

    Auth::login($user);
    $request->session()->regenerate();

    return redirect()->route('dashboard');
}
//login
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
