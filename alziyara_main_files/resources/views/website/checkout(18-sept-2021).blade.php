@extends('website.layout.master')

<body class="home">

@section('content')



<section id="modal-one">
      <div class="container checkout_container">
         <div class="section-1">
            <div class="row">
               <div class="col-md-7">
                  <div class="row">
                     <div class="col-md-12">
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
						   
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
								
								@if(isset($cart["category"]))
							  
									@if($cart["category"] == 4)
										   
										   
											<li class="breadcrumb-item"><a href="{{route('guestspasses')}}">Guest Passes</a></li>
											<li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{$cart['title']}}</a></li>
										   
									@elseif($cart["category"] == 1)
										   
										   
											<li class="breadcrumb-item"><a href="{{route('guestspasses')}}">Package Deals</a></li>
											<li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{$cart['title']}}</a></li>
											
											
									@elseif($cart["category"] == 2)
										   
										   
											<li class="breadcrumb-item"><a href="{{route('hotels')}}">Hotel</a></li>
											<li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{$cart['title']}}</a></li>
											
									@elseif($cart["category"] == 3)
										   
											<li class="breadcrumb-item"><a href="{{route('guestspasses')}}">Transport</a></li>
											<li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{$cart['title']}}</a></li>
											
									@elseif($cart["category"] == 5)
										   
										   
											<li class="breadcrumb-item"><a href="{{route('guestspasses')}}">Guide</a></li>
											<li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{$cart['title']}}</a></li>
											
									@else
										
											
									@endif
									
								@endif
                              <!--  <li class="breadcrumb-item"><a href="#">Buss</a></li>-->
                              <!--<li class="breadcrumb-item active" aria-current="page">Name of Vehicle / Plate#</li>-->
                           </ol>
                        </nav>
                     </div>
                  </div>
                  <div class="row">
                     
						   @if(isset($cart))
                              
                                @if($cart["category"] == "4")
										
									<div class="col-md-4">
										<img src="{{$cart['image']}}" class="img-fluid" alt="">
									</div>
									<div class="col-md-8">
										<div class="sect-one-txt">
									
									
											<h5 class="title-hotel">Guest Passes</h5>
											<h1 class="main-heading">{{$cart['title']}}</h1>
											<p class="address-najaf">{{$categoryitem->GuestPassLocation}}</p>
											<p class="guest-rating">Guests have rated it {{ round($categoryitem->getGuestPassreviewdetails->avg('Rating'),2) }}!</p>
												
												@for( $a=1 ; $a <= round($categoryitem->getGuestPassreviewdetails->avg('Rating')) ; $a++ )

													<i class="fas fa-star"></i>

												@endfor

												@for( $a=1 ; $a <= 5-round($categoryitem->getGuestPassreviewdetails->avg('Rating')) ; $a++ )

													<i class="far fa-star"></i>

												@endfor
											
											<div class="reviews">
											  <h4 class="rating-num">{{ round($categoryitem->getGuestPassreviewdetails->avg('Rating'),2) }} out of 5</h4>
											  
											  <?php $ratings = round($categoryitem->getGuestPassreviewdetails->avg('Rating'),2); ?>
												
												
												@if($ratings >= 4)
														<h4 class='rating-text'>Excellent</h4>
												@elseif($ratings >= 3)
														<h4 class='rating-text'>Very Good</h4>
												@elseif($ratings >= 2)
														<h4 class='rating-text'>Good</h4>
												@elseif($ratings >= 1)
														<h4 class='rating-text'>Fine/New Product</h4>
												@else
														<h4 class='rating-text'>Select Product</h4>
												@endif
											  
											  
											  <p class="reviews-para">{{$categoryitem->getGuestPassreviewdetails->count()}} reviews</p>
										   </div>
										</div>
									</div>
									
                                @elseif($cart["category"] == "1")
								
									<div class="col-md-4">
										<img src="{{$cart['image']}}" class="img-fluid" alt="">
									</div>
									<div class="col-md-8">
										<div class="sect-one-txt">
								
											<!--<h5 class="title-hotel">Package Deal<span><i class="fas fa-thumbs-up"></i></span></h5>
											<h5 class="title-hotel">Package Deal<span><i class="fas fa-thumbs-up"></i></span></h5>-->
											<h1 class="main-heading">{{$cart['title']}}</h1>
											<p class="address-najaf">{{$categoryitem->package_deals_location}}</p>
											<p class="guest-rating">Guests have rated it {{ round($categoryitem->getPackageReviewForView->avg('Rating'),2) }}!</p>
											
												@for( $a=1 ; $a <= round($categoryitem->getPackageReviewForView->avg('Rating')) ; $a++ )

													<i class="fas fa-star"></i>

												@endfor

												@for( $a=1 ; $a <= 5-round($categoryitem->getPackageReviewForView->avg('Rating')) ; $a++ )

													<i class="far fa-star"></i>

												@endfor
											
											<div class="reviews">
												<h4 class="rating-num">{{ round($categoryitem->getPackageReviewAverageForView->averageRating,2) }} out of 5</h4>
												<?php $ratings = round($categoryitem->getPackageReviewAverageForView->averageRating,2); ?>
										
										
												@if($ratings >= 4)
														<h4 class='rating-text'>Excellent</h4>
												@elseif($ratings >= 3)
														<h4 class='rating-text'>Very Good</h4>
												@elseif($ratings >= 2)
														<h4 class='rating-text'>Good</h4>
												@elseif($ratings >= 1)
														<h4 class='rating-text'>Fine/New Product</h4>
												@else
														<h4 class='rating-text'>Select Product</h4>
												@endif
												
												<p class="reviews-para">{{$categoryitem->getPackageReviewCountForView[0]->countReview}} reviews</p>
											</div>	
										</div>
									</div>
									
                                @elseif($cart["category"] == "2")
								
									<div class="col-md-4">
										<img src="{{$cart['image']}}" class="img-fluid" alt="">
									</div>
									<div class="col-md-8">
										<div class="sect-one-txt">
								
											<h5 class="title-hotel">Hotel</h5>
											<h1 class="main-heading">{{$cart['title']}}</h1>
											<p class="address-najaf">{{$categoryitem->City}}</p>
											<p class="guest-rating">Guests have rated it {{ round($categoryitem->getHotelReviewAverage[0]->averageRating,2) }}!</p>
									
											<div class="reviews">
												<h4 class="rating-num">{{ round($categoryitem->getHotelReviewAverage[0]->averageRating,2) }} out of 5</h4>
												<?php $ratings = round($categoryitem->getHotelReviewAverage[0]->averageRating,2); ?>
										
										
												@if($ratings >= 4)
														<h4 class='rating-text'>Excellent</h4>
												@elseif($ratings >= 3)
														<h4 class='rating-text'>Very Good</h4>
												@elseif($ratings >= 2)
														<h4 class='rating-text'>Good</h4>
												@elseif($ratings >= 1)
														<h4 class='rating-text'>Fine/New Product</h4>
												@else
														<h4 class='rating-text'>Select Product</h4>
												@endif
												
												<p class="reviews-para">{{$categoryitem->getHotelReview->count()}} reviews</p>
											</div>
									
										</div>
								   
								   </div>
									
                                @elseif($cart["category"] == "3")
								
									<div class="col-md-4">
										<img src="{{$cart['image']}}" class="img-fluid" alt="">
									</div>
									<div class="col-md-8">
										<div class="sect-one-txt">
											
											<h5 class="title-hotel">Transport</h5>
											<h1 class="main-heading">{{$cart['title']}}</h1>
											
											<?php
												
												$getroute = explode('-',$cart['title']);
												
												$ratings = round($categoryitem->getTransportReviewAverageForView->avg('averageRating'));
												
												?>
											<p class="address-najaf">{{$getroute[1]}}</p>
											<p class="guest-rating">Guests have rated it {{ $ratings }} out of 5</p>
											
											
											<div class="reviews">
												<h4 class="rating-num">
												
													@for( $a=1 ; $a <= round($categoryitem->getTransportReviewAverageForView->avg('averageRating')) ; $a++ )

														<i class="fas fa-star"></i>

													@endfor

													@for( $a=1 ; $a <= 5-round($categoryitem->getTransportReviewAverageForView->avg('averageRating')) ; $a++ )

														<i class="far fa-star"></i>

													@endfor
												
												</h4>
												@if($ratings >= 4)
														<h4 class='rating-text'>Excellent</h4>
												@elseif($ratings >= 3)
														<h4 class='rating-text'>Very Good</h4>
												@elseif($ratings >= 2)
														<h4 class='rating-text'>Good</h4>
												@elseif($ratings >= 1)
														<h4 class='rating-text'>Fine/New Product</h4>
												@else
														<h4 class='rating-text'>Select Product</h4>
												@endif
												
												@if(count($categoryitem->getTransportReview)>1)

														<p class="reviews-para">{{ count($categoryitem->getTransportReviewForView) }} reviews</p>

												@else

														<p class="reviews-para">{{ count($categoryitem->getTransportReviewForView) }} review</p>

												@endif
											
											</div>
											
											
											
											
										</div>
									</div>
								   
                                @elseif($cart["category"] == "5")
								
									<div class="col-md-4">
										<img src="{{$cart['image']}}" class="img-fluid" alt="">
									</div>
									<div class="col-md-8">
										<div class="sect-one-txt">

											<h5 class="title-hotel">Guide</h5>
											<h1 class="main-heading">{{$cart['title']}}</h1>
											<p class="address-najaf">{{$categoryitem->GuidesLocation}}</p>
											<p class="guest-rating">Guests have rated it {{ round($categoryitem->getGuideReviewForView->avg('Rating'),2) }} !</p>

												@for( $a=1 ; $a <= round($categoryitem->getGuideReviewForView->avg('Rating')) ; $a++ )

													<i class="fas fa-star"></i>

												@endfor

												@for( $a=1 ; $a <= 5-round($categoryitem->getGuideReviewForView->avg('Rating')) ; $a++ )

													<i class="far fa-star"></i>

												@endfor

											<div class="reviews">
											  <h4 class="rating-num">{{ round($categoryitem->getGuideReviewForView->avg('Rating'),2) }} out of 5</h4>

											  <?php $ratings = round($categoryitem->getGuideReviewForView->avg('Rating'),2); ?>


												@if($ratings >= 4)
														<h4 class='rating-text'>Excellent</h4>
												@elseif($ratings >= 3)
														<h4 class='rating-text'>Very Good</h4>
												@elseif($ratings >= 2)
														<h4 class='rating-text'>Good</h4>
												@elseif($ratings >= 1)
														<h4 class='rating-text'>Fine/New Product</h4>
												@else
														<h4 class='rating-text'>Select Product</h4>
												@endif


											  <p class="reviews-para">{{$categoryitem->getGuideReviewForView->count()}} reviews</p>
										   </div>
									   
									  </div>
								   
								   </div>
								
								
								@else
									
									<div class="col-md-4">
										<img src="" class="img-fluid" alt="">
									</div>
									<div class="col-md-8">
										<div class="sect-one-txt">
									
											<div class="reviews">
												<h4 class="rating-num">0.0</h4>
												<h4 class="rating-text">Select Product</h4>
												<p class="reviews-para">0 reviews</p>
											</div>
											
												<h5 class="title-hotel">Select Product</h5>
											   <h1 class="main-heading">No Title</h1>
											   <p class="address-najaf">No Location</p>
											   <p class="guest-rating">Guests have rated it 0.0!</p>
									   
									   
										</div>
								   
								   </div>
								
								
                                @endif
								
							@else
								
								<h5 class="title-hotel">Kindly Select Product</h5> 
								
                           @endif
                        
                  </div>
				
                  
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @if(session('message'))
                  <!-- <div class="account-title">{{session('message')}}</div> -->
                  <div class="account-title">  

                     <p class="alert alert-danger" >{{session('message')}}</p>
                     
                  </div>
                @endif

                
                  <div class="section-2">
                     <h2 class="person-booking">@if(isset(Auth::user()->id)) {{Auth::user()->name}} is booking! @else Who is booking? @endif</h2>
					 
						@if(isset(Auth::user()->id))
							
						<form action="{{ route('mycheckoutauth')}}" method="POST" >
						
						@csrf
						
						@else
						<form action="{{ route('registeruser')}}" method="POST" >
                        @csrf
                        <div class="form-row for-user-icon">
                           <div class="form-group col-md-8">
                              <label for="inputEmail4">Name <span>*</span></label>
                              <i class="fas fa-user"></i>
                              <input type="text" name="name" class="form-control" id="inputEmail4" value="{{old('name')}}"  required placeholder="First and Last Name">
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="col-md-12">
                              <label for="">Country/Territory Code <span>*</span> </label>
                           </div>
                           <!--<div class="btn-group">
                              <button type="button" class="btn  dropdown-toggle country-drop territory-code" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                              United States of America +1
                              </button>

                              <input class="form-control" id="jquery-intl-phone" name="country" type="tel">

                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                                 <button class="dropdown-item" type="button">Qatar</button>
                                 <button class="dropdown-item" type="button">Pakistan</button>
                                 <button class="dropdown-item" type="button">Saudi</button>
                              </div>
                           </div>
                        </div>
                        <div class="form-row">-->
                           <div class="form-group col-md-8">
                           <select class="form-control" name="countryCode" id=""  required >
                                 <option value="">Select Country</option>
                                 <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                                 <option data-countryCode="AD" value="376">Andorra (+376)</option>
                                 <option data-countryCode="AO" value="244">Angola (+244)</option>
                                 <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
                                 <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                                 <option data-countryCode="AR" value="54">Argentina (+54)</option>
                                 <option data-countryCode="AM" value="374">Armenia (+374)</option>
                                 <option data-countryCode="AW" value="297">Aruba (+297)</option>
                                 <option data-countryCode="AU" value="61">Australia (+61)</option>
                                 <option data-countryCode="AT" value="43">Austria (+43)</option>
                                 <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
                                 <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
                                 <option data-countryCode="BH" value="973">Bahrain (+973)</option>
                                 <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                                 <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
                                 <option data-countryCode="BY" value="375">Belarus (+375)</option>
                                 <option data-countryCode="BE" value="32">Belgium (+32)</option>
                                 <option data-countryCode="BZ" value="501">Belize (+501)</option>
                                 <option data-countryCode="BJ" value="229">Benin (+229)</option>
                                 <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
                                 <option data-countryCode="BT" value="975">Bhutan (+975)</option>
                                 <option data-countryCode="BO" value="591">Bolivia (+591)</option>
                                 <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
                                 <option data-countryCode="BW" value="267">Botswana (+267)</option>
                                 <option data-countryCode="BR" value="55">Brazil (+55)</option>
                                 <option data-countryCode="BN" value="673">Brunei (+673)</option>
                                 <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
                                 <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
                                 <option data-countryCode="BI" value="257">Burundi (+257)</option>
                                 <option data-countryCode="KH" value="855">Cambodia (+855)</option>
                                 <option data-countryCode="CM" value="237">Cameroon (+237)</option>
                                 <option data-countryCode="CA" value="1">Canada (+1)</option>
                                 <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
                                 <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
                                 <option data-countryCode="CF" value="236">Central African Republic (+236)</option>
                                 <option data-countryCode="CL" value="56">Chile (+56)</option>
                                 <option data-countryCode="CN" value="86">China (+86)</option>
                                 <option data-countryCode="CO" value="57">Colombia (+57)</option>
                                 <option data-countryCode="KM" value="269">Comoros (+269)</option>
                                 <option data-countryCode="CG" value="242">Congo (+242)</option>
                                 <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
                                 <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
                                 <option data-countryCode="HR" value="385">Croatia (+385)</option>
                                 <option data-countryCode="CU" value="53">Cuba (+53)</option>
                                 <option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
                                 <option data-countryCode="CY" value="357">Cyprus South (+357)</option>
                                 <option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
                                 <option data-countryCode="DK" value="45">Denmark (+45)</option>
                                 <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
                                 <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
                                 <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
                                 <option data-countryCode="EC" value="593">Ecuador (+593)</option>
                                 <option data-countryCode="EG" value="20">Egypt (+20)</option>
                                 <option data-countryCode="SV" value="503">El Salvador (+503)</option>
                                 <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
                                 <option data-countryCode="ER" value="291">Eritrea (+291)</option>
                                 <option data-countryCode="EE" value="372">Estonia (+372)</option>
                                 <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
                                 <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
                                 <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
                                 <option data-countryCode="FJ" value="679">Fiji (+679)</option>
                                 <option data-countryCode="FI" value="358">Finland (+358)</option>
                                 <option data-countryCode="FR" value="33">France (+33)</option>
                                 <option data-countryCode="GF" value="594">French Guiana (+594)</option>
                                 <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
                                 <option data-countryCode="GA" value="241">Gabon (+241)</option>
                                 <option data-countryCode="GM" value="220">Gambia (+220)</option>
                                 <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
                                 <option data-countryCode="DE" value="49">Germany (+49)</option>
                                 <option data-countryCode="GH" value="233">Ghana (+233)</option>
                                 <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
                                 <option data-countryCode="GR" value="30">Greece (+30)</option>
                                 <option data-countryCode="GL" value="299">Greenland (+299)</option>
                                 <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
                                 <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
                                 <option data-countryCode="GU" value="671">Guam (+671)</option>
                                 <option data-countryCode="GT" value="502">Guatemala (+502)</option>
                                 <option data-countryCode="GN" value="224">Guinea (+224)</option>
                                 <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
                                 <option data-countryCode="GY" value="592">Guyana (+592)</option>
                                 <option data-countryCode="HT" value="509">Haiti (+509)</option>
                                 <option data-countryCode="HN" value="504">Honduras (+504)</option>
                                 <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
                                 <option data-countryCode="HU" value="36">Hungary (+36)</option>
                                 <option data-countryCode="IS" value="354">Iceland (+354)</option>
                                 <option data-countryCode="IN" value="91">India (+91)</option>
                                 <option data-countryCode="ID" value="62">Indonesia (+62)</option>
                                 <option data-countryCode="IR" value="98">Iran (+98)</option>
                                 <option data-countryCode="IQ" value="964">Iraq (+964)</option>
                                 <option data-countryCode="IE" value="353">Ireland (+353)</option>
                                 <option data-countryCode="IL" value="972">Israel (+972)</option>
                                 <option data-countryCode="IT" value="39">Italy (+39)</option>
                                 <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
                                 <option data-countryCode="JP" value="81">Japan (+81)</option>
                                 <option data-countryCode="JO" value="962">Jordan (+962)</option>
                                 <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
                                 <option data-countryCode="KE" value="254">Kenya (+254)</option>
                                 <option data-countryCode="KI" value="686">Kiribati (+686)</option>
                                 <option data-countryCode="KP" value="850">Korea North (+850)</option>
                                 <option data-countryCode="KR" value="82">Korea South (+82)</option>
                                 <option data-countryCode="KW" value="965">Kuwait (+965)</option>
                                 <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
                                 <option data-countryCode="LA" value="856">Laos (+856)</option>
                                 <option data-countryCode="LV" value="371">Latvia (+371)</option>
                                 <option data-countryCode="LB" value="961">Lebanon (+961)</option>
                                 <option data-countryCode="LS" value="266">Lesotho (+266)</option>
                                 <option data-countryCode="LR" value="231">Liberia (+231)</option>
                                 <option data-countryCode="LY" value="218">Libya (+218)</option>
                                 <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
                                 <option data-countryCode="LT" value="370">Lithuania (+370)</option>
                                 <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
                                 <option data-countryCode="MO" value="853">Macao (+853)</option>
                                 <option data-countryCode="MK" value="389">Macedonia (+389)</option>
                                 <option data-countryCode="MG" value="261">Madagascar (+261)</option>
                                 <option data-countryCode="MW" value="265">Malawi (+265)</option>
                                 <option data-countryCode="MY" value="60">Malaysia (+60)</option>
                                 <option data-countryCode="MV" value="960">Maldives (+960)</option>
                                 <option data-countryCode="ML" value="223">Mali (+223)</option>
                                 <option data-countryCode="MT" value="356">Malta (+356)</option>
                                 <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
                                 <option data-countryCode="MQ" value="596">Martinique (+596)</option>
                                 <option data-countryCode="MR" value="222">Mauritania (+222)</option>
                                 <option data-countryCode="YT" value="269">Mayotte (+269)</option>
                                 <option data-countryCode="MX" value="52">Mexico (+52)</option>
                                 <option data-countryCode="FM" value="691">Micronesia (+691)</option>
                                 <option data-countryCode="MD" value="373">Moldova (+373)</option>
                                 <option data-countryCode="MC" value="377">Monaco (+377)</option>
                                 <option data-countryCode="MN" value="976">Mongolia (+976)</option>
                                 <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
                                 <option data-countryCode="MA" value="212">Morocco (+212)</option>
                                 <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
                                 <option data-countryCode="MN" value="95">Myanmar (+95)</option>
                                 <option data-countryCode="NA" value="264">Namibia (+264)</option>
                                 <option data-countryCode="NR" value="674">Nauru (+674)</option>
                                 <option data-countryCode="NP" value="977">Nepal (+977)</option>
                                 <option data-countryCode="NL" value="31">Netherlands (+31)</option>
                                 <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
                                 <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                                 <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
                                 <option data-countryCode="NE" value="227">Niger (+227)</option>
                                 <option data-countryCode="NG" value="234">Nigeria (+234)</option>
                                 <option data-countryCode="NU" value="683">Niue (+683)</option>
                                 <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
                                 <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
                                 <option data-countryCode="NO" value="47">Norway (+47)</option>
                                 <option data-countryCode="OM" value="968">Oman (+968)</option>
								 <option data-countryCode="PS" value="970">Palestine (+970)</option>
                                 <option data-countryCode="PW" value="680">Palau (+680)</option>
                                 <option data-countryCode="PK" value="92">Pakistan (+92)</option>
                                 <option data-countryCode="PA" value="507">Panama (+507)</option>
                                 <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
                                 <option data-countryCode="PY" value="595">Paraguay (+595)</option>
                                 <option data-countryCode="PE" value="51">Peru (+51)</option>
                                 <option data-countryCode="PH" value="63">Philippines (+63)</option>
                                 <option data-countryCode="PL" value="48">Poland (+48)</option>
                                 <option data-countryCode="PT" value="351">Portugal (+351)</option>
                                 <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
                                 <option data-countryCode="QA" value="974">Qatar (+974)</option>
                                 <option data-countryCode="RE" value="262">Reunion (+262)</option>
                                 <option data-countryCode="RO" value="40">Romania (+40)</option>
                                 <option data-countryCode="RU" value="7">Russia (+7)</option>
                                 <option data-countryCode="RW" value="250">Rwanda (+250)</option>
                                 <option data-countryCode="SM" value="378">San Marino (+378)</option>
                                 <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
                                 <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
                                 <option data-countryCode="SN" value="221">Senegal (+221)</option>
                                 <option data-countryCode="CS" value="381">Serbia (+381)</option>
                                 <option data-countryCode="SC" value="248">Seychelles (+248)</option>
                                 <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
                                 <option data-countryCode="SG" value="65">Singapore (+65)</option>
                                 <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
                                 <option data-countryCode="SI" value="386">Slovenia (+386)</option>
                                 <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
                                 <option data-countryCode="SO" value="252">Somalia (+252)</option>
                                 <option data-countryCode="ZA" value="27">South Africa (+27)</option>
                                 <option data-countryCode="ES" value="34">Spain (+34)</option>
                                 <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                                 <option data-countryCode="SH" value="290">St. Helena (+290)</option>
                                 <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
                                 <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
                                 <option data-countryCode="SD" value="249">Sudan (+249)</option>
                                 <option data-countryCode="SR" value="597">Suriname (+597)</option>
                                 <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
                                 <option data-countryCode="SE" value="46">Sweden (+46)</option>
                                 <option data-countryCode="CH" value="41">Switzerland (+41)</option>
                                 <option data-countryCode="SI" value="963">Syria (+963)</option>
                                 <option data-countryCode="TW" value="886">Taiwan (+886)</option>
                                 <option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
                                 <option data-countryCode="TH" value="66">Thailand (+66)</option>
                                 <option data-countryCode="TG" value="228">Togo (+228)</option>
                                 <option data-countryCode="TO" value="676">Tonga (+676)</option>
                                 <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
                                 <option data-countryCode="TN" value="216">Tunisia (+216)</option>
                                 <option data-countryCode="TR" value="90">Turkey (+90)</option>
                                 <option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
                                 <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
                                 <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
                                 <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
                                 <option data-countryCode="UG" value="256">Uganda (+256)</option>
                                 <option data-countryCode="GB" value="44">UK (+44)</option>
                                 <option data-countryCode="UA" value="380">Ukraine (+380)</option>
                                 <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
                                 <option data-countryCode="UY" value="598">Uruguay (+598)</option>
                                 <option data-countryCode="US" value="1">USA (+1)</option> 
                                 <option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
                                 <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
                                 <option data-countryCode="VA" value="379">Vatican City (+379)</option>
                                 <option data-countryCode="VE" value="58">Venezuela (+58)</option>
                                 <option data-countryCode="VN" value="84">Vietnam (+84)</option>
                                 <option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>
                                 <option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
                                 <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                                 <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
                                 <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
                                 <option data-countryCode="ZM" value="260">Zambia (+260)</option>
                                 <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                              </optgroup>
                           </select>
                           </div>
                        </div>
                        <div class="form-row for-user-icon">
                           <div class="form-group col-md-8">
                              <label for="inputEmail4">Phone number <span>*</span></label>
                              <i class="fas fa-phone-alt"></i>
                              <input type="text" class="form-control" id="inputEmail4" required name="phone" value="{{old('phone')}}" placeholder="In case we need to reach you">
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="col-md-8">
                              <h3 class="confirm-mail">Confirmation email</h3>
                              <p class="email-text-conf">Please enter the email address where you would like to receive your confirmation</p>
                           </div>
                        </div>
                        <div class="form-row for-user-icon">
                           <div class="form-group col-md-8">
                              <label for="inputEmail4">Email address <span>*</span></label>
                              <i class="fas fa-envelope"></i>
                              <input type="email" class="form-control" id="inputEmail4" required name="email" value="{{old('email')}}" placeholder="Enter you email address">
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="booking-sect">
                              <h5 class="manage-booking">Manage your booking</h5>
                              <div class="right-tick">
                                 <i class="fas fa-check"></i>
                                 <a href="#!">Earn points for free travel</a>
                                 <i class="fas fa-check"></i>
                                 <a href="#!">Save with Member Prices</a>
                                 <i class="fas fa-check"></i>
                                 <a href="#!">Easily access your intineraries</a>
                              </div>
                              <p>Enter a password to create an account using the email address.</p>
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="form-group col-md-8">
                              <label for="inputEmail4">Create password</label>
                              <input type="text" class="form-control" id="inputEmail4" name="password" placeholder="6 - 30 characters,  no spaces" required >
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="form-group col-md-8">
                              <label for="inputEmail4">Confirm password</label>
                              <input type="text" class="form-control" name="password_confirmation" id="inputEmail4" required >
                           </div>
                        </div>
						@endif
                        <div class="form-row">
                           <div class="col-md-12 more">
                              <h3 class="more-text">More...</h3>
                              <p class="more-para">Select Yes or No continue booking <span>*</span></p>
                              <input type="hidden" name="formtotalamount" id="formtotalamount" value=""  >
                              <input type="hidden" name="formtotaldonation" id="formtotaldonation" value=""  >
                           </div>
                        </div>
                        <div class="row more-section">
                           <div class="col-md-10">
                              <div class="Yes-more-section">
                                 <h4>Insurance</h4>
                                 <input type="radio" id="html" name="Insurance" onchange="insurance();" value="1"><label for="html">Yes, I need medical insurance</label><br>
                                 <li> <i class="fas fa-check"></i>The healthcare system is extensive and will support you in the event of illness.</span></li>
                                 <li><i class="fas fa-check"></i><span>Everyone who plan to visit ziyara will be assured that they are insured in the event of illness.</span></li>
                                 <li><i class="fas fa-check"></i><span>Never compromise on your health.</span></span></li>
                                 <li><i class="fas fa-check"></i>Covers your rental car from <span>theif, Vandalism</span> and <span>collion damage</span></li>
                                 <!--<li><i class="fas fa-check"></i>Covers your rental car from <span>theif, Vandalism</span> and <span>collion damage</span></li>-->
                                 <a href="#!">View insurance details and disclosure</a>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="calendar-day">
                                 <h4>$10.00</h4>
                              </div>
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="col-md-12 No">
                              <input type="radio" id="html" name="Insurance" onchange="insurance();" checked="checked" value="0"><label for="html">No, I am willing to take the risk</label><br>
                           </div>
                        </div>
                        <div class="row more-section donation">
                           <div class="col-md-10">
                              <h4>Donation</h4>
                              <div class="Yes-more-section">
                                 <div class="form-inline">
                                    <input type="radio" id="html" name="donation" onchange="mydonation();" value="1">
                                    <label for="html">Yes, I would like to donate to with this reservation.</label>
                                    <!--<select class="form-control" name="owner_dm">
                                       <option value="1">Mecca</option>
                                       <option value="1">Medina</option>
                                       <option value="1">Karbala</option>
                                       <option value="1">Najaf</option>
                                       <option value="1">Baghdad</option>
                                       <option value="1">Kadhmain</option>
                                       <option value="1">Samarrah</option>
                                    </select>
                                    <label for="html"></label>-->
                                 </div>
                                 Yes, I would like to donate to (Drop Down of Shrines Names) with this reservation.</label>
                                 <li> <i class="fas fa-check"></i>The healthcare system is extensive and will support you in the event of illness.</span></li>
                                 <li><i class="fas fa-check"></i><span>Everyone who plan to visit ziyara will be assured that they are insured in the event of illness.</span></li>
                                 <li><i class="fas fa-check"></i><span>Never compromise on your health.</span></span></li>
                                 <li><i class="fas fa-check"></i>Covers your rental car from <span>thef, Vandalism</span> and <span>collion damage</span></li>
                                 <li><i class="fas fa-check"></i>Covers your rental car from <span>thef, Vandalism</span> and <span>collion damage</span></li>
                                 <a href="#!">View insurance details and disclosure</a>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="calendar-day">
                                 <h4>$10.00</h4>
                                 <div class="amount_donation">
                                    <span>$</span>
                                    <input type="number" id="donationamountform" value="10"   placeholder="Amount"/>    
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="col-md-12 No">
                              <input type="radio" id="html" name="donation" checked="checked" onchange="mydonation();" value="0"><label for="html">Skip Donation</label><br>
                           </div>
                        </div>
                        <p class="surprise text">"I was surprised how quickly the claim was resolved and with minimal paperwork. And no deductible!!!"</p>
                        <div class="all-visa-nd-anchor">
                           <h3 class="payment">Payment</h3>
                           <br>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="paymentType" id="" value="1">
                              <label class="form-check-label" for="">Bank Check</label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" checked="checked" name="paymentType" id="" value="2">
                              <label class="form-check-label"  for="">Cash</label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="paymentType" id="" value="3">
                              <label class="form-check-label" for="">Credit</label>
                           </div>
                           <br><br>
                           <i class="fas fa-check"></i>
                           <a href="#!">we use secure transmission</a>
                           <i class="fas fa-check"></i>
                           <a href="#!">we protect your personal information</a>
                           <div class="payment-imgs">
                              <img src="./img/db1.png" alt="" class="img-fluid">
                              <img src="./img/db2.png" alt="" class="img-fluid">
                              <img src="./img/db3.png" alt="" class="img-fluid">
                              <img src="./img/db4.png" alt="" class="img-fluid">
                              <img src="./img/db5.png" alt="" class="img-fluid">
                              <img src="./img/db6.png" alt="" class="img-fluid">
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="form-group col-md-8">
                              <label for="inputEmail4">Name on card <span>*</span></label>
                              <input type="text" class="form-control" id="inputEmail4">
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="form-group col-md-8">
                              <label for="inputEmail4">Debit/Credit card number<span>*</span></label>
                              <input type="text" class="form-control" id="inputEmail4">
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="exp-date col-md-8">
                              <h5>Expiration Date <span>*</span></h5>
                              <div class="dropdown">
                                 <button class="btn exp-date-drp dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 Month
                                 </button>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button">January</button>
                                    <button class="dropdown-item" type="button">Feb</button>
                                    <button class="dropdown-item" type="button">Mar</button>
                                 </div>
                              </div>
                              <div class="dropdown">
                                 <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 Year
                                 </button>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button">2020</button>
                                    <button class="dropdown-item" type="button">2021</button>
                                    <button class="dropdown-item" type="button">2022</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="zip">
                           <div class="form-row">
                              <div class="form-group col-md-4">
                                 <label for="inputZip">Security code <span>*</span></label>
                                 <input type="text" class="form-control" id="inputZip">
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputZip">Billing ZIP code</label>
                                 <input type="text" class="form-control" id="inputZip">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12 text-area">
                              <h3>Special Requests</h3>
                              <div class="text-area-bg">
                                 <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt, veritatis.</p>
                                 <h5>Please write your requests in English. <span>(optional)</span></h5>
                                 <textarea name="customernotes" id="" cols="90" rows="3" required></textarea>
                              </div>
                           </div>
                        </div>
                        <div class="car-info">
							
							@if(isset($cart))
								@if($cart["category"] == "4")
									<h3>House Rules of GuestPass</h3>
									<p> ( {{$cart['title']}} ) - ( {{$cart['date']}} )</p>
									<li>The following rules and restriction are provided by the Vendor ( <strong>{{$categoryitem->guestpassbyuser[0]->name}} </strong>)</li>
									<p>{!! $categoryitem->HouseRules !!}</p>
								@elseif($cart["category"] == "2")
									<h3>House Rules of Hotels</h3>
									<p>( {{$cart['title']}} )  - ( {{$cart['date']}} )</p>
									<li>The following rules and restriction are provided by the Vendor ( <strong>{{ $categoryitem->getUserofProperty->name }} </strong>)</li>
									<p>{!! $categoryitem->HouseRules !!}</p>
									<input type="hidden" name="propertyid" value="{{$categoryitem->PropertyID}}" >
								@elseif($cart["category"] == "1" )
									<h3>House Rules of PackageDeals</h3>
									<p>( {{$cart['title']}} ) - ( {{$cart['date']}} )</p>
									<li>The following rules and restriction are provided by the Vendor ( <strong>{{ $categoryitem->getPackageUser->name }} </strong>)</li>
									<p>{!! $categoryitem->house_rules !!}</p>
								@elseif($cart["category"] == "5")
									<h3>House Rules of Guide</h3>
									<p>( {{$cart['title']}} ) - ( {{$cart['date']}} )</p>
									<li>The following rules and restriction are provided by the Vendor ( <strong>{{ $categoryitem->getguideUser->name }} </strong>)</li>
									<p>{!! $categoryitem->HouseRules !!}</p>
								@elseif($cart["category"] == "3")
									<h3>House Rules of Transport</h3>
									<p>( {{$cart['title']}} ) - ( {{$cart['date']}} )</p>
									<li>The following rules and restriction are provided by the Vendor ( <strong>{{ $categoryitem->getTransportuser->name }} </strong>)</li>
									<input type="hidden" name="pickuplocation" value="{{$cart['pickuplocation']}}" />
									<input type="hidden" name="dropofflocation" value="{{$cart['dropofflocation']}}" />
									<input type="hidden" name="triptype" value="{{$cart['triptype']}}" />
									<input type="hidden" name="tofrom" value="{{$getroute[1]}}"/>
									<p>{!! $categoryitem->HouseRules !!}</p>
								@endif
							@endif
							
                           <li>By selecting to complete this booking I acknowledge that i have read and accept the <a href="#!">Rules & Restriction</a> <a href="#!">Terms of Use</a>, <a href="#!">Privacy Policy</a> and <a href="#!">Government Travel Advice</a></li>
                        </div>
                        <div class="col-md-6">
                            <a type="submit">
                                <script
                                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                        data-key="pk_test_51IwCsLHvXmO4xH0sWKA78TwVhFr8X6NpCeidqIUCx2qU5I6QNwZdLuNPP0HiVDqKLuKKuWKYRb6tnHtGkULPw4o300g2qO6tZv"
                                        data-image=""
                                        data-allow-remember-me="false"
                                        data-label="Pay With Stripe">
                                </script>
                            </a>
                           <!--<a href="#!" class="btn reserve-now" data-toggle="modal" data-target="#largeModal">Book Now > </a>-->
                            {{--<input type="submit" class="btn reserve-now" value="Book Now >">--}}
                        </div>
                        <div class="lock-text">
                           <p class="lock-para"> <i class="fas fa-lock"></i> we sue secure transmision and encrypted your personal information.</p>
                           <p class="lock-para">This payment will be processed in the U.S. This does not apply the travel provider (airline/hotel/rail, etc )process Your payment.</p>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="col-md-4 side_bar">
                   <section class="form-section-modal">
                  <div class="container">
                     <div class="row heading">
                        <div class="col-md-12">
                           <h2 class="your-main-heading">Your booking details</h2>
                        </div>
                     </div>
					 
						@if(isset($cart))
                              
                                @if($cart["category"] == "4")
									
                                
									<div class="row">
										<div class="col-md-12">
										   <h4 class="check-in">Visit Time</h4>
										   <h3 class="check-dates"><?php $mygustspassdate = date_create($cart['date']);  ?>{{ date_format($mygustspassdate,"D, M d, Y ") }}</h3>
										   
										   <ul>
										   
										   @foreach($categoryitem->getGuestPassprogramDetails as $key=>$getGuestPassDetail)

                                            <li>
												
												<h6 class="time-check">{{date("g:iA", strtotime($getGuestPassDetail->GuestProDetailTime))}}</h6>

                                                <span class="updated_to_be">{{$getGuestPassDetail->GuestProDetailDis}}</span>

                                            </li>

                                            @endforeach
										   
										   </ul>
										</div>
									</div>
									<div class="row">
										<div class="col">
										   <h4 class="length-stay">Total length of stay:</h4>
										   <h3 class="week-stay">Less Than 1 day</h3>
										</div>
									 </div>
					 
								@elseif($cart["category"] == "1")
									 
									 <div class="row">
										<?php 
										
											$myhotelcheckindate = date_create($categoryitem->package_available_from);

											$myhotelcheckoutdate = date_create($categoryitem->package_available_to); 
											
											$startTimeStamp = strtotime($categoryitem->package_available_from);
											$endTimeStamp = strtotime($categoryitem->package_available_to);

											$timeDiff = abs($endTimeStamp - $startTimeStamp);

											$numberDays = $timeDiff/86400;  // 86400 seconds in one day

											// and you might want to convert to integer
											$numberDays = intval($numberDays);


										?>
											<div class="col-md-6">
											   <h4 class="check-in">Check-in</h4>
											   <h3 class="check-dates">{{ date_format($myhotelcheckindate,"D, M d, Y ") }}</h3>
											   <h6 class="time-check">00:00</h6>
											</div>
											<div class="col-md-6">
											   <h4 class="check-in">Check-out</h4>
											   <h3 class="check-dates">{{ date_format($myhotelcheckoutdate,"D, M d, Y ") }}</h3>
											   <h6 class="time-check">24:00</h6>
											</div>
										</div>
									 <div class="row">
										<div class="col">
										   <h4 class="length-stay">Total length of stay:</h4>
										   <h3 class="week-stay">{{$numberDays}} Days</h3>
										</div>
									 </div>
                                @elseif($cart["category"] == "2")
									
									
										<div class="row">
										<?php 
										
											$Bookdates = explode('-',$cart['date']);
											
											$myhotelcheckindate = date_create($Bookdates[0]);

											$myhotelcheckoutdate = date_create($Bookdates[1]); 
											
											$startTimeStamp = strtotime($Bookdates[0]);
											$endTimeStamp = strtotime($Bookdates[1]);

											$timeDiff = abs($endTimeStamp - $startTimeStamp);

											$numberDays = $timeDiff/86400;  // 86400 seconds in one day

											// and you might want to convert to integer
											$numberDays = intval($numberDays);


										?>
											<div class="col-md-6">
											   <h4 class="check-in">Check-in</h4>
											   <h3 class="check-dates">{{ date_format($myhotelcheckindate,"D, M d, Y ") }}</h3>
											   <h6 class="time-check">00:00</h6>
											</div>
											<div class="col-md-6">
											   <h4 class="check-in">Check-out</h4>
											   <h3 class="check-dates">{{ date_format($myhotelcheckoutdate,"D, M d, Y ") }}</h3>
											   <h6 class="time-check">24:00</h6>
											</div>
										</div>
									 <div class="row">
										<div class="col">
										   <h4 class="length-stay">Total length of stay:</h4>
										   <h3 class="week-stay">{{$numberDays}} Days</h3>
										</div>
									 </div>
                                @elseif($cart["category"] == "3")
									
									
									<div class="row">
										<div class="col-md-6">
										   <h4 class="check-in">Check-in</h4>
										   <h3 class="check-dates">Fri, Jun 25, 2021</h3>
										   <h6 class="time-check">2:00 PM - 12:00 AM</h6>
										</div>
										<div class="col-md-6">
										   <h4 class="check-in">Check-out</h4>
										   <h3 class="check-dates">Fri, July 2, 2021</h3>
										   <h6 class="time-check">7:00 PM - 12:00 AM</h6>
										</div>
									 </div>
									 <div class="row">
										<div class="col">
										   <h4 class="length-stay">Total length of stay:</h4>
										   <h3 class="week-stay">1 Week</h3>
										</div>
									 </div>
                                @elseif($cart["category"] == "5")
									
									
									<div class="row">
									
										<?php 
										
											$myguidecheckindate = date_create($categoryitem->guide_startdate);

											$myguidecheckoutdate = date_create($categoryitem->guide_enddate); 
											
											$startTimeStamp = strtotime($categoryitem->guide_startdate);
											$endTimeStamp = strtotime($categoryitem->guide_enddate);

											$timeDiff = abs($endTimeStamp - $startTimeStamp);

											$numberDays = $timeDiff/86400;  // 86400 seconds in one day

											// and you might want to convert to integer
											$numberDays = intval($numberDays);


										?>
										
										
										<div class="col-md-6">
										   <h4 class="check-in">Check-in</h4>
										   <h3 class="check-dates">{{ date_format($myguidecheckindate,"D, M d, Y ") }}</h3>
										   <h6 class="time-check">00:00</h6>
										</div>
										<div class="col-md-6">
										   <h4 class="check-in">Check-out</h4>
										   <h3 class="check-dates">{{ date_format($myguidecheckoutdate,"D, M d, Y ") }}</h3>
										   <h6 class="time-check">24:00</h6>
										</div>
									 </div>
									 <div class="row">
										<div class="col">
										   <h4 class="length-stay">Total length of stay:</h4>
										   <h3 class="week-stay">{{$numberDays}} Days</h3>
										</div>
									 </div>
								@else
									
									<div class="row">
										<div class="col-md-6">
										   <h4 class="check-in">Check-in</h4>
										   <h3 class="check-dates">Fri, Jun 25, 2021</h3>
										   <h6 class="time-check">2:00 PM - 12:00 AM</h6>
										</div>
										<div class="col-md-6">
										   <h4 class="check-in">Check-out</h4>
										   <h3 class="check-dates">Fri, July 2, 2021</h3>
										   <h6 class="time-check">7:00 PM - 12:00 AM</h6>
										</div>
									 </div>
									 <div class="row">
										<div class="col">
										   <h4 class="length-stay">Total length of stay:</h4>
										   <h3 class="week-stay">1 Week</h3>
										</div>
									 </div>
									 
                                @endif
						@endif
                     <?php $total = 0; ?> 
                     <div class="row">
                        <div class="col">
                           <h2 class="selected-text">You selected:</h2>
                           
                           @if(isset($cart))
                              
                                @if($cart["category"] == "4")
									<p class="room">Guest Passes</p>
										
										<tr>
											<td data-th="Price">Name = {{$cart['title']}},</td>
											<td data-th="Price">Quantity = {{$cart['quantity']}},</td>
											<td data-th="Price">Date = {{$cart['date']}}</td>
											<td data-th="Price"><p>Price = ${{$cart['quantity'] * $cart['price']}}
											   <?php $total += $cart['quantity'] * $cart['price']; ?>
											</p></td>
										</tr>
									
                                @elseif($cart["category"] == "1")
									<p class="room">Package Deal</p>
									
										<tr>
											<td data-th="Price">Name = {{$cart['title']}},</td>
											<td data-th="Price">Quantity = {{$cart['quantity']}},</td>
											<td data-th="Price">Date = {{$cart['date']}}</td>
											<td data-th="Price"><p>Price = ${{$cart['quantity'] * $cart['price']}}
											   <?php $total += $cart['quantity'] * $cart['price']; ?>
											</p></td>
										</tr>
                                @elseif($cart["category"] == "2")
									<p class="room">Hotel</p>
									
										<tr>
											<td data-th="Price">Name = {{$cart['title']}},</td>
											<td data-th="Price">Quantity = {{$cart['quantity']}},</td>
											<td data-th="Price">Date = {{$cart['date']}}</td>
											<td data-th="Price"><p>Price = ${{$cart['price']}}
											   <?php $total += $cart['price']; ?>
											</p>
											</td>
										</tr>
										
                                @elseif($cart["category"] == "3")
									<p class="room">Transport</p>
									
										<tr>
											<td data-th="Price">Name = {{$cart['title']}},</td>
											<td data-th="Price">Quantity = {{$cart['quantity']}},</td>
											<td data-th="Price">Date = {{$cart['date']}}</td>
											<td data-th="Price"><p>Price = ${{$cart['quantity'] * $cart['price']}}
											   <?php $total += $cart['quantity'] * $cart['price']; ?>
											</p>
											</td>
										</tr>
										
                                @elseif($cart["category"] == "5")
									<p class="room">Guide</p>
									
										<tr>
											<td data-th="Price">Name = {{$cart['title']}},</td>
											<td data-th="Price">Quantity = {{$cart['quantity']}},</td>
											<td data-th="Price">Date = {{$cart['date']}}</td>
											<td data-th="Price"><p>Price = ${{$cart['quantity'] * $cart['price']}}
											   <?php $total += $cart['quantity'] * $cart['price']; ?>
											</p>
											</td>
										</tr>
                                @endif
                                    
                           @endif
                           <a href="{{ url()->previous() }}" class="change-selection">Change your selection</a>
                        </div>
                     </div>
                     <div class="row summary-sec">
                        <div class="col-md-12">
                           <h2 class="your-main-heading">Your Price Summary</h2>
                        </div>
                        @if(isset($cart))
                              <div class="col-md-6" id="totalsummaryheading">
                                 
                                 
                                 @if($cart["category"] == "4")
                                       <p class="room">Guest Passes</p>
                                       <p class="room">10 % tax</p>
                                 @elseif($cart["category"] == "1")
                                       <p class="room">Package Deal</p>
                                       <p class="room">10 % tax</p>
                                 @elseif($cart["category"] == "2")
                                       <p class="room">Hotel</p>
                                       <p class="room">10 % tax</p>
                                 @elseif($cart["category"] == "3")
                                       <p class="room">Transport</p>
                                       <p class="room">10 % tax</p>
                                 @elseif($cart["category"] == "5")
                                       <p class="room">Guide</p>
                                       <p class="room">10 % tax</p>
                                 @endif
                              </div>
                              <div class="col-md-6" id="totalsummaryamount">
                                 <p class="room">$ {{$total}}</p>
                                 <p class="room">$ 0</p>
                              </div>
                           
                        @endif
                     </div>
                     <div class="row price-bg-color">
                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-6">
                                 <h2 class="your-main-heading">Total Price</h2>
                                 <!--<p class="currency-text">(Your currency)</p>-->
                              </div>
                              <div class="col-md-6">
                                 <h2 class="your-main-heading" id="finaltotalheading">$ {{$total}} *</h2>
                              </div>
                           </div>
                           <!--   <div class="row">-->
                           <!--   <div class="col-md-6">-->
                           <!--   <h4 class="property-txt">Property's Currency</h4>-->
                           <!--   <p class="currency-text">in US$</p>-->
                           <!--   <p class="currency-text">(for 1 week & all guests)</p>-->
                           <!--</div>-->
                           <!--<div class="col-md-6">-->
                           <!--  <h4 class="property-txt">$885.50</h4>-->
                           <!--</div>-->
                           <!--</div>-->
                        </div>
                     </div>
                     <!--<p class="view-para">* This price is converted to show you the approximate cost in Rs. You'll pay in <strong>$</strong>. The exchange rate might change before you pay.</p>-->
                     <!--<p class="view-para">Keep in mind that your card issuer may charge you a foreign transaction fee.</p>-->
                     <input type="hidden" id="finaltotalamount" value="{{$total}}" />
                     <input type="hidden" id="subtractdonationamount" value="" />
               </section>
               </div>
            </div>
         </div>
      </div>
   </section>
               </div>
            </div>
         </div>
      </div>
      </div>
      </div>
   </section>

      
   
   <!-- modal-section -->
   <!-- large modal -->
   <!--<section class="modal-two">-->
   <!--   <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">-->
   <!--   <div class="modal-dialog modal-lg">-->
   <!--      <div class="modal-content">-->
   <!--         <div class="modal-header">-->
   <!--            <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
   <!--            <span aria-hidden="true">&times;</span>-->
   <!--            </button>-->
   <!--         </div>-->
   <!--         <div class="modal-body">-->
   <!--            <section class="form-section-modal">-->
   <!--               <div class="container">-->
   <!--                  <div class="row heading">-->
   <!--                     <div class="col-md-12">-->
   <!--                        <h2 class="your-main-heading">Your booking details</h2>-->
   <!--                     </div>-->
   <!--                  </div>-->
   <!--                  <div class="row">-->
   <!--                     <div class="col-md-6">-->
   <!--                        <h4 class="check-in">Check-in</h4>-->
   <!--                        <h3 class="check-dates">Fri, Jun 25, 2021</h3>-->
   <!--                        <h6 class="time-check">2:00 PM - 12:00 AM</h6>-->
   <!--                     </div>-->
   <!--                     <div class="col-md-6">-->
   <!--                        <h4 class="check-in">Check-out</h4>-->
   <!--                        <h3 class="check-dates">Fri, July 2, 2021</h3>-->
   <!--                        <h6 class="time-check">7:00 PM - 12:00 AM</h6>-->
   <!--                     </div>-->
   <!--                  </div>-->
   <!--                  <div class="row">-->
   <!--                     <div class="col">-->
   <!--                        <h4 class="length-stay">Total lenght of stay:</h4>-->
   <!--                        <h3 class="week-stay">1 Week</h3>-->
   <!--                     </div>-->
   <!--                  </div>-->
   <!--                  <div class="row">-->
   <!--                     <div class="col">-->
   <!--                        <h2 class="selected-text">You selected:</h2>-->
   <!--                        <p class="room">Double Room</p>-->
   <!--                        <a href="#!" class="change-selection">Change your selection</a>-->
   <!--                     </div>-->
   <!--                  </div>-->
   <!--                  <div class="row summary-sec">-->
   <!--                     <div class="col-md-12">-->
   <!--                        <h2 class="your-main-heading">Your Price Summary</h2>-->
   <!--                     </div>-->
   <!--                     <div class="col-md-6">-->
   <!--                        <p class="room">Double Room</p>-->
   <!--                        <p class="room">10 % City tax</p>-->
   <!--                     </div>-->
   <!--                     <div class="col-md-6">-->
   <!--                        <p class="room">$ 59,795.39</p>-->
   <!--                        <p class="room">5,979.54</p>-->
   <!--                     </div>-->
   <!--                  </div>-->
   <!--                  <div class="row price-bg-color">-->
   <!--                     <div class="col-md-12">-->
   <!--                        <div class="row">-->
   <!--                           <div class="col-md-6">-->
   <!--                              <h2 class="your-main-heading">Total Price</h2>-->
                                 <!--<p class="currency-text">(Your currency)</p>-->
   <!--                           </div>-->
   <!--                           <div class="col-md-6">-->
   <!--                              <h2 class="your-main-heading">$ 65,774.93 *</h2>-->
   <!--                           </div>-->
   <!--                        </div>-->
                           <!--   <div class="row">-->
                           <!--   <div class="col-md-6">-->
                           <!--   <h4 class="property-txt">Property's Currency</h4>-->
                           <!--   <p class="currency-text">in US$</p>-->
                           <!--   <p class="currency-text">(for 1 week & all guests)</p>-->
                           <!--</div>-->
                           <!--<div class="col-md-6">-->
                           <!--  <h4 class="property-txt">$885.50</h4>-->
                           <!--</div>-->
                           <!--</div>-->
   <!--                     </div>-->
   <!--                  </div>-->
                     <!--<p class="view-para">* This price is converted to show you the approximate cost in Rs. You'll pay in <strong>$</strong>. The exchange rate might change before you pay.</p>-->
                     <!--<p class="view-para">Keep in mind that your card issuer may charge you a foreign transaction fee.</p>-->
   <!--            </section>-->
   <!--            </div>-->
   <!--         </div>-->
   <!--      </div>-->
   <!--   </div>-->
   <!--</section>-->

<script>

   function insurance(){

    $radiovalue =  $("input[name='Insurance']:checked").val();

      if($radiovalue == 1){

         var finaltotalamount = $('#finaltotalamount').val();

         insuranceintotal = parseInt(finaltotalamount) + 10 ;

         $('#finaltotalamount').val(insuranceintotal);

         $('#formtotalamount').val(insuranceintotal);

         finaltotalamountheading = '$'+ insuranceintotal + ' *';

         $('#finaltotalheading').empty();

         insuranceheading = '<p class="room" id="insuranceheading">Insurance</p>';

         insuranceamount = '<p class="room" id="insuranceamount">$ 10</p>';

         var addfield = $('#finaltotalheading').append(finaltotalamountheading);

         var addsummaryinshed = $('#totalsummaryheading').append(insuranceheading);

         var addsummaryinsamt = $('#totalsummaryamount').append(insuranceamount);

         
      }else if($radiovalue == 0){

         var finaltotalamount = $('#finaltotalamount').val();

         insuranceintotal = parseInt(finaltotalamount) - 10 ;

         $('#finaltotalamount').val(insuranceintotal);

         $('#formtotalamount').val(insuranceintotal);

         finaltotalamountheading = '$'+ insuranceintotal + ' *';

         $('#finaltotalheading').empty();

         var addsummaryinshed = $('#insuranceheading').remove();

         var addsummaryinsamt = $('#insuranceamount').remove();

         var addfield = $('#finaltotalheading').append(finaltotalamountheading);
         
      }else{

      }

   }

   $( document ).ready(function(){

      var finaltotalamount = $('#finaltotalamount').val();

      $('#formtotalamount').val(finaltotalamount);


   });

   function mydonation(){

      $radiovalue =  $("input[name='donation']:checked").val();

      if($radiovalue == 1){

         var finaltotalamount = $('#finaltotalamount').val();

         var mydonationamount = $('#donationamountform').val();

         donationintotal = parseInt(finaltotalamount) + parseInt(mydonationamount) ;

         $('#finaltotalamount').val(donationintotal);

         $('#subtractdonationamount').val(parseInt(mydonationamount));

         $('#formtotaldonation').val(parseInt(mydonationamount));

         $('#formtotalamount').val(donationintotal);

         finaltotalamountheading = '$'+ donationintotal + ' *';

         $('#finaltotalheading').empty();

         donationheading = '<p class="room" id="donationheading">Donation</p>';

         donationamount = '<p class="room" id="donationamount">$ '+ mydonationamount +'</p>';

         var addfield = $('#finaltotalheading').append(finaltotalamountheading);


         var addsummaryinshed = $('#totalsummaryheading').append(donationheading);

         var addsummaryinsamt = $('#totalsummaryamount').append(donationamount);

         
      }else if($radiovalue == 0){

         var finaltotalamount = $('#finaltotalamount').val();

         var mydonationamount = $('#subtractdonationamount').val();

         $('#formtotaldonation').val(0);

         donationintotal = parseInt(finaltotalamount) - parseInt(mydonationamount) ;

         $('#formtotalamount').val(donationintotal);

         $('#finaltotalamount').val(donationintotal);

         finaltotalamountheading = '$'+ donationintotal + ' *';

         $('#finaltotalheading').empty();

         var addsummaryinshed = $('#donationheading').remove();

         var addsummaryinsamt = $('#donationamount').remove();

         var addfield = $('#finaltotalheading').append(finaltotalamountheading);
         
      }else{

      }

   }   

</script>

@endsection