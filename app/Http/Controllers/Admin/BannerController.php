<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class BannerController extends Controller
{
    public function index(): View
    {
        $banners = Schema::hasTable('banners')
            ? Banner::query()->orderBy('sort_order')->get()
            : collect();

        return view('admin.banners.index', compact('banners'));
    }

    public function create(): View
    {
        return view('admin.banners.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:1000',
            'image_url' => 'nullable|string|max:500',
            'image_caption' => 'nullable|string|max:255',
            'button1_text' => 'nullable|string|max:120',
            'button1_link' => 'nullable|string|max:255',
            'button2_text' => 'nullable|string|max:120',
            'button2_link' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        Banner::create([
            'badge_text' => $validated['badge_text'] ?? null,
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'image_url' => $validated['image_url'] ?? null,
            'image_caption' => $validated['image_caption'] ?? null,
            'button1_text' => $validated['button1_text'] ?? null,
            'button1_link' => $validated['button1_link'] ?? null,
            'button2_text' => $validated['button2_text'] ?? null,
            'button2_link' => $validated['button2_link'] ?? null,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'নতুন হিরো ব্যানার সফলভাবে যুক্ত করা হয়েছে।');
    }

    public function edit(Banner $banner): View
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner): RedirectResponse
    {
        $validated = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:1000',
            'image_url' => 'nullable|string|max:500',
            'image_caption' => 'nullable|string|max:255',
            'button1_text' => 'nullable|string|max:120',
            'button1_link' => 'nullable|string|max:255',
            'button2_text' => 'nullable|string|max:120',
            'button2_link' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $banner->update([
            'badge_text' => $validated['badge_text'] ?? null,
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'image_url' => $validated['image_url'] ?? null,
            'image_caption' => $validated['image_caption'] ?? null,
            'button1_text' => $validated['button1_text'] ?? null,
            'button1_link' => $validated['button1_link'] ?? null,
            'button2_text' => $validated['button2_text'] ?? null,
            'button2_link' => $validated['button2_link'] ?? null,
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'হিরো ব্যানার সফলভাবে আপডেট করা হয়েছে।');
    }

    public function toggleActive(Banner $banner): RedirectResponse
    {
        $banner->update(['is_active' => ! $banner->is_active]);
        $status = $banner->is_active ? 'পাবলিশড' : 'ড্রাফট';
        return back()->with('success', "ব্যানারটি সফলভাবে {$status} করা হয়েছে।");
    }

    public function destroy(Banner $banner): RedirectResponse
    {
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'ব্যানার সফলভাবে মুছে ফেলা হয়েছে।');
    }
}
