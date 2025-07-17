<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended($this->redirectTo());
    }

    protected function redirectTo(): string
    {
        $user = Auth::user();

        if ($user->department === 'player') {
            return route('admin.player-dashboard');  // '/admin/player'
        }

        if ($user->department === 'staff') {
            return route('admin.admin-dashboard');         // '/admin'
        }

        if ($user->department === 'tournament_official') {
            return route('admin.tournament-official-dashboard');         // '/admin'
        }


        // Default fallback
        return '/login';
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
