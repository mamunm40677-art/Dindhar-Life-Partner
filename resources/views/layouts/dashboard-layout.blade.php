@extends('layouts.app')

@section('content')
<style>
    :root {
        --dash-green: #062820;
        --dash-green-light: #0d493a;
        --dash-gold: #cba135;
        --dash-gold-hover: #b88e28;
        --dash-bg: #f8f7f2;
        --dash-card: #ffffff;
        --dash-border: #e5e0d3;
        --dash-text: #15382f;
        --dash-muted: #69766f;
    }

    .dash-container {
        padding: 40px 0 70px;
        background: var(--dash-bg);
        min-height: calc(100vh - 250px);
    }

    .dash-grid {
        display: grid;
        grid-template-columns: 290px 1fr;
        gap: 28px;
        align-items: start;
    }

    /* Left Sidebar */
    .dash-sidebar {
        background: var(--dash-card);
        border: 1.5px solid var(--dash-border);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(6, 40, 32, 0.04);
        position: sticky;
        top: 90px;
    }

    .dash-user-profile {
        text-align: center;
        padding-bottom: 20px;
        border-bottom: 1.5px solid var(--dash-border);
        margin-bottom: 20px;
    }

    .dash-avatar-circle {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: var(--dash-green);
        border: 2px solid var(--dash-gold);
        color: var(--dash-gold);
        display: grid;
        place-items: center;
        font: 700 28px var(--serif);
        margin: 0 auto 12px;
        box-shadow: 0 4px 10px rgba(6, 40, 32, 0.15);
    }

    .dash-user-name {
        font-family: var(--serif);
        font-size: 18px;
        font-weight: 700;
        color: var(--dash-green);
        margin-bottom: 4px;
    }

    .dash-user-email {
        font-size: 12px;
        color: var(--dash-muted);
        margin-bottom: 12px;
    }

    .dash-badge-status {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        background: #e6f4ea;
        color: #137333;
        border: 1px solid #b7e1cd;
    }

    .dash-badge-status.draft {
        background: #fff8e1;
        color: #b78103;
        border-color: #ffe082;
    }

    /* Navigation Links */
    .dash-nav {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .dash-nav-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 11px 14px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        color: var(--dash-text);
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .dash-nav-item:hover, .dash-nav-item.active {
        background: var(--dash-green);
        color: var(--dash-gold);
    }

    .dash-nav-item .nav-label {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .dash-badge-new {
        background: var(--dash-gold);
        color: var(--dash-green);
        font-size: 10px;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 12px;
    }

    .dash-main {
        min-width: 0;
    }

    @media (max-width: 850px) {
        .dash-grid {
            grid-template-columns: 1fr;
        }
        .dash-sidebar {
            position: static;
        }
    }
</style>

@php
    $myBiodata = auth()->user()->biodata;
@endphp

<div class="dash-container">
    <div class="container">
        <div class="dash-grid">
            <!-- Left Sidebar Navigation (Always Visible) -->
            <aside class="dash-sidebar">
                <div class="dash-user-profile">
                    <div class="dash-avatar-circle">
                        {{ mb_substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="dash-user-name">{{ auth()->user()->name }}</div>
                    <div class="dash-user-email">{{ auth()->user()->email }}</div>

                    @if(auth()->user()->isAdmin())
                        <div style="margin-bottom:8px">
                            <span class="dash-badge-status" style="background:#dbeafe;color:#1e40af;border-color:#bfdbfe">🛡️ সিস্টেম এডমিন</span>
                        </div>
                    @endif

                    @if ($myBiodata)
                        <span class="dash-badge-status {{ $myBiodata->published ? '' : 'draft' }}">
                            {{ $myBiodata->published ? '🟢 বায়োডাটা পাবলিশড' : '🟡 পেন্ডিং/ড্রাফট' }}
                        </span>
                    @else
                        <span class="dash-badge-status draft">
                            🔴 বায়োডাটা তৈরি করা নেই
                        </span>
                    @endif
                </div>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" style="display:flex;align-items:center;justify-content:center;gap:8px;margin-bottom:18px;padding:12px;background:#062820;color:#cba135;border:1.5px solid #cba135;border-radius:12px;text-align:center;font-weight:700;font-size:13px;text-decoration:none">
                        🕌 এডমিন প্যানেলে যান (Admin Panel)
                    </a>
                @endif

                <nav class="dash-nav">
                    <!-- 1. ড্যাশবোর্ড -->
                    <a href="{{ route('dashboard') }}" class="dash-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <span class="nav-label"><span class="icon">📊</span> ড্যাশবোর্ড</span>
                    </a>

                    <!-- 2. মিউচুয়াল ম্যাচ বায়োডাটা -->
                    <a href="{{ route('mutual-matches') }}" class="dash-nav-item {{ request()->routeIs('mutual-matches') ? 'active' : '' }}">
                        <span class="nav-label"><span class="icon">🤝</span> মিউচুয়াল ম্যাচ বায়োডাটা</span>
                        <span class="dash-badge-new">New</span>
                    </a>

                    <!-- 3. পছন্দ অনুযায়ী মিল -->
                    <a href="{{ route('preference-matches') }}" class="dash-nav-item {{ request()->routeIs('preference-matches') ? 'active' : '' }}">
                        <span class="nav-label"><span class="icon">✨</span> পছন্দ অনুযায়ী মিল</span>
                        <span class="dash-badge-new">New</span>
                    </a>

                    <!-- 4. অনলাইন ইউজার -->
                    <a href="{{ route('online-users') }}" class="dash-nav-item {{ request()->routeIs('online-users') ? 'active' : '' }}">
                        <span class="nav-label"><span class="icon">📡</span> অনলাইন ইউজার</span>
                        <span class="dash-badge-new">New</span>
                    </a>

                    <!-- 5. আমার বায়োডাটা -->
                    @if ($myBiodata)
                        <a href="{{ route('biodatas.show', $myBiodata) }}" class="dash-nav-item {{ request()->routeIs('biodatas.show') ? 'active' : '' }}">
                            <span class="nav-label"><span class="icon">👁️</span> আমার বায়োডাটা</span>
                        </a>
                    @else
                        <a href="{{ route('my-biodata.create') }}" class="dash-nav-item">
                            <span class="nav-label"><span class="icon">👁️</span> আমার বায়োডাটা</span>
                        </a>
                    @endif

                    <!-- 6. এডিট বায়োডাটা -->
                    @if ($myBiodata)
                        <a href="{{ route('my-biodata.edit', $myBiodata) }}" class="dash-nav-item {{ request()->routeIs('my-biodata.edit') ? 'active' : '' }}">
                            <span class="nav-label"><span class="icon">✎</span> এডিট বায়োডাটা</span>
                        </a>
                    @else
                        <a href="{{ route('my-biodata.create') }}" class="dash-nav-item {{ request()->routeIs('my-biodata.create') ? 'active' : '' }}">
                            <span class="nav-label"><span class="icon">✎</span> এডিট বায়োডাটা</span>
                        </a>
                    @endif

                    <!-- 7. যোগাযোগ তথ্য -->
                    <a href="{{ route('unlocked-contacts') }}" class="dash-nav-item {{ request()->routeIs('unlocked-contacts') ? 'active' : '' }}">
                        <span class="nav-label"><span class="icon">📞</span> যোগাযোগ তথ্য</span>
                    </a>

                    <!-- 8. কারা রিকোয়েস্ট করেছে -->
                    <a href="{{ route('incoming-requests') }}" class="dash-nav-item {{ request()->routeIs('incoming-requests') ? 'active' : '' }}">
                        <span class="nav-label"><span class="icon">👍</span> কারা রিকোয়েস্ট করেছে</span>
                        <span class="dash-badge-new">New</span>
                    </a>

                    <!-- 9. কারা পছন্দে যুক্ত রেখেছে -->
                    <a href="{{ route('shortlisted-by') }}" class="dash-nav-item {{ request()->routeIs('shortlisted-by') ? 'active' : '' }}">
                        <span class="nav-label"><span class="icon">❤️</span> কারা পছন্দে যুক্ত রেখেছে</span>
                        <span class="dash-badge-new">New</span>
                    </a>

                    <!-- 10. কারা প্রোফাইল দেখেছে -->
                    <a href="{{ route('profile-visitors') }}" class="dash-nav-item {{ request()->routeIs('profile-visitors') ? 'active' : '' }}">
                        <span class="nav-label"><span class="icon">👁️‍🗨️</span> কারা প্রোফাইল দেখেছে</span>
                        <span class="dash-badge-new">New</span>
                    </a>

                    <!-- 11. ইগনোর তালিকা -->
                    <a href="{{ route('ignored-list') }}" class="dash-nav-item {{ request()->routeIs('ignored-list') ? 'active' : '' }}">
                        <span class="nav-label"><span class="icon">🚫</span> ইগনোর তালিকা</span>
                        <span class="dash-badge-new">New</span>
                    </a>

                    <!-- 12. প্যাকেজ কিনুন -->
                    <a href="{{ route('packages') }}" class="dash-nav-item {{ request()->routeIs('packages') ? 'active' : '' }}">
                        <span class="nav-label"><span class="icon">💎</span> প্যাকেজ কিনুন</span>
                    </a>

                    <!-- 13. সেটিংস -->
                    <a href="{{ route('settings') }}" class="dash-nav-item {{ request()->routeIs('settings') ? 'active' : '' }}">
                        <span class="nav-label"><span class="icon">⚙️</span> সেটিংস</span>
                    </a>
                </nav>
            </aside>

            <!-- Main Dashboard Body Content -->
            <div class="dash-main">
                @yield('dash-content')
            </div>
        </div>
    </div>
</div>
@endsection
