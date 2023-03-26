<?php

namespace App\Traits;

use App\Constants\Response as ConstantsResponse;

trait HandleResponse
{

    public function successResponse($message, $data = null, $statusCode = ConstantsResponse::HTTP_SUCCESS)
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if ($data)
            $response['data'] = $data;

        return response()->json($response, $statusCode);
    }

    public function errorResponse($message, $errorMessages = [], $statusCode = ConstantsResponse::HTTP_BAD_REQUEST)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];


        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }


        return response()->json($response, $statusCode);
    }
}
