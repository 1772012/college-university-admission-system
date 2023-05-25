<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Traits\RedirectTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    use RedirectTrait;

    /*
    |--------------------------------------------------------------------------
    | View Controllers
    |--------------------------------------------------------------------------
    */

    /**
     *  Index
     *
     *  @return View
     */
    public function index(): View
    {
        return $this->renderOrRedirect(function () {
            return view('pages.login.index');
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Service Controllers
    |--------------------------------------------------------------------------
    */

    /**
     * Auth
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function auth(LoginRequest $request): RedirectResponse
    {
        return $this->renderOrRedirect(function () use ($request) {

            //  Set credentials
            $credentials = $request->only(['email', 'password']);

            //  Whether is login
            if (Auth::attempt($credentials)) {
                if (Auth::user()->role == 'admin') {
                    return redirect()->route('dashboard.index');
                } else {
                    return back()->with('error-message', 'Anda bukan administrator!');
                }
            } else {
                return back()->with('error-message', 'Username atau password salah!');
            }
        });
    }


    /**
     *  Logout
     *
     *  @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        return $this->renderOrRedirect(function () {

            //  Logout
            Auth::logout();

            //  Return redirect route
            return redirect()->route('login.index');
        });
    }
}
