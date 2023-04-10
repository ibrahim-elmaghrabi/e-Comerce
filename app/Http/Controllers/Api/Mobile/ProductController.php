<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductResource;

class ProductController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $products = Product::where(function ($query) use ($request) {
            if ($request->has('category_id')) {
                $query->where('category_id', $request->category_id);
            }
        })->paginate(10);

        return $this->apiResponse(1, "Success", ProductResource::collection($products));
    }

    public function show($id)
    {
        return $this->apiResponse(1, 'Success', new ProductResource(Product::findOrFail($id)));
    }

    public function filter(Request $request)
    {
        $title = $request->input('title');
        $price = $request->input('price');
        $city = $request->input('city_id');

        $products = Product::query();

        if ($title) {
            $products->where('title', 'LIKE', '%' . $title . '%');
        }

        if ($price) {
            $products->where('price', '<=', $price);
        }

        if ($city) {
            $products->where('city_id', $city->id);
        }

        $products = $products->get();

    }


}
