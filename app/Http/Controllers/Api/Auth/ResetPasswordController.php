<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mobile\ResetPasswordRequest;
use App\Http\Requests\Api\Mobile\SetNewPasswordRequest;

class ResetPasswordController extends Controller
{
    use ApiResponse ;
    public function forgetPassword(ResetPasswordRequest $request)
    {
        $user = User::where('phone', $request->phone)->first();
        if (! $user) {
            return $this->apiResponse(false, "phone not found");
        }
        $code = rand(1111, 9999);
        $user->pin_code = $code;
        $user->user_token = uniqid();
        $user->save();
        return $this->apiResponse(true, "please chesck your device", ['verify_token' => $user->user_token]);
    }

    public function verfiyUser(ResetPasswordRequest $request)
    {
        $user = User::where('user_token', $request->user_token)->first();
        if ($request->pin_code != $user->pin_code)
        {
            return $this->apiResponse(false, "incorrect pin code");
        }
        $user->update([
            'pin_code' => null ,
            'user_token' => uniqid(),
        ]);
        return $this->apiResponse(true, 'Success', ['verify_token' => $user->user_token]);
    }

    public function setNewPassword(SetNewPasswordRequest $request)
    {
        $user = User::where('user_token', $request->user_token)->where('user_token', '!=', null)->first();
        if (! $user)
        {
            return $this->apiResponse(false, "user not found");
        }
        $user->update([
            'password' => $request->password,
            'user_token' => null,
        ]);
        return $this->apiResponse(true, "password Changed successfully, go to login");

    }
}
