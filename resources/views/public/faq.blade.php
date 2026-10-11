@extends('layouts.public')

@section('title', 'Tanya Jawab (FAQ) - Cabdin Wilayah Kabupaten Gresik')

@section('content')

<!-- PAGE HEADER -->
<section class="page-header" style="background: linear-gradient(135deg, var(--primary), var(--primary-light)); color: white; padding: 40px 0; text-align: center; border-bottom: 4px solid var(--secondary);">
    <div class="container">
        <h2 style="font-size: 28px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">Tanya Jawab (FAQ)</h2>
        <div class="breadcrumb" style="font-size: 13.5px; color: rgba(255, 255, 255, 0.7); margin-top: 8px;">
            <a href="{{ route('home') }}" style="color: #93c5fd; font-weight: 600;">Beranda</a> / Tanya Jawab
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<section class="main-section" style="background-color: #f8fafc; padding: 40px 0;">
    <div class="container" style="max-width: 800px; margin: 0 auto; padding: 0 20px;">
        
        <!-- Search Box -->
        <div style="background: #ffffff; padding: 20px; border-radius: var(--radius-md); border: 1px solid var(--border); box-shadow: var(--shadow-sm); margin-bottom: 25px;">
            <h3 style="font-size: 15px; font-weight: 700; color: var(--primary); margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                <i class="bi bi-search text-secondary"></i> Cari Jawaban Anda
            </h3>
            <div style="position: relative;">
                <input type="text" id="faq-search" placeholder="Ketik kata kunci pertanyaan di sini (misal: mutasi, pengaduan)..." 
                       style="width: 100%; padding: 12px 15px 12px 42px; border: 1px solid var(--border); border-radius: var(--radius-sm); font-size: 14px; outline: none; transition: all 0.25s ease;">
                <i class="bi bi-search" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 15px;"></i>
            </div>
        </div>

        <!-- FAQ Container -->
        <div class="faq-list" style="display: flex; flex-direction: column; gap: 15px;">
            
            <!-- FAQ Item 1 -->
            <div class="faq-item" style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-md); overflow: hidden; box-shadow: var(--shadow-sm); transition: all 0.25s ease;">
                <button class="faq-trigger" style="width: 100%; text-align: left; background: none; border: none; padding: 18px 20px; display: flex; justify-content: space-between; align-items: center; cursor: pointer; outline: none; gap: 15px;">
                    <span class="faq-question" style="font-size: 15px; font-weight: 700; color: var(--primary); transition: color 0.2s ease;">
                        Apa saja wilayah kerja Cabang Dinas Wilayah Kabupaten Gresik?
                    </span>
                    <i class="bi bi-chevron-down faq-chevron" style="font-size: 14px; color: var(--text-muted); transition: transform 0.25s ease;"></i>
                </button>
                <div class="faq-answer-wrapper" style="max-height: 0; overflow: hidden; transition: max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: #fafbfc;">
                    <div style="padding: 20px; border-top: 1px solid var(--border); font-size: 14px; line-height: 1.7; color: var(--text-dark); text-align: justify;">
                        Cabang Dinas Pendidikan Wilayah Kabupaten Gresik memiliki wilayah kerja pembinaan, pengawasan, pelayanan administrasi sekolah menengah atas (SMA), sekolah menengah kejuruan (SMK), serta pendidikan khusus (SLB/PK-PLK) di seluruh wilayah administratif Kabupaten Gresik, Jawa Timur.
                    </div>
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="faq-item" style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-md); overflow: hidden; box-shadow: var(--shadow-sm); transition: all 0.25s ease;">
                <button class="faq-trigger" style="width: 100%; text-align: left; background: none; border: none; padding: 18px 20px; display: flex; justify-content: space-between; align-items: center; cursor: pointer; outline: none; gap: 15px;">
                    <span class="faq-question" style="font-size: 15px; font-weight: 700; color: var(--primary); transition: color 0.2s ease;">
                        Bagaimana cara mengajukan pengaduan atau aspirasi pelayanan publik?
                    </span>
                    <i class="bi bi-chevron-down faq-chevron" style="font-size: 14px; color: var(--text-muted); transition: transform 0.25s ease;"></i>
                </button>
                <div class="faq-answer-wrapper" style="max-height: 0; overflow: hidden; transition: max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: #fafbfc;">
                    <div style="padding: 20px; border-top: 1px solid var(--border); font-size: 14px; line-height: 1.7; color: var(--text-dark); text-align: justify;">
                        Anda dapat mengajukan pengaduan resmi melalui tombol **Hotline Pengaduan WhatsApp** yang tertera di bagian atas portal website ini, atau langsung datang ke seksi umum kantor Cabang Dinas Pendidikan Wilayah Kabupaten Gresik pada jam kerja operasional.
                    </div>
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="faq-item" style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-md); overflow: hidden; box-shadow: var(--shadow-sm); transition: all 0.25s ease;">
                <button class="faq-trigger" style="width: 100%; text-align: left; background: none; border: none; padding: 18px 20px; display: flex; justify-content: space-between; align-items: center; cursor: pointer; outline: none; gap: 15px;">
                    <span class="faq-question" style="font-size: 15px; font-weight: 700; color: var(--primary); transition: color 0.2s ease;">
                        Di mana lokasi kantor Cabang Dinas Pendidikan Kabupaten Gresik?
                    </span>
                    <i class="bi bi-chevron-down faq-chevron" style="font-size: 14px; color: var(--text-muted); transition: transform 0.25s ease;"></i>
                </button>
                <div class="faq-answer-wrapper" style="max-height: 0; overflow: hidden; transition: max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: #fafbfc;">
                    <div style="padding: 20px; border-top: 1px solid var(--border); font-size: 14px; line-height: 1.7; color: var(--text-dark); text-align: justify;">
                        Kantor kami berlokasi di Jl. Dr. Wahidin Sudirohusodo No.229, Kembangan, Gresik, Jawa Timur. Peta lokasi interaktif dapat Anda lihat di bagian bawah beranda atau halaman kontak kami.
                    </div>
                </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="faq-item" style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-md); overflow: hidden; box-shadow: var(--shadow-sm); transition: all 0.25s ease;">
                <button class="faq-trigger" style="width: 100%; text-align: left; background: none; border: none; padding: 18px 20px; display: flex; justify-content: space-between; align-items: center; cursor: pointer; outline: none; gap: 15px;">
                    <span class="faq-question" style="font-size: 15px; font-weight: 700; color: var(--primary); transition: color 0.2s ease;">
                        Jam berapa pelayanan tatap muka di kantor Cabang Dinas dibuka?
                    </span>
                    <i class="bi bi-chevron-down faq-chevron" style="font-size: 14px; color: var(--text-muted); transition: transform 0.25s ease;"></i>
                </button>
                <div class="faq-answer-wrapper" style="max-height: 0; overflow: hidden; transition: max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: #fafbfc;">
                    <div style="padding: 20px; border-top: 1px solid var(--border); font-size: 14px; line-height: 1.7; color: var(--text-dark); text-align: justify;">
                        Pelayanan administrasi tatap muka dibuka setiap hari Senin hingga Jumat, mulai pukul 07.30 s.d. 16.00 WIB (kecuali pada hari libur nasional atau cuti bersama).
                    </div>
                </div>
            </div>

            <!-- FAQ Item 5 -->
            <div class="faq-item" style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-md); overflow: hidden; box-shadow: var(--shadow-sm); transition: all 0.25s ease;">
                <button class="faq-trigger" style="width: 100%; text-align: left; background: none; border: none; padding: 18px 20px; display: flex; justify-content: space-between; align-items: center; cursor: pointer; outline: none; gap: 15px;">
                    <span class="faq-question" style="font-size: 15px; font-weight: 700; color: var(--primary); transition: color 0.2s ease;">
                        Bagaimana cara mendapatkan informasi mengenai data prestasi dan inovasi sekolah?
                    </span>
                    <i class="bi bi-chevron-down faq-chevron" style="font-size: 14px; color: var(--text-muted); transition: transform 0.25s ease;"></i>
                </button>
                <div class="faq-answer-wrapper" style="max-height: 0; overflow: hidden; transition: max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: #fafbfc;">
                    <div style="padding: 20px; border-top: 1px solid var(--border); font-size: 14px; line-height: 1.7; color: var(--text-dark); text-align: justify;">
                        Informasi mengenai inovasi dan prestasi sekolah dapat diakses secara terbuka melalui menu navigasi **Prestasi & Inovasi** di bagian atas website ini. Kategori ini menampilkan berbagai penghargaan dan kreasi dari siswa serta sekolah di wilayah Kabupaten Gresik.
                    </div>
                </div>
            </div>

            <!-- FAQ Item 6 -->
            <div class="faq-item" style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-md); overflow: hidden; box-shadow: var(--shadow-sm); transition: all 0.25s ease;">
                <button class="faq-trigger" style="width: 100%; text-align: left; background: none; border: none; padding: 18px 20px; display: flex; justify-content: space-between; align-items: center; cursor: pointer; outline: none; gap: 15px;">
                    <span class="faq-question" style="font-size: 15px; font-weight: 700; color: var(--primary); transition: color 0.2s ease;">
                        Bagaimana prosedur permohonan mutasi siswa (pindah sekolah)?
                    </span>
                    <i class="bi bi-chevron-down faq-chevron" style="font-size: 14px; color: var(--text-muted); transition: transform 0.25s ease;"></i>
                </button>
                <div class="faq-answer-wrapper" style="max-height: 0; overflow: hidden; transition: max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: #fafbfc;">
                    <div style="padding: 20px; border-top: 1px solid var(--border); font-size: 14px; line-height: 1.7; color: var(--text-dark); text-align: justify;">
                        Prosedur mutasi siswa tingkat SMA/SMK/SLB memerlukan surat rekomendasi dari sekolah asal, surat kesiapan menerima dari sekolah tujuan, serta berkas rapor pendukung lainnya. Dokumen tersebut kemudian dibawa ke seksi pelayanan umum kantor Cabang Dinas Pendidikan Gresik untuk diverifikasi dan diterbitkan surat rekomendasi mutasi resmi.
                    </div>
                </div>
            </div>

            <!-- Empty Search State -->
            <div id="faq-empty" style="display: none; text-align: center; padding: 40px 20px; color: var(--text-muted); font-size: 14px;">
                <i class="bi bi-info-circle" style="font-size: 32px; display: block; margin-bottom: 12px; color: #a1a1aa;"></i>
                Pertanyaan tidak ditemukan. Coba ketik kata kunci yang lain.
            </div>

        </div>

    </div>
</section>

<style>
/* CSS styles for premium hover and active accordions */
.faq-item:hover {
    border-color: var(--secondary) !important;
    box-shadow: 0 4px 15px rgba(13, 148, 136, 0.08) !important;
}
.faq-item.active {
    border-color: var(--secondary) !important;
    box-shadow: 0 4px 20px rgba(13, 148, 136, 0.1) !important;
}
.faq-item.active .faq-question {
    color: var(--secondary) !important;
}
.faq-item.active .faq-chevron {
    transform: rotate(180deg);
    color: var(--secondary) !important;
}
#faq-search:focus {
    border-color: var(--secondary) !important;
    box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Accordion Toggle Logic
    const triggers = document.querySelectorAll('.faq-trigger');
    triggers.forEach(trigger => {
        trigger.addEventListener('click', function() {
            const item = this.parentElement;
            const wrapper = item.querySelector('.faq-answer-wrapper');
            const isActive = item.classList.contains('active');

            // Close all other items
            document.querySelectorAll('.faq-item').forEach(el => {
                if (el !== item) {
                    el.classList.remove('active');
                    el.querySelector('.faq-answer-wrapper').style.maxHeight = '0';
                }
            });

            // Toggle current item
            if (isActive) {
                item.classList.remove('active');
                wrapper.style.maxHeight = '0';
            } else {
                item.classList.add('active');
                wrapper.style.maxHeight = wrapper.scrollHeight + 'px';
            }
        });
    });

    // Real-time Search Logic
    const searchInput = document.getElementById('faq-search');
    const faqItems = document.querySelectorAll('.faq-item');
    const emptyState = document.getElementById('faq-empty');

    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase().trim();
        let matches = 0;

        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question').textContent.toLowerCase();
            const answer = item.querySelector('.faq-answer-wrapper').textContent.toLowerCase();

            if (question.includes(query) || answer.includes(query)) {
                item.style.display = 'block';
                matches++;
            } else {
                item.style.display = 'none';
                // Also close it if it was open
                item.classList.remove('active');
                item.querySelector('.faq-answer-wrapper').style.maxHeight = '0';
            }
        });

        if (matches === 0) {
            emptyState.style.display = 'block';
        } else {
            emptyState.style.display = 'none';
        }
    });
});
</script>

@endsection
