<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    /**
     *  Response
     *
     *  @param bool $success
     *  @param string $message
     *  @param int $status
     *  @param $data
     *  @return JsonResponse
     */
    public function response(bool $success, string $message, int $status, $data = null): JsonResponse
    {
        $response['success'] = $success;
        $response['message'] = $message;
        $response['status'] = $status;
        $response['data'] = $data;
        return response()->json($response, $status);
    }

    /**
     *  Return success response
     *
     *  @param $data
     *  @param string $message
     *  @return JsonResponse
     */
    public function responseSuccess($data, string $message): JsonResponse
    {
        return $this->response(true, $message, 200, $data);
    }

    /**
     *  Return success response
     *
     *  @param string $message
     *  @param int $status
     *  @return JsonResponse
     */
    public function responseError(string $message, int $status = 500): JsonResponse
    {
        return $this->response(false, $message, $status);
    }
}
