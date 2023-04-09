<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mobile\RegisterRequest;

class RegisterController extends Controller
{
    use ApiResponse;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {
       $user = User::create($request->validated());
       $code = rand(1111, 9999);
       $user->pin_code = $code;
       $user->user_token = uniqid();
       $user->save();
       return $this->apiResponse(true, 'success', ['verify_token' => $user->user_token]);
    }
}
