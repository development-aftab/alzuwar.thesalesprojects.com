@extends('website.layout.master')

@push('css')
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
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
    .dropdown_heading{display: inline-block;color:#365ca9;padding-left: 30px;padding-top: 5px;}
    .guests_dropdown{width: 250px; background-color: #ffffff}
    .guests_dropdown input {padding: 0px !important;}
    .fa, .fas {font-weight: 900;font-size: 21px;color: #365ca9;}
    .fa, .far {font-size: 21px;}
    .dropdown{width:100%; text-align: left;}
    .dropdown button{width:100%; text-align: left;border-color: #cfd5db;background: none !important;}
    span.adults_span_hotels{padding-left: 20px;}
    .select_rooms_dropdown{width: 100%;border: 2px solid #D4D4D4;border-radius: 5px;font-size: 14px;color: #000000;height: 40px;text-align: center;}
    .addReviewButton{padding: 0px !important;width: auto;background: none;color: #365ca9 !important;border: none;text-decoration: underline !important;}
    .transportation-imgs .cards {
        margin-left: 10px;
    }
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
    .transportation-imgs img {
        padding-bottom: 20px;
        height: 175px;
        object-fit: cover;
        width: 210px;
    }
    .empty-tb-style a {
        color: #fff;
    }

    .table-responsive>.table-bordered {
        overflow-x: scroll;
        width: 1200px;
    }
    .form-row .col-md-12 {
        padding-left: 22px;
    }
    .about_hotel h2{
        margin-bottom: 5px;
    }
    .about_hotel{
        margin-bottom: 25px;
    }
    .quantity_priceroom div {
        display: flex;
        justify-content: space-between;
        width: 100%;
        margin-bottom: 30px;
    }


    @media (max-width: 1200px) {
        /* Hotels Reservation inline style start-------------  */
        .transportation-details #form_transport_details .book-now {
            padding: 2px 40px !important;
        }
        .table th {
            text-align: center;
        }
        .table td,
        .table th {
            padding: 0.25rem;
        }
        /* Hotels Reservation inline style end-------------  */
    }

    @media (max-width: 991px) {
        /* Hotels Reservation inline style start-------------  */
        .all-jumpto-bttns {
            margin-left: 0px;
        }
        .form-group.col-md-4:nth-child(1) {
            max-width: 25%;
        }
        .form-group.col-md-4:nth-child(1)>div select {
            padding: 0px 0px 0px 23px;
        }
        .aminities h3 {
            font-size: 22px;
        }
        /* Hotels Reservation inline style end-------------  */
    }

    @media (max-width: 768px) {
        .transportation-details .input-group>.custom-select:not(:first-child),
        .input-group>.form-control:not(:first-child) {
            padding-right: 2px;
        }
    }

    @media (max-width: 767px) {
        /* Hotels Reservation inline style start-------------  */
        .form-group.col-md-4:nth-child(1) {
            max-width: 100%;
        }
        .transportation-imgs .cards {
            text-align: center;
        }
        .responsive-map {
            margin-bottom: 20px;
        }
        .hotel-details .all-jumpto-bttns {
            display: flex;
            flex-direction: column;
        }
        .transport-sec>div>.row>.row {
            margin:0 auto;
            width: 100%;
        }
        .transport-sec>div>.row>.row .all-jumpto-bttns {
            width: 100%;
            margin: 0px auto;
        }
        .transport-sec>div>.row>.row .all-jumpto-bttns a {
            margin-bottom: 10px;
            padding: 5px 10px;
        }
        /* Hotels Reservation inline style end-------------  */
    }

    @media (max-width: 480px) {
        /* Hotels Reservation inline style start-------------  */
        .transport-sec>div>.row>.row .all-jumpto-bttns {
            width: 40%;
            margin: 0px auto;
        }
        .transport-sec>div>.row>.row .all-jumpto-bttns a {
            margin-bottom: 10px;
            padding: 5px 10px;
        }
        /* Hotels Reservation inline style end-------------  */
    }

    @media (max-width: 425px) {
        h2 {
            font-size: 28px !important;
        }
        h3 {
            font-size: 18px !important;
        }
        a {
            font-size: 14px !important;
        }
    }
</style>
@endpush
<body class="visa hotel-details transportation-details">
@section('content')
    <section class="transport-sec sec-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-bg-color">
                    <form role="form" id="form_transport_details" class="margin-bottom-0" method="get" action="{{ route('search-hotels') }}">
                        <div class="form-row d-flex align-items-end">
                            <div class="form-group col-md-3">
                                <label for="">Destination</label>
                                <div class="input-group" id="loc-from">
                                    <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                    <select class="form-control" name="destination" required>
                                        <option @if(!$existingData) selected @endif disabled>Destination</option>
                                        @foreach($cityNames as $cityName)
                                            @if($existingData)
                                                <option value="{{$cityName->GuestPassLocation}}" @if($existingData->destination == $cityName) selected @endif>{{$cityName->GuestPassLocation}} </option>
                                            @else
                                                <option value="{{$cityName->GuestPassLocation}}">{{$cityName->GuestPassLocation}} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">From/To</label>
                                <div class="input-group" id="pickup-date">
                                    <label for=""><i class="fas fa-calendar-alt"></i></label>
                                    @if(isset($existingData->daterange))
                                        <input type="text" name="daterange" min="{{$default_checkin}}" value="{{$existingData->daterange}}" class="form-control" />
                                    @else
                                        <input type="text" name="daterange" min="{{$default_checkin}}" value="{{$default_checkin}} - {{$default_checkout}}" class="form-control" />
                                    @endif
                                </div>
                            </div>
                            <input class="total_guests_hotels" id="total_guests_hotels" name="total_guests_hotels" value="2" readonly hidden>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Visitors</label>
                                    <div class="input-group" id="one-way">
                                        <div class="dropdown keep-open">
                                            <!-- Dropdown Button -->
                                            <button id="dLabel" role="button" href="#" data-toggle="dropdown" data-target="#" class="btn btn-light">
                                                <i class="fas fa-user"></i>
                                                @if($existingData)
                                                    <span class="adults_span_hotels">{{$existingData->adults_hotels}}</span> Adults,
                                                    <span class="childs_span_hotels">{{$existingData->childs_hotels}}</span> Children,
                                                    <span class="infants_span_hotels">{{$existingData->infants_hotels}}</span> Infants
                                                @else
                                                    <span class="adults_span_hotels">0</span> Adults,
                                                    <span class="childs_span_hotels">0</span> Children,
                                                    <span class="infants_span_hotels">0</span> Infants
                                                @endif

                                            </button>
                                            <!-- Dropdown Menu -->
                                            <div class="dropdown-menu guests_dropdown" role="menu" aria-labelledby="dLabel">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-12 dropdown_heading">Adults</div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_adults_hotels">-</span></div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="adults_input_field_hotels">
                                                            @if($existingData)
                                                               <input type="number" class="form-control adults_hotels" name="adults_hotels" value="{{$existingData->adults_hotels}}" readonly min="2"></span>
                                                            @else
                                                                <input type="number" class="form-control adults_hotels" name="adults_hotels" value="0" readonly min="0"></span>
                                                            @endif
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_adults_hotels">+</span></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-12 dropdown_heading">Children</div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_childs_hotels">-</span></div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field_hotels">
                                                         @if($existingData)
                                                            <input type="number" class="form-control childs_hotels" name="childs_hotels" value="{{$existingData->childs_hotels}}" readonly min="0">
                                                         @else
                                                            <input type="number" class="form-control childs_hotels" name="childs_hotels" value="0" readonly min="0">
                                                         @endif
                                                        </span></div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_childs_hotels">+</span></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-12 dropdown_heading">Infants</div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_infants_hotels">-</span></div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field_hotels">
                                                        @if($existingData)
                                                            <input type="number" class="form-control infants_hotels" name="infants_hotels" value="{{$existingData->infants_hotels}}" readonly min="0"></span>
                                                        @else
                                                            <input type="number" class="form-control infants_hotels" name="infants_hotels" value="0" readonly min="0"></span>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_infants_hotels">+</span></div>
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

            @if(session('bookedDates'))

                <h4>All rooms are booked in this category. Please change your selection and try again</h4>
                <div class="alert alert-danger">
                    <ul>
                        @foreach (session('bookedDates') as $error)
                            <li>Date {{ $error }} All Rooms Are Booked</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="row">
                <div class="col-md-12 pt-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('hotels')}}">All Hotels</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$hotelData->City}}</li>
                            <li class="breadcrumb-item active" aria-current="page">{{$hotelData->Name}}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-7">
                    <div class="card-deck">
                        @foreach($hotelData->getHotelPics as $hotelPic)
                            @if($hotelPic==null)
                                <img class="card-img-top" src="{{asset('website/img/not_available.png')}}" alt="Not Available" title="Not Available">
                            @elseif($hotelPic->DefaultFlag==1)
                                <img class="card-img-top" src="{{asset('website')}}/{{$hotelPic->PhotoLocation}}" alt="{{$hotelPic->AltText}}" title="{{$hotelPic->PhotoTitle}}">
                                <input type="hidden" name="hotelImage" id="hotelImage" value="{{asset('website')}}/{{$hotelPic->PhotoLocation}}" />
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-5 transportation-imgs">
                    <div class="row no-gutters">
                        <div class="col-md-12 pb-4">
                            <h2>{{$hotelData->Name}}</h2>
                            {{--<small>{{$hotelData->getHotelUser->name}}</small>--}}
                            <p>
                                @for( $a=1 ; $a <= round($hotelData->getHotelReviewAverage->avg('averageRating')) ; $a++ )
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for( $a=1 ; $a <= 5-round($hotelData->getHotelReviewAverage->avg('averageRating')) ; $a++ )
                                    <i class="far fa-star"></i>
                                @endfor
                                <a href="#reviews"  >{{$hotelData->getHotelReview->count('countReview')}} Reviews</a>
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
                                            <form method="post" action="{{ route('add-property-review') }}">
                                                @csrf
                                                <input type="hidden" value="{{$hotelData->PropertyID}}" name="PropertyID">
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
                                    </div>
                                </div>
                            </div>
                            <!-- Review Modal End-->
                            @endif

                            </p>
                            <h4>{{$hotelData->Address}}, {{$hotelData->City}}, {{$hotelData->Country}}</h4>
                        </div>
                        @foreach($hotelData->getHotelPics as $hotelPic)
                            @if($hotelPic->DefaultFlag==0)
                                <div class="col-md-6">
                                    <div class="cards">
                                        <img class="card-img-top" src="{{asset('website')}}/{{$hotelPic->PhotoLocation}}" alt="{{$hotelPic->AltText}}" title="{{$hotelPic->PhotoTitle}}">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="all-jumpto-bttns">
                            <p class="jump-to-hotel">Jump to:</p>
                            <a class="btn jumpto-buttons" href="#room_choices" role="button">Room choices</a>
                            <a class="btn jumpto-buttons" href="#hotel_description" role="button">Hotel Description</a>
                            <a class="btn jumpto-buttons" href="#map" role="button">Map</a>
                            <a class="btn jumpto-buttons" href="#amenities" role="button">Amenities</a>
                            <a class="btn jumpto-buttons" href="#reviews" role="button">Reviews</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="room_choices">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="choose-room">Choose Your Room</h2>
                    <!--<p class="para-choose-rm">We recommend booking a stay with free cancellation in case your plans change.</p>-->
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-headings">
                            <tr>
                                <th class="table-imgs">Image</th>
                                <th class="room-types">Room Type</th>
                                <th class="table-sleep">Sleep</th>
                                <th class="price-table">Price</th>
                                <th class="table-youget">You Get</th>
                                <th class="table-selectroom">Select Rooms</th>
                                <th class="empty-table-heading"> </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($hotelData->getRooms as $key => $Room)

                                @if($Room->RoomStatus == 'Ready')
                                    <tr>
                                        <td class="table-img-style">
                                            <img class="card-img-top" src="{{asset('website')}}/{{$Room->RoomImage}}" alt="Not Available" title="Not Available">
                                            {{--<img src="./img/h4.png" alt="" class="img-fluid">--}}
                                        </td>
                                        <td class="room-type-style">
                                            <h3 class="table-title">{{$Room->RoomType??''}}</h3>

                                            <a href="#!">
                                                {{$Room->AvailableQty??''}} Rooms Available
                                                {{--at This Price--}}
                                            </a>
                                            <p>{!!$Room->RoomDescription??'' !!}</p>
                                        </td>
                                        <td class="table-bed-style">
                                            <i class="fas fa-bed"></i>
                                            <p>{{$Room->QtyOfBed}} {{$Room->getBedType->BedTypeDesc??''}}</p>
                                        </td>
                                        <td class="table-price-style ">
                                            <h3 class="table-title">$ {{number_format($Room->Price, 0, '.', '')}} </h3>

                                            <a href="#!">+ ${{$Room->TaxAndCharges??''}} tax & charges</a>
                                            {{--<input type="hidden" id="get_tax_and_charges" value="{{$Room->TaxAndCharges}}">--}}
                                        </td>
                                        <td class="table-youget-style">
                                            <ul>
                                                @foreach($Room->roomFeatureList->take(4) as $roomFeature)
                                                    <li class="date">
                                                        @if($roomFeature->ImageIcon==null)
                                                            {{--<i class="fas fa-square-full"></i>--}}
                                                            <i class="fas fa-dot-circle"></i>
                                                        @else
                                                            {!! $roomFeature->ImageIcon??'' !!}
                                                        @endif
                                                        {!! $roomFeature->Title??'' !!}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="table-dropdown">
                                            <select required class="select_rooms_dropdown" id="quantityofrooms{{$key}}">
                                                @for($a=1; $a<=$Room->AvailableQty; $a++)
                                                    <option value="{{$a*$Room->Price}}">{{$a}} - ${{$a*$Room->Price}}</option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td class="empty-tb-style">
                                            <a  id="addtocart" data-toggle="modal" onClick="hotelreserve({{$Room->Price}},{{$Room->TaxAndCharges}},{{$Room->id}},{{$key}},{{$Room->MaxOccupancy}},'{{$Room->RoomType}}-{{$hotelData->Name}}');" data-target="#hotelroom" class="btn">
                                                RESERVE NOW
                                            </a>
                                            <p> Free Cancellation Policy</p>
                                        </td>

                                    </tr>
                                @else
                                    <p><b> No Rooms Service in this Hotel </b></p>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($hotelData->Description != null)
        <section id="hotel_description">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 about_hotel">
                        <h2>About The Hotel</h2>
                        {!! $hotelData->Description !!}
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if($hotelData->getHotelFeaturesAndAmenities != null)
        <section class="aminities"  id="amenities">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Features and Amenities</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h3>General</h3>
                        <ul>
                            {!!$hotelData->getHotelFeaturesAndAmenities->generl??''!!}
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h3>Food & Drink</h3>
                        <ul>
                            {!!$hotelData->getHotelFeaturesAndAmenities->food_and_drink??''!!}
                        </ul>
                        <h3>Front Desk Services</h3>
                        <ul>
                            {!!$hotelData->getHotelFeaturesAndAmenities->front_desk_services??''!!}
                        </ul>
                        <h3>Entertainment & Family Services</h3>
                        <ul>
                            {!!$hotelData->getHotelFeaturesAndAmenities->entertainment_and_family_services??''!!}
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h3>Living Area</h3>
                        <ul>
                            {!!$hotelData->getHotelFeaturesAndAmenities->living_area??''!!}
                        </ul>
                        <h3>Health & Wellness Facilities</h3>
                        <ul>
                            {!!$hotelData->getHotelFeaturesAndAmenities->health_facility??''!!}
                        </ul>
                        <h3>Safety & Security</h3>
                        <ul>
                            {!!$hotelData->getHotelFeaturesAndAmenities->safety_and_security??''!!}
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h3>Bussiness Facilities</h3>
                        <ul>
                            {!!$hotelData->getHotelFeaturesAndAmenities->bussiness_facility??''!!}
                        </ul>
                        <h3>Accessibility</h3>
                        <ul>
                            {!!$hotelData->getHotelFeaturesAndAmenities->accessibility??''!!}
                        </ul>
                        <h3>Languages Spoken</h3>
                        <ul>
                            {!!$hotelData->getHotelFeaturesAndAmenities->languages_spoken??''!!}
                        </ul>
                        <h3>Cleaning Services</h3>
                        <ul>
                            {!!$hotelData->getHotelFeaturesAndAmenities->cleaning_service??''!!}
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section class="hotel_location"  id="map">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Location</h3>
                    <p>{{$hotelData->Address}}, {{$hotelData->City}}, {{$hotelData->Country}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="responsive-map">
                        <iframe
                                src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q={{$hotelData->Address}}, {{$hotelData->City}}, {{$hotelData->Country}}&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                                width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="hotelroom">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div id="loader"></div>
                    <div class="modal-header">
                        <div class="col-lg-12 transportation-imgs">
                            <div class="row no-gutters">
                                <div class="col-md-12 pb-4">
                                    <h2>{{$hotelData->Name}}</h2>
                                    <p>
                                        @for( $a=1 ; $a <= round($hotelData->getHotelReviewAverage->avg('averageRating')) ; $a++ )
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        @for( $a=1 ; $a <= 5-round($hotelData->getHotelReviewAverage->avg('averageRating')) ; $a++ )
                                            <i class="far fa-star"></i>
                                        @endfor
                                        <a href="#reviews"  >{{$hotelData->getHotelReview->count('countReview')}} Reviews</a>
                                        @if(Auth::user() != null)

                                        @endif
                                    </p>
                                    <h4> {{ucwords($hotelData->Address)}}, {{ucwords($hotelData->City)}}, {{ucwords($hotelData->Country)}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('addtocart')}}" id="frmGuestPass" method="post">
                        {{csrf_field()}}
                        <div class="modal-body">
                            <div id="message"></div>
                            <div class="form-group">
                                <input type="hidden" name="id" id="hotelid" value="{{$hotelData->PropertyID}}" />
                                <input type="hidden" name="id" id="roomid" />
                                <input type="hidden" id="title" name="title" value="" />
                                <input type="hidden" name="category" value="2" />
                                <input type="hidden" name="image" id="image" value="" />
                                <input type="hidden" name="quantity" id="quantity" value="" />
                                <input type="hidden" id="set_tax_and_charges" name="tax_and_charges" value="">
                                <br />
                                <label for="addSDphone">Trip Duration:</label>
                                <div id="sandbox-container">
                                    @if($existingData)
                                        <input type="text" id="hoteldaterange" name="date" class="form-control" placeholder="Please select a date" value="{{$existingData->daterange}}" onChange="mydateChange()" required  style="margin-bottom: 10px"   />
                                    @else
                                        <input type="text" id="hoteldaterange" name="date" class="form-control" placeholder="Please select a date" value="" onChange="mydateChange()" required  style="margin-bottom: 10px"  />
                                    @endif
                                        <br>
                                        <div class="reserve_now_modal">

                                        </div>
                                    <hr>
                                    <hr>
                                    <hr>
                                    <div id="quantitypriceroom" class="quantity_priceroom">
                                    </div>
                                    <div id="alltotal">
                                    </div>
                                </div>
                                <script>
                                    var y = [0, 1, 2, 3, 4, 5, 6];
                                </script>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">ADD TO CART</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <section class="transport-last-sect"  id="reviews">
        <div class="container">
            <div class="row">
                <h3 class="review-title">Reviews</h3>
                @if($hotelData->getHotelReview->count()>=1)
                    @foreach($hotelData->getHotelReview as $hotelReview)
                        <div class="col-md-12 review-one">
                            <h5 class="rating">
                                @for( $a=1 ; $a <= $hotelReview->Rating ; $a++ )
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for( $a=1 ; $a <= 5-$hotelReview->Rating ; $a++ )
                                    <i class="far fa-star"></i>
                                @endfor
                                <span>Reviewed {{ \Carbon\Carbon::parse($hotelReview->ReviewOn)->diffForHumans() }}</span>
                            </h5>
                            <p class="review-para">{{$hotelReview->Description}}</p>
                            <p class="review-para">{{$hotelReview->Name}}{{--- Australia--}}</p>
                        </div>
                    @endforeach

                @else
                    <div class="col-md-12 review-one">
                        <p class="review-para">No reviews found</p>
                    </div>

                @endif
            </div>
        </div>
    </section>
    <script>
        var swiper = new Swiper(".hotel_detail_slider", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

@endsection
@push('js')
<script>
    // <!-- for hotels -->
    $(document).ready(function(){
        $('input[name="daterange"]').daterangepicker({
            minDate:new Date()
        });


        $("#add_adults_hotels").click(function(){

            adults_hotels = parseInt($(".adults_hotels").val());
            console.log(adults_hotels);

            if(adults_hotels>=0 && adults_hotels<30){
                adults_hotels = adults_hotels+1;
                $('.adults_hotels').val(adults_hotels);
                $('#total_guests_hotels').val(total_guests_hotels);
                total_guests_hotels = parseInt($(".adults_hotels").val())+parseInt($(".childs_hotels").val())+parseInt($(".infants_hotels").val());
                $('#total_guests_hotels').val(total_guests_hotels);
                $(".adults_span_hotels").html(adults_hotels);
            }
        });
        $("#remove_adults_hotels").click(function(){
            adults = $(".adults_hotels").val();
            console.log(adults);
            if(adults_hotels>0){
                adults_hotels = parseInt(adults_hotels)-1;
                $('.adults_hotels').val(adults_hotels);
                total_guests_hotels = parseInt($(".adults_hotels").val())+parseInt($(".childs_hotels").val())+parseInt($(".infants_hotels").val());
                $('#total_guests_hotels').val(total_guests_hotels);
                $(".adults_span_hotels").html(adults_hotels);
            }
        });

        $("#add_childs_hotels").click(function(){
            childs_hotels = parseInt($(".childs_hotels").val());
            console.log(childs_hotels);
            if(childs_hotels>=0 && childs_hotels<30){
                childs_hotels = childs_hotels+1;
                $('.childs_hotels').val(childs_hotels);
                total_guests_hotels = parseInt($(".adults_hotels").val())+parseInt($(".childs_hotels").val())+parseInt($(".infants_hotels").val());
                $('#total_guests_hotels').val(total_guests_hotels);
                $(".childs_span_hotels").html(childs_hotels);
            }
        });
        $("#remove_childs_hotels").click(function(){
            childs = $(".childs_hotels").val();
            console.log(childs);
            if(childs_hotels>0){
                childs_hotels = parseInt(childs_hotels)-1;
                $('.childs_hotels').val(childs_hotels);
                total_guests_hotels = parseInt($(".adults_hotels").val())+parseInt($(".childs_hotels").val())+parseInt($(".infants_hotels").val());
                $('#total_guests_hotels').val(total_guests_hotels);
                $(".childs_span_hotels").html(childs_hotels);
            }
        });

        $("#add_infants_hotels").click(function(){
            infants_hotels = parseInt($(".infants_hotels").val());
            if(infants_hotels>=0 && infants_hotels<30){
                infants_hotels = infants_hotels+1;
                $('.infants_hotels').val(infants_hotels);
                // total_guests_hotels = parseInt($(".adults_hotels").val())+parseInt($(".childs_hotels").val())+parseInt($(".infants_hotels").val());
                // $('#total_guests_hotels').val(total_guests_hotels);
                $(".infants_span_hotels").html(infants_hotels);
            }
        });
        $("#remove_infants_hotels").click(function(){
            infants_hotels = $(".infants_hotels").val();
            if(infants_hotels>0){
                infants_hotels = parseInt(infants_hotels)-1;
                $('.infants_hotels').val(infants_hotels);
                // total_guests_hotels = parseInt($(".adults_hotels").val())+parseInt($(".childs_hotels").val())+parseInt($(".infants_hotels").val());
                // $('#total_guests_hotels').val(total_guests_hotels);
                $(".infants_span_hotels").html(infants_hotels);
            }
        });
    });
</script>
<script>

    function hotelreserve(price,tax,id,index,occupancy,roomname) {
        $('#set_tax_and_charges').val(tax);

        var start = moment();
        var end = moment();

        $('input[name="date"]').daterangepicker({
            minDate: new Date()										
        });

        $('#modals').empty();
        var quantityindex = '#quantityofrooms' + index;

        var roomdata = $(quantityindex).find(":selected").text();

        var roomquantity = roomdata.split("-");

        var totalamount = parseInt(roomquantity[0]) * price;
        //tax removed here will should be added on next page
        //var totalwithtax = totalamount + tax;
        var totalwithtax = totalamount;

        var roomid = jQuery("#roomid").val(id);

        var hotelImage = jQuery("#hotelImage").val();

        var hotelImageinput = jQuery("#image").val(hotelImage);

        var pricediv = jQuery("#title").val(roomname);

        var myroomquantity = jQuery("#quantity").val(roomquantity[0]);

//        $('#quantitypriceroom').html(
//            '<br/>' +
//            '<div class="form-control" readonly>' +
//                '<h6> '+ occupancy + ' Persons Per Single Room Total Persons of '+ roomquantity[0] +' rooms</h6>' +
//                '<h6> '+ roomquantity[0]*occupancy +'</h6>' +
//            '</div>'
//        );
//        $('#quantitypriceroom').append(
//            '<div class="form-control" readonly>' +
//                '<h6>No of Rooms '+ roomquantity[0] +' x $' + price + '</h6>' +
//                '<h6> $'+ totalamount +' </h6>' +
//            '</div>'
//            //            ,'<div class="form-control">' +
//            //                '<h6> Total + Tax ( $ '+ tax +' ) </h6>' +
//            //                '<h6> $'+ totalwithtax +' </h6>' +
//            //            '</div>'
//        );
//        $('#quantitypriceroom').append(
//            '<div class="form-control" readonly> ' +
//                '<h6 id ="mychangedates" > Per Day </h6>' +
//                '<h6> $'+ totalwithtax +'</h6>' +
//            '</div>'
//            +
//            '<div id="myalldays" class="form-control" readonly></div>'
//        );
        $('#alltotal').html(
            '<input type="hidden" id="grandtotal" value ="'+ totalwithtax +'" > ' +
            '<input type="hidden" id="finaltotal" value ="'+ totalwithtax +'" name="price">'
        );
        {{--@if(isset($existingData->daterange) && $existingData->daterange)--}}
        @if(true)
            <?php
                if(isset($existingData->daterange) && $existingData->daterange){
                    $start_date = strtotime(explode('-',$existingData->daterange)[0]);
                    $end_date = strtotime(explode('-',$existingData->daterange)[1]);
                    $datediff = $end_date-$start_date;
                    $no_of_days  = round($datediff / (60 * 60 * 24));
                }
                else{

                    $datediff =0;
                    $no_of_days =0;
                }
            ?>
            $('#myalldays').html(
                '<h6> No of days {{$no_of_days  }}, Final Amount = {{$no_of_days  }} days  x '+totalamount+' = '+(totalamount*{{$no_of_days}})+'</h6>'
            );
        var daterange = jQuery("#hoteldaterange").val();

        var datesplit = daterange.split("-");

        const date1 = new Date(datesplit[0]);

        const date2 = new Date(datesplit[1]);

        const diffTime = Math.abs(date2 - date1);

        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        if(diffDays == 0){
            diffDays = 1;

        }
        else {
            diffDays = diffDays + 1;
        }

        var grandtotaldiv = jQuery("#grandtotal").val();

        var grandtotaldivwithdays = diffDays * grandtotaldiv;

        var finalgrandtotal = jQuery("#finaltotal").val(grandtotaldivwithdays);

        console.log(date1, date2, diffTime, diffDays, grandtotaldiv, grandtotaldivwithdays, finalgrandtotal)
//            console.log(totalwithtax, roomquantity[0], totalamount, occupancy, roomquantity[0], price);
            $('.reserve_now_modal').html(
                '<table class="table">' +
                    '<thead>' +
                        '<tr>' +
                            '<th>Details</th>' +
                            '<th>Qty</th>' +
                            '<th>Price</th>' +
                            '<th>Amount</th>' +
                        '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                        '<tr>' +
                            '<td>Per Day Price</td>' +
                            '<td>1</td>' +
                            '<td>$'+totalwithtax+'</td>' +
                            '<td>$'+totalwithtax+'</td>' +
                        '</tr>' +
                        '<tr>' +
                            '<td>No of Rooms</td>' +
                            '<td>'+roomquantity[0]+'</td>' +
                            '<td>$'+totalwithtax+'</td>' +
                            '<td>$'+totalwithtax+'</td>' +
                        '</tr>' +
                        '<tr id="no_of_days_id">' +

                        '</tr> ' +
                        '<tr>' +

                        '</tr>' +
                        '<td colspan="4"><b>'+ occupancy + '</b> Persons Per Single Room Total Persons of <b>'+ roomquantity[0] +'</b> rooms <b>'+ roomquantity[0]*occupancy +'</b>.</td>' +
//                        '<tr>' +
//                        '<td colspan="4">Total No of days = <b class="total_no_of_days">'+ diffDays + '</b> <br> <hr> Final Amount = <b class="diff_days">'+ diffDays +' </b> days x $<b class="grand_totaldiv">'+ grandtotaldiv +'</b> = $<b class="grand_totaldiv_withdays">'+ grandtotaldivwithdays +'</b></td>' +
//                        '</tr>' +
//                        '<tr>' +
//                        '<td>' +
//                        '</td>' +
//                        '<td>' +
//                        '</td>' +
////                        '<td>Subtotal:</td>' +
////                        '<td>$'+totalamount+'</td>'
//                        +
//                        '</tr>' +
                        '<tr>' +
                        '<th colspan="3" style="text-align: right;">Total:</td>' +
                        '<th class="tbl_grand_totaldiv_withdays">$'+grandtotaldivwithdays+'</td>' +
                        '</tr>'
                         +
                    '</tbody>' +
                '</table>'
            );

            var no_of_days_data = '<td>No of Days</td>' +
                    '<td>'+diffDays +'</td>' +
                    '<td>$'+grandtotaldiv+'</td>' +
                    '<td>$'+grandtotaldivwithdays+'</td>' ;
            $('#no_of_days_id').html(no_of_days_data);
            $('#myalldays').html(
                    '<h6> No of days </h6> ' +
                    '<h6> '+ diffDays + ' days </h6> ' +
                    '<h6> Final Amount = </h6> ' +
                    '<h6> '+ diffDays +' days  x $' + grandtotaldiv + ' = $'+ grandtotaldivwithdays +' </h6>'
            );

        @endif
    }

    function mydateChange(){
        var daterange = jQuery("#hoteldaterange").val();

        var datesplit = daterange.split("-");

        const date1 = new Date(datesplit[0]);

        const date2 = new Date(datesplit[1]);

        const diffTime = Math.abs(date2 - date1);

        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        if(diffDays == 0){
            diffDays = 1;

        }
        else {
            diffDays = diffDays + 1;
        }

        var grandtotaldiv = jQuery("#grandtotal").val();

        var grandtotaldivwithdays = diffDays * grandtotaldiv;

        var finalgrandtotal = jQuery("#finaltotal").val(grandtotaldivwithdays);

        console.log(date1, date2, diffTime, diffDays, grandtotaldiv, grandtotaldivwithdays, finalgrandtotal);

        //        $('#mychangedates').html('');

        var no_of_days_data = '<td>No of Days</td>' +
        '<td>'+diffDays +'</td>' +
        '<td>$'+grandtotaldiv+'</td>' +
        '<td>$'+grandtotaldivwithdays+'</td>' ;
        $('#no_of_days_id').html(no_of_days_data);
        $('#myalldays').html(
            '<h6> No of days </h6> ' +
            '<h6> '+ diffDays + ' days </h6> ' +
            '<h6> Final Amount = </h6> ' +
            '<h6> '+ diffDays +' days  x $' + grandtotaldiv + ' = $'+ grandtotaldivwithdays +' </h6>'
        );
        $('.total_no_of_days').html(diffDays);
        $('.diff_days').html(diffDays);
        $('.grand_totaldiv').html(grandtotaldiv);
        $('.grand_totaldiv_withdays').html(grandtotaldivwithdays);
        $('.tbl_grand_totaldiv_withdays').empty();
        $('.tbl_grand_totaldiv_withdays').html('$'+grandtotaldivwithdays);
    }

</script>
@endpush