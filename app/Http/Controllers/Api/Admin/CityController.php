<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\City;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CityRequest;

class CityController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cities = City::where(function ($query) use ($request) {
            if ($request->has('country-id') ){
                $query->where('country_id', $request->country_id);
            }
        })->paginate(5);
        return $this->apiResponse(true, 'Success', $cities);
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
    public function store(CityRequest $request)
    {
        City::create($request->validated());
        return $this->apiResponse(true, 'city created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::findOrFail($id);
        return $this->apiResponse(true, 'Success', ['city' => $city]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::findOrFail($id);
        return $this->apiResponse(true, "Success", $city);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, $id)
    {
        $city = City::findOrFail($id);
        $city->update($request->validated());
        return $this->apiResponse(true, 'city Updated Successfully', ['city' => $city]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         City::findOrFail($id)->delete();
         return $this->apiResponse(true, "city Deleted successfully");

    }
}
