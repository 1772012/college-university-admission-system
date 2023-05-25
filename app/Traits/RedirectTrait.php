<?php

namespace App\Traits;

use Closure;

trait RedirectTrait
{
    /**
     *  Redirect
     *
     *  @param Closure $closure
     */
    public function renderOrRedirect(Closure $closure)
    {
        try {
            return $closure();
        } catch (\Throwable $th) {
            return back()->with('error-message', 'Oops. Terjadi kesalahan sistem.');
        }
    }
}
