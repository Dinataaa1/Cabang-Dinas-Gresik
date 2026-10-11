@extends('layouts.public')

@section('title', 'Pengaduan Masyarakat | Cabdin Wilayah Kab. Gresik')

@section('content')

<!-- PAGE HEADER -->
<section style="background: linear-gradient(135deg, var(--primary), var(--primary-light)); color: white; padding: 45px 0; text-align: center; border-bottom: 4px solid var(--secondary);">
    <div class="container">
        <div style="font-size: 42px; margin-bottom: 12px;"><i class="bi bi-chat-left-dots-fill" style="color: var(--accent-light);"></i></div>
        <h2 style="font-size: 26px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">Pengaduan Masyarakat</h2>
        <p style="font-size: 13.5px; color: rgba(255,255,255,0.7); margin-top: 6px;">
            Saluran komunikasi resmi untuk menyampaikan keluhan, laporan, saran, dan aspirasi pelayanan publik
        </p>
        <div style="font-size: 13.5px; color: rgba(255,255,255,0.6); margin-top: 10px;">
            <a href="{{ route('home') }}" style="color: #93c5fd; font-weight: 600;">Beranda</a> / Pengaduan Masyarakat
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<section class="main-section" style="background-color: #f8fafc; padding: 45px 0;">
    <div class="container" style="max-width: 920px; margin: 0 auto; padding: 0 20px;">

        <!-- Intro Text -->
        <div style="text-align: center; margin-bottom: 35px;">
            <h3 style="font-size: 19px; font-weight: 700; color: var(--primary); margin-bottom: 8px;">Kritik, Saran & Laporan Anda Membangun Kami</h3>
            <p style="font-size: 14px; line-height: 1.7; color: var(--text-dark); max-width: 700px; margin: 0 auto;">
                Cabang Dinas Pendidikan Wilayah Kabupaten Gresik berkomitmen untuk memberikan pelayanan publik yang prima, transparan, dan akuntabel. Jika Anda menemukan ketidaksesuaian pelayanan, pelanggaran, atau memiliki saran konstruktif, silakan laporkan melalui kanal resmi kami.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 35px;" class="grid-split">
            <!-- Left Card: Alur Pengaduan -->
            <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-md); padding: 25px; box-shadow: var(--shadow-sm);">
                <h4 style="font-size: 15px; font-weight: 700; color: var(--primary); margin-bottom: 18px; border-left: 4px solid var(--secondary); padding-left: 10px; display: flex; align-items: center; gap: 8px;">
                    <i class="bi bi-info-circle-fill" style="color: var(--secondary);"></i> Alur Laporan Pengaduan
                </h4>
                
                <div style="display: flex; flex-direction: column; gap: 16px;">
                    <div style="display: flex; gap: 12px; align-items: flex-start;">
                        <span style="background: rgba(30,58,95,0.1); color: var(--primary); font-weight: 700; border-radius: 50%; width: 26px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; flex-shrink: 0;">1</span>
                        <div>
                            <h5 style="font-size: 13.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 3px;">Kirim Pengaduan</h5>
                            <p style="font-size: 12.5px; color: var(--text-muted); line-height: 1.5;">Kirim pesan pengaduan melalui tombol WhatsApp Hotline di samping dengan format yang disediakan.</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 12px; align-items: flex-start;">
                        <span style="background: rgba(30,58,95,0.1); color: var(--primary); font-weight: 700; border-radius: 50%; width: 26px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; flex-shrink: 0;">2</span>
                        <div>
                            <h5 style="font-size: 13.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 3px;">Verifikasi & Analisis</h5>
                            <p style="font-size: 12.5px; color: var(--text-muted); line-height: 1.5;">Tim verifikator Cabdin Gresik akan meninjau kelengkapan laporan Anda dalam waktu maksimal 2x24 jam kerja.</p>
                        </div>
                    </div>

                    <div style="display: flex; gap: 12px; align-items: flex-start;">
                        <span style="background: rgba(30,58,95,0.1); color: var(--primary); font-weight: 700; border-radius: 50%; width: 26px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; flex-shrink: 0;">3</span>
                        <div>
                            <h5 style="font-size: 13.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 3px;">Tindak Lanjut</h5>
                            <p style="font-size: 12.5px; color: var(--text-muted); line-height: 1.5;">Laporan akan diteruskan ke kepala seksi terkait untuk penyelesaian masalah dan pemberian feedback resmi kepada pelapor.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Card: Hotline WhatsApp -->
            <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-md); padding: 25px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <h4 style="font-size: 15px; font-weight: 700; color: var(--primary); margin-bottom: 12px; border-left: 4px solid var(--secondary); padding-left: 10px; display: flex; align-items: center; gap: 8px;">
                        <i class="bi bi-whatsapp" style="color: #25d366;"></i> WhatsApp Hotline
                    </h4>
                    <p style="font-size: 13px; line-height: 1.6; color: var(--text-dark); margin-bottom: 16px;">
                        Hubungi kami langsung melalui tautan interaktif WhatsApp di bawah ini untuk melaporkan kendala pelayanan publik:
                    </p>
                    
                    <div style="background: #f8fafc; padding: 12px 14px; border-radius: var(--radius-sm); border: 1px solid var(--border); font-size: 12px; color: var(--text-dark); margin-bottom: 18px;">
                        <div style="font-weight: 700; color: var(--primary); margin-bottom: 6px;"><i class="bi bi-info-square-fill" style="margin-right: 4px;"></i> Format Laporan Pengaduan:</div>
                        <strong>NAMA:</strong> [Nama Lengkap Anda]<br>
                        <strong>ASAL:</strong> [Sekolah / Instansi / Alamat]<br>
                        <strong>KATEGORI:</strong> [Akademik / Sarana / Pendidik / Pelayanan]<br>
                        <strong>LAPORAN:</strong> [Isi Pengaduan Secara Detail]
                    </div>
                </div>

                <div style="text-align: center;">
                    <a href="https://wa.me/6281234567890?text=Halo%20Cabdin%20Gresik,%20saya%20ingin%20mengajukan%20pengaduan.%20Berikut%20detailnya:%0ANAMA:%20%0AASAL:%20%0AKATEGORI:%20%0ALAPORAN:%20" 
                       target="_blank" rel="noopener" class="wa-btn" style="display: inline-flex; align-items: center; justify-content: center; gap: 10px; background: #25d366; color: white; border: none; padding: 12px 28px; border-radius: var(--radius-sm); font-size: 14px; font-weight: 700; cursor: pointer; transition: all 0.25s ease; text-decoration: none; width: 100%;">
                        <i class="bi bi-whatsapp" style="font-size: 18px;"></i> Hubungi via WhatsApp
                    </a>
                </div>
            </div>
        </div>

        <!-- Kerahasiaan Info Box -->
        <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: var(--radius-md); padding: 18px 22px; display: flex; gap: 15px; align-items: flex-start; animation: pulseGlow 3s infinite ease-in-out;">
            <i class="bi bi-shield-lock-fill" style="font-size: 24px; color: #2563eb; flex-shrink: 0; margin-top: 1px;"></i>
            <div>
                <h4 style="font-size: 14px; font-weight: 700; color: #1e3a8a; margin-bottom: 4px;">Jaminan Kerahasiaan & Keamanan Pelapor</h4>
                <p style="font-size: 12.5px; line-height: 1.6; color: #1e40af;">
                    Kami menjamin kerahasiaan identitas pribadi Anda selaku pelapor (Whistleblower) sepenuhnya. Informasi yang Anda sampaikan dilindungi dan hanya akan digunakan untuk proses investigasi internal yang objektif.
                </p>
            </div>
        </div>

    </div>
</section>

<style>
.wa-btn:hover {
    background: #20ba5a !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(37,211,102,0.35);
}
@media (max-width: 768px) {
    .grid-split {
        grid-template-columns: 1fr !important;
    }
}
@keyframes pulseGlow {
    0%, 100% { box-shadow: 0 0 0 0px rgba(37,99,235,0); }
    50% { box-shadow: 0 0 15px 2px rgba(37,99,235,0.12); }
}
</style>

@endsection
