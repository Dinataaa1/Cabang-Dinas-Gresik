@extends('layouts.admin')
@section('title', 'Tambah Agenda - Cabdin Gresik')
@section('content')

<div class="pf-header" style="margin-bottom:24px;">
    <div class="pf-header-icon" style="background:linear-gradient(135deg,#0b1f3f,#1e3a5f);"><i class="bi bi-calendar-plus"></i></div>
    <div>
        <h2 class="pf-header-title">Tambah Agenda Baru</h2>
        <p class="pf-header-sub">Masukkan jadwal acara yang akan datang</p>
    </div>
    <a href="{{ route('admin.agendas.index') }}" class="btn" style="margin-left:auto; background:white; border:1px solid #cbd5e1; text-decoration:none; color:#475569;">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <form action="{{ route('admin.agendas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display:grid; grid-template-columns: 2fr 1fr; gap:24px;">
            <div>
                <div class="form-group" style="margin-bottom:20px;">
                    <label style="display:block;font-size:13px;font-weight:600;margin-bottom:6px;color:#334155;">Judul Acara <span style="color:#ef4444">*</span></label>
                    <input type="text" name="title" required class="form-control" style="width:100%;padding:10px 14px;border:1px solid #cbd5e1;border-radius:8px;" placeholder="Contoh: Rapat Koordinasi Kepala Sekolah">
                </div>
                <div class="form-group" style="margin-bottom:20px;">
                    <label style="display:block;font-size:13px;font-weight:600;margin-bottom:6px;color:#334155;">Deskripsi (Opsional)</label>
                    <textarea name="description" class="form-control" rows="5" style="width:100%;padding:10px 14px;border:1px solid #cbd5e1;border-radius:8px;" placeholder="Keterangan lebih lanjut..."></textarea>
                </div>
            </div>
            <div>
                <div class="form-group" style="margin-bottom:20px;">
                    <label style="display:block;font-size:13px;font-weight:600;margin-bottom:6px;color:#334155;">Waktu Pelaksanaan</label>
                    <input type="datetime-local" name="event_date" class="form-control" style="width:100%;padding:10px 14px;border:1px solid #cbd5e1;border-radius:8px;">
                </div>
                <div class="form-group" style="margin-bottom:20px;">
                    <label style="display:block;font-size:13px;font-weight:600;margin-bottom:6px;color:#334155;">Lokasi Acara</label>
                    <input type="text" name="location" class="form-control" style="width:100%;padding:10px 14px;border:1px solid #cbd5e1;border-radius:8px;" placeholder="Contoh: Aula Cabdin Gresik">
                </div>
                <div class="form-group" style="margin-bottom:20px;">
                    <label style="display:block;font-size:13px;font-weight:600;margin-bottom:6px;color:#334155;">Gambar / Ikon (Opsional)</label>
                    <input type="file" name="cover_image" accept="image/*" class="form-control" style="width:100%;padding:8px 14px;border:1px solid #cbd5e1;border-radius:8px;">
                </div>
                <div class="form-group" style="margin-bottom:20px;">
                    <label style="display:block;font-size:13px;font-weight:600;margin-bottom:6px;color:#334155;">Status</label>
                    <select name="is_published" class="form-control" style="width:100%;padding:10px 14px;border:1px solid #cbd5e1;border-radius:8px;">
                        <option value="1">Tayang di Beranda</option>
                        <option value="0">Draft (Tersembunyi)</option>
                    </select>
                </div>
            </div>
        </div>
        <div style="margin-top:24px; padding-top:20px; border-top:1px solid #e2e8f0; text-align:right;">
            <button type="submit" class="btn btn-primary" style="padding:10px 24px; font-weight:600;">Simpan Agenda</button>
        </div>
    </form>
</div>
@endsection