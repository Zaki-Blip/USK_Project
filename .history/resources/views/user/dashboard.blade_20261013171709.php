@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="card shadow-sm p-4 mb-4">
        <h4 class="fw-bold mb-1">Halo, {{ auth()->user()->name }}!</h4>
        <p class="text-muted mb-0">
            Selamat datang di Web Sertifikasi Siswa
        </p>
    </div>
    @if(! $peserta)
        <div class="card p-4 text-center">
            <h5 class="fw-bold mb-2">Selamat datang, {{ auth()->user()->name }}!</h5>
            <p class="text-muted mb-3">Biodata kamu belum diisi. Lengkapi dulu untuk mengikuti sertifikasi.</p>
            <div>
                <a href="{{ route('peserta.create') }}" class="btn btn-success">
                    <i class="bi bi-pencil-square me-1"></i>Isi Biodata
                </a>
            </div>
        </div>
    @else($peserta)
        <div class="card shadow-sm p-4">
            <table class="table table-borderless mb-0">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Data Saya</h5>
                </div>
                <tr>
                    <th style="width: 200px;">NIK</th>
                    <td>{{ $peserta->nik }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $peserta->nama }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $peserta->email }}</td>
                </tr>
                <tr>
                    <th>No. HP</th>
                    <td>{{ $peserta->no_hp }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $peserta->alamat }}</td>
                </tr>
                <tr>
                    <th>Skema Sertifikasi</th>
                    <td>{{ $peserta->skema?->nama_skema ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Daftar</th>
                    <td>{{ $peserta->tanggal_daftar }}</td>
                </tr>
            </table>
        </div>

    @else
        <div class="alert alert-warning mb-0">
            Data peserta untuk akun ini tidak ditemukan. Silakan hubungi admin.
        </div>
    @endif
@endsection
