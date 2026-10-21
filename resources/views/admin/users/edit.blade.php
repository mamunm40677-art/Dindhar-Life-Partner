@extends('admin.layout')

@section('title', 'ইউজার প্রোফাইল এডিট')
@section('page_title', 'ইউজার তথ্য সম্পাদনা')

@section('content')
    <div class="card" style="max-width:700px;margin:0 auto">
        <div class="card-header">
            <h3 class="card-title">✏️ ইউজার প্রোফাইল সম্পাদনা: {{ $user->name }}</h3>
            <a href="{{ route('admin.users.index') }}" class="btn-action btn-action-primary">← ব্যাক টু ইউজারস</a>
        </div>

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>ইউজারের নাম *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label>ইমেইল অ্যাড্রেস *</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label>নতুন পাসওয়ার্ড (পরিবর্তন করতে চাইলে লিখুন)</label>
                <input type="password" name="password" class="form-control" placeholder="পাসওয়ার্ড অপরিবর্তিত রাখতে ফাঁকা রাখুন">
            </div>

            <div class="form-group" style="margin-top:20px">
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                    <input type="checkbox" name="is_admin" value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
                    <strong>এই ইউজারকে এডমিন রোল (Admin Role) প্রদান করুন</strong>
                </label>
            </div>

            <div style="margin-top:25px;display:flex;justify-content:space-between;align-items:center">
                <button type="submit" class="btn-submit" style="padding:12px 28px;font-size:14px">💾 পরিবর্তন সেভ করুন</button>
            </div>
        </form>
    </div>
@endsection
