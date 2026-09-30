@extends('layouts.app')
@section('title', 'Data Skema')
@section('content')

<div class="d-flex justify-content-between mb-3">
    <h4 class="fw-bold mb-0">Data Skema</h4>
    <a href="{{ route('skema.create') }}" class="btn btn-warning fw-bold">+ Tambah</a>
</div>

<div class="card p-4">
    <table class="table table-dark table-hover align-middle mb-0">
        <thead><tr><th>No</th><th>Kode</th><th>Nama</th><th>Deskripsi</th><th>Peserta</th><th class="text-center">Aksi</th></tr></thead>
        <tbody>
        @forelse($skemas as $i => $s)
            <tr>
                <td>{{ $skemas->firstItem() + $i }}</td>
                <td class="text-warning">{{ $s->kode_skema }}</td>
                <td class="fw-bold">{{ $s->nama_skema }}</td>
                <td><small class="text-secondary">{{ \Str::limit($s->deskripsi, 50) ?: '-' }}</small></td>
                <td>{{ $s->pesertas_count }} orang</td>
                <td class="text-center">
                    <a href="{{ route('skema.show', $s) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('skema.edit', $s) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('skema.destroy', $s) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-secondary py-4">Belum ada data.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-3">{{ $skemas->links() }}</div>
</div>
@endsection