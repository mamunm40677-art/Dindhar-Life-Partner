@extends('layouts.app')

@section('title', $biodata->display_name.' | '.config('app.name'))

@section('content')
    <section class="container page-head">
        <a class="eyebrow" href="{{ route('biodatas.index') }}">← {{ __('site.biodatas') }}</a>
        <h1>{{ $biodata->display_name }}</h1>
        <p>{{ __('site.profile_id', ['id' => $biodata->id]) }}</p>
    </section>
    <section class="container section" style="padding-top:0">
        <article class="panel">
            <div class="info-list">
                <div class="info-item"><small>{{ __('site.gender_label') }}</small><strong>{{ __('site.gender_'.$biodata->gender) }}</strong></div>
                <div class="info-item"><small>{{ __('site.age_years', ['age' => $biodata->age]) }}</small><strong>{{ __('site.'.$biodata->marital_status) }}</strong></div>
                <div class="info-item"><small>{{ __('site.city') }}</small><strong>{{ $biodata->city }}</strong></div>
                <div class="info-item"><small>{{ __('site.education') }}</small><strong>{{ $biodata->education }}</strong></div>
                <div class="info-item"><small>{{ __('site.occupation') }}</small><strong>{{ $biodata->occupation }}</strong></div>
            </div>
            <div class="about-copy" style="margin-top:22px"><strong>{{ __('site.about_you') }}</strong><p style="margin:8px 0 0">{{ $biodata->about }}</p></div>
            <p class="about-copy" style="margin:20px 0 0">{{ __('site.profile_form_copy') }}</p>
            @auth
                @if (auth()->user()->biodata?->is($biodata))
                    <div class="actions"><a class="button" href="{{ route('my-biodata.edit', $biodata) }}">{{ __('site.edit_profile') }}</a></div>
                @endif
            @endauth
        </article>
    </section>
@endsection