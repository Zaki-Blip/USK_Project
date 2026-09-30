@extends('layouts.app')
@section('title', 'Data Peserta')
@section('content')

<div class="d-flex justify-content-between mb-3">
    <h4 class="fw-bold mb-0">Data Peserta</h4>
    <a href="{{ route('peserta.create') }}" class="btn btn-warning fw-bold">+ Tambah</a>
</div>

<div class="card p-4">
    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-10"><input type="text" name="cari" value="{{ request('cari') }}" class="form-control bg-dark text-light border-secondary" placeholder="Cari..."></div>
        <div class="col-md-2"><button class="btn btn-warning w-100">Cari</button></div>
    </form>

    <table class="table table-dark table-hover align-middle mb-0">
        <thead><tr><th>No</th><th>NIK</th><th>Nama</th><th>Skema</th><th>Tanggal</th><th class="text-center">Aksi</th></tr></thead>
        <tbody>
        @forelse($pesertas as $i => $p)
            <tr>
                <td>{{ $pesertas->firstItem() + $i }}</td>
                <td>{{ $p->nik }}</td>
                <td><b>{{ $p->nama }}</b><br><small class="text-secondary">{{ $p->email }}</small></td>
                <td>{{ $p->skema?->nama_skema ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($p->tanggal_daftar)->format('d M Y') }}</td>
                <td class="text-center">
                    <a href="{{ route('peserta.show', $p) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('peserta.edit', $p) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('peserta.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-secondary py-4">Belum ada data.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-3">{{ $pesertas->links() }}</div>
</div>
@endsection