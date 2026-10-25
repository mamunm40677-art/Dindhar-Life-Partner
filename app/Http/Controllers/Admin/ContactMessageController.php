<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        try {
            $messages = Schema::hasTable('contact_messages')
                ? ContactMessage::latest()->paginate(15)
                : new LengthAwarePaginator([], 0, 15);
        } catch (\Throwable $e) {
            $messages = new LengthAwarePaginator([], 0, 15);
        }

        return view('admin.messages.index', compact('messages'));
    }

    public function destroy(ContactMessage $message): RedirectResponse
    {
        try {
            $message->delete();
        } catch (\Throwable $e) {
            return back()->with('error', 'মেসেজ ডিলেট করা সম্ভব হয়নি।');
        }

        return back()->with('success', 'Message deleted successfully.');
    }
}
