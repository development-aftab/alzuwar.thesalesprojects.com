@extends('ziyaraviews.layout.app')
@section('content')
   <!----------------- BANNER FORM SECTION STARTS  --------------->

   <section class="sec-1">
       <div class="vidbg-container">
            <video playsinline="" autoplay="" loop="" muted="">
                <source src="./img/bgVideo.mp4" type="video/mp4"><source src="#" type="video/mp4">
            </video>
            <div class="vidbg-overlay"></div>
       </div>
      <div class="container custom-container">
         <div class="row align-items-center">
            <div class="col-md-6 tabs_section" data-aos="fade-right" data-aos-duration="3000">
                <div class="col-md-12 text-center notification_form">
                  <p> Call at +1 (718) 297-6520 ext. 101 OR book online </p>
               </div>
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true"><i class="far fa-envelope-open"></i><span>Package
                           Deals</span></a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="profile-tab" href="./visa.php"
                        aria-controls="profile" aria-selected="false" target="_blank"><i
                           class="fas fa-ticket-alt"></i><span>Visa</span></a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="contact-tab" href="./flights.php"
                        aria-controls="contact" aria-selected="false" target="_blank"><i
                           class="fas fa-plane-departure"></i><span>Flights</span></a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="transport-tab" href="./transportation.php"
                        aria-controls="transport" aria-selected="false" target="_blank"><i
                           class="fas fa-bus"></i><span>Transport</span></a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="contact-tab" href="./guest-passes.php" role="tab"
                        aria-controls="contact" aria-selected="false"><i class="fas fa-user"></i><span>Guest Pass</span></a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="contact-tab" href="./hotels.php"
                        aria-controls="contact" aria-selected="false" target="_blank"><i class="fas fa-hotel"></i><span>Hotel</span></a>
                  </li>
               </ul>

               
               <div class="tab-content" id="myTabContent">

                  <!-------------- PACKAGE DEALS ------------>

                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                     <form>
                        <div class="form-row">
                           <div class="col-md-12">
                               <img src="./img/flight_new.png" class="img-fluid flight_img">
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
                                     <img src="./img/location.png" class="img-fluid flight_img">
                                    <select class="form-control" name="owner_dm">
                                       <option value="">Destination</option>
                                       <option value="1">Makkah</option>
                                       <option value="1">Madina</option>
                                    </select>
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">

                                    <img src="./img/calender.png" onclick="setDatepicker(this)" class="img-fluid flight_img">

                                 <!-- Input field along with 
                calendar icon and -->
                                 <div class="input-group date">
                                  
                                    <!-- Accepts the input from calendar -->
                                    <input class="form-control" type="text" name="dob" id="dob"
                                       placeholder="Depart Date" value="">
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <select id="inputState" class="form-control day_selector">
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
                               <label>
                                   <i class="fas fa-bed"></i>
                               </label>
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
                              <input type="text" class="form-control guest_field" id="formGroupExampleInput" placeholder="2 Guests">
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

                  <!------------------- VISA ----------------->\

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


                  <div class="tab-pane fade" id="transport" role="tabpanel" aria-labelledby="transport-tab">
                     <form>
                        <div class="form-row transportation">
                           <div class="col-md-12">
                              <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Pick-up">
                           </div>

                           <div class="col-md-12">
                              <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Drop-off">
                           </div>

                           <div class="col-md-12">
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
                                 <option selected>10:00am</option>
                                 <option> 11:00am </option>
                                 <option> 12:00am </option>
                                 <option> 1:00pm </option>
                                 <option> 2:00pm </option>
                                 <option> 3:0pm </option>
                                 <option> 4:00pm </option>
                              </select>
                           </div>

                           <div class="col-md-6">
                              <select id="inputState" class="form-control">
                                 <option selected>10:00am</option>
                                 <option> 11:00am </option>
                                 <option> 12:00am </option>
                                 <option> 1:00pm </option>
                                 <option> 2:00pm </option>
                                 <option> 3:0pm </option>
                                 <option> 4:00pm </option>
                              </select>
                           </div>


                           <div class="col-md-12 check_row">
                              <input class="form-check-input" type="checkbox" id="gridCheck">
                              <label class="form-check-label" for="gridCheck">
                                 Driver Age 25-69?
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

                  <!------------------ SHRINE GUIDE ----------------->


                  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
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

                  <!-------------------------- HOTEL ------------------->

                  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
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
               </div>

            </div>
            <div class="col-md-6 banner_text" data-aos="fade-left" data-aos-duration="3000">
               <h2>AlZiyarah Package & Tours
               </h2>
               <h2> The Only Official Shrines Partner</h2>
               <p>Want to Have an Exclusive Ziyarah Experience?</p>
               <a href="#">Discover Our Tours &nbsp;<i class="fas fa-arrow-right"></i></a>

            </div>
         </div>
        <audio controls autoplay id="bgAudio">
            <source src="./img/bgMusic.mp3" type="audio/mp3">
        </audio>
      </div>
   </section>


   <!-- -------------- HOVER SECTION STARTS  ----------------->

   <section class="sec-2">
      <div class="container">
         <div class="row">
            <div class="col-lg-4" data-aos="fade-right" data-aos-duration="2000">
               <div class="media">
                  <div class="browse_travel">
                     <img src="./img/browsing.png" alt="">
                  </div>
                  <div class="media-body">
                     <h5 class="mt-0">Browse</h5>
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
               </div>

            </div>
            <div class="col-lg-4" data-aos="fade-down" data-aos-duration="2000">
               <div class="media">
                  <div class="browse_travel">
                     <img src="./img/select1.png" alt="">
                  </div>
                  <div class="media-body">
                     <h5 class="mt-0">Select</h5>
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                  </div>
               </div>

            </div>
            <div class="col-lg-4" data-aos="fade-left" data-aos-duration="2000">
               <div class="media">
                  <div class="browse_travel">
                     <img src="./img/passport.png" alt="">
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
               <h3>We're Truely Dedicated to Make
                  your Travel Experience Best</h3>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                  ullamco.</p>
               <p>laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                  cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.
               </p>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="3000">
               <img src="./img/sec3img.png" alt="Quran" class="img-fluid">
            </div>
         </div>
      </div>
   </section>


   <!------------- UMRAH PACKAGE SECTION STARTS ---------------->

   <section class="sec-4">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center Umrah-Package" data-aos="zoom-in" data-aos-duration="3000">
               <p class="blue_text"> Experience the variety of </p>
               <h1> Hajj / Umrah Packages </h1>
               <p class="last_text"> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                  sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
            </div>
         </div>

         <div class="row">
            <div class="col-lg-12">
               <div class="main-swiper">
                  <div class="swiper-container mySwiper">
                     <div class="swiper-wrapper">
                        <div class="swiper-slide" data-aos="fade-right" data-aos-duration="2000">
                           <div class="card" style="width: 18re"> <a href="./packages-deals.php" traget="_blank"><img class="card-img-top" src="./img/mecca.png"
                                 alt="Card image cap"></a>
                              <div class="card-body">
                                  <div class="card_body_content">
                                      <p class="three_star"><i class="fas fa-star"></i> 3 Star </p>
                                 <h3 class="card-title"> Economy Umrah Package </h3>
                                 <ul>
                                    <li class="date"><i class="far fa-calendar-plus"></i> June 25th 2020 to September
                                       25th 2020 </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 3 Nights Stay in Dallah taiba Madinah
                                    </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 4 Nights Stay in Swisshotel makkah </li>
                                    <li class="house"><i class="fas fa-house-user"></i> North American sheet-rock tents
                                       in mina </li>
                                    <li class="airfare"><i class="fas fa-ticket-alt"></i> Round Trip Airfare </li>
                                 </ul>
                                  </div>
                                 
                                 <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> 10 Nights & 11 Days </p>
                                    <p> From <span> $595 </span></p>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="swiper-slide" data-aos="zoom-in" data-aos-duration="2000">
                           <div class="card" style="width: 18re"> <a href="./packages-deals.php" traget="_blank"><img class="card-img-top" src="./img/Group 2981.png"
                                 alt="Card image cap"></a>
                              <div class="card-body">
                                   <div class="card_body_content">
                                       <p class="three_star"><i class="fas fa-star"></i> 4 Star </p>
                                 <h3 class="card-title"> Premium Umrah Package </h3>
                                 <ul>
                                    <li class="date"><i class="far fa-calendar-plus"></i> June 25th 2020 to September
                                       25th 2020 </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 3 Nights Stay in Dallah taiba Madinah
                                    </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 4 Nights Stay in Swisshotel makkah </li>
                                    <li class="house"><i class="fas fa-house-user"></i> North American sheet-rock tents
                                       in mina </li>
                                    <li class="airfare"><i class="fas fa-ticket-alt"></i> Round Trip Airfare </li>
                                 </ul>
                                  </div>
                                
                                 <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> 10 Nights & 11 Days </p>
                                    <p> From <span> $695 </span></p>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="swiper-slide" data-aos="fade-left" data-aos-duration="2000">
                           <div class="card" style="width: 18re"><a href="./packages-deals.php" traget="_blank"> <img class="card-img-top" src="./img/Group 2982.png"
                                 alt="Card image cap"></a>
                              <div class="card-body">
                                   <div class="card_body_content">
                                      <p class="three_star"><i class="fas fa-star"></i> 5 Star </p>
                                 <h3 class="card-title"> Deluxe Umrah Package </h3>
                                 <ul>
                                    <li class="date"><i class="far fa-calendar-plus"></i> June 25th 2020 to September
                                       25th 2020 </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 3 Nights Stay in Dallah taiba Madinah
                                    </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 4 Nights Stay in Swisshotel makkah </li>
                                    <li class="house"><i class="fas fa-house-user"></i> North American sheet-rock tents
                                       in mina </li>
                                    <li class="airfare"><i class="fas fa-ticket-alt"></i> Round Trip Airfare </li>
                                 </ul>
                                  </div>
                                 
                                 <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> 10 Nights & 11 Days </p>
                                    <p> From <span> $695 </span></p>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="swiper-slide">
                           <div class="card" style="width: 18re"><a href="./packages-deals.php" traget="_blank"> <img class="card-img-top" src="./img/mecca.png"
                                 alt="Card image cap"></a>
                              <div class="card-body">
                                   <div class="card_body_content">
                                       <p class="three_star"> 3 Star </p>
                                 <h3 class="card-title"> Economy Umrah Package </h3>
                                 <ul>
                                    <li class="date"><i class="far fa-calendar-plus"></i> June 25th 2020 to September
                                       25th 2020 </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 3 Nights Stay in Dallah taiba Madinah
                                    </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 4 Nights Stay in Swisshotel makkah </li>
                                    <li class="house"><i class="fas fa-house-user"></i> North American sheet-rock tents
                                       in mina </li>
                                    <li class="airfare"><i class="fas fa-ticket-alt"></i> Round Trip Airfare </li>
                                 </ul>
                                  </div>
                                
                                 <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> 10 Nights & 11 Days </p>
                                    <p> From <span> $595 </span></p>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="swiper-slide">
                           <div class="card" style="width: 18re"><a href="./packages-deals.php" traget="_blank"> <img class="card-img-top" src="./img/Group 2981.png"
                                 alt="Card image cap"></a>
                              <div class="card-body">
                                   <div class="card_body_content">
                                       <p class="three_star"> 3 Star </p>
                                 <h3 class="card-title"> Economy Umrah Package </h3>
                                 <ul>
                                    <li class="date"><i class="far fa-calendar-plus"></i> June 25th 2020 to September
                                       25th 2020 </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 3 Nights Stay in Dallah taiba Madinah
                                    </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 4 Nights Stay in Swisshotel makkah </li>
                                    <li class="house"><i class="fas fa-house-user"></i> North American sheet-rock tents
                                       in mina </li>
                                    <li class="airfare"><i class="fas fa-ticket-alt"></i> Round Trip Airfare </li>
                                 </ul>
                                  </div>
                                
                                 <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> 10 Nights & 11 Days </p>
                                    <p> From <span> $595 </span></p>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="swiper-slide">
                           <div class="card" style="width: 18re"><a href="./packages-deals.php" traget="_blank"> <img class="card-img-top" src="./img/Group 2982.png"
                                 alt="Card image cap"></a>
                              <div class="card-body">
                                   <div class="card_body_content">
                                       <p class="three_star"> 3 Star </p>
                                 <h3 class="card-title"> Economy Umrah Package </h3>
                                 <ul>
                                    <li class="date"><i class="far fa-calendar-plus"></i> June 25th 2020 to September
                                       25th 2020 </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 3 Nights Stay in Dallah taiba Madinah
                                    </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 4 Nights Stay in Swisshotel makkah </li>
                                    <li class="house"><i class="fas fa-house-user"></i> North American sheet-rock tents
                                       in mina </li>
                                    <li class="airfare"><i class="fas fa-ticket-alt"></i> Round Trip Airfare </li>
                                 </ul>
                                  </div>
                                
                                 <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> 10 Nights & 11 Days </p>
                                    <p> From <span> $595 </span></p>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
               <div class="swiper-button-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
               <div class="swiper-button-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-12 ball_button text-center">
               <a href="#">VIEW ALL PACKAGES &nbsp;<i class="fas fa-arrow-right"></i></a>
            </div>
         </div>
      </div>
   </section>
   
   
   <!------------- GUEST PASS PACKAGE SECTION STARTS ---------------->
   
   <section class="sec-4">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center Umrah-Package" data-aos="zoom-in" data-aos-duration="3000">
               <p class="blue_text"> Experience the variety of </p>
               <h1>Guest Program:</h1>
               <p class="last_text">Seminars, Tours & Meals from Holy Shrines</p>
            </div>
         </div>

         <div class="row">
            <div class="col-lg-12">
               <div class="main-swiper">
                  <div class="swiper-container mySwiper">
                     <div class="swiper-wrapper">
                        <div class="swiper-slide" data-aos="fade-right" data-aos-duration="2000">
                           <div class="card" style="width: 18re"><a href="./guest-passes.php" traget="_blank"> <img class="card-img-top" src="./img/mecca.png"
                                 alt="Card image cap"></a>
                              <div class="card-body">
                                  <div class="card_body_content">
                                      <p class="three_star"><i class="fas fa-star"></i> 3 Star </p>
                                 <h3 class="card-title"> Economy Umrah Package </h3>
                                 <ul>
                                    <li class="date"><i class="far fa-calendar-plus"></i> June 25th 2020 to September
                                       25th 2020 </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 3 Nights Stay in Dallah taiba Madinah
                                    </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 4 Nights Stay in Swisshotel makkah </li>
                                    <li class="house"><i class="fas fa-house-user"></i> North American sheet-rock tents
                                       in mina </li>
                                    <li class="airfare"><i class="fas fa-ticket-alt"></i> Round Trip Airfare </li>
                                 </ul>
                                  </div>
                                 
                                 <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> 10 Nights & 11 Days </p>
                                    <p> From <span> $595 </span></p>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="swiper-slide" data-aos="zoom-in" data-aos-duration="2000">
                           <div class="card" style="width: 18re"><a href="./guest-passes.php" traget="_blank"> <img class="card-img-top" src="./img/Group 2981.png"
                                 alt="Card image cap"></a>
                              <div class="card-body">
                                   <div class="card_body_content">
                                       <p class="three_star"><i class="fas fa-star"></i> 4 Star </p>
                                 <h3 class="card-title"> Premium Umrah Package </h3>
                                 <ul>
                                    <li class="date"><i class="far fa-calendar-plus"></i> June 25th 2020 to September
                                       25th 2020 </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 3 Nights Stay in Dallah taiba Madinah
                                    </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 4 Nights Stay in Swisshotel makkah </li>
                                    <li class="house"><i class="fas fa-house-user"></i> North American sheet-rock tents
                                       in mina </li>
                                    <li class="airfare"><i class="fas fa-ticket-alt"></i> Round Trip Airfare </li>
                                 </ul>
                                  </div>
                                
                                 <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> 10 Nights & 11 Days </p>
                                    <p> From <span> $695 </span></p>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="swiper-slide" data-aos="fade-left" data-aos-duration="2000">
                           <div class="card" style="width: 18re"><a href="./guest-passes.php" traget="_blank"> <img class="card-img-top" src="./img/Group 2982.png"
                                 alt="Card image cap"></a>
                              <div class="card-body">
                                   <div class="card_body_content">
                                      <p class="three_star"><i class="fas fa-star"></i> 5 Star </p>
                                 <h3 class="card-title"> Deluxe Umrah Package </h3>
                                 <ul>
                                    <li class="date"><i class="far fa-calendar-plus"></i> June 25th 2020 to September
                                       25th 2020 </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 3 Nights Stay in Dallah taiba Madinah
                                    </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 4 Nights Stay in Swisshotel makkah </li>
                                    <li class="house"><i class="fas fa-house-user"></i> North American sheet-rock tents
                                       in mina </li>
                                    <li class="airfare"><i class="fas fa-ticket-alt"></i> Round Trip Airfare </li>
                                 </ul>
                                  </div>
                                 
                                 <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> 10 Nights & 11 Days </p>
                                    <p> From <span> $695 </span></p>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="swiper-slide">
                           <div class="card" style="width: 18re"><a href="./guest-passes.php" traget="_blank"> <img class="card-img-top" src="./img/mecca.png"
                                 alt="Card image cap"></a>
                              <div class="card-body">
                                   <div class="card_body_content">
                                       <p class="three_star"> 3 Star </p>
                                 <h3 class="card-title"> Economy Umrah Package </h3>
                                 <ul>
                                    <li class="date"><i class="far fa-calendar-plus"></i> June 25th 2020 to September
                                       25th 2020 </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 3 Nights Stay in Dallah taiba Madinah
                                    </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 4 Nights Stay in Swisshotel makkah </li>
                                    <li class="house"><i class="fas fa-house-user"></i> North American sheet-rock tents
                                       in mina </li>
                                    <li class="airfare"><i class="fas fa-ticket-alt"></i> Round Trip Airfare </li>
                                 </ul>
                                  </div>
                                
                                 <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> 10 Nights & 11 Days </p>
                                    <p> From <span> $595 </span></p>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="swiper-slide">
                           <div class="card" style="width: 18re"><a href="./guest-passes.php" traget="_blank"> <img class="card-img-top" src="./img/Group 2981.png"
                                 alt="Card image cap"></a>
                              <div class="card-body">
                                   <div class="card_body_content">
                                       <p class="three_star"> 3 Star </p>
                                 <h3 class="card-title"> Economy Umrah Package </h3>
                                 <ul>
                                    <li class="date"><i class="far fa-calendar-plus"></i> June 25th 2020 to September
                                       25th 2020 </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 3 Nights Stay in Dallah taiba Madinah
                                    </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 4 Nights Stay in Swisshotel makkah </li>
                                    <li class="house"><i class="fas fa-house-user"></i> North American sheet-rock tents
                                       in mina </li>
                                    <li class="airfare"><i class="fas fa-ticket-alt"></i> Round Trip Airfare </li>
                                 </ul>
                                  </div>
                                
                                 <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> 10 Nights & 11 Days </p>
                                    <p> From <span> $595 </span></p>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="swiper-slide">
                           <div class="card" style="width: 18re"><a href="./guest-passes.php" traget="_blank"> <img class="card-img-top" src="./img/Group 2982.png"
                                 alt="Card image cap"></a>
                              <div class="card-body">
                                   <div class="card_body_content">
                                       <p class="three_star"> 3 Star </p>
                                 <h3 class="card-title"> Economy Umrah Package </h3>
                                 <ul>
                                    <li class="date"><i class="far fa-calendar-plus"></i> June 25th 2020 to September
                                       25th 2020 </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 3 Nights Stay in Dallah taiba Madinah
                                    </li>
                                    <li class="stay"><i class="fas fa-bed"></i> 4 Nights Stay in Swisshotel makkah </li>
                                    <li class="house"><i class="fas fa-house-user"></i> North American sheet-rock tents
                                       in mina </li>
                                    <li class="airfare"><i class="fas fa-ticket-alt"></i> Round Trip Airfare </li>
                                 </ul>
                                  </div>
                                
                                 <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> 10 Nights & 11 Days </p>
                                    <p> From <span> $595 </span></p>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
               <div class="swiper-button-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
               <div class="swiper-button-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-12 ball_button text-center">
               <a href="#">VIEW ALL PACKAGES &nbsp;<i class="fas fa-arrow-right"></i></a>
            </div>
         </div>
      </div>
   </section>

   <!--------------- ZIYARAT PACKAGES SECTION STARTS --------------->


   <section class="sec-4 ziyarat_package">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center Umrah-Package" data-aos="zoom-in" data-aos-duration="3000">
               <p class="blue_text"> Experience the variety of </p>
               <h1> Ziyarat Packages </h1>
               <p class="last_text"> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                  sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
            </div>
         </div>

         <div class="row">
            <div class="col-lg-12">
               <div class="main-swiper">
                  <div class="swiper-container mySwiper">
                     <div class="swiper-wrapper">
                        <div class="swiper-slide" data-aos="fade-right" data-aos-duration="2000">
                           <div class="card" style="width: 18re"><a href="./packages-deals.php" traget="_blank"> <img class="card-img-top" src="./img/Iraq1.png"
                                 alt="Card image cap"></a>
                              <div class="card-body">
                                  <div class="card_body_content">
                                       <p class="three_star"><i class="fas fa-map-marker-alt"></i> IRAQ </p>
                                 <h3 class="card-title"> Arfa Makhsoosi in Karbala </h3>
                                 <ul>
                                    <li class="date"><i class="far fa-calendar-plus"></i> June 25th 2020 to September
                                       25th 2020 </li>
                                    <li class="date"><i class="fas fa-bed"></i> Accomodations </li>
                                    <li class="stay"><i class="fas fa-utensils"></i> Meals </li>
                                    <li class="stay"><i class="fas fa-bus"></i> Transportation </li>
                                    <li class="house"><i class="fas fa-praying-hands"></i> Atraf Ziarat </li>
                                    <li class="airfare"><i class="fas fa-ticket-alt"></i> Round Trip Airfare </li>
                                 </ul>
                                  </div>
                                
                                 <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> 10 Nights & 11 Days </p>
                                    <p> From <span> $1250 </span></p>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="swiper-slide" data-aos="zoom-in" data-aos-duration="2000">
                           <div class="card" style="width: 18re"><a href="./packages-deals.php" traget="_blank"> <img class="card-img-top" src="./img/Iraq2.png"
                                 alt="Card image cap"></a>
                              <div class="card-body">
                                  <div class="card_body_content">
                                         <p class="three_star"><i class="fas fa-map-marker-alt"></i> IRAQ </p>
                                 <h3 class="card-title"> Ashura In Karbala 1443 Hijri </h3>
                                 <ul>
                                    <li class="date"><i class="far fa-calendar-plus"></i> June 25th 2020 to September
                                       25th 2020 </li>
                                    <li class="date"><i class="fas fa-bed"></i> Accomodations </li>
                                    <li class="stay"><i class="fas fa-utensils"></i> Meals </li>
                                    <li class="stay"><i class="fas fa-bus"></i> Transportation </li>
                                    <li class="house"><i class="fas fa-praying-hands"></i> Atraf Ziarat </li>
                                    <li class="airfare"><i class="fas fa-ticket-alt"></i> Round Trip Airfare </li>
                                 </ul>
                                  </div>
                              
                                 <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> 10 Nights & 11 Days </p>
                                    <p> From <span> $1250 </span></p>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="swiper-slide" data-aos="fade-left" data-aos-duration="2000">
                           <div class="card" style="width: 18re"><a href="./packages-deals.php" traget="_blank"> <img class="card-img-top" src="./img/Iraq3.png"
                                 alt="Card image cap"></a>
                              <div class="card-body">
                                  <div class="card_body_content">
                                        <p class="three_star"><i class="fas fa-map-marker-alt"></i> IRAQ + IRAN </p>
                                 <h3 class="card-title"> June Family Package </h3>
                                 <ul>
                                    <li class="date"><i class="far fa-calendar-plus"></i> June 25th 2020 to September
                                       25th 2020 </li>
                                    <li class="date"><i class="fas fa-bed"></i> Accomodations </li>
                                    <li class="stay"><i class="fas fa-utensils"></i> Meals </li>
                                    <li class="stay"><i class="fas fa-bus"></i> Transportation </li>
                                    <li class="house"><i class="fas fa-praying-hands"></i> Atraf Ziarat </li>
                                    <li class="airfare"><i class="fas fa-ticket-alt"></i> Round Trip Airfare </li>
                                 </ul>
                                  </div>
                               
                                 <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> 10 Nights & 11 Days </p>
                                    <p> From <span> $1150 </span></p>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="swiper-slide">
                           <div class="card" style="width: 18re"><a href="./packages-deals.php" traget="_blank"> <img class="card-img-top" src="./img/Iraq1.png"
                                 alt="Card image cap"></a>
                              <div class="card-body">
                                  <div class="card_body_content">
                                       <p class="three_star"><i class="fas fa-map-marker-alt"></i> IRAQ </p>
                                 <h3 class="card-title"> Arfa Makhsoosi in Karbala </h3>
                                 <ul>
                                    <li class="date"><i class="far fa-calendar-plus"></i> June 25th 2020 to September
                                       25th 2020 </li>
                                    <li class="date"><i class="fas fa-bed"></i> Accomodations </li>
                                    <li class="stay"><i class="fas fa-utensils"></i> Meals </li>
                                    <li class="stay"><i class="fas fa-bus"></i> Transportation </li>
                                    <li class="house"><i class="fas fa-praying-hands"></i> Atraf Ziarat </li>
                                    <li class="airfare"><i class="fas fa-ticket-alt"></i> Round Trip Airfare </li>
                                 </ul>
                                  </div>
                                
                                 <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> 10 Nights & 11 Days </p>
                                    <p> From <span> $1250 </span></p>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="swiper-slide">
                           <div class="card" style="width: 18re"><a href="./packages-deals.php" traget="_blank"> <img class="card-img-top" src="./img/Iraq2.png"
                                 alt="Card image cap"></a>
                              <div class="card-body">
                                  <div class="card_body_content">
                                       <p class="three_star"><i class="fas fa-map-marker-alt"></i> IRAQ </p>
                                 <h3 class="card-title"> Ashura In Karbala 1443 Hijri </h3>
                                 <ul>
                                    <li class="date"><i class="far fa-calendar-plus"></i> June 25th 2020 to September
                                       25th 2020 </li>
                                    <li class="date"><i class="fas fa-bed"></i> Accomodations </li>
                                    <li class="stay"><i class="fas fa-utensils"></i> Meals </li>
                                    <li class="stay"><i class="fas fa-bus"></i> Transportation </li>
                                    <li class="house"><i class="fas fa-praying-hands"></i> Atraf Ziarat </li>
                                    <li class="airfare"><i class="fas fa-ticket-alt"></i> Round Trip Airfare </li>
                                 </ul>
                                  </div>
                                
                                 <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> 10 Nights & 11 Days </p>
                                    <p> From <span> $1250 </span></p>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="swiper-slide">
                           <div class="card" style="width: 18re"><a href="./packages-deals.php" traget="_blank"> <img class="card-img-top" src="./img/Iraq3.png"
                                 alt="Card image cap"></a>
                              <div class="card-body">
                                  <div class="card_body_content">
                                       <p class="three_star"><i class="fas fa-map-marker-alt"></i> IRAQ + IRAN </p>
                                 <h3 class="card-title"> June Family Package </h3>
                                 <ul>
                                    <li class="date"><i class="far fa-calendar-plus"></i> June 25th 2020 to September
                                       25th 2020 </li>
                                    <li class="date"><i class="fas fa-bed"></i> Accomodations </li>
                                    <li class="stay"><i class="fas fa-utensils"></i> Meals </li>
                                    <li class="stay"><i class="fas fa-bus"></i> Transportation </li>
                                    <li class="house"><i class="fas fa-praying-hands"></i> Atraf Ziarat </li>
                                    <li class="airfare"><i class="fas fa-ticket-alt"></i> Round Trip Airfare </li>
                                 </ul>
                                  </div>
                                
                                 <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> 10 Nights & 11 Days </p>
                                    <p> From <span> $1150 </span></p>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
               <div class="swiper-button-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
               <div class="swiper-button-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-12 ball_button text-center">
               <a href="#">VIEW ALL PACKAGES &nbsp;<i class="fas fa-arrow-right"></i></a>
            </div>
         </div>
      </div>
   </section>


   <!--------------- TRAVEL BEST RELIGIOUS TRIPS SECTION --------------->

   <section class="sec-5 Religious_trips">
      <div class="container">
         <div class="row">
            <div class="col-lg-6 col-xl-6 text-left" data-aos="fade-right" data-aos-duration="2000">
               <h2> Travel Best Religious Trips </h2>
               <p> Our experienced team specializes in Ziyarat and
                  Tourism Packages for Iraq, Iran, Syria. We also provide Haj
                  and Umrah services.</p>
            </div>

            <div class="col-xl-6 col-lg-6" data-aos="fade-left" data-aos-duration="2000">
               <div class="Ziyarat_tours">
                  <img src="./img/image1.png" alt="Quran" class="img-fluid">
                  <div class="tour_content">
                     <h4> Iran Ziyarat & Tours </h4>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-lg-4 col-xl-4 col-md-4" data-aos="zoom-in-right" data-aos-duration="2000">
               <div class="Ziyarat">
                  <img src="./img/image2.png" alt="Quran" class="img-fluid">
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

            <div class="col-lg-4 col-xl-4 col-md-4" data-aos="zoom-in" data-aos-duration="2000">
               <div class="Ziyarat">
                  <img src="./img/image3.png" alt="Quran" class="img-fluid">
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
                  <img src="./img/image4.png" alt="Quran" class="img-fluid">
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
         </div>
      </div>
   </section>
   
   <section class="sec_booking">
       <div class="container-fluid">
           <div class="row">
                 <div class="row">
            <div class="col-lg-4 col-xl-4 col-md-4" data-aos="zoom-in" data-aos-duration="2000">
               <div class="Exclusive_Prices">
                  <img src="./img/interior.png" alt="Quran" class="img-fluid">
                  <div class="Discover_Book">
                     <h2> Discover & Book Hotels at Exclusive Prices </h2>
                     <a href="./hotels.php"><span>DISCOVER HOTELS</span><i class="fas fa-arrow-right"></i></a>
                  </div>
               </div>
            </div>

            <div class="col-lg-4 col-xl-4 col-md-4" data-aos="zoom-in" data-aos-duration="2000">
               <div class="Exclusive_Prices">
                  <img src="./img/bus.png" alt="Quran" class="img-fluid">
                  <div class="Discover_Book">
                     <h2> Book Transport at Exclusive Prices </h2>
                     <a href="./transportation.php"><span>DISCOVER TRANSPORTATION</span><i class="fas fa-arrow-right"></i></a>
                  </div>
               </div>
            </div>
            
            <div class="col-lg-4 col-xl-4 col-md-4" data-aos="zoom-in" data-aos-duration="2000">
               <div class="Exclusive_Prices">
                  <img src="./img/ira.png" alt="Quran" class="img-fluid">
                  <div class="Discover_Book">
                     <h2> Discover Our Tours at Exclusive Prices </h2>
                     <a href="#"><span>DISCOVER TOURS</span><i class="fas fa-arrow-right"></i></a>
                  </div>
               </div>
            </div>
         </div>
           </div>
       </div>
   </section>


   <!--------------- PEOPLE SAY ABOUT US ------------------->

   <section class="sec-6 About_Us">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center" data-aos="zoom-in" data-aos-duration="2000">
               <h1> What <span> People Say About Us </span></h1>
               <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                  et dolore magna aliqua.
                  Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
            </div>
         </div>

         <div class="row">
            <div class="col-lg-6 col-xl-6 col-md-6" data-aos="fade-right" data-aos-duration="2000">
               <div class="people_comments">
                  <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                     Ut enim ad minim veniam, quis nostrud exercitation ullamco </p>
               </div>

               <div class="picture_review">
                  <img src="./img/Ellipse 11.png" alt="Quran" class="img-fluid">
                  <div class="name_stars">
                     <p> Aslam Abbas </p>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
               </div>
            </div>

            <div class="col-lg-6 col-xl-6 col-md-6" data-aos="fade-left" data-aos-duration="2000">
               <div class="people_comments">
                  <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                     Ut enim ad minim veniam, quis nostrud exercitation ullamco </p>
               </div>

               <div class="picture_review">
                  <img src="./img/Ellipse 11.png" alt="Quran" class="img-fluid">
                  <div class="name_stars">
                     <p> Aslam Abbas </p>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>


   <!--------------- LATEST NEWS AND BLOGS ----------------->

   <section class="sec-7 News_blog">
      <div class="container">

         <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12 text-center news_text" data-aos="zoom-in"
               data-aos-duration="2000">
               <h2> Latest News & Blogs </h2>
               <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                  sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                  nostrud exercitation ullamco</p>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-5 col-xl-5 first_blog" data-aos="fade-right" data-aos-duration="2000">
               <div class="card">
                  <img class="card-img-top" src="./img/Mask7.png" alt="Card image cap">
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
            </div>

            <div class="col-lg-7 col-xl-7 second_blog">
               <div class="row">
                  <div class="col-lg-6 col-xl-6 inner_blog" data-aos="zoom-in" data-aos-duration="2000">
                     <div class="card">
                        <img class="card-img-top" src="./img/Mask8.png" alt="Card image cap">
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
                        <img class="card-img-top" src="./img/Mask9.png" alt="Card image cap">
                        <div class="date_comments">
                           <p><i class="far fa-calendar-alt"></i> 4th Jun 2021 </p>
                           <p><i class="fas fa-comments"></i> 3 comments </p>
                        </div>
                        <div class="card-body">
                           <h2 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing</h2>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="row blog_second_row">
                  <div class="col-lg-6 col-xl-6 inner_blog" data-aos="zoom-in" data-aos-duration="2000">
                     <div class="card">
                        <img class="card-img-top" src="./img/Mask10.png" alt="Card image cap">
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
                        <img class="card-img-top" src="./img/Mask11.png" alt="Card image cap">
                        <div class="date_comments">
                           <p><i class="far fa-calendar-alt"></i> 4th Jun 2021 </p>
                           <p><i class="fas fa-comments"></i> 3 comments </p>
                        </div>
                        <div class="card-body">
                           <h2 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing</h2>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>


   <!----------------  ACCORDION SECTION -------------------->


   <section id="vendor-sec-3">
      <div class="container custom-comtainer">
         <div class="row">
            <div class="col-lg-12 text-center faq_text" data-aos="zoom-in" data-aos-duration="2000">
               <h1> FAQs </h1>
               <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                  sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                  nostrud exercitation ullamco</p>
            </div>
            <div class="col-xl-8 col-lg-7 col-md-6" data-aos="fade-right" data-aos-duration="2000">
               <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                           <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                              aria-expanded="true" aria-controls="collapseOne">
                              <i class="fas fa-plus"></i>
                              Lorem ipsum dolor sit amet, consectetur adipiscing elit
                           </a>
                        </h4>
                     </div>
                     <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                           terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
                           Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                           on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                           helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan
                           excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                           synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                           <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                              href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              <i class="fas fa-plus"></i>
                              Lorem ipsum dolor sit amet, consectetur adipiscing elit
                           </a>
                        </h4>
                     </div>
                     <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                           terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
                           Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                           on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                           helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan
                           excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                           synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                           <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                              href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              <i class="fas fa-plus"></i>
                              Lorem ipsum dolor sit amet, consectetur adipiscing elit
                           </a>
                        </h4>
                     </div>
                     <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                        aria-labelledby="headingThree">
                        <div class="panel-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                           terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
                           Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                           on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                           helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan
                           excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                           synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="headingFour">
                        <h4 class="panel-title">
                           <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                              href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                              <i class="fas fa-plus"></i>
                              Lorem ipsum dolor sit amet, consectetur adipiscing elit
                           </a>
                        </h4>
                     </div>
                     <div id="collapseFour" class="panel-collapse collapse" role="tabpanel"
                        aria-labelledby="headingFour">
                        <div class="panel-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                           terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
                           Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                           on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                           helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan
                           excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                           synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="headingFive">
                        <h4 class="panel-title">
                           <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                              href="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                              <i class="fas fa-plus"></i>
                              Lorem ipsum dolor sit amet, consectetur adipiscing elit
                           </a>
                        </h4>
                     </div>
                     <div id="collapseFive" class="panel-collapse collapse" role="tabpanel"
                        aria-labelledby="headingFive">
                        <div class="panel-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                           terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
                           Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                           on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                           helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan
                           excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                           synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6 Form-text" data-aos="fade-left" data-aos-duration="2000">
               <h2> Ask a Question <h2>
                     <form>
                        <div class="form-group">
                           <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email Address"
                              aria-describedby="emailHelp">
                        </div>

                        <div class="form-group">
                           <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Message"
                              rows="3"></textarea>
                        </div>

                        <div class="ball_button accordian_btn">
                           <a href="#"> SEND &nbsp;<i class="fas fa-arrow-right"></i></a>
                        </div>
                     </form>
            </div>
         </div>
   </section>

@endsection