<footer style="background-color: rgb(12, 188, 53); color: white" class="footer_2">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-4">
                <div class="wsus__footer_content">
                    <a class="wsus__footer_2_logo" href="#">
                        {{-- <img src="images/logo_2.png" alt="logo"> --}}
                    </a>
                    <a class="action" href="callto:+8896254857456"><i class="fas fa-phone-alt"></i>
                        +8896254857456</a>
                    <a class="action" href="mailto:example@gmail.com"><i class="far fa-envelope"></i>
                        example@gmail.com</a>
                    <p><i class="fal fa-map-marker-alt"></i> E Waste Management, Sri Lanka</p>
                    <ul class="wsus__footer_social">
                        <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a class="whatsapp" href="#"><i class="fab fa-whatsapp"></i></a></li>
                        <li><a class="pinterest" href="#"><i class="fab fa-pinterest-p"></i></a></li>
                        <li><a class="behance" href="#"><i class="fab fa-behance"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="wsus__footer_content">
                   
                </div>
            </div>
            <div class="col-md-4">
                {{-- <div class="wsus__footer_content">
                    <h5>Support</h5>
                    <ul class="wsus__footer_menu">
                        <li><a href="#"><i class="fas fa-caret-right"></i> Career</a></li>
                        <li><a href="#"><i class="fas fa-caret-right"></i> Contact Us</a></li>
                        <li><a href="#"><i class="fas fa-caret-right"></i> Affiliate</a></li>
                       
                    </ul>
                </div> --}}
                <h5>Quick Links</h5>
                <ul class="wsus__footer_menu">
                    <li><a class="active" href="{{route('home')}}">home</a></li>
                    <li><a href="{{route('login')}}"><i class="fas fa-caret-right"></i> Vendor</a></li>
                    <li><a href="{{route('login')}}"><i class="fas fa-caret-right"></i> Knowledge Base</a></li>
                    <li><a href="#"><i class="fas fa-caret-right"></i> Hot Selling</a></li>
                    <li><a href="{{ route('home') }}#wsus__hot_deals"><i class="fas fa-caret-right"></i> Products</a></li>
                    <li><a href="{{ route('home') }}#large-banner"><i class="fas fa-caret-right"></i> E-Waste Detector</a></li>
                    <li><a href="{{route('frontend.show-collection-points.index')}}"><i class="fas fa-caret-right"></i> Collection Points</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div style="background-color: rgb(34, 134, 57)" class="wsus__footer_bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__copyright d-flex justify-content-center">
                        <p>Copyright © 2025 E - Waste Management System. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
