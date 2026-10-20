<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MutualMatchController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user()->load('biodata');
        $myBiodata = $user->biodata;

        $matches = collect();

        if ($myBiodata) {
            $targetGender = ($myBiodata->gender === 'groom' || $myBiodata->gender === 'male') ? ['bride', 'female'] : ['groom', 'male'];

            $oppositeBiodatas = Biodata::whereIn('gender', $targetGender)
                ->where('published', true)
                ->latest()
                ->take(20)
                ->get();

            foreach ($oppositeBiodatas as $other) {
                $score = 50;

                if (mb_strtolower($myBiodata->city) === mb_strtolower($other->city)) {
                    $score += 25;
                }

                if ($myBiodata->marital_status === $other->marital_status) {
                    $score += 15;
                }

                $ageDiff = abs($myBiodata->age - $other->age);
                if ($ageDiff <= 5) {
                    $score += 10;
                }

                $other->match_percentage = min($score, 100);
                $matches->push($other);
            }

            $matches = $matches->sortByDesc('match_percentage');
        }

        return view('biodatas.mutual', [
            'myBiodata' => $myBiodata,
            'matches' => $matches,
        ]);
    }

    public function preferenceMatches(Request $request): View
    {
        $user = $request->user()->load('biodata');
        $myBiodata = $user->biodata;

        $matches = collect();

        if ($myBiodata) {
            $targetGender = ($myBiodata->gender === 'groom' || $myBiodata->gender === 'male') ? ['bride', 'female'] : ['groom', 'male'];

            $matches = Biodata::whereIn('gender', $targetGender)
                ->where('published', true)
                ->latest()
                ->take(15)
                ->get();

            foreach ($matches as $item) {
                $item->match_percentage = rand(70, 98);
            }
        }

        return view('biodatas.preferences', [
            'myBiodata' => $myBiodata,
            'matches' => $matches,
        ]);
    }

    public function onlineUsers(Request $request): View
    {
        $onlineBiodatas = Biodata::where('published', true)
            ->latest()
            ->take(12)
            ->get();

        return view('biodatas.online', [
            'onlineBiodatas' => $onlineBiodatas,
        ]);
    }

    public function contactInfo(Request $request): View
    {
        return view('biodatas.contacts');
    }
}
