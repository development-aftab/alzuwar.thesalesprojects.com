@extends('website.layout.master')

<body class="hotels transportation package transportation-details">

    @section('content')

    <section class="transport-sec sec-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-bg-color">
                    <form role="form" id="form_transport_details" class="margin-bottom-0">
                        <div class="form-row d-flex align-items-end">
                            <div class="form-group col-md-3">
                                <div class="input-group" id="loc-from">
                                    <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                    <select class="form-control" name="owner_dm">
                                        <option value="disable">Packages Type</option>
                                        <option value="1">Package 1</option>
                                        <option value="1">Package 2</option>
                                        <option value="1">Package 3</option>
                                        <option value="1">Package 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="input-group" id="pickup-date">
                                    <label for=""><i class="fas fa-calendar-alt"></i></label>
                                    <!--<select class="form-control" name="owner_dm">-->
                                    <!--    <option value="">Pickup Date &amp; Time</option>-->
                                    <!--    <option value="1">1</option>-->
                                    <!--    </select>-->
                                    <input type="text" name="daterange" value="01/01/2018 - 01/15/2018"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="input-group" id="one-way">
                                    <label for=""><i class="fas fa-user-friends"></i></label>
                                    <select class="form-control" name="owner_dm">
                                        <option value="">People</option>
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
                                        <option value="1">5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <button class="btn book-now check_avail">Search</button>
                            </div>
                        </div>
                    </form>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Guest Passes</a></li>
                            <li class="breadcrumb-item"><a href="#"> Iraq Packages </a></li>
                            <li class="breadcrumb-item"><a href="#">Iraq</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ashura in Karbala 1443 Hijri</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-7">
                    <div class="card-deck">
                        <img src="{{asset('website').'/'.$guestPass->getGuestPassDetails[0]->PhotoLocation}}" alt=""
                            class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-5 transportation-imgs">
                    <div class="row no-gutters">
                        <div class="col-md-12 pb-4">
                            <h2>{{$guestPass->GuestPassName}}</h2>
                            <p><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                <i class="fas fa-star"></i><i class="fas fa-star"></i> 146 Reviews
                            </p>
                            <h4>{{$guestPass->GuestPassLocation}}</h4>
                            <a id="addtocart" data-toggle="modal" data-target="#guestpass" class="btn cartwork">Book
                                Now</a>
                        </div>

                        <div class="col-md-6">
                            @foreach($guestPass->getGuestPassDetails as $key=>$getGuestPassDetail)
                            <div class="cards">
                                <img src="{{asset('website').'/'.$getGuestPassDetail->PhotoLocation}}"
                                    alt="{{$getGuestPassDetail->AltText}}" class="img-fluid">
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                <div class="package_detail_link">
                    <span class="jump_to">Jump to:</span>
                    <a href="#!">Itinerary,</a>
                    <a href="#!">Description,</a>
                    <a href="#!">Reviews</a>
                </div>
            </div>
        </div>
    </section>
    <section class="itinerary">
        <div class="container">
            <div class="row">
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
                                            <li><span class="check_icon"><i
                                                        class="fas fa-check"></i>{{date("g:iA", strtotime($getGuestPassDetail->GuestProDetailTime))}}</span>
                                                <span
                                                    class="updated_to_be">{{$getGuestPassDetail->GuestProDetailDis}}</span>
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
            <div class="row">
                <div class="col-md-12">
                    <h3 class="review-title">Description</h3>
                    <p class="review-para">{{$guestPass->GuestPassDesc}}
                    </p>

                </div>
            </div>
            <div class="row">
                <h3 class="review-title">Reviews</h3>
                @foreach($guestPass->getGuestPassreviewdetails as $key=>$getGuestPassreviewDetail)
                    @if($getGuestPassreviewDetail->ReviewerName != "Admin")
                    <div class="col-md-12">
                        <div class="review-one">
                            <h5 class="rating">@for( $a=1 ; $a <= $getGuestPassreviewDetail->Rating ; $a++ )<i
                                        class="fas fa-star"></i>@endfor
                                    <span>Review {{$getGuestPassreviewDetail->created_at->diffForHumans()}}</span></h5>
                            <p class="review-para">{{$getGuestPassreviewDetail->Description}}</p>
                            <h4>{{$getGuestPassreviewDetail->ReviewerName}} - Australia</h4>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="modal fade" id="guestpass">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div id="loader"></div>
                    <div class="modal-header">
                        <h4 class="modal-title">Guest Pass Order</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        
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
                                    <lable for="addSDphone">Guest Pass Booking Date</label>
                                        <div id="sandbox-container">
                                            <input type="text" id="" name="date" class="form-control datepicker"
                                                data-provide="datepicker" placeholder="Guest Pass Select Date" value=""
                                                required  readonly />
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
                                                <option value='5'>Thursday</option>

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
                                                <option value='1'>Sunday </option>

                                                <script>
                                                //  days.push(1); 

                                                var removeItem = 0;

                                                y = jQuery.grep(y, function(value) {
                                                    return value != removeItem;
                                                });
                                                </script>
                                                @endif
                                                @endforeach
                                                
                                                <lable for="addSDphone">Quantity</label>
                                                <input class="form-control" type="number" name="quantity" value="0" />

                                           
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