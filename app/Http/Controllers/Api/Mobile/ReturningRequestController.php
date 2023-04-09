<?php

namespace App\Http\Controllers\Api\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReturningRequestRequest;
use App\Http\Requests\Api\ReturningRequest;
use App\Http\Resources\Api\ReturningRequestResource;

class ReturningRequestController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        dd('fuck');
        $requests = ReturningRequest::where(function ($query) use($request) {
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }
        })->paginate(10);
        return $this->apiResponse(true, "Success", ReturningRequestResource::collection($requests));
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
    public function store(ReturningRequestRequest $request)
    {
        ReturningRequest::create($request->validated()+['user_id' => auth()->user->id]);
        return $this->apiResponse(true, 'Returning request send successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->apiResponse(true, "Success", new ReturningRequestResource( ReturningRequest::findOrFail($id)));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
