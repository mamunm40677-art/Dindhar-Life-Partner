<!doctype html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'এডমিন প্যানেল') - দ্বীনদার লাইফ পার্টনার</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --admin-bg: #f4f6f8;
            --sidebar-bg: #062820;
            --sidebar-active: #0d493a;
            --gold: #cba135;
            --ink: #15382f;
            --card-bg: #ffffff;
            --border: #e2e8f0;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Noto Sans Bengali', 'DM Sans', sans-serif; background: var(--admin-bg); color: var(--ink); }
        a { text-decoration: none; color: inherit; }

        .admin-wrapper { display: flex; min-height: 100vh; }

        /* Sidebar */
        .sidebar { width: 260px; background: var(--sidebar-bg); color: #e2ece8; flex-shrink: 0; display: flex; flex-direction: column; }
        .sidebar-brand { padding: 20px; font-size: 18px; font-weight: 700; color: var(--gold); border-bottom: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; gap: 10px; }
        .sidebar-menu { list-style: none; padding: 15px 0; flex: 1; overflow-y: auto; }
        .sidebar-menu li a { display: flex; align-items: center; justify-content: space-between; padding: 11px 20px; font-size: 13.5px; font-weight: 600; transition: 0.2s; color: #a2b2ab; }
        .sidebar-menu li a:hover, .sidebar-menu li a.active { background: var(--sidebar-active); color: #ffffff; border-left: 4px solid var(--gold); }

        .nav-section-title { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--gold); font-weight: 700; padding: 18px 20px 6px; }

        .sidebar-footer { padding: 18px 20px; border-top: 1px solid rgba(255,255,255,0.1); font-size: 12px; color: #788c83; text-align: center; }

        /* Main Content */
        .main-content { flex: 1; display: flex; flex-direction: column; overflow-x: hidden; }
        .top-navbar { background: #ffffff; height: 65px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; padding: 0 25px; }
        .top-navbar .admin-title { font-size: 18px; font-weight: 700; color: var(--sidebar-bg); }
        .top-navbar .user-info { display: flex; align-items: center; gap: 15px; font-size: 14px; font-weight: 600; }
        .btn-logout { background: #e11d48; color: #fff; border: none; padding: 6px 14px; border-radius: 6px; font-size: 12px; font-weight: 700; cursor: pointer; }

        .content-body { padding: 25px; flex: 1; }

        /* Alerts */
        .alert { padding: 12px 18px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; font-weight: 600; }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

        /* Stats Cards */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 18px; margin-bottom: 25px; }
        .stat-card { background: var(--card-bg); padding: 20px; border-radius: 10px; border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.03); }
        .stat-card .label { font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 6px; }
        .stat-card .value { font-size: 26px; font-weight: 700; color: var(--sidebar-bg); }

        /* Cards & Tables */
        .card { background: var(--card-bg); border-radius: 10px; border: 1px solid var(--border); padding: 20px; margin-bottom: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.03); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; }
        .card-title { font-size: 16px; font-weight: 700; color: var(--sidebar-bg); }

        table.admin-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 13px; }
        table.admin-table th, table.admin-table td { padding: 12px 15px; border-bottom: 1px solid var(--border); }
        table.admin-table th { background: #f8fafc; font-weight: 700; color: #475569; }
        table.admin-table tr:hover { background: #f1f5f9; }

        .badge { display: inline-block; padding: 3px 8px; border-radius: 20px; font-size: 11px; font-weight: 700; }
        .badge-green { background: #dcfce7; color: #166534; }
        .badge-yellow { background: #fef9c3; color: #854d0e; }
        .badge-blue { background: #dbeafe; color: #1e40af; }
        .badge-red { background: #fee2e2; color: #991b1b; }

        .btn-action { padding: 6px 12px; border-radius: 6px; border: none; font-size: 12px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 4px; text-decoration: none; }
        .btn-action-primary { background: #062820; color: #cba135; border: 1px solid #cba135; }
        .btn-action-primary:hover { background: #0d493a; color: white; }
        .btn-action-success { background: #16a34a; color: white; }
        .btn-action-warning { background: #d97706; color: white; }
        .btn-action-danger { background: #dc2626; color: white; }

        .search-box { display: flex; gap: 10px; margin-bottom: 20px; }
        .search-box input, .form-control { width: 100%; padding: 9px 14px; border: 1px solid var(--border); border-radius: 6px; font-size: 13px; }
        .search-box button, .btn-submit { padding: 9px 18px; background: var(--sidebar-bg); color: var(--gold); border: 1px solid var(--gold); border-radius: 6px; font-weight: 700; cursor: pointer; }
        .btn-submit:hover { background: var(--sidebar-active); color: #fff; }

        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 13px; font-weight: 700; color: var(--sidebar-bg); margin-bottom: 6px; }
        .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <span>🕌</span> এডমিন প্যানেল
            </div>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span>📊 ড্যাশবোর্ড</span>
                    </a>
                </li>

                <!-- ACCOUNTS SECTION -->
                <li class="nav-section-title">📂 ACCOUNTS</li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <span>👥 ইউজার অ্যাকাউন্টস (Users)</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.requests.index') }}" class="{{ request()->routeIs('admin.requests.*') ? 'active' : '' }}">
                        <span>📩 ইউজার রিকোয়েস্ট (Requests)</span>
                        @php $pCount = \App\Models\UserRequest::where('status', 'pending')->count(); @endphp
                        @if($pCount > 0)
                            <span class="badge badge-red">{{ $pCount }}</span>
                        @endif
                    </a>
                </li>

                <!-- BUSINESS SECTION -->
                <li class="nav-section-title">💼 BUSINESS</li>
                <li>
                    <a href="{{ route('admin.plans.index') }}" class="{{ request()->routeIs('admin.plans.*') ? 'active' : '' }}">
                        <span>💎 সাবস্ক্রিপশন প্ল্যান (Plans)</span>
                    </a>
                </li>

                <!-- GENERAL MANAGEMENT -->
                <li class="nav-section-title">⚙️ GENERAL</li>
                <li>
                    <a href="{{ route('admin.biodatas.index') }}" class="{{ request()->routeIs('admin.biodatas.*') ? 'active' : '' }}">
                        <span>📜 বায়োডাটা ব্যবস্থাপনা</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                        <span>✉️ কন্টাক্ট মেসেজ</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('home') }}" target="_blank">
                        <span>🌐 মূল ওয়েবসাইটে যান</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                দ্বীনদার লাইফ পার্টনার v1.0
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <header class="top-navbar">
                <div class="admin-title">@yield('page_title', 'ড্যাশবোর্ড')</div>
                <div class="user-info">
                    <span>👋 {{ auth()->user()->name }} (এডমিন)</span>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="btn-logout">লগআউট</button>
                    </form>
                </div>
            </header>

            <div class="content-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-error">{{ session('error') }}</div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
