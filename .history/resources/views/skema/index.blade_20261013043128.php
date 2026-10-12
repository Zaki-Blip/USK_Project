@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold mb-0">Data Skema</h4>
    <a href="{{ route('skema.create') }}" class="btn btn-success">+ Tambah Skema</a>
</div>

<div class="card p-3">
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle mb-0">
            <thead class="table-success">
                <tr>
                    <th>No</th><th>Kode</th><th>Nama</th><th>Deskripsi</th><th>Peserta</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($skemas as $i => $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><span class="badge bg-success">{{ $s->kode_skema }}</span></td>
                    <td class="fw-bold">{{ $s->nama_skema }}</td>
                    <td><small class="text-muted">{{ \Str::limit($s->deskripsi, 50) ?: '-' }}</small></td>
                    <td class="text-center">
                        <a href="{{ route('skema.show', $s) }}" class="btn btn-sm btn-info text-white"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('skema.edit', $s) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('skema.destroy', $s) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus data ini?')">@csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>


</div>

@endsection
