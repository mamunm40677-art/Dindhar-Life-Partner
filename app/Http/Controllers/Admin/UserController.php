<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query()->with('biodata');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function toggleAdmin(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot change your own admin status.');
        }

        $user->update(['is_admin' => ! $user->is_admin]);

        $status = $user->is_admin ? 'promoted to Admin' : 'removed from Admin';

        return back()->with('success', "User {$user->name} has been {$status}.");
    }

    public function destroy(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete yourself.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}
