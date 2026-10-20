@extends('layouts.app')

@section('title', __('site.dashboard_title').' | '.config('app.name'))

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

    .dash-nav-item .icon {
        font-size: 16px;
    }

    /* Main Dashboard Cards */
    .dash-main {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    /* Notice Banner */
    .dash-alert-banner {
        background: #fffdf5;
        border: 1.5px solid var(--dash-gold);
        border-radius: 12px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 14px;
        color: var(--dash-green);
        font-size: 13px;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(203, 161, 53, 0.08);
    }

    /* Stats Row */
    .dash-stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
    }

    .dash-stat-card {
        background: var(--dash-card);
        border: 1.5px solid var(--dash-border);
        border-radius: 14px;
        padding: 22px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
    }

    .dash-stat-card .card-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .dash-stat-card .title {
        font-size: 12px;
        font-weight: 700;
        color: var(--dash-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .dash-stat-card .value {
        font-family: var(--serif);
        font-size: 24px;
        font-weight: 700;
        color: var(--dash-green);
    }

    .dash-btn-gold {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 30px;
        background: var(--dash-gold);
        color: var(--dash-green);
        border: 1.5px solid var(--dash-gold);
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .dash-btn-gold:hover {
        background: var(--dash-gold-hover);
        border-color: var(--dash-gold-hover);
        color: #000000;
    }

    .dash-btn-green {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 30px;
        background: var(--dash-green);
        color: var(--dash-gold);
        border: 1.5px solid var(--dash-gold);
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .dash-btn-green:hover {
        background: var(--dash-green-light);
        color: #ffffff;
    }

    .dash-btn-outline {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 30px;
        background: #ffffff;
        color: var(--dash-green);
        border: 1.5px solid var(--dash-green);
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .dash-btn-outline:hover {
        background: var(--dash-green);
        color: #ffffff;
    }

    /* Biodata Card */
    .dash-card {
        background: var(--dash-card);
        border: 1.5px solid var(--dash-border);
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
    }

    .dash-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 18px;
        border-bottom: 1.5px solid var(--dash-border);
        margin-bottom: 20px;
    }

    .dash-card-title {
        font-family: var(--serif);
        font-size: 20px;
        font-weight: 700;
        color: var(--dash-green);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .info-box {
        background: #fcfbf8;
        border: 1px solid var(--dash-border);
        padding: 14px 18px;
        border-radius: 10px;
    }

    .info-box .label {
        font-size: 11px;
        color: var(--dash-muted);
        font-weight: 600;
        margin-bottom: 4px;
    }

    .info-box .val {
        font-size: 14px;
        font-weight: 700;
        color: var(--dash-green);
    }

    @media (max-width: 850px) {
        .dash-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dash-container">
    <div class="container">
        <div class="dash-grid">
            <!-- Left Sidebar Navigation -->
            <aside class="dash-sidebar">
                <div class="dash-user-profile">
                    <div class="dash-avatar-circle">
                        {{ mb_substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="dash-user-name">{{ auth()->user()->name }}</div>
                    <div class="dash-user-email">{{ auth()->user()->email }}</div>

                    @if ($biodata)
                        <span class="dash-badge-status {{ $biodata->published ? '' : 'draft' }}">
                            {{ $biodata->published ? '🟢 বায়োডাটা পাবলিশড' : '🟡 পেন্ডিং/ড্রাফট' }}
                        </span>
                    @else
                        <span class="dash-badge-status draft">
                            🔴 বায়োডাটা তৈরি করা নেই
                        </span>
                    @endif
                </div>

                <nav class="dash-nav">
                    <a href="{{ route('dashboard') }}" class="dash-nav-item active">
                        <span class="icon">📊</span> ড্যাশবোর্ড
                    </a>
                    <a href="{{ route('mutual-matches') }}" class="dash-nav-item">
                        <span class="icon">🤝</span> মিউচুয়াল ম্যাচ বায়োডাটা
                    </a>
                    <a href="{{ route('preference-matches') }}" class="dash-nav-item">
                        <span class="icon">✨</span> পছন্দ অনুযায়ী মিল
                    </a>
                    <a href="{{ route('online-users') }}" class="dash-nav-item">
                        <span class="icon">📡</span> অনলাইন ইউজার
                    </a>
                    <a href="{{ route('unlocked-contacts') }}" class="dash-nav-item">
                        <span class="icon">📞</span> যোগাযোগ তথ্য
                    </a>
                    <a href="{{ route('biodatas.index') }}" class="dash-nav-item">
                        <span class="icon">🔍</span> বায়োডাটা ব্রাউজ করুন
                    </a>
                    @if ($biodata)
                        <a href="{{ route('biodatas.show', $biodata) }}" class="dash-nav-item">
                            <span class="icon">👁️</span> আমার বায়োডাটা
                        </a>
                        <a href="{{ route('my-biodata.edit', $biodata) }}" class="dash-nav-item">
                            <span class="icon">✎</span> এডিট বায়োডাটা
                        </a>
                    @else
                        <a href="{{ route('my-biodata.create') }}" class="dash-nav-item">
                            <span class="icon">＋</span> নতুন বায়োডাটা তৈরি করুন
                        </a>
                    @endif
                    <a href="{{ route('settings') }}" class="dash-nav-item">
                        <span class="icon">⚙️</span> গুরুত্বপূর্ণ সেটিংস
                    </a>
                    <a href="{{ route('guide') }}" class="dash-nav-item">
                        <span class="icon">📖</span> দিকনির্দেশনা ও গাইড
                    </a>
                    <a href="{{ route('contact') }}" class="dash-nav-item">
                        <span class="icon">🎧</span> হেল্পলাইন ও সাপোর্ট
                    </a>
                </nav>
            </aside>

            <!-- Main Dashboard Body -->
            <div class="dash-main">
                <!-- Warning / Alert Banner -->
                <div class="dash-alert-banner">
                    <span style="font-size: 22px;">📢</span>
                    <div>
                        <strong>শরীয়াহ সম্মত ইসলামিক বিবাহ প্ল্যাটফর্ম:</strong>
                        <span style="font-weight: 400; color: #3a4d45;"> আপনার বায়োডাটা সম্পূর্ণ করুন যাতে অভিভাবকগণ সহজে আপনার সাথে যোগাযোগ করতে পারেন।</span>
                    </div>
                </div>

                <!-- Metrics & Stats -->
                <div class="dash-stats-row">
                    <!-- Stat 1: Active Package -->
                    <div class="dash-stat-card">
                        <div class="card-head">
                            <span class="title">👑 সক্রিয় প্যাকেজ</span>
                            <span style="font-size: 18px;">💎</span>
                        </div>
                        <div class="value" style="font-size: 18px; margin-bottom: 12px;">ফ্রি প্যাকেজ (মৌলিক)</div>
                        <a href="{{ route('home') }}#packages" class="dash-btn-gold" style="padding: 6px 14px; font-size: 11px; width: 100%;">
                            প্যাকেজ আপডেট করুন ↗
                        </a>
                    </div>

                    <!-- Stat 2: Profile Status -->
                    <div class="dash-stat-card">
                        <div class="card-head">
                            <span class="title">📜 বায়োডাটা স্ট্যাটাস</span>
                            <span style="font-size: 18px;">📋</span>
                        </div>
                        <div class="value" style="font-size: 18px; margin-bottom: 12px;">
                            {{ $biodata ? ($biodata->published ? 'পাবলিশড' : 'ড্রাফট') : 'অনুপস্থিত' }}
                        </div>
                        <span style="font-size: 11px; color: var(--dash-muted);">
                            তারিখ: {{ $biodata?->updated_at?->format('d M Y') ?? '—' }}
                        </span>
                    </div>

                    <!-- Stat 3: Registration Info -->
                    <div class="dash-stat-card">
                        <div class="card-head">
                            <span class="title">🗓️ সদস্যপদ সময়কাল</span>
                            <span style="font-size: 18px;">⏳</span>
                        </div>
                        <div class="value" style="font-size: 18px; margin-bottom: 12px;">
                            {{ $memberSince?->translatedFormat('M Y') }}
                        </div>
                        <span style="font-size: 11px; color: var(--dash-muted);">
                            আইডি: #{{ auth()->id() }}
                        </span>
                    </div>
                </div>

                <!-- Main Biodata Overview Card -->
                <div class="dash-card">
                    <div class="dash-card-header">
                        <div>
                            <span style="color: var(--dash-gold); font-size: 11px; font-weight: 700; text-transform: uppercase;">আপনার বায়োডাটা তথ্য</span>
                            <div class="dash-card-title">{{ $biodata?->display_name ?? 'বায়োডাটা তৈরি করা নেই' }}</div>
                        </div>

                        @if ($biodata)
                            <a href="{{ route('my-biodata.edit', $biodata) }}" class="dash-btn-green">
                                ✎ এডিট বায়োডাটা
                            </a>
                        @else
                            <a href="{{ route('my-biodata.create') }}" class="dash-btn-gold">
                                ＋ বায়োডাটা তৈরি করুন
                            </a>
                        @endif
                    </div>

                    @if ($biodata)
                        <div class="info-grid">
                            <div class="info-box">
                                <div class="label">লিঙ্গ (Gender)</div>
                                <div class="val">{{ __('site.gender_'.$biodata->gender) }}</div>
                            </div>
                            <div class="info-box">
                                <div class="label">বয়স (Age)</div>
                                <div class="val">{{ $biodata->age }} বছর</div>
                            </div>
                            <div class="info-box">
                                <div class="label">জেলা / শহর</div>
                                <div class="val">{{ $biodata->city }}</div>
                            </div>
                            <div class="info-box">
                                <div class="label">শিক্ষাগত যোগ্যতা</div>
                                <div class="val">{{ $biodata->education }}</div>
                            </div>
                            <div class="info-box" style="grid-column: 1 / -1;">
                                <div class="label">পেশা</div>
                                <div class="val">{{ $biodata->occupation }}</div>
                            </div>
                        </div>

                        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                            <a href="{{ route('my-biodata.edit', $biodata) }}" class="dash-btn-outline">
                                ✎ তথ্য সংশোধন করুন
                            </a>
                            @if ($biodata->published)
                                <a href="{{ route('biodatas.show', $biodata) }}" class="dash-btn-green">
                                    👁️ সরাসরি বায়োডাটা দেখুন ↗
                                </a>
                            @endif
                        </div>
                    @else
                        <div style="text-align: center; padding: 40px 20px; background: #fbfaf6; border: 1.5px dashed var(--dash-gold); border-radius: 12px;">
                            <div style="font-size: 32px; margin-bottom: 10px;">📜</div>
                            <h3 style="font-family: var(--serif); font-size: 18px; color: var(--dash-green); margin: 0 0 8px;">আপনার এখনো কোনো বায়োডাটা তৈরি করা হয়নি</h3>
                            <p style="font-size: 13px; color: var(--dash-muted); max-width: 480px; margin: 0 auto 20px;">
                                পাত্র/পাত্রীর বায়োডাটা তৈরি করে প্রকাশ করলে সম্মানিত অভিভাবক ও দ্বীনদার ব্যক্তিগণ আপনার সাথে যোগাযোগ করতে পারবেন।
                            </p>
                            <a href="{{ route('my-biodata.create') }}" class="dash-btn-gold">
                                ✨ বিনামূল্যে বায়োডাটা তৈরি করুন
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
