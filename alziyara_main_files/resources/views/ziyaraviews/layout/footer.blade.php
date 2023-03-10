<!--- ======== FOOTER SECTION ======== -->

<footer class="alziyara-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-ft1">
                <img src="./img/logo.png" alt="">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                <ul class="list-unstyled pb-3 pt-3">
                    <li><a href="tel:+1 123 456 7890"><i class="fas fa-phone-alt"></i> +1 123 456 7890</a></li>
                    <li><a href="mailto:info@Alziyara.com"><i class="fas fa-envelope"></i> info@Alziyara.com</a></li>
                    <li><a href="#"><i class="fas fa-map-marker-alt"></i> 2678 Bee Street, Grand <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rapids, Michigan</a></li>
                </ul>
                <a href="#!"><img src="./img/paypal.png" alt="" class="img-fluid"></a>
                <a href="#!"><img src="./img/american-express.png" alt="" class="img-fluid"></a>
                <a href="#!"><img src="./img/discover.png" alt="" class="img-fluid"></a>
                <a href="#!"><img src="./img/zelle.png" alt="" class="img-fluid"></a>
                
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
                    <li><a href="./flights.php">Flights</a></li>
                    <li><a href="#!">Flight from US</a></li>
                    <li><a href="./hotels.php">Hotels Deals in Popular Cities</a></li>
                    <li><a href="./transportation.php">Transportation</a></li>
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
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Why Al Ziyara</a></li>
                    <li><a href="#">Media</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                    <li><a href="privacy-policy.php">Privacy Policy</a></li>
                    <li><a href="#">Terms of Services</a></li>

                </ul>
            </div>
            <div class="col-lg-12 text-center pt-5">
                <p style="color: #2D2D2D; font-size:15px;">©2021 Alziyara. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script>
    $(document).ready(function(){

    $('.input-daterange').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    calendarWeeks : true,
    clearBtn: true,
    disableTouchKeyboard: true
    });
    
    });
</script>
<script>
  AOS.init();
</script>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        slidesPerGroup: 3,
        loop: true,
        loopFillGroupWithBlank: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    </script>

<script>
        function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
    </script>   
    <script type="text/javascript">
        function setDatepicker(_this) {
  
            /* Get the parent class name so we 
                can show date picker */
            let className = $(_this).parent()
                .parent().parent().attr('class');
  
            // Remove space and add '.'
            let removeSpace = className.replace(' ', '.');
  
            // jQuery class selector
            $("." + removeSpace).datepicker({
                format: "dd/mm/yyyy",
  
                // Positioning where the calendar is placed
                orientation: "bottom auto",
                // Calendar closes when cursor is 
                // clicked outside the calendar
                autoclose: true,
                showOnFocus: "false"
            });
        }
    </script>
<script>
    $(function() {
   $("li.nav-item").click(function() {
      // remove classes from all
      $("li.nav-item").removeClass("active");
      // add class to the one we clicked
      $(this).addClass("active");
   });
});
</script>

<script>
$('#pickup-date input[name="daterange"]').daterangepicker();
</script>

// <script>
//     $('a.btn.reserve-now').click(function(){
//         $('div#largeModal').addClass('modal_display');
//     });
// </script>

// <script>
//     $(document).ajaxStart(function(){
//         $('.modal_display .modal-header .close').click(function(){
//             $('div#largeModal').removeClass('modal_display');
//         });
//     });
// </script>
   