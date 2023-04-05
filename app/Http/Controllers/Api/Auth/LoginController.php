<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\LoginRequest;

class LoginController extends Controller
{
    use ApiResponse;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request)
    {

        $user = User::where('phone', $request['phone'])->first();
        if (!$user || !Hash::check($request['password'], $user->password))
        {
            return $this->apiResponse(false, 'wrong phone or password');
        }
        $token = $user->createToken('UserToken')->plainTextToken;
        return $this->apiResponse(true, 'Success', ['token' => $token]) ;

    }
}
