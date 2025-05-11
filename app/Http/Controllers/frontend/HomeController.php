<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\CollectionPoint;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Quiz1Result;
use App\Models\QuizScore;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        $sliders = Slider::where('status',1)->orderBy('serial', 'asc')->get();

        $sellingCategory = HomePageSetting::where('key', 'selling_category_section')->first();

        $typeBaseProducts = $this->getTypeBaseProduct();
        $categoryProductSliderSectionOne = HomePageSetting::where('key', 'product_slider_section_one')->first();

        // Get Top Performers for each level
        $topPerformers = $this->getTopPerformersByLevel();

        // Handle search
        if($request->has('search')) {
            $searchQuery = $request->search;
            $typeBaseProducts['type_selling'] = Product::where(function($query) use ($searchQuery) {
                $query->where('name', 'like', '%'.$searchQuery.'%')
                    ->orWhere('short_description', 'like', '%'.$searchQuery.'%')
                    ->orWhere('long_description', 'like', '%'.$searchQuery.'%');
            })
            ->where(['product_type' => 'type_selling', 'is_approved' => 1, 'status' => 1])
            ->orderBy('id', 'DESC')
            ->get();

            $typeBaseProducts['type_dontion'] = Product::where(function($query) use ($searchQuery) {
                $query->where('name', 'like', '%'.$searchQuery.'%')
                    ->orWhere('short_description', 'like', '%'.$searchQuery.'%')
                    ->orWhere('long_description', 'like', '%'.$searchQuery.'%');
            })
            ->where(['product_type' => 'type_dontion', 'is_approved' => 1, 'status' => 1])
            ->orderBy('id', 'DESC')
            ->get();
        }
        
        return view('frontend.home.home', compact(
            'sliders',
            'sellingCategory',
            'typeBaseProducts',
            'topPerformers',
            'categoryProductSliderSectionOne'
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
        $topPerformersForLevel = QuizScore::with('user') // eager load user relation
            ->where('level', $level)
            ->orderByDesc('score')
            ->take(3)
            ->get()
            ->map(function ($result) {
                return [
                    'username' => $result->user->username ?? 'Unknown User', // adjust to 'name' if needed
                    'marks' => $result->score,
                    'level' => $result->level
                ];
            });

        $topPerformers[$level] = $topPerformersForLevel;
    }

    return $topPerformers;
}

}