<section id="wsus__banner" class="position-relative">
    <div class="container-fluid px-0">
        <div class="row g-0">
            <div class="col-12">
                <div class="wsus__banner_content">
                    <div class="banner_slider position-relative">
                        @foreach ($sliders as $slider)
                            <div class="wsus__single_slider position-relative" 
                                 style="background-image: url('{{ $slider->banner }}');
                                        background-size: cover;
                                        background-position: center;
                                        height: 100vh;
                                        background-repeat: no-repeat;">
                                
                                <div class="container position-absolute top-50 start-0 translate-middle-y">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-10">
                                            {{-- <div class="wsus__single_slider_text 
                                                        animate__animated animate__fadeInLeft 
                                                        text-white 
                                                        p-4 
                                                        rounded" 
                                                 style="background-color: rgba(0,0,0,0.5);
                                                        box-shadow: none;">
                                                
                                                @if($slider->header_3)
                                                    <h6 class="text-uppercase mb-2 
                                                               fw-light 
                                                               text-warning">
                                                        {!! $slider->header_3 !!}
                                                    </h6>
                                                @endif
                                                
                                                @if($slider->header_1)
                                                    <h1 class="display-4 
                                                               fw-bold 
                                                               mb-3 
                                                               text-white">
                                                        {!! $slider->header_1 !!}
                                                    </h1>
                                                @endif
                                                
                                                @if($slider->header_2)
                                                    <h3 class="mb-4 
                                                               fw-light 
                                                               text-light">
                                                        {!! $slider->header_2 !!}
                                                    </h3>
                                                @endif
                                                
                                                @if($slider->btn_url)
                                                    <a href="{{ $slider->btn_url }}" 
                                                       class="btn btn-primary btn-lg 
                                                              text-uppercase 
                                                              rounded-pill 
                                                              px-4">
                                                        Shop Now
                                                    </a>
                                                @endif
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    .banner_slider .slick-dots {
        bottom: 30px;
    }
    .banner_slider .slick-dots li button:before {
        color: white;
        opacity: 0.5;
    }
    .banner_slider .slick-dots li.slick-active button:before {
        color: white;
        opacity: 1;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function(){
        $('.banner_slider').slick({
            dots: true,
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear',
            autoplay: true,
            autoplaySpeed: 3000,
        });
    });
</script>
@endpush