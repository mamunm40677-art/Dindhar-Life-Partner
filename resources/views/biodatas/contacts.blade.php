@extends('layouts.dashboard-layout')

@section('title', 'যোগাযোগ তথ্য | '.config('app.name'))

@section('dash-content')
<style>
    .gift-banner {
        background: #fffdf5;
        border: 1.5px solid #cba135;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 15px rgba(203, 161, 53, 0.08);
        margin-bottom: 28px;
    }

    .gift-banner-top {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 20px;
    }

    .gift-icon-wrap {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #062820;
        border: 2px solid #cba135;
        color: #cba135;
        display: grid;
        place-items: center;
        font-size: 24px;
        flex-shrink: 0;
    }

    .gift-steps-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .gift-step-box {
        background: #ffffff;
        border: 1px solid #e5e0d3;
        border-radius: 12px;
        padding: 16px;
        text-align: center;
    }

    .gift-step-box .title {
        font-size: 11px;
        color: #69766f;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .gift-step-box .badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        background: #e6f4ea;
        color: #137333;
    }

    .contact-tabs-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 24px;
    }

    .tab-btn-lg {
        padding: 14px;
        border-radius: 30px;
        border: 1.5px solid #062820;
        background: #ffffff;
        color: #062820;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .tab-btn-lg:hover, .tab-btn-lg.active {
        background: #062820;
        color: #cba135;
        border-color: #062820;
    }

    .contact-card-main {
        background: #ffffff;
        border: 1.5px solid #e5e0d3;
        border-radius: 16px;
        padding: 40px 24px;
        box-shadow: 0 4px 20px rgba(6, 40, 32, 0.03);
        text-align: center;
    }

    .btn-action-main {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 28px;
        border-radius: 30px;
        background: #062820;
        color: #cba135;
        border: 1.5px solid #cba135;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-action-main:hover {
        background: #0d493a;
        color: #ffffff;
    }

    @media (max-width: 760px) {
        .gift-steps-grid {
            grid-template-columns: 1fr;
        }
        .contact-tabs-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Gift Banner -->
<div class="gift-banner">
    <div class="gift-banner-top">
        <div class="gift-icon-wrap">🎁</div>
        <div>
            <span style="background: #cba135; color: #062820; font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 4px; text-transform: uppercase;">প্রতি মাসে উপহার</span>
            <h2 style="font-family: var(--serif); font-size: 20px; font-weight: 700; color: #062820; margin: 4px 0;">স্ট্যাটাস আপডেট রাখুন, জিতে নিন বিবাহের উপহার</h2>
            <p style="font-size: 12px; color: #69766f; margin: 0;">দ্বীনদার পার্টনারের মাধ্যমে যাদের বিবাহ সম্পন্ন হয়, তাদের মধ্য থেকে প্রতি মাসে একজন নবদম্পতিকে আমরা উপহার দিই ইনশাআল্লাহ।</p>
        </div>
    </div>

    <div class="gift-steps-grid">
        <div class="gift-step-box">
            <div class="title">ধাপ ১</div>
            <span class="badge">💬 কথা চলছে</span>
        </div>
        <div class="gift-step-box">
            <div class="title">ধাপ ২</div>
            <span class="badge" style="background: #e0f2fe; color: #0369a1;">📅 বিবাহ ঠিক হয়েছে</span>
        </div>
        <div class="gift-step-box">
            <div class="title">ধাপ ৩</div>
            <span class="badge" style="background: #fef3c7; color: #b45309;">💖 বিবাহ হয়েছে</span>
        </div>
    </div>
</div>

<!-- Contact Tabs -->
<div class="contact-tabs-row">
    <button class="tab-btn-lg active" onclick="switchContactTab(1, this)">
        📞 আমি নিয়েছি (০)
    </button>
    <button class="tab-btn-lg" onclick="switchContactTab(2, this)">
        📩 আমার তথ্য নিয়েছে (০)
    </button>
</div>

<!-- Main Content Card -->
<div class="contact-card-main">
    <!-- Tab Pane 1 -->
    <div id="contact-pane-1">
        <div style="font-size: 50px; margin-bottom: 12px; color: #dc2626;">❌</div>
        <h2 style="font-family: var(--serif); font-size: 22px; color: #062820; margin: 0 0 10px;">কোন বায়োডাটার যোগাযোগ তথ্য নেয়া হয় নি!</h2>
        <p style="font-size: 13px; color: #69766f; max-width: 520px; margin: 0 auto 24px; line-height: 1.8;">
            বায়োডাটা পেজ থেকে আপনি বায়োডাটা পছন্দ করে যোগাযোগ করার জন্য কার্ট যুক্ত করতে পারেন। দ্রুত আপনার জীবনসঙ্গীকে শুরু করে ফেলুন ইনশাআল্লাহ।
        </p>
        <a href="{{ route('biodatas.index') }}" class="btn-action-main">
            📞 বায়োডাটার সাথে যোগাযোগ করি ↗
        </a>
    </div>

    <!-- Tab Pane 2 -->
    <div id="contact-pane-2" style="display: none;">
        <div style="font-size: 50px; margin-bottom: 12px; color: #cba135;">📩</div>
        <h2 style="font-family: var(--serif); font-size: 22px; color: #062820; margin: 0 0 10px;">আপনার যোগাযোগ তথ্য এখনো কেউ সংগ্রহ করেনি</h2>
        <p style="font-size: 13px; color: #69766f; max-width: 520px; margin: 0 auto 24px; line-height: 1.8;">
            অন্যান্য দ্বীনদার ইউজারগণ আপনার সাথে যোগাযোগের আগ্রহ প্রকাশ করলে তাদের তালিকা এখানে দেখাবে ইনশাআল্লাহ।
        </p>
    </div>
</div>

<script>
    function switchContactTab(step, btn) {
        var p1 = document.getElementById('contact-pane-1');
        var p2 = document.getElementById('contact-pane-2');
        var btns = document.querySelectorAll('.tab-btn-lg');

        btns.forEach(function(b) { b.classList.remove('active'); });
        btn.classList.add('active');

        if (step === 1) {
            p1.style.display = 'block';
            p2.style.display = 'none';
        } else {
            p1.style.display = 'none';
            p2.style.display = 'block';
        }
    }
</script>
@endsection
