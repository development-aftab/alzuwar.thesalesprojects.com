
<body class="hotels transportation package transportation-details">
<?php $__env->startPush('css'); ?>
<link href="<?php echo e(asset('css/customCss.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('css/responsive.css')); ?>" rel="stylesheet" />
<style>
    .alziyara-footer{
        width: 99vw;
        position: absolute;
        left: 0px;
    }
</style>
<?php $__env->stopPush(); ?>
<body class="hotels transportation package transportation-details">

    <?php $__env->startSection('content'); ?>

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
                <div class="col-lg-12 Alziyara" data-aos="fade-right" data-aos-duration="3000">

                    <h3><?php echo ($packagesdeals->where('slug','packagedeals')->first()->title??'Not Available'); ?></h3>
                    <p style="color: black;"><?php echo ($packagesdeals->where('slug','packagedeals')->first()->description??'Not Available'); ?></p>


                </div>
                
                    
                        
                    

                
            </div>
        </div>
    </section>
    
        
            
                
                        
                        
                            
                                
                                    
                                    
                                        
                                        
                                        
                                    
                                
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                                
                                
                                    
                                        
                                            
                                                
                                                
                                                    
                                                    
                                                    
                                                    
                                                
                                                
                                                
                                                    
                                                        
                                                        
                                                        
                                                        
                                                    
                                                    
                                                        
                                                        
                                                        
                                                        
                                                    
                                                    
                                                        
                                                        
                                                        
                                                        
                                                    
                                                
                                            
                                            
                                                
                                                    
                                                    
                                                    
                                                

                                                
                                                    
                                                        
                                                    
                                                
                                            <!--</script>-->
                                        
                                    
                                
                            
                            
                                
                            
                        
                    

                
            
        
    
    <!------------- UMRAH PACKAGE SECTION STARTS ---------------->
    <section class="sec-4 ">
        <div class="container">
            
                
                    
                        
                            
                            
                            
                                
                            
                                
                            
                        
                    
                
                
                    
                        
                            
                                
                                
                                
                                
                                
                                
                                
                            
                        
                    
                
            
        

                    
                        
                            
                                
                                    
                                        
                                    
                                    
                                        
                                    
                                    
                                        
                                    
                                    
                                        
                                    
                                    
                                        
                                    
                                    
                                        
                                    
                                
                                
                                
                                    
                                        
                                            
                                        
                                    
                                
                                    
                                
                                
                                    
                                
                                
                                 
                                
                            
                        
                    
                    
    

        <section class="sec-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 pb-4">
                        <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('packages')); ?>">Package Deals</a></li>
                            <?php if($route_name == 'search_package_deals'): ?>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo e($searchPackageName??''); ?></li>
                            <?php elseif(isset($cityName)): ?>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo e($cityName??''); ?></li>
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
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php if(sizeof($packages)>0): ?>
                    <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item view_all">
                    <a class="nav-link active" href="<?php echo e(URL::to("/packagesdeals/")); ?>" role="tab">View All</a>
                    </li>

                        <?php $__currentLoopData = $packageType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item">
                                <a class="nav-link <?php if($route_name == 'packages-by-type/'.$item->id): ?> active <?php endif; ?>" href="<?php echo e(URL::to("/packages-by-type/")); ?>/<?php echo e($item->id??''); ?>" role="tab"><?php echo e(ucwords($item->package_deals_type_desc??'')); ?></a>
                        </li>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    
                        
                        
                        
                     
                    

                    </ul>
                    <?php else: ?>
                            <h3 class="text-center">We're sorry. We were not able to find a match.</h3>
                            <h3 class="text-center">Please modify your search and try again</h3>
                    <?php endif; ?>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="all_tab" role="tabpanel">
                    <div class="row sec_hotel_detail" id="sec_hotel_detail">
                    <?php echo $__env->make('website.package_card_section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                        </div>
                                <?php if($route_name != 'search_package_deals'): ?>
                                    <?php $__currentLoopData = $cityNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cityName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane" id="<?php echo e($cityName->package_deals_location); ?>" role="tabpanel">
                                    <div class="row <?php echo e($cityName->package_deals_location); ?>">
                                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(ucfirst($pk ->package_deals_location) == $cityName->package_deals_location): ?>
                                    card
                                    <div class="col-md-4">

                                    card end
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function(){
            $("#sort_by").change(function(){
                
                    
                    // this.innerHTML('');
//                    $('.sec_hotel_detail').empty();
                    // alert('search');
//                    $('.sec_hotel_detail').html(data);
                    // console.log(data);
//                });
                

                <?php if($route_name == 'packagesdeals'): ?>
                    $.get('<?php echo e(URL::to("package-sorting")); ?>/'+$("#sort_by").val(),function(data){
                    // this.innerHTML('');
                    $('.sec_hotel_detail').empty();
                    // alert($("#sort_by").val());
                    $('.sec_hotel_detail').html(data);
                    // console.log(data);
                });
                    <?php else: ?>
                       $.get('<?php echo e(URL::to("package-sorting-with-type")); ?>/'+$("#sort_by").val()+'/<?php echo e($id??''); ?>',function(data){
                        $('#sec_hotel_detail').empty();
                        $('#sec_hotel_detail').html(data);
                    });




                
                    
                    
                        
                        
                    
                    
                        
                        
                        
                            
                            
                        
                    
                <?php endif; ?>
                $('#sec_hotel_detail').on('click','.pagination a',function (e){
                    e.preventDefault();
                    var url = $(this).attr("href");
                    $.get(url,function(data){
                        $('.sec_hotel_detail').empty();
                        $('.sec_hotel_detail').html(data);
                    });
                    // $("html, body").animate({
                    //     scrollTop: 0
                    // }, 9000);
                });
            });
        });
    </script>
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

        jQuery('.pagination>li:first-child .page-link').text('Previous');
        jQuery('.pagination>li:last-child .page-link').text('Next');
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('website.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/packages.blade.php ENDPATH**/ ?>