@extends('layouts.app')

@section('title', 'অনলাইন ইউজার | '.config('app.name'))

@section('content')
<style>
    :root {
        --o-green: #062820;
        --o-green-hover: #0d493a;
        --o-gold: #cba135;
        --o-bg: #f8f7f2;
        --o-card: #ffffff;
        --o-border: #e5e0d3;
        --o-text: #15382f;
        --o-muted: #69766f;
    }

    .online-container {
        padding: 40px 0 70px;
        background: var(--o-bg);
        min-height: calc(100vh - 250px);
    }

    .online-head-card {
        background: var(--o-card);
        border: 1.5px solid var(--o-border);
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

    .online-head-title h1 {
        font-family: var(--serif);
        font-size: 24px;
        font-weight: 700;
        color: var(--o-green);
        margin: 0 0 6px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .online-head-title p {
        font-size: 13px;
        color: var(--o-muted);
        margin: 0;
    }

    .online-badge-count {
        background: var(--o-green);
        color: var(--o-gold);
        border: 1.5px solid var(--o-gold);
        padding: 8px 18px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .online-dot-pulse {
        width: 10px;
        height: 10px;
        background: #22c55e;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
    }

    .online-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 22px;
    }

    .online-card {
        background: var(--o-card);
        border: 1.5px solid var(--o-border);
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
        transition: transform 0.2s ease, border-color 0.2s ease;
    }

    .online-card:hover {
        transform: translateY(-4px);
        border-color: var(--o-gold);
    }

    .btn-full-bio {
        display: block;
        width: 100%;
        text-align: center;
        padding: 10px;
        background: var(--o-green);
        color: var(--o-gold);
        border: 1.5px solid var(--o-gold);
        border-radius: 30px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        margin-top: 16px;
        transition: all 0.2s ease;
    }

    .btn-full-bio:hover {
        background: var(--o-green-hover);
        color: #ffffff;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: var(--o-card);
        border: 1.5px dashed var(--o-gold);
        border-radius: 16px;
        max-width: 650px;
        margin: 0 auto;
    }
</style>

<div class="online-container">
    <div class="container">
        <!-- Header Card -->
        <div class="online-head-card">
            <div class="online-head-title">
                <h1>📡 অনলাইন ইউজার</h1>
                <p>যারা এখন ওয়েবসাইটে সক্রিয় আছেন — তালিকাটি রিয়েল-টাইমে আপডেট হয়।</p>
            </div>
            <div class="online-badge-count">
                <span class="online-dot-pulse"></span>
                {{ $onlineBiodatas->count() }} জন বর্তমানে অনলাইনে
            </div>
        </div>

        @if ($onlineBiodatas->count() > 0)
            <div class="online-grid">
                @foreach ($onlineBiodatas as $b)
                    <div class="online-card">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
                            <span style="background: #e6f4ea; color: #137333; font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 20px; display: inline-flex; align-items: center; gap: 5px;">
                                <span style="width: 7px; height: 7px; background: #22c55e; border-radius: 50%;"></span> Online
                            </span>
                            <span style="font-size: 11px; font-weight: 700; color: var(--o-green); background: #f1efe5; padding: 3px 8px; border-radius: 4px;">
                                Bio No - {{ $b->id }}
                            </span>
                        </div>

                        <div style="text-align: center; margin-bottom: 14px;">
                            <div style="width: 56px; height: 56px; border-radius: 50%; background: #062820; border: 2px solid var(--o-gold); color: var(--o-gold); display: grid; place-items: center; font-size: 22px; margin: 0 auto 8px;">
                                {{ $b->gender === 'groom' || $b->gender === 'male' ? '🧔' : '🧕' }}
                            </div>
                            <h3 style="font-family: var(--serif); font-size: 18px; color: var(--o-green); margin: 0;">{{ $b->display_name }}</h3>
                            <span style="font-size: 11px; color: var(--o-gold); font-weight: 700;">{{ $b->gender === 'groom' || $b->gender === 'male' ? 'পাত্র' : 'পাত্রী' }}</span>
                        </div>

                        <ul style="list-style: none; padding: 0; margin: 0 0 16px; font-size: 13px; color: var(--o-muted); line-height: 2;">
                            <li>🎂 বয়স: <strong>{{ $b->age }} বছর</strong></li>
                            <li>📍 জেলা: <strong>{{ $b->city }}</strong></li>
                            <li>💍 অবস্থা: <strong>{{ $b->marital_status }}</strong></li>
                            <li>🎓 শিক্ষা/পেশা: <strong>{{ $b->occupation }}</strong></li>
                        </ul>

                        <a href="{{ route('biodatas.show', $b) }}" class="btn-full-bio">
                            সম্পূর্ণ বায়োডাটা দেখুন ↗
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div style="font-size: 48px; margin-bottom: 14px;">📡</div>
                <h2 style="font-family: var(--serif); font-size: 22px; color: var(--o-green); margin: 0 0 10px;">বর্তমানে কোনো সক্রিয় অনলাইন ইউজার নেই</h2>
                <p style="font-size: 13px; color: var(--o-muted); margin: 0;">
                    অন্যান্য ইউজারগণ অনলাইন হলেই স্বয়ংক্রিয়ভাবে এখানে প্রদর্শিত হবে।
                </p>
            </div>
        @endif
    </div>
</div>
@endsection
