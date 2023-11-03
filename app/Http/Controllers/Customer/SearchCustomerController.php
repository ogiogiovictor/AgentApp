<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Billing\ECMICustomers;
use App\Models\Billing\EMSCustomers;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\BaseAPIController;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SearchCustomerController extends BaseAPIController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
       
       if(!$request->type || !$request->accountNo){
           return  $this->sendError("Important Params Missing",  "ERROR!", Response::HTTP_BAD_REQUEST);  
       }

       switch($request->type){
            case 'Prepaid':
               return $this->prepaidServers($request);
            case 'Postpaid':
               return $this->postpaidServers($request);
            default:
                throw new \InvalidArgumentException('Invalid type');  
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


    private function prepaidServers($request){

       
        try{

            $returnRequest = ECMICustomers::where("MeterNo", $request->accountNo)->firstOrFail();
           
            return $this->sendSuccess($returnRequest, "SUCCESS", Response::HTTP_OK);

        }catch(\Exception $e) {  //DatabaseException
            return  $this->sendError("Customer Record Not Found",  "ERROR!", Response::HTTP_NOT_FOUND);   
        }
       

    }

    private function postpaidServers($request){

        try {
            $returnRequest = EMSCustomers::where("AccountNo", $request->accountNo)->firstOrFail();

            return $this->sendSuccess($returnRequest, "SUCCESS", Response::HTTP_OK);

        }catch(\Exception $e){
            return  $this->sendError("Customer Record Not Found",  "ERROR!", Response::HTTP_NOT_FOUND);   
        }
       

    }


}
