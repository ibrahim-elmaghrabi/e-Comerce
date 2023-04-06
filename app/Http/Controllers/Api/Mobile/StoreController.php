<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Models\Store;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\StoreResource;

class StoreController extends Controller
{
    use ApiResponse;

    public function __invoke()
    {
        return $this->apiResponse(1, 'Success', StoreResource(Store::get()));
    }
}
