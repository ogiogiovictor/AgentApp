<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\BaseAPIController;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Hash;

class RegisterController extends BaseAPIController
{
    public function register(RegisterRequest $request){
        
        switch($request->user_type){
            case 'agent':
                return $this->createUser($request);
            case 'user':
                return BaseAPIController::sendError("Please visit OPS for user registration",  "ERROR!", Response::HTTP_BAD_REQUEST); 
            default:
              throw new \InvalidArgumentException('Invalid payment type');  
        }
    }


    private function createUser($request){
        $registerUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  $request->password, //Hash::make('default'), //Must change password on first login
            'user_type' => $request->user_type,
        ]);

        return BaseAPIController::sendSuccess($registerUser,  "SUCCESS", Response::HTTP_OK); 
    }
}
