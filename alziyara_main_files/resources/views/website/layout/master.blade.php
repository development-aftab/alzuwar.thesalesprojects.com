<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('website/img/alziyara_white_background_logo.png')}}">
    <title>AlZuwar</title>

    <!-- Bootstrap core CSS -->
    <!-- <link rel="stylesheet" href="{{ asset('website') }}/css/style.css"> -->
    <!-- <link rel="stylesheet" href="{{ asset('website') }}/css/responsive.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>

    <!-- Custom styles for this template -->
    <link href="{{ asset('website') }}/css/carousel.css" rel="stylesheet">

    <link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
    <style>
        .account-title{
            margin: 10px;
            font-weight: bold;
        }
    </style>
    @stack('css')
</head>
@include('website.header')
@yield('content')
@include('website.footer')
@include('website.google_multi_langual')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
{{--<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>--}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    @if(session()->has('msg'))
            Swal.fire("{{session()->get('title')??""}}","{{session()->get('msg')??""}}","{{session()->get('type')??""}}")
    @endif
</script>
<script>
$(document).ready(function() {
    $('.input-daterange').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        calendarWeeks: true,
        clearBtn: true,
        disableTouchKeyboard: true
    });
});
</script>
<script>
AOS.init({
    disable: true,
});
</script>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    breakpoints: {
        320: {
            slidesPerView: 1,
            spaceBetween: 0,
            slidesPerGroup: 1,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 10,
            slidesPerGroup: 2,
        },
        1280: {
    slidesPerView: 3,
    spaceBetween: 30,
    slidesPerGroup: 3,
        },
    },
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

<script>
//     $('a.btn.reserve-now').click(function(){
//         $('div#largeModal').addClass('modal_display');
//     });
// 
</script>

<script>
//     $(document).ajaxStart(function(){
//         $('.modal_display .modal-header .close').click(function(){
//             $('div#largeModal').removeClass('modal_display');
//         });
//     });
//
</script>

<script type="text/javascript">
    @if(session('no_transportation_found'))
        Swal.fire(
            'Sorry...',
            '{{session('no_transportation_found')}}',
            'error'
        )
    @elseif(session('no_guide_found'))
    Swal.fire(
        'Sorry...',
        '{{session('no_guide_found')}}',
        'error'
    )
    @elseif(session('no_favourite_found'))
    Swal.fire(
        'Sorry...',
        '{{session('no_favourite_found')}}',
        'info'
    )
    @elseif(session('update_profile'))
    Swal.fire(
        'Updated...',
        '{{session('update_profile')}}',
        'success'
    )
    @elseif(session('vendors_not_allowed'))
    Swal.fire(
        'Sorry...',
        '{{session('vendors_not_allowed')}}',
        'error'
    )
    @endif
</script>

@stack('js')
</body>

</html>