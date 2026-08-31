<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - NusaMart Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --brand-blue: #2563eb;
            --brand-blue-dark: #1d4ed8;
            --sidebar-bg: #0f172a;       /* Dark slate */
            --sidebar-hover: #1e293b;
            --sidebar-text: #94a3b8;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --white: #ffffff;
            --radius-sm: 6px;
            --radius: 8px;
            --radius-lg: 12px;
            --shadow-subtle: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            --shadow-card: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            --sidebar-w: 250px;
            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--gray-50);
            color: var(--gray-800);
            font-size: 13.5px;
            display: flex;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        a { text-decoration: none; color: inherit; }

        /* ─── SIDEBAR ─────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            min-height: 100vh;
            position: fixed;
            left: 0; top: 0; bottom: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            border-right: 1px solid var(--gray-800);
        }

        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid var(--gray-800);
        }

        .sidebar-brand-name {
            font-size: 20px;
            font-weight: 800;
            color: var(--white);
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: -0.5px;
        }

        .sidebar-brand-name span { color: var(--brand-blue); }

        .sidebar-brand-icon {
            width: 34px;
            height: 34px;
            background: var(--brand-blue);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: var(--white);
        }

        .sidebar-nav { flex: 1; padding: 16px 0; overflow-y: auto; }

        .sidebar-section {
            padding: 12px 20px 6px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #475569;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 20px;
            color: var(--sidebar-text);
            font-size: 13.5px;
            font-weight: 500;
            transition: var(--transition);
        }

        .sidebar-link:hover { background: var(--sidebar-hover); color: var(--white); }

        .sidebar-link.active {
            background: rgba(37, 99, 235, 0.12);
            color: #60a5fa;
            font-weight: 600;
            border-left: 3px solid var(--brand-blue);
        }

        .sidebar-link i { width: 18px; text-align: center; font-size: 15px; }

        .sidebar-bottom {
            padding: 16px 20px;
            border-top: 1px solid var(--gray-800);
        }

        .sidebar-user { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }

        .sidebar-avatar {
            width: 36px; height: 36px;
            background: var(--brand-blue);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; color: var(--white); font-size: 14px;
        }

        .sidebar-user-name { font-weight: 600; color: var(--white); font-size: 13px; }
        .sidebar-user-role { font-size: 11px; color: var(--sidebar-text); }

        .sidebar-logout {
            width: 100%;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #f87171;
            padding: 8px 14px;
            border-radius: var(--radius);
            font-size: 12.5px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            display: flex; align-items: center; gap: 8px;
            transition: var(--transition);
        }

        .sidebar-logout:hover { background: rgba(239, 68, 68, 0.2); color: #fca5a5; }

        /* ─── MAIN CONTENT ───────────────────────── */
        .admin-main {
            margin-left: var(--sidebar-w);
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .admin-topbar {
            background: var(--white);
            padding: 0 28px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--gray-200);
            position: sticky; top: 0; z-index: 50;
        }

        .topbar-title { font-weight: 700; font-size: 17px; color: var(--gray-900); }
        .topbar-breadcrumb { font-size: 12px; color: var(--gray-500); margin-top: 2px; }

        .admin-body { flex: 1; padding: 28px; }

        /* ─── CARDS & TABLES ─────────────────────── */
        .card {
            background: var(--white);
            border-radius: var(--radius-lg);
            border: 1px solid var(--gray-200);
            box-shadow: var(--shadow-card);
            overflow: hidden;
        }

        .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--gray-200);
            display: flex; align-items: center; justify-content: space-between;
            background: var(--white);
        }

        .card-title { font-weight: 700; font-size: 15px; color: var(--gray-900); }
        .card-body { padding: 24px; }

        .stat-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 20px;
            border: 1px solid var(--gray-200);
            box-shadow: var(--shadow-card);
            display: flex; align-items: center; gap: 16px;
        }

        .stat-icon {
            width: 48px; height: 48px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; flex-shrink: 0;
        }

        .stat-icon.blue { background: #dbeafe; color: #2563eb; }
        .stat-icon.purple { background: #f3e8ff; color: #7e22ce; }
        .stat-icon.green { background: #dcfce7; color: #15803d; }
        .stat-icon.orange { background: #ffedd5; color: #c2410c; }

        .stat-value { font-size: 22px; font-weight: 800; color: var(--gray-900); line-height: 1; }
        .stat-label { font-size: 12px; color: var(--gray-500); margin-top: 4px; font-weight: 500; }

        .table-wrapper { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            background: var(--gray-50);
            padding: 12px 18px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--gray-200);
        }

        tbody td { padding: 14px 18px; border-bottom: 1px solid var(--gray-200); font-size: 13.5px; vertical-align: middle; }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: var(--gray-50); }

        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-weight: 600; font-size: 13px; color: var(--gray-700); margin-bottom: 6px; }
        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--gray-300);
            border-radius: var(--radius);
            font-size: 13.5px;
            font-family: inherit;
            color: var(--gray-900);
            background: var(--white);
            outline: none;
            transition: var(--transition);
        }

        .form-control:focus { border-color: var(--brand-blue); box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); }
        .form-error { font-size: 12px; color: #ef4444; margin-top: 4px; }

        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            padding: 9px 18px; border-radius: var(--radius); font-size: 13.5px; font-weight: 600;
            font-family: inherit; cursor: pointer; border: 1px solid transparent; transition: var(--transition);
        }
        .btn-sm { padding: 6px 12px; font-size: 12px; }
        .btn-brand { background: var(--brand-blue); color: var(--white); }
        .btn-brand:hover { background: var(--brand-blue-dark); }
        .btn-green { background: #16a34a; color: var(--white); }
        .btn-green:hover { background: #15803d; }
        .btn-danger { background: #ef4444; color: var(--white); }
        .btn-danger:hover { background: #dc2626; }
        .btn-white { background: var(--white); color: var(--gray-700); border-color: var(--gray-300); }
        .btn-white:hover { background: var(--gray-50); }

        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600; }
        .badge-success { background: #dcfce7; color: #166534; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-info    { background: #e0f2fe; color: #075985; }
        .badge-primary { background: #dbeafe; color: #1e40af; }
        .badge-danger  { background: #fee2e2; color: #991b1b; }
        .badge-secondary { background: var(--gray-100); color: var(--gray-600); }

        .alert { padding: 12px 18px; border-radius: var(--radius); font-size: 13.5px; font-weight: 500; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .alert-success { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
        .alert-error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }
    </style>
    @stack('styles')
</head>
<body>
    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-name">
                <div class="sidebar-brand-icon"><i class="fas fa-store"></i></div>
                Nusa<span>Mart</span>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-section">Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>

            <div class="sidebar-section">Manajemen Toko</div>
            <a href="{{ route('admin.products.index') }}" class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="fas fa-box-open"></i> Kelola Produk
            </a>
            <a href="{{ route('admin.orders.index') }}" class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="fas fa-shopping-bag"></i> Kelola Pesanan
            </a>

            <div class="sidebar-section">Link Luar</div>
            <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
                <i class="fas fa-external-link-alt"></i> Lihat Toko Publik
            </a>
        </nav>

        <div class="sidebar-bottom">
            <div class="sidebar-user">
                <div class="sidebar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div>
                    <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
                    <div class="sidebar-user-role">Administrator</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-logout">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="admin-main">
        <div class="admin-topbar">
            <div>
                <div class="topbar-title">@yield('page-title', 'Dashboard Administrator')</div>
                <div class="topbar-breadcrumb">NusaMart Admin &rsaquo; @yield('breadcrumb', 'Dashboard')</div>
            </div>
            <div>
                <span class="badge badge-success"><i class="fas fa-circle" style="font-size:7px;"></i> Online</span>
            </div>
        </div>

        <div class="admin-body">
            @if(session('success'))
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error"><i class="fas fa-times-circle"></i> {{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
