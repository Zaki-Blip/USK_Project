@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold mb-0">Detail Skema</h4>
    <a href="{{ route('skema.index') }}" class="btn btn-sm btn-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row g-3">

    <div class="col-md-5">
        <div class="card p-3">
            <small class="text-muted">Kode Skema</small>
            <h5 class="text-success fw-bold">{{ $skema->kode_skema }}</h5>

            <small class="text-muted">Nama Skema</small>
            <h6 class="fw-bold">{{ $skema->nama_skema }}</h6>

            <small class="text-muted">Deskripsi</small>
            <p class="small">{{ $skema->deskripsi ?: '-' }}</p>

            <small class="text-muted">Total Peserta</small>
            <h5 class="text-success fw-bold">{{ $skema->pesertas->count() }} orang</h5>

            <hr>

            <a href="{{ route('skema.edit', $skema) }}" class="btn btn-warning w-100">
                <i class="bi bi-pencil me-1"></i>Edit Skema
            </a>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card p-3">
            <h6 class="fw-bold mb-3">
                <i class="bi bi-people me-1"></i>Peserta yang Mengikuti Skema Ini
            </h6>

            @if($skema->pesertas->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th><th>NIK</th><th>Nama</th><th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($skema->pesertas as $i => $p)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $p->nik }}</td>
                                    <td>{{ $p->nama }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('peserta.show', $p) }}" class="btn btn-sm btn-info text-white">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted text-center py-4 mb-0">
                    <i class="bi bi-inbox d-block mb-2" style="font-size:2rem"></i>
                    Belum ada peserta yang mengikuti skema ini.
                </p>
            @endif
        </div>
    </div>
</div>

@endsection