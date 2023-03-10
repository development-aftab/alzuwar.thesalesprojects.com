@extends('website.layout.master')
@push('css')
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
       .hotels .sec-5 .form-group select { max-width: 52%; border-radius: 5px; }
       .hotels .sec-5 .form-group select>option { font-size: 15px; font-weight: 400;  }
       .hotel_img>img {  height: 100%;  border-radius: 20px;  }
       .hotel_view_detail i:hover { background: #FF0000; transition: ease 1s;cursor: pointer;}
       .hotel_view_detail i {background-color: #eeee; transition: ease 1s}
    </style>
@endpush
<body class="hotels transportation-details">

    @section('content')
    <!----------------- ALZIYARA SECTION ----------------------->
    <section class="sec-3">
        <div class="container">
            <div class="row">
                @if($route_name == 'view-favorites')
                    <div class="col-lg-12 Alziyara text-center" data-aos="fade-right" data-aos-duration="3000">
                        <h3>Favorites</h3>
                        <p>Your favorites hotels show here...</p>
                    </div>
                @else
                    <div class="col-lg-12 Alziyara text-center" data-aos="fade-right" data-aos-duration="3000">
                        <h3>{!!($pages->where('slug','reservation')->first()->title??'Not Available') !!}</h3>
                        {!!($pages->where('slug','reservation')->first()->description??'Not Available') !!}
                    </div>
                @endif
                <!--<div class="col-lg-6" data-aos="fade-left" data-aos-duration="3000">-->
                <!--    <div class="hotel_bg_img">-->
                <!--        <img src="./img/hotel-bg.png" alt="Quran" class="img-fluid">-->
                <!--    </div>-->

                <!--</div>-->
            </div>
        </div>
    </section>
    <!------------- UMRAH PACKAGE SECTION STARTS ---------------->
    @if($route_name != 'view-favorites')
    <section class="transport-sec sec-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-bg-color">
                    <form role="form" id="form_transport_details" class="margin-bottom-0" method="get" action="{{ route('search-hotels') }}">
                        <div class="form-row d-flex align-items-end">
                            <div class="form-group col-md-4">															<label for="">Locations:</label>
                                <div class="input-group" id="loc-from">
                                    <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                    <select class="form-control" name="destination" required>
                                        {{--<option selected disabled>Destination</option>--}}
                                        @foreach($cityNames as $cityName)
                                            <option value="{{$cityName->GuestPassLocation}}"
                                            @if($route_name == 'search-hotels')
                                                @if( $cityName->GuestPassLocation== $search_city)
                                                    selected
                                                @endif
                                            @elseif( $cityName->GuestPassLocation=='Karbala')
                                                selected
                                            @endif
                                            >{{$cityName->GuestPassLocation}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">From/To:</label>
                                <div class="input-group" id="pickup-date">
                                    <label for=""><i class="fas fa-calendar-alt"></i></label>

                                    <input type="text" name="daterange" min="{{$default_checkin}}" value="{{$checkin_date??$default_checkin}} - {{$checkout_date??$default_checkout}}" class="form-control" />
                                </div>
                            </div>
                            {{--$Today=date('y:m:d');--}}

                            {{--// add 3 days to date--}}
                            {{--$NewDate=Date('y:m:d', strtotime('+3 days'));--}}
                            <input class="total_guests_hotels" id="total_guests_hotels" name="total_guests_hotels" value="2" readonly hidden>
                           <div class="col-md-3">						   							<label for="">Visitors:</label>
                              <div class="form-group">
                                 <div class="input-group" id="one-way">
                                    <div class="dropdown keep-open">
                                       <!-- Dropdown Button -->
                                       <button id="dLabel" role="button" href="#" data-toggle="dropdown" data-target="#" class="btn btn-light">
                                          <i class="fas fa-user"></i>
                                          <span class="adults_span_hotels">{{$adults_hotels??0}}</span> Adults,
                                          <span class="childs_span_hotels">{{$childs_hotels??0}}</span> Children,
                                          <span class="infants_span_hotels">{{$infants_hotels??0}}</span> Infants
                                       </button>
                                       <!-- Dropdown Menu -->
                                       <div class="dropdown-menu guests_dropdown" role="menu" aria-labelledby="dLabel">
                                          <div class="row">
                                             <div class="col-lg-3 col-md-12 dropdown_heading"><p>Adults</p></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_adults_hotels">-</span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="adults_input_field_hotels"><input type="number" class="form-control adults_hotels" name="adults_hotels" value="{{$adults_hotels??0}}" readonly min="0"></span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_adults_hotels">+</span></div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-3 col-md-12 dropdown_heading"><p>Children</p></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_childs_hotels">-</span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field_hotels"><input type="number" class="form-control childs_hotels" name="childs_hotels" value="{{$childs_hotels??0}}" readonly min="0"></span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_childs_hotels">+</span></div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-3 col-md-12 dropdown_heading"><p>Infants</p></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_infants_hotels">-</span></div>
                                             <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field_hotels"><input type="number" class="form-control infants_hotels" name="infants_hotels" value="{{$infants_hotels??0}}" readonly min="0"></span></div>
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
        </div>
    </section>
    <section class="sec-4 sec-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 pb-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('hotels')}}">All Hotels</a></li>
                            {{--<li class="breadcrumb-item"><a href="#">Iraq</a></li>--}}
                            @if($route_name == 'search-hotels')
                                <li class="breadcrumb-item active" aria-current="page">{{$search_city}}</li>
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
                <!--<div class="col-md-4">-->
                <!--   <div class="card" style="width: 18re">-->
                <!--      <img class="card-img-top" src="./img/hotel-qasir.png" alt="Card image cap">-->
                <!--      <div class="card-body">-->
                <!--         <p class="three_star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> 146 Reviews </p>-->
                <!--         <h3 class="card-title"> Hotel Qasr AlDur Hotel</h3>-->
                <!--         <ul class="list-unstyled">-->
                <!--            <li class="date"><i class="far fa-calendar-plus"></i> Deluxe Twin Room </li>-->
                <!--            <li class="stay"><i class="fas fa-bed"></i> 2 twin beds </li>-->
                <!--            <li class="house"><i class="fas fa-bread-slice"></i> Breakfast Included  </li>-->
                <!--            <li class="airfare"><i class="fas fa-calendar-alt"></i> 9 Days All Inclusive </li>-->
                <!--         </ul>-->
                <!--         <div class="final_price">-->
                <!--            <p class="duration"><i class="fas fa-clock"></i> 9 Nights & 10 Days </p>-->
                <!--            <p> From <span> $765 </span></p>-->
                <!--         </div>-->
                <!--      </div>-->
                <!--   </div>-->
                <!--</div>-->
            </div>
        </div>
    </section>
    @endif
    <section class="sec_hotel_detail" id="sec_hotel_detail">
        @include('website.hotel_card_section')
    </section>
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
    </script>
    <script>
        $(document).ready(function(){
            $("#sort_by").change(function(){
                @if($route_name == 'search-hotels')
                    $.get('{{ URL::to("hotels-sorting-with-city")}}/'+$("#sort_by").val()+'/{{$search_city}}',function(data){
                    // this.innerHTML('');
                    $('.sec_hotel_detail').empty();
                    // alert('search');
                    $('.sec_hotel_detail').html(data);
                    // console.log(data);
                });
                @else
                    $.get('{{ URL::to("hotels-sorting")}}/'+$("#sort_by").val(),function(data){
                    // this.innerHTML('');
                    $('.sec_hotel_detail').empty();
                    // alert($("#sort_by").val());
                    $('.sec_hotel_detail').html(data);
                    // console.log(data);
                });
                @endif
                $('#sec_hotel_detail').on('click','.pagination a',function (e){
                    e.preventDefault();
                    var url = $(this).attr("href");
                    $.get(url,function(data){
                        $('.sec_hotel_detail').empty();
                        $('.sec_hotel_detail').html(data);
                    });
                    // $("html, body").animate({
                    //     scrollTop: 0
                    // }, 9000);
                });
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