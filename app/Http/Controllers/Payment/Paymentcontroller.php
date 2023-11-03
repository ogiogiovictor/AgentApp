<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\BaseAPIController;
use App\Http\Requests\PaymentRquest;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Paymentcontroller extends BaseAPIController
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRquest $request)
    {
       $uuid = str_replace("-", "", Str::uuid()->toString());
       $randomNum = "145-".substr($uuid, 0, 10).Carbon::now()->format('His');

       $data = [
            "tx_ref" => strtoUpper($randomNum),
             "amount" => $request->amount,
             "currency" =>  "NGN",
            "redirect_url" => "https://appengine.ibedc.com:7443/catch_response",
            "meta" => [
                "consumer_id" => 23,
                "consumer_mac" => $uuid,
            ],
            "customer" => [
                "email" => $request->email,
                "phonenumber" => $request->phone_number,
                "name" => "Yemi Desola"
            ],
            "customizations" => [
                "title" => "IBEDC Payments",
                "logo" => "https://media.premiumtimesng.com/wp-content/files/2021/03/IBEDC-Logo.png"
            ]
        ];

        try {
            $response = Http::withHeaders([
                "Authorization" => "Bearer " . env('TEST_FLW_SECRET_KEY') // Use env() function to fetch environment variable
            ])->post('https://api.flutterwave.com/v3/payments', $data);
        
            // Handle the response as needed
            return $responseData = $response->json();

            // For example, you can get the response body with $response->body() or check $response->status() for the HTTP status code
        } catch (\Exception $e) {
            // Handle exceptions, e.g., log the error or return an error response
            // You can access the exception message with $e->getMessage()
        }

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function catchResponse(Request $request)
    {

        $status = $request->input('status');
        $txRef = $request->input('tx_ref');
        $transactionId = $request->input('transaction_id');

        \Log::info("Success: ". json_encode($request));
        return $this->sendSuccess($txRef, "SUCCESS", Response::HTTP_OK);
    }
}
