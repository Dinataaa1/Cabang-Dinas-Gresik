@extends('layouts.public')

@section('title', 'SKM - Survei Kepuasan Masyarakat | Cabdin Wilayah Kab. Gresik')

@section('content')

<!-- PAGE HEADER -->
<section style="background: linear-gradient(135deg, var(--primary), var(--primary-light)); color: white; padding: 40px 0; text-align: center; border-bottom: 4px solid var(--secondary);">
    <div class="container">
        <div style="font-size: 40px; margin-bottom: 12px;"><i class="bi bi-clipboard2-check-fill" style="color: var(--accent-light);"></i></div>
        <h2 style="font-size: 26px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">Survei Kepuasan Masyarakat</h2>
        <p style="font-size: 13.5px; color: rgba(255,255,255,0.7); margin-top: 6px;">
            Bantu kami meningkatkan kualitas pelayanan Cabang Dinas Pendidikan Wilayah Kab. Gresik
        </p>
        <div style="font-size: 13.5px; color: rgba(255,255,255,0.6); margin-top: 10px;">
            <a href="{{ route('home') }}" style="color: #93c5fd; font-weight: 600;">Beranda</a> / SKM
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<section class="main-section" style="background-color: #f8fafc; padding: 40px 0;">
    <div class="container" style="max-width: 860px; margin: 0 auto; padding: 0 20px;">

        <!-- Info Box -->
        <div style="background: #ffffff; border: 1px solid var(--border); border-left: 5px solid var(--secondary); border-radius: var(--radius-md); padding: 20px 22px; box-shadow: var(--shadow-sm); margin-bottom: 28px; display: flex; gap: 16px; align-items: flex-start;">
            <i class="bi bi-info-circle-fill" style="font-size: 22px; color: var(--secondary); flex-shrink: 0; margin-top: 2px;"></i>
            <div>
                <h3 style="font-size: 14.5px; font-weight: 700; color: var(--primary); margin-bottom: 6px;">Apa itu SKM?</h3>
                <p style="font-size: 13.5px; line-height: 1.7; color: var(--text-dark);">
                    Survei Kepuasan Masyarakat (SKM) adalah kegiatan pengukuran secara komprehensif tentang tingkat kepuasan masyarakat terhadap kualitas layanan yang diberikan oleh penyelenggara pelayanan publik, sesuai <strong>Permenpan RB No. 14 Tahun 2017</strong>.
                    Hasil SKM digunakan sebagai bahan evaluasi dan perbaikan layanan kami ke depan.
                </p>
            </div>
        </div>

        @if(session('success'))
            <div style="background:#dcfce7;border:1px solid #86efac;border-radius:var(--radius-sm);padding:16px 20px;margin-bottom:20px;display:flex;align-items:center;gap:12px;">
                <i class="bi bi-check-circle-fill" style="font-size:20px;color:#16a34a;flex-shrink:0;"></i>
                <div>
                    <p style="font-size:14px;font-weight:700;color:#15803d;margin:0 0 3px;">Survei Terkirim!</p>
                    <p style="font-size:13px;color:#16a34a;margin:0;">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div style="background:#fef2f2;border:1px solid #fca5a5;border-radius:var(--radius-sm);padding:16px 20px;margin-bottom:20px;">
                <p style="font-size:13.5px;font-weight:700;color:#dc2626;margin:0 0 8px;"><i class="bi bi-exclamation-triangle-fill"></i> Mohon perbaiki kesalahan berikut:</p>
                <ul style="margin:0;padding-left:20px;font-size:13px;color:#dc2626;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- SKM Form Card --}}
        <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-md); padding: 30px; box-shadow: var(--shadow-sm);">
            <h3 style="font-size: 17px; font-weight: 700; color: var(--primary); margin-bottom: 6px; display: flex; align-items: center; gap: 10px; border-left: 4px solid var(--secondary); padding-left: 12px;">
                <i class="bi bi-pencil-square"></i> Formulir Survei Kepuasan
            </h3>
            <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 24px; padding-left: 16px;">Mohon isi seluruh bagian formulir dengan jujur dan lengkap. Data identitas Anda bersifat rahasia dan hanya digunakan untuk keperluan statistik.</p>

            <form id="skm-form" action="{{ route('skm.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 22px;">
                @csrf

                {{-- ─── SECTION 1: DATA DIRI / BIODATA ─── --}}
                <div style="background: linear-gradient(135deg, #f0f9ff, #e0f2fe); border: 1px solid #bae6fd; border-radius: 12px; padding: 22px 24px;">
                    <h4 style="font-size: 14.5px; font-weight: 700; color: var(--primary); margin: 0 0 18px; display: flex; align-items: center; gap: 8px;">
                        <span style="background: var(--primary); color: white; border-radius: 50%; width: 26px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700;">1</span>
                        Data Diri Responden
                    </h4>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        {{-- Nama Lengkap --}}
                        <div class="skm-field" style="grid-column: 1 / -1;">
                            <label class="skm-label">Nama Lengkap <span style="color:#dc2626;">*</span></label>
                            <input type="text" name="nama" class="skm-input" value="{{ old('nama') }}"
                                   placeholder="Masukkan nama lengkap Anda" required>
                        </div>
                        {{-- Jenis Kelamin --}}
                        <div class="skm-field">
                            <label class="skm-label">Jenis Kelamin <span style="color:#dc2626;">*</span></label>
                            <select name="jenis_kelamin" class="skm-input" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        {{-- Usia --}}
                        <div class="skm-field">
                            <label class="skm-label">Usia (Tahun) <span style="color:#dc2626;">*</span></label>
                            <input type="number" name="usia" class="skm-input" value="{{ old('usia') }}"
                                   placeholder="Contoh: 35" min="10" max="120" required>
                        </div>
                        {{-- Pendidikan Terakhir --}}
                        <div class="skm-field">
                            <label class="skm-label">Pendidikan Terakhir <span style="color:#dc2626;">*</span></label>
                            <select name="pendidikan" class="skm-input" required>
                                <option value="">-- Pilih --</option>
                                @foreach(['SD','SMP','SMA/SMK','Diploma (D1-D4)','Sarjana (S1)','Magister (S2)','Doktor (S3)','Lainnya'] as $p)
                                    <option value="{{ $p }}" {{ old('pendidikan') == $p ? 'selected' : '' }}>{{ $p }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Pekerjaan / Profesi --}}
                        <div class="skm-field">
                            <label class="skm-label">Pekerjaan / Profesi <span style="color:#dc2626;">*</span></label>
                            <input type="text" name="pekerjaan" class="skm-input" value="{{ old('pekerjaan') }}"
                                   placeholder="Contoh: Guru, PNS, Wiraswasta" required>
                        </div>
                        {{-- Jenis Layanan Diterima --}}
                        <div class="skm-field" style="grid-column: 1 / -1;">
                            <label class="skm-label">Jenis Layanan yang Diterima <span style="color:#dc2626;">*</span></label>
                            <select name="layanan_diterima" class="skm-input" required>
                                <option value="">-- Pilih Jenis Layanan --</option>
                                @if(isset($services) && $services->isNotEmpty())
                                    @foreach($services->groupBy('category') as $cat => $groupedServices)
                                        <optgroup label="{{ $cat }}">
                                            @foreach($groupedServices as $srv)
                                                <option value="{{ $srv->name }}" {{ old('layanan_diterima') == $srv->name ? 'selected' : '' }}>{{ $srv->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                @endif
                                <option value="Layanan Lainnya" {{ old('layanan_diterima') == 'Layanan Lainnya' ? 'selected' : '' }}>Layanan Lainnya</option>
                            </select>
                        </div>
                        {{-- Tanggal Pelayanan --}}
                        <div class="skm-field" style="grid-column: 1 / -1;">
                            <label class="skm-label">Tanggal / Periode Pelayanan <span style="color:#dc2626;">*</span></label>
                            <input type="date" name="tanggal_pelayanan" class="skm-input" value="{{ old('tanggal_pelayanan') }}"
                                   max="{{ date('Y-m-d') }}" required>
                            <small style="font-size: 11.5px; color: var(--text-muted); margin-top: 4px; display: block;">Pilih tanggal saat Anda menerima layanan dari Cabdin Gresik.</small>
                        </div>
                    </div>
                </div>

                {{-- ─── SECTION 2: PENILAIAN LAYANAN ─── --}}
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px 24px;">
                    <h4 style="font-size: 14.5px; font-weight: 700; color: var(--primary); margin: 0 0 18px; display: flex; align-items: center; gap: 8px;">
                        <span style="background: var(--secondary); color: white; border-radius: 50%; width: 26px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700;">2</span>
                        Penilaian Kualitas Pelayanan
                    </h4>
                    <p style="font-size: 12.5px; color: var(--text-muted); margin: -10px 0 18px; line-height: 1.6;">
                        Berikan penilaian jujur untuk setiap aspek layanan berikut. Penilaian Anda sangat berarti untuk peningkatan kualitas pelayanan kami.
                    </p>

                    <!-- Unsur 1 -->
                    <div class="skm-question" style="animation: fadeInUp 0.4s both; margin-bottom: 14px;">
                        <label style="font-size: 14px; font-weight: 600; color: var(--text-dark); display: block; margin-bottom: 10px;">
                            <span style="background: var(--primary); color: white; border-radius: 50%; width: 22px; height: 22px; display: inline-flex; align-items: center; justify-content: center; font-size: 11px; margin-right: 8px; font-weight: 700;">1</span>
                            Bagaimana penilaian Anda terhadap kesesuaian <strong>persyaratan</strong> pelayanan yang diberikan?
                        </label>
                        <div class="skm-options">
                            <label class="skm-radio"><input type="radio" name="q1" value="1" {{ old('q1')==1?'checked':'' }}> Tidak Sesuai</label>
                            <label class="skm-radio"><input type="radio" name="q1" value="2" {{ old('q1')==2?'checked':'' }}> Kurang Sesuai</label>
                            <label class="skm-radio"><input type="radio" name="q1" value="3" {{ old('q1')==3?'checked':'' }}> Sesuai</label>
                            <label class="skm-radio"><input type="radio" name="q1" value="4" {{ old('q1')==4?'checked':'' }}> Sangat Sesuai</label>
                        </div>
                    </div>

                    <!-- Unsur 2 -->
                    <div class="skm-question" style="animation: fadeInUp 0.5s both; margin-bottom: 14px;">
                        <label style="font-size: 14px; font-weight: 600; color: var(--text-dark); display: block; margin-bottom: 10px;">
                            <span style="background: var(--primary); color: white; border-radius: 50%; width: 22px; height: 22px; display: inline-flex; align-items: center; justify-content: center; font-size: 11px; margin-right: 8px; font-weight: 700;">2</span>
                            Bagaimana penilaian Anda terhadap kemudahan <strong>prosedur/alur</strong> pelayanan yang diberikan?
                        </label>
                        <div class="skm-options">
                            <label class="skm-radio"><input type="radio" name="q2" value="1" {{ old('q2')==1?'checked':'' }}> Tidak Mudah</label>
                            <label class="skm-radio"><input type="radio" name="q2" value="2" {{ old('q2')==2?'checked':'' }}> Kurang Mudah</label>
                            <label class="skm-radio"><input type="radio" name="q2" value="3" {{ old('q2')==3?'checked':'' }}> Mudah</label>
                            <label class="skm-radio"><input type="radio" name="q2" value="4" {{ old('q2')==4?'checked':'' }}> Sangat Mudah</label>
                        </div>
                    </div>

                    <!-- Unsur 3 -->
                    <div class="skm-question" style="animation: fadeInUp 0.6s both; margin-bottom: 14px;">
                        <label style="font-size: 14px; font-weight: 600; color: var(--text-dark); display: block; margin-bottom: 10px;">
                            <span style="background: var(--primary); color: white; border-radius: 50%; width: 22px; height: 22px; display: inline-flex; align-items: center; justify-content: center; font-size: 11px; margin-right: 8px; font-weight: 700;">3</span>
                            Bagaimana penilaian Anda terhadap <strong>kecepatan waktu</strong> penyelesaian pelayanan?
                        </label>
                        <div class="skm-options">
                            <label class="skm-radio"><input type="radio" name="q3" value="1" {{ old('q3')==1?'checked':'' }}> Tidak Cepat</label>
                            <label class="skm-radio"><input type="radio" name="q3" value="2" {{ old('q3')==2?'checked':'' }}> Kurang Cepat</label>
                            <label class="skm-radio"><input type="radio" name="q3" value="3" {{ old('q3')==3?'checked':'' }}> Cepat</label>
                            <label class="skm-radio"><input type="radio" name="q3" value="4" {{ old('q3')==4?'checked':'' }}> Sangat Cepat</label>
                        </div>
                    </div>

                    <!-- Unsur 4 -->
                    <div class="skm-question" style="animation: fadeInUp 0.7s both; margin-bottom: 14px;">
                        <label style="font-size: 14px; font-weight: 600; color: var(--text-dark); display: block; margin-bottom: 10px;">
                            <span style="background: var(--primary); color: white; border-radius: 50%; width: 22px; height: 22px; display: inline-flex; align-items: center; justify-content: center; font-size: 11px; margin-right: 8px; font-weight: 700;">4</span>
                            Bagaimana penilaian Anda terhadap <strong>biaya</strong> yang dikenakan dalam pelayanan?
                        </label>
                        <div class="skm-options">
                            <label class="skm-radio"><input type="radio" name="q4" value="1" {{ old('q4')==1?'checked':'' }}> Sangat Mahal</label>
                            <label class="skm-radio"><input type="radio" name="q4" value="2" {{ old('q4')==2?'checked':'' }}> Cukup Mahal</label>
                            <label class="skm-radio"><input type="radio" name="q4" value="3" {{ old('q4')==3?'checked':'' }}> Murah</label>
                            <label class="skm-radio"><input type="radio" name="q4" value="4" {{ old('q4')==4?'checked':'' }}> Gratis/Sesuai</label>
                        </div>
                    </div>

                    <!-- Unsur 5 -->
                    <div class="skm-question" style="animation: fadeInUp 0.8s both; margin-bottom: 14px;">
                        <label style="font-size: 14px; font-weight: 600; color: var(--text-dark); display: block; margin-bottom: 10px;">
                            <span style="background: var(--primary); color: white; border-radius: 50%; width: 22px; height: 22px; display: inline-flex; align-items: center; justify-content: center; font-size: 11px; margin-right: 8px; font-weight: 700;">5</span>
                            Bagaimana penilaian Anda terhadap <strong>hasil/kualitas</strong> pelayanan yang diterima?
                        </label>
                        <div class="skm-options">
                            <label class="skm-radio"><input type="radio" name="q5" value="1" {{ old('q5')==1?'checked':'' }}> Tidak Sesuai</label>
                            <label class="skm-radio"><input type="radio" name="q5" value="2" {{ old('q5')==2?'checked':'' }}> Kurang Sesuai</label>
                            <label class="skm-radio"><input type="radio" name="q5" value="3" {{ old('q5')==3?'checked':'' }}> Sesuai</label>
                            <label class="skm-radio"><input type="radio" name="q5" value="4" {{ old('q5')==4?'checked':'' }}> Sangat Sesuai</label>
                        </div>
                    </div>

                    <!-- Unsur 6 -->
                    <div class="skm-question" style="animation: fadeInUp 0.9s both; margin-bottom: 14px;">
                        <label style="font-size: 14px; font-weight: 600; color: var(--text-dark); display: block; margin-bottom: 10px;">
                            <span style="background: var(--primary); color: white; border-radius: 50%; width: 22px; height: 22px; display: inline-flex; align-items: center; justify-content: center; font-size: 11px; margin-right: 8px; font-weight: 700;">6</span>
                            Bagaimana penilaian Anda terhadap <strong>kompetensi petugas</strong> dalam memberikan pelayanan?
                        </label>
                        <div class="skm-options">
                            <label class="skm-radio"><input type="radio" name="q6" value="1" {{ old('q6')==1?'checked':'' }}> Tidak Kompeten</label>
                            <label class="skm-radio"><input type="radio" name="q6" value="2" {{ old('q6')==2?'checked':'' }}> Kurang Kompeten</label>
                            <label class="skm-radio"><input type="radio" name="q6" value="3" {{ old('q6')==3?'checked':'' }}> Kompeten</label>
                            <label class="skm-radio"><input type="radio" name="q6" value="4" {{ old('q6')==4?'checked':'' }}> Sangat Kompeten</label>
                        </div>
                    </div>

                    <!-- Unsur 7 -->
                    <div class="skm-question" style="animation: fadeInUp 1.0s both; margin-bottom: 14px;">
                        <label style="font-size: 14px; font-weight: 600; color: var(--text-dark); display: block; margin-bottom: 10px;">
                            <span style="background: var(--primary); color: white; border-radius: 50%; width: 22px; height: 22px; display: inline-flex; align-items: center; justify-content: center; font-size: 11px; margin-right: 8px; font-weight: 700;">7</span>
                            Bagaimana penilaian Anda terhadap <strong>sikap dan perilaku</strong> petugas pelayanan?
                        </label>
                        <div class="skm-options">
                            <label class="skm-radio"><input type="radio" name="q7" value="1" {{ old('q7')==1?'checked':'' }}> Tidak Sopan</label>
                            <label class="skm-radio"><input type="radio" name="q7" value="2" {{ old('q7')==2?'checked':'' }}> Kurang Sopan</label>
                            <label class="skm-radio"><input type="radio" name="q7" value="3" {{ old('q7')==3?'checked':'' }}> Sopan</label>
                            <label class="skm-radio"><input type="radio" name="q7" value="4" {{ old('q7')==4?'checked':'' }}> Sangat Sopan</label>
                        </div>
                    </div>

                    <!-- Unsur 8 -->
                    <div class="skm-question" style="animation: fadeInUp 1.1s both;">
                        <label style="font-size: 14px; font-weight: 600; color: var(--text-dark); display: block; margin-bottom: 10px;">
                            <span style="background: var(--primary); color: white; border-radius: 50%; width: 22px; height: 22px; display: inline-flex; align-items: center; justify-content: center; font-size: 11px; margin-right: 8px; font-weight: 700;">8</span>
                            Bagaimana penilaian Anda terhadap kondisi <strong>sarana dan prasarana</strong> pelayanan?
                        </label>
                        <div class="skm-options">
                            <label class="skm-radio"><input type="radio" name="q8" value="1" {{ old('q8')==1?'checked':'' }}> Sangat Buruk</label>
                            <label class="skm-radio"><input type="radio" name="q8" value="2" {{ old('q8')==2?'checked':'' }}> Kurang Baik</label>
                            <label class="skm-radio"><input type="radio" name="q8" value="3" {{ old('q8')==3?'checked':'' }}> Baik</label>
                            <label class="skm-radio"><input type="radio" name="q8" value="4" {{ old('q8')==4?'checked':'' }}> Sangat Baik</label>
                        </div>
                    </div>
                </div>

                {{-- ─── SECTION 3: SARAN ─── --}}
                <div style="border-top: 1px solid var(--border); padding-top: 18px; animation: fadeInUp 1.2s both;">
                    <label style="font-size: 14px; font-weight: 600; color: var(--text-dark); display: block; margin-bottom: 10px;">
                        <i class="bi bi-chat-left-text-fill" style="margin-right: 8px; color: var(--secondary);"></i>
                        Saran atau masukan untuk perbaikan pelayanan <span style="font-weight:400;color:var(--text-muted);">(opsional)</span>:
                    </label>
                    <textarea name="saran" rows="4" placeholder="Tuliskan saran atau masukan Anda di sini..."
                              style="width: 100%; padding: 12px 14px; border: 1px solid var(--border); border-radius: var(--radius-sm); font-size: 13.5px; font-family: inherit; resize: vertical; outline: none; transition: border-color 0.25s ease; box-sizing: border-box;">{{ old('saran') }}</textarea>
                </div>

                <!-- Submit -->
                <div style="text-align: center; padding-top: 8px;">
                    <button type="submit" style="background: var(--secondary); color: white; border: none; padding: 13px 40px; border-radius: var(--radius-sm); font-size: 14px; font-weight: 700; cursor: pointer; transition: all 0.25s ease; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="bi bi-send-fill"></i> Kirim Survei
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>

<style>
.skm-label {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--text-dark);
    display: block;
    margin-bottom: 6px;
}
.skm-input {
    width: 100%;
    padding: 10px 13px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: 13.5px;
    font-family: inherit;
    background: #fff;
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    box-sizing: border-box;
}
.skm-input:focus {
    border-color: var(--secondary);
    box-shadow: 0 0 0 3px rgba(13,148,136,0.12);
}
.skm-field { display: flex; flex-direction: column; }
.skm-question {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 18px 20px;
    transition: border-color 0.25s ease, box-shadow 0.25s ease;
}
.skm-question:hover {
    border-color: var(--secondary);
    box-shadow: 0 3px 12px rgba(13,148,136,0.08);
}
.skm-options {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}
.skm-radio {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 8px 16px;
    border: 1.5px solid var(--border);
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-dark);
    cursor: pointer;
    transition: all 0.2s ease;
    background: #fff;
}
.skm-radio:hover {
    border-color: var(--secondary);
    background: rgba(13,148,136,0.05);
    color: var(--secondary);
}
.skm-radio input[type="radio"] {
    accent-color: var(--secondary);
    width: 15px;
    height: 15px;
}
.skm-radio:has(input:checked) {
    border-color: var(--secondary);
    background: rgba(13,148,136,0.08);
    color: var(--secondary);
}
textarea:focus {
    border-color: var(--secondary) !important;
    box-shadow: 0 0 0 3px rgba(13,148,136,0.12);
}
button[type="submit"]:hover {
    background: var(--secondary-light) !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(13,148,136,0.3);
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}
@media (max-width: 640px) {
    .skm-field[style*="grid-column"] { grid-column: 1 / -1 !important; }
}
</style>

@endsection
