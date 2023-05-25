<?php

namespace App\Traits;

use Closure;
use Illuminate\Support\Facades\DB;

trait DBTransactionTrait
{
    use ResponseTrait;

    /**
     *  Wrap transaction
     *
     *  @param Closure $closure
     */
    public function wrapTransaction(Closure $closure)
    {
        DB::beginTransaction();
        try {
            $result = $closure();
            DB::commit();
            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseError($th->getMessage());
        }
    }
}
