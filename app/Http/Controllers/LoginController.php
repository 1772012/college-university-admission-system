<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     *  Index
     *
     *  @return View
     */
    public function index(): View
    {
        return view('pages.login.index');
    }

    /**
     *  Auth
     *
     *  @return RedirectResponse
     */
    public function auth(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('dashboard.index');
            }
            return back()->with('error-message', 'Anda bukan administrator!');
        } else {
            return back()->with('error-message', 'Username atau password salah!');
        }
    }

    /**
     *  Logout
     *
     *  @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login.index');
    }
}
