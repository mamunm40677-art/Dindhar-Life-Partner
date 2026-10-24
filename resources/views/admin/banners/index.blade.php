@extends('admin.layout')

@section('title', 'হিরো ব্যানার ব্যবস্থাপনা')
@section('page_title', 'বিজনেস - হোমপেজ হিরো ব্যানার কন্ট্রোল')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="card-title">🖼️ ডায়নামিক হোমপেজ হিরো ব্যানার (Hero Banners)</h3>
                <p style="font-size:12px;color:#64748b;margin-top:4px">হোমপেজের মূল হেডার ব্যানার, টাইটেল, সাবটাইটেল, ছবি ও বাটন পরিবর্তন বা এডিট করুন।</p>
            </div>
            <a href="{{ route('admin.banners.create') }}" class="btn-action btn-action-primary" style="padding:8px 16px;font-size:13px">
                ➕ নতুন ব্যানার যোগ করুন
            </a>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ক্রম</th>
                    <th>ছবি</th>
                    <th>টাইটেল & ব্যাজ</th>
                    <th>সাবটাইটেল</th>
                    <th>বাটন ১ & ২</th>
                    <th>স্ট্যাটাস</th>
                    <th>অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banners as $banner)
                    <tr>
                        <td>#{{ $banner->sort_order }}</td>
                        <td>
                            @if($banner->image_url)
                                <img src="{{ $banner->image_url }}" alt="Banner" style="width:70px;height:45px;object-fit:cover;border-radius:6px;border:1px solid #cbd5e1">
                            @else
                                <span style="color:#94a3b8;font-size:11px">ছবি নেই</span>
                            @endif
                        </td>
                        <td>
                            @if($banner->badge_text)
                                <span class="badge badge-yellow">{{ $banner->badge_text }}</span><br>
                            @endif
                            <strong style="color:#062820;font-size:14px">{{ $banner->title }}</strong>
                        </td>
                        <td>
                            <small style="color:#475569">{{ Str::limit($banner->subtitle, 80) }}</small>
                        </td>
                        <td>
                            @if($banner->button1_text)
                                <span class="badge badge-green">{{ $banner->button1_text }}</span><br>
                            @endif
                            @if($banner->button2_text)
                                <span class="badge badge-blue">{{ $banner->button2_text }}</span>
                            @endif
                        </td>
                        <td>
                            @if($banner->is_active)
                                <span class="badge badge-green">সক্রিয়</span>
                            @else
                                <span class="badge badge-yellow">ড্রাফট</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <a href="{{ route('admin.banners.edit', $banner) }}" class="btn-action btn-action-primary">এডিট</a>

                                <form action="{{ route('admin.banners.toggle-active', $banner) }}" method="POST">
                                    @csrf
                                    <button class="btn-action {{ $banner->is_active ? 'btn-action-warning' : 'btn-action-success' }}">
                                        {{ $banner->is_active ? 'হাইড করুন' : 'পাবলিশ করুন' }}
                                    </button>
                                </form>

                                <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই ব্যানারটি ডিলিট করতে চান?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-action btn-action-danger">ডিলিট</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;color:#64748b">কোনো ব্যানার পাওয়া যায়নি। নতুন একটি ব্যানার যোগ করুন।</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
