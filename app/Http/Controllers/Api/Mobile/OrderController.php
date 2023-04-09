<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Models\Order;
use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequest;
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
        return $this->apiResponse('true', "Success", OrderResource::collection(Order::where('user_id', auth()->user()->id)->paginate(10)));
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
     //   $order = auth()->user()->orders()->create($request->validated());
       // $product = Product::findOrFail($request['product_id']);
    $user = auth()->user();
    $product = Product::findOrFail($request['product_id']);

    // Create the order
    $order = new Order(['user_id' => $user->id, 'address_id' => $request->address_id]);
    $order = $product->orders()->save($order);

    // Create the order items
    foreach ($request['items'] as $itemData) {
        $size = Size::findOrFail($itemData['size_id']);
        $color = Color::findOrFail($itemData['color_id']);

        if ($size->product_id != $product->id || !$size->colors->contains($color)) {
            return response()->json(['message' => 'Invalid size or color for this product.'], 422);
        }

        if ($size->getColorQuantity($color) < $itemData['quantity']) {
            return response()->json(['message' => 'Not enough stock for this size and color.'], 422);
        }

        $orderItem = new OrderItem([
            'size_id' => $size->id,
            'price'  => $size->price,
            'color_id' => $color->id,
            'quantity' => $itemData['quantity'],
        ]);
        $order->items()->save($orderItem);
        $total = $size->price * $itemData['quantity'];

        $size->decrementColorQuantity($color, $itemData['quantity']);
    }
    $order->update(['total' => $total]);

    return response()->json([
        'message' => 'Order placed successfully.',
        'order' => $order,
    ], 201);


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
        return $this->apiResponse(true, "Success", new OrderResource(Order::findOrFail($id)));

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
