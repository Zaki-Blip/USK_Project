@extends('layouts.app')
@section('content')

<h4 class="fw-bold mb-3">Dashboard</h4>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card p-3">
            <small class="text-muted">Total Peserta</small>
            <h2 class="text-success fw-bold mb-0">{{ $totalPeserta }}</h2>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-3">
            <small class="text-muted">Total Skema</small>
            <h2 class="text-success fw-bold mb-0">{{ $totalSkema }}</h2>
        </div>
    </div>
</div>

@endsection