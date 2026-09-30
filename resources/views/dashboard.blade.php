@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<h4 class="fw-bold mb-4">Dashboard</h4>
<div class="row g-3">
    <div class="col-md-6"><div class="card p-4"><small class="text-secondary">Total Peserta</small><h2 class="text-warning fw-bold mb-0">{{ $totalPeserta }}</h2></div></div>
    <div class="col-md-6"><div class="card p-4"><small class="text-secondary">Total Skema</small><h2 class="text-warning fw-bold mb-0">{{ $totalSkema }}</h2></div></div>
</div>
@endsection