@php
    
    $sellingCategorySection = json_decode($sellingCategorySection->value);
   

@endphp

<div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.selling-category-section')}}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">

                    <h5>Category 1</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Category</label>
                            <select name="cat_one" id="" class="form-control main-category">
                                <option value="">Select</option>  
                                @foreach ($categories as $category)
                                <option {{$category->id == $sellingCategorySection[0]->category ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>  
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Sub Category</label>
                            <select name="sub_cat_one" id="" class="form-control sub-category">
                                @php
                                    $subCategories = \App\Models\SubCategory::where('category_id', $sellingCategorySection[0]->category)->get();
                                @endphp
                                <option value="">Select</option>  
                                @foreach ($subCategories as $subCategory)
                                <option {{$subCategory->id == $sellingCategorySection[0]->sub_category ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Child Category</label>
                            <select name="child_cat_one" id="" class="form-control child-category">
                                @php
                                $childCategories = \App\Models\ChildCategory::where('sub_category_id', $sellingCategorySection[0]->sub_category)->get();
                                @endphp
                                <option value="">Select</option> 
                                @foreach ( $childCategories as $childCategory)
                                <option {{$childCategory->id == $sellingCategorySection[0]->child_category ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                @endforeach
                              
                            </select>
                        </div>
                    </div>

                    <h5>Category 2</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Category</label>
                            <select name="cat_two" id="" class="form-control main-category">
                                <option value="">Select</option>  
                                @foreach ($categories as $category)
                                <option {{$category->id == $sellingCategorySection[1]->category ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>  
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Sub Category</label>
                            <select name="sub_cat_two" id="" class="form-control sub-category">
                                @php
                                    $subCategories = \App\Models\SubCategory::where('category_id', $sellingCategorySection[1]->category)->get();
                                @endphp
                                <option value="">Select</option> 
                                @foreach ($subCategories as $subCategory)
                                <option {{$subCategory->id == $sellingCategorySection[1]->sub_category ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Child Category</label>
                            <select name="child_cat_two" id="" class="form-control child-category">
                                @php
                                $childCategories = \App\Models\ChildCategory::where('sub_category_id', $sellingCategorySection[1]->sub_category)->get();
                                @endphp
                                <option value="">Select</option> 
                                @foreach ( $childCategories as $childCategory)
                                <option {{$childCategory->id == $sellingCategorySection[1]->child_category ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <h5>Category 3</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Category</label>
                            <select name="cat_three" id="" class="form-control main-category">
                                <option value="">Select</option>  
                                @foreach ($categories as $category)
                                <option {{$category->id == $sellingCategorySection[2]->category ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>  
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Sub Category</label>
                            <select name="sub_cat_three" id="" class="form-control sub-category">
                                @php
                                $subCategories = \App\Models\SubCategory::where('category_id', $sellingCategorySection[2]->category)->get();
                                @endphp
                                <option value="">Select</option> 
                                @foreach ($subCategories as $subCategory)
                                <option {{$subCategory->id == $sellingCategorySection[2]->sub_category ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Child Category</label>
                            <select name="child_cat_three" id="" class="form-control child-category">
                                @php
                                $childCategories = \App\Models\ChildCategory::where('sub_category_id', $sellingCategorySection[2]->sub_category)->get();
                                @endphp
                                <option value="">Select</option> 
                                @foreach ( $childCategories as $childCategory)
                                <option {{$childCategory->id == $sellingCategorySection[2]->child_category ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <h5>Category 4</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Category</label>
                            <select name="cat_four" id="" class="form-control main-category">
                                <option value="">Select</option>  
                                @foreach ($categories as $category)
                                <option {{$category->id == $sellingCategorySection[3]->category ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>  
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Sub Category</label>
                            <select name="sub_cat_four" id="" class="form-control sub-category">
                                @php
                                $subCategories = \App\Models\SubCategory::where('category_id', $sellingCategorySection[3]->category)->get();
                                @endphp
                                <option value="">Select</option> 
                                @foreach ($subCategories as $subCategory)
                                <option {{$subCategory->id == $sellingCategorySection[3]->sub_category ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Child Category</label>
                            <select name="child_cat_four" id="" class="form-control child categoty">
                                @php
                                $childCategories = \App\Models\ChildCategory::where('sub_category_id', $sellingCategorySection[3]->sub_category)->get();
                                @endphp
                                <option value="">Select</option> 
                                @foreach ( $childCategories as $childCategory)
                                <option {{$childCategory->id == $sellingCategorySection[3]->child_category ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div> 
  </div>

  @push('scripts')
<script>
    $(document).ready(function () {
        // On main category change, fetch subcategories via AJAX
        $('body').on('change', '.main-category', function (e) {
            let id = $(this).val();
            let row =  $(this).closest('.row'); 
            $.ajax({
                method: 'GET',
                url: '{{ route('admin.get-subcategories') }}',
                data: { id: id },
                success: function (data) {
                    let selector = row.find('.sub-category');
                    selector.html('<option value="">Select</option>');
                    $.each(data, function (i, item) {
                        selector.append(`<option value="${item.id}">${item.name}</option>`);
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });

         // On subcategory change, load child categories dynamically
         $('body').on('change', '.sub-category', function (e) {
            let id = $(this).val(); // Get the selected subcategory ID
            let row =  $(this).closest('.row'); 
            console.log("Selected Sub Category ID:", id);

            $.ajax({
                method: 'GET',
                url: '{{ route('admin.product.get-child-categories') }}', // Route for fetching child categories
                data: { id: id },
                success: function (data) {
                    let selector = row.find('.child-category');
                    console.log("Child Categories Data:", data);

                    // Populate the child category dropdown
                    selector.html('<option value="">Select</option>');
                    $.each(data, function (i, item) {
                        selector.append(`<option value="${item.id}">${item.name}</option>`);
                    });
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        });
    });
</script>
@endpush