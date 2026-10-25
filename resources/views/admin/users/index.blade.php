@extends('admin.layout')

@section('title', 'ইউজার তালিকা')
@section('page_title', 'ইউজার অ্যাকাউন্ট ব্যবস্থাপনা')

@section('content')
    <div class="card">
        <form method="GET" action="{{ route('admin.users.index') }}" class="search-box">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="নাম বা ইমেইল দিয়ে খুঁজুন...">
            <button type="submit">খুঁজুন</button>
            @if(request('search'))
                <a href="{{ route('admin.users.index') }}" class="btn-action btn-action-danger" style="display:inline-flex;align-items:center;">রিসেট</a>
            @endif
        </form>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>নাম</th>
                    <th>ইমেইল</th>
                    <th>বায়োডাটা স্ট্যাটাস</th>
                    <th>রোল</th>
                    <th>রেজিস্ট্রেশনের তারিখ</th>
                    <th>অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>#{{ $user->id }}</td>
                        <td><strong>{{ $user->name }}</strong></td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @php
                                $hasBio = false;
                                $bioId = null;
                                try {
                                    if ($user->biodata) {
                                        $hasBio = true;
                                        $bioId = $user->biodata->id;
                                    }
                                } catch (\Throwable $e) {}
                            @endphp
                            @if($hasBio)
                                <span class="badge badge-green">তৈরি করা আছে (#{{ $bioId }})</span>
                            @else
                                <span class="badge badge-yellow">তৈরি করা হয়নি</span>
                            @endif
                        </td>
                        <td>
                            @if($user->isAdmin())
                                <span class="badge badge-blue">এডমিন</span>
                            @else
                                <span class="badge badge-yellow">সাধারণ ইউজার</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at?->format('d M, Y - h:i A') ?? 'N/A' }}</td>
                        <td>
                            <div style="display:flex;gap:6px">
                                @if(auth()->id() !== $user->id)
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn-action btn-action-primary">এডিট</a>

                                    <form action="{{ route('admin.users.toggle-admin', $user) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-action {{ $user->isAdmin() ? 'btn-action-warning' : 'btn-action-success' }}">
                                            {{ $user->isAdmin() ? 'ইউজার বানান' : 'এডমিন বানান' }}
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই ইউজার এবং তার সকল তথ্য স্থায়ীভাবে মুছে ফেলতে চান?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-action-danger">ডিলিট</button>
                                    </form>
                                @else
                                    <span style="font-size:11px;color:#64748b;font-weight:bold">(আপনার অ্যাকাউন্ট)</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;color:#64748b">কোনো ইউজার পাওয়া যায়নি।</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:20px">
            {{ $users->links() }}
        </div>
    </div>
@endsection
