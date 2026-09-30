@extends('layouts.app')
@section('title', 'Detail Skema')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h4 class="fw-bold mb-0">Detail Skema</h4>
    <a href="{{ route('skema.index') }}" class="btn btn-sm btn-outline-warning">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row g-3">

    {{-- Info Skema --}}
    <div class="col-md-5">
        <div class="card p-4">
            <small class="text-secondary">Kode Skema</small>
            <h5 class="text-warning fw-bold mb-3">{{ $skema->kode_skema }}</h5>

            <small class="text-secondary">Nama Skema</small>
            <h6 class="fw-bold mb-3">{{ $skema->nama_skema }}</h6>

            <small class="text-secondary">Deskripsi</small>
            <p class="small mb-3">{{ $skema->deskripsi ?: '-' }}</p>

            <small class="text-secondary">Total Peserta</small>
            <h5 class="text-warning fw-bold mb-0">{{ $skema->pesertas->count() }} orang</h5>

            <hr class="border-secondary">

            <a href="{{ route('skema.edit', $skema) }}" class="btn btn-warning fw-bold w-100">
                <i class="bi bi-pencil me-1"></i>Edit Skema
            </a>
        </div>
    </div>

    {{-- Daftar Peserta yang Ikut Skema Ini --}}
    <div class="col-md-7">
        <div class="card p-4">
            <h6 class="fw-bold text-warning mb-3">
                <i class="bi bi-people-fill me-1"></i>Peserta yang Mengikuti Skema Ini
            </h6>

            @if($skema->pesertas->count() > 0)
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($skema->pesertas as $i => $p)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td class="text-warning">{{ $p->nik }}</td>
                                <td>{{ $p->nama }}</td>
                                <td class="text-center">
                                    <a href="{{ route('peserta.show', $p) }}"
                                       class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-secondary small text-center py-4 mb-0">
                    <i class="bi bi-inbox d-block mb-2" style="font-size:2rem"></i>
                    Belum ada peserta yang mengikuti skema ini.
                </p>
            @endif
        </div>
    </div>
</div>

@endsection