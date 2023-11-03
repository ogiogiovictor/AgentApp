<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\BaseAPIController;
use Symfony\Component\HttpFoundation\Response;

class RegisterRequest extends FormRequest
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
            "name" => 'required',
            "email" => 'required|email|unique:users,email',
            "user_type" => "required",
            'password' => [
                'required',
                Password::min(8) // Minimum length of 8 characters
                    ->letters() // Must contain at least one letter
                    ->mixedCase() // Must contain both uppercase and lowercase letters
                    ->numbers() // Must contain at least one number
                    ->symbols() // Must contain at least one special character
                    ->uncompromised() // Check if the password has not been compromised in data breaches
            ],
        ];
    }

    public function filters(){
        return [
            'email' => 'trim|escape|lowercase'
        ];
    }

    
    
    
}
