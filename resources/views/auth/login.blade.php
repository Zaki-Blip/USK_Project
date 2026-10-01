<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="min-height:100vh">

<div class="card shadow-sm mx-auto p-4" style="max-width:400px;width:100%">
    <h5 class="text-center text-dark fw-bold mb-4">
        <i class="bi bi-patch-check-fill me-1"></i>Aplikasi Sertifikasi
    </h5>

    @if($errors->any())
        <div class="alert alert-danger py-2 small">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">@csrf
        <div class="mb-3">
            <label class="form-label fw-bold">Email*</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Password*</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-success w-100">Masuk</button>
    </form>
</div>

</body>
</html>