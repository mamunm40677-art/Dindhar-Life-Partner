@extends('layouts.app')

@section('title', __('site.create_biodata').' | '.config('app.name'))

@section('content')
    <section class="container page-head"><span class="eyebrow">{{ __('site.dashboard') }}</span><h1>{{ __('site.profile_form_title') }}</h1><p>{{ __('site.profile_form_copy') }}</p></section>
    <section class="container section" style="padding-top:0"><div style="max-width:820px">@include('biodatas._form')</div></section>
@endsection