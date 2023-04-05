<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Store;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreRequest;

class StoreController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stores = Store::where(function ($query) use ($request) {
            if ($request->has('name')) {
                $query->where('name', $request->name);
            }
        })->get()->paginate(10);
        return $this->apiResponse(true, "Success", $stores);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $store = Store::create($request->validated() + ['user_id' => auth()->user()->id]);
        if (! $store) {
            return $this->apiResponse(false, "error happened try again");
        }
        return $this->apiResponse(true, "store Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = Store::findOrFail($id);
        return $this->apiResponse(true, "Success", ['store' => $store]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::findOrFail($id);
        return $this->apiResponse(true, "Success", $store);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        $store = Store::findOrFail($id);
        $store->update($request->validated());
        return  $this->apiResponse(true, "Store Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Store::findOrFail($id)->delete();
        return $this->apiResponse(true, "store Deleted Successfully");
    }
}
