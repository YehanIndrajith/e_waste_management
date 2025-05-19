@extends('frontend.home.layouts.master')

@section('content')
    <!--==========================
          PRODUCT MODAL VIEW START
        ===========================-->
  
    <!--==========================
          PRODUCT MODAL VIEW END
        ===========================-->


    <!--============================
            BREADCRUMB START
        ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>products details</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">product</a></li>
                            <li><a href="#">product details</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
            BREADCRUMB END
        ==============================-->


    <!--============================
            PRODUCT DETAILS START
        ==============================-->
    <section id="wsus__product_details">
        <div class="container">
            <div class="wsus__details_bg">
                <div class="row">
                    <div class="col-xl-4 col-md-5 col-lg-5">
                        <div id="sticky_pro_zoom">
                            <div class="exzoom hidden" id="exzoom">
                                <div class="exzoom_img_box">
                                    @if ($product->video_link)
                                        <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                            href="{{ $product->video_link }}">
                                            <i class="fas fa-play"></i>
                                        </a>
                                    @endif

                                    <ul class='exzoom_img_ul'>
                                        <li><img class="zoom ing-fluid w-100" src="{{ asset($product->thumb_image) }}"
                                                alt="product"></li>

                                    </ul>
                                </div>
                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn"> <i
                                            class="far fa-chevron-left"></i> </a>
                                    <a href="javascript:void(0);" class="exzoom_next_btn"> <i
                                            class="far fa-chevron-right"></i> </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-7 col-lg-7">
                        <div class="wsus__pro_details_text">
                            <a class="title" href="javascript:;">{{ $product->name }}</a>
                            <p class="wsus__stock_area"><span class="in_stock">in stock</span> </p>
                            <h4>Rs. {{ $product->price }} </h4>

                            <div class="wsus_pro_det_color" style="margin: 20px 0; padding: 15px 0; border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
                                @php
                                    $badgeClass = '';
                                    $badgeName = '';
                                    $badgeColor = '';
                                    
                                    // Extract the numerical score from the eco_rating string
                                    $scoreString = $product->eco_rating;
                                    preg_match('/Score: ([\d.]+)/', $scoreString, $matches);
                                    $score = isset($matches[1]) ? floatval($matches[1]) : 0;
                                    
                                    if ($score >= 61 && $score <= 100) {
                                        $badgeClass = 'bg-success';
                                        $badgeName = 'High';
                                        $badgeColor = '#28a745';
                                    } elseif ($score >= 31 && $score <= 60) {
                                        $badgeClass = 'bg-warning';
                                        $badgeName = 'Medium';
                                        $badgeColor = '#ffc107';
                                    } else {
                                        $badgeClass = 'bg-danger';
                                        $badgeName = 'Low';
                                        $badgeColor = '#dc3545';
                                    }
                                @endphp
                                
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <h5 style="margin: 0; font-size: 16px; font-weight: 600; color: #333;">Eco Rating:</h5>
                                    <span class="badge {{ $badgeClass }}" style="
                                        padding: 8px 15px;
                                        font-size: 14px;
                                        font-weight: 600;
                                        border-radius: 4px;
                                        text-transform: uppercase;
                                        letter-spacing: 0.5px;
                                        background-color: {{ $badgeColor }};
                                        color: white;
                                        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                        display: inline-flex;
                                        align-items: center;
                                        justify-content: center;
                                        min-width: 80px;
                                        height: 30px;
                                    ">
                                        {{ $badgeName }}
                                    </span>
                                </div>
                            </div>

                            <!-- Vendor Information -->
                            <div class="wsus_pro_det_color" style="margin: 20px 0; padding: 15px 0; border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
                                <div style="display: flex; flex-direction: column; gap: 10px;">
                                    <h5 style="margin: 0; font-size: 16px; font-weight: 600; color: #333;">Vendor Information:</h5>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <i class="fas fa-store" style="color: #666;"></i>
                                        <span style="font-size: 14px; color: #666;">{{ $product->vendor->shop_name }}</span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <i class="fas fa-phone" style="color: #666;"></i>
                                        <span style="font-size: 14px; color: #666;">{{ $product->vendor->phone }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="wsus_pro__det_size">
                                <h5>Type :</h5>
                                @if ($product->product_type === 'type_selling')
                                    <span class="badge bg-primary p-2" style="font-size: 1.1rem;">
                                        <i class="fas fa-donate me-1"></i> Selling
                                    </span>
                                @elseif ($product->product_type === 'type_dontion')
                                    <span class="badge bg-warning p-2 text-dark" style="font-size: 1.1rem;">
                                        <i class="fas fa-award me-1"></i> Donation
                                    </span>
                                @endif
                            </div>
                            <div class="wsus__quentity">
                                <h5>quentity : {{$product->qty}}</h5>
                                
                              
                            </div>

                            <ul class="wsus__button_area">
                                
                                <li><a class="buy_now" >buy now : Call Us</a></li>
                                
                            </ul>
                            
                            <p class="brand_model"><span></span> {{$product->short_description}}</p>
                           
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-12 mt-md-5 mt-lg-0">
                        <div class="wsus_pro_det_sidebar" id="sticky_sidebar">
                            <ul>
                                <li>
                                    <span><i class="fal fa-truck"></i></span>
                                    <div class="text">
                                        <h4>Fast Delevary</h4>
                                     
                                    </div>
                                </li>
                                <li>
                                    <span><i class="far fa-shield-check"></i></span>
                                    <div class="text">
                                        <h4>Secure Payment</h4>
                                     
                                    </div>
                                </li>
                                <li>
                                    <span><i class="fal fa-envelope-open-dollar"></i></span>
                                    <div class="text">
                                        <h4>Trusted After Sale Service</h4>
                                     
                                    </div>
                                </li>
                            </ul>
                            <div class="wsus__det_sidebar_banner">
                                <img src="images/blog_1.jpg" alt="banner" class="img-fluid w-100">
                                <div class="wsus__det_sidebar_banner_text_overlay">
                                    <div class="wsus__det_sidebar_banner_text">
                                        <p>Buy What You Want</p>
                                        <h4>Best Price In The Market</h4>
                                        <a href="#" class="common_btn">shope now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__pro_det_description">
                        <div class="wsus__details_bg">
                            <ul class="nav nav-pills mb-3" id="pills-tab3" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab7" data-bs-toggle="pill"
                                        data-bs-target="#pills-home22" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">Description</button>
                                </li>
                              
                            </ul>
                            <div class="tab-content" id="pills-tabContent4">
                                <div class="tab-pane fade  show active " id="pills-home22" role="tabpanel"
                                    aria-labelledby="pills-home-tab7">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="wsus__description_area">
                                                <h1>Heading</h1>
                                                <p>
                                                    {{ $product->short_description }}
 
                                                    <br>

                                                    {{ $product->long_description }}
                                                </p>

                                                
                                                
                                               
                                               
                                             
                                               
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-4 col-md-4">
                                                <div class="description_single">
                                                    <h6><span>1</span> Free Shipping </h6>
                                                    <p>We offer free shipping for Our All Products</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-4">
                                                <div class="description_single">
                                                    <h6><span>2</span> Free and Easy Returns</h6>
                                                    <p>We guarantee our products and you could get back all of your
                                                        money anytime you want in 30 days.</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-4">
                                                <div class="description_single">
                                                    <h6><span>3</span> Special Financing </h6>
                                                    <p>Get 20%-50% off items over 50$ for a month or over 250$ for a
                                                        year with our special credit card.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
  
@endsection
