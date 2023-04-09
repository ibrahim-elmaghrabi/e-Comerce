<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Models\Address;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Mobile\Controller;
use App\Http\Resources\Api\AddressResource;
use App\Http\Requests\Api\Mobile\AddressRequest;

class AddressController extends Controller
{
    use ApiResponse;

    public function store(AddressRequest $request)
    {
        Address::create($request->validated()+['user_id' => auth()->user()->id]);
        return $this->apiResponse(true, 'Address created Successfully');
    }


      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->apiResponse(true, "Success", new AddressResource(Address::findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, $id)
    {
        $address = Address::findOrFail($id);
        $address->update($request->validated());
        return $this->apiResponse(true, "Address Updated Successfully");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Address::findOrFail($id)->delete();
        return $this->apiResponse(true, "Address Deleted successfully");
    }



}
