<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#083a30">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="{{ __('site.meta_description') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Noto+Serif+Bengali:wght@400;500;600;700&family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{--ink:#15382f;--green:#0d493a;--green-deep:#062820;--mint:#e5eee7;--paper:#ffffff;--rose:#c57669;--gold:#cba135;--gold-hover:#b88e28;--muted:#69766f;--line:#e5e1d5;--sans:'Noto Sans Bengali','DM Sans',sans-serif;--serif:'Noto Serif Bengali',serif}
        *{box-sizing:border-box}html{scroll-behavior:smooth}body{margin:0;background:#f8f7f2;color:var(--ink);font-family:var(--sans)}a{color:inherit;text-decoration:none}button,input,select,textarea{font:inherit}button{cursor:pointer}.container{width:min(1240px,calc(100% - 32px));margin-inline:auto}

        /* Top Utility Bar */
        .top-header-bar{background:var(--green-deep);color:#e2ece8;font-size:12px;padding:7px 0;border-bottom:1px solid rgba(203,161,53,.25)}
        .top-header-row{display:flex;align-items:center;justify-content:space-between;gap:15px;flex-wrap:wrap}
        .top-left-info{display:flex;align-items:center;gap:12px}
        .shariah-badge{background:var(--gold);color:var(--green-deep);font-weight:700;padding:3px 10px;border-radius:4px;font-size:11px}
        .tagline-text{display:flex;align-items:center;gap:6px;font-weight:500;color:#f0f7f4}
        .top-right-info{display:flex;align-items:center;gap:16px;color:#f0f7f4;font-size:12px;font-weight:500}
        .top-right-info span.divider{color:rgba(255,255,255,.3)}
        .top-right-info strong{color:var(--gold);font-weight:700}

        /* Main Header Navigation */
        header.main-header{position:sticky;top:0;z-index:100;background:#ffffff;border-bottom:1px solid #e8e4da;box-shadow:0 2px 10px rgba(0,0,0,.03)}
        .main-nav{min-height:74px;display:flex;align-items:center;justify-content:space-between;gap:15px}

        /* Logo Brand */
        .brand{display:flex;align-items:center;gap:10px}
        .brand-logo-circle{width:44px;height:44px;border-radius:50%;background:var(--green-deep);border:2px solid var(--gold);display:grid;place-items:center;color:var(--gold);font-size:22px;box-shadow:0 2px 6px rgba(0,0,0,.1)}
        .brand-text-wrap{display:flex;flex-direction:column}
        .brand-title{font:700 20px var(--serif);color:var(--green-deep);line-height:1.1;letter-spacing:-0.3px}
        .brand-subtitle{font-size:11px;color:var(--gold);font-weight:700;margin-top:2px}

        /* Navigation Links */
        .center-nav-links{display:flex;align-items:center;gap:18px;font-size:13px;font-weight:600;color:#2c4037}
        .center-nav-links a{padding:6px 0;position:relative;transition:color .18s}
        .center-nav-links a:hover{color:var(--green-deep)}
        .center-nav-links a.active{color:var(--green-deep);font-weight:700}
        .center-nav-links a.active:after{content:'';position:absolute;bottom:0;left:0;right:0;height:2px;background:var(--gold);border-radius:2px}
        .center-nav-links a.live-badge-link{color:#d92525;font-weight:700;display:inline-flex;align-items:center;gap:4px}
        .center-nav-links a.live-badge-link .red-dot{width:7px;height:7px;background:#d92525;border-radius:50%;display:inline-block;animation:pulse-dot 1.5s infinite}

        @keyframes pulse-dot {
            0% { transform: scale(0.95); opacity: 0.8; }
            50% { transform: scale(1.2); opacity: 1; }
            100% { transform: scale(0.95); opacity: 0.8; }
        }

        /* Header Right Action Buttons */
        .header-actions{display:flex;align-items:center;gap:10px}
        .heart-cart-btn{position:relative;width:42px;height:42px;border-radius:50%;background:#f9f6ea;border:1px solid #e8e2cf;display:grid;place-items:center;font-size:16px;color:var(--green-deep);cursor:pointer;transition:.2s}
        .heart-cart-btn:hover{background:#f0ebd8}
        .heart-cart-btn .badge-count{position:absolute;top:-2px;right:-2px;background:#d92525;color:#fff;font-size:10px;font-weight:700;width:18px;height:18px;border-radius:50%;display:grid;place-items:center;border:2px solid #fff}

        .mobile-menu-btn{display:none;width:42px;height:42px;border-radius:6px;border:1px solid #d1cbba;background:#fff;color:var(--green-deep);font-size:22px;place-items:center;cursor:pointer}

        .btn-pill{display:inline-flex;align-items:center;justify-content:center;padding:8px 20px;border-radius:30px;font-size:13px;font-weight:700;transition:.2s;cursor:pointer}
        .btn-pill-outline{background:#fff;border:1.5px solid #2a5849;color:#2a5849}
        .btn-pill-outline:hover{background:#f0f7f4;color:var(--green-deep)}
        .btn-pill-gold{background:var(--gold);border:1.5px solid var(--gold);color:var(--green-deep)}
        .btn-pill-gold:hover{background:var(--gold-hover);border-color:var(--gold-hover);color:#000}

        /* Mobile Dropdown Drawer */
        .mobile-nav-drawer{display:none;position:absolute;top:100%;left:0;right:0;background:#fff;border-bottom:2px solid var(--gold);box-shadow:0 10px 25px rgba(0,0,0,.1);padding:20px}
        .mobile-nav-drawer.open{display:block}
        .mobile-links{display:flex;flex-direction:column;gap:12px;font-size:14px;font-weight:600}
        .mobile-links a{padding:8px 12px;border-radius:6px;color:var(--green-deep)}
        .mobile-links a:hover{background:#f0f7f4}
        .mobile-actions{display:flex;gap:10px;margin-top:16px;padding-top:16px;border-top:1px solid #e8e4da}

        /* Hero Section */
        .hero{padding:50px 0 70px;background:radial-gradient(ellipse at 75% 0%,rgba(46,104,77,.6),transparent 50%),var(--green-deep);color:#fff;position:relative}
        .hero-grid{display:grid;grid-template-columns:1.1fr .9fr;align-items:center;gap:40px}
        .badge-pill{display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.12);border:1px solid rgba(203,161,53,.4);color:var(--gold);padding:6px 14px;border-radius:30px;font-size:12px;font-weight:600;margin-bottom:16px}
        .badge-pill .dot{width:8px;height:8px;background:#22c55e;border-radius:50%;display:inline-block}
        .badge-pill.green{background:#e6f4ea;color:#137333;border-color:#ceebd5}
        .hero h1{margin:12px 0;font:700 clamp(30px,4vw,50px)/1.3 var(--serif)}
        .hero h1 em{color:var(--gold);font-style:normal}
        .hero-copy{color:#e2e8e4;font-size:15px;line-height:1.9;max-width:540px;margin-bottom:24px}
        .hero-buttons{display:flex;gap:14px;flex-wrap:wrap}
        .hero-image{position:relative;min-height:350px;border:2px solid var(--gold);border-radius:48% 48% 8px 8px;overflow:hidden;background:#1b4a3c}
        .hero-image img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}
        .hero-image span{position:absolute;bottom:15px;left:20px;right:20px;z-index:2;color:#fff;font-size:12px;background:rgba(8,58,48,.85);padding:8px 12px;border-radius:4px;text-align:center}

        /* Search / Filter Card */
        .search-wrap{position:relative;z-index:10;margin-top:-35px}
        .search-panel-rich{background:#fff;border:1px solid #e2ded0;border-radius:12px;padding:24px;box-shadow:0 15px 35px rgba(8,58,48,.1)}
        .form-row{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px}
        .form-row label span{display:block;font-size:12px;font-weight:700;color:var(--green-deep);margin-bottom:6px}
        select,input{width:100%;min-height:44px;padding:9px 12px;border:1px solid #d1cbba;border-radius:30px;background:#fcfbf8;font-size:13px;color:var(--ink);outline-color:var(--gold)}
        .form-submit{margin-top:20px;text-align:center}
        .filter-btn{width:100%;max-width:420px;min-height:48px;font-size:14px;background:var(--green-deep);color:var(--gold);border:1px solid var(--gold);border-radius:30px;font-weight:700}
        .filter-btn:hover{background:var(--green);color:#fff}

        /* Sections Header */
        .section{padding:65px 0}
        .section-center-head{text-align:center;max-width:680px;margin:0 auto 35px}
        .section-center-head .sub-title{color:var(--gold);font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px;display:block;margin-bottom:6px}
        .section-center-head h2{font:700 30px/1.4 var(--serif);color:var(--green-deep);margin:6px 0 10px}
        .section-center-head p{color:var(--muted);font-size:13px;line-height:1.8}

        /* Tabs Filter */
        .filter-tabs{display:flex;justify-content:center;gap:10px;flex-wrap:wrap;margin-bottom:30px}
        .tab-item{padding:8px 18px;border-radius:30px;border:1px solid #d1cbba;background:#fff;color:var(--ink);font-size:13px;font-weight:600;transition:.2s}
        .tab-item:hover,.tab-item.active{background:var(--green-deep);color:var(--gold);border-color:var(--green-deep)}
        .tab-item.urgent{background:#fff1f0;color:#e11d48;border-color:#fca5a5}

        /* Biodata Cards Grid */
        .profile-cards-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(330px,1fr));gap:22px}
        .biodata-card{background:#fff;border:1px solid #e5e0d3;border-radius:10px;padding:20px;box-shadow:0 4px 15px rgba(0,0,0,.03);display:flex;flex-direction:column;justify-space-between;transition:.2s}
        .biodata-card:hover{transform:translateY(-3px);box-shadow:0 10px 25px rgba(8,58,48,.08);border-color:var(--gold)}
        .card-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:14px}
        .status-badge{background:#e6f4ea;color:#137333;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px}
        .id-badge{background:#f1efe5;color:var(--green-deep);font-size:11px;font-weight:700;padding:3px 8px;border-radius:4px}
        .card-avatar-wrap{text-align:center;margin-bottom:12px}
        .card-avatar{width:64px;height:64px;border-radius:50%;background:#e5eee7;display:grid;place-items:center;font-size:28px;margin:0 auto;border:2px solid var(--gold)}
        .card-body h3{text-align:center;font:700 18px var(--serif);color:var(--green-deep);margin:0 0 12px}
        .card-info-list{list-style:none;padding:0;margin:0 0 14px;font-size:12px;color:var(--muted);line-height:2}
        .quote-text{background:#fbfaf6;border-left:3px solid var(--gold);padding:8px 12px;font-size:12px;color:#4a5851;margin:0 0 16px;border-radius:0 6px 6px 0;font-style:italic}
        .card-footer{display:flex;gap:10px;align-items:center;margin-top:auto}
        .card-btn{flex:1;background:var(--green-deep);color:#fff;font-size:12px;border-radius:6px;min-height:38px}
        .card-btn:hover{background:var(--green)}
        .fav-btn{width:38px;height:38px;border:1px solid #d1cbba;border-radius:6px;background:#fff;color:#e11d48;font-size:15px;display:grid;place-items:center}

        /* Why Choose Us */
        .why-us{background:#f3f1e8}
        .feature-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:20px}
        .feature-card{background:#fff;padding:26px;border-radius:10px;border:1px solid #e0dad0;text-align:center}
        .feature-card .icon{font-size:36px;margin-bottom:12px}
        .feature-card h3{font:700 18px var(--serif);color:var(--green-deep);margin:0 0 8px}
        .feature-card p{font-size:12px;color:var(--muted);line-height:1.8;margin:0}

        /* 4 Steps */
        .steps-section{background:#fff}
        .four-steps-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px}
        .step-card{background:#fbfaf6;border:1px solid #e5e0d3;padding:24px;border-radius:10px;position:relative;text-align:center}
        .step-number{width:36px;height:36px;background:var(--gold);color:var(--green-deep);font-weight:700;border-radius:50%;display:grid;place-items:center;margin:0 auto 14px;font-size:16px}
        .step-card h3{font:700 16px var(--serif);color:var(--green-deep);margin:0 0 8px}
        .step-card p{font-size:12px;color:var(--muted);line-height:1.7;margin:0}

        /* Pricing Packages */
        .pricing-section{background:#f6f4ed}
        .pricing-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:24px;align-items:center}
        .price-card{background:#fff;border:1px solid #e0dad0;border-radius:12px;padding:30px;position:relative;text-align:center}
        .price-card.popular{border:2px solid var(--gold);box-shadow:0 10px 30px rgba(203,161,53,.15);transform:scale(1.03)}
        .price-card .badge{position:absolute;top:-12px;left:50%;transform:translateX(-50%);padding:4px 14px;border-radius:20px;font-size:11px;font-weight:700}
        .price-card .badge.free{background:#e2e8f0;color:#334155}
        .price-card .badge.featured{background:var(--gold);color:var(--green-deep)}
        .price-card h3{font:700 22px var(--serif);color:var(--green-deep);margin:10px 0 4px}
        .price-card .subtitle{font-size:12px;color:var(--muted);margin:0 0 16px}
        .price-card .price{font:700 32px var(--serif);color:var(--green-deep);margin-bottom:20px}
        .price-card .price span{font-size:12px;color:var(--muted);font-family:var(--sans)}
        .plan-features{list-style:none;padding:0;margin:0 0 24px;text-align:left;font-size:13px;line-height:2.2;color:#334155}

        /* Success Stories */
        .stories-section{background:#fff}
        .stories-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:22px}
        .story-card{background:#fbfaf6;border:1px solid #e2ded0;border-radius:10px;padding:20px;text-align:center}
        .story-img{height:180px;border-radius:8px;overflow:hidden;margin-bottom:14px}
        .story-img img{width:100%;height:100%;object-fit:cover}
        .story-card h3{font:700 18px var(--serif);color:var(--green-deep);margin:0 0 4px}
        .story-card .date{font-size:11px;color:var(--gold);font-weight:600;display:block;margin-bottom:10px}
        .story-card p{font-size:12px;color:var(--muted);line-height:1.8;margin:0 0 12px;font-style:italic}
        .story-link{color:#e11d48;font-size:12px;font-weight:700}

        /* Blog Section */
        .blog-section{background:#f8f6f0}
        .blog-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:22px}
        .blog-card{background:#fff;border:1px solid #e0dad0;border-radius:10px;overflow:hidden}
        .blog-img{height:170px;overflow:hidden}
        .blog-img img{width:100%;height:100%;object-fit:cover}
        .blog-body{padding:18px}
        .blog-body .category{background:#e6f4ea;color:#137333;font-size:10px;font-weight:700;padding:2px 8px;border-radius:4px;display:inline-block;margin-bottom:8px}
        .blog-body h3{font:700 16px var(--serif);color:var(--green-deep);margin:0 0 8px;line-height:1.4}
        .blog-body p{font-size:12px;color:var(--muted);line-height:1.7;margin:0 0 12px}
        .read-more{color:var(--green-deep);font-size:12px;font-weight:700}

        /* FAQ Accordion */
        .faq-section{background:#fff}
        .faq-accordion{max-width:760px;margin:0 auto;display:grid;gap:12px}
        .faq-item{background:#fbfaf6;border:1px solid #e0dad0;border-radius:8px;padding:14px 18px}
        .faq-item summary{font-weight:700;font-size:14px;color:var(--green-deep);cursor:pointer;outline:none}
        .faq-answer{padding-top:10px;font-size:13px;color:var(--muted);line-height:1.8}

        /* Bottom Banner CTA */
        .bottom-cta-banner{background:var(--green-deep);color:#fff;padding:60px 0;text-align:center}
        .banner-inner{max-width:640px;margin:0 auto}
        .banner-inner h2{font:700 28px var(--serif);margin:0 0 12px;color:var(--gold)}
        .banner-inner p{font-size:14px;color:#e2e8e4;margin:0 0 24px;line-height:1.8}

        /* Footer */
        footer{background:#05241c;color:#a2b2ab;padding:50px 0 20px;font-size:12px}
        .footer-row{display:flex;justify-content:space-between;gap:30px;flex-wrap:wrap;border-bottom:1px solid rgba(255,255,255,.1);padding-bottom:30px}
        .footer-row p{max-width:380px;line-height:1.8;margin:12px 0 0}
        .footer-links{display:flex;gap:20px;font-weight:600}
        .footer-links a:hover{color:var(--gold)}
        .copyright{text-align:center;padding-top:20px;color:#6d8077;font-size:11px}

        @media(max-width:1024px){
            .center-nav-links{gap:12px;font-size:12px}
        }
        @media(max-width:850px){
            .center-nav-links{display:none}
            .header-actions .btn-pill{display:none}
            .mobile-menu-btn{display:grid}
            .top-header-row{justify-content:center;text-align:center;gap:8px}
            .top-left-info{display:none}
            .top-right-info{font-size:11px}
            .hero-grid{grid-template-columns:1fr}
            .hero-image{min-height:260px}
            .brand-title{font-size:17px}
            .brand-logo-circle{width:38px;height:38px;font-size:18px}
        }
    </style>
</head>
<body>
    <!-- Top Utility Bar -->
    <div class="top-header-bar">
        <div class="container top-header-row">
            <div class="top-left-info">
                <span class="shariah-badge">শরীয়াহ সম্মত</span>
                <span class="tagline-text">🕋 ১০০% সুন্নতি ও অভিভাবক-বান্ধব ইসলামিক বিবাহ প্ল্যাটফর্ম</span>
            </div>
            <div class="top-right-info">
                <span>🎧 হেল্পলাইন: <strong>০১২৩৩-৫৫০০MB</strong></span>
                <span class="divider">|</span>
                <span>🕒 সকাল ১০টা - রাত ১০টা</span>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="main-header">
        <div class="container main-nav">
            <!-- Brand Logo -->
            <a class="brand" href="{{ route('home') }}">
                <div class="brand-logo-circle">د</div>
                <div class="brand-text-wrap">
                    <span class="brand-title">Dindaar Life Partner</span>
                    <span class="brand-subtitle">দ্বীনদার লাইফ পার্টনার</span>
                </div>
            </a>

            <!-- Center Navigation Links (Desktop) -->
            <nav class="center-nav-links" aria-label="Main Navigation">
                <a href="{{ route('home') }}" class="active">হোম</a>
                <a href="#profiles" class="live-badge-link"><span class="red-dot"></span> লাইভ বায়োডাটা</a>
                <a href="#guide">ধাপসমূহ</a>
                <a href="#why-us">কেন আমরা</a>
                <a href="#packages">প্যাকেজসমূহ</a>
                <a href="#stories">সাফল্যের গল্প</a>
                <a href="#blog">গাইডলাইন</a>
                <a href="#faq">FAQ</a>
            </nav>

            <!-- Right Action Buttons -->
            <div class="header-actions">
                <div class="heart-cart-btn" title="পছন্দের তালিকা">
                    ❤️
                    <span class="badge-count">0</span>
                </div>
                @auth
                    <a class="btn-pill btn-pill-outline" href="{{ route('dashboard') }}">{{ __('site.dashboard') }}</a>
                @else
                    <a class="btn-pill btn-pill-outline" href="{{ route('login') }}">লগইন</a>
                    <a class="btn-pill btn-pill-gold" href="{{ route('register') }}">নিবন্ধন করুন</a>
                @endauth
                <button class="mobile-menu-btn" onclick="toggleMobileMenu()" aria-label="Toggle Menu">☰</button>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div class="mobile-nav-drawer" id="mobileDrawer">
            <div class="mobile-links">
                <a href="{{ route('home') }}">হোম</a>
                <a href="#profiles">🔴 লাইভ বায়োডাটা</a>
                <a href="#guide">ধাপসমূহ</a>
                <a href="#why-us">কেন আমরা</a>
                <a href="#packages">প্যাকেজসমূহ</a>
                <a href="#stories">সাফল্যের গল্প</a>
                <a href="#blog">গাইডলাইন</a>
                <a href="#faq">FAQ</a>
            </div>
            <div class="mobile-actions">
                @auth
                    <a class="btn-pill btn-pill-outline" style="width:100%" href="{{ route('dashboard') }}">{{ __('site.dashboard') }}</a>
                @else
                    <a class="btn-pill btn-pill-outline" style="width:50%" href="{{ route('login') }}">লগইন</a>
                    <a class="btn-pill btn-pill-gold" style="width:50%" href="{{ route('register') }}">নিবন্ধন করুন</a>
                @endauth
            </div>
        </div>
    </header>

    @if (session('status'))
        <div class="container flash" role="status" style="margin-top:15px;padding:12px;background:#e6f4ea;color:#137333;border-radius:6px">{{ session('status') }}</div>
    @endif

    <main>@yield('content')</main>

    <footer>
        <div class="container">
            <div class="footer-row">
                <div>
                    <a class="brand" href="{{ route('home') }}" style="color:#fff">
                        <div class="brand-logo-circle">د</div>
                        <div class="brand-text-wrap">
                            <span class="brand-title" style="color:#fff">Dindaar Life Partner</span>
                            <span class="brand-subtitle">দ্বীনদার লাইফ পার্টনার</span>
                        </div>
                    </a>
                    <p>সম্পূর্ণ শরীয়াহ সম্মত উপায়ে ডাইনামিক দ্বীনদার জীবনসঙ্গী খোঁজার বিশ্বস্ত জাতীয় নেটওয়ার্ক।</p>
                </div>
                <nav class="footer-links" aria-label="{{ __('site.footer_navigation') }}">
                    <a href="{{ route('home') }}">হোম পেজ</a>
                    <a href="{{ route('biodatas.index') }}">নবীন বায়োডাটা</a>
                    <a href="{{ route('guide') }}">বায়োডাটা তৈরির ধাপ</a>
                    <a href="{{ route('faq') }}">প্যাকেজ ও ফি</a>
                    <a href="{{ route('contact') }}">যোগাযোগ</a>
                </nav>
            </div>
            <div class="copyright">© {{ date('Y') }} Dindaar Life Partner | সর্বস্বত্ব সংরক্ষিত।</div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            var drawer = document.getElementById('mobileDrawer');
            drawer.classList.toggle('open');
        }
    </script>
</body>
</html>
