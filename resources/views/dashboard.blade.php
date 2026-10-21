@extends('layouts.dashboard-layout')

@section('title', __('site.dashboard_title').' | '.config('app.name'))

@section('dash-content')
<style>
    .dash-heading{display:flex;align-items:end;justify-content:space-between;gap:16px;margin-bottom:24px}
    .dash-heading h1{margin:6px 0 4px;font-size:28px;color:#062820;font-family:var(--serif)}
    .dash-heading p{margin:0;color:#69766f;font-size:13px}
    .dash-metrics{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px;margin-bottom:24px}
    .metric{min-height:95px;padding:18px;border:1px solid #e5e0d3;border-radius:10px;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,0.02)}
    .metric small{display:block;margin-bottom:8px;color:#69766f;font-size:11px;font-weight:600;text-transform:uppercase}
    .metric strong{display:block;font:700 16px var(--serif);color:#062820;overflow-wrap:anywhere}
    .dash-card{padding:24px;border:1px solid #e5e0d3;border-radius:12px;background:#fff;box-shadow:0 4px 15px rgba(0,0,0,0.02)}
    .dash-card-head{display:flex;align-items:start;justify-content:space-between;gap:15px;margin-bottom:18px}
    .dash-card h2{margin:0;font:700 20px var(--serif);color:#062820}
    .status-pill{display:inline-flex;align-items:center;gap:7px;padding:6px 14px;border-radius:20px;background:#e6f4ea;color:#137333;font-size:12px;font-weight:700}
    .status-pill.draft{background:#f6efdf;color:#816321}
    .dash-empty{padding:30px;border:1.5px dashed #cba135;border-radius:10px;background:#fbfaf6;color:#69766f;font-size:13px;line-height:1.9;text-align:center}
    .dash-quicklinks{display:flex;flex-wrap:wrap;gap:12px;margin-top:20px}
    .dash-alert-banner {
        background: #fffdf5;
        border: 1.5px solid #cba135;
        border-radius: 12px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 14px;
        color: #062820;
        font-size: 13px;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(203, 161, 53, 0.08);
        margin-bottom: 24px;
    }
    @media(max-width:760px){.dash-heading{align-items:start;flex-direction:column}.dash-heading h1{font-size:24px}}
    @media(max-width:480px){.dash-metrics{grid-template-columns:1fr}.metric{min-height:auto}.dash-card{padding:18px}.dash-card-head{align-items:start;flex-direction:column}}
</style>

<!-- Warning / Alert Banner -->
<div class="dash-alert-banner">
    <span style="font-size: 22px;">📢</span>
    <div>
        <strong>শরীয়াহ সম্মত ইসলামিক বিবাহ প্ল্যাটফর্ম:</strong>
        <span style="font-weight: 400; color: #3a4d45;"> আপনার বায়োডাটা সম্পূর্ণ করুন যাতে অভিভাবকগণ সহজে আপনার সাথে যোগাযোগ করতে পারেন।</span>
    </div>
</div>

<div class="dash-heading">
    <div>
        <span style="color: #cba135; font-size: 12px; font-weight: 700; text-transform: uppercase;">{{ __('site.account_overview') }}</span>
        <h1>{{ __('site.dashboard_title') }}</h1>
        <p>{{ __('site.dashboard_intro') }}</p>
    </div>
    @if ($biodata)
        <a class="button gold" href="{{ route('my-biodata.edit', $biodata) }}" style="padding: 10px 22px; background: #cba135; color: #062820; border-radius: 30px; font-weight: 700; text-decoration: none;">✎ {{ __('site.edit_profile') }}</a>
    @else
        <a class="button gold" href="{{ route('my-biodata.create') }}" style="padding: 10px 22px; background: #cba135; color: #062820; border-radius: 30px; font-weight: 700; text-decoration: none;">＋ {{ __('site.create_biodata') }}</a>
    @endif
</div>

<div class="dash-metrics">
    <article class="metric"><small>{{ __('site.profile_visibility') }}</small><strong>{{ $biodata ? ($biodata->published ? __('site.published') : __('site.draft')) : __('site.profile_missing') }}</strong></article>
    <article class="metric"><small>{{ __('site.member_since') }}</small><strong>{{ $memberSince?->translatedFormat('M Y') }}</strong></article>
    <article class="metric"><small>{{ __('site.profile_updated_at') }}</small><strong>{{ $biodata?->updated_at?->translatedFormat('d M Y') ?? '—' }}</strong></article>
</div>

<section class="dash-card">
    <div class="dash-card-head">
        <div><span style="color: #cba135; font-size: 11px; font-weight: 700; text-transform: uppercase;">আপনার বায়োডাটা তথ্য</span><h2 style="font-size: 20px;">{{ $biodata?->display_name ?? __('site.profile_missing') }}</h2></div>
        @if ($biodata)<span class="status-pill {{ $biodata->published ? '' : 'draft' }}">{{ $biodata->published ? __('site.published') : __('site.draft') }}</span>@endif
    </div>
    @if ($biodata)
        <div class="info-list" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin:20px 0;">
            <div class="info-item" style="background:#fcfbf8;padding:12px;border-radius:8px;border:1px solid #e5e0d3"><small style="display:block;color:#69766f;font-size:11px">{{ __('site.gender_label') }}</small><strong style="color:#062820">{{ __('site.gender_'.$biodata->gender) }}</strong></div>
            <div class="info-item" style="background:#fcfbf8;padding:12px;border-radius:8px;border:1px solid #e5e0d3"><small style="display:block;color:#69766f;font-size:11px">{{ __('site.age') }}</small><strong style="color:#062820">{{ __('site.age_years', ['age' => $biodata->age]) }}</strong></div>
            <div class="info-item" style="background:#fcfbf8;padding:12px;border-radius:8px;border:1px solid #e5e0d3"><small style="display:block;color:#69766f;font-size:11px">{{ __('site.city') }}</small><strong style="color:#062820">{{ $biodata->city }}</strong></div>
            <div class="info-item" style="background:#fcfbf8;padding:12px;border-radius:8px;border:1px solid #e5e0d3"><small style="display:block;color:#69766f;font-size:11px">{{ __('site.education') }}</small><strong style="color:#062820">{{ $biodata->education }}</strong></div>
        </div>
        <div class="dash-quicklinks">
            <a class="button secondary small" href="{{ route('my-biodata.edit', $biodata) }}" style="padding: 8px 18px; border: 1.5px solid #062820; color: #062820; border-radius: 30px; font-weight: 700; text-decoration: none;">✎ {{ __('site.edit_profile') }}</a>
            @if ($biodata->published)<a class="button small" href="{{ route('biodatas.show', $biodata) }}" style="padding: 8px 18px; background: #062820; color: #cba135; border-radius: 30px; font-weight: 700; text-decoration: none;">👁 {{ __('site.view_profile') }} ↗</a>@endif
        </div>
    @else
        <div class="dash-empty">
            <p style="margin-bottom:15px;font-size:14px;color:#062820"><strong>{{ __('site.profile_missing') }}</strong></p>
            <div class="dash-quicklinks" style="justify-content:center">
                <a class="button gold" href="{{ route('my-biodata.create') }}" style="padding: 10px 24px; background: #cba135; color: #062820; border-radius: 30px; font-weight: 700; text-decoration: none;">＋ {{ __('site.create_biodata') }}</a>
            </div>
        </div>
    @endif
</section>
@endsection
