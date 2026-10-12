<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use Illuminate\Http\Request;

class SkemaController extends Controller
{
    public function index()
{
    $user = auth()->user();

    $skemas = $user->isAdmin()
        ? Skema::all()
        : Skema::where('id', $user->peserta?->skema_id)->get();

    return view('skema.index', compact('skemas'));
}

public function show(Skema $skema)
{
    $user = auth()->user();

    abort_if(! $user->isAdmin() && $skema->id !== $user->peserta?->skema_id, 403);

    return view('skema.show', compact('skema'));
}

    public function create()
    {
        return view('skema.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_skema' => ['required', 'max:20', 'regex:/^[A-Z]{2,6}-[A-Z0-9]{2,6}-?[0-9]{0,4}$/', 'unique:skemas,kode_skema'],
            'nama_skema' => ['required', 'max:150', 'regex:/^[a-zA-Z0-9\s\.\-\/]+$/'],
            'deskripsi'  => ['nullable', 'string', 'max:500'],
        ], [
            'kode_skema.required' => 'Kode skema wajib diisi.',
            'kode_skema.regex'    => 'Format kode: JWD-2026 atau SKM-WEB-01.',
            'kode_skema.unique'   => 'Kode skema sudah dipakai.',
            'nama_skema.required' => 'Nama skema wajib diisi.',
            'nama_skema.regex'    => 'Nama hanya boleh huruf, angka, dan simbol dasar.',
            'deskripsi.max'       => 'Deskripsi maksimal 500 karakter.',
        ]);

        Skema::create($validated);
        return redirect()->route('skema.index')->with('sukses', 'Skema berhasil ditambahkan.');
    }

    public function edit(Skema $skema)
    {
        return view('skema.edit', compact('skema'));
    }

    public function update(Request $request, Skema $skema)
    {
        $validated = $request->validate([
            'kode_skema' => ['required', 'max:20','unique:skemas,kode_skema,' . $skema->id],
            'nama_skema' => ['required', 'max:150', 'regex:/^[a-zA-Z0-9\s\.\-\/]+$/'],
            'deskripsi'  => ['nullable', 'string', 'max:500'],
        ], [
            'kode_skema.required' => 'Kode skema wajib diisi.',
            'kode_skema.unique'   => 'Kode skema sudah dipakai.',
            'nama_skema.required' => 'Nama skema wajib diisi.',
            'nama_skema.regex'    => 'Nama hanya boleh huruf, angka, dan simbol dasar.',
            'deskripsi.max'       => 'Deskripsi maksimal 500 karakter.',
        ]);

        $skema->update($validated);
        return redirect()->route('skema.index')->with('sukses', 'Skema berhasil diperbarui.');
    }
    
    public function destroy(Skema $skema)
    {
        // Cek apakah masih dipakai peserta
        if ($skema->pesertas()->count() > 0) {
            return redirect()->route('skema.index')
                ->with('error', 'Skema tidak bisa dihapus karena masih dipakai peserta.');
        }

        $skema->delete();
        return redirect()->route('skema.index')->with('sukses', 'Skema berhasil dihapus.');
    }
}