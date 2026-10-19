<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user()->load('biodata');

        return view('dashboard', [
            'biodata' => $user->biodata,
            'memberSince' => $user->created_at,
        ]);
    }
}
