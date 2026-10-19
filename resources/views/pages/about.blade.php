@extends('layouts.app')

@section('title', __('site.about_title').' | '.config('app.name'))

@section('content')
    <section class="container page-head"><span class="eyebrow">Dindhar Life Partner</span><h1>{{ __('site.about_title') }}</h1></section>
    <section class="container section" style="padding-top:0;max-width:900px">
        <article class="panel about-copy"><p>{{ __('site.about_copy') }}</p><p>{{ __('site.about_copy_second') }}</p><a class="button" href="{{ route('guide') }}">{{ __('site.how_it_works') }} ↗</a></article>
    </section>
@endsection