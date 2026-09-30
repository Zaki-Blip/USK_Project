<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Aplikasi Sertifikasi')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>body{background:#0a0a0a;color:#e4e4e7}.card{background:#18181b;border-color:#27272a}.table{color:#e4e4e7}</style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark border-bottom border-secondary px-4">
    <a class="navbar-brand text-warning fw-bold" href="{{ route('dashboard') }}">
        <i class="bi bi-patch-check-fill text-warning me-1"></i>Aplikasi Sertifikasi
    </a>
    <div class="d-flex align-items-center gap-3">
        <span class="text-secondary small"><i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}">@csrf
            <button class="btn btn-sm btn-primary">Logout</button>
        </form>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 bg-black p-3" style="min-height:calc(100vh - 60px)">
            <a href="{{ route('dashboard') }}" class="d-block p-2 mb-1 rounded text-decoration-none {{ request()->routeIs('dashboard') ? 'bg-warning text-dark' : 'text-secondary' }}"><i class="bi bi-grid-1x2-fill me-2"></i>Dashboard</a>
            <a href="{{ route('peserta.index') }}" class="d-block p-2 mb-1 rounded text-decoration-none {{ request()->routeIs('peserta.*') ? 'bg-warning text-dark' : 'text-secondary' }}"><i class="bi bi-people-fill me-2"></i>Peserta</a>
            <a href="{{ route('skema.index') }}" class="d-block p-2 mb-1 rounded text-decoration-none {{ request()->routeIs('skema.*') ? 'bg-warning text-dark' : 'text-secondary' }}"><i class="bi bi-award-fill me-2"></i>Skema</a>
        </nav>

        <main class="col-md-10 p-4">
            @if(session('sukses'))<div class="alert alert-success">{{ session('sukses') }}</div>@endif
            @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>