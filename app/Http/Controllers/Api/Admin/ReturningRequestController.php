<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\ReturningRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReturningRequestRequest;
use App\Http\Resources\Api\ReturningRequestResource;

class ReturningRequestController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->apiResponse(true, "Success", ReturningRequestResource::collection(ReturningRequest::with('user','product')
        ->where('user_id', auth()->user()->id)->paginate(5)));
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
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->apiResponse(true, 'Success', new ReturningRequestResource(ReturningRequest::with('user', 'product')->findOrFail($id)));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->apiResponse(true, "Success", new ReturningRequestResource(ReturningRequest::findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReturningRequestRequest $request, $id)
    {
        $returningRequest = ReturningRequest::findOrFail($id);
        $returningRequest->update($request->validated());
        return $this->apiResponse(true, "ReturningRequest Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ReturningRequest::findOrFail($id)->delete();
        return $this->apiResponse(true, 'ReturningRequest Deleted Successfully');
    }
}
