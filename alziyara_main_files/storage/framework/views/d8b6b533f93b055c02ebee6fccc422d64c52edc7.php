<?php $__env->startPush('css'); ?>
    <style>
        span.adults_span {padding-left: 25px;}
        input.form-control.adults {text-align: right;padding: 0;width: 40px;}
        input.form-control.childs {text-align: right;padding: 0;width: 40px;}
        input.form-control.infants {text-align: right;padding: 0;width: 40px;}
        #add_adults{margin-top: 3px}
        #remove_adults{margin-top: 3px}
        #add_childs{margin-top: 3px}
        #remove_childs{margin-top: 3px}
        #add_infants{margin-top: 3px}
        #remove_infants{margin-top: 3px}
        .dropdown_heading{display: inline-block;color:#365ca9;padding-left: 30px;padding-top: 5px;}
        .guests_dropdown{width: 250px; background-color: #ffffff}
        .card-body h3.card-title {text-decoration: none;color: #000000;}
        .card-body .final_price i {color: #DDC01A !important;}
        .card-body .final_price p {color: #000000;}
        .tab-content a:hover{text-decoration: none;}
        .card .card-img-top {height: 210px;}


        .sec-4 .tab-content .col-md-4 {
            position: relative;
        }
        .sec-4 .tab-content .col-md-4 .fa-heart {
            position: absolute;
            z-index: 99;
            top: 5%;
            right: 10%;
            font-size: 20px;
            color: white;
            background: grey;
            padding: 10px;
            border-radius: 50%;
        }
        .guestpass_view_detail .heart i:hover { background: #FF0000; transition: ease 1s;cursor: pointer;}
        .guestpass_view_detail .heart i {background-color: #eeee; transition: ease 1s}
        .mycardguestpassdescription{overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;height: 50px;}
        h3.card-title{overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;}
    </style>
<?php $__env->stopPush(); ?>
<body class="hotels transportation package transportation-details guest-passes">
<?php $__env->startSection('content'); ?>
    <!----------------- ALZIYARA SECTION ----------------------->
    <!--<section class="search_box">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-md-12">-->
    <!--                <div class="search_content">-->
    <!--                    <form>-->
    <!--                        <div class="form-group">-->
    <!--                             <input type="date" class="form-control" id="formGroupExampleInput" placeholder="Date">-->
    <!--                         </div>-->
    <!--                     <div class="input-group mb-3">-->
    <!--                       <div class="input-group-prepend">-->
    <!--                         <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker"></i></span>-->
    <!--                       </div>-->
    <!--                       <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">-->
    <!--                     </div>-->
    <!--                         <select class="form-select" aria-label="Default select example">-->
    <!--                           <option selected>Open this select menu</option>-->
    <!--                           <option value="1">One</option>-->
    <!--                           <option value="2">Two</option>-->
    <!--                           <option value="3">Three</option>-->
    <!--                         </select>-->
    <!--                         <button type="button" class="btn btn_search">Search</button>-->
    <!--                    </form>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <section class="sec-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 Alziyara text-center" data-aos="fade-right" data-aos-duration="3000">
                    <h3><?php echo ($pages->where('slug','guestpasses')->first()->title??'Not Available'); ?></h3>
                    <?php echo ($pages->where('slug','guestpasses')->first()->description??'Not Available'); ?>

                </div>
                <!--<div class="col-lg-6" data-aos="fade-left" data-aos-duration="3000">-->
                <!--    <div class="hotel_bg_img">-->
                <!--   <img src="./img/ziyarat.png" alt="Transport-service" class="img-fluid">     -->
                <!--    </div>-->

                <!--</div>-->
            </div>
        </div>
    </section>
    <section class="transport-sec sec-4">
        <div class="container">
            <!--<div class="row">
                <div class="col-md-12 col-bg-color">
                    
                    <form role="form" id="form_transport_details" class="margin-bottom-0" method="get" action="<?php echo e(route('searchguestpass')); ?>">
                        
                        <div class="form-row d-flex align-items-end">
                            <div class="form-group col-md-5">
                                <div class="input-group" id="loc-from">
                                    <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                    <select class="form-control" name="city" required>
                                        <option value="" selected disabled>City</option>
                                        <?php $__currentLoopData = $cityNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($city_name->GuestPassLocation); ?>"><?php echo e($city_name->GuestPassLocation); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>-->
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <!--<input class="total_guests" id="total_guests" name="total_guests" value="1" readonly hidden>
                            <div class="form-group col-md-5">
                                <div class="input-group" id="one-way">
                                    <div class="dropdown keep-open">-->
                                        <!-- Dropdown Button -->
                                        <!--<button id="dLabel" role="button" href="#" data-toggle="dropdown" data-target="#" class="btn btn-light">
                                            <i class="fas fa-user"></i>
                                            <span class="adults_span">1</span> Adults,
                                            <span class="childs_span">0</span> Children,
                                            <span class="infants_span">0</span> Infants
                                        </button>-->
                                        <!-- Dropdown Menu -->
                                        <!--<div class="dropdown-menu guests_dropdown" role="menu" aria-labelledby="dLabel">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-12 dropdown_heading">Adults</div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_adults">-</span></div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="adults_input_field"><input type="number" class="form-control adults" name="adults" value="1" readonly min="1"></span></div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_adults">+</span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-12 dropdown_heading">Children</div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_childs">-</span></div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field"><input type="number" class="form-control childs" name="childs" value="0" readonly min="0"></span></div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_childs">+</span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-12 dropdown_heading">Infants</div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_infants">-</span></div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field"><input type="number" class="form-control infants" name="infants" value="0" readonly min="0"></span></div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_infants">+</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $('.keep-open').on({
                                            "shown.bs.dropdown": function() { $(this).attr('closable', false); },
                                            "click":             function() { },
                                            "hide.bs.dropdown":  function() { return $(this).attr('closable') == 'true'; }
                                        });

                                        $('.keep-open #dLabel').on({
                                            "click": function() {
                                                $(this).parent().attr('closable', true );
                                            }
                                        })
                                    </script>

                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <button class="btn book-now">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>-->
            <div class="row">
                <div class="col-md-8 pb-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('guestspasses')); ?>"> Shrine Programs</a></li>
                            <?php if($route_name == 'searchguestpass'): ?>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo e($search_city); ?></li>
                            <?php endif; ?>
                            
                            
                            
                        </ol>
                    </nav>
                </div>
                <div class="col-md-4 pb-4">
                    <div class="form-group">
                        <div class="input-group" id="loc-from">
                            <select class="form-control" name="sort_by" id="sort_by">
                                <option value="disable" selected disabled="">Sort by  </option>
                                <option value="price_high_to_low"> Price(high to low) </option>
                                <option value="price_low_to_high"> Price(low to high) </option>
                                <option value="max_reviews">       Most Reviews        </option>
                                <option value="min_reviews">       Least Reviews        </option>
                                <option value="rating_high_to_low">Rating(high to low)</option>
                                <option value="rating_low_to_high">Rating(low to high)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!------------- UMRAH PACKAGE SECTION STARTS ---------------->
    <section class="sec-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item view_all">
                            <a class="nav-link active" href="<?php echo e(URL::to("/guestspasses/")); ?>" role="tab">View All</a>
                        </li>
                        <?php if($route_name != 'searchguestpass'): ?>
                            <?php $__currentLoopData = $cityNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <li class="nav-item">
                                    <a class="nav-link <?php if($route_name == 'guestspassesbycity/'.$city_name->GuestPassLocation): ?> active <?php endif; ?>" href="<?php echo e(URL::to("/guestspassesbycity/")); ?>/<?php echo e($city_name->GuestPassLocation); ?>" role="tab"><?php echo e(ucfirst($city_name->GuestPassLocation)); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content" id="guestpass_card_section">
                        <?php echo $__env->make('website.guestpass_card_section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function(){
            $("#add_adults").click(function(){
                adults = parseInt($(".adults").val());

                if(adults>=1 && adults<30){
                    adults = adults+1;
                    $('.adults').val(adults);
                    $('#total_guests').val(total_guests);
                    total_guests = parseInt($(".adults").val())+parseInt($(".childs").val())+parseInt($(".infants").val());
                    $('#total_guests').val(total_guests);
                    $(".adults_span").html(adults);
                }
            });
            $("#remove_adults").click(function(){
                adults = $(".adults").val();
                if(adults>1){
                    adults = parseInt(adults)-1;
                    $('.adults').val(adults);
                    total_guests = parseInt($(".adults").val())+parseInt($(".childs").val())+parseInt($(".infants").val());
                    $('#total_guests').val(total_guests);
                    $(".adults_span").html(adults);
                }
            });

            $("#add_childs").click(function(){
                childs = parseInt($(".childs").val());
                if(childs>=0 && childs<30){
                    childs = childs+1;
                    $('.childs').val(childs);
                    total_guests = parseInt($(".adults").val())+parseInt($(".childs").val())+parseInt($(".infants").val());
                    $('#total_guests').val(total_guests);
                    $(".childs_span").html(childs);
                }
            });
            $("#remove_childs").click(function(){
                childs = $(".childs").val();
                if(childs>0){
                    childs = parseInt(childs)-1;
                    $('.childs').val(childs);
                    total_guests = parseInt($(".adults").val())+parseInt($(".childs").val())+parseInt($(".infants").val());
                    $('#total_guests').val(total_guests);
                    $(".childs_span").html(childs);
                }
            });

            $("#add_infants").click(function(){
                infants = parseInt($(".infants").val());
                if(infants>=0 && infants<30){
                    infants = infants+1;
                    $('.infants').val(infants);
                    total_guests = parseInt($(".adults").val())+parseInt($(".childs").val())+parseInt($(".infants").val());
                    $('#total_guests').val(total_guests);
                    $(".infants_span").html(infants);
                }
            });
            $("#remove_infants").click(function(){
                infants = $(".infants").val();
                if(infants>0){
                    infants = parseInt(infants)-1;
                    $('.infants').val(infants);
                    total_guests = parseInt($(".adults").val())+parseInt($(".childs").val())+parseInt($(".infants").val());
                    $('#total_guests').val(total_guests);
                    $(".infants_span").html(infants);
                }
            });
        });
    </script>
    <script>
        //        function getGuestPassBYCity(cityName)
        //        {
        //            alert(cityName);
        //            $('.'+cityName).html('');
        //            $('.'+cityName).append( "<p>"+cityName+"</p>" );
        
        
        
        
        
        
        
        
        
        //        }
    </script>
    <script>
        $(document).ready(function(){
            $(".heart").click(function(){
                if($(this).attr('attr') =='heart_checked'){
                    <?php if(Auth::id()): ?>
                    // alert('RemoveFavorite');
                    <?php if($route_name=='view-favorites'): ?>
                    $(this).parent().parent().parent().css( "display", "none" );
                    <?php endif; ?>
                    $.get('<?php echo e(URL::to("remove-favorite-property")); ?>/'+$(this).attr('PropertyID')+'/'+$(this).attr('CategoryID'),function(data){
                        console.log(data);
                        Swal.fire({
                            icon: 'success',
                            title: 'Favorites',
                            text: data,
                        })
                    });
                    $(this).css('background','gray');
                    $(this).attr('attr','heart_unchecked');
                    <?php endif; ?>
                }else{
                    <?php if(Auth::id()): ?>
                    // alert('Add Favorite');
                    $.get('<?php echo e(URL::to("add-favorite-property")); ?>/'+$(this).attr('PropertyID')+'/'+$(this).attr('CategoryID'),function(data){
                        console.log(data);
                        Swal.fire({
                            icon: 'success',
                            title: 'Favorites',
                            text: data,
                        })
                    });
                    $(this).css('background','red');
                    $(this).attr('attr','heart_checked');
                    <?php else: ?>
                    Swal.fire({
                        icon: 'info',
                        title: 'Favorites',
                        text: 'Please login to add in favorites.',
                        footer: '<a href="login">Login?</a>'
                    })
                    <?php endif; ?>

                }
            });
        });

    </script>
    <script>
    $(document).ready(function() {
        $("#sort_by").change(function () {
//            alert($("#sort_by").val());
            <?php if($route_name == 'guestspasses'): ?>
                $.get('<?php echo e(URL::to("guestpass-sorting")); ?>/' + $("#sort_by").val(), function (data) {
                $('#guestpass_card_section').empty();
                $('#guestpass_card_section').html(data);
            });
            $('#guestpass_card_section').on('click', '.pagination a', function (e) {
                e.preventDefault();
                var url = $(this).attr("href");
                $.get(url, function (data) {
                    $('#guestpass_card_section').empty();
                    $('#guestpass_card_section').html(data);
                });
            });
            <?php else: ?>
            $.get('<?php echo e(URL::to("guestpass-sorting-with-city")); ?>/'+$("#sort_by").val()+'/<?php echo e($cityName); ?>',function(data){
                $('#guestpass_card_section').empty();
                $('#guestpass_card_section').html(data);
            });
            $('#guestpass_card_section').on('click', '.pagination a', function (e) {
                e.preventDefault();
                var url = $(this).attr("href");
                $.get(url, function (data) {
                    $('#guestpass_card_section').empty();
                    $('#guestpass_card_section').html(data);
                });
            });
            <?php endif; ?>
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('website.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/guestspass.blade.php ENDPATH**/ ?>