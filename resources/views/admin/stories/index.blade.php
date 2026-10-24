@extends('admin.layout')

@section('title', 'সাফল্যের গল্প ব্যবস্থাপনা')
@section('page_title', 'বিজনেস - আমাদের সাফল্যের গল্প (Success Stories)')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="card-title">💕 আমাদের সাফল্যের গল্পসমূহ (Success Stories)</h3>
                <p style="font-size:12px;color:#64748b;margin-top:4px">হোমপেজে প্রদর্শিত নতুন দম্পতিদের সাফল্যের গল্প যোগ, এডিট বা কাস্টমাইজ করুন।</p>
            </div>
            <a href="{{ route('admin.stories.create') }}" class="btn-action btn-action-primary" style="padding:8px 16px;font-size:13px">
                ➕ নতুন গল্প যোগ করুন
            </a>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ক্রম</th>
                    <th>ছবি</th>
                    <th>দম্পতির নাম</th>
                    <th>বিয়ের তারিখ/মাস</th>
                    <th>উক্তি / উক্তি বিবরণ</th>
                    <th>স্ট্যাটাস</th>
                    <th>অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stories as $story)
                    <tr>
                        <td>#{{ $story->sort_order }}</td>
                        <td>
                            @if($story->image_url)
                                <img src="{{ $story->image_url }}" alt="Couple" style="width:60px;height:45px;object-fit:cover;border-radius:6px;border:1px solid #cbd5e1">
                            @else
                                <span style="color:#94a3b8;font-size:11px">ছবি নেই</span>
                            @endif
                        </td>
                        <td>
                            <strong style="color:#062820;font-size:14px">{{ $story->title }}</strong>
                        </td>
                        <td>
                            <span class="badge badge-yellow">{{ $story->marriage_date ?? 'N/A' }}</span>
                        </td>
                        <td>
                            <small style="color:#475569">"{{ Str::limit($story->quote, 90) }}"</small>
                        </td>
                        <td>
                            @if($story->is_active)
                                <span class="badge badge-green">সক্রিয়</span>
                            @else
                                <span class="badge badge-yellow">ড্রাফট</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <a href="{{ route('admin.stories.edit', $story) }}" class="btn-action btn-action-primary">এডিট</a>

                                <form action="{{ route('admin.stories.toggle-active', $story) }}" method="POST">
                                    @csrf
                                    <button class="btn-action {{ $story->is_active ? 'btn-action-warning' : 'btn-action-success' }}">
                                        {{ $story->is_active ? 'হাইড করুন' : 'পাবলিশ করুন' }}
                                    </button>
                                </form>

                                <form action="{{ route('admin.stories.destroy', $story) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই গল্পটি মুছে ফেলতে চান?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-action btn-action-danger">ডিলিট</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;color:#64748b">কোনো সাফল্যের গল্প পাওয়া যায়নি। নতুন একটি গল্প যোগ করুন।</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
