@extends('layouts.dashboard-layout')

@section('title', 'পছন্দ অনুযায়ী মিলে যাওয়া বায়োডাটা | '.config('app.name'))

@section('dash-content')
<style>
    .pref-head-card {
        background: #ffffff;
        border: 1.5px solid #e5e0d3;
        border-radius: 16px;
        padding: 24px 28px;
        box-shadow: 0 4px 15px rgba(6, 40, 32, 0.03);
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .pref-head-title h1 {
        font-family: var(--serif);
        font-size: 24px;
        font-weight: 700;
        color: #062820;
        margin: 0 0 6px;
    }

    .pref-head-title p {
        font-size: 13px;
        color: #69766f;
        margin: 0;
    }

    .pref-badge-count {
        background: #062820;
        color: #cba135;
        border: 1.5px solid #cba135;
        padding: 8px 18px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 700;
    }

    .matches-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 22px;
    }

    .match-card {
        background: #ffffff;
        border: 1.5px solid #e5e0d3;
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
        transition: transform 0.2s ease, border-color 0.2s ease;
    }

    .match-card:hover {
        transform: translateY(-4px);
        border-color: #cba135;
    }

    .btn-view {
        display: block;
        width: 100%;
        text-align: center;
        padding: 10px;
        background: #062820;
        color: #cba135;
        border: 1.5px solid #cba135;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        margin-top: 16px;
        transition: all 0.2s ease;
    }

    .btn-view:hover {
        background: #0d493a;
        color: #ffffff;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: #ffffff;
        border: 1.5px dashed #cba135;
        border-radius: 16px;
    }
</style>

<!-- Header Card -->
<div class="pref-head-card">
    <div class="pref-head-title">
        <h1>✨ পছন্দ অনুযায়ী মিলে যাওয়া বায়োডাটা</h1>
        <p>যেসব বায়োডাটা আপনার দেওয়া জীবনসঙ্গীর পছন্দের সাথে মিলে গিয়েছে।</p>
    </div>
    <div class="pref-badge-count">
        {{ $matches->count() }} টি বায়োডাটা
    </div>
</div>

@if ($matches->count() > 0)
    <div class="matches-grid">
        @foreach ($matches as $b)
            <div class="match-card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
                    <span style="background: #e6f4ea; color: #137333; font-size: 12px; font-weight: 700; padding: 4px 12px; border-radius: 20px;">
                        ✨ {{ $b->match_percentage }}% পছন্দসই মিল
                    </span>
                    <span style="font-size: 11px; font-weight: 700; color: #062820; background: #f1efe5; padding: 3px 8px; border-radius: 4px;">
                        #{{ $b->id }}
                    </span>
                </div>

                <div style="text-align: center; margin-bottom: 14px;">
                    <div style="width: 56px; height: 56px; border-radius: 50%; background: #062820; border: 2px solid #cba135; color: #cba135; display: grid; place-items: center; font-size: 22px; margin: 0 auto 8px;">
                        {{ $b->gender === 'groom' || $b->gender === 'male' ? '🧔' : '🧕' }}
                    </div>
                    <h3 style="font-family: var(--serif); font-size: 18px; color: #062820; margin: 0;">{{ $b->display_name }}</h3>
                </div>

                <ul style="list-style: none; padding: 0; margin: 0 0 16px; font-size: 13px; color: #69766f; line-height: 2;">
                    <li>📍 অবস্থান: <strong>{{ $b->city }}</strong></li>
                    <li>🎂 বয়স: <strong>{{ $b->age }} বছর</strong></li>
                    <li>💍 অবস্থা: <strong>{{ $b->marital_status }}</strong></li>
                    <li>💼 পেশা: <strong>{{ $b->occupation }}</strong></li>
                </ul>

                <a href="{{ route('biodatas.show', $b) }}" class="btn-view">
                    👁️ পুরো বায়োডাটা দেখুন ↗
                </a>
            </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <div style="font-size: 48px; margin-bottom: 14px;">✨</div>
        <h2 style="font-family: var(--serif); font-size: 22px; color: #062820; margin: 0 0 10px;">আপনার পছন্দ অনুযায়ী এখনো কোন বায়োডাটা পাওয়া যায়নি</h2>
        <p style="font-size: 13px; color: #69766f; line-height: 1.8; margin: 0 0 20px;">
            আপনার এক্সপেক্টেড পার্টনার তথ্য সম্পূর্ণ ও সঠিকভাবে দেওয়া থাকলে নতুন বায়োডাটা যুক্ত হওয়া মাত্রই এখানে পছন্দসই তালিকা দেখতে পাবেন ইনশাআল্লাহ।
        </p>
        @if (!$myBiodata)
            <a href="{{ route('my-biodata.create') }}" style="display: inline-block; padding: 10px 24px; background: #cba135; color: #062820; font-weight: 700; border-radius: 30px; text-decoration: none;">
                ✨ প্রথমে আপনার বায়োডাটা তৈরি করুন
            </a>
        @endif
    </div>
@endif
@endsection
