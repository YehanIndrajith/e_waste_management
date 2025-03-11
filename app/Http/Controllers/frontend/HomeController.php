<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\CollectionPoint;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Quiz1Result;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $sliders = Slider::where('status',1)->orderBy('serial', 'asc')->get();

        $sellingCategory = HomePageSetting::where('key', 'selling_category_section')->first();

        $typeBaseProducts = $this->getTypeBaseProduct();

        // Get Top Performers for each level
        $topPerformers = $this->getTopPerformersByLevel();
        
        return view('frontend.home.home', compact(
            'sliders',
            'sellingCategory',
            'typeBaseProducts',
            'topPerformers'
        ));
    }

   public function getTypeBaseProduct()
   {
    $typeBaseProducts = [];

    $typeBaseProducts['type_selling'] = Product::where(['product_type' => 'type_selling', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->get();

    $typeBaseProducts['type_dontion'] = Product::where(['product_type' => 'type_dontion', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->get();

    return $typeBaseProducts;
   }

   private function getTopPerformersByLevel()
   {
       $levels = ['beginner', 'intermediate', 'pro'];
       $topPerformers = [];

       foreach ($levels as $level) {
           $topPerformersForLevel = Quiz1Result::where('level', $level)
               ->orderBy('marks', 'desc')
               ->take(3)
               ->get()
               ->map(function ($result) {
                   return [
                       'username' => $result->username,
                       'marks' => $result->marks,
                       'level' => $result->level
                   ];
               });

           $topPerformers[$level] = $topPerformersForLevel;
       }

       return $topPerformers;
   }
}