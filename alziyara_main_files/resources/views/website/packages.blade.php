@extends('website.layout.master')
<body class="hotels transportation package transportation-details">
@push('css')
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
<style>
    .alziyara-footer{
        width: 99vw;
        position: absolute;
        left: 0px;
    }
</style>
@endpush
<body class="hotels transportation package transportation-details">

    @section('content')

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

                    <h3>{!!($packagesdeals->where('slug','packagedeals')->first()->title??'Not Available') !!}</h3>
                    <p style="color: black;">{!!($packagesdeals->where('slug','packagedeals')->first()->description??'Not Available') !!}</p>


                </div>
                {{--<div class="col-lg-6" data-aos="fade-left" data-aos-duration="3000">--}}
                    {{--<div class="hotel_bg_img">--}}
                        {{--<img src="./img/ziyarat.png" alt="Transport-service" class="img-fluid">--}}
                    {{--</div>--}}

                {{--</div>--}}
            </div>
        </div>
    </section>
    {{--<section class="transport-sec sec-4">--}}
        {{--<div class="container">--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-12 col-bg-color">--}}
                        {{--<form role="form" id="form_transport_details" class="margin-bottom-0" action="{{route('search_package_deals')}}"  method="get">--}}
                        {{--<div class="form-row d-flex align-items-end">--}}
                            {{--<div class="form-group col-md-5">--}}
                                {{--<div class="input-group" id="loc-from">--}}
                                    {{--<label for=""><i class="fas fa-map-marker-alt"></i></label>--}}
                                    {{--<select class="form-control" name="owner_dm" value="{{$item->id??''}}" >--}}
                                        {{--@foreach($packageType as $item)--}}
                                        {{--<option value="{{$item->id??''}}" >{{$item->package_deals_type_desc??''}}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<!--<div class="form-group col-md-3">-->--}}
                            {{--<!--    <div class="input-group" id="pickup-date">-->--}}
                            {{--<!--    <label for=""><i class="fas fa-calendar-alt"></i></label>-->--}}
                            {{--<!--<select class="form-control" name="owner_dm">-->--}}
                            {{--<!--    <option value="">Pickup Date &amp; Time</option>-->--}}
                            {{--<!--    <option value="1">1</option>-->--}}
                            {{--<!--    </select>-->--}}
                            {{--<!--        <input type="text" name="daterange" value="01/01/2018 - 01/15/2018" class="form-control" />-->--}}
                            {{--<!--    </div>-->--}}
                            {{--<!--</div>-->--}}
                            {{--<div class="form-group col-md-5">--}}
                                {{--<input class="total_guests" id="total_guests" name="total_guests" value="1" readonly hidden>--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<div class="input-group" id="one-way">--}}
                                            {{--<div class="dropdown keep-open">--}}
                                                {{--<!-- Dropdown Button -->--}}
                                                {{--<button id="dLabel" role="button" href="#" data-toggle="dropdown" data-target="#" class="btn btn-light">--}}
                                                    {{--<i class="fas fa-bed"></i>--}}
                                                    {{--<span class="adults_span">1</span> Adults,--}}
                                                    {{--<span class="childs_span">0</span> Children,--}}
                                                    {{--<span class="infants_span">0</span> Infants--}}
                                                {{--</button>--}}
                                                {{--<!-- Dropdown Menu -->--}}
                                                {{--<div class="dropdown-menu guests_dropdown" role="menu" aria-labelledby="dLabel">--}}
                                                    {{--<div class="row">--}}
                                                        {{--<div class="col-lg-3 col-md-12 dropdown_heading">Adults</div>--}}
                                                        {{--<div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_adults">-</span></div>--}}
                                                        {{--<div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="adults_input_field"><input type="number" class="form-control adults" name="adults" value="1" readonly min="1"></span></div>--}}
                                                        {{--<div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_adults">+</span></div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="row">--}}
                                                        {{--<div class="col-lg-3 col-md-12 dropdown_heading">Children</div>--}}
                                                        {{--<div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_childs">-</span></div>--}}
                                                        {{--<div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field"><input type="number" class="form-control childs" name="childs" value="0" readonly min="0"></span></div>--}}
                                                        {{--<div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_childs">+</span></div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="row">--}}
                                                        {{--<div class="col-lg-3 col-md-12 dropdown_heading">Infants</div>--}}
                                                        {{--<div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_infants">-</span></div>--}}
                                                        {{--<div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field"><input type="number" class="form-control infants" name="infants" value="0" readonly min="0"></span></div>--}}
                                                        {{--<div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_infants">+</span></div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<script>--}}
                                                {{--$('.keep-open').on({--}}
                                                    {{--"shown.bs.dropdown": function() { $(this).attr('closable', false); },--}}
                                                    {{--"click":             function() { },--}}
                                                    {{--"hide.bs.dropdown":  function() { return $(this).attr('closable') == 'true'; }--}}
                                                {{--});--}}
{{----}}
                                                {{--$('.keep-open #dLabel').on({--}}
                                                    {{--"click": function() {--}}
                                                        {{--$(this).parent().attr('closable', true );--}}
                                                    {{--}--}}
                                                {{--})--}}
                                            <!--</script>-->
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group col-md-2">--}}
                                {{--<button class="btn book-now">Search</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
{{----}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
    <!------------- UMRAH PACKAGE SECTION STARTS ---------------->
    <section class="sec-4 ">
        <div class="container">
            {{--<div class="row">--}}
                {{--<div class="col-md-8 pb-4">--}}
                    {{--<nav aria-label="breadcrumb">--}}
                        {{--<ol class="breadcrumb">--}}
                            {{--<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>--}}
                            {{--<li class="breadcrumb-item"><a href="{{route('packages')}}">Package Deals</a></li>--}}
                            {{--@if($route_name == 'search_package_deals')--}}
                                {{--<li class="breadcrumb-item active" aria-current="page">{{$searchPackageName??''}}</li>--}}
                            {{--@else--}}
                                {{--<li class="breadcrumb-item active" aria-current="page"></li>--}}
                            {{--@endif--}}
                        {{--</ol>--}}
                    {{--</nav>--}}
                {{--</div>--}}
                {{--<div class="col-md-4 pb-4">--}}
                    {{--<div class="form-group">--}}
                        {{--<div class="input-group" id="loc-from">--}}
                            {{--<select class="form-control" name="sort_by" id="sort_by">--}}
                                {{--<option value="disable" selected disabled="">Sort by  </option>--}}
                                {{--<option value="price_high_to_low"> Price(high to low) </option>--}}
                                {{--<option value="price_low_to_high"> Price(low to high) </option>--}}
                                {{--<option value="max_reviews">       Max Reviews        </option>--}}
                                {{--<option value="min_reviews">       Min Reviews        </option>--}}
                                {{--<option value="rating_high_to_low">Rating(high to low)</option>--}}
                                {{--<option value="rating_low_to_high">Rating(low to high)</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

                    {{--<div class="container">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-md-12">--}}
                                {{--<ul class="nav nav-tabs" role="tablist">--}}
                                    {{--<li class="nav-item view_all">--}}
                                        {{--<a class="nav-link active" data-toggle="tab" href="#all_tab" role="tab">View All</a>--}}
                                    {{--</li>--}}
                                    {{--<li class="nav-item">--}}
                                        {{--<a class="nav-link" data-toggle="tab" href="#tabs-1" role="tab">Makkah</a>--}}
                                    {{--</li>--}}
                                    {{--<li class="nav-item">--}}
                                        {{--<a class="nav-link" data-toggle="tab" href="#tabs-1" role="tab">Madina</a>--}}
                                    {{--</li>--}}
                                    {{--<li class="nav-item">--}}
                                        {{--<a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Baghdad</a>--}}
                                    {{--</li>--}}
                                    {{--<li class="nav-item">--}}
                                        {{--<a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Syria</a>--}}
                                    {{--</li>--}}
                                    {{--<li class="nav-item">--}}
                                        {{--<a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Tehran</a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                                {{--<!-- Tab panes -->--}}
                                {{--<div class="tab-content">--}}
                                    {{--<div class="tab-pane active" id="tabs-1" role="tabpanel">--}}
                                        {{--<div class="row sec_hotel_detail" id="sec_hotel_detail">--}}
                                            {{--@include('website.package_card_section')--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--<div class="tab-pane" id="tabs-2" role="tabpanel">--}}
                                    {{--<p>Second Panel</p>--}}
                                {{--</div>--}}
                                {{--<div class="tab-pane" id="tabs-3" role="tabpanel">--}}
                                    {{--<p>Third Panel</p>--}}
                                {{--</div>--}}
                                {{--<div class="tab-pane" id="tabs-4" role="tabpanel">--}}
                                 {{--<p>Fourth Panel</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
    {{--</section>--}}

        <section class="sec-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 pb-4">
                        <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('packages')}}">Package Deals</a></li>
                            @if($route_name == 'search_package_deals')
                            <li class="breadcrumb-item active" aria-current="page">{{$searchPackageName??''}}</li>
                            @elseif(isset($cityName))
                            <li class="breadcrumb-item active" aria-current="page">{{$cityName??''}}</li>
                            @endif
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
                        @if(sizeof($packages)>0)
                    <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item view_all">
                    <a class="nav-link active" href="{{ URL::to("/packagesdeals/")}}" role="tab">View All</a>
                    </li>

                        @foreach($packageType as $item)
                        <li class="nav-item">
                                <a class="nav-link @if($route_name == 'packages-by-type/'.$item->id) active @endif" href="{{ URL::to("/packages-by-type/")}}/{{$item->id??''}}" role="tab">{{ucwords($item->package_deals_type_desc??'')}}</a>
                        </li>
                     @endforeach
                    {{--@if($route_name != 'search_package_deals')--}}
                    {{--@foreach($cityNames as $cityName)--}}
                        {{--<li class="nav-item">--}}
                        {{--<a class="nav-link @if($route_name == 'packgae_deals_by_city/'.$cityName->package_deals_location??'') active @endif" href="{{ URL::to("/packgae_deals_by_city/")}}/{{$cityName->package_deals_location??''}}" role="tab">{{ucfirst($cityName->package_deals_location??'')}}</a>--}}
                        {{--</li>--}}
                     {{--@endforeach--}}
                    {{--@endif--}}

                    </ul>
                    @else
                            <h3 class="text-center">We're sorry. We were not able to find a match.</h3>
                            <h3 class="text-center">Please modify your search and try again</h3>
                    @endif
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="all_tab" role="tabpanel">
                    <div class="row sec_hotel_detail" id="sec_hotel_detail">
                    @include('website.package_card_section')
                    </div>
                        </div>
                                @if($route_name != 'search_package_deals')
                                    @foreach($cityNames as $cityName)
                                    <div class="tab-pane" id="{{$cityName->package_deals_location}}" role="tabpanel">
                                    <div class="row {{$cityName->package_deals_location}}">
                                    @foreach($packages as $pk)
                                    @if(ucfirst($pk ->package_deals_location) == $cityName->package_deals_location)
                                    card
                                    <div class="col-md-4">

                                    card end
                                    @endif
                                    @endforeach
                                    </div>
                                    </div>
                                    @endforeach
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $("#sort_by").change(function(){
                {{--@if($route_name == 'search_package_deals')--}}
                    {{--$.get('{{ URL::to("package-sorting-with-city")}}/'+$("#sort_by").val()+'/{{$searchPackageName}}',function(data){--}}
                    // this.innerHTML('');
//                    $('.sec_hotel_detail').empty();
                    // alert('search');
//                    $('.sec_hotel_detail').html(data);
                    // console.log(data);
//                });
                {{--@else--}}

                @if($route_name == 'packagesdeals')
                    $.get('{{ URL::to("package-sorting")}}/'+$("#sort_by").val(),function(data){
                    // this.innerHTML('');
                    $('.sec_hotel_detail').empty();
                    // alert($("#sort_by").val());
                    $('.sec_hotel_detail').html(data);
                    // console.log(data);
                });
                    @else
                       $.get('{{ URL::to("package-sorting-with-type")}}/'+$("#sort_by").val()+'/{{$id??''}}',function(data){
                        $('#sec_hotel_detail').empty();
                        $('#sec_hotel_detail').html(data);
                    });




                {{--@else--}}
                    {{--// alert($("#sort_by").val());--}}
                    {{--$.get('{{ URL::to("package-sorting-with-type")}}/'+$("#sort_by").val()+'/{{$packages->package_deals_location}}',function(data){--}}
                        {{--$('#sec_hotel_detail').empty();--}}
                        {{--$('#sec_hotel_detail').html(data);--}}
                    {{--});--}}
                    {{--$('#package_card_section').on('click', '.pagination a', function (e) {--}}
                        {{--e.preventDefault();--}}
                        {{--var url = $(this).attr("href");--}}
                        {{--$.get(url, function (data) {--}}
                            {{--$('#sec_hotel_detail').empty();--}}
                            {{--$('#sec_hotel_detail').html(data);--}}
                        {{--});--}}
                    {{--});--}}
                @endif
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
                    @if(Auth::id())
                    // alert('RemoveFavorite');
                    @if($route_name=='view-favorites')
                    $(this).parent().parent().parent().css( "display", "none" );
                    @endif
                    $.get('{{ URL::to("remove-favorite-property")}}/'+$(this).attr('PropertyID')+'/'+$(this).attr('CategoryID'),function(data){
                        console.log(data);
                        Swal.fire({
                            icon: 'success',
                            title: 'Favorites',
                            text: data,
                        })
                    });
                    $(this).css('background','gray');
                    $(this).attr('attr','heart_unchecked');
                    @endif
                }else{
                    @if(Auth::id())
                    // alert('Add Favorite');
                    $.get('{{ URL::to("add-favorite-property")}}/'+$(this).attr('PropertyID')+'/'+$(this).attr('CategoryID'),function(data){
                        console.log(data);
                        Swal.fire({
                            icon: 'success',
                            title: 'Favorites',
                            text: data,
                        })
                    });
                    $(this).css('background','red');
                    $(this).attr('attr','heart_checked');
                    @else
                    Swal.fire({
                        icon: 'info',
                        title: 'Favorites',
                        text: 'Please login to add in favorites.',
                        footer: '<a href="login">Login?</a>'
                    })
                    @endif

                }
            });
        });

        jQuery('.pagination>li:first-child .page-link').text('Previous');
        jQuery('.pagination>li:last-child .page-link').text('Next');
    </script>
@endpush