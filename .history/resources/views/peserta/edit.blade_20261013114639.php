@extends('layouts.app')
@section('content')

<h4 class="fw-bold mb-3">Edit Peserta</h4>

<div class="card p-3" style="max-width:700px">
    <form method="POST" action="{{ route('peserta.update', $peserta) }}">@csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">NIK</label>
                <input type="text" class="form-control" value="{{ $peserta->nik }}" disabled>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama *</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $peserta->nama) }}">
                @error('nama')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $peserta->email) }}">
                @error('email')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $peserta->no_hp) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Skema</label>
                <select name="skema_id" class="form-select">
                    @foreach($skemas as $s)
                        <option value="{{ $s->id }}" {{ old('skema_id', $peserta->skema_id) == $s->id ? 'selected' : '' }}>
                            {{ $s->kode_skema }} - {{ $s->nama_skema }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal_daftar" class="form-control"
                       value="{{ old('tanggal_daftar', $peserta->tanggal_daftar) }}">
            </div>
            <div class="col-12">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" rows="3" class="form-control">{{ old('alamat', $peserta->alamat) }}</textarea>
            </div>
        </div>
        <div class="mt-3">
            <button class="btn btn-success">Update</button>
            <a href="{{ route('peserta.index') }}" class="btn btn-danger">Batal</a>
        </div>
    </form>
</div>

@endsection
