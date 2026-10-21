<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\ContactMessage;
use App\Models\Plan;
use App\Models\User;
use App\Models\UserRequest;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalUsers = User::count();
        $totalBiodatas = Biodata::count();
        $publishedBiodatas = Biodata::where('published', true)->count();
        $pendingBiodatas = Biodata::where('published', false)->count();
        $totalMessages = ContactMessage::count();
        $activePlansCount = Plan::where('is_active', true)->count();
        $pendingRequestsCount = UserRequest::where('status', 'pending')->count();

        $latestUsers = User::latest()->take(5)->get();
        $latestBiodatas = Biodata::with('user')->latest()->take(5)->get();
        $latestRequests = UserRequest::with(['user', 'biodata'])->latest()->take(5)->get();

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
