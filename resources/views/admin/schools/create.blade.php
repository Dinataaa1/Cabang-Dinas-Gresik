@extends('layouts.admin')

@section('title', 'Tambah Sekolah - Cabdin Gresik')

@section('content')

<div class="pf-header">
    <div class="pf-header-icon"><i class="bi bi-bank"></i></div>
    <div>
        <h2 class="pf-header-title">Tambah Data Sekolah</h2>
        <p class="pf-header-sub">Tambahkan data sekolah baru beserta statistik guru, siswa, dan jumlah prestasi.</p>
    </div>
</div>

<div class="pf-card">
    <form action="{{ route('admin.schools.store') }}" method="POST">
        @csrf
        <div class="pf-card-body">
            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="name">Nama Sekolah</label>
                    <input type="text" id="name" name="name" class="pf-textarea" style="height: 42px; min-height: 42px; padding: 6px 12px;"
                           placeholder="Contoh: SMA Negeri 1 Gresik" value="{{ old('name') }}" required>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="category">Kategori Jenjang</label>
                    <select id="category" name="category" class="pf-textarea" style="height: 42px; min-height: 42px; padding: 6px 12px;" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ $selectedCategory == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="status">Status</label>
                    <select id="status" name="status" class="pf-textarea" style="height: 42px; min-height: 42px; padding: 6px 12px;" required>
                        @foreach($statuses as $s)
                            <option value="{{ $s }}" {{ old('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 120px 1.5fr 1.5fr; gap: 16px; margin-bottom: 16px;">
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="npsn">NPSN</label>
                    <input type="text" id="npsn" name="npsn" class="pf-textarea" style="height: 42px; min-height: 42px; padding: 6px 12px;"
                           placeholder="8 digit" value="{{ old('npsn') }}">
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="address">Alamat Sekolah</label>
                    <input type="text" id="address" name="address" class="pf-textarea" style="height: 42px; min-height: 42px; padding: 6px 12px;"
                           placeholder="Jl. ... Kecamatan ... Gresik" value="{{ old('address') }}">
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="website">Website Sekolah <span class="pf-label-hint">(Opsional)</span></label>
                    <input type="text" id="website" name="website" class="pf-textarea" style="height: 42px; min-height: 42px; padding: 6px 12px;"
                           placeholder="https://sekolah.sch.id" value="{{ old('website') }}">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 16px;">
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="jumlah_guru">Jumlah Guru</label>
                    <input type="number" id="jumlah_guru" name="jumlah_guru" class="pf-textarea" style="height: 42px; min-height: 42px; padding: 6px 12px;"
                           value="{{ old('jumlah_guru', 0) }}" min="0" required>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="jumlah_tendik">Jumlah Tendik (Staf Administrasi)</label>
                    <input type="number" id="jumlah_tendik" name="jumlah_tendik" class="pf-textarea" style="height: 42px; min-height: 42px; padding: 6px 12px;"
                           value="{{ old('jumlah_tendik', 0) }}" min="0" required>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0;">
                    <label class="pf-label" for="jumlah_prestasi">Jumlah Prestasi</label>
                    <input type="number" id="jumlah_prestasi" name="jumlah_prestasi" class="pf-textarea" style="height: 42px; min-height: 42px; padding: 6px 12px;"
                           value="{{ old('jumlah_prestasi', 0) }}" min="0" required>
                </div>
            </div>

            <div style="border-top: 1px solid var(--border); padding-top: 16px; margin-top: 16px;">
                <h4 style="font-size: 13px; font-weight: 700; color: #0b1f3f; margin: 0 0 14px;"><i class="bi bi-mortarboard-fill"></i> Pembagian Siswa Kelas &amp; Gender</h4>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; background: #f8fafc; padding: 12px; border-radius: 8px; border: 1px solid #e2e8f0;">
                    <div class="pf-form-group" style="margin-bottom: 0;">
                        <label class="pf-label" for="siswa_x_l">Kelas X (Laki-laki)</label>
                        <input type="number" id="siswa_x_l" name="siswa_x_l" class="pf-textarea" style="height: 42px; min-height: 42px; padding: 6px 12px; background: #fff;"
                               value="{{ old('siswa_x_l', 0) }}" min="0" oninput="calculateTotalSiswa()" required>
                    </div>
                    <div class="pf-form-group" style="margin-bottom: 0;">
                        <label class="pf-label" for="siswa_x_p">Kelas X (Perempuan)</label>
                        <input type="number" id="siswa_x_p" name="siswa_x_p" class="pf-textarea" style="height: 42px; min-height: 42px; padding: 6px 12px; background: #fff;"
                               value="{{ old('siswa_x_p', 0) }}" min="0" oninput="calculateTotalSiswa()" required>
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; background: #f8fafc; padding: 12px; border-radius: 8px; border: 1px solid #e2e8f0;">
                    <div class="pf-form-group" style="margin-bottom: 0;">
                        <label class="pf-label" for="siswa_xi_l">Kelas XI (Laki-laki)</label>
                        <input type="number" id="siswa_xi_l" name="siswa_xi_l" class="pf-textarea" style="height: 42px; min-height: 42px; padding: 6px 12px; background: #fff;"
                               value="{{ old('siswa_xi_l', 0) }}" min="0" oninput="calculateTotalSiswa()" required>
                    </div>
                    <div class="pf-form-group" style="margin-bottom: 0;">
                        <label class="pf-label" for="siswa_xi_p">Kelas XI (Perempuan)</label>
                        <input type="number" id="siswa_xi_p" name="siswa_xi_p" class="pf-textarea" style="height: 42px; min-height: 42px; padding: 6px 12px; background: #fff;"
                               value="{{ old('siswa_xi_p', 0) }}" min="0" oninput="calculateTotalSiswa()" required>
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; background: #f8fafc; padding: 12px; border-radius: 8px; border: 1px solid #e2e8f0;">
                    <div class="pf-form-group" style="margin-bottom: 0;">
                        <label class="pf-label" for="siswa_xii_l">Kelas XII (Laki-laki)</label>
                        <input type="number" id="siswa_xii_l" name="siswa_xii_l" class="pf-textarea" style="height: 42px; min-height: 42px; padding: 6px 12px; background: #fff;"
                               value="{{ old('siswa_xii_l', 0) }}" min="0" oninput="calculateTotalSiswa()" required>
                    </div>
                    <div class="pf-form-group" style="margin-bottom: 0;">
                        <label class="pf-label" for="siswa_xii_p">Kelas XII (Perempuan)</label>
                        <input type="number" id="siswa_xii_p" name="siswa_xii_p" class="pf-textarea" style="height: 42px; min-height: 42px; padding: 6px 12px; background: #fff;"
                               value="{{ old('siswa_xii_p', 0) }}" min="0" oninput="calculateTotalSiswa()" required>
                    </div>
                </div>
                <div class="pf-form-group" style="margin-bottom: 0; max-width: 250px;">
                    <label class="pf-label" for="jumlah_siswa">Total Siswa (Terhitung Otomatis)</label>
                    <input type="number" id="jumlah_siswa" name="jumlah_siswa" class="pf-textarea" style="height: 42px; min-height: 42px; padding: 6px 12px; background: #f1f5f9; font-weight: 700; color: #475569;"
                           value="{{ old('jumlah_siswa', 0) }}" readonly>
                </div>
            </div>

            <script>
                function calculateTotalSiswa() {
                    let xl = parseInt(document.getElementById('siswa_x_l').value) || 0;
                    let xp = parseInt(document.getElementById('siswa_x_p').value) || 0;
                    let xil = parseInt(document.getElementById('siswa_xi_l').value) || 0;
                    let xip = parseInt(document.getElementById('siswa_xi_p').value) || 0;
                    let xiil = parseInt(document.getElementById('siswa_xii_l').value) || 0;
                    let xiip = parseInt(document.getElementById('siswa_xii_p').value) || 0;
                    document.getElementById('jumlah_siswa').value = xl + xp + xil + xip + xiil + xiip;
                }
                document.addEventListener('DOMContentLoaded', calculateTotalSiswa);
            </script>
        </div>

        <div class="pf-actions">
            <button type="submit" class="pf-btn-save"><i class="bi bi-floppy"></i> Simpan Data Sekolah</button>
            <a href="{{ route('admin.schools.index', ['category' => $selectedCategory]) }}" class="pf-btn-cancel"><i class="bi bi-arrow-left"></i> Batal</a>
        </div>
    </form>
</div>

@endsection