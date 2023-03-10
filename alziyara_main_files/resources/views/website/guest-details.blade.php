@extends('website.layout.master')
@push('css')
<style>
    span.adults_span {padding-left: 25px;}
    input.form-control.adults {text-align: right;padding: 0;width: 40px;}
    input.form-control.childs {text-align: right;padding: 0;width: 40px;}
    input.form-control.infants {text-align: right;padding: 0;width: 40px;}
    #add_adults{margin-top: 3px}
    #remove_adults{margin-top: 3px}
    #add_childs{margin-top: 3px}
    #remove_childs{margin-top: 3px}
    #add_infants{margin-top: 3px}
    #remove_infants{margin-top: 3px}
    .dropdown_heading{display: inline-block;color:#365ca9;padding-left: 30px;padding-top: 5px;}
    .guests_dropdown{width: 250px; background-color: #ffffff}
    .addReviewButton{padding: 0px !important;width: auto;background: none;color: #365ca9 !important;border: none;text-decoration: underline !important;}
    .modal-header{display: block !important;}
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
        .col-12 div {
            display: flex;
            justify-content: space-between;
        }
        .col-md-12.pb-4 p i.fas.fa-star{
            margin-top: 10px;
        }
        .getGuestPass_Price .col-lg-6:nth-child(even) {
    text-align: right;
}
</style>
@endpush
<body class="hotels transportation package transportation-details">

    @section('content')

    <section class="transport-sec sec-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-bg-color">
                    {{--<form role="form" id="form_transport_details" class="margin-bottom-0" method="get" action="{{ route('searchguestpass') }}">--}}
                        {{--@csrf--}}
                        {{--<div class="form-row d-flex align-items-end">--}}
                            {{--<div class="form-group col-md-5">--}}
                                {{--<div class="input-group" id="loc-from">--}}
                                    {{--<label for=""><i class="fas fa-map-marker-alt"></i></label>--}}
                                    {{--<select class="form-control" name="city" required>--}}
                                        {{--<option value="" selected disabled>City</option>--}}
                                        {{--@foreach($cityNames as $cityName)--}}
                                            {{--<option value="{{$cityName->GuestPassLocation}}">{{$cityName->GuestPassLocation}} </option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group col-md-3">--}}
                            {{--<div class="input-group" id="pickup-date">--}}
                            {{--<label for=""><i class="fas fa-calendar-alt"></i></label>--}}
                            {{--<!--<select class="form-control" name="owner_dm">-->--}}
                            {{--<!--    <option value="">Pickup Date &amp; Time</option>-->--}}
                            {{--<!--    <option value="1">1</option>-->--}}
                            {{--<!--    </select>-->--}}
                            {{--<input type="text" name="daterange" value="01/01/2018 - 01/15/2018"--}}
                            {{--class="form-control" />--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<input class="total_guests" id="total_guests" name="total_guests" value="0" readonly hidden>--}}
                            {{--<div class="form-group col-md-5">--}}
                                {{--<div class="input-group" id="one-way">--}}
                                    {{--<div class="dropdown keep-open">--}}
                                        {{--<!-- Dropdown Button -->--}}
                                        {{--<button id="dLabel" role="button" href="#" data-toggle="dropdown" data-target="#" class="btn btn-light">--}}
                                            {{--<i class="fas fa-user"></i>--}}
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

                                        {{--$('.keep-open #dLabel').on({--}}
                                            {{--"click": function() {--}}
                                                {{--$(this).parent().attr('closable', true );--}}
                                            {{--}--}}
                                        {{--})--}}
                                    {{--</script>--}}

                                    {{--<select class="form-control" name="owner_dm">--}}
                                    {{--<option value="" disabled selected>Guests</option>--}}
                                    {{--<option value="1">1</option>--}}
                                    {{--<option value="1">2</option>--}}
                                    {{--<option value="1">3</option>--}}
                                    {{--<option value="1">4</option>--}}
                                    {{--<option value="1">5</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group col-md-2">--}}
                                {{--<button class="btn book-now">Search</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>			--}}
					@if($errors->any())		
						<div class="account-title">  	
							<p class="alert alert-success" >{{$errors->first()}}</p>	
						</div>							
					@endif
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                            {{--<li class="breadcrumb-item"><a href="#">Guest Passes</a></li>--}}
                            {{--<li class="breadcrumb-item"><a href="#"> Iraq Packages </a></li>--}}
                            {{--<li class="breadcrumb-item"><a href="#">Iraq</a></li>--}}
                            {{--<li class="breadcrumb-item active" aria-current="page">Ashura in Karbala 1443 Hijri</li>--}}
                            <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('guestspasses')}}"> Guest Passes</a></li>
							<li class="breadcrumb-item">{{$guestPass->GuestPassLocation}}</li>
                            <li class="breadcrumb-item">{{$guestPass->GuestPassName}}</li>
                            {{--<?php $segments = ''; ?>--}}
                            {{--@foreach(Request::segments() as $segment)--}}
                                {{--<?php $segments .= '/'.$segment; ?>--}}
                                {{--<li>--}}
                                    {{--<a href="{{ $segments }}">{{$segment}}</a>--}}
                                {{--</li>--}}
                            {{--@endforeach--}}
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-7">
                    <div class="card-deck">
                        <img src="{{asset('website').'/'.$guestPass->getGuestPassDefaultPic->PhotoLocation}}" alt=""
                            class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-5 transportation-imgs">
                    <div class="row no-gutters">
                        <div class="col-md-12 pb-4">
                            {{--<h2 >{{$guestPass->GuestPassName}}</h2>--}}
                            <p class="three_star"><i class="fas fa-map-marker-alt"></i>{{$guestPass->GuestPassLocation}}</p>
                            <h3 class="card-title" title="{{$guestPass->GuestPassName}}"> {{$guestPass->GuestPassName}}</h3>
                            <small> <strong>By: SP Tester</strong>  {{$guestPass->getGuestPassUser->name}}</small>
                            <p>
                                @for( $a=1 ; $a <= round($guestPass->getGuestPassreviewdetails->avg('Rating')) ; $a++ )
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for( $a=1 ; $a <= 5-round($guestPass->getGuestPassreviewdetails->avg('Rating')) ; $a++ )
                                    <i class="far fa-star"></i>
                                @endfor
                                {{$guestPass->getGuestPassreviewdetails->count()}} Reviews
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
                                                        <form method="post" action="{{ route('add-guest-pass-review') }}">
                                                            {{--<div class="form-group">--}}
                                                                {{--<label for="recipient-name" class="col-form-label">Recipient:</label>--}}
                                                                {{--<input type="text" class="form-control" id="recipient-name">--}}
                                                            {{--</div>--}}
                                                            @csrf
                                                            <input type="hidden" value="{{$guestPass->GuestPassID}}" name="GuestPassID">
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
                                                                  {{--<input type="radio" id="rating-0" name="rating" value="0" class="star-cb-clear" />--}}
                                                                  {{--<label for="rating-0"></label>--}}
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
                            <p>
                            <div class="row getGuestPass_Price">
                               
                                 <div class="col-lg-6">Price</div>
                                <div class="col-lg-6 "> ${{number_format($guestPass->Price, 2, '.', '')}} Per Person</div>
                                 <div class="col-lg-6">Max Occupancy </div>
                                <div class="col-lg-6 ">{{$guestPass->MaxOccupancy}}</div>
                            </div>

                            </p>
                            {{--<h4>{{$guestPass->GuestPassLocation}}</h4>--}}
                            <a id="addtocart" data-toggle="modal" data-target="#guestpass" class="btn cartwork">Book
                                Now</a>
                        </div>


                            @foreach($guestPass->getGuestPassDetails as $key=>$getGuestPassDetail)
                            <div class="col-md-6">
                            <div class="cards">
                                <img src="{{asset('website').'/'.$getGuestPassDetail->PhotoLocation}}"
                                    alt="{{$getGuestPassDetail->AltText}}" class="img-fluid">
                            </div>
                            </div>
                            @endforeach


                    </div>
                </div>
                <div class="package_detail_link">
                    <span class="jump_to">Jump to:</span>
                    <a href="#itinerary">Itinerary</a>
                    <a href="#description">Description</a>
                    <a href="#house_rules">House Rules</a>
                    <a href="#reviews">Reviews</a>
                </div>
            </div>
        </div>
    </section>
    <section class="itinerary">
        <div class="container">
            <div class="row" id="itinerary">
                <div class="col-md-12">
                    <div class="itinerary_content">
                        <h1>Itinerary</h1>
                        <table class="table itinerary_table">
                            <tbody>
                                <tr>
                                    <th scope="row">Days</th>
                                    <td>
                                        <ul>
                                            <?php  
                                                
                                                $days =  explode(',',$guestPass->ScheduleDays); 
                                            
                                            ?>

                                            <li><span class="check_icon"><i class="fas fa-check"></i>
                                                    @foreach($days as $availabledays)

                                                    @if($availabledays == "2")
                                                    Monday,
                                                    @elseif($availabledays == "3")
                                                    Tuesday,
                                                    @elseif($availabledays == "4")
                                                    Wednesday,
                                                    @elseif($availabledays == "5")
                                                    Thursday,
                                                    @elseif($availabledays == "6")
                                                    Friday,
                                                    @elseif($availabledays == "7")
                                                    Saturday,
                                                    @elseif($availabledays == "1")
                                                    Sunday
                                                    @endif
                                                    @endforeach</span></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">DURATION</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i
                                                        class="fas fa-check"></i>{{$guestPass->GuestPassTime}}</span>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">COST</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i
                                                        class="fas fa-check"></i>${{number_format($guestPass->Price, 2, '.', '')}}
                                                </span></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">PROGRAM</th>
                                    <td>
                                        <ul>
                                            @foreach($guestPass->getGuestPassprogramDetails as
                                            $key=>$getGuestPassDetail)
                                            <li>
                                                <span class="check_icon"><i class="fas fa-check"></i>{{date("g:iA", strtotime($getGuestPassDetail->GuestProDetailTime))}}</span>
                                                <span class="updated_to_be">{{$getGuestPassDetail->GuestProDetailDis}}</span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Maximum Capacity</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i
                                                        class="fas fa-check"></i>{{$guestPass->MaxOccupancy}}
                                                    people</span>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--  <div class="form-group col-md-12 text-center mt-5">-->
            <!--    <button class="btn book-now check_avail">BOOK NOW</button>-->
            <!--</div>-->
        </div>
    </section>

    <section class="review_sec">
        <div class="container">
            <div class="row" id="description">
                <div class="col-md-12">
                    <h3 class="review-title">Description</h3>
                    <p class="review-para">{!! $guestPass->GuestPassDesc !!}
                    </p>

                </div>
            </div>
            <div class="row" id="house_rules">
                <div class="col-md-12">
                    <h3 class="review-title">House Rules</h3>
                    <p class="review-para">{!! $guestPass->HouseRules !!}
                    </p>
                </div>
            </div>
                <div class="row" id="reviews">
                    <h3 class="review-title">Reviews</h3>
            @if($guestPass->getGuestPassreviewdetails->count()>1)
                    @foreach($guestPass->getGuestPassreviewdetails as $key=>$getGuestPassreviewDetail)
                        @if($getGuestPassreviewDetail->ReviewerName != "Admin")
                        <div class="col-md-12">
                            <div class="review-one">
                                <h5 class="rating">
                                    @for( $a=1 ; $a <= $getGuestPassreviewDetail->Rating ; $a++ )
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    @for( $a=1 ; $a <= 5-$getGuestPassreviewDetail->Rating ; $a++ )
                                        <i class="far fa-star"></i>
                                    @endfor
                                    <span>Review {{$getGuestPassreviewDetail->created_at->diffForHumans()}}</span></h5>
                                <p class="review-para">{{$getGuestPassreviewDetail->Description}}</p>
                                <h4>{{$getGuestPassreviewDetail->ReviewerName}}{{--- Australia--}}</h4>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="col-md-12">
                    <div class="review-one">
                        <p class="review-para">No Record Found</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="modal fade" id="guestpass">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div id="loader"></div>
                    <div class="modal-header">
					
						<div class="col-lg-12 transportation-imgs">
								<div class="row no-gutters">
									<div class="col-md-12 pb-4">
										<h2 class="card-title">{{$guestPass->GuestPassName}}</h2>
                                    <small><strong>By: SP Tester </strong> {{$guestPass->getGuestPassUser->name}}</small>
										<p>
											@for( $a=1 ; $a <= round($guestPass->getGuestPassreviewdetails->avg('Rating')) ; $a++ )
												<i class="fas fa-star"></i>
											@endfor
											@for( $a=1 ; $a <= 5-round($guestPass->getGuestPassreviewdetails->avg('Rating')) ; $a++ )
												<i class="far fa-star"></i>
											@endfor
											{{$guestPass->getGuestPassreviewdetails->count()}} Reviews
												@if(Auth::user() != null)

													<!-- Button trigger review modal -->
													{{--<a type="button" class="addReviewButton" data-toggle="modal" data-target="#addReviewModal">
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
																	<form method="post" action="{{ route('add-guest-pass-review') }}">--}}
																		{{--<div class="form-group">--}}
																			{{--<label for="recipient-name" class="col-form-label">Recipient:</label>--}}
																			{{--<input type="text" class="form-control" id="recipient-name">--}}
																		{{--</div>--}}
																		@csrf
																		{{--<input type="hidden" value="{{$guestPass->GuestPassID}}" name="GuestPassID">
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
																				<label for="rating-1"></label>--}}
																			  {{--<input type="radio" id="rating-0" name="rating" value="0" class="star-cb-clear" />--}}
																			  {{--<label for="rating-0"></label>--}}
																			  {{--</span>
																		</fieldset>
																		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																		<button type="submit" class="btn btn-primary">Add Review</button>
																	</form>
																  </div>--}}
																{{--<div class="modal-footer">--}}
																	{{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
																	{{--<button type="button" class="btn btn-primary">Add Review</button>--}}
																{{--</div>--}}
															{{--</div>
														</div>
													</div>--}}
													<!-- Review Modal End-->
                                                @endif
										</p>
										<p>
										<div class="row">
											<div class="col-lg-6">Max Occupancy {{$guestPass->MaxOccupancy}}</div>
											<div class="col-lg-6">Price ${{number_format($guestPass->Price, 2, '.', '')}} per Person</div>
										</div>

										</p>
										<h4>{{$guestPass->GuestPassLocation}}</h4>
											{{--<a id="addtocart" data-toggle="modal" data-target="#guestpass" class="btn cartwork">Book
											Now</a>--}}
									</div>

								</div>
							</div>
					{{--<h4 class="modal-title">{{$guestPass->GuestPassName}}</h4><br/>
                        <small>By: {{$guestPass->getGuestPassUser->name}}</small><br/>
                        <small>Price: ${{number_format($guestPass->Price, 0, '.', '')}}</small>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
                        
                    </div>

                    <form action="{{ route('addtocart')}}" id="frmGuestPass" method="post">
                        {{csrf_field()}}
                        <div class="modal-body">
                            <div id="message"></div>
                            <div class="form-group">
                                    <input type="hidden" name="id" value="{{$guestPass->GuestPassID}}" />
                                    <input type="hidden" id="price" name="price" value="{{$guestPass->Price}}" />
                                    <!--<input type="hidden" id="quantityprice" name="guestpasssingle" value="{{$guestPass->Price}}" />-->
                                    <input type="hidden" name="title" value="{{$guestPass->GuestPassName}}" />
                                    <input type="hidden" name="category" value="{{$guestPass->Productcategory}}" />
                                    <input type="hidden" name="image" value="{{asset('website').'/'.$guestPass->getGuestPassDetails[0]->PhotoLocation}}" />
                                    <br />

                                        <div  class="row" id="sandbox-container">
                                            <div class="col-md-6">
                                            <label for="addSDphone">Event Date</label>
                                            </div>
                                            <div class="col-md-6">
                                            <input type="text" id="date" name="date" class="form-control datepicker"
                                                data-provide="datepicker" placeholder="Please select a date" value=""
                                                  readonly required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <label for="addSDphone">Number of Tickets</label>
                                            </div>
                                            <div class="col-md-6">
                                            <input class="form-control" type="number" name="quantity" value="1" min="1"/>
                                            </div>
                                        </div>
                                        <!--<br />
                                        <lable for="addSDstatus">Guest Pass Booking Quantity</label>
                                            <input type="number" class="form-control" id="gpquanttiy" name="gpquantity" id="addSDstatus" placeholder="Guest Pass Booking Quantity"
                                                name="addstatus" required>-->
                                                <script>
                                                var y = [0, 1, 2, 3, 4, 5, 6];
                                                </script>
                                                @foreach($days as $availabledays)

                                                @if($availabledays == "2")
                                                
                                                <script>
                                                //  days.push(1); 

                                                var removeItem = 1;

                                                y = jQuery.grep(y, function(value) {
                                                    return value != removeItem;
                                                });
                                                </script>
                                                @elseif($availabledays == "3")

                                                <script>
                                                //  days.push(1); 

                                                var removeItem = 2;

                                                y = jQuery.grep(y, function(value) {
                                                    return value != removeItem;
                                                });
                                                </script>
                                                @elseif($availabledays == "4")
                                                

                                                <script>
                                                //  days.push(1); 

                                                var removeItem = 3;

                                                y = jQuery.grep(y, function(value) {
                                                    return value != removeItem;
                                                });
                                                </script>
                                                @elseif($availabledays == "5")
                                                

                                                <script>
                                                //  days.push(1); 

                                                var removeItem = 4;

                                                y = jQuery.grep(y, function(value) {
                                                    return value != removeItem;
                                                });
                                                </script>
                                                @elseif($availabledays == "6")
                                                

                                                <script>
                                                //  days.push(1); 

                                                var removeItem = 5;

                                                y = jQuery.grep(y, function(value) {
                                                    return value != removeItem;
                                                });
                                                </script>
                                                @elseif($availabledays == "7")
                                                

                                                <script>
                                                //  days.push(1); 

                                                var removeItem = 6;

                                                y = jQuery.grep(y, function(value) {
                                                    return value != removeItem;
                                                });
                                                </script>
                                                @elseif($availabledays == "1")


                                                <script>
                                                //  days.push(1); 

                                                var removeItem = 0;

                                                y = jQuery.grep(y, function(value) {
                                                    return value != removeItem;
                                                });
                                                </script>
                                                @endif
                                                @endforeach

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


    <script>
    $('#sandbox-container input').datepicker({
        startDate: "today",
        daysOfWeekDisabled: y
    });

    function showdataform() {
        console.log('here');
        var x = document.getElementById("guestpass");
        $('#modals').empty();
        $('#guestpass').modal('show');
        // var x = document.getElementById("guestpass");
        // console.log(x);
        // if (x.style.display === "none") {
        //     x.style.display = "block";
        // } else {
        //     x.style.display = "none";
        // }
    }
    jQuery("#frmGuestPass").delegate("#gpquanttiy", "change", function(){
        // console.log("badar");
        var gpquantity = $('#gpquanttiy').val();
        var gpprice = $('#gpprice').val();
        var totalprice = gpquantity * gpprice;
        $('#gpprice').val(totalprice);
    });
    // $(document).on("click","#addtocart",function(){
    //     console.log("data");
    //         var myoptionid = $(this).attr('id');
    //         //  console.log(myoptionid);
    //         //  e.preventDefault();
    //         var res = myoptionid.split("-");
    //         var price = {{$guestPass->Price}};
    //         var name =  {{$guestPass->Price}};
    //         var slotid = document.getElementById('slotid').value;
    //         var section = res[1];
    //         var playerTeamarray = res[0].split(",");
    //         var playerTeam = playerTeamarray[0];
    // console.log(selectvalue);
    // console.log(matchid);
    // console.log(slotid);
    // console.log(section);
    // console.log(playerTeam);
    //         var values = new Array(selectvalue,matchid,slotid,section);	
    //         $.ajax({	
    //         url: "{{ URL::to('admin/playerscore')}}",
    //         type: "post",	
    //         data: {'_token':"{{ csrf_token() }}",'matchid':matchid,'slotid':slotid,'selectvalue':selectvalue,'section':section,'playerTeam':playerTeam},		
    //         success: function (response) {
    //         },		
    //         error: function(jqXHR, textStatus, errorThrown) {
    //             console.log(textStatus, errorThrown);		
    //             }	
    //     })
    // });
    </script>
    @endsection
    @push('js')
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
@endpush