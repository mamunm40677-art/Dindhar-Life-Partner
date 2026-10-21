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
    <!-- Package 1 -->
    <div class="pkg-card">
        <span class="badge">ফ্রি ট্রায়াল</span>
        <div class="pkg-title">ফ্রি প্যাকেজ</div>
        <div class="pkg-price">৳০ <span>/ ফ্রি</span></div>
        <ul class="pkg-features">
            <li>✓ ১টি বায়োডাটা তৈরি</li>
            <li>✓ সরাসরি পাবলিক প্রোফাইল প্রকাশ</li>
            <li>✓ আনলিমিটেড বায়োডাটা ব্রাউজিং</li>
            <li>✓ বেসিক কন্টাক্ট সাপোর্ট</li>
        </ul>
        <a href="{{ route('dashboard') }}" class="btn-buy">বর্তমান প্যাকেজ</a>
    </div>

    <!-- Package 2 -->
    <div class="pkg-card popular">
        <span class="badge" style="background: #062820; color: #cba135; border: 1px solid #cba135;">জনপ্রিয়</span>
        <div class="pkg-title">স্ট্যান্ডার্ড প্যাকেজ</div>
        <div class="pkg-price">৳৪৯০ <span>/ ৫ কানেকশন</span></div>
        <ul class="pkg-features">
            <li>✓ ৫ জন অভিভাবকের সাথে সরাসরি যোগাযোগ</li>
            <li>✓ মিউচুয়াল ম্যাচ সুবিধা</li>
            <li>✓ পছন্দ অনুযায়ী রিয়েল-টাইম অটো নোটিফিকেশন</li>
            <li>✓ নিবেদিত হেল্পলাইন সাপোর্ট</li>
        </ul>
        <a href="{{ route('contact') }}" class="btn-buy">প্যাকেজ সাবস্ক্রাইব করুন</a>
    </div>

    <!-- Package 3 -->
    <div class="pkg-card">
        <span class="badge">প্রিমিয়াম</span>
        <div class="pkg-title">প্রিমিয়াম প্যাকেজ</div>
        <div class="pkg-price">৳৯৯০ <span>/ ১২ কানেকশন</span></div>
        <ul class="pkg-features">
            <li>✓ ১২ জন অভিভাবকের সরাসরি যোগাযোগ তথ্য</li>
            <li>✓ টপ লিস্টে বায়োডাটা হাইলাইট করার সুযোগ</li>
            <li>✓ প্রিমিয়াম কাস্টমার কেয়ার সার্ভিস</li>
            <li>✓ সম্পূর্ণ ভেরিফাইড ইউজার সংযোগ</li>
        </ul>
        <a href="{{ route('contact') }}" class="btn-buy">প্যাকেজ সাবস্ক্রাইব করুন</a>
    </div>
</div>
@endsection
