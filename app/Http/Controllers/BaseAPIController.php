<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseAPIController extends Controller
{
    public function sendSuccess($data, $message="", $responseCode){
        return response()->json([
            'data' => $data,
            'message' => $message,
            'success' => true,
        ], $responseCode);

    }

    public function sendError($error, $message = [], $responseCode){
        $response = [
            'error' => 'ERROR!',
            'message' => $rror,
            'success' => false,
        ];

        if(!empty($message)){
            $response['data'] = $message;
        }

        return response()->json($response, $responseCode);
    }
}
