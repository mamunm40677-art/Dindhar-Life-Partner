@extends('layouts.app')

@section('title', __('site.register_title').' | '.config('app.name'))

@section('content')
<div style="padding: 60px 15px; background: #f8f7f2; min-height: calc(100vh - 200px); display: grid; place-items: center;">
    <div style="width: 100%; max-width: 520px; background: #ffffff; border: 1px solid #e5e0d3; border-radius: 16px; padding: 40px 32px; box-shadow: 0 10px 30px rgba(6, 40, 32, 0.06);">
        <!-- Title & Subtitle -->
        <div style="text-align: center; margin-bottom: 30px;">
            <div style="width: 50px; height: 50px; border-radius: 50%; background: #062820; border: 2px solid #cba135; display: grid; place-items: center; color: #cba135; font-size: 24px; margin: 0 auto 12px;">د</div>
            <h2 style="font-family: var(--serif); font-size: 28px; font-weight: 700; color: #062820; margin: 0 0 8px;">রেজিস্ট্রেশন</h2>
            <p style="font-size: 13px; color: #69766f; margin: 0;">নতুন অ্যাকাউন্ট তৈরি করুন এবং জীবনসঙ্গী খোঁজার যাত্রা শুরু করুন</p>
        </div>

        @if ($errors->any())
            <div style="background: #fee2e2; border: 1px solid #fecaca; color: #991b1b; padding: 12px 16px; border-radius: 8px; font-size: 13px; margin-bottom: 24px;">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('register.store') }}" style="display: flex; flex-direction: column; gap: 20px;">
            @csrf

            <!-- Full Name -->
            <div>
                <label style="display: block; font-size: 13px; font-weight: 700; color: #062820; margin-bottom: 8px;">
                    👤 পূর্ণ নাম
                </label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="আপনার পূর্ণ নাম লিখুন" maxlength="120" required autocomplete="name" style="width: 100%; min-height: 48px; padding: 10px 16px; border: 1.5px solid #d1cbba; border-radius: 10px; background: #fcfbf8; font-size: 14px; color: #15382f; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#062820'" onblur="this.style.borderColor='#d1cbba'">
            </div>

            <!-- Email -->
            <div>
                <label style="display: block; font-size: 13px; font-weight: 700; color: #062820; margin-bottom: 8px;">
                    ✉️ ইমেইল এড্রেস
                </label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="example@gmail.com" maxlength="255" required autocomplete="email" style="width: 100%; min-height: 48px; padding: 10px 16px; border: 1.5px solid #d1cbba; border-radius: 10px; background: #fcfbf8; font-size: 14px; color: #15382f; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#062820'" onblur="this.style.borderColor='#d1cbba'">
            </div>

            <!-- Password -->
            <div>
                <label style="display: block; font-size: 13px; font-weight: 700; color: #062820; margin-bottom: 8px;">
                    🔒 পাসওয়ার্ড (কমপক্ষে ৮ অক্ষর)
                </label>
                <input type="password" name="password" placeholder="নিরাপদ পাসওয়ার্ড তৈরি করুন" required autocomplete="new-password" style="width: 100%; min-height: 48px; padding: 10px 16px; border: 1.5px solid #d1cbba; border-radius: 10px; background: #fcfbf8; font-size: 14px; color: #15382f; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#062820'" onblur="this.style.borderColor='#d1cbba'">
            </div>

            <!-- Confirm Password -->
            <div>
                <label style="display: block; font-size: 13px; font-weight: 700; color: #062820; margin-bottom: 8px;">
                    🔒 পাসওয়ার্ড নিশ্চিত করুন
                </label>
                <input type="password" name="password_confirmation" placeholder="পাসওয়ার্ড পুনরায় লিখুন" required autocomplete="new-password" style="width: 100%; min-height: 48px; padding: 10px 16px; border: 1.5px solid #d1cbba; border-radius: 10px; background: #fcfbf8; font-size: 14px; color: #15382f; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#062820'" onblur="this.style.borderColor='#d1cbba'">
            </div>

            <!-- Submit Button (Home page matching Islamic Green & Gold) -->
            <button type="submit" style="width: 100%; min-height: 50px; background: #062820; color: #cba135; border: 1.5px solid #cba135; border-radius: 30px; font-size: 15px; font-weight: 700; cursor: pointer; transition: all 0.2s ease; margin-top: 10px;" onmouseover="this.style.background='#0d493a'; this.style.color='#ffffff';" onmouseout="this.style.background='#062820'; this.style.color='#cba135';">
                ✨ অ্যাকাউন্ট তৈরি করুন
            </button>
        </form>

        <!-- Login Redirect Link -->
        <div style="text-align: center; margin-top: 25px; padding-top: 20px; border-top: 1px solid #e5e0d3; font-size: 13px; color: #69766f;">
            ইতিমধ্যে অ্যাকাউন্ট আছে? <a href="{{ route('login') }}" style="color: #062820; font-weight: 700; text-decoration: underline;">এখনই লগইন করুন</a>
        </div>
    </div>
</div>
@endsection
