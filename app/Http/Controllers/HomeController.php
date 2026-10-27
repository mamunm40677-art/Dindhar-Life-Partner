<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Banner;
use App\Models\Biodata;
use App\Models\Plan;
use App\Models\SuccessStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
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

        $plans = Schema::hasTable('plans')
            ? Plan::where('is_active', true)->orderBy('sort_order')->get()
            : collect();

        $heroBanner = Schema::hasTable('banners')
            ? Banner::where('is_active', true)->orderBy('sort_order')->first()
            : null;

        $successStories = Schema::hasTable('success_stories')
            ? SuccessStory::where('is_active', true)->orderBy('sort_order')->get()
            : collect();

        $articles = Schema::hasTable('articles')
            ? Article::where('is_active', true)->orderBy('sort_order')->orderBy('id', 'desc')->get()
            : collect();

        return view('home', compact('biodatas', 'totalBiodatas', 'groomsCount', 'bridesCount', 'plans', 'heroBanner', 'successStories', 'articles'));
    }
}
}
