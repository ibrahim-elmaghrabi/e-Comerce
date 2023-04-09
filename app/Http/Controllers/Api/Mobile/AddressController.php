<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddressRequest;

class AddressController extends Controller
{
    use ApiResponse;

    public function __invoke(AddressRequest $request)
    {
        Address::create($request->validated()+['user_id' => auth()->user()->id]);
        return $this->apiResponse(true, 'Address created Successfully');
    }

}
