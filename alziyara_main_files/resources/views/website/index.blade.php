@extends('website.layout.master')
<body class="home">
@section('content')
   <section class="sec-1">
      <div class="vidbg-container">
         <video playsinline="" autoplay="" loop="" muted="">
            {{--<source src="https://ziyaratservices.com/src/assets/media/aerial-footage-hazrat-e-abbas.mp4" type="video/mp4">--}}
            <source src="{{ asset('website') }}/videos/aerial-footage-hazrat-e-abbas.mp4" type="video/mp4">
         </video>
         <div class="vidbg-overlay"></div>
      </div>
      <div class="container custom-container">
         <div class="row align-items-center ">
            <div class="col-md-12 col-lg-6 tabs_section" data-aos="fade-right" data-aos-duration="3000">
               <div class="col-md-12 text-center notification_form">
                  <p> Call at +1 (718) 297-6520 ext. 101 OR book online </p>
               </div>
               <ul class="nav nav-tabs nav-pills" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <a class="nav-link active" id="home-tab"  href="#home" data-toggle="tab" role="tab"
                        aria-controls="home" aria-selected="true"><i class="far fa-envelope-open"></i><span>Package Deals</span></a>
                  </li>
                  {{--<li class="nav-item" role="presentation">--}}
                  {{--<a class="nav-link" id="profile-tab" href="{{route('visa')}}"--}}
                  {{--aria-controls="profile" aria-selected="false" target="_blank"><i class="fas fa-ticket-alt"></i><span>Visa</span></a>--}}
                  {{--</li>--}}
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="contact-tab" href="{{route('flight')}}"
                        aria-controls="contact" aria-selected="false" target="_blank"><i class="fas fa-plane-departure"></i><span>Flights</span></a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="transport-tab" href="#transportation" data-toggle="tab" role="tab"
                        aria-controls="transport" aria-selected="false"><i class="fas fa-bus"></i><span>Transport</span></a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="guestspasses-tab" href="#guestspasses" data-toggle="tab" role="tab"
                        aria-controls="guestspasses" aria-selected="false"><i class="fas fa-user"></i><span>Guest Pass</span></a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="hotels-tab" href="#hotels"  data-toggle="tab" role="tab"
                        aria-controls="hotels" aria-selected="false"><i class="fas fa-hotel"></i><span>Hotel</span></a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="guide-tab" href="#guide"  data-toggle="tab" role="tab"
                        aria-controls="guides" aria-selected="false"><i class="fas fa-bus"></i><span>Guide</span></a>
                  </li>
                  {{--<li>--}}
                  {{--<a href="#guestspasses" data-toggle="tab">Background color</a>--}}
                  {{--</li>--}}
               </ul>
               <div class="tab-content" id="myTabContent">

                  <!-------------- PACKAGE DEALS ------------>
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                     <form role="form" id="form_Package_deals" class="margin-bottom-0" action="{{route('search_package_deals')}}"  method="get">
                        <div class="form-row d-flex align-items-end">
                           <div class="form-group col-md-12">
                              <div class="input-group" id="loc-from">
                                 <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                 <select class="form-control" name="owner_dm" value="{{$item->id??''}}" >
                                    {{--<input type="hidden" name="package_type_id" id="package_type_id" value="{{$item->id??''}}" >--}}
                                    @foreach($packageType as $item)
                                       <option value="{{$item->id??''}}" >{{$item->package_deals_type_desc??''}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <!--<div class="form-group col-md-3">-->
                           <!--    <div class="input-group" id="pickup-date">-->
                           <!--    <label for=""><i class="fas fa-calendar-alt"></i></label>-->
                           <!--<select class="form-control" name="owner_dm">-->
                           <!--    <option value="">Pickup Date &amp; Time</option>-->
                           <!--    <option value="1">1</option>-->
                           <!--    </select>-->
                           <!--        <input type="text" name="daterange" value="01/01/2018 - 01/15/2018" class="form-control" />-->
                           <!--    </div>-->
                           <!--</div>-->
                           <div class="form-group col-md-12">
                              <input class="total_guests_package" id="total_guests_package" name="total_guests_package" value="1" readonly hidden>
                              
                                 <div class="form-group">
                                    <div class="input-group" id="one-way">
                                       <div class="dropdown keep-open">
                                          <!-- Dropdown Button -->
                                          <button id="dLabel" role="button" href="#" data-toggle="dropdown" data-target="#" class="btn btn-light w-100 text-left">
                                             <i class="fas fa-bed"></i>
                                             <span class="adults_span_package">1</span> Adults,
                                             <span class="childs_span_package">0</span> Children,
                                             <span class="infants_span_package">0</span> Infants
                                          </button>
                                          <!-- Dropdown Menu -->
                                          <div class="dropdown-menu guests_dropdown" role="menu" aria-labelledby="dLabel">
                                             <div class="row">
                                                <div class="col-lg-3 col-md-12 dropdown_heading">Adults</div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_adults_package">-</span></div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="adults_input_field"><input type="number" class="form-control adults_package" name="adults_package" value="1" readonly min="1"></span></div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_adults_package">+</span></div>
                                             </div>
                                             <div class="row">
                                                <div class="col-lg-3 col-md-12 dropdown_heading">Children</div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_childs_package">-</span></div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field"><input type="number" class="form-control childs_package" name="childs_package" value="0" readonly min="0"></span></div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_childs_package">+</span></div>
                                             </div>
                                             <div class="row">
                                                <div class="col-lg-3 col-md-12 dropdown_heading">Infants</div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_infants_package">-</span></div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field"><input type="number" class="form-control infants_package" name="infants_package" value="0" readonly min="0"></span></div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_infants_package">+</span></div>
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

                           <div class="form-group col-md-2 mt-5">
                              <button class="btn book-now">Search</button>
                           </div>
                        </div>
                     </form>
                  </div>

                  <!------------------- VISA ----------------->

                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                     <form>
                        <div class="form-row">
                           <div class="col-md-12">
                              <select id="inputState" class="form-control">
                                 <option selected>Flight</option>
                                 <option>Boston</option>
                                 <option>Brandon</option>
                                 <option>Calgary</option>
                                 <option>Chicago</option>
                                 <option>Comox</option>
                                 <option>Dawson Creek</option>
                                 <option>Deer Lake</option>
                                 <option>Edmonton</option>
                              </select>
                           </div>

                           <div class="col-md-12">
                              <div class="form-group">
                                 <div class="input-group" id="loc-to">
                                    <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                    <select class="form-control" name="owner_dm">
                                       <option value="">To</option>
                                       <option value="1">Makkah</option>
                                       <option value="1">Madina</option>
                                    </select>
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <!--<input type="date" class="form-control" id="formGroupExampleInput" placeholder="Date">-->
                              <div class="form-group">

                                 <!-- Input field along with
                calendar icon and -->
                                 <div class="input-group date">
                                    <!-- Sets the calendar icon -->
                                    <span class="input-group-prepend">
                                       <span class="input-group-text">
                                          <i class="fa fa-calendar" onclick="setDatepicker(this)">
                                          </i>
                                       </span>
                                    </span>

                                    <!-- Accepts the input from calendar -->
                                    <input class="form-control" type="text" name="dob" id="dob"
                                           placeholder="Depart Date" value="">
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <select id="inputState" class="form-control">
                                 <option selected>7 or 8 days</option>
                                 <option> 7 or 8 days</option>
                                 <option> 8 or 10 days</option>
                                 <option> 10 or 12 days</option>
                                 <option> 12 or 14 days</option>
                                 <option> 14 or 16 days</option>
                                 <option> 16 or 18 days</option>
                              </select>
                           </div>

                           <div class="col-md-6">
                              <select id="inputState" class="form-control">
                                 <option selected>1 Room</option>
                                 <option> 2 Rooms</option>
                                 <option> 3 Rooms</option>
                                 <option> 4 Rooms</option>
                                 <option> 5 Rooms</option>
                                 <option> 6 Rooms</option>
                              </select>
                           </div>

                           <div class="col-md-6">
                              <input type="text" class="form-control" id="formGroupExampleInput" placeholder="2 Guests">
                           </div>

                           <div class="col-md-12 check_row">
                              <input class="form-check-input" type="checkbox" id="gridCheck">
                              <label class="form-check-label" for="gridCheck">
                                 All Inclusive Only
                              </label>
                           </div>

                           <div class="col-md-6 last_form_line">
                              <i class="far fa-calendar-alt"></i>
                              <div class="last_line_text">
                                 <p> Flexible on Dates? </p>
                                 <h4> Best Price Calender </h4>
                              </div>
                           </div>

                           <div class="col-md-6 form_blue_btn">
                              <button type="submit" class="btn btn-primary">Search</button>
                           </div>
                        </div>
                     </form>
                  </div>

                  <!------------------- FLIGHTS ---------------->

                  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                     <form>
                        <div class="form-row">
                           <div class="col-md-12">
                              <input type="text" class="form-control" id="formGroupExampleInput"
                                     placeholder="Leaving From">
                           </div>

                           <div class="col-md-12">
                              <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Going to">
                           </div>

                           <div class="col-md-12">
                              <input type="date" class="form-control" id="formGroupExampleInput" placeholder="Date">
                           </div>

                           <div class="col-md-4">
                              <select id="inputState" class="form-control">
                                 <option selected>1 Adults</option>
                                 <option> 2 Adults</option>
                                 <option> 3 Adults</option>
                                 <option> 4 Adults</option>
                                 <option> 5 Adults</option>
                                 <option> 6 Adults</option>
                                 <option> 7 Adults</option>
                              </select>
                           </div>

                           <div class="col-md-4">
                              <select id="inputState" class="form-control">
                                 <option selected>0 Children</option>
                                 <option> 1 Children</option>
                                 <option> 2 Children</option>
                                 <option> 3 Children</option>
                                 <option> 4 Children</option>
                                 <option> 5 Children</option>
                                 <option> 6 Children</option>
                              </select>
                           </div>

                           <div class="col-md-4">
                              <select id="inputState" class="form-control">
                                 <option selected>Economy</option>
                                 <option> Premium Economy </option>
                                 <option> Buisiness Class</option>
                                 <option> First Class</option>
                              </select>
                           </div>

                           <div class="row check_boxes justify-content-md-center">
                              <div class="col-md-3 check_row check_1">
                                 <input class="form-check-input" type="checkbox" id="gridCheck">
                                 <label class="form-check-label" for="gridCheck">
                                    Direct Flight
                                 </label>
                              </div>

                              <div class="col-md-3 check_row">
                                 <input class="form-check-input" type="checkbox" id="gridCheck">
                                 <label class="form-check-label" for="gridCheck">
                                    Nearby Airports
                                 </label>
                              </div>
                           </div>

                           <div class="col-md-6 last_form_line">
                              <i class="far fa-calendar-alt"></i>
                              <div class="last_line_text">
                                 <p> Flexible on Dates? </p>
                                 <h4> Best Price Calender </h4>
                              </div>
                           </div>

                           <div class="col-md-6 form_blue_btn">
                              <button type="submit" class="btn btn-primary">Search</button>
                           </div>
                        </div>
                     </form>
                  </div>

                  <!--------------------------- TRANSPORT -------------------->


                  <div class="tab-pane fade" id="transportation" role="tabpanel" aria-labelledby="transport-tab">
                     <form role="form" id="form_transport_details" action="{{Route('search-transportation')}}" method="get">
                        <div class="form-row transportation">
                           <div class="col-md-12">
                              <div class="input-group" id="loc-from">
                                 <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                 <select class="form-control" name="route_from" id="route_from" required>
                                    <option value="disable">From</option>
                                    @foreach($transportation_routes_from as $transportation_route_from)
                                       <option value="{{$transportation_route_from->RouteFrom}}"
                                               @if($transportation_route_from->RouteFrom=='Karbala')
                                               selected
                                               @endif>{{$transportation_route_from->RouteFrom}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>

                           <div class="col-md-12">
                              <div class="input-group" id="loc-from">
                                 <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                 <select class="form-control" name="route_to" id="route_to" required disabled="true">
                                    <option value="disable">To</option>
                                    @foreach($transportation_routes_to as $transportation_route_to)
                                       <option value="{{$transportation_route_to->RouteTo}}"
                                               @if($transportation_route_to->RouteTo=='Najaf')
                                               selected
                                               @endif>{{$transportation_route_to->RouteTo}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>

                           <div class="col-md-12">
                              <div class="input-group" id="pickup-date">
                                 {{--<label for=""><i class="fas fa-calendar-alt"></i></label>--}}
                                 <div class="input-group input-daterange">
                                    <input type="date" id="start" class="form-control text-left mr-2" value="{{Date('Y-m-d')}}" min="{{Date('Y-m-d', strtotime('+1 day'))}}">
                                 </div>
                              </div>
                           </div>

                           {{--<div class="col-md-12">--}}
                              {{--<div class="radio_btn">--}}
                                 {{--<label><input type="radio" name="type" value="One Way"> One way</label>--}}
                                 {{--<label><input type="radio" name="type" value="Round Trip" checked="checked"> Round Trip</label>--}}
                              {{--</div>--}}
                           {{--</div>--}}


                           {{--<div class="col-md-12 check_row">--}}
                           {{--<input class="form-check-input" type="checkbox" id="gridCheck">--}}
                           {{--<label class="form-check-label" for="gridCheck">--}}
                           {{--Driver Age 25-69?--}}
                           {{--</label>--}}
                           {{--</div>--}}

                           <div class="col-md-6 last_form_line">
                              <i class="far fa-calendar-alt"></i>
                              <div class="last_line_text">
                                 <p> Flexible on Dates? </p>
                                 <h4> Best Price Calender </h4>
                              </div>
                           </div>

                           <div class="col-md-6 form_blue_btn">
                              <button type="submit" class="btn btn-primary">Search</button>
                           </div>
                        </div>
                     </form>
                  </div>

                  <!------------------ SHRINE GUIDE ----------------->

                  <div class="tab-pane" id="guide"  role="tabpanel" aria-labelledby="transport-tab">
                     {{--<h3>We use css to change the background color of the content to be equal to the tab</h3>--}}
                     <form method="get" action="{{ route('guide') }}">
                        @csrf
                        <div class="form-row">
                           <div class="form-group col-md-12">
                              <div class="input-group" id="pickup-date">
                                 <label for=""><i class="fas fa-calendar-alt"></i></label>
                                  <?php
                                  $tour_start_date=date('m/d/Y');
                                  $tour_end_date=Date('m/d/Y', strtotime('+10 days'));
                                  //                                  $default_checkin=Date('m/d/Y', strtotime('+7 days'));
                                  //                                  $default_checkout=Date('m/d/Y', strtotime('+17 days'));
                                  ?>
                                 <input type="text" name="daterange" min="{{$tour_start_date}}" value="{{$tour_start_date}} - {{$tour_end_date}}" class="form-control" />
                              </div>
                           </div>
                           <div class="form-group col-md-12">
                              <div class="input-group" id="loc-from">
                                 <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                 <select class="form-control" name="city" required>
                                    <option value="" selected disabled>City</option>
                                    {{--@foreach($cityNames as $cityName)--}}
                                    <option value="karbala">{{ucfirst('karbala')}}</option>
                                    <option value="najaf">{{ucfirst('najaf')}}</option>
                                    <option value="kadhmain">{{ucfirst('kadhmain')}}</option>
                                    <option value="baghdad">{{ucfirst('baghdad')}}</option>
                                    <option value="samarrah">{{ucfirst('samarrah')}}</option>
                                    {{--@endforeach--}}
                                 </select>
                              </div>
                           </div>
                           <div class="form-group col-md-12">
                              <div class="input-group" id="loc-from">
                                 <label for=""><i class="fa fa-language"></i></label>
                                 <select class="form-control" name="language" required>
                                    <option value="" selected disabled>Language</option>
                                    {{--@foreach($cityNames as $cityName)--}}
                                    <option value="english">{{ucfirst('english')}}</option>
                                    <option value="arabic">{{ucfirst('arabic')}}</option>
                                    <option value="urdu">{{ucfirst('urdu')}}</option>
                                    <option value="farsi">{{ucfirst('farsi')}}</option>
                                    {{--@endforeach--}}
                                 </select>
                              </div>
                           </div>
                           <input class="total_guests_guide" id="total_guests_guide" name="total_guests_guide" value="2" readonly hidden>
                           <div class="col-md-12">
                              <div class="form-group">
                                 <div class="input-group" id="one-way">
                                    <div class="dropdown keep-open">
                                       <!-- Dropdown Button -->
                                       <button id="dLabel" role="button" href="#" data-toggle="dropdown" data-target="#" class="btn btn-light">
                                          <i class="fas fa-bed"></i>
                                          <span class="adults_span_guide">2</span> Adults,
                                          <span class="childs_span_guide">0</span> Children,
                                          <span class="infants_span_guide">0</span> Infants
                                       </button>
                                       <!-- Dropdown Menu -->
                                       <div class="dropdown-menu guests_dropdown" role="menu" aria-labelledby="dLabel">
                                          <div class="row">
                                             <div class="col-lg-3 col-md-12 dropdown_heading">Adults</div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_adults_guide">-</span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="adults_input_field_guide"><input type="number" class="form-control adults_guide" name="adults_guide" value="2" readonly min="2"></span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_adults_guide">+</span></div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-3 col-md-12 dropdown_heading">Children</div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_childs_guide">-</span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field_guide"><input type="number" class="form-control childs_guide" name="childs_guide" value="0" readonly min="0"></span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_childs_guide">+</span></div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-3 col-md-12 dropdown_heading">Infants</div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_infants_guide">-</span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field_guide"><input type="number" class="form-control infants_guide" name="infants_guide" value="0" readonly min="0"></span></div>
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
                           <div class="col-md-6 last_form_line">
                              <i class="far fa-calendar-alt"></i>
                              <div class="last_line_text">
                                 <p> Flexible on Dates? </p>
                                 <h4> Best Price Calender </h4>
                              </div>
                           </div>
                           <div class="col-md-6 form_blue_btn">
                              <button type="submit" class="btn btn-primary">Search</button>
                           </div>
                        </div>
                     </form>
                  </div>

                  <!------------------ GUEST PASSES ----------------->

                  <div class="tab-pane" id="guestspasses">
                     <form method="get" action="{{ route('searchguestpass') }}">
                        @csrf
                        <div class="form-row">
                           <div class="form-group col-md-12">
                              <div class="input-group" id="loc-from">
                                 <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                 <select class="form-control" name="city" required>
                                    <option value="" selected disabled>City</option>
                                    @foreach($cityNames as $cityName)
                                       <option value="{{$cityName->GuestPassLocation}}">{{$cityName->GuestPassLocation}} </option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <input class="total_guests" id="total_guests" name="total_guests" value="1" readonly hidden>
                           <div class="col-md-12">
                              <div class="form-group">
                                 <div class="input-group" id="one-way">
                                    <div class="dropdown keep-open">
                                       <!-- Dropdown Button -->
                                       <button id="dLabel" role="button" href="#" data-toggle="dropdown" data-target="#" class="btn btn-light">
                                          <i class="fas fa-bed"></i>
                                          <span class="adults_span">1</span> Adults,
                                          <span class="childs_span">0</span> Children,
                                          <span class="infants_span">0</span> Infants
                                       </button>
                                       <!-- Dropdown Menu -->
                                       <div class="dropdown-menu guests_dropdown" role="menu" aria-labelledby="dLabel">
                                          <div class="row">
                                             <div class="col-lg-3 col-md-12 dropdown_heading">Adults</div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_adults">-</span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="adults_input_field"><input type="number" class="form-control adults" name="adults" value="1" readonly min="1"></span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_adults">+</span></div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-3 col-md-12 dropdown_heading">Children</div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_childs">-</span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field"><input type="number" class="form-control childs" name="childs" value="0" readonly min="0"></span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_childs">+</span></div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-3 col-md-12 dropdown_heading">Infants</div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_infants">-</span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field"><input type="number" class="form-control infants" name="infants" value="0" readonly min="0"></span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_infants">+</span></div>
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

                           {{--<div class="col-md-6">--}}
                           {{--<div class="form-group">--}}
                           {{--<!-- Input field along with --}}
                           {{--calendar icon and -->--}}
                           {{--<div class="input-group date">--}}
                           {{--<!-- Sets the calendar icon -->--}}
                           {{--<span class="input-group-prepend">--}}
                           {{--<span class="input-group-text">--}}
                           {{--<i class="fa fa-calendar" onclick="setDatepicker(this)">--}}
                           {{--</i>--}}
                           {{--</span>--}}
                           {{--</span>--}}

                           {{--<!-- Accepts the input from calendar -->--}}
                           {{--<input class="form-control" type="text" name="dob" id="dob"--}}
                           {{--placeholder="Depart Date" value="">--}}
                           {{--</div>--}}
                           {{--</div>--}}
                           {{--</div>--}}

                           {{--<div class="col-md-6">--}}
                           {{--<select id="inputState" class="form-control">--}}
                           {{--<option selected>7 or 8 days</option>--}}
                           {{--<option> 7 or 8 days</option>--}}
                           {{--<option> 8 or 10 days</option>--}}
                           {{--<option> 10 or 12 days</option>--}}
                           {{--<option> 12 or 14 days</option>--}}
                           {{--<option> 14 or 16 days</option>--}}
                           {{--<option> 16 or 18 days</option>--}}
                           {{--</select>--}}
                           {{--</div>--}}

                           {{--<div class="col-md-6">--}}
                           {{--<select id="inputState" class="form-control">--}}
                           {{--<option selected>1 Room</option>--}}
                           {{--<option> 2 Rooms</option>--}}
                           {{--<option> 3 Rooms</option>--}}
                           {{--<option> 4 Rooms</option>--}}
                           {{--<option> 5 Rooms</option>--}}
                           {{--<option> 6 Rooms</option>--}}
                           {{--</select>--}}
                           {{--</div>--}}

                           {{--<div class="col-md-6">--}}
                           {{--<input type="text" class="form-control" id="formGroupExampleInput" placeholder="2 Guests">--}}
                           {{--</div>--}}

                           {{--<div class="col-md-12 check_row">--}}
                           {{--<input class="form-check-input" type="checkbox" id="gridCheck">--}}
                           {{--<label class="form-check-label" for="gridCheck">--}}
                           {{--All Inclusive Only--}}
                           {{--</label>--}}
                           {{--</div>--}}

                           <div class="col-md-6 last_form_line">
                              <i class="far fa-calendar-alt"></i>
                              <div class="last_line_text">
                                 <p> Flexible on Dates? </p>
                                 <h4> Best Price Calender </h4>
                              </div>
                           </div>

                           <div class="col-md-6 form_blue_btn">
                              <button type="submit" class="btn btn-primary">Search</button>
                           </div>
                        </div>
                     </form>
                  </div>

                  <!-------------------------- HOTEL ------------------->

                  <div class="tab-pane fade" id="hotels" role="tabpanel" aria-labelledby="contact-tab">
                     <form method="get" action="{{ route('search-hotels') }}">
                        <div class="form-row">
                           <div class="form-group col-md-12">
                              <div class="input-group" id="loc-from">
                                 <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                 <select class="form-control" name="destination" required>
                                    {{--<option selected disabled>Destination</option>--}}
                                    @foreach($cityNames as $cityName)
                                       <option value="{{$cityName->GuestPassLocation}}" @if( $cityName->GuestPassLocation=='Karbala') selected @endif>{{$cityName->GuestPassLocation}} </option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="form-group col-md-12">
                              <div class="input-group" id="pickup-date">
                                 <label for=""><i class="fas fa-calendar-alt"></i></label>
                                  <?php
                                  //$Today=date('m/d/Y');
                                  $default_checkin=Date('m/d/Y', strtotime('+7 days'));
                                  $default_checkout=Date('m/d/Y', strtotime('+17 days'));
                                  ?>
                                 <input type="text" name="daterange" min="{{$default_checkin}}" value="{{$default_checkin}} - {{$default_checkout}}" class="form-control" />

                              </div>
                           </div>


                           <input class="total_guests_hotels" id="total_guests_hotels" name="total_guests_hotels" value="2" readonly hidden>
                           <div class="col-md-12">
                              <div class="form-group">
                                 <div class="input-group" id="one-way">
                                    <div class="dropdown keep-open">
                                       <!-- Dropdown Button -->
                                       <button id="dLabel" role="button" href="#" data-toggle="dropdown" data-target="#" class="btn btn-light">
                                          <i class="fas fa-bed"></i>
                                          <span class="adults_span_hotels">2</span> Adults,
                                          <span class="childs_span_hotels">0</span> Children,
                                          <span class="infants_span_hotels">0</span> Infants
                                       </button>
                                       <!-- Dropdown Menu -->
                                       <div class="dropdown-menu guests_dropdown" role="menu" aria-labelledby="dLabel">
                                          <div class="row">
                                             <div class="col-lg-3 col-md-12 dropdown_heading">Adults</div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_adults_hotels">-</span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="adults_input_field_hotels"><input type="number" class="form-control adults_hotels" name="adults_hotels" value="2" readonly min="2"></span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_adults_hotels">+</span></div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-3 col-md-12 dropdown_heading">Children</div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_childs_hotels">-</span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field_hotels"><input type="number" class="form-control childs_hotels" name="childs_hotels" value="0" readonly min="0"></span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_childs_hotels">+</span></div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-3 col-md-12 dropdown_heading">Infants</div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_infants_hotels">-</span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field_hotels"><input type="number" class="form-control infants_hotels" name="infants_hotels" value="0" readonly min="0"></span></div>
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
                           <div class="col-md-6 last_form_line">
                              <i class="far fa-calendar-alt"></i>
                              <div class="last_line_text">
                                 <p> Flexible on Dates? </p>
                                 <h4> Best Price Calender </h4>
                              </div>
                           </div>
                           <div class="col-md-6 form_blue_btn">
                              <button type="submit" class="btn btn-primary">Search</button>
                           </div>
                        </div>
                     </form>
                  </div>

                  <!------------------ GUIDE ----------------->

                  <div class="tab-pane" id="guestspasses">
                     <form method="get" action="{{ route('searchguestpass') }}">
                        @csrf
                        <div class="form-row">
                           <div class="form-group col-md-12">
                              <div class="input-group" id="loc-from">
                                 <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                 <select class="form-control" name="city" required>
                                    <option value="" selected disabled>City</option>
                                    @foreach($cityNames as $cityName)
                                       <option value="{{$cityName->GuestPassLocation}}">{{$cityName->GuestPassLocation}} </option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <input class="total_guests_guide" id="total_guests_guide" name="total_guests_guide" value="2" readonly hidden>
                           <div class="col-md-12">
                              <div class="form-group">
                                 <div class="input-group" id="one-way">
                                    <div class="dropdown keep-open">
                                       <!-- Dropdown Button -->
                                       <button id="dLabel" role="button" href="#" data-toggle="dropdown" data-target="#" class="btn btn-light">
                                          <i class="fas fa-bed"></i>
                                          <span class="adults_span_guide">2</span> Adults,
                                          <span class="childs_span_guide">0</span> Children,
                                          <span class="infants_span_guide">0</span> Infants
                                       </button>
                                       <!-- Dropdown Menu -->
                                       <div class="dropdown-menu guests_dropdown" role="menu" aria-labelledby="dLabel">
                                          <div class="row">
                                             <div class="col-lg-3 col-md-12 dropdown_heading">Adults</div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_adults_guide">-</span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="adults_input_field_guide"><input type="number" class="form-control adults_guide" name="adults_guide" value="2" readonly min="2"></span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_adults_guide">+</span></div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-3 col-md-12 dropdown_heading">Children</div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_childs_guide">-</span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field_guide"><input type="number" class="form-control childs_guide" name="childs_guide" value="0" readonly min="0"></span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_childs_guide">+</span></div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-3 col-md-12 dropdown_heading">Infants</div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_infants_guide">-</span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field_guide"><input type="number" class="form-control infants_guide" name="infants_guide" value="0" readonly min="0"></span></div>
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
                           <div class="col-md-6 last_form_line">
                              <i class="far fa-calendar-alt"></i>
                              <div class="last_line_text">
                                 <p> Flexible on Dates? </p>
                                 <h4> Best Price Calender </h4>
                              </div>
                           </div>
                           <div class="col-md-6 form_blue_btn">
                              <button type="submit" class="btn btn-primary">Search</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>

            </div>
            <div class="col-md-12 col-lg-6 banner_text" data-aos="fade-left" data-aos-duration="3000">
               <h2>{!! ($pages->where('slug','alzuwar')->first()->title??'Not Available') !!}
               </h2>
               {!! ($pages->where('slug','alzuwar')->first()->description??'Not Available') !!}
               <a href="{{route('aboutus')}}">Discover More &nbsp;<i class="fas fa-arrow-right"></i></a>
            </div>
         </div>
         {{--<audio controls autoplay id="bgAudio">--}}
         {{--<source src="{{ asset('website') }}/img/bgMusic.mp3" type="audio/mp3">--}}
         {{--</audio>--}}
      </div>
   </section>


   <!-- -------------- HOVER SECTION STARTS  ----------------->

   <section class="sec-2">
      <div class="container">
         <div class="row">
            <div class="col-lg-4 col-md-4" data-aos="fade-right" data-aos-duration="2000">
               <div class="media">
                  <div class="browse_travel">
                     <img src="{{ asset('website') }}/img/browsing.png" alt="">
                  </div>
                  <div class="media-body">
                     <h5 class="mt-0">Browse</h5>
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
               </div>

            </div>
            <div class="col-lg-4 col-md-4" data-aos="fade-down" data-aos-duration="2000">
               <div class="media">
                  <div class="browse_travel">
                     <img src="{{ asset('website') }}/img/select1.png" alt="">
                  </div>
                  <div class="media-body">
                     <h5 class="mt-0">Select</h5>
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
               </div>

            </div>
            <div class="col-lg-4 col-md-4" data-aos="fade-left" data-aos-duration="2000">
               <div class="media">
                  <div class="browse_travel">
                     <img src="{{ asset('website') }}/img/passport.png" alt="">
                  </div>
                  <div class="media-body">
                     <h5 class="mt-0">Travel</h5>
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
               </div>

            </div>
         </div>
      </div>
   </section>


   <!----------------- ALZIYARA SECTION ----------------------->


   <section class="sec-3">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-6 Alziyara" data-aos="fade-right" data-aos-duration="3000">
               <h5> About Alziyara </h5>
               <h3>{{($pages->where('slug','indexabout')->first()->title??'Not Available') }}</h3>
               {!!($pages->where('slug','indexabout')->first()->description??'Not Available') !!}
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="3000">
               <img src="{{ asset('website') }}/{{($pages->where('slug','indexabout')->first()->image??'Not Available') }}" alt="Quran" class="img-fluid">
            </div>
         </div>
      </div>
   </section>


   <!------------- UMRAH PACKAGE SECTION STARTS ---------------->
   @if(sizeof($packages)>0)
   <section class="sec-4">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center Umrah-Package" data-aos="zoom-in" data-aos-duration="3000">
               <p class="blue_text"> Experience the variety of </p>
               <h1>{!!($pages->where('slug','ExclusivePackageDeals')->first()->title??'Not Available') !!}</h1>
               {!!($pages->where('slug','ExclusivePackageDeals')->first()->description??'Not Available') !!}
            </div>
         </div>

         <div class="row">
            <div class="col-lg-12">
               <div class="main-swiper">
                  <div class="swiper-container mySwiper">
                     <div class="swiper-wrapper">
                        @foreach($packages as $package)
                        <div class="swiper-slide" data-aos="fade-right" data-aos-duration="2000">
                              <div class="package_view_detail">
                                 <div class="card">
                                    <i class="far fa-heart heart" PropertyID="{{$package->id}}" CategoryID="1" attr="@if($package->getUserFavoriteProperties!=null){{'heart_checked'}}@else{{'heart_unchecked'}}@endif" style="@if($package->getUserFavoriteProperties!=null){{'background:red'}} @else{{'background:grey'}}@endif" value="abc" id="heart"></i>
                                    <a href="{{route('packagedetail')}}/{{$package->id??''}}/{{$package->package_deals_name??''}}">
                                       @if($package->getPackageDealsDefaultPhoto != null)
                                          <img class="card-img-top" src="{{asset('website/' . $package->getPackageDealsDefaultPhoto->PhotoLocation??'Not Available')}}" alt="Card image cap" width="350px">
                                       @else
                                          <img src='{{asset('website/img/karbala.png')}}' width="350px">
                                       @endif
                              <div class="card-body">
                                 <div class="card_body_content">
                                             <p class="three_star"><i class="fas fa-map-marker-alt"></i>{{$package->package_deals_location??''}} </p>
                                             <h3 class="card-title" title="{{$package->package_deals_name??''}}"> {{$package->package_deals_name??''}}</h3>
                                             <ul class="list-unstyled">
                                                <li class="date"><i class="far fa-calendar-plus"></i> {{$package->package_available_from??''}} to {{$package->package_available_to??''}}</li>
                                                <li class="stay"><i class="fas fa-bed"></i> {{$package->accomodation??''}}</li>
                                                <li class="house"><i class="fas fa-utensils"></i>{{$package->meal??''}}</li>
                                                <li class="airfare"><i class="fas fa-bus"></i>{{$package->transportation??''}}</li>
                                                <li class="airfare"><i class="fas fa-praying-hands"></i>{{$package->location??''}}</li>
                                                <li class="airfare"><i class="fas fa-suitcase"></i>${{$package->airfare??''}}</li>
                                    </ul>
                                 </div>

                                 <div class="final_price">
                                             <p>
                                                @for( $a=1 ; $a <= round($package->getPackageReviewForView->avg('Rating')) ; $a++ )
                                                   <i class="fas fa-star"></i>
                                                @endfor
                                                @for( $a=1 ; $a <= 5-round($package->getPackageReviewForView->avg('Rating')) ; $a++ )
                                                   <i class="far fa-star"></i>
                                                @endfor
                                             </p>
                                             <p> From <span> ${{$package->price}} </span></p>
                                 </div>
                              </div>
                                    </a>
                           </div>
                        </div>
                                 </div>
                        @endforeach
                     </div>
                  </div>
               </div>
               <div class="swiper-button-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
               <div class="swiper-button-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-12 ball_button text-center">
               <a href="{{route('packages')}}">VIEW ALL PACKAGES &nbsp;<i class="fas fa-arrow-right"></i></a>
            </div>
         </div>
      </div>
   </section>
@endif

   <!------------- GUEST PASS PACKAGE SECTION STARTS ---------------->
@if(sizeof($guestpass)>0)
   <section class="sec-4">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center Umrah-Package" data-aos="zoom-in" data-aos-duration="3000">
               <p class="blue_text"> Experience the variety of </p>
               <h1> {!!($pages->where('slug','GuestProgram')->first()->title??'Not Available') !!}</h1>
                  {!!($pages->where('slug','GuestProgram')->first()->description??'Not Available') !!}
            </div>
         </div>

         <div class="row">
            <div class="col-lg-12">
               <div class="main-swiper">
                  <div class="swiper-container mySwiper">
                     <div class="swiper-wrapper">
                           @foreach($guestpass as $gp)
                        <div class="swiper-slide" data-aos="fade-right" data-aos-duration="2000">
                              {{--@if(ucfirst($gp->GuestPassLocation) == 'Karbala')--}}
                              <div class="guestpass_view_detail">
                                 <i class="far fa-heart heart" PropertyID="{{$gp->GuestPassID}}" CategoryID="4" attr="@if($gp->getUserFavoriteProperties!=null){{'heart_checked'}}@else{{'heart_unchecked'}}@endif" style="@if($gp->getUserFavoriteProperties!=null){{'background:red'}} @else{{'background:grey'}}@endif" value="abc" id="heart"></i>
                                 <a href="{{route('guestsdetails')}}/{{$gp->GuestPassID}}/{{$gp->GuestPassName}}">
                                    <div class="card">
                                       @foreach($gp->getGuestPassDetails as $gp_pics)
                                          @if($gp_pics->DefaultFlag == '1')
                                             <img class="card-img-top" src="{{asset('website').'/'.$gp_pics->PhotoLocation}}" alt="{{$gp->AltText}}">
                                          @endif
                                       @endforeach
                              <div class="card-body">
                                 <div class="card_body_content">
                                             <p class="three_star"><i class="fas fa-map-marker-alt"></i>{{$gp->GuestPassLocation}}</p>
                                             <h3 class="card-title"> {{$gp->GuestPassName}}</h3>
                                 </div>

                                 <div class="final_price">
                                             <p>
                                                @for( $a=1 ; $a <= round($gp->getGuestPassreviewdetails->avg('Rating')) ; $a++ )
                                                   <i class="fas fa-star"></i>
                                                @endfor
                                                @for( $a=1 ; $a <= 5-round($gp->getGuestPassreviewdetails->avg('Rating')) ; $a++ )
                                                   <i class="far fa-star"></i>
                                                @endfor
                                             </p>
                                             <p> From <span>$ {{number_format($gp->Price, 2, '.', '')}} </span></p>
                                 </div>
                              </div>
                           </div>
                                 </a>
                        </div>
                              {{--@endif--}}
                                 </div>
                           @endforeach
                     </div>
                  </div>
               </div>
               <div class="swiper-button-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
               <div class="swiper-button-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-12 ball_button text-center">
               <a href="{{route('guestspasses')}}">VIEW ALL GUEST PASSES &nbsp;<i class="fas fa-arrow-right"></i></a>
            </div>
         </div>
      </div>
   </section>
@endif
   <!--------------- ZIYARAT PACKAGES SECTION STARTS --------------->


   {{--<section class="sec-4 ziyarat_package">--}}
      {{--<div class="container">--}}
         {{--<div class="row">--}}
            {{--<div class="col-lg-12 text-center Umrah-Package" data-aos="zoom-in" data-aos-duration="3000">--}}
               {{--<p class="blue_text"> Experience the variety of </p>--}}
               {{--<h1> Local Guide & Translator </h1>--}}
               {{--<p class="last_text"> Browse and book an affordable local translator/guide for your Ziarah. An experienced guide will assist you personally, show you places and handle all local logistics bookings (itinerary, accommodation, food, transportation) for you.</p>--}}
            {{--</div>--}}
         {{--</div>--}}
         {{--<div class="row">--}}
            {{--<div class="col-lg-12">--}}
               {{--<div class="main-swiper">--}}
                  {{--<div class="swiper-container mySwiper">--}}
                     {{--<div class="swiper-wrapper">--}}
                           {{--@foreach($guides as $guide)--}}
                        {{--<div class="swiper-slide" data-aos="fade-right" data-aos-duration="2000">--}}
                              {{--<div class="guide_view_detail">--}}
                                 {{--<div class="card" style="width: 18re">--}}
                                    {{--<a href="./tansportation-details.php">--}}
                                    {{--<i class="far fa-heart heart" PropertyID="{{$guide->GuidesID}}" CategoryID="5" attr="@if($guide->getUserFavoriteProperties!=null){{'heart_checked'}}@else{{'heart_unchecked'}}@endif" style="@if($guide->getUserFavoriteProperties!=null){{'background:red'}} @else{{'background:grey'}}@endif" value="abc" id="heart"></i>--}}
                                    {{--<a href="{{route('guide-details')}}/{{$guide->GuidesID??''}}/{{$guide->GuidesName??''}}">--}}
                                       {{--@if(isset($guide->getGuideDefaultPic->PhotoLocation))--}}
                                          {{--<img class="card-img-top" src="{{asset('website')}}/{{$guide->getGuideDefaultPic->PhotoLocation}}" alt="{{$guide->getGuideDefaultPic->AltText}}" title="{{$guide->getGuideDefaultPic->PhotoTitle}}">--}}
                                       {{--@else--}}
                                          {{--<img class="card-img-top" src="{{asset('website/img/not_available.png')}}" alt="Not Available" title="Not Available">--}}
                                       {{--@endif--}}
                                    {{--</a>--}}
                                    {{--<div class="card-body">--}}
                                       {{--<div class="card_body_content">--}}
                                          {{--<p class="three_star">--}}
                                             {{--@for( $a=1 ; $a <= round($guide->getGuideReviewAverageForView->avg('averageRating')) ; $a++ )--}}
                                                {{--<i class="fas fa-star"></i>--}}
                                             {{--@endfor--}}
                                             {{--@for( $a=1 ; $a <= 5-round($guide->getGuideReviewAverageForView->avg('averageRating')) ; $a++ )--}}
                                                {{--<i class="far fa-star"></i>--}}
                                             {{--@endfor--}}
                                             {{--@if(count($guide->getGuideReviewForView)>1)--}}
                                                {{--{{ count($guide->getGuideReviewForView) }} reviews--}}
                                             {{--@else--}}
                                                {{--{{ count($guide->getGuideReviewForView) }} review--}}
                                             {{--@endif--}}
                                          {{--</p>--}}
                                          {{--<h3 class="card-title">{{$guide->GuidesName}}</h3>--}}
                                          {{--<ul class="list-unstyled">--}}
                                          {{--<li class="date"><i class="fas fa-bus"></i> Deluxe Bus </li>--}}
                                          {{--<li class="stay"><i class="fas fa-coffee"></i> Tea or Coffee Complimentry </li>--}}
                                          {{--<li class="house"><i class="fas fa-utensils"></i> Lunch Included</li>--}}
                                          {{--<li class="airfare"><i class="fas fa-headphones"></i> Headphones Available </li>--}}
                                          {{--</ul>--}}
                                       {{--</div>--}}
                                       {{--<div class="final_price">--}}
                                          {{--<p class="duration"><i class="fas fa-clock"></i> {{$guide->DaysInTrip??'0'}} Days--}}
                                          {{--</p>--}}
                                          {{--<p> From <span> ${{number_format($guide->PricePerDay, 0, '.', '')}}/day</span></p>--}}
                                       {{--</div>--}}
                                    {{--</div>--}}
                                 {{--</div>--}}
                              {{--</div>--}}
                        {{--</div>--}}
                           {{--@endforeach--}}
                     {{--</div>--}}
                  {{--</div>--}}
               {{--</div>--}}
               {{--<div class="swiper-button-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>--}}
               {{--<div class="swiper-button-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>--}}
            {{--</div>--}}
         {{--</div>--}}

         {{--<div class="row">--}}
            {{--<div class="col-md-12 ball_button text-center">--}}
               {{--<a href="{{route('guide')}}">VIEW ALL GUIDES &nbsp;<i class="fas fa-arrow-right"></i></a>--}}
            {{--</div>--}}
         {{--</div>--}}
      {{--</div>--}}
   {{--</section>--}}


   <!--------------- TRAVEL BEST RELIGIOUS TRIPS SECTION --------------->

   <section class="sec-5 Religious_trips">
      <div class="container">
         <div class="row">
            <div class="col-lg-6 col-xl-6 text-left" data-aos="fade-right" data-aos-duration="2000">
               <h2> {{$tourtrips->title??''}}</h2>
                {!! $tourtrips->description??'' !!}
            </div>

            <div class="col-xl-6 col-lg-6" data-aos="fade-left" data-aos-duration="2000">
               <div class="Ziyarat_tours">
                  <img src="{{ asset('website') }}/{{$tourtrips->image??''}}" alt="Quran" class="img-fluid">
                  <div class="tour_content">
                     <h4>{!! $tourtrips->name??'' !!}</h4>
                     <p>
                        @for( $a=1 ; $a <= round($tourtrips->rating) ; $a++ )
                            <i class="fas fa-star"></i>
                        @endfor
                        @for( $a=1 ; $a <= 5-round($tourtrips->rating) ; $a++ )
                            <i class="far fa-star"></i>
                        @endfor
                     </p>
                  </div>
               </div>
            </div>
         </div>

         <div class="row">
            @foreach($tourtrips_lower as $item)
            <a href="{{$item->links??''}}">
            <div class="col-lg-4 col-xl-4 col-md-4" data-aos="zoom-in-right" data-aos-duration="2000">
               <div class="Ziyarat">
                  <img src="{{ asset('website') }}/{{$item->image??''}}" alt="Quran" class="img-fluid">
                  <div class="tour_content">
                     <h4>{{$item->name??''}}</h4>
                     <p>
                        @for( $a=1 ; $a <= round($item->rating) ; $a++ )
                            <i class="fas fa-star"></i>
                        @endfor
                        @for( $a=1 ; $a <= 5-round($item->rating) ; $a++ )
                            <i class="far fa-star"></i>
                        @endfor
                     </p>
                  </div>
               </div>
            </a>
            </div>
            @endforeach

            <!-- <div class="col-lg-4 col-xl-4 col-md-4" data-aos="zoom-in" data-aos-duration="2000">
               <div class="Ziyarat">
                  <img src="{{ asset('website') }}/img/image3.png" alt="Quran" class="img-fluid">
                  <div class="tour_content">
                     <h4> Iraq Ziyarat & Tours </h4>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
               </div>
            </div>

            <div class="col-lg-4 col-xl-4 col-md-4" data-aos="zoom-in-left" data-aos-duration="2000">
               <div class="Ziyarat">
                  <img src="{{ asset('website') }}/img/image4.png" alt="Quran" class="img-fluid">
                  <div class="tour_content">
                     <h4> Iraq Ziyarat & Tours </h4>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
               </div>
            </div> -->
         </div>
      </div>
   </section>

   <section class="sec_booking">
      <div class="container-fluid">
         <div class="row">
            <!-- <div class="row"> -->
               @foreach($discovers as $item)
               <div class="col-lg-6 col-xl-4 col-md-6 col-sm-12" data-aos="zoom-in" data-aos-duration="2000">
                  <div class="Exclusive_Prices">
                     <img src="{{ asset('website') }}/{{$item->image??''}}" alt="Quran" class="img-fluid">
                     <div class="Discover_Book">
                        <h2>{{$item->title??''}}</h2>
                        <a href="{{$item->link}}"><span>{{$item->title_link??''}}</span><i class="fas fa-arrow-right"></i></a>
                     </div>
                  </div>
               </div>
               @endforeach

               <!-- <div class="col-lg-4 col-xl-4 col-md-4" data-aos="zoom-in" data-aos-duration="2000">
                  <div class="Exclusive_Prices">
                     <img src="{{ asset('website') }}/img/bus.png" alt="Quran" class="img-fluid">
                     <div class="Discover_Book">
                        <h2> Book Transport at Exclusive Prices </h2>
                        <a href="{{route('Transport')}}"><span>DISCOVER TRANSPORTATION</span><i class="fas fa-arrow-right"></i></a>
                     </div>
                  </div>
               </div>

               <div class="col-lg-4 col-xl-4 col-md-4" data-aos="zoom-in" data-aos-duration="2000">
                  <div class="Exclusive_Prices">
                     <img src="{{ asset('website') }}/img/ira.png" alt="Quran" class="img-fluid">
                     <div class="Discover_Book">
                        <h2> Discover Our Tours at Exclusive Prices </h2>
                        <a href="{{route('packages')}}"><span>DISCOVER TOURS</span><i class="fas fa-arrow-right"></i></a>
                     </div>
                  </div>
               </div> -->
            <!-- </div> -->
         </div>
      </div>
   </section>


   <!--------------- PEOPLE SAY ABOUT US ------------------->

   <section class="sec-6 About_Us">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center" data-aos="zoom-in" data-aos-duration="2000">
               <h1> What <span> People Say About Us </span></h1>
               {!!($pages->where('slug','sayaboutus')->first()->description??'Not Available') !!}
            </div>
         </div>

         <div class="row">
            @foreach($testimonials as $item)
            <div class="col-lg-6 col-xl-6 col-md-6" data-aos="fade-right" data-aos-duration="2000">
               <div class="people_comments">
                  {!! $item->description??'' !!}
               </div>

               <div class="picture_review">
                  <img src="{{ asset('website') }}/img/Ellipse 11.png" alt="Quran" class="img-fluid">
                  <div class="name_stars">
                     <p>{{$item->name??''}}</p>
                     <p>
                        @for( $a=1 ; $a <= round($item->rating) ; $a++ )
                            <i class="fas fa-star"></i>
                        @endfor
                        @for( $a=1 ; $a <= 5-round($item->rating) ; $a++ )
                            <i class="far fa-star"></i>
                        @endfor
                     </p>
                  </div>
               </div>
            </div>
            @endforeach
            <!-- <div class="col-lg-6 col-xl-6 col-md-6" data-aos="fade-left" data-aos-duration="2000">
               <div class="people_comments">
                  <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                     Ut enim ad minim veniam, quis nostrud exercitation ullamco </p>
               </div>

               <div class="picture_review">
                  <img src="{{ asset('website') }}/img/Ellipse 11.png" alt="Quran" class="img-fluid">
                  <div class="name_stars">
                     <p> Aslam Abbas </p>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
               </div>
            </div> -->
         </div>
      </div>
   </section>


   <!--------------- LATEST NEWS AND BLOGS ----------------->

   <section class="sec-7 News_blog">
      <div class="container">

         <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12 text-center news_text" data-aos="zoom-in"
                 data-aos-duration="2000">
               <h2>{!!($pages->where('slug','newsandblogs')->first()->title??'Not Available') !!}</h2>
               {!!($pages->where('slug','newsandblogs')->first()->description??'Not Available') !!}
            </div>
         </div>
         <div class="row">
            <!-- <div class="col-lg-5 col-xl-5 first_blog" data-aos="fade-right" data-aos-duration="2000">
               <div class="card">
                  <img class="card-img-top" src="{{ asset('website') }}/img/Mask7.png" alt="Card image cap">
                  <div class="date_comments">
                     <p><i class="far fa-calendar-alt"></i> 4th Jun 2021 </p>
                     <p><i class="fas fa-comments"></i> 3 comments </p>
                  </div>
                  <div class="card-body">
                     <h2 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing</h2>
                     <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco..</p>

                     <p class="card-text">laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur.</p>
                  </div>
               </div>
            </div> -->

            <div class="col-lg-12 col-xl-12 second_blog">
               <div class="row">
                  @foreach($blogs as $item)
                  <div class="col-lg-4 col-xl-3 col-md-6  inner_blog" data-aos="zoom-in" data-aos-duration="2000">
                     <div class="card">
                        <a href="{{route('view-blog')}}/{{$item->id??''}}">
                        <img class="card-img-top" src="{{ asset('website') }}/{{$item->image??''}}" alt="Card image cap">
                        </a>
                        <div class="row">
                           <p class="col-6 text-center"><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse( $item->created_at??'' )->toFormattedDateString() }}</p>
                           <p class="col-6 text-center"><i class="fas fa-comments"></i> 3 comments </p>
                        </div>
                        <div class="card-body">
                           <h2 class="card-title">{{$item->title??''}}</h2>
                        </div>
                     </div>
                  </div>
                  @endforeach

                  <!-- <div class="col-lg-6 col-xl-6 inner_blog" data-aos="zoom-in" data-aos-duration="2000">
                     <div class="card">
                        <img class="card-img-top" src="{{ asset('website') }}/img/Mask9.png" alt="Card image cap">
                        <div class="date_comments">
                           <p><i class="far fa-calendar-alt"></i> 4th Jun 2021 </p>
                           <p><i class="fas fa-comments"></i> 3 comments </p>
                        </div>
                        <div class="card-body">
                           <h2 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing</h2>
                        </div>
                     </div>
                  </div> -->
               </div>

               <!-- <div class="row blog_second_row">
                  <div class="col-lg-6 col-xl-6 inner_blog" data-aos="zoom-in" data-aos-duration="2000">
                     <div class="card">
                        <img class="card-img-top" src="{{ asset('website') }}/img/Mask10.png" alt="Card image cap">
                        <div class="date_comments">
                           <p><i class="far fa-calendar-alt"></i> 4th Jun 2021 </p>
                           <p><i class="fas fa-comments"></i> 3 comments </p>
                        </div>
                        <div class="card-body">
                           <h2 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing</h2>
                        </div>
                     </div>
                  </div>

                  <div class="col-lg-6 col-xl-6 inner_blog" data-aos="zoom-in" data-aos-duration="2000">
                     <div class="card">
                        <img class="card-img-top" src="{{ asset('website') }}/img/Mask11.png" alt="Card image cap">
                        <div class="date_comments">
                           <p><i class="far fa-calendar-alt"></i> 4th Jun 2021 </p>
                           <p><i class="fas fa-comments"></i> 3 comments </p>
                        </div>
                        <div class="card-body">
                           <h2 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing</h2>
                        </div>
                     </div>
                  </div>
               </div> -->
            </div>
         </div>
      </div>
   </section>


   <!----------------  ACCORDION SECTION -------------------->


   <section id="vendor-sec-3">
      <div class="container custom-comtainer">
         <div class="row">
            <div class="col-lg-12 text-center faq_text" data-aos="zoom-in" data-aos-duration="2000">
               <h1>{!!($pages->where('slug','faq')->first()->title??'Not Available') !!}</h1>
               {!!($pages->where('slug','faq')->first()->description??'Not Available') !!}
            </div>
            <div class="col-xl-8 col-lg-7 col-md-6" data-aos="fade-right" data-aos-duration="2000">
               <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  @foreach($faqs as $key=>$item)
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                           <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$key}}"
                              aria-expanded="true" aria-controls="collapseOne">
                              <i class="fas fa-plus"></i>
                               {{$item->title??''}}
                           </a>
                        </h4>
                     </div>
                     <div id="collapseOne{{$key}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body"> {!! $item->description??'' !!}</div>
                     </div>
                  </div>
                  @endforeach
                  
               </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6 Form-text" data-aos="fade-left" data-aos-duration="2000">
               <h2> Ask a Question </h2>
               <form action="{{route('ask_A_Question')}}" method="post" name="ask_question_form">
                  @csrf
                  <div class="form-group">
                     <input type="email" class="form-control" id="email" placeholder="Email Address"
                            aria-describedby="emailHelp" name="email">
                  </div>

                  <div class="form-group">
                           <textarea class="form-control" id="description" placeholder="Message"
                                     rows="3" name="description"></textarea>
                  </div>

                  <div class="ball_button accordian_btn">
                     <!-- <a href="#"> SEND &nbsp;<i class="fas fa-arrow-right"></i></a> -->
                     <button class="ball_button accordian_btn" type="submit">Send &nbsp;<i class="fas fa-arrow-right"></i></button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>
@endsection
@push('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
   <script>
      // --------------------- for validation. -----------------
      $(function() {
            $("form[name='ask_question_form']").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    description: "required",
                  },
                messages: {
                    email:           "Please enter your valid Email*",
                    description:     "Please enter your Message*",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
       //for guest pass
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
       //for hotels
       $(document).ready(function(){
           $("#add_adults_hotels").click(function(){
               adults_hotels = parseInt($(".adults_hotels").val());

               if(adults_hotels>=1 && adults_hotels<30){
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
               if(adults_hotels>1){
                   adults_hotels = parseInt(adults_hotels)-1;
                   $('.adults_hotels').val(adults_hotels);
                   total_guests_hotels = parseInt($(".adults_hotels").val())+parseInt($(".childs_hotels").val())+parseInt($(".infants_hotels").val());
                   $('#total_guests_hotels').val(total_guests_hotels);
                   $(".adults_span_hotels").html(adults_hotels);
               }
           });

           $("#add_childs_hotels").click(function(){
               childs_hotels = parseInt($(".childs_hotels").val());
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

       //for Packages
       $(document).ready(function(){
           $("#add_adults_package").click(function(){
               adults_package = parseInt($(".adults_package").val());

               if(adults_package>=1 && adults_package<30){
                   adults_package = adults_package+1;
                   $('.adults_package').val(adults_package);
                   $('#total_guests_package').val(total_guests_package);
                   total_guests_package = parseInt($(".adults_package").val())+parseInt($(".childs_package").val())+parseInt($(".infants_package").val());
                   $('#total_guests_hotels').val(total_guests_hotels);
                   $(".adults_span_hotels").html(adults_hotels);
               }
           });
           $("#remove_adults_package").click(function(){
               adults = $(".adults_package").val();
               if(adults_package>1){
                   adults_package = parseInt(adults_package)-1;
                   $('.adults_package').val(adults_package);
                   total_guests_package = parseInt($(".adults_package").val())+parseInt($(".childs_package").val())+parseInt($(".infants_package").val());
                   $('#total_guests_package').val(total_guests_package);
                   $(".adults_span_package").html(adults_package);
               }
           });

           $("#add_childs_package").click(function(){
               childs_package = parseInt($(".childs_package").val());
               if(childs_package>=0 && childs_package<30){
                   childs_package = childs_package+1;
                   $('.childs_package').val(childs_package);
                   total_guests_package = parseInt($(".adults_package").val())+parseInt($(".childs_package").val())+parseInt($(".infants_package").val());
                   $('#total_guests_hotels').val(total_guests_hotels);
                   $(".childs_span_package").html(childs_package);
               }
           });
           $("#remove_childs_package").click(function(){
               childs = $(".childs_package").val();
               if(childs_package>0){
                   childs_package = parseInt(childs_package)-1;
                   $('.childs_package').val(childs_package);
                   total_guests_package = parseInt($(".adults_package").val())+parseInt($(".childs_package").val())+parseInt($(".infants_package").val());
                   $('#total_guests_package').val(total_guests_package);
                   $(".childs_span_package").html(childs_package);
               }
           });

           $("#add_infants_package").click(function(){
               infants_package = parseInt($(".infants_package").val());
               if(infants_package>=0 && infants_package<30){
                   infants_package = infants_package+1;
                   $('.infants_package').val(infants_package);
                   // total_guests_hotels = parseInt($(".adults_hotels").val())+parseInt($(".childs_hotels").val())+parseInt($(".infants_hotels").val());
                   // $('#total_guests_hotels').val(total_guests_hotels);
                   $(".infants_span_package").html(infants_package);
               }
           });
           $("#remove_infants_package").click(function(){
               infants_package = $(".infants_package").val();
               if(infants_package>0){
                   infants_package = parseInt(infants_package)-1;
                   $('.infants_package').val(infants_package);
                   // total_guests_hotels = parseInt($(".adults_hotels").val())+parseInt($(".childs_hotels").val())+parseInt($(".infants_hotels").val());
                   // $('#total_guests_hotels').val(total_guests_hotels);
                   $(".infants_span_package").html(infants_package);
               }
           });
       });

       //for guides
       $(document).ready(function(){
           $("#add_adults_guide").click(function(){
               adults_guide = parseInt($(".adults_guide").val());

               if(adults_guide>=1 && adults_guide<30){
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
       $('#route_from').on('change', function() {
           $.get('{{ URL::to("get-transportation-route-to")}}/'+this.value,function(data){
               $('#route_to').empty();
               $('#route_to').prop('disabled', false);
               $('#route_to').append('<option value="disable" disabled selected>To</option>');
               for (var item in data) {
                   $('#route_to').append('<option value='+data[ item ]["RouteTo"]+'>'+data[ item ]["RouteTo"]+'</option>');
                   // console.log(data[ item ]['RouteTo']);
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
{{--                @if($route_name=='view-favorites')--}}
//                    $(this).parent().parent().parent().css( "display", "none" );
                {{--@endif--}}
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