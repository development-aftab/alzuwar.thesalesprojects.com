@extends('website.layout.master')
    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <style>
            th.sorting.sorting_asc, td.sorting_1 {
                padding: 0px;
            }
        </style>
        @endpush



<body class="hotels transportation transportation-details cart">

    @section('content')


    <!--   <section class="transport-sec sec-4">-->
    <!--    <div class="container">-->
    <!--       <div class="row">-->
    <!--           <div class="col-md-12 col-bg-color">-->
    <!--               <form role="form" id="form_transport_details" class="margin-bottom-0">-->
    <!--    <div class="form-row d-flex" style="align-item:end;">-->
    <!--        <div class="form-group col-md-2">-->
    <!--            <div class="input-group" id="loc-from">-->
    <!--               <label for=""><i class="fas fa-map-marker-alt"></i></label>-->
    <!--                <select class="form-control" name="owner_dm">-->
    <!--                    <option value="disable">From</option>-->
    <!--                    <option value="1">Karbala</option>-->
    <!--                    <option value="1">Najaf</option>-->
    <!--                    <option value="1">Samarrah</option>-->
    <!--                    <option value="1">Kadhmain</option>-->
    <!--                    </select>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="form-group col-md-2">-->
    <!--            <div class="input-group" id="loc-from">-->
    <!--               <label for=""><i class="fas fa-map-marker-alt"></i></label>-->
    <!--                <select class="form-control" name="owner_dm">-->
    <!--                    <option value="disable">To</option>-->
    <!--                    <option value="1">Karbala</option>-->
    <!--                    <option value="1">Najaf</option>-->
    <!--                    <option value="1">Samarrah</option>-->
    <!--                    <option value="1">Kadhmain</option>-->
    <!--                    </select>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="form-group col-md-3">-->
    <!--            <div class="input-group" id="pickup-date">-->
    <!--            <label for=""><i class="fas fa-calendar-alt"></i></label>-->
    <!--<select class="form-control" name="owner_dm">-->
    <!--    <option value="">Pickup Date &amp; Time</option>-->
    <!--    <option value="1">1</option>-->
    <!--    </select>-->
    <!--                <input type="text" name="daterange" value="01/01/2018 - 01/15/2018" class="form-control" />-->
    <!--            </div>-->
    <!--        </div>-->

    <!--        <div class="col-md-3">-->
    <!--            <div class="radio_btn">-->
    <!--                          <label><input type="checkbox" checked="checked"> One way-->

    <!--</label>-->
    <!--<label><input type="checkbox"> Two way-->

    <!--</label>-->
    <!--            </div>-->

    <!--        </div>-->
    <!--        <div class="form-group col-md-2">-->
    <!--          <button class="btn book-now">Search</button>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--</form>-->

    <!--            </div>-->



    <!--       </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!--   <section class="sec-3">-->
    <!--      <div class="container">-->
    <!--         <div class="row">-->
    <!--            <div class="col-lg-6 Alziyara" data-aos="fade-right" data-aos-duration="3000">-->
    <!--               <h3>Tour Guide</h3>-->
    <!--               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt-->
    <!--                  ut labore et dolore magna aliqua.-->
    <!--               </p>-->
    <!--            </div>-->
    <!--            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="3000">-->
    <!--                <div class="hotel_bg_img">-->
    <!--               <img src="./img/transportation-bus.png" alt="Transport-service" class="img-fluid">     -->
    <!--                </div>-->

    <!--            </div>-->
    <!--         </div>-->
    <!--      </div>-->
    <!--   </section>-->
    <!------------- UMRAH PACKAGE SECTION STARTS ---------------->
    <!--   <section class="sec-4">-->
    <!--      <div class="container">-->
    <!--         <div class="row">-->
    <!--            <div class="col-md-12 pb-4">-->
    <!--               <nav aria-label="breadcrumb">-->
    <!--                  <ol class="breadcrumb">-->
    <!--                     <li class="breadcrumb-item"><a href="#">Home</a></li>-->
    <!--                     <li class="breadcrumb-item"><a href="#">Transportation</a></li>-->
    <!--                     <li class="breadcrumb-item active" aria-current="page">Karbala to Najaf</li>-->
    <!--                  </ol>-->
    <!--               </nav>-->
    <!--            </div>-->
    <!--            <div class="col-md-12">-->
    <!--               <ul class="nav nav-tabs" role="tablist">-->
    <!--                   <li class="nav-item view_all">-->
    <!--                     <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">View All</a>-->
    <!--                  </li>-->
    <!--                  <li class="nav-item">-->
    <!--                     <a class="nav-link" data-toggle="tab" href="#tabs-1" role="tab">Arabic</a>-->
    <!--                  </li>-->
    <!--                  <li class="nav-item">-->
    <!--                     <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">English</a>-->
    <!--                  </li>-->
    <!--                  <li class="nav-item">-->
    <!--                     <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Urdu</a>-->
    <!--                  </li>-->
    <!--                  <li class="nav-item">-->
    <!--                     <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Farsi</a>-->
    <!--                  </li>-->
    <!--               </ul>-->
    <!-- Tab panes -->
    <!--               <div class="tab-content">-->
    <!--                  <div class="tab-pane active" id="tabs-1" role="tabpanel">-->
    <!--                     <div class="row">-->
    <!--                        <div class="col-md-4">-->
    <!--                           <div class="card" style="width: 18re">-->
    <!--                              <a href="./tansportation-details.php"><img class="card-img-top" src="./img/bus1.png" alt="Card image cap"></a>-->
    <!--                              <div class="card-body">-->
    <!--                                  <div class="card_body_content">-->
    <!--                                    <p class="three_star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> 146 Reviews </p>-->
    <!--                                 <h3 class="card-title"> Hotel Qasr AlDur Hotel</h3>-->
    <!--                                 <ul class="list-unstyled">-->
    <!--                                    <li class="date"><i class="fas fa-bus"></i> Deluxe Bus </li>-->
    <!--                                    <li class="stay"><i class="fas fa-coffee"></i> Tea or Coffee Complimentry </li>-->
    <!--                                    <li class="house"><i class="fas fa-utensils"></i> Lunch Included </li>-->
    <!--                                    <li class="airfare"><i class="fas fa-headphones"></i> Headphones Available </li>-->
    <!--                                 </ul>  -->
    <!--                                  </div>-->
    <!--                                 <div class="final_price">-->
    <!--                                    <p class="duration"><i class="fas fa-clock"></i> Pick up Date & Time </p>-->
    <!--                                    <p> From <span> $765 </span></p>-->
    <!--                                 </div>-->
    <!--                              </div>-->
    <!--                           </div>-->
    <!--                        </div>-->
    <!--                        <div class="col-md-4">-->
    <!--                           <div class="card" style="width: 18re">-->
    <!--                              <a href="./tansportation-details.php"><img class="card-img-top" src="./img/bus1.png" alt="Card image cap"></a>-->
    <!--                              <div class="card-body">-->
    <!--                                  <div class="card_body_content">-->
    <!--                                       <p class="three_star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> 146 Reviews </p>-->
    <!--                                 <h3 class="card-title"> Hotel Qasr AlDur Hotel</h3>-->
    <!--                                 <ul class="list-unstyled">-->
    <!--                                    <li class="date"><i class="fas fa-bus"></i> Deluxe Bus </li>-->
    <!--                                    <li class="stay"><i class="fas fa-coffee"></i> Tea or Coffee Complimentry </li>-->
    <!--                                    <li class="house"><i class="fas fa-utensils"></i> Lunch Included </li>-->
    <!--                                    <li class="airfare"><i class="fas fa-headphones"></i> Headphones Available </li>-->
    <!--                                 </ul>-->
    <!--                                  </div>-->

    <!--                                 <div class="final_price">-->
    <!--                                    <p class="duration"><i class="fas fa-clock"></i> Pick up Date & Time </p>-->
    <!--                                    <p> From <span> $765 </span></p>-->
    <!--                                 </div>-->
    <!--                              </div>-->
    <!--                           </div>-->
    <!--                        </div>-->
    <!--                        <div class="col-md-4">-->
    <!--                           <div class="card" style="width: 18re">-->
    <!--                              <a href="./tansportation-details.php"><img class="card-img-top" src="./img/bus1.png" alt="Card image cap"></a>-->
    <!--                              <div class="card-body">-->
    <!--                                  <div class="card_body_content">-->
    <!--                                         <p class="three_star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> 146 Reviews </p>-->
    <!--                                 <h3 class="card-title"> Hotel Qasr AlDur Hotel</h3>-->
    <!--                                 <ul class="list-unstyled">-->
    <!--                                    <li class="date"><i class="fas fa-bus"></i> Deluxe Bus </li>-->
    <!--                                    <li class="stay"><i class="fas fa-coffee"></i> Tea or Coffee Complimentry </li>-->
    <!--                                    <li class="house"><i class="fas fa-utensils"></i> Lunch Included </li>-->
    <!--                                    <li class="airfare"><i class="fas fa-headphones"></i> Headphones Available </li>-->
    <!--                                 </ul>-->
    <!--                                  </div>-->

    <!--                                 <div class="final_price">-->
    <!--                                    <p class="duration"><i class="fas fa-clock"></i> Pick up Date & Time </p>-->
    <!--                                    <p> From <span> $765 </span></p>-->
    <!--                                 </div>-->
    <!--                              </div>-->
    <!--                           </div>-->
    <!--                        </div>-->
    <!--                        <div class="col-md-4">-->
    <!--                           <div class="card" style="width: 18re">-->
    <!--                              <a href="./tansportation-details.php"><img class="card-img-top" src="./img/bus1.png" alt="Card image cap"></a>-->
    <!--                              <div class="card-body">-->
    <!--                                  <div class="card_body_content">-->
    <!--                                      <p class="three_star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> 146 Reviews </p>-->
    <!--                                 <h3 class="card-title"> Hotel Qasr AlDur Hotel</h3>-->
    <!--                                 <ul class="list-unstyled">-->
    <!--                                    <li class="date"><i class="fas fa-bus"></i> Deluxe Bus </li>-->
    <!--                                    <li class="stay"><i class="fas fa-coffee"></i> Tea or Coffee Complimentry </li>-->
    <!--                                    <li class="house"><i class="fas fa-utensils"></i> Lunch Included </li>-->
    <!--                                    <li class="airfare"><i class="fas fa-headphones"></i> Headphones Available </li>-->
    <!--                                 </ul>-->
    <!--                                  </div>-->

    <!--                                 <div class="final_price">-->
    <!--                                    <p class="duration"><i class="fas fa-clock"></i> Pick up Date & Time </p>-->
    <!--                                    <p> From <span> $765 </span></p>-->
    <!--                                 </div>-->
    <!--                              </div>-->
    <!--                           </div>-->
    <!--                        </div>-->
    <!--                        <div class="col-md-4">-->
    <!--                           <div class="card" style="width: 18re">-->
    <!--                              <a href="./tansportation-details.php"><img class="card-img-top" src="./img/bus1.png" alt="Card image cap"></a>-->
    <!--                              <div class="card-body">-->
    <!--                                  <div class="card_body_content">-->
    <!--                                       <p class="three_star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> 146 Reviews </p>-->
    <!--                                 <h3 class="card-title"> Hotel Qasr AlDur Hotel</h3>-->
    <!--                                 <ul class="list-unstyled">-->
    <!--                                    <li class="date"><i class="fas fa-bus"></i> Deluxe Bus </li>-->
    <!--                                    <li class="stay"><i class="fas fa-coffee"></i> Tea or Coffee Complimentry </li>-->
    <!--                                    <li class="house"><i class="fas fa-utensils"></i> Lunch Included </li>-->
    <!--                                    <li class="airfare"><i class="fas fa-headphones"></i> Headphones Available </li>-->
    <!--                                 </ul>-->
    <!--                                  </div>-->

    <!--                                 <div class="final_price">-->
    <!--                                    <p class="duration"><i class="fas fa-clock"></i> Pick up Date & Time </p>-->
    <!--                                    <p> From <span> $765 </span></p>-->
    <!--                                 </div>-->
    <!--                              </div>-->
    <!--                           </div>-->
    <!--                        </div>-->
    <!--                        <div class="col-md-4">-->
    <!--                           <div class="card" style="width: 18re">-->
    <!--                              <a href="./tansportation-details.php"><img class="card-img-top" src="./img/bus1.png" alt="Card image cap"></a>-->
    <!--                              <div class="card-body">-->
    <!--                                  <div class="card_body_content">-->
    <!--                                       <p class="three_star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> 146 Reviews </p>-->
    <!--                                 <h3 class="card-title"> Hotel Qasr AlDur Hotel</h3>-->
    <!--                                 <ul class="list-unstyled">-->
    <!--                                    <li class="date"><i class="fas fa-bus"></i> Deluxe Bus </li>-->
    <!--                                    <li class="stay"><i class="fas fa-coffee"></i> Tea or Coffee Complimentry </li>-->
    <!--                                    <li class="house"><i class="fas fa-utensils"></i> Lunch Included </li>-->
    <!--                                    <li class="airfare"><i class="fas fa-headphones"></i> Headphones Available </li>-->
    <!--                                 </ul>-->
    <!--                                  </div>-->

    <!--                                 <div class="final_price">-->
    <!--                                    <p class="duration"><i class="fas fa-clock"></i> Pick up Date & Time </p>-->
    <!--                                    <p> From <span> $765 </span></p>-->
    <!--                                 </div>-->
    <!--                              </div>-->
    <!--                           </div>-->
    <!--                        </div>-->

    <!--                     </div>-->
    <!--                  </div>-->
    <!--                  <div class="tab-pane" id="tabs-2" role="tabpanel">-->
    <!--                     <p>Second Panel</p>-->
    <!--                  </div>-->
    <!--                  <div class="tab-pane" id="tabs-3" role="tabpanel">-->
    <!--                     <p>Third Panel</p>-->
    <!--                  </div>-->
    <!--                   <div class="tab-pane" id="tabs-4" role="tabpanel">-->
    <!--                     <p>Fourth Panel</p>-->
    <!--                  </div>-->
    <!--               </div>-->
    <!--            </div>-->
    <!--         </div>-->
    <!--      </div>-->
    <!--   </section>-->

	<section class="sec-3">
        <div class="modal fade refund_and_ancelations_policy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Refund & Cancelations Policy</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"><p>
                        •	We are committed to full satisfaction of our clients and will do everything possible to resolve the issue.<br>
                        •	Refunds will be issued every 15th day of month.<br>
                        •	You will be notified by email for the status of your refund.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="refund_and_ancelations_policy_accept_button" class="btn btn-primary">Accept</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 Alziyara text-center" data-aos="fade-right" data-aos-duration="3000">
                    <h3>My Bookings</h3>
                    <p></p>
                </div>
            </div>
        </div>
    </section>

    <section class="cart_s1">
        <div class="container">
            <table id="cart" class="table table-hover table-condensed">
                <thead>
                    <tr>
						<th style="width:50%">S.No</th>
						<th style="width:50%">Booked On</th>
                        <th style="width:50%">Product Image</th>
						<th style="width:50%">Recipt No</th>
						<th style="width:50%">Product Name</th>
                        <th style="width:10%">Booking Status</th>
						<th style="width:10%">Payment Status</th>
						<th style="width:10%">Reservation Date / Package Start Date</th>
                        <th style="width:10%">Price</th>
                        <th style="width:10%">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $a = 1; ?>

                    @if(isset($customerreservation))
                        @foreach($customerreservation as $mybooking)

                                <tr>
									<td>{{ $a++ }}</td>
									<td>{{$mybooking['created_at']}}</td>
                                    <td data-th="Product">
                                        <img src="{{asset('website').'/'.$mybooking['image']}}" alt="..." class="img-responsive">
                                    </td>
									<td data-th="Price"><p>{{$mybooking['reciptno']}}</p></td>
									<td data-th="Price"><p>{{$mybooking['name']}}</p></td>
                                    <td data-th="Price"><p>{{$mybooking['bookingstatus']}}</p></td>
									<td data-th="Price">@if($mybooking['paymentstatus'] == "PAID") <p> Received </p> @else <p> Not Received </p> @endif</td>
									<td data-th="Price"><p>{{date_format(date_create($mybooking['reservationdate']),"D, M d, Y ")}}</p></td>
                                    <td data-th="Price"><p>${{number_format($mybooking['price'],2, '.', ',')}}</p></td>
                                    <td class="actions" data-th="">
                                        <a type="button" href="{{$mybooking['route']}}"	class="btn btn-warning btn-md add-tooltip"><i class="fa fa-eye"></i></a>
                                        <?php
										
											$date=$mybooking['reservationdate'];
											
                                            $addeddays = date_create($date);
											
											$myaddeddays = date_format($addeddays,"Y-m-d");
											
											$mycurrentdate= date('Y-m-d');
											
											$mycurrentmyaddeddays = $mycurrentdate;
											$date1 	= date_create_from_format('Y-m-d',$myaddeddays);
											$date2 	= date_create_from_format('Y-m-d', date('Y-m-d'));
											$diff 	= $date1->diff($date2);
											
											
										?>
                                    @if($mybooking['bookingstatus'] == 'CONFIRMED' &&  $mybooking['paymentstatus'] == 'PAID')
										@if($date1 > $date2 )
											@if($diff->days >= 10)
												@if($mybooking['request_refund'] == '' )
												<p style="color: #00AEEF"> <a class="dropdown-item" id="accept_reservation" onclick="requestrefund({{$mybooking['ReservationID']}},{{$mybooking['category_id']}})" >Request Refund</a></p>
												@else
													<a style="color:green;padding: 0px" class="dropdown-item">Request Sent</a>
												@endif
											@endif
										@endif
                                    @endif

											@if(($mybooking['request_refund_reply_comments'] !=''))
												<a  class="refund_request" attr="{{$mybooking['request_refund_reply_comments']}}">See Reply</a>
											@else
											@endif




                                    </td>
                                </tr>

                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="refund_request_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Admin Reply</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p name="request_refund_reply" id="request_refund_reply"></p>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
    $('.refund_request').click(function(event) {
//        alert('abc');
//        event.preventDefault();
//        jQuery.noConflict();
        var request_refund_reply = $(this).attr('attr');
        $('#request_refund_reply').text(request_refund_reply);
        $('#refund_request_modal').modal('show');
    });
$(document).ready(function() {
			var table = $('#cart').DataTable({
				aLengthMenu: [
			  [15,25, 50,100,500, -1],
			  [15,25, 50,100,500,"All"]
				],
				iDisplayLength:15,
				stateSave: true,
				order: [0, 'asc']
				// "pageLength": 25
						//   bFilter: false,
						//   ordering: false,
						//   searching: false,
						//   dom: 't'
			});

		});
function requestrefund(ReservationID,category_id) {
    console.log(category_id);
    console.log(ReservationID);
//    event.preventDefault();
//    jQuery.noConflict();
    $('.refund_and_ancelations_policy').modal('show');
    $('#refund_and_ancelations_policy_accept_button').click(function(event) {
//        event.preventDefault();
//        jQuery.noConflict();
        $('.refund_and_ancelations_policy').modal('hide');
        swal( {
            text: "Please let us know the reason for your refund request for this order.",
            buttons: ["Cancel", "Submit my refund request"],
            content: "input",
        })
            .then((value) => {
            if (value) {
                console.log(value);
                $.get('{{ URL::to("request_refund_by_customer")}}/'+ReservationID+'/'+category_id+'/'+value,function(data){
                    console.log(data);
                    window.location.reload();
                });
                swal("Your request has been!", {
                    icon: "success",

                });
            } else {
                swal("Your request has not been sent!");
    }
    });
    });
}

</script>



@endpush