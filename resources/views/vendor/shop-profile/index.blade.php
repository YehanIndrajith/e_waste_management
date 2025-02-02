@extends('vendor.layouts.master')

@section('content')

  <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
     @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            {{-- <h3><i class="far fa-user mt-1"></i>Shop profile</h3> --}}
            <br>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{route('vendor.shop-profile.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-2">
                        <label class="mt-3">Preview</label>
                        <br>
                        <img width="200px" src="{{asset($profile->banner)}}" alt="">
                    </div>

                    <div class="form-group mb-2">
                        <label>Banner</label>
                        <input type="file" class="form-control" name="banner">
                        @error('banner')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                      <label>Shop Name</label>
                      <input type="text" class="form-control" name="shop_name" value="{{$profile->shop_name}}" >
                      @error('phone')
                          <small class="text-danger">{{ $message }}</small>
                      @enderror
                  </div>

                    <div class="form-group mb-2">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{$profile->phone}}" >
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" value="{{$profile->email}}" >
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" value="{{$profile->address}}">
                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" value="{{$profile->description}}">
                        {{-- <textarea class="form-control" name="description" value="{{$profile->description}}"> </textarea> --}}
                        @error('description')
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
    </div>
  </section>
  <!--=============================
    DASHBOARD START
  ==============================-->

@endsection