@extends('admin.layout')

@section('title', 'বায়োডাটা ব্যবস্থাপনা')
@section('page_title', 'বায়োডাটা তালিকা ও অনুমোদন')

@section('content')
    <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:15px">
            <div style="display:flex;gap:10px">
                <a href="{{ route('admin.biodatas.index') }}" class="btn-action {{ !request('status') ? 'btn-action-primary' : '' }}" style="background:#062820;color:#fff">সব বায়োডাটা</a>
                <a href="{{ route('admin.biodatas.index', ['status' => 'published']) }}" class="btn-action {{ request('status') === 'published' ? 'btn-action-success' : '' }}" style="background:#16a34a;color:#fff">পাবলিশড</a>
                <a href="{{ route('admin.biodatas.index', ['status' => 'pending']) }}" class="btn-action {{ request('status') === 'pending' ? 'btn-action-warning' : '' }}" style="background:#d97706;color:#fff">পেন্ডিং অনুমোদন</a>
            </div>

            <form method="GET" action="{{ route('admin.biodatas.index') }}" class="search-box" style="margin-bottom:0">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <input type="text" name="search" value="{{ request('search') }}" placeholder="বায়োডাটা খুঁজুন (নাম/শহর)...">
                <button type="submit">খুঁজুন</button>
            </form>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ডিসপ্লে নাম</th>
                    <th>ইউজার</th>
                    <th>লিঙ্গ</th>
                    <th>বয়স</th>
                    <th>বৈবাহিক অবস্থা</th>
                    <th>শহর</th>
                    <th>স্ট্যাটাস</th>
                    <th>অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($biodatas as $b)
                    <tr>
                        <td><strong>#{{ $b->id }}</strong></td>
                        <td>{{ $b->display_name }}</td>
                        <td>{{ $b->user ? $b->user->name : 'N/A' }}</td>
                        <td>{{ $b->gender === 'male' ? 'পাত্র (Male)' : 'পাত্রী (Female)' }}</td>
                        <td>{{ $b->age }} বছর</td>
                        <td>{{ $b->marital_status }}</td>
                        <td>{{ $b->city }}</td>
                        <td>
                            @if($b->published)
                                <span class="badge badge-green">পাবলিশড</span>
                            @else
                                <span class="badge badge-yellow">পেন্ডিং</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <a href="{{ route('biodatas.show', $b) }}" target="_blank" class="btn-action btn-action-primary">দেখুন</a>

                                <form action="{{ route('admin.biodatas.toggle-publish', $b) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-action {{ $b->published ? 'btn-action-warning' : 'btn-action-success' }}">
                                        {{ $b->published ? 'আনপাবলিশ' : 'অনুমোদন (Publish)' }}
                                    </button>
                                </form>

                                <form action="{{ route('admin.biodatas.destroy', $b) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই বায়োডাটা মুছে ফেলতে চান?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-action-danger">ডিলিট</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align:center;color:#64748b">কোনো বায়োডাটা পাওয়া যায়নি।</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:20px">
            {{ $biodatas->links() }}
        </div>
    </div>
@endsection
