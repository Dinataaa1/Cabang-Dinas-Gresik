<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - Cabdin Gresik</title>

      <!-- Favicon / Tab Icons (Logo Provinsi Jawa Timur) -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-jatim.svg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo-jatim-32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/logo-jatim-192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- CSS Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="login-page">

    <div class="login-card">
        <div class="login-header">
            <div class="logo-placeholder" style="margin: 0 auto 15px;">CDP</div>
            <h3>LOGIN ADMIN</h3>
            <p>Cabang Dinas Pendidikan Wilayah Gresik</p>
        </div>

        <!-- NOTIFIKASI ERROR -->
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email..." value="{{ old('email') }}" required autofocus>
            </div>
            
            <div class="form-group" style="margin-bottom: 25px;">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password..." required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-weight: 700; background-color: var(--primary);">
                Masuk ke Dashboard
            </button>
        </form>

        <div style="text-align: center; margin-top: 25px;">
            <a href="{{ route('home') }}" style="font-size: 12px; color: var(--text-muted); font-weight: 600;">
                ← Kembali ke Beranda Publik
            </a>
        </div>
    </div>

</body>
</html>
