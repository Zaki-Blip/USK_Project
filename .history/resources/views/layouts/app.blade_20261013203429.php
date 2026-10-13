<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Web Sertifikasi')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light min-vh-100">

    {{-- Topbar --}}
    <div class="border-bottom bg-success p-3 shadow-sm">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <span class="fw-bold text-light fs-5">
                <i class="bi bi-patch-check-fill me-2"></i>Sertifikasi Siswa
            </span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-sm btn-dark fw-bold text-danger">Logout</button>
            </form>
        </div>
    </div>

    <div class="d-flex flex-column flex-md-row">

        {{-- Sidebar --}}
        <aside class="bg-white border-end p-3" style="min-width: 220px;">
            <nav class="nav nav-pills flex-column gap-1">

                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ request()->routeIs('dashboard') ? 'active bg-success' : 'text-dark' }}">
                    <i class="bi me-2"></i>Dashboard
                </a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('peserta.index') }}"
                    class="nav-link {{ request()->routeIs('peserta.*') ? 'active bg-success' : 'text-dark' }}">
                        <i class="bi me-2"></i>Peserta
                    </a>

                    <a href="{{ route('skema.index') }}"
                    class="nav-link {{ request()->routeIs('skema.*') ? 'active bg-success' : 'text-dark' }}">
                        <i class="bi me-2"></i>Skema
                    </a>
                @else
                    @if(auth()->user()->peserta)
                        <a href="{{ route('peserta.show', auth()->user()->peserta) }}"
                        class="nav-link {{ request()->routeIs('peserta.show') ? 'active bg-success' : 'text-dark' }}">
                            <i class="bi me-2"></i>Data Saya
                        </a>
                    @else
                        <a href="{{ route('peserta.create') }}"
                        class="nav-link {{ request()->routeIs('peserta.create') ? 'active bg-success' : 'text-dark' }}">
                            <i class="bi me-2"></i>Isi Biodata
                        </a>
                    @endif
                @endif

            </nav>
        </aside>

        {{-- Isi Content --}}
        <main class="flex-1 p-4" style="min-width: 0;">
            <div class="mx-auto" style="max-width: 1000px;">
                @if(session('sukses'))
                    <div class="alert alert-success">{{ session('sukses') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
               @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $pesan)
                                <li>{{ $pesan }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
