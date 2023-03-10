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
                              <li class="breadcrumb-item"><a href="#">Package Deals</a></li>
                              <li class="breadcrumb-item"><a href="#">Premium Package</a></li>
                              <!--  <li class="breadcrumb-item"><a href="#">Buss</a></li>-->
                              <!--<li class="breadcrumb-item active" aria-current="page">Name of Vehicle / Plate#</li>-->
                           </ol>
                        </nav>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4">
                        <img src="./img/hotel-img.png" class="img-fluid" alt="">
                     </div>
                     <div class="col-md-8">
                        <div class="sect-one-txt">
                           <h5 class="title-hotel">Hotel<span><i class="fas fa-thumbs-up"></i></span></h5>
                           <h1 class="main-heading">Qasr AlDur Hotel</h1>
                           <p class="address-najaf">Zain Al Abdeen street, Najaf 5400, 54001 An Najaf, Iraq</p>
                           <p class="guest-rating">This Property has an excellent location. Guests have rated it 9.7!</p>
                           <div class="reviews">
                              <h4 class="rating-num">8.3</h4>
                              <h4 class="rating-text">Very Good</h4>
                              <p class="reviews-para">89 reviews</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="section-2">
                     <h2 class="person-booking">Who is booking?</h2>
                     <form>
                        <div class="form-row for-user-icon">
                           <div class="form-group col-md-8">
                              <label for="inputEmail4">Name <span>*</span></label>
                              <i class="fas fa-user"></i>
                              <input type="text" class="form-control" id="inputEmail4" placeholder="First and Last Name">
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="col-md-12">
                              <label for="">Country/Territory Code <span>*</span> </label>
                           </div>
                           <div class="btn-group">
                              <button type="button" class="btn  dropdown-toggle country-drop territory-code" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                              United States of America +1
                              </button>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                                 <button class="dropdown-item" type="button">Qatar</button>
                                 <button class="dropdown-item" type="button">Pakistan</button>
                                 <button class="dropdown-item" type="button">Saudi</button>
                              </div>
                           </div>
                        </div>
                        <div class="form-row for-user-icon">
                           <div class="form-group col-md-8">
                              <label for="inputEmail4">Phone number <span>*</span></label>
                              <i class="fas fa-phone-alt"></i>
                              <input type="text" class="form-control" id="inputEmail4" placeholder="In case we need to reach you">
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
                              <input type="email" class="form-control" id="inputEmail4" placeholder="Enter you email address">
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
                              <input type="text" class="form-control" id="inputEmail4" placeholder="6 - 30 characters,  no spaces">
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="form-group col-md-8">
                              <label for="inputEmail4">Confirm password</label>
                              <input type="text" class="form-control" id="inputEmail4">
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="col-md-12 more">
                              <h3 class="more-text">More...</h3>
                              <p class="more-para">Select Yes or No continue booking <span>*</span></p>
                           </div>
                        </div>
                        <div class="row more-section">
                           <div class="col-md-10">
                              <div class="Yes-more-section">
                                 <h4>Insurance</h4>
                                 <input type="radio" id="html" name="fav_language" value="HTML"><label for="html">Yes, I need medical insurance</label><br>
                                 <li> <i class="fas fa-check"></i>The healthcare system is extensive and will support you in the event of illness.</span></li>
                                 <li><i class="fas fa-check"></i><span>Everyone who plan to visit ziyara will be assured that they are insured in the event of illness.</span></li>
                                 <li><i class="fas fa-check"></i><span>Never compromise on your health.</span></span></li>
                                 <li><i class="fas fa-check"></i>Covers your rental car from <span>thef, Vandalism</span> and <span>collion damage</span></li>
                                 <li><i class="fas fa-check"></i>Covers your rental car from <span>thef, Vandalism</span> and <span>collion damage</span></li>
                                 <a href="#!">View insurence details and disclosure</a>
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
                              <input type="radio" id="html" name="fav_language" value="HTML"><label for="html">No, I am willing to take the risk</label><br>
                           </div>
                        </div>
                        <div class="row more-section donation">
                           <div class="col-md-10">
                              <h4>Donation</h4>
                              <div class="Yes-more-section">
                                 <div class="form-inline">
                                    <input type="radio" id="html" name="fav_language" value="HTML">
                                    <label for="html">Yes, I would like to donate to</label>
                                    <select class="form-control" name="owner_dm">
                                       <option value="1">Mecca</option>
                                       <option value="1">Medina</option>
                                       <option value="1">Karbala</option>
                                       <option value="1">Najaf</option>
                                       <option value="1">Baghdad</option>
                                       <option value="1">Kadhmain</option>
                                       <option value="1">Samarrah</option>
                                    </select>
                                    <label for="html">with this reservation.</label>
                                 </div>
                                 Yes, I would like to donate to (Drop Down of Shrines Names) with this reservation.</label>
                                 <li> <i class="fas fa-check"></i>The healthcare system is extensive and will support you in the event of illness.</span></li>
                                 <li><i class="fas fa-check"></i><span>Everyone who plan to visit ziyara will be assured that they are insured in the event of illness.</span></li>
                                 <li><i class="fas fa-check"></i><span>Never compromise on your health.</span></span></li>
                                 <li><i class="fas fa-check"></i>Covers your rental car from <span>thef, Vandalism</span> and <span>collion damage</span></li>
                                 <li><i class="fas fa-check"></i>Covers your rental car from <span>thef, Vandalism</span> and <span>collion damage</span></li>
                                 <a href="#!">View insurence details and disclosure</a>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="calendar-day">
                                 <h4>$10.00</h4>
                                 <div class="amount_donation">
                                    <span>$</span>
                                    <input type="text" id="" placeholder="Amount"/>    
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="col-md-12 No">
                              <input type="radio" id="html" name="fav_language" value="HTML"><label for="html">Skip Donation</label><br>
                           </div>
                        </div>
                        <p class="surprise text">"I was surprised how quickly the claim was resolved and with minimal paperwork. And no deductible!!!"</p>
                        <div class="all-visa-nd-anchor">
                           <h3 class="payment">Payment</h3>
                           <br>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="" value="">
                              <label class="form-check-label" for="">Bank Check</label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="" value="">
                              <label class="form-check-label" for="">Cash</label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="" value="">
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
                                 <h5>Please write your reuests in English. <span>(optional)</span></h5>
                                 <textarea name="" id="" cols="90" rows="3"></textarea>
                              </div>
                           </div>
                        </div>
                        <div class="car-info">
                           <h3>Important car information</h3>
                           <p>Midsize SUV (New York, New York) - Thu, Jul 8 - Frti, Jul 9</p>
                           <li>The following rules and restriction are provided by the car rental company</li>
                           <li>The drivers must present a valid <a href="#!">driver's license</a> and credit card in their name upon pick-up. The credit card is required as adeposit when renting any vehicle. The deposit amount is held by car rental company.Please ensure sufficient funds are available on the card</li>
                           <li>By selecting to complete this booking I acknowledge that i have read and accept the <a href="#!">Rules & Restriction</a> <a href="#!">Terms of Use</a>, <a href="#!">Privacy Policy</a> and <a href="#!">Government Travel Advice</a></li>
                        </div>
                        <div class="col-md-6">
                           <a href="#!" class="btn reserve-now" data-toggle="modal" data-target="#largeModal">Book Now > </a>
                           <!-- <button type="button" class="btn reserve-now" >Book Now > </button> -->
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
                           <h4 class="length-stay">Total lenght of stay:</h4>
                           <h3 class="week-stay">1 Week</h3>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col">
                           <h2 class="selected-text">You selected:</h2>
                           
                             @if(isset($cart))
                              @foreach($cart as $key => $cartitems)
                                @if($key == "4")
                                <p class="room">Guest Passes</p>
                                @elseif($key == "1")
                                <p class="room">Package Deal</p>
                                @elseif($key == "2")
                                <p class="room">Hotel</p>
                                @elseif($key == "3")
                                <p class="room">Transport</p>
                                @elseif($key == "5")
                                <p class="room">Guide</p>
                                @endif
                                    @foreach($cartitems as $cartproductdate)
                                       @foreach($cartproductdate as $cartproduct)
                                             <tr>
                                                <td data-th="Price">Name = {{$cartproduct['title']}},</td>
                                                <td data-th="Price">Quantity = {{$cartproduct['quantity']}},</td>
                                                <td data-th="Price">Date = {{$cartproduct['date']}}</td>
                                                <td data-th="Price"><p>Price = ${{$cartproduct['quantity'] * $cartproduct['price']}}
                                                   <?php $total += $cartproduct['quantity'] * $cartproduct['price']; ?>
                                                </p></td>
                                             </tr>
                                       @endforeach
                                    @endforeach
                                 @endforeach
                           @endif
                           
                           <a href="#!" class="change-selection">Change your selection</a>
                        </div>
                     </div>
                     <div class="row summary-sec">
                        <div class="col-md-12">
                           <h2 class="your-main-heading">Your Price Summary</h2>
                        </div>
                        <div class="col-md-6">
                           <p class="room">Double Room</p>
                           <p class="room">10 % City tax</p>
                        </div>
                        <div class="col-md-6">
                           <p class="room">$ 59,795.39</p>
                           <p class="room">5,979.54</p>
                        </div>
                     </div>
                     <div class="row price-bg-color">
                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-6">
                                 <h2 class="your-main-heading">Total Price</h2>
                                 <!--<p class="currency-text">(Your currency)</p>-->
                              </div>
                              <div class="col-md-6">
                                 <h2 class="your-main-heading">$ 65,774.93 *</h2>
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

@endsection