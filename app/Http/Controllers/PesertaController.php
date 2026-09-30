<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    // Tampil semua peserta + pencarian
    public function index(Request $request)
    {
        $query = Peserta::with('skema');

        if ($request->filled('cari')) {
            $kw = $request->cari;
            $query->where(function ($q) use ($kw) {
                $q->where('nama', 'like', "%{$kw}%")
                  ->orWhere('nik', 'like', "%{$kw}%")
                  ->orWhere('email', 'like', "%{$kw}%")
                  ->orWhereHas('skema', fn($s) => $s->where('nama_skema', 'like', "%{$kw}%"));
            });
        }

        $pesertas = $query->latest()->paginate(10)->withQueryString();
        return view('peserta.index', compact('pesertas'));
    }

    // Form tambah
    public function create()
    {
        $skemas = Skema::orderBy('nama_skema')->get();
        return view('peserta.create', compact('skemas'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik'            => 'required|digits:16|unique:pesertas,nik',
            'nama'           => 'required|max:100',
            'email'          => 'required|email|unique:pesertas,email',
            'no_hp'          => 'nullable|max:15',
            'alamat'         => 'nullable|string',
            'skema_id'       => 'required|exists:skemas,id',
            'tanggal_daftar' => 'required|date',
        ], [
            'nik.required'            => 'NIK wajib diisi.',
            'nik.digits'              => 'NIK harus 16 digit.',
            'nik.unique'              => 'NIK sudah terdaftar.',
            'nama.required'           => 'Nama wajib diisi.',
            'email.required'          => 'Email wajib diisi.',
            'email.email'             => 'Format email tidak valid.',
            'email.unique'            => 'Email sudah terdaftar.',
            'skema_id.required'       => 'Skema wajib dipilih.',
            'skema_id.exists'         => 'Skema tidak ditemukan.',
            'tanggal_daftar.required' => 'Tanggal daftar wajib diisi.',
        ]);

        Peserta::create($validated);

        return redirect()->route('peserta.index')
                         ->with('sukses', 'Data peserta berhasil ditambahkan.');
    }

    // Detail peserta
    public function show(Peserta $peserta)
    {
        $peserta->load('skema');
        return view('peserta.show', compact('peserta'));
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
            'nama'           => 'required|max:100',
            'email'          => 'required|email|unique:pesertas,email,' . $peserta->id,
            'no_hp'          => 'nullable|max:15',
            'alamat'         => 'nullable|string',
            'skema_id'       => 'required|exists:skemas,id',
            'tanggal_daftar' => 'required|date',
        ], [
            'nama.required'  => 'Nama wajib diisi.',
            'email.unique'   => 'Email sudah dipakai peserta lain.',
            'skema_id.exists'=> 'Skema tidak valid.',
        ]);

        $peserta->update($validated);

        return redirect()->route('peserta.index')
                         ->with('sukses', 'Data peserta berhasil diperbarui.');
    }

    // Hapus data
    public function destroy(Peserta $peserta)
    {
        $peserta->delete();
        return redirect()->route('peserta.index')
                         ->with('sukses', 'Data peserta berhasil dihapus.');
    }
}