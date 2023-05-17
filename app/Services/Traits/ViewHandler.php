<?php

namespace App\Services\Traits;

use Closure;
use Illuminate\Support\Facades\DB;

trait ViewHandler
{
    use ResponseHandler;

    /**
     *  Handle
     *
     *  @param Closure $closure
     */
    public function handle(Closure $closure)
    {
        try {
            return $closure();
        } catch (\Throwable $th) {
            $this->response([], '[ERROR] ' . $th->getMessage(), false, 500);
            return back()->with('error', 'Terjadi kesalahan sistem');
        }
    }
}
