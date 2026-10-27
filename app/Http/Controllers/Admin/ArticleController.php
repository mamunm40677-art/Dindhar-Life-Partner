<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Schema::hasTable('articles')
            ? Article::query()->orderBy('sort_order')->orderBy('id', 'desc')->get()
            : collect();

        return view('admin.articles.index', compact('articles'));
    }

    public function create(): View
    {
        return view('admin.articles.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'category' => 'required|string|max:100',
            'summary' => 'required|string|max:1000',
            'content' => 'nullable|string',
            'image_url' => 'nullable|string|max:500',
            'link_url' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        Article::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'summary' => $validated['summary'],
            'content' => $validated['content'] ?? null,
            'image_url' => $validated['image_url'] ?? null,
            'link_url' => $validated['link_url'] ?? route('guide'),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'নতুন আর্টিকেল সফলভাবে যুক্ত করা হয়েছে।');
    }

    public function edit(Article $article): View
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'category' => 'required|string|max:100',
            'summary' => 'required|string|max:1000',
            'content' => 'nullable|string',
            'image_url' => 'nullable|string|max:500',
            'link_url' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $article->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'summary' => $validated['summary'],
            'content' => $validated['content'] ?? null,
            'image_url' => $validated['image_url'] ?? null,
            'link_url' => $validated['link_url'] ?? route('guide'),
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'আর্টিকেল সফলভাবে আপডেট করা হয়েছে।');
    }

    public function toggleActive(Article $article): RedirectResponse
    {
        $article->update(['is_active' => ! $article->is_active]);
        $status = $article->is_active ? 'পাবলিশড' : 'ড্রাফট';
        return back()->with('success', "আর্টিকেলটি সফলভাবে {$status} করা হয়েছে।");
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'আর্টিকেল মুছে ফেলা হয়েছে।');
    }
}
