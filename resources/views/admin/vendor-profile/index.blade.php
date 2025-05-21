@extends('admin.layouts.master')

@section('content')
<section class="section" style="padding: 20px;">
    <!-- Header Section -->
    <div class="section-header" 
         style="background: linear-gradient(to right, #f0f9f1, #ffffff);
                padding: 20px;
                border-radius: 15px;
                box-shadow: 0 2px 10px rgba(81, 187, 106, 0.1);
                margin-bottom: 30px;">
        <h1 style="color: #218838; 
                   font-size: 24px; 
                   font-weight: 600; 
                   margin: 0;
                   display: flex;
                   align-items: center;
                   gap: 10px;">
            <i class="fas fa-user-circle"></i>
            Admin Profile
        </h1>
    </div>

    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card" 
                     style="border-radius: 15px;
                            box-shadow: 0 4px 15px rgba(81, 187, 106, 0.1);
                            border: 1px solid rgba(81, 187, 106, 0.1);
                            overflow: hidden;">
                    
                    <!-- Card Header -->
                    <div class="card-header" 
                         style="background: rgba(81, 187, 106, 0.05);
                                padding: 20px;
                                border-bottom: 1px solid rgba(81, 187, 106, 0.1);">
                        <h4 style="color: #218838; 
                                   font-weight: 600; 
                                   margin: 0;
                                   display: flex;
                                   align-items: center;
                                   gap: 10px;">
                            <i class="fas fa-edit"></i>
                            Update Admin Profile
                        </h4>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body" style="padding: 30px;">
                        @if(session('success'))
                            <div class="alert alert-success" 
                                 style="background: rgba(40, 167, 69, 0.1);
                                        color: #218838;
                                        border: none;
                                        border-radius: 8px;
                                        padding: 15px 20px;">
                                <i class="fas fa-check-circle"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.vendor-profile.store') }}" 
                              method="POST" 
                              enctype="multipart/form-data">
                            @csrf

                            <!-- Preview Image -->
                            <div class="form-group" style="margin-bottom: 25px;">
                                <label style="font-weight: 600; color: #333; margin-bottom: 10px;">Preview</label>
                                <br>
                                <div style="padding: 10px;
                                          border-radius: 10px;
                                          background: rgba(81, 187, 106, 0.05);
                                          display: inline-block;">
                                    <img width="200px" 
                                         src="{{asset($profile->banner)}}" 
                                         alt=""
                                         style="border-radius: 8px;
                                                box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                                </div>
                            </div>

                            <!-- Form Fields -->
                            <div class="form-group" style="margin-bottom: 25px;">
                                <label style="font-weight: 600; color: #333; margin-bottom: 10px;">
                                    <i class="fas fa-image" style="color: #218838; margin-right: 8px;"></i>
                                    Banner
                                </label>
                                <input type="file" 
                                       class="form-control" 
                                       name="banner"
                                       style="padding: 10px;
                                              border: 1px solid rgba(81, 187, 106, 0.2);
                                              border-radius: 8px;
                                              background: rgba(81, 187, 106, 0.02);">
                                @error('banner')
                                    <small class="text-danger" style="margin-top: 5px; display: block;">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group" style="margin-bottom: 25px;">
                                <label style="font-weight: 600; color: #333; margin-bottom: 10px;">
                                    <i class="fas fa-phone" style="color: #218838; margin-right: 8px;"></i>
                                    Phone
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       name="phone" 
                                       value="{{$profile->phone}}"
                                       style="padding: 12px;
                                              border: 1px solid rgba(81, 187, 106, 0.2);
                                              border-radius: 8px;
                                              background: rgba(81, 187, 106, 0.02);">
                                @error('phone')
                                    <small class="text-danger" style="margin-top: 5px; display: block;">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group" style="margin-bottom: 25px;">
                                <label style="font-weight: 600; color: #333; margin-bottom: 10px;">
                                    <i class="fas fa-envelope" style="color: #218838; margin-right: 8px;"></i>
                                    Email
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       name="email" 
                                       value="{{$profile->email}}"
                                       style="padding: 12px;
                                              border: 1px solid rgba(81, 187, 106, 0.2);
                                              border-radius: 8px;
                                              background: rgba(81, 187, 106, 0.02);">
                                @error('email')
                                    <small class="text-danger" style="margin-top: 5px; display: block;">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group" style="margin-bottom: 25px;">
                                <label style="font-weight: 600; color: #333; margin-bottom: 10px;">
                                    <i class="fas fa-map-marker-alt" style="color: #218838; margin-right: 8px;"></i>
                                    Address
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       name="address" 
                                       value="{{$profile->address}}"
                                       style="padding: 12px;
                                              border: 1px solid rgba(81, 187, 106, 0.2);
                                              border-radius: 8px;
                                              background: rgba(81, 187, 106, 0.02);">
                                @error('address')
                                    <small class="text-danger" style="margin-top: 5px; display: block;">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group" style="margin-bottom: 25px;">
                                <label style="font-weight: 600; color: #333; margin-bottom: 10px;">
                                    <i class="fas fa-align-left" style="color: #218838; margin-right: 8px;"></i>
                                    Description
                                </label>
                                <textarea class="summernote" 
                                          name="description"
                                          style="border: 1px solid rgba(81, 187, 106, 0.2);
                                                 border-radius: 8px;">
                                    {{$profile->description}}
                                </textarea>
                                @error('description')
                                    <small class="text-danger" style="margin-top: 5px; display: block;">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" 
                                    class="btn btn-primary"
                                    style="background: #218838;
                                           border: none;
                                           padding: 12px 30px;
                                           border-radius: 8px;
                                           font-weight: 500;
                                           transition: all 0.3s ease;
                                           box-shadow: 0 2px 10px rgba(81, 187, 106, 0.2);">
                                <i class="fas fa-save" style="margin-right: 8px;"></i>
                                Update Profile
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Form Control Focus States */
    .form-control:focus {
        border-color: #218838;
        box-shadow: 0 0 0 0.2rem rgba(81, 187, 106, 0.25);
    }

    /* Button Hover Effect */
    .btn-primary:hover {
        background: #1a6e2e !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(81, 187, 106, 0.3) !important;
    }

    /* Summernote Editor Custom Styling */
    .note-editor.note-frame {
        border-color: rgba(81, 187, 106, 0.2);
        border-radius: 8px;
    }

    .note-editor.note-frame .note-toolbar {
        background: rgba(81, 187, 106, 0.05);
        border-bottom: 1px solid rgba(81, 187, 106, 0.1);
        border-radius: 8px 8px 0 0;
    }

    /* Error Message Animation */
    .text-danger {
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection