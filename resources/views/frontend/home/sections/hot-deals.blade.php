<section id="wsus__hot_deals" class="wsus__hot_deals_2" style="padding: 50px 0; background-color: #f8f9fa;">
    <div class="container">
        <div class="wsus__hot_large_item">
            <!-- Filter Buttons -->
            <div class="row mb-4">
                <div class="col-xl-12">
                    <div class="wsus__section_header"
                        style="
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        margin-bottom: 10px;
                    ">
                        <h2
                        style="
                        background: linear-gradient(45deg, #007bff, #00c6ff);
                        -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;
                        font-size: 1.5rem;
                        font-weight: 800;
                        text-align: center;
                        text-transform: uppercase;
                        letter-spacing: 1px;
                        position: relative;
                        padding-bottom: 10px;
                    ">
                        
                            Products</h2>
                        <div class="monthly_top_filter2" style="display: flex; gap: 15px;">
                            <button class="active auto_click" data-filter=".type_selling"
                                style="
                                padding: 8px 20px;
                                border: none;
                                background-color: #2ecc71;
                                color: white;
                                border-radius: 25px;
                                font-weight: 500;
                                transition: all 0.3s ease;
                                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                            ">Selling</button>
                            <button data-filter=".type_dontion"
                                style="
                                padding: 8px 20px;
                                border: none;
                                background-color: #f1c40f;
                                color: #333;
                                border-radius: 25px;
                                font-weight: 500;
                                transition: all 0.3s ease;
                                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                            ">Donations</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="row grid2" style="gap: 20px 0;">
                @foreach ($typeBaseProducts as $key => $products)
                    @foreach ($products as $product)
                        <div class="col-xl-3 col-sm-6 col-md-4 col-lg-4 {{ $key }}">
                            <div class="wsus__product_item"
                                style="
                                background: white;
                                border-radius: 10px;
                                overflow: hidden;
                                box-shadow: 0 3px 10px rgba(0,0,0,0.1);
                                transition: transform 0.3s ease;
                                height: 30%;
                                position: relative;
                            ">

                                <!-- Product Image -->
                                <a class="wsus__pro_link" href="{{ route('product-detail', $product->slug) }}"
                                    style="
                                      display: block;
                                           padding: 5px; 
                                            ">
                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                        style="
                                            width: 100%;
                                            height: 250px; 
                                            object-fit: cover;
                                            border-radius: 8px;
                                            border: 1px solid #e9ecef; /* Added subtle border */
                                       " />
                                </a>


                                <!-- Product Details -->
                                <div class="wsus__product_details" style="padding: 10px;">
                                    <div
                                        style="
                                        display: inline-block;
                                        background-color: #c97db0;
                                        padding: 0px 12px;
                                        border-radius: 10px;
                                        margin-bottom: 10px;
                                        border: 1px solid #e9ecef;
                                    ">
                                        <a class="wsus__category" href="#"
                                            style="
                                            color: #666;
                                            font-size: 13px;
                                            font-weight: 500;
                                            text-decoration: none;
                                        ">{{ $product->category->name }}</a>
                                    </div>

                                    <a class="wsus__pro_name" href="{{ route('product-detail', $product->slug) }}"
                                        style="
                                        font-size: 16px;
                                        color: #333;
                                        font-weight: 600;
                                        margin: 8px 0;
                                        display: block;
                                        text-decoration: none;
                                    ">{!! limitText($product->name) !!}</a>

                                    <!-- Eco Rating Badge -->
                                    @php
                                        $scoreString = $product->eco_rating;
                                        preg_match('/Score: ([\d.]+)/', $scoreString, $matches);
                                        $score = isset($matches[1]) ? floatval($matches[1]) : 0;

                                        if ($score >= 61) {
                                            $badgeColor = '#28a745';
                                            $badgeName = 'High';
                                        } elseif ($score >= 31) {
                                            $badgeColor = '#ffc107';
                                            $badgeName = 'Medium';
                                        } else {
                                            $badgeColor = '#dc3545';
                                            $badgeName = 'Low';
                                        }
                                    @endphp

                                    <div style="display: flex; align-items: center; gap: 10px; margin: 10px 0;">
                                        <span style="font-size: 14px;">Eco Rating:</span>
                                        <div
                                            style="
                                            width: 20px;
                                            height: 20px;
                                            background-color: {{ $badgeColor }};
                                            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
                                        ">
                                        </div>
                                        <span
                                            style="
                                            background-color: {{ $badgeColor }};
                                            color: white;
                                            padding: 3px 10px;
                                            border-radius: 12px;
                                            font-size: 12px;
                                            font-weight: 600;
                                        ">{{ $badgeName }}</span>
                                    </div>

                                    <p class="wsus__price"
                                        style="
                                        font-size: 18px;
                                        color: #2ecc71;
                                        font-weight: bold;
                                        margin: 10px 0 0 0;
                                    ">
                                        Rs. {{ $product->price }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
    .wsus__product_item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    .wsus__pro_name:hover {
        color: #2ecc71;
    }

    .monthly_top_filter2 button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .monthly_top_filter2 button.active {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .wsus__category:hover {
        color: #2ecc71 !important;
    }
</style>
