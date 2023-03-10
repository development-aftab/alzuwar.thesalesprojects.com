@extends('layouts.master')



@push('css')

@endpush



@section('content')

<div class="container-fluid">

    <!-- .row -->

    <div class="row">

        <div class="col-sm-12">

            <div class="white-box">

                <h3 class="box-title m-b-0">Transport Reservation Details</h3>
				
				<br/>

                <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->

                <form  class="form-horizontal" >
                
					<?php   //print_r($guestpassreserves); die; ?>
					
					
                    <div class="form-group">

                        <label class="col-md-2">Reservation Name</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassName" class="form-control"  value="{{$transportreserves->getTransportOrders->NameofVehicle}}">
						</div>
						
						<label class="col-md-2" >Reservation Receipt No</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassLocation" class="form-control"  value="{{$transportreserves->ReceiptNum??""}}"> 

                        </div>

                    </div>
					
					<?php

							
						
							if(($transportreserves->Insurance == 1) && ($transportreserves->Donation == 0)){
								
								$finalprice = 0;
								
								$finalprice = $transportreserves->TotalPrice - 10;
								
							}elseif(($transportreserves->Donation == 1) && ($transportreserves->Insurance == 0)){
								
								$finalprice = 0;
							
								$finalprice = $transportreserves->TotalPrice - $transportreserves->Donation_amount;
							
							}elseif(($transportreserves->Insurance == 1) && ($transportreserves->Insurance == 1) ){
								
								$finalprice = 0;
							
								$finalprice = $transportreserves->TotalPrice - $transportreserves->Donation_amount - 10;
								
							}else{
								
								$finalprice = 0;
								
								$finalprice = $transportreserves->TotalPrice;
								
							}
							
							// $myjourneyarray = array($transportreserves->PickupLocation,$transportreserves->DropOffLocation);
							
							// $myjourney = implode('to',$myjourneyarray);
								
						?> 
						
					<div class="form-group">

                        <label class="col-md-2">Pick Up Time</label>

                        <div class="col-md-4">

                            <input type="text" name="Price" class="form-control" value="{{$transportreserves->PickUpDateTime}}">

                         </div>
						 
						 <label class="col-md-2">Drop Off Time</label>

                        <div class="col-md-4">

                            <input type="text" class="form-control" name="MaxOccupancy"  value="{{$transportreserves->DropOffDateTime}}"> 

                        </div>

                    </div>
					
					<div class="form-group">

                        <label class="col-md-2">Pick Up Location</label>

                        <div class="col-md-4">

                            <input type="text" name="Price" class="form-control" value="{{$transportreserves->PickupLocation}}">

                         </div>
						 
						 <label class="col-md-2">Drop Off Location</label>

                        <div class="col-md-4">

                            <input type="text" class="form-control" name="MaxOccupancy"  value="{{$transportreserves->DropOffLocation}}"> 

                        </div>

                    </div>
					
					<div class="form-group">

                        <label class="col-md-2">Trip Type</label>

                        <div class="col-md-4">

                            <input type="text" name="Price" class="form-control" value="{{$transportreserves->triptype}}">

                         </div>
						 
						 <label class="col-md-2">Reservation Vendor/Service OR Customer Status</label>

                        <div class="col-md-4">

                            <input type="text" class="form-control" name="MaxOccupancy"  value="{{$transportreserves->reservation_status}}"> 

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-md-2">Reservation Amount</label>

                        <div class="col-md-4">

                            <input type="text" name="Price" class="form-control" value=" $ {{$finalprice}}">

                         </div>
						 
						 <label class="col-md-2">Number of Days of Trip</label>

                        <div class="col-md-4">

                            <input type="text" class="form-control" name="MaxOccupancy"  value="{{$transportreserves->noofdaysqty}}"> 

                        </div>

                    </div>
					
					<div class="form-group">

                        <label class="col-md-2">Reservation Journey</label>

                        <div class="col-md-4">

                            <input type="text" name="Price" class="form-control" value="{{$transportreserves->getTransportmainrouteforreservation->RouteName}}">

                         </div>
						 
						 <label class="col-md-2">Reservation Status</label>

                        <div class="col-md-4">

                            <input type="text" class="form-control" name="MaxOccupancy"  value="{{$transportreserves->ReservationStatus}}"> 

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-md-2">Reservation Transport Driver Name</label>

                        <div class="col-md-4">

                             <input type="text" class="form-control" name="MaxOccupancy"  value="{{$transportreserves->getTransportOrders->DriverName}}">
							 
                        </div>

                        <label class="col-md-2">Reservation Payment Status</label>

                        <div class="col-md-4">
						
							<input type="text" class="form-control" name="MaxOccupancy"  value="{{$transportreserves->PaymentStatus}}">

                        </div>

                    </div>
					
					<div class="form-group">

                        <label class="col-md-2">Reservation Customer Name</label>

                        <div class="col-md-4">

                             <input type="text" class="form-control" name="Customer Name"  value="{{$transportreserves->getTransportOrdersbyuser->name}}">
							 
                        </div>

                        <label class="col-md-2">Reservation Customer Email</label>

                        <div class="col-md-4">
						
							<input type="text" class="form-control" name="Customer Email"  value="{{$transportreserves->getTransportOrdersbyuser->email}}">

                        </div>

                    </div>
					
					<div class="form-group">

                        <label class="col-md-2">Reservation Customer Phone</label>

                        <div class="col-md-4">

                             <input type="text" class="form-control" name="Customer Phone"  value="+{{$transportreserves->getTransportOrdersbyuserprofile->country}} - {{$transportreserves->getTransportOrdersbyuserprofile->phone}}">
							 
                        </div>
					
					
                        <label class="col-md-2">Reservation Customer Country</label>

                        <div class="col-md-4">
						
							
								@if($transportreserves->getTransportOrdersbyuserprofile->country =="")
        
                                        <p>Select Country</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="213")
                                        
                                        <p>Algeria (+213)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="376")
                                        
                                        <p>Andorra (+376)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="244")
                                        
                                        <p>Angola (+244)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="1264")
                                        
                                        <p>Anguilla (+1264)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="1268")
                                        
                                        <p>Antigua &amp; Barbuda (+1268)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="54")
                                        
                                        <p>Argentina (+54)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="374")
                                        
                                        <p>Armenia (+374)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="297")
                                        
                                        <p>Aruba (+297)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="61")
                                        
                                        <p>Australia (+61)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="43")
                                        
                                        <p>Austria (+43)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="994")
                                        
                                        <p>Azerbaijan (+994)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="1242")
                                        
                                        <p>Bahamas (+1242)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="973")
                                        
                                        <p>Bahrain (+973)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="880")
                                        
                                        <p>Bangladesh (+880)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="1246")
                                        
                                        <p>Barbados (+1246)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="375")
                                        
                                        <p>Belarus (+375)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="32")
                                        
                                        <p>Belgium (+32)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="501")
                                        
                                        <p>Belize (+501)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="229")
                                        
                                        <p>Benin (+229)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="1441")
                                        
                                        <p>Bermuda (+1441)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="975")
                                        
                                        <p>Bhutan (+975)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="591")
                                        
                                        <p>Bolivia (+591)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="387")
                                        
                                        <p>Bosnia Herzegovina (+387)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="267")
                                        
                                        <p>Botswana (+267)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="55")
                                        
                                        <p>Brazil (+55)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="673")
                                        
                                        <p>Brunei (+673)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="359")
                                        
                                        <p>Bulgaria (+359)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="226")
                                        
                                        <p>Burkina Faso (+226)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="257")
                                        
                                        <p>Burundi (+257)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="855")
                                        
                                        <p>Cambodia (+855)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="237")
                                        
                                        <p>Cameroon (+237)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="1")
                                        
                                        <p>Canada (+1)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="238")
                                        
                                        <p>Cape Verde Islands (+238)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="1345")
                                        
                                        <p>Cayman Islands (+1345)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="236")
                                        
                                        <p>Central African Republic (+236)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="56")
                                        
                                        <p>Chile (+56)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="86")
                                        
                                        <p>China (+86)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="57")
                                        
                                        <p>Colombia (+57)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="269")
                                        
                                        <p>Comoros (+269)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="242")
                                        
                                        <p>Congo (+242)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="682")
                                        
                                        <p>Cook Islands (+682)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="506")
                                        
                                        <p>Costa Rica (+506)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="385")
                                        
                                        <p>Croatia (+385)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="53")
                                        
                                        <p>Cuba (+53)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="90392")
                                        
                                        <p>Cyprus North (+90392)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="357")
                                        
                                        <p>Cyprus South (+357)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="42")
                                        
                                        <p>Czech Republic (+42)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="45")
                                        
                                        <p>Denmark (+45)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="253")
                                        
                                        <p>Djibouti (+253)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="1809")
                                        
                                        <p>Dominica (+1809)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="1809")
                                        
                                        <p>Dominican Republic (+1809)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="593")
                                        
                                        <p>Ecuador (+593)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="20")
                                        
                                        <p>Egypt (+20)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="503")
                                        
                                        <p>El Salvador (+503)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="240")
                                        
                                        <p>Equatorial Guinea (+240)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="291")
                                        
                                        <p>Eritrea (+291)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="372")
                                        
                                        <p>Estonia (+372)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="251")
                                        
                                        <p>Ethiopia (+251)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="500")
                                        
                                        <p>Falkland Islands (+500)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="298")
                                        
                                        <p>Faroe Islands (+298)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="679")
                                        
                                        <p>Fiji (+679)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="358")
                                        
                                        <p>Finland (+358)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="33")
                                        
                                        <p>France (+33)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="594")
                                        
                                        <p>French Guiana (+594)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="689")
                                        
                                        <p>French Polynesia (+689)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="241")
                                        
                                        <p>Gabon (+241)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="220")
                                        
                                        <p>Gambia (+220)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="7880")
                                        
                                        <p>Georgia (+7880)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="49")
                                        
                                        <p>Germany (+49)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="233")
                                        
                                        <p>Ghana (+233)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="350")
                                        
                                        <p>Gibraltar (+350)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="30")
                                        
                                        <p>Greece (+30)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="299")
                                        
                                        <p>Greenland (+299)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="1473")
                                        
                                        <p>Grenada (+1473)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="590")
                                        
                                        <p>Guadeloupe (+590)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="671")
                                        
                                        <p>Guam (+671)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="502")
                                        
                                        <p>Guatemala (+502)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="224")
                                        
                                        <p>Guinea (+224)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="245")
                                        
                                        <p>Guinea - Bissau (+245)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="592")
                                        
                                        <p>Guyana (+592)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="509")
                                        
                                        <p>Haiti (+509)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="504")
                                        
                                        <p>Honduras (+504)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="852")
                                        
                                        <p>Hong Kong (+852)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="36")
                                        
                                        <p>Hungary (+36)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="354")
                                        
                                        <p>Iceland (+354)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="91")
                                        
                                        <p>India (+91)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="62")
                                        
                                        <p>Indonesia (+62)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="98")
                                        
                                        <p>Iran (+98)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="964")
                                        
                                        <p>Iraq (+964)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="353")
                                        
                                        <p>Ireland (+353)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="972")
                                        
                                        <p>Israel (+972)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="39")
                                        
                                        <p>Italy (+39)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="1876")
                                        
                                        <p>Jamaica (+1876)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="81")
                                        
                                        <p>Japan (+81)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="962")
                                        
                                        <p>Jordan (+962)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="7")
                                        
                                        <p>Kazakhstan (+7)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="254")
                                        
                                        <p>Kenya (+254)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="686")
                                        
                                        <p>Kiribati (+686)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="850")
                                        
                                        <p>Korea North (+850)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="82")
                                        
                                        <p>Korea South (+82)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="965")
                                        
                                        <p>Kuwait (+965)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="996")
                                        
                                        <p>Kyrgyzstan (+996)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="856")
                                        
                                        <p>Laos (+856)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="371")
                                        
                                        <p>Latvia (+371)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="961")
                                        
                                        <p>Lebanon (+961)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="266")
                                        
                                        <p>Lesotho (+266)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="231")
                                        
                                        <p>Liberia (+231)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="218")
                                        
                                        <p>Libya (+218)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="417")
                                        
                                        <p>Liechtenstein (+417)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="370")
                                        
                                        <p>Lithuania (+370)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="352")
                                        
                                        <p>Luxembourg (+352)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="853")
                                        
                                        <p>Macao (+853)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="389")
                                        
                                        <p>Macedonia (+389)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="261")
                                        
                                        <p>Madagascar (+261)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="265")
                                        
                                        <p>Malawi (+265)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="60")
                                        
                                        <p>Malaysia (+60)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="960")
                                        
                                        <p>Maldives (+960)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="223")
                                        
                                        <p>Mali (+223)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="356")
                                        
                                        <p>Malta (+356)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="692")
                                        
                                        <p>Marshall Islands (+692)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="596")
                                        
                                        <p>Martinique (+596)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="222")
                                        
                                        <p>Mauritania (+222)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="269")
                                        
                                        <p>Mayotte (+269)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="52")
                                        
                                        <p>Mexico (+52)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="691")
                                        
                                        <p>Micronesia (+691)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="373")
                                        
                                        <p>Moldova (+373)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="377")
                                        
                                        <p>Monaco (+377)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="976")
                                        
                                        <p>Mongolia (+976)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="1664")
                                        
                                        <p>Montserrat (+1664)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="212")
                                        
                                        <p>Morocco (+212)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="258")
                                        
                                        <p>Mozambique (+258)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="95")
                                        
                                        <p>Myanmar (+95)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="264")
                                        
                                        <p>Namibia (+264)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="674")
                                        
                                        <p>Nauru (+674)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="977")
                                        
                                        <p>Nepal (+977)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="31")
                                        
                                        <p>Netherlands (+31)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="687")
                                        
                                        <p>New Caledonia (+687)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="64")
                                        
                                        <p>New Zealand (+64)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="505")
                                        
                                        <p>Nicaragua (+505)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="227")
                                        
                                        <p>Niger (+227)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="234")
                                        
                                        <p>Nigeria (+234)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="683")
                                        
                                        <p>Niue (+683)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="672")
                                        
                                        <p>Norfolk Islands (+672)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="670")
                                        
                                        <p>Northern Marianas (+670)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="47")
                                        
                                        <p>Norway (+47)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="968")
                                        
                                        <p>Oman (+968)</p>
										
								 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="970")
                                        
                                        <p>Palestine (+970)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="680")
                                        
                                        <p>Palau (+680)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="92")
                                        
                                        <p>Pakistan (+92)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="507")
                                        
                                        <p>Panama (+507)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="675")
                                        
                                        <p>Papua New Guinea (+675)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="595")
                                        
                                        <p>Paraguay (+595)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="51")
                                        
                                        <p>Peru (+51)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="63")
                                        
                                        <p>Philippines (+63)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="48")
                                        
                                        <p>Poland (+48)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="351")
                                        
                                        <p>Portugal (+351)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="1787")
                                        
                                        <p>Puerto Rico (+1787)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="974")
                                        
                                        <p>Qatar (+974)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="262")
                                        
                                        <p>Reunion (+262)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="40")
                                        
                                        <p>Romania (+40)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="7")
                                        
                                        <p>Russia (+7)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="250")
                                        
                                        <p>Rwanda (+250)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="378")
                                        
                                        <p>San Marino (+378)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="239")
                                        
                                        <p>Sao Tome &amp; Principe (+239)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="966")
                                        
                                        <p>Saudi Arabia (+966)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="221")
                                        
                                        <p>Senegal (+221)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="381")
                                        
                                        <p>Serbia (+381)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="248")
                                        
                                        <p>Seychelles (+248)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="232")
                                        
                                        <p>Sierra Leone (+232)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="65")
                                        
                                        <p>Singapore (+65)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="421")
                                        
                                        <p>Slovak Republic (+421)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="386")
                                        
                                        <p>Slovenia (+386)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="677")
                                        
                                        <p>Solomon Islands (+677)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="252")
                                        
                                        <p>Somalia (+252)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="27")
                                        
                                        <p>South Africa (+27)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="34")
                                        
                                        <p>Spain (+34)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="94")
                                        
                                        <p>Sri Lanka (+94)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="290")
                                        
                                        <p>St. Helena (+290)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="1869")
                                        
                                        <p>St. Kitts (+1869)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="1758")
                                        
                                        <p>St. Lucia (+1758)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="249")
                                        
                                        <p>Sudan (+249)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="597")
                                        
                                        <p>Suriname (+597)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="268")
                                        
                                        <p>Swaziland (+268)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="46")
                                        
                                        <p>Sweden (+46)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="41")
                                        
                                        <p>Switzerland (+41)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="963")
                                        
                                        <p>Syria (+963)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="886")
                                        
                                        <p>Taiwan (+886)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="7")
                                        
                                        <p>Tajikstan (+7)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="66")
                                        
                                        <p>Thailand (+66)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="228")
                                        
                                        <p>Togo (+228)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="676")
                                        
                                        <p>Tonga (+676)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="1868")
                                        
                                        <p>Trinidad &amp; Tobago (+1868)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="216")
                                        
                                        <p>Tunisia (+216)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="90")
                                        
                                        <p>Turkey (+90)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="7")
                                        
                                        <p>Turkmenistan (+7)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="993")
                                        
                                        <p>Turkmenistan (+993)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="1649")
                                        
                                        <p>Turks &amp; Caicos Islands (+1649)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="688")
                                        
                                        <p>Tuvalu (+688)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="256")
                                        
                                        <p>Uganda (+256)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="44")
                                        
                                        <p>UK (+44)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="380")
                                        
                                        <p>Ukraine (+380)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="971")
                                        
                                        <p>United Arab Emirates (+971)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="598")
                                        
                                        <p>Uruguay (+598)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="1")
                                        
                                        <p>USA (+1)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="7")
                                        
                                        <p>Uzbekistan (+7)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="678")
                                        
                                        <p>Vanuatu (+678)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="379")
                                        
                                        <p>Vatican City (+379)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="58")
                                        
                                        <p>Venezuela (+58)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="84")
                                        
                                        <p>Vietnam (+84)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="84")
                                        
                                        <p>Virgin Islands - British (+1284)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="84")
                                        
                                        <p>Virgin Islands - US (+1340)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="681")
                                        
                                        <p>Wallis &amp; Futuna (+681)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="969")
                                        
                                        <p>Yemen (North)(+969)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="967")
                                        
                                        <p>Yemen (South)(+967)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="260")
                                        
                                        <p>Zambia (+260)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofile->country =="263")
                                        
                                        <p>Zimbabwe (+263)</p>
                                @endif


                        </div>

                    </div>
					
					
                    <div class="form-group">

                        <label class="col-md-12">Reservation Customer Notes</label>

                        <div class="col-md-12">

                            <textarea class="form-control" name="HouseRules" rows="5">{{$transportreserves->NotesByCustomer}}</textarea>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-md-12">Reservation Created Time</label>

                        <div class="col-md-12">

                            <input type="datetime" class="form-control" name="GuestPassendTime" placeholder="GuestPass Time" value="{{$transportreserves->updated_at}}"> 

                        </div>

                    </div>

            </div>

        </div>

    </div>

<!-- ===== Right-Sidebar ===== -->

@include('layouts.partials.right-sidebar')

</div>

@endsection
