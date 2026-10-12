@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>✏️ Edit Data Peserta</strong>
            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-secondary">
                ← Kembali
            </a>
        </div>

        <div class="card-body">

            {{-- Error global --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('peserta.update', $peserta->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- NIK (readonly, gak bisa diubah) --}}
                <div class="mb-3">
                    <label class="form-label">NIK</label>
                    <input type="text" class="form-control" value="{{ $peserta->nik }}" readonly>
                    <small class="text-muted">NIK tidak dapat diubah.</small>
                </div>

                {{-- Nama --}}
                <div class="mb-3">
                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text"
                           name="nama"
                           class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama', $peserta->nama) }}">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $peserta->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- No HP --}}
                <div class="mb-3">
                    <label class="form-label">No. HP</label>
                    <input type="text"
                           name="no_hp"
                           class="form-control @error('no_hp') is-invalid @enderror"
                           value="{{ old('no_hp', $peserta->no_hp) }}"
                           placeholder="08xxxxxxxxxx">
                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat"
                              rows="3"
                              class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $peserta->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Skema --}}
                <div class="mb-3">
                    <label class="form-label">Skema Sertifikasi <span class="text-danger">*</span></label>
                    <select name="skema_id"
                            class="form-select @error('skema_id') is-invalid @enderror">
                        <option value="">-- Pilih Skema --</option>
                        @foreach ($skemas as $skema)
                            <option value="{{ $skema->id }}"
                                {{ old('skema_id', $peserta->skema_id) == $skema->id ? 'selected' : '' }}>
                                {{ $skema->nama_skema }}
                            </option>
                        @endforeach
                    </select>
                    @error('skema_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tanggal Daftar --}}
                <div class="mb-3">
                    <label class="form-label">Tanggal Daftar <span class="text-danger">*</span></label>
                    <input type="date"
                           name="tanggal_daftar"
                           class="form-control @error('tanggal_daftar') is-invalid @enderror"
                           value="{{ old('tanggal_daftar', $peserta->tanggal_daftar) }}">
                    @error('tanggal_daftar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        💾 Simpan
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
