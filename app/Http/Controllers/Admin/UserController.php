<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::withCount('cases')->latest();

        if (in_array($request->query('role'), ['admin', 'doctor', 'patient'], true)) {
            $query->where('role', $request->query('role'));
        }

        $users = $query->get();

        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted.');
    }
}
