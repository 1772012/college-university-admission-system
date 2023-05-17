<?php

namespace App\Services\Traits;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

trait Handler
{
    use ResponseHandler;

    /**
     *  Handle view responses
     *
     *  @param Closure $closure
     *  @return RedirectResponse|View
     */
    public function handleViewResponse(Closure $closure)
    {
        try {
            return $closure();
        } catch (\Throwable $th) {
            $this->response(['Description'   => $th->getMessage()], '[ERROR] ' . $th->getMessage(), false, 500);
            return back()->with('error', 'Terjadi kesalahan sistem.');
        }
    }

    /**
     *  Handle json responses
     *
     *  @return JsonResponse
     */
    public function handleJsonResponse(Closure $closure): JsonResponse
    {
        DB::beginTransaction();

        try {
            $result = $closure();
            DB::commit();
            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->response(['Description'   => $th->getMessage()], '[ERROR] ' . $th->getMessage(), false, 500);
        }
    }
}
