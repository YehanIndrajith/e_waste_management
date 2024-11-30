@extends('admin.layouts.master')

@section("content")
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Admin Dashboard</a></div>
            <div class="breadcrumb-item">Child Category</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Child Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.child-category.store') }}" method="POST">
                            @csrf

                            <!-- Main Category -->
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control main-category" name="category" required>
                                    <option value="">Select</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Subcategory -->
                            <div class="form-group">
                                <label>Sub Category</label>
                                <select class="form-control sub-category" name="sub_category" required>
                                    <option value="">Select</option>
                                </select>
                                @error('sub_category')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Name -->
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        // On main category change, fetch subcategories via AJAX
        $('body').on('change', '.main-category', function (e) {
            let id = $(this).val();
            $.ajax({
                method: 'GET',
                url: '{{ route('admin.get-subcategories') }}',
                data: { id: id },
                success: function (data) {
                    $('.sub-category').html('<option value="">Select</option>');
                    $.each(data, function (i, item) {
                        $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`);
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
@endpush
