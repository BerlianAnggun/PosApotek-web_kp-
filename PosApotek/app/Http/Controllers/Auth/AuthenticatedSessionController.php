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
        $cek = Auth::user();
        if ($cek->roles_id == 1) {
            return redirect()->intended(route('dashboard1',false));
        }
        if ($cek->roles_id == 2) {
            return redirect()->intended(route('dashboard1',false));
        }
        if ($cek->roles_id == 3) {
            return redirect()->intended(route('dashboard2',false));
        }
        if ($cek->roles_id == 5) {
            return redirect()->intended(route('dashboard2',false));
        }
        return redirect()->intended(route('admin.home', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
