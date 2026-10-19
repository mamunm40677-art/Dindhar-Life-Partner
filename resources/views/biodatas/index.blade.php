@extends('layouts.app')

@section('title', __('site.search_page_title').' | '.config('app.name'))

@section('content')
    <section class="container page-head">
        <span class="eyebrow">{{ __('site.public_profiles_note') }}</span>
        <h1>{{ __('site.search_page_title') }}</h1>
        <p>{{ __('site.search_title') }}</p>
    </section>
    <section class="container" style="padding-bottom:64px">
        <form class="search-panel" method="get" action="{{ route('biodatas.index') }}">
            <label>{{ __('site.gender') }}
                <select name="gender"><option value="">{{ __('site.all') }}</option><option value="groom" @selected(($filters['gender'] ?? '') === 'groom')>{{ __('site.groom') }}</option><option value="bride" @selected(($filters['gender'] ?? '') === 'bride')>{{ __('site.bride') }}</option></select>
            </label>
            <label>{{ __('site.marital_status') }}
                <select name="marital_status"><option value="">{{ __('site.all') }}</option>@foreach (['never_married', 'divorced', 'widowed'] as $status)<option value="{{ $status }}" @selected(($filters['marital_status'] ?? '') === $status)>{{ __('site.'.$status) }}</option>@endforeach</select>
            </label>
            <label>{{ __('site.city') }}<input name="city" value="{{ $filters['city'] ?? '' }}" maxlength="100"></label>
            <label>{{ __('site.keyword') }}<input name="q" value="{{ $filters['q'] ?? '' }}" placeholder="{{ __('site.keyword_placeholder') }}" maxlength="100"></label>
            <button class="button" type="submit">{{ __('site.search') }} <span aria-hidden="true">↗</span></button>
        </form>
        <div class="section-head" style="margin-top:32px"><h2>{{ __('site.search_results') }} <span style="color:var(--muted);font:12px 'DM Sans',sans-serif">({{ $biodatas->total() }})</span></h2></div>
        @if ($biodatas->isNotEmpty())
            <div class="profile-grid">@foreach ($biodatas as $biodata)@include('biodatas._card', ['biodata' => $biodata])@endforeach</div>
            <div class="pagination">{{ $biodatas->links() }}</div>
        @else
            <div class="empty-state">{{ __('site.no_profiles') }}</div>
        @endif
    </section>
@endsection