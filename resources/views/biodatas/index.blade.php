@extends('layouts.app')

@section('title', __('site.search_page_title').' | '.config('app.name'))

@section('content')
<div style="background: #f8f7f2; padding: 40px 0 70px; min-height: calc(100vh - 250px);">
    <div class="container">
        <!-- Title & Dual Main Options Search Panel -->
        <div style="background: #ffffff; border: 1.5px solid #e5e0d3; border-radius: 16px; padding: 28px; box-shadow: 0 4px 15px rgba(6, 40, 32, 0.03); margin-bottom: 30px;">
            <span style="color: #cba135; font-size: 12px; font-weight: 700; text-transform: uppercase;">{{ __('site.public_profiles_note') }}</span>
            <h1 style="font-family: var(--serif); font-size: 28px; font-weight: 700; color: #062820; margin: 6px 0 20px;">{{ __('site.search_page_title') }}</h1>

            <!-- Primary Two Options Buttons Header -->
            <div style="display: flex; gap: 12px; margin-bottom: 16px;">
                <button type="button" onclick="switchIndexMainOption('deendar_practice')" id="idx-opt-btn-practice" style="flex: 1; padding: 12px 20px; border-radius: 12px; border: 2px solid #cba135; background: #062820; color: #cba135; font-size: 15px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <span>🕌 ১. দ্বীনদার প্র্যাকটিস</span>
                </button>

                <button type="button" onclick="switchIndexMainOption('deendar_manush')" id="idx-opt-btn-manush" style="flex: 1; padding: 12px 20px; border-radius: 12px; border: 2px solid #e5e0d3; background: #ffffff; color: #062820; font-size: 15px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <span>👤 ২. দ্বীনদার মানুষ</span>
                </button>
            </div>

            <!-- Option 1 Form: Deendar Practice (দ্বীনদার প্র্যাকটিস) -->
            <form id="idx-form-deendar-practice" method="get" action="{{ route('biodatas.index') }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; align-items: end; border: 1.5px solid #cba135; padding: 20px; border-radius: 12px; background: #fcfbf8;">
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #062820; margin-bottom: 6px;">পাত্র / পাত্রী</label>
                    <select name="gender" style="width: 100%; min-height: 44px; padding: 9px 12px; border: 1.5px solid #d1cbba; border-radius: 10px; background: #ffffff; font-size: 13px;">
                        <option value="">সকল (দ্বীনদার পাত্র ও পাত্রী)</option>
                        <option value="groom" @selected(($filters['gender'] ?? '') === 'groom')>♂ দ্বীনদার পাত্র</option>
                        <option value="bride" @selected(($filters['gender'] ?? '') === 'bride')>♀ দ্বীনদার পাত্রী</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #062820; margin-bottom: 6px;">দ্বীনদারী প্র্যাকটিস</label>
                    <select name="deendar_keyword" style="width: 100%; min-height: 44px; padding: 9px 12px; border: 1.5px solid #d1cbba; border-radius: 10px; background: #ffffff; font-size: 13px;">
                        <option value="">সকল ইসলামি আমল ও প্র্যাকটিস</option>
                        <option value="সালাত" @selected(($filters['deendar_keyword'] ?? '') === 'সালাত')>🕌 ৫ ওয়াক্ত সালাত</option>
                        <option value="পর্দা" @selected(($filters['deendar_keyword'] ?? '') === 'পর্দা')>🧕 শরীয়াহ সম্মত পর্দা/হিজাব</option>
                        <option value="কোরআন" @selected(($filters['deendar_keyword'] ?? '') === 'কোরআন')>📖 কোরআন তিলাওয়াত</option>
                        <option value="হাফেজ" @selected(($filters['deendar_keyword'] ?? '') === 'হাফেজ')>হাফেজে কোরআন</option>
                        <option value="আলেম" @selected(($filters['deendar_keyword'] ?? '') === 'আলেম')>আলেম / আলেমা</option>
                        <option value="সুন্নত" @selected(($filters['deendar_keyword'] ?? '') === 'সুন্নত')>সুন্নতি জীবনধারা</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #062820; margin-bottom: 6px;">দ্বীনি ব্যাকগ্রাউন্ড / শিক্ষা</label>
                    <select name="education" style="width: 100%; min-height: 44px; padding: 9px 12px; border: 1.5px solid #d1cbba; border-radius: 10px; background: #ffffff; font-size: 13px;">
                        <option value="">সকল শিক্ষা</option>
                        <option value="আলেম" @selected(($filters['education'] ?? '') === 'আলেম')>আলেম / দাওরায়ে হাদিস / কামিল</option>
                        <option value="হাফেজ" @selected(($filters['education'] ?? '') === 'হাফেজ')>হাফেজে কোরআন</option>
                        <option value="গ্র্যাজুয়েশন" @selected(($filters['education'] ?? '') === 'গ্র্যাজুয়েশন')>গ্র্যাজুয়েশন (সাধারণ শিক্ষা)</option>
                    </select>
                </div>

                <div>
                    <button type="submit" style="width: 100%; min-height: 44px; background: #062820; color: #cba135; border: 1.5px solid #cba135; border-radius: 30px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s ease;">
                        🕌 ফিল্টার করুন ↗
                    </button>
                </div>
            </form>

            <!-- Option 2 Form: Deendar Manush (দ্বীনদার মানুষ) -->
            <form id="idx-form-deendar-manush" method="get" action="{{ route('biodatas.index') }}" style="display: none; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; align-items: end; border: 1.5px solid #e5e0d3; padding: 20px; border-radius: 12px; background: #fcfbf8;">
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #062820; margin-bottom: 6px;">{{ __('site.gender') }}</label>
                    <select name="gender" style="width: 100%; min-height: 44px; padding: 9px 12px; border: 1.5px solid #d1cbba; border-radius: 10px; background: #ffffff; font-size: 13px;">
                        <option value="">{{ __('site.all') }}</option>
                        <option value="groom" @selected(($filters['gender'] ?? '') === 'groom')>{{ __('site.groom') }}</option>
                        <option value="bride" @selected(($filters['gender'] ?? '') === 'bride')>{{ __('site.bride') }}</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #062820; margin-bottom: 6px;">{{ __('site.marital_status') }}</label>
                    <select name="marital_status" style="width: 100%; min-height: 44px; padding: 9px 12px; border: 1.5px solid #d1cbba; border-radius: 10px; background: #ffffff; font-size: 13px;">
                        <option value="">{{ __('site.all') }}</option>
                        @foreach (['never_married', 'divorced', 'widowed'] as $status)
                            <option value="{{ $status }}" @selected(($filters['marital_status'] ?? '') === $status)>{{ __('site.'.$status) }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #062820; margin-bottom: 6px;">{{ __('site.city') }}</label>
                    <input name="city" value="{{ $filters['city'] ?? '' }}" placeholder="জেলা বা বিভাগ" maxlength="100" style="width: 100%; min-height: 44px; padding: 9px 12px; border: 1.5px solid #d1cbba; border-radius: 10px; background: #ffffff; font-size: 13px;">
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #062820; margin-bottom: 6px;">{{ __('site.keyword') }}</label>
                    <input name="q" value="{{ $filters['q'] ?? '' }}" placeholder="{{ __('site.keyword_placeholder') }}" maxlength="100" style="width: 100%; min-height: 44px; padding: 9px 12px; border: 1.5px solid #d1cbba; border-radius: 10px; background: #ffffff; font-size: 13px;">
                </div>

                <div>
                    <button type="submit" style="width: 100%; min-height: 44px; background: #062820; color: #cba135; border: 1.5px solid #cba135; border-radius: 30px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s ease;">
                        👤 ফিল্টার করুন ↗
                    </button>
                </div>
            </form>
        </div>

        <script>
            function switchIndexMainOption(optionType) {
                var practice = document.getElementById('idx-form-deendar-practice');
                var manush = document.getElementById('idx-form-deendar-manush');
                var btnPractice = document.getElementById('idx-opt-btn-practice');
                var btnManush = document.getElementById('idx-opt-btn-manush');

                if (optionType === 'deendar_manush') {
                    practice.style.display = 'none';
                    manush.style.display = 'grid';

                    btnPractice.style.background = '#ffffff';
                    btnPractice.style.color = '#062820';
                    btnPractice.style.borderColor = '#e5e0d3';

                    btnManush.style.background = '#062820';
                    btnManush.style.color = '#cba135';
                    btnManush.style.borderColor = '#cba135';
                } else {
                    practice.style.display = 'grid';
                    manush.style.display = 'none';

                    btnPractice.style.background = '#062820';
                    btnPractice.style.color = '#cba135';
                    btnPractice.style.borderColor = '#cba135';

                    btnManush.style.background = '#ffffff';
                    btnManush.style.color = '#062820';
                    btnManush.style.borderColor = '#e5e0d3';
                }
            }
        </script>

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
