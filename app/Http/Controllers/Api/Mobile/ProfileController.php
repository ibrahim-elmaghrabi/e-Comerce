<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\ProfileRequest;
use App\Http\Resources\Api\ProfileResource;
use App\Http\Requests\Api\ChangePasswordRequest;

class ProfileController extends Controller
{
    use ApiResponse;

    public function profile()
    {
        return $this->apiResponse(true, "Success",new ProfileResource(auth()->user()));
    }

    public function editProfile()
    {
        return $this->apiResponse(true, "Success", new ProfileResource(auth()->user()));
    }

    public function updateProfile(ProfileRequest $request)
    {
         auth()->user()->update($request->validated());
        return $this->apiResponse(true, "Profile Updated Successfully");
    }

    public function ChangePassword(ChangePasswordRequest $request)
    {
        if(! Hash::check($request->password , auth()->user()->password)) {
            return $this->apiResponse(false, 'incorrect Password');
        }
        auth()->user()->update([
            'password' => $request->new_password
        ]);
        auth()->user()->currentAccessToken()->delete();
        return $this->apiResponse(true, 'password Updated Successfully , please login');
    }

}
