<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AgencyRequest;
use App\Models\Agency\Agency;
use App\Http\Controllers\BaseAPIController;
use App\Repositories\AgencyRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;



class AgencyController extends BaseAPIController
{

    protected $agencyRepository;

    public function __construct(AgencyRepositoryInterface $agencyRepository) {
        $this->agencyRepository = $agencyRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()  : Response
    {
       
        try {

            $agencies = $this->agencyRepository->all();
            return $this->sendSuccess($agencies, "All Agencies Successfuly Listed", Response::HTTP_CREATED);

        }catch(\Exception $e){
            return $this->sendError($e->getMessage(), "ERROR!", Response::HTTP_BAD_REQUEST);
        }


    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AgencyRequest $request) : Response
    {
        try {

            $agency = $this->agencyRepository->create($request->validated());
            return $this->sendSuccess($agency, "Agency Successfuly Created", Response::HTTP_CREATED);

        }catch(\Exception $e){
            return $this->sendError($e->getMessage(), "ERROR!", Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        try {

            $agency = $this->agencyRepository->find($id);
            return $this->sendSuccess($agency, "Agency Successfuly Listed", Response::HTTP_CREATED);

        }catch(\Exception $e){
            return $this->sendError($e->getMessage(), "ERROR!", Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        try {

            $agency = $this->agencyRepository->update($id, $request->validated());
            return $this->sendSuccess($agency, "Agency Successfuly Updated", Response::HTTP_CREATED);

        }catch(\Exception $e){
            return $this->sendError($e->getMessage(), "ERROR!", Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            
            try {
    
                $agency = $this->agencyRepository->delete($id);
                return $this->sendSuccess($agency, "Agency Successfuly Deleted", Response::HTTP_CREATED);
    
            }catch(\Exception $e){
                return $this->sendError($e->getMessage(), "ERROR!", Response::HTTP_BAD_REQUEST);
            }
    }
}
