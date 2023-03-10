<footer class="alziyara-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-ft1">
                <img src="{{ asset('website') }}/img/logo.png" alt="">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore.</p>
                <ul class="list-unstyled pb-3 pt-3">
                    <li><a href="tel:+1 123 456 7890"><i class="fas fa-phone-alt"></i> +1 123 456 7890</a></li>
                    <li><a href="mailto:info@Alziyara.com"><i class="fas fa-envelope"></i> info@Alziyara.com</a>
                    </li>
                    <li><a href="#"><i class="fas fa-map-marker-alt"></i> 2678 Bee Street, Grand <br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rapids, Michigan</a></li>
                </ul>
                <a href="#!"><img src="{{ asset('website') }}/img/paypal.png" alt="" class="img-fluid"></a>
                <a href="#!"><img src="{{ asset('website') }}/img/american-express.png" alt="" class="img-fluid"></a>
                <a href="#!"><img src="{{ asset('website') }}/img/discover.png" alt="" class="img-fluid"></a>
                <a href="#!"><img src="{{ asset('website') }}/img/zelle.png" alt="" class="img-fluid"></a>

            </div>
            <div class="col-lg-3">
                <h3>Partners</h3>
                <ul class="list-unstyled ">
                    <li><a href="#">Work With Us</a></li>
                    <li><a href="#">Advertise With Us</a></li>

                </ul>

                <h3>Explore</h3>
                <ul class="list-unstyled ">
                    <li><a href="#">Cities</a></li>
                    <li><a href="{{route('flight')}}">Flights</a></li>
                    <li><a href="#!">Flight from US</a></li>
                    <li><a href="{{route('hotels')}}">Hotels Deals in Popular Cities</a></li>
                    <li><a href="{{route('Transport')}}">Transportation</a></li>
                    <li><a href="#">Travel Insurance</a></li>
                    <li><a href="#">Donations</a></li>

                </ul>
            </div>
            <div class="col-lg-3">
                <h3>Help</h3>
                <ul class="list-unstyled ">
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Privacy Settings</a></li>



                </ul>
                <h3>Al Ziyara</h3>
                <ul class="list-unstyled ">
                    <li><a href="{{route('aboutus')}}">About Us</a></li>
                    <li><a href="#">Why Al Ziyara</a></li>
                    <li><a href="#">Media</a></li>
                    <li><a href="">Cookie Policy</a></li>
                    <li><a href="{{route('privacypolicy')}}">Privacy Policy</a></li>
                    <li><a href="{{URL('terms-and-conditions')}}">Terms of Services</a></li>
                </ul>
            </div>
            <div class="col-lg-12 text-center pt-5">
                <p style="color: #2D2D2D; font-size:15px;">©2021 Alziyara. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>