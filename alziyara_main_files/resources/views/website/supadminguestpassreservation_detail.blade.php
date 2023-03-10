@extends('layouts.master')



@push('css')

@endpush



@section('content')

<div class="container-fluid">

    <!-- .row -->

    <div class="row">

        <div class="col-sm-12">

            <div class="white-box">

                <h3 class="box-title m-b-0">SuperAdmin Guests Pass Reservation Details</h3>
				
				<br/>

                <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->

                <form  class="form-horizontal" >
                
					<?php
					
						$guestpassVendorName =  App\User::where('id',$guestpassreserves->getGuestPassOrderssupadmin->GuestPassCreatedBy)->first();
						
						$guestpassVendorProfile =  App\Profile::where('user_id',$guestpassreserves->getGuestPassOrderssupadmin->GuestPassCreatedBy)->first();
						
						// dd($guestpassVendorProfile);
						
					?>
					
					
                    <div class="form-group">

                        <label class="col-md-2">Reservation Name</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassName" class="form-control"  value="{{$guestpassreserves->getGuestPassOrderssupadmin->GuestPassName??""}}">
						</div>
						
						<label class="col-md-2" >Reservation Receipt No</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassLocation" class="form-control"  value="{{$guestpassreserves->ReceiptNum??""}}"> 

                        </div>

                    </div>
					
					<div class="form-group">

                        <label class="col-md-2">Reservation Vendor Name</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassName" class="form-control"  value="{{$guestpassVendorName->name??""}}">
						</div>
						
						<label class="col-md-2" >Reservation Vendor Email</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassLocation" class="form-control"  value="{{$guestpassVendorName->email??""}}"> 

                        </div>

                    </div>
					
					<div class="form-group">

                        <label class="col-md-2">Reservation Vendor Phone No</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassName" class="form-control"  value="+{{$guestpassVendorProfile->country}} - {{$guestpassVendorProfile->phone??""}}">
						</div>
						
						<label class="col-md-2" >Reservation Vendor Country</label>

                        <div class="col-md-4">
							
								@if($guestpassVendorProfile->country =="")
        
                                        <p>Select Country</p>

                                 @elseif($guestpassVendorProfile->country =="213")
                                        
                                        <p>Algeria (+213)</p>

                                 @elseif($guestpassVendorProfile->country =="376")
                                        
                                        <p>Andorra (+376)</p>

                                 @elseif($guestpassVendorProfile->country =="244")
                                        
                                        <p>Angola (+244)</p>

                                 @elseif($guestpassVendorProfile->country =="1264")
                                        
                                        <p>Anguilla (+1264)</p>

                                 @elseif($guestpassVendorProfile->country =="1268")
                                        
                                        <p>Antigua &amp; Barbuda (+1268)</p>

                                 @elseif($guestpassVendorProfile->country =="54")
                                        
                                        <p>Argentina (+54)</p>

                                 @elseif($guestpassVendorProfile->country =="374")
                                        
                                        <p>Armenia (+374)</p>

                                 @elseif($guestpassVendorProfile->country =="297")
                                        
                                        <p>Aruba (+297)</p>

                                 @elseif($guestpassVendorProfile->country =="61")
                                        
                                        <p>Australia (+61)</p>

                                 @elseif($guestpassVendorProfile->country =="43")
                                        
                                        <p>Austria (+43)</p>

                                 @elseif($guestpassVendorProfile->country =="994")
                                        
                                        <p>Azerbaijan (+994)</p>

                                 @elseif($guestpassVendorProfile->country =="1242")
                                        
                                        <p>Bahamas (+1242)</p>

                                 @elseif($guestpassVendorProfile->country =="973")
                                        
                                        <p>Bahrain (+973)</p>

                                 @elseif($guestpassVendorProfile->country =="880")
                                        
                                        <p>Bangladesh (+880)</p>

                                 @elseif($guestpassVendorProfile->country =="1246")
                                        
                                        <p>Barbados (+1246)</p>

                                 @elseif($guestpassVendorProfile->country =="375")
                                        
                                        <p>Belarus (+375)</p>

                                 @elseif($guestpassVendorProfile->country =="32")
                                        
                                        <p>Belgium (+32)</p>

                                 @elseif($guestpassVendorProfile->country =="501")
                                        
                                        <p>Belize (+501)</p>

                                 @elseif($guestpassVendorProfile->country =="229")
                                        
                                        <p>Benin (+229)</p>

                                 @elseif($guestpassVendorProfile->country =="1441")
                                        
                                        <p>Bermuda (+1441)</p>

                                 @elseif($guestpassVendorProfile->country =="975")
                                        
                                        <p>Bhutan (+975)</p>

                                 @elseif($guestpassVendorProfile->country =="591")
                                        
                                        <p>Bolivia (+591)</p>

                                 @elseif($guestpassVendorProfile->country =="387")
                                        
                                        <p>Bosnia Herzegovina (+387)</p>

                                 @elseif($guestpassVendorProfile->country =="267")
                                        
                                        <p>Botswana (+267)</p>

                                 @elseif($guestpassVendorProfile->country =="55")
                                        
                                        <p>Brazil (+55)</p>

                                 @elseif($guestpassVendorProfile->country =="673")
                                        
                                        <p>Brunei (+673)</p>

                                 @elseif($guestpassVendorProfile->country =="359")
                                        
                                        <p>Bulgaria (+359)</p>

                                 @elseif($guestpassVendorProfile->country =="226")
                                        
                                        <p>Burkina Faso (+226)</p>

                                 @elseif($guestpassVendorProfile->country =="257")
                                        
                                        <p>Burundi (+257)</p>

                                 @elseif($guestpassVendorProfile->country =="855")
                                        
                                        <p>Cambodia (+855)</p>

                                 @elseif($guestpassVendorProfile->country =="237")
                                        
                                        <p>Cameroon (+237)</p>

                                 @elseif($guestpassVendorProfile->country =="1")
                                        
                                        <p>Canada (+1)</p>

                                 @elseif($guestpassVendorProfile->country =="238")
                                        
                                        <p>Cape Verde Islands (+238)</p>

                                 @elseif($guestpassVendorProfile->country =="1345")
                                        
                                        <p>Cayman Islands (+1345)</p>

                                 @elseif($guestpassVendorProfile->country =="236")
                                        
                                        <p>Central African Republic (+236)</p>

                                 @elseif($guestpassVendorProfile->country =="56")
                                        
                                        <p>Chile (+56)</p>

                                 @elseif($guestpassVendorProfile->country =="86")
                                        
                                        <p>China (+86)</p>

                                 @elseif($guestpassVendorProfile->country =="57")
                                        
                                        <p>Colombia (+57)</p>

                                 @elseif($guestpassVendorProfile->country =="269")
                                        
                                        <p>Comoros (+269)</p>

                                 @elseif($guestpassVendorProfile->country =="242")
                                        
                                        <p>Congo (+242)</p>

                                 @elseif($guestpassVendorProfile->country =="682")
                                        
                                        <p>Cook Islands (+682)</p>

                                 @elseif($guestpassVendorProfile->country =="506")
                                        
                                        <p>Costa Rica (+506)</p>

                                 @elseif($guestpassVendorProfile->country =="385")
                                        
                                        <p>Croatia (+385)</p>

                                 @elseif($guestpassVendorProfile->country =="53")
                                        
                                        <p>Cuba (+53)</p>

                                 @elseif($guestpassVendorProfile->country =="90392")
                                        
                                        <p>Cyprus North (+90392)</p>

                                 @elseif($guestpassVendorProfile->country =="357")
                                        
                                        <p>Cyprus South (+357)</p>

                                 @elseif($guestpassVendorProfile->country =="42")
                                        
                                        <p>Czech Republic (+42)</p>

                                 @elseif($guestpassVendorProfile->country =="45")
                                        
                                        <p>Denmark (+45)</p>

                                 @elseif($guestpassVendorProfile->country =="253")
                                        
                                        <p>Djibouti (+253)</p>

                                 @elseif($guestpassVendorProfile->country =="1809")
                                        
                                        <p>Dominica (+1809)</p>

                                 @elseif($guestpassVendorProfile->country =="1809")
                                        
                                        <p>Dominican Republic (+1809)</p>

                                 @elseif($guestpassVendorProfile->country =="593")
                                        
                                        <p>Ecuador (+593)</p>

                                 @elseif($guestpassVendorProfile->country =="20")
                                        
                                        <p>Egypt (+20)</p>

                                 @elseif($guestpassVendorProfile->country =="503")
                                        
                                        <p>El Salvador (+503)</p>

                                 @elseif($guestpassVendorProfile->country =="240")
                                        
                                        <p>Equatorial Guinea (+240)</p>

                                 @elseif($guestpassVendorProfile->country =="291")
                                        
                                        <p>Eritrea (+291)</p>

                                 @elseif($guestpassVendorProfile->country =="372")
                                        
                                        <p>Estonia (+372)</p>

                                 @elseif($guestpassVendorProfile->country =="251")
                                        
                                        <p>Ethiopia (+251)</p>

                                 @elseif($guestpassVendorProfile->country =="500")
                                        
                                        <p>Falkland Islands (+500)</p>

                                 @elseif($guestpassVendorProfile->country =="298")
                                        
                                        <p>Faroe Islands (+298)</p>

                                 @elseif($guestpassVendorProfile->country =="679")
                                        
                                        <p>Fiji (+679)</p>

                                 @elseif($guestpassVendorProfile->country =="358")
                                        
                                        <p>Finland (+358)</p>

                                 @elseif($guestpassVendorProfile->country =="33")
                                        
                                        <p>France (+33)</p>

                                 @elseif($guestpassVendorProfile->country =="594")
                                        
                                        <p>French Guiana (+594)</p>

                                 @elseif($guestpassVendorProfile->country =="689")
                                        
                                        <p>French Polynesia (+689)</p>

                                 @elseif($guestpassVendorProfile->country =="241")
                                        
                                        <p>Gabon (+241)</p>

                                 @elseif($guestpassVendorProfile->country =="220")
                                        
                                        <p>Gambia (+220)</p>

                                 @elseif($guestpassVendorProfile->country =="7880")
                                        
                                        <p>Georgia (+7880)</p>

                                 @elseif($guestpassVendorProfile->country =="49")
                                        
                                        <p>Germany (+49)</p>

                                 @elseif($guestpassVendorProfile->country =="233")
                                        
                                        <p>Ghana (+233)</p>

                                 @elseif($guestpassVendorProfile->country =="350")
                                        
                                        <p>Gibraltar (+350)</p>

                                 @elseif($guestpassVendorProfile->country =="30")
                                        
                                        <p>Greece (+30)</p>

                                 @elseif($guestpassVendorProfile->country =="299")
                                        
                                        <p>Greenland (+299)</p>

                                 @elseif($guestpassVendorProfile->country =="1473")
                                        
                                        <p>Grenada (+1473)</p>

                                 @elseif($guestpassVendorProfile->country =="590")
                                        
                                        <p>Guadeloupe (+590)</p>

                                 @elseif($guestpassVendorProfile->country =="671")
                                        
                                        <p>Guam (+671)</p>

                                 @elseif($guestpassVendorProfile->country =="502")
                                        
                                        <p>Guatemala (+502)</p>

                                 @elseif($guestpassVendorProfile->country =="224")
                                        
                                        <p>Guinea (+224)</p>

                                 @elseif($guestpassVendorProfile->country =="245")
                                        
                                        <p>Guinea - Bissau (+245)</p>

                                 @elseif($guestpassVendorProfile->country =="592")
                                        
                                        <p>Guyana (+592)</p>

                                 @elseif($guestpassVendorProfile->country =="509")
                                        
                                        <p>Haiti (+509)</p>

                                 @elseif($guestpassVendorProfile->country =="504")
                                        
                                        <p>Honduras (+504)</p>

                                 @elseif($guestpassVendorProfile->country =="852")
                                        
                                        <p>Hong Kong (+852)</p>

                                 @elseif($guestpassVendorProfile->country =="36")
                                        
                                        <p>Hungary (+36)</p>

                                 @elseif($guestpassVendorProfile->country =="354")
                                        
                                        <p>Iceland (+354)</p>

                                 @elseif($guestpassVendorProfile->country =="91")
                                        
                                        <p>India (+91)</p>

                                 @elseif($guestpassVendorProfile->country =="62")
                                        
                                        <p>Indonesia (+62)</p>

                                 @elseif($guestpassVendorProfile->country =="98")
                                        
                                        <p>Iran (+98)</p>

                                 @elseif($guestpassVendorProfile->country =="964")
                                        
                                        <p>Iraq (+964)</p>

                                 @elseif($guestpassVendorProfile->country =="353")
                                        
                                        <p>Ireland (+353)</p>

                                 @elseif($guestpassVendorProfile->country =="972")
                                        
                                        <p>Israel (+972)</p>

                                 @elseif($guestpassVendorProfile->country =="39")
                                        
                                        <p>Italy (+39)</p>

                                 @elseif($guestpassVendorProfile->country =="1876")
                                        
                                        <p>Jamaica (+1876)</p>

                                 @elseif($guestpassVendorProfile->country =="81")
                                        
                                        <p>Japan (+81)</p>

                                 @elseif($guestpassVendorProfile->country =="962")
                                        
                                        <p>Jordan (+962)</p>

                                 @elseif($guestpassVendorProfile->country =="7")
                                        
                                        <p>Kazakhstan (+7)</p>

                                 @elseif($guestpassVendorProfile->country =="254")
                                        
                                        <p>Kenya (+254)</p>

                                 @elseif($guestpassVendorProfile->country =="686")
                                        
                                        <p>Kiribati (+686)</p>

                                 @elseif($guestpassVendorProfile->country =="850")
                                        
                                        <p>Korea North (+850)</p>

                                 @elseif($guestpassVendorProfile->country =="82")
                                        
                                        <p>Korea South (+82)</p>

                                 @elseif($guestpassVendorProfile->country =="965")
                                        
                                        <p>Kuwait (+965)</p>

                                 @elseif($guestpassVendorProfile->country =="996")
                                        
                                        <p>Kyrgyzstan (+996)</p>

                                 @elseif($guestpassVendorProfile->country =="856")
                                        
                                        <p>Laos (+856)</p>

                                 @elseif($guestpassVendorProfile->country =="371")
                                        
                                        <p>Latvia (+371)</p>

                                 @elseif($guestpassVendorProfile->country =="961")
                                        
                                        <p>Lebanon (+961)</p>

                                 @elseif($guestpassVendorProfile->country =="266")
                                        
                                        <p>Lesotho (+266)</p>

                                 @elseif($guestpassVendorProfile->country =="231")
                                        
                                        <p>Liberia (+231)</p>

                                 @elseif($guestpassVendorProfile->country =="218")
                                        
                                        <p>Libya (+218)</p>

                                 @elseif($guestpassVendorProfile->country =="417")
                                        
                                        <p>Liechtenstein (+417)</p>

                                 @elseif($guestpassVendorProfile->country =="370")
                                        
                                        <p>Lithuania (+370)</p>

                                 @elseif($guestpassVendorProfile->country =="352")
                                        
                                        <p>Luxembourg (+352)</p>

                                 @elseif($guestpassVendorProfile->country =="853")
                                        
                                        <p>Macao (+853)</p>

                                 @elseif($guestpassVendorProfile->country =="389")
                                        
                                        <p>Macedonia (+389)</p>

                                 @elseif($guestpassVendorProfile->country =="261")
                                        
                                        <p>Madagascar (+261)</p>

                                 @elseif($guestpassVendorProfile->country =="265")
                                        
                                        <p>Malawi (+265)</p>

                                 @elseif($guestpassVendorProfile->country =="60")
                                        
                                        <p>Malaysia (+60)</p>

                                 @elseif($guestpassVendorProfile->country =="960")
                                        
                                        <p>Maldives (+960)</p>

                                 @elseif($guestpassVendorProfile->country =="223")
                                        
                                        <p>Mali (+223)</p>

                                 @elseif($guestpassVendorProfile->country =="356")
                                        
                                        <p>Malta (+356)</p>

                                 @elseif($guestpassVendorProfile->country =="692")
                                        
                                        <p>Marshall Islands (+692)</p>

                                 @elseif($guestpassVendorProfile->country =="596")
                                        
                                        <p>Martinique (+596)</p>

                                 @elseif($guestpassVendorProfile->country =="222")
                                        
                                        <p>Mauritania (+222)</p>

                                 @elseif($guestpassVendorProfile->country =="269")
                                        
                                        <p>Mayotte (+269)</p>

                                 @elseif($guestpassVendorProfile->country =="52")
                                        
                                        <p>Mexico (+52)</p>

                                 @elseif($guestpassVendorProfile->country =="691")
                                        
                                        <p>Micronesia (+691)</p>

                                 @elseif($guestpassVendorProfile->country =="373")
                                        
                                        <p>Moldova (+373)</p>

                                 @elseif($guestpassVendorProfile->country =="377")
                                        
                                        <p>Monaco (+377)</p>

                                 @elseif($guestpassVendorProfile->country =="976")
                                        
                                        <p>Mongolia (+976)</p>

                                 @elseif($guestpassVendorProfile->country =="1664")
                                        
                                        <p>Montserrat (+1664)</p>

                                 @elseif($guestpassVendorProfile->country =="212")
                                        
                                        <p>Morocco (+212)</p>

                                 @elseif($guestpassVendorProfile->country =="258")
                                        
                                        <p>Mozambique (+258)</p>

                                 @elseif($guestpassVendorProfile->country =="95")
                                        
                                        <p>Myanmar (+95)</p>

                                 @elseif($guestpassVendorProfile->country =="264")
                                        
                                        <p>Namibia (+264)</p>

                                 @elseif($guestpassVendorProfile->country =="674")
                                        
                                        <p>Nauru (+674)</p>

                                 @elseif($guestpassVendorProfile->country =="977")
                                        
                                        <p>Nepal (+977)</p>

                                 @elseif($guestpassVendorProfile->country =="31")
                                        
                                        <p>Netherlands (+31)</p>

                                 @elseif($guestpassVendorProfile->country =="687")
                                        
                                        <p>New Caledonia (+687)</p>

                                 @elseif($guestpassVendorProfile->country =="64")
                                        
                                        <p>New Zealand (+64)</p>

                                 @elseif($guestpassVendorProfile->country =="505")
                                        
                                        <p>Nicaragua (+505)</p>

                                 @elseif($guestpassVendorProfile->country =="227")
                                        
                                        <p>Niger (+227)</p>

                                 @elseif($guestpassVendorProfile->country =="234")
                                        
                                        <p>Nigeria (+234)</p>

                                 @elseif($guestpassVendorProfile->country =="683")
                                        
                                        <p>Niue (+683)</p>

                                 @elseif($guestpassVendorProfile->country =="672")
                                        
                                        <p>Norfolk Islands (+672)</p>

                                 @elseif($guestpassVendorProfile->country =="670")
                                        
                                        <p>Northern Marianas (+670)</p>

                                 @elseif($guestpassVendorProfile->country =="47")
                                        
                                        <p>Norway (+47)</p>

                                 @elseif($guestpassVendorProfile->country =="968")
                                        
                                        <p>Oman (+968)</p>
										
								 @elseif($guestpassVendorProfile->country =="970")
                                        
                                        <p>Palestine (+970)</p>

                                 @elseif($guestpassVendorProfile->country =="680")
                                        
                                        <p>Palau (+680)</p>

                                 @elseif($guestpassVendorProfile->country =="92")
                                        
                                        <p>Pakistan (+92)</p>

                                 @elseif($guestpassVendorProfile->country =="507")
                                        
                                        <p>Panama (+507)</p>

                                 @elseif($guestpassVendorProfile->country =="675")
                                        
                                        <p>Papua New Guinea (+675)</p>

                                 @elseif($guestpassVendorProfile->country =="595")
                                        
                                        <p>Paraguay (+595)</p>

                                 @elseif($guestpassVendorProfile->country =="51")
                                        
                                        <p>Peru (+51)</p>

                                 @elseif($guestpassVendorProfile->country =="63")
                                        
                                        <p>Philippines (+63)</p>

                                 @elseif($guestpassVendorProfile->country =="48")
                                        
                                        <p>Poland (+48)</p>

                                 @elseif($guestpassVendorProfile->country =="351")
                                        
                                        <p>Portugal (+351)</p>

                                 @elseif($guestpassVendorProfile->country =="1787")
                                        
                                        <p>Puerto Rico (+1787)</p>

                                 @elseif($guestpassVendorProfile->country =="974")
                                        
                                        <p>Qatar (+974)</p>

                                 @elseif($guestpassVendorProfile->country =="262")
                                        
                                        <p>Reunion (+262)</p>

                                 @elseif($guestpassVendorProfile->country =="40")
                                        
                                        <p>Romania (+40)</p>

                                 @elseif($guestpassVendorProfile->country =="7")
                                        
                                        <p>Russia (+7)</p>

                                 @elseif($guestpassVendorProfile->country =="250")
                                        
                                        <p>Rwanda (+250)</p>

                                 @elseif($guestpassVendorProfile->country =="378")
                                        
                                        <p>San Marino (+378)</p>

                                 @elseif($guestpassVendorProfile->country =="239")
                                        
                                        <p>Sao Tome &amp; Principe (+239)</p>

                                 @elseif($guestpassVendorProfile->country =="966")
                                        
                                        <p>Saudi Arabia (+966)</p>

                                 @elseif($guestpassVendorProfile->country =="221")
                                        
                                        <p>Senegal (+221)</p>

                                 @elseif($guestpassVendorProfile->country =="381")
                                        
                                        <p>Serbia (+381)</p>

                                 @elseif($guestpassVendorProfile->country =="248")
                                        
                                        <p>Seychelles (+248)</p>

                                 @elseif($guestpassVendorProfile->country =="232")
                                        
                                        <p>Sierra Leone (+232)</p>

                                 @elseif($guestpassVendorProfile->country =="65")
                                        
                                        <p>Singapore (+65)</p>

                                 @elseif($guestpassVendorProfile->country =="421")
                                        
                                        <p>Slovak Republic (+421)</p>

                                 @elseif($guestpassVendorProfile->country =="386")
                                        
                                        <p>Slovenia (+386)</p>

                                 @elseif($guestpassVendorProfile->country =="677")
                                        
                                        <p>Solomon Islands (+677)</p>

                                 @elseif($guestpassVendorProfile->country =="252")
                                        
                                        <p>Somalia (+252)</p>

                                 @elseif($guestpassVendorProfile->country =="27")
                                        
                                        <p>South Africa (+27)</p>

                                 @elseif($guestpassVendorProfile->country =="34")
                                        
                                        <p>Spain (+34)</p>

                                 @elseif($guestpassVendorProfile->country =="94")
                                        
                                        <p>Sri Lanka (+94)</p>

                                 @elseif($guestpassVendorProfile->country =="290")
                                        
                                        <p>St. Helena (+290)</p>

                                 @elseif($guestpassVendorProfile->country =="1869")
                                        
                                        <p>St. Kitts (+1869)</p>

                                 @elseif($guestpassVendorProfile->country =="1758")
                                        
                                        <p>St. Lucia (+1758)</p>

                                 @elseif($guestpassVendorProfile->country =="249")
                                        
                                        <p>Sudan (+249)</p>

                                 @elseif($guestpassVendorProfile->country =="597")
                                        
                                        <p>Suriname (+597)</p>

                                 @elseif($guestpassVendorProfile->country =="268")
                                        
                                        <p>Swaziland (+268)</p>

                                 @elseif($guestpassVendorProfile->country =="46")
                                        
                                        <p>Sweden (+46)</p>

                                 @elseif($guestpassVendorProfile->country =="41")
                                        
                                        <p>Switzerland (+41)</p>

                                 @elseif($guestpassVendorProfile->country =="963")
                                        
                                        <p>Syria (+963)</p>

                                 @elseif($guestpassVendorProfile->country =="886")
                                        
                                        <p>Taiwan (+886)</p>

                                 @elseif($guestpassVendorProfile->country =="7")
                                        
                                        <p>Tajikstan (+7)</p>

                                 @elseif($guestpassVendorProfile->country =="66")
                                        
                                        <p>Thailand (+66)</p>

                                 @elseif($guestpassVendorProfile->country =="228")
                                        
                                        <p>Togo (+228)</p>

                                 @elseif($guestpassVendorProfile->country =="676")
                                        
                                        <p>Tonga (+676)</p>

                                 @elseif($guestpassVendorProfile->country =="1868")
                                        
                                        <p>Trinidad &amp; Tobago (+1868)</p>

                                 @elseif($guestpassVendorProfile->country =="216")
                                        
                                        <p>Tunisia (+216)</p>

                                 @elseif($guestpassVendorProfile->country =="90")
                                        
                                        <p>Turkey (+90)</p>

                                 @elseif($guestpassVendorProfile->country =="7")
                                        
                                        <p>Turkmenistan (+7)</p>

                                 @elseif($guestpassVendorProfile->country =="993")
                                        
                                        <p>Turkmenistan (+993)</p>

                                 @elseif($guestpassVendorProfile->country =="1649")
                                        
                                        <p>Turks &amp; Caicos Islands (+1649)</p>

                                 @elseif($guestpassVendorProfile->country =="688")
                                        
                                        <p>Tuvalu (+688)</p>

                                 @elseif($guestpassVendorProfile->country =="256")
                                        
                                        <p>Uganda (+256)</p>

                                 @elseif($guestpassVendorProfile->country =="44")
                                        
                                        <p>UK (+44)</p>

                                 @elseif($guestpassVendorProfile->country =="380")
                                        
                                        <p>Ukraine (+380)</p>

                                 @elseif($guestpassVendorProfile->country =="971")
                                        
                                        <p>United Arab Emirates (+971)</p>

                                 @elseif($guestpassVendorProfile->country =="598")
                                        
                                        <p>Uruguay (+598)</p>

                                 @elseif($guestpassVendorProfile->country =="1")
                                        
                                        <p>USA (+1)</p>

                                 @elseif($guestpassVendorProfile->country =="7")
                                        
                                        <p>Uzbekistan (+7)</p>

                                 @elseif($guestpassVendorProfile->country =="678")
                                        
                                        <p>Vanuatu (+678)</p>

                                 @elseif($guestpassVendorProfile->country =="379")
                                        
                                        <p>Vatican City (+379)</p>

                                 @elseif($guestpassVendorProfile->country =="58")
                                        
                                        <p>Venezuela (+58)</p>

                                 @elseif($guestpassVendorProfile->country =="84")
                                        
                                        <p>Vietnam (+84)</p>

                                 @elseif($guestpassVendorProfile->country =="84")
                                        
                                        <p>Virgin Islands - British (+1284)</p>

                                 @elseif($guestpassVendorProfile->country =="84")
                                        
                                        <p>Virgin Islands - US (+1340)</p>

                                 @elseif($guestpassVendorProfile->country =="681")
                                        
                                        <p>Wallis &amp; Futuna (+681)</p>

                                 @elseif($guestpassVendorProfile->country =="969")
                                        
                                        <p>Yemen (North)(+969)</p>

                                 @elseif($guestpassVendorProfile->country =="967")
                                        
                                        <p>Yemen (South)(+967)</p>

                                 @elseif($guestpassVendorProfile->country =="260")
                                        
                                        <p>Zambia (+260)</p>

                                 @elseif($guestpassVendorProfile->country =="263")
                                        
                                        <p>Zimbabwe (+263)</p>
                                @endif


                        </div>

                    </div>
					
					<?php

							
						
							if(($guestpassreserves->Insurance == 1) && ($guestpassreserves->Donation == 0)){
								
								$finalprice = 0;
								
								$finalprice = $guestpassreserves->TotalPrice - 10;
								
							}elseif(($guestpassreserves->Donation == 1) && ($guestpassreserves->Insurance == 0)){
								
								$finalprice = 0;
							
								$finalprice = $guestpassreserves->TotalPrice - $guestpassreserves->Donation_amount;
							
							}elseif(($guestpassreserves->Insurance == 1) && ($guestpassreserves->Insurance == 1) ){
								
								$finalprice = 0;
							
								$finalprice = $guestpassreserves->TotalPrice - $guestpassreserves->Donation_amount - 10;
								
							}else{
								
								$finalprice = 0;
								
								$finalprice = $guestpassreserves->TotalPrice;
								
							}
								
						?>

                    <div class="form-group">

                        <label class="col-md-2">Reservation Amount</label>

                        <div class="col-md-4">

                            <input type="text" name="Price" class="form-control" value=" $ {{$finalprice}}">
							<small class="text-muted">Only Amount Without Donation and Insurance</small>

                         </div>
						 
						 <label class="col-md-2">Reservation Quantity</label>

                        <div class="col-md-4">

                            <input type="text" class="form-control" name="MaxOccupancy"  value="{{$guestpassreserves->qty}}"> 

                        </div>

                    </div>
					
					
					<div class="form-group">

                        <label class="col-md-2">Reservation Insurance Amount</label>

                        <div class="col-md-4">
						
						@if(($guestpassreserves->Insurance == 1) )
							
							<input type="text" name="Price" class="form-control" value=" $ 10">
								
								
						@else
							
							<input type="text" name="Price" class="form-control" value=" $ 0">
								
						@endif

                            

                         </div>
						 
						 <label class="col-md-2">Reservation Donation Amount</label>

                        <div class="col-md-4">
						
						@if(($guestpassreserves->Donation == 1))

                            <input type="text" class="form-control" name="MaxOccupancy"  value=" $ {{$guestpassreserves->Donation_amount}}"> 
							
						@else
							
							<input type="text" class="form-control" name="MaxOccupancy"  value=" $ 0"> 
							
						@endif

                        </div>

                    </div>
					
					

                    <div class="form-group">

                        <label class="col-md-2">Reservation Date</label>

                        <div class="col-md-4">

                             <input type="text" class="form-control" name="MaxOccupancy"  value="{{$guestpassreserves->ReservationForDate}}">
							 
                        </div>

                        <label class="col-md-2">Reservation Payment Status</label>

                        <div class="col-md-4">
						
							<input type="text" class="form-control" name="MaxOccupancy"  value="{{$guestpassreserves->PaymentStatus}}">

                        </div>

                    </div>
					
					<div class="form-group">

                        <label class="col-md-2">Reservation Customer Name</label>

                        <div class="col-md-4">

                             <input type="text" class="form-control" name="Customer Name"  value="{{$guestpassreserves->getGuestPassOrdersbyuser->name}}">
							 
                        </div>

                        <label class="col-md-2">Reservation Customer Email</label>

                        <div class="col-md-4">
						
							<input type="text" class="form-control" name="Customer Email"  value="{{$guestpassreserves->getGuestPassOrdersbyuser->email}}">

                        </div>

                    </div>
					
					<div class="form-group">

                        <label class="col-md-2">Reservation Customer Phone</label>

                        <div class="col-md-4">
							 
							 <input type="text" class="form-control" name="Customer Phone"  value="+{{$guestpassreserves->getGuestPassOrdersbyuserprofile->country}} - {{$guestpassreserves->getGuestPassOrdersbyuserprofile->phone}}">
							 
                        </div>

                        <label class="col-md-2">Reservation Customer Country</label>

                        <div class="col-md-4">
						
							
							
							    @if($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="")
        
                                        <p>No Country</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="213")
                                        
                                        <p>Algeria (+213)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="376")
                                        
                                        <p>Andorra (+376)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="244")
                                        
                                        <p>Angola (+244)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="1264")
                                        
                                        <p>Anguilla (+1264)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="1268")
                                        
                                        <p>Antigua &amp; Barbuda (+1268)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="54")
                                        
                                        <p>Argentina (+54)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="374")
                                        
                                        <p>Armenia (+374)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="297")
                                        
                                        <p>Aruba (+297)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="61")
                                        
                                        <p>Australia (+61)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="43")
                                        
                                        <p>Austria (+43)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="994")
                                        
                                        <p>Azerbaijan (+994)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="1242")
                                        
                                        <p>Bahamas (+1242)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="973")
                                        
                                        <p>Bahrain (+973)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="880")
                                        
                                        <p>Bangladesh (+880)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="1246")
                                        
                                        <p>Barbados (+1246)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="375")
                                        
                                        <p>Belarus (+375)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="32")
                                        
                                        <p>Belgium (+32)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="501")
                                        
                                        <p>Belize (+501)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="229")
                                        
                                        <p>Benin (+229)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="1441")
                                        
                                        <p>Bermuda (+1441)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="975")
                                        
                                        <p>Bhutan (+975)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="591")
                                        
                                        <p>Bolivia (+591)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="387")
                                        
                                        <p>Bosnia Herzegovina (+387)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="267")
                                        
                                        <p>Botswana (+267)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="55")
                                        
                                        <p>Brazil (+55)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="673")
                                        
                                        <p>Brunei (+673)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="359")
                                        
                                        <p>Bulgaria (+359)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="226")
                                        
                                        <p>Burkina Faso (+226)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="257")
                                        
                                        <p>Burundi (+257)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="855")
                                        
                                        <p>Cambodia (+855)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="237")
                                        
                                        <p>Cameroon (+237)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="1")
                                        
                                        <p>Canada (+1)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="238")
                                        
                                        <p>Cape Verde Islands (+238)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="1345")
                                        
                                        <p>Cayman Islands (+1345)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="236")
                                        
                                        <p>Central African Republic (+236)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="56")
                                        
                                        <p>Chile (+56)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="86")
                                        
                                        <p>China (+86)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="57")
                                        
                                        <p>Colombia (+57)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="269")
                                        
                                        <p>Comoros (+269)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="242")
                                        
                                        <p>Congo (+242)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="682")
                                        
                                        <p>Cook Islands (+682)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="506")
                                        
                                        <p>Costa Rica (+506)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="385")
                                        
                                        <p>Croatia (+385)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="53")
                                        
                                        <p>Cuba (+53)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="90392")
                                        
                                        <p>Cyprus North (+90392)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="357")
                                        
                                        <p>Cyprus South (+357)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="42")
                                        
                                        <p>Czech Republic (+42)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="45")
                                        
                                        <p>Denmark (+45)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="253")
                                        
                                        <p>Djibouti (+253)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="1809")
                                        
                                        <p>Dominica (+1809)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="1809")
                                        
                                        <p>Dominican Republic (+1809)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="593")
                                        
                                        <p>Ecuador (+593)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="20")
                                        
                                        <p>Egypt (+20)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="503")
                                        
                                        <p>El Salvador (+503)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="240")
                                        
                                        <p>Equatorial Guinea (+240)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="291")
                                        
                                        <p>Eritrea (+291)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="372")
                                        
                                        <p>Estonia (+372)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="251")
                                        
                                        <p>Ethiopia (+251)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="500")
                                        
                                        <p>Falkland Islands (+500)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="298")
                                        
                                        <p>Faroe Islands (+298)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="679")
                                        
                                        <p>Fiji (+679)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="358")
                                        
                                        <p>Finland (+358)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="33")
                                        
                                        <p>France (+33)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="594")
                                        
                                        <p>French Guiana (+594)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="689")
                                        
                                        <p>French Polynesia (+689)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="241")
                                        
                                        <p>Gabon (+241)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="220")
                                        
                                        <p>Gambia (+220)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="7880")
                                        
                                        <p>Georgia (+7880)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="49")
                                        
                                        <p>Germany (+49)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="233")
                                        
                                        <p>Ghana (+233)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="350")
                                        
                                        <p>Gibraltar (+350)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="30")
                                        
                                        <p>Greece (+30)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="299")
                                        
                                        <p>Greenland (+299)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="1473")
                                        
                                        <p>Grenada (+1473)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="590")
                                        
                                        <p>Guadeloupe (+590)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="671")
                                        
                                        <p>Guam (+671)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="502")
                                        
                                        <p>Guatemala (+502)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="224")
                                        
                                        <p>Guinea (+224)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="245")
                                        
                                        <p>Guinea - Bissau (+245)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="592")
                                        
                                        <p>Guyana (+592)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="509")
                                        
                                        <p>Haiti (+509)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="504")
                                        
                                        <p>Honduras (+504)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="852")
                                        
                                        <p>Hong Kong (+852)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="36")
                                        
                                        <p>Hungary (+36)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="354")
                                        
                                        <p>Iceland (+354)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="91")
                                        
                                        <p>India (+91)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="62")
                                        
                                        <p>Indonesia (+62)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="98")
                                        
                                        <p>Iran (+98)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="964")
                                        
                                        <p>Iraq (+964)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="353")
                                        
                                        <p>Ireland (+353)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="972")
                                        
                                        <p>Israel (+972)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="39")
                                        
                                        <p>Italy (+39)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="1876")
                                        
                                        <p>Jamaica (+1876)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="81")
                                        
                                        <p>Japan (+81)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="962")
                                        
                                        <p>Jordan (+962)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="7")
                                        
                                        <p>Kazakhstan (+7)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="254")
                                        
                                        <p>Kenya (+254)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="686")
                                        
                                        <p>Kiribati (+686)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="850")
                                        
                                        <p>Korea North (+850)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="82")
                                        
                                        <p>Korea South (+82)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="965")
                                        
                                        <p>Kuwait (+965)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="996")
                                        
                                        <p>Kyrgyzstan (+996)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="856")
                                        
                                        <p>Laos (+856)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="371")
                                        
                                        <p>Latvia (+371)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="961")
                                        
                                        <p>Lebanon (+961)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="266")
                                        
                                        <p>Lesotho (+266)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="231")
                                        
                                        <p>Liberia (+231)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="218")
                                        
                                        <p>Libya (+218)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="417")
                                        
                                        <p>Liechtenstein (+417)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="370")
                                        
                                        <p>Lithuania (+370)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="352")
                                        
                                        <p>Luxembourg (+352)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="853")
                                        
                                        <p>Macao (+853)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="389")
                                        
                                        <p>Macedonia (+389)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="261")
                                        
                                        <p>Madagascar (+261)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="265")
                                        
                                        <p>Malawi (+265)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="60")
                                        
                                        <p>Malaysia (+60)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="960")
                                        
                                        <p>Maldives (+960)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="223")
                                        
                                        <p>Mali (+223)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="356")
                                        
                                        <p>Malta (+356)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="692")
                                        
                                        <p>Marshall Islands (+692)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="596")
                                        
                                        <p>Martinique (+596)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="222")
                                        
                                        <p>Mauritania (+222)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="269")
                                        
                                        <p>Mayotte (+269)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="52")
                                        
                                        <p>Mexico (+52)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="691")
                                        
                                        <p>Micronesia (+691)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="373")
                                        
                                        <p>Moldova (+373)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="377")
                                        
                                        <p>Monaco (+377)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="976")
                                        
                                        <p>Mongolia (+976)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="1664")
                                        
                                        <p>Montserrat (+1664)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="212")
                                        
                                        <p>Morocco (+212)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="258")
                                        
                                        <p>Mozambique (+258)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="95")
                                        
                                        <p>Myanmar (+95)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="264")
                                        
                                        <p>Namibia (+264)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="674")
                                        
                                        <p>Nauru (+674)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="977")
                                        
                                        <p>Nepal (+977)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="31")
                                        
                                        <p>Netherlands (+31)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="687")
                                        
                                        <p>New Caledonia (+687)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="64")
                                        
                                        <p>New Zealand (+64)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="505")
                                        
                                        <p>Nicaragua (+505)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="227")
                                        
                                        <p>Niger (+227)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="234")
                                        
                                        <p>Nigeria (+234)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="683")
                                        
                                        <p>Niue (+683)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="672")
                                        
                                        <p>Norfolk Islands (+672)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="670")
                                        
                                        <p>Northern Marianas (+670)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="47")
                                        
                                        <p>Norway (+47)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="968")
                                        
                                        <p>Oman (+968)</p>
										
							     @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="970")
                                        
                                        <p>Palestine (+970)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="680")
                                        
                                        <p>Palau (+680)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="92")
                                        
                                        <p>Pakistan (+92)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="507")
                                        
                                        <p>Panama (+507)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="675")
                                        
                                        <p>Papua New Guinea (+675)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="595")
                                        
                                        <p>Paraguay (+595)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="51")
                                        
                                        <p>Peru (+51)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="63")
                                        
                                        <p>Philippines (+63)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="48")
                                        
                                        <p>Poland (+48)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="351")
                                        
                                        <p>Portugal (+351)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="1787")
                                        
                                        <p>Puerto Rico (+1787)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="974")
                                        
                                        <p>Qatar (+974)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="262")
                                        
                                        <p>Reunion (+262)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="40")
                                        
                                        <p>Romania (+40)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="7")
                                        
                                        <p>Russia (+7)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="250")
                                        
                                        <p>Rwanda (+250)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="378")
                                        
                                        <p>San Marino (+378)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="239")
                                        
                                        <p>Sao Tome &amp; Principe (+239)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="966")
                                        
                                        <p>Saudi Arabia (+966)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="221")
                                        
                                        <p>Senegal (+221)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="381")
                                        
                                        <p>Serbia (+381)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="248")
                                        
                                        <p>Seychelles (+248)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="232")
                                        
                                        <p>Sierra Leone (+232)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="65")
                                        
                                        <p>Singapore (+65)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="421")
                                        
                                        <p>Slovak Republic (+421)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="386")
                                        
                                        <p>Slovenia (+386)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="677")
                                        
                                        <p>Solomon Islands (+677)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="252")
                                        
                                        <p>Somalia (+252)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="27")
                                        
                                        <p>South Africa (+27)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="34")
                                        
                                        <p>Spain (+34)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="94")
                                        
                                        <p>Sri Lanka (+94)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="290")
                                        
                                        <p>St. Helena (+290)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="1869")
                                        
                                        <p>St. Kitts (+1869)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="1758")
                                        
                                        <p>St. Lucia (+1758)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="249")
                                        
                                        <p>Sudan (+249)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="597")
                                        
                                        <p>Suriname (+597)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="268")
                                        
                                        <p>Swaziland (+268)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="46")
                                        
                                        <p>Sweden (+46)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="41")
                                        
                                        <p>Switzerland (+41)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="963")
                                        
                                        <p>Syria (+963)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="886")
                                        
                                        <p>Taiwan (+886)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="7")
                                        
                                        <p>Tajikstan (+7)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="66")
                                        
                                        <p>Thailand (+66)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="228")
                                        
                                        <p>Togo (+228)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="676")
                                        
                                        <p>Tonga (+676)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="1868")
                                        
                                        <p>Trinidad &amp; Tobago (+1868)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="216")
                                        
                                        <p>Tunisia (+216)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="90")
                                        
                                        <p>Turkey (+90)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="7")
                                        
                                        <p>Turkmenistan (+7)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="993")
                                        
                                        <p>Turkmenistan (+993)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="1649")
                                        
                                        <p>Turks &amp; Caicos Islands (+1649)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="688")
                                        
                                        <p>Tuvalu (+688)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="256")
                                        
                                        <p>Uganda (+256)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="44")
                                        
                                        <p>UK (+44)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="380")
                                        
                                        <p>Ukraine (+380)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="971")
                                        
                                        <p>United Arab Emirates (+971)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="598")
                                        
                                        <p>Uruguay (+598)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="1")
                                        
                                        <p>USA (+1)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="7")
                                        
                                        <p>Uzbekistan (+7)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="678")
                                        
                                        <p>Vanuatu (+678)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="379")
                                        
                                        <p>Vatican City (+379)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="58")
                                        
                                        <p>Venezuela (+58)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="84")
                                        
                                        <p>Vietnam (+84)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="84")
                                        
                                        <p>Virgin Islands - British (+1284)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="84")
                                        
                                        <p>Virgin Islands - US (+1340)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="681")
                                        
                                        <p>Wallis &amp; Futuna (+681)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="969")
                                        
                                        <p>Yemen (North)(+969)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="967")
                                        
                                        <p>Yemen (South)(+967)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="260")
                                        
                                        <p>Zambia (+260)</p>

                                 @elseif($guestpassreserves->getGuestPassOrdersbyuserprofile->country =="263")
                                        
                                        <p>Zimbabwe (+263)</p>
                                @endif


                        </div>

                    </div>
					
                    <div class="form-group">

                        <label class="col-md-12">Reservation Customer Notes</label>

                        <div class="col-md-12">

                            <textarea class="form-control" name="HouseRules" rows="5">{{$guestpassreserves->NotesByCustomer}}</textarea>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-md-12">Reservation Created Time</label>

                        <div class="col-md-12">

                            <input type="datetime" class="form-control" name="GuestPassendTime" placeholder="GuestPass Time" value="{{$guestpassreserves->updated_at}}"> 

                        </div>

                    </div>

            </div>

        </div>

    </div>

<!-- ===== Right-Sidebar ===== -->

@include('layouts.partials.right-sidebar')

</div>

@endsection
