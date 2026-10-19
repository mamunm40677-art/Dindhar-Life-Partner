@extends('layouts.app')

@section('title', __('site.guide_title').' | '.config('app.name'))

@section('content')
    <section class="container page-head"><span class="eyebrow">{{ __('site.how_eyebrow') }}</span><h1>{{ __('site.guide_title') }}</h1><p>{{ __('site.family_note') }}</p></section>
    <section class="section how"><div class="container"><div class="steps">
        @foreach (['profile', 'search', 'family', 'decide'] as $index => $step)
            <article class="step"><b>0{{ $index + 1 }}</b><h3>{{ __('site.step_'.$step) }}</h3><p>{{ __('site.step_'.$step.'_copy') }}</p></article>
        @endforeach
    </div></div></section>
    <section class="container cta"><div><h2>{{ __('site.cta_title') }}</h2><p>{{ __('site.cta_copy') }}</p></div><a class="button" href="{{ route('register') }}">{{ __('site.create_account') }}</a></section>
@endsection