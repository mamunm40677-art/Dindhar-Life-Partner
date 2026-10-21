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

    public function incomingRequests(Request $request): View
    {
        return view('biodatas.generic_list', [
            'title' => '👍 কারা রিকোয়েস্ট করেছে',
            'subtitle' => 'যেসব পাত্র/পাত্রী আপনার সাথে যোগাযোগের আগ্রহ প্রকাশ করেছেন বা রিকোয়েস্ট পাঠিয়েছেন।',
            'emptyMessage' => 'এখনো আপনাকে কেউ যোগাযোগ রিকোয়েস্ট পাঠায়নি।',
        ]);
    }

    public function shortlistedBy(Request $request): View
    {
        return view('biodatas.generic_list', [
            'title' => '❤️ কারা পছন্দে যুক্ত রেখেছে',
            'subtitle' => 'যেসব ইউজার আপনার বায়োডাটা তাদের পছন্দের তালিকায় (Shortlist) যুক্ত করেছেন।',
            'emptyMessage' => 'এখনো কেউ আপনার বায়োডাটা পছন্দের তালিকায় যুক্ত করেনি।',
        ]);
    }

    public function profileVisitors(Request $request): View
    {
        return view('biodatas.generic_list', [
            'title' => '👁️‍🗨️ কারা প্রোফাইল দেখেছে',
            'subtitle' => 'সাম্প্রতিক যেসব দ্বীনদার ইউজার আপনার বায়োডাটা ভিজিট করেছেন।',
            'emptyMessage' => 'সাম্প্রতিক সময়ে কেউ আপনার বায়োডাটা ভিজিট করেনি।',
        ]);
    }

    public function ignoredList(Request $request): View
    {
        return view('biodatas.generic_list', [
            'title' => '🚫 ইগনোর তালিকা',
            'subtitle' => 'যেসব বায়োডাটা আপনি হাইড বা ইগনোর করে রেখেছেন।',
            'emptyMessage' => 'আপনার ইগনোর তালিকায় কোনো বায়োডাটা নেই।',
        ]);
    }

    public function packagesPage(Request $request): View
    {
        $plans = \App\Models\Plan::where('is_active', true)->orderBy('sort_order')->get();
        return view('biodatas.packages', compact('plans'));
    }
}
