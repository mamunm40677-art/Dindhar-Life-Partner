@extends(auth()->check() ? 'layouts.dashboard-layout' : 'layouts.app')

@section('title', $biodata->display_name.' | '.config('app.name'))

@section('dash-content')
@section('content')
<style>
    .view-header-card {
        background: #ffffff;
        border: 1.5px solid #e5e0d3;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(6, 40, 32, 0.03);
        margin-bottom: 24px;
        position: relative;
    }

    .gender-pill-tag {
        position: absolute;
        top: 20px;
        left: 20px;
        background: #e6f4ea;
        color: #137333;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
        border: 1px solid #b7e1cd;
    }

    .view-avatar-circle {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: #062820;
        border: 3px solid #cba135;
        color: #cba135;
        display: grid;
        place-items: center;
        font-size: 40px;
        margin: 0 auto 12px;
        box-shadow: 0 4px 12px rgba(6, 40, 32, 0.15);
    }

    .view-bio-no {
        font-family: var(--serif);
        font-size: 26px;
        font-weight: 700;
        color: #062820;
        margin: 0 0 16px;
        text-align: center;
    }

    /* 2 columns x 3 rows summary grid */
    .summary-grid-2x3 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin: 20px 0 24px;
    }

    .summary-box-item {
        background: #fcfbf8;
        border: 1px solid #e5e0d3;
        padding: 12px 16px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .summary-box-item .icon {
        font-size: 20px;
    }

    .summary-box-item .lbl {
        font-size: 11px;
        color: #69766f;
        font-weight: 600;
    }

    .summary-box-item .val {
        font-size: 13px;
        font-weight: 700;
        color: #062820;
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
        background: #062820;
        color: #cba135;
        border: 1.5px solid #cba135;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-action-green:hover {
        background: #0d493a;
        color: #ffffff;
    }

    .btn-action-outline {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 24px;
        border-radius: 30px;
        background: #ffffff;
        color: #062820;
        border: 1.5px solid #062820;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    /* Tabs Bar */
    .view-tabs-card {
        background: #ffffff;
        border: 1.5px solid #e5e0d3;
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
        border: 1px solid #e5e0d3;
        background: #fcfbf8;
        color: #15382f;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.2s ease;
    }

    .tab-btn:hover, .tab-btn.active {
        background: #062820;
        color: #cba135;
        border-color: #062820;
    }

    /* Content Body Card */
    .view-body-card {
        background: #ffffff;
        border: 1.5px solid #e5e0d3;
        border-radius: 16px;
        padding: 40px 30px;
        box-shadow: 0 4px 20px rgba(6, 40, 32, 0.03);
        text-align: center;
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
    }

    .btn-fill-info {
        display: inline-block;
        padding: 12px 32px;
        background: #062820;
        color: #cba135;
        border: 1.5px solid #cba135;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-fill-info:hover {
        background: #0d493a;
        color: #ffffff;
    }

    @media (max-width: 650px) {
        .summary-grid-2x3 {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Profile Header Card -->
<div class="view-header-card">
    <span class="gender-pill-tag">
        {{ $biodata->gender === 'groom' || $biodata->gender === 'male' ? 'পাত্র' : 'পাত্রী' }}
    </span>

    <div class="view-avatar-circle">
        {{ $biodata->gender === 'groom' || $biodata->gender === 'male' ? '🧔' : '🧕' }}
    </div>

    <div class="view-bio-no">Bio No - {{ $biodata->id }}</div>

    <!-- 2x3 Grid -->
    <div class="summary-grid-2x3">
        <div class="summary-box-item">
            <span class="icon">📅</span>
            <div>
                <div class="lbl">জন্মসাল / বয়স</div>
                <div class="val">{{ $biodata->age }} বছর</div>
            </div>
        </div>

        <div class="summary-box-item">
            <span class="icon">💍</span>
            <div>
                <div class="lbl">বৈবাহিক অবস্থা</div>
                <div class="val">{{ $biodata->marital_status ?? 'N/A' }}</div>
            </div>
        </div>

        <div class="summary-box-item">
            <span class="icon">📏</span>
            <div>
                <div class="lbl">উচ্চতা</div>
                <div class="val">৫ ফিট ৪ ইঞ্চি</div>
            </div>
        </div>

        <div class="summary-box-item">
            <span class="icon">🎨</span>
            <div>
                <div class="lbl">গায়ের বর্ণ</div>
                <div class="val">উজ্জ্বল শ্যামলা</div>
            </div>
        </div>

        <div class="summary-box-item">
            <span class="icon">💼</span>
            <div>
                <div class="lbl">পেশা</div>
                <div class="val">{{ $biodata->occupation ?? 'N/A' }}</div>
            </div>
        </div>

        <div class="summary-box-item">
            <span class="icon">📍</span>
            <div>
                <div class="lbl">ঠিকানা</div>
                <div class="val">{{ $biodata->city ?? 'N/A' }}</div>
            </div>
        </div>
    </div>

    <div class="action-row">
        @auth
            @if (auth()->user()->biodata?->is($biodata))
                <a href="{{ route('my-biodata.edit', $biodata) }}" class="btn-action-green">
                    ✎ তথ্য আপডেট
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
    <button class="tab-btn" onclick="switchViewTab(7, this)">🔍 কাঙ্ক্ষিত জীবনসঙ্গী</button>
</div>

<!-- Tab Body Content -->
<div class="view-body-card">
    <!-- Tab 1: General Info -->
    <div class="tab-pane active" id="view-pane-1">
        <p style="font-size: 15px; color: #69766f; margin-bottom: 24px;">
            ডিসপ্লে নাম: <strong>{{ $biodata->display_name }}</strong> | বয়স: <strong>{{ $biodata->age }} বছর</strong>
        </p>
        <a href="{{ route('my-biodata.edit', $biodata) }}" class="btn-fill-info">
            তথ্য পূরণ করি
        </a>
    </div>

    <!-- Tab 2: About -->
    <div class="tab-pane" id="view-pane-2">
        <p style="font-size: 15px; color: #69766f; margin-bottom: 24px;">
            {{ $biodata->about ?? 'এখনো পর্যন্ত আপনি এই তথ্য পূরণ করেন নি।' }}
        </p>
        <a href="{{ route('my-biodata.edit', $biodata) }}" class="btn-fill-info">
            তথ্য পূরণ করি
        </a>
    </div>

    <!-- Tab 3: Family -->
    <div class="tab-pane" id="view-pane-3">
        <p style="font-size: 15px; color: #69766f; margin-bottom: 24px;">
            এখনো পর্যন্ত আপনি এই তথ্য পূরণ করেন নি।
        </p>
        <a href="{{ route('my-biodata.edit', $biodata) }}" class="btn-fill-info">
            তথ্য পূরণ করি
        </a>
    </div>

    <!-- Tab 4: Education & Career -->
    <div class="tab-pane" id="view-pane-4">
        <p style="font-size: 15px; color: #69766f; margin-bottom: 24px;">
            শিক্ষা: <strong>{{ $biodata->education }}</strong> | পেশা: <strong>{{ $biodata->occupation }}</strong>
        </p>
        <a href="{{ route('my-biodata.edit', $biodata) }}" class="btn-fill-info">
            তথ্য পূরণ করি
        </a>
    </div>

    <!-- Tab 5: Religious -->
    <div class="tab-pane" id="view-pane-5">
        <p style="font-size: 15px; color: #69766f; margin-bottom: 24px;">
            এখনো পর্যন্ত আপনি এই তথ্য পূরণ করেন নি।
        </p>
        <a href="{{ route('my-biodata.edit', $biodata) }}" class="btn-fill-info">
            তথ্য পূরণ করি
        </a>
    </div>

    <!-- Tab 6: Marital -->
    <div class="tab-pane" id="view-pane-6">
        <p style="font-size: 15px; color: #69766f; margin-bottom: 24px;">
            এখনো পর্যন্ত আপনি এই তথ্য পূরণ করেন নি।
        </p>
        <a href="{{ route('my-biodata.edit', $biodata) }}" class="btn-fill-info">
            তথ্য পূরণ করি
        </a>
    </div>

    <!-- Tab 7: Expected Partner -->
    <div class="tab-pane" id="view-pane-7">
        <p style="font-size: 15px; color: #69766f; margin-bottom: 24px;">
            এখনো পর্যন্ত আপনি এই তথ্য পূরণ করেন নি।
        </p>
        <a href="{{ route('my-biodata.edit', $biodata) }}" class="btn-fill-info">
            তথ্য পূরণ করি
        </a>
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
@endsection
