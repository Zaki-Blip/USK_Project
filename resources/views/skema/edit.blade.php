@extends('layouts.app')
@section('title', 'Edit Skema')
@section('content')

<h4 class="fw-bold mb-3">Edit Skema</h4>

<div class="card p-4" style="max-width:600px">
<form method="POST" action="{{ route('skema.update', $skema) }}">@csrf @method('PUT')
    <div class="mb-2"><label class="small">Kode *</label>
        <input type="text" name="kode_skema" class="form-control bg-dark text-light border-secondary" value="{{ old('kode_skema', $skema->kode_skema) }}">
        @error('kode_skema')<small class="text-danger">{{ $message }}</small>@enderror</div>
    <div class="mb-2"><label class="small">Nama *</label>
        <input type="text" name="nama_skema" class="form-control bg-dark text-light border-secondary" value="{{ old('nama_skema', $skema->nama_skema) }}">
        @error('nama_skema')<small class="text-danger">{{ $message }}</small>@enderror</div>
    <div class="mb-3"><label class="small">Deskripsi</label>
        <textarea name="deskripsi" rows="3" class="form-control bg-dark text-light border-secondary">{{ old('deskripsi', $skema->deskripsi) }}</textarea></div>
    <button class="btn btn-warning fw-bold">Update</button>
    <a href="{{ route('skema.index') }}" class="btn btn-outline-warning">Batal</a>
</form>
</div>
@endsection