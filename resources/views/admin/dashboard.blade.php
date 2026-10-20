@extends('admin.layout')

@section('title', 'ড্যাশবোর্ড')
@section('page_title', 'এডমিন ওভারভিউ')

@section('content')
    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="label">মোট রেজিস্টার্ড ইউজার</div>
            <div class="value">{{ number_format($totalUsers) }}</div>
        </div>
        <div class="stat-card">
            <div class="label">মোট বায়োডাটা</div>
            <div class="value">{{ number_format($totalBiodatas) }}</div>
        </div>
        <div class="stat-card">
            <div class="label">পাবলিশড বায়োডাটা</div>
            <div class="value" style="color:#16a34a">{{ number_format($publishedBiodatas) }}</div>
        </div>
        <div class="stat-card">
            <div class="label">পেন্ডিং বায়োডাটা</div>
            <div class="value" style="color:#d97706">{{ number_format($pendingBiodatas) }}</div>
        </div>
        <div class="stat-card">
            <div class="label">কন্টাক্ট মেসেজ</div>
            <div class="value" style="color:#2563eb">{{ number_format($totalMessages) }}</div>
        </div>
    </div>

    <!-- Recent Biodatas -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">📜 সাম্প্রতিক বায়োডাটা সমূহ</div>
            <a href="{{ route('admin.biodatas.index') }}" class="btn-action btn-action-primary">সব দেখুন</a>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>নাম</th>
                    <th>লিঙ্গ</th>
                    <th>বয়স</th>
                    <th>শহর</th>
                    <th>স্ট্যাটাস</th>
                    <th>তারিখ</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestBiodatas as $b)
                    <tr>
                        <td>#{{ $b->id }}</td>
                        <td><strong>{{ $b->display_name }}</strong></td>
                        <td>{{ $b->gender === 'male' ? 'পাত্র' : 'পাত্রী' }}</td>
                        <td>{{ $b->age }} বছর</td>
                        <td>{{ $b->city }}</td>
                        <td>
                            @if($b->published)
                                <span class="badge badge-green">পাবলিশড</span>
                            @else
                                <span class="badge badge-yellow">পেন্ডিং</span>
                            @endif
                        </td>
                        <td>{{ $b->created_at->format('d M, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;color:#64748b">কোনো বায়োডাটা পাওয়া যায়নি।</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Recent Users & Messages -->
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
        <!-- Recent Users -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">👥 সাম্প্রতিক ইউজারগণ</div>
                <a href="{{ route('admin.users.index') }}" class="btn-action btn-action-primary">সব ইউজার</a>
            </div>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>নাম</th>
                        <th>ইমেইল</th>
                        <th>রোল</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($latestUsers as $u)
                        <tr>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>
                                @if($u->isAdmin())
                                    <span class="badge badge-blue">এডমিন</span>
                                @else
                                    <span class="badge badge-yellow">ইউজার</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Recent Messages -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">📩 সাম্প্রতিক মেসেজ</div>
                <a href="{{ route('admin.messages.index') }}" class="btn-action btn-action-primary">সব মেসেজ</a>
            </div>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>প্রেরক</th>
                        <th>বিষয়</th>
                        <th>তারিখ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestMessages as $m)
                        <tr>
                            <td>{{ $m->name }}</td>
                            <td>{{ Str::limit($m->subject, 25) }}</td>
                            <td>{{ $m->created_at->format('d M') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align:center;color:#64748b">কোনো মেসেজ নেই।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
