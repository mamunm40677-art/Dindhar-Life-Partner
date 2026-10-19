<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $biodatas = Biodata::query()->where('published', true)->latest()->limit(3)->get();

        return view('home', compact('biodatas'));
    }
}
