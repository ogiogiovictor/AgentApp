<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\SearchCustomerController;
use App\Http\Controllers\Payment\Paymentcontroller;

/************************************* IBEDC ALTERNATE PAYMENT SYSTEM **************************************************/
Route::group(['prefix' => 'V1_AWMXS4dnsY_USearchCompCustomer', 'name' => 'Api\v1'], function () {

    Route::apiResource('search_customer', SearchCustomerController::class)->except('edit');
    

});


Route::group(['prefix' => 'Customer_XMA_Payment', 'name' => 'Api\v1'], function () {

    Route::apiResource('make_payment', Paymentcontroller::class)->except('edit');
   
    

});