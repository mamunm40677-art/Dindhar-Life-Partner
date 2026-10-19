@extends('layouts.app')

@section('title', __('site.login_title').' | '.config('app.name'))

@section('content')
    <section class="container section" style="max-width:600px">
        <div class="section-head"><div><span class="eyebrow">Dindhar Life Partner</span><h2>{{ __('site.login_title') }}</h2></div></div>
        <form class="panel" method="post" action="{{ route('login.store') }}">
            @csrf
            @if ($errors->any())<div class="errors" role="alert"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
            <div class="form-grid">
                <label class="full">{{ __('site.email') }}<input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus></label>
                <label class="full">{{ __('site.password') }}<input type="password" name="password" required autocomplete="current-password"></label>
            </div>
            <label class="check-row"><input type="checkbox" name="remember" value="1">{{ __('site.remember_me') }}</label>
            <div class="actions"><button class="button" type="submit">{{ __('site.login_action') }}</button><span class="about-copy">{{ __('site.no_account') }} <a href="{{ route('register') }}">{{ __('site.register') }}</a></span></div>
        </form>
    </section>
@endsection