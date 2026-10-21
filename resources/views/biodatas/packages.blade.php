@extends('layouts.dashboard-layout')

@section('title', 'প্যাকেজ ও সংযোগ সুবিধা | '.config('app.name'))

@section('dash-content')
<style>
    .packages-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 24px;
        margin-top: 20px;
    }

    .pkg-card {
        background: #ffffff;
        border: 1.5px solid #e5e0d3;
        border-radius: 16px;
        padding: 28px 24px;
        box-shadow: 0 4px 15px rgba(6, 40, 32, 0.03);
        text-align: center;
        position: relative;
        transition: transform 0.2s ease, border-color 0.2s ease;
    }

    .pkg-card:hover, .pkg-card.popular {
        transform: translateY(-4px);
        border-color: #cba135;
        box-shadow: 0 8px 25px rgba(203, 161, 53, 0.15);
    }

    .pkg-card .badge {
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background: #cba135;
        color: #062820;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 14px;
        border-radius: 20px;
    }

    .pkg-title {
        font-family: var(--serif);
        font-size: 22px;
        font-weight: 700;
        color: #062820;
        margin: 10px 0 6px;
    }

    .pkg-price {
        font-family: var(--serif);
        font-size: 32px;
        font-weight: 700;
        color: #062820;
        margin-bottom: 20px;
    }

    .pkg-features {
        list-style: none;
        padding: 0;
        margin: 0 0 24px;
        font-size: 13px;
        color: #69766f;
        line-height: 2.2;
        text-align: left;
    }

    .btn-buy {
        display: block;
        width: 100%;
        padding: 12px;
        background: #062820;
        color: #cba135;
        border: 1.5px solid #cba135;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-buy:hover {
        background: #0d493a;
        color: #ffffff;
    }
</style>

<div style="background: #ffffff; border: 1.5px solid #e5e0d3; border-radius: 16px; padding: 24px 28px; box-shadow: 0 4px 15px rgba(6, 40, 32, 0.03); margin-bottom: 24px;">
    <h1 style="font-family: var(--serif); font-size: 24px; font-weight: 700; color: #062820; margin: 0 0 6px;">💎 সংযোগ প্যাকেজসমূহ</h1>
    <p style="font-size: 13px; color: #69766f; margin: 0;">আপনার পছন্দ অনুযায়ী অভিভাবকদের সাথে যোগাযোগের কানেকশন ক্রয়ের সুবিধা।</p>
</div>

<div class="packages-grid">
    @forelse($plans as $plan)
        <div class="pkg-card {{ $plan->is_popular ? 'popular' : '' }}">
            @if($plan->badge)
                <span class="badge" @if($plan->is_popular) style="background: #062820; color: #cba135; border: 1px solid #cba135;" @endif>{{ $plan->badge }}</span>
            @endif
            <div class="pkg-title">{{ $plan->name }}</div>
            <div class="pkg-price">৳{{ number_format($plan->price) }} <span>{{ $plan->period }}</span></div>
            <ul class="pkg-features">
                @if(is_array($plan->features))
                    @foreach($plan->features as $feature)
                        <li>✓ {{ $feature }}</li>
                    @endforeach
                @endif
            </ul>
            <a href="{{ $plan->button_link }}" class="btn-buy">{{ $plan->button_text }}</a>
        </div>
    @empty
        <div style="grid-column: 1/-1; text-align: center; color: #69766f; padding: 30px;">
            কোনো সক্রিয় প্যাকেজ পাওয়া যায়নি।
        </div>
    @endforelse
</div>
@endsection
