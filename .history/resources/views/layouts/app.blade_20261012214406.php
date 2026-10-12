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
        <div class="container d-flex justify-content-between align-items-center">
            <span class="fw-bold text-light fs-5">
                <i class="bi bi-patch-check-fill me-2"></i>Sertifikasi Siswa
            </span>
            <div class="d-flex align-items-center gap-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-sm btn-dark fw-bold text-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Isi Content --}}
    <div class="container py-4" style="max-width: 900px;">
        @if(session('sukses'))
            <div class="alert alert-success">{{ session('sukses') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
