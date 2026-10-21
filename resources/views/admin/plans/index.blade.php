@extends('admin.layout')

@section('title', 'সাবস্ক্রিপশন প্ল্যান সমূহ')
@section('page_title', 'বিজনেস - সাবস্ক্রিপশন প্ল্যান ব্যবস্থাপনা')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="card-title">💎 ডায়নামিক সাবস্ক্রিপশন প্ল্যানসমূহ (Packages & Plans)</h3>
                <p style="font-size:12px;color:#64748b;margin-top:4px">এখান থেকে নতুন সাবস্ক্রিপশন প্যাকেজ যোগ, এডিট বা কাস্টমাইজ করুন।</p>
            </div>
            <a href="{{ route('admin.plans.create') }}" class="btn-action btn-action-primary" style="padding:8px 16px;font-size:13px">
                ➕ নতুন প্ল্যান তৈরি করুন
            </a>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ক্রম</th>
                    <th>প্ল্যানের নাম</th>
                    <th>ব্যাজ (Badge)</th>
                    <th>মূল্য (Price)</th>
                    <th>মেয়াদ/কানেকশন</th>
                    <th>ফিচারসমূহ</th>
                    <th>পপুলার</th>
                    <th>স্ট্যাটাস</th>
                    <th>অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($plans as $plan)
                    <tr>
                        <td>#{{ $plan->sort_order }}</td>
                        <td>
                            <strong>{{ $plan->name }}</strong><br>
                            <small style="color:#64748b">{{ $plan->subtitle }}</small>
                        </td>
                        <td>
                            @if($plan->badge)
                                <span class="badge badge-blue">{{ $plan->badge }}</span>
                            @else
                                <span style="color:#94a3b8;font-size:11px">-</span>
                            @endif
                        </td>
                        <td>
                            <strong style="color:#062820;font-size:15px">৳{{ number_format($plan->price) }}</strong>
                            <small style="color:#64748b">{{ $plan->period }}</small>
                        </td>
                        <td>
                            <strong>{{ $plan->connection_limit }} কানেকশন</strong>
                        </td>
                        <td>
                            @if(is_array($plan->features))
                                <ul style="padding-left:15px;margin:0;font-size:12px;color:#475569">
                                    @foreach($plan->features as $feat)
                                        <li>{{ $feat }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span style="font-size:12px;color:#64748b">{{ $plan->features }}</span>
                            @endif
                        </td>
                        <td>
                            @if($plan->is_popular)
                                <span class="badge badge-green">হ্যাঁ (পপুলার)</span>
                            @else
                                <span style="color:#94a3b8;font-size:12px">সাধারণ</span>
                            @endif
                        </td>
                        <td>
                            @if($plan->is_active)
                                <span class="badge badge-green">সক্রিয়</span>
                            @else
                                <span class="badge badge-yellow">ড্রাফট</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <a href="{{ route('admin.plans.edit', $plan) }}" class="btn-action btn-action-primary">এডিট</a>

                                <form action="{{ route('admin.plans.toggle-active', $plan) }}" method="POST">
                                    @csrf
                                    <button class="btn-action {{ $plan->is_active ? 'btn-action-warning' : 'btn-action-success' }}">
                                        {{ $plan->is_active ? 'হাইড করুন' : 'পাবলিশ করুন' }}
                                    </button>
                                </form>

                                <form action="{{ route('admin.plans.destroy', $plan) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই প্যাকেজটি ডিলিট করতে চান?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-action btn-action-danger">ডিলিট</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align:center;color:#64748b">কোনো সাবস্ক্রিপশন প্ল্যান পাওয়া যায়নি। নতুন একটি প্ল্যান যোগ করুন।</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
