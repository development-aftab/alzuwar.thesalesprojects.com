@extends('layouts.master')



@push('css')

@endpush



@section('content')

<div class="container-fluid">

    <!-- .row -->

    <div class="row">

        <div class="col-sm-12">

            <div class="white-box">

                <h3 class="box-title m-b-0">Room Reservation Details</h3>
				
				<br/>

                <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->

                <form  class="form-horizontal" >
                
					<?php   //print_r($guestpassreserves); die; ?>
					
					
                    <div class="form-group">

                        <label class="col-md-2">Reservation Hotel Name</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassName" class="form-control"  value="{{$roomreserves->getReservationOrdersproperty[0]->Name??""}}">
						</div>
						
						<label class="col-md-2" >Reservation Receipt No</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassLocation" class="form-control"  value="{{$roomreserves->ReceiptNum??""}}"> 

                        </div>

                    </div>
					
					<div class="form-group">

                        <label class="col-md-2">Reservation Room Type</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassName" class="form-control"  value="{{$roomreserves->getReservationOrdersroom->RoomType??""}}">
						</div>
						
						<label class="col-md-2" >Reservation Room Name</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassLocation" class="form-control"  value="{{$roomreserves->getReservationOrdersroom->RoomName??""}}"> 

                        </div>

                    </div>
					
					<?php

							
						
							if(($roomreserves->Insurance == 1) && ($roomreserves->Donation == 0)){
								
								$finalprice = 0;
								
								$finalprice = $roomreserves->TotalPrice - 10;
								
							}elseif(($roomreserves->Donation == 1) && ($roomreserves->Insurance == 0)){
								
								$finalprice = 0;
							
								$finalprice = $roomreserves->TotalPrice - $roomreserves->Donation_amount;
							
							}elseif(($roomreserves->Insurance == 1) && ($roomreserves->Insurance == 1) ){
								
								$finalprice = 0;
							
								$finalprice = $roomreserves->TotalPrice - $roomreserves->Donation_amount - 10;
								
							}else{
								
								$finalprice = 0;
								
								$finalprice = $roomreserves->TotalPrice;
								
							}
								
						?>

                    <div class="form-group">

                        <label class="col-md-2">Reservation Amount</label>

                        <div class="col-md-4">

                            <input type="text" name="Price" class="form-control" value=" $ {{$finalprice}}">

                         </div>
						 
						 <label class="col-md-2">Reservation Quantity</label>

                        <div class="col-md-4">

                            <input type="text" class="form-control" name="MaxOccupancy"  value="{{$roomreserves->qty}}"> 

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-md-2">Reservation Date</label>

                        <div class="col-md-4">

                             <input type="text" class="form-control" name="MaxOccupancy"  value="{{$roomreserves->CreateDate}}">
							 
                        </div>

                        <label class="col-md-2">Reservation Payment Status</label>

                        <div class="col-md-4">
						
							<input type="text" class="form-control" name="MaxOccupancy"  value="{{$roomreserves->PaymentStatus}}">

                        </div>

                    </div>
					
					<div class="form-group">

                        <label class="col-md-2">Check In</label>

                        <div class="col-md-4">

                             <input type="text" class="form-control" name="MaxOccupancy"  value="{{$roomreserves->checkin}}">
							 
                        </div>

                        <label class="col-md-2">Check Out</label>

                        <div class="col-md-4">
						
							<input type="text" class="form-control" name="MaxOccupancy"  value="{{$roomreserves->checkout}}">

                        </div>

                    </div>
					
					<div class="form-group">

                        <label class="col-md-2">Reservation Customer Name</label>

                        <div class="col-md-4">

                             <input type="text" class="form-control" name="Customer Name"  value="{{$roomreserves->getRoomOrdersbyuser->name}}">
							 
                        </div>

                        <label class="col-md-2">Reservation Customer Email</label>

                        <div class="col-md-4">
						
							<input type="text" class="form-control" name="Customer Email"  value="{{$roomreserves->getRoomOrdersbyuser->email}}">

                        </div>

                    </div>
					
					<div class="form-group">

                        <label class="col-md-2">Reservation Customer Phone</label>

                        <div class="col-md-4">

                             <input type="text" class="form-control" name="Customer Phone"  value="+{{$roomreserves->getRoomOrdersbyuserprofile->country}} - {{$roomreserves->getRoomOrdersbyuserprofile->phone}}">
							 
                        </div>

                        <label class="col-md-2">Reservation Customer Country</label>

                        <div class="col-md-4">
						
							@if($roomreserves->getRoomOrdersbyuserprofile->country =="")
        
                                        <p>Select Country</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="213")
                                        
                                        <p>Algeria (+213)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="376")
                                        
                                        <p>Andorra (+376)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="244")
                                        
                                        <p>Angola (+244)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="1264")
                                        
                                        <p>Anguilla (+1264)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="1268")
                                        
                                        <p>Antigua &amp; Barbuda (+1268)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="54")
                                        
                                        <p>Argentina (+54)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="374")
                                        
                                        <p>Armenia (+374)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="297")
                                        
                                        <p>Aruba (+297)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="61")
                                        
                                        <p>Australia (+61)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="43")
                                        
                                        <p>Austria (+43)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="994")
                                        
                                        <p>Azerbaijan (+994)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="1242")
                                        
                                        <p>Bahamas (+1242)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="973")
                                        
                                        <p>Bahrain (+973)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="880")
                                        
                                        <p>Bangladesh (+880)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="1246")
                                        
                                        <p>Barbados (+1246)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="375")
                                        
                                        <p>Belarus (+375)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="32")
                                        
                                        <p>Belgium (+32)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="501")
                                        
                                        <p>Belize (+501)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="229")
                                        
                                        <p>Benin (+229)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="1441")
                                        
                                        <p>Bermuda (+1441)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="975")
                                        
                                        <p>Bhutan (+975)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="591")
                                        
                                        <p>Bolivia (+591)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="387")
                                        
                                        <p>Bosnia Herzegovina (+387)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="267")
                                        
                                        <p>Botswana (+267)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="55")
                                        
                                        <p>Brazil (+55)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="673")
                                        
                                        <p>Brunei (+673)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="359")
                                        
                                        <p>Bulgaria (+359)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="226")
                                        
                                        <p>Burkina Faso (+226)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="257")
                                        
                                        <p>Burundi (+257)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="855")
                                        
                                        <p>Cambodia (+855)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="237")
                                        
                                        <p>Cameroon (+237)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="1")
                                        
                                        <p>Canada (+1)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="238")
                                        
                                        <p>Cape Verde Islands (+238)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="1345")
                                        
                                        <p>Cayman Islands (+1345)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="236")
                                        
                                        <p>Central African Republic (+236)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="56")
                                        
                                        <p>Chile (+56)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="86")
                                        
                                        <p>China (+86)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="57")
                                        
                                        <p>Colombia (+57)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="269")
                                        
                                        <p>Comoros (+269)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="242")
                                        
                                        <p>Congo (+242)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="682")
                                        
                                        <p>Cook Islands (+682)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="506")
                                        
                                        <p>Costa Rica (+506)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="385")
                                        
                                        <p>Croatia (+385)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="53")
                                        
                                        <p>Cuba (+53)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="90392")
                                        
                                        <p>Cyprus North (+90392)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="357")
                                        
                                        <p>Cyprus South (+357)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="42")
                                        
                                        <p>Czech Republic (+42)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="45")
                                        
                                        <p>Denmark (+45)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="253")
                                        
                                        <p>Djibouti (+253)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="1809")
                                        
                                        <p>Dominica (+1809)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="1809")
                                        
                                        <p>Dominican Republic (+1809)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="593")
                                        
                                        <p>Ecuador (+593)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="20")
                                        
                                        <p>Egypt (+20)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="503")
                                        
                                        <p>El Salvador (+503)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="240")
                                        
                                        <p>Equatorial Guinea (+240)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="291")
                                        
                                        <p>Eritrea (+291)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="372")
                                        
                                        <p>Estonia (+372)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="251")
                                        
                                        <p>Ethiopia (+251)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="500")
                                        
                                        <p>Falkland Islands (+500)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="298")
                                        
                                        <p>Faroe Islands (+298)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="679")
                                        
                                        <p>Fiji (+679)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="358")
                                        
                                        <p>Finland (+358)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="33")
                                        
                                        <p>France (+33)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="594")
                                        
                                        <p>French Guiana (+594)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="689")
                                        
                                        <p>French Polynesia (+689)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="241")
                                        
                                        <p>Gabon (+241)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="220")
                                        
                                        <p>Gambia (+220)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="7880")
                                        
                                        <p>Georgia (+7880)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="49")
                                        
                                        <p>Germany (+49)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="233")
                                        
                                        <p>Ghana (+233)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="350")
                                        
                                        <p>Gibraltar (+350)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="30")
                                        
                                        <p>Greece (+30)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="299")
                                        
                                        <p>Greenland (+299)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="1473")
                                        
                                        <p>Grenada (+1473)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="590")
                                        
                                        <p>Guadeloupe (+590)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="671")
                                        
                                        <p>Guam (+671)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="502")
                                        
                                        <p>Guatemala (+502)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="224")
                                        
                                        <p>Guinea (+224)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="245")
                                        
                                        <p>Guinea - Bissau (+245)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="592")
                                        
                                        <p>Guyana (+592)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="509")
                                        
                                        <p>Haiti (+509)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="504")
                                        
                                        <p>Honduras (+504)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="852")
                                        
                                        <p>Hong Kong (+852)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="36")
                                        
                                        <p>Hungary (+36)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="354")
                                        
                                        <p>Iceland (+354)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="91")
                                        
                                        <p>India (+91)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="62")
                                        
                                        <p>Indonesia (+62)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="98")
                                        
                                        <p>Iran (+98)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="964")
                                        
                                        <p>Iraq (+964)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="353")
                                        
                                        <p>Ireland (+353)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="972")
                                        
                                        <p>Israel (+972)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="39")
                                        
                                        <p>Italy (+39)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="1876")
                                        
                                        <p>Jamaica (+1876)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="81")
                                        
                                        <p>Japan (+81)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="962")
                                        
                                        <p>Jordan (+962)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="7")
                                        
                                        <p>Kazakhstan (+7)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="254")
                                        
                                        <p>Kenya (+254)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="686")
                                        
                                        <p>Kiribati (+686)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="850")
                                        
                                        <p>Korea North (+850)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="82")
                                        
                                        <p>Korea South (+82)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="965")
                                        
                                        <p>Kuwait (+965)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="996")
                                        
                                        <p>Kyrgyzstan (+996)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="856")
                                        
                                        <p>Laos (+856)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="371")
                                        
                                        <p>Latvia (+371)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="961")
                                        
                                        <p>Lebanon (+961)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="266")
                                        
                                        <p>Lesotho (+266)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="231")
                                        
                                        <p>Liberia (+231)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="218")
                                        
                                        <p>Libya (+218)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="417")
                                        
                                        <p>Liechtenstein (+417)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="370")
                                        
                                        <p>Lithuania (+370)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="352")
                                        
                                        <p>Luxembourg (+352)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="853")
                                        
                                        <p>Macao (+853)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="389")
                                        
                                        <p>Macedonia (+389)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="261")
                                        
                                        <p>Madagascar (+261)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="265")
                                        
                                        <p>Malawi (+265)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="60")
                                        
                                        <p>Malaysia (+60)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="960")
                                        
                                        <p>Maldives (+960)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="223")
                                        
                                        <p>Mali (+223)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="356")
                                        
                                        <p>Malta (+356)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="692")
                                        
                                        <p>Marshall Islands (+692)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="596")
                                        
                                        <p>Martinique (+596)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="222")
                                        
                                        <p>Mauritania (+222)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="269")
                                        
                                        <p>Mayotte (+269)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="52")
                                        
                                        <p>Mexico (+52)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="691")
                                        
                                        <p>Micronesia (+691)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="373")
                                        
                                        <p>Moldova (+373)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="377")
                                        
                                        <p>Monaco (+377)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="976")
                                        
                                        <p>Mongolia (+976)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="1664")
                                        
                                        <p>Montserrat (+1664)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="212")
                                        
                                        <p>Morocco (+212)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="258")
                                        
                                        <p>Mozambique (+258)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="95")
                                        
                                        <p>Myanmar (+95)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="264")
                                        
                                        <p>Namibia (+264)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="674")
                                        
                                        <p>Nauru (+674)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="977")
                                        
                                        <p>Nepal (+977)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="31")
                                        
                                        <p>Netherlands (+31)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="687")
                                        
                                        <p>New Caledonia (+687)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="64")
                                        
                                        <p>New Zealand (+64)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="505")
                                        
                                        <p>Nicaragua (+505)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="227")
                                        
                                        <p>Niger (+227)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="234")
                                        
                                        <p>Nigeria (+234)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="683")
                                        
                                        <p>Niue (+683)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="672")
                                        
                                        <p>Norfolk Islands (+672)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="670")
                                        
                                        <p>Northern Marianas (+670)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="47")
                                        
                                        <p>Norway (+47)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="968")
                                        
                                        <p>Oman (+968)</p>
										
								 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="970")
                                        
                                        <p>Palestine (+970)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="680")
                                        
                                        <p>Palau (+680)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="92")
                                        
                                        <p>Pakistan (+92)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="507")
                                        
                                        <p>Panama (+507)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="675")
                                        
                                        <p>Papua New Guinea (+675)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="595")
                                        
                                        <p>Paraguay (+595)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="51")
                                        
                                        <p>Peru (+51)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="63")
                                        
                                        <p>Philippines (+63)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="48")
                                        
                                        <p>Poland (+48)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="351")
                                        
                                        <p>Portugal (+351)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="1787")
                                        
                                        <p>Puerto Rico (+1787)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="974")
                                        
                                        <p>Qatar (+974)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="262")
                                        
                                        <p>Reunion (+262)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="40")
                                        
                                        <p>Romania (+40)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="7")
                                        
                                        <p>Russia (+7)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="250")
                                        
                                        <p>Rwanda (+250)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="378")
                                        
                                        <p>San Marino (+378)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="239")
                                        
                                        <p>Sao Tome &amp; Principe (+239)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="966")
                                        
                                        <p>Saudi Arabia (+966)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="221")
                                        
                                        <p>Senegal (+221)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="381")
                                        
                                        <p>Serbia (+381)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="248")
                                        
                                        <p>Seychelles (+248)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="232")
                                        
                                        <p>Sierra Leone (+232)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="65")
                                        
                                        <p>Singapore (+65)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="421")
                                        
                                        <p>Slovak Republic (+421)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="386")
                                        
                                        <p>Slovenia (+386)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="677")
                                        
                                        <p>Solomon Islands (+677)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="252")
                                        
                                        <p>Somalia (+252)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="27")
                                        
                                        <p>South Africa (+27)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="34")
                                        
                                        <p>Spain (+34)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="94")
                                        
                                        <p>Sri Lanka (+94)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="290")
                                        
                                        <p>St. Helena (+290)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="1869")
                                        
                                        <p>St. Kitts (+1869)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="1758")
                                        
                                        <p>St. Lucia (+1758)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="249")
                                        
                                        <p>Sudan (+249)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="597")
                                        
                                        <p>Suriname (+597)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="268")
                                        
                                        <p>Swaziland (+268)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="46")
                                        
                                        <p>Sweden (+46)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="41")
                                        
                                        <p>Switzerland (+41)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="963")
                                        
                                        <p>Syria (+963)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="886")
                                        
                                        <p>Taiwan (+886)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="7")
                                        
                                        <p>Tajikstan (+7)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="66")
                                        
                                        <p>Thailand (+66)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="228")
                                        
                                        <p>Togo (+228)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="676")
                                        
                                        <p>Tonga (+676)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="1868")
                                        
                                        <p>Trinidad &amp; Tobago (+1868)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="216")
                                        
                                        <p>Tunisia (+216)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="90")
                                        
                                        <p>Turkey (+90)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="7")
                                        
                                        <p>Turkmenistan (+7)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="993")
                                        
                                        <p>Turkmenistan (+993)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="1649")
                                        
                                        <p>Turks &amp; Caicos Islands (+1649)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="688")
                                        
                                        <p>Tuvalu (+688)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="256")
                                        
                                        <p>Uganda (+256)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="44")
                                        
                                        <p>UK (+44)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="380")
                                        
                                        <p>Ukraine (+380)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="971")
                                        
                                        <p>United Arab Emirates (+971)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="598")
                                        
                                        <p>Uruguay (+598)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="1")
                                        
                                        <p>USA (+1)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="7")
                                        
                                        <p>Uzbekistan (+7)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="678")
                                        
                                        <p>Vanuatu (+678)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="379")
                                        
                                        <p>Vatican City (+379)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="58")
                                        
                                        <p>Venezuela (+58)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="84")
                                        
                                        <p>Vietnam (+84)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="84")
                                        
                                        <p>Virgin Islands - British (+1284)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="84")
                                        
                                        <p>Virgin Islands - US (+1340)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="681")
                                        
                                        <p>Wallis &amp; Futuna (+681)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="969")
                                        
                                        <p>Yemen (North)(+969)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="967")
                                        
                                        <p>Yemen (South)(+967)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="260")
                                        
                                        <p>Zambia (+260)</p>

                                 @elseif($roomreserves->getRoomOrdersbyuserprofile->country =="263")
                                        
                                        <p>Zimbabwe (+263)</p>
                                @endif


                        </div>

                    </div>
					
                    <div class="form-group">

                        <label class="col-md-12">Reservation Customer Notes</label>

                        <div class="col-md-12">

                            <textarea class="form-control" name="HouseRules" rows="5">{{$roomreserves->NotesByCustomer}}</textarea>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-md-12">Reservation Created Time</label>

                        <div class="col-md-12">

                            <input type="datetime" class="form-control" name="GuestPassendTime" placeholder="GuestPass Time" value="{{$roomreserves->updated_at}}"> 

                        </div>

                    </div>

            </div>

        </div>

    </div>

<!-- ===== Right-Sidebar ===== -->

@include('layouts.partials.right-sidebar')

</div>

@endsection
