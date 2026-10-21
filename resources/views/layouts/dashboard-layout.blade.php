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
        grid-template-columns: 280px 1fr;
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
        gap: 8px;
    }

    .dash-nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
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

                <nav class="dash-nav">
                    <a href="{{ route('dashboard') }}" class="dash-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <span class="icon">📊</span> ড্যাশবোর্ড
                    </a>
                    <a href="{{ route('mutual-matches') }}" class="dash-nav-item {{ request()->routeIs('mutual-matches') ? 'active' : '' }}">
                        <span class="icon">🤝</span> মিউচুয়াল ম্যাচ বায়োডাটা
                    </a>
                    <a href="{{ route('preference-matches') }}" class="dash-nav-item {{ request()->routeIs('preference-matches') ? 'active' : '' }}">
                        <span class="icon">✨</span> পছন্দ অনুযায়ী মিল
                    </a>
                    <a href="{{ route('online-users') }}" class="dash-nav-item {{ request()->routeIs('online-users') ? 'active' : '' }}">
                        <span class="icon">📡</span> অনলাইন ইউজার
                    </a>
                    <a href="{{ route('biodatas.index') }}" class="dash-nav-item {{ request()->routeIs('biodatas.index') ? 'active' : '' }}">
                        <span class="icon">🔍</span> বায়োডাটা ব্রাউজ করুন
                    </a>
                    @if ($myBiodata)
                        <a href="{{ route('biodatas.show', $myBiodata) }}" class="dash-nav-item {{ request()->routeIs('biodatas.show') && request()->route('biodata')->id == $myBiodata->id ? 'active' : '' }}">
                            <span class="icon">👁️</span> আমার বায়োডাটা
                        </a>
                        <a href="{{ route('my-biodata.edit', $myBiodata) }}" class="dash-nav-item {{ request()->routeIs('my-biodata.edit') ? 'active' : '' }}">
                            <span class="icon">✎</span> এডিট বায়োডাটা
                        </a>
                    @else
                        <a href="{{ route('my-biodata.create') }}" class="dash-nav-item {{ request()->routeIs('my-biodata.create') ? 'active' : '' }}">
                            <span class="icon">＋</span> নতুন বায়োডাটা তৈরি করুন
                        </a>
                    @endif
                    <a href="{{ route('unlocked-contacts') }}" class="dash-nav-item {{ request()->routeIs('unlocked-contacts') ? 'active' : '' }}">
                        <span class="icon">📞</span> যোগাযোগ তথ্য
                    </a>
                    <a href="{{ route('settings') }}" class="dash-nav-item {{ request()->routeIs('settings') ? 'active' : '' }}">
                        <span class="icon">⚙️</span> গুরুত্বপূর্ণ সেটিংস
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
