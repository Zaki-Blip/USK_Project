<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang - Web Sertifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        html { scroll-behavior: smooth; }
        section { scroll-margin-top: 70px; } /* supaya judul tidak tertutup oleh navbar */
    </style>
</head>
<body class="bg-white">

<nav class="navbar navbar-expand-md bg-success sticky-top">
    <div class="container-fluid px-4">
        <a href="#beranda" class="navbar-brand fw-bold text-light">
            <i class="bi bi-patch-check-fill me-1"></i>Sertifikasi Siswa
        </a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto me-md-3">
                <li class="nav-item"><a class="nav-link text-light" href="#beranda">Beranda</a></li>
            </ul>
            <div class="d-flex gap-2 mt-2 mt-md-0">
                <a href="{{ route('login') }}" class="btn btn-light">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-light">Register</a>
            </div>
        </div>
    </div>
</nav>
@if(session('sukses'))
    <div class="alert alert-success text-center mb-0 rounded-0">{{ session('sukses') }}</div>
@endif
<section id="beranda" class="container text-start py-5">
    <div class="py-5">
        <i class="bi bi-patch-check-fill text-success" style="font-size: 4rem;"></i>
        <h4 class="text-success fw-bold">Selamat Datang Di Aplikasi</h4>
        <h1 class="display-3 fw-bold mt-3">Web Sertifikasi Siswa</h1>
        <p class="text-muted mb-0" style="max-width: 650px;">
            Web Sertifikasi Siswa adalah aplikasi untuk membantu mencatat dan mengelola
            data peserta serta skema sertifikasi. Dengan aplikasi ini, data tersimpan
            lebih rapi, mudah dicari, dan bisa diakses kapan saja.
        </p>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
