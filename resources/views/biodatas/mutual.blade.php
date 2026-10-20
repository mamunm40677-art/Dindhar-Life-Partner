@extends('layouts.app')

@section('title', 'মিউচুয়াল ম্যাচ বায়োডাটা | '.config('app.name'))

@section('content')
<style>
    :root {
        --m-green: #062820;
        --m-green-hover: #0d493a;
        --m-gold: #cba135;
        --m-bg: #f8f7f2;
        --m-card: #ffffff;
        --m-border: #e5e0d3;
        --m-text: #15382f;
        --m-muted: #69766f;
    }

    .mutual-container {
        padding: 40px 0 70px;
        background: var(--m-bg);
        min-height: calc(100vh - 250px);
    }

    .mutual-head-card {
        background: var(--m-card);
        border: 1.5px solid var(--m-border);
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

    .mutual-head-title h1 {
        font-family: var(--serif);
        font-size: 24px;
        font-weight: 700;
        color: var(--m-green);
        margin: 0 0 6px;
    }

    .mutual-head-title p {
        font-size: 13px;
        color: var(--m-muted);
        margin: 0;
    }

    .mutual-badge-count {
        background: var(--m-green);
        color: var(--m-gold);
        border: 1.5px solid var(--m-gold);
        padding: 8px 18px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 700;
    }

    .matches-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 22px;
    }

    .match-card {
        background: var(--m-card);
        border: 1.5px solid var(--m-border);
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
        transition: transform 0.2s ease, border-color 0.2s ease;
    }

    .match-card:hover {
        transform: translateY(-4px);
        border-color: var(--m-gold);
    }

    .match-percentage-badge {
        background: #e6f4ea;
        color: #137333;
        border: 1px solid #b7e1cd;
        font-size: 12px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: var(--m-card);
        border: 1.5px dashed var(--m-gold);
        border-radius: 16px;
        max-width: 650px;
        margin: 0 auto;
    }

    .btn-view {
        display: block;
        width: 100%;
        text-align: center;
        padding: 10px;
        background: var(--m-green);
        color: var(--m-gold);
        border: 1.5px solid var(--m-gold);
        border-radius: 30px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        margin-top: 16px;
        transition: all 0.2s ease;
    }

    .btn-view:hover {
        background: var(--m-green-hover);
        color: #ffffff;
    }
</style>

<div class="mutual-container">
    <div class="container">
        <!-- Header Card -->
        <div class="mutual-head-card">
            <div class="mutual-head-title">
                <h1>🤝 মিউচুয়াল ম্যাচ বায়োডাটা</h1>
                <p>যেসব বায়োডাটার সাথে আপনার পছন্দ এবং তাদের পছন্দ — উভয় দিক থেকেই মেলে।</p>
            </div>
            <div class="mutual-badge-count">
                {{ $matches->count() }} টি সম্ভাব্য ম্যাচ
            </div>
        </div>

        @if ($matches->count() > 0)
            <div class="matches-grid">
                @foreach ($matches as $b)
                    <div class="match-card">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
                            <span class="match-percentage-badge">
                                🎯 {{ $b->match_percentage }}% মেলবন্ধন (Match)
                            </span>
                            <span style="font-size: 11px; font-weight: 700; color: var(--m-green); background: #f1efe5; padding: 3px 8px; border-radius: 4px;">
                                #{{ $b->id }}
                            </span>
                        </div>

                        <div style="text-align: center; margin-bottom: 14px;">
                            <div style="width: 56px; height: 56px; border-radius: 50%; background: #062820; border: 2px solid var(--m-gold); color: var(--m-gold); display: grid; place-items: center; font-size: 22px; margin: 0 auto 8px;">
                                {{ $b->gender === 'groom' || $b->gender === 'male' ? '🧔' : '🧕' }}
                            </div>
                            <h3 style="font-family: var(--serif); font-size: 18px; color: var(--m-green); margin: 0;">{{ $b->display_name }}</h3>
                        </div>

                        <ul style="list-style: none; padding: 0; margin: 0 0 16px; font-size: 13px; color: var(--m-muted); line-height: 2;">
                            <li>📍 শহর: <strong>{{ $b->city }}</strong></li>
                            <li>🎂 বয়স: <strong>{{ $b->age }} বছর</strong></li>
                            <li>💍 বৈবাহিক অবস্থা: <strong>{{ $b->marital_status }}</strong></li>
                            <li>🎓 শিক্ষা: <strong>{{ $b->education }}</strong></li>
                        </ul>

                        <a href="{{ route('biodatas.show', $b) }}" class="btn-view">
                            👁️ পুরো বায়োডাটা দেখুন ↗
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div style="font-size: 48px; margin-bottom: 14px;">🤝</div>
                <h2 style="font-family: var(--serif); font-size: 22px; color: var(--m-green); margin: 0 0 10px;">এখনো কোন মিউচুয়াল ম্যাচ পাওয়া যায়নি</h2>
                <p style="font-size: 13px; color: var(--m-muted); line-height: 1.8; margin: 0 0 20px;">
                    আপনার বায়োডাটা তথ্য সম্পূর্ণ ও সঠিকভাবে দেওয়া থাকলে নতুন বায়োডাটা যুক্ত হওয়ার সাথে সাথেই এখানে অটোমেটিক শতাংশ (%) অনুযায়ী ম্যাচ দেখতে পাবেন ইনশাআল্লাহ।
                </p>
                @if (!$myBiodata)
                    <a href="{{ route('my-biodata.create') }}" style="display: inline-block; padding: 10px 24px; background: var(--m-gold); color: var(--m-green); font-weight: 700; border-radius: 30px; text-decoration: none;">
                        ✨ প্রথমে আপনার বায়োডাটা তৈরি করুন
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
