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
                        <h4>Create Product</h4>
                    </div>
                    <div class="card-body">
                        <!-- Display success message -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Form to create a new product -->
                        <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

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
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
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
                                               <option value="{{ $category->id }}">{{ $category->name }}</option>
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

                            </div>

                            
                            <!-- Product SKU field -->
                            <!-- <div class="form-group">
                                <label>SKU</label>
                                <input type="text" class="form-control" name="sku" value="{{ old('sku') }}">
                                @error('sku')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div> -->

                              <!-- Product Stock quantity field -->
                              <div class="form-group">
                                <label>Stock Quantity</label>
                                <input type="text" class="form-control" name="qty" value="{{ old('qty') }}">
                                @error('sku')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                              </div>

                               <!-- Product Video Link field -->

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
                                <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Eco Rating Section -->
                            <div class="form-group">
                                <label>Eco Rating</label>
                                <div class="input-group">
                                    <textarea id="eco-rating" name="eco_rating" class="form-control" readonly></textarea>
                                    <div class="input-group-append">
                                        <!-- Button to open modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ecoRatingModal">Get Your Eco Rating</button>
                                    </div>
                                </div>
                                <!-- Warning message for low eco rating -->
                                <div id="low-rating-warning" class="alert alert-danger mt-2" style="display: none;">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Your item received a low score, indicating that it may no longer be suitable for continued use. 
                                    We recommend not listing this item for sale. Instead, consider recycling it to minimize environmental impact. 
                                    You can find the nearest recycling center using this platform.
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
                            <button type="submit" class="btn btn-primary">Create</button>
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

                    <!-- Q1: Product Type -->
                    <div class="form-group">
                        <label>What is your item?</label>
                        <select id="product" name="product" class="form-control">
                            <option value="">Select</option>
                            <option value="Mobile_Phones">Mobile Phones</option>
                            <option value="Laptops & tablets">Laptops</option>
                            <option value="Refrigerators">Refrigerators</option>
                            <option value="Washing machines">Washing Machines</option>
                            <option value="Microwaves">Microwaves</option>
                            <option value="Toasters">Toasters</option>
                            <option value="'Air conditioners">Air Conditioners</option>
                            <option value="Blenders">Blenders</option>
                            <option value="Vacuum Cleaners">Vacuum Cleaners</option>
                            <option value="Rice cookers">Rice Cookers</option>
                            <option value="Electric kettles">Electric Kettles</option>
                            <option value="Televisions">Televisions</option>
                            <option value="DVD players">DVD/Blu-ray Players</option>
                            <option value="Speakers">Speakers</option>
                            <option value="Printers">Printers</option>
                            <option value="Scanners">Scanners</option>
                            <option value="Projectors">Projectors</option>
                            <option value="Fax machines">Fax Machines</option>
                            <option value="Fans">Fans</option>
<!-- 
                            <option value="HairDryers">Hair Dryers</option>
                            <option value="ElectricShavers">Electric Shavers</option>
                            <option value="Clocks">Clocks (Smart Clocks, Alarm Clocks)</option>
                            <option value="DashCameras">Dash Cameras</option>
                            <option value="CarAudioSystems">Car Audio Systems</option> -->
                            <!-- Add other product types here -->
                        </select>
                    </div>

                    <!-- Q2: Age of the Product -->
                    <div class="form-group">
                        <label>How old is the item?</label>
                        <select id="age" name="age" class="form-control">
                            <option value="0-2">0-2 years</option>
                            <option value="2-5">2-5 years</option>
                            <option value="5-8">5-8 years</option>
                            <option value="8+">8+ years</option>
                        </select>
                    </div>

                    <!-- Q3: Parts Replacement -->
                    <div class="form-group">
                        <label>Have any parts been replaced?</label>
                        <select id="parts_replaced" name="parts_replaced" class="form-control">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <!-- Q4 and Q5: Replacement Details -->
                    <div class="form-group" id="replacement-details" style="display: none;">
                        <label>Quality of replaced parts</label>
                        <select id="quality_parts" name="quality_parts" class="form-control">
                            <option value="Original">Original</option>
                            <option value="High">High Quality</option>
                            <option value="Low">Low Quality</option>
                        </select>
                        <label>Who performed the replacements?</label>
                        <select id="replacer" name="replacer" class="form-control">
                            <option value="Authorized service center">Authorized service center</option>
                            <option value="Professional technician">Professional technician</option>
                            <option value="Self-repaired">Self-repaired</option>
                        </select>
                    </div>

                    <!-- Q6: Functionality -->
                    <div class="form-group">
                        <label>Is the item fully functional?</label>
                        <select id="functionality" name="functionality" class="form-control">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <!-- Q7: Performance Issues -->
                    <div class="form-group" id="performance-issues" style="display: none;">
                        <label>What issues does the product have?</label>
                        <select id="performance_issue" name="performance_issue" class="form-control">
                            <option value="Minor">Minor</option>
                            <option value="Moderate">Moderate</option>
                            <option value="Major">Major</option>
                        </select>
                    </div>

                    <!-- Q8: Recyclable Materials -->
                    <div class="form-group">
                        <label>Recyclable Materials</label>
                        <select id="recyclable" name="recyclable[]" class="form-control" style="height: 90px;" multiple>
                            <option value="Metals">Metals</option>
                            <option value="Plastics">Plastics</option>
                            <option value="Glass">Glass</option>
                            <option value="Electronic components">Electronic components</option>
                        </select>
                    </div>

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

        // ✅ 1. Subcategory to Product Name Mapping
        const subcategoryToProductMap = {
            13: 'Mobile_Phones',
            16: 'Laptops & tablets',
            17: 'Printers',
            18: 'Mobile_Phones',
            19: 'Printers',
            22: 'Laptops & tablets',
            23: 'Refrigerators',
            24: 'Washing machines',
            25: 'Microwaves',
            26: 'Toasters',
            27: 'Air conditioners',
            28: 'Blenders',
            29: 'Vacuum Cleaners',
            30: 'Rice cookers',
            31: 'Electric kettles',
            32: 'Televisions',
            33: 'DVD players',
            34: 'Speakers',
            35: 'Scanners',
            36: 'Projectors',
            37: 'Fax machines',
            38: 'Fans',
            39: 'Refrigerators',
            40: 'Washing machines',
            41: 'Microwaves',
            42: 'Toasters',
            43: 'Air conditioners',
            44: 'Blenders',
            45: 'Vacuum Cleaners',
            46: 'Rice cookers',
            47: 'Electric kettles',
            48: 'Televisions',
            49: 'DVD players',
            50: 'Speakers',
            51: 'Scanners',
            52: 'Projectors',
            53: 'Fax machines',
            54: 'Fans'
        };

        // ✅ 2. Load subcategories when category changes
        $('#main-category').on('change', function () {
            let id = $(this).val();
            $.ajax({
                method: 'GET',
                url: '{{ route('vendor.product.get-subcategories') }}',
                data: { id: id },
                success: function (data) {
                    $('#sub-category').html('<option value="">Select</option>');
                    $.each(data, function (i, item) {
                        $('#sub-category').append(`<option value="${item.id}">${item.name}</option>`);
                    });
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        });

        // ✅ 3. Auto-select product type in Eco Modal when opened
        $('#ecoRatingModal').on('show.bs.modal', function () {
            const subcategoryId = parseInt($('#sub-category').val());
            const mappedProduct = subcategoryToProductMap[subcategoryId];

            if (mappedProduct) {
                $('#product').val(mappedProduct).prop('disabled', true); // Disable user changes
            } else {
                $('#product').val('').prop('disabled', false); // Allow manual selection if mapping missing
            }
        });

        // ✅ 4. Show/hide part replacement & issue fields
        $('#parts_replaced').on('change', function () {
            $('#replacement-details').toggle($(this).val() === 'Yes');
        });

        $('#functionality').on('change', function () {
            $('#performance-issues').toggle($(this).val() === 'No');
        });

        // ✅ 5. Submit eco rating calculation via AJAX
        $('#generate-eco-rating').on('click', function () {
            const ecoData = {
                _token: '{{ csrf_token() }}',
                product: $('#product').val(),
                age: $('#age').val(),
                parts_replaced: $('#parts_replaced').val(),
                quality_parts: $('#parts_replaced').val() === 'Yes' ? $('#quality_parts').val() : null,
                replacer: $('#parts_replaced').val() === 'Yes' ? $('#replacer').val() : null,
                functionality: $('#functionality').val(),
                performance_issue: $('#functionality').val() === 'No' ? $('#performance_issue').val() : null,
                recyclable: $('#recyclable').val()
            };

            $.ajax({
                url: '{{ route('vendor.product.calculate-eco-rating') }}',
                method: 'POST',
                data: ecoData,
                success: function (response) {
                    $('#eco-rating').val(response.rating);
                    
                    // Check if the rating is low (score <= 30)
                    const scoreMatch = response.rating.match(/Score: ([\d.]+)/);
                    if (scoreMatch && parseFloat(scoreMatch[1]) <= 3) {
                        $('#low-rating-warning').show();
                    } else {
                        $('#low-rating-warning').hide();
                    }
                    
                    $('#ecoRatingModal').modal('hide');
                },
                error: function () {
                    alert('Error calculating eco rating.');
                }
            });
        });

        // ✅ 6. If product type is donation, auto-set price to 0
        $('select[name="product_type"]').on('change', function () {
            const isDonation = $(this).val() === 'type_dontion';
            const priceField = $('input[name="price"]');
            priceField.prop('readonly', isDonation).val(isDonation ? 0 : '');
        });

    });
</script>
@endpush

