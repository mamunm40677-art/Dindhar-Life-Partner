@extends('admin.layout')

@section('title', 'নতুন ব্যানার যোগ করুন')
@section('page_title', 'বিজনেস - নতুন ব্যানার তৈরি')

@section('content')
    <div class="card" style="max-width:800px;margin:0 auto">
        <div class="card-header">
            <h3 class="card-title">🖼️ নতুন হোমপেজ ব্যানার যোগ করুন</h3>
            <a href="{{ route('admin.banners.index') }}" class="btn-action btn-action-primary">← ব্যাক টু লিস্ট</a>
        </div>

        <form action="{{ route('admin.banners.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>ব্যানার টাইটেল / শিরোনাম *</label>
                <input type="text" name="title" class="form-control" placeholder="যেমন: পবিত্র ও সুন্নতি উপায়ে দ্বীনদার জীবনসঙ্গী নির্বাচন করুন" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label>ব্যাজ টেক্সট (Top Badge Label)</label>
                <input type="text" name="badge_text" class="form-control" placeholder="যেমন: বর্তমান নিবন্ধিত বায়োডাটা: ৩,৪৫৭+ টি" value="{{ old('badge_text') }}">
            </div>

            <div class="form-group">
                <label>সাবটাইটেল / সংক্ষিপ্ত বিবরণ</label>
                <textarea name="subtitle" class="form-control" rows="3" placeholder="পর্দা ও শরীয়াহ শতভাগ বজায় রেখে পাত্র-পাত্রী খোঁজার একমাত্র প্ল্যাটফর্ম...">{{ old('subtitle') }}</textarea>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>ব্যানার ছবি (Image URL)</label>
                    <input type="text" name="image_url" class="form-control" placeholder="https://images.unsplash.com/..." value="{{ old('image_url') }}">
                </div>

                <div class="form-group">
                    <label>ছবি ওভারলে ক্যাপশন</label>
                    <input type="text" name="image_caption" class="form-control" placeholder="পবিত্র সম্পর্কের সূচনায় একমাত্র প্ল্যাটফর্ম" value="{{ old('image_caption') }}">
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>১ম বাটন টেক্সট</label>
                    <input type="text" name="button1_text" class="form-control" placeholder="বিনামূল্যে বায়োডাটা জমা দিন" value="{{ old('button1_text', 'বিনামূল্যে বায়োডাটা জমা দিন') }}">
                </div>

                <div class="form-group">
                    <label>১ম বাটন লিংক URL</label>
                    <input type="text" name="button1_link" class="form-control" placeholder="/register" value="{{ old('button1_link', '/register') }}">
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>২য় বাটন টেক্সট</label>
                    <input type="text" name="button2_text" class="form-control" placeholder="বায়োডাটা ব্রাউজ করুন" value="{{ old('button2_text', 'বায়োডাটা ব্রাউজ করুন') }}">
                </div>

                <div class="form-group">
                    <label>২য় বাটন লিংক URL</label>
                    <input type="text" name="button2_link" class="form-control" placeholder="#search-filter" value="{{ old('button2_link', '#search-filter') }}">
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>পজিশন ক্রম (Sort Order)</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 1) }}">
                </div>

                <div class="form-group" style="display:flex;align-items:center;margin-top:25px">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                        সরাসরি পাবলিশ করুন
                    </label>
                </div>
            </div>

            <div style="margin-top:20px;text-align:right">
                <button type="submit" class="btn-submit" style="padding:12px 28px;font-size:14px">💾 ব্যানার সেভ করুন</button>
            </div>
        </form>
    </div>
@endsection
