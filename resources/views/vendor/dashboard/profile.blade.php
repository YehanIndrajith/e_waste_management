@extends('vendor.layouts.master')

@section('content')
<section id="wsus__dashboard" style="background: #f8f9fa; padding: 30px 0;">
    <div class="container-fluid">
        @include('vendor.layouts.sidebar')

        <div class="row">
            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                <div class="dashboard_content" 
                     style="background: white;
                            border-radius: 15px;
                            box-shadow: 0 4px 15px rgba(81, 187, 106, 0.1);
                            padding: 30px;">
                    
                    <!-- Profile Section -->
                    <div class="wsus__dashboard_profile">
                        <!-- Header -->
                        <div class="section-header" 
                             style="border-bottom: 1px solid rgba(81, 187, 106, 0.1);
                                    margin-bottom: 30px;
                                    padding-bottom: 20px;">
                            <h3 style="color: #218838;
                                     font-size: 24px;
                                     font-weight: 600;
                                     display: flex;
                                     align-items: center;
                                     gap: 10px;">
                                <i class="far fa-user" 
                                   style="background: rgba(81, 187, 106, 0.1);
                                          padding: 10px;
                                          border-radius: 8px;
                                          color: #218838;"></i>
                                Profile
                            </h3>
                            <p style="color: #666; 
                                    margin-top: 5px;
                                    margin-left: 35px;">
                                Basic Information
                            </p>
                        </div>

                        <!-- Profile Form -->
                        <form action="" 
                              method="POST" 
                              style="background: rgba(81, 187, 106, 0.02);
                                     border-radius: 12px;
                                     padding: 30px;">
                            
                            <!-- Profile Image -->
                            <div class="profile-image-section" 
                                 style="text-align: center; 
                                        margin-bottom: 30px;">
                                <div class="wsus__dash_pro_img" 
                                     style="position: relative;
                                            width: 150px;
                                            height: 150px;
                                            margin: 0 auto;
                                            border-radius: 50%;
                                            border: 3px solid #218838;
                                            padding: 3px;
                                            background: white;">
                                    <img src="{{Auth::user()->image ? asset(Auth::user()->image) : asset('frontend/images/ts-2.jpg')}}" 
                                         alt="Profile Image" 
                                         style="width: 100%;
                                                height: 100%;
                                                object-fit: cover;
                                                border-radius: 50%;">
                                </div>
                            </div>

                            <!-- Form Fields -->
                            <div class="row" style="gap: 20px;">
                                <!-- Name Field -->
                                <div class="col-12">
                                    <div class="form-group" 
                                         style="background: white;
                                                border-radius: 10px;
                                                padding: 5px;
                                                box-shadow: 0 2px 10px rgba(81, 187, 106, 0.05);">
                                        <label style="color: #218838;
                                                    font-weight: 500;
                                                    margin-bottom: 8px;
                                                    display: block;
                                                    padding: 0 15px;">
                                            Name
                                        </label>
                                        <div style="display: flex;
                                                    align-items: center;
                                                    padding: 0 15px;">
                                            <i class="fas fa-user-tie" 
                                               style="color: #218838;
                                                      margin-right: 10px;"></i>
                                            <input type="text" 
                                                   name="name" 
                                                   value="{{Auth::user()->name}}"
                                                   style="width: 100%;
                                                          border: none;
                                                          padding: 10px 0;
                                                          outline: none;
                                                          color: #333;">
                                        </div>
                                    </div>
                                </div>

                                <!-- Email Field -->
                                <div class="col-12">
                                    <div class="form-group" 
                                         style="background: white;
                                                border-radius: 10px;
                                                padding: 5px;
                                                box-shadow: 0 2px 10px rgba(81, 187, 106, 0.05);">
                                        <label style="color: #218838;
                                                    font-weight: 500;
                                                    margin-bottom: 8px;
                                                    display: block;
                                                    padding: 0 15px;">
                                            Email
                                        </label>
                                        <div style="display: flex;
                                                    align-items: center;
                                                    padding: 0 15px;">
                                            <i class="fal fa-envelope-open" 
                                               style="color: #218838;
                                                      margin-right: 10px;"></i>
                                            <input type="email" 
                                                   name="email" 
                                                   value="{{Auth::user()->email}}"
                                                   style="width: 100%;
                                                          border: none;
                                                          padding: 10px 0;
                                                          outline: none;
                                                          color: #333;">
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12" style="margin-top: 20px;">
                                    <button type="submit" 
                                            class="btn" 
                                            style="background: #218838;
                                                   color: white;
                                                   padding: 12px 30px;
                                                   border-radius: 8px;
                                                   border: none;
                                                   font-weight: 500;
                                                   transition: all 0.3s ease;
                                                   box-shadow: 0 4px 15px rgba(81, 187, 106, 0.2);">
                                        <i class="fas fa-save" style="margin-right: 8px;"></i>
                                        Update Profile
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Hover Effects */
    .btn:hover {
        background: #1a6e2e !important;
        transform: translateY(-2px);
    }

    .form-group:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(81, 187, 106, 0.1) !important;
    }

    /* Input Focus Effect */
    input:focus {
        background: rgba(81, 187, 106, 0.05);
    }

    /* Profile Image Hover Effect */
    .wsus__dash_pro_img:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 20px rgba(81, 187, 106, 0.2);
    }

    /* Smooth Transitions */
    * {
        transition: all 0.3s ease;
    }
</style>
@endsection