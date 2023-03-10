
<?php $__env->startPush('css'); ?>
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
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php if(session('message')): ?>
        <!-- <div class="account-title"><?php echo e(session('message')); ?></div> -->
        <div class="account-title">
            <p class="alert alert-success"><?php echo e(session('message')); ?></p>
        </div>
    <?php endif; ?>
    <section class="loginform">
        <div class="container">
            <div class="inner_col">
                <form method="POST" action="<?php echo e(route('usersignup')); ?>" enctype='multipart/form-data' id="register">
                    <?php echo e(csrf_field()); ?>

                    <div class="row">

                        <div class="col-md-12 mb-2">
                            <h1 class="text-center loginheading pb-4">Register</h1>
                        </div>
                        
                            
                        
                        
                            
                                
                            
                            
                        
                        <?php if($route_name == 'vendor-signup'): ?>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="mb-4 icon_position">
                                    <div class="icon"><img src="<?php echo e(asset('website')); ?>/img/Icon awesome-user-alt.png" alt=""></div>
                                    <input type="text" placeholder="Company Name" aria-label="Companyname" aria-describedby="basic-addon1" name="company_name" value="<?php echo e(old('company_name')); ?>" required autofocus>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="mb-4 icon_position">
                                <div class="icon"><img src="<?php echo e(asset('website')); ?>/img/Icon awesome-user-alt.png" alt=""></div>
                                <input type="text" placeholder="Name" aria-label="Username" aria-describedby="basic-addon1" name="name" value="<?php echo e(old('name')); ?>" required autofocus>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="mb-4 icon_position">
                                <div class="icon"><img src="<?php echo e(asset('website')); ?>/img/Icon awesome-envelope.png"></div>
                                <input type="email" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1" name="email" value="<?php echo e(old('email')); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="mb-4 icon_position">
                                <div class="icon"><img src="<?php echo e(asset('website')); ?>/img/Icon awesome-key.png" alt=""></div>
                                <input type="password" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" name="password" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="mb-4 icon_position">
                                <div class="icon"><img src="<?php echo e(asset('website')); ?>/img/Icon awesome-key.png" alt=""></div>
                                <input type="password" placeholder="Confirm Password" aria-label="Username" aria-describedby="basic-addon1" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="mb-4 icon_position">
                                <div class="icon"><img src="<?php echo e(asset('website')); ?>/img/brazil.png" alt=""></div>
                                
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                
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
                                <div class="icon"><img src="<?php echo e(asset('website')); ?>/img/phone.png" alt=""></div>
                                <input type="tel" placeholder="Phone Number" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo e(old('phoneno')); ?>" name="phoneno" required>
                            </div>
                        </div>

                        <?php if($route_name == 'vendor-signup'): ?>
                            <div class="col-md-12 col-sm-12">
                                

                                    
                                        
                                        
                                        
                                        
                                        
                                        
                                    
                                
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
                        <?php else: ?>
                            <input type="hidden" name="vendorType[]" value="customer">
                            <input type="hidden" name="status" value="1">
                        <?php endif; ?>
                        
                            
                        
                        <div class="col-md-12 mb-4 form-check">
                            
                            <label class="form-check-label" for="exampleCheck1">By signing in or creating an account, you agree with our <a href="<?php echo e(URL('terms-and-conditions')); ?>" class="privacypolicy"> Terms & Conditions</a> and <a href="<?php echo e(URL('privacypolicy')); ?>" class="privacypolicy">Privacy Statement</a> </label>
                        </div>
                        <div class="buttons text-center mt-4">
                            <button type="submit" class="btn">Sign Up&nbsp; <i class="fas fa-arrow-right"></i></button>
                            <span class="d-block  mt-4">Already have an account? <a href="<?php echo e(url('user-login')); ?>" class="login"> Login</a></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
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
                $('#profile_pic').attr('src', '<?php echo e(asset('website')); ?>/img/camera.png');
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




<?php $__env->stopPush(); ?>

<?php echo $__env->make('website.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/user_signup.blade.php ENDPATH**/ ?>