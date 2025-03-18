@php
    $categoryProductSliderSectionOne = json_decode($categoryProductSliderSectionOne->value);

    $lastKey = [];
    foreach ($categoryProductSliderSectionOne as $key => $category) {
        if ($category == null) {
            break;
        }
        $lastKey = [$key => $category];
    }
    if (array_keys($lastKey)[0] == 'category') {
        $category = \App\Models\Category::find($lastKey['category']);
        $products = \App\Models\Product::where('category_id', $category->id)->orderBy('id', 'DESC')->take(12)->get();
    } elseif (array_keys($lastKey)[0] == 'sub_category') {
        $category = \App\Models\SubCategory::find($lastKey['sub_category']);
        $products = \App\Models\Product::where('sub_category_id', $category->id)
            ->orderBy('id', 'DESC')
            ->take(12)
            ->get();
    } else {
        $category = \App\Models\ChildCategory::find($lastKey['child_category']);
        $products = \App\Models\Product::where('child_category_id', $category->id)
            ->orderBy('id', 'DESC')
            ->take(12)
            ->get();
    }
@endphp
<section id="wsus__electronic" style="padding: 20px 0; background-color: #f8f9fa;">
    <div class="container">
        <!-- Section Header -->
        <div class="row mb-4">
            <div class="col-xl-12">
                <div class="wsus__section_header" style="text-align: center; margin-bottom: 10px;">
                    <h3
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
                        {{ $category->name }}
                        {{-- <span
                            style="
                            content: '';
                            position: absolute;
                            bottom: 0;
                            left: 50%;
                            transform: translateX(-50%);
                            width: 50px;
                            height: 3px;
                            background: linear-gradient(45deg, #2ecc71, #27ae60);
                            border-radius: 2px;
                        "></span> --}}
                    </h3>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="row flash_sell_slider">
            @foreach ($products as $product)
                <div class="col-xl-3 col-sm-6 col-md-4 col-lg-4">
                    <div class="wsus__product_item"
                        style="
                        background: rgb(255, 255, 255);
                        border-radius: 15px;
                        overflow: hidden;
                        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
                        transition: transform 0.3s ease;
                        height: auto;
                        position: relative;
                        margin-bottom: 0px;
                    ">
                        <!-- Product Image -->
                        <a class="wsus__pro_link" href="{{ route('product-detail', $product->slug) }}"
                            style="
                            display: block;
                            padding: 8px 8px 0 8px;
                        ">
                            <img src="{{ asset($product->thumb_image) }}" alt="product"
                                style="
                                width: 100%;
                                height: 200px;
                                object-fit: cover;
                                border-radius: 8px;
                                border: 1px solid #e9ecef;
                                margin-bottom: 0 px;
                            " />
                        </a>

                        <!-- Product Details -->
                        <div class="wsus__product_details" style="padding: 0 10px 10px 10px;">
                            <div
                                style="
                                display: inline-block;
                                background-color: #f8f9fa;
                                padding: 3px 10px;
                                border-radius: 12px;
                                margin-bottom: 8px;
                                border: 1px solid #e9ecef;
                            ">
                                <a class="wsus__category" href="#"
                                    style="
                                    color: #666;
                                    font-size: 12px;
                                    font-weight: 500;
                                    text-decoration: none;
                                ">{{ $product->category->name }}</a>
                            </div>

                            <a class="wsus__pro_name" href="{{ route('product-detail', $product->slug) }}"
                                style="
                                font-size: 14px;
                                color: #333;
                                font-weight: 600;
                                margin: 5px 0;
                                display: block;
                                text-decoration: none;
                                line-height: 1.4;
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

                            <div
                                style="
                                display: flex;
                                align-items: center;
                                gap: 8px;
                                margin: 8px 0;
                            ">
                                <span style="font-size: 13px;">Eco Rating:</span>
                                <div
                                    style="
                                    width: 16px;
                                    height: 16px;
                                    background-color: {{ $badgeColor }};
                                    clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
                                ">
                                </div>
                                <span
                                    style="
                                    background-color: {{ $badgeColor }};
                                    color: white;
                                    padding: 2px 8px;
                                    border-radius: 10px;
                                    font-size: 11px;
                                    font-weight: 600;
                                ">{{ $badgeName }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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

    .wsus__category:hover {
        color: #2ecc71 !important;
    }

    /* If you're using a slider, you might want to add these styles */
    .flash_sell_slider {
        margin: 0 -10px;
    }

    .flash_sell_slider .col-xl-3 {
        padding: 0 10px;
    }
</style>
