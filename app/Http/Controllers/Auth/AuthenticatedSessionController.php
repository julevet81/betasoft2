<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{

    public function index(): View
    {
        $users = User::all(); // Fetch all users
        return view('dashboard.user.index', compact('users')); // Adjust the view name as needed
        
        /**
         * Get the needed authorization credentials from the request.
         */
        
    }

    protected function credentials(Request $request)
    {
        return $request->only('email', 'password');
    }
    /** 
     * Display the login view.
     */
    public function create(): View
    {
        return view('dashboard.user.auth.signin');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {


        if ($this->attemptLogin($request))
        {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard.user', absolute: false));
        }

        else
        {
             return redirect()->route('login')
                         ->withErrors(['email' => 'Your account is inactive. Please contact admin.']);
        }
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

    protected function attemptLogin(Request $request)
    {
        return Auth::guard(name: 'web')->attempt(
            $this->credentials($request) + ['status' => 'active'],
            $request->filled('remember')
        );
    }

}
