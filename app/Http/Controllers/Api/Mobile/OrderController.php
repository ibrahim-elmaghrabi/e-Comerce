<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Models\{Size, Product, Color, Address, Setting};
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mobile\OrderRequest;
use App\Http\Resources\Api\OrderResource;

class OrderController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->apiResponse(true, "Success", OrderResource::collection(Order::paginate(10)));
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
        public function store(OrderRequest $request)
        {
            $product = Product::findOrFail($request->product_id);
            $address = Address::findOrFail($request->address_id);
            if ($address->user_id != auth()->user()->id) {
                return  $this->apiResponse(false, 'invalid Address');
            }
            $total = 0;
            $order = auth()->user()->orders()->create(['address_id' => $request->address_id]);
            foreach ($request['items'] as $item) {
                $size = Size::findOrFail($item['size_id']);
                $color = Color::findOrFail($item['color_id']);
                $orderItem = [
                    $item['size_id'] =>[
                            'size_id' =>  $size->id,
                            'color_id' => $color->id,
                            'quantity' => $item['quantity'],
                            'price'    => $size->price,
                    ]
                ];
                $order->products()->attach($orderItem);
                $deliverCharge= Setting::select('delivery_charge')->where('id', 1)->get();
                $total += (($size->price * $item['quantity']) - $deliverCharge);
            }
            if ($product->store->include_vat) {
                $total = ($total * $product->store->vat_percentage);
            }
            $order->update(['total' => $total]);
            return $this->apiResponse(true, "Order Created Successfully");
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return $this->apiResponse(true, "Success", new OrderResource(Order::findOrFail($id)));
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
