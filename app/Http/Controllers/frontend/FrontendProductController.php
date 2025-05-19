<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{
    //show product detail page
public function showProduct(string $slug)
{
    $product = Product::with('vendor')->where('slug', $slug)->where('status', 1)->first();
    return view('frontend.pages.product-detail', compact('product'));
}

// if($request->has('search')){
//     $products = Product::where(function($query) use ($request){
//         $query->where('name', 'like', '%'.$request->search.'%')
//            ->orWhere('long_desciption', 'like', '%'.$request->search.'%' )
//     })->get();
// }


}
