@extends('layouts.dashboard-layout')

@section('title', __('site.edit_profile').' | '.config('app.name'))

@section('dash-content')
    <div style="background: #ffffff; border: 1.5px solid #e5e0d3; border-radius: 16px; padding: 24px 28px; box-shadow: 0 4px 15px rgba(6, 40, 32, 0.03); margin-bottom: 24px;">
        <span style="color: #cba135; font-size: 12px; font-weight: 700; text-transform: uppercase;">{{ __('site.dashboard') }}</span>
        <h1 style="font-family: var(--serif); font-size: 24px; font-weight: 700; color: #062820; margin: 4px 0 6px;">{{ __('site.edit_profile') }}</h1>
        <p style="font-size: 13px; color: #69766f; margin: 0;">{{ __('site.profile_form_copy') }}</p>
    </div>

    @include('biodatas._form')

    <div style="margin-top: 24px; text-align: right;">
        <form method="post" action="{{ route('my-biodata.destroy', $biodata) }}" onsubmit="return confirm(@js(__('site.confirm_delete')))">
            @csrf
            @method('DELETE')
            <button type="submit" style="background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; padding: 8px 18px; border-radius: 20px; font-size: 12px; font-weight: 700; cursor: pointer;">
                🗑️ {{ __('site.delete_profile') }}
            </button>
        </form>
    </div>
@endsection
