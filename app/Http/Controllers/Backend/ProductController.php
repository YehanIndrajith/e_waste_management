<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\ImageUploadTrait;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class ProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
     {
        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category_id' => ['required'],
            'eco_rating' => ['required'],
            'product_type' => ['required'],
            'price' => ['required', 'numeric'],
            'qty' => ['required', 'integer'],
            'short_description' => ['required', 'max:600'], 
            'long_description' => ['required'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required', 'boolean'],
        ]);
        
        /** Handle the image upload */
          $imagePath = $this->uploadImage($request, 'image', 'uploads');
        
        $product = new Product();
        $product->thumb_image = $imagePath;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category_id; // Corrected field name
        $product->sub_category_id = $request->sub_category_id ?? null;
        $product->child_category_id = $request->child_category_id ?? null;
        $product->brand_id = $request->brand_id ?? null; // Optional field
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link = $request->video_link ?? null; // Optional field
        $product->sku = $request->sku ?? null; // Optional field
        $product->price = $request->price;
        $product->eco_rating = $request->eco_rating;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = 1;
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product Created successfully!');

     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        return view('admin.product.edit', compact('product','categories','subCategories', 'childCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category_id' => ['required'],
            'eco_rating' => ['required'],
            'product_type' => ['required'],
            'price' => ['required', 'numeric'],
            'qty' => ['required', 'integer'],
            'short_description' => ['required', 'max:600'], 
            'long_description' => ['required'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required', 'boolean'],
        ]);
        
        $product = Product::findOrFail($id);
        /** Handle the image upload */
          $imagePath = $this->updateImage($request, 'image', 'uploads', $product->thumb_image);
        
      
        $product->thumb_image = empty(!$imagePath) ? $imagePath : $product->thumb_image;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category_id; // Corrected field name
        $product->sub_category_id = $request->sub_category_id ?? null;
        $product->child_category_id = $request->child_category_id ?? null;
        $product->brand_id = $request->brand_id ?? null; // Optional field
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link = $request->video_link ?? null; // Optional field
        $product->sku = $request->sku ?? null; // Optional field
        $product->price = $request->price;
        $product->eco_rating = $request->eco_rating;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = 1;
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $this->deleteImage($product->thumb_image);
        $product->delete();
 
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function getSubCategories(Request $request)
    {
        $categories = Category::all();

        if ($request->has('id')) {
            $subCategories = SubCategory::where('category_id', $request->id)->get(['id', 'name']);
            return response()->json($subCategories);
        }
        return response()->json([], 400);
    }
    
    public function getChildCategories(Request $request)
    {
        if ($request->has('id')) {
            $childCategories = ChildCategory::where('sub_category_id', $request->id)->get(['id', 'name']);
            return response()->json($childCategories);
        }
        return response()->json([], 400);
    }

    public function calculateEcoRating(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'item' => 'required|string',                 // Q1: What is your item?
            'age' => 'required|string',                  // Q2: How old is the item?
            'parts_replaced' => 'required|string',       // Q3: Have any parts been replaced?
            'parts_count' => 'nullable|string',          // Q4: How many parts were replaced?
            'quality_parts' => 'nullable|array',         // Q5: Quality of replaced parts
            'replacer' => 'nullable|array',              // Q6: Who performed the replacements?
            'functional_status' => 'required|string',    // Q7: Is the item fully functional?
            'issue_type' => 'nullable|string',           // Q8: Type of performance issues
            'recyclable' => 'nullable|array',            // Q9: Recyclable materials
        ]);
    
     // Q2: Age score based on the item type
$ageScores = [
    'Mobile_Phones' => [ '0-3' => 10, '4-5' => 5, '6-8' => 2.5 ],
    'Laptops' => [ '0-3' => 10, '4-5' => 5, '6-8' => 2.5 ],
    'Smartwatches' => [ '0-3' => 10, '4-5' => 5, '6-8' => 2.5 ],
    'Refrigerators' => [ '0-3' => 10, '4-5' => 7.5, '6-8' => 5 ],
    'Washing_Machines' => [ '0-3' => 10, '4-5' => 7.5, '6-8' => 5 ],
    'Microwaves' => [ '0-3' => 10, '4-5' => 7.5, '6-8' => 5 ],
    'Toasters' => [ '0-3' => 10, '4-5' => 7.5, '6-8' => 5 ],
    'Air_Conditioners' => [ '0-3' => 10, '4-5' => 7.5, '6-8' => 5 ],
    'Blenders' => [ '0-3' => 10, '4-5' => 7.5, '6-8' => 5 ],
    'Vacuum_Cleaners' => [ '0-3' => 10, '4-5' => 7.5, '6-8' => 5 ],
    'Rice_Cookers' => [ '0-3' => 10, '4-5' => 7.5, '6-8' => 5 ],
    'Electric_Kettles' => [ '0-3' => 10, '4-5' => 7.5, '6-8' => 5 ],
    'Televisions' => [ '0-3' => 10, '4-5' => 7.5, '6-8' => 5 ],
    'DVD_Blu_ray_Players' => [ '0-3' => 10, '4-5' => 5, '6-8' => 2.5 ],
    'Speakers' => [ '0-3' => 10, '4-5' => 5, '6-8' => 2.5 ],
    'Printers' => [ '0-3' => 10, '4-5' => 5, '6-8' => 2.5 ],
    'Scanners' => [ '0-3' => 10, '4-5' => 5, '6-8' => 2.5 ],
    'Projectors' => [ '0-3' => 10, '4-5' => 5, '6-8' => 2.5 ],
    'Fax_Machines' => [ '0-3' => 10, '4-5' => 5, '6-8' => 2.5 ],
    'Fans' => [ '0-3' => 10, '4-5' => 7.5, '6-8' => 5 ],
    'Hair_Dryers' => [ '0-3' => 10, '4-5' => 7.5, '6-8' => 5 ],
    'Electric_Shavers' => [ '0-3' => 10, '4-5' => 7.5, '6-8' => 5 ],
    'Electric_Clocks' => [ '0-3' => 10, '4-5' => 7.5, '6-8' => 5 ],
    'Dash_Cameras' => [ '0-3' => 10, '4-5' => 7.5, '6-8' => 5 ],
    'Car_Audio_Systems' => [ '0-3' => 10, '4-5' => 7.5, '6-8' => 5 ],
    'Headphones' => [ '0-3' => 10, '4-5' => 5, '6-8' => 2.5 ],
    'Portable_Chargers' => [ '0-3' => 10, '4-5' => 5, '6-8' => 2.5 ],
];

    
        $ageScore = $ageScores[$request->item][$request->age] ?? 0;
    
        // Parts replaced (Q3-Q6)
        $replacementScore = 0;
        if ($request->parts_replaced === 'No') {
            $replacementScore += 10; // No parts replaced
        } else {
            // Q4: How many parts replaced
            $partsCountScores = ['1-2' => 3, '2-4' => 2, '3-6' => 1];
            $partsCountScore = $partsCountScores[$request->parts_count] ?? 0;
    
            // Q5: Quality of replaced parts
            $qualityPartsScores = ['Original' => 5, 'High' => 3, 'Low' => 2];
            $qualityPartsScore = collect($request->quality_parts)->sum(fn($quality) => $qualityPartsScores[$quality] ?? 0);
    
            // Q6: Who performed replacements
            $replacerScores = ['Authorized' => 5, 'Technician' => 3, 'Self' => 2];
            $replacerScore = collect($request->replacer)->sum(fn($replacer) => $replacerScores[$replacer] ?? 0);
    
            $replacementScore += $partsCountScore + $qualityPartsScore + $replacerScore;
        }
    
        // Functional Status (Q7-Q8)
        $functionalScore = 0;
        if ($request->functional_status === 'Yes') {
            $functionalScore += 10; // Fully functional
        } else {
            // Q8: Type of performance issues
            $issueScores = ['Minor' => 7, 'Moderate' => 4, 'Major' => 1];
            $issueScore = $issueScores[$request->issue_type] ?? 0;
            $functionalScore += $issueScore;
        }
    
        // Recyclable materials (Q9)
        $recyclableScores = [
            'Metals' => 4,
            'Plastics' => 3,
            'Glass' => 2,
            'Electronics' => 1,
        ];
        $recyclableScore = collect($request->recyclable)->sum(fn($material) => $recyclableScores[$material] ?? 0);
    
        // Total score
        $totalScore = $ageScore + $replacementScore + $functionalScore + $recyclableScore;
    
        // Normalize the score to 100
        $normalizedScore = ($totalScore / 60) * 100;
    
        // Badge assignment
        $badge = match (true) {
            $normalizedScore <= 30 => 'Low (Red Badge)',
            $normalizedScore <= 60 => 'Medium (Yellow Badge)',
            default => 'High (Green Badge)',
        };
    
        // Return JSON response
        return response()->json([
            'rating' => "Score: $normalizedScore, Badge: $badge",
            'total_score' => $normalizedScore,
            'badge' => $badge,
        ]);
    }
    


    

}
