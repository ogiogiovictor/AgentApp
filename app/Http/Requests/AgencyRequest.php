<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgencyRequest extends FormRequest
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
            "ceo_email" => 'required|email|unique:agency,email',
            "ceo_name" => "required",
            "ceo_phone" => "required",
            "no_sub_agents" => "required",
        ];
    }

    /**
         * Get the error messages for the defined validation rules.
         *
         * @return array<string, string>
         */
    public function messages(): array
        {
            return [
                'ceo_email.required' => 'CEO Email is required',
                'no_sub_agents.required' => 'Please enter the number of sub_agents allowed for this agency',
            ];
        }
}
