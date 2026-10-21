@extends('admin.layout')

@section('title', 'নতুন সাবস্ক্রিপশন প্ল্যান তৈরি')
@section('page_title', 'বিজনেস - নতুন প্ল্যান যোগ করুন')

@section('content')
    <div class="card" style="max-width:800px;margin:0 auto">
        <div class="card-header">
            <h3 class="card-title">💎 নতুন সাবস্ক্রিপশন প্যাকেজ যোগ করুন</h3>
            <a href="{{ route('admin.plans.index') }}" class="btn-action btn-action-primary">← ব্যাক টু লিস্ট</a>
        </div>

        <form action="{{ route('admin.plans.store') }}" method="POST">
            @csrf

            <div class="form-row-2">
                <div class="form-group">
                    <label>প্যাকেজের নাম *</label>
                    <input type="text" name="name" class="form-control" placeholder="যেমন: স্ট্যান্ডার্ড প্যাকেজ" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label>সাবটাইটেল / সংক্ষিপ্ত বিবরণ</label>
                    <input type="text" name="subtitle" class="form-control" placeholder="যেমন: অভিভাবকের নম্বর নেওয়ার জন্য" value="{{ old('subtitle') }}">
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>ব্যাজ টেক্সট (Badge Label)</label>
                    <input type="text" name="badge" class="form-control" placeholder="যেমন: সবচেয়ে জনপ্রিয় / ফ্রি ট্রায়াল / ভিআইপি" value="{{ old('badge') }}">
                </div>

                <div class="form-group">
                    <label>মূল্য (টাকায়) *</label>
                    <input type="number" name="price" class="form-control" placeholder="যেমন: 1200 (ফ্রি হলে 0)" value="{{ old('price', 0) }}" required min="0">
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>মেয়াদ বা শর্ত বিবরণ (Period Text)</label>
                    <input type="text" name="period" class="form-control" placeholder="যেমন: / ৩টি অভিভাবকের নম্বর" value="{{ old('period', '/ কানেকশন') }}">
                </div>

                <div class="form-group">
                    <label>অভিভাবক কানেকশন লিমিট (সংখ্যা) *</label>
                    <input type="number" name="connection_limit" class="form-control" placeholder="যেমন: 3" value="{{ old('connection_limit', 3) }}" required min="0">
                </div>
            </div>

            <div class="form-group">
                <label>ফিচারসমূহ (প্রতিটি লাইন একটি নতুন ফিচার হিসেবে গন্য হবে) *</label>
                <textarea name="features_raw" class="form-control" rows="5" placeholder="✓ ৩টি বায়োডাটার অভিভাবকের সরাসরি ফোন নম্বর&#10;✓ ৫০০ দিন মেয়াদ&#10;✓ সাপোর্ট সাপোর্ট সুবিধা" required>{{ old('features_raw') }}</textarea>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>বাটন টেক্সট</label>
                    <input type="text" name="button_text" class="form-control" value="{{ old('button_text', 'প্যাকেজ সাবস্ক্রাইব করুন') }}" required>
                </div>

                <div class="form-group">
                    <label>বাটন লিংক URL</label>
                    <input type="text" name="button_link" class="form-control" value="{{ old('button_link', '/contact') }}" required>
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>পজিশন ক্রম (Sort Order)</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 1) }}">
                </div>

                <div class="form-group" style="display:flex;gap:20px;align-items:center;margin-top:25px">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                        <input type="checkbox" name="is_popular" value="1" {{ old('is_popular') ? 'checked' : '' }}>
                        পপুলার হিসেবে হাইলাইট করুন
                    </label>

                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                        সরাসরি পাবলিশ করুন
                    </label>
                </div>
            </div>

            <div style="margin-top:20px;text-align:right">
                <button type="submit" class="btn-submit" style="padding:12px 28px;font-size:14px">💾 সেভ করুন</button>
            </div>
        </form>
    </div>
@endsection
