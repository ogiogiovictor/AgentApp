<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\BaseAPIController;

class RegisterController extends BaseAPIController
{
    public function register(RegisterRequest $request){
        return $request;
    }
}
