<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NusaMart - Platform Belanja Online Profesional & Terpercaya.">
    <title>@yield('title', 'NusaMart') - Belanja Online Terpercaya</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #0f172a;
            --primary-hover: #1e293b;
            --brand-blue: #2563eb;
            --brand-blue-hover: #1d4ed8;
            --accent-teal: #0d9488;
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
            --shadow-subtle: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px 0 rgba(0, 0, 0, 0.03);
            --shadow-card: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            --shadow-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.07), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
            --radius-sm: 6px;
            --radius: 8px;
            --radius-lg: 12px;
            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--gray-50);
            color: var(--gray-800);
            font-size: 14px;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        a { text-decoration: none; color: inherit; }
        img { max-width: 100%; display: block; }

        .top-bar {
            background: var(--gray-900);
            color: var(--gray-400);
            font-size: 12px;
            padding: 6px 0;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .top-bar-inner {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar-links { display: flex; gap: 16px; }
        .top-bar-links a { color: var(--gray-300); transition: var(--transition); }
        .top-bar-links a:hover { color: var(--white); }

        .navbar {
            background: var(--white);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid var(--gray-200);
            box-shadow: var(--shadow-subtle);
        }

        .navbar-inner {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 20px;
            height: 68px;
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--gray-900);
            font-weight: 800;
            font-size: 21px;
            letter-spacing: -0.5px;
            white-space: nowrap;
        }

        .brand-icon {
            width: 38px;
            height: 38px;
            background: var(--brand-blue);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 18px;
        }

        .brand span { color: var(--brand-blue); }

        .search-bar-form {
            flex: 1;
            max-width: 580px;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background: var(--gray-100);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius);
            overflow: hidden;
            height: 42px;
            transition: var(--transition);
        }

        .search-bar:focus-within {
            background: var(--white);
            border-color: var(--brand-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .search-bar input {
            flex: 1;
            border: none;
            outline: none;
            padding: 0 16px;
            font-size: 13.5px;
            font-family: inherit;
            color: var(--gray-900);
            background: transparent;
        }

        .search-bar button {
            background: transparent;
            border: none;
            height: 42px;
            width: 44px;
            cursor: pointer;
            color: var(--gray-500);
            font-size: 15px;
            transition: var(--transition);
        }

        .search-bar button:hover { color: var(--brand-blue); }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-left: auto;
        }

        .btn-link {
            padding: 8px 16px;
            font-size: 13.5px;
            font-weight: 600;
            color: var(--gray-700);
            border-radius: var(--radius);
            transition: var(--transition);
        }

        .btn-link:hover { color: var(--brand-blue); background: var(--gray-100); }

        .btn-primary-nav {
            background: var(--brand-blue);
            color: var(--white);
            padding: 8px 18px;
            border-radius: var(--radius);
            font-weight: 600;
            font-size: 13.5px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .btn-primary-nav:hover { background: var(--brand-blue-hover); }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 12px;
            border-radius: var(--radius);
            cursor: pointer;
            transition: var(--transition);
            border: 1px solid var(--gray-200);
            background: var(--white);
        }

        .nav-user:hover { border-color: var(--gray-300); background: var(--gray-50); }

        .avatar {
            width: 32px;
            height: 32px;
            background: var(--brand-blue);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
        }

        .nav-username {
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-800);
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .nav-dropdown { position: relative; }

        .nav-dropdown-menu {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            min-width: 220px;
            overflow: hidden;
            z-index: 100;
            border: 1px solid var(--gray-200);
        }

        .nav-dropdown:hover .nav-dropdown-menu { display: block; }

        .nav-dropdown-menu a,
        .nav-dropdown-menu button {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 16px;
            color: var(--gray-700);
            font-size: 13px;
            font-weight: 500;
            width: 100%;
            background: transparent;
            border: none;
            cursor: pointer;
            font-family: inherit;
            transition: var(--transition);
        }

        .nav-dropdown-menu a:hover,
        .nav-dropdown-menu button:hover { background: var(--gray-50); color: var(--brand-blue); }

        .nav-dropdown-menu .divider { height: 1px; background: var(--gray-200); margin: 4px 0; }

        .subnav {
            background: var(--white);
            border-bottom: 1px solid var(--gray-200);
        }

        .subnav-inner {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            gap: 6px;
            height: 42px;
            overflow-x: auto;
        }

        .subnav a {
            color: var(--gray-600);
            font-size: 13px;
            font-weight: 500;
            padding: 6px 14px;
            border-radius: var(--radius-sm);
            white-space: nowrap;
            transition: var(--transition);
        }

        .subnav a:hover, .subnav a.active { color: var(--brand-blue); background: var(--gray-100); }

        .alert-container {
            max-width: 1240px;
            margin: 16px auto 0;
            padding: 0 20px;
        }

        .alert {
            padding: 12px 18px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13.5px;
            font-weight: 500;
            margin-bottom: 12px;
            box-shadow: var(--shadow-subtle);
        }

        .alert-success { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
        .alert-error   { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }
        .alert-warning { background: #fffbeb; color: #92400e; border: 1px solid #fde68a; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: var(--radius);
            font-size: 13.5px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            border: 1px solid transparent;
            transition: var(--transition);
            white-space: nowrap;
        }

        .btn-sm { padding: 6px 14px; font-size: 12.5px; }
        .btn-lg { padding: 12px 26px; font-size: 15px; }

        .btn-brand { background: var(--brand-blue); color: var(--white); }
        .btn-brand:hover { background: var(--brand-blue-hover); }

        .btn-outline { background: transparent; color: var(--gray-700); border-color: var(--gray-300); }
        .btn-outline:hover { background: var(--gray-100); color: var(--gray-900); }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 600;
        }

        .badge-success { background: #dcfce7; color: #166534; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-info    { background: #e0f2fe; color: #075985; }
        .badge-primary { background: #dbeafe; color: #1e40af; }
        .badge-danger  { background: #fee2e2; color: #991b1b; }
        .badge-secondary { background: var(--gray-100); color: var(--gray-600); }

        footer {
            background: var(--gray-900);
            color: var(--gray-400);
            padding: 48px 0 24px;
            margin-top: 60px;
            border-top: 1px solid var(--gray-800);
        }

        .footer-inner { max-width: 1240px; margin: 0 auto; padding: 0 20px; }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-brand {
            font-size: 20px;
            font-weight: 800;
            color: var(--white);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-brand span { color: var(--brand-blue); }
        .footer-desc { font-size: 13.5px; line-height: 1.7; color: var(--gray-400); margin-bottom: 18px; }

        .footer-heading { font-size: 14px; font-weight: 700; color: var(--white); margin-bottom: 16px; }
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 10px; }
        .footer-links a { font-size: 13.5px; color: var(--gray-400); transition: var(--transition); }
        .footer-links a:hover { color: var(--white); }

        .footer-bottom {
            border-top: 1px solid var(--gray-800);
            padding-top: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .footer-grid { grid-template-columns: 1fr 1fr; }
            .navbar-inner { gap: 12px; }
            .top-bar { display: none; }
        }
    </style>
    @stack('styles')
</head>
<body>

    {{-- TOPBAR --}}
    <div class="top-bar">
        <div class="top-bar-inner">
            <div><i class="fas fa-shield-alt" style="color:var(--brand-blue);"></i> Belanja Aman & Resmi di <strong>NusaMart</strong></div>
            <div class="top-bar-links">
                <a href="#"><i class="fas fa-headset"></i> Bantuan</a>
                <a href="#"><i class="fas fa-truck"></i> Lacak Pengiriman</a>
            </div>
        </div>
    </div>

    {{-- NAVBAR --}}
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="{{ route('home') }}" class="brand">
                <div class="brand-icon"><i class="fas fa-store"></i></div>
                Nusa<span>Mart</span>
            </a>

            {{-- FUNCTIONAL SEARCH FORM --}}
            <form action="{{ route('home') }}" method="GET" class="search-bar-form">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <div class="search-bar">
                    <input type="text" name="q" placeholder="Cari nama produk, deskripsi, atau kategori..." value="{{ request('q') }}">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>

            <div class="nav-actions">
                @guest
                    <a href="{{ route('login') }}" class="btn-link">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-primary-nav">
                        Daftar Akun
                    </a>
                @else
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn-link" style="color:var(--brand-blue); font-weight:700;">
                            <i class="fas fa-user-shield"></i> Panel Admin
                        </a>
                    @else
                        <a href="{{ route('orders.my') }}" class="btn-link">
                            <i class="fas fa-box"></i> Pesanan Saya
                        </a>
                    @endif

                    <div class="nav-dropdown">
                        <div class="nav-user">
                            <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                            <span class="nav-username">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down" style="font-size:10px; color:var(--gray-500);"></i>
                        </div>
                        <div class="nav-dropdown-menu">
                            <div style="padding:12px 16px; border-bottom:1px solid var(--gray-200);">
                                <div style="font-weight:700; color:var(--gray-900); font-size:14px;">{{ auth()->user()->name }}</div>
                                <div style="font-size:12px; color:var(--gray-500);">{{ auth()->user()->email }}</div>
                                <span class="badge {{ auth()->user()->isAdmin() ? 'badge-primary' : 'badge-secondary' }}" style="margin-top:6px;">
                                    {{ auth()->user()->isAdmin() ? '👑 Administrator' : '🛍️ Pembeli' }}
                                </span>
                            </div>
                            @if(!auth()->user()->isAdmin())
                                <a href="{{ route('orders.my') }}"><i class="fas fa-box"></i> Pesanan Saya</a>
                            @else
                                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-line"></i> Dashboard Admin</a>
                            @endif
                            <div class="divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" style="color:#ef4444!important;">
                                    <i class="fas fa-sign-out-alt"></i> Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    {{-- INTERACTIVE SUBNAV CATEGORY LINKS --}}
    <div class="subnav">
        <div class="subnav-inner">
            <a href="{{ route('home') }}" class="{{ !request('category') ? 'active' : '' }}">Semua Produk</a>
            <a href="{{ route('home', ['category' => 'Fashion']) }}" class="{{ request('category') == 'Fashion' ? 'active' : '' }}">Fashion</a>
            <a href="{{ route('home', ['category' => 'Elektronik']) }}" class="{{ request('category') == 'Elektronik' ? 'active' : '' }}">Elektronik</a>
            <a href="{{ route('home', ['category' => 'Sepatu']) }}" class="{{ request('category') == 'Sepatu' ? 'active' : '' }}">Sepatu</a>
            <a href="{{ route('home', ['category' => 'Tas']) }}" class="{{ request('category') == 'Tas' ? 'active' : '' }}">Tas</a>
            <a href="{{ route('home', ['category' => 'Aksesoris']) }}" class="{{ request('category') == 'Aksesoris' ? 'active' : '' }}">Aksesoris</a>
            <a href="{{ route('home', ['category' => 'Rumah']) }}" class="{{ request('category') == 'Rumah' ? 'active' : '' }}">Peralatan Rumah</a>
        </div>
    </div>

    {{-- FLASH MESSAGES --}}
    <div class="alert-container">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-times-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif
        @if(session('alert'))
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('alert') }}</span>
            </div>
        @endif
    </div>

    {{-- MAIN CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer>
        <div class="footer-inner">
            <div class="footer-grid">
                <div>
                    <div class="footer-brand">
                        <i class="fas fa-store" style="color:var(--brand-blue);"></i> Nusa<span>Mart</span>
                    </div>
                    <p class="footer-desc">Platform toko online terpercaya dengan pilihan produk lengkap, proses transaksi mudah, dan layanan pelanggan profesional.</p>
                </div>
                <div>
                    <div class="footer-heading">Kategori Populer</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('home', ['category' => 'Fashion']) }}">Fashion</a></li>
                        <li><a href="{{ route('home', ['category' => 'Elektronik']) }}">Elektronik</a></li>
                        <li><a href="{{ route('home', ['category' => 'Sepatu']) }}">Sepatu</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer-heading">Perusahaan</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Katalog Utama</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer-heading">Metode Pembayaran</div>
                    <ul class="footer-links">
                        <li><a href="#">COD (Cash On Delivery)</a></li>
                        <li><a href="#">Transfer Bank Rekening Bersama</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <span>&copy; 2026 NusaMart. Hak Cipta Dilindungi.</span>
                <span>Sistem E-Commerce Terintegrasi</span>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
