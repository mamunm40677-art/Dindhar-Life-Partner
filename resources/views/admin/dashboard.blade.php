@extends('admin.layout')

@section('title', 'ড্যাশবোর্ড')
@section('page_title', 'এডমিন ওভারভিউ')

@section('content')
    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="label">📂 মোট ইউজার</div>
            <div class="value">{{ number_format($totalUsers) }}</div>
        </div>
        <div class="stat-card">
            <div class="label">📩 পন্ডিং রিকোয়েস্ট (Requests)</div>
            <div class="value" style="color:#dc2626">{{ number_format($pendingRequestsCount) }}</div>
        </div>
        <div class="stat-card">
            <div class="label">💎 সক্রিয় সাবস্ক্রিপশন প্ল্যান</div>
            <div class="value" style="color:#059669">{{ number_format($activePlansCount) }}</div>
        </div>
        <div class="stat-card">
            <div class="label">📜 পাবলিশড বায়োডাটা</div>
            <div class="value" style="color:#16a34a">{{ number_format($publishedBiodatas) }}</div>
        </div>
        <div class="stat-card">
            <div class="label">✉️ কন্টাক্ট মেসেজ</div>
            <div class="value" style="color:#2563eb">{{ number_format($totalMessages) }}</div>
        </div>
    </div>

    <!-- Recent Requests Section -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">📩 সাম্প্রতিক ইউজার রিকোয়েস্টসমূহ (User Requests)</div>
            <a href="{{ route('admin.requests.index') }}" class="btn-action btn-action-primary">সব রিকোয়েস্ট দেখুন</a>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ইউজার</th>
                    <th>টাইপ</th>
                    <th>টাইটেল</th>
                    <th>স্ট্যাটাস</th>
                    <th>তারিখ</th>
                    <th>অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestRequests as $req)
                    <tr>
                        <td>#{{ $req->id }}</td>
                        <td><strong>{{ $req->user->name ?? 'N/A' }}</strong><br><small style="color:#64748b">{{ $req->user->email ?? '' }}</small></td>
                        <td><span class="badge badge-blue">{{ strtoupper($req->type) }}</span></td>
                        <td>{{ $req->title }}</td>
                        <td>
                            @if($req->status === 'approved')
                                <span class="badge badge-green">অনুমোদিত</span>
                            @elseif($req->status === 'rejected')
                                <span class="badge badge-red">বাতিল</span>
                            @else
                                <span class="badge badge-yellow">পেন্ডিং</span>
                            @endif
                        </td>
                        <td>{{ $req->created_at->format('d M, Y - h:i A') }}</td>
                        <td>
                            @if($req->status === 'pending')
                                <form action="{{ route('admin.requests.approve', $req) }}" method="POST" style="display:inline">
                                    @csrf
                                    <button class="btn-action btn-action-success">এপ্রুভ করুন</button>
                                </form>
                            @else
                                <span style="font-size:11px;color:#64748b">সম্পন্ন</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;color:#64748b">কোনো নতুন রিকোয়েস্ট নেই।</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Recent Biodatas & Users Grid -->
    <div style="display:grid;grid-template-columns:1.2fr 0.8fr;gap:20px;">
        <!-- Recent Biodatas -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">📜 সাম্প্রতিক বায়োডাটা সমূহ</div>
                <a href="{{ route('admin.biodatas.index') }}" class="btn-action btn-action-primary">সব বায়োডাটা</a>
            </div>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>নাম</th>
                        <th>লিঙ্গ</th>
                        <th>বয়স</th>
                        <th>স্ট্যাটাস</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestBiodatas as $b)
                        <tr>
                            <td>#{{ $b->id }}</td>
                            <td><strong>{{ $b->display_name }}</strong></td>
                            <td>{{ $b->gender === 'male' || $b->gender === 'groom' ? 'পাত্র' : 'পাত্রী' }}</td>
                            <td>{{ $b->age }} বছর</td>
                            <td>
                                @if($b->published)
                                    <span class="badge badge-green">পাবলিশড</span>
                                @else
                                    <span class="badge badge-yellow">পেন্ডিং</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;color:#64748b">কোনো বায়োডাটা পাওয়া যায়নি।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Recent Users -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">👥 নতুন রেজিস্টার্ড ইউজার</div>
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
                            <td><strong>{{ $u->name }}</strong></td>
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
    </div>
@endsection
