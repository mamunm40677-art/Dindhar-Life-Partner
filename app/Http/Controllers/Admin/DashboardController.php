<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\ContactMessage;
use App\Models\User;
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

        $latestUsers = User::latest()->take(5)->get();
        $latestBiodatas = Biodata::with('user')->latest()->take(5)->get();
        $latestMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalBiodatas',
            'publishedBiodatas',
            'pendingBiodatas',
            'totalMessages',
            'latestUsers',
            'latestBiodatas',
            'latestMessages'
        ));
    }
}
