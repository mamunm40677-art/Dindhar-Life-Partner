<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user()->load('biodata');

        return view('settings', [
            'user' => $user,
            'biodata' => $user->biodata,
        ]);
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
        ]);

        $user->update($validated);

        return back()->with('status', 'প্রোফাইল তথ্য সফলভাবে আপডেট করা হয়েছে।');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'password' => ['required', 'string', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে।');
    }

    public function deleteBiodata(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->biodata) {
            $user->biodata->delete();
            return back()->with('status', 'আপনার বায়োডাটা সফলভাবে মুছে ফেলা হয়েছে।');
        }

        return back()->with('error', 'আপনার কোনো অ্যাক্টিভ বায়োডাটা নেই।');
    }

    public function deleteAccount(Request $request): RedirectResponse
    {
        $user = $request->user();

        Auth::logout();

        if ($user->biodata) {
            $user->biodata->delete();
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('status', 'আপনার অ্যাকাউন্টটি সফলভাবে স্থায়ীভাবে মুছে ফেলা হয়েছে।');
    }
}
