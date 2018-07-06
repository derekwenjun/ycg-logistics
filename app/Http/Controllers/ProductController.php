<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\Product;

use Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $addresses = Product::get();
        return view('products.index', ['nav' => 'product', 'products' => $addresses, 'uid' => $userId ]);
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;

        // 搜索商品，根据商品名称
        $query = $request->input('query');
        $products = Product::where('name', 'like', '%' . $query . '%')->get();
        foreach($products as $product) {
            $product->category->name;
        }
        return response()->json(['products' => $products]);
    }
}
