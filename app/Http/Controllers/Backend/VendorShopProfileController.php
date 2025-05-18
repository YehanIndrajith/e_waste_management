<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorShopProfileController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Vendor::where('user_id', Auth::user()->id)->first();
        if (!$profile) {
            // If no profile, show the create form
            return view('vendor.shop-profile.create');
        }
        return view('vendor.shop-profile.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.shop-profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner' => ['nullable','image', 'max:3000'],
            'shop_name' => ['required', 'max:200'],
            'phone' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:200'],
            'address' => ['required'],
            'description' => ['required'],
        ]);

        $vendor = Vendor::where('user_id', Auth::user()->id)->first();
        if (!$vendor) {
            $vendor = new Vendor();
            $vendor->user_id = Auth::user()->id;
        }
        $bannerPath = $this->uploadImage($request, 'banner', 'uploads');
        $vendor->banner = $bannerPath;
        $vendor->phone = $request->phone;
        $vendor->shop_name = $request->shop_name;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        $vendor->description = $request->description;
        $vendor->save();

        return redirect()->route('vendor.shop-profile.index')->with('success', 'Vendor Shop Profile Saved successfully!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
