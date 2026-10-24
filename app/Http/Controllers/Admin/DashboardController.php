<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\ContactMessage;
use App\Models\Plan;
use App\Models\User;
use App\Models\UserRequest;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalUsers = User::count();
        $totalBiodatas = Schema::hasTable('biodatas') ? Biodata::count() : 0;
        $publishedBiodatas = Schema::hasTable('biodatas') ? Biodata::where('published', true)->count() : 0;
        $pendingBiodatas = Schema::hasTable('biodatas') ? Biodata::where('published', false)->count() : 0;
        $totalMessages = Schema::hasTable('contact_messages') ? ContactMessage::count() : 0;
        $activePlansCount = Schema::hasTable('plans') ? Plan::where('is_active', true)->count() : 0;
        $pendingRequestsCount = Schema::hasTable('user_requests') ? UserRequest::where('status', 'pending')->count() : 0;

        $latestUsers = User::latest()->take(5)->get();
        $latestBiodatas = Schema::hasTable('biodatas') ? Biodata::with('user')->latest()->take(5)->get() : collect();
        $latestRequests = Schema::hasTable('user_requests') ? UserRequest::with(['user', 'biodata'])->latest()->take(5)->get() : collect();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalBiodatas',
            'publishedBiodatas',
            'pendingBiodatas',
            'totalMessages',
            'activePlansCount',
            'pendingRequestsCount',
            'latestUsers',
            'latestBiodatas',
            'latestRequests'
        ));
    }
}
