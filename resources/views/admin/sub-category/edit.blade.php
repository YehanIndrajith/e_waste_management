@extends('admin.layouts.master')

@section("content")

<section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Admin Dashboard</a></div>
        <div class="breadcrumb-item">Sub Category</div>
      </div>
    </div>
  
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Update Sub Category</h4>   
            </div>
            <div class="card-body">
            <form action="{{route('admin.sub-category.update', $subCategory->id)}}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category" required>
                    <option value="">Select</option>
                    @foreach ($categories as $category)
                    <option {{$category->id == $subCategory->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                   
                </select>
                @error('category')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{$subCategory->name}}" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" required>
                        <option {{$subCategory->status == 1 ? 'selected' : ''}} value="1">Active</option>
                        <option {{$subCategory->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                    </select>
                    @error('status')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            </div>
          </div>
        </div>
      </div>
  
    </div>
  </section>
@endsection

