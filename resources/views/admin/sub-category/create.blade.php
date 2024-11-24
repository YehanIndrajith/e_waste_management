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
              <h4>Create Sub Category</h4>   
            </div>
            <div class="card-body">
            <form action="{{route('admin.sub-category.store')}}" method="POST">
              @csrf


              <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category" required>
                    <option value="">Select</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                   
                </select>
                @error('status')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" required>
                    @error('banner')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

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

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
            </div>
          </div>
        </div>
      </div>
  
    </div>
  </section>
@endsection

