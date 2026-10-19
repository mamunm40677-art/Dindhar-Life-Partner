<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBiodataRequest;
use App\Models\Biodata;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class BiodataController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'gender' => ['nullable', 'in:groom,bride'],
            'marital_status' => ['nullable', 'in:never_married,divorced,widowed'],
            'city' => ['nullable', 'string', 'max:100'],
            'q' => ['nullable', 'string', 'max:100'],
        ]);

        $biodatas = Biodata::query()
            ->where('published', true)
            ->when($filters['gender'] ?? null, fn ($query, $gender) => $query->where('gender', $gender))
            ->when($filters['marital_status'] ?? null, fn ($query, $status) => $query->where('marital_status', $status))
            ->when($filters['city'] ?? null, fn ($query, $city) => $query->where('city', 'like', '%'.$city.'%'))
            ->when($filters['q'] ?? null, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('display_name', 'like', '%'.$search.'%')
                        ->orWhere('education', 'like', '%'.$search.'%')
                        ->orWhere('occupation', 'like', '%'.$search.'%')
                        ->orWhere('city', 'like', '%'.$search.'%');
                });
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('biodatas.index', compact('biodatas', 'filters'));
    }

    public function create(): View
    {
        Gate::authorize('create', Biodata::class);

        return view('biodatas.create', ['biodata' => new Biodata]);
    }

    public function store(StoreBiodataRequest $request): RedirectResponse
    {
        $biodata = $request->user()->biodata()->create(array_merge(
            $request->validated(),
            ['published' => $request->boolean('published')],
        ));

        return redirect()->route('biodatas.show', $biodata)->with('status', __('site.profile_created'));
    }

    public function show(Biodata $biodata): View
    {
        abort_unless($biodata->published || auth()->user()?->biodata()->is($biodata), 404);

        return view('biodatas.show', compact('biodata'));
    }

    public function edit(Biodata $biodata): View
    {
        Gate::authorize('update', $biodata);

        return view('biodatas.edit', compact('biodata'));
    }

    public function update(StoreBiodataRequest $request, Biodata $biodata): RedirectResponse
    {
        $biodata->update(array_merge(
            $request->validated(),
            ['published' => $request->boolean('published')],
        ));

        return redirect()->route('biodatas.show', $biodata)->with('status', __('site.profile_updated'));
    }

    public function destroy(Biodata $biodata): RedirectResponse
    {
        Gate::authorize('delete', $biodata);
        $biodata->delete();

        return redirect()->route('dashboard')->with('status', __('site.profile_deleted'));
    }
}
