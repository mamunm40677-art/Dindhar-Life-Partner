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
        :root{--ink:#15382f;--green:#0d493a;--green-deep:#083a30;--mint:#e5eee7;--paper:#fbfaf6;--rose:#c57669;--gold:#d4af37;--gold-hover:#b89628;--muted:#69766f;--line:#e5e1d5;--sans:'Noto Sans Bengali','DM Sans',sans-serif;--serif:'Noto Serif Bengali',serif}
        *{box-sizing:border-box}html{scroll-behavior:smooth}body{margin:0;background:var(--paper);color:var(--ink);font-family:var(--sans)}a{color:inherit;text-decoration:none}button,input,select,textarea{font:inherit}button{cursor:pointer}.container{width:min(1160px,calc(100% - 32px));margin-inline:auto}.topline{height:4px;background:linear-gradient(90deg,var(--green) 0 67%,var(--gold) 67% 82%,var(--rose) 82%)}

        /* Top Utility Bar */
        .utility-bar{background:var(--green-deep);color:#f8f4e7;font-size:12px;padding:6px 0;border-bottom:1px solid rgba(212,175,55,.3)}
        .utility-row{display:flex;align-items:center;justify-content:space-between;gap:15px;flex-wrap:wrap}
        .utility-note{display:flex;align-items:center;gap:8px}
        .utility-contact{color:var(--gold);font-weight:600}

        /* Header Navigation */
        header{position:sticky;top:0;z-index:100;background:rgba(251,250,246,.98);backdrop-filter:blur(8px);border-bottom:1px solid var(--line)}
        .nav{min-height:70px;display:flex;align-items:center;justify-content:space-between;gap:20px}
        .brand{display:flex;align-items:center;gap:12px;font-size:17px;font-weight:700;color:var(--green-deep)}
        .brand-mark{display:grid;place-items:center;width:40px;height:40px;border-radius:50%;background:var(--green-deep);color:var(--gold);border:2px solid var(--gold);font:700 20px var(--serif)}
        .brand small{display:block;color:var(--muted);font:500 10px 'DM Sans',sans-serif}
        .nav-links{display:flex;align-items:center;gap:22px;font-size:13px;font-weight:600;color:#344d43}
        .nav-links a:hover{color:var(--gold)}
        .nav-actions{display:flex;align-items:center;gap:10px}

        /* Buttons */
        .button{display:inline-flex;align-items:center;justify-content:center;gap:8px;min-height:42px;padding:0 20px;border:1px solid transparent;border-radius:6px;background:var(--green);color:#fff;font-size:13px;font-weight:600;transition:.2s;cursor:pointer}
        .button:hover{background:var(--green-deep);transform:translateY(-1px)}
        .button.gold{background:var(--gold);color:var(--green-deep);border-color:var(--gold)}
        .button.gold:hover{background:var(--gold-hover);color:#000}
        .button.secondary-outline{background:transparent;border-color:rgba(255,255,255,.4);color:#fff}
        .button.secondary-outline:hover{background:rgba(255,255,255,.1);border-color:#fff}
        .button.small{min-height:36px;padding:0 14px;font-size:12px}
        .language-button{border:1px solid var(--line);padding:5px 12px;border-radius:4px;background:#fff;color:var(--green);font:700 12px 'DM Sans',sans-serif}

        /* Hero Section */
        .hero{padding:50px 0 70px;background:radial-gradient(ellipse at 75% 0%,rgba(46,104,77,.6),transparent 50%),var(--green-deep);color:#fff;position:relative}
        .hero-grid{display:grid;grid-template-columns:1.1fr .9fr;align-items:center;gap:40px}
        .badge-pill{display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.12);border:1px solid rgba(212,175,55,.4);color:var(--gold);padding:6px 14px;border-radius:30px;font-size:12px;font-weight:600;margin-bottom:16px}
        .badge-pill .dot{width:8px;height:8px;background:#22c55e;border-radius:50%;display:inline-block}
        .badge-pill.green{background:#e6f4ea;color:#137333;border-color:#ceebd5}
        .hero h1{margin:12px 0;font:700 clamp(32px,4vw,50px)/1.3 var(--serif)}
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
        select,input{width:100%;min-height:44px;padding:9px 12px;border:1px solid #d1cbba;border-radius:6px;background:#fcfbf8;font-size:13px;color:var(--ink);outline-color:var(--gold)}
        .form-submit{margin-top:20px;text-align:center}
        .filter-btn{width:100%;max-width:420px;min-height:48px;font-size:14px;background:var(--green-deep);color:var(--gold);border:1px solid var(--gold)}
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
        .card-btn{flex:1;background:var(--green-deep);color:#fff;font-size:12px}
        .card-btn:hover{background:var(--green)}
        .fav-btn{width:40px;height:40px;border:1px solid #d1cbba;border-radius:6px;background:#fff;color:#e11d48;font-size:16px;display:grid;place-items:center}

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
        .price-card.popular{border:2px solid var(--gold);box-shadow:0 10px 30px rgba(212,175,55,.15);transform:scale(1.03)}
        .price-card .badge{position:absolute;top:-12px;left:50%;transform:translateX(-50%);padding:4px 14px;border-radius:20px;font-size:11px;font-weight:700}
        .price-card .badge.free{background:#e2e8f0;color:#334155}
        .price-card .badge.featured{background:var(--gold);color:var(--green-deep)}
        .price-card h3{font:700 22px var(--serif);color:var(--green-deep);margin:10px 0 4px}
        .price-card .subtitle{font-size:12px;color:var(--muted);margin:0 0 16px}
        .price-card .price{font:700 32px var(--serif);color:var(--green-deep);margin-bottom:20px}
        .price-card .price span{font-size:12px;color:var(--muted);font-family:var(--sans)}
        .plan-features{list-style:none;padding:0;margin:0 0 24px;text-align:left;font-size:13px;line-height:2.2;color:#334155}
        .button.secondary-full{width:100%;background:transparent;border-color:var(--green-deep);color:var(--green-deep)}
        .button.primary-full{width:100%;background:var(--gold);color:var(--green-deep);font-weight:700}

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

        @media(max-width:768px){
            .hero-grid{grid-template-columns:1fr}
            .hero-image{min-height:260px}
            .nav-links{display:none}
            .price-card.popular{transform:none}
        }
    </style>
</head>
<body>
    <div class="topline"></div>
    <div class="utility-bar">
        <div class="container utility-row">
            <span class="utility-note">পাবলিক লাইভডাটা | ১০০% সুন্নতি ও অভিভাবক সম্বলিত ইসলামিক বিবাহ ম্যাচমেকিং</span>
            <span class="utility-contact">📞 হেল্পলাইন: ০১২৩৩ ৫৭০১MB (সকাল ১০টা - রাত ১০টা)</span>
        </div>
    </div>
    <header>
        <div class="container nav">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-mark">د</span>
                <span>Dindaar Life Partner<small>দ্বীনদার লাইফ পার্টনার</small></span>
            </a>
            <nav class="nav-links" aria-label="{{ __('site.navigation') }}">
                <a href="{{ route('home') }}">লাইভ বায়োডাটা</a>
                <a href="#guide">ধাপসমূহ</a>
                <a href="#search-filter">কেন আমরা</a>
                <a href="#packages">প্যাকেজসমূহ</a>
                <a href="#faq">FAQ</a>
            </nav>
            <div class="nav-actions">
                <form method="post" action="{{ route('language.update') }}">
                    @csrf
                    <input type="hidden" name="locale" value="{{ app()->getLocale() === 'bn' ? 'en' : 'bn' }}">
                    <button class="language-button" type="submit">{{ app()->getLocale() === 'bn' ? 'EN' : 'বাংলা' }}</button>
                </form>
                @auth
                    <a class="button small" href="{{ route('dashboard') }}">{{ __('site.dashboard') }}</a>
                    <form method="post" action="{{ route('logout') }}">@csrf<button class="button secondary-outline small" style="color:var(--green-deep)" type="submit">{{ __('site.logout') }}</button></form>
                @else
                    <a class="button small gold" href="{{ route('login') }}">{{ __('site.login') }}</a>
                    <a class="button small" href="{{ route('register') }}">{{ __('site.register') }}</a>
                @endauth
            </div>
        </div>
    </header>

    @if (session('status'))
        <div class="container flash" role="status">{{ session('status') }}</div>
    @endif

    <main>@yield('content')</main>

    <footer>
        <div class="container">
            <div class="footer-row">
                <div>
                    <a class="brand" href="{{ route('home') }}" style="color:#fff">
                        <span class="brand-mark">د</span>
                        <span>Dindaar Life Partner<small style="color:var(--gold)">দ্বীনদার লাইফ পার্টনার</small></span>
                    </a>
                    <p>সম্পূর্ণ শরীয়াহ সম্মত উপায়ে ডাইনামিক দ্বীনদার জীবনসঙ্গী খোঁজার বিশ্বস্ত জাতীয় নেটওয়ার্ক।</p>
                </div>
                <nav class="footer-links" aria-label="{{ __('site.footer_navigation') }}">
                    <a href="{{ route('home') }}">হোম পেজ</a>
                    <a href="{{ route('biodatas.index') }}">নবীন বায়োডাটা</a>
                    <a href="{{ route('guide') }}">বায়োডাটা তৈরির ধাপ</a>
                    <a href="{{ route('faq') }}">প্যাকেজ ও ফি</a>
                    <a href="{{ route('contact') }}">ইসলমিক বুকস</a>
                </nav>
            </div>
            <div class="copyright">© {{ date('Y') }} Dindaar Life Partner | সর্বস্বত্ব সংরক্ষিত।</div>
        </div>
    </footer>
</body>
</html>
