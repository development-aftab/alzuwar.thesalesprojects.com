<?php $__env->startPush('css'); ?>
    <style>
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
        .transportation_view_detail i:hover { background: #FF0000; transition: ease 1s;cursor: pointer;}
        .transportation_view_detail i {background-color: transparent; transition: ease 1s}
    </style>
<?php $__env->stopPush(); ?>

<body class="hotels transportation transportation-details">

<?php $__env->startSection('content'); ?>

    <section class="sec-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 Alziyara text-center" data-aos="fade-right" data-aos-duration="3000">
                    <h3>Transportation</h3>
                    <p>Find and compare affordable and comfortable transportation options for your trip. You can book now and pay later</p>
                </div>
                <!--<div class="col-lg-6" data-aos="fade-left" data-aos-duration="3000">-->
                <!--    <div class="hotel_bg_img">-->
                <!--   <img src="./img/transportation-bus.png" alt="Transport-service" class="img-fluid">     -->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
    </section>

    <section class="transport-sec sec-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-bg-color">
                    <form role="form" id="form_transport_details" class="margin-bottom-0" action="<?php echo e(Route('search-transportation')); ?>" method="get">
                        <?php echo csrf_field(); ?>
                        <div class="form-row d-flex" style="align-item:end;">
                            <div class="form-group col-md-3">
                                <label for="">Pickup City</label>
                                <div class="input-group" id="loc-from">
                                    <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                    <select class="form-control" name="route_from" id="route_from" required>
                                        <!--<option value="disable">From</option>-->
                                        <?php $__currentLoopData = $transportation_routes_from; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transportation_route_from): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($transportation_route_from->RouteFrom); ?>"
                                                    <?php if(Session::has('RouteFrom')): ?>
                                                        <?php if($transportation_route_from->RouteFrom == Session::get('RouteFrom')): ?>
                                                            selected
                                                        <?php endif; ?>
                                                    <?php elseif($transportation_route_from->RouteFrom =='Karbala'): ?>
                                                        selected
                                                    <?php endif; ?>>
                                                <?php echo e($transportation_route_from->RouteFrom); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Destination City:</label>
                                <div class="input-group" id="loc-from">
                                    <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                    <select class="form-control" name="route_to" id="route_to" required readonly="true">
                                        <!--<option value="disable">To</option>-->
                                        <?php $__currentLoopData = $transportation_routes_to; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transportation_route_to): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($transportation_route_to->RouteTo); ?>" <?php if(Session::has('RouteTo')): ?> <?php if(Session::get('RouteTo') == $transportation_route_to->RouteTo): ?> selected  <?php endif; ?>   <?php elseif($transportation_route_to->RouteTo=='Najaf'): ?> selected <?php endif; ?>><?php echo e($transportation_route_to->RouteTo); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Pickup On:</label>
                                <div class="input-group" id="pickup-date">
                                    <div class="input-group">
                                        <input type="date" id="start" name="start" class="form-control text-left mr-2" value="<?php echo e($date??Date('Y-m-d', strtotime('+2 day'))); ?>" min="<?php echo e($date??Date('Y-m-d', strtotime('+2 day'))); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for=""></label>
                                <button class="btn book-now">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!------------- UMRAH PACKAGE SECTION STARTS ---------------->
    <section class="sec-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8 pb-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('Transport')); ?>">Transportation</a></li>
                            <?php if($route_name == 'search-transportation'): ?>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo e(ucfirst($transportation_routes_from_name)); ?> to <?php echo e(ucfirst($transportation_routes_to_name)); ?></li>
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
                                <option value="max_reviews">       Most Reviews       </option>
                                <option value="min_reviews">       Least Reviews        </option>
                                <option value="rating_high_to_low">Rating(high to low)</option>
                                <option value="rating_low_to_high">Rating(low to high)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item view_all">
                            <a class="nav-link active" href="<?php echo e(URL::to("/Transportation/")); ?>" role="tab">View All</a>
                        </li>
                        <?php $__currentLoopData = $transportation_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transportation_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if($route_name == 'transportation-by-type/'.$transportation_type->TransportationTypeID): ?> active <?php endif; ?>" href="<?php echo e(URL::to("/transportation-by-type/")); ?>/<?php echo e($transportation_type->TransportationTypeID); ?>" role="tab"><?php echo e(ucwords($transportation_type->TransportationTypeDesc??'')); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content" id="transportation_card_section">
                        <?php echo $__env->make('website.transportation_card_section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        $('#route_from').on('change', function() {
            $.get('<?php echo e(URL::to("get-transportation-route-to")); ?>/'+this.value,function(data){
                $('#route_to').empty();
                $('#route_to').prop('readonly', false);
                $('#route_to').append('<option value="disable" disabled selected>To</option>');
                for (var item in data) {
                    $('#route_to').append('<option value='+data[ item ]["RouteTo"]+'>'+data[ item ]["RouteTo"]+'</option>');
                    // console.log(data[ item ]['RouteTo']);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#sort_by").change(function () {
                <?php if($route_name == 'Transportation'): ?>
                    $.get('<?php echo e(URL::to("transportation-sorting")); ?>/' + $("#sort_by").val(), function (data) {
                        $('#transportation_card_section').empty();
                        $('#transportation_card_section').html(data);

                    });
                $('#transportation_card_section').on('click', '.pagination a', function (e) {
                    e.preventDefault();
                    var url = $(this).attr("href");
                    $.get(url, function (data) {
                        $('#transportation_card_section').empty();
                        $('#transportation_card_section').html(data);
                    });
                });
                <?php elseif($route_name == 'search-transportation'): ?>
                // alert($("#sort_by").val());
                    $.get('<?php echo e(URL::to("searched-transportation-sorting")); ?>/'+$("#sort_by").val()+'/<?php echo e($searched_transportation_id); ?>/<?php echo e($type); ?>',function(data){
                        $('#transportation_card_section').empty();
                        $('#transportation_card_section').html(data);
                    });
                    $('#transportation_card_section').on('click', '.pagination a', function (e) {
                        e.preventDefault();
                        var url = $(this).attr("href");
                        $.get(url, function (data) {
                            $('#transportation_card_section').empty();
                            $('#transportation_card_section').html(data);
                        });
                    });
                <?php else: ?>
                    // alert($("#sort_by").val());
                    $.get('<?php echo e(URL::to("transportation-sorting-with-type")); ?>/'+$("#sort_by").val()+'/<?php echo e($TransportationTypeID); ?>',function(data){
                        $('#transportation_card_section').empty();
                        $('#transportation_card_section').html(data);
                    });
                    $('#transportation_card_section').on('click', '.pagination a', function (e) {
                        e.preventDefault();
                        var url = $(this).attr("href");
                        $.get(url, function (data) {
                            $('#transportation_card_section').empty();
                            $('#transportation_card_section').html(data);
                        });
                    });
                <?php endif; ?>

                // $('#transportation_card_section').on('click','.pagination a',function (e){
                //     e.preventDefault();
                //     var url = $(this).attr("href");
                //     $.get(url,function(data){
                //         $('#transportation_card_section').empty();
                //         $('#transportation_card_section').html(data);
                //     });
                // });
            });
        });
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('website.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/transport.blade.php ENDPATH**/ ?>