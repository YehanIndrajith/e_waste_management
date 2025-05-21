@extends('admin.layouts.master')

@section('content')
<section class="section" style="padding: 20px;">
    <!-- Header Section -->
    <div class="section-header" 
         style="background: linear-gradient(to right, #f0f9f1, #ffffff);
                padding: 20px;
                border-radius: 15px;
                box-shadow: 0 2px 10px rgba(81, 187, 106, 0.1);
                margin-bottom: 30px;
                display: flex;
                justify-content: space-between;
                align-items: center;">
        <h1 style="color: #218838; font-size: 24px; font-weight: 600; margin: 0;">Dashboard</h1>
        <div class="section-header-breadcrumb" 
             style="display: flex; 
                    gap: 10px; 
                    align-items: center;">
            <div class="breadcrumb-item active">
                <a href="#" 
                   style="color: #218838; 
                          text-decoration: none; 
                          font-weight: 500;">Dashboard</a>
            </div>
            <div class="breadcrumb-item" 
                 style="color: #666;">User Data</div>
        </div>
    </div>

    <div class="section-body">
        <!-- Main Content Card -->
        <div class="row">
            <div class="col-12">
                <div class="card" 
                     style="background: white;
                            border-radius: 15px;
                            box-shadow: 0 4px 15px rgba(81, 187, 106, 0.1);
                            border: 1px solid rgba(81, 187, 106, 0.1);
                            overflow: hidden;">
                    
                    <!-- Card Header -->
                    <div class="card-header" 
                         style="background: rgba(81, 187, 106, 0.05);
                                padding: 20px;
                                border-bottom: 1px solid rgba(81, 187, 106, 0.1);
                                display: flex;
                                justify-content: space-between;
                                align-items: center;">
                        <!-- <h4 style="color: #218838; 
                                   font-weight: 600; 
                                   margin: 0;">Data</h4> -->
                        <div class="card-header-action">
                            <!-- Add your action buttons here if needed -->
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body" style="padding: 20px;">
                        <!-- Eco Rating Message -->
                        <div class="eco-rating-container" 
                             style="background: linear-gradient(145deg, #ffffff, #f8f9fa);
                                    border-radius: 15px;
                                    padding: 25px;
                                    margin-bottom: 20px;
                                    border: 1px solid rgba(81, 187, 106, 0.1);
                                    box-shadow: 0 4px 15px rgba(81, 187, 106, 0.05);">
                            
                            <h5 style="color: #218838;
                                     font-size: 20px;
                                     font-weight: 600;
                                     margin-bottom: 20px;
                                     display: flex;
                                     align-items: center;
                                     gap: 10px;">
                                <i class="fas fa-leaf" style="color: #218838;"></i>
                                Eco Rating – Give Electronics a Second Life
                            </h5>

                            <div class="rating-cards" 
                                 style="display: grid;
                                        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                                        gap: 20px;
                                        margin-top: 20px;">
                                
                                <!-- Green Badge -->
                                <div class="rating-card" 
                                     style="background: rgba(40, 167, 69, 0.1);
                                            border-radius: 10px;
                                            padding: 20px;
                                            border-left: 5px solid #28a745;">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <span style="font-size: 24px;">✅</span>
                                        <h6 style="margin: 0; color: #28a745; font-weight: 600;">Green Badge</h6>
                                    </div>
                                    <p style="margin: 10px 0 0 0; color: #2c2c2c;">
                                        Good condition, long-lasting, and perfect for reuse. A smart, eco-friendly choice.
                                    </p>
                                </div>

                                <!-- Yellow Badge -->
                                <div class="rating-card" 
                                     style="background: rgba(255, 193, 7, 0.1);
                                            border-radius: 10px;
                                            padding: 20px;
                                            border-left: 5px solid #ffc107;">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <span style="font-size: 24px;">⚠️</span>
                                        <h6 style="margin: 0; color: #ffc107; font-weight: 600;">Yellow Badge</h6>
                                    </div>
                                    <p style="margin: 10px 0 0 0; color: #2c2c2c;">
                                        Decent condition, needs some love & repairs, but still usable.
                                    </p>
                                </div>

                                <!-- Red Badge -->
                                <div class="rating-card" 
                                     style="background: rgba(220, 53, 69, 0.1);
                                            border-radius: 10px;
                                            padding: 20px;
                                            border-left: 5px solid #dc3545;">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <span style="font-size: 24px;">❌</span>
                                        <h6 style="margin: 0; color: #dc3545; font-weight: 600;">Red Badge</h6>
                                    </div>
                                    <p style="margin: 10px 0 0 0; color: #2c2c2c;">
                                        Bad condition, short lifespan, limited reuse.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Hover effects for cards */
    .rating-card {
        transition: all 0.3s ease;
    }
    
    .rating-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(81, 187, 106, 0.1);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .section-header {
            flex-direction: column;
            gap: 15px;
        }

        .section-header-breadcrumb {
            margin-top: 10px;
        }
    }
</style>
@endsection