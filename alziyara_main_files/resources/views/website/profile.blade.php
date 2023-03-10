@extends('website.layout.master')
@push('css')
    <style>
        .inner-col{
            border: 1px solid black;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0px 0px 10px grey;
            margin-bottom: 50px;
        }
        .user_profile h1{
            font-weight: bold;
        }
        .user_profile_img{
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .user_profile .location {
            font-size: 16px;
        }
        .user_profile h3{
            font-weight: bold;
        }
        .user_profile h4{
            color: rgb(92, 92, 92);
            font-weight: 400;
        }
        .user_profile p{
            padding-top: 10px;
            color: rgb(113 153 233);
            font-size: 16px;
        }
        .user_profile input{
            width: 100%;
            padding: 10px 20px;
            background-color: #f3f3f3;
            border: none;
            outline: none;
            color: rgb(92, 92, 92);
            font-weight: 600;
        }
        .user_profile input:focus {
            background: white;
        }
        .user_profile input:focus {
            background: white;
            border: 1px solid grey;
            border-radius: 3px;
        }
        .buttonside .col-md-12:last-child {
            position: relative;
        }
        .buttonside .col-md-12:last-child button {
            position: absolute;
            right: 13px;
            top: 50px;
        }
        textarea {
            overflow: auto;
            resize: none;
            outline: none;
            border: none;
            font-size: 13px;
            width: 100%;
            color: grey;
            height: 105px !important;
        }
        .inner-col .form-control {
            display: block;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #f3f3f3;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            font-weight: 600;
        }
        @media(max-width:991px){
            .buttonside .col-md-12:last-child button {
                position: absolute;
                right: 13px;
                top: 15px;
            }
        }
        img.profile_pic { height: 200px; border-radius: 50%; }
        .image-upload>input {
            display: none;
        }
        .image-upload{
            text-align: center;
        }
        .pr-btn {
            text-align: center;
            padding: 13px 0;
            margin-top: 50px;
        }

        .pr-btn .profile_btn {
            color: white;
            text-decoration: none;
            background: #7199e9;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            font-size: 14px;
        }
        .pr-btn .profile_btn i {
            padding-right: 10px;
        }
    </style>
@endpush
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="user_profile">
        <div class="container">
            <h1 class="mt-5">My Profile</h1>
            <div class="pr-btn">
                <a href="{{route('profile')}}" class="profile_btn"><i class="fas fa-user"></i> My Profile</a>
                <a href="{{route('mybook')}}" class="profile_btn"><i class="fas fa-book-open"></i> My Bookings</a>
            </div>

            <div class="inner-col">
                <form action="{{url('update-profile')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    <input type="text" value="{{$profile_data->pic}}" name="old_pic" hidden>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <img src="{{asset('website')}}/{{$profile_data->pic??'img/not_available.png'}}" alt="" class="img-fluid user_profile_img" id="profile_pic">
                            <div class="image-upload">
                                <label for="file-input">
                                    <p><i class="fa fa-image" aria-hidden="true"></i> Choose Profile Picture</p>
                                </label>
                                <input id="file-input" class="pic" name="pic" type="file" />
                            </div>
                            <h3 class="mt-2">{{$profile_data->user->name??''}}</h3>
                            {{--<textarea name="bio" placeholder="bio..." required>{{$profile_data->bio??''}}</textarea>--}}
                        </div>
                        <div class="col-md-8 col-sm-12">
                            @csrf

                            <div class="row ">
                                <div class="col-lg-6 mt-3">
                                    <h4>Personal Information</h4>
                                    <div class="form-group row">
                                        <div class="col-md-12 col-sm-12">
                                            <p>Name</p>
                                            <input type="text" name="name" placeholder="Name" value="{{Auth::user()->name??''}}" required>
                                        </div>
                                        {{--<div class="col-md-12 col-sm-12">--}}
                                            {{--<p>Birth Date</p>--}}
                                            {{--<input type="date" name="dob" placeholder="Date of Birth" value="{{$profile_data->dob??''}}" required>--}}
                                        {{--</div>--}}
                                        <div class="col-md-12 col-sm-12">
                                            <p>Country</p>
                                            <select class="form-control" name="country" id="">
                                                <option value="" selected disabled>Select Country</option>
                                                <option data-countryCode="DZ" @if( $profile_data->country == "Algeria ,(+213)" ) selected @endif > Algeria ,(+213)</option>
                                                <option data-countryCode="AD" @if( $profile_data->country == "Andorra ,(+376)" ) selected @endif > Andorra ,(+376)</option>
                                                <option data-countryCode="AO" @if( $profile_data->country == "Angola ,(+244) " ) selected @endif > Angola ,(+244)</option>
                                                <option data-countryCode="AI" @if( $profile_data->country == "Anguilla ,(+1264)" ) selected @endif > Anguilla ,(+1264)</option>
                                                <option data-countryCode="AG" @if( $profile_data->country == "Antigua &amp; Barbuda ,(+1268) " ) selected @endif > Antigua &amp; Barbuda ,(+1268)</option>
                                                <option data-countryCode="AR" @if( $profile_data->country == "Argentina ,(+54) " ) selected @endif > Argentina ,(+54)</option>
                                                <option data-countryCode="AM" @if( $profile_data->country == "Armenia ,(+374)" ) selected @endif > Armenia ,(+374)</option>
                                                <option data-countryCode="AW" @if( $profile_data->country == "Aruba ,(+297)" ) selected @endif > Aruba ,(+297)</option>
                                                <option data-countryCode="AU" @if( $profile_data->country == "Australia ,(+61) " ) selected @endif > Australia ,(+61)</option>
                                                <option data-countryCode="AT" @if( $profile_data->country == "Austria ,(+43) " ) selected @endif > Austria ,(+43)</option>
                                                <option data-countryCode="AZ" @if( $profile_data->country == "Azerbaijan ,(+994) " ) selected @endif > Azerbaijan ,(+994)</option>
                                                <option data-countryCode="BS" @if( $profile_data->country == "Bahamas ,(+1242) " ) selected @endif > Bahamas ,(+1242)</option>
                                                <option data-countryCode="BH" @if( $profile_data->country == "Bahrain ,(+973)" ) selected @endif > Bahrain ,(+973)</option>
                                                <option data-countryCode="BD" @if( $profile_data->country == "Bangladesh ,(+880) " ) selected @endif > Bangladesh ,(+880)</option>
                                                <option data-countryCode="BB" @if( $profile_data->country == "Barbados ,(+1246)" ) selected @endif > Barbados ,(+1246)</option>
                                                <option data-countryCode="BY" @if( $profile_data->country == "Belarus ,(+375)" ) selected @endif > Belarus ,(+375)</option>
                                                <option data-countryCode="BE" @if( $profile_data->country == "Belgium ,(+32) " ) selected @endif > Belgium ,(+32)</option>
                                                <option data-countryCode="BZ" @if( $profile_data->country == "Belize ,(+501) " ) selected @endif > Belize ,(+501)</option>
                                                <option data-countryCode="BJ" @if( $profile_data->country == "Benin ,(+229)" ) selected @endif > Benin ,(+229)</option>
                                                <option data-countryCode="BM" @if( $profile_data->country == "Bermuda ,(+1441) " ) selected @endif > Bermuda ,(+1441)</option>
                                                <option data-countryCode="BT" @if( $profile_data->country == "Bhutan ,(+975) " ) selected @endif > Bhutan ,(+975)</option>
                                                <option data-countryCode="BO" @if( $profile_data->country == "Bolivia ,(+591)" ) selected @endif > Bolivia ,(+591)</option>
                                                <option data-countryCode="BA" @if( $profile_data->country == "Bosnia Herzegovina ,(+387) " ) selected @endif > Bosnia Herzegovina ,(+387)</option>
                                                <option data-countryCode="BW" @if( $profile_data->country == "Botswana ,(+267) " ) selected @endif > Botswana ,(+267)</option>
                                                <option data-countryCode="BR" @if( $profile_data->country == "Brazil ,(+55)" ) selected @endif > Brazil ,(+55)</option>
                                                <option data-countryCode="BN" @if( $profile_data->country == "Brunei ,(+673) " ) selected @endif > Brunei ,(+673)</option>
                                                <option data-countryCode="BG" @if( $profile_data->country == "Bulgaria ,(+359) " ) selected @endif > Bulgaria ,(+359)</option>
                                                <option data-countryCode="BF" @if( $profile_data->country == "Burkina Faso ,(+226) " ) selected @endif > Burkina Faso ,(+226)</option>
                                                <option data-countryCode="BI" @if( $profile_data->country == "Burundi ,(+257) " ) selected @endif > Burundi ,(+257)</option>
                                                <option data-countryCode="KH" @if( $profile_data->country == "Cambodia ,(+855) " ) selected @endif > Cambodia ,(+855)</option>
                                                <option data-countryCode="CM" @if( $profile_data->country == "Cameroon ,(+237) " ) selected @endif > Cameroon ,(+237)</option>
                                                <option data-countryCode="CA" @if( $profile_data->country == "Canada ,(+1) " ) selected @endif > Canada ,(+1)</option>
                                                <option data-countryCode="CV" @if( $profile_data->country == "Cape Verde Islands ,(+238) " ) selected @endif > Cape Verde Islands ,(+238)</option>
                                                <option data-countryCode="KY" @if( $profile_data->country == "Cayman Islands ,(+1345)" ) selected @endif > Cayman Islands ,(+1345)</option>
                                                <option data-countryCode="CF" @if( $profile_data->country == "Central African Republic ,(+236) " ) selected @endif > Central African Republic ,(+236)</option>
                                                <option data-countryCode="CL" @if( $profile_data->country == "Chile ,(+56) " ) selected @endif > Chile ,(+56)</option>
                                                <option data-countryCode="CN" @if( $profile_data->country == "China ,(+86) " ) selected @endif > China ,(+86)</option>
                                                <option data-countryCode="CO" @if( $profile_data->country == "Colombia ,(+57)" ) selected @endif > Colombia ,(+57)</option>
                                                <option data-countryCode="KM" @if( $profile_data->country == "Comoros ,(+269)" ) selected @endif > Comoros ,(+269)</option>
                                                <option data-countryCode="CG" @if( $profile_data->country == "Congo ,(+242)" ) selected @endif > Congo ,(+242)</option>
                                                <option data-countryCode="CK" @if( $profile_data->country == "Cook Islands ,(+682) " ) selected @endif > Cook Islands ,(+682)</option>
                                                <option data-countryCode="CR" @if( $profile_data->country == "Costa Rica ,(+506) " ) selected @endif > Costa Rica ,(+506)</option>
                                                <option data-countryCode="HR" @if( $profile_data->country == "Croatia ,(+385)" ) selected @endif > Croatia ,(+385)</option>
                                                <option data-countryCode="CU" @if( $profile_data->country == "Cuba ,(+53)" ) selected @endif > Cuba ,(+53)</option>
                                                <option data-countryCode="CY" @if( $profile_data->country == "Cyprus North ,(+90392) " ) selected @endif > Cyprus North ,(+90392)</option>
                                                <option data-countryCode="CY" @if( $profile_data->country == "Cyprus South ,(+357) " ) selected @endif > Cyprus South ,(+357)</option>
                                                <option data-countryCode="CZ" @if( $profile_data->country == "Czech Republic ,(+42)" ) selected @endif > Czech Republic ,(+42)</option>
                                                <option data-countryCode="DK" @if( $profile_data->country == "Denmark ,(+45) " ) selected @endif > Denmark ,(+45)</option>
                                                <option data-countryCode="DJ" @if( $profile_data->country == "Djibouti ,(+253) " ) selected @endif > Djibouti ,(+253)</option>
                                                <option data-countryCode="DM" @if( $profile_data->country == "Dominica ,(+1809)" ) selected @endif > Dominica ,(+1809)</option>
                                                <option data-countryCode="DO" @if( $profile_data->country == "Dominican Republic ,(+1809)" ) selected @endif > Dominican Republic ,(+1809)</option>
                                                <option data-countryCode="EC" @if( $profile_data->country == "Ecuador ,(+593)" ) selected @endif > Ecuador ,(+593)</option>
                                                <option data-countryCode="EG" @if( $profile_data->country == "Egypt ,(+20) " ) selected @endif > Egypt ,(+20)</option>
                                                <option data-countryCode="SV" @if( $profile_data->country == "El Salvador ,(+503)" ) selected @endif > El Salvador ,(+503)</option>
                                                <option data-countryCode="GQ" @if( $profile_data->country == "Equatorial Guinea ,(+240)" ) selected @endif > Equatorial Guinea ,(+240)</option>
                                                <option data-countryCode="ER" @if( $profile_data->country == "Eritrea ,(+291)" ) selected @endif > Eritrea ,(+291)</option>
                                                <option data-countryCode="EE" @if( $profile_data->country == "Estonia ,(+372)" ) selected @endif > Estonia ,(+372)</option>
                                                <option data-countryCode="ET" @if( $profile_data->country == "Ethiopia ,(+251) " ) selected @endif > Ethiopia ,(+251)</option>
                                                <option data-countryCode="FK" @if( $profile_data->country == "Falkland Islands ,(+500) " ) selected @endif > Falkland Islands ,(+500)</option>
                                                <option data-countryCode="FO" @if( $profile_data->country == "Faroe Islands ,(+298)" ) selected @endif > Faroe Islands ,(+298)</option>
                                                <option data-countryCode="FJ" @if( $profile_data->country == "Fiji ,(+679) " ) selected @endif > Fiji ,(+679)</option>
                                                <option data-countryCode="FI" @if( $profile_data->country == "Finland ,(+358)" ) selected @endif > Finland ,(+358)</option>
                                                <option data-countryCode="FR" @if( $profile_data->country == "France ,(+33)" ) selected @endif > France ,(+33)</option>
                                                <option data-countryCode="GF" @if( $profile_data->country == "French Guiana ,(+594)" ) selected @endif > French Guiana ,(+594)</option>
                                                <option data-countryCode="PF" @if( $profile_data->country == "French Polynesia ,(+689) " ) selected @endif > French Polynesia ,(+689)</option>
                                                <option data-countryCode="GA" @if( $profile_data->country == "Gabon ,(+241)" ) selected @endif > Gabon ,(+241)</option>
                                                <option data-countryCode="GM" @if( $profile_data->country == "Gambia ,(+220) " ) selected @endif > Gambia ,(+220)</option>
                                                <option data-countryCode="GE" @if( $profile_data->country == "Georgia ,(+7880) " ) selected @endif > Georgia ,(+7880)</option>
                                                <option data-countryCode="DE" @if( $profile_data->country == "Germany ,(+49) " ) selected @endif > Germany ,(+49)</option>
                                                <option data-countryCode="GH" @if( $profile_data->country == "Ghana ,(+233)" ) selected @endif > Ghana ,(+233)</option>
                                                <option data-countryCode="GI" @if( $profile_data->country == "Gibraltar ,(+350)" ) selected @endif > Gibraltar ,(+350)</option>
                                                <option data-countryCode="GR" @if( $profile_data->country == "Greece ,(+30)" ) selected @endif > Greece ,(+30)</option>
                                                <option data-countryCode="GL" @if( $profile_data->country == "Greenland ,(+299)" ) selected @endif > Greenland ,(+299)</option>
                                                <option data-countryCode="GD" @if( $profile_data->country == "Grenada ,(+1473) " ) selected @endif > Grenada ,(+1473)</option>
                                                <option data-countryCode="GP" @if( $profile_data->country == "Guadeloupe ,(+590) " ) selected @endif > Guadeloupe ,(+590)</option>
                                                <option data-countryCode="GU" @if( $profile_data->country == "Guam ,(+671) " ) selected @endif > Guam ,(+671)</option>
                                                <option data-countryCode="GT" @if( $profile_data->country == "Guatemala ,(+502)" ) selected @endif > Guatemala ,(+502)</option>
                                                <option data-countryCode="GN" @if( $profile_data->country == "Guinea ,(+224) " ) selected @endif > Guinea ,(+224)</option>
                                                <option data-countryCode="GW" @if( $profile_data->country == "Guinea - Bissau ,(+245)" ) selected @endif > Guinea - Bissau ,(+245)</option>
                                                <option data-countryCode="GY" @if( $profile_data->country == "Guyana ,(+592) " ) selected @endif > Guyana ,(+592)</option>
                                                <option data-countryCode="HT" @if( $profile_data->country == "Haiti ,(+509)" ) selected @endif > Haiti ,(+509)</option>
                                                <option data-countryCode="HN" @if( $profile_data->country == "Honduras ,(+504) " ) selected @endif > Honduras ,(+504)</option>
                                                <option data-countryCode="HK" @if( $profile_data->country == "Hong Kong ,(+852)" ) selected @endif > Hong Kong ,(+852)</option>
                                                <option data-countryCode="HU" @if( $profile_data->country == "Hungary ,(+36) " ) selected @endif > Hungary ,(+36)</option>
                                                <option data-countryCode="IS" @if( $profile_data->country == "Iceland ,(+354)" ) selected @endif > Iceland ,(+354)</option>
                                                <option data-countryCode="IN" @if( $profile_data->country == "India ,(+91) " ) selected @endif > India ,(+91)</option>
                                                <option data-countryCode="ID" @if( $profile_data->country == "Indonesia ,(+62) " ) selected @endif > Indonesia ,(+62)</option>
                                                <option data-countryCode="IR" @if( $profile_data->country == "Iran ,(+98)" ) selected @endif > Iran ,(+98)</option>
                                                <option data-countryCode="IQ" @if( $profile_data->country == "Iraq ,(+964) " ) selected @endif > Iraq ,(+964)</option>
                                                <option data-countryCode="IE" @if( $profile_data->country == "Ireland ,(+353)" ) selected @endif > Ireland ,(+353)</option>
                                                <option data-countryCode="IL" @if( $profile_data->country == "Israel ,(+972) " ) selected @endif > Israel ,(+972)</option>
                                                <option data-countryCode="IT" @if( $profile_data->country == "Italy ,(+39) " ) selected @endif > Italy ,(+39)</option>
                                                <option data-countryCode="JM" @if( $profile_data->country == "Jamaica ,(+1876) " ) selected @endif > Jamaica ,(+1876)</option>
                                                <option data-countryCode="JP" @if( $profile_data->country == "Japan ,(+81) " ) selected @endif > Japan ,(+81)</option>
                                                <option data-countryCode="JO" @if( $profile_data->country == "Jordan ,(+962) " ) selected @endif > Jordan ,(+962)</option>
                                                <option data-countryCode="KZ" @if( $profile_data->country == "Kazakhstan ,(+7) " ) selected @endif > Kazakhstan ,(+7)</option>
                                                <option data-countryCode="KE" @if( $profile_data->country == "Kenya ,(+254)" ) selected @endif > Kenya ,(+254)</option>
                                                <option data-countryCode="KI" @if( $profile_data->country == "Kiribati ,(+686) " ) selected @endif > Kiribati ,(+686)</option>
                                                <option data-countryCode="KP" @if( $profile_data->country == "Korea North ,(+850)" ) selected @endif > Korea North ,(+850)</option>
                                                <option data-countryCode="KR" @if( $profile_data->country == "Korea South ,(+82) " ) selected @endif > Korea South ,(+82)</option>
                                                <option data-countryCode="KW" @if( $profile_data->country == "Kuwait ,(+965) " ) selected @endif > Kuwait ,(+965)</option>
                                                <option data-countryCode="KG" @if( $profile_data->country == "Kyrgyzstan ,(+996) " ) selected @endif > Kyrgyzstan ,(+996)</option>
                                                <option data-countryCode="LA" @if( $profile_data->country == "Laos ,(+856) " ) selected @endif > Laos ,(+856)</option>
                                                <option data-countryCode="LV" @if( $profile_data->country == "Latvia ,(+371) " ) selected @endif > Latvia ,(+371)</option>
                                                <option data-countryCode="LB" @if( $profile_data->country == "Lebanon ,(+961)" ) selected @endif > Lebanon ,(+961)</option>
                                                <option data-countryCode="LS" @if( $profile_data->country == "Lesotho ,(+266)" ) selected @endif > Lesotho ,(+266)</option>
                                                <option data-countryCode="LR" @if( $profile_data->country == "Liberia ,(+231)" ) selected @endif > Liberia ,(+231)</option>
                                                <option data-countryCode="LY" @if( $profile_data->country == "Libya ,(+218)" ) selected @endif > Libya ,(+218)</option>
                                                <option data-countryCode="LI" @if( $profile_data->country == "Liechtenstein ,(+417)" ) selected @endif > Liechtenstein ,(+417)</option>
                                                <option data-countryCode="LT" @if( $profile_data->country == "Lithuania ,(+370)" ) selected @endif > Lithuania ,(+370)</option>
                                                <option data-countryCode="LU" @if( $profile_data->country == "Luxembourg ,(+352) " ) selected @endif > Luxembourg ,(+352)</option>
                                                <option data-countryCode="MO" @if( $profile_data->country == "Macao ,(+853)" ) selected @endif > Macao ,(+853)</option>
                                                <option data-countryCode="MK" @if( $profile_data->country == "Macedonia ,(+389)" ) selected @endif > Macedonia ,(+389)</option>
                                                <option data-countryCode="MG" @if( $profile_data->country == "Madagascar ,(+261) " ) selected @endif > Madagascar ,(+261)</option>
                                                <option data-countryCode="MW" @if( $profile_data->country == "Malawi ,(+265) " ) selected @endif > Malawi ,(+265)</option>
                                                <option data-countryCode="MY" @if( $profile_data->country == "Malaysia ,(+60)" ) selected @endif > Malaysia ,(+60)</option>
                                                <option data-countryCode="MV" @if( $profile_data->country == "Maldives ,(+960) " ) selected @endif > Maldives ,(+960)</option>
                                                <option data-countryCode="ML" @if( $profile_data->country == "Mali ,(+223) " ) selected @endif > Mali ,(+223)</option>
                                                <option data-countryCode="MT" @if( $profile_data->country == "Malta ,(+356)" ) selected @endif > Malta ,(+356)</option>
                                                <option data-countryCode="MH" @if( $profile_data->country == "Marshall Islands ,(+692) " ) selected @endif > Marshall Islands ,(+692)</option>
                                                <option data-countryCode="MQ" @if( $profile_data->country == "Martinique ,(+596) " ) selected @endif > Martinique ,(+596)</option>
                                                <option data-countryCode="MR" @if( $profile_data->country == "Mauritania ,(+222) " ) selected @endif > Mauritania ,(+222)</option>
                                                <option data-countryCode="YT" @if( $profile_data->country == "Mayotte ,(+269)" ) selected @endif > Mayotte ,(+269)</option>
                                                <option data-countryCode="MX" @if( $profile_data->country == "Mexico ,(+52)" ) selected @endif > Mexico ,(+52)</option>
                                                <option data-countryCode="FM" @if( $profile_data->country == "Micronesia ,(+691) " ) selected @endif > Micronesia ,(+691)</option>
                                                <option data-countryCode="MD" @if( $profile_data->country == "Moldova ,(+373)" ) selected @endif > Moldova ,(+373)</option>
                                                <option data-countryCode="MC" @if( $profile_data->country == "Monaco ,(+377) " ) selected @endif > Monaco ,(+377)</option>
                                                <option data-countryCode="MN" @if( $profile_data->country == "Mongolia ,(+976) " ) selected @endif > Mongolia ,(+976)</option>
                                                <option data-countryCode="MS" @if( $profile_data->country == "Montserrat ,(+1664)" ) selected @endif > Montserrat ,(+1664)</option>
                                                <option data-countryCode="MA" @if( $profile_data->country == "Morocco ,(+212)" ) selected @endif > Morocco ,(+212)</option>
                                                <option data-countryCode="MZ" @if( $profile_data->country == "Mozambique ,(+258) " ) selected @endif > Mozambique ,(+258)</option>
                                                <option data-countryCode="MN" @if( $profile_data->country == "Myanmar ,(+95) " ) selected @endif > Myanmar ,(+95)</option>
                                                <option data-countryCode="NA" @if( $profile_data->country == "Namibia ,(+264)" ) selected @endif > Namibia ,(+264)</option>
                                                <option data-countryCode="NR" @if( $profile_data->country == "Nauru ,(+674)" ) selected @endif > Nauru ,(+674)</option>
                                                <option data-countryCode="NP" @if( $profile_data->country == "Nepal ,(+977)" ) selected @endif > Nepal ,(+977)</option>
                                                <option data-countryCode="NL" @if( $profile_data->country == "Netherlands ,(+31) " ) selected @endif > Netherlands ,(+31)</option>
                                                <option data-countryCode="NC" @if( $profile_data->country == "New Caledonia ,(+687)" ) selected @endif > New Caledonia ,(+687)</option>
                                                <option data-countryCode="NZ" @if( $profile_data->country == "New Zealand ,(+64) " ) selected @endif > New Zealand ,(+64)</option>
                                                <option data-countryCode="NI" @if( $profile_data->country == "Nicaragua ,(+505)" ) selected @endif > Nicaragua ,(+505)</option>
                                                <option data-countryCode="NE" @if( $profile_data->country == "Niger ,(+227)" ) selected @endif > Niger ,(+227)</option>
                                                <option data-countryCode="NG" @if( $profile_data->country == "Nigeria ,(+234)" ) selected @endif > Nigeria ,(+234)</option>
                                                <option data-countryCode="NU" @if( $profile_data->country == "Niue ,(+683) " ) selected @endif > Niue ,(+683)</option>
                                                <option data-countryCode="NF" @if( $profile_data->country == "Norfolk Islands ,(+672)" ) selected @endif > Norfolk Islands ,(+672)</option>
                                                <option data-countryCode="NP" @if( $profile_data->country == "Northern Marianas ,(+670)" ) selected @endif > Northern Marianas ,(+670)</option>
                                                <option data-countryCode="NO" @if( $profile_data->country == "Norway ,(+47)" ) selected @endif > Norway ,(+47)</option>
                                                <option data-countryCode="OM" @if( $profile_data->country == "Oman ,(+968) " ) selected @endif > Oman ,(+968)</option>
                                                <option data-countryCode="PS" @if( $profile_data->country == "Palestine ,(+970)" ) selected @endif > Palestine ,(+970)</option>
                                                <option data-countryCode="PW" @if( $profile_data->country == "Palau ,(+680)" ) selected @endif > Palau ,(+680)</option>
                                                <option data-countryCode="PK" @if( $profile_data->country == "Pakistan ,(+92)" ) selected @endif > Pakistan ,(+92)</option>
                                                <option data-countryCode="PA" @if( $profile_data->country == "Panama ,(+507) " ) selected @endif > Panama ,(+507)</option>
                                                <option data-countryCode="PG" @if( $profile_data->country == "Papua New Guinea ,(+675) " ) selected @endif > Papua New Guinea ,(+675)</option>
                                                <option data-countryCode="PY" @if( $profile_data->country == "Paraguay ,(+595) " ) selected @endif > Paraguay ,(+595)</option>
                                                <option data-countryCode="PE" @if( $profile_data->country == "Peru ,(+51)" ) selected @endif > Peru ,(+51)</option>
                                                <option data-countryCode="PH" @if( $profile_data->country == "Philippines ,(+63) " ) selected @endif > Philippines ,(+63)</option>
                                                <option data-countryCode="PL" @if( $profile_data->country == "Poland ,(+48)" ) selected @endif > Poland ,(+48)</option>
                                                <option data-countryCode="PT" @if( $profile_data->country == "Portugal ,(+351) " ) selected @endif > Portugal ,(+351)</option>
                                                <option data-countryCode="PR" @if( $profile_data->country == "Puerto Rico ,(+1787) " ) selected @endif > Puerto Rico ,(+1787)</option>
                                                <option data-countryCode="QA" @if( $profile_data->country == "Qatar ,(+974)" ) selected @endif > Qatar ,(+974)</option>
                                                <option data-countryCode="RE" @if( $profile_data->country == "Reunion ,(+262)" ) selected @endif > Reunion ,(+262)</option>
                                                <option data-countryCode="RO" @if( $profile_data->country == "Romania ,(+40) " ) selected @endif > Romania ,(+40)</option>
                                                <option data-countryCode="RU" @if( $profile_data->country == "Russia ,(+7) " ) selected @endif > Russia ,(+7)</option>
                                                <option data-countryCode="RW" @if( $profile_data->country == "Rwanda ,(+250) " ) selected @endif > Rwanda ,(+250)</option>
                                                <option data-countryCode="SM" @if( $profile_data->country == "San Marino ,(+378) " ) selected @endif > San Marino ,(+378)</option>
                                                <option data-countryCode="ST" @if( $profile_data->country == "Sao Tome &amp; Principe ,(+239)" ) selected @endif > Sao Tome &amp; Principe ,(+239)</option>
                                                <option data-countryCode="SA" @if( $profile_data->country == "Saudi Arabia ,(+966) " ) selected @endif > Saudi Arabia ,(+966)</option>
                                                <option data-countryCode="SN" @if( $profile_data->country == "Senegal ,(+221)" ) selected @endif > Senegal ,(+221)</option>
                                                <option data-countryCode="CS" @if( $profile_data->country == "Serbia ,(+381) " ) selected @endif > Serbia ,(+381)</option>
                                                <option data-countryCode="SC" @if( $profile_data->country == "Seychelles ,(+248) " ) selected @endif > Seychelles ,(+248)</option>
                                                <option data-countryCode="SL" @if( $profile_data->country == "Sierra Leone ,(+232) " ) selected @endif > Sierra Leone ,(+232)</option>
                                                <option data-countryCode="SG" @if( $profile_data->country == "Singapore ,(+65) " ) selected @endif > Singapore ,(+65)</option>
                                                <option data-countryCode="SK" @if( $profile_data->country == "Slovak Republic ,(+421)" ) selected @endif > Slovak Republic ,(+421)</option>
                                                <option data-countryCode="SI" @if( $profile_data->country == "Slovenia ,(+386) " ) selected @endif > Slovenia ,(+386)</option>
                                                <option data-countryCode="SB" @if( $profile_data->country == "Solomon Islands ,(+677)" ) selected @endif > Solomon Islands ,(+677)</option>
                                                <option data-countryCode="SO" @if( $profile_data->country == "Somalia ,(+252)" ) selected @endif > Somalia ,(+252)</option>
                                                <option data-countryCode="ZA" @if( $profile_data->country == "South Africa ,(+27)" ) selected @endif > South Africa ,(+27)</option>
                                                <option data-countryCode="ES" @if( $profile_data->country == "Spain ,(+34) " ) selected @endif > Spain ,(+34)</option>
                                                <option data-countryCode="LK" @if( $profile_data->country == "Sri Lanka ,(+94) " ) selected @endif > Sri Lanka ,(+94)</option>
                                                <option data-countryCode="SH" @if( $profile_data->country == "St. Helena ,(+290) " ) selected @endif > St. Helena ,(+290)</option>
                                                <option data-countryCode="KN" @if( $profile_data->country == "St. Kitts ,(+1869) " ) selected @endif > St. Kitts ,(+1869)</option>
                                                <option data-countryCode="SC" @if( $profile_data->country == "St. Lucia ,(+1758) " ) selected @endif > St. Lucia ,(+1758)</option>
                                                <option data-countryCode="SD" @if( $profile_data->country == "Sudan ,(+249)" ) selected @endif > Sudan ,(+249)</option>
                                                <option data-countryCode="SR" @if( $profile_data->country == "Suriname ,(+597) " ) selected @endif > Suriname ,(+597)</option>
                                                <option data-countryCode="SZ" @if( $profile_data->country == "Swaziland ,(+268)" ) selected @endif > Swaziland ,(+268)</option>
                                                <option data-countryCode="SE" @if( $profile_data->country == "Sweden ,(+46)" ) selected @endif > Sweden ,(+46)</option>
                                                <option data-countryCode="CH" @if( $profile_data->country == "Switzerland ,(+41) " ) selected @endif > Switzerland ,(+41)</option>
                                                <option data-countryCode="SI" @if( $profile_data->country == "Syria ,(+963)" ) selected @endif > Syria ,(+963)</option>
                                                <option data-countryCode="TW" @if( $profile_data->country == "Taiwan ,(+886) " ) selected @endif > Taiwan ,(+886)</option>
                                                <option data-countryCode="TJ" @if( $profile_data->country == "Tajikstan ,(+7)" ) selected @endif > Tajikstan ,(+7)</option>
                                                <option data-countryCode="TH" @if( $profile_data->country == "Thailand ,(+66)" ) selected @endif > Thailand ,(+66)</option>
                                                <option data-countryCode="TG" @if( $profile_data->country == "Togo ,(+228) " ) selected @endif > Togo ,(+228)</option>
                                                <option data-countryCode="TO" @if( $profile_data->country == "Tonga ,(+676)" ) selected @endif > Tonga ,(+676)</option>
                                                <option data-countryCode="TT" @if( $profile_data->country == "Trinidad &amp; Tobago ,(+1868) " ) selected @endif > Trinidad &amp; Tobago ,(+1868)</option>
                                                <option data-countryCode="TN" @if( $profile_data->country == "Tunisia ,(+216)" ) selected @endif > Tunisia ,(+216)</option>
                                                <option data-countryCode="TR" @if( $profile_data->country == "Turkey ,(+90)" ) selected @endif > Turkey ,(+90)</option>
                                                <option data-countryCode="TM" @if( $profile_data->country == "Turkmenistan ,(+7) " ) selected @endif > Turkmenistan ,(+7)</option>
                                                <option data-countryCode="TM" @if( $profile_data->country == "Turkmenistan ,(+993) " ) selected @endif > Turkmenistan ,(+993)</option>
                                                <option data-countryCode="TC" @if( $profile_data->country == "rks &amp; Caicos Islands ,(+1649)" ) selected @endif > Turks &amp; Caicos Islands ,(+1649)</option>
                                                <option data-countryCode="TV" @if( $profile_data->country == "Tuvalu ,(+688) " ) selected @endif > Tuvalu ,(+688)</option>
                                                <option data-countryCode="UG" @if( $profile_data->country == "Uganda ,(+256) " ) selected @endif > Uganda ,(+256)</option>
                                                <option data-countryCode="GB" @if( $profile_data->country == "UK ,(+44)" ) selected @endif > UK ,(+44)</option>
                                                <option data-countryCode="UA" @if( $profile_data->country == "Ukraine ,(+380)" ) selected @endif > Ukraine ,(+380)</option>
                                                <option data-countryCode="AE" @if( $profile_data->country == "United Arab Emirates ,(+971) " ) selected @endif > United Arab Emirates ,(+971)</option>
                                                <option data-countryCode="UY" @if( $profile_data->country == "Uruguay ,(+598)" ) selected @endif > Uruguay ,(+598)</option>
                                                <option data-countryCode="US" @if( $profile_data->country == "USA ,(+1)" ) selected @endif > USA ,(+1)</option>
                                                <option data-countryCode="UZ" @if( $profile_data->country == "Uzbekistan ,(+7) " ) selected @endif > Uzbekistan ,(+7)</option>
                                                <option data-countryCode="VU" @if( $profile_data->country == "Vanuatu ,(+678)" ) selected @endif > Vanuatu ,(+678)</option>
                                                <option data-countryCode="VA" @if( $profile_data->country == "Vatican City ,(+379) " ) selected @endif > Vatican City ,(+379)</option>
                                                <option data-countryCode="VE" @if( $profile_data->country == "Venezuela ,(+58) " ) selected @endif > Venezuela ,(+58)</option>
                                                <option data-countryCode="VN" @if( $profile_data->country == "Vietnam ,(+84) " ) selected @endif > Vietnam ,(+84)</option>
                                                <option data-countryCode="VG" @if( $profile_data->country == "Virgin Islands - British ,(+1284)" ) selected @endif > Virgin Islands - British ,(+1284)</option>
                                                <option data-countryCode="VI" @if( $profile_data->country == "Virgin Islands - US ,(+1340) " ) selected @endif > Virgin Islands - US ,(+1340)</option>
                                                <option data-countryCode="WF" @if( $profile_data->country == "Wallis &amp; Futuna ,(+681)" ) selected @endif > Wallis &amp; Futuna ,(+681)</option>
                                                <option data-countryCode="YE" @if( $profile_data->country == "Yemen (North),(+969) " ) selected @endif > Yemen (North),(+969)</option>
                                                <option data-countryCode="YE" @if( $profile_data->country == "Yemen (South),(+967) " ) selected @endif > Yemen (South),(+967)</option>
                                                <option data-countryCode="ZM" @if( $profile_data->country == "Zambia ,(+260) " ) selected @endif > Zambia ,(+260)</option>
                                                <option data-countryCode="ZW" @if( $profile_data->country == "Zimbabwe ,(+263) " ) selected @endif > Zimbabwe ,(+263)</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                        {{--<div class="col-md-12 col-sm-12">--}}
                                        {{--<p>State/region</p>--}}
                                        {{--<input type="text" value="{{$profile_data->state??''}}">--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-3 buttonside">
                                    <h4>Contact Information</h4>
                                    <div class="form-group row">
                                        <div class="col-md-12 col-sm-12">
                                            <p>Email</p>
                                            <input type="email" name="email" placeholder="Email" value="{{$profile_data->user->email??''}}" required readonly>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <p>Phone number</p>
                                            <input type="tel" name="phone" placeholder="Phone Number" value="{{$profile_data->phone??''}}" required>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <button type="submit" class="btn btn-primary" id="submit_btn"><i class="fa fa-refresh "></i> Update Profile</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(function(){
            $('#file-input').change(function(){
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
                {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#profile_pic').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
                else
                {
                    $('#profile_pic').attr('src', '/assets/no_preview.png');
                }
            });

        });
    </script>
@endpush