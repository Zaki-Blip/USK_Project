@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<h2>Dashboard</h2>
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Peserta</h5>
                <p class="display-4">{{ $totalPeserta }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Skema</h5>
                <p class="display-4">{{ $totalSkema }}</p>
            </div>
        </div>
    </div>
</div>
@endsection