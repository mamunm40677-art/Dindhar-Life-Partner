@extends('admin.layout')

@section('title', 'ব্যানার সম্পাদনা')
@section('page_title', 'বিজনেস - ব্যানার কাস্টমাইজেশন')

@section('content')
    <div class="card" style="max-width:800px;margin:0 auto">
        <div class="card-header">
            <h3 class="card-title">✏️ ব্যানার কাস্টমাইজ করুন: {{ $banner->title }}</h3>
            <a href="{{ route('admin.banners.index') }}" class="btn-action btn-action-primary">← ব্যাক টু লিস্ট</a>
        </div>

        <form action="{{ route('admin.banners.update', $banner) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>ব্যানার টাইটেল / শিরোনাম *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $banner->title) }}" required>
            </div>

            <div class="form-group">
                <label>ব্যাজ টেক্সট (Top Badge Label)</label>
                <input type="text" name="badge_text" class="form-control" value="{{ old('badge_text', $banner->badge_text) }}">
            </div>

            <div class="form-group">
                <label>সাবটাইটেল / সংক্ষিপ্ত বিবরণ</label>
                <textarea name="subtitle" class="form-control" rows="3">{{ old('subtitle', $banner->subtitle) }}</textarea>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>ব্যানার ছবি (Image URL)</label>
                    <input type="text" name="image_url" class="form-control" value="{{ old('image_url', $banner->image_url) }}">
                </div>

                <div class="form-group">
                    <label>ছবি ওভারলে ক্যাপশন</label>
                    <input type="text" name="image_caption" class="form-control" value="{{ old('image_caption', $banner->image_caption) }}">
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>১ম বাটন টেক্সট</label>
                    <input type="text" name="button1_text" class="form-control" value="{{ old('button1_text', $banner->button1_text) }}">
                </div>

                <div class="form-group">
                    <label>১ম বাটন লিংক URL</label>
                    <input type="text" name="button1_link" class="form-control" value="{{ old('button1_link', $banner->button1_link) }}">
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>২য় বাটন টেক্সট</label>
                    <input type="text" name="button2_text" class="form-control" value="{{ old('button2_text', $banner->button2_text) }}">
                </div>

                <div class="form-group">
                    <label>২য় বাটন লিংক URL</label>
                    <input type="text" name="button2_link" class="form-control" value="{{ old('button2_link', $banner->button2_link) }}">
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>পজিশন ক্রম (Sort Order)</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $banner->sort_order) }}">
                </div>

                <div class="form-group" style="display:flex;align-items:center;margin-top:25px">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                        সরাসরি পাবলিশড রাখুন
                    </label>
                </div>
            </div>

            <div style="margin-top:20px;text-align:right">
                <button type="submit" class="btn-submit" style="padding:12px 28px;font-size:14px">💾 পরিবর্তন সেভ করুন</button>
            </div>
        </form>
    </div>
@endsection
