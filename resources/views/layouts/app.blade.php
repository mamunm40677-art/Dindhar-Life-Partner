<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f7f8f3">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="{{ __('site.meta_description') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Noto+Serif+Bengali:wght@400;500;600;700&family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{--ink:#18352d;--green:#23634e;--green-deep:#174735;--mint:#e5eee7;--paper:#f7f8f3;--rose:#c57669;--gold:#d4a74d;--muted:#69766f;--line:#dfe6df;--sans:'Noto Sans Bengali','DM Sans',sans-serif;--serif:'Noto Serif Bengali',serif}
        *{box-sizing:border-box}html{scroll-behavior:smooth}body{margin:0;background:var(--paper);color:var(--ink);font-family:var(--sans)}a{color:inherit;text-decoration:none}button,input,select,textarea{font:inherit}button{cursor:pointer}.container{width:min(1160px,calc(100% - 48px));margin-inline:auto}.topline{height:5px;background:linear-gradient(90deg,var(--green) 0 67%,var(--gold) 67% 82%,var(--rose) 82%)}
        header{position:relative;z-index:3;background:rgba(247,248,243,.95);border-bottom:1px solid rgba(24,53,45,.08)}.nav{min-height:76px;display:flex;align-items:center;justify-content:space-between;gap:20px}.brand{display:flex;align-items:center;gap:10px;font-size:16px;font-weight:700;white-space:nowrap}.brand-mark{display:grid;place-items:center;width:39px;aspect-ratio:1;background:var(--green);border-radius:13px 13px 13px 4px;color:#fff;font:600 19px var(--serif)}.brand small{display:block;color:var(--muted);font:500 10px 'DM Sans',sans-serif}.nav-links,.nav-actions{display:flex;align-items:center;gap:clamp(12px,2vw,24px);font-size:12px}.nav-links{color:#45584f}.nav-links a:hover{color:var(--green)}.nav-actions{gap:9px}.nav-actions form{margin:0}.button{display:inline-flex;align-items:center;justify-content:center;gap:7px;min-height:42px;padding:0 17px;border:1px solid transparent;border-radius:4px;background:var(--green);color:#fff;font-size:12px;font-weight:600;transition:.18s}.button:hover{background:var(--green-deep);transform:translateY(-1px)}.button.secondary{background:transparent;border-color:var(--line);color:var(--ink)}.button.secondary:hover{background:#fff}.button.small{min-height:35px;padding:0 12px}.language-button{border:0;background:transparent;color:var(--green);font:700 12px 'DM Sans',sans-serif}.flash{margin:20px auto;padding:13px 16px;border-left:3px solid var(--green);background:#eaf2ec;color:var(--green-deep);font-size:13px}.errors{margin:18px 0;padding:14px 18px;border-left:3px solid var(--rose);background:#f7e9e5;color:#813f37;font-size:12px}.errors ul{margin:0;padding-left:18px}
        main{min-height:55vh}.hero{position:relative;overflow:hidden;padding:58px 0 72px;background:var(--mint)}.hero:after{content:'';position:absolute;width:380px;height:380px;border:1px solid rgba(35,99,78,.16);border-radius:50%;right:-190px;bottom:-290px;box-shadow:0 0 0 34px rgba(35,99,78,.04),0 0 0 70px rgba(35,99,78,.025)}.hero-grid{position:relative;z-index:1;display:grid;grid-template-columns:1.08fr .92fr;align-items:center;gap:42px}.eyebrow{display:inline-flex;align-items:center;gap:8px;color:var(--green);font-size:11px;font-weight:700}.eyebrow:before{content:'';width:22px;height:1px;background:var(--rose)}h1,h2,h3,p{margin-top:0}h1{margin:14px 0;font:600 clamp(34px,4.3vw,54px)/1.38 var(--serif)}h1 em{color:var(--green);font-style:normal}.hero-copy{max-width:520px;color:#53665d;font-size:14px;line-height:2}.hero-image{position:relative;min-height:360px;overflow:hidden;border-radius:48% 48% 4px 4px;background:#a2b5a8}.hero-image img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}.hero-image:after{content:'';position:absolute;inset:50% 0 0;background:linear-gradient(transparent,rgba(19,49,39,.48))}.hero-image span{position:absolute;z-index:1;left:22px;bottom:18px;color:white;font-size:11px}.search-wrap{position:relative;z-index:2;margin-top:-28px}.search-panel{display:grid;grid-template-columns:repeat(4,1fr) auto;gap:13px;align-items:end;padding:20px;border:1px solid #e8ece6;border-radius:6px;background:white;box-shadow:0 12px 32px rgba(28,67,52,.08)}.search-panel h2{grid-column:1/-1;margin:0;font:600 17px var(--serif)}label{display:grid;gap:6px;color:#47584f;font-size:11px;font-weight:600}input,select,textarea{width:100%;min-height:42px;padding:9px 11px;border:1px solid var(--line);border-radius:3px;background:#fff;color:var(--ink);font-size:12px;outline-color:var(--green)}textarea{min-height:120px;resize:vertical;line-height:1.8}.section{padding:65px 0}.section-head{display:flex;align-items:end;justify-content:space-between;gap:20px;margin-bottom:24px}.section-head h2{margin:8px 0 0;font:600 27px/1.5 var(--serif)}.section-head p{margin:0 0 4px;color:var(--muted);font-size:11px}.profile-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:15px}.profile-card{display:grid;grid-template-columns:62px 1fr;gap:12px;padding:17px;border:1px solid var(--line);border-radius:4px;background:white}.avatar{display:grid;place-items:center;width:62px;height:76px;border-radius:3px;background:#e6efeb;color:var(--green);font:600 24px var(--serif)}.profile-meta{display:flex;justify-content:space-between;gap:8px;color:var(--green);font-size:10px}.profile-card h3{margin:7px 0 5px;font:600 15px var(--serif)}.profile-card p{margin:0;color:var(--muted);font-size:10px;line-height:1.9}.profile-card .card-link{grid-column:2;color:var(--green);font-size:10px;font-weight:700}.empty-state{padding:30px;border:1px solid var(--line);background:white;color:var(--muted);text-align:center;font-size:13px}.panel{padding:25px;border:1px solid var(--line);border-radius:5px;background:white}.page-head{padding:35px 0 25px}.page-head h1{margin:0;font-size:32px}.page-head p{margin:8px 0 0;color:var(--muted);font-size:12px}.content-grid{display:grid;grid-template-columns:minmax(0,1fr) 270px;gap:26px}.form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}.form-grid .full{grid-column:1/-1}.check-row{display:flex;align-items:center;gap:10px;margin:16px 0;color:var(--ink);font-size:12px}.check-row input{width:16px;min-height:16px}.actions{display:flex;align-items:center;gap:10px;margin-top:20px}.info-list{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:15px}.info-item{padding:14px 0;border-bottom:1px solid var(--line)}.info-item small{display:block;margin-bottom:5px;color:var(--muted);font-size:10px}.info-item strong{font-size:14px;font-weight:600}.about-copy{color:#4f6158;font-size:13px;line-height:2}.how{background:#eef2ec}.steps{display:grid;grid-template-columns:repeat(4,1fr);gap:24px;margin-top:27px}.step{padding-top:13px;border-top:1px solid #b9c9bd}.step b{display:block;margin-bottom:8px;color:var(--rose);font:600 12px 'DM Sans',sans-serif}.step h3{margin-bottom:7px;font:600 15px var(--serif)}.step p{margin:0;color:var(--muted);font-size:11px;line-height:1.8}.pagination{margin-top:22px}.cta{display:flex;align-items:center;justify-content:space-between;gap:20px;padding:30px 0;border-bottom:1px solid var(--line)}.cta h2{margin:0 0 7px;font:600 21px var(--serif)}.cta p{margin:0;color:var(--muted);font-size:11px}footer{padding:26px 0 18px}.footer-row{display:flex;justify-content:space-between;gap:25px;color:var(--muted);font-size:10px;line-height:1.9}.footer-row p{max-width:350px;margin:10px 0}.footer-links{display:flex;align-items:start;gap:20px}.copyright{margin-top:18px;padding-top:12px;border-top:1px solid var(--line);color:#87928b;font:10px 'DM Sans',sans-serif}
        @media(max-width:900px){.nav{min-height:66px}.nav-links{display:none}.hero-grid{gap:24px}.hero-image{min-height:300px}.search-panel{grid-template-columns:repeat(2,minmax(0,1fr))}.search-panel .button{grid-column:1/-1}.profile-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.steps{grid-template-columns:repeat(2,1fr)}}
        @media(max-width:620px){.container{width:calc(100% - 32px)}.brand{font-size:13px}.brand-mark{width:34px}.nav-actions{gap:7px}.nav-actions .button{min-height:36px;padding:0 10px;font-size:10px}.hero{padding:38px 0 54px}.hero-grid{grid-template-columns:1fr;gap:22px}h1{font-size:36px}.hero-copy{font-size:12px}.hero-image{min-height:260px;border-radius:38% 38% 4px 4px}.search-panel{gap:11px;padding:15px}.section{padding:48px 0}.section-head{align-items:start;flex-direction:column;gap:4px}.section-head h2{font-size:23px}.profile-grid{grid-template-columns:1fr}.form-grid,.info-list{grid-template-columns:1fr}.form-grid .full{grid-column:auto}.content-grid{grid-template-columns:1fr}.steps{gap:20px 14px}.cta,.footer-row{align-items:start;flex-direction:column}.footer-links{flex-wrap:wrap;gap:10px 17px}}
        @media(prefers-reduced-motion:reduce){*,*:before,*:after{scroll-behavior:auto!important;animation-duration:.01ms!important;transition-duration:.01ms!important}}
    </style>
</head>
<body>
    <div class="topline"></div>
    <header>
        <div class="container nav">
            <a class="brand" href="{{ route('home') }}"><span class="brand-mark">د</span><span>Dindhar Life Partner<small>{{ __('site.tagline') }}</small></span></a>
            <nav class="nav-links" aria-label="{{ __('site.navigation') }}">
                <a href="{{ route('home') }}">{{ __('site.home') }}</a>
                <a href="{{ route('biodatas.index') }}">{{ __('site.biodatas') }}</a>
                <a href="{{ route('guide') }}">{{ __('site.how_it_works') }}</a>
                <a href="{{ route('about') }}">{{ __('site.about') }}</a>
                <a href="{{ route('faq') }}">FAQ</a>
            </nav>
            <div class="nav-actions">
                <form method="post" action="{{ route('language.update') }}">
                    @csrf
                    <input type="hidden" name="locale" value="{{ app()->getLocale() === 'bn' ? 'en' : 'bn' }}">
                    <button class="language-button" type="submit">{{ app()->getLocale() === 'bn' ? 'EN' : 'বাংলা' }}</button>
                </form>
                @auth
                    <a class="button secondary small" href="{{ route('dashboard') }}">{{ __('site.dashboard') }}</a>
                    <form method="post" action="{{ route('logout') }}">@csrf<button class="button small" type="submit">{{ __('site.logout') }}</button></form>
                @else
                    <a class="button secondary small" href="{{ route('login') }}">{{ __('site.login') }}</a>
                    <a class="button small" href="{{ route('register') }}">{{ __('site.register') }}</a>
                @endauth
            </div>
        </div>
    </header>
    @if (session('status'))
        <div class="container flash" role="status">{{ session('status') }}</div>
    @endif
    <main>@yield('content')</main>
    <footer class="container" id="about">
        <div class="footer-row">
            <div><a class="brand" href="{{ route('home') }}"><span class="brand-mark">د</span><span>Dindhar Life Partner<small>{{ __('site.tagline') }}</small></span></a><p>{{ __('site.footer_copy') }}</p></div>
            <nav class="footer-links" aria-label="{{ __('site.footer_navigation') }}"><a href="{{ route('biodatas.index') }}">{{ __('site.biodatas') }}</a><a href="{{ route('guide') }}">{{ __('site.how_it_works') }}</a><a href="{{ route('faq') }}">FAQ</a><a href="{{ route('contact') }}">{{ __('site.contact') }}</a></nav>
        </div>
        <div class="copyright">© {{ date('Y') }} Dindhar Life Partner. {{ __('site.rights') }}</div>
    </footer>
</body>
</html>