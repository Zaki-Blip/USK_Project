@extends('layouts.app')
@section('title', 'Tambah Skema')
@section('content')

<h4 class="fw-bold mb-3">Tambah Skema</h4>

<div class="card p-4" style="max-width:600px">
<form method="POST" action="{{ route('skema.store') }}">@csrf
    <div class="mb-2"><label class="small">Kode *</label>
        <input type="text" name="kode_skema" class="form-control bg-dark text-light border-secondary" value="{{ old('kode_skema') }}">
        @error('kode_skema')<small class="text-danger">{{ $message }}</small>@enderror</div>
    <div class="mb-2"><label class="small">Nama *</label>
        <input type="text" name="nama_skema" class="form-control bg-dark text-light border-secondary" value="{{ old('nama_skema') }}">
        @error('nama_skema')<small class="text-danger">{{ $message }}</small>@enderror</div>
    <div class="mb-3"><label class="small">Deskripsi</label>
        <textarea name="deskripsi" rows="3" class="form-control bg-dark text-light border-secondary">{{ old('deskripsi') }}</textarea></div>
    <button class="btn btn-warning fw-bold">Simpan</button>
    <a href="{{ route('skema.index') }}" class="btn btn-outline-warning">Batal</a>
</form>
</div>
@endsection