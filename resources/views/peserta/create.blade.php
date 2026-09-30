@extends('layouts.app')
@section('title', 'Tambah Peserta')
@section('content')

<h4 class="fw-bold mb-3">Tambah Peserta</h4>

<div class="card p-4" style="max-width:700px">
<form method="POST" action="{{ route('peserta.store') }}">@csrf
    <div class="row g-3">
        <div class="col-md-6"><label class="small">NIK *</label>
            <input type="text" name="nik" maxlength="16" class="form-control bg-dark text-light border-secondary" value="{{ old('nik') }}">
            @error('nik')<small class="text-danger">{{ $message }}</small>@enderror</div>
        <div class="col-md-6"><label class="small">Nama *</label>
            <input type="text" name="nama" class="form-control bg-dark text-light border-secondary" value="{{ old('nama') }}">
            @error('nama')<small class="text-danger">{{ $message }}</small>@enderror</div>
        <div class="col-md-6"><label class="small">Email *</label>
            <input type="email" name="email" class="form-control bg-dark text-light border-secondary" value="{{ old('email') }}">
            @error('email')<small class="text-danger">{{ $message }}</small>@enderror</div>
        <div class="col-md-6"><label class="small">No HP</label>
            <input type="text" name="no_hp" class="form-control bg-dark text-light border-secondary" value="{{ old('no_hp') }}"></div>
        <div class="col-md-6"><label class="small">Skema *</label>
            <select name="skema_id" class="form-select bg-dark text-light border-secondary">
                <option value="">-- Pilih --</option>
                @foreach($skemas as $s)<option value="{{ $s->id }}" {{ old('skema_id')==$s->id?'selected':'' }}>{{ $s->kode_skema }} - {{ $s->nama_skema }}</option>@endforeach
            </select>
            @error('skema_id')<small class="text-danger">{{ $message }}</small>@enderror</div>
        <div class="col-md-6"><label class="small">Tanggal *</label>
            <input type="date" name="tanggal_daftar" class="form-control bg-dark text-light border-secondary" value="{{ old('tanggal_daftar', date('Y-m-d')) }}"></div>
        <div class="col-12"><label class="small">Alamat</label>
            <textarea name="alamat" rows="3" class="form-control bg-dark text-light border-secondary">{{ old('alamat') }}</textarea></div>
    </div>
    <div class="mt-3">
        <button class="btn btn-warning fw-bold">Simpan</button>
        <a href="{{ route('peserta.index') }}" class="btn btn-outline-warning">Batal</a>
    </div>
</form>
</div>
@endsection