<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\verificationRequest;

class verificationController extends Controller
{
    use ApiResponse;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(verificationRequest $request)
    {
        $user = User::where('user_token', $request->user_token)->first();
        if ($request->pin_code != $user->pin_code)
        {
            return $this->apiResponse(false, "incorrect pin code");
        }
        $user->update([
            'pin_code' => null ,
            'user_token' => null ,
        ]);
        return $this->apiResponse(true, 'Success');
    }
}
