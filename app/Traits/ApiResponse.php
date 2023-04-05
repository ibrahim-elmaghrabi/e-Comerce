<?php


namespace App\Traits;


trait ApiResponse
{
    function apiResponse(bool $status, string $message, mixed $data = null)
    {

        $response = [
            'status' => $status,
            'message'=> $message,
            'data'   => $data,
        ];

        return response()->json($response);
    }

}
