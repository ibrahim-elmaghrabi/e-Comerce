<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Api\TokenResource;
use App\Http\Requests\Api\AdminLoginRequest;

class LoginController extends Controller
{
    use ApiResponse;

    public function login(AdminLoginRequest $request)
    {

        $user = User::where('email', $request['email'])->first();
        if (!$user || !Hash::check($request['password'], $user->password)) {
            return $this->apiResponse(false, 'wrong email or password');
        }
        return $this->apiResponse(true, 'Success', new TokenResource($user)) ;
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->apiResponse(1, 'Logged out Successfully');
    }
}
