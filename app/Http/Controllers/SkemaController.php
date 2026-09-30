<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use Illuminate\Http\Request;

class SkemaController extends Controller
{
    public function index()
    {
        $skemas = Skema::withCount('pesertas')->latest()->paginate(10);
        return view('skema.index', compact('skemas'));
    }

    public function create()
    {
        return view('skema.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_skema' => 'required|max:20|unique:skemas,kode_skema',
            'nama_skema' => 'required|max:150',
            'deskripsi'  => 'nullable|string',
        ], [
            'kode_skema.required' => 'Kode skema wajib diisi.',
            'kode_skema.unique'   => 'Kode skema sudah dipakai.',
            'nama_skema.required' => 'Nama skema wajib diisi.',
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
            'kode_skema' => 'required|max:20|unique:skemas,kode_skema,' . $skema->id,
            'nama_skema' => 'required|max:150',
            'deskripsi'  => 'nullable|string',
        ]);

        $skema->update($validated);
        return redirect()->route('skema.index')->with('sukses', 'Skema berhasil diperbarui.');
    }
    public function show(Skema $skema)
    {
        $skema->load('pesertas');
        return view('skema.show', compact('skema'));
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