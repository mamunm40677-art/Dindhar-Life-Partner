@extends('admin.layout')

@section('title', 'নতুন নির্দেশিকা বা ব্লগ যোগ করুন')
@section('page_title', 'বিজনেস - নতুন আর্টিকেল তৈরি')

@section('content')
    <div class="card" style="max-width:800px;margin:0 auto">
        <div class="card-header">
            <h3 class="card-title">📰 নতুন নির্দেশিকা/ব্লগ আর্টিকেল যোগ করুন</h3>
            <a href="{{ Route::has('admin.articles.index') ? route('admin.articles.index') : url('/admin/articles') }}" class="btn-action btn-action-primary">← ব্যাক টু লিস্ট</a>
        </div>

        <form action="{{ Route::has('admin.articles.store') ? route('admin.articles.store') : url('/admin/articles') }}" method="POST">
            @csrf

            <div class="form-row-2">
                <div class="form-group">
                    <label>আর্টিকেল টাইটেল *</label>
                    <input type="text" name="title" class="form-control" placeholder="যেমন: পাত্র/পাত্রী নির্বাচনে দ্বীনদারিতাকে কেন প্রাধান্য দেবেন?" value="{{ old('title') }}" required>
                </div>

                <div class="form-group">
                    <label>ক্যাটাগরি ব্যাজ *</label>
                    <input type="text" name="category" class="form-control" placeholder="যেমন: সুন্নতি বিবাহ / অভিভাবকের করণীয়" value="{{ old('category', 'সুন্নতি বিবাহ') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label>সংক্ষিপ্ত সারাংশ (Home Summary) *</label>
                <textarea name="summary" class="form-control" rows="3" placeholder="রাসূলুল্লাহ (সাল্লাল্লাহু আলাইহি ওয়া সাল্লাম) বলেছেন, নারীর চারটি বিষয় দেখে বিবাহ করা হয়..." required>{{ old('summary') }}</textarea>
            </div>

            <div class="form-group">
                <label>বিস্তারিত বিবরণ / কনটেন্ট (Content Body)</label>
                <textarea name="content" class="form-control" rows="6" placeholder="আর্টিকেলের সম্পূর্ণ ইসলামিক আলোচনা ও বিস্তারিত রেফারেন্স লিখুন...">{{ old('content') }}</textarea>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>ছবি URL (Blog Cover Image Link)</label>
                    <input type="text" name="image_url" class="form-control" placeholder="https://images.unsplash.com/..." value="{{ old('image_url') }}">
                </div>

                <div class="form-group">
                    <label>পড়ার লিংক (Link URL)</label>
                    <input type="text" name="link_url" class="form-control" placeholder="{{ route('guide') }}" value="{{ old('link_url', route('guide')) }}">
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
                <button type="submit" class="btn-submit" style="padding:12px 28px;font-size:14px">💾 আর্টিকেল সেভ করুন</button>
            </div>
        </form>
    </div>
@endsection
