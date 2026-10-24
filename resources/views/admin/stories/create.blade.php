@extends('admin.layout')

@section('title', 'নতুন সাফল্যের গল্প যোগ করুন')
@section('page_title', 'বিজনেস - নতুন গল্প তৈরি')

@section('content')
    <div class="card" style="max-width:800px;margin:0 auto">
        <div class="card-header">
            <h3 class="card-title">💕 নতুন সাফল্যের গল্প যোগ করুন</h3>
            <a href="{{ route('admin.stories.index') }}" class="btn-action btn-action-primary">← ব্যাক টু লিস্ট</a>
        </div>

        <form action="{{ route('admin.stories.store') }}" method="POST">
            @csrf

            <div class="form-row-2">
                <div class="form-group">
                    <label>দম্পতির নাম *</label>
                    <input type="text" name="title" class="form-control" placeholder="যেমন: আব্দুল্লাহ & ফাতেমা" value="{{ old('title') }}" required>
                </div>

                <div class="form-group">
                    <label>বিবাহের তারিখ/মাস</label>
                    <input type="text" name="marriage_date" class="form-control" placeholder="যেমন: বিবাহ: ফেব্রুয়ারি ২০২৪" value="{{ old('marriage_date') }}">
                </div>
            </div>

            <div class="form-group">
                <label>দম্পতির অনুভূতি / উক্তি (Quote) *</label>
                <textarea name="quote" class="form-control" rows="4" placeholder="আলহামদুলিল্লাহ, দ্বীনদার লাইফ পার্টনারের মাধ্যমে খুব দ্রুত ও সুন্নতি নিয়মে আমাদের বিবাহ সম্পন্ন হয়েছে..." required>{{ old('quote') }}</textarea>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>ছবি URL (Photo Image Link)</label>
                    <input type="text" name="image_url" class="form-control" placeholder="https://images.unsplash.com/..." value="{{ old('image_url') }}">
                </div>

                <div class="form-group">
                    <label>সম্পূর্ণ গল্পের লিংক (optional)</label>
                    <input type="text" name="link_url" class="form-control" placeholder="#" value="{{ old('link_url', '#') }}">
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
                <button type="submit" class="btn-submit" style="padding:12px 28px;font-size:14px">💾 গল্প সেভ করুন</button>
            </div>
        </form>
    </div>
@endsection
