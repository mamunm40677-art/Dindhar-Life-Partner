@extends('layouts.app')

@section('title', 'গুরুত্বপূর্ণ সেটিংস | '.config('app.name'))

@section('content')
<style>
    :root {
        --dash-green: #062820;
        --dash-green-light: #0d493a;
        --dash-gold: #cba135;
        --dash-gold-hover: #b88e28;
        --dash-bg: #f8f7f2;
        --dash-card: #ffffff;
        --dash-border: #e5e0d3;
        --dash-text: #15382f;
        --dash-muted: #69766f;
    }

    .settings-container {
        padding: 40px 0 70px;
        background: var(--dash-bg);
        min-height: calc(100vh - 250px);
    }

    .settings-head {
        text-align: center;
        margin-bottom: 35px;
    }

    .settings-head h1 {
        font-family: var(--serif);
        font-size: 32px;
        font-weight: 700;
        color: var(--dash-green);
        margin: 0;
    }

    .settings-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 28px;
        align-items: start;
    }

    .settings-card {
        background: var(--dash-card);
        border: 1.5px solid var(--dash-border);
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 4px 20px rgba(6, 40, 32, 0.03);
        margin-bottom: 24px;
    }

    .settings-card-title {
        font-family: var(--serif);
        font-size: 20px;
        font-weight: 700;
        color: var(--dash-green);
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1.5px solid var(--dash-border);
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: var(--dash-green);
        margin-bottom: 8px;
    }

    .form-group input, .form-group select {
        width: 100%;
        min-height: 48px;
        padding: 10px 16px;
        border: 1.5px solid #d1cbba;
        border-radius: 10px;
        background: #fcfbf8;
        font-size: 14px;
        color: var(--dash-text);
        outline: none;
        transition: border-color 0.2s;
    }

    .form-group input:focus, .form-group select:focus {
        border-color: var(--dash-green);
    }

    .btn-green-full {
        width: 100%;
        min-height: 48px;
        background: var(--dash-green);
        color: var(--dash-gold);
        border: 1.5px solid var(--dash-gold);
        border-radius: 30px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-green-full:hover {
        background: var(--dash-green-light);
        color: #ffffff;
    }

    .btn-danger-full {
        width: 100%;
        min-height: 48px;
        background: #dc2626;
        color: #ffffff;
        border: none;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-danger-full:hover {
        background: #b91c1c;
    }

    .radio-option {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        border: 1px solid var(--dash-border);
        border-radius: 8px;
        background: #fcfbf8;
        margin-bottom: 10px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 600;
        color: var(--dash-text);
    }

    .radio-option input[type="radio"] {
        width: 18px;
        height: 18px;
        accent-color: var(--dash-green);
        min-height: auto;
    }

    @media (max-width: 850px) {
        .settings-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="settings-container">
    <div class="container">
        <!-- Title -->
        <div class="settings-head">
            <h1>গুরুত্বপূর্ণ সেটিংস</h1>
        </div>

        @if (session('status'))
            <div style="max-width: 800px; margin: 0 auto 24px; background: #dcfce7; border: 1px solid #bbf7d0; color: #166534; padding: 14px 20px; border-radius: 10px; font-weight: 700; font-size: 14px;">
                ✅ {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="max-width: 800px; margin: 0 auto 24px; background: #fee2e2; border: 1px solid #fecaca; color: #991b1b; padding: 14px 20px; border-radius: 10px; font-weight: 700; font-size: 14px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="settings-grid">
            <!-- Left Column: Profile Update -->
            <div class="settings-card">
                <div class="settings-card-title">📝 প্রোফাইল আপডেট করুন</div>

                <form action="{{ route('settings.profile') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>পাত্র/পাত্রীর নাম</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required placeholder="আপনার পূর্ণ নাম লিখুন">
                    </div>

                    <div class="form-group">
                        <label>পাত্র/পাত্রীর ইমেইল (এই ইমেইলে যোগাযোগ করা হবে)</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="user@gmail.com">
                    </div>

                    <div class="form-group">
                        <label>পাত্র/পাত্রীর জেন্ডার (Gender)</label>
                        <select name="gender" disabled>
                            <option value="groom" @selected($biodata?->gender === 'groom' || $biodata?->gender === 'male')>Male (পুরুষ)</option>
                            <option value="bride" @selected($biodata?->gender === 'bride' || $biodata?->gender === 'female')>Female (নারী)</option>
                        </select>
                        <small style="color: var(--dash-muted); font-size: 11px; display: block; margin-top: 4px;">* জেন্ডার বায়োডাটা এডিট সেকশন থেকে পরিবর্তন করা যাবে।</small>
                    </div>

                    <button type="submit" class="btn-green-full">
                        তথ্য আপডেট করি
                    </button>
                </form>
            </div>

            <!-- Right Column: Password Change, Delete Biodata & Logout -->
            <div>
                <!-- Password Change Card -->
                <div class="settings-card">
                    <div class="settings-card-title">🔒 পাসওয়ার্ড পরিবর্তন করুন</div>

                    <form action="{{ route('settings.password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>নতুন পাসওয়ার্ড লিখুন</label>
                            <input type="password" name="password" required placeholder="নতুন পাসওয়ার্ড...">
                        </div>

                        <div class="form-group">
                            <label>আবার নতুন পাসওয়ার্ড লিখুন</label>
                            <input type="password" name="password_confirmation" required placeholder="আবার নতুন পাসওয়ার্ড...">
                        </div>

                        <button type="submit" class="btn-green-full">
                            পাসওয়ার্ড পরিবর্তন করি
                        </button>
                    </form>
                </div>

                <!-- Delete Biodata Card -->
                <div class="settings-card">
                    <div class="settings-card-title" style="color: #dc2626;">⚠️ বায়োডাটা ডিলেট করতে চান?</div>
                    <p style="font-size: 13px; color: var(--dash-muted); margin-bottom: 16px; line-height: 1.6;">
                        আপনি যদি বায়োডাটা ডিলেট করে ফেলেন তাহলে আপনার বায়োডাটায় প্রদত্ত তথ্যগুলো বন্ধ হয়ে যাবে।
                    </p>

                    <form action="{{ route('settings.biodata.delete') }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে আপনার বায়োডাটা মুছে ফেলতে চান?')">
                        @csrf

                        <label style="display: block; font-size: 13px; font-weight: 700; color: var(--dash-green); margin-bottom: 10px;">কেন ডিলেট করছেন?</label>

                        <label class="radio-option">
                            <input type="radio" name="delete_reason" value="married_via_site" checked>
                            দ্বীনদার পার্টনার ডট কমের মাধ্যমে বিবাহ সম্পন্ন হয়েছে
                        </label>

                        <label class="radio-option">
                            <input type="radio" name="delete_reason" value="married_other">
                            অন্য কোন মাধ্যমে বিবাহ সম্পন্ন হয়েছে
                        </label>

                        <label class="radio-option">
                            <input type="radio" name="delete_reason" value="personal">
                            ব্যক্তিগত কারণ
                        </label>

                        <label class="radio-option">
                            <input type="radio" name="delete_reason" value="bad_experience">
                            ভালো অভিজ্ঞতা পাইনি
                        </label>

                        <label class="radio-option">
                            <input type="radio" name="delete_reason" value="other">
                            অন্যান্য
                        </label>

                        <button type="submit" class="btn-danger-full" style="margin-top: 10px;">
                            হ্যাঁ, বায়োডাটা ডিলেট করতে চাই
                        </button>
                    </form>
                </div>

                <!-- Logout Card -->
                <div class="settings-card">
                    <div class="settings-card-title">🚪 লগআউট</div>
                    <p style="font-size: 13px; color: var(--dash-muted); margin-bottom: 16px;">
                        আপনার অ্যাকাউন্ট থেকে লগআউট করতে নিচের বাটনে ক্লিক করুন।
                    </p>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-danger-full" style="background: #ef4444;">
                            লগআউট করি
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
