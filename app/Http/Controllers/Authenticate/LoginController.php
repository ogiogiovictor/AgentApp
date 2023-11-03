<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseAPIController;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Models\Ops\OpsUser;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseAPIController
{
    public function login(LoginRequest $request){

        switch($request->user_type){
            case 'agent':
                return $request->authenticate();
            case 'user': // cro, teamlead, admin
                return $this->opsLogin($request);
            default:
              throw new \InvalidArgumentException('Invalid payment type');  
        }
    }


    private function opsLogin($request){

       // return Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        $userState = OpsUser::where("email", $request->email)->value("status");

        if($userState != 1){
           return  $this->sendError("Please visit OPS for user registration",  "ERROR!", Response::HTTP_BAD_REQUEST);   
        }

        //if(Auth::attempt(['email' => $request->email, 'password' => $request->password ])){
        if(Auth::guard('ops')->attempt(['email' => $request->email, 'password' => $request->password ])){
                
            $authUser = Auth::guard('ops')->user();
            //$success['Authorization'] = $authUser->createToken('Sanctom+Socialite')->accessToken;
           $success['Authorization'] =  $authUser->createToken('70k3N')->plainTextToken;


            $success['user'] = $authUser;
           
            return $this->sendSuccess($success, "Authorization Successufully Generated", Response::HTTP_CREATED);
        }else {
            return $this->sendError('Invalid Login', "Check your credentials and try again", Response::HTTP_UNAUTHORIZED);
        }

    }
}


