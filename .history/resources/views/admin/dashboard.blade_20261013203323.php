@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<h4 class="fw-bold mb-3">Dashboard</h4>

{{-- Statistik --}}
<div class="row g-3 mb-4">
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card p-3 h-100">
            <small class="text-muted">Total Peserta</small>
            <h2 class="text-success fw-bold mb-0">{{ $totalPeserta }}</h2>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="card p-3 h-100">
            <small class="text-muted">Total Skema</small>
            <h2 class="text-success fw-bold mb-0">{{ $totalSkema }}</h2>
        </div>
    </div>
</div>

{{-- Tabel Peserta --}}
<div class="card p-3">
    <h5 class="fw-bold mb-3">Daftar Peserta</h5>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle mb-0">
            <thead class="table-success">
                <tr>
                    <th style="width: 70px;">No</th>
                    <th>Nama</th>
                    <th>Skema</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pesertas as $i => $p)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->skema?->nama_skema ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-3">
                            Belum ada data peserta.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
