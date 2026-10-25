<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class BiodataController extends Controller
{
    public function index(Request $request): View
    {
        if (! Schema::hasTable('biodatas')) {
            $biodatas = new LengthAwarePaginator([], 0, 15);
            return view('admin.biodatas.index', compact('biodatas'));
        }

        $query = Biodata::query()->with('user');

        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->where('published', true);
            } elseif ($request->status === 'pending') {
                $query->where('published', false);
            }
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('display_name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('occupation', 'like', "%{$search}%");
            });
        }

        $biodatas = $query->latest()->paginate(15)->withQueryString();

        return view('admin.biodatas.index', compact('biodatas'));
    }

    public function togglePublish(Biodata $biodata): RedirectResponse
    {
        $biodata->update(['published' => ! $biodata->published]);

        $status = $biodata->published ? 'published' : 'unpublished';

        return back()->with('success', "Biodata #{$biodata->id} ({$biodata->display_name}) has been {$status}.");
    }

    public function destroy(Biodata $biodata): RedirectResponse
    {
        $biodata->delete();

        return back()->with('success', 'Biodata deleted successfully.');
    }
}
