<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Cabdin Gresik')</title>
     <!-- Favicon / Tab Icons (Logo Provinsi Jawa Timur) -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-jatim.svg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo-jatim-32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/logo-jatim-192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    /* ════════════════════════════════════════════════════════
       ADMIN LAYOUT — PREMIUM DESIGN
    ════════════════════════════════════════════════════════ */
    *, *::before, *::after { box-sizing: border-box; }

    body { margin:0; font-family:'Inter','Segoe UI',system-ui,sans-serif; background:#f0f4f8; color:#374151; }

    /* ── Layout Shell ─────────────────────────────────────── */
    .admin-layout { display:flex; min-height:100vh; }

    /* ── Sidebar ──────────────────────────────────────────── */
    .admin-sidebar {
        width: 240px;
        flex-shrink: 0;
        background: linear-gradient(180deg, #0b1f3f 0%, #0f2a55 60%, #112e5a 100%);
        display: flex;
        flex-direction: column;
        position: fixed;
        top: 0; left: 0; bottom: 0;
        z-index: 100;
        box-shadow: 4px 0 20px rgba(0,0,0,0.18);
    }

    .admin-brand {
        padding: 16px 14px 13px;
        border-bottom: 1px solid rgba(255,255,255,0.07);
    }

    .admin-brand-inner {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .admin-brand-logo-img {
        width: 34px;
        height: 34px;
        object-fit: contain;
        flex-shrink: 0;
        opacity: 1;
        drop-shadow: 0 1px 4px rgba(0,0,0,0.3);
    }

    .admin-brand-texts {
        flex: 1;
        min-width: 0;
    }

    .admin-brand-title {
        font-size: 11px;
        font-weight: 800;
        color: #e2e8f0;
        margin: 0 0 1px;
        letter-spacing: 0.5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .admin-brand-sub {
        font-size: 9.5px;
        color: rgba(255,255,255,0.4);
        margin: 0;
        letter-spacing: 0.2px;
        white-space: nowrap;
    }

    /* ── Menu ─────────────────────────────────────────────── */
    .admin-menu {
        list-style: none;
        margin: 12px 0 0;
        padding: 0 10px;
        flex: 1;
        overflow-y: auto;
    }

    .admin-menu-section {
        font-size: 9.5px;
        font-weight: 700;
        color: rgba(255,255,255,0.25);
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 14px 10px 6px;
    }

    .admin-menu-item { margin-bottom: 2px; }

    .admin-menu-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 12px;
        border-radius: 9px;
        color: rgba(255,255,255,0.6);
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.18s ease;
        position: relative;
    }

    .admin-menu-link i { font-size: 15px; flex-shrink: 0; }

    .admin-menu-link:hover {
        color: #fff;
        background: rgba(255,255,255,0.08);
    }

    .admin-menu-item.active .admin-menu-link {
        color: #fff;
        background: rgba(13,148,136,0.25);
        font-weight: 700;
    }

    .admin-menu-item.active .admin-menu-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 6px;
        bottom: 6px;
        width: 3px;
        background: #0d9488;
        border-radius: 0 3px 3px 0;
    }

    /* ── Sidebar Footer ───────────────────────────────────── */
    .admin-sidebar-footer {
        padding: 14px 16px;
        border-top: 1px solid rgba(255,255,255,0.07);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .admin-sidebar-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0d9488, #0b7a70);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 14px;
        flex-shrink: 0;
    }

    .admin-sidebar-user-name {
        font-size: 12px;
        font-weight: 700;
        color: rgba(255,255,255,0.75);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        flex: 1;
    }

    /* ── Main Area ────────────────────────────────────────── */
    .admin-main {
        flex: 1;
        margin-left: 240px;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    /* ── Top Header Bar ───────────────────────────────────── */
    .admin-header {
        background: #fff;
        border-bottom: 1px solid #e8edf3;
        padding: 0 28px;
        height: 58px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 90;
        box-shadow: 0 1px 8px rgba(0,0,0,0.05);
    }

    .header-left { display: flex; align-items: center; gap: 10px; }

    .header-visit-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 13px;
        background: #f0fdf9;
        border: 1.5px solid #99f6e4;
        color: #0d9488;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.18s;
    }

    .header-visit-btn:hover { background: #ccfbf1; }

    .header-right { display: flex; align-items: center; gap: 14px; }

    .header-user-info {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
    }

    .header-user-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0d9488, #0b7a70);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 13px;
    }

    .header-logout-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 13px;
        background: #fff;
        border: 1.5px solid #fecdd3;
        color: #e11d48;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.18s;
    }

    .header-logout-btn:hover { background: #fff1f2; }

    /* ── Content Area ─────────────────────────────────────── */
    .admin-content { flex: 1; padding: 28px; }

    /* ── Flash Alerts ─────────────────────────────────────── */
    .alert {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 13px 16px;
        border-radius: 10px;
        font-size: 13.5px;
        font-weight: 500;
        margin-bottom: 20px;
        animation: fadeSlideDown 0.3s ease;
    }

    @keyframes fadeSlideDown { from{opacity:0;transform:translateY(-8px)} to{opacity:1;transform:translateY(0)} }

    .alert-success {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #15803d;
    }

    .alert-success::before {
        content: '\f26a';
        font-family: 'bootstrap-icons';
        font-size: 16px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .alert-danger {
        background: #fff1f2;
        border: 1px solid #fecdd3;
        color: #be123c;
    }

    .alert-danger::before {
        content: '\f333';
        font-family: 'bootstrap-icons';
        font-size: 16px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .alert-danger ul { margin: 6px 0 0 4px; padding-left: 16px; }

    /* ── CKEditor Custom Styling ── */
    .ck-editor {
        margin-top: 6px;
    }
    .ck-editor__editable {
        min-height: 220px !important;
        max-height: 450px !important;
        border-radius: 0 0 10px 10px !important;
        border-color: #cbd5e1 !important;
        font-size: 13.5px;
        line-height: 1.6;
        color: #1e293b;
    }
    .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
        border-color: #cbd5e1 !important;
    }
    .ck-toolbar {
        border-radius: 10px 10px 0 0 !important;
        border-color: #cbd5e1 !important;
        background: #f8fafc !important;
    }
    </style>
</head>
<body>

<div class="admin-layout">

    <!-- ════════ SIDEBAR ════════ -->
    <aside class="admin-sidebar">
        <div class="admin-brand">
            <div class="admin-brand-inner">
                <img src="{{ asset('images/logo-jatim.svg') }}" alt="Logo Jatim" class="admin-brand-logo-img" onerror="this.style.display='none'">
                <div class="admin-brand-texts">
                    <h2 class="admin-brand-title">CMS CABDIN GRESIK</h2>
                    <p class="admin-brand-sub">Administrator Panel</p>
                </div>
            </div>
        </div>

        <ul class="admin-menu">
            <li class="admin-menu-section">Utama</li>
            <li class="admin-menu-item {{ Request::is('admin') && !request()->has('type') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="admin-menu-link">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>

            <li class="admin-menu-section">Konten</li>
            <li class="admin-menu-item {{ Request::is('admin/posts*') && request('type') == 'berita' ? 'active' : '' }}">
                <a href="{{ route('admin.posts.index', ['type' => 'berita']) }}" class="admin-menu-link">
                    <i class="bi bi-newspaper"></i> Kelola Berita
                </a>
            </li>
            <li class="admin-menu-item {{ Request::is('admin/posts*') && request('type') == 'pengumuman' ? 'active' : '' }}">
                <a href="{{ route('admin.posts.index', ['type' => 'pengumuman']) }}" class="admin-menu-link">
                    <i class="bi bi-megaphone"></i> Pengumuman
                </a>
            </li>
            <li class="admin-menu-item {{ Request::is('admin/posts*') && request('type') == 'inovasi' ? 'active' : '' }}">
                <a href="{{ route('admin.posts.index', ['type' => 'inovasi']) }}" class="admin-menu-link">
                    <i class="bi bi-lightbulb"></i> Kelola Inovasi
                </a>
            </li>
            <li class="admin-menu-item {{ Request::is('admin/posts*') && request('type') == 'prestasi' ? 'active' : '' }}">
                <a href="{{ route('admin.posts.index', ['type' => 'prestasi']) }}" class="admin-menu-link">
                    <i class="bi bi-trophy"></i> Kelola Prestasi
                </a>
            </li>
            <li class="admin-menu-item {{ Request::is('admin/activities*') ? 'active' : '' }}">
                <a href="{{ route('admin.activities.index') }}" class="admin-menu-link">
                    <i class="bi bi-camera"></i> Kelola Kegiatan
                </a>
            </li>

            <li class="admin-menu-item {{ Request::is('admin/agendas*') ? 'active' : '' }}">
                <a href="{{ route('admin.agendas.index') }}" class="admin-menu-link">
                    <i class="bi bi-calendar-event"></i> Kelola Agenda
                </a>
            </li>

            <li class="admin-menu-section">Manajemen</li>
            <li class="admin-menu-item {{ Request::is('admin/sliders*') ? 'active' : '' }}">
                <a href="{{ route('admin.sliders.index') }}" class="admin-menu-link">
                    <i class="bi bi-images"></i> Banner Slider
                </a>
            </li>
            <li class="admin-menu-item {{ Request::is('admin/services*') ? 'active' : '' }}">
                <a href="{{ route('admin.services.index') }}" class="admin-menu-link">
                    <i class="bi bi-grid-3x3-gap"></i> Kelola Layanan
                </a>
            </li>
            <li class="admin-menu-item {{ Request::is('admin/profile*') ? 'active' : '' }}">
                <a href="{{ route('admin.profile.index') }}" class="admin-menu-link">
                    <i class="bi bi-person-workspace"></i> Profil Lembaga
                </a>
            </li>
            <li class="admin-menu-item {{ Request::is('admin/downloads*') ? 'active' : '' }}">
                <a href="{{ route('admin.downloads.index') }}" class="admin-menu-link">
                    <i class="bi bi-download"></i> Kelola Unduhan
                </a>
            </li>
            <li class="admin-menu-item {{ Request::is('admin/skm*') ? 'active' : '' }}">
                <a href="{{ route('admin.skm.index') }}" class="admin-menu-link">
                    <i class="bi bi-clipboard2-check"></i> Hasil Survei SKM
                </a>
            </li>
            <li class="admin-menu-item {{ Request::is('admin/mkks*') ? 'active' : '' }}">
                <a href="{{ route('admin.mkks.index') }}" class="admin-menu-link">
                    <i class="bi bi-building"></i> Kelola MKKS
                </a>
            </li>
            <li class="admin-menu-item {{ Request::is('admin/schools*') ? 'active' : '' }}">
                <a href="{{ route('admin.schools.index') }}" class="admin-menu-link">
                    <i class="bi bi-bank"></i> Kelola Data Sekolah
                </a>
            </li>
            <li class="admin-menu-item {{ Request::is('admin/users*') ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}" class="admin-menu-link">
                    <i class="bi bi-people"></i> Kelola Admin
                </a>
            </li>
        </ul>

        <div class="admin-sidebar-footer">
            <div class="admin-sidebar-avatar">
                <i class="bi bi-person-fill"></i>
            </div>
            <span class="admin-sidebar-user-name">{{ Auth::user()->name }}</span>
        </div>
    </aside>

    <!-- ════════ MAIN ════════ -->
    <div class="admin-main">
        <!-- Top Header -->
        <header class="admin-header">
            <div class="header-left">
                <a href="{{ route('home') }}" target="_blank" class="header-visit-btn">
                    <i class="bi bi-globe"></i> Lihat Website
                </a>
            </div>
            <div class="header-right">
                <div class="header-user-info">
                    <div class="header-user-avatar"><i class="bi bi-person-fill"></i></div>
                    {{ Auth::user()->name }}
                </div>
                <form action="{{ route('admin.logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="header-logout-btn">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </button>
                </form>
            </div>
        </header>

        <!-- Content -->
        <main class="admin-content">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </main>
    </div>

</div>

<!-- CKEditor 5 Super Build CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/super-build/ckeditor.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const textareas = document.querySelectorAll('.use-ckeditor');
        textareas.forEach(textarea => {
            CKEDITOR.ClassicEditor.create(textarea, {
                toolbar: {
                    items: [
                        'heading', '|',
                        'fontFamily', 'fontSize', 'fontColor', 'fontBackgroundColor', '|',
                        'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', '|',
                        'alignment', '|',
                        'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent', '|',
                        'insertTable', 'mediaEmbed', 'link', 'horizontalLine', '|',
                        'removeFormat', 'undo', 'redo'
                    ],
                    shouldNotGroupWhenFull: true
                },
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                fontSize: {
                    options: [ 10, 12, 14, 'default', 18, 20, 22, 24, 28, 32 ],
                    supportAllValues: true
                },
                removePlugins: [
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    'MathType',
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents',
                    'PasteFromOfficeEnhanced'
                ]
            })

                .then(editor => {
                    const form = textarea.closest('form');

                if (form) {
                    form.addEventListener('submit', () => {
                        textarea.value = editor.getData();
                    });
                }
})
                
            .catch(error => {
                console.error('CKEditor initialization error:', error);
            });
        });
    });
</script>

@yield('scripts')

</body>
</html>
