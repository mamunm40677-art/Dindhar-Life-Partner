@extends('layouts.app')

@section('title', $biodata->display_name.' | '.config('app.name'))

@section('content')
<style>
    :root {
        --v-green: #062820;
        --v-green-hover: #0d493a;
        --v-gold: #cba135;
        --v-gold-hover: #b88e28;
        --v-bg: #f8f7f2;
        --v-card: #ffffff;
        --v-border: #e5e0d3;
        --v-text: #15382f;
        --v-muted: #69766f;
    }

    .view-container {
        padding: 40px 0 70px;
        background: var(--v-bg);
        min-height: calc(100vh - 250px);
    }

    .view-header-card {
        background: var(--v-card);
        border: 1.5px solid var(--v-border);
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(6, 40, 32, 0.03);
        margin-bottom: 24px;
        text-align: center;
    }

    .view-avatar-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--v-green);
        border: 3px solid var(--v-gold);
        color: var(--v-gold);
        display: grid;
        place-items: center;
        font-size: 36px;
        margin: 0 auto 12px;
        box-shadow: 0 4px 12px rgba(6, 40, 32, 0.15);
    }

    .view-bio-no {
        font-family: var(--serif);
        font-size: 26px;
        font-weight: 700;
        color: var(--v-green);
        margin: 0 0 6px;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 14px;
        margin: 24px 0;
    }

    .summary-box {
        background: #fcfbf8;
        border: 1px solid var(--v-border);
        padding: 12px;
        border-radius: 10px;
        text-align: center;
    }

    .summary-box .lbl {
        font-size: 11px;
        color: var(--v-muted);
        font-weight: 600;
        margin-bottom: 4px;
    }

    .summary-box .val {
        font-size: 14px;
        font-weight: 700;
        color: var(--v-green);
    }

    .action-row {
        display: flex;
        justify-content: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-action-green {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 24px;
        border-radius: 30px;
        background: var(--v-green);
        color: var(--v-gold);
        border: 1.5px solid var(--v-gold);
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-action-green:hover {
        background: var(--v-green-hover);
        color: #ffffff;
    }

    .btn-action-outline {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 24px;
        border-radius: 30px;
        background: #ffffff;
        color: var(--v-green);
        border: 1.5px solid var(--v-green);
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    /* Tabs Bar */
    .view-tabs-card {
        background: var(--v-card);
        border: 1.5px solid var(--v-border);
        border-radius: 16px;
        padding: 12px;
        box-shadow: 0 4px 20px rgba(6, 40, 32, 0.03);
        margin-bottom: 24px;
        display: flex;
        gap: 8px;
        overflow-x: auto;
    }

    .tab-btn {
        padding: 10px 18px;
        border-radius: 30px;
        border: 1px solid var(--v-border);
        background: #fcfbf8;
        color: var(--v-text);
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.2s ease;
    }

    .tab-btn:hover, .tab-btn.active {
        background: var(--v-green);
        color: var(--v-gold);
        border-color: var(--v-green);
    }

    /* Content Body Card */
    .view-body-card {
        background: var(--v-card);
        border: 1.5px solid var(--v-border);
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(6, 40, 32, 0.03);
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
    }

    .tab-pane h2 {
        font-family: var(--serif);
        font-size: 20px;
        font-weight: 700;
        color: var(--v-green);
        margin: 0 0 16px;
        padding-bottom: 10px;
        border-bottom: 1.5px solid var(--v-border);
    }

    .info-list-rows {
        display: grid;
        gap: 14px;
    }

    .info-row-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 16px;
        background: #fcfbf8;
        border-radius: 8px;
        border: 1px solid var(--v-border);
        font-size: 14px;
    }

    .info-row-item .title {
        font-weight: 600;
        color: var(--v-muted);
    }

    .info-row-item .value {
        font-weight: 700;
        color: var(--v-green);
    }
</style>

<div class="view-container">
    <div class="container" style="max-width: 900px;">
        <!-- Profile Header Card -->
        <div class="view-header-card">
            <div class="view-avatar-circle">
                {{ $biodata->gender === 'groom' || $biodata->gender === 'male' ? '🧔' : '🧕' }}
            </div>
            <div class="view-bio-no">Bio No - {{ $biodata->id }}</div>
            <h2 style="font-family: var(--serif); font-size: 20px; color: var(--v-green); margin: 0 0 6px;">{{ $biodata->display_name }}</h2>

            <div class="summary-grid">
                <div class="summary-box">
                    <div class="lbl">বয়স (Age)</div>
                    <div class="val">{{ $biodata->age }} বছর</div>
                </div>
                <div class="summary-box">
                    <div class="lbl">বৈবাহিক অবস্থা</div>
                    <div class="val">{{ $biodata->marital_status }}</div>
                </div>
                <div class="summary-box">
                    <div class="lbl">জেলা / শহর</div>
                    <div class="val">{{ $biodata->city }}</div>
                </div>
                <div class="summary-box">
                    <div class="lbl">পেশা</div>
                    <div class="val">{{ $biodata->occupation }}</div>
                </div>
                <div class="summary-box">
                    <div class="lbl">শিক্ষা</div>
                    <div class="val">{{ $biodata->education }}</div>
                </div>
            </div>

            <div class="action-row">
                @auth
                    @if (auth()->user()->biodata?->is($biodata))
                        <a href="{{ route('my-biodata.edit', $biodata) }}" class="btn-action-green">
                            ✎ তথ্য আপডেট করুন
                        </a>
                    @endif
                @endauth
                <button class="btn-action-outline" onclick="navigator.clipboard.writeText(window.location.href); alert('বায়োডাটা লিংক কপি হয়েছে!');">
                    🔗 বায়োডাটা লিংক কপি
                </button>
            </div>
        </div>

        <!-- Category Tabs -->
        <div class="view-tabs-card">
            <button class="tab-btn active" onclick="switchViewTab(1, this)">👤 সাধারণ তথ্য</button>
            <button class="tab-btn" onclick="switchViewTab(2, this)">✎ নিজের সম্পর্কে</button>
            <button class="tab-btn" onclick="switchViewTab(3, this)">👨‍👩‍👧 পারিবারিক তথ্য</button>
            <button class="tab-btn" onclick="switchViewTab(4, this)">🎓 শিক্ষা ও পেশা</button>
            <button class="tab-btn" onclick="switchViewTab(5, this)">☪️ দ্বীনি তথ্য</button>
            <button class="tab-btn" onclick="switchViewTab(6, this)">💍 বৈবাহিক তথ্য</button>
        </div>

        <!-- Tab Body Content -->
        <div class="view-body-card">
            <!-- Tab 1: General Info -->
            <div class="tab-pane active" id="view-pane-1">
                <h2>১. সাধারণ তথ্য</h2>
                <div class="info-list-rows">
                    <div class="info-row-item">
                        <span class="title">ডিসপ্লে নাম</span>
                        <span class="value">{{ $biodata->display_name }}</span>
                    </div>
                    <div class="info-row-item">
                        <span class="title">বায়োডাটার ধরন</span>
                        <span class="value">{{ $biodata->gender === 'groom' || $biodata->gender === 'male' ? 'পাত্রের বায়োডাটা' : 'পাত্রীর বায়োডাটা' }}</span>
                    </div>
                    <div class="info-row-item">
                        <span class="title">বয়স</span>
                        <span class="value">{{ $biodata->age }} বছর</span>
                    </div>
                    <div class="info-row-item">
                        <span class="title">বৈবাহিক অবস্থা</span>
                        <span class="value">{{ $biodata->marital_status }}</span>
                    </div>
                    <div class="info-row-item">
                        <span class="title">জেলা / অবস্থান</span>
                        <span class="value">{{ $biodata->city }}</span>
                    </div>
                </div>
            </div>

            <!-- Tab 2: About -->
            <div class="tab-pane" id="view-pane-2">
                <h2>২. নিজের সম্পর্কে</h2>
                <div style="background: #fcfbf8; padding: 20px; border-radius: 10px; border: 1px solid var(--v-border); font-size: 14px; line-height: 1.8; color: var(--v-text);">
                    {{ $biodata->about }}
                </div>
            </div>

            <!-- Tab 3: Family -->
            <div class="tab-pane" id="view-pane-3">
                <h2>৩. পারিবারিক তথ্য</h2>
                <div class="info-list-rows">
                    <div class="info-row-item">
                        <span class="title">পারিবারিক জেলা</span>
                        <span class="value">{{ $biodata->city }}</span>
                    </div>
                </div>
            </div>

            <!-- Tab 4: Education & Career -->
            <div class="tab-pane" id="view-pane-4">
                <h2>৪. শিক্ষা ও পেশা</h2>
                <div class="info-list-rows">
                    <div class="info-row-item">
                        <span class="title">শিক্ষাগত যোগ্যতা</span>
                        <span class="value">{{ $biodata->education }}</span>
                    </div>
                    <div class="info-row-item">
                        <span class="title">বর্তমান পেশা</span>
                        <span class="value">{{ $biodata->occupation }}</span>
                    </div>
                </div>
            </div>

            <!-- Tab 5: Religious -->
            <div class="tab-pane" id="view-pane-5">
                <h2>৫. দ্বীনি তথ্য</h2>
                <div style="background: #fcfbf8; padding: 20px; border-radius: 10px; border: 1px solid var(--v-border); font-size: 14px; line-height: 1.8; color: var(--v-text);">
                    পাঁচ ওয়াক্ত সালাত পাবন্দির সাথে আদায় করা হয় এবং ইসলামিক অনুশাসন মানার চেষ্টা রয়েছে আলহামদুলিল্লাহ।
                </div>
            </div>

            <!-- Tab 6: Marital -->
            <div class="tab-pane" id="view-pane-6">
                <h2>৬. বৈবাহিক তথ্য</h2>
                <div class="info-list-rows">
                    <div class="info-row-item">
                        <span class="title">অভিভাবকের সম্মতি</span>
                        <span class="value">অভিভাবক সম্পূর্ণরূপে অবগত ও সম্মত আছেন।</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function switchViewTab(index, btn) {
        var panes = document.querySelectorAll('.tab-pane');
        var buttons = document.querySelectorAll('.tab-btn');

        panes.forEach(function(pane) { pane.classList.remove('active'); });
        buttons.forEach(function(b) { b.classList.remove('active'); });

        document.getElementById('view-pane-' + index).classList.add('active');
        btn.classList.add('active');
    }
</script>
@endsection
