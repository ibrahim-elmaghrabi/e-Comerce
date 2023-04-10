<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Traits\ApiResponse;
use App\events\OrderCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OrderResource;
use App\Http\Requests\Api\Mobile\OrderRequest;
use App\Models\{Size, Product, Color, Address, Setting, Store, Coupon};

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
                if ($size->quantity < $item['quantity']) {
                    return $this->apiResponse(false, 'this quantity not available now for '.$size->size.' size');
                }
                $order->products()->attach($orderItem);
                $deliverCharge= Setting::select('delivery_charge')->first();
                $total += (($size->price * $item['quantity']) + $deliverCharge);
                $size->decrement('quantity', $item['quantity']);
            }
            if ($product->store->include_vat) {
                $vat = ($total * $product->store->vat_percentage);
                $total = ($total + $vat);
            }
            if ($request->has('coupon_id')){
                $coupon = Coupon::findOrFail($request->coupon_id);
                if ($coupon->status == "disable") {
                    return $this->apiResponse(false, "this coupon not valid");
                } else {
                    $total = ($total * $coupon->value) ;
                    $coupon->increment('count');
                }
            }
            $order->update(['total' => $total]);
            event(new OrderCreated($order));
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
