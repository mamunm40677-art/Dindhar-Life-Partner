@extends('admin.layout')

@section('title', 'ইউজার রিকোয়েস্ট তালিকা')
@section('page_title', 'অ্যাকাউন্টস - ইউজার রিকোয়েস্ট ব্যবস্থাপনা (User Requests)')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="card-title">📩 ইউজার রিকোয়েস্ট ও অনুমোদনসমূহ</h3>
                <p style="font-size:12px;color:#64748b;margin-top:4px">ইউজারদের বায়োডাটা এপ্রুভাল রিকোয়েস্ট, কানেকশন আনলক বা প্যাকেজ রিকোয়েস্ট এক ক্লিকে অনুমোদন বা বাতিল করুন।</p>
            </div>
            <div style="display:flex;gap:8px">
                <a href="{{ route('admin.requests.index') }}" class="badge badge-blue" style="font-size:12px;padding:6px 12px">সব ({{ $userRequests->total() }})</a>
                <a href="{{ route('admin.requests.index', ['status' => 'pending']) }}" class="badge badge-yellow" style="font-size:12px;padding:6px 12px">পেন্ডিং ({{ $pendingCount }})</a>
                <a href="{{ route('admin.requests.index', ['status' => 'approved']) }}" class="badge badge-green" style="font-size:12px;padding:6px 12px">অনুমোদিত ({{ $approvedCount }})</a>
            </div>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>আবেদনকারী ইউজার</th>
                    <th>রিকোয়েস্ট টাইপ</th>
                    <th>টাইটেল & বিবরণ</th>
                    <th>সংযুক্ত বায়োডাটা</th>
                    <th>স্ট্যাটাস</th>
                    <th>আবেদনের তারিখ</th>
                    <th>অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($userRequests as $req)
                    <tr>
                        <td>#{{ $req->id }}</td>
                        <td>
                            <strong>{{ $req->user->name ?? 'N/A' }}</strong><br>
                            <small style="color:#64748b">{{ $req->user->email ?? '' }}</small>
                        </td>
                        <td>
                            <span class="badge badge-blue">{{ strtoupper($req->type) }}</span>
                        </td>
                        <td>
                            <strong>{{ $req->title }}</strong><br>
                            <small style="color:#475569">{{ $req->details }}</small>
                            @if($req->admin_note)
                                <br><small style="color:#059669">নোট: {{ $req->admin_note }}</small>
                            @endif
                        </td>
                        <td>
                            @if($req->biodata)
                                <a href="{{ route('biodatas.show', $req->biodata) }}" target="_blank" style="color:#2563eb;font-weight:700">
                                    {{ $req->biodata->display_name }} (#{{ $req->biodata->id }})
                                </a>
                            @else
                                <span style="color:#94a3b8">-</span>
                            @endif
                        </td>
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
                            <div style="display:flex;gap:6px">
                                @if($req->status === 'pending')
                                    <form action="{{ route('admin.requests.approve', $req) }}" method="POST">
                                        @csrf
                                        <button class="btn-action btn-action-success">এপ্রুভ করুন</button>
                                    </form>

                                    <form action="{{ route('admin.requests.reject', $req) }}" method="POST">
                                        @csrf
                                        <button class="btn-action btn-action-warning">বাতিল করুন</button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.requests.destroy', $req) }}" method="POST" onsubmit="return confirm('রিকোয়েস্ট হিস্ট্রি মুছে ফেলতে চান?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-action btn-action-danger">ডিলিট</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center;color:#64748b">কোনো ইউজার রিকোয়েস্ট পাওয়া যায়নি।</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:20px">
            {{ $userRequests->links() }}
        </div>
    </div>
@endsection
