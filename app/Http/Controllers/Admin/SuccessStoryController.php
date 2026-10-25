<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuccessStory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class SuccessStoryController extends Controller
{
    public function index(): View
    {
        $stories = Schema::hasTable('success_stories')
            ? SuccessStory::query()->orderBy('sort_order')->orderBy('id')->get()
            : collect();

        return view('admin.stories.index', compact('stories'));
    }

    public function create(): View
    {
        return view('admin.stories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:120',
            'marriage_date' => 'nullable|string|max:100',
            'quote' => 'required|string|max:1000',
            'image_url' => 'nullable|string|max:500',
            'link_url' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        SuccessStory::create([
            'title' => $validated['title'],
            'marriage_date' => $validated['marriage_date'] ?? null,
            'quote' => $validated['quote'],
            'image_url' => $validated['image_url'] ?? null,
            'link_url' => $validated['link_url'] ?? '#',
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.stories.index')->with('success', 'নতুন সাফল্যের গল্প সফলভাবে যোগ করা হয়েছে।');
    }

    public function edit(SuccessStory $story): View
    {
        return view('admin.stories.edit', compact('story'));
    }

    public function update(Request $request, SuccessStory $story): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:120',
            'marriage_date' => 'nullable|string|max:100',
            'quote' => 'required|string|max:1000',
            'image_url' => 'nullable|string|max:500',
            'link_url' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $story->update([
            'title' => $validated['title'],
            'marriage_date' => $validated['marriage_date'] ?? null,
            'quote' => $validated['quote'],
            'image_url' => $validated['image_url'] ?? null,
            'link_url' => $validated['link_url'] ?? '#',
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.stories.index')->with('success', 'সাফল্যের গল্প সফলভাবে আপডেট করা হয়েছে।');
    }

    public function toggleActive(SuccessStory $story): RedirectResponse
    {
        $story->update(['is_active' => ! $story->is_active]);
        $status = $story->is_active ? 'পাবলিশড' : 'ড্রাফট';
        return back()->with('success', "গল্পটি সফলভাবে {$status} করা হয়েছে।");
    }

    public function destroy(SuccessStory $story): RedirectResponse
    {
        $story->delete();
        return redirect()->route('admin.stories.index')->with('success', 'সাফল্যের গল্প মুছে ফেলা হয়েছে।');
    }
}
