<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('website/img/alziyara_white_background_logo.png')); ?>">
    <title>AlZuwar Admin</title>
    <!-- ===== Bootstrap CSS ===== -->
    <link href="<?php echo e(asset('bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- ===== Plugin CSS ===== -->
    <link href="<?php echo e(asset('plugins/components/chartist-js/dist/chartist.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('plugins/components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css')); ?>"
          rel="stylesheet">
    <link href="<?php echo e(asset('plugins/components/toast-master/css/jquery.toast.css')); ?>" rel="stylesheet">

    <!-- ===== Animation CSS ===== -->
    <link href="<?php echo e(asset('css/animate.css')); ?>" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="<?php echo e(asset('css/common.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('plugins/components/datatables/jquery.dataTables.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.9.0/css/bootstrap-iconpicker.min.css"/>
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.css" rel="stylesheet" type="text/css" />


    <?php echo $__env->yieldPushContent('css'); ?>

    <!--====== Dynamic theme changing =====-->

    <?php if(session()->get('theme-layout') == 'fix-header'): ?>
        <link href="<?php echo e(asset('css/style-fix-header.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/colors/default.css')); ?>" id="theme" rel="stylesheet">

    <?php elseif(session()->get('theme-layout') == 'mini-sidebar'): ?>
        <link href="<?php echo e(asset('css/style-mini-sidebar.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/colors/default.css')); ?>" id="theme" rel="stylesheet">
    <?php else: ?>
        <link href="<?php echo e(asset('css/style-normal.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/colors/default.css')); ?>" id="theme" rel="stylesheet">
    <?php endif; ?>

    <link href="<?php echo e(asset('css/datatables.min.css')); ?>" rel="stylesheet" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.9.0/css/bootstrap-iconpicker.min.css"/>


    <!-- ===== Color CSS ===== -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        @import  url('https://fonts.googleapis.com/css?family=Fira Sans&display=swap');
        body {
            font-family: 'Fira Sans', sans-serif;
            color:#000000;
        }

        @media (min-width: 768px) {
            .extra.collapse li a span.hide-menu {
                display: block !important;
            }

            .extra.collapse.in li a.waves-effect span.hide-menu {
                display: block !important;
            }

            .extra.collapse li.active a.active span.hide-menu {
                display: block !important;
            }

            ul.side-menu li:hover + .extra.collapse.in li.active a.active span.hide-menu {
                display: block !important;
            }
        }
        .sidebar-nav ul#side-menu li a.active {
            color: #7199E9;
        }
        #side-menu ul>li>a:hover, .mini-sidebar .sidebar-nav #side-menu>li:hover>a i, .sidebar-nav ul#side-menu li a.active i{
            color: #7199E9;
        }
        .fc-listYear-button{
            display: none;
        }
        .fa-comment{
            cursor: pointer;
        }
    </style>
</head>

<body class="<?php if(session()->get('theme-layout')): ?> <?php echo e(session()->get('theme-layout')); ?> <?php endif; ?>">
<!-- ===== Main-Wrapper ===== -->
<div id="wrapper">
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <!-- ===== Top-Navigation ===== -->
<?php echo $__env->make('layouts.partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ===== Top-Navigation-End ===== -->

    <!-- ===== Left-Sidebar ===== -->
<?php echo $__env->make('layouts.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.partials.right-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- ===== Left-Sidebar-End ===== -->
    <!-- ===== Page-Content ===== -->
    <div class="page-wrapper">
        <?php echo $__env->yieldContent('content'); ?>
        <footer class="footer t-a-c">
            <div class="p-20 bg-white">
                <!--<center> 2017 © Cubic Admin / Design & Developed By <a href="https://jthemes.com" target="_blank">jThemes Studio</a> </center>-->
            </div>
        </footer>
    </div>
    <!-- ===== Page-Content-End ===== -->
</div>
<!-- ===== Main-Wrapper-End ===== -->
<!-- ==============================
    Required JS Files
=============================== -->
<!-- ===== jQuery ===== -->
<script src="<?php echo e(asset('plugins/components/jquery/dist/jquery.min.js')); ?>"></script>
<!-- ===== Bootstrap JavaScript ===== -->
<script src="<?php echo e(asset('bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<!-- ===== Slimscroll JavaScript ===== -->
<script src="<?php echo e(asset('js/jquery.slimscroll.js')); ?>"></script>
<!-- ===== Wave Effects JavaScript ===== -->
<script src="<?php echo e(asset('js/waves.js')); ?>"></script>
<!-- ===== Menu Plugin JavaScript ===== -->
<script src="<?php echo e(asset('js/sidebarmenu.js')); ?>"></script>
<!-- ===== Custom JavaScript ===== -->

<?php if(session()->get('theme-layout') == 'fix-header'): ?>
    <script src="<?php echo e(asset('js/custom-fix-header.js')); ?>"></script>
<?php elseif(session()->get('theme-layout') == 'mini-sidebar'): ?>
    <script src="<?php echo e(asset('js/custom-mini-sidebar.js')); ?>"></script>
<?php else: ?>
    <script src="<?php echo e(asset('js/custom-normal.js')); ?>"></script>
<?php endif; ?>


<!-- ===== Plugin JS ===== -->
<script src="<?php echo e(asset('plugins/components/chartist-js/dist/chartist.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/components/sparkline/jquery.sparkline.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/components/sparkline/jquery.charts-sparkline.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/components/knob/jquery.knob.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/components/easypiechart/dist/jquery.easypiechart.min.js')); ?>"></script>
<!-- ===== Style Switcher JS ===== -->
<script src="<?php echo e(asset('plugins/components/styleswitcher/jQuery.style.switcher.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.9.0/js/bootstrap-iconpicker-iconset-all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.9.0/js/bootstrap-iconpicker.min.js"></script>

<script src="<?php echo e(asset('plugins/components/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>


    

    


<script src="https://ckeditor.com/assets/libs/ckeditor4/4.16.0/ckeditor.js"></script>
<script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        url = "<?php echo e(route('upload_ck_editor_image',['_token'=>csrf_token()])); ?>";
        CKEDITOR.replace('blog',{
            height:300,
            filebrowserUploadUrl: url,
            filebrowserUploadMethod: 'form'
        });
    </script>
<script>
    CKEDITOR.replace('description');
    CKEDITOR.replace('sub_description');
</script>
<script src="<?php echo e(asset('js/jquery.PrintArea.js')); ?>" type="text/JavaScript"></script>
<script>
    $(function() {
        $("#print").on("click", function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });
    });
</script>
<script type="text/javascript">
    <?php if(session('already_requested')): ?>
        Swal.fire(
            'Sorry...',
            '<?php echo e(session('already_requested')); ?>',
            'info'
        )
//        Swal.fire(
//        'Sorry...',
        
//        'error'
//    )
//    Swal.fire(
//        'Updated...',

//        'success'
//    )
    <?php elseif(session('withdraw_request')): ?>
            Swal.fire(
            'Withdraw Request...',
            '<?php echo e(session('withdraw_request')); ?>',
            'success'
    )
    <?php endif; ?>

//        $(document).ready(function(){
//            length = 200;
//            cHtml = $(".content").html();
//            cText = $(".content").text().substr(0, length).trim();
//            $(".content").addClass("compressed").html(cText + "... <a href='#' class='exp'>More</a>");
//            window.handler = function()
//            {
//                $('.exp').click(function(){
//                    if ($(".content").hasClass("compressed"))
//                    {
//                        $(".content").html(cHtml + "<a href='#' class='exp'>Less</a>");
//                        $(".content").removeClass("compressed");
//                        handler();
//                        return false;
//                    }
//                    else
//                    {
//                        $(".content").html(cText + "... <a href='#' class='exp'>More</a>");
//                        $(".content").addClass("compressed");
//                        handler();
//                        return false;
//                    }
//                });
//            }
//            handler();
//        });
</script>
<?php echo $__env->yieldPushContent('js'); ?>
</body>

</html><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/layouts/master.blade.php ENDPATH**/ ?>