@extends('layouts.admin')

@section('title', 'Kelola Layanan Cabdin - Cabdin Gresik')

@section('content')

<div class="pf-header">
    <div class="pf-header-icon"><i class="bi bi-briefcase"></i></div>
    <div>
        <h2 class="pf-header-title">Layanan Cabdin</h2>
        <p class="pf-header-sub">Kelola kategori layanan publik (SMA, SMK, Tata Usaha), alur pengajuan, dan persyaratan.</p>
    </div>
</div>

<div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
    <a href="{{ route('admin.services.create') }}" class="pf-btn-save" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
        <i class="bi bi-plus-circle"></i> Tambah Layanan Baru
    </a>
</div>

<div class="pf-card" style="padding: 0; overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                <th style="padding: 12px 18px; text-align: left; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; width: 220px;">Nama Layanan</th>
                <th style="padding: 12px 18px; text-align: left; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; width: 140px;">Kategori</th>
                <th style="padding: 12px 18px; text-align: left; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase;">Deskripsi</th>
                <th style="padding: 12px 18px; text-align: center; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; width: 100px;">Syarat</th>
                <th style="padding: 12px 18px; text-align: center; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; width: 100px;">Prosedur</th>
                <th style="padding: 12px 18px; text-align: center; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; width: 180px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
                @php
                    $badgeStyle = match($service->category) {
                        'SMA' => 'background: #eff6ff; color: #1d4ed8;',
                        'SMK' => 'background: #effaf6; color: #0d9488;',
                        'Tata Usaha' => 'background: #f5f3ff; color: #7c3aed;',
                        default => 'background: #f1f5f9; color: #475569;'
                    };
                @endphp
                <tr style="border-bottom: 1px solid #f1f5f9; transition: background .15s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background=''">
                    <td style="padding: 14px 18px;">
                        <strong style="font-size: 13.5px; color: #0b1f3f;">{{ $service->name }}</strong>
                    </td>
                    <td style="padding: 14px 18px;">
                        <span style="padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; {{ $badgeStyle }}">
                            {{ $service->category }}
                        </span>
                    </td>
                    <td style="padding: 14px 18px; font-size: 12.5px; color: #64748b;">
                        <div style="max-height: 40px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; line-height: 1.4;">
                            {{ strip_tags($service->description) }}
                        </div>
                    </td>
                    <td style="padding: 14px 18px; text-align: center;">
                        <i class="bi {{ $service->requirements ? 'bi-check-circle-fill text-success' : 'bi-x-circle-fill text-warning' }}" style="font-size: 16px;"></i>
                    </td>
                    <td style="padding: 14px 18px; text-align: center;">
                        <i class="bi {{ $service->procedure ? 'bi-check-circle-fill text-success' : 'bi-x-circle-fill text-warning' }}" style="font-size: 16px;"></i>
                    </td>
                    <td style="padding: 14px 18px; text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 8px;">
                            <a href="{{ route('admin.services.edit', $service) }}" style="padding: 6px 12px; background: #fff8e6; border-radius: 8px; font-size: 12px; font-weight: 600; color: #d97706; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?');" style="margin: 0;">
                                @csrf @method('DELETE')
                                <button type="submit" style="padding: 6px 12px; background: #fee2e2; border: none; border-radius: 8px; font-size: 12px; font-weight: 600; color: #dc2626; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px; color: #94a3b8;">
                        <i class="bi bi-folder-x" style="font-size: 32px; display: block; margin-bottom: 10px;"></i>
                        Belum ada data layanan publik yang terdaftar.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @if($services->hasPages())
        <div style="padding: 16px 18px; border-top: 1px solid #e2e8f0;">
            {{ $services->links() }}
        </div>
    @endif
</div>

@endsection
