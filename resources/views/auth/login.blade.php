<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background:#0a0a0a; color:#e4e4e7; }
        .card { background:#18181b; border-color:#27272a; }
        .form-control {
            background:#0a0a0a; color:#e4e4e7; border:1px solid #27272a;
        }
        .form-control:focus {
            background:#0a0a0a; color:#e4e4e7; border-color:#d4af37; box-shadow:none;
        }
        .form-label { color:#a1a1aa; }
        .text-warning { color:#d4af37 !important; }
        .btn-warning { background:#d4af37; border-color:#d4af37; color:#0a0a0a; font-weight:600; }
        .btn-warning:hover { background:#f4c430; border-color:#f4c430; color:#0a0a0a; }
        .alert-danger { background:#7f1d1d; color:#fca5a5; border-color:#991b1b; }
    </style>
</head>
<body class="d-flex align-items-center" style="min-height:100vh">
<div class="card mx-auto p-4" style="max-width:380px;width:100%">
    <h5 class="text-warning fw-bold text-center mb-4">
        <i class="bi bi-patch-check-fill me-1"></i>Aplikasi Sertifikasi
    </h5>

    @if($errors->any())
        <div class="alert alert-danger small py-2">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">@csrf
        <div class="mb-3">
            <label class="form-label small">Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email') }}" required autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label small">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-warning w-100">Masuk</button>
    </form>
</div>
</body>
</html>