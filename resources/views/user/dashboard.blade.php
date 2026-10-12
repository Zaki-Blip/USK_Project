@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="card shadow-sm p-4 mb-4">
        <h4 class="fw-bold mb-1">Halo, {{ auth()->user()->name }}!</h4>
        <p class="text-muted mb-0">
            Selamat datang di Web Sertifikasi Siswa. Berikut data sertifikasi lu.
        </p>
    </div>

    @if($peserta)
        <div class="card shadow-sm p-4">
            <h6 class="fw-bold mb-3">
                <i class="bi bi-person-badge text-success me-1"></i>Data Saya
            </h6>
            <table class="table table-borderless mb-0">
                <tr>
                    <th style="width: 200px;">Nama</th>
                    <td>{{ $peserta->nama }}</td>
                </tr>
                <tr>
                    <th>Email Akun</th>
                    <td>{{ auth()->user()->email }}</td>
                </tr>
                <tr>
                    <th>Skema Sertifikasi</th>
                    <td>{{ $peserta->skema->nama ?? '-' }}</td>
                </tr>
                {{-- Tambahkan kolom lain milik peserta di sini, misalnya: --}}
                {{-- <tr><th>No. Telepon</th><td>{{ $peserta->telepon }}</td></tr> --}}
            </table>
        </div>
    @else
        <div class="alert alert-warning mb-0">
            Data peserta untuk akun ini belum dihubungkan. Silakan hubungi admin.
        </div>
    @endif
@endsection