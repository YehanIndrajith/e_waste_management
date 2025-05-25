<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class VendorProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductDataTable $dataTable)
    {
        return $dataTable->render('vendor.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('vendor.product.create',compact('categories'));
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
        $product->long_description = strip_tags($request->long_description);
        $product->video_link = $request->video_link ?? null; // Optional field
        $product->sku = $request->sku ?? null; // Optional field
        $product->price = $request->price;
        $product->eco_rating = $request->eco_rating;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = 0;
        $product->save();

        return redirect()->route('vendor.products.index')->with('success', 'Product Created successfully!');

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
        if($product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }

        $categories = Category::all();
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        return view('vendor.product.edit', compact('product','categories','subCategories', 'childCategories'));
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

        if($product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }


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
        $product->long_description = strip_tags($request->long_description);
        $product->video_link = $request->video_link ?? null; // Optional field
        $product->sku = $request->sku ?? null; // Optional field
        $product->price = $request->price;
        $product->eco_rating = $request->eco_rating;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = $product->is_approved;
        $product->save();

        return redirect()->route('vendor.products.index')->with('success', 'Product Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if($product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }
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
    'product' => 'required|string', // Product type
    'age' => 'required|string',   // Age range: 0-2, 2-5, 5-8, 8+
    'parts_replaced' => 'required|string', // Yes/No
    'quality_parts' => 'nullable|string', // Original/High/Low
    'replacer' => 'nullable|string', // Authorized/Technician/Self
    'functionality' => 'required|string', // Yes/No
    'performance_issue' => 'nullable|string', // Minor/Moderate/Major
    'recyclable' => 'nullable|array', // Array of materials
]);

// 1. Age (10 marks)
$ageTable = [
    'Mobile_Phones' => ['0-2' => 10, '2-5' => 7, '5-8' => 4, '8+' => 1],
    'Laptops & tablets' => ['0-2' => 10, '2-5' => 7, '5-8' => 4, '8+' => 1],
    'Refrigerators' => ['0-2' => 10, '2-5' => 8, '5-8' => 6, '8+' => 4],
    'Washing machines' => ['0-2' => 10, '2-5' => 8, '5-8' => 6, '8+' => 4],
    'Microwaves' => ['0-2' => 10, '2-5' => 8, '5-8' => 6, '8+' => 4],
    'Toasters' => ['0-2' => 10, '2-5' => 8, '5-8' => 6, '8+' => 4],
    'Air conditioners' => ['0-2' => 10, '2-5' => 8, '5-8' => 6, '8+' => 4],
    'Blenders' => ['0-2' => 10, '2-5' => 8, '5-8' => 6, '8+' => 4],
    'Vacuum Cleaners' => ['0-2' => 10, '2-5' => 8, '5-8' => 6, '8+' => 4],
    'Rice cookers' => ['0-2' => 10, '2-5' => 8, '5-8' => 6, '8+' => 4],
    'Electric kettles' => ['0-2' => 10, '2-5' => 8, '5-8' => 6, '8+' => 4],
    'Televisions' => ['0-2' => 10, '2-5' => 8, '5-8' => 6, '8+' => 4],
    'DVD players' => ['0-2' => 10, '2-5' => 7, '5-8' => 4, '8+' => 1],
    'Speakers' => ['0-2' => 10, '2-5' => 7, '5-8' => 4, '8+' => 1],
    'Printers' => ['0-2' => 10, '2-5' => 7, '5-8' => 4, '8+' => 1],
    'Scanners' => ['0-2' => 10, '2-5' => 7, '5-8' => 4, '8+' => 1],
    'Projectors' => ['0-2' => 10, '2-5' => 7, '5-8' => 4, '8+' => 1],
    'Fax machines' => ['0-2' => 10, '2-5' => 7, '5-8' => 4, '8+' => 1],
    'Fans' => ['0-2' => 10, '2-5' => 7, '5-8' => 4, '8+' => 1],
];
$ageScore = $ageTable[$request->product][$request->age] ?? 0;

// 2. Part Replacements (10 marks)
$partReplacementScore = 0;
if ($request->parts_replaced === 'No') {
    // No parts replaced: use table by age
    $noReplaceTable = ['0-2' => 10, '2-5' => 10, '5-8' => 8, '8+' => 6];
    $partReplacementScore = $noReplaceTable[$request->age] ?? 0;
} else {
    // Q4: Quality of replaced parts (table by age)
    $qualityTable = [
        '0-2' => ['Original' => 5, 'High' => 4, 'Low' => 2],
        '2-5' => ['Original' => 5, 'High' => 4, 'Low' => 2],
        '5-8' => ['Original' => 4, 'High' => 3, 'Low' => 1],
        '8+'  => ['Original' => 3, 'High' => 2, 'Low' => 1],
    ];
    $qualityScore = $qualityTable[$request->age][$request->quality_parts] ?? 0;

    // Q5: Who performed the replacement
    $whoScore = match ($request->replacer) {
        'Authorized service center' => 5,
        'Professional technician' => 4,
        'Self-repaired' => 3,
        default => 0,
    };
    $partReplacementScore = $qualityScore + $whoScore;
}

// 3. Functionality (10 marks)
$functionalityScore = $request->functionality === 'Yes'
    ? 10
    : match ($request->performance_issue) {
        'Minor' => 7,
        'Moderate' => 4,
        'Major' => 1,
        default => 0,
    };

// 4. Recyclability (10 marks)
$recyclableScores = [
    'Metals' => 3,
    'Plastics' => 1,
    'Glass' => 2,
    'Electronic components' => 4,
];
$recyclabilityScore = 0;
if (is_array($request->recyclable)) {
    foreach ($request->recyclable as $mat) {
        $recyclabilityScore += $recyclableScores[$mat] ?? 0;
    }
}

// 5. Weighted Overall Score
$finalScore = round(
    ($ageScore * 0.4) +
    ($partReplacementScore * 0.3) +
    ($functionalityScore * 0.1) +
    ($recyclabilityScore * 0.2), 1
);

// Badge assignment (new system)
$badge = match (true) {
    $finalScore <= 3 => 'Low (Red Badge)',
    $finalScore <= 7 => 'Medium (Yellow Badge)',
    default => 'High (Green Badge)',
};

return response()->json([
    'rating' => "Score: $finalScore, Badge: $badge",
    'total_score' => $finalScore,
    'badge' => $badge,
]);

}  
    
}
