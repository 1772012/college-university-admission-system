<?php

namespace App\Services\Traits;

use Closure;
use Illuminate\Support\Facades\DB;

trait ServiceHandler
{
    use ResponseHandler;

    /**
     *  Handle
     *
     *  @param Closure $closure
     */
    public function handle(Closure $closure)
    {
        DB::beginTransaction();

        try {
            $result = $closure();

            DB::commit();

            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();

            return $this->response([], '[ERROR] ' . $th->getMessage(), false, 500);
        }
    }
}
