@extends('layouts.master')



@push('css')

@endpush



@section('content')

<div class="container-fluid">

    <!-- .row -->

    <div class="row">

        <div class="col-sm-12">

            <div class="white-box">

                <h3 class="box-title m-b-0">SuperAdmin Transport Reservation Details</h3>

				<br/>

                <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->

                <form  class="form-horizontal" >

					<?php

						$transportVendorName =  App\User::where('id',$transportreserves->getTransportOrderssupadmin->TransportationOwnerID)->first();

						$transportVendorProfile =  App\Profile::where('user_id',$transportreserves->getTransportOrderssupadmin->TransportationOwnerID)->first();

						// dd($transportVendorProfile);

					?>


                    <div class="form-group">

                        <label class="col-md-2">Reservation Name</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassName" class="form-control"  value="{{$transportreserves->getTransportOrderssupadmin->NameofVehicle??""}}">
						</div>

						<label class="col-md-2" >Reservation Receipt No</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassLocation" class="form-control"  value="{{$transportreserves->ReceiptNum??""}}">

                        </div>

                    </div>



					<div class="form-group">

                        <label class="col-md-2">Reservation Vendor Name</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassName" class="form-control"  value="{{$transportVendorName->name??""}}">
						</div>

						<label class="col-md-2" >Reservation Vendor Email</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassLocation" class="form-control"  value="{{$transportVendorName->email??""}}">

                        </div>

                    </div>

					<div class="form-group">

                        <label class="col-md-2">Reservation Vendor Phone No</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassName" class="form-control"  value="+{{$transportVendorProfile->country}} - {{$transportVendorProfile->phone??""}}">
						</div>



						<label class="col-md-2" >Reservation Vendor Country</label>

                        <div class="col-md-4">

								@if($transportVendorProfile->country =="")

                                        <p>Select Country</p>

                                 @elseif($transportVendorProfile->country =="213")

                                        <p>Algeria (+213)</p>

                                 @elseif($transportVendorProfile->country =="376")

                                        <p>Andorra (+376)</p>

                                 @elseif($transportVendorProfile->country =="244")

                                        <p>Angola (+244)</p>

                                 @elseif($transportVendorProfile->country =="1264")

                                        <p>Anguilla (+1264)</p>

                                 @elseif($transportVendorProfile->country =="1268")

                                        <p>Antigua &amp; Barbuda (+1268)</p>

                                 @elseif($transportVendorProfile->country =="54")

                                        <p>Argentina (+54)</p>

                                 @elseif($transportVendorProfile->country =="374")

                                        <p>Armenia (+374)</p>

                                 @elseif($transportVendorProfile->country =="297")

                                        <p>Aruba (+297)</p>

                                 @elseif($transportVendorProfile->country =="61")

                                        <p>Australia (+61)</p>

                                 @elseif($transportVendorProfile->country =="43")

                                        <p>Austria (+43)</p>

                                 @elseif($transportVendorProfile->country =="994")

                                        <p>Azerbaijan (+994)</p>

                                 @elseif($transportVendorProfile->country =="1242")

                                        <p>Bahamas (+1242)</p>

                                 @elseif($transportVendorProfile->country =="973")

                                        <p>Bahrain (+973)</p>

                                 @elseif($transportVendorProfile->country =="880")

                                        <p>Bangladesh (+880)</p>

                                 @elseif($transportVendorProfile->country =="1246")

                                        <p>Barbados (+1246)</p>

                                 @elseif($transportVendorProfile->country =="375")

                                        <p>Belarus (+375)</p>

                                 @elseif($transportVendorProfile->country =="32")

                                        <p>Belgium (+32)</p>

                                 @elseif($transportVendorProfile->country =="501")

                                        <p>Belize (+501)</p>

                                 @elseif($transportVendorProfile->country =="229")

                                        <p>Benin (+229)</p>

                                 @elseif($transportVendorProfile->country =="1441")

                                        <p>Bermuda (+1441)</p>

                                 @elseif($transportVendorProfile->country =="975")

                                        <p>Bhutan (+975)</p>

                                 @elseif($transportVendorProfile->country =="591")

                                        <p>Bolivia (+591)</p>

                                 @elseif($transportVendorProfile->country =="387")

                                        <p>Bosnia Herzegovina (+387)</p>

                                 @elseif($transportVendorProfile->country =="267")

                                        <p>Botswana (+267)</p>

                                 @elseif($transportVendorProfile->country =="55")

                                        <p>Brazil (+55)</p>

                                 @elseif($transportVendorProfile->country =="673")

                                        <p>Brunei (+673)</p>

                                 @elseif($transportVendorProfile->country =="359")

                                        <p>Bulgaria (+359)</p>

                                 @elseif($transportVendorProfile->country =="226")

                                        <p>Burkina Faso (+226)</p>

                                 @elseif($transportVendorProfile->country =="257")

                                        <p>Burundi (+257)</p>

                                 @elseif($transportVendorProfile->country =="855")

                                        <p>Cambodia (+855)</p>

                                 @elseif($transportVendorProfile->country =="237")

                                        <p>Cameroon (+237)</p>

                                 @elseif($transportVendorProfile->country =="1")

                                        <p>Canada (+1)</p>

                                 @elseif($transportVendorProfile->country =="238")

                                        <p>Cape Verde Islands (+238)</p>

                                 @elseif($transportVendorProfile->country =="1345")

                                        <p>Cayman Islands (+1345)</p>

                                 @elseif($transportVendorProfile->country =="236")

                                        <p>Central African Republic (+236)</p>

                                 @elseif($transportVendorProfile->country =="56")

                                        <p>Chile (+56)</p>

                                 @elseif($transportVendorProfile->country =="86")

                                        <p>China (+86)</p>

                                 @elseif($transportVendorProfile->country =="57")

                                        <p>Colombia (+57)</p>

                                 @elseif($transportVendorProfile->country =="269")

                                        <p>Comoros (+269)</p>

                                 @elseif($transportVendorProfile->country =="242")

                                        <p>Congo (+242)</p>

                                 @elseif($transportVendorProfile->country =="682")

                                        <p>Cook Islands (+682)</p>

                                 @elseif($transportVendorProfile->country =="506")

                                        <p>Costa Rica (+506)</p>

                                 @elseif($transportVendorProfile->country =="385")

                                        <p>Croatia (+385)</p>

                                 @elseif($transportVendorProfile->country =="53")

                                        <p>Cuba (+53)</p>

                                 @elseif($transportVendorProfile->country =="90392")

                                        <p>Cyprus North (+90392)</p>

                                 @elseif($transportVendorProfile->country =="357")

                                        <p>Cyprus South (+357)</p>

                                 @elseif($transportVendorProfile->country =="42")

                                        <p>Czech Republic (+42)</p>

                                 @elseif($transportVendorProfile->country =="45")

                                        <p>Denmark (+45)</p>

                                 @elseif($transportVendorProfile->country =="253")

                                        <p>Djibouti (+253)</p>

                                 @elseif($transportVendorProfile->country =="1809")

                                        <p>Dominica (+1809)</p>

                                 @elseif($transportVendorProfile->country =="1809")

                                        <p>Dominican Republic (+1809)</p>

                                 @elseif($transportVendorProfile->country =="593")

                                        <p>Ecuador (+593)</p>

                                 @elseif($transportVendorProfile->country =="20")

                                        <p>Egypt (+20)</p>

                                 @elseif($transportVendorProfile->country =="503")

                                        <p>El Salvador (+503)</p>

                                 @elseif($transportVendorProfile->country =="240")

                                        <p>Equatorial Guinea (+240)</p>

                                 @elseif($transportVendorProfile->country =="291")

                                        <p>Eritrea (+291)</p>

                                 @elseif($transportVendorProfile->country =="372")

                                        <p>Estonia (+372)</p>

                                 @elseif($transportVendorProfile->country =="251")

                                        <p>Ethiopia (+251)</p>

                                 @elseif($transportVendorProfile->country =="500")

                                        <p>Falkland Islands (+500)</p>

                                 @elseif($transportVendorProfile->country =="298")

                                        <p>Faroe Islands (+298)</p>

                                 @elseif($transportVendorProfile->country =="679")

                                        <p>Fiji (+679)</p>

                                 @elseif($transportVendorProfile->country =="358")

                                        <p>Finland (+358)</p>

                                 @elseif($transportVendorProfile->country =="33")

                                        <p>France (+33)</p>

                                 @elseif($transportVendorProfile->country =="594")

                                        <p>French Guiana (+594)</p>

                                 @elseif($transportVendorProfile->country =="689")

                                        <p>French Polynesia (+689)</p>

                                 @elseif($transportVendorProfile->country =="241")

                                        <p>Gabon (+241)</p>

                                 @elseif($transportVendorProfile->country =="220")

                                        <p>Gambia (+220)</p>

                                 @elseif($transportVendorProfile->country =="7880")

                                        <p>Georgia (+7880)</p>

                                 @elseif($transportVendorProfile->country =="49")

                                        <p>Germany (+49)</p>

                                 @elseif($transportVendorProfile->country =="233")

                                        <p>Ghana (+233)</p>

                                 @elseif($transportVendorProfile->country =="350")

                                        <p>Gibraltar (+350)</p>

                                 @elseif($transportVendorProfile->country =="30")

                                        <p>Greece (+30)</p>

                                 @elseif($transportVendorProfile->country =="299")

                                        <p>Greenland (+299)</p>

                                 @elseif($transportVendorProfile->country =="1473")

                                        <p>Grenada (+1473)</p>

                                 @elseif($transportVendorProfile->country =="590")

                                        <p>Guadeloupe (+590)</p>

                                 @elseif($transportVendorProfile->country =="671")

                                        <p>Guam (+671)</p>

                                 @elseif($transportVendorProfile->country =="502")

                                        <p>Guatemala (+502)</p>

                                 @elseif($transportVendorProfile->country =="224")

                                        <p>Guinea (+224)</p>

                                 @elseif($transportVendorProfile->country =="245")

                                        <p>Guinea - Bissau (+245)</p>

                                 @elseif($transportVendorProfile->country =="592")

                                        <p>Guyana (+592)</p>

                                 @elseif($transportVendorProfile->country =="509")

                                        <p>Haiti (+509)</p>

                                 @elseif($transportVendorProfile->country =="504")

                                        <p>Honduras (+504)</p>

                                 @elseif($transportVendorProfile->country =="852")

                                        <p>Hong Kong (+852)</p>

                                 @elseif($transportVendorProfile->country =="36")

                                        <p>Hungary (+36)</p>

                                 @elseif($transportVendorProfile->country =="354")

                                        <p>Iceland (+354)</p>

                                 @elseif($transportVendorProfile->country =="91")

                                        <p>India (+91)</p>

                                 @elseif($transportVendorProfile->country =="62")

                                        <p>Indonesia (+62)</p>

                                 @elseif($transportVendorProfile->country =="98")

                                        <p>Iran (+98)</p>

                                 @elseif($transportVendorProfile->country =="964")

                                        <p>Iraq (+964)</p>

                                 @elseif($transportVendorProfile->country =="353")

                                        <p>Ireland (+353)</p>

                                 @elseif($transportVendorProfile->country =="972")

                                        <p>Israel (+972)</p>

                                 @elseif($transportVendorProfile->country =="39")

                                        <p>Italy (+39)</p>

                                 @elseif($transportVendorProfile->country =="1876")

                                        <p>Jamaica (+1876)</p>

                                 @elseif($transportVendorProfile->country =="81")

                                        <p>Japan (+81)</p>

                                 @elseif($transportVendorProfile->country =="962")

                                        <p>Jordan (+962)</p>

                                 @elseif($transportVendorProfile->country =="7")

                                        <p>Kazakhstan (+7)</p>

                                 @elseif($transportVendorProfile->country =="254")

                                        <p>Kenya (+254)</p>

                                 @elseif($transportVendorProfile->country =="686")

                                        <p>Kiribati (+686)</p>

                                 @elseif($transportVendorProfile->country =="850")

                                        <p>Korea North (+850)</p>

                                 @elseif($transportVendorProfile->country =="82")

                                        <p>Korea South (+82)</p>

                                 @elseif($transportVendorProfile->country =="965")

                                        <p>Kuwait (+965)</p>

                                 @elseif($transportVendorProfile->country =="996")

                                        <p>Kyrgyzstan (+996)</p>

                                 @elseif($transportVendorProfile->country =="856")

                                        <p>Laos (+856)</p>

                                 @elseif($transportVendorProfile->country =="371")

                                        <p>Latvia (+371)</p>

                                 @elseif($transportVendorProfile->country =="961")

                                        <p>Lebanon (+961)</p>

                                 @elseif($transportVendorProfile->country =="266")

                                        <p>Lesotho (+266)</p>

                                 @elseif($transportVendorProfile->country =="231")

                                        <p>Liberia (+231)</p>

                                 @elseif($transportVendorProfile->country =="218")

                                        <p>Libya (+218)</p>

                                 @elseif($transportVendorProfile->country =="417")

                                        <p>Liechtenstein (+417)</p>

                                 @elseif($transportVendorProfile->country =="370")

                                        <p>Lithuania (+370)</p>

                                 @elseif($transportVendorProfile->country =="352")

                                        <p>Luxembourg (+352)</p>

                                 @elseif($transportVendorProfile->country =="853")

                                        <p>Macao (+853)</p>

                                 @elseif($transportVendorProfile->country =="389")

                                        <p>Macedonia (+389)</p>

                                 @elseif($transportVendorProfile->country =="261")

                                        <p>Madagascar (+261)</p>

                                 @elseif($transportVendorProfile->country =="265")

                                        <p>Malawi (+265)</p>

                                 @elseif($transportVendorProfile->country =="60")

                                        <p>Malaysia (+60)</p>

                                 @elseif($transportVendorProfile->country =="960")

                                        <p>Maldives (+960)</p>

                                 @elseif($transportVendorProfile->country =="223")

                                        <p>Mali (+223)</p>

                                 @elseif($transportVendorProfile->country =="356")

                                        <p>Malta (+356)</p>

                                 @elseif($transportVendorProfile->country =="692")

                                        <p>Marshall Islands (+692)</p>

                                 @elseif($transportVendorProfile->country =="596")

                                        <p>Martinique (+596)</p>

                                 @elseif($transportVendorProfile->country =="222")

                                        <p>Mauritania (+222)</p>

                                 @elseif($transportVendorProfile->country =="269")

                                        <p>Mayotte (+269)</p>

                                 @elseif($transportVendorProfile->country =="52")

                                        <p>Mexico (+52)</p>

                                 @elseif($transportVendorProfile->country =="691")

                                        <p>Micronesia (+691)</p>

                                 @elseif($transportVendorProfile->country =="373")

                                        <p>Moldova (+373)</p>

                                 @elseif($transportVendorProfile->country =="377")

                                        <p>Monaco (+377)</p>

                                 @elseif($transportVendorProfile->country =="976")

                                        <p>Mongolia (+976)</p>

                                 @elseif($transportVendorProfile->country =="1664")

                                        <p>Montserrat (+1664)</p>

                                 @elseif($transportVendorProfile->country =="212")

                                        <p>Morocco (+212)</p>

                                 @elseif($transportVendorProfile->country =="258")

                                        <p>Mozambique (+258)</p>

                                 @elseif($transportVendorProfile->country =="95")

                                        <p>Myanmar (+95)</p>

                                 @elseif($transportVendorProfile->country =="264")

                                        <p>Namibia (+264)</p>

                                 @elseif($transportVendorProfile->country =="674")

                                        <p>Nauru (+674)</p>

                                 @elseif($transportVendorProfile->country =="977")

                                        <p>Nepal (+977)</p>

                                 @elseif($transportVendorProfile->country =="31")

                                        <p>Netherlands (+31)</p>

                                 @elseif($transportVendorProfile->country =="687")

                                        <p>New Caledonia (+687)</p>

                                 @elseif($transportVendorProfile->country =="64")

                                        <p>New Zealand (+64)</p>

                                 @elseif($transportVendorProfile->country =="505")

                                        <p>Nicaragua (+505)</p>

                                 @elseif($transportVendorProfile->country =="227")

                                        <p>Niger (+227)</p>

                                 @elseif($transportVendorProfile->country =="234")

                                        <p>Nigeria (+234)</p>

                                 @elseif($transportVendorProfile->country =="683")

                                        <p>Niue (+683)</p>

                                 @elseif($transportVendorProfile->country =="672")

                                        <p>Norfolk Islands (+672)</p>

                                 @elseif($transportVendorProfile->country =="670")

                                        <p>Northern Marianas (+670)</p>

                                 @elseif($transportVendorProfile->country =="47")

                                        <p>Norway (+47)</p>

                                 @elseif($transportVendorProfile->country =="968")

                                        <p>Oman (+968)</p>

								 @elseif($transportVendorProfile->country =="970")

                                        <p>Palestine (+970)</p>

                                 @elseif($transportVendorProfile->country =="680")

                                        <p>Palau (+680)</p>

                                 @elseif($transportVendorProfile->country =="92")

                                        <p>Pakistan (+92)</p>

                                 @elseif($transportVendorProfile->country =="507")

                                        <p>Panama (+507)</p>

                                 @elseif($transportVendorProfile->country =="675")

                                        <p>Papua New Guinea (+675)</p>

                                 @elseif($transportVendorProfile->country =="595")

                                        <p>Paraguay (+595)</p>

                                 @elseif($transportVendorProfile->country =="51")

                                        <p>Peru (+51)</p>

                                 @elseif($transportVendorProfile->country =="63")

                                        <p>Philippines (+63)</p>

                                 @elseif($transportVendorProfile->country =="48")

                                        <p>Poland (+48)</p>

                                 @elseif($transportVendorProfile->country =="351")

                                        <p>Portugal (+351)</p>

                                 @elseif($transportVendorProfile->country =="1787")

                                        <p>Puerto Rico (+1787)</p>

                                 @elseif($transportVendorProfile->country =="974")

                                        <p>Qatar (+974)</p>

                                 @elseif($transportVendorProfile->country =="262")

                                        <p>Reunion (+262)</p>

                                 @elseif($transportVendorProfile->country =="40")

                                        <p>Romania (+40)</p>

                                 @elseif($transportVendorProfile->country =="7")

                                        <p>Russia (+7)</p>

                                 @elseif($transportVendorProfile->country =="250")

                                        <p>Rwanda (+250)</p>

                                 @elseif($transportVendorProfile->country =="378")

                                        <p>San Marino (+378)</p>

                                 @elseif($transportVendorProfile->country =="239")

                                        <p>Sao Tome &amp; Principe (+239)</p>

                                 @elseif($transportVendorProfile->country =="966")

                                        <p>Saudi Arabia (+966)</p>

                                 @elseif($transportVendorProfile->country =="221")

                                        <p>Senegal (+221)</p>

                                 @elseif($transportVendorProfile->country =="381")

                                        <p>Serbia (+381)</p>

                                 @elseif($transportVendorProfile->country =="248")

                                        <p>Seychelles (+248)</p>

                                 @elseif($transportVendorProfile->country =="232")

                                        <p>Sierra Leone (+232)</p>

                                 @elseif($transportVendorProfile->country =="65")

                                        <p>Singapore (+65)</p>

                                 @elseif($transportVendorProfile->country =="421")

                                        <p>Slovak Republic (+421)</p>

                                 @elseif($transportVendorProfile->country =="386")

                                        <p>Slovenia (+386)</p>

                                 @elseif($transportVendorProfile->country =="677")

                                        <p>Solomon Islands (+677)</p>

                                 @elseif($transportVendorProfile->country =="252")

                                        <p>Somalia (+252)</p>

                                 @elseif($transportVendorProfile->country =="27")

                                        <p>South Africa (+27)</p>

                                 @elseif($transportVendorProfile->country =="34")

                                        <p>Spain (+34)</p>

                                 @elseif($transportVendorProfile->country =="94")

                                        <p>Sri Lanka (+94)</p>

                                 @elseif($transportVendorProfile->country =="290")

                                        <p>St. Helena (+290)</p>

                                 @elseif($transportVendorProfile->country =="1869")

                                        <p>St. Kitts (+1869)</p>

                                 @elseif($transportVendorProfile->country =="1758")

                                        <p>St. Lucia (+1758)</p>

                                 @elseif($transportVendorProfile->country =="249")

                                        <p>Sudan (+249)</p>

                                 @elseif($transportVendorProfile->country =="597")

                                        <p>Suriname (+597)</p>

                                 @elseif($transportVendorProfile->country =="268")

                                        <p>Swaziland (+268)</p>

                                 @elseif($transportVendorProfile->country =="46")

                                        <p>Sweden (+46)</p>

                                 @elseif($transportVendorProfile->country =="41")

                                        <p>Switzerland (+41)</p>

                                 @elseif($transportVendorProfile->country =="963")

                                        <p>Syria (+963)</p>

                                 @elseif($transportVendorProfile->country =="886")

                                        <p>Taiwan (+886)</p>

                                 @elseif($transportVendorProfile->country =="7")

                                        <p>Tajikstan (+7)</p>

                                 @elseif($transportVendorProfile->country =="66")

                                        <p>Thailand (+66)</p>

                                 @elseif($transportVendorProfile->country =="228")

                                        <p>Togo (+228)</p>

                                 @elseif($transportVendorProfile->country =="676")

                                        <p>Tonga (+676)</p>

                                 @elseif($transportVendorProfile->country =="1868")

                                        <p>Trinidad &amp; Tobago (+1868)</p>

                                 @elseif($transportVendorProfile->country =="216")

                                        <p>Tunisia (+216)</p>

                                 @elseif($transportVendorProfile->country =="90")

                                        <p>Turkey (+90)</p>

                                 @elseif($transportVendorProfile->country =="7")

                                        <p>Turkmenistan (+7)</p>

                                 @elseif($transportVendorProfile->country =="993")

                                        <p>Turkmenistan (+993)</p>

                                 @elseif($transportVendorProfile->country =="1649")

                                        <p>Turks &amp; Caicos Islands (+1649)</p>

                                 @elseif($transportVendorProfile->country =="688")

                                        <p>Tuvalu (+688)</p>

                                 @elseif($transportVendorProfile->country =="256")

                                        <p>Uganda (+256)</p>

                                 @elseif($transportVendorProfile->country =="44")

                                        <p>UK (+44)</p>

                                 @elseif($transportVendorProfile->country =="380")

                                        <p>Ukraine (+380)</p>

                                 @elseif($transportVendorProfile->country =="971")

                                        <p>United Arab Emirates (+971)</p>

                                 @elseif($transportVendorProfile->country =="598")

                                        <p>Uruguay (+598)</p>

                                 @elseif($transportVendorProfile->country =="1")

                                        <p>USA (+1)</p>

                                 @elseif($transportVendorProfile->country =="7")

                                        <p>Uzbekistan (+7)</p>

                                 @elseif($transportVendorProfile->country =="678")

                                        <p>Vanuatu (+678)</p>

                                 @elseif($transportVendorProfile->country =="379")

                                        <p>Vatican City (+379)</p>

                                 @elseif($transportVendorProfile->country =="58")

                                        <p>Venezuela (+58)</p>

                                 @elseif($transportVendorProfile->country =="84")

                                        <p>Vietnam (+84)</p>

                                 @elseif($transportVendorProfile->country =="84")

                                        <p>Virgin Islands - British (+1284)</p>

                                 @elseif($transportVendorProfile->country =="84")

                                        <p>Virgin Islands - US (+1340)</p>

                                 @elseif($transportVendorProfile->country =="681")

                                        <p>Wallis &amp; Futuna (+681)</p>

                                 @elseif($transportVendorProfile->country =="969")

                                        <p>Yemen (North)(+969)</p>

                                 @elseif($transportVendorProfile->country =="967")

                                        <p>Yemen (South)(+967)</p>

                                 @elseif($transportVendorProfile->country =="260")

                                        <p>Zambia (+260)</p>

                                 @elseif($transportVendorProfile->country =="263")

                                        <p>Zimbabwe (+263)</p>
                                @endif


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

                        <label class="col-md-2">Reservation Amount</label>

                        <div class="col-md-4">

                            <input type="text" name="Price" class="form-control" value=" $ {{$finalprice}}">
							<small class="text-muted">Only Amount Without Donation and Insurance</small>

                         </div>

						 <label class="col-md-2">Reservation Quantity</label>

                        <div class="col-md-4">

                            <input type="text" class="form-control" name="MaxOccupancy"  value="{{$transportreserves->qty}}">

                        </div>

                    </div>
					
					<div class="form-group">

                        <label class="col-md-2">Reservation Insurance Amount</label>

                        <div class="col-md-4">

						@if(($transportreserves->Insurance == 1) )

							<input type="text" name="Price" class="form-control" value=" $ 10">


						@else

							<input type="text" name="Price" class="form-control" value=" $ 0">

						@endif



                         </div>

						 <label class="col-md-2">Reservation Donation Amount</label>

                        <div class="col-md-4">

						@if(($transportreserves->Donation == 1))

                            <input type="text" class="form-control" name="MaxOccupancy"  value=" $ {{$transportreserves->Donation_amount}}">

						@else

							<input type="text" class="form-control" name="MaxOccupancy"  value=" $ 0">

						@endif

                        </div>

                    </div>
					
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

                             <input type="text" class="form-control" name="MaxOccupancy"  value="{{$transportreserves->getTransportOrderssupadmin->DriverName}}">

                        </div>

                        <label class="col-md-2">Reservation Payment Status</label>

                        <div class="col-md-4">

							<input type="text" class="form-control" name="MaxOccupancy"  value="{{$transportreserves->PaymentStatus}}">

                        </div>

                    </div>

					<div class="form-group">

                        <label class="col-md-2">Reservation Customer Name</label>

                        <div class="col-md-4">

                             <input type="text" class="form-control" name="Customer Name"  value="{{$transportreserves->getTransportOrdersbyusersupadmin->name}}">

                        </div>

                        <label class="col-md-2">Reservation Customer Email</label>

                        <div class="col-md-4">

							<input type="text" class="form-control" name="Customer Email"  value="{{$transportreserves->getTransportOrdersbyusersupadmin->email}}">

                        </div>

                    </div>

					<div class="form-group">

                        <label class="col-md-2">Reservation Customer Phone</label>

                        <div class="col-md-4">

							 <input type="text" class="form-control" name="Customer Phone"  value="+{{$transportreserves->getTransportOrdersbyuserprofilesupadmin->country}} - {{$transportreserves->getTransportOrdersbyuserprofilesupadmin->phone}}">

                        </div>



                        <label class="col-md-2">Reservation Customer Country</label>

                        <div class="col-md-4">




							    @if($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="")

                                        <p>No Country</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="213")

                                        <p>Algeria (+213)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="376")

                                        <p>Andorra (+376)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="244")

                                        <p>Angola (+244)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="1264")

                                        <p>Anguilla (+1264)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="1268")

                                        <p>Antigua &amp; Barbuda (+1268)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="54")

                                        <p>Argentina (+54)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="374")

                                        <p>Armenia (+374)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="297")

                                        <p>Aruba (+297)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="61")

                                        <p>Australia (+61)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="43")

                                        <p>Austria (+43)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="994")

                                        <p>Azerbaijan (+994)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="1242")

                                        <p>Bahamas (+1242)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="973")

                                        <p>Bahrain (+973)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="880")

                                        <p>Bangladesh (+880)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="1246")

                                        <p>Barbados (+1246)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="375")

                                        <p>Belarus (+375)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="32")

                                        <p>Belgium (+32)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="501")

                                        <p>Belize (+501)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="229")

                                        <p>Benin (+229)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="1441")

                                        <p>Bermuda (+1441)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="975")

                                        <p>Bhutan (+975)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="591")

                                        <p>Bolivia (+591)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="387")

                                        <p>Bosnia Herzegovina (+387)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="267")

                                        <p>Botswana (+267)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="55")

                                        <p>Brazil (+55)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="673")

                                        <p>Brunei (+673)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="359")

                                        <p>Bulgaria (+359)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="226")

                                        <p>Burkina Faso (+226)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="257")

                                        <p>Burundi (+257)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="855")

                                        <p>Cambodia (+855)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="237")

                                        <p>Cameroon (+237)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="1")

                                        <p>Canada (+1)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="238")

                                        <p>Cape Verde Islands (+238)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="1345")

                                        <p>Cayman Islands (+1345)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="236")

                                        <p>Central African Republic (+236)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="56")

                                        <p>Chile (+56)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="86")

                                        <p>China (+86)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="57")

                                        <p>Colombia (+57)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="269")

                                        <p>Comoros (+269)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="242")

                                        <p>Congo (+242)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="682")

                                        <p>Cook Islands (+682)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="506")

                                        <p>Costa Rica (+506)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="385")

                                        <p>Croatia (+385)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="53")

                                        <p>Cuba (+53)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="90392")

                                        <p>Cyprus North (+90392)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="357")

                                        <p>Cyprus South (+357)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="42")

                                        <p>Czech Republic (+42)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="45")

                                        <p>Denmark (+45)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="253")

                                        <p>Djibouti (+253)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="1809")

                                        <p>Dominica (+1809)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="1809")

                                        <p>Dominican Republic (+1809)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="593")

                                        <p>Ecuador (+593)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="20")

                                        <p>Egypt (+20)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="503")

                                        <p>El Salvador (+503)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="240")

                                        <p>Equatorial Guinea (+240)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="291")

                                        <p>Eritrea (+291)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="372")

                                        <p>Estonia (+372)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="251")

                                        <p>Ethiopia (+251)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="500")

                                        <p>Falkland Islands (+500)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="298")

                                        <p>Faroe Islands (+298)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="679")

                                        <p>Fiji (+679)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="358")

                                        <p>Finland (+358)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="33")

                                        <p>France (+33)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="594")

                                        <p>French Guiana (+594)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="689")

                                        <p>French Polynesia (+689)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="241")

                                        <p>Gabon (+241)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="220")

                                        <p>Gambia (+220)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="7880")

                                        <p>Georgia (+7880)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="49")

                                        <p>Germany (+49)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="233")

                                        <p>Ghana (+233)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="350")

                                        <p>Gibraltar (+350)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="30")

                                        <p>Greece (+30)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="299")

                                        <p>Greenland (+299)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="1473")

                                        <p>Grenada (+1473)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="590")

                                        <p>Guadeloupe (+590)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="671")

                                        <p>Guam (+671)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="502")

                                        <p>Guatemala (+502)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="224")

                                        <p>Guinea (+224)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="245")

                                        <p>Guinea - Bissau (+245)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="592")

                                        <p>Guyana (+592)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="509")

                                        <p>Haiti (+509)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="504")

                                        <p>Honduras (+504)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="852")

                                        <p>Hong Kong (+852)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="36")

                                        <p>Hungary (+36)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="354")

                                        <p>Iceland (+354)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="91")

                                        <p>India (+91)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="62")

                                        <p>Indonesia (+62)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="98")

                                        <p>Iran (+98)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="964")

                                        <p>Iraq (+964)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="353")

                                        <p>Ireland (+353)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="972")

                                        <p>Israel (+972)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="39")

                                        <p>Italy (+39)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="1876")

                                        <p>Jamaica (+1876)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="81")

                                        <p>Japan (+81)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="962")

                                        <p>Jordan (+962)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="7")

                                        <p>Kazakhstan (+7)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="254")

                                        <p>Kenya (+254)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="686")

                                        <p>Kiribati (+686)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="850")

                                        <p>Korea North (+850)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="82")

                                        <p>Korea South (+82)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="965")

                                        <p>Kuwait (+965)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="996")

                                        <p>Kyrgyzstan (+996)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="856")

                                        <p>Laos (+856)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="371")

                                        <p>Latvia (+371)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="961")

                                        <p>Lebanon (+961)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="266")

                                        <p>Lesotho (+266)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="231")

                                        <p>Liberia (+231)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="218")

                                        <p>Libya (+218)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="417")

                                        <p>Liechtenstein (+417)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="370")

                                        <p>Lithuania (+370)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="352")

                                        <p>Luxembourg (+352)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="853")

                                        <p>Macao (+853)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="389")

                                        <p>Macedonia (+389)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="261")

                                        <p>Madagascar (+261)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="265")

                                        <p>Malawi (+265)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="60")

                                        <p>Malaysia (+60)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="960")

                                        <p>Maldives (+960)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="223")

                                        <p>Mali (+223)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="356")

                                        <p>Malta (+356)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="692")

                                        <p>Marshall Islands (+692)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="596")

                                        <p>Martinique (+596)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="222")

                                        <p>Mauritania (+222)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="269")

                                        <p>Mayotte (+269)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="52")

                                        <p>Mexico (+52)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="691")

                                        <p>Micronesia (+691)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="373")

                                        <p>Moldova (+373)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="377")

                                        <p>Monaco (+377)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="976")

                                        <p>Mongolia (+976)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="1664")

                                        <p>Montserrat (+1664)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="212")

                                        <p>Morocco (+212)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="258")

                                        <p>Mozambique (+258)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="95")

                                        <p>Myanmar (+95)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="264")

                                        <p>Namibia (+264)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="674")

                                        <p>Nauru (+674)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="977")

                                        <p>Nepal (+977)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="31")

                                        <p>Netherlands (+31)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="687")

                                        <p>New Caledonia (+687)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="64")

                                        <p>New Zealand (+64)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="505")

                                        <p>Nicaragua (+505)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="227")

                                        <p>Niger (+227)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="234")

                                        <p>Nigeria (+234)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="683")

                                        <p>Niue (+683)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="672")

                                        <p>Norfolk Islands (+672)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="670")

                                        <p>Northern Marianas (+670)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="47")

                                        <p>Norway (+47)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="968")

                                        <p>Oman (+968)</p>

							     @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="970")

                                        <p>Palestine (+970)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="680")

                                        <p>Palau (+680)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="92")

                                        <p>Pakistan (+92)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="507")

                                        <p>Panama (+507)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="675")

                                        <p>Papua New Guinea (+675)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="595")

                                        <p>Paraguay (+595)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="51")

                                        <p>Peru (+51)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="63")

                                        <p>Philippines (+63)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="48")

                                        <p>Poland (+48)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="351")

                                        <p>Portugal (+351)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="1787")

                                        <p>Puerto Rico (+1787)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="974")

                                        <p>Qatar (+974)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="262")

                                        <p>Reunion (+262)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="40")

                                        <p>Romania (+40)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="7")

                                        <p>Russia (+7)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="250")

                                        <p>Rwanda (+250)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="378")

                                        <p>San Marino (+378)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="239")

                                        <p>Sao Tome &amp; Principe (+239)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="966")

                                        <p>Saudi Arabia (+966)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="221")

                                        <p>Senegal (+221)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="381")

                                        <p>Serbia (+381)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="248")

                                        <p>Seychelles (+248)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="232")

                                        <p>Sierra Leone (+232)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="65")

                                        <p>Singapore (+65)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="421")

                                        <p>Slovak Republic (+421)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="386")

                                        <p>Slovenia (+386)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="677")

                                        <p>Solomon Islands (+677)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="252")

                                        <p>Somalia (+252)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="27")

                                        <p>South Africa (+27)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="34")

                                        <p>Spain (+34)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="94")

                                        <p>Sri Lanka (+94)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="290")

                                        <p>St. Helena (+290)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="1869")

                                        <p>St. Kitts (+1869)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="1758")

                                        <p>St. Lucia (+1758)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="249")

                                        <p>Sudan (+249)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="597")

                                        <p>Suriname (+597)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="268")

                                        <p>Swaziland (+268)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="46")

                                        <p>Sweden (+46)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="41")

                                        <p>Switzerland (+41)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="963")

                                        <p>Syria (+963)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="886")

                                        <p>Taiwan (+886)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="7")

                                        <p>Tajikstan (+7)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="66")

                                        <p>Thailand (+66)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="228")

                                        <p>Togo (+228)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="676")

                                        <p>Tonga (+676)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="1868")

                                        <p>Trinidad &amp; Tobago (+1868)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="216")

                                        <p>Tunisia (+216)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="90")

                                        <p>Turkey (+90)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="7")

                                        <p>Turkmenistan (+7)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="993")

                                        <p>Turkmenistan (+993)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="1649")

                                        <p>Turks &amp; Caicos Islands (+1649)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="688")

                                        <p>Tuvalu (+688)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="256")

                                        <p>Uganda (+256)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="44")

                                        <p>UK (+44)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="380")

                                        <p>Ukraine (+380)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="971")

                                        <p>United Arab Emirates (+971)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="598")

                                        <p>Uruguay (+598)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="1")

                                        <p>USA (+1)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="7")

                                        <p>Uzbekistan (+7)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="678")

                                        <p>Vanuatu (+678)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="379")

                                        <p>Vatican City (+379)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="58")

                                        <p>Venezuela (+58)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="84")

                                        <p>Vietnam (+84)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="84")

                                        <p>Virgin Islands - British (+1284)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="84")

                                        <p>Virgin Islands - US (+1340)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="681")

                                        <p>Wallis &amp; Futuna (+681)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="969")

                                        <p>Yemen (North)(+969)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="967")

                                        <p>Yemen (South)(+967)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="260")

                                        <p>Zambia (+260)</p>

                                 @elseif($transportreserves->getTransportOrdersbyuserprofilesupadmin->country =="263")

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






