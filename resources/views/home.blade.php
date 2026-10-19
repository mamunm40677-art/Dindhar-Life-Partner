@extends('layouts.app')

@section('title', config('app.name').' | '.__('site.home'))

@section('content')
    <section class="hero">
        <div class="container hero-grid">
            <div>
                <span class="eyebrow">{{ __('site.hero_eyebrow') }}</span>
                <h1>{{ __('site.hero_title') }}<br><em>{{ __('site.hero_title_accent') }}</em></h1>
                <p class="hero-copy">{{ __('site.hero_copy') }}</p>
            </div>
            <div class="hero-image">
                <img src="https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?auto=format&amp;fit=crop&amp;w=1100&amp;q=85" alt="{{ __('site.hero_photo_alt') }}" fetchpriority="high">
                <span>{{ __('site.hero_photo_note') }}</span>
            </div>
        </div>
    </section>

    <section class="container search-wrap" aria-label="{{ __('site.search_title') }}">
        <form class="search-panel" method="get" action="{{ route('biodatas.index') }}">
            <h2>{{ __('site.search_title') }}</h2>
            <label>{{ __('site.gender') }}
                <select name="gender">
                    <option value="">{{ __('site.all') }}</option>
                    <option value="groom" @selected(request('gender') === 'groom')>{{ __('site.groom') }}</option>
                    <option value="bride" @selected(request('gender') === 'bride')>{{ __('site.bride') }}</option>
                </select>
            </label>
            <label>{{ __('site.marital_status') }}
                <select name="marital_status">
                    <option value="">{{ __('site.all') }}</option>
                    @foreach (['never_married', 'divorced', 'widowed'] as $status)
                        <option value="{{ $status }}" @selected(request('marital_status') === $status)>{{ __('site.'.$status) }}</option>
                    @endforeach
                </select>
            </label>
            <label>{{ __('site.city') }}<input name="city" value="{{ request('city') }}" maxlength="100"></label>
            <label>{{ __('site.keyword') }}<input name="q" placeholder="{{ __('site.keyword_placeholder') }}" value="{{ request('q') }}" maxlength="100"></label>
            <button class="button" type="submit">{{ __('site.search') }} <span aria-hidden="true">↗</span></button>
        </form>
    </section>

    <section class="container section" id="profiles">
        <div class="section-head">
            <div><span class="eyebrow">{{ __('site.public_profiles_note') }}</span><h2>{{ __('site.new_profiles') }}</h2></div>
            <a class="button secondary small" href="{{ route('biodatas.index') }}">{{ __('site.biodatas') }} <span aria-hidden="true">↗</span></a>
        </div>
        @if ($biodatas->isNotEmpty())
            <div class="profile-grid">
                @foreach ($biodatas as $biodata)
                    @include('biodatas._card', ['biodata' => $biodata])
                @endforeach
            </div>
        @else
            <div class="empty-state">{{ __('site.no_profiles') }} <a href="{{ route('register') }}">{{ __('site.create_account') }}</a></div>
        @endif
    </section>

    <section class="section how" id="how">
        <div class="container">
            <div class="section-head"><div><span class="eyebrow">{{ __('site.how_eyebrow') }}</span><h2>{{ __('site.how_title') }}</h2></div><p>{{ __('site.family_note') }}</p></div>
            <div class="steps">
                @foreach (['profile', 'search', 'family', 'decide'] as $index => $step)
                    <article class="step"><b>0{{ $index + 1 }}</b><h3>{{ __('site.step_'.$step) }}</h3><p>{{ __('site.step_'.$step.'_copy') }}</p></article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="container cta">
        <div><h2>{{ __('site.cta_title') }}</h2><p>{{ __('site.cta_copy') }}</p></div>
        <a class="button" href="{{ route('register') }}">{{ __('site.create_biodata') }} <span aria-hidden="true">↗</span></a>
    </section>
@endsection