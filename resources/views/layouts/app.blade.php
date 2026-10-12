<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    .list-group-item.active {
        background-color: #198754;   
        border-color: #06110d;
        color: #fff;
    }
</style>
</head>
<body>

<div class="d-flex">

    <div class="border-end bg-light p-1" style="width: 220px; min-height: 100vh;">
        <h6 class="fw-bold mb-4 text-dark">
            <i class="bi bi-patch-check-fill me-2 m-4 p-1"></i>Sertifikasi Siswa
        </h6>   
        <div class="list-group list-group-flush">
            <a href="{{ route('dashboard') }}"
               class="list-group-item list-group-item-action border-0 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('peserta.index') }}"
               class="list-group-item list-group-item-action border-0 {{ request()->routeIs('peserta.*') ? 'active' : '' }}">
                Peserta
            </a>
            <a href="{{ route('skema.index') }}"
               class="list-group-item list-group-item-action border-0 {{ request()->routeIs('skema.*') ? 'active' : '' }}">
                Skema
            </a>
            <a href="{{ route('dashboard') }}" class="navbar-brand fw-bold">
            </a>
        </div>
    </div>

    <div class="flex-grow-1">

        {{-- Topbar --}}
        <div class="border-bottom bg-success p-3 d-flex justify-content-between align-items-center">
            <span class="fw-bold text-light ">@yield('title', 'Web Sertifikasi')</span>
            <div class="d-flex align-items-center gap-3">
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button class="btn fw-bold btn-dark text-danger">Logout</button>
                </form>
            </div>
        </div>

        {{-- Isi --}}
        <div class="p-4">
            @if(session('sukses'))
                <div class="alert alert-success">{{ session('sukses') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>