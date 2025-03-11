 @php
     $sliderSectionOne = json_decode( $sliderSectionOne->value);
 @endphp
 <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.product-slider-section-one')}}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Category</label>
                        <select name="cat_one" id="" class="form-control main-category">
                             
                             @foreach ($categories as $category)
                             <option {{$category->id ==   $sliderSectionOne->category}} value="{{$category->id}}">{{$category->name}}</option> 
                             @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>Sub Category</label>
                        <select name="sub_cat_one" id="" class="form-control sub-category">
                           
                            <option value="">Select</option>  
                           
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>Child Category</label>
                        <select name="child_cat_one" id="" class="form-control child-category">
                         
                            <option value="">Select</option> 
                           
                          
                        </select>
                    </div>
                </div>
                
               
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
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
</div>