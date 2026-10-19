<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $query = Biodata::query()->where('published', true);

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        $biodatas = (clone $query)->latest()->limit(6)->get();

        $totalBiodatas = Biodata::where('published', true)->count();
        $groomsCount = Biodata::where('published', true)->where('gender', 'groom')->count();
        $bridesCount = Biodata::where('published', true)->where('gender', 'bride')->count();

        return view('home', compact('biodatas', 'totalBiodatas', 'groomsCount', 'bridesCount'));
    }
}
