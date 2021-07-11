<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Specification;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function getProducts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'offset' => 'required|int|min:0',
            'limit' => 'required|int',
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->messages()]);
        }

        $products = Product::select('id', 'name', 'price', 'price_old', 'saving', 'small_image', 'image', 'big_image', 'gift_url', 'rating', 'votes', 'shock', 'top')->with('specifications');

        $productsCount = $products->count();

        $products = $products->limit($request->get("limit"))
            ->offset($request->get("offset"))
            ->orderBy("created_at", "DESC")
            ->get();

        return response()->json(['success' => true, 'products' => $products, 'count' => $productsCount], 200);
    }
}
