<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $sliders = Slider::where('status',1)->orderBy('serial', 'asc')->get();

        $sellingCategory = HomePageSetting::where('key', 'selling_category_section')->first();

        $typeBaseProducts = $this->getTypeBaseProduct();
        
        return view('frontend.home.home', compact(
            'sliders',
            'sellingCategory',
            'typeBaseProducts'
        ));
    }

   public function getTypeBaseProduct()
   {
    $typeBaseProducts = [];

    $typeBaseProducts['type_selling'] = Product::where(['product_type' => 'type_selling', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->get();

    $typeBaseProducts['type_dontion'] = Product::where(['product_type' => 'type_dontion', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->get();

    return $typeBaseProducts;
   }
}
