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
        .transport-sec .transportation-imgs a.btn {
            margin-top: 5px !important ;
        }
        .modal-body .recipt div {
            display: flex;
            justify-content: space-between;
        }
        .modal-body{
            padding: 1rem 34px;
        }
        .price_detail .col-md-6 p {
    font-size: 16px;
    font-weight: bold;
}
.price_detail .col-md-6:nth-child(even) p {
    text-align: right;
}

    </style>
@endpush
<body class="visa transportation-details">

@section('content')

    <section class="transport-sec sec-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-bg-color">
                    <form role="form" method="get" action="{{ route('search-guide') }}" id="form_transport_details" class="margin-bottom-0">
                        {{--@csrf--}}
                        <div class="form-row d-flex" style="align-item:end;">
                            <div class="form-group col-md-3">
                                <div class="input-group" id="pickup-date">
                                    <label for=""><i class="fas fa-calendar-alt"></i></label>
                                    <?php
                                    $tour_start_date=date('m/d/Y');
                                    $tour_end_date=Date('m/d/Y', strtotime('+10 days'));
                                    //$default_checkin=Date('m/d/Y', strtotime('+7 days'));
                                    //$default_checkout=Date('m/d/Y', strtotime('+17 days'));
                                    ?>
                                    <input type="text" name="daterange" min="{{$tour_start_date}}" value="{{$checkin_date??$tour_start_date}} - {{$checkout_date??$tour_end_date}}" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class="input-group" id="loc-from">
                                    <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                    <select class="form-control" name="city" required>
                                        <option value="" selected disabled>City</option>
                                        @foreach($guide_cities as $guide_city)
                                            @if($existingData)
{{--                                                <option value="{{$cityName->GuestPassLocation}}" @if($existingData->destination == $cityName) selected @endif>{{$cityName->GuestPassLocation}} </option>--}}
                                                <option value="{{$guide_city->city_name??''}}" @if($existingData->city == $guide_city->city_name) selected @endif>{{ucfirst($guide_city->city_name??'')}}</option>
                                            @else
                                                <option value="{{$guide_city->city_name??''}}">{{ucfirst($guide_city->city_name??'')}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class="input-group" id="loc-from">
                                    <label for=""><i class="fa fa-language"></i></label>
                                    <select class="form-control" name="language" required>
                                        <option value="" selected disabled>Language</option>
                                        @foreach($guide_languages as $guide_language)
                                            @if($existingData)
                                                {{--                                                <option value="{{$cityName->GuestPassLocation}}" @if($existingData->destination == $cityName) selected @endif>{{$cityName->GuestPassLocation}} </option>--}}
                                                <option value="{{$guide_language->language_name??''}}" @if($existingData->language == $guide_language->language_name) selected @endif>{{ucfirst($guide_language->language_name??'')}}</option>
                                            @else
                                                <option value="{{$guide_language->language_name??''}}">{{ucfirst($guide_language->language_name??'')}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input class="total_guests_guide" id="total_guests_guide" name="total_guests_guide" value="2" readonly hidden>
                            <div class="col-md-3">
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
                                                    <div class="col-lg-3 col-md-12 dropdown_heading">Adults</div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_adults_guide">-</span></div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="adults_input_field_guide">
                                                        <input type="number" class="form-control adults_guide" name="adults_guide" value="{{$adults_guide??0}}" readonly min="2"></span></div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_adults_guide">+</span></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-12 dropdown_heading">Children</div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_childs_guide">-</span></div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field_guide">
                                                        <input type="number" class="form-control childs_guide" name="childs_guide" value="{{$childs_guide??0}}" readonly min="0"></span></div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_childs_guide">+</span></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-12 dropdown_heading">Infants</div>
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
								<li>This Guide is booked on this Date {{ $error }}</li>
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
                            <li class="breadcrumb-item"><a href="{{route('guide')}}">Guide</a></li>
                            <li class="breadcrumb-item"><a href="">{{ucfirst($guides->GuidesName??'')}}</a></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-7">
                    <div class="card-deck">

                        @if($guides->getGuideDefaultPic==null)
                            <img class="card-img-top" src="{{asset('website/img/not_available.png')}}" alt="Not Available" title="Not Available">														<input id="myimage" type="hidden" value="{{asset('website/img/not_available.png')}}" >
                        @else
                            <img class="card-img-top" src="{{asset('website')}}/{{$guides->getGuideDefaultPic->PhotoLocation}}" alt="{{$guides->AltText}}" title="{{$guides->PhotoTitle}}">														<input id="myimage" type="hidden" value="{{asset('website')}}/{{$guides->getGuideDefaultPic->PhotoLocation}}" >
                        @endif
                    </div>

                </div>
                <div class="col-lg-5 transportation-imgs">
                    <div class="row">
                        <div class="col-md-12 pb-4">
                            <p class="three_star"><i class="fas fa-map-marker-alt"></i>{{$guides->GuidesLocation??''}} </p>
                            <h2 class="card-title">{{$guides->GuidesName??''}}</h2>
                            <p>
                                @for( $a=1 ; $a <= round($guides->getGuideReviewAverageForView->avg('averageRating')) ; $a++ )
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for( $a=1 ; $a <= 5-round($guides->getGuideReviewAverageForView->avg('averageRating')) ; $a++ )
                                    <i class="far fa-star"></i>
                                @endfor
                                @if(count($guides->getGuideReview)>1)
                                    {{ count($guides->getGuideReviewForView) }} reviews
                                @else
                                    {{ count($guides->getGuideReviewForView) }} review
                                @endif
                                @if(Auth::user() != null)

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
                                            <form method="post" action="{{ route('add-guide-review') }}">
                                                {{--<div class="form-group">--}}
                                                {{--<label for="recipient-name" class="col-form-label">Recipient:</label>--}}
                                                {{--<input type="text" class="form-control" id="recipient-name">--}}
                                                {{--</div>--}}
                                                @csrf()
                                                <input type="hidden" value="{{$guides->GuidesID}}" name="GuidesID">
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
                            <div class="row recipt price_detail">
                                <div class="col-md-6"><p> Price Per Day:</p></div>
                                <div class="col-md-6 selected_col_right"><p> ${{number_format($guides->PricePerDay, 0, '.', '')}}</p></div>
                                <div class="col-md-6"><p>Max Occupancy:</p></div>
                                <div class="col-md-6 selected_col_right"><p> {{$guides->MaxOccupancy}}</p></div>
                            </div>
							<div class="row  price_detail">
								<div class="col-md-6"><p>Guide Based in:</p></div>
                                <div class="col-md-6 selected_col_right"><p>{{$guides->GuidesLocation}}</p></div>
                                <div class="col-md-6"><p>Guide Languages:</p></div>
                                <div class="col-md-6 selected_col_right"><p>{{$guides->Languages}}</p></div>
                            </div>
                            {{--<h4>{{$guide->getGuidemainroute->RouteName}}</h4>--}}

                            <a id="addtocart" onClick="getdefaultimage()" data-toggle="modal" data-target="#guide" class="btn book-now">Book Now</a>
                        </div>
                        @foreach($guides->getGuidePics as $guidePic)
                            @if($guidePic->DefaultFlag == 0)
                                <div class="col-md-6">
                                    <div class="cards">
                                        <img class="card-img-top" src="{{asset('website')}}/{{$guidePic->PhotoLocation}}" alt="{{$guidePic->AltText}}" title="{{$guidePic->PhotoTitle}}">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="jump_to">
                        <p class="jump-to">Jump to:
                            {{--<a href="#features">Features & Amenities</a>--}}
                            <a href="#description"> Description</a>
                            <a href="#reviews"> Reviews</a>
                            <a href="#house_rules"> House Rules</a>
                            <a href="#reviews"> Reviews</a>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--@if($guide->FeaturesAndAmenities!='')--}}
        {{--<section id="features">--}}
            {{--<div class="container">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-12">--}}
                        {{--<h3 class="review-title">Features and Amenities</h3>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                    {{--{!! $guide->FeaturesAndAmenities??'' !!}--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</section>--}}
    {{--@endif--}}
    <section id="description" class="transport-last-sect">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="review-title">Description</h3>
                    <p class="review-para">{!!$guides->GuidesDesc!!}</p>
                </div>
            </div>
			<div class="row" id="house_rules">
                <div class="col-md-12">
                    <h3 class="review-title">House Rules</h3>
                    <p class="review-para">{!! $guides->HouseRules !!}</p>
                </div>
            </div>
            {{--<div class="row" id="call_driver">--}}
                {{--<div class="col-md-12">--}}
                    {{--<h3 class="review-title">Contact Driver</h3>--}}
                    {{--<p class="review-para">Ph: {{$guide->DriverContactNum}}</p>--}}
                {{--</div>--}}
            {{--</div>--}}
            @if($guides->getGuideReview->count()>1)
                <div class="row" id="reviews">
                    <div class="col-md-12 review-one">
                        <h3 class="review-title">Reviews</h3>
                        @foreach($guides->getGuideReviewForView as $guidereview)
                            <h5 class="rating">
                                @for( $a=1 ; $a <= $guidereview->Rating ; $a++ )
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for( $a=1 ; $a <= 5-$guidereview->Rating ; $a++ )
                                    <i class="far fa-star"></i>
                                @endfor
                                <span>Reviewed {{ \Carbon\Carbon::parse($guidereview->ReviewOn)->diffForHumans() }}</span>
                            </h5>
                            <p class="review-para">{{$guidereview->Description}}</p>
                            <p class="review-para">{{$guidereview->Name}}{{--- Australia--}}</p>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="row" id="reviews">
                    <div class="col-md-12 review-one">
                        <h3 class="review-title">Reviews</h3>
                            <p class="review-para">No reviews found</p>

                    </div>
                </div>
            @endif
			<div class="modal fade" id="guide">
				<div class="modal-dialog">
					<div class="modal-content">
						<div id="loader"></div>
						{{--<div class="modal-header">--}}
							{{--<div class="row">--}}
								{{--<div class="col-lg-12 transportation-imgs">--}}

							{{--</div>--}}
						{{--<h4 class="modal-title">{{$guides->GuidesName??''}}</h4><br/>
						<small>By: {{$guides->getguideUser->name}}</small><br/>
						<small>Price Per Day: ${{number_format($guides->PricePerDay, 0, '.', '')}}</small>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
						{{--</div>--}}
						<form action="{{ route('addtocart')}}" id="frmGuestPass" method="post">
						{{csrf_field()}}
						<div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12 transportation-imgs">
                                    <div class="row">
                                        <div class="col-md-12 pb-4">
                                            <h2>{{$guides->GuidesName??''}}</h2>
                                            <p>
                                                @for( $a=1 ; $a <= round($guides->getGuideReviewAverageForView->avg('averageRating')) ; $a++ )
                                                    <i class="fas fa-star"></i>
                                                @endfor
                                                @for( $a=1 ; $a <= 5-round($guides->getGuideReviewAverageForView->avg('averageRating')) ; $a++ )
                                                    <i class="far fa-star"></i>
                                                @endfor
                                                @if(count($guides->getGuideReview)>1)
                                                    {{ count($guides->getGuideReviewForView) }} reviews
                                                @else
                                                    {{ count($guides->getGuideReviewForView) }} review
                                                @endif
                                                @if(Auth::user() != null)

                                                @endif
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                {{--<h4 class="modal-title">{{$guides->GuidesName??''}}</h4><br/>
                                <small>By: {{$guides->getguideUser->name}}</small><br/>
                                <small>Price Per Day: ${{number_format($guides->PricePerDay, 0, '.', '')}}</small>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
                            </div>
							<div id="message"></div>
							<div class="form-group">
								<input type="hidden" name="id" value="{{$guides->GuidesID}}" />
								<input type="hidden" id="price" name="price" value="{{$guides->PricePerDay}}" />
								{{--<input type="hidden" id="quantityprice" name="guestpasssingle" value="{{$guides->PricePerDay}}" />--}}
								<input type="hidden" name="title" value="{{$guides->GuidesName}}" />
								<input type="hidden" name="category" value="{{$guides->Productcategory}}" />

								<input type="hidden" id="cartimage" name="image" value="" />

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="recipt">
                                           <div> <p>Price Per Day:</p> <p>${{number_format($guides->PricePerDay, 0, '.', '')}}</p></div>
                                            <div> <p>Max Occupancy: </p><p>{{$guides->MaxOccupancy}}</p></div>
                                            <div> <p>	Guide Based in:</p>
                                               <p>	{{$guides->GuidesLocation}}</p></div>
                                           <div> <p>Booking Duration: </p>
                                            <p>
                                                <input class="form-control"  type="text" name="date" value="{{$checkin_date??$tour_start_date}} - {{$checkout_date??$tour_end_date}}" placeholder="Please select a date"  required  readonly />
                                            </p>
                                           </div>
                                        </div>

                                    </div>
                                    </div>
								<div class="row">
									<div class="col-md-6">

									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										{{--<lable for="addSDphone">Booking Duration:</lable>--}}
									</div>
									<div class="col-md-6">
									{{--<input class="form-control"  type="text" name="date"   placeholder="Please select a date"  required  readonly />--}}
									</div>
								</div>
								<!--<lable for="addSDphone">Number of Tickets</lable>-->
								<input class="form-control" type="hidden" name="quantity" value="{{$guides->MaxOccupancy}}" min="1"/>

								{{--</lable>--}}
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

        <!-- for guide -->
        $(document).ready(function(){
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
                if(adults_guide>0){
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

			var start = moment();

			var end = moment();

			$('input[name="date"]').daterangepicker({

					minDate: new Date()

					});


		function getdefaultimage(){

			var guideImage = jQuery("#myimage").val();
			var guidesetImage = jQuery("#cartimage").val(guideImage);

		}

    </script>
@endpush