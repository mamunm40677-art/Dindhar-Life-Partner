@extends('layouts.app')

@section('title', __('site.edit_profile').' | '.config('app.name'))

@section('content')
    <section class="container page-head"><span class="eyebrow">{{ __('site.dashboard') }}</span><h1>{{ __('site.edit_profile') }}</h1><p>{{ __('site.profile_form_copy') }}</p></section>
    <section class="container section" style="padding-top:0"><div style="max-width:820px">
        @include('biodatas._form')
        <form method="post" action="{{ route('my-biodata.destroy', $biodata) }}" onsubmit="return confirm(@js(__('site.confirm_delete')))">@csrf @method('DELETE')<button class="button secondary" type="submit" style="margin-top:14px;color:#813f37">{{ __('site.delete_profile') }}</button></form>
    </div></section>
@endsection