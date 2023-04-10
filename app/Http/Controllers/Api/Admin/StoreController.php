<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Store;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Api\StoreResource;
use App\Http\Requests\Api\Admin\StoreRequest;

class StoreController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->apiResponse(true, "Success", StoreResource::collection(Store::with('user')
        ->withCount('products')->paginate(5)));
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
    public function store(StoreRequest $request)
    {
        $request->image = $request->file('image')->store('stores', 'public');
        Store::create($request->validated()+['user_id' => auth()->user()->id]);
        return $this->apiResponse(true, "Store Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->ApiResponse(true, "Success", new StoreResource(Store::with('user')
        ->withCount('products')->findOrFail($id)));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->apiResponse(true, "Success", new StoreResource(Store::findOrFail($id)));
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
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($store->image);
            $request->image = $request->file('image')->store('stores', 'public');
        }
        $store->update($request->validated());
        return $this->apiResponse(true, "Store Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Store::findOrFail($id);
        Storage::disk('public')->delete($store->image);
        $store->delete();
        return $this->apiResponse(true, "Store Deleted successfully");
    }
}
