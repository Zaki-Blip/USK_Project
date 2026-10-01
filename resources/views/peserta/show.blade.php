@extends('layouts.app')
@section('content')

<h4 class="fw-bold mb-3">Detail Peserta</h4>

<div class="card p-3" style="max-width:600px">
    <h5 class="fw-bold mb-1">{{ $peserta->nama }}</h5>
    <small class="fw-bold text-success d-block mb-3">{{ $peserta->skema?->nama_skema ?? '-' }}</small>

    <table class="table table-borderless mb-0">
        <tr><th width="150">NIK</th><td>{{ $peserta->nik }}</td></tr>
        <tr><th>Email</th><td>{{ $peserta->email }}</td></tr>
        <tr><th>No HP</th><td>{{ $peserta->no_hp ?: '-' }}</td></tr>
        <tr><th>Alamat</th><td>{{ $peserta->alamat ?: '-' }}</td></tr>
        <tr><th>Tanggal</th><td>{{ \Carbon\Carbon::parse($peserta->tanggal_daftar)->format('d F Y') }}</td></tr>
    </table>

    <div class="mt-3">
        <a href="{{ route('peserta.edit', $peserta) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('peserta.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@endsection