<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AppWide\appAuthorization;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StateAppWide
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedIPs = appAuthorization::pluck('ip_address')->toArray();
        $clientIP = $request->ip();

        if (!empty($_SERVER['SERVER_ADDR'])) {
            $serverIP = $_SERVER['SERVER_ADDR'];
        } else {
            $serverIP = 'unknown';
        }
    
        // if (!in_array($clientIP, $allowedIPs)) {
        //     return $this->getResponse(401, 'Host IP Not Allowed ' . $_SERVER['HTTP_HOST'] . " -request- " . $clientIP . " serverip- " . $serverIP);
        // }

        $appSecret = $request->header('app-secret');
        $appToken = $request->header('app-token');

        if (empty($appSecret) || empty($appToken)) {
            return $this->getResponse(403, 'Required Parameters to process page missing ' . $appSecret);
        }

        try {
            $matches = ['app_secret' => $appSecret, 'app_token' => $appToken, 'status' => 'on'];
            $checkRequest = appAuthorization::where($matches)->exists();

            if ($checkRequest) {
                return $next($request);
            } else {
                return $this->getResponse(402, 'Invalid Header Information');
            }
        } catch (ModelNotFoundException $exception) {
            return $this->getResponse(402, 'Bad request, your token may have expired');
        }
    }


    private function getResponse($statusCode, $message)
    {
        return response()->json([
            'status' => $statusCode,
            'message' => $message,
            'success' => false,
        ], Response::HTTP_BAD_REQUEST);
    }
}
