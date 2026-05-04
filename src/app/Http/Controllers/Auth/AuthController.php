<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Support\PanelResolver;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Redirect authenticated user to their panel.
     * Useful for guard-based redirects (e.g. after middleware passes).
     */
    public function dashboard(): RedirectResponse
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        return redirect()->to(PanelResolver::redirectUrl(Auth::user()));
    }

    /**
     * Log the user out and clear session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}