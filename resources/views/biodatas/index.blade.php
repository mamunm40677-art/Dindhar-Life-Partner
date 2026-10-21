@extends('layouts.app')

@section('title', __('site.search_page_title').' | '.config('app.name'))

@section('content')
<div style="background: #f8f7f2; padding: 40px 0 70px; min-height: calc(100vh - 250px);">
    <div class="container">
        <!-- Title & Search Panel -->
        <div style="background: #ffffff; border: 1.5px solid #e5e0d3; border-radius: 16px; padding: 28px; box-shadow: 0 4px 15px rgba(6, 40, 32, 0.03); margin-bottom: 30px;">
            <span style="color: #cba135; font-size: 12px; font-weight: 700; text-transform: uppercase;">{{ __('site.public_profiles_note') }}</span>
            <h1 style="font-family: var(--serif); font-size: 28px; font-weight: 700; color: #062820; margin: 6px 0 20px;">{{ __('site.search_page_title') }}</h1>

            <form method="get" action="{{ route('biodatas.index') }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; align-items: end;">
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #062820; margin-bottom: 6px;">{{ __('site.gender') }}</label>
                    <select name="gender" style="width: 100%; min-height: 44px; padding: 9px 12px; border: 1.5px solid #d1cbba; border-radius: 10px; background: #fcfbf8; font-size: 13px;">
                        <option value="">{{ __('site.all') }}</option>
                        <option value="groom" @selected(($filters['gender'] ?? '') === 'groom')>{{ __('site.groom') }}</option>
                        <option value="bride" @selected(($filters['gender'] ?? '') === 'bride')>{{ __('site.bride') }}</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #062820; margin-bottom: 6px;">{{ __('site.marital_status') }}</label>
                    <select name="marital_status" style="width: 100%; min-height: 44px; padding: 9px 12px; border: 1.5px solid #d1cbba; border-radius: 10px; background: #fcfbf8; font-size: 13px;">
                        <option value="">{{ __('site.all') }}</option>
                        @foreach (['never_married', 'divorced', 'widowed'] as $status)
                            <option value="{{ $status }}" @selected(($filters['marital_status'] ?? '') === $status)>{{ __('site.'.$status) }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #062820; margin-bottom: 6px;">{{ __('site.city') }}</label>
                    <input name="city" value="{{ $filters['city'] ?? '' }}" placeholder="জেলা বা বিভাগ" maxlength="100" style="width: 100%; min-height: 44px; padding: 9px 12px; border: 1.5px solid #d1cbba; border-radius: 10px; background: #fcfbf8; font-size: 13px;">
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #062820; margin-bottom: 6px;">{{ __('site.keyword') }}</label>
                    <input name="q" value="{{ $filters['q'] ?? '' }}" placeholder="{{ __('site.keyword_placeholder') }}" maxlength="100" style="width: 100%; min-height: 44px; padding: 9px 12px; border: 1.5px solid #d1cbba; border-radius: 10px; background: #fcfbf8; font-size: 13px;">
                </div>

                <div>
                    <button type="submit" style="width: 100%; min-height: 44px; background: #062820; color: #cba135; border: 1.5px solid #cba135; border-radius: 30px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s ease;">
                        🔍 {{ __('site.search') }} ↗
                    </button>
                </div>
            </form>
        </div>

        <!-- Results Head -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="font-family: var(--serif); font-size: 22px; font-weight: 700; color: #062820; margin: 0;">
                {{ __('site.search_results') }} <span style="font-size: 14px; color: #69766f;">({{ $biodatas->total() }})</span>
            </h2>
        </div>

        <!-- Results Cards Grid -->
        @if ($biodatas->isNotEmpty())
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 22px;">
                @foreach ($biodatas as $biodata)
                    @include('biodatas._card', ['biodata' => $biodata])
                @endforeach
            </div>

            <div style="margin-top: 30px; text-align: center;">
                {{ $biodatas->links() }}
            </div>
        @else
            <div style="text-align: center; padding: 60px 20px; background: #ffffff; border: 1.5px dashed #cba135; border-radius: 16px;">
                <div style="font-size: 48px; margin-bottom: 12px;">🔍</div>
                <h3 style="font-family: var(--serif); font-size: 20px; color: #062820; margin: 0 0 8px;">{{ __('site.no_profiles') }}</h3>
                <p style="font-size: 13px; color: #69766f; margin: 0;">অন্য কোন জেলা বা ফিল্টার সিলেক্ট করে পুনরায় অনুসন্ধান করুন।</p>
            </div>
        @endif
    </div>
</div>
@endsection
