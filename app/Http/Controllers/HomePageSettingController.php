<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HomePageSetting;
use Illuminate\Http\Request;

class HomePageSettingController extends Controller
{
    public function index(){

        $categories = Category::where('status',1 )->get(); 
        $sellingCategorySection = HomePageSetting::where('key', 'selling_category_section')->first();
        $sliderSectionOne = HomePageSetting::where('key', 'product_slider_section_one')->first();
        return view('admin.home-page-setting.index', compact('categories','sellingCategorySection', 'sliderSectionOne'));
    }

    public function updateSellingCategorySection(Request $request){
    //    dd($request->all());

    $data = [
        [
            'category' => $request->cat_one,
            'sub_category' => $request->sub_cat_one,
            'child_category' => $request->child_cat_one,
        ],
        [
            'category' => $request->cat_two,
            'sub_category' => $request->sub_cat_two,
            'child_category' => $request->child_cat_two,
        ],
        [
            'category' => $request->cat_three,
            'sub_category' => $request->sub_cat_three,
            'child_category' => $request->child_cat_three,
        ],
        [
            'category' => $request->cat_four,
            'sub_category' => $request->sub_cat_four,
            'child_category' => $request->child_cat_four,
        ],
        
    ];

   HomePageSetting::updateOrCreate(
    [
        'key' => 'selling_category_section'
    ],
    [
        'value' => json_encode($data)
    ]
    );

    toastr('Updated Successfully!','success');

    return redirect()->back();

    }

    public function updateProductSliderSectionOne(Request $request){
     
        $data = [
                'category' => $request->cat_one,
                'sub_category' => $request->sub_cat_one,
                'child_category' => $request->child_cat_one,
        ];
           
            
    
    
       HomePageSetting::updateOrCreate(
        [
            'key' => 'product_slider_section_one'
        ],
        [
            'value' => json_encode($data)
        ]
        );
    
        toastr('Updated Successfully!','success');
    
        return redirect()->back();
    }
}
