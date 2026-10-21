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

        <!-- Divider -->
        <div style="display: flex; align-items: center; margin: 24px 0;">
            <div style="flex: 1; height: 1px; background: #e5e0d3;"></div>
            <span style="padding: 0 14px; font-size: 12px; color: #69766f; font-weight: 600;">অথবা</span>
            <div style="flex: 1; height: 1px; background: #e5e0d3;"></div>
        </div>

        <!-- Google Login Button -->
        <a href="{{ route('google.login') }}" style="display: flex; align-items: center; justify-content: center; gap: 10px; width: 100%; min-height: 48px; background: #ffffff; border: 1.5px solid #d1cbba; border-radius: 30px; font-size: 14px; font-weight: 700; color: #15382f; text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.borderColor='#062820'; this.style.background='#fcfbf8';" onmouseout="this.style.borderColor='#d1cbba'; this.style.background='#ffffff';">
            <svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>
            Google দিয়ে সাইন আপ করুন
        </a>

        <!-- Login Redirect Link -->
        <div style="text-align: center; margin-top: 25px; padding-top: 20px; border-top: 1px solid #e5e0d3; font-size: 13px; color: #69766f;">
            ইতিমধ্যে অ্যাকাউন্ট আছে? <a href="{{ route('login') }}" style="color: #062820; font-weight: 700; text-decoration: underline;">এখনই লগইন করুন</a>
        </div>
    </div>
</div>
@endsection
