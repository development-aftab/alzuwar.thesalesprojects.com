@extends('website.layout.master')
@push('css')
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
@endpush

<body class="hotels transportation transportation-details">

@section('content')

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
                    <form role="form" id="form_transport_details" class="margin-bottom-0" action="{{Route('search-transportation')}}" method="get">
                        @csrf
                        <div class="form-row d-flex" style="align-item:end;">
                            <div class="form-group col-md-3">
                                <label for="">Pickup City</label>
                                <div class="input-group" id="loc-from">
                                    <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                    <select class="form-control" name="route_from" id="route_from" required>
                                        <!--<option value="disable">From</option>-->
                                        @foreach($transportation_routes_from as $transportation_route_from)
                                            <option value="{{$transportation_route_from->RouteFrom}}"
                                                    @if(Session::has('RouteFrom'))
                                                        @if($transportation_route_from->RouteFrom == Session::get('RouteFrom'))
                                                            selected
                                                        @endif
                                                    @elseif($transportation_route_from->RouteFrom =='Karbala')
                                                        selected
                                                    @endif>
                                                {{$transportation_route_from->RouteFrom}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Destination City:</label>
                                <div class="input-group" id="loc-from">
                                    <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                    <select class="form-control" name="route_to" id="route_to" required readonly="true">
                                        <!--<option value="disable">To</option>-->
                                        @foreach($transportation_routes_to as $transportation_route_to)
                                            <option value="{{$transportation_route_to->RouteTo}}" @if(Session::has('RouteTo')) @if(Session::get('RouteTo') == $transportation_route_to->RouteTo) selected  @endif   @elseif($transportation_route_to->RouteTo=='Najaf') selected @endif>{{$transportation_route_to->RouteTo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Pickup On:</label>
                                <div class="input-group" id="pickup-date">
                                    <div class="input-group">
                                        <input type="date" id="start" name="start" class="form-control text-left mr-2" value="{{$date??Date('Y-m-d', strtotime('+2 day'))}}" min="{{$date??Date('Y-m-d', strtotime('+2 day'))}}">
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
                            <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('Transport')}}">Transportation</a></li>
                            @if($route_name == 'search-transportation')
                                <li class="breadcrumb-item active" aria-current="page">{{ucfirst($transportation_routes_from_name)}} to {{ucfirst($transportation_routes_to_name)}}</li>
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
                            <a class="nav-link active" href="{{ URL::to("/Transportation/")}}" role="tab">View All</a>
                        </li>
                        @foreach($transportation_types as $transportation_type)
                            <li class="nav-item">
                                <a class="nav-link @if($route_name == 'transportation-by-type/'.$transportation_type->TransportationTypeID) active @endif" href="{{ URL::to("/transportation-by-type/")}}/{{$transportation_type->TransportationTypeID}}" role="tab">{{ucwords($transportation_type->TransportationTypeDesc??'')}}</a>
                            </li>
                        @endforeach
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content" id="transportation_card_section">
                        @include('website.transportation_card_section')
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection

@push('js')
    <script>
        $('#route_from').on('change', function() {
            $.get('{{ URL::to("get-transportation-route-to")}}/'+this.value,function(data){
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
                @if($route_name == 'Transportation')
                    $.get('{{ URL::to("transportation-sorting")}}/' + $("#sort_by").val(), function (data) {
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
                @elseif($route_name == 'search-transportation')
                // alert($("#sort_by").val());
                    $.get('{{ URL::to("searched-transportation-sorting")}}/'+$("#sort_by").val()+'/{{$searched_transportation_id}}/{{$type}}',function(data){
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
                @else
                    // alert($("#sort_by").val());
                    $.get('{{ URL::to("transportation-sorting-with-type")}}/'+$("#sort_by").val()+'/{{$TransportationTypeID}}',function(data){
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