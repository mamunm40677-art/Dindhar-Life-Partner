@extends('layouts.app')

@section('title', __('site.register_title').' | '.config('app.name'))

@section('content')
    <section class="container section" style="max-width:680px">
        <div class="section-head"><div><span class="eyebrow">Dindhar Life Partner</span><h2>{{ __('site.register_title') }}</h2></div></div>
        <form class="panel" method="post" action="{{ route('register.store') }}">
            @csrf
            @if ($errors->any())<div class="errors" role="alert"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
            <div class="form-grid">
                <label class="full">{{ __('site.name') }}<input name="name" value="{{ old('name') }}" maxlength="120" required autocomplete="name"></label>
                <label class="full">{{ __('site.email') }}<input type="email" name="email" value="{{ old('email') }}" maxlength="255" required autocomplete="email"></label>
                <label>{{ __('site.password') }}<input type="password" name="password" required autocomplete="new-password"></label>
                <label>{{ __('site.password_confirmation') }}<input type="password" name="password_confirmation" required autocomplete="new-password"></label>
            </div>
            <div class="actions"><button class="button" type="submit">{{ __('site.create_account') }}</button><span class="about-copy">{{ __('site.have_account') }} <a href="{{ route('login') }}">{{ __('site.login') }}</a></span></div>
        </form>
    </section>
@endsection