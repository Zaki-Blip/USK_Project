
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Web Sertifikasi')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @media (min-width: 768px) {
            #sidebar { min-height: calc(100vh - 64px); }
        }
    </style>
</head>
<body class="bg-light min-vh-100">

    {{-- Topbar --}}
    <div class="border-bottom bg-success p-3 shadow-sm">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                @if($isAdmin)
                    <button class="btn btn-sm btn-light d-md-none" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#sidebar">
                        <i class="bi bi-list"></i>
                    </button>
                @endif
                <span class="fw-bold text-light fs-5">
                    <i class="bi bi-patch-check-fill me-2"></i>Sertifikasi Siswa
                </span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-sm btn-dark fw-bold text-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <div class="d-flex">

        {{-- Sidebar (khusus admin) --}}
        @if($isAdmin)
            <aside id="sidebar" class="offcanvas-md offcanvas-start bg-white border-end flex-shrink-0"
                   tabindex="-1" style="width: 240px;">
                <div class="offcanvas-header d-md-none">
                    <h6 class="offcanvas-title fw-bold">Menu Admin</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebar"></button>
                </div>
                <div class="offcanvas-body p-0">
                    <nav class="nav nav-pills flex-column p-3 gap-1 w-100">
                        <a href="{{ route('dashboard') }}"
                           class="nav-link {{ request()->routeIs('dashboard') ? 'active bg-success' : 'text-dark' }}">
                            <i class="bi bi-speedometer2 me-2"></i>Dashboard
                        </a>
                        <a href="{{ route('peserta.index') }}"
                           class="nav-link {{ request()->routeIs('peserta.*') ? 'active bg-success' : 'text-dark' }}">
                            <i class="bi bi-people-fill me-2"></i>Data Peserta
                        </a>
                        <a href="{{ route('skema.index') }}"
                           class="nav-link {{ request()->routeIs('skema.*') ? 'active bg-success' : 'text-dark' }}">
                            <i class="bi bi-journal-text me-2"></i>Data Skema
                        </a>
                    </nav>
                </div>
            </aside>
        @endif

        {{-- Isi Content --}}
        <main class="flex-grow-1 p-4" style="min-width: 0;">
            <div class="mx-auto" style="max-width: {{ $isAdmin ? '1100px' : '900px' }};">
                @if(session('sukses'))
                    <div class="alert alert-success">{{ session('sukses') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
