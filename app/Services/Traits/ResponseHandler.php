<?php

namespace App\Services\Traits;

use App\Models\Logs\Log;
use Illuminate\Http\JsonResponse;

trait ResponseHandler
{
    /**
     *  Response
     *
     *  @param null|array $data
     *  @param true|bool $success
     *  @param string $message
     *  @param int $status
     *  @param null|string $redirect
     *  @return JsonResponse
     */
    public function response(?array $data = [], string $message = 'success.', bool $success = true, int $status = 200, string $redirect = null): JsonResponse
    {
        /**
         *  Temp data
         *
         *  @var array $data
         */
        $data = [
            'success'   => $success,
            'status'    => $status,
            'message'   => $message,
            'data'      => $data,
            'redirect'  => $redirect,
        ];

        /**
         *  Create
         *
         */
        Log::create([
            'description'   => json_encode($data)
        ]);

        return response()->json($data);
    }
}
