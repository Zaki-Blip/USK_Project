<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\User;
use App\Models\Skema;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    // Tampil semua peserta + pencarian
    public function index(Peserta $peserta)
    {
        $user = auth()->user();

        $pesertas = $user->isAdmin()
            ? Peserta::with('skema')->orderBy('nama')->get()
            : Peserta::with('skema')->where('user_id', $user->id)->get();

        return view('peserta.index', compact('pesertas'));
    }

    public function show(Peserta $peserta)
    {
        abort_if(! auth()->user()->isAdmin() && $peserta->user_id !== auth()->id(), 403);

        return view('peserta.show', compact('peserta'));
    }

    // Form tambah
    public function create()
    {
        $skemas = Skema::orderBy('nama_skema')->get();
        return view('peserta.create', compact('skemas'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik'            => ['required', 'regex:/^[0-9]{16}$/', 'unique:pesertas,nik'],
            'nama'           => ['required', 'max:100', 'regex:/^[a-zA-Z\s\.\']+$/'],
            'email'          => ['required', 'email:rfc,dns', 'unique:pesertas,email'],
            'no_hp'          => ['nullable', 'regex:/^08[0-9]{8,11}$/'],
            'alamat'         => ['nullable', 'string', 'max:500'],
            'skema_id'       => ['required', 'exists:skemas,id'],
            'tanggal_daftar' => ['required', 'date', 'before_or_equal:today'],
        ], [
            'nik.required'   => 'NIK wajib diisi.',
            'nik.regex'      => 'NIK harus 16 digit angka.',
            'nik.unique'     => 'NIK sudah terdaftar.',
            'nama.required'  => 'Nama wajib diisi.',
            'nama.regex'     => 'Nama hanya boleh huruf & spasi.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah terdaftar.',
            'no_hp.regex'    => 'No HP harus format 08xxxxxxxxxx.',
            'skema_id.required' => 'Skema wajib dipilih.',
            'skema_id.exists'   => 'Skema tidak ditemukan.',
            'tanggal_daftar.before_or_equal' => 'Tanggal tidak boleh masa depan.',
        ]);

        Peserta::create($validated);

        return redirect()->route('peserta.index')
                         ->with('sukses', 'Data peserta berhasil ditambahkan.');
    }

    // Form edit
    public function edit(Peserta $peserta)
    {
        $skemas = Skema::orderBy('nama_skema')->get();
        return view('peserta.edit', compact('peserta', 'skemas'));
    }

    // Update data
    public function update(Request $request, Peserta $peserta)
    {
        $validated = $request->validate([
            'nama'           => ['required', 'max:100', 'regex:/^[a-zA-Z\s\.\']+$/'],
            'email'          => ['required', 'email:rfc,dns', 'unique:pesertas,email,' . $peserta->id],
            'no_hp'          => ['nullable', 'regex:/^08[0-9]{8,11}$/'],
            'alamat'         => ['nullable', 'string', 'max:500'],
            'skema_id'       => ['required', 'exists:skemas,id'],
            'tanggal_daftar' => ['required', 'date', 'before_or_equal:today'],
        ], [
            'nama.required'  => 'Nama wajib diisi.',
            'nama.regex'     => 'Nama hanya boleh huruf & spasi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah dipakai peserta lain.',
            'no_hp.regex'    => 'No HP harus format 08xxxxxxxxxx.',
            'skema_id.exists'=> 'Skema tidak valid.',
            'tanggal_daftar.before_or_equal' => 'Tanggal tidak boleh masa depan.',
        ]);

        $peserta->update($validated);

        return redirect()->route('peserta.index')
                         ->with('sukses', 'Data peserta berhasil diperbarui.');
    }

    // Hapus data
    public function destroy(Peserta $peserta)
{
    $peserta->delete();

    return redirect()
        ->route('peserta.index')
        ->with('sukses', 'Data peserta berhasil dihapus.');
}
}
