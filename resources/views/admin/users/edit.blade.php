@extends('layouts.admin')

@section('title', 'Edit Data Admin - CMS Cabdin Gresik')

@section('content')
<div style="margin-bottom: 25px;">
    <h2 style="font-size: 22px; font-weight: 800; color: var(--primary); display: inline-flex; align-items: center; gap: 8px;">
        <i class="bi bi-person-gear"></i> Edit Akun Admin
    </h2>
    <p style="font-size: 13px; color: var(--text-muted);">Ubah data profil administrator atau ganti kata sandinya.</p>
</div>

<div class="card" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; box-shadow: var(--shadow-md);">
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Alamat Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            <small style="display: block; margin-top: 5px; color: var(--text-muted); font-size: 11px;">Jika mengganti email, kredensial login admin akan berubah mengikuti email baru.</small>
        </div>

        <div style="margin: 25px 0 15px 0; border-top: 1px dashed var(--border); padding-top: 20px;">
            <h4 style="font-size: 14px; font-weight: 700; color: var(--primary); margin-bottom: 5px;">Ganti Kata Sandi (Opsional)</h4>
            <p style="font-size: 12px; color: var(--text-muted); margin-bottom: 15px;">Biarkan kolom kata sandi di bawah ini kosong jika Anda tidak ingin mengubahnya.</p>
        </div>

        <div class="form-group">
            <label for="password">Kata Sandi Baru</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Isi hanya jika ingin diganti (min. 6 karakter)">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Ulangi kata sandi baru">
        </div>

        <div style="display: flex; gap: 15px; margin-top: 30px; justify-content: flex-end; border-top: 1px solid var(--border); padding-top: 20px;">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; gap: 6px; padding: 10px 18px;">
                <i class="bi bi-x-circle"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 6px; padding: 10px 18px;">
                <i class="bi bi-check-circle-fill"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
