<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use App\Models\AppWideRequest;

class TerminatingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

     /**
     * Handle tasks after the response has been sent to the browser.
     */
    public function terminate(Request $request, Response $response): void
    {

        $user = isset(Auth::user()->id) ? Auth::user()->id : null;

        $getresonseContent = $response->getContent();
        $response = substr($getresonseContent, 0, 4294967295); // Adjust the length (255 in this example) to fit your column size

        //Data points to captures
        $data = [
            'user_id' => $user,
            'ip_address' => $request->ip(),
            'ajax'  =>  $request->ajax(),
            'url'   =>  $request->fullUrl(),
            'method'    =>  $request->method(),
            'user_agent'    =>  $request->userAgent(),
            'payload'   =>  $request->toArray(),
            'status_code'  =>  method_exists($response, 'getStatusCode') ? $response->getStatusCode() : null,
            'response'  => $response,
            
        ];

        AppWideRequest::create($data);
        //Log::info(__METHOD__ . ' - ' . $request->toArray());
    }
}
