@extends('layouts.admin')

@section('title', 'Kelola Admin - CMS Cabdin Gresik')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <div>
        <h2 style="font-size: 22px; font-weight: 800; color: var(--primary); display: inline-flex; align-items: center; gap: 8px;">
            <i class="bi bi-people-fill"></i> Kelola Akun Admin
        </h2>
        <p style="font-size: 13px; color: var(--text-muted);">Daftar pengguna yang memiliki hak akses untuk mengelola konten website (CRUD).</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 6px;">
        <i class="bi bi-person-plus-fill"></i> Tambah Admin Baru
    </a>
</div>

@if (session('error'))
    <div class="alert alert-danger" style="margin-bottom: 20px;">
        <i class="bi bi-exclamation-triangle-fill" style="margin-right: 6px;"></i> {{ session('error') }}
    </div>
@endif

<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 80px;">No</th>
                <th>Nama Administrator</th>
                <th>Email</th>
                <th>Terdaftar Pada</th>
                <th style="width: 180px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $u)
                <tr>
                    <td>{{ $users->firstItem() + $index }}</td>
                    <td style="font-weight: 700; color: var(--primary);">
                        {{ $u->name }}
                        @if($u->id === Auth::id())
                            <span class="badge badge-info" style="margin-left: 5px; font-size: 9px; padding: 2px 5px; background-color: rgba(13, 148, 136, 0.15); color: var(--secondary);">Anda</span>
                        @endif
                        @if($u->email === 'admin@gmail.com')
                            <span class="badge badge-warning" style="margin-left: 5px; font-size: 9px; padding: 2px 5px; background-color: rgba(217, 119, 6, 0.15); color: var(--accent);">Master</span>
                        @endif
                    </td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->created_at->format('d M Y H:i') }}</td>
                    <td style="text-align: center;">
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-secondary" style="padding: 6px 10px; font-size: 12px; display: inline-flex; align-items: center; gap: 4px;">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            
                            @if($u->id !== Auth::id() && $u->email !== 'admin@gmail.com')
                                <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus administrator ini?')" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 6px 10px; font-size: 12px; display: inline-flex; align-items: center; gap: 4px;">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-danger" style="padding: 6px 10px; font-size: 12px; opacity: 0.4; cursor: not-allowed; display: inline-flex; align-items: center; gap: 4px;" disabled title="Akun ini tidak dapat dihapus">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 30px;">Belum ada admin lain terdaftar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($users->hasPages())
    <div style="margin-top: 20px; display: flex; justify-content: center;">
        {{ $users->links('vendor.pagination.custom') }}
    </div>
@endif
@endsection
