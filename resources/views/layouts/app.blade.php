<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Aplikasi Sertifikasi')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>

{{-- Navbar atas --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Aplikasi Sertifikasi</a>
        <div class="ms-auto d-flex align-items-center">
            <span class="text-white me-3">{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button class="btn btn-outline-light btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        {{-- Sidebar kiri --}}
        <nav class="col-md-2 bg-light min-vh-100 pt-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}"
                       href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('peserta.*') ? 'active fw-bold' : '' }}"
                       href="{{ route('peserta.index') }}">Data Peserta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('skema.*') ? 'active fw-bold' : '' }}"
                       href="{{ route('skema.index') }}">Data Skema</a>
                </li>
            </ul>
        </nav>

        {{-- Konten utama --}}
        <main class="col-md-10 pt-3">
            @if(session('sukses'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('sukses') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
@stack('scripts')
</body>
</html>