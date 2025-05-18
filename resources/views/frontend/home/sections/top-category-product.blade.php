@php
    $sellingCategories = json_decode($sellingCategory->value, true);
@endphp

<section id="wsus__monthly_top" class="wsus__monthly_top_2">
    <div class="container mb-3">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header for_md">
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
                            padding-bottom: 10px;">
                        Hot Selling Categories of the Month
                    </h3>

                    <div class="monthly_top_filter">
                        @php
                            $products = [];
                        @endphp

                        @foreach ($sellingCategories as $sellingCategory)
                            @php
                                $lastKey = [];
                                foreach ($sellingCategory as $key => $catId) {
                                    if ($catId == null) break;
                                    $lastKey = [$key => $catId];
                                }

                                $category = null;
                                $productSet = collect(); // default empty collection

                                // ✅ Null-safe access added below
                                if (array_key_first($lastKey) === 'category') {
                                    $category = \App\Models\Category::find($lastKey['category']);
                                    if ($category) {
                                        $productSet = \App\Models\Product::where('category_id', $category->id)
                                            ->orderBy('id', 'DESC')
                                            ->take(12)
                                            ->get();
                                    }
                                } elseif (array_key_first($lastKey) === 'sub_category') {
                                    $category = \App\Models\SubCategory::find($lastKey['sub_category']);
                                    if ($category) {
                                        $productSet = \App\Models\Product::where('sub_category_id', $category->id)
                                            ->orderBy('id', 'DESC')
                                            ->take(12)
                                            ->get();
                                    }
                                } elseif (array_key_first($lastKey) === 'child_category') {
                                    $category = \App\Models\ChildCategory::find($lastKey['child_category']);
                                    if ($category) {
                                        $productSet = \App\Models\Product::where('child_category_id', $category->id)
                                            ->orderBy('id', 'DESC')
                                            ->take(12)
                                            ->get();
                                    }
                                }

                                $products[] = $productSet;
                            @endphp

                            @if ($category)
                                <button class="{{ $loop->index == 0 ? 'auto_click active' : '' }}"
                                    data-filter=".category-{{ $loop->index }}">
                                    {{ $category->name }}
                                </button>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="row grid g-4">
                    @foreach ($products as $key => $productGroup)
                        @foreach ($productGroup as $item)
                            <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3 category-{{ $key }}">
                                <a class="wsus__hot_deals__single shadow-sm rounded overflow-hidden d-block" href="#">
                                    <div class="wsus__hot_deals__single_img position-relative">
                                        <img src="{{ asset($item->thumb_image) }}" alt="image"
                                            class="img-fluid w-100 product-image"
                                            style="height: 200px; object-fit: cover;">

                                        @if ($item->discount_price)
                                            <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                                                {{ round((($item->price - $item->discount_price) / $item->price) * 100) }}%
                                                OFF
                                            </span>
                                        @endif
                                    </div>
                                    <div class="wsus__hot_deals__single_text p-3">
                                        <h5 class="text-truncate mb-2">{!! limitText($item->name, 20) !!}</h5>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="wsus__tk text-dark fw-bold mb-0">
                                                @if ($item->discount_price)
                                                    <span class="text-muted text-decoration-line-through me-2 small">
                                                        Rs. {{ $item->price }}
                                                    </span>
                                                    Rs. {{ $item->discount_price }}
                                                @else
                                                    Rs. {{ $item->price }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .wsus__hot_deals__single {
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .wsus__hot_deals__single:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .monthly_top_filter button {
        margin-right: 10px;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }

    .monthly_top_filter button.active {
        background-color: #007bff;
        color: white;
    }

    .section-title {
        position: relative;
        padding-bottom: 10px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background-color: #007bff;
    }
</style>
