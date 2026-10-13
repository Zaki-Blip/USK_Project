
@extends('layouts.app')

@section('content')
<h4 class="fw-bold mb-3">Detail Skema</h4>

<div class="card p-3" style="max-width: 600px">
    <p>
        <strong>Kode Skema:</strong>
        {{ $skema->kode_skema }}
    </p>

    <p>
        <strong>Nama Skema:</strong>
        {{ $skema->nama_skema }}
    </p>

    <p>
        <strong>Deskripsi:</strong>
        {{ $skema->deskripsi ?: '-' }}
    </p>

    <a href="{{ route('skema.index') }}"
       class="btn btn-secondary">
        Kembali
    </a>
</div>
@endsection
