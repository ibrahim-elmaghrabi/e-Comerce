<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\Api\TokenResource;

class LoginController extends Controller
{
    use ApiResponse;

    public function login(LoginRequest $request)
    {

        $user = User::where('phone', $request['phone'])->first();
        if (!$user || !Hash::check($request['password'], $user->password))
        {
            return $this->apiResponse(false, 'wrong phone or password');
        }
        return $this->apiResponse(true, 'Success', new TokenResource($user)) ;

    }
}
