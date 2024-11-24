<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Traits\ImageUploadTrait;

class SliderController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
       
        return $dataTable->render('admin.slider.index'); // Placeholder for your index page
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner' => ['required', 'image', 'max:3000'], // Validate image upload
            'header_1' => ['required', 'string', 'max:200'],
            'header_2' => ['required', 'string', 'max:200'],
            'header_3' => ['nullable', 'string', 'max:200'],
            'btn_url' => ['nullable', 'url'], // Allow null and validate as URL
            'serial' => ['required', 'integer'],
            'status' => ['required', 'boolean'], // Boolean for Active/Inactive
        ]);

        $slider = new Slider();

      
        

        $imagePath = $this->uploadImage($request, 'banner', 'uploads');

        $slider->banner = $imagePath;
        // Save other fields
        $slider->header_1 = $request->header_1;
        $slider->header_2 = $request->header_2;
        $slider->header_3 = $request->header_3;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;

        $slider->save();

        return redirect()->route('admin.slider.index')->with('success', 'Slider created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Future implementation for viewing slider details
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'banner' => ['nullable', 'image', 'max:3000'], // Validate image upload
            'header_1' => ['required', 'string', 'max:200'],
            'header_2' => ['required', 'string', 'max:200'],
            'header_3' => ['nullable', 'string', 'max:200'],
            'btn_url' => ['nullable', 'url'], // Allow null and validate as URL
            'serial' => ['required', 'integer'],
            'status' => ['required', 'boolean'], // Boolean for Active/Inactive
        ]);

        $slider = Slider::findOrFail($id);

        $imagePath = $this->updateImage($request, 'banner', 'uploads', $slider->banner);

        $slider->banner = empty(!$imagePath) ? $imagePath : $slider->banner;
        // Save other fields
        $slider->header_1 = $request->header_1;
        $slider->header_2 = $request->header_2;
        $slider->header_3 = $request->header_3;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;

        $slider->save();

        return redirect()->route('admin.slider.index')->with('success', 'Slider Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $slider = Slider::findOrFail($id);
       $this->deleteImage($slider->banner);
       $slider->delete();

       return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
