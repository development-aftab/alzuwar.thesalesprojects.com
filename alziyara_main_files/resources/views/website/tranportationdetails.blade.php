@extends('website.layout.master')

@push('css')

<style>
    .addReviewButton{padding: 0px !important;width: auto;background: none;color: #365ca9 !important;border: none;text-decoration: underline !important;}
    .star-cb-group {
        /* remove inline-block whitespace */
        font-size: 0;
        /* flip the order so we can use the + and ~ combinators */
        unicode-bidi: bidi-override;
        direction: rtl;
        /* the hidden clearer */
    }
    .star-cb-group * {
        font-size: 1rem;
    }
    .star-cb-group > input {
        display: none;
    }
    .star-cb-group > input + label {
        /* only enough room for the star */
        display: inline-block;
        /*overflow: hidden;*/
        /*text-indent: 9999px;*/
        width: 1em;
        white-space: nowrap;

        cursor: pointer;
    }
    .star-cb-group > input + label:before {
        display: inline-block;
        text-indent: -9999px;
        content: "☆";
        color: #DDC01A;
        font-size: 45px;
    }
    .star-cb-group > input:checked ~ label:before, .star-cb-group > input + label:hover ~ label:before, .star-cb-group > input + label:hover:before {
        content: "★";
        color: #DDC01A;
        text-shadow: 0 0 1px #333;
    }
    .star-cb-group > .star-cb-clear + label {
        text-indent: -9999px;
        width: .5em;
        margin-left: -.5em;
    }
    .star-cb-group > .star-cb-clear + label:before {
        width: .5em;
    }
    .star-cb-group:hover > input + label:before {
        content: "☆";
        color: #888;
        text-shadow: none;
    }
    .star-cb-group:hover > input + label:hover ~ label:before, .star-cb-group:hover > input + label:hover:before {
        content: "★";
        color: #DDC01A;
        text-shadow: 0 0 1px #333;
    }
    .star-cb-group > input + label {
        padding: 0 20px;
    }
    fieldset {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .transportation-imgs .cards>img {
        height: 160px;
        object-fit: cover;
    }
    .modal .transport_booking_modal_inner_section {
        padding: 10px 18px 0 18px;
    }
    .transportation-details .transport-sec .card-deck img,
    .transportation-imgs .cards>img  {
        object-fit: fill;
    }
    .quote{
        display: flex;
    }
    .transportation_text p {
        font-size: 18px;
        font-weight: bold;
    }
</style>

@endpush

<body class="visa transportation-details">

@section('content')

    <section class="transport-sec sec-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-bg-color">
                    <form role="form" id="form_transport_details" class="margin-bottom-0" action="{{Route('search-transportation')}}" method="get">
                        @csrf
                        <div class="form-row d-flex" style="align-item:end;">
                            <div class="form-group col-md-3">
                                <div class="input-group" id="loc-from">
                                    <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                    <select class="form-control" name="route_from" id="route_from" required>
                                        {{--<option value="disable">From</option>--}}
                                        @foreach($transportation_routes_from as $transportation_route_from)
                                            {{ $transportation_route_from }}
                                            <option value="{{$transportation_route_from->RouteFrom??''}}"
                                                    @if(Session::has('RouteFrom')) @if(Session::get('RouteFrom') == $transportation_route_from->RouteFrom) selected  @endif   @elseif($transportation_route_from->RouteFrom=='Karbala') selected @endif>
                                                {{$transportation_route_from->RouteFrom??''}}
                                            </option>
                                            {{--@if($transportation_route_from->RouteFrom??''==$transport->getTransportmainroute->RouteFrom??'')--}}
                                            {{--selected--}}

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="input-group" id="loc-from">
                                    <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                    <select class="form-control" name="route_to" id="route_to" required >
                                        {{--<option value="disable">To</option>--}}
                                        @foreach($transportation_routes_to as $transportation_route_to)
                                            <option value="{{$transportation_route_to->RouteTo??''}}"
                                                    @if(Session::has('RouteTo')) @if(Session::get('RouteTo') == $transportation_route_to->RouteTo) selected  @endif   @elseif($transportation_route_to->RouteTo=='Najaf') selected @endif>
                                                {{$transportation_route_to->RouteTo??''}}
                                            </option>
                                            {{--@if($transportation_route_to->RouteTo??''==$transport->getTransportmainroute->RouteTo??'')--}}
                                            {{--selected--}}
                                            {{--@endif--}}
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{--<div class="input-group" id="pickup-date">--}}
                                {{--<label for=""><i class="fas fa-calendar-alt"></i></label>--}}
                                <div class="input-group ">
                                    <input type="date" id="start" name="start" class="form-control text-left mr-2" value="{{(isset($existingData)) ? $existingData->start??$date??'' : $date??''}}" min="{{$date??''}}">
                                </div>
                                {{--</div>--}}
                            </div>
                            {{--<div class="col-md-3">--}}
                            {{--<div class="radio_btn">--}}
                            {{--<label><input type="radio" name="type" value="One Way"> One way</label>--}}
                            {{--<label><input type="radio" name="type" value="Round Trip" checked="checked"> Round Trip</label>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group col-md-3">
                                <button class="btn book-now">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('bookedDates'))
                    @foreach (session('bookedDates') as $error)
                        <div class="alert alert-danger">
                            <ul>
                                <li>This vehicle is booked on this Date {{ $error }}</li>
                            </ul>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 pt-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('Transport')}}">Transportation</a></li>
                            <li class="breadcrumb-item"><a href="">{{$transport->NameofVehicle??''}}</a></li>
                            {{--@if($route_name == 'search-hotels')--}}
                            {{--<li class="breadcrumb-item active" aria-current="page">{{$search_city}}</li>--}}
                            {{--@endif--}}
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-7">
                    <div class="card-deck">
                        @if($transport->getTransportDefaultPic==null)
                            <img class="card-img-top" src="{{asset('website/img/not_available.png')}}" alt="Not Available" title="Not Available">
                        @else
                            <img class="card-img-top" src="{{asset('website')}}/{{$transport->getTransportDefaultPic->PhotoLocation}}" alt="{{$transport->AltText}}" title="{{$transport->PhotoTitle}}">
                            <input type="hidden" id ="mydefaultimg" value="{{asset('website')}}/{{$transport->getTransportDefaultPic->PhotoLocation}}" >
                        @endif
                    </div>
                </div>
                <div class="col-lg-5 transportation-imgs">
                    <div class="row">
                        <div class="col-md-12 pb-4">
                            <h2 class="transport_name">{{$transport->NameofVehicle}}</h2>
                            <p>
                                @for( $a=1 ; $a <= round($transport->getTransportReviewAverageForView->avg('averageRating')) ; $a++ )
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for( $a=1 ; $a <= 5-round($transport->getTransportReviewAverageForView->avg('averageRating')) ; $a++ )
                                    <i class="far fa-star"></i>
                                @endfor
                                @if(count($transport->getTransportReview)>1)
                                    {{ count($transport->getTransportReviewForView) }} reviews
                                @else
                                    {{ count($transport->getTransportReviewForView) }} review
                                @endif
                                @if(Auth::user() != null)
                                    /
                                    <!-- Button trigger review modal -->
                                    <a type="button" class="addReviewButton" data-toggle="modal" data-target="#addReviewModal">
                                        Write a review
                                    </a>

                                    <!-- Review Modal -->
                            <div class="modal fade" id="addReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Write A Review</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('add-transportation-review') }}">
                                                {{--<div class="form-group">--}}
                                                {{--<label for="recipient-name" class="col-form-label">Recipient:</label>--}}
                                                {{--<input type="text" class="form-control" id="recipient-name">--}}
                                                {{--</div>--}}
                                                @csrf
                                                <input type="hidden" value="{{$transport->VehicleRouteID}}" name="VehicleRouteID">
                                                <input type="hidden" value="{{Auth::User()->name}}" name="Name">
                                                <input type="hidden" value="{{Auth::User()->email}}" name="EmailAddress">
                                                <input type="hidden" value="{{\Request::getClientIp(true)}}" name="IPAddress">
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Message:</label>
                                                    <textarea class="form-control" id="message-text" name="Description" required></textarea>
                                                </div>
                                                <fieldset>
                                                    <span class="star-cb-group">
                                                        <input type="radio" id="rating-5" name="Rating" value="5" />
                                                        <label for="rating-5"></label>
                                                        <input type="radio" id="rating-4" name="Rating" value="4" />
                                                        <label for="rating-4"></label>
                                                        <input type="radio" id="rating-3" name="Rating" value="3" />
                                                        <label for="rating-3"></label>
                                                        <input type="radio" id="rating-2" name="Rating" value="2" />
                                                        <label for="rating-2"></label>
                                                        <input type="radio" id="rating-1" name="Rating" value="1" />
                                                        <label for="rating-1"></label>
                                                    </span>
                                                </fieldset>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Add Review</button>
                                            </form>
                                        </div>
                                        {{--<div class="modal-footer">--}}
                                        {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                                        {{--<button type="button" class="btn btn-primary">Add Review</button>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>
                            <!-- Review Modal End-->
                            @endif
                            </p>
                            <div class="row transportation_text">

                                <div class="col-lg-6">
                                    <p>	By:&nbsp; {{$transport->getTransportuser->name}}  </p>

                                </div>
                            </div>
                            <div class="row transportation_text">
                                <div class="col-lg-6 mb-3">
                                    <p> Route:</p>

                                    <select class="form-control" id="routedetails"  required>
                                        <option value="" selected disabled>Select Route</option>
                                        {{--@foreach($transportation_routes_to as $transportation_route_to)--}}
                                        {{--<option value="{{$transportation_route_to->RouteTo??''}}"--}}
                                        {{--@if(Session::has('RouteTo')) @if(Session::get('RouteTo') == $transportation_route_to->RouteTo) selected  @endif   @elseif($transportation_route_to->RouteTo=='Najaf') selected @endif>--}}
                                        {{--{{$transportation_route_to->RouteTo??''}}--}}
                                        {{--</option>--}}
                                        {{--@endforeach--}}
                                        @foreach($transport->getTransportRoutes as $route)
                                            <option id="routedetailsSelected" value="{{$route->RouteID}}" price="{{number_format($route->Price, 2, '.', '')}}" twowayprice="{{number_format($route->TwoWayPrice, 2, '.', '')}}">{{$route->getTransportmainroute->RouteFrom??''}} to {{$route->getTransportmainroute->RouteTo??''}}</option>
                                        @endforeach
                                    </select>
                                    {{--{{$transport->getTransportmainroute->RouteName??''}}--}}

                                </div>
                                <div class="col-lg-6 mb-3 transportation_text">
                                    <p for="addSDphone">Trip Type</p>

                                    <label>
                                        <input type="radio" name="triptype" value="oneway" required>  One Way
                                        <span id="onewaypricespandetail"></span></label>
                                    <label>
                                        <input type="radio" name="triptype" value="twoway" id="round_trip" required checked>  Round Trip
                                        <span id="twowaypricespandetail"></span></label>

                                    <br/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 "><div class="quote">
                                        Quote for: <p><i class="fas fa-chair"></i> :  {{$transport->getTransporttype->NumOfSeats}}</p> <p><i class="fas fa-briefcase"></i> :  {{$transport->getTransporttype->LuggageCapacity}}</p></div>
                                </div>
                            </div>

                            {{--<div class="row">--}}
                            {{--<div class="col-lg-6">--}}
                            {{--One Way Trip: ${{number_format($transport->Price, 0, '.', '')}}--}}
                            {{--</div>--}}
                            {{--<div class="col-lg-6">--}}
                            {{--|   Round Trip: ${{number_format($transport->TwoWayPrice, 0, '.', '')}}--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="row">--}}
                            {{--<div class="col-lg-6"><div class="icn_line"></div></div>--}}
                            {{--<div class="col-lg-6">One Way Price: ${{number_format($transport->Price, 0, '.', '')}}<br>Two Way Price: ${{number_format($transport->TwoWayPrice, 0, '.', '')}}</div>--}}
                            {{--</div>--}}

                            {{--<h4>{{$transport->getTransportmainroute->RouteName??''}}</h4>--}}
                            <a data-target="#guestpass" onclick="getdefaultimage()" data-toggle="modal" class="btn book-now">Book Now</a>
                        </div>
                        @foreach($transport->getTransportPics as $transportPic)
                            @if($transportPic->DefaultFlag == 0)
                                <div class="col-md-6">
                                    <div class="cards">
                                        <img class="card-img-top" src="{{asset('website')}}/{{$transportPic->PhotoLocation}}" alt="{{$transport->AltText}}" title="{{$transport->PhotoTitle}}">
                                        {{--<img src="./img/b-img1.png" alt="" class="img-fluid">--}}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <!--<div class="row">-->
                <!--<div class="col-md-12">-->
                <!--    <div class="jump_to">-->
                <!--        <p class="jump-to">Jump to: <a href="#features">Features & Amenities</a>-->
                <!--        <a href="#description"> Description</a>-->
                <!--        <a href="#reviews"> Reviews</a>-->
                <!--        <a href="#call_driver"> Call Driver</a>-->

                <!--</p>-->
                <!--</div>-->
                <!--</div>-->
                <!--</div>-->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="jump_to">
                        <p class="jump-to">Jump to: <a href="#features">Features & Amenities</a>
                            <a href="#description"> Description</a>
                            <a href="#reviews"> Reviews</a>
                            {{--<a href="#call_driver"> Call Driver</a>--}}

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($transport->FeaturesAndAmenities!='')
        <section id="features">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="review-title">Features and Amenities</h3>
                    </div>
                </div>
                <div class="row">
                    {!! $transport->FeaturesAndAmenities??'' !!}
                    {{--<div class="col-md-3">--}}
                    {{--<h5 class="features-title">Lorem ipsum</h5>--}}
                    {{--<ul class="features-links">--}}
                    {{--<li><a href="#">Lorem ipsum</a></li>--}}
                    {{--<li><a href="#">Lorem ipsum</a></li>--}}
                    {{--<li><a href="#">Lorem ipsum</a></li>--}}
                    {{--<li><a href="#">Lorem ipsum</a></li>--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-3">--}}
                    {{--<h5 class="features-title">Lorem ipsum</h5>--}}
                    {{--<ul class="features-links">--}}
                    {{--<li><a href="#">Lorem ipsum</a></li>--}}
                    {{--<li><a href="#">Lorem ipsum</a></li>--}}
                    {{--<li><a href="#">Lorem ipsum</a></li>--}}
                    {{--<li><a href="#">Lorem ipsum</a></li>--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-3">--}}
                    {{--<h5 class="features-title">Lorem ipsum</h5>--}}
                    {{--<ul class="features-links">--}}
                    {{--<li><a href="#">Lorem ipsum</a></li>--}}
                    {{--<li><a href="#">Lorem ipsum</a></li>--}}
                    {{--<li><a href="#">Lorem ipsum</a></li>--}}
                    {{--<li><a href="#">Lorem ipsum</a></li>--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-3">--}}
                    {{--<h5 class="features-title">Lorem ipsum</h5>--}}
                    {{--<ul class="features-links">--}}
                    {{--<li><a href="#">Lorem ipsum</a></li>--}}
                    {{--<li><a href="#">Lorem ipsum</a></li>--}}
                    {{--<li><a href="#">Lorem ipsum</a></li>--}}
                    {{--<li><a href="#">Lorem ipsum</a></li>--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                </div>
            </div>
        </section>
    @endif

    <section id="description" class="transport-last-sect">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="review-title">Description</h3>
                    <p class="review-para">{!!$transport->Description!!}</p>
                </div>
            </div>
            {{--<div class="row">
                <div class="col-md-12">
                    <h3 class="review-title">Description</h3>
                    <p class="review-para">{!!$transport->Description!!}</p>
                </div>
            </div>
            <div class="row" id="call_driver">
                <div class="col-md-12">
                    <h3 class="review-title">Contact Driver</h3>
                    <p class="review-para">Ph: {{$transport->DriverContactNum}}</p>
                </div>
            </div>--}}
            @if($transport->getTransportReview->count()>1)
                <div class="row" id="reviews">
                    <div class="col-md-12 review-one">
                        <h3 class="review-title">Reviews</h3>
                        @foreach($transport->getTransportReviewForView as $transportreview)
                            <h5 class="rating">
                                @for( $a=1 ; $a <= $transportreview->Rating ; $a++ )
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for( $a=1 ; $a <= 5-$transportreview->Rating ; $a++ )
                                    <i class="far fa-star"></i>
                                @endfor
                                <span>Reviewed {{ \Carbon\Carbon::parse($transportreview->ReviewOn)->diffForHumans() }}</span>
                            </h5>
                            <p class="review-para">{{$transportreview->Description}}</p>
                            <p class="review-para">{{$transportreview->Name}}{{--- Australia--}}</p>
                        @endforeach
                    </div>

                </div>
            @else
                <div class="row" id="reviews">
                    <div class="col-md-12 review-one">
                        <h3 class="review-title">Reviews</h3>
                        <p class="review-para">No record found</p>
                    </div>

                </div>
            @endif
            <input type="hidden" id="onewayprice"  value="{{number_format($transport->Price, 0, '.', '')}}" />
            <input type="hidden" id="twowayprice"  value="{{number_format($transport->TwoWayPrice, 0, '.', '')}}" />
            <div class="modal fade" id="guestpass">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div id="loader"></div>
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="transport_booking_modal_inner_section">
                                    <h2>{{$transport->NameofVehicle}}</h2><span>By:{{$transport->getTransportuser->name}}</span>
                                    <p>
                                        @for( $a=1 ; $a <= round($transport->getTransportReviewAverageForView->avg('averageRating')) ; $a++ )
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        @for( $a=1 ; $a <= 5-round($transport->getTransportReviewAverageForView->avg('averageRating')) ; $a++ )
                                            <i class="far fa-star"></i>
                                        @endfor
                                        @if(count($transport->getTransportReview)>1)
                                            {{ count($transport->getTransportReviewForView) }} reviews
                                        @else
                                            {{ count($transport->getTransportReviewForView) }} review
                                        @endif
                                        {{--@if(Auth::user() != null)--}}
                                        {{--/--}}
                                        {{--@endif--}}
                                    </p>
                                    {{--<div class="row">--}}
                                    {{--<div class="col-lg-6">--}}
                                    {{--By:{{$transport->getTransportuser->name}}--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="row">--}}
                                    {{--<div class="col-lg-6">--}}
                                    {{--Route:{{$transport->getTransportmainroute->RouteName??''}}--}}
                                    {{--</div>--}}
                                    {{--<div class="col-lg-6">--}}
                                    {{--|  Quote for:--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="row">--}}
                                    {{--<div class="col-lg-6">--}}
                                    {{--One Way Trip: ${{number_format($transport->Price, 0, '.', '')}}--}}
                                    {{--</div>--}}
                                    {{--<div class="col-lg-6">--}}
                                    {{--|   Round Trip: ${{number_format($transport->TwoWayPrice, 0, '.', '')}}--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="row">

                                        <div class="col-lg-6">
                                            <i class="fas fa-chair"></i> Number of Seats: {{$transport->getTransporttype->NumOfSeats}}<br>
                                        </div>
                                        <div class="col-lg-6">
                                            <i class="fas fa-briefcase"></i> Luggage Capacity: {{$transport->getTransporttype->LuggageCapacity}}
                                        </div>
                                        {{--<div class="col-lg-6">One Way Price: ${{number_format($transport->Price, 0, '.', '')}}<br>Two Way Price: ${{number_format($transport->TwoWayPrice, 0, '.', '')}}</div>--}}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <form action="{{ route('addtocart')}}"  id="frmGuestPass" method="post">
                            {{csrf_field()}}
                            <div class="modal-body">
                                <div id="message"></div>
                                <div class="form-group">
                                    <input type="hidden" name="id" value="{{$transport->VehicleRouteID}}" />
                                    <input type="hidden" id="price" name="price" value="{{number_format($transport->Price, 0, '.', '')}}" />

                                    {{--<input type="hidden" name="title" value="{{$transport->NameofVehicle}} - {{$transport->getTransportmainroute->RouteName??''}}" />--}}
                                    <input type="hidden" name="title" value="" />
                                    <input type="hidden" name="category" value="3" />
                                    <input type="hidden" name="todaydate" value="{{date('Y-m-d')}}" />
                                    <input type="hidden" name="image" id="cartimage" value="" />
                                    <input type="hidden" name="numberplate" value="{{$transport->NumberPlate}}" />
                                    <input  type="hidden" class="form-control" name="RouteID" id="route"  required>
                                    <br/>
                                    <div class="row ml-2 mr-2">
                                        <label for="addSDphone">Pickup Date</label>
                                        <input type="datetime-local" id="date" name="date" class="form-control text-left mr-2" value="{{(isset($existingData)) ? $existingData->start??$date??'' : $date??''}}" min="{{$date??''}}" required>
                                        {{--<input type="date" id="start" name="date" class="form-control text-left mr-2" value="{{(isset($existingData)) ? $existingData->start??'' : Date('Y-m-d`', strtotime('+2 day'))}}" min="{{Date('Y-m-d', strtotime('+2 day'))}}">--}}
{{--                                        <input type="datetime-local" name="date" min={{$date??''}} class="form-control" placeholder="Please select a date" value="{{(isset($existingData)) ? $existingData->start??'' : $date??''}}" min="{{$date??''}}" required  />--}}
                                    </div>
                                    <div class="row ml-2 mr-2">
                                        <label for="addSDphone">PickUp Location </label>
                                        <input class="form-control" type="text" placeholder="Airport/Hotel/Address/shrine name" name="pickuplocation" value="{{(isset($existingData)) ? $existingData->route_from??'Karbala' : 'Airport/Hotel/Address/shrine name'}}" required >
                                    </div>
                                    <div class="row ml-2 mr-2">
                                        <label for="addSDphone">Destination Location</label>
                                        <input class="form-control" type="text" name="dropofflocation" placeholder="Airport/Hotel/Address/shrine name" value="{{(isset($existingData)) ? $existingData->route_to??'Najaf' : 'Airport/Hotel/Address/shrine name'}}" required >
                                    </div>
                                    <input type="hidden" name="triptype" id="triptype" value="">
                                    {{--<label><input type="hidden" name="triptypeprice" value="" ></label>--}}
                                    <label><input type="hidden" name="onewaycartprice" value="" ></label>
                                    {{--<label for="addSDphone">Trip Type</label>--}}
                                    {{--<br/>--}}
                                    {{--<label><input type="radio" name="triptype" value="oneway" required>  One Way <span id="onewaypricespan"></span></label>--}}
                                    {{--<label><input type="radio" name="triptype" value="twoway" required>  Round Trip<span id="twowaypricespan"></span></label>--}}
                                    <br/>
                                    <br/>
                                    <input class="form-control" type="hidden" name="quantity" value="1" required >
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">ADD TO CART</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')
<script>
    // var routedetailsSelected = $('#routedetailsSelected').val();
    // alert(routedetailsSelected);
    $('#route_from').on('change', function() {
        $.get('{{ URL::to("get-transportation-route-to")}}/'+this.value,function(data){
            $('#route_to').empty();
            $('#route_to').prop('disabled', false);
            // $('#route_to').append('<option value="disable" disabled selected>To</option>');
            for (var item in data) {
                $('#route_to').append('<option value='+data[ item ]["RouteTo"]+'>'+data[ item ]["RouteTo"]+'</option>');
                // console.log(data[ item ]['RouteTo']);
            }

        });
    });

    function getdefaultimage(){

        var transportImage = jQuery("#mydefaultimg").val();

        var transportsetImage = jQuery("#cartimage").val(transportImage);

    }

    $(document).ready(function(){

        $("input[name='triptype']").change(function(){
            var radioValue = $("input[name='triptype']:checked").val();
//			alert(radioValue);
            if(radioValue == "oneway"){

                var onewayamount = jQuery("#onewayprice").val();
                var priceinput = jQuery("#price").val(onewayamount);
                $('#triptype').val('oneway');
//                $('#triptypeprice').val('onewayamount');


            }else if(radioValue == "twoway"){

                var twowayamount = jQuery("#twowayprice").val();
                var priceinput = jQuery("#price").val(twowayamount);
                $('#triptype').val('twoway');
//                $('#triptypeprice').val('twowayamount');
            }
        });
        $('#round_trip').trigger('change');
    });



    // $(document).ready(function(){
    //     $('#routedetails').on('change', function() {
    //         $("#onewayprice").val($(this).find(':selected').attr('price'));
    //         $("#twowayprice").val($(this).find(':selected').attr('twowayprice'));
    //         $("#onewaypricespan").text('('+$(this).find(':selected').attr('price')+')');
    //         $("#twowaypricespan").text('('+$(this).find(':selected').attr('twowayprice')+')');
    //         $("#onewaypricespandetail").text('('+$(this).find(':selected').attr('price')+')');
    //         $("#twowaypricespandetail").text('('+$(this).find(':selected').attr('twowayprice')+')');
    //         $("#onewaypricecart").val('('+$(this).find(':selected').attr('price')+')');
    //         $("#twowaypricecart").val('('+$(this).find(':selected').attr('twowayprice')+')');
    //         $('input[name="title"]').val($(".transport_name").text()+' - '+$(this).find(':selected').text());
    //         $('#route').val($(this).val());
    //     });
    // });

    @if(Session::has('RouteTo'))
        $('#routedetails option[id="routedetailsSelected"]').attr('selected','selected');
    $("#onewayprice").val($('#routedetails option[id="routedetailsSelected"]').attr('price'));
    $("#twowayprice").val($('#routedetails option[id="routedetailsSelected"]').attr('twowayprice'));
    $("#onewaypricespan").text('('+$('#routedetails option[id="routedetailsSelected"]').attr('price')+')');
    $("#twowaypricespan").text('('+$('#routedetails option[id="routedetailsSelected"]').attr('twowayprice')+')');
    $("#onewaypricespandetail").text('('+$('#routedetails option[id="routedetailsSelected"]').attr('price')+')');
    $("#twowaypricespandetail").text('('+$('#routedetails option[id="routedetailsSelected"]').attr('twowayprice')+')');
    $("#onewaypricecart").val('('+$('#routedetails option[id="routedetailsSelected"]').attr('price')+')');
    $("#twowaypricecart").val('('+$('#routedetails option[id="routedetailsSelected"]').attr('twowayprice')+')');
    $('input[name="title"]').val($(".transport_name").text()+' - '+$('#routedetails option[id="routedetailsSelected"]').text());
    $('#route').val($('#routedetails option[id="routedetailsSelected"]').val());
    @endif

</script>
@endpush