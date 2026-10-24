@extends('admin.layout')

@section('title', 'সাফল্যের গল্প এডিট')
@section('page_title', 'বিজনেস - গল্প কাস্টমাইজেশন')

@section('content')
    <div class="card" style="max-width:800px;margin:0 auto">
        <div class="card-header">
            <h3 class="card-title">✏️ সাফল্যের গল্প সংশোধন করুন: {{ $story->title }}</h3>
            <a href="{{ route('admin.stories.index') }}" class="btn-action btn-action-primary">← ব্যাক টু লিস্ট</a>
        </div>

        <form action="{{ route('admin.stories.update', $story) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-row-2">
                <div class="form-group">
                    <label>দম্পতির নাম *</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $story->title) }}" required>
                </div>

                <div class="form-group">
                    <label>বিবাহের তারিখ/মাস</label>
                    <input type="text" name="marriage_date" class="form-control" value="{{ old('marriage_date', $story->marriage_date) }}">
                </div>
            </div>

            <div class="form-group">
                <label>দম্পতির অনুভূতি / উক্তি (Quote) *</label>
                <textarea name="quote" class="form-control" rows="4" required>{{ old('quote', $story->quote) }}</textarea>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>ছবি URL (Photo Image Link)</label>
                    <input type="text" name="image_url" class="form-control" value="{{ old('image_url', $story->image_url) }}">
                </div>

                <div class="form-group">
                    <label>সম্পূর্ণ গল্পের লিংক (optional)</label>
                    <input type="text" name="link_url" class="form-control" value="{{ old('link_url', $story->link_url) }}">
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>পজিশন ক্রম (Sort Order)</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $story->sort_order) }}">
                </div>

                <div class="form-group" style="display:flex;align-items:center;margin-top:25px">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $story->is_active) ? 'checked' : '' }}>
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
