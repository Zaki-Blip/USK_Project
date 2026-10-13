<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    // Admin: daftar semua peserta. User: langsung ke datanya sendiri.
    public function index(Request $request)
{
    $user = $request->user();

    if (! $user->isAdmin()) {
        // Belum isi biodata -> ke form biodata
        if (! $user->peserta) {
            return redirect()->route('peserta.create');
        }

        return redirect()->route('peserta.show', $user->peserta);
    }

    $pesertas = Peserta::with('skema')->orderBy('nama')->get();

    return view('peserta.index', compact('pesertas'));
}

    public function show(Request $request, Peserta $peserta)
    {
        $this->pastikanBoleh($request->user(), $peserta);

        return view('peserta.show', compact('peserta'));
    }

    // Form tambah (admin saja, dijaga di route)
    public function create()
    {
        $skemas = Skema::orderBy('nama_skema')->get();
        return view('peserta.create', compact('skemas'));
    }

    // Simpan data baru (admin saja, dijaga di route)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik'            => ['required', 'regex:/^[0-9]{16}$/', 'unique:pesertas,nik'],
            'nama'           => ['required', 'max:100', 'regex:/^[a-zA-Z\s\.\']+$/'],
            'email'          => ['required', 'email:rfc,dns', 'unique:pesertas,email', 'unique:users,email'],
            'no_hp'          => ['required', 'digits_between:9,13', 'starts_with:08'],
            'alamat'         => ['required', 'string', 'max:500'],
            'skema_id'       => ['required', 'exists:skemas,id'],
            'tanggal_daftar' => ['required', 'date', 'before_or_equal:today'],
        ], [
            'nik.required'             => 'NIK wajib diisi.',
            'nik.regex'                => 'NIK harus 16 digit angka.',
            'nik.unique'               => 'NIK sudah terdaftar.',
            'nama.required'            => 'Nama wajib diisi.',
            'nama.regex'               => 'Nama hanya boleh huruf, spasi, titik, & petik.',
            'email.required'           => 'Email wajib diisi.',
            'email.email'              => 'Format email tidak valid.',
            'email.unique'             => 'Email sudah terdaftar.',
            'no_hp.required'           => 'No HP wajib diisi.',
            'no_hp.digits_between'     => 'No HP harus diawali 08 dan memiliki panjang maks 13 digit.',
            'alamat.required'          => 'Alamat wajib diisi.',
            'skema_id.required'        => 'Skema wajib dipilih.',
            'skema_id.exists'          => 'Skema tidak ditemukan.',
            'tanggal_daftar.required'  => 'Tanggal daftar wajib diisi.',
            'tanggal_daftar.date'      => 'Format tanggal tidak valid.',
            'tanggal_daftar.before_or_equal' => 'Tanggal tidak boleh melebihi hari ini.',
        ]);

        Peserta::create($validated);

        return redirect()->route('peserta.index')
                ->with('sukses', 'Data peserta berhasil ditambahkan.');
    }

    // Form edit (admin: siapa saja, user: miliknya sendiri)
    public function edit(Request $request, Peserta $peserta)
    {
        $this->pastikanBoleh($request->user(), $peserta);

        $skemas = Skema::orderBy('nama_skema')->get();
        return view('peserta.edit', compact('peserta', 'skemas'));
    }

    // Update data (admin: siapa saja, user: miliknya sendiri)
    public function update(Request $request, Peserta $peserta)
{
    $this->pastikanBoleh($request->user(), $peserta);

    $validated = $request->validate([
    'nama'           => ['required', 'max:100', 'regex:/^[a-zA-Z\s\.\']+$/'],
    'email'          => ['required', 'email:rfc,dns', 'unique:pesertas,email,' . $peserta->id],
    'no_hp'          => ['required', 'digits_between:9,13', 'starts_with:08'],
    'alamat'         => ['required', 'string', 'max:500'],
    'skema_id'       => ['required', 'exists:skemas,id'],
    'tanggal_daftar' => ['required', 'date', 'before_or_equal:today'],
], [
    'nama.required'            => 'Nama wajib diisi.',
    'nama.regex'               => 'Nama hanya boleh huruf, spasi, titik, & petik.',
    'email.required'           => 'Email wajib diisi.',
    'email.email'              => 'Format email tidak valid.',
    'email.unique'             => 'Email sudah dipakai peserta lain.',
    'no_hp.required'           => 'No HP wajib diisi.',
    'no_hp.digits_between'     => 'No HP harus diawali 08 dan memiliki panjang maks 13 digit.',
    'alamat.required'          => 'Alamat wajib diisi.',
    'skema_id.required'        => 'Skema wajib dipilih.',
    'skema_id.exists'          => 'Skema tidak valid.',
    'tanggal_daftar.required'  => 'Tanggal daftar wajib diisi.',
    'tanggal_daftar.date'      => 'Format tanggal tidak valid.',
    'tanggal_daftar.before_or_equal' => 'Tanggal tidak boleh melebihi hari ini.',
]);

    $peserta->update($validated);

    if ($request->user()->isAdmin()) {
    return redirect()->route('peserta.index')
                     ->with('sukses', 'Data peserta berhasil diperbarui.');
    }

    return redirect()->route('peserta.show', $peserta)
                    ->with('sukses', 'Data kamu berhasil diperbarui.');
}

    // Hapus data (admin saja, dijaga di route)
    public function destroy(Peserta $peserta)
    {
        $peserta->delete();

        return redirect()->route('peserta.index')
                         ->with('sukses', 'Data peserta berhasil dihapus.');
    }

    // Admin boleh semua. User hanya boleh data miliknya sendiri.
    private function pastikanBoleh($user, Peserta $peserta): void
    {
        abort_if(! $user->isAdmin() && $peserta->user_id !== $user->id, 403);
    }
}
