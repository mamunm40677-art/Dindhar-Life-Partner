<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PlanController extends Controller
{
    public function index(): View
    {
        $plans = Schema::hasTable('plans')
            ? Plan::query()->orderBy('sort_order')->orderBy('id')->get()
            : collect();

        return view('admin.plans.index', compact('plans'));
    }

    public function create(): View
    {
        return view('admin.plans.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'subtitle' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:60',
            'price' => 'required|numeric|min:0',
            'period' => 'nullable|string|max:60',
            'connection_limit' => 'required|integer|min:0',
            'features_raw' => 'required|string',
            'is_popular' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'button_text' => 'required|string|max:100',
            'button_link' => 'required|string|max:255',
        ]);

        $features = array_filter(
            array_map('trim', explode("\n", $validated['features_raw'])),
            fn($line) => $line !== ''
        );

        Plan::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . time(),
            'subtitle' => $validated['subtitle'] ?? null,
            'badge' => $validated['badge'] ?? null,
            'price' => $validated['price'],
            'period' => $validated['period'] ?? '/ মেয়াদী',
            'connection_limit' => $validated['connection_limit'],
            'features' => array_values($features),
            'is_popular' => $request->boolean('is_popular'),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $validated['sort_order'] ?? 0,
            'button_text' => $validated['button_text'],
            'button_link' => $validated['button_link'],
        ]);

        return redirect()->route('admin.plans.index')->with('success', 'নতুন সাবস্ক্রিপশন প্ল্যান সফলভাবে তৈরি করা হয়েছে।');
    }

    public function edit(Plan $plan): View
    {
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'subtitle' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:60',
            'price' => 'required|numeric|min:0',
            'period' => 'nullable|string|max:60',
            'connection_limit' => 'required|integer|min:0',
            'features_raw' => 'required|string',
            'is_popular' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'button_text' => 'required|string|max:100',
            'button_link' => 'required|string|max:255',
        ]);

        $features = array_filter(
            array_map('trim', explode("\n", $validated['features_raw'])),
            fn($line) => $line !== ''
        );

        $plan->update([
            'name' => $validated['name'],
            'subtitle' => $validated['subtitle'] ?? null,
            'badge' => $validated['badge'] ?? null,
            'price' => $validated['price'],
            'period' => $validated['period'] ?? '/ মেয়াদী',
            'connection_limit' => $validated['connection_limit'],
            'features' => array_values($features),
            'is_popular' => $request->boolean('is_popular'),
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $validated['sort_order'] ?? 0,
            'button_text' => $validated['button_text'],
            'button_link' => $validated['button_link'],
        ]);

        return redirect()->route('admin.plans.index')->with('success', 'সাবস্ক্রিপশন প্ল্যান সফলভাবে আপডেট করা হয়েছে।');
    }

    public function toggleActive(Plan $plan): RedirectResponse
    {
        $plan->update(['is_active' => ! $plan->is_active]);
        $status = $plan->is_active ? 'পাবলিশড' : 'ড্রাফট';
        return back()->with('success', "প্ল্যানটি সফলভাবে {$status} করা হয়েছে।");
    }

    public function destroy(Plan $plan): RedirectResponse
    {
        $plan->delete();
        return redirect()->route('admin.plans.index')->with('success', 'সাবস্ক্রিপশন প্ল্যান সফলভাবে মুছে ফেলা হয়েছে।');
    }
}
