@extends('vendor.layouts.master')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Product</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Product</h4>
                    </div>
                    <div class="card-body">
                        <!-- Display success message -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Form to create a new product -->
                        <form action="{{ route('vendor.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Preview</label>
                                <br>
                                <img src="{{asset($product->thumb_image)}}" style="width:200px">
                            </div>

                            <!-- Image upload field -->
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control" name="image">
                                @error('banner')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Product name field -->
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{$product->name}}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="row">
                                <!-- Main category dropdown -->
                                <div class="col-md-4">
                                    <div class="form-group main-category">
                                        <label>Category</label>
                                        <select class="form-control" id="main-category" name="category_id">
                                            <option value="">Select</option>
                                            @foreach ($categories as $category)
                                               <option  value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Subcategory dropdown -->
                                <div class="col-md-4">
                                    <div class="form-group sub-category">
                                        <label>Sub Category</label>
                                        <select class="form-control" id="sub-category" name="sub_category_id">
                                            <option value="">Select</option>
                                        </select>
                                        @error('sub_category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Child category dropdown -->
                                <!-- <div class="col-md-4">
                                    <div class="form-group child-category">
                                        <label>Child Category</label>
                                        <select class="form-control" id="child-category" name="child_category_id">
                                            <option value="">Select</option>
                                        </select>
                                        @error('child_category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div> -->
                            </div>

                            
                            <!-- Product SKU field -->
                            <div class="form-group">
                                <label>SKU</label>
                                <input type="text" class="form-control" name="sku" value="{{$product->sku}}">
                                @error('sku')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                              <!-- Product Stock quantity field -->
                              <div class="form-group">
                                <label>Stock Quantity</label>
                                <input type="text" class="form-control" name="qty" value="{{$product->qty}}">
                                @error('sku')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                              </div>

                               <!-- Product Video Link field -->
                               <!-- <div class="form-group">
                                <label>Video Link</label>
                                <input type="text" class="form-control" name="video_link" value="{{$product->video_link}}">
                                @error('sku')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                               </div> -->

                                <!-- Product short description field -->
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea name="short_description" class="form-control" ></textarea>
                                    @error('sku')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                   </div>

                                    <!-- Product Long description field -->
                                <div class="form-group">
                                    <label>Long Description</label>
                                    <textarea name="long_description" class="form-control summernote" ></textarea>
                                    @error('sku')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                   </div>

                          

                            
                                 <!-- Product Type -->
                             <div class="form-group">
                                <label>Product Type</label>
                                <select class="form-control" name="product_type">
                                    <option value="">Select</option>
                                    <option value="type_selling">Selling</option>
                                    <option value="type_dontion">Donation</option>
                                </select>
                                @error('product_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                              </div>
                           
                             <!-- Product Price field -->
                             <div class="form-group">
                                <label>Price</label>
                                <input type="text" class="form-control" name="price" value="{{$product->price}}">
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Eco Rating Section -->
                            <div class="form-group">
                                <label>Eco Rating</label>
                                <div class="input-group">
                                    <textarea id="eco-rating" name="eco_rating" class="form-control" readonly>{{ $product->eco_rating }}</textarea>
                                    <div class="input-group-append">
                                        <!-- Button to open modal -->
                                        <button type="button" class="btn btn-secondary" disabled>Eco Rating Generated</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Status dropdown -->
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Eco Rating Modal -->
<div class="modal fade" id="ecoRatingModal" tabindex="-1" role="dialog" aria-labelledby="ecoRatingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Calculate Eco Rating</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ecoRatingForm">
                    @csrf

                    <!-- Q1: What is your item? -->
                    <div class="form-group">
                        <label>What is your item?</label>
                        <select id="item" name="item" class="form-control">
                            <option value="">Select</option>
                            <option value="Mobile Phones">Mobile Phones</option>
                            <option value="Laptops">Laptops</option>
                            <option value="Smartwatches">Smartwatches</option>
                            <option value="Refrigerators">Refrigerators</option>
                        </select>
                    </div>

                    <!-- Q2: How old is the item? -->
                    <div class="form-group">
                        <label>How old is the item?</label>
                        <select id="product-age" name="age" class="form-control">
                            <option value="0-3">0-3 years</option>
                            <option value="4-5">4-5 years</option>
                            <option value="6-8">6-8+ years</option>
                        </select>
                    </div>

                    <!-- Q3: Have any parts been replaced? -->
                    <div class="form-group">
                        <label>Have any parts been replaced?</label>
                        <select id="part-replacement" name="parts_replaced" class="form-control">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <!-- Q4: How many parts were replaced? -->
                    <div class="form-group" id="parts-count-group" style="display: none;">
                        <label>If yes, how many parts were replaced?</label>
                        <select id="parts-count" name="parts_count" class="form-control">
                            <option value="1-2">1-2</option>
                            <option value="2-4">2-4</option>
                            <option value="3-6">3-6</option>
                        </select>
                    </div>

                    <!-- Q5: Quality of replaced parts -->
                    <div class="form-group" id="quality-parts-group" style="display: none;">
                        <label>Quality of replaced parts:</label>
                        <select id="quality-parts" name="quality_parts[]" class="form-control" multiple>
                            <option value="Original">Original parts</option>
                            <option value="High">High quality parts</option>
                            <option value="Low">Low quality parts</option>
                        </select>
                    </div>

                    <!-- Q6: Who performed the replacements? -->
                    <div class="form-group" id="replacer-group" style="display: none;">
                        <label>Who performed the replacements?</label>
                        <select id="replacer" name="replacer[]" class="form-control" multiple>
                            <option value="Authorized">Authorized service center</option>
                            <option value="Technician">Professional technician</option>
                            <option value="Self">Self-repaired</option>
                        </select>
                    </div>

                    <!-- Q7: Is the item fully functional? -->
                    <div class="form-group">
                        <label>Is the item fully functional without issues?</label>
                        <select id="functional-status" name="functional_status" class="form-control">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <!-- Q8: Type of performance issues -->
                    <div class="form-group" id="issues-group" style="display: none;">
                        <label>If no, what issues does the item have?</label>
                        <select id="issue-type" name="issue_type" class="form-control">
                            <option value="Minor">Minor issues</option>
                            <option value="Moderate">Moderate issues</option>
                            <option value="Major">Major issues</option>
                        </select>
                    </div>

                    <!-- Q9: Materials used in the item that are recyclable -->
                    <div class="form-group">
                        <label>What materials are recyclable?</label>
                        <select id="recyclable-materials" name="recyclable[]" class="form-control" style="height: 90px;" multiple>
                            <option value="Metals">Metals</option>
                            <option value="Plastics">Plastics</option>
                            <option value="Glass">Glass</option>
                            <option value="Electronics">Electronic Components</option>
                        </select>
                    </div>

                    <!-- Generate Eco Rating Button -->
                    <button type="button" class="btn btn-success" id="generate-eco-rating">Generate Eco Rating</button>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        // On main category change, load subcategories dynamically
        $('#main-category').on('change', function () {
            let id = $(this).val(); // Get the selected main category ID
            console.log("Selected Main Category ID:", id);

            $.ajax({
                method: 'GET',
                url: '{{ route('vendor.product.get-subcategories') }}', // Route for fetching subcategories
                data: { id: id },
                success: function (data) {
                    console.log("Subcategories Data:", data);

                    // Populate the subcategory dropdown
                    $('#sub-category').html('<option value="">Select</option>');
                    $('#child-category').html('<option value="">Select</option>'); // Reset child category
                    $.each(data, function (i, item) {
                        $('#sub-category').append(`<option value="${item.id}">${item.name}</option>`);
                    });
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        });

        // On subcategory change, load child categories dynamically
        $('#sub-category').on('change', function () {
            let id = $(this).val(); // Get the selected subcategory ID
            console.log("Selected Sub Category ID:", id);

            $.ajax({
                method: 'GET',
                url: '{{ route('vendor.product.get-child-categories') }}', // Route for fetching child categories
                data: { id: id },
                success: function (data) {
                    console.log("Child Categories Data:", data);

                    // Populate the child category dropdown
                    $('#child-category').html('<option value="">Select</option>');
                    $.each(data, function (i, item) {
                        $('#child-category').append(`<option value="${item.id}">${item.name}</option>`);
                    });
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        });
    });

    // === Eco Rating AJAX Functionality ===

    $(document).ready(function () {
        // Show or hide fields based on parts replacement answer
        $('#part-replacement').on('change', function () {
        const value = $(this).val(); // Get the selected value
        console.log('Parts replaced:', value); // Debugging

        if (value === 'Yes') {
            console.log('Showing related fields'); // Debugging
            $('#parts-replaced-group').show(); // Show related fields
            $('#quality-parts-group').show();
            $('#replacer-group').show();
        } else {
            console.log('Hiding related fields'); // Debugging
            $('#parts-replaced-group').hide(); // Hide related fields
            $('#quality-parts-group').hide();
            $('#replacer-group').hide();
        }
        });

        // Show or hide issues question based on functionality
        $('#functional-status').on('change', function () {
            const value = $(this).val();
            if (value === 'No') {
                $('#issues-group').show();
            } else {
                $('#issues-group').hide();
            }
        });

        // Handle Generate Eco Rating button click
        $('#generate-eco-rating').on('click', function () {
            // Collect form data for eco rating
            const data = {
                _token: "{{ csrf_token() }}", // Include CSRF token for security
                item: $('#item').val(), // Selected item
                age: $('#product-age').val(), // Product age
                parts_replaced: $('#part-replacement').val(), // Whether parts were replaced
                parts_count: $('#parts-count').val(), // Number of parts replaced
                quality_parts: $('#quality-parts').val(), // Quality of replaced parts
                replacer: $('#replacer').val(), // Who replaced the parts
                functional_status: $('#functional-status').val(), // Whether the product is functional
                issue_type: $('#issue-type').val(), // Type of performance issues
                recyclable: $('#recyclable-materials').val(), // Recyclable materials
            };

            // Log data for debugging purposes
            console.log("Eco Rating Data:", data);

            // Make AJAX request to calculate eco rating
            $.ajax({
                url: "{{ route('vendor.product.calculate-eco-rating') }}", // Backend route
                method: "POST", // Use POST to send form data
                data: data, // Pass collected data
                success: function (response) {
                    console.log("Eco Rating Response:", response);

                    // Populate the textarea with the calculated eco rating
                    $('#eco-rating').val(response.rating);

                    // Close the modal after successful response
                    $('#ecoRatingModal').modal('hide');
                },
                error: function (xhr, status, error) {
                    console.error("Error Generating Eco Rating:", error);
                    alert('An error occurred while generating the eco rating. Please try again.');
                },
            });
        });
    });

    $(document).ready(function () {
    // Handle changes to the product type dropdown
    $('select[name="product_type"]').on('change', function () {
        const productType = $(this).val(); // Get the selected value
        const priceField = $('input[name="price"]'); // Select the price field

        if (productType === 'type_dontion') {
            // Set the price field to read-only and set the value to 0
            priceField.val(0).prop('readonly', true);
        } else {
            // Make the price field editable and clear its value
            priceField.prop('readonly', false).val('');
        }
    });
});

</script>
@endpush
