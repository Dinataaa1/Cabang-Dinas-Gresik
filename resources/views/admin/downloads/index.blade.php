@extends('layouts.admin')
@section('title', 'Kelola Unduhan - Cabdin Gresik')
@section('content')

<div class="pf-header">
    <div class="pf-header-icon"><i class="bi bi-download"></i></div>
    <div>
        <h2 class="pf-header-title">Kelola Pusat Unduhan</h2>
        <p class="pf-header-sub">Unggah dan kelola dokumen yang dapat diunduh oleh publik dari halaman Download.</p>
    </div>
</div>

{{-- Upload Form --}}
<div class="pf-card" style="margin-bottom:28px;">
    <div class="pf-card-header">
        <span class="pf-badge"><i class="bi bi-upload"></i></span>
        <div>
            <h3 class="pf-section-title">Unggah Dokumen Baru</h3>
            <p class="pf-section-sub">Format: PDF, DOC, DOCX, XLS, XLSX, ZIP · Maks 20MB per file</p>
        </div>
    </div>
    <div class="pf-card-body">
        <form action="{{ route('admin.downloads.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="display:grid;grid-template-columns:2fr 1fr;gap:16px;margin-bottom:16px;">
                <div class="pf-form-group" style="margin-bottom:0;">
                    <label class="pf-label" for="dl_title">Judul Dokumen</label>
                    <input type="text" id="dl_title" name="title" class="pf-textarea" style="min-height:42px;height:42px;padding:6px 12px;"
                           placeholder="Contoh: Formulir Permohonan Mutasi Guru" value="{{ old('title') }}" required>
                </div>
                <div class="pf-form-group" style="margin-bottom:0;">
                    <label class="pf-label" for="dl_category">Kategori</label>
                    <select id="dl_category" name="category" class="pf-textarea" style="min-height:42px;height:42px;padding:6px 12px;" required>
                        <option value="Formulir" {{ old('category')=='Formulir'?'selected':'' }}>Formulir</option>
                        <option value="Regulasi" {{ old('category')=='Regulasi'?'selected':'' }}>Regulasi / SK</option>
                        <option value="Laporan"  {{ old('category')=='Laporan' ?'selected':'' }}>Laporan</option>
                        <option value="Panduan"  {{ old('category')=='Panduan' ?'selected':'' }}>Panduan / SOP</option>
                        <option value="SKM"      {{ old('category')=='SKM'     ?'selected':'' }}>Template SKM</option>
                    </select>
                </div>
            </div>
            <div class="pf-form-group" style="margin-bottom:16px;">
                <label class="pf-label" for="dl_desc">Deskripsi Singkat <span class="pf-label-hint">Opsional</span></label>
                <input type="text" id="dl_desc" name="description" class="pf-textarea" style="min-height:42px;height:42px;padding:6px 12px;"
                       placeholder="Keterangan singkat tentang dokumen ini..." value="{{ old('description') }}">
            </div>
            <div class="pf-form-group" style="margin-bottom:20px;">
                <label class="pf-label" for="dl_file">File Dokumen</label>
                <input type="file" id="dl_file" name="file" class="pf-textarea" style="padding:8px 12px;cursor:pointer;" required
                       accept=".pdf,.doc,.docx,.xls,.xlsx,.zip">
            </div>
            <div class="pf-actions" style="margin-top:0;padding-top:0;border-top:none;">
                <button type="submit" class="pf-btn-save"><i class="bi bi-cloud-upload"></i> Unggah Dokumen</button>
            </div>
        </form>
    </div>
</div>

{{-- Daftar Download --}}
<div class="pf-card">
    <div class="pf-card-header">
        <span class="pf-badge"><i class="bi bi-list-ul"></i></span>
        <div>
            <h3 class="pf-section-title">Daftar Dokumen ({{ $downloads->count() }} file)</h3>
        </div>
    </div>
    <div class="pf-card-body" style="padding:0;">
        @if($downloads->isEmpty())
            <div style="text-align:center;padding:50px;color:#94a3b8;">
                <i class="bi bi-file-earmark-x" style="font-size:40px;display:block;margin-bottom:12px;"></i>
                <p>Belum ada dokumen. Upload dokumen pertama di atas.</p>
            </div>
        @else
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc;border-bottom:2px solid #e2e8f0;">
                    <th style="padding:12px 18px;text-align:left;font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;">Judul</th>
                    <th style="padding:12px 18px;text-align:left;font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;">Kategori</th>
                    <th style="padding:12px 18px;text-align:left;font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;">Ukuran</th>
                    <th style="padding:12px 18px;text-align:center;font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;">Unduhan</th>
                    <th style="padding:12px 18px;text-align:left;font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;">Tanggal</th>
                    <th style="padding:12px 18px;text-align:center;font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($downloads as $dl)
                @php
                    $ext = pathinfo($dl->file_name, PATHINFO_EXTENSION);
                    $iconClass = match(strtolower($ext)) {
                        'pdf'  => 'bi-file-earmark-pdf-fill text-danger',
                        'doc','docx' => 'bi-file-earmark-word-fill',
                        'xls','xlsx' => 'bi-file-earmark-excel-fill text-success',
                        'zip'  => 'bi-file-earmark-zip-fill text-warning',
                        default => 'bi-file-earmark-fill',
                    };
                @endphp
                <tr style="border-bottom:1px solid #f1f5f9;transition:background .15s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background=''">
                    <td style="padding:13px 18px;">
                        <div style="display:flex;align-items:center;gap:10px;">
                            <i class="bi {{ $iconClass }}" style="font-size:20px;"></i>
                            <div>
                                <p style="font-size:13px;font-weight:600;color:#0b1f3f;margin:0 0 2px;">{{ $dl->title }}</p>
                                @if($dl->description)
                                    <p style="font-size:11px;color:#94a3b8;margin:0;">{{ $dl->description }}</p>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td style="padding:13px 18px;">
                        <span style="background:#eff6ff;color:#1d4ed8;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;">{{ $dl->category }}</span>
                    </td>
                    <td style="padding:13px 18px;font-size:12px;color:#64748b;">{{ $dl->file_size ?? '-' }}</td>
                    <td style="padding:13px 18px;text-align:center;font-size:13px;font-weight:700;color:#0d9488;">{{ number_format($dl->download_count) }}</td>
                    <td style="padding:13px 18px;font-size:12px;color:#64748b;">{{ $dl->created_at->format('d M Y') }}</td>
                    <td style="padding:13px 18px;text-align:center;">
                        <form action="{{ route('admin.downloads.destroy', $dl) }}" method="POST" onsubmit="return confirm('Hapus dokumen ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:#fee2e2;border:none;padding:6px 12px;border-radius:7px;font-size:12px;font-weight:600;color:#dc2626;cursor:pointer;">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>

@endsection
