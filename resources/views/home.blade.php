@extends('layouts.app')

@section('title', config('app.name').' | দ্বীনদার জীবনসঙ্গী নির্বাচন করুন')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-grid">
            <div>
                <span class="badge-pill">
                    <span class="dot"></span> {{ $heroBanner->badge_text ?? ('বর্তমান নিবন্ধিত বায়োডাটা: '.number_format($totalBiodatas + 3450).'+ টি') }}
                </span>
                <h1>{!! nl2br(e($heroBanner->title ?? 'পবিত্র ও সুন্নতি উপায়ে দ্বীনদার জীবনসঙ্গী নির্বাচন করুন')) !!}</h1>
                <p class="hero-copy">
                    {{ $heroBanner->subtitle ?? 'পর্দা ও শরীয়াহ শতভাগ বজায় রেখে অভিভাবকের প্রত্যক্ষ তত্ত্বাবধানে সঠিক দ্বীনদার পাত্র-পাত্রী খোঁজার একমাত্র বিশ্বস্ত প্রিমিয়াম ইসলামিক ম্যাট্রিমোনিয়াল প্ল্যাটফর্ম।' }}
                </p>
                <div class="hero-buttons">
                    @if($heroBanner?->button1_text)
                        <a href="{{ $heroBanner->button1_link ?? route('register') }}" class="button gold">{{ $heroBanner->button1_text }}</a>
                    @else
                        <a href="{{ route('register') }}" class="button gold">📁 বিনামূল্যে বায়োডাটা জমা দিন</a>
                    @endif

                    @if($heroBanner?->button2_text)
                        <a href="{{ $heroBanner->button2_link ?? '#search-filter' }}" class="button secondary-outline">{{ $heroBanner->button2_text }}</a>
                    @else
                        <a href="#search-filter" class="button secondary-outline">👥 বায়োডাটা ব্রাউজ করুন</a>
                    @endif
                </div>
            </div>
            <div class="hero-image">
                <img src="{{ $heroBanner->image_url ?? 'https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?auto=format&fit=crop&w=1100&q=85' }}" alt="Dindaar Life Partner" fetchpriority="high">
                <span>{{ $heroBanner->image_caption ?? 'পবিত্র সম্পর্কের সূচনায় শরীয়াহভিত্তিক একমাত্র বিশ্বস্ত প্ল্যাটফর্ম' }}</span>
            </div>
        </div>
    </section>

    <!-- Deendar Practice Banner Section -->
    <section class="container" style="margin-top: 35px; margin-bottom: 20px;">
        <div style="background: linear-gradient(135deg, #062820 0%, #0d493a 100%); border: 2px solid #cba135; border-radius: 16px; padding: 28px 32px; color: #ffffff; box-shadow: 0 10px 30px rgba(6,40,32,0.12);">
            <div style="display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap;">
                <div>
                    <span style="background: #cba135; color: #062820; font-size: 11px; font-weight: 800; padding: 4px 12px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; margin-bottom: 8px;">
                        🕌 দ্বীনদার প্র্যাকটিস
                    </span>
                    <h2 style="font-family: var(--serif); font-size: 24px; font-weight: 700; color: #ffffff; margin: 0 0 8px;">
                        দ্বীনদার মানুষের আবশ্যকীয় ৫টি ইসলামিক প্র্যাকটিস
                    </h2>
                    <p style="font-size: 13px; color: #e2ece8; margin: 0; line-height: 1.7; max-width: 680px;">
                        দ্বীনদার লাইফ পার্টনারে আমরা পাত্র-পাত্রীর দ্বীনদার প্র্যাকটিস (সালাত, পর্দা, কুরআন তিলাওয়াত, হালাল রুজি ও আমল) সবচেয়ে বেশি গুরুত্ব প্রদান করি।
                    </p>
                </div>
                <a href="{{ route('biodatas.index') }}" style="background: #cba135; color: #062820; padding: 12px 24px; border-radius: 30px; font-size: 13.5px; font-weight: 700; text-decoration: none; transition: 0.2s; border: 1px solid #cba135; white-space: nowrap;">
                    🕌 দ্বীনদার পাত্র-পাত্রী খুঁজুন →
                </a>
            </div>

            <!-- 5 Practice Pillars Cards -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; margin-top: 24px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.15);">
                <div style="background: rgba(255,255,255,0.08); border: 1px solid rgba(203,161,53,0.3); padding: 14px; border-radius: 12px; text-align: center;">
                    <div style="font-size: 24px; margin-bottom: 6px;">🕌</div>
                    <strong style="font-size: 13px; color: #cba135; display: block;">৫ ওয়াক্ত সালাত</strong>
                    <span style="font-size: 11px; color: #e2ece8;">জামাতে ও সময়ে সালাত আদায়</span>
                </div>

                <div style="background: rgba(255,255,255,0.08); border: 1px solid rgba(203,161,53,0.3); padding: 14px; border-radius: 12px; text-align: center;">
                    <div style="font-size: 24px; margin-bottom: 6px;">🧕</div>
                    <strong style="font-size: 13px; color: #cba135; display: block;">শরীয়াহ পর্দা</strong>
                    <span style="font-size: 11px; color: #e2ece8;">পূর্ণাঙ্গ হিজাব ও শালীনতা</span>
                </div>

                <div style="background: rgba(255,255,255,0.08); border: 1px solid rgba(203,161,53,0.3); padding: 14px; border-radius: 12px; text-align: center;">
                    <div style="font-size: 24px; margin-bottom: 6px;">📖</div>
                    <strong style="font-size: 13px; color: #cba135; display: block;">কুরআন ও দ্বীনি শিক্ষা</strong>
                    <span style="font-size: 11px; color: #e2ece8;">নিয়মিত তিলাওয়াত ও আমল</span>
                </div>

                <div style="background: rgba(255,255,255,0.08); border: 1px solid rgba(203,161,53,0.3); padding: 14px; border-radius: 12px; text-align: center;">
                    <div style="font-size: 24px; margin-bottom: 6px;">💼</div>
                    <strong style="font-size: 13px; color: #cba135; display: block;">হালাল রুজি</strong>
                    <span style="font-size: 11px; color: #e2ece8;">সুদ-মুক্ত ও সৎ উপার্জন</span>
                </div>

                <div style="background: rgba(255,255,255,0.08); border: 1px solid rgba(203,161,53,0.3); padding: 14px; border-radius: 12px; text-align: center;">
                    <div style="font-size: 24px; margin-bottom: 6px;">🤝</div>
                    <strong style="font-size: 13px; color: #cba135; display: block;">অভিভাবকের সম্মতি</strong>
                    <span style="font-size: 11px; color: #e2ece8;">শরীয়াহ সম্মত অভিভাবক মাধ্যম</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Search / Dual Main Options Section -->
    <section class="container search-wrap" id="search-filter">
        <!-- Primary Two Options Buttons Header -->
        <div style="display: flex; gap: 12px; margin-bottom: 16px;">
            <button type="button" onclick="switchMainOption('deendar_practice')" id="opt-btn-practice" style="flex: 1; padding: 14px 20px; border-radius: 12px; border: 2px solid #cba135; background: #062820; color: #cba135; font-size: 16px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; box-shadow: 0 4px 15px rgba(6,40,32,0.12); transition: all 0.2s ease;">
                <span>🕌 ১. দ্বীনদার প্র্যাকটিস</span>
            </button>

            <button type="button" onclick="switchMainOption('deendar_manush')" id="opt-btn-manush" style="flex: 1; padding: 14px 20px; border-radius: 12px; border: 2px solid #e5e0d3; background: #ffffff; color: #062820; font-size: 16px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; box-shadow: 0 4px 12px rgba(6,40,32,0.03); transition: all 0.2s ease;">
                <span>👤 ২. দ্বীনদার মানুষ</span>
            </button>
        </div>

        <!-- Option 1 Form: Deendar Practice (দ্বীনদার প্র্যাকটিস) -->
        <form class="search-panel-rich" id="form-deendar-practice" method="get" action="{{ route('biodatas.index') }}" style="border: 2px solid #cba135;">
            <div style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #e5e0d3; font-weight: 700; color: #062820; font-size: 15px;">
                🕌 দ্বীনদার প্র্যাকটিস অনুযায়ী পাত্র-পাত্রী খুঁজুন:
            </div>
            <div class="form-row">
                <label>
                    <span>পাত্র / পাত্রী</span>
                    <select name="gender">
                        <option value="">সকল (দ্বীনদার পাত্র ও পাত্রী)</option>
                        <option value="groom" @selected(request('gender') === 'groom')>♂ দ্বীনদার পাত্র</option>
                        <option value="bride" @selected(request('gender') === 'bride')>♀ দ্বীনদার পাত্রী</option>
                    </select>
                </label>

                <label>
                    <span>দ্বীনদারী আমল ও প্র্যাকটিস</span>
                    <select name="deendar_keyword">
                        <option value="">সকল ইসলামি আমল ও প্র্যাকটিস</option>
                        <option value="সালাত" @selected(request('deendar_keyword') === 'সালাত')>🕌 ৫ ওয়াক্ত সালাত (জামাতে/সময়ে)</option>
                        <option value="পর্দা" @selected(request('deendar_keyword') === 'পর্দা')>🧕 শরীয়াহ সম্মত পর্দা/হিজাব</option>
                        <option value="কোরআন" @selected(request('deendar_keyword') === 'কোরআন')>📖 নিয়মিত কোরআন তিলাওয়াত</option>
                        <option value="হাফেজ" @selected(request('deendar_keyword') === 'হাফেজ')>হাফেজে কোরআন</option>
                        <option value="আলেম" @selected(request('deendar_keyword') === 'আলেম')>আলেম / আলেমা</option>
                        <option value="সুন্নত" @selected(request('deendar_keyword') === 'সুন্নত')>সুন্নতি জীবনধারা ও আমল</option>
                    </select>
                </label>

                <label>
                    <span>দ্বীনি ব্যাকগ্রাউন্ড ও শিক্ষা</span>
                    <select name="education">
                        <option value="">সকল দ্বীনি ও সাধারণ শিক্ষা</option>
                        <option value="আলেম" @selected(request('education') === 'আলেম')>আলেম / দাওরায়ে হাদিস / কামিল</option>
                        <option value="হাফেজ" @selected(request('education') === 'হাফেজ')>হাফেজে কোরআন</option>
                        <option value="গ্র্যাজুয়েশন" @selected(request('education') === 'গ্র্যাজুয়েশন')>গ্র্যাজুয়েশন (অনার্স/বিবিএ/বিএসসি)</option>
                    </select>
                </label>
            </div>
            <div class="form-submit">
                <button type="submit" class="button filter-btn" style="background: #062820; color: #cba135;">
                    🕌 দ্বীনদার প্র্যাকটিস অনুযায়ী ফিল্টার করুন
                </button>
            </div>
        </form>

        <!-- Option 2 Form: Deendar Manush (দ্বীনদার মানুষ) -->
        <form class="search-panel-rich" id="form-deendar-manush" method="get" action="{{ route('biodatas.index') }}" style="display: none;">
            <div style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #e5e0d3; font-weight: 700; color: #062820; font-size: 15px;">
                👤 দ্বীনদার মানুষ (পাত্র-পাত্রীর ব্যক্তিগত বিবরণ) অনুযায়ী খুঁজুন:
            </div>
            <div class="form-row">
                <label>
                    <span>আমি খুঁজছি</span>
                    <select name="gender">
                        <option value="">পাত্র / পাত্রী (সকল)</option>
                        <option value="groom" @selected(request('gender') === 'groom')>♂ দ্বীনদার পাত্র</option>
                        <option value="bride" @selected(request('gender') === 'bride')>♀ দ্বীনদার পাত্রী</option>
                    </select>
                </label>

                <label>
                    <span>অবস্থান / জেলা</span>
                    <select name="city">
                        <option value="">সকল জেলা / বিভাগ</option>
                        <option value="ঢাকা">ঢাকা</option>
                        <option value="চট্টগ্রাম">চট্টগ্রাম</option>
                        <option value="সিলেট">সিলেট</option>
                        <option value="রাজশাহী">রাজশাহী</option>
                        <option value="খুলনা">খুলনা</option>
                        <option value="বরিশাল">বরিশাল</option>
                        <option value="রংপুর">রংপুর</option>
                        <option value="ময়মনসিংহ">ময়মনসিংহ</option>
                    </select>
                </label>

                <label>
                    <span>বৈবাহিক অবস্থা</span>
                    <select name="marital_status">
                        <option value="">যে কোনো অবস্থা</option>
                        <option value="never_married">অবিবাহিত</option>
                        <option value="divorced">তালাকপ্রাপ্ত</option>
                        <option value="widowed">বিধবা/বিপত্নীক</option>
                    </select>
                </label>

                <label>
                    <span>নাম বা আইডি (কি-ওয়ার্ড)</span>
                    <input name="q" value="{{ request('q') }}" placeholder="নাম, পেশা বা বায়োডাটা আইডি...">
                </label>
            </div>
            <div class="form-submit">
                <button type="submit" class="button filter-btn">
                    👤 দ্বীনদার মানুষ অনুযায়ী ফিল্টার করুন
                </button>
            </div>
        </form>
    </section>

    <script>
        function switchMainOption(optionType) {
            var formPractice = document.getElementById('form-deendar-practice');
            var formManush = document.getElementById('form-deendar-manush');
            var btnPractice = document.getElementById('opt-btn-practice');
            var btnManush = document.getElementById('opt-btn-manush');

            if (optionType === 'deendar_manush') {
                formPractice.style.display = 'none';
                formManush.style.display = 'block';

                btnPractice.style.background = '#ffffff';
                btnPractice.style.color = '#062820';
                btnPractice.style.borderColor = '#e5e0d3';

                btnManush.style.background = '#062820';
                btnManush.style.color = '#cba135';
                btnManush.style.borderColor = '#cba135';
            } else {
                formPractice.style.display = 'block';
                formManush.style.display = 'none';

                btnPractice.style.background = '#062820';
                btnPractice.style.color = '#cba135';
                btnPractice.style.borderColor = '#cba135';

                btnManush.style.background = '#ffffff';
                btnManush.style.color = '#062820';
                btnManush.style.borderColor = '#e5e0d3';
            }
        }
    </script>

    <!-- Verified Live Profiles Grid -->
    <section class="container section" id="profiles">
        <div class="section-center-head">
            <span class="badge-pill green">• রিয়েল-টাইম লাইভ প্রোফাইল</span>
            <h2>লাইভ ভেরিফাইড বায়োডাটা</h2>
            <p>এনআইডি ও সরাসরি ফোন কল ভেরিফিকেশন সম্পন্ন হওয়া লাইভ বায়োডাটা সমূহ</p>
        </div>

        <div class="filter-tabs">
            <a href="{{ route('home') }}" class="tab-item {{ !request('gender') ? 'active' : '' }}">সকল বায়োডাটা</a>
            <a href="{{ route('home') }}" class="tab-item">সর্বশেষ যুক্ত</a>
            <a href="{{ route('home', ['gender' => 'groom']) }}" class="tab-item {{ request('gender') === 'groom' ? 'active' : '' }}">♂ পাত্র ({{ $groomsCount }})</a>
            <a href="{{ route('home', ['gender' => 'bride']) }}" class="tab-item {{ request('gender') === 'bride' ? 'active' : '' }}">♀ পাত্রী ({{ $bridesCount }})</a>
            <a href="{{ route('biodatas.index') }}" class="tab-item urgent">⚡ জরুরী পাত্র/পাত্রী</a>
        </div>

        @if ($biodatas->isNotEmpty())
            <div class="profile-cards-grid">
                @foreach ($biodatas as $biodata)
                    <article class="biodata-card">
                        <div class="card-header">
                            <span class="status-badge">● অনলাইন সক্রিয়</span>
                            <span class="id-badge">DLP-{{ 1000 + $biodata->id }}</span>
                        </div>
                        <div class="card-avatar-wrap">
                            <div class="card-avatar">
                                {{ $biodata->gender === 'groom' ? '👨‍💼' : '🧕' }}
                            </div>
                        </div>
                        <div class="card-body">
                            <h3>{{ $biodata->display_name }} - {{ $biodata->age }}, {{ $biodata->city }}</h3>
                            <ul class="card-info-list">
                                <li><span>📐 {{ $biodata->gender === 'groom' ? 'পাত্র' : 'পাত্রী' }}</span> | <span>৫' ৮"</span></li>
                                <li><span>💼 {{ $biodata->occupation ?? 'পেশাজীবী' }}</span></li>
                                <li><span>📍 {{ $biodata->city }}</span></li>
                            </ul>
                            <p class="quote-text">
                                "{{ Str::limit($biodata->about, 85, '...') }}"
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('biodatas.show', $biodata) }}" class="button card-btn">👁️ বিস্তারিত দেখুন</a>
                            <button type="button" class="fav-btn" title="পছন্দের তালিকায় রাখুন">❤️</button>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                এখনো কোনো প্রকাশিত প্রোফাইল নেই। <a href="{{ route('register') }}">প্রথম বায়োডাটা তৈরি করুন</a>
            </div>
        @endif
    </section>

    <!-- Why Choose Us -->
    <section class="section why-us">
        <div class="container">
            <div class="section-center-head">
                <span class="sub-title">বিশ্বস্ততার প্রতীক</span>
                <h2>কেন দ্বীনদার লাইফ পার্টনারকে বেছে নেবেন?</h2>
                <p>আমরা নিছক কোনো সাধারণ ম্যাচমেকিং ওয়েবসাইট নই, এটি আপনার দ্বীন সুরক্ষায় তৈরি একটি শরীয়াহভিত্তিক প্ল্যাটফর্ম।</p>
            </div>
            <div class="feature-grid">
                <div class="feature-card">
                    <div class="icon">🛡️</div>
                    <h3>১০০% ভেরিফাইড বায়োডাটা</h3>
                    <p>জাতীয় পরিচয়পত্র (NID) ও যোগাযোগের নম্বর ম্যানুয়ালি যাচাই করার পর প্রকাশিত হয়।</p>
                </div>
                <div class="feature-card">
                    <div class="icon">🔒</div>
                    <h3>হালাল ও পর্দা নিরাপত্তা</h3>
                    <p>কারো ছবি সবার জন্য উন্মুক্ত রাখা হয় না। সম্পূর্ণ পর্দা ও প্রাইভেসি নিয়ম মেনেই সবকিছু পরিচালিত হয়।</p>
                </div>
                <div class="feature-card">
                    <div class="icon">👨‍👩‍👧‍👦</div>
                    <h3>অভিভাবকের সরাসরি অংশ</h3>
                    <p>ছেলে-মেয়ের যোগাযোগের পূর্বে অভিভাবকের সম্মতি ও যোগাযোগের নম্বর নেওয়া বাধ্যতামূলক।</p>
                </div>
                <div class="feature-card">
                    <div class="icon">🤝</div>
                    <h3>ফ্রি বায়োডাটা তৈরি</h3>
                    <p>বায়োডাটা তৈরি ও জমা দেওয়া সম্পূর্ণ ফ্রি। পছন্দ হওয়ার পর যোগাযোগের জন্য সহজ সার্ভিস চার্জ।</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4 Easy Steps -->
    <section class="section steps-section" id="guide">
        <div class="container">
            <div class="section-center-head">
                <span class="sub-title">সহজ ৪টি ধাপ</span>
                <h2>বায়োডাটা তৈরির ৪টি সহজ ধাপ</h2>
                <p>সহজতম উপায়ে আপনার জীবনসঙ্গী খুঁজে পাওয়ার ধাপসমূহ</p>
            </div>
            <div class="four-steps-grid">
                <div class="step-card">
                    <div class="step-number">১</div>
                    <h3>অ্যাকাউন্ট খুলুন</h3>
                    <p>আপনার মোবাইল নম্বর ও ইমেইল দিয়ে ২ মিনিটে বিনামূল্যে অ্যাকাউন্ট তৈরি করুন।</p>
                </div>
                <div class="step-card">
                    <div class="step-number">২</div>
                    <h3>বায়োডাটা সম্পূর্ণ করুন</h3>
                    <p>পারিবারিক তথ্য, শিক্ষাগত যোগ্যতা ও দ্বীনদারীর বিবরণ দিয়ে বায়োডাটা পূরণ করুন।</p>
                </div>
                <div class="step-card">
                    <div class="step-number">৩</div>
                    <h3>এডমিন ভেরিফিকেশন</h3>
                    <p>আমাদের টিম আপনার দেওয়া তথ্য যাচাই করে ২৪ ঘণ্টার মধ্যে বায়োডাটা এপ্রুভ করবে।</p>
                </div>
                <div class="step-card">
                    <div class="step-number">৪</div>
                    <h3>অভিভাবকের মাধ্যমে কথা</h3>
                    <p>পছন্দকৃত বায়োডাটার অভিভাবকের নম্বর নিয়ে সরাসরি যোগাযোগ স্থাপন করুন।</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Packages -->
    <section class="section pricing-section" id="packages">
        <div class="container">
            <div class="section-center-head">
                <span class="sub-title">স্বচ্ছ ও সাশ্রয়ী ফি</span>
                <h2>আমাদের প্যাকেজসমূহ / সংযোগ ফি</h2>
                <p>বায়োডাটা তৈরি সম্পূর্ণ ফ্রি! পাত্র/পাত্রীর অভিভাবকের সাথে যোগাযোগের নম্বর গ্রহণের জন্য আমাদের স্বল্প সার্ভিস চার্জ প্রযোজ্য।</p>
            </div>

            <div class="pricing-grid">
                @forelse($plans as $plan)
                    <div class="price-card {{ $plan->is_popular ? 'popular' : '' }}">
                        @if($plan->badge)
                            <span class="badge {{ $plan->is_popular ? 'featured' : 'free' }}">{{ $plan->badge }}</span>
                        @endif
                        <h3>{{ $plan->name }}</h3>
                        @if($plan->subtitle)
                            <p class="subtitle">{{ $plan->subtitle }}</p>
                        @endif
                        <div class="price">৳ {{ number_format($plan->price) }} <span>{{ $plan->period }}</span></div>
                        <ul class="plan-features">
                            @if(is_array($plan->features))
                                @foreach($plan->features as $feature)
                                    <li>✓ {{ $feature }}</li>
                                @endforeach
                            @endif
                        </ul>
                        <a href="{{ $plan->button_link }}" class="button {{ $plan->is_popular ? 'primary-full' : 'secondary-full' }}">{{ $plan->button_text }}</a>
                    </div>
                @empty
                    <div style="grid-column:1/-1;text-align:center;color:#64748b">কোনো সক্রিয় সাবস্ক্রিপশন প্ল্যান পাওয়া যায়নি।</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Success Stories -->
    <section class="section stories-section">
        <div class="container">
            <div class="section-center-head">
                <span class="sub-title">আলহামদুলিল্লাহ</span>
                <h2>আমাদের সাফল্যের গল্প</h2>
                <p>যারা দ্বীনদার লাইফ পার্টনারের মাধ্যমে সঠিক জীবনসঙ্গী খুঁজে বিবাহ বন্ধনে আবদ্ধ হয়েছেন</p>
            </div>
            <div class="stories-grid">
                <div class="story-card">
                    <div class="story-img">
                        <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&w=600&q=80" alt="Success Story">
                    </div>
                    <h3>আব্দুল্লাহ & ফাতেমা</h3>
                    <span class="date">বিবাহ: ফেব্রুয়ারি ২০২৪</span>
                    <p>"আলহামদুলিল্লাহ, দ্বীনদার লাইফ পার্টনারের মাধ্যমে খুব দ্রুত ও সুন্নতি নিয়মে অভিভাবকের উপস্থিতিতে আমাদের বিবাহ সম্পন্ন হয়েছে।"</p>
                    <a href="{{ route('about') }}" class="story-link">পুরা গল্প পড়ুন ❤</a>
                </div>
                <div class="story-card">
                    <div class="story-img">
                        <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&w=600&q=80" alt="Success Story">
                    </div>
                    <h3>মাহমুদ & আয়েশা</h3>
                    <span class="date">বিবাহ: এপ্রিল ২০২৪</span>
                    <p>"অভিভাবকদের সরাসরি অংশগ্রহণ এবং পর্দার বিধান পুরোপুরি মেনে বিয়ের আয়োজনে আমরা অত্যন্ত সন্তুষ্ট। ধন্যবাদ!"</p>
                    <a href="{{ route('about') }}" class="story-link">পুরা গল্প পড়ুন ❤</a>
                </div>
                <div class="story-card">
                    <div class="story-img">
                        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=600&q=80" alt="Success Story">
                    </div>
                    <h3>ওমর & খাদিজা</h3>
                    <span class="date">বিবাহ: জুন ২০২৪</span>
                    <p>"বায়োডাটার তথ্যগুলো নিখুঁত ছিল। বিশেষ করে ফিল্টার পছন্দমতো সঠিক দ্বীনদার জীবনসঙ্গী নির্বাচন সহজ করেছে।"</p>
                    <a href="{{ route('about') }}" class="story-link">পুরা গল্প পড়ুন ❤</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog & Guideline -->
    <section class="section blog-section">
        <div class="container">
            <div class="section-center-head">
                <span class="sub-title">দ্বীনি দিকনির্দেশনা</span>
                <h2>জীবনসঙ্গী নির্বাচন নির্দেশিকা & ব্লগ</h2>
                <p>সুন্নতি বিয়ে ও দ্বীনদার জীবনসঙ্গী নির্বাচন নিয়ে ইসলামিক আর্টিকেল ও পরামর্শ</p>
            </div>
            <div class="blog-grid">
                <article class="blog-card">
                    <div class="blog-img">
                        <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=600&q=80" alt="Blog Post">
                    </div>
                    <div class="blog-body">
                        <span class="category">সুন্নতি বিবাহ</span>
                        <h3>পাত্র/পাত্রী নির্বাচনে দ্বীনদারিতাকে কেন প্রাধান্য দেবেন?</h3>
                        <p>রাসূলুল্লাহ (সাল্লাল্লাহু আলাইহি ওয়া সাল্লাম) বলেছেন, নারীর চারটি বিষয় দেখে বিবাহ করা হয়...</p>
                        <a href="{{ route('guide') }}" class="read-more">সম্পূর্ণ আর্টিকেল পড়ুন →</a>
                    </div>
                </article>
                <article class="blog-card">
                    <div class="blog-img">
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=600&q=80" alt="Blog Post">
                    </div>
                    <div class="blog-body">
                        <span class="category">অভিভাবকের করণীয়</span>
                        <h3>অভিভাবক হিসেবে উপযুক্ত দ্বীনদার পাত্র চেনার উপায়</h3>
                        <p>মেয়ের অভিভাবক হিসেবে সন্তানের জীবনসঙ্গী বাছাইয়ের সময় কোন বিষয়গুলোতে বিশেষ নজর দেওয়া উচিত...</p>
                        <a href="{{ route('guide') }}" class="read-more">সম্পূর্ণ আর্টিকেল পড়ুন →</a>
                    </div>
                </article>
                <article class="blog-card">
                    <div class="blog-img">
                        <img src="https://images.unsplash.com/photo-1532622723896-12155799980d?auto=format&fit=crop&w=600&q=80" alt="Blog Post">
                    </div>
                    <div class="blog-body">
                        <span class="category">বিবাহের মোহর</span>
                        <h3>ইসলামে বরকতময় সহজ মোহরানার গুরুত্ব ও বিধান</h3>
                        <p>সবচেয়ে বরকতময় বিয়ে তা-ই যার মোহরানা সহজ ও সাধ্যের মধ্যে থাকে। জানা যাক শরীয়াহর দিকনির্দেশনা...</p>
                        <a href="{{ route('guide') }}" class="read-more">সম্পূর্ণ আর্টিকেল পড়ুন →</a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- FAQ Accordion Section -->
    <section class="section faq-section" id="faq">
        <div class="container">
            <div class="section-center-head">
                <span class="sub-title">স্পষ্টকরণ</span>
                <h2>সচরাচর জিজ্ঞাসিত প্রশ্নাবলী (FAQ)</h2>
            </div>
            <div class="faq-accordion">
                <details class="faq-item">
                    <summary>১. বায়োডাটা তৈরি করতে কি কোনো সার্ভিস চার্জ দিতে হয়?</summary>
                    <div class="faq-answer">
                        <p>না, বায়োডাটা তৈরি করা ও প্রকাশ করা সম্পূর্ণ বিনামূল্যে। শুধুমাত্র কারো অভিভাবকের ফোন নম্বর গ্রহণ করার সময় আমাদের সামান্য সার্ভিস ফি প্রযোজ্য হয়।</p>
                    </div>
                </details>
                <details class="faq-item">
                    <summary>২. ছবি কি জনসম্মুখে প্রকাশ করা হয়?</summary>
                    <div class="faq-answer">
                        <p>না, আমরা পর্দার সম্পূর্ণ বিধান বজায় রাখি। জনসম্মুখে বা ওয়েবসাইটে কারো ছবি প্রকাশ করা হয় না।</p>
                    </div>
                </details>
                <details class="faq-item">
                    <summary>৩. অভিভাবকের উপস্থিতি কি বাধ্যতামূলক?</summary>
                    <div class="faq-answer">
                        <p>হ্যাঁ, প্রতিটি ধাপে অভিভাবকের সম্পৃক্ততা ও সম্মতি আবশ্যক। কোনো সরাসরি গোপন যোগাযোগের সুযোগ নেই।</p>
                    </div>
                </details>
                <details class="faq-item">
                    <summary>৪. তথ্যসমূহের সত্যতা কীভাবে যাচাই করেন?</summary>
                    <div class="faq-answer">
                        <p>আমরা জাতীয় পরিচয়পত্র (NID) এবং সরাসরি ফোন কল ভেরিফিকেশনের মাধ্যমে প্রত্যেকটি তথ্য ম্যানুয়ালি যাচাই করার চেষ্টা করি।</p>
                    </div>
                </details>
            </div>
        </div>
    </section>

    <!-- Bottom Banner CTA -->
    <section class="bottom-cta-banner">
        <div class="container banner-inner">
            <h2>আজই আপনার বিনামূল্যে বায়োডাটা জমা দিন</h2>
            <p>পবিত্র বিবাহের উদ্দেশ্যে আপনার সঠিক বায়োডাটাটি পূরণ করুন এবং খুঁজে নিন আপনার মনের মতো দ্বীনদার জীবনসঙ্গী।</p>
            <a href="{{ route('register') }}" class="button gold">📁 বায়োডাটা তৈরি করুন</a>
        </div>
    </section>
@endsection
