@extends('layouts.admin')

@section('title', 'Tambah Admin Baru - CMS Cabdin Gresik')

@section('content')
<div style="margin-bottom: 25px;">
    <h2 style="font-size: 22px; font-weight: 800; color: var(--primary); display: inline-flex; align-items: center; gap: 8px;">
        <i class="bi bi-person-plus-fill"></i> Tambah Admin Baru
    </h2>
    <p style="font-size: 13px; color: var(--text-muted);">Buat akun administrator baru untuk memberikan akses pengelolaan website.</p>
</div>

<div class="card" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; box-shadow: var(--shadow-md);">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Contoh: Ahmad Fauzi" required>
        </div>

        <div class="form-group">
            <label for="email">Alamat Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Contoh: fauzi@gmail.com" required>
            <small style="display: block; margin-top: 5px; color: var(--text-muted); font-size: 11px;">Email ini akan digunakan untuk login admin panel.</small>
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label for="password">Kata Sandi (Password)</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Minimal 6 karakter" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Kata Sandi</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Ulangi kata sandi" required>
        </div>

        <div style="display: flex; gap: 15px; margin-top: 30px; justify-content: flex-end; border-top: 1px solid var(--border); padding-top: 20px;">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; gap: 6px; padding: 10px 18px;">
                <i class="bi bi-x-circle"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 6px; padding: 10px 18px;">
                <i class="bi bi-check-circle-fill"></i> Simpan Admin
            </button>
        </div>
    </form>
</div>
@endsection
