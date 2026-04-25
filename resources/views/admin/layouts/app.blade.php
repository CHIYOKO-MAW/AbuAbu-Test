<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }} - Abu-Abu Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --bg: #0B0F19;
            --surface: #161B26;
            --surface-hover: #1E2433;
            --border: #2A3142;
            --text: #E5E7EB;
            --text-dim: #9CA3AF;
            --text-fade: #6B7280;
            --primary: #8B5CF6;
            --primary-hover: #7C3AED;
            --primary-dim: rgba(139, 92, 246, 0.15);
            --secondary: #A78BFA;
            --green: #34D399;
            --green-dim: rgba(52, 211, 153, 0.15);
            --red: #F87171;
            --red-dim: rgba(248, 113, 113, 0.15);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body { background: var(--bg); color: var(--text); font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; font-size: 14px; line-height: 1.5; }

        /* Layout */
        .flex { display: flex; }
        .fixed { position: fixed; }
        .inset-0 { top: 0; right: 0; bottom: 0; left: 0; }
        .inline-flex { display: inline-flex; }
        .z-40 { z-index: 40; }
        .z-50 { z-index: 50; }
        .hidden { display: none; }
        .h-full { height: 100%; }
        .w-full { width: 100%; }
        .min-h-screen { min-height: 100vh; }
        .overflow-y-auto { overflow-y: auto; }

        /* Sidebar */
        .sidebar { background: var(--surface); border-right: 1px solid var(--border); width: 200px; }
        .sidebar a { color: var(--text-dim); display: flex; align-items: center; gap: 10px; padding: 10px 14px; border-radius: 6px; margin: 2px 8px; text-decoration: none; font-size: 13px; font-weight: 500; }
        .sidebar a:hover { background: var(--surface-hover); color: var(--text); }
        .sidebar a.active { background: var(--primary-dim); color: var(--primary); }
        .sidebar .logo { padding: 16px; border-bottom: 1px solid var(--border); font-size: 14px; font-weight: 600; color: var(--text); }
        .sidebar .section { padding: 16px 14px 6px; font-size: 10px; font-weight: 600; color: var(--text-fade); text-transform: uppercase; letter-spacing: 0.5px; }
        .sidebar .nav { flex: 1; padding-top: 6px; }
        .sidebar .footer { padding: 16px; border-top: 1px solid var(--border); }
        .sidebar .footer a, .sidebar .footer button { margin: 0; padding: 10px 14px; font-size: 13px; }

        /* Main */
        .main { flex: 1; margin-left: 200px; padding: 24px; background: var(--bg); }
        .max-w { max-width: 1100px; }

        /* Typography */
        h1 { font-size: 20px; font-weight: 600; color: var(--text); }
        h2 { font-size: 14px; font-weight: 600; }

        /* Card */
        .card { background: var(--surface); border: 1px solid var(--border); border-radius: 8px; }
        .card-header { padding: 14px 16px; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; }
        .card-body { padding: 16px; }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 8px 14px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; cursor: pointer; border: none; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-hover); }
        .btn-secondary { background: var(--surface); border: 1px solid var(--border); color: var(--text-dim); }
        .btn-secondary:hover { background: var(--surface-hover); color: var(--text); }
        .btn-sm { padding: 6px 10px; font-size: 12px; }

        /* Forms */
        .form-input { width: 100%; padding: 8px 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 13px; background: var(--surface); color: var(--text); }
        .form-input:focus { outline: none; border-color: var(--primary); }
        .form-select { width: 100%; padding: 8px 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 13px; background: var(--surface); color: var(--text); }

        /* Table */
        table { width: 100%; border-collapse: collapse; }
        th { padding: 10px 12px; text-align: left; font-size: 11px; color: var(--text-fade); border-bottom: 1px solid var(--border); background: var(--surface); }
        td { padding: 10px 12px; border-bottom: 1px solid var(--border); font-size: 13px; color: var(--text-dim); }
        tr:hover td { background: var(--surface-hover); }

        /* Utils */
        .mb-2 { margin-bottom: 8px; }
        .mb-4 { margin-bottom: 16px; }
        .mb-6 { margin-bottom: 24px; }
        .mt-4 { margin-top: 16px; }
        .mt-1 { margin-top: 4px; }
        .mt-2 { margin-top: 8px; }
        .mt-6 { margin-top: 24px; }
        .mr-2 { margin-right: 8px; }
        .mr-3 { margin-right: 12px; }
        .gap-2 { gap: 8px; }
        .gap-3 { gap: 12px; }
        .gap-4 { gap: 16px; }
        .grid { display: grid; }
        .grid-cols-2 { grid-template-columns: repeat(2, 1fr); }
        .grid-cols-3 { grid-template-columns: repeat(3, 1fr); }
        .grid-cols-4 { grid-template-columns: repeat(4, 1fr); }
        .col-span-2 { grid-column: span 2; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .p-4 { padding: 16px; }
        .p-2 { padding: 8px; }
        .py-3 { padding-top: 12px; padding-bottom: 12px; }
        .pt-2 { padding-top: 8px; }
        .pb-2 { padding-bottom: 8px; }
        .pl-0 { padding-left: 0; }
        .text-center { text-align: center; }
        .inline { display: inline; }
        .flex-1 { flex: 1; }

        /* Links & Text */
        a { color: var(--primary); text-decoration: none; }
        a:hover { color: var(--secondary); }
        .text-muted { color: var(--text-fade); }
        .text-red { color: var(--red); }
        .text-center { text-align: center; }
        .btn-link { font-size: 12px; color: var(--primary); }
        .hidden { display: none; }
        .border-t { border-top: 1px solid var(--border); }
        .border-b { border-bottom: 1px solid var(--border); }
        .border-border { border-color: var(--border); }
        .w-48 { width: 12rem; }
        .h-48 { height: 12rem; }
        .h-64 { height: 16rem; }
        .object-cover { object-fit: cover; }
        .text-sm { font-size: 12px; }

        /* Stats */
        .stat-card { background: var(--surface); border: 1px solid var(--border); border-radius: 8px; padding: 14px 16px; display: flex; align-items: center; gap: 12px; text-decoration: none; font-size: 13px; }
        .stat-card:hover { border-color: var(--primary); }
        .stat-icon { width: 36px; height: 36px; border-radius: 6px; background: var(--primary-dim); display: flex; align-items: center; justify-content: center; }
        .stat-icon svg { color: var(--primary); }
        .stat-label { font-size: 12px; color: var(--text-fade); }
        .stat-value { font-size: 20px; font-weight: 600; color: var(--text); }

        /* Items */
        .item-row { display: flex; align-items: center; gap: 10px; padding: 10px 16px; border-bottom: 1px solid var(--border); font-size: 13px; text-decoration: none; color: var(--text-dim); }
        .item-row:last-child { border-bottom: none; }
        .item-row:hover { background: var(--surface-hover); }
        .item-icon { width: 28px; height: 28px; border-radius: 4px; background: var(--primary-dim); display: flex; align-items: center; justify-content: center; }
        .item-icon svg { color: var(--primary); width: 14px; height: 14px; }
        .item-title { font-weight: 500; color: var(--text); }
        .item-sub { font-size: 11px; color: var(--text-fade); }
        .badge { padding: 2px 6px; border-radius: 4px; font-size: 10px; font-weight: 500; background: var(--green-dim); color: var(--green); }
        .badge-green { background: var(--green-dim); color: var(--green); }
        .badge-blue { background: var(--primary-dim); color: var(--primary); }

        /* Alert */
        .alert { padding: 10px 14px; border-radius: 6px; border: 1px solid; font-size: 13px; }
        .alert-success { background: var(--green-dim); border-color: var(--green); color: var(--green); }
        .alert-error { background: var(--red-dim); border-color: var(--red); color: var(--red); }

        /* Pagination */
        .pagination { display: flex; gap: 4px; }
        .pagination a, .pagination span { padding: 6px 10px; border-radius: 4px; border: 1px solid var(--border); font-size: 12px; color: var(--text-dim); }
        .pagination a:hover { background: var(--surface-hover); }
        .pagination .active { background: var(--primary); border-color: var(--primary); color: white; }

        @media (max-width: 768px) {
            .sidebar { position: fixed; left: -200px; transition: left 0.2s; }
            .sidebar.open { left: 0; }
            .main { margin-left: 0; padding: 16px; }
            .grid-cols-2, .grid-cols-4 { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="flex min-h-screen">
        @auth
        <aside class="sidebar fixed inset-0 h-full flex flex-col">
            <div class="logo">Abu-Abu Admin</div>
            
            <nav class="nav overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3"/></svg>
                    Dashboard
                </a>
                
                <div class="section">Music</div>
                <a href="{{ route('admin.artists.index') }}" class="{{ request()->routeIs('admin.artists.*') ? 'active' : '' }}">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Artists
                </a>
                <a href="{{ route('admin.albums.index') }}" class="{{ request()->routeIs('admin.albums.*') ? 'active' : '' }}">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 19V6l12-3v13"/></svg>
                    Albums
                </a>
                
                <div class="section">Content</div>
                <a href="{{ route('admin.reading.index') }}" class="{{ request()->routeIs('admin.reading.*') ? 'active' : '' }}">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13"/></svg>
                    Reading
                </a>
                <a href="{{ route('admin.tools.index') }}" class="{{ request()->routeIs('admin.tools.*') ? 'active' : '' }}">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Tools
                </a>
                <a href="{{ route('admin.requests.index') }}" class="{{ request()->routeIs('admin.requests.*') ? 'active' : '' }}">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    Requests
                </a>
            </nav>

            <div class="footer">
                <a href="/" target="_blank" style="padding:10px 14px;display:block;color:var(--text-dim)">
                    View Site
                </a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" style="background:none;border:none;cursor:pointer;width:100%;padding:10px 14px;text-align:left;color:var(--text-dim);font-size:13px">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="main">
        @endauth
            @yield('content')
        </main>
    </div>
</body>
</html>