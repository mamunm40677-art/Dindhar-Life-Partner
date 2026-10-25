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
        try {
            $hasBiodatas = Schema::hasTable('biodatas');
            $hasRequests = Schema::hasTable('user_requests');
            $hasPlans = Schema::hasTable('plans');
            $hasMessages = Schema::hasTable('contact_messages');

            $totalUsers = User::count();
            $totalBiodatas = $hasBiodatas ? Biodata::count() : 0;
            $publishedBiodatas = $hasBiodatas ? Biodata::where('published', true)->count() : 0;
            $pendingBiodatas = $hasBiodatas ? Biodata::where('published', false)->count() : 0;
            $totalMessages = $hasMessages ? ContactMessage::count() : 0;
            $activePlansCount = $hasPlans ? Plan::where('is_active', true)->count() : 0;
            $pendingRequestsCount = $hasRequests ? UserRequest::where('status', 'pending')->count() : 0;

            $latestUsers = User::latest()->take(5)->get();
            $latestBiodatas = $hasBiodatas ? Biodata::with('user')->latest()->take(5)->get() : collect();
            $latestRequests = $hasRequests ? UserRequest::with(array_values(array_filter(['user', $hasBiodatas ? 'biodata' : null])))->latest()->take(5)->get() : collect();
        } catch (\Throwable $e) {
            $totalUsers = 0;
            $totalBiodatas = 0;
            $publishedBiodatas = 0;
            $pendingBiodatas = 0;
            $totalMessages = 0;
            $activePlansCount = 0;
            $pendingRequestsCount = 0;
            $latestUsers = collect();
            $latestBiodatas = collect();
            $latestRequests = collect();
        }

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
