@extends('admin.layout')

@section('title', 'ব্লগ ও নির্দেশিকা ব্যবস্থাপনা')
@section('page_title', 'বিজনেস - জীবনসঙ্গী নির্বাচন নির্দেশিকা & ব্লগ')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="card-title">📰 ব্লগ ও নির্দেশিকা আর্টিকেলসমূহ (Blog & Guidelines)</h3>
                <p style="font-size:12px;color:#64748b;margin-top:4px">হোমপেজে প্রদর্শিত ইসলামিক দিকনির্দেশনা ও ব্লগ নতুন যোগ, এডিট বা কাস্টমাইজ করুন।</p>
            </div>
            <a href="{{ Route::has('admin.articles.create') ? route('admin.articles.create') : url('/admin/articles/create') }}" class="btn-action btn-action-primary" style="padding:8px 16px;font-size:13px">
                ➕ নতুন আর্টিকেল যোগ করুন
            </a>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ক্রম</th>
                    <th>ছবি</th>
                    <th>ক্যাটাগরি</th>
                    <th>আর্টিকেল টাইটেল</th>
                    <th>সংক্ষিপ্ত বিবরণ (Summary)</th>
                    <th>স্ট্যাটাস</th>
                    <th>অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                    <tr>
                        <td>#{{ $article->sort_order }}</td>
                        <td>
                            @if($article->image_url)
                                <img src="{{ $article->image_url }}" alt="Blog" style="width:60px;height:45px;object-fit:cover;border-radius:6px;border:1px solid #cbd5e1">
                            @else
                                <span style="color:#94a3b8;font-size:11px">ছবি নেই</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-blue">{{ $article->category }}</span>
                        </td>
                        <td>
                            <strong style="color:#062820;font-size:14px">{{ $article->title }}</strong>
                        </td>
                        <td>
                            <small style="color:#475569">{{ Str::limit($article->summary, 80) }}</small>
                        </td>
                        <td>
                            @if($article->is_active)
                                <span class="badge badge-green">সক্রিয়</span>
                            @else
                                <span class="badge badge-yellow">ড্রাফট</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <a href="{{ Route::has('admin.articles.edit') ? route('admin.articles.edit', $article) : url('/admin/articles/'.$article->id.'/edit') }}" class="btn-action btn-action-primary">এডিট</a>

                                <form action="{{ Route::has('admin.articles.toggle-active') ? route('admin.articles.toggle-active', $article) : url('/admin/articles/'.$article->id.'/toggle-active') }}" method="POST">
                                    @csrf
                                    <button class="btn-action {{ $article->is_active ? 'btn-action-warning' : 'btn-action-success' }}">
                                        {{ $article->is_active ? 'হাইড করুন' : 'পাবলিশ করুন' }}
                                    </button>
                                </form>

                                <form action="{{ Route::has('admin.articles.destroy') ? route('admin.articles.destroy', $article) : url('/admin/articles/'.$article->id) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই আর্টিকেলটি মুছে ফেলতে চান?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-action btn-action-danger">ডিলিট</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;color:#64748b">কোনো নির্দেশিকা আর্টিকেল পাওয়া যায়নি। নতুন একটি আর্টিকেল যোগ করুন।</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
