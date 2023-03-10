@extends('website.layout.master')
@push('css')
<style>
    .loginform{
        padding:40px;
    }
    .inner_col{
        /* border: 1px solid black; */
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0px 4px 10px rgba(94,92,169,0.4);
        margin: 50px 0;
        width: 100%;
        max-width: 60%;
        margin: 0 auto;
    }
    .loginform .loginheading{
        color: #365CA9;
        font-weight: bold;
        font-size: 50px;

    }
    .loginform input{
        border: none;
        outline: none !important;
        margin: 0 40px;
        font-size: 18px;
        background: none;
    }
    .loginform select{
        border: none;
        outline: none !important;
        /* margin: 0 40px; */
        font-size: 18px;
        background: none;
        width: 100%;
        padding: 0 40px;
        height: 28px;
    }
    .loginform input[type="email"],.loginform input[type="password"]{
        width: 100%;
    }
    .loginform input::placeholder{
        color: #212121;
    }
    .loginform .icon_position{
        position: relative;
        border: 1px solid #E8E8E8;
        padding: 15px 10px;
        border-radius: 5px;
        box-shadow: 0px 5px 10px rgba(0,0,0,0.15);
        width: 100%;
    }

    .loginform .icon_position .icon{
        position: absolute;
        top: 15px;
        left: 12px;
    }
    .loginform .buttons{
        width:100%;
    }
    .loginform .buttons button{
        background-color: #365CA9;
        padding: 10px 40px;
        color: white;
        font-size: 20px;
    }
    .loginform input[type="checkbox"]{
        margin: 0;
        padding: 0;
    }
    .loginform .camera{

        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #9B9B9B;
        display: flex;
        justify-content: center;
        align-items: center;

    }
    .loginform .camera-center{
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
    }
    .loginform .buttons .signup{
        padding: 20px 40px;
        color: #8D8D8D;
        font-size: 20px;
        font-weight: bold;
        text-decoration: none;
    }
    .loginform .buttons span{
        color: #8D8D8D;
        font-size: 20px;
        font-size: 400;
        text-decoration: none;
    }
    .loginform .buttons .login{
        color: #8D8D8D;
        font-size: 20px;
        font-weight: 400;
        text-decoration: none;
        font-weight: bold;
    }
    .loginform .form-check{
        padding: 0;
    }
    .loginform .form-check-label{
        font-size: 17px;
        color: #7e7e7e;
    }

    .loginform .forgotpass a{
        color: #7199E9;
        text-decoration: none;
    }
    .loginform .privacypolicy{
        /* text-decoration: none; */
        /*color: #000;*/
        color: #365ca9;
        text-decoration: underline;
    }

    /*New*/
    .loginform input[type="email"], .loginform input[type="password"] {
        width: 90% !important;
    }

    .loginform input[type="text"] {
        width: 90% !important;
    }
    .loginform textarea.form-control {
        height: auto;
        /*width: 95%;*/
        /*margin: 0 auto;*/
        box-shadow: 0px 5px 10px rgba(0,0,0,0.15);
        border: 1px solid #E8E8E8;;
    }

    .loginform .form-check {
        padding: 0 20px;
    }
    img.profile_pic { height: 100px; width: 100px; border-radius: 50%; object-fit: contain;}
    .image-upload>input {
        display: none;
    }
    .image-upload{
        text-align: center;
        width: 100%;
    }
    .chosen-container-multi .chosen-choices{
        background-image: none !important;
        border: none !important;
        background-color: transparent !important;
        padding: 0 0px 0px 45px !important;
    }
    .chosen-container-active .chosen-choices {
        box-shadow: none !important;
    }
    li.search-choice.search-choice-disabled{
        color: #495057 !important;
        font-size: 18px !important;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
    }
    @media(max-width:1024px){
        .loginform .inner_col{
            width: 100%;
            max-width: 70%;
            margin: 0 auto;
        }
    }
    @media(max-width:768px){
        .loginform .inner_col{
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
        }
    }
    @media(max-width:480px){
        .loginform .form-check label{
            font-size: 15px;
        }
        .loginform .forgotpass a{
            font-size: 15px;
        }
    }
    @media(max-width:375px){
        .loginform .form-check label{
            font-size: 12px;
        }
        .loginform .forgotpass a{
            font-size: 12px;
        }
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
    @if(session('message'))
        <!-- <div class="account-title">{{session('message')}}</div> -->
        <div class="account-title">
            <p class="alert alert-success">{{session('message')}}</p>
        </div>
    @endif
    <section class="loginform">
        <div class="container">
            <div class="inner_col">
                <form method="POST" action="{{ route('usersignup') }}" enctype='multipart/form-data' id="register">
                    {{csrf_field()}}
                    <div class="row">

                        <div class="col-md-12 mb-2">
                            <h1 class="text-center loginheading pb-4">Register</h1>
                        </div>
                        {{--<div class="col-md-12 mb-4 camera-center">--}}
                            {{--<img class="profile_pic" id="profile_pic" src="{{ asset('website') }}/img/camera.png" alt="">--}}
                        {{--</div>--}}
                        {{--<div class="image-upload">--}}
                            {{--<label for="file-input">--}}
                                {{--<p><i class="fa fa-image" aria-hidden="true"></i> Choose Profile Picture</p>--}}
                            {{--</label>--}}
                            {{--<input id="file-input" class="pic" type="file" name="image" accept="image/png, image/jpg, image/jpeg"/>--}}
                        {{--</div>--}}
                        @if($route_name == 'vendor-signup')
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="mb-4 icon_position">
                                    <div class="icon"><img src="{{ asset('website') }}/img/Icon awesome-user-alt.png" alt=""></div>
                                    <input type="text" placeholder="Company Name" aria-label="Companyname" aria-describedby="basic-addon1" name="company_name" value="{{ old('company_name') }}" required autofocus>
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="mb-4 icon_position">
                                <div class="icon"><img src="{{ asset('website') }}/img/Icon awesome-user-alt.png" alt=""></div>
                                <input type="text" placeholder="Name" aria-label="Username" aria-describedby="basic-addon1" name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="mb-4 icon_position">
                                <div class="icon"><img src="{{ asset('website') }}/img/Icon awesome-envelope.png"></div>
                                <input type="email" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="mb-4 icon_position">
                                <div class="icon"><img src="{{ asset('website') }}/img/Icon awesome-key.png" alt=""></div>
                                <input type="password" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" name="password" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="mb-4 icon_position">
                                <div class="icon"><img src="{{ asset('website') }}/img/Icon awesome-key.png" alt=""></div>
                                <input type="password" placeholder="Confirm Password" aria-label="Username" aria-describedby="basic-addon1" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="mb-4 icon_position">
                                <div class="icon"><img src="{{ asset('website') }}/img/brazil.png" alt=""></div>
                                {{--<select class="form-control" name="countryCode" id="">--}}
                                    {{--<option value="">Select Country</option>--}}
                                    {{--<option data-countryCode="DZ" value="213">Algeria (+213)</option>--}}
                                    {{--<option data-countryCode="AD" value="376">Andorra (+376)</option>--}}
                                    {{--<option data-countryCode="AO" value="244">Angola (+244)</option>--}}
                                    {{--<option data-countryCode="AI" value="1264">Anguilla (+1264)</option>--}}
                                    {{--<option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>--}}
                                    {{--<option data-countryCode="AR" value="54">Argentina (+54)</option>--}}
                                    {{--<option data-countryCode="AM" value="374">Armenia (+374)</option>--}}
                                    {{--<option data-countryCode="AW" value="297">Aruba (+297)</option>--}}
                                    {{--<option data-countryCode="AU" value="61">Australia (+61)</option>--}}
                                    {{--<option data-countryCode="AT" value="43">Austria (+43)</option>--}}
                                    {{--<option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>--}}
                                    {{--<option data-countryCode="BS" value="1242">Bahamas (+1242)</option>--}}
                                    {{--<option data-countryCode="BH" value="973">Bahrain (+973)</option>--}}
                                    {{--<option data-countryCode="BD" value="880">Bangladesh (+880)</option>--}}
                                    {{--<option data-countryCode="BB" value="1246">Barbados (+1246)</option>--}}
                                    {{--<option data-countryCode="BY" value="375">Belarus (+375)</option>--}}
                                    {{--<option data-countryCode="BE" value="32">Belgium (+32)</option>--}}
                                    {{--<option data-countryCode="BZ" value="501">Belize (+501)</option>--}}
                                    {{--<option data-countryCode="BJ" value="229">Benin (+229)</option>--}}
                                    {{--<option data-countryCode="BM" value="1441">Bermuda (+1441)</option>--}}
                                    {{--<option data-countryCode="BT" value="975">Bhutan (+975)</option>--}}
                                    {{--<option data-countryCode="BO" value="591">Bolivia (+591)</option>--}}
                                    {{--<option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>--}}
                                    {{--<option data-countryCode="BW" value="267">Botswana (+267)</option>--}}
                                    {{--<option data-countryCode="BR" value="55">Brazil (+55)</option>--}}
                                    {{--<option data-countryCode="BN" value="673">Brunei (+673)</option>--}}
                                    {{--<option data-countryCode="BG" value="359">Bulgaria (+359)</option>--}}
                                    {{--<option data-countryCode="BF" value="226">Burkina Faso (+226)</option>--}}
                                    {{--<option data-countryCode="BI" value="257">Burundi (+257)</option>--}}
                                    {{--<option data-countryCode="KH" value="855">Cambodia (+855)</option>--}}
                                    {{--<option data-countryCode="CM" value="237">Cameroon (+237)</option>--}}
                                    {{--<option data-countryCode="CA" value="1">Canada (+1)</option>--}}
                                    {{--<option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>--}}
                                    {{--<option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>--}}
                                    {{--<option data-countryCode="CF" value="236">Central African Republic (+236)</option>--}}
                                    {{--<option data-countryCode="CL" value="56">Chile (+56)</option>--}}
                                    {{--<option data-countryCode="CN" value="86">China (+86)</option>--}}
                                    {{--<option data-countryCode="CO" value="57">Colombia (+57)</option>--}}
                                    {{--<option data-countryCode="KM" value="269">Comoros (+269)</option>--}}
                                    {{--<option data-countryCode="CG" value="242">Congo (+242)</option>--}}
                                    {{--<option data-countryCode="CK" value="682">Cook Islands (+682)</option>--}}
                                    {{--<option data-countryCode="CR" value="506">Costa Rica (+506)</option>--}}
                                    {{--<option data-countryCode="HR" value="385">Croatia (+385)</option>--}}
                                    {{--<option data-countryCode="CU" value="53">Cuba (+53)</option>--}}
                                    {{--<option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>--}}
                                    {{--<option data-countryCode="CY" value="357">Cyprus South (+357)</option>--}}
                                    {{--<option data-countryCode="CZ" value="42">Czech Republic (+42)</option>--}}
                                    {{--<option data-countryCode="DK" value="45">Denmark (+45)</option>--}}
                                    {{--<option data-countryCode="DJ" value="253">Djibouti (+253)</option>--}}
                                    {{--<option data-countryCode="DM" value="1809">Dominica (+1809)</option>--}}
                                    {{--<option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>--}}
                                    {{--<option data-countryCode="EC" value="593">Ecuador (+593)</option>--}}
                                    {{--<option data-countryCode="EG" value="20">Egypt (+20)</option>--}}
                                    {{--<option data-countryCode="SV" value="503">El Salvador (+503)</option>--}}
                                    {{--<option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>--}}
                                    {{--<option data-countryCode="ER" value="291">Eritrea (+291)</option>--}}
                                    {{--<option data-countryCode="EE" value="372">Estonia (+372)</option>--}}
                                    {{--<option data-countryCode="ET" value="251">Ethiopia (+251)</option>--}}
                                    {{--<option data-countryCode="FK" value="500">Falkland Islands (+500)</option>--}}
                                    {{--<option data-countryCode="FO" value="298">Faroe Islands (+298)</option>--}}
                                    {{--<option data-countryCode="FJ" value="679">Fiji (+679)</option>--}}
                                    {{--<option data-countryCode="FI" value="358">Finland (+358)</option>--}}
                                    {{--<option data-countryCode="FR" value="33">France (+33)</option>--}}
                                    {{--<option data-countryCode="GF" value="594">French Guiana (+594)</option>--}}
                                    {{--<option data-countryCode="PF" value="689">French Polynesia (+689)</option>--}}
                                    {{--<option data-countryCode="GA" value="241">Gabon (+241)</option>--}}
                                    {{--<option data-countryCode="GM" value="220">Gambia (+220)</option>--}}
                                    {{--<option data-countryCode="GE" value="7880">Georgia (+7880)</option>--}}
                                    {{--<option data-countryCode="DE" value="49">Germany (+49)</option>--}}
                                    {{--<option data-countryCode="GH" value="233">Ghana (+233)</option>--}}
                                    {{--<option data-countryCode="GI" value="350">Gibraltar (+350)</option>--}}
                                    {{--<option data-countryCode="GR" value="30">Greece (+30)</option>--}}
                                    {{--<option data-countryCode="GL" value="299">Greenland (+299)</option>--}}
                                    {{--<option data-countryCode="GD" value="1473">Grenada (+1473)</option>--}}
                                    {{--<option data-countryCode="GP" value="590">Guadeloupe (+590)</option>--}}
                                    {{--<option data-countryCode="GU" value="671">Guam (+671)</option>--}}
                                    {{--<option data-countryCode="GT" value="502">Guatemala (+502)</option>--}}
                                    {{--<option data-countryCode="GN" value="224">Guinea (+224)</option>--}}
                                    {{--<option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>--}}
                                    {{--<option data-countryCode="GY" value="592">Guyana (+592)</option>--}}
                                    {{--<option data-countryCode="HT" value="509">Haiti (+509)</option>--}}
                                    {{--<option data-countryCode="HN" value="504">Honduras (+504)</option>--}}
                                    {{--<option data-countryCode="HK" value="852">Hong Kong (+852)</option>--}}
                                    {{--<option data-countryCode="HU" value="36">Hungary (+36)</option>--}}
                                    {{--<option data-countryCode="IS" value="354">Iceland (+354)</option>--}}
                                    {{--<option data-countryCode="IN" value="91">India (+91)</option>--}}
                                    {{--<option data-countryCode="ID" value="62">Indonesia (+62)</option>--}}
                                    {{--<option data-countryCode="IR" value="98">Iran (+98)</option>--}}
                                    {{--<option data-countryCode="IQ" value="964">Iraq (+964)</option>--}}
                                    {{--<option data-countryCode="IE" value="353">Ireland (+353)</option>--}}
                                    {{--<option data-countryCode="IL" value="972">Israel (+972)</option>--}}
                                    {{--<option data-countryCode="IT" value="39">Italy (+39)</option>--}}
                                    {{--<option data-countryCode="JM" value="1876">Jamaica (+1876)</option>--}}
                                    {{--<option data-countryCode="JP" value="81">Japan (+81)</option>--}}
                                    {{--<option data-countryCode="JO" value="962">Jordan (+962)</option>--}}
                                    {{--<option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>--}}
                                    {{--<option data-countryCode="KE" value="254">Kenya (+254)</option>--}}
                                    {{--<option data-countryCode="KI" value="686">Kiribati (+686)</option>--}}
                                    {{--<option data-countryCode="KP" value="850">Korea North (+850)</option>--}}
                                    {{--<option data-countryCode="KR" value="82">Korea South (+82)</option>--}}
                                    {{--<option data-countryCode="KW" value="965">Kuwait (+965)</option>--}}
                                    {{--<option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>--}}
                                    {{--<option data-countryCode="LA" value="856">Laos (+856)</option>--}}
                                    {{--<option data-countryCode="LV" value="371">Latvia (+371)</option>--}}
                                    {{--<option data-countryCode="LB" value="961">Lebanon (+961)</option>--}}
                                    {{--<option data-countryCode="LS" value="266">Lesotho (+266)</option>--}}
                                    {{--<option data-countryCode="LR" value="231">Liberia (+231)</option>--}}
                                    {{--<option data-countryCode="LY" value="218">Libya (+218)</option>--}}
                                    {{--<option data-countryCode="LI" value="417">Liechtenstein (+417)</option>--}}
                                    {{--<option data-countryCode="LT" value="370">Lithuania (+370)</option>--}}
                                    {{--<option data-countryCode="LU" value="352">Luxembourg (+352)</option>--}}
                                    {{--<option data-countryCode="MO" value="853">Macao (+853)</option>--}}
                                    {{--<option data-countryCode="MK" value="389">Macedonia (+389)</option>--}}
                                    {{--<option data-countryCode="MG" value="261">Madagascar (+261)</option>--}}
                                    {{--<option data-countryCode="MW" value="265">Malawi (+265)</option>--}}
                                    {{--<option data-countryCode="MY" value="60">Malaysia (+60)</option>--}}
                                    {{--<option data-countryCode="MV" value="960">Maldives (+960)</option>--}}
                                    {{--<option data-countryCode="ML" value="223">Mali (+223)</option>--}}
                                    {{--<option data-countryCode="MT" value="356">Malta (+356)</option>--}}
                                    {{--<option data-countryCode="MH" value="692">Marshall Islands (+692)</option>--}}
                                    {{--<option data-countryCode="MQ" value="596">Martinique (+596)</option>--}}
                                    {{--<option data-countryCode="MR" value="222">Mauritania (+222)</option>--}}
                                    {{--<option data-countryCode="YT" value="269">Mayotte (+269)</option>--}}
                                    {{--<option data-countryCode="MX" value="52">Mexico (+52)</option>--}}
                                    {{--<option data-countryCode="FM" value="691">Micronesia (+691)</option>--}}
                                    {{--<option data-countryCode="MD" value="373">Moldova (+373)</option>--}}
                                    {{--<option data-countryCode="MC" value="377">Monaco (+377)</option>--}}
                                    {{--<option data-countryCode="MN" value="976">Mongolia (+976)</option>--}}
                                    {{--<option data-countryCode="MS" value="1664">Montserrat (+1664)</option>--}}
                                    {{--<option data-countryCode="MA" value="212">Morocco (+212)</option>--}}
                                    {{--<option data-countryCode="MZ" value="258">Mozambique (+258)</option>--}}
                                    {{--<option data-countryCode="MN" value="95">Myanmar (+95)</option>--}}
                                    {{--<option data-countryCode="NA" value="264">Namibia (+264)</option>--}}
                                    {{--<option data-countryCode="NR" value="674">Nauru (+674)</option>--}}
                                    {{--<option data-countryCode="NP" value="977">Nepal (+977)</option>--}}
                                    {{--<option data-countryCode="NL" value="31">Netherlands (+31)</option>--}}
                                    {{--<option data-countryCode="NC" value="687">New Caledonia (+687)</option>--}}
                                    {{--<option data-countryCode="NZ" value="64">New Zealand (+64)</option>--}}
                                    {{--<option data-countryCode="NI" value="505">Nicaragua (+505)</option>--}}
                                    {{--<option data-countryCode="NE" value="227">Niger (+227)</option>--}}
                                    {{--<option data-countryCode="NG" value="234">Nigeria (+234)</option>--}}
                                    {{--<option data-countryCode="NU" value="683">Niue (+683)</option>--}}
                                    {{--<option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>--}}
                                    {{--<option data-countryCode="NP" value="670">Northern Marianas (+670)</option>--}}
                                    {{--<option data-countryCode="NO" value="47">Norway (+47)</option>--}}
                                    {{--<option data-countryCode="OM" value="968">Oman (+968)</option>--}}
                                    {{--<option data-countryCode="PS" value="970">Palestine (+970)</option>--}}
                                    {{--<option data-countryCode="PW" value="680">Palau (+680)</option>--}}
                                    {{--<option data-countryCode="PK" value="92">Pakistan (+92)</option>--}}
                                    {{--<option data-countryCode="PA" value="507">Panama (+507)</option>--}}
                                    {{--<option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>--}}
                                    {{--<option data-countryCode="PY" value="595">Paraguay (+595)</option>--}}
                                    {{--<option data-countryCode="PE" value="51">Peru (+51)</option>--}}
                                    {{--<option data-countryCode="PH" value="63">Philippines (+63)</option>--}}
                                    {{--<option data-countryCode="PL" value="48">Poland (+48)</option>--}}
                                    {{--<option data-countryCode="PT" value="351">Portugal (+351)</option>--}}
                                    {{--<option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>--}}
                                    {{--<option data-countryCode="QA" value="974">Qatar (+974)</option>--}}
                                    {{--<option data-countryCode="RE" value="262">Reunion (+262)</option>--}}
                                    {{--<option data-countryCode="RO" value="40">Romania (+40)</option>--}}
                                    {{--<option data-countryCode="RU" value="7">Russia (+7)</option>--}}
                                    {{--<option data-countryCode="RW" value="250">Rwanda (+250)</option>--}}
                                    {{--<option data-countryCode="SM" value="378">San Marino (+378)</option>--}}
                                    {{--<option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>--}}
                                    {{--<option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>--}}
                                    {{--<option data-countryCode="SN" value="221">Senegal (+221)</option>--}}
                                    {{--<option data-countryCode="CS" value="381">Serbia (+381)</option>--}}
                                    {{--<option data-countryCode="SC" value="248">Seychelles (+248)</option>--}}
                                    {{--<option data-countryCode="SL" value="232">Sierra Leone (+232)</option>--}}
                                    {{--<option data-countryCode="SG" value="65">Singapore (+65)</option>--}}
                                    {{--<option data-countryCode="SK" value="421">Slovak Republic (+421)</option>--}}
                                    {{--<option data-countryCode="SI" value="386">Slovenia (+386)</option>--}}
                                    {{--<option data-countryCode="SB" value="677">Solomon Islands (+677)</option>--}}
                                    {{--<option data-countryCode="SO" value="252">Somalia (+252)</option>--}}
                                    {{--<option data-countryCode="ZA" value="27">South Africa (+27)</option>--}}
                                    {{--<option data-countryCode="ES" value="34">Spain (+34)</option>--}}
                                    {{--<option data-countryCode="LK" value="94">Sri Lanka (+94)</option>--}}
                                    {{--<option data-countryCode="SH" value="290">St. Helena (+290)</option>--}}
                                    {{--<option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>--}}
                                    {{--<option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>--}}
                                    {{--<option data-countryCode="SD" value="249">Sudan (+249)</option>--}}
                                    {{--<option data-countryCode="SR" value="597">Suriname (+597)</option>--}}
                                    {{--<option data-countryCode="SZ" value="268">Swaziland (+268)</option>--}}
                                    {{--<option data-countryCode="SE" value="46">Sweden (+46)</option>--}}
                                    {{--<option data-countryCode="CH" value="41">Switzerland (+41)</option>--}}
                                    {{--<option data-countryCode="SI" value="963">Syria (+963)</option>--}}
                                    {{--<option data-countryCode="TW" value="886">Taiwan (+886)</option>--}}
                                    {{--<option data-countryCode="TJ" value="7">Tajikstan (+7)</option>--}}
                                    {{--<option data-countryCode="TH" value="66">Thailand (+66)</option>--}}
                                    {{--<option data-countryCode="TG" value="228">Togo (+228)</option>--}}
                                    {{--<option data-countryCode="TO" value="676">Tonga (+676)</option>--}}
                                    {{--<option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>--}}
                                    {{--<option data-countryCode="TN" value="216">Tunisia (+216)</option>--}}
                                    {{--<option data-countryCode="TR" value="90">Turkey (+90)</option>--}}
                                    {{--<option data-countryCode="TM" value="7">Turkmenistan (+7)</option>--}}
                                    {{--<option data-countryCode="TM" value="993">Turkmenistan (+993)</option>--}}
                                    {{--<option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>--}}
                                    {{--<option data-countryCode="TV" value="688">Tuvalu (+688)</option>--}}
                                    {{--<option data-countryCode="UG" value="256">Uganda (+256)</option>--}}
                                    {{--<option data-countryCode="GB" value="44">UK (+44)</option>--}}
                                    {{--<option data-countryCode="UA" value="380">Ukraine (+380)</option>--}}
                                    {{--<option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>--}}
                                    {{--<option data-countryCode="UY" value="598">Uruguay (+598)</option>--}}
                                    {{--<option data-countryCode="US" value="1">USA (+1)</option>--}}
                                    {{--<option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>--}}
                                    {{--<option data-countryCode="VU" value="678">Vanuatu (+678)</option>--}}
                                    {{--<option data-countryCode="VA" value="379">Vatican City (+379)</option>--}}
                                    {{--<option data-countryCode="VE" value="58">Venezuela (+58)</option>--}}
                                    {{--<option data-countryCode="VN" value="84">Vietnam (+84)</option>--}}
                                    {{--<option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>--}}
                                    {{--<option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>--}}
                                    {{--<option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>--}}
                                    {{--<option data-countryCode="YE" value="969">Yemen (North)(+969)</option>--}}
                                    {{--<option data-countryCode="YE" value="967">Yemen (South)(+967)</option>--}}
                                    {{--<option data-countryCode="ZM" value="260">Zambia (+260)</option>--}}
                                    {{--<option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>--}}
                                    {{--</optgroup>--}}
                                {{--</select>--}}
                                <select class="form-control" name="countryCode" id="">
                                    <option selected value="" disabled>Select Country</option>
                                    <option data-countryCode="DZ">Algeria ,(+213)</option>
                                    <option data-countryCode="AD">Andorra ,(+376)</option>
                                    <option data-countryCode="AO">Angola ,(+244)</option>
                                    <option data-countryCode="AI">Anguilla ,(+1264)</option>
                                    <option data-countryCode="AG">Antigua &amp; Barbuda ,(+1268)</option>
                                    <option data-countryCode="AR">Argentina ,(+54)</option>
                                    <option data-countryCode="AM">Armenia ,(+374)</option>
                                    <option data-countryCode="AW">Aruba ,(+297)</option>
                                    <option data-countryCode="AU">Australia ,(+61)</option>
                                    <option data-countryCode="AT">Austria ,(+43)</option>
                                    <option data-countryCode="AZ">Azerbaijan ,(+994)</option>
                                    <option data-countryCode="BS">Bahamas ,(+1242)</option>
                                    <option data-countryCode="BH">Bahrain ,(+973)</option>
                                    <option data-countryCode="BD">Bangladesh ,(+880)</option>
                                    <option data-countryCode="BB">Barbados ,(+1246)</option>
                                    <option data-countryCode="BY">Belarus ,(+375)</option>
                                    <option data-countryCode="BE">Belgium ,(+32)</option>
                                    <option data-countryCode="BZ">Belize ,(+501)</option>
                                    <option data-countryCode="BJ">Benin ,(+229)</option>
                                    <option data-countryCode="BM">Bermuda ,(+1441)</option>
                                    <option data-countryCode="BT">Bhutan ,(+975)</option>
                                    <option data-countryCode="BO">Bolivia ,(+591)</option>
                                    <option data-countryCode="BA">Bosnia Herzegovina ,(+387)</option>
                                    <option data-countryCode="BW">Botswana ,(+267)</option>
                                    <option data-countryCode="BR">Brazil ,(+55)</option>
                                    <option data-countryCode="BN">Brunei ,(+673)</option>
                                    <option data-countryCode="BG">Bulgaria ,(+359)</option>
                                    <option data-countryCode="BF">Burkina Faso ,(+226)</option>
                                    <option data-countryCode="BI">Burundi ,(+257)</option>
                                    <option data-countryCode="KH">Cambodia ,(+855)</option>
                                    <option data-countryCode="CM">Cameroon ,(+237)</option>
                                    <option data-countryCode="CA">Canada ,(+1)</option>
                                    <option data-countryCode="CV">Cape Verde Islands ,(+238)</option>
                                    <option data-countryCode="KY">Cayman Islands ,(+1345)</option>
                                    <option data-countryCode="CF">Central African Republic ,(+236)</option>
                                    <option data-countryCode="CL">Chile ,(+56)</option>
                                    <option data-countryCode="CN">China ,(+86)</option>
                                    <option data-countryCode="CO">Colombia ,(+57)</option>
                                    <option data-countryCode="KM">Comoros ,(+269)</option>
                                    <option data-countryCode="CG">Congo ,(+242)</option>
                                    <option data-countryCode="CK">Cook Islands ,(+682)</option>
                                    <option data-countryCode="CR">Costa Rica ,(+506)</option>
                                    <option data-countryCode="HR">Croatia ,(+385)</option>
                                    <option data-countryCode="CU">Cuba ,(+53)</option>
                                    <option data-countryCode="CY">Cyprus North ,(+90392)</option>
                                    <option data-countryCode="CY">Cyprus South ,(+357)</option>
                                    <option data-countryCode="CZ">Czech Republic ,(+42)</option>
                                    <option data-countryCode="DK">Denmark ,(+45)</option>
                                    <option data-countryCode="DJ">Djibouti ,(+253)</option>
                                    <option data-countryCode="DM">Dominica ,(+1809)</option>
                                    <option data-countryCode="DO">Dominican Republic ,(+1809)</option>
                                    <option data-countryCode="EC">Ecuador ,(+593)</option>
                                    <option data-countryCode="EG">Egypt ,(+20)</option>
                                    <option data-countryCode="SV">El Salvador ,(+503)</option>
                                    <option data-countryCode="GQ">Equatorial Guinea ,(+240)</option>
                                    <option data-countryCode="ER">Eritrea ,(+291)</option>
                                    <option data-countryCode="EE">Estonia ,(+372)</option>
                                    <option data-countryCode="ET">Ethiopia ,(+251)</option>
                                    <option data-countryCode="FK">Falkland Islands ,(+500)</option>
                                    <option data-countryCode="FO">Faroe Islands ,(+298)</option>
                                    <option data-countryCode="FJ">Fiji ,(+679)</option>
                                    <option data-countryCode="FI">Finland ,(+358)</option>
                                    <option data-countryCode="FR">France ,(+33)</option>
                                    <option data-countryCode="GF">French Guiana ,(+594)</option>
                                    <option data-countryCode="PF">French Polynesia ,(+689)</option>
                                    <option data-countryCode="GA">Gabon ,(+241)</option>
                                    <option data-countryCode="GM">Gambia ,(+220)</option>
                                    <option data-countryCode="GE">Georgia ,(+7880)</option>
                                    <option data-countryCode="DE">Germany ,(+49)</option>
                                    <option data-countryCode="GH">Ghana ,(+233)</option>
                                    <option data-countryCode="GI">Gibraltar ,(+350)</option>
                                    <option data-countryCode="GR">Greece ,(+30)</option>
                                    <option data-countryCode="GL">Greenland ,(+299)</option>
                                    <option data-countryCode="GD">Grenada ,(+1473)</option>
                                    <option data-countryCode="GP">Guadeloupe ,(+590)</option>
                                    <option data-countryCode="GU">Guam ,(+671)</option>
                                    <option data-countryCode="GT">Guatemala ,(+502)</option>
                                    <option data-countryCode="GN">Guinea ,(+224)</option>
                                    <option data-countryCode="GW">Guinea - Bissau ,(+245)</option>
                                    <option data-countryCode="GY">Guyana ,(+592)</option>
                                    <option data-countryCode="HT">Haiti ,(+509)</option>
                                    <option data-countryCode="HN">Honduras ,(+504)</option>
                                    <option data-countryCode="HK">Hong Kong ,(+852)</option>
                                    <option data-countryCode="HU">Hungary ,(+36)</option>
                                    <option data-countryCode="IS">Iceland ,(+354)</option>
                                    <option data-countryCode="IN">India ,(+91)</option>
                                    <option data-countryCode="ID">Indonesia ,(+62)</option>
                                    <option data-countryCode="IR">Iran ,(+98)</option>
                                    <option data-countryCode="IQ">Iraq ,(+964)</option>
                                    <option data-countryCode="IE">Ireland ,(+353)</option>
                                    <option data-countryCode="IL">Israel ,(+972)</option>
                                    <option data-countryCode="IT">Italy ,(+39)</option>
                                    <option data-countryCode="JM">Jamaica ,(+1876)</option>
                                    <option data-countryCode="JP">Japan ,(+81)</option>
                                    <option data-countryCode="JO">Jordan ,(+962)</option>
                                    <option data-countryCode="KZ">Kazakhstan ,(+7)</option>
                                    <option data-countryCode="KE">Kenya ,(+254)</option>
                                    <option data-countryCode="KI">Kiribati ,(+686)</option>
                                    <option data-countryCode="KP">Korea North ,(+850)</option>
                                    <option data-countryCode="KR">Korea South ,(+82)</option>
                                    <option data-countryCode="KW">Kuwait ,(+965)</option>
                                    <option data-countryCode="KG">Kyrgyzstan ,(+996)</option>
                                    <option data-countryCode="LA">Laos ,(+856)</option>
                                    <option data-countryCode="LV">Latvia ,(+371)</option>
                                    <option data-countryCode="LB">Lebanon ,(+961)</option>
                                    <option data-countryCode="LS">Lesotho ,(+266)</option>
                                    <option data-countryCode="LR">Liberia ,(+231)</option>
                                    <option data-countryCode="LY">Libya ,(+218)</option>
                                    <option data-countryCode="LI">Liechtenstein ,(+417)</option>
                                    <option data-countryCode="LT">Lithuania ,(+370)</option>
                                    <option data-countryCode="LU">Luxembourg ,(+352)</option>
                                    <option data-countryCode="MO">Macao ,(+853)</option>
                                    <option data-countryCode="MK">Macedonia ,(+389)</option>
                                    <option data-countryCode="MG">Madagascar ,(+261)</option>
                                    <option data-countryCode="MW">Malawi ,(+265)</option>
                                    <option data-countryCode="MY">Malaysia ,(+60)</option>
                                    <option data-countryCode="MV">Maldives ,(+960)</option>
                                    <option data-countryCode="ML">Mali ,(+223)</option>
                                    <option data-countryCode="MT">Malta ,(+356)</option>
                                    <option data-countryCode="MH">Marshall Islands ,(+692)</option>
                                    <option data-countryCode="MQ">Martinique ,(+596)</option>
                                    <option data-countryCode="MR">Mauritania ,(+222)</option>
                                    <option data-countryCode="YT">Mayotte ,(+269)</option>
                                    <option data-countryCode="MX">Mexico ,(+52)</option>
                                    <option data-countryCode="FM">Micronesia ,(+691)</option>
                                    <option data-countryCode="MD">Moldova ,(+373)</option>
                                    <option data-countryCode="MC">Monaco ,(+377)</option>
                                    <option data-countryCode="MN">Mongolia ,(+976)</option>
                                    <option data-countryCode="MS">Montserrat ,(+1664)</option>
                                    <option data-countryCode="MA">Morocco ,(+212)</option>
                                    <option data-countryCode="MZ">Mozambique ,(+258)</option>
                                    <option data-countryCode="MN">Myanmar ,(+95)</option>
                                    <option data-countryCode="NA">Namibia ,(+264)</option>
                                    <option data-countryCode="NR">Nauru ,(+674)</option>
                                    <option data-countryCode="NP">Nepal ,(+977)</option>
                                    <option data-countryCode="NL">Netherlands ,(+31)</option>
                                    <option data-countryCode="NC">New Caledonia ,(+687)</option>
                                    <option data-countryCode="NZ">ew Zealand ,(+64)</option>
                                    <option data-countryCode="NI">Nicaragua ,(+505)</option>
                                    <option data-countryCode="NE">Niger ,(+227)</option>
                                    <option data-countryCode="NG">Nigeria ,(+234)</option>
                                    <option data-countryCode="NU">Niue ,(+683)</option>
                                    <option data-countryCode="NF">Norfolk Islands ,(+672)</option>
                                    <option data-countryCode="NP">Northern Marianas ,(+670)</option>
                                    <option data-countryCode="NO">Norway ,(+47)</option>
                                    <option data-countryCode="OM">Oman ,(+968)</option>
                                    <option data-countryCode="PS">Palestine ,(+970)</option>
                                    <option data-countryCode="PW">Palau ,(+680)</option>
                                    <option data-countryCode="PK">Pakistan ,(+92)</option>
                                    <option data-countryCode="PA">Panama ,(+507)</option>
                                    <option data-countryCode="PG">Papua New Guinea ,(+675)</option>
                                    <option data-countryCode="PY">Paraguay ,(+595)</option>
                                    <option data-countryCode="PE">eru ,(+51)</option>
                                    <option data-countryCode="PH">hilippines ,(+63)</option>
                                    <option data-countryCode="PL">oland ,(+48)</option>
                                    <option data-countryCode="PT">Portugal ,(+351)</option>
                                    <option data-countryCode="PR">Puerto Rico ,(+1787)</option>
                                    <option data-countryCode="QA">Qatar ,(+974)</option>
                                    <option data-countryCode="RE">Reunion ,(+262)</option>
                                    <option data-countryCode="RO">Romania ,(+40)</option>
                                    <option data-countryCode="RU">Russia ,(+7)</option>
                                    <option data-countryCode="RW">Rwanda ,(+250)</option>
                                    <option data-countryCode="SM">San Marino ,(+378)</option>
                                    <option data-countryCode="ST">Sao Tome &amp; Principe ,(+239)</option>
                                    <option data-countryCode="SA">Saudi Arabia ,(+966)</option>
                                    <option data-countryCode="SN">Senegal ,(+221)</option>
                                    <option data-countryCode="CS">Serbia ,(+381)</option>
                                    <option data-countryCode="SC">Seychelles ,(+248)</option>
                                    <option data-countryCode="SL">Sierra Leone ,(+232)</option>
                                    <option data-countryCode="SG">Singapore ,(+65)</option>
                                    <option data-countryCode="SK">Slovak Republic ,(+421)</option>
                                    <option data-countryCode="SI">Slovenia ,(+386)</option>
                                    <option data-countryCode="SB">Solomon Islands ,(+677)</option>
                                    <option data-countryCode="SO">Somalia ,(+252)</option>
                                    <option data-countryCode="ZA">South Africa ,(+27)</option>
                                    <option data-countryCode="ES">Spain ,(+34)</option>
                                    <option data-countryCode="LK">Sri Lanka ,(+94)</option>
                                    <option data-countryCode="SH">St. Helena ,(+290)</option>
                                    <option data-countryCode="KN">St. Kitts ,(+1869)</option>
                                    <option data-countryCode="SC">St. Lucia ,(+1758)</option>
                                    <option data-countryCode="SD">Sudan ,(+249)</option>
                                    <option data-countryCode="SR">Suriname ,(+597)</option>
                                    <option data-countryCode="SZ">Swaziland ,(+268)</option>
                                    <option data-countryCode="SE">Sweden ,(+46)</option>
                                    <option data-countryCode="CH">Switzerland ,(+41)</option>
                                    <option data-countryCode="SI">Syria ,(+963)</option>
                                    <option data-countryCode="TW">Taiwan ,(+886)</option>
                                    <option data-countryCode="TJ">Tajikstan ,(+7)</option>
                                    <option data-countryCode="TH">Thailand ,(+66)</option>
                                    <option data-countryCode="TG">Togo ,(+228)</option>
                                    <option data-countryCode="TO">Tonga ,(+676)</option>
                                    <option data-countryCode="TT">Trinidad &amp; Tobago ,(+1868)</option>
                                    <option data-countryCode="TN">Tunisia ,(+216)</option>
                                    <option data-countryCode="TR">Turkey ,(+90)</option>
                                    <option data-countryCode="TM">Turkmenistan ,(+7)</option>
                                    <option data-countryCode="TM">Turkmenistan ,(+993)</option>
                                    <option data-countryCode="TC">Turks &amp; Caicos Islands ,(+1649)</option>
                                    <option data-countryCode="TV">Tuvalu ,(+688)</option>
                                    <option data-countryCode="UG">Uganda ,(+256)</option>
                                    <option data-countryCode="GB">UK ,(+44)</option>
                                    <option data-countryCode="UA">Ukraine ,(+380)</option>
                                    <option data-countryCode="AE">United Arab Emirates ,(+971)</option>
                                    <option data-countryCode="UY">Uruguay ,(+598)</option>
                                    <option data-countryCode="US">USA ,(+1)</option>
                                    <option data-countryCode="UZ">Uzbekistan ,(+7)</option>
                                    <option data-countryCode="VU">Vanuatu ,(+678)</option>
                                    <option data-countryCode="VA">Vatican City ,(+379)</option>
                                    <option data-countryCode="VE">Venezuela ,(+58)</option>
                                    <option data-countryCode="VN">Vietnam ,(+84)</option>
                                    <option data-countryCode="VG">Virgin Islands - British ,(+1284)</option>
                                    <option data-countryCode="VI">Virgin Islands - US ,(+1340)</option>
                                    <option data-countryCode="WF">Wallis &amp; Futuna ,(+681)</option>
                                    <option data-countryCode="YE">Yemen (North),(+969)</option>
                                    <option data-countryCode="YE">Yemen (South),(+967)</option>
                                    <option data-countryCode="ZM">Zambia ,(+260)</option>
                                    <option data-countryCode="ZW">Zimbabwe ,(+263)</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="mb-4 icon_position">
                                <div class="icon"><img src="{{ asset('website') }}/img/phone.png" alt=""></div>
                                <input type="tel" placeholder="Phone Number" aria-label="Username" aria-describedby="basic-addon1" value="{{old('phoneno')}}" name="phoneno" required>
                            </div>
                        </div>

                        @if($route_name == 'vendor-signup')
                            <div class="col-md-12 col-sm-12">
                                {{--<div class="mb-4 icon_position">--}}
{{--                                    <div class="icon"><img src="{{ asset('website') }}/img/multi_role.png" alt="">Select Signup Type</div>--}}
                                    {{--<select  class="form-control selectpicker" name="vendorType[]"  multiple  required>--}}
                                        {{--<option value="" disabled selected>Select Signup Type</option>--}}
                                        {{--<option value="packagedeals">Package Deals</option>--}}
                                        {{--<option value="hotels">Hotels</option>--}}
                                        {{--<option value="transport">Transports</option>--}}
                                        {{--<option value="guestspass">Guests Pass</option>--}}
                                        {{--<option value="guide">Guide</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                                <p> Select Signup Type</p>
                                <input type="checkbox" name="vendorType[]" id="package" value="packagedeals">
                                <label for="package">Package Deals - I am an agent/owner of travel agency.</label><br>
                                <input type="checkbox" name="vendorType[]" id="hotel" value="hotels">
                                <label for="hotel"> Hotels - I am an agent/owner of Hotel/Residence for rental.</label><br>
                                <input type="checkbox" name="vendorType[]" id="transport" value="transport">
                                <label for="transport"> Transports - I am an agent/owner of Transportation </label><br>
                                <input type="checkbox" name="vendorType[]" id="guestpass" value="guestspass">
                                <label for="guestpass"> Shrine Programs - I arrange program and events at Holy Shrines in Iraq.</label><br>
                                <input type="checkbox" name="vendorType[]" id="guide" value="guide">
                                <label for="guide"> Guide - I am a guide / I manage guides.</label><br>
                            </div>
                        @else
                            <input type="hidden" name="vendorType[]" value="customer">
                            <input type="hidden" name="status" value="1">
                        @endif
                        {{--<div class="col-md-12 mb-4">--}}
                            {{--<textarea class="form-control{{ $errors->has('bio') ? ' is-invalid' : '' }}" name="bio" id="summerhousehours" placeholder="Bio" rows="5">{{ old('bio') }}</textarea>--}}
                        {{--</div>--}}
                        <div class="col-md-12 mb-4 form-check">
                            {{--<input type="checkbox" class="" id="checkbox">--}}
                            <label class="form-check-label" for="exampleCheck1">By signing in or creating an account, you agree with our <a href="{{URL('terms-and-conditions')}}" class="privacypolicy"> Terms & Conditions</a> and <a href="{{URL('privacypolicy')}}" class="privacypolicy">Privacy Statement</a> </label>
                        </div>
                        <div class="buttons text-center mt-4">
                            <button type="submit" class="btn">Sign Up&nbsp; <i class="fas fa-arrow-right"></i></button>
                            <span class="d-block  mt-4">Already have an account? <a href="{{url('user-login')}}" class="login"> Login</a></span>
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
            console.log(input);
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
            {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#profile_pic').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
            else
            {
                $('#profile_pic').attr('src', '{{ asset('website') }}/img/camera.png');
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select .gif, .png, .jpeg, .jpg format picture...',
                })
            }
        });
    });


//    $('option').mousedown(function(e) {
//        e.preventDefault();
//        var originalScrollTop = $(this).parent().scrollTop();
//        console.log(originalScrollTop);
//        $(this).prop('selected', $(this).prop('selected') ? false : true);
//        var self = this;
//        $(this).parent().focus();
//        setTimeout(function() {
//            $(self).parent().scrollTop(originalScrollTop);
//        }, 0);
//
//        return false;
//    });

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
<script>
    $(".selectpicker").chosen({
        no_results_text: "Oops, nothing found!"
    });
</script>
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>--}}
{{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>--}}
{{--<script>$('.selectpicker').selectpicker();</script>--}}
@endpush
