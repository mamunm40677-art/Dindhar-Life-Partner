@extends('layouts.app')

@section('title', __('site.dashboard_title').' | '.config('app.name'))

@section('content')
    <style>
        .dashboard-shell{display:grid;grid-template-columns:245px minmax(0,1fr);gap:28px;padding-top:38px;padding-bottom:64px}
        .account-sidebar{align-self:start;padding:20px;border:1px solid var(--line);border-radius:5px;background:#fff}
        .account-identity{padding-bottom:20px;border-bottom:1px solid var(--line)}
        .account-avatar{display:grid;place-items:center;width:54px;aspect-ratio:1;margin-bottom:12px;border-radius:50%;background:var(--mint);color:var(--green);font:600 22px var(--serif)}
        .account-identity strong{display:block;font:600 15px var(--serif);overflow-wrap:anywhere}
        .account-identity small{display:block;margin-top:5px;color:var(--muted);font-size:10px;overflow-wrap:anywhere}
        .account-menu{display:grid;gap:5px;margin-top:17px}
        .account-menu a{display:flex;align-items:center;gap:10px;min-height:39px;padding:0 10px;border-radius:3px;color:#53665d;font-size:11px}
        .account-menu a:hover,.account-menu a[aria-current="page"]{background:#edf3ed;color:var(--green);font-weight:700}
        .dashboard-main{min-width:0}
        .dashboard-heading{display:flex;align-items:end;justify-content:space-between;gap:16px;margin-bottom:23px}
        .dashboard-heading h1{margin:8px 0 5px;font-size:29px}
        .dashboard-heading p{margin:0;color:var(--muted);font-size:11px}
        .dashboard-metrics{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:12px;margin-bottom:19px}
        .metric{min-height:95px;padding:15px;border:1px solid var(--line);border-radius:4px;background:#fff}
        .metric small{display:block;margin-bottom:9px;color:var(--muted);font-size:10px}
        .metric strong{display:block;font:600 14px var(--serif);overflow-wrap:anywhere}
        .dashboard-card{padding:20px;border:1px solid var(--line);border-radius:4px;background:#fff}
        .dashboard-card-head{display:flex;align-items:start;justify-content:space-between;gap:15px;margin-bottom:16px}
        .dashboard-card h2{margin:0;font:600 18px var(--serif)}
        .status-pill{display:inline-flex;align-items:center;gap:7px;padding:6px 9px;border-radius:3px;background:#e8f1e9;color:var(--green);font-size:10px;font-weight:700}
        .status-pill.draft{background:#f6efdf;color:#816321}
        .dashboard-empty{padding:25px;border:1px dashed #c9d5cc;border-radius:4px;background:#fbfcf9;color:var(--muted);font-size:12px;line-height:1.9}
        .dashboard-quicklinks{display:flex;flex-wrap:wrap;gap:10px;margin-top:17px}
        @media(max-width:760px){.dashboard-shell{grid-template-columns:1fr;gap:18px;padding-top:24px}.account-sidebar{padding:14px}.account-identity{display:flex;align-items:center;gap:12px;padding-bottom:12px}.account-avatar{width:42px;margin:0}.account-menu{grid-template-columns:repeat(3,minmax(0,1fr));margin-top:12px}.account-menu a{justify-content:center;padding:0 5px;text-align:center;font-size:10px}.dashboard-heading{align-items:start;flex-direction:column}.dashboard-heading h1{font-size:25px}}
        @media(max-width:480px){.dashboard-metrics{grid-template-columns:1fr}.metric{min-height:auto}.dashboard-card{padding:15px}.dashboard-card-head{align-items:start;flex-direction:column}.account-menu{grid-template-columns:repeat(2,minmax(0,1fr))}}
    </style>
    <section class="container dashboard-shell">
        <aside class="account-sidebar" aria-label="{{ __('site.account_menu') }}">
            <div class="account-identity">
                <span class="account-avatar" aria-hidden="true">{{ mb_substr(auth()->user()->name, 0, 1) }}</span>
                <div><strong>{{ auth()->user()->name }}</strong><small>{{ auth()->user()->email }}</small></div>
            </div>
            <nav class="account-menu">
                <a href="{{ route('dashboard') }}" aria-current="page"><span aria-hidden="true">⌂</span>{{ __('site.dashboard') }}</a>
                <a href="{{ route('biodatas.index') }}"><span aria-hidden="true">⌕</span>{{ __('site.browse_profiles') }}</a>
                @if ($biodata)
                    <a href="{{ route('my-biodata.edit', $biodata) }}"><span aria-hidden="true">✎</span>{{ __('site.edit_profile') }}</a>
                @else
                    <a href="{{ route('my-biodata.create') }}"><span aria-hidden="true">＋</span>{{ __('site.create_biodata') }}</a>
                @endif
                <a href="{{ route('guide') }}"><span aria-hidden="true">↗</span>{{ __('site.help_center') }}</a>
            </nav>
        </aside>

        <div class="dashboard-main">
            <div class="dashboard-heading">
                <div><span class="eyebrow">{{ __('site.account_overview') }}</span><h1>{{ __('site.dashboard_title') }}</h1><p>{{ __('site.dashboard_intro') }}</p></div>
                @if ($biodata)
                    <a class="button" href="{{ route('my-biodata.edit', $biodata) }}">{{ __('site.edit_profile') }}</a>
                @else
                    <a class="button" href="{{ route('my-biodata.create') }}">{{ __('site.create_biodata') }}</a>
                @endif
            </div>

            <div class="dashboard-metrics">
                <article class="metric"><small>{{ __('site.profile_visibility') }}</small><strong>{{ $biodata ? ($biodata->published ? __('site.published') : __('site.draft')) : __('site.profile_missing') }}</strong></article>
                <article class="metric"><small>{{ __('site.member_since') }}</small><strong>{{ $memberSince?->translatedFormat('M Y') }}</strong></article>
                <article class="metric"><small>{{ __('site.profile_updated_at') }}</small><strong>{{ $biodata?->updated_at?->translatedFormat('d M Y') ?? '—' }}</strong></article>
            </div>

            <section class="dashboard-card" aria-labelledby="biodata-heading">
                <div class="dashboard-card-head">
                    <div><span class="eyebrow">{{ __('site.your_biodata') }}</span><h2 id="biodata-heading">{{ $biodata?->display_name ?? __('site.profile_missing') }}</h2></div>
                    @if ($biodata)<span class="status-pill {{ $biodata->published ? '' : 'draft' }}">{{ $biodata->published ? __('site.published') : __('site.draft') }}</span>@endif
                </div>
                @if ($biodata)
                    <div class="info-list">
                        <div class="info-item"><small>{{ __('site.gender_label') }}</small><strong>{{ __('site.gender_'.$biodata->gender) }}</strong></div>
                        <div class="info-item"><small>{{ __('site.age') }}</small><strong>{{ __('site.age_years', ['age' => $biodata->age]) }}</strong></div>
                        <div class="info-item"><small>{{ __('site.city') }}</small><strong>{{ $biodata->city }}</strong></div>
                        <div class="info-item"><small>{{ __('site.education') }}</small><strong>{{ $biodata->education }}</strong></div>
                    </div>
                    <div class="dashboard-quicklinks">
                        <a class="button secondary small" href="{{ route('my-biodata.edit', $biodata) }}">{{ __('site.edit_profile') }}</a>
                        @if ($biodata->published)<a class="button secondary small" href="{{ route('biodatas.show', $biodata) }}">{{ __('site.view_profile') }} ↗</a>@endif
                    </div>
                @else
                    <div class="dashboard-empty">{{ __('site.profile_missing') }}<div class="dashboard-quicklinks"><a class="button small" href="{{ route('my-biodata.create') }}">{{ __('site.create_biodata') }}</a></div></div>
                @endif
            </section>
        </div>
    </section>
@endsection