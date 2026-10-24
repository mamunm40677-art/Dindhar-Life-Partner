<style>
    :root {
        --b-green: #062820;
        --b-green-hover: #0d493a;
        --b-gold: #cba135;
        --b-gold-hover: #b88e28;
        --b-bg: #f8f7f2;
        --b-card: #ffffff;
        --b-border: #e5e0d3;
        --b-text: #15382f;
        --b-muted: #69766f;
    }

    .biodata-form-wrapper {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 28px;
        align-items: start;
        margin-top: 20px;
    }

    /* Left Steps Progress Column */
    .steps-sidebar {
        background: var(--b-card);
        border: 1.5px solid var(--b-border);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(6, 40, 32, 0.03);
    }

    .steps-progress-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .steps-progress-title {
        font-family: var(--serif);
        font-size: 18px;
        font-weight: 700;
        color: var(--b-green);
    }

    .steps-badge-count {
        background: var(--b-green);
        color: var(--b-gold);
        font-size: 12px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        border: 1px solid var(--b-gold);
    }

    .steps-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-top: 18px;
    }

    .step-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        border-radius: 10px;
        border: 1px solid var(--b-border);
        background: #fcfbf8;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .step-item:hover, .step-item.active {
        background: var(--b-green);
        color: var(--b-gold);
        border-color: var(--b-green);
    }

    .step-item.active .step-num {
        background: var(--b-gold);
        color: var(--b-green);
    }

    .step-num {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #e5eee7;
        color: var(--b-green);
        font-size: 12px;
        font-weight: 700;
        display: grid;
        place-items: center;
    }

    .step-label {
        font-size: 13px;
        font-weight: 700;
    }

    /* Right Form Area */
    .form-card-panel {
        background: var(--b-card);
        border: 1.5px solid var(--b-border);
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(6, 40, 32, 0.03);
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .step-header {
        margin-bottom: 24px;
        padding-bottom: 14px;
        border-bottom: 1.5px solid var(--b-border);
    }

    .step-header h2 {
        font-family: var(--serif);
        font-size: 22px;
        font-weight: 700;
        color: var(--b-green);
        margin: 0 0 4px;
    }

    .step-header p {
        font-size: 13px;
        color: var(--b-muted);
        margin: 0;
    }

    .form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 24px;
    }

    .form-grid-1 {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        margin-bottom: 24px;
    }

    .field-group label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: var(--b-green);
        margin-bottom: 8px;
    }

    .field-group input, .field-group select, .field-group textarea {
        width: 100%;
        min-height: 48px;
        padding: 10px 16px;
        border: 1.5px solid #d1cbba;
        border-radius: 10px;
        background: #fcfbf8;
        font-size: 14px;
        color: var(--b-text);
        outline: none;
        transition: border-color 0.2s;
    }

    .field-group input:focus, .field-group select:focus, .field-group textarea:focus {
        border-color: var(--b-green);
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1.5px solid var(--b-border);
    }

    .btn-step-next {
        min-height: 48px;
        padding: 10px 28px;
        background: var(--b-green);
        color: var(--b-gold);
        border: 1.5px solid var(--b-gold);
        border-radius: 30px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-step-next:hover {
        background: var(--b-green-hover);
        color: #ffffff;
    }

    .btn-step-prev {
        min-height: 48px;
        padding: 10px 24px;
        background: #ffffff;
        color: var(--b-green);
        border: 1.5px solid var(--b-green);
        border-radius: 30px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
    }

    @media (max-width: 850px) {
        .biodata-form-wrapper {
            grid-template-columns: 1fr;
        }
        .form-grid-2 {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="biodata-form-wrapper">
    <!-- Left 10-Step Progress Sidebar -->
    <aside class="steps-sidebar">
        <div class="steps-progress-head">
            <span class="steps-progress-title">বায়োডাটা ফর্ম</span>
            <span class="steps-badge-count" id="progressBadge">১০টির মধ্যে ১ম</span>
        </div>

        <div class="steps-list">
            <div class="step-item active" onclick="goToStep(1)" id="step-nav-1">
                <span class="step-num">১</span>
                <span class="step-label">সাধারণ তথ্য</span>
            </div>
            <div class="step-item" onclick="goToStep(2)" id="step-nav-2">
                <span class="step-num">২</span>
                <span class="step-label">ঠিকানা</span>
            </div>
            <div class="step-item" onclick="goToStep(3)" id="step-nav-3">
                <span class="step-num">৩</span>
                <span class="step-label">নিজের সম্পর্কে</span>
            </div>
            <div class="step-item" onclick="goToStep(4)" id="step-nav-4">
                <span class="step-num">৪</span>
                <span class="step-label">পারিবারিক তথ্য</span>
            </div>
            <div class="step-item" onclick="goToStep(5)" id="step-nav-5">
                <span class="step-num">৫</span>
                <span class="step-label">শিক্ষা ও পেশা</span>
            </div>
            <div class="step-item" onclick="goToStep(6)" id="step-nav-6">
                <span class="step-num">৬</span>
                <span class="step-label">ধর্মীয় তথ্য</span>
            </div>
            <div class="step-item" onclick="goToStep(7)" id="step-nav-7">
                <span class="step-num">৭</span>
                <span class="step-label">বৈবাহিক তথ্য</span>
            </div>
            <div class="step-item" onclick="goToStep(8)" id="step-nav-8">
                <span class="step-num">৮</span>
                <span class="step-label">কাঙ্ক্ষিত জীবনসঙ্গী</span>
            </div>
            <div class="step-item" onclick="goToStep(9)" id="step-nav-9">
                <span class="step-num">৯</span>
                <span class="step-label">যোগাযোগ তথ্য</span>
            </div>
            <div class="step-item" onclick="goToStep(10)" id="step-nav-10">
                <span class="step-num">১০</span>
                <span class="step-label">বায়োডাটা প্রকাশ</span>
            </div>
        </div>
    </aside>

    <!-- Main Form Panel -->
    <div class="form-card-panel">
        <form id="biodataMultiStepForm" method="post" action="{{ $biodata->exists ? route('my-biodata.update', $biodata) : route('my-biodata.store') }}">
            @csrf
            @if ($biodata->exists) @method('PUT') @endif

            @if ($errors->any())
                <div style="background: #fee2e2; border: 1px solid #fecaca; color: #991b1b; padding: 14px 18px; border-radius: 10px; font-size: 13px; margin-bottom: 24px;">
                    <strong style="display:block; margin-bottom: 6px;">{{ __('site.validation_errors') }}</strong>
                    <ul style="margin:0; padding-left: 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Step 1: General Info -->
            <div class="tab-content active" id="tab-step-1">
                <div class="step-header">
                    <h2>১. সাধারণ তথ্য</h2>
                    <p>আপনার সাধারণ তথ্য পূরণ করুন।</p>
                </div>

                <div class="form-grid-2">
                    <div class="field-group" style="grid-column: 1 / -1;">
                        <label>বায়োডাটার ডিসপ্লে নাম</label>
                        <input name="display_name" value="{{ old('display_name', $biodata->display_name) }}" maxlength="120" required placeholder="আপনার নাম লিখুন">
                    </div>

                    <div class="field-group" style="grid-column: 1 / -1;">
                        <label>বায়োডাটার ধরন</label>
                        <select name="gender" required>
                            <option value="">বায়োডাটার ধরন নির্বাচন করুন</option>
                            <option value="groom" @selected(old('gender', $biodata->gender) === 'groom' || old('gender', $biodata->gender) === 'male')>পাত্রের বায়োডাটা (Male)</option>
                            <option value="bride" @selected(old('gender', $biodata->gender) === 'bride' || old('gender', $biodata->gender) === 'female')>পাত্রীর বায়োডাটা (Female)</option>
                        </select>
                    </div>

                    <div class="field-group" style="grid-column: 1 / -1;">
                        <label>বয়স (Age in Years)</label>
                        <input type="number" name="age" value="{{ old('age', $biodata->age) }}" min="18" max="80" required placeholder="বয়স লিখুন (যেমন: ২৫)">
                    </div>

                    <div class="field-group">
                        <label>উচ্চতা</label>
                        <select name="height">
                            <option value="">উচ্চতা নির্বাচন করুন</option>
                            <option value="4.10">৪ ফিট ১০ ইঞ্চি</option>
                            <option value="5.0">৫ ফিট ০ ইঞ্চি</option>
                            <option value="5.2">৫ ফিট ২ ইঞ্চি</option>
                            <option value="5.4" selected>৫ ফিট ৪ ইঞ্চি</option>
                            <option value="5.6">৫ ফিট ৬ ইঞ্চি</option>
                            <option value="5.8">৫ ফিট ৮ ইঞ্চি</option>
                            <option value="6.0">৬ ফিট ০ ইঞ্চি</option>
                        </select>
                    </div>

                    <div class="field-group">
                        <label>ওজন</label>
                        <select name="weight">
                            <option value="">ওজন নির্বাচন করুন</option>
                            <option value="50">৫০ কেজি</option>
                            <option value="55">৫৫ কেজি</option>
                            <option value="60" selected>৬০ কেজি</option>
                            <option value="65">৬৫ কেজি</option>
                            <option value="70">৭০ কেজি</option>
                        </select>
                    </div>

                    <div class="field-group">
                        <label>বর্ণ (গায়ের রঙ)</label>
                        <select name="complexion">
                            <option value="">বর্ণ নির্বাচন করুন</option>
                            <option value="fair">উজ্জ্বল ফর্সা</option>
                            <option value="medium" selected>উজ্জ্বল শ্যামলা</option>
                            <option value="dusky">শ্যামলা</option>
                        </select>
                    </div>

                    <div class="field-group">
                        <label>রক্তের গ্রুপ</label>
                        <select name="blood_group">
                            <option value="">রক্তের গ্রুপ নির্বাচন করুন</option>
                            <option value="A+">A+ (এ পজিটিভ)</option>
                            <option value="B+">B+ (বি পজিটিভ)</option>
                            <option value="O+" selected>O+ (ও পজিটিভ)</option>
                            <option value="AB+">AB+ (এবি পজিটিভ)</option>
                        </select>
                    </div>

                    <div class="field-group" style="grid-column: 1 / -1;">
                        <label>বৈবাহিক অবস্থা</label>
                        <select name="marital_status" required>
                            <option value="">বৈবাহিক অবস্থা নির্বাচন করুন</option>
                            @foreach (['never_married', 'divorced', 'widowed'] as $status)
                                <option value="{{ $status }}" @selected(old('marital_status', $biodata->marital_status) === $status)>{{ __('site.'.$status) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Step 2: Address -->
            <div class="tab-content" id="tab-step-2">
                <div class="step-header">
                    <h2>২. ঠিকানা সংক্রান্ত তথ্য</h2>
                    <p>আপনার জেলা ও বর্তমান অবস্থান সংক্রান্ত তথ্য দিন।</p>
                </div>
                <div class="form-grid-2">
                    <div class="field-group" style="grid-column: 1 / -1;">
                        <label>জেলা / বিভাগ</label>
                        <input name="city" value="{{ old('city', $biodata->city) }}" maxlength="100" required placeholder="উদাহরণ: ঢাকা, চট্টগ্রাম, সিলেট">
                    </div>
                </div>
            </div>

            <!-- Step 3: About Yourself -->
            <div class="tab-content" id="tab-step-3">
                <div class="step-header">
                    <h2>৩. নিজের সম্পর্কে তথ্য</h2>
                    <p>আপনার দ্বীনদারিত্ব, ব্যক্তিত্ব ও নিজের সম্পর্কে বিস্তারিত লিখুন।</p>
                </div>
                <div class="form-grid-1">
                    <div class="field-group">
                        <label>নিজের সম্পর্কে বিস্তারিত বিবরণ</label>
                        <textarea name="about" maxlength="2000" rows="6" required placeholder="আপনার ভালো লাগা, জীবনের লক্ষ্য, দ্বীনদারিত্বের অভ্যাস ইত্যাদি বর্ণনা করুন...">{{ old('about', $biodata->about) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Step 4: Family Info -->
            <div class="tab-content" id="tab-step-4">
                <div class="step-header">
                    <h2>৪. পারিবারিক তথ্য</h2>
                    <p>আপনার পরিবার ও শিক্ষার বিবরণ।</p>
                </div>
                <div class="form-grid-2">
                    <div class="field-group" style="grid-column: 1 / -1;">
                        <label>শিক্ষাগত যোগ্যতা</label>
                        <input name="education" value="{{ old('education', $biodata->education) }}" maxlength="160" required placeholder="উদাহরণ: অনার্স / বিএসসি / কামিল">
                    </div>
                </div>
            </div>

            <!-- Step 5: Education & Career -->
            <div class="tab-content" id="tab-step-5">
                <div class="step-header">
                    <h2>৫. শিক্ষা ও পেশা সংক্রান্ত তথ্য</h2>
                    <p>আপনার বর্তমান পেশার তথ্য দিন।</p>
                </div>
                <div class="form-grid-2">
                    <div class="field-group" style="grid-column: 1 / -1;">
                        <label>পেশা (Occupation)</label>
                        <input name="occupation" value="{{ old('occupation', $biodata->occupation) }}" maxlength="120" required placeholder="উদাহরণ: শিক্ষকতা / সফটওয়্যার ইঞ্জিনিয়ার / ব্যবসা">
                    </div>
                </div>
            </div>

            <!-- Step 6: Deendar Practice & Religious Info -->
            <div class="tab-content" id="tab-step-6">
                <div class="step-header">
                    <h2>৬. দ্বীনদার প্র্যাকটিস ও ধর্মীয় তথ্য</h2>
                    <p>আপনার দ্বীনদারী, সালাত, পর্দা ও ইসলামিক আমল সংক্রান্ত বিবরণ দিন।</p>
                </div>
                <div class="form-grid-1">
                    <div class="field-group">
                        <label>🕌 দ্বীনদারী প্র্যাকটিস ও ইসলামিক অনুশীলনের বিবরণ (Deendar Practice)</label>
                        <textarea name="deendar_practice" maxlength="2000" rows="5" placeholder="যেমন: আলহামদুলিল্লাহ প্রতিদিন ৫ ওয়াক্ত সালাত সময়ে পড়া হয়, শরীয়াহ সম্মত পর্দার বিধান মেনে চলা হয়, নিয়মিত কোরআন তিলাওয়াত, দ্বীনি তা'লীম এবং সুন্নত অনুসরণ করা হয়...">{{ old('deendar_practice', $biodata->deendar_practice) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="tab-step-7">
                <div class="step-header">
                    <h2>৭. বৈবাহিক সংক্রান্ত তথ্য</h2>
                    <p>বিবাহের সিদ্ধান্ত ও সম্মতি সংক্রান্ত তথ্য।</p>
                </div>
                <p style="font-size: 13px; color: var(--b-muted);">পরবর্তী ধাপে যান।</p>
            </div>

            <div class="tab-content" id="tab-step-8">
                <div class="step-header">
                    <h2>৮. কাঙ্ক্ষিত জীবনসঙ্গী</h2>
                    <p>যেমন জীবনসঙ্গী প্রত্যাশা করেন তার বিবরণ।</p>
                </div>
                <p style="font-size: 13px; color: var(--b-muted);">পরবর্তী ধাপে যান।</p>
            </div>

            <div class="tab-content" id="tab-step-9">
                <div class="step-header">
                    <h2>৯. যোগাযোগ তথ্য</h2>
                    <p>অভিভাবকের যোগাযোগের মাধ্যম।</p>
                </div>
                <p style="font-size: 13px; color: var(--b-muted);">পরবর্তী ধাপে যান।</p>
            </div>

            <!-- Step 10: Publish -->
            <div class="tab-content" id="tab-step-10">
                <div class="step-header">
                    <h2>১০. বায়োডাটা প্রকাশ (Publish)</h2>
                    <p>আপনার বায়োডাটা ওয়েবসাইটে প্রকাশের জন্য অনুমোদন করুন।</p>
                </div>
                <div style="background: #fbfaf6; padding: 20px; border-radius: 12px; border: 1.5px solid var(--b-gold); margin-bottom: 24px;">
                    <label style="display: flex; align-items: center; gap: 12px; font-size: 15px; font-weight: 700; color: var(--b-green); cursor: pointer;">
                        <input type="checkbox" name="published" value="1" @checked(old('published', $biodata->published)) style="width: 20px; height: 20px; accent-color: var(--b-green);">
                        🌐 হ্যাঁ, বায়োডাটা পাবলিশড করতে চাই (সবাই দেখতে পাবে)
                    </label>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="form-actions">
                <button type="button" class="btn-step-prev" id="prevBtn" onclick="nextPrev(-1)" style="display: none;">
                    ← পূর্ববর্তী ধাপ
                </button>

                <button type="button" class="btn-step-next" id="nextBtn" onclick="nextPrev(1)">
                    ✓ আপডেট করে পরবর্তী স্টেপে যান
                </button>

                <button type="submit" class="btn-step-next" id="submitBtn" style="display: none; background: #062820;">
                    💾 সম্পূর্ণ তথ্য সংরক্ষণ করুন
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    var currentStep = 1;
    var totalSteps = 10;

    function showStep(n) {
        for (var i = 1; i <= totalSteps; i++) {
            var tab = document.getElementById('tab-step-' + i);
            var nav = document.getElementById('step-nav-' + i);
            if (tab) tab.classList.remove('active');
            if (nav) nav.classList.remove('active');
        }

        var currentTab = document.getElementById('tab-step-' + n);
        var currentNav = document.getElementById('step-nav-' + n);
        if (currentTab) currentTab.classList.add('active');
        if (currentNav) currentNav.classList.add('active');

        document.getElementById('progressBadge').innerText = '১০টির মধ্যে ' + n + 'ম ধাপ';

        document.getElementById('prevBtn').style.display = (n === 1) ? 'none' : 'inline-block';
        if (n === totalSteps) {
            document.getElementById('nextBtn').style.display = 'none';
            document.getElementById('submitBtn').style.display = 'inline-block';
        } else {
            document.getElementById('nextBtn').style.display = 'inline-block';
            document.getElementById('submitBtn').style.display = 'none';
        }
    }

    function goToStep(n) {
        currentStep = n;
        showStep(currentStep);
    }

    function nextPrev(n) {
        currentStep += n;
        if (currentStep > totalSteps) {
            document.getElementById('biodataMultiStepForm').submit();
            return false;
        }
        if (currentStep < 1) currentStep = 1;
        showStep(currentStep);
    }
</script>
