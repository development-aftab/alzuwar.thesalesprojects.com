@extends('website.layout.master')
<body class="visa package_detail transportation-details">

    @section('content')

@push('css')
    <link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
<style>

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
    /* Packages innerpages inline style start------------- */
    .all-jumpto-bttns {
        margin-left: 50px;
    }
    /* Packages innerpages inline style end------------- */
    }

@media (max-width: 768px) {
    /* Packages innerpages inline style start------------- */
    .package_detail .jumpto-buttons {
        padding: 7px;
    }
    /* Packages innerpages inline style end------------- */
    }

@media (max-width: 767px) {
    /* Packages innerpages inline style start------------- */
    .sec-4 .transportation-imgs img {
        height: auto;
        width: 100%;
    }
    .all-jumpto-bttns {
        margin-left: 0px;
    }
    .package_detail .jumpto-buttons {
        padding: 7px;
    }
    /* Packages innerpages inline style end------------- */
}

@media (max-width: 480px) {
    /* Packages innerpages inline style start------------- */
    .package_detail .jumpto-buttons {
        padding: 0px;
        font-size: 15px;
    }
    .itinerary {
        padding: 0 31px;
    }
    .review_sec {
        padding: 50px 31px;
    }
    .package_detail .all-jumpto-bttns {
        display: flex;
        flex-direction: column;
        width: 35%;
        margin: 10px auto;
    }
    .package_detail .all-jumpto-bttns a {
        margin-bottom: 10px;
        padding: 7px;
    }
    /* Packages innerpages inline style end------------- */
}

@media (max-width: 425px) {
    /* Packages innerpages inline style start------------- */
    .package_detail .all-jumpto-bttns {
        display: flex;
        flex-direction: column;
    }
    .package_detail .jumpto-buttons {
        margin-bottom: 20px;
        padding: 8px;
    }
    .transport-sec .transportation-imgs a.btn {
        width: 38%;
        /* Packages innerpages inline style end------------- */
    }
}

</style>

@endpush
<body class="visa package_detail transportation-details">

    @section('content')


    <section class="transport-sec sec-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-bg-color">
                    {{--<form role="form" id="form_transport_details" class="margin-bottom-0" method="get" action="{{route('search_package_deals')}}">--}}
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
                            {{--<div class="form-group col-md-5">--}}
                                {{--<input class="total_guests" id="total_guests" name="total_guests" value="1" readonly hidden>--}}
                                {{--<div class="row">--}}
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
                                                {{--</script>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group col-md-2">--}}
                                {{--<button class="btn book-now">Search</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>										--}}
                    @if($errors->any())
                        <div class="account-title">
                            <p class="alert alert-success" >{{$errors->first()}}</p>
                        </div>
                    @endif
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('packages')}}">Package Deals</a></li>
                            <li class="breadcrumb-item"><a href="#">{{$packages->getPackageDealsType->package_deals_type_desc??''}}</a></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-7" id="book_now">
                    <div class="card-deck">
                        @if($packages->getPackageDealsDefaultPhoto != null)
                        <img src="{{asset('website/' . $packages->getPackageDealsDefaultPhoto->PhotoLocation??'NOt Available')}}" alt="" class="img-fluid">
					
						<input id="myimage" type="hidden" value="{{asset('website/' . $packages->getPackageDealsDefaultPhoto->PhotoLocation??'NOt Available')}}" >
                    </div>
                    @else
                    <img class="card-img-top" src="{{asset('website/img/not_available.png')}}" alt="Not Available" title="Not Available">
				
					<input id="myimage" type="hidden" value="{{asset('website/img/not_available.png')}}" >
                    @endif
                </div>
                <div class="col-lg-5 transportation-imgs">
                    <div class="row no-gutters">
                        <div class="col-md-12 pb-4">
                            <h2>{{$packages->package_deals_name??''}}</h2>
                            <small>By: {{$packages->getPackageUser->name}}</small>
                            <p>
                                @for( $a=1 ; $a <= round($packages->getPackageReviewForView->avg('Rating')) ; $a++ )
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for( $a=1 ; $a <= 5-round($packages->getPackageReviewForView->avg('Rating')) ; $a++ )
                                    <i class="far fa-star"></i>
                                @endfor
                                    <a href="#reviews">{{$packages->getPackageReviewCountForView->count()}} @if($packages->getPackageReviewCountForView->count()==1) Review @else Reviews @endif</a>
                                @if(Auth::user() != null && sizeof($is_user_book_this_before)>0)
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
                                            <form method="post" action="{{ route('add-package-review') }}">
                                                {{--<div class="form-group">--}}
                                                {{--<label for="recipient-name" class="col-form-label">Recipient:</label>--}}
                                                {{--<input type="text" class="form-control" id="recipient-name">--}}
                                                {{--</div>--}}
                                                @csrf
                                                <input type="hidden" value="{{$packages->id??''}}" name="PackageDealsID">
                                                <input type="hidden" value="{{Auth::User()->name??''}}" name="ReviewerName">
                                                <input type="hidden" value="{{Auth::User()->email??''}}" name="EmailAddress">
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

                            <p>Group Capacity :{{$packages->max_occupancy??''}}</p>

                            <div class="pull-right">
                                <p><b>${{number_format($packages->price, 2, '.', '')}}</b></p>
                            </div>
                            <h4>{{$packages->package_deals_location??''}}</h4>
                            <a onclick="getdefaultimage()" data-toggle="modal" data-target="#guestpass" class="btn">Book Now</a>
                        </div>
                        @foreach($packages->getPackageDealsPhoto as $packageImages)
                        <div class="col-md-6">
                            <div class="cards">
                                <img src="{{asset('website/' . $packageImages->PhotoLocation??'')}}" alt="" class="img-fluid">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="all-jumpto-bttns">
                            <p class="jump-to-package">Jump to:</p>
                            <a class="btn jumpto-buttons" href="#itinerary" role="button">Itinerary</a>
                            <a class="btn jumpto-buttons" href="#description" role="button">Description</a>
                            <a class="btn jumpto-buttons" href="#house_rules" role="button">House Rules</a>
                            <a class="btn jumpto-buttons" href="#reviews" role="button">Reviews</a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    <section class="itinerary" id="itinerary">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="itinerary_content">
                        <h1>Itinerary</h1>
                        <table class="table itinerary_table">
                            <tbody>
                                <tr>
                                    <th scope="row">DEPARTURE</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i class="fas fa-check"></i>
                                                    {{$packages->departure_place??''}}  </span></li>
                                        </ul>
                                    </td>
                                </tr>
                                {{--<tr>--}}
                                    {{--<th scope="row">DURATION</th>--}}
                                    {{--<td>--}}
                                        {{--<ul>--}}
                                            {{--<li><span class="check_icon"><i class="fas fa-check"></i>{{$packages->total_stay??''}}</span></li>--}}
                                        {{--</ul>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                <tr>
                                    <th scope="row">Package Start </th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i class="fas fa-check"></i>{{ \Carbon\Carbon::parse( $packages->package_available_from??'' )->toFormattedDateString() }}</span></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Package Ends </th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i class="fas fa-check"></i>{{ \Carbon\Carbon::parse( $packages->package_available_to??'' )->toFormattedDateString() }}</span></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">COST</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i class="fas fa-check"></i>${{$packages->price??''}}</span></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">HOTELS</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i class="fas fa-check"></i>{{$packages->accomodation??''}}</span>
                                                {{--<span class="updated_to_be">(To be Updated)</span>--}}
                                            </li>
                                            {{--<li><span class="check_icon"><i class="fas fa-check"></i>NAJAF</span>--}}
                                                {{--<span class="updated_to_be">(To be Updated)</span>--}}
                                            {{--</li>--}}
                                            {{--<li><span class="check_icon"><i--}}
                                                        {{--class="fas fa-check"></i>KADHMAIN/BAGHDAD</span>--}}
                                                {{--<span class="updated_to_be">(To be Updated)</span>--}}
                                            {{--</li>--}}
                                            {{--<li><span class="check_icon"><i class="fas fa-check"></i>3/4/5 star--}}
                                                    {{--hotel</span></li>--}}
                                        </ul>
                                    </td>

                                </tr>
                                <tr>
                                    <th scope="row">Guide</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i class="fas fa-check"></i>{{$packages->guide??''}}</span></li>
                                            <li><span class="check_icon"><i class="fas fa-check"></i>Multilingual
                                                    guides</span></li>
                                        </ul>
                                    </td>

                                </tr>
                                <tr>
                                    <th scope="row">PACKAGE INCLUDE</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i class="fas fa-check"></i>
                                                    {{$packages->transportation??''}}</span></li>
                                            <li><span class="check_icon"><i class="fas fa-check"></i>{{$packages->accomodation??''}}</span></li>
                                            <li><span class="check_icon"><i class="fas fa-check"></i>{{$packages->meal??''}}</span></li>
                                            {{--<li><span class="check_icon"><i class="fas fa-check"></i>{{$packages->total_stay??''}}</span></li>--}}
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Deadline to register</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i class="fas fa-check"></i>{{ \Carbon\Carbon::parse( $packages->deadline??'' )->toFormattedDateString() }}</span></li>
                                        </ul>
                                    </td>

                                </tr>
                                <tr>
                                    <th scope="row">Maximum Capacity</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i class="fas fa-check"></i>{{$packages->max_occupancy??''}} people</span>
                                            </li>
                                        </ul>
                                    </td>

                                </tr>
                                <tr>
                                    <th scope="row">Package Deadline</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon" style="color:red;"><i class="fas fa-check"></i>{{ \Carbon\Carbon::parse( $packages->deadline??'' )->toFormattedDateString() }}</span>
                                            </li>
                                        </ul>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                        <div class="package_remain"><a href="#book_now">Book Now ({{$packages->max_occupancy??''}} reservations available)</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="review_sec">
        <div class="container">
            <div class="row" id="description">
                <div class="col-md-12">
                    <h3 class="review-title">Description</h3>
                    <p class="review-para">{!! $packages->package_deals_desc??''!!}</p>
                </div>
            </div>
            <div class="row" id="house_rules">
                <div class="col-md-12">
                    <h3 class="review-title">House Rules</h3>
                    <p class="review-para">{!! $packages->house_rules??''!!}</p>
                </div>
            </div>
                <div class="row" id="reviews">
                    <div class="col-md-12">
                        <div class="review-one">
                            @if($packages->getPackageReviewForView->count() != 0)
                            <h3 class="review-title">Reviews</h3>
                            @foreach($packages->getPackageReviewForView as $packageReview)
                            <p>@for( $a=1 ; $a <= round($packageReview->Rating) ; $a++ )
                                <i class="fas fa-star"></i>
                            @endfor
                            @for( $a=1 ; $a <= 5-round($packageReview->Rating) ; $a++ )
                                <i class="far fa-star"></i>
                            @endfor
                            </p>
                                <span>Review {{$packageReview->created_at->diffForHumans()??''}}</span></h5>
                            </h5>
                            <p class="review-para">{!! $packageReview->Description??''!!}</p>
                            <p>{{$packageReview->ReviewerName??''}}</p>
                            @endforeach
                            @else
                                <div class="row" id="reviews">
                                    <div class="col-md-12 review-one">
                                        <h3 class="review-title">Reviews</h3>
                                        <p class="review-para">No reviews found</p>

                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>		
				<div class="modal fade" id="guestpass">		
					<div class="modal-dialog">		
						<div class="modal-content">		
							<div id="loader"></div>			
							<div class="modal-header">	
								<div class="col-lg-12 transportation-imgs">
									<div class="row no-gutters">
										<div class="col-md-12 pb-4">
											<h2>{{$packages->package_deals_name??''}}</h2>
												{{--<small>By: {{$packages->getPackageUser->name}}</small>--}}
											<p>
												@for( $a=1 ; $a <= round($packages->getPackageReviewForView->avg('Rating')) ; $a++ )
													<i class="fas fa-star"></i>
												@endfor
												@for( $a=1 ; $a <= 5-round($packages->getPackageReviewForView->avg('Rating')) ; $a++ )
													<i class="far fa-star"></i>
												@endfor
													<a href="#reviews">{{$packages->getPackageReviewCountForView->count()}} @if($packages->getPackageReviewCountForView->count()==1) Review @else Reviews @endif</a>
												@if(Auth::user() != null && sizeof($is_user_book_this_before)>0)
													/
													<!-- Button trigger review modal -->
													{{--<a type="button" class="addReviewButton" data-toggle="modal" data-target="#addReviewModal">
														Write a review
													</a>--}}

													<!-- Review Modal -->
											{{--<div class="modal fade" id="addReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLongTitle">Write A Review</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<form method="post" action="{{ route('add-package-review') }}">--}}
																{{--<div class="form-group">--}}
																{{--<label for="recipient-name" class="col-form-label">Recipient:</label>--}}
																{{--<input type="text" class="form-control" id="recipient-name">--}}
																{{--</div>--}}
																@csrf
																{{--<input type="hidden" value="{{$packages->id??''}}" name="PackageDealsID">
																<input type="hidden" value="{{Auth::User()->name??''}}" name="ReviewerName">
																<input type="hidden" value="{{Auth::User()->email??''}}" name="EmailAddress">
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
																					<label for="rating-1"></label>--}}
																					{{--<input type="radio" id="rating-0" name="rating" value="0" class="star-cb-clear" />--}}
																					{{--<label for="rating-0"></label>--}}
																						{{--</span>
																</fieldset>
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																<button type="submit" class="btn btn-primary">Add Review</button>
																						</form>--}}
														</div>
														{{--<div class="modal-footer">--}}
														{{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
														{{--<button type="button" class="btn btn-primary">Add Review</button>--}}
														{{--</div>
													</div>
												</div>
											</div>--}}
											<!-- Review Modal End-->
											@endif
											</p>

											<p>Group Capacity  <span> {{$packages->max_occupancy??''}}</span></p>

												{{--<div class="pull-right">
												<p><b>${{number_format($packages->price, 2, '.', '')}}</b></p>
												</div>
												<h4>{{$packages->package_deals_location??''}}</h4>--}}
										</div>
									</div>
								</div>
							
							{{--<h4 class="modal-title">{{$packages->package_deals_name??''}}</h4><br/>		
								<small>By: {{$packages->getPackageUser->name}}</small><br/>		
								<small>Price: ${{number_format($packages->price, 0, '.', '') ?? ''}}</small>--}}
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>	
							</div>                  
							<form action="{{ route('addtocart')}}" id="frmGuestPass" method="post">    
								{{csrf_field()}}            
								<div class="modal-body">    
								<div id="message"></div>    
								<div class="form-group">     
								<input type="hidden" name="id" value="{{$packages->id}}" />     
								<input type="hidden" id="price" name="price" value="{{$packages->price}}" />  
								<input type="hidden" name="title" value="{{$packages->package_deals_name}}" /> 
								<input type="hidden" name="category" value="1" />                
								<input type="hidden" name="image" id="cartimage" value="" />	
								<input type="hidden" name="date" value="{{$packages->package_available_from}}" />   
								<br />
								<div class="row ml-2 mr-2">
									<div class="col-md-6 ">
									<lable for="addSDphone">Number of Tickets</lable>
									</div>


									<div class="col-md-6 ">
									<input class="form-control" type="number" name="quantity" value="1" min="1"/> 
									</div>
								</div>        
								</div>         
								<div class="modal-footer">   
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    $('#itinerary').click(function() {
        $('.itinerary_content').focus();
    });
    $('#description').click(function() {
        $('.review-para').focus();
    });
    $('#reviews').click(function() {
        $('.review-one').focus();
    });	

	function getdefaultimage(){	
	
		var packageImage = jQuery("#myimage").val();	
		var packagesetImage = jQuery("#cartimage").val(packageImage);
		
	}
</script>
@endpush