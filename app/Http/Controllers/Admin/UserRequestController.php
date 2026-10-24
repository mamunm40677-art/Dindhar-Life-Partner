<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\UserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class UserRequestController extends Controller
{
    public function index(Request $request): View
    {
        $query = UserRequest::query()->with(['user', 'biodata', 'plan']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $userRequests = $query->latest()->paginate(15)->withQueryString();

        $pendingCount = Schema::hasTable('user_requests') ? UserRequest::where('status', 'pending')->count() : 0;
        $approvedCount = Schema::hasTable('user_requests') ? UserRequest::where('status', 'approved')->count() : 0;
        $rejectedCount = Schema::hasTable('user_requests') ? UserRequest::where('status', 'rejected')->count() : 0;

        if (Schema::hasTable('biodatas') && Schema::hasTable('user_requests')) {
            $unapprovedBiodatas = Biodata::where('published', false)->get();
            foreach ($unapprovedBiodatas as $biodata) {
                UserRequest::firstOrCreate(
                    [
                        'user_id' => $biodata->user_id,
                        'biodata_id' => $biodata->id,
                        'type' => 'biodata_approval',
                    ],
                    [
                        'title' => 'বায়োডাটা অনুমোদন রিকোয়েস্ট (ID: #' . $biodata->id . ')',
                        'details' => 'ইউজার ' . $biodata->display_name . ' নতুন বায়োডাটা অনুমোদনের জন্য আবেদন করেছেন।',
                        'status' => 'pending',
                    ]
                );
            }
        }

        return view('admin.requests.index', compact('userRequests', 'pendingCount', 'approvedCount', 'rejectedCount'));
    }

    public function approve(UserRequest $userRequest): RedirectResponse
    {
        $userRequest->update([
            'status' => 'approved',
            'admin_note' => 'এডমিন কর্তৃক অনুমোদিত হয়েছে।'
        ]);

        if ($userRequest->biodata) {
            $userRequest->biodata->update(['published' => true]);
        }

        return back()->with('success', 'রিকোয়েস্ট সফলভাবে এপ্রুভ বা অনুমোদন করা হয়েছে।');
    }

    public function reject(UserRequest $userRequest): RedirectResponse
    {
        $userRequest->update([
            'status' => 'rejected',
            'admin_note' => 'এডমিন কর্তৃক বাতিল করা হয়েছে।'
        ]);

        if ($userRequest->biodata) {
            $userRequest->biodata->update(['published' => false]);
        }

        return back()->with('success', 'রিকোয়েস্টটি বাতিল করা হয়েছে।');
    }

    public function destroy(UserRequest $userRequest): RedirectResponse
    {
        $userRequest->delete();
        return back()->with('success', 'রিকোয়েস্ট হিস্ট্রি মুছে ফেলা হয়েছে।');
    }
}
