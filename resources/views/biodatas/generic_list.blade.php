@extends('layouts.dashboard-layout')

@section('title', $title.' | '.config('app.name'))

@section('dash-content')
<style>
    .list-head-card {
        background: #ffffff;
        border: 1.5px solid #e5e0d3;
        border-radius: 16px;
        padding: 24px 28px;
        box-shadow: 0 4px 15px rgba(6, 40, 32, 0.03);
        margin-bottom: 30px;
    }

    .list-head-card h1 {
        font-family: var(--serif);
        font-size: 24px;
        font-weight: 700;
        color: #062820;
        margin: 0 0 6px;
    }

    .list-head-card p {
        font-size: 13px;
        color: #69766f;
        margin: 0;
    }

    .list-empty-card {
        text-align: center;
        padding: 60px 20px;
        background: #ffffff;
        border: 1.5px dashed #cba135;
        border-radius: 16px;
    }
</style>

<div class="list-head-card">
    <h1>{{ $title }}</h1>
    <p>{{ $subtitle }}</p>
</div>

<div class="list-empty-card">
    <div style="font-size: 48px; margin-bottom: 14px;">📋</div>
    <h2 style="font-family: var(--serif); font-size: 22px; color: #062820; margin: 0 0 10px;">{{ $emptyMessage }}</h2>
    <p style="font-size: 13px; color: #69766f; margin: 0 0 20px;">
        নিয়মিত আপনার বায়োডাটা আপডেট রাখুন এবং অ্যাক্টিভ থাকুন।
    </p>
    <a href="{{ route('biodatas.index') }}" style="display: inline-block; padding: 10px 24px; background: #062820; color: #cba135; border: 1.5px solid #cba135; font-weight: 700; border-radius: 30px; text-decoration: none;">
        🔍 বায়োডাটা ব্রাউজ করুন ↗
    </a>
</div>
@endsection
