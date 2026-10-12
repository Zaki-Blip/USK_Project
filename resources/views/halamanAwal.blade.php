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
                <li class="nav-item"><a class="nav-link text-light" href="#tentang">Tentang Aplikasi</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="#fitur">Fitur Utama</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="#cara">Cara Menggunakan</a></li>
            </ul>
            <div class="d-flex gap-2 mt-2 mt-md-0">
                <a href="{{ route('login') }}" class="btn btn-light">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-light">Register</a>
            </div>
        </div>
    </div>
</nav>

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
<section id="tentang" class="bg-light py-5">
    <div class="container text-center" style="max-width: 700px;">
        <i class="bi bi-info-circle-fill text-success" style="font-size: 2.5rem;"></i>
        <h3 class="fw-bold mt-3 mb-3">Tentang Aplikasi</h3>
        <p class="text-muted">
            Web Sertifikasi adalah aplikasi sederhana untuk membantu LSP mengelola data
            peserta dan skema sertifikasi siswa. Aplikasi ini dibuat agar pencatatan yang
            tadinya manual menjadi lebih cepat, rapi, dan mudah dicari.
        </p>
        <a href="{{ route('login') }}" class="btn btn-success px-4">Mulai Sekarang</a>
    </div>
</section>
<section id="fitur" class="bg-light py-5">
    <div class="container text-center">
        <h3 class="fw-bold mb-1">Fitur Utama</h3>
        <p class="text-muted mb-4">Tiga fitur yang tersedia di aplikasi ini</p>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm p-4">
                    <i class="bi bi-people-fill text-success" style="font-size: 2.5rem;"></i>
                    <h5 class="fw-bold mt-3">Data Peserta</h5>
                    <p class="text-muted mb-0">
                        Simpan dan kelola data peserta sertifikasi, mulai dari menambah,
                        mengubah, sampai menghapus data. Semua tersimpan rapi dalam satu tempat
                        sehingga mudah dicari kapan saja.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm p-4">
                    <i class="bi bi-journal-text text-success" style="font-size: 2.5rem;"></i>
                    <h5 class="fw-bold mt-3">Skema Sertifikasi</h5>
                    <p class="text-muted mb-0">
                        Atur daftar skema sertifikasi yang tersedia, misalnya nama skema dan
                        keterangannya. Skema ini nantinya dipilih untuk setiap peserta yang
                        mengikuti sertifikasi.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm p-4">
                    <i class="bi bi-bar-chart-fill text-success" style="font-size: 2.5rem;"></i>
                    <h5 class="fw-bold mt-3">Dashboard</h5>
                    <p class="text-muted mb-0">
                        Halaman ringkasan yang menampilkan gambaran data, seperti jumlah peserta
                        dan skema. Cocok untuk melihat kondisi terbaru tanpa membuka banyak halaman.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="cara" class="container text-center py-5">
    <h3 class="fw-bold mb-1">Cara Menggunakan</h3>
    <p class="text-muted mb-4">Ikuti tiga langkah mudah berikut</p>

    <div class="row g-4">
        <div class="col-md-4">
            <span class="badge bg-success rounded-circle fs-5 px-3 py-2">1</span>
            <h5 class="fw-bold mt-3">Daftar atau Login</h5>
            <p class="text-muted">
                Buat akun baru lewat tombol Register. Jika sudah punya akun,
                langsung masuk lewat tombol Login.
            </p>
        </div>
        <div class="col-md-4">
            <span class="badge bg-success rounded-circle fs-5 px-3 py-2">2</span>
            <h5 class="fw-bold mt-3">Isi Data</h5>
            <p class="text-muted">
                Setelah masuk, buka menu Skema untuk menambah skema sertifikasi,
                lalu menu Peserta untuk mengisi data peserta.
            </p>
        </div>
        <div class="col-md-4">
            <span class="badge bg-success rounded-circle fs-5 px-3 py-2">3</span>
            <h5 class="fw-bold mt-3">Pantau Hasilnya</h5>
            <p class="text-muted">
                Buka Dashboard untuk melihat ringkasan data yang sudah diisi,
                dan ubah datanya kapan saja jika ada perubahan.
            </p>
        </div>
    </div>
</section>



<div class="bg-success text-light text-center py-3">
    <small>LSP BNSP Asesor Kompetensi — 2026</small>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>