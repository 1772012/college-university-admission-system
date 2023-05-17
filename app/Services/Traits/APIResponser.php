<?php

namespace App\Services\Traits;

use Illuminate\Http\JsonResponse;

trait APIResponser
{
    /**
     *  Response
     *
     *  @param bool $success
     *  @param int $code
     *  @param array $data,
     *  @param string $message
     */
    public function response(bool $success, int $code, array $data, string $message): JsonResponse
    {
        return response()->json([
            'success'   => $success,
            'code'      => $code,
            'data'      => $data,
            'message'   => $message
        ]);
    }
}
