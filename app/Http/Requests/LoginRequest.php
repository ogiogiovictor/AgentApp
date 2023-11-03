<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseAPIController;
use Symfony\Component\HttpFoundation\Response;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "email" => "required|email",
            "password" => "required"
        ];
    }


    public function authenticate() {

        $baseAPIController = new BaseAPIController();

        $user = User::where("email", $this->email)->first();

        if(!$user){
            return  $baseAPIController->sendError('User does not exits',  "ERROR!", Response::HTTP_BAD_REQUEST); 
        }

        if(Auth::attempt(['email' => $this->email, 'password' => $this->password ])){

            $authUser = Auth::user();
            $success['Authorization'] = $authUser->createToken('Sanctom+Socialite')->plainTextToken;
            $success['user'] = $authUser;
          
            return $baseAPIController->sendSuccess($success, "Authorization Successufully Generated", Response::HTTP_CREATED);
           
        }else {
            return $baseAPIController->sendError("Invalid Login", "Check your credentials and try again ", Response::HTTP_UNAUTHORIZED);
        }

    }


}
