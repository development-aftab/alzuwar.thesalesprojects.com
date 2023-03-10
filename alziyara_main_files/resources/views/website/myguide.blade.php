@push('css')
    <style>
        span.adults_span {padding-left: 25px;}
        input.form-control.adults_hotels {text-align: right;padding: 0;width: 40px;}
        input.form-control.childs_hotels {text-align: right;padding: 0;width: 40px;}
        input.form-control.infants_hotels {text-align: right;padding: 0;width: 40px;}
        #add_adults{margin-top: 3px}
        #remove_adults{margin-top: 3px}
        #add_childs{margin-top: 3px}
        #remove_childs{margin-top: 3px}
        #add_infants{margin-top: 3px}
        #remove_infants{margin-top: 3px}
        .dropdown_heading{display: inline-block;color:#365ca9;padding-left: 23px;padding-top: 5px;}
        .guests_dropdown{width: 250px; background-color: #ffffff}
        .guests_dropdown input {padding: 0px !important; text-align: center; padding-left: 12px !important;}
        .fa, .fas {font-weight: 900;font-size: 21px;color: #365ca9;}
        .fa, .far {font-size: 21px;}
        .dropdown{width:100%; text-align: left;}
        .dropdown button{width:107%; text-align: left;border-color: #cfd5db;background: none !important;padding-left: 28px;}
        span.adults_span_hotels{padding-left: 20px;}
        .hotels .sec-5 .form-group select { max-width: 52%; border-radius: 5px; }
        .hotels .sec-5 .form-group select>option { font-size: 15px; font-weight: 400;  }
        .hotel_img>img {  height: 100%;  border-radius: 20px;  }
        .hotel_view_detail i:hover { background: #FF0000; transition: ease 1s;cursor: pointer;}
        .hotel_view_detail i {background-color: #eeee; transition: ease 1s}
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
        .guide_view_detail i:hover { background: #FF0000; transition: ease 1s;cursor: pointer;}
        .guide_view_detail i { transition: ease 1s}
    </style>
@endpush
@extends('website.layout.master')
<body class="hotels transportation transportation-details">

@section('content')


    <section class="transport-sec sec-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-bg-color">
                        <form role="form" method="get" action="{{ route('search-guide') }}" id="form_transport_details" class="margin-bottom-0">
                            {{--@csrf--}}
                            <div class="form-row d-flex" style="align-item:end;">
                                <div class="form-group col-md-3">
                                    <label>Date</label>
                                    <div class="input-group" id="pickup-date">
                                        <label for=""><i class="fas fa-calendar-alt"></i></label>
                                        <?php
                                        // $tour_start_date=date('m/d/Y');
                                        // $tour_end_date=Date('m/d/Y', strtotime('+10 days'));
                                        // $default_checkin=Date('m/d/Y', strtotime('+7 days'));
                                        // $default_checkout=Date('m/d/Y', strtotime('+17 days'));
                                        ?>
                                        <input type="text" name="daterange" min="{{$default_checkin}}" value="{{$checkin_date??$default_checkin}} - {{$checkout_date??$default_checkout}}" class="form-control" />
                                        {{-- <input type="text" name="daterange" min="{{$tour_start_date}}" value="{{$tour_start_date}} - {{$tour_end_date}}" class="form-control" /> --}}
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Location</label>
                                    <div class="input-group" id="loc-from">
                                        <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                        <select class="form-control" name="city" required>
                                            {{--<option value="" selected disabled>City</option>--}}
                                            @foreach($guide_cities as $guide_city)
                                                <option value="{{$guide_city->city_name??''}}"  @if($route_name == 'search-guide') @if($guide_city->city_name == $searched_city??'') selected @endif @endif>{{ucfirst($guide_city->city_name??'')}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Language</label>
                                    <div class="input-group" id="loc-from">

                                        <label for=""><i class="fa fa-language"></i></label>
                                        <select class="form-control" name="language" required>
                                            {{--<option value="" selected disabled>Language</option>--}}
                                            @foreach($guide_languages as $guide_language)
                                            <option value="{{$guide_language->language_name??''}}" @if($route_name == 'search-guide') @if($guide_language->language_name == $searched_language??'') selected @endif @endif>{{ucfirst($guide_language->language_name??'')}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <input class="total_guests_guide" id="total_guests_guide" name="total_guests_guide" value="2" readonly hidden>
                                <div class="col-md-3">
                                    <label>Visitors:</label>
                                    <div class="form-group">
                                        <div class="input-group" id="one-way">
                                            <div class="dropdown keep-open">
                                                <!-- Dropdown Button -->

                                                <button id="dLabel" role="button" href="#" data-toggle="dropdown" data-target="#" class="btn btn-light">
                                                    <i class="fas fa-user"></i>
                                                    <span class="adults_span_guide">{{$adults_guide??0}}</span> Adults,
                                                    <span class="childs_span_guide">{{$childs_guide??0}}</span> Children,
                                                    <span class="infants_span_guide">{{$infants_guide??0}}</span> Infants
                                                </button>
                                                <!-- Dropdown Menu -->
                                                <div class="dropdown-menu guests_dropdown" role="menu" aria-labelledby="dLabel">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-12 dropdown_heading"><p>Adults</p></div>
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_adults_guide">-</span></div>
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="adults_input_field_guide">
                                                            <input type="number" class="form-control adults_guide" name="adults_guide" value="{{$adults_guide??0}}" readonly min="0"></span></div>
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_adults_guide">+</span></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-12 dropdown_heading"><p>Children</p></div>
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_childs_guide">-</span></div>
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field_guide">
                                                            <input type="number" class="form-control childs_guide" name="childs_guide" value="{{$childs_guide??0}}" readonly min="0"></span></div>
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_childs_guide">+</span></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-12 dropdown_heading"><p>Infants</p></div>
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_infants_guide">-</span></div>
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field_guide">
                                                            <input type="number" class="form-control infants_guide" name="infants_guide" value="{{$infants_guide??0}}" readonly min="0"></span></div>
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_infants_guide">+</span></div>
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
                                </div>
                                <div class="form-group col-md-2">
                                    <button class="btn book-now">Search</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="sec-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 Alziyara text-center" data-aos="fade-right" data-aos-duration="3000">
                    <h3>{!!($pages->where('slug','guides')->first()->title??'Not Available') !!}</h3>
                    {!!($pages->where('slug','guides')->first()->description??'Not Available') !!}
                </div>
                <!--<div class="col-lg-6" data-aos="fade-left" data-aos-duration="3000">-->
                <!--    <div class="hotel_bg_img">-->
                <!--   <img src="./img/transportation-bus.png" alt="Transport-service" class="img-fluid">     -->
                <!--    </div>-->

                <!--</div>-->
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
                            <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('guide')}}">Guide</a></li>

                            @if(isset($route_name))
                                @if($route_name == 'search-guide')
                                    <li class="breadcrumb-item active" aria-current="page">{{$searched_city??''}}(city), {{$searched_language??''}}(language)</li>
                                @endif
                            @endif
                            {{--<li class="breadcrumb-item active" aria-current="page">Karbala to Najaf</li>--}}
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
                <div class="col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item view_all">
                            <a class="nav-link active" href="{{ URL::to("/guide/")}}">View All</a>
                        </li>
                        @if(isset($route_name))
                            @if($route_name != 'search-guide')
                                @foreach($guide_languages as $guide_language)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ URL::to("/guide-by-language/")}}/{{$guide_language->language_name}}">{{ucwords($guide_language->language_name)}}</a>
                                        {{--<a class="nav-link @if($route_name == 'transportation-by-type/'.$transportation_type->TransportationTypeID) active @endif" href="{{ URL::to("/transportation-by-type/")}}/{{$transportation_type->TransportationTypeID}}" role="tab">{{ucwords($transportation_type->TransportationTypeDesc??'')}}</a>--}}
                                    </li>
                                @endforeach
                            @endif
                        @endif
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content"id="guide_card_section">
                        @include('website.guide_card_section')
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
@push('js')
    <script>

        // <!-- for guide -->
        $(document).ready(function(){
            $('input[name="daterange"]').daterangepicker({
                minDate:new Date()
            });
            
            $("#add_adults_guide").click(function(){
                adults_guide = parseInt($(".adults_guide").val());

                if(adults_guide>=0 && adults_guide<30){
                    adults_guide = adults_guide+1;
                    $('.adults_guide').val(adults_guide);
                    $('#total_guests_guide').val(total_guests_guide);
                    total_guests_guide = parseInt($(".adults_guide").val())+parseInt($(".childs_guide").val())+parseInt($(".infants_guide").val());
                    $('#total_guests_guide').val(total_guests_guide);
                    $(".adults_span_guide").html(adults_guide);
                }
            });
            $("#remove_adults_guide").click(function(){
                adults = $(".adults_guide").val();
                if(adults_guide>1){
                    adults_guide = parseInt(adults_guide)-1;
                    $('.adults_guide').val(adults_guide);
                    total_guests_guide = parseInt($(".adults_guide").val())+parseInt($(".childs_guide").val())+parseInt($(".infants_guide").val());
                    $('#total_guests_guide').val(total_guests_guide);
                    $(".adults_span_guide").html(adults_guide);
                }
            });

            $("#add_childs_guide").click(function(){
                childs_guide = parseInt($(".childs_guide").val());
                if(childs_guide>=0 && childs_guide<30){
                    childs_guide = childs_guide+1;
                    $('.childs_guide').val(childs_guide);
                    total_guests_guide = parseInt($(".adults_guide").val())+parseInt($(".childs_guide").val())+parseInt($(".infants_guide").val());
                    $('#total_guests_guide').val(total_guests_guide);
                    $(".childs_span_guide").html(childs_guide);
                }
            });
            $("#remove_childs_guide").click(function(){
                childs = $(".childs_guide").val();
                if(childs_guide>0){
                    childs_guide = parseInt(childs_guide)-1;
                    $('.childs_guide').val(childs_guide);
                    total_guests_guide = parseInt($(".adults_guide").val())+parseInt($(".childs_guide").val())+parseInt($(".infants_guide").val());
                    $('#total_guests_guide').val(total_guests_guide);
                    $(".childs_span_guide").html(childs_guide);
                }
            });

            $("#add_infants_guide").click(function(){
                infants_guide = parseInt($(".infants_guide").val());
                if(infants_guide>=0 && infants_guide<30){
                    infants_guide = infants_guide+1;
                    $('.infants_guide').val(infants_guide);
                    // total_guests_guide = parseInt($(".adults_guide").val())+parseInt($(".childs_guide").val())+parseInt($(".infants_guide").val());
                    // $('#total_guests_guide').val(total_guests_guide);
                    $(".infants_span_guide").html(infants_guide);
                }
            });
            $("#remove_infants_guide").click(function(){
                infants_guide = $(".infants_guide").val();
                if(infants_guide>0){
                    infants_guide = parseInt(infants_guide)-1;
                    $('.infants_guide').val(infants_guide);
                    // total_guests_guide = parseInt($(".adults_guide").val())+parseInt($(".childs_guide").val())+parseInt($(".infants_guide").val());
                    // $('#total_guests_guide').val(total_guests_guide);
                    $(".infants_span_guide").html(infants_guide);
                }
            });
        });

    </script>
    <script>
        $(document).ready(function() {
            $("#sort_by").change(function () {
                @if($route_name == 'guide')
                        // alert($("#sort_by").val());
                $.get('{{ URL::to("guide-sorting")}}/' + $("#sort_by").val(), function (data) {
                {{--                $.get('{{ URL::to("transportation-sorting")}}/' + $("#sort_by").val(), function (data) {--}}
                    $('#guide_card_section').empty();
                    $('#guide_card_section').html(data);
                });
                $('#guide_card_section').on('click', '.pagination a', function (e) {
                // $('#transportation_card_section').on('click', '.pagination a', function (e) {
                    e.preventDefault();
                    var url = $(this).attr("href");
                    $.get(url, function (data) {
                        $('#guide_card_section').empty();
                        $('#guide_card_section').html(data);
                    });
                });
                @elseif($route_name == 'search-guide')
                // alert($("#sort_by").val());
                $.get('{{ URL::to("searched-guide-sorting")}}/'+$("#sort_by").val()+'/{{$searched_language??''}}/{{$searched_city}}/{{$total_guests}}',function(data){
                {{--$.get('{{ URL::to("searched-guide-sorting")}}/'+$("#sort_by").val()+'/{{$searched_guide_id}}/{{$type}}',function(data){--}}
                    $('#guide_card_section').empty();
                    $('#guide_card_section').html(data);
                });
                $('#guide_card_section').on('click', '.pagination a', function (e) {
                    e.preventDefault();
                    var url = $(this).attr("href");
                    $.get(url, function (data) {
                        $('#guide_card_section').empty();
                        $('#guide_card_section').html(data);
                    });
                });
                @else
                // alert($("#sort_by").val());

                $.get('{{ URL::to("guide-sorting-with-language")}}/'+$("#sort_by").val()+'/{{request()->segment(count(request()->segments()))??''}}',function(data){
                    $('#guide_card_section').empty();
                    $('#guide_card_section').html(data);
                });
                $('#guide_card_section').on('click', '.pagination a', function (e) {
                    e.preventDefault();
                    var url = $(this).attr("href");
                    $.get(url, function (data) {
                        $('#guide_card_section').empty();
                        $('#guide_card_section').html(data);
                    });
                });
                @endif

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
    </script>
@endpush