<?php

namespace App\Http\Controllers;

use App\Constants\Response as ConstantsResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


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
