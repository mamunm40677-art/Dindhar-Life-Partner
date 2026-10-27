@extends('admin.layout')

@section('title', 'আর্টিকেল এডিট')
@section('page_title', 'বিজনেস - আর্টিকেল সংশোধন')

@section('content')
    <div class="card" style="max-width:800px;margin:0 auto">
        <div class="card-header">
            <h3 class="card-title">✏️ নির্দেশিকা/ব্লগ সংশোধন করুন: {{ $article->title }}</h3>
            <a href="{{ Route::has('admin.articles.index') ? route('admin.articles.index') : url('/admin/articles') }}" class="btn-action btn-action-primary">← ব্যাক টু লিস্ট</a>
        </div>

        <form action="{{ Route::has('admin.articles.update') ? route('admin.articles.update', $article) : url('/admin/articles/'.$article->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-row-2">
                <div class="form-group">
                    <label>আর্টিকেল টাইটেল *</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $article->title) }}" required>
                </div>

                <div class="form-group">
                    <label>ক্যাটাগরি ব্যাজ *</label>
                    <input type="text" name="category" class="form-control" value="{{ old('category', $article->category) }}" required>
                </div>
            </div>

            <div class="form-group">
                <label>সংক্ষিপ্ত সারাংশ (Home Summary) *</label>
                <textarea name="summary" class="form-control" rows="3" required>{{ old('summary', $article->summary) }}</textarea>
            </div>

            <div class="form-group">
                <label>বিস্তারিত বিবরণ / কনটেন্ট (Content Body)</label>
                <textarea name="content" class="form-control" rows="6">{{ old('content', $article->content) }}</textarea>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>ছবি URL (Blog Cover Image Link)</label>
                    <input type="text" name="image_url" class="form-control" value="{{ old('image_url', $article->image_url) }}">
                </div>

                <div class="form-group">
                    <label>পড়ার লিংক (Link URL)</label>
                    <input type="text" name="link_url" class="form-control" value="{{ old('link_url', $article->link_url) }}">
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>পজিশন ক্রম (Sort Order)</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $article->sort_order) }}">
                </div>

                <div class="form-group" style="display:flex;align-items:center;margin-top:25px">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $article->is_active) ? 'checked' : '' }}>
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
