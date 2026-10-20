@extends('admin.layout')

@section('title', 'কন্টাক্ট মেসেজ')
@section('page_title', 'ইউজার কন্টাক্ট মেসেজ সমূহ')

@section('content')
    <div class="card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>প্রেরকের নাম</th>
                    <th>ইমেইল</th>
                    <th>বিষয়</th>
                    <th>বার্তা (Message)</th>
                    <th>তারিখ</th>
                    <th>অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                    <tr>
                        <td>#{{ $msg->id }}</td>
                        <td><strong>{{ $msg->name }}</strong></td>
                        <td><a href="mailto:{{ $msg->email }}" style="color:#2563eb">{{ $msg->email }}</a></td>
                        <td>{{ $msg->subject }}</td>
                        <td style="max-width:300px;line-height:1.5">{{ $msg->message }}</td>
                        <td>{{ $msg->created_at->format('d M, Y - h:i A') }}</td>
                        <td>
                            <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('এই মেসেজটি ডিলিট করতে চান?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-action-danger">ডিলিট</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;color:#64748b">কোনো ইনকামিং কন্টাক্ট মেসেজ নেই।</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:20px">
            {{ $messages->links() }}
        </div>
    </div>
@endsection
