@extends('layouts.master')



@push('css')

@endpush



@section('content')

<div class="container-fluid">

    <!-- .row -->

    <div class="row">

        <div class="col-sm-12">

            <div class="white-box">

                <h3 class="box-title m-b-0">SuperAdmin Guide Reservation Details</h3>

				<br/>

                <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->

                <form  class="form-horizontal" >

					<?php

						$guideVendorName =  App\User::where('id',$guidereserves->getGuideOrderssupadmin->GuidesCreatedBy)->first();

						$guideVendorProfile =  App\Profile::where('user_id',$guidereserves->getGuideOrderssupadmin->GuidesCreatedBy)->first();

						// dd($transportVendorProfile);

					?>


                    <div class="form-group">

                        <label class="col-md-2">Reservation Name</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassName" class="form-control"  value="{{$guidereserves->getGuideOrderssupadmin->GuidesName??""}}">
						</div>

						<label class="col-md-2" >Reservation Receipt No</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassLocation" class="form-control"  value="{{$guidereserves->ReceiptNum??""}}">

                        </div>

                    </div>



					<div class="form-group">

                        <label class="col-md-2">Reservation Vendor Name</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassName" class="form-control"  value="{{$guideVendorName->name??""}}">
						</div>

						<label class="col-md-2" >Reservation Vendor Email</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassLocation" class="form-control"  value="{{$guideVendorName->email??""}}">

                        </div>

                    </div>

					<div class="form-group">

                        <label class="col-md-2">Reservation Vendor Phone No</label>

                        <div class="col-md-4">

                            <input type="text" name="GuestPassName" class="form-control"  value="+{{$guideVendorProfile->country}} - {{$guideVendorProfile->phone??""}}">
						</div>



						<label class="col-md-2" >Reservation Vendor Country</label>

                        <div class="col-md-4">

								@if($guideVendorProfile->country =="")

                                        <p>Select Country</p>

                                 @elseif($guideVendorProfile->country =="213")

                                        <p>Algeria (+213)</p>

                                 @elseif($guideVendorProfile->country =="376")

                                        <p>Andorra (+376)</p>

                                 @elseif($guideVendorProfile->country =="244")

                                        <p>Angola (+244)</p>

                                 @elseif($guideVendorProfile->country =="1264")

                                        <p>Anguilla (+1264)</p>

                                 @elseif($guideVendorProfile->country =="1268")

                                        <p>Antigua &amp; Barbuda (+1268)</p>

                                 @elseif($guideVendorProfile->country =="54")

                                        <p>Argentina (+54)</p>

                                 @elseif($guideVendorProfile->country =="374")

                                        <p>Armenia (+374)</p>

                                 @elseif($guideVendorProfile->country =="297")

                                        <p>Aruba (+297)</p>

                                 @elseif($guideVendorProfile->country =="61")

                                        <p>Australia (+61)</p>

                                 @elseif($guideVendorProfile->country =="43")

                                        <p>Austria (+43)</p>

                                 @elseif($guideVendorProfile->country =="994")

                                        <p>Azerbaijan (+994)</p>

                                 @elseif($guideVendorProfile->country =="1242")

                                        <p>Bahamas (+1242)</p>

                                 @elseif($guideVendorProfile->country =="973")

                                        <p>Bahrain (+973)</p>

                                 @elseif($guideVendorProfile->country =="880")

                                        <p>Bangladesh (+880)</p>

                                 @elseif($guideVendorProfile->country =="1246")

                                        <p>Barbados (+1246)</p>

                                 @elseif($guideVendorProfile->country =="375")

                                        <p>Belarus (+375)</p>

                                 @elseif($guideVendorProfile->country =="32")

                                        <p>Belgium (+32)</p>

                                 @elseif($guideVendorProfile->country =="501")

                                        <p>Belize (+501)</p>

                                 @elseif($guideVendorProfile->country =="229")

                                        <p>Benin (+229)</p>

                                 @elseif($guideVendorProfile->country =="1441")

                                        <p>Bermuda (+1441)</p>

                                 @elseif($guideVendorProfile->country =="975")

                                        <p>Bhutan (+975)</p>

                                 @elseif($guideVendorProfile->country =="591")

                                        <p>Bolivia (+591)</p>

                                 @elseif($guideVendorProfile->country =="387")

                                        <p>Bosnia Herzegovina (+387)</p>

                                 @elseif($guideVendorProfile->country =="267")

                                        <p>Botswana (+267)</p>

                                 @elseif($guideVendorProfile->country =="55")

                                        <p>Brazil (+55)</p>

                                 @elseif($guideVendorProfile->country =="673")

                                        <p>Brunei (+673)</p>

                                 @elseif($guideVendorProfile->country =="359")

                                        <p>Bulgaria (+359)</p>

                                 @elseif($guideVendorProfile->country =="226")

                                        <p>Burkina Faso (+226)</p>

                                 @elseif($guideVendorProfile->country =="257")

                                        <p>Burundi (+257)</p>

                                 @elseif($guideVendorProfile->country =="855")

                                        <p>Cambodia (+855)</p>

                                 @elseif($guideVendorProfile->country =="237")

                                        <p>Cameroon (+237)</p>

                                 @elseif($guideVendorProfile->country =="1")

                                        <p>Canada (+1)</p>

                                 @elseif($guideVendorProfile->country =="238")

                                        <p>Cape Verde Islands (+238)</p>

                                 @elseif($guideVendorProfile->country =="1345")

                                        <p>Cayman Islands (+1345)</p>

                                 @elseif($guideVendorProfile->country =="236")

                                        <p>Central African Republic (+236)</p>

                                 @elseif($guideVendorProfile->country =="56")

                                        <p>Chile (+56)</p>

                                 @elseif($guideVendorProfile->country =="86")

                                        <p>China (+86)</p>

                                 @elseif($guideVendorProfile->country =="57")

                                        <p>Colombia (+57)</p>

                                 @elseif($guideVendorProfile->country =="269")

                                        <p>Comoros (+269)</p>

                                 @elseif($guideVendorProfile->country =="242")

                                        <p>Congo (+242)</p>

                                 @elseif($guideVendorProfile->country =="682")

                                        <p>Cook Islands (+682)</p>

                                 @elseif($guideVendorProfile->country =="506")

                                        <p>Costa Rica (+506)</p>

                                 @elseif($guideVendorProfile->country =="385")

                                        <p>Croatia (+385)</p>

                                 @elseif($guideVendorProfile->country =="53")

                                        <p>Cuba (+53)</p>

                                 @elseif($guideVendorProfile->country =="90392")

                                        <p>Cyprus North (+90392)</p>

                                 @elseif($guideVendorProfile->country =="357")

                                        <p>Cyprus South (+357)</p>

                                 @elseif($guideVendorProfile->country =="42")

                                        <p>Czech Republic (+42)</p>

                                 @elseif($guideVendorProfile->country =="45")

                                        <p>Denmark (+45)</p>

                                 @elseif($guideVendorProfile->country =="253")

                                        <p>Djibouti (+253)</p>

                                 @elseif($guideVendorProfile->country =="1809")

                                        <p>Dominica (+1809)</p>

                                 @elseif($guideVendorProfile->country =="1809")

                                        <p>Dominican Republic (+1809)</p>

                                 @elseif($guideVendorProfile->country =="593")

                                        <p>Ecuador (+593)</p>

                                 @elseif($guideVendorProfile->country =="20")

                                        <p>Egypt (+20)</p>

                                 @elseif($guideVendorProfile->country =="503")

                                        <p>El Salvador (+503)</p>

                                 @elseif($guideVendorProfile->country =="240")

                                        <p>Equatorial Guinea (+240)</p>

                                 @elseif($guideVendorProfile->country =="291")

                                        <p>Eritrea (+291)</p>

                                 @elseif($guideVendorProfile->country =="372")

                                        <p>Estonia (+372)</p>

                                 @elseif($guideVendorProfile->country =="251")

                                        <p>Ethiopia (+251)</p>

                                 @elseif($guideVendorProfile->country =="500")

                                        <p>Falkland Islands (+500)</p>

                                 @elseif($guideVendorProfile->country =="298")

                                        <p>Faroe Islands (+298)</p>

                                 @elseif($guideVendorProfile->country =="679")

                                        <p>Fiji (+679)</p>

                                 @elseif($guideVendorProfile->country =="358")

                                        <p>Finland (+358)</p>

                                 @elseif($guideVendorProfile->country =="33")

                                        <p>France (+33)</p>

                                 @elseif($guideVendorProfile->country =="594")

                                        <p>French Guiana (+594)</p>

                                 @elseif($guideVendorProfile->country =="689")

                                        <p>French Polynesia (+689)</p>

                                 @elseif($guideVendorProfile->country =="241")

                                        <p>Gabon (+241)</p>

                                 @elseif($guideVendorProfile->country =="220")

                                        <p>Gambia (+220)</p>

                                 @elseif($guideVendorProfile->country =="7880")

                                        <p>Georgia (+7880)</p>

                                 @elseif($guideVendorProfile->country =="49")

                                        <p>Germany (+49)</p>

                                 @elseif($guideVendorProfile->country =="233")

                                        <p>Ghana (+233)</p>

                                 @elseif($guideVendorProfile->country =="350")

                                        <p>Gibraltar (+350)</p>

                                 @elseif($guideVendorProfile->country =="30")

                                        <p>Greece (+30)</p>

                                 @elseif($guideVendorProfile->country =="299")

                                        <p>Greenland (+299)</p>

                                 @elseif($guideVendorProfile->country =="1473")

                                        <p>Grenada (+1473)</p>

                                 @elseif($guideVendorProfile->country =="590")

                                        <p>Guadeloupe (+590)</p>

                                 @elseif($guideVendorProfile->country =="671")

                                        <p>Guam (+671)</p>

                                 @elseif($guideVendorProfile->country =="502")

                                        <p>Guatemala (+502)</p>

                                 @elseif($guideVendorProfile->country =="224")

                                        <p>Guinea (+224)</p>

                                 @elseif($guideVendorProfile->country =="245")

                                        <p>Guinea - Bissau (+245)</p>

                                 @elseif($guideVendorProfile->country =="592")

                                        <p>Guyana (+592)</p>

                                 @elseif($guideVendorProfile->country =="509")

                                        <p>Haiti (+509)</p>

                                 @elseif($guideVendorProfile->country =="504")

                                        <p>Honduras (+504)</p>

                                 @elseif($guideVendorProfile->country =="852")

                                        <p>Hong Kong (+852)</p>

                                 @elseif($guideVendorProfile->country =="36")

                                        <p>Hungary (+36)</p>

                                 @elseif($guideVendorProfile->country =="354")

                                        <p>Iceland (+354)</p>

                                 @elseif($guideVendorProfile->country =="91")

                                        <p>India (+91)</p>

                                 @elseif($guideVendorProfile->country =="62")

                                        <p>Indonesia (+62)</p>

                                 @elseif($guideVendorProfile->country =="98")

                                        <p>Iran (+98)</p>

                                 @elseif($guideVendorProfile->country =="964")

                                        <p>Iraq (+964)</p>

                                 @elseif($guideVendorProfile->country =="353")

                                        <p>Ireland (+353)</p>

                                 @elseif($guideVendorProfile->country =="972")

                                        <p>Israel (+972)</p>

                                 @elseif($guideVendorProfile->country =="39")

                                        <p>Italy (+39)</p>

                                 @elseif($guideVendorProfile->country =="1876")

                                        <p>Jamaica (+1876)</p>

                                 @elseif($guideVendorProfile->country =="81")

                                        <p>Japan (+81)</p>

                                 @elseif($guideVendorProfile->country =="962")

                                        <p>Jordan (+962)</p>

                                 @elseif($guideVendorProfile->country =="7")

                                        <p>Kazakhstan (+7)</p>

                                 @elseif($guideVendorProfile->country =="254")

                                        <p>Kenya (+254)</p>

                                 @elseif($guideVendorProfile->country =="686")

                                        <p>Kiribati (+686)</p>

                                 @elseif($guideVendorProfile->country =="850")

                                        <p>Korea North (+850)</p>

                                 @elseif($guideVendorProfile->country =="82")

                                        <p>Korea South (+82)</p>

                                 @elseif($guideVendorProfile->country =="965")

                                        <p>Kuwait (+965)</p>

                                 @elseif($guideVendorProfile->country =="996")

                                        <p>Kyrgyzstan (+996)</p>

                                 @elseif($guideVendorProfile->country =="856")

                                        <p>Laos (+856)</p>

                                 @elseif($guideVendorProfile->country =="371")

                                        <p>Latvia (+371)</p>

                                 @elseif($guideVendorProfile->country =="961")

                                        <p>Lebanon (+961)</p>

                                 @elseif($guideVendorProfile->country =="266")

                                        <p>Lesotho (+266)</p>

                                 @elseif($guideVendorProfile->country =="231")

                                        <p>Liberia (+231)</p>

                                 @elseif($guideVendorProfile->country =="218")

                                        <p>Libya (+218)</p>

                                 @elseif($guideVendorProfile->country =="417")

                                        <p>Liechtenstein (+417)</p>

                                 @elseif($guideVendorProfile->country =="370")

                                        <p>Lithuania (+370)</p>

                                 @elseif($guideVendorProfile->country =="352")

                                        <p>Luxembourg (+352)</p>

                                 @elseif($guideVendorProfile->country =="853")

                                        <p>Macao (+853)</p>

                                 @elseif($guideVendorProfile->country =="389")

                                        <p>Macedonia (+389)</p>

                                 @elseif($guideVendorProfile->country =="261")

                                        <p>Madagascar (+261)</p>

                                 @elseif($guideVendorProfile->country =="265")

                                        <p>Malawi (+265)</p>

                                 @elseif($guideVendorProfile->country =="60")

                                        <p>Malaysia (+60)</p>

                                 @elseif($guideVendorProfile->country =="960")

                                        <p>Maldives (+960)</p>

                                 @elseif($guideVendorProfile->country =="223")

                                        <p>Mali (+223)</p>

                                 @elseif($guideVendorProfile->country =="356")

                                        <p>Malta (+356)</p>

                                 @elseif($guideVendorProfile->country =="692")

                                        <p>Marshall Islands (+692)</p>

                                 @elseif($guideVendorProfile->country =="596")

                                        <p>Martinique (+596)</p>

                                 @elseif($guideVendorProfile->country =="222")

                                        <p>Mauritania (+222)</p>

                                 @elseif($guideVendorProfile->country =="269")

                                        <p>Mayotte (+269)</p>

                                 @elseif($guideVendorProfile->country =="52")

                                        <p>Mexico (+52)</p>

                                 @elseif($guideVendorProfile->country =="691")

                                        <p>Micronesia (+691)</p>

                                 @elseif($guideVendorProfile->country =="373")

                                        <p>Moldova (+373)</p>

                                 @elseif($guideVendorProfile->country =="377")

                                        <p>Monaco (+377)</p>

                                 @elseif($guideVendorProfile->country =="976")

                                        <p>Mongolia (+976)</p>

                                 @elseif($guideVendorProfile->country =="1664")

                                        <p>Montserrat (+1664)</p>

                                 @elseif($guideVendorProfile->country =="212")

                                        <p>Morocco (+212)</p>

                                 @elseif($guideVendorProfile->country =="258")

                                        <p>Mozambique (+258)</p>

                                 @elseif($guideVendorProfile->country =="95")

                                        <p>Myanmar (+95)</p>

                                 @elseif($guideVendorProfile->country =="264")

                                        <p>Namibia (+264)</p>

                                 @elseif($guideVendorProfile->country =="674")

                                        <p>Nauru (+674)</p>

                                 @elseif($guideVendorProfile->country =="977")

                                        <p>Nepal (+977)</p>

                                 @elseif($guideVendorProfile->country =="31")

                                        <p>Netherlands (+31)</p>

                                 @elseif($guideVendorProfile->country =="687")

                                        <p>New Caledonia (+687)</p>

                                 @elseif($guideVendorProfile->country =="64")

                                        <p>New Zealand (+64)</p>

                                 @elseif($guideVendorProfile->country =="505")

                                        <p>Nicaragua (+505)</p>

                                 @elseif($guideVendorProfile->country =="227")

                                        <p>Niger (+227)</p>

                                 @elseif($guideVendorProfile->country =="234")

                                        <p>Nigeria (+234)</p>

                                 @elseif($guideVendorProfile->country =="683")

                                        <p>Niue (+683)</p>

                                 @elseif($guideVendorProfile->country =="672")

                                        <p>Norfolk Islands (+672)</p>

                                 @elseif($guideVendorProfile->country =="670")

                                        <p>Northern Marianas (+670)</p>

                                 @elseif($guideVendorProfile->country =="47")

                                        <p>Norway (+47)</p>

                                 @elseif($guideVendorProfile->country =="968")

                                        <p>Oman (+968)</p>

								 @elseif($guideVendorProfile->country =="970")

                                        <p>Palestine (+970)</p>

                                 @elseif($guideVendorProfile->country =="680")

                                        <p>Palau (+680)</p>

                                 @elseif($guideVendorProfile->country =="92")

                                        <p>Pakistan (+92)</p>

                                 @elseif($guideVendorProfile->country =="507")

                                        <p>Panama (+507)</p>

                                 @elseif($guideVendorProfile->country =="675")

                                        <p>Papua New Guinea (+675)</p>

                                 @elseif($guideVendorProfile->country =="595")

                                        <p>Paraguay (+595)</p>

                                 @elseif($guideVendorProfile->country =="51")

                                        <p>Peru (+51)</p>

                                 @elseif($guideVendorProfile->country =="63")

                                        <p>Philippines (+63)</p>

                                 @elseif($guideVendorProfile->country =="48")

                                        <p>Poland (+48)</p>

                                 @elseif($guideVendorProfile->country =="351")

                                        <p>Portugal (+351)</p>

                                 @elseif($guideVendorProfile->country =="1787")

                                        <p>Puerto Rico (+1787)</p>

                                 @elseif($guideVendorProfile->country =="974")

                                        <p>Qatar (+974)</p>

                                 @elseif($guideVendorProfile->country =="262")

                                        <p>Reunion (+262)</p>

                                 @elseif($guideVendorProfile->country =="40")

                                        <p>Romania (+40)</p>

                                 @elseif($guideVendorProfile->country =="7")

                                        <p>Russia (+7)</p>

                                 @elseif($guideVendorProfile->country =="250")

                                        <p>Rwanda (+250)</p>

                                 @elseif($guideVendorProfile->country =="378")

                                        <p>San Marino (+378)</p>

                                 @elseif($guideVendorProfile->country =="239")

                                        <p>Sao Tome &amp; Principe (+239)</p>

                                 @elseif($guideVendorProfile->country =="966")

                                        <p>Saudi Arabia (+966)</p>

                                 @elseif($guideVendorProfile->country =="221")

                                        <p>Senegal (+221)</p>

                                 @elseif($guideVendorProfile->country =="381")

                                        <p>Serbia (+381)</p>

                                 @elseif($guideVendorProfile->country =="248")

                                        <p>Seychelles (+248)</p>

                                 @elseif($guideVendorProfile->country =="232")

                                        <p>Sierra Leone (+232)</p>

                                 @elseif($guideVendorProfile->country =="65")

                                        <p>Singapore (+65)</p>

                                 @elseif($guideVendorProfile->country =="421")

                                        <p>Slovak Republic (+421)</p>

                                 @elseif($guideVendorProfile->country =="386")

                                        <p>Slovenia (+386)</p>

                                 @elseif($guideVendorProfile->country =="677")

                                        <p>Solomon Islands (+677)</p>

                                 @elseif($guideVendorProfile->country =="252")

                                        <p>Somalia (+252)</p>

                                 @elseif($guideVendorProfile->country =="27")

                                        <p>South Africa (+27)</p>

                                 @elseif($guideVendorProfile->country =="34")

                                        <p>Spain (+34)</p>

                                 @elseif($guideVendorProfile->country =="94")

                                        <p>Sri Lanka (+94)</p>

                                 @elseif($guideVendorProfile->country =="290")

                                        <p>St. Helena (+290)</p>

                                 @elseif($guideVendorProfile->country =="1869")

                                        <p>St. Kitts (+1869)</p>

                                 @elseif($guideVendorProfile->country =="1758")

                                        <p>St. Lucia (+1758)</p>

                                 @elseif($guideVendorProfile->country =="249")

                                        <p>Sudan (+249)</p>

                                 @elseif($guideVendorProfile->country =="597")

                                        <p>Suriname (+597)</p>

                                 @elseif($guideVendorProfile->country =="268")

                                        <p>Swaziland (+268)</p>

                                 @elseif($guideVendorProfile->country =="46")

                                        <p>Sweden (+46)</p>

                                 @elseif($guideVendorProfile->country =="41")

                                        <p>Switzerland (+41)</p>

                                 @elseif($guideVendorProfile->country =="963")

                                        <p>Syria (+963)</p>

                                 @elseif($guideVendorProfile->country =="886")

                                        <p>Taiwan (+886)</p>

                                 @elseif($guideVendorProfile->country =="7")

                                        <p>Tajikstan (+7)</p>

                                 @elseif($guideVendorProfile->country =="66")

                                        <p>Thailand (+66)</p>

                                 @elseif($guideVendorProfile->country =="228")

                                        <p>Togo (+228)</p>

                                 @elseif($guideVendorProfile->country =="676")

                                        <p>Tonga (+676)</p>

                                 @elseif($guideVendorProfile->country =="1868")

                                        <p>Trinidad &amp; Tobago (+1868)</p>

                                 @elseif($guideVendorProfile->country =="216")

                                        <p>Tunisia (+216)</p>

                                 @elseif($guideVendorProfile->country =="90")

                                        <p>Turkey (+90)</p>

                                 @elseif($guideVendorProfile->country =="7")

                                        <p>Turkmenistan (+7)</p>

                                 @elseif($guideVendorProfile->country =="993")

                                        <p>Turkmenistan (+993)</p>

                                 @elseif($guideVendorProfile->country =="1649")

                                        <p>Turks &amp; Caicos Islands (+1649)</p>

                                 @elseif($guideVendorProfile->country =="688")

                                        <p>Tuvalu (+688)</p>

                                 @elseif($guideVendorProfile->country =="256")

                                        <p>Uganda (+256)</p>

                                 @elseif($guideVendorProfile->country =="44")

                                        <p>UK (+44)</p>

                                 @elseif($guideVendorProfile->country =="380")

                                        <p>Ukraine (+380)</p>

                                 @elseif($guideVendorProfile->country =="971")

                                        <p>United Arab Emirates (+971)</p>

                                 @elseif($guideVendorProfile->country =="598")

                                        <p>Uruguay (+598)</p>

                                 @elseif($guideVendorProfile->country =="1")

                                        <p>USA (+1)</p>

                                 @elseif($guideVendorProfile->country =="7")

                                        <p>Uzbekistan (+7)</p>

                                 @elseif($guideVendorProfile->country =="678")

                                        <p>Vanuatu (+678)</p>

                                 @elseif($guideVendorProfile->country =="379")

                                        <p>Vatican City (+379)</p>

                                 @elseif($guideVendorProfile->country =="58")

                                        <p>Venezuela (+58)</p>

                                 @elseif($guideVendorProfile->country =="84")

                                        <p>Vietnam (+84)</p>

                                 @elseif($guideVendorProfile->country =="1284")

                                        <p>Virgin Islands - British (+1284)</p>

                                 @elseif($guideVendorProfile->country =="84")

                                        <p>Virgin Islands - US (+1340)</p>

                                 @elseif($guideVendorProfile->country =="681")

                                        <p>Wallis &amp; Futuna (+681)</p>

                                 @elseif($guideVendorProfile->country =="969")

                                        <p>Yemen (North)(+969)</p>

                                 @elseif($guideVendorProfile->country =="967")

                                        <p>Yemen (South)(+967)</p>

                                 @elseif($guideVendorProfile->country =="260")

                                        <p>Zambia (+260)</p>

                                 @elseif($guideVendorProfile->country =="263")

                                        <p>Zimbabwe (+263)</p>
                                @endif


                        </div>

                    </div>



					<?php



							if(($guidereserves->Insurance == 1) && ($guidereserves->Donation == 0)){

								$finalprice = 0;

								$finalprice = $guidereserves->TotalPrice - 10;

							}elseif(($guidereserves->Donation == 1) && ($guidereserves->Insurance == 0)){

								$finalprice = 0;

								$finalprice = $guidereserves->TotalPrice - $guidereserves->Donation_amount;

							}elseif(($guidereserves->Insurance == 1) && ($guidereserves->Insurance == 1) ){

								$finalprice = 0;

								$finalprice = $guidereserves->TotalPrice - $guidereserves->Donation_amount - 10;

							}else{

								$finalprice = 0;

								$finalprice = $guidereserves->TotalPrice;

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

                            <input type="text" class="form-control" name="MaxOccupancy"  value="{{$guidereserves->qty}}">

                        </div>

                    </div>



					<div class="form-group">

						 <label class="col-md-2">Reservation Status</label>

                        <div class="col-md-4">

                            <input type="text" class="form-control" name="MaxOccupancy"  value="{{$guidereserves->ReservationStatus}}">

                        </div>

						<label class="col-md-2">Reservation Payment Status</label>

                        <div class="col-md-4">

							<input type="text" class="form-control" name="MaxOccupancy"  value="{{$guidereserves->PaymentStatus}}">

                        </div>

                    </div>


					<div class="form-group">

                        <label class="col-md-2">Reservation Insurance Amount</label>

                        <div class="col-md-4">

						@if(($guidereserves->Insurance == 1) )

							<input type="text" name="Price" class="form-control" value=" $ 10">


						@else

							<input type="text" name="Price" class="form-control" value=" $ 0">

						@endif



                         </div>

						 <label class="col-md-2">Reservation Donation Amount</label>

                        <div class="col-md-4">

						@if(($guidereserves->Donation == 1))

                            <input type="text" class="form-control" name="MaxOccupancy"  value=" $ {{$guidereserves->Donation_amount}}">

						@else

							<input type="text" class="form-control" name="MaxOccupancy"  value=" $ 0">

						@endif

                        </div>

                    </div>


					<div class="form-group">

                        <label class="col-md-2">Reservation Customer Name</label>

                        <div class="col-md-4">

                             <input type="text" class="form-control" name="Customer Name"  value="{{$guidereserves->getGuideOrdersbyusersupadmin->name}}">

                        </div>

                        <label class="col-md-2">Reservation Customer Email</label>

                        <div class="col-md-4">

							<input type="text" class="form-control" name="Customer Email"  value="{{$guidereserves->getGuideOrdersbyusersupadmin->email}}">

                        </div>

                    </div>

					<div class="form-group">

                        <label class="col-md-2">Reservation Customer Phone</label>

                        <div class="col-md-4">

							 <input type="text" class="form-control" name="Customer Phone"  value="+{{$guidereserves->getGuideOrdersbyuserprofilesupadmin->country}} - {{$guidereserves->getGuideOrdersbyuserprofilesupadmin->phone}}">

                        </div>



                        <label class="col-md-2">Reservation Customer Country</label>

                        <div class="col-md-4">



							    @if($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="")

                                        <p>No Country</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="213")

                                        <p>Algeria (+213)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="376")

                                        <p>Andorra (+376)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="244")

                                        <p>Angola (+244)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1264")

                                        <p>Anguilla (+1264)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1268")

                                        <p>Antigua &amp; Barbuda (+1268)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="54")

                                        <p>Argentina (+54)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="374")

                                        <p>Armenia (+374)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="297")

                                        <p>Aruba (+297)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="61")

                                        <p>Australia (+61)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="43")

                                        <p>Austria (+43)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="994")

                                        <p>Azerbaijan (+994)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1242")

                                        <p>Bahamas (+1242)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="973")

                                        <p>Bahrain (+973)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="880")

                                        <p>Bangladesh (+880)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1246")

                                        <p>Barbados (+1246)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="375")

                                        <p>Belarus (+375)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="32")

                                        <p>Belgium (+32)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="501")

                                        <p>Belize (+501)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="229")

                                        <p>Benin (+229)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1441")

                                        <p>Bermuda (+1441)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="975")

                                        <p>Bhutan (+975)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="591")

                                        <p>Bolivia (+591)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="387")

                                        <p>Bosnia Herzegovina (+387)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="267")

                                        <p>Botswana (+267)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="55")

                                        <p>Brazil (+55)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="673")

                                        <p>Brunei (+673)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="359")

                                        <p>Bulgaria (+359)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="226")

                                        <p>Burkina Faso (+226)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="257")

                                        <p>Burundi (+257)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="855")

                                        <p>Cambodia (+855)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="237")

                                        <p>Cameroon (+237)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1")

                                        <p>Canada (+1)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="238")

                                        <p>Cape Verde Islands (+238)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1345")

                                        <p>Cayman Islands (+1345)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="236")

                                        <p>Central African Republic (+236)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="56")

                                        <p>Chile (+56)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="86")

                                        <p>China (+86)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="57")

                                        <p>Colombia (+57)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="269")

                                        <p>Comoros (+269)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="242")

                                        <p>Congo (+242)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="682")

                                        <p>Cook Islands (+682)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="506")

                                        <p>Costa Rica (+506)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="385")

                                        <p>Croatia (+385)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="53")

                                        <p>Cuba (+53)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="90392")

                                        <p>Cyprus North (+90392)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="357")

                                        <p>Cyprus South (+357)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="42")

                                        <p>Czech Republic (+42)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="45")

                                        <p>Denmark (+45)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="253")

                                        <p>Djibouti (+253)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1809")

                                        <p>Dominica (+1809)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1809")

                                        <p>Dominican Republic (+1809)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="593")

                                        <p>Ecuador (+593)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="20")

                                        <p>Egypt (+20)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="503")

                                        <p>El Salvador (+503)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="240")

                                        <p>Equatorial Guinea (+240)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="291")

                                        <p>Eritrea (+291)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="372")

                                        <p>Estonia (+372)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="251")

                                        <p>Ethiopia (+251)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="500")

                                        <p>Falkland Islands (+500)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="298")

                                        <p>Faroe Islands (+298)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="679")

                                        <p>Fiji (+679)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="358")

                                        <p>Finland (+358)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="33")

                                        <p>France (+33)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="594")

                                        <p>French Guiana (+594)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="689")

                                        <p>French Polynesia (+689)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="241")

                                        <p>Gabon (+241)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="220")

                                        <p>Gambia (+220)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="7880")

                                        <p>Georgia (+7880)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="49")

                                        <p>Germany (+49)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="233")

                                        <p>Ghana (+233)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="350")

                                        <p>Gibraltar (+350)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="30")

                                        <p>Greece (+30)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="299")

                                        <p>Greenland (+299)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1473")

                                        <p>Grenada (+1473)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="590")

                                        <p>Guadeloupe (+590)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="671")

                                        <p>Guam (+671)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="502")

                                        <p>Guatemala (+502)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="224")

                                        <p>Guinea (+224)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="245")

                                        <p>Guinea - Bissau (+245)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="592")

                                        <p>Guyana (+592)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="509")

                                        <p>Haiti (+509)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="504")

                                        <p>Honduras (+504)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="852")

                                        <p>Hong Kong (+852)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="36")

                                        <p>Hungary (+36)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="354")

                                        <p>Iceland (+354)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="91")

                                        <p>India (+91)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="62")

                                        <p>Indonesia (+62)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="98")

                                        <p>Iran (+98)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="964")

                                        <p>Iraq (+964)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="353")

                                        <p>Ireland (+353)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="972")

                                        <p>Israel (+972)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="39")

                                        <p>Italy (+39)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1876")

                                        <p>Jamaica (+1876)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="81")

                                        <p>Japan (+81)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="962")

                                        <p>Jordan (+962)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="7")

                                        <p>Kazakhstan (+7)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="254")

                                        <p>Kenya (+254)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="686")

                                        <p>Kiribati (+686)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="850")

                                        <p>Korea North (+850)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="82")

                                        <p>Korea South (+82)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="965")

                                        <p>Kuwait (+965)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="996")

                                        <p>Kyrgyzstan (+996)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="856")

                                        <p>Laos (+856)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="371")

                                        <p>Latvia (+371)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="961")

                                        <p>Lebanon (+961)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="266")

                                        <p>Lesotho (+266)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="231")

                                        <p>Liberia (+231)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="218")

                                        <p>Libya (+218)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="417")

                                        <p>Liechtenstein (+417)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="370")

                                        <p>Lithuania (+370)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="352")

                                        <p>Luxembourg (+352)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="853")

                                        <p>Macao (+853)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="389")

                                        <p>Macedonia (+389)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="261")

                                        <p>Madagascar (+261)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="265")

                                        <p>Malawi (+265)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="60")

                                        <p>Malaysia (+60)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="960")

                                        <p>Maldives (+960)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="223")

                                        <p>Mali (+223)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="356")

                                        <p>Malta (+356)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="692")

                                        <p>Marshall Islands (+692)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="596")

                                        <p>Martinique (+596)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="222")

                                        <p>Mauritania (+222)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="269")

                                        <p>Mayotte (+269)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="52")

                                        <p>Mexico (+52)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="691")

                                        <p>Micronesia (+691)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="373")

                                        <p>Moldova (+373)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="377")

                                        <p>Monaco (+377)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="976")

                                        <p>Mongolia (+976)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1664")

                                        <p>Montserrat (+1664)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="212")

                                        <p>Morocco (+212)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="258")

                                        <p>Mozambique (+258)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="95")

                                        <p>Myanmar (+95)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="264")

                                        <p>Namibia (+264)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="674")

                                        <p>Nauru (+674)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="977")

                                        <p>Nepal (+977)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="31")

                                        <p>Netherlands (+31)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="687")

                                        <p>New Caledonia (+687)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="64")

                                        <p>New Zealand (+64)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="505")

                                        <p>Nicaragua (+505)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="227")

                                        <p>Niger (+227)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="234")

                                        <p>Nigeria (+234)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="683")

                                        <p>Niue (+683)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="672")

                                        <p>Norfolk Islands (+672)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="670")

                                        <p>Northern Marianas (+670)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="47")

                                        <p>Norway (+47)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="968")

                                        <p>Oman (+968)</p>

							     @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="970")

                                        <p>Palestine (+970)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="680")

                                        <p>Palau (+680)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="92")

                                        <p>Pakistan (+92)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="507")

                                        <p>Panama (+507)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="675")

                                        <p>Papua New Guinea (+675)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="595")

                                        <p>Paraguay (+595)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="51")

                                        <p>Peru (+51)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="63")

                                        <p>Philippines (+63)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="48")

                                        <p>Poland (+48)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="351")

                                        <p>Portugal (+351)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1787")

                                        <p>Puerto Rico (+1787)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="974")

                                        <p>Qatar (+974)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="262")

                                        <p>Reunion (+262)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="40")

                                        <p>Romania (+40)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="7")

                                        <p>Russia (+7)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="250")

                                        <p>Rwanda (+250)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="378")

                                        <p>San Marino (+378)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="239")

                                        <p>Sao Tome &amp; Principe (+239)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="966")

                                        <p>Saudi Arabia (+966)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="221")

                                        <p>Senegal (+221)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="381")

                                        <p>Serbia (+381)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="248")

                                        <p>Seychelles (+248)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="232")

                                        <p>Sierra Leone (+232)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="65")

                                        <p>Singapore (+65)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="421")

                                        <p>Slovak Republic (+421)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="386")

                                        <p>Slovenia (+386)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="677")

                                        <p>Solomon Islands (+677)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="252")

                                        <p>Somalia (+252)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="27")

                                        <p>South Africa (+27)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="34")

                                        <p>Spain (+34)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="94")

                                        <p>Sri Lanka (+94)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="290")

                                        <p>St. Helena (+290)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1869")

                                        <p>St. Kitts (+1869)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1758")

                                        <p>St. Lucia (+1758)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="249")

                                        <p>Sudan (+249)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="597")

                                        <p>Suriname (+597)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="268")

                                        <p>Swaziland (+268)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="46")

                                        <p>Sweden (+46)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="41")

                                        <p>Switzerland (+41)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="963")

                                        <p>Syria (+963)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="886")

                                        <p>Taiwan (+886)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="7")

                                        <p>Tajikstan (+7)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="66")

                                        <p>Thailand (+66)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="228")

                                        <p>Togo (+228)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="676")

                                        <p>Tonga (+676)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1868")

                                        <p>Trinidad &amp; Tobago (+1868)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="216")

                                        <p>Tunisia (+216)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="90")

                                        <p>Turkey (+90)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="7")

                                        <p>Turkmenistan (+7)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="993")

                                        <p>Turkmenistan (+993)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1649")

                                        <p>Turks &amp; Caicos Islands (+1649)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="688")

                                        <p>Tuvalu (+688)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="256")

                                        <p>Uganda (+256)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="44")

                                        <p>UK (+44)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="380")

                                        <p>Ukraine (+380)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="971")

                                        <p>United Arab Emirates (+971)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="598")

                                        <p>Uruguay (+598)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1")

                                        <p>USA (+1)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="7")

                                        <p>Uzbekistan (+7)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="678")

                                        <p>Vanuatu (+678)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="379")

                                        <p>Vatican City (+379)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="58")

                                        <p>Venezuela (+58)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="84")

                                        <p>Vietnam (+84)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1284")

                                        <p>Virgin Islands - British (+1284)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="1340")

                                        <p>Virgin Islands - US (+1340)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="681")

                                        <p>Wallis &amp; Futuna (+681)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="969")

                                        <p>Yemen (North)(+969)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="967")

                                        <p>Yemen (South)(+967)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="260")

                                        <p>Zambia (+260)</p>

                                 @elseif($guidereserves->getGuideOrdersbyuserprofilesupadmin->country =="263")

                                        <p>Zimbabwe (+263)</p>
                                @endif


                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-md-12">Reservation Customer Notes</label>

                        <div class="col-md-12">

                            <textarea class="form-control" name="HouseRules" rows="5">{{$guidereserves->NotesByCustomer}}</textarea>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-md-12">Reservation Created Time</label>

                        <div class="col-md-12">

                            <input type="datetime" class="form-control"  value="{{$guidereserves->updated_at>??''}}">

                        </div>

                    </div>

            </div>

        </div>

    </div>

<!-- ===== Right-Sidebar ===== -->

@include('layouts.partials.right-sidebar')

</div>

@endsection
