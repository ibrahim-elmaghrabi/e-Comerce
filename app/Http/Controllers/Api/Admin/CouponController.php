<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Coupon;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CouponRequest;
use App\Http\Resources\Api\CouponResource;

class CouponController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return $this->apiResponse(true, "Success", CouponResource::collection(Coupon::with('store')->paginate(5)));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        Coupon::create($request->validated());
        return $this->apiResponse(true, "Coupon Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->ApiResponse(true, "Success", new CouponResource(Coupon::with('store')->findOrFail($id)));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->apiResponse(true, "Success", new CouponResource(Coupon::findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update($request->validated());
        return $this->apiResponse(true, "Coupon Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Coupon::findOrFail($id)->delete();
        return $this->apiResponse(true, "Coupon Deleted successfully");
    }
}
