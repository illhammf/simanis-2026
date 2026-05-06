<?php

namespace App\Http\Middleware;

use App\Support\PanelResolver;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsurePanelRole
{
    /**
     * Handle an incoming request.
     *
     * Verifies that the authenticated user's role matches
     * the panel they are trying to access. If not, redirects
     * them to their own panel or back to login.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $requiredRole = PanelResolver::roleForPath($request->path());

        // Path is not a known panel — allow through
        if ($requiredRole === null) {
            return $next($request);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // super_admin can access all panels
        if (! PanelResolver::canAccess($user, PanelResolver::roleForPath($request->path()) ?? '')) {
            return redirect()->to(PanelResolver::redirectUrl($user));
        }

        return $next($request);
    }
}