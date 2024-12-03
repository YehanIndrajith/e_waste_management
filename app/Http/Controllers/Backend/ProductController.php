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

    // Calculate the scores for each question

    // Q2: Age score
    $ageScore = match ($request->age) {
        '0-3' => 10,
        '4-5' => 5,
        '6-8' => 2.5,
        default => 0,
    };

    // Q3/Q4/Q5: Replacement-related scores
    $replacementScore = $request->parts_replaced === 'No' ? 10 : 0;

    // If parts were replaced, calculate based on parts count and quality
    if ($request->parts_replaced === 'Yes') {
        $partsCountScore = match ($request->parts_count) {
            '1-2' => 3,
            '2-4' => 2,
            '3-6' => 1,
            default => 0,
        };

        $qualityPartsScore = collect($request->quality_parts)->sum(fn($quality) => match ($quality) {
            'Original' => 5,
            'High' => 3,
            'Low' => 1,
            default => 0,
        });

        $replacementScore += $partsCountScore + $qualityPartsScore;
    }

    // Q7/Q8: Functionality-related scores
    $functionalScore = $request->functional_status === 'Yes' ? 10 : 0;

    if ($request->functional_status === 'No') {
        $issueScore = match ($request->issue_type) {
            'Minor' => 2,
            'Moderate' => 1,
            'Major' => -5, // Deduct points for major issues
            default => 0,
        };
        $functionalScore += $issueScore;
    }

    // Q9: Recyclable materials score
    $recyclableScore = collect($request->recyclable)->sum(fn($material) => match ($material) {
        'Metals' => 4,
        'Plastics' => 3,
        'Glass' => 2,
        'Electronics' => 1,
        default => 0,
    });

    // Total score calculation
    $totalScore = $ageScore + $replacementScore + $functionalScore + $recyclableScore;

    $totalScore = $totalScore*1.6666;

    // Determine badge based on total score
    $badge = match (true) {
        $totalScore <= 30 => 'Red Badge',
        $totalScore <= 60 => 'Yellow Badge',
        default => 'Green Badge',
    };

    // Return response
    return response()->json([
        'rating' => "Score: $totalScore, Badge: $badge",
        'total_score' => $totalScore,
        'badge' => $badge,
    ]);
}


    

}
