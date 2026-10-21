@extends('layouts.dashboard-layout')

@section('title', __('site.create_biodata').' | '.config('app.name'))

@section('dash-content')
    <div style="background: #ffffff; border: 1.5px solid #e5e0d3; border-radius: 16px; padding: 24px 28px; box-shadow: 0 4px 15px rgba(6, 40, 32, 0.03); margin-bottom: 24px;">
        <span style="color: #cba135; font-size: 12px; font-weight: 700; text-transform: uppercase;">{{ __('site.dashboard') }}</span>
        <h1 style="font-family: var(--serif); font-size: 24px; font-weight: 700; color: #062820; margin: 4px 0 6px;">{{ __('site.profile_form_title') }}</h1>
        <p style="font-size: 13px; color: #69766f; margin: 0;">{{ __('site.profile_form_copy') }}</p>
    </div>

    @include('biodatas._form')
@endsection
