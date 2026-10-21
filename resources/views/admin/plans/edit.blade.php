@extends('admin.layout')

@section('title', 'সাবস্ক্রিপশন প্ল্যান এডিট')
@section('page_title', 'বিজনেস - প্ল্যান সংশোধন')

@section('content')
    <div class="card" style="max-width:800px;margin:0 auto">
        <div class="card-header">
            <h3 class="card-title">✏️ সাবস্ক্রিপশন প্যাকেজ সংশোধন করুন: {{ $plan->name }}</h3>
            <a href="{{ route('admin.plans.index') }}" class="btn-action btn-action-primary">← ব্যাক টু লিস্ট</a>
        </div>

        <form action="{{ route('admin.plans.update', $plan) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-row-2">
                <div class="form-group">
                    <label>প্যাকেজের নাম *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $plan->name) }}" required>
                </div>

                <div class="form-group">
                    <label>সাবটাইটেল / সংক্ষিপ্ত বিবরণ</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $plan->subtitle) }}">
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>ব্যাজ টেক্সট (Badge Label)</label>
                    <input type="text" name="badge" class="form-control" value="{{ old('badge', $plan->badge) }}">
                </div>

                <div class="form-group">
                    <label>মূল্য (টাকায়) *</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', $plan->price) }}" required min="0">
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>মেয়াদ বা শর্ত বিবরণ (Period Text)</label>
                    <input type="text" name="period" class="form-control" value="{{ old('period', $plan->period) }}">
                </div>

                <div class="form-group">
                    <label>অভিভাবক কানেকশন লিমিট (সংখ্যা) *</label>
                    <input type="number" name="connection_limit" class="form-control" value="{{ old('connection_limit', $plan->connection_limit) }}" required min="0">
                </div>
            </div>

            @php
                $featuresText = is_array($plan->features) ? implode("\n", $plan->features) : $plan->features;
            @endphp

            <div class="form-group">
                <label>ফিচারসমূহ (প্রতিটি লাইন একটি নতুন ফিচার হিসেবে গন্য হবে) *</label>
                <textarea name="features_raw" class="form-control" rows="5" required>{{ old('features_raw', $featuresText) }}</textarea>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>বাটন টেক্সট</label>
                    <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $plan->button_text) }}" required>
                </div>

                <div class="form-group">
                    <label>বাটন লিংক URL</label>
                    <input type="text" name="button_link" class="form-control" value="{{ old('button_link', $plan->button_link) }}" required>
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label>পজিশন ক্রম (Sort Order)</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $plan->sort_order) }}">
                </div>

                <div class="form-group" style="display:flex;gap:20px;align-items:center;margin-top:25px">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                        <input type="checkbox" name="is_popular" value="1" {{ old('is_popular', $plan->is_popular) ? 'checked' : '' }}>
                        পপুলার হিসেবে হাইলাইট করুন
                    </label>

                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $plan->is_active) ? 'checked' : '' }}>
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
