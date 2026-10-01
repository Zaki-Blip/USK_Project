@extends('layouts.app')
@section('content')

<h4 class="fw-bold mb-3">Edit Skema</h4>

<div class="card p-3" style="max-width:600px">
    <form method="POST" action="{{ route('skema.update', $skema) }}">@csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Kode *</label>
            <input type="text" name="kode_skema" class="form-control" value="{{ old('kode_skema', $skema->kode_skema) }}">
            @error('kode_skema')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Nama *</label>
            <input type="text" name="nama_skema" class="form-control" value="{{ old('nama_skema', $skema->nama_skema) }}">
            @error('nama_skema')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $skema->deskripsi) }}</textarea>
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('skema.index') }}" class="btn btn-danger">Batal</a>
    </form>
</div>

@endsection