@extends('layouts.master')

@push('css')
<link href="{{ asset('plugins/components/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
<link href="{{asset('plugins/components/icheck/skins/all.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet"/>
{{--<link href="{{asset('plugins/components/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">--}}
<link href="{{asset('plugins/components/jqueryui/jquery-ui.min.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
<style>
    /* #rootwizard .nav.nav-pills {
        margin-bottom: 25px;
    }

    .help-block {
        display: block;
        margin-top: 5px;
        margin-bottom: 10px;
    }
    .nav-pills>li>a{
        cursor: default;;
        background-color: inherit;
    }
    .nav-pills>li>a:focus,.nav-tabs>li>a:focus, .nav-pills>li>a:hover, .nav-tabs>li>a:hover {
        border: 1px solid transparent!important;
        background-color: inherit!important;
    }
    .has-error .help-block {
        color: #EF6F6C;
    }

    .select2 {
        width: 100% !important;
    }
    .error-block{
        background-color: #ff9d9d;
        color: red;
    } */
</style>
@endpush

@section('content')


    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Edit User</h3>
                    <hr>
                    <div class="clearfix"></div>
                    <form id="commentForm" action="{{url('user/edit/'.$user->id)}}"
                          method="POST" enctype="multipart/form-data" class="form-horizontal">
                        <!-- CSRF Token -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <div id="rootwizard">
                            {{--<ul class="nav nav-tabs">--}}
                            {{--<li class="active"><a href="#tab1" data-toggle="tab">User Profile</a></li>--}}
                            {{--<li><a href="#tab2" data-toggle="tab">Bio</a></li>--}}
                            {{--<li><a href="#tab3" data-toggle="tab">Address</a></li>--}}
                            {{--<li><a href="#tab4" data-toggle="tab">User Role</a></li>--}}
                            {{--</ul>--}}
                            <div class="tab-content">
                                {{--<div class="tab-pane active" id="tab1">--}}
                                <h2 class="hidden">&nbsp;</h2>
                                <h3><b>Profile</b></h3>

                                <div class="form-group {{ $errors->first('name', 'has-error') }}">
                                    <label for="name" class="col-sm-2 control-label">Name *</label>
                                    <div class="col-sm-10">
                                        <input id="name" name="name" type="text"
                                               placeholder="Name" class="form-control required"
                                               value="{{$user->name}}"/>

                                        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                    <label for="email" class="col-sm-2 control-label">Email *</label>
                                    <div class="col-sm-10">
                                        <input id="email" name="email" placeholder="E-mail" type="text"
                                               class="form-control required email" value="{{$user->email}}"/>
                                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>

                                <h6><b>If you don't want to change password... please leave them empty</b></h6>

                                <div class="form-group {{ $errors->first('password', 'has-error') }}">
                                    <label for="password" class="col-sm-2 control-label">Password *</label>
                                    <div class="col-sm-10">
                                        <input id="password" name="password" type="password" placeholder="Password"
                                               class="form-control required" value="{!! old('password') !!}"/>
                                        {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->first('password_confirmation', 'has-error') }}">
                                    <label for="password_confirm" class="col-sm-2 control-label">Confirm Password
                                        *</label>
                                    <div class="col-sm-10">
                                        <input id="password_confirmation" name="password_confirmation"
                                               type="password"
                                               placeholder="Confirm Password " class="form-control required"/>
                                        {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                {{--</div>--}}
                                {{--<div class="tab-pane" id="tab2" disabled="disabled">--}}
                                <h2 class="hidden">&nbsp;</h2>
                                <div class="form-group  {{ $errors->first('dob', 'has-error') }}">
                                    <label for="dob" class="col-sm-2 control-label">Date of Birth</label>
                                    <div class="col-sm-10">
                                        <input autocomplete="off" value="{{$user->profile->dob ?: null}}" id="dob" name="dob" type="text"  class="form-control"
                                               data-date-format="YYYY-MM-DD"
                                               placeholder="yyyy-mm-dd"/>
                                        <span class="help-block">{{ $errors->first('dob', ':message') }}</span>

                                    </div>
                                </div>

                                <h3><b>Picture</b></h3>
                                <div class="form-group {{ $errors->first('pic_file', 'has-error') }}">
                                    <label for="pic" class="col-sm-2 control-label">Profile picture</label>
                                    <div class="col-sm-10">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail"
                                                 style="width: 200px; height: 200px;">
                                                @if($user->profile->pic != null)
                                                    <img src="{{asset('website/ProfileImage/'.$user->profile->pic)}}" alt="profile pic">
                                                @else
                                                    <img src="http://placehold.it/200x200" alt="profile pic">
                                                @endif
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"
                                                 style="max-width: 200px; max-height: 200px;"></div>
                                            <div>
                                                <span class="btn btn-default btn-file">
                                                    <span class="fileinput-new">Select image</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input id="pic" name="pic_file" type="file" class="form-control"/>
                                                </span>
                                                <a href="#" class="btn btn-danger fileinput-exists"
                                                   data-dismiss="fileinput">Remove</a>
                                            </div>
                                        </div>
                                        <span class="help-block">{{ $errors->first('pic_file', ':message') }}</span>
                                    </div>
                                </div>


                                {{--<div class="form-group">--}}
                                {{--<label for="bio" class="col-sm-2 control-label">Bio--}}
                                {{--<small>(brief intro) *</small>--}}
                                {{--</label>--}}
                                {{--<div class="col-sm-10">--}}
                                {{--<textarea name="bio" id="bio" class="form-control resize_vertical" rows="4">{{$user->profile->bio}}</textarea>--}}
                                {{--</div>--}}
                                {{--{!! $errors->first('bio', '<span class="help-block">:message</span>') !!}--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="tab-pane" id="tab3" disabled="disabled">--}}
                                <div class="form-group {{ $errors->first('gender', 'has-error') }}">
                                    <label for="email" class="col-sm-2 control-label">Gender *</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" title="Select Gender..." name="gender">
                                            <option value="">Select</option>
                                            <option value="male"
                                                    @if($user->profile->gender === 'male') selected="selected" @endif >Male
                                            </option>
                                            <option value="female"
                                                    @if($user->profile->gender === 'female') selected="selected" @endif >
                                                Female
                                            </option>
                                            <option value="other"
                                                    @if($user->profile->gender === 'other') selected="selected" @endif >Other
                                            </option>

                                        </select>
                                        <span class="help-block">{{ $errors->first('gender', ':message') }}</span>
                                    </div>

                                </div>
                                <h3><b>Contact Information</b></h3>
                                <div class="form-group {{ $errors->first('country', 'has-error') }}">
                                    <label for="country" class="col-sm-2 control-label">Country</label>
                                    <div class="col-sm-10">
                                        {{--<input id="countries" name="country" type="text"
                                                   class="form-control"
                                                   value="{{$user->profile->country}}"/>--}}
                                        <span class="help-block">{{ $errors->first('country', ':message') }}</span>
                                        <select class="form-control" name="country" id="">
                                            <option @if( $user->profile->country == "") selected @endif value =  >Select Country</
                                            <option data-countryCode="DZ" @if( $user->profile->country == "213" ) selected @endif value = "213" >Algeria (+213)</option>
                                            <option data-countryCode="AD" @if( $user->profile->country == "376" ) selected @endif value = "376" >Andorra (+376)</option>
                                            <option data-countryCode="AO" @if( $user->profile->country == "244" ) selected @endif value = "244" >Angola (+244)</option>
                                            <option data-countryCode="AI" @if( $user->profile->country == "1264") selected @endif value = "1264" >Anguilla (+1264)</option>
                                            <option data-countryCode="AG" @if( $user->profile->country == "1268") selected @endif value = "1268" >Antigua &amp; Barbuda (+1268)</option>
                                            <option data-countryCode="AR" @if( $user->profile->country == "54"  ) selected @endif value = "54" >Argentina (+54)</option>
                                            <option data-countryCode="AM" @if( $user->profile->country == "374" ) selected @endif value = "374" >Armenia (+374)</option>
                                            <option data-countryCode="AW" @if( $user->profile->country == "297" ) selected @endif value = "297" >Aruba (+297)</option>
                                            <option data-countryCode="AU" @if( $user->profile->country == "61"  ) selected @endif value = "61" >Australia (+61)</option>
                                            <option data-countryCode="AT" @if( $user->profile->country == "43"  ) selected @endif value = "43" >Austria (+43)</option>
                                            <option data-countryCode="AZ" @if( $user->profile->country == "994" ) selected @endif value = "994" >Azerbaijan (+994)</option>
                                            <option data-countryCode="BS" @if( $user->profile->country == "1242") selected @endif value = "1242" >Bahamas (+1242)</option>
                                            <option data-countryCode="BH" @if( $user->profile->country == "973" ) selected @endif value = "973" >Bahrain (+973)</option>
                                            <option data-countryCode="BD" @if( $user->profile->country == "880" ) selected @endif value = "880" >Bangladesh (+880)</option>
                                            <option data-countryCode="BB" @if( $user->profile->country == "1246") selected @endif value = "1246" >Barbados (+1246)</option>
                                            <option data-countryCode="BY" @if( $user->profile->country == "375" ) selected @endif value = "375" >Belarus (+375)</option>
                                            <option data-countryCode="BE" @if( $user->profile->country == "32"  ) selected @endif value = "32" >Belgium (+32)</option>
                                            <option data-countryCode="BZ" @if( $user->profile->country == "501" ) selected @endif value = "501" >Belize (+501)</option>
                                            <option data-countryCode="BJ" @if( $user->profile->country == "229" ) selected @endif value = "229" >Benin (+229)</option>
                                            <option data-countryCode="BM" @if( $user->profile->country == "1441") selected @endif value = "1441" >Bermuda (+1441)</option>
                                            <option data-countryCode="BT" @if( $user->profile->country == "975" ) selected @endif value = "975" >Bhutan (+975)</option>
                                            <option data-countryCode="BO" @if( $user->profile->country == "591" ) selected @endif value = "591" >Bolivia (+591)</option>
                                            <option data-countryCode="BA" @if( $user->profile->country == "387" ) selected @endif value = "387" >Bosnia Herzegovina (+387)</option>
                                            <option data-countryCode="BW" @if( $user->profile->country == "267" ) selected @endif value = "267" >Botswana (+267)</option>
                                            <option data-countryCode="BR" @if( $user->profile->country == "55"  ) selected @endif value = "55" >Brazil (+55)</option>
                                            <option data-countryCode="BN" @if( $user->profile->country == "673" ) selected @endif value = "673" >Brunei (+673)</option>
                                            <option data-countryCode="BG" @if( $user->profile->country == "359" ) selected @endif value = "359" >Bulgaria (+359)</option>
                                            <option data-countryCode="BF" @if( $user->profile->country == "226" ) selected @endif value = "226" >Burkina Faso (+226)</option>
                                            <option data-countryCode="BI" @if( $user->profile->country == "257" ) selected @endif value = "257" >Burundi (+257)</option>
                                            <option data-countryCode="KH" @if( $user->profile->country == "855" ) selected @endif value = "855" >Cambodia (+855)</option>
                                            <option data-countryCode="CM" @if( $user->profile->country == "237" ) selected @endif value = "237" >Cameroon (+237)</option>
                                            <option data-countryCode="CA" @if( $user->profile->country == "1"   ) selected @endif value = "1" >Canada (+1)</option>
                                            <option data-countryCode="CV" @if( $user->profile->country == "238" ) selected @endif value = "238" >Cape Verde Islands (+238)</option>
                                            <option data-countryCode="KY" @if( $user->profile->country == "1345") selected @endif value = "1345" >Cayman Islands (+1345)</option>
                                            <option data-countryCode="CF" @if( $user->profile->country == "236" ) selected @endif value = "236" >Central African Republic (+236)</option>
                                            <option data-countryCode="CL" @if( $user->profile->country == "56"  ) selected @endif value = "56" >Chile (+56)</option>
                                            <option data-countryCode="CN" @if( $user->profile->country == "86"  ) selected @endif value = "86" >China (+86)</option>
                                            <option data-countryCode="CO" @if( $user->profile->country == "57"  ) selected @endif value = "57" >Colombia (+57)</option>
                                            <option data-countryCode="KM" @if( $user->profile->country == "269" ) selected @endif value = "269" >Comoros (+269)</option>
                                            <option data-countryCode="CG" @if( $user->profile->country == "242" ) selected @endif value = "242" >Congo (+242)</option>
                                            <option data-countryCode="CK" @if( $user->profile->country == "682" ) selected @endif value = "682" >Cook Islands (+682)</option>
                                            <option data-countryCode="CR" @if( $user->profile->country == "506" ) selected @endif value = "506" >Costa Rica (+506)</option>
                                            <option data-countryCode="HR" @if( $user->profile->country == "385" ) selected @endif value = "385" >Croatia (+385)</option>
                                            <option data-countryCode="CU" @if( $user->profile->country == "53"  ) selected @endif value = "53" >Cuba (+53)</option>
                                            <option data-countryCode="CY" @if( $user->profile->country == "90392") selected @endif value = "90392" >Cyprus North (+90392)</option>
                                            <option data-countryCode="CY" @if( $user->profile->country == "357" ) selected @endif value = "357" >Cyprus South (+357)</option>
                                            <option data-countryCode="CZ" @if( $user->profile->country == "42"  ) selected @endif value = "42" >Czech Republic (+42)</option>
                                            <option data-countryCode="DK" @if( $user->profile->country == "45"  ) selected @endif value = "45" >Denmark (+45)</option>
                                            <option data-countryCode="DJ" @if( $user->profile->country == "253" ) selected @endif value = "253" >Djibouti (+253)</option>
                                            <option data-countryCode="DM" @if( $user->profile->country == "1809") selected @endif value = "1809" >Dominica (+1809)</option>
                                            <option data-countryCode="DO" @if( $user->profile->country == "1809") selected @endif value = "1809" >Dominican Republic (+1809)</option>
                                            <option data-countryCode="EC" @if( $user->profile->country == "593" ) selected @endif value = "593" >Ecuador (+593)</option>
                                            <option data-countryCode="EG" @if( $user->profile->country == "20"  ) selected @endif value = "20" >Egypt (+20)</option>
                                            <option data-countryCode="SV" @if( $user->profile->country == "503" ) selected @endif value = "503" >El Salvador (+503)</option>
                                            <option data-countryCode="GQ" @if( $user->profile->country == "240" ) selected @endif value = "240" >Equatorial Guinea (+240)</option>
                                            <option data-countryCode="ER" @if( $user->profile->country == "291" ) selected @endif value = "291" >Eritrea (+291)</option>
                                            <option data-countryCode="EE" @if( $user->profile->country == "372" ) selected @endif value = "372" >Estonia (+372)</option>
                                            <option data-countryCode="ET" @if( $user->profile->country == "251" ) selected @endif value = "251" >Ethiopia (+251)</option>
                                            <option data-countryCode="FK" @if( $user->profile->country == "500" ) selected @endif value = "500" >Falkland Islands (+500)</option>
                                            <option data-countryCode="FO" @if( $user->profile->country == "298" ) selected @endif value = "298" >Faroe Islands (+298)</option>
                                            <option data-countryCode="FJ" @if( $user->profile->country == "679" ) selected @endif value = "679" >Fiji (+679)</option>
                                            <option data-countryCode="FI" @if( $user->profile->country == "358" ) selected @endif value = "358" >Finland (+358)</option>
                                            <option data-countryCode="FR" @if( $user->profile->country == "33"  ) selected @endif value = "33" >France (+33)</option>
                                            <option data-countryCode="GF" @if( $user->profile->country == "594" ) selected @endif value = "594" >French Guiana (+594)</option>
                                            <option data-countryCode="PF" @if( $user->profile->country == "689" ) selected @endif value = "689" >French Polynesia (+689)</option>
                                            <option data-countryCode="GA" @if( $user->profile->country == "241" ) selected @endif value = "241" >Gabon (+241)</option>
                                            <option data-countryCode="GM" @if( $user->profile->country == "220" ) selected @endif value = "220" >Gambia (+220)</option>
                                            <option data-countryCode="GE" @if( $user->profile->country == "7880") selected @endif value = "7880" >Georgia (+7880)</option>
                                            <option data-countryCode="DE" @if( $user->profile->country == "49"  ) selected @endif value = "49" >Germany (+49)</option>
                                            <option data-countryCode="GH" @if( $user->profile->country == "233" ) selected @endif value = "233" >Ghana (+233)</option>
                                            <option data-countryCode="GI" @if( $user->profile->country == "350" ) selected @endif value = "350" >Gibraltar (+350)</option>
                                            <option data-countryCode="GR" @if( $user->profile->country == "30"  ) selected @endif value = "30" >Greece (+30)</option>
                                            <option data-countryCode="GL" @if( $user->profile->country == "299" ) selected @endif value = "299" >Greenland (+299)</option>
                                            <option data-countryCode="GD" @if( $user->profile->country == "1473") selected @endif value = "1473" >Grenada (+1473)</option>
                                            <option data-countryCode="GP" @if( $user->profile->country == "590" ) selected @endif value = "590" >Guadeloupe (+590)</option>
                                            <option data-countryCode="GU" @if( $user->profile->country == "671" ) selected @endif value = "671" >Guam (+671)</option>
                                            <option data-countryCode="GT" @if( $user->profile->country == "502" ) selected @endif value = "502" >Guatemala (+502)</option>
                                            <option data-countryCode="GN" @if( $user->profile->country == "224" ) selected @endif value = "224" >Guinea (+224)</option>
                                            <option data-countryCode="GW" @if( $user->profile->country == "245" ) selected @endif value = "245" >Guinea - Bissau (+245)</option>
                                            <option data-countryCode="GY" @if( $user->profile->country == "592" ) selected @endif value = "592" >Guyana (+592)</option>
                                            <option data-countryCode="HT" @if( $user->profile->country == "509" ) selected @endif value = "509" >Haiti (+509)</option>
                                            <option data-countryCode="HN" @if( $user->profile->country == "504" ) selected @endif value = "504" >Honduras (+504)</option>
                                            <option data-countryCode="HK" @if( $user->profile->country == "852" ) selected @endif value = "852" >Hong Kong (+852)</option>
                                            <option data-countryCode="HU" @if( $user->profile->country == "36"  ) selected @endif value = "36" >Hungary (+36)</option>
                                            <option data-countryCode="IS" @if( $user->profile->country == "354" ) selected @endif value = "354" >Iceland (+354)</option>
                                            <option data-countryCode="IN" @if( $user->profile->country == "91"  ) selected @endif value = "91" >India (+91)</option>
                                            <option data-countryCode="ID" @if( $user->profile->country == "62"  ) selected @endif value = "62" >Indonesia (+62)</option>
                                            <option data-countryCode="IR" @if( $user->profile->country == "98"  ) selected @endif value = "98" >Iran (+98)</option>
                                            <option data-countryCode="IQ" @if( $user->profile->country == "964" ) selected @endif value = "964" >Iraq (+964)</option>
                                            <option data-countryCode="IE" @if( $user->profile->country == "353" ) selected @endif value = "353" >Ireland (+353)</option>
                                            <option data-countryCode="IL" @if( $user->profile->country == "972" ) selected @endif value = "972" >Israel (+972)</option>
                                            <option data-countryCode="IT" @if( $user->profile->country == "39"  ) selected @endif value = "39" >Italy (+39)</option>
                                            <option data-countryCode="JM" @if( $user->profile->country == "1876") selected @endif value = "1876" >Jamaica (+1876)</option>
                                            <option data-countryCode="JP" @if( $user->profile->country == "81"  ) selected @endif value = "81" >Japan (+81)</option>
                                            <option data-countryCode="JO" @if( $user->profile->country == "962" ) selected @endif value = "962" >Jordan (+962)</option>
                                            <option data-countryCode="KZ" @if( $user->profile->country == "7"   ) selected @endif value = "7" >Kazakhstan (+7)</option>
                                            <option data-countryCode="KE" @if( $user->profile->country == "254" ) selected @endif value = "254" >Kenya (+254)</option>
                                            <option data-countryCode="KI" @if( $user->profile->country == "686" ) selected @endif value = "686" >Kiribati (+686)</option>
                                            <option data-countryCode="KP" @if( $user->profile->country == "850" ) selected @endif value = "850" >Korea North (+850)</option>
                                            <option data-countryCode="KR" @if( $user->profile->country == "82"  ) selected @endif value = "82" >Korea South (+82)</option>
                                            <option data-countryCode="KW" @if( $user->profile->country == "965" ) selected @endif value = "965" >Kuwait (+965)</option>
                                            <option data-countryCode="KG" @if( $user->profile->country == "996" ) selected @endif value = "996" >Kyrgyzstan (+996)</option>
                                            <option data-countryCode="LA" @if( $user->profile->country == "856" ) selected @endif value = "856" >Laos (+856)</option>
                                            <option data-countryCode="LV" @if( $user->profile->country == "371" ) selected @endif value = "371" >Latvia (+371)</option>
                                            <option data-countryCode="LB" @if( $user->profile->country == "961" ) selected @endif value = "961" >Lebanon (+961)</option>
                                            <option data-countryCode="LS" @if( $user->profile->country == "266" ) selected @endif value = "266" >Lesotho (+266)</option>
                                            <option data-countryCode="LR" @if( $user->profile->country == "231" ) selected @endif value = "231" >Liberia (+231)</option>
                                            <option data-countryCode="LY" @if( $user->profile->country == "218" ) selected @endif value = "218" >Libya (+218)</option>
                                            <option data-countryCode="LI" @if( $user->profile->country == "417" ) selected @endif value = "417" >Liechtenstein (+417)</option>
                                            <option data-countryCode="LT" @if( $user->profile->country == "370" ) selected @endif value = "370" >Lithuania (+370)</option>
                                            <option data-countryCode="LU" @if( $user->profile->country == "352" ) selected @endif value = "352" >Luxembourg (+352)</option>
                                            <option data-countryCode="MO" @if( $user->profile->country == "853" ) selected @endif value = "853" >Macao (+853)</option>
                                            <option data-countryCode="MK" @if( $user->profile->country == "389" ) selected @endif value = "389" >Macedonia (+389)</option>
                                            <option data-countryCode="MG" @if( $user->profile->country == "261" ) selected @endif value = "261" >Madagascar (+261)</option>
                                            <option data-countryCode="MW" @if( $user->profile->country == "265" ) selected @endif value = "265" >Malawi (+265)</option>
                                            <option data-countryCode="MY" @if( $user->profile->country == "60"  ) selected @endif value = "60" >Malaysia (+60)</option>
                                            <option data-countryCode="MV" @if( $user->profile->country == "960" ) selected @endif value = "960" >Maldives (+960)</option>
                                            <option data-countryCode="ML" @if( $user->profile->country == "223" ) selected @endif value = "223" >Mali (+223)</option>
                                            <option data-countryCode="MT" @if( $user->profile->country == "356" ) selected @endif value = "356" >Malta (+356)</option>
                                            <option data-countryCode="MH" @if( $user->profile->country == "692" ) selected @endif value = "692" >Marshall Islands (+692)</option>
                                            <option data-countryCode="MQ" @if( $user->profile->country == "596" ) selected @endif value = "596" >Martinique (+596)</option>
                                            <option data-countryCode="MR" @if( $user->profile->country == "222" ) selected @endif value = "222" >Mauritania (+222)</option>
                                            <option data-countryCode="YT" @if( $user->profile->country == "269" ) selected @endif value = "269" >Mayotte (+269)</option>
                                            <option data-countryCode="MX" @if( $user->profile->country == "52"  ) selected @endif value = "52" >Mexico (+52)</option>
                                            <option data-countryCode="FM" @if( $user->profile->country == "691" ) selected @endif value = "691" >Micronesia (+691)</option>
                                            <option data-countryCode="MD" @if( $user->profile->country == "373" ) selected @endif value = "373" >Moldova (+373)</option>
                                            <option data-countryCode="MC" @if( $user->profile->country == "377" ) selected @endif value = "377" >Monaco (+377)</option>
                                            <option data-countryCode="MN" @if( $user->profile->country == "976" ) selected @endif value = "976" >Mongolia (+976)</option>
                                            <option data-countryCode="MS" @if( $user->profile->country == "1664") selected @endif value = "1664" >Montserrat (+1664)</option>
                                            <option data-countryCode="MA" @if( $user->profile->country == "212" ) selected @endif value = "212" >Morocco (+212)</option>
                                            <option data-countryCode="MZ" @if( $user->profile->country == "258" ) selected @endif value = "258" >Mozambique (+258)</option>
                                            <option data-countryCode="MN" @if( $user->profile->country == "95"  ) selected @endif value = "95" >Myanmar (+95)</option>
                                            <option data-countryCode="NA" @if( $user->profile->country == "264" ) selected @endif value = "264" >Namibia (+264)</option>
                                            <option data-countryCode="NR" @if( $user->profile->country == "674" ) selected @endif value = "674" >Nauru (+674)</option>
                                            <option data-countryCode="NP" @if( $user->profile->country == "977" ) selected @endif value = "977" >Nepal (+977)</option>
                                            <option data-countryCode="NL" @if( $user->profile->country == "31"  ) selected @endif value = "31" >Netherlands (+31)</option>
                                            <option data-countryCode="NC" @if( $user->profile->country == "687" ) selected @endif value = "687" >New Caledonia (+687)</option>
                                            <option data-countryCode="NZ" @if( $user->profile->country == "64"  ) selected @endif value = "64" >New Zealand (+64)</option>
                                            <option data-countryCode="NI" @if( $user->profile->country == "505" ) selected @endif value = "505" >Nicaragua (+505)</option>
                                            <option data-countryCode="NE" @if( $user->profile->country == "227" ) selected @endif value = "227" >Niger (+227)</option>
                                            <option data-countryCode="NG" @if( $user->profile->country == "234" ) selected @endif value = "234" >Nigeria (+234)</option>
                                            <option data-countryCode="NU" @if( $user->profile->country == "683" ) selected @endif value = "683" >Niue (+683)</option>
                                            <option data-countryCode="NF" @if( $user->profile->country == "672" ) selected @endif value = "672" >Norfolk Islands (+672)</option>
                                            <option data-countryCode="NP" @if( $user->profile->country == "670" ) selected @endif value = "670" >Northern Marianas (+670)</option>
                                            <option data-countryCode="NO" @if( $user->profile->country == "47"  ) selected @endif value = "47" >Norway (+47)</option>
                                            <option data-countryCode="OM" @if( $user->profile->country == "968" ) selected @endif value = "968" >Oman (+968)</option>
                                            <option data-countryCode="PS" @if( $user->profile->country == "970" ) selected @endif value = "970" >Palestine (+970)</option>
                                            <option data-countryCode="PW" @if( $user->profile->country == "680" ) selected @endif value = "680" >Palau (+680)</option>
                                            <option data-countryCode="PK" @if( $user->profile->country == "92"  ) selected @endif value = "92" >Pakistan (+92)</option>
                                            <option data-countryCode="PA" @if( $user->profile->country == "507" ) selected @endif value = "507" >Panama (+507)</option>
                                            <option data-countryCode="PG" @if( $user->profile->country == "675" ) selected @endif value = "675" >Papua New Guinea (+675)</option>
                                            <option data-countryCode="PY" @if( $user->profile->country == "595" ) selected @endif value = "595" >Paraguay (+595)</option>
                                            <option data-countryCode="PE" @if( $user->profile->country == "51"  ) selected @endif value = "51" >Peru (+51)</option>
                                            <option data-countryCode="PH" @if( $user->profile->country == "63"  ) selected @endif value = "63" >Philippines (+63)</option>
                                            <option data-countryCode="PL" @if( $user->profile->country == "48"  ) selected @endif value = "48" >Poland (+48)</option>
                                            <option data-countryCode="PT" @if( $user->profile->country == "351" ) selected @endif value = "351" >Portugal (+351)</option>
                                            <option data-countryCode="PR" @if( $user->profile->country == "1787") selected @endif value = "1787" >Puerto Rico (+1787)</option>
                                            <option data-countryCode="QA" @if( $user->profile->country == "974" ) selected @endif value = "974" >Qatar (+974)</option>
                                            <option data-countryCode="RE" @if( $user->profile->country == "262" ) selected @endif value = "262" >Reunion (+262)</option>
                                            <option data-countryCode="RO" @if( $user->profile->country == "40"  ) selected @endif value = "40" >Romania (+40)</option>
                                            <option data-countryCode="RU" @if( $user->profile->country == "7"   ) selected @endif value = "7" >Russia (+7)</option>
                                            <option data-countryCode="RW" @if( $user->profile->country == "250" ) selected @endif value = "250" >Rwanda (+250)</option>
                                            <option data-countryCode="SM" @if( $user->profile->country == "378" ) selected @endif value = "378" >San Marino (+378)</option>
                                            <option data-countryCode="ST" @if( $user->profile->country == "239" ) selected @endif value = "239" >Sao Tome &amp; Principe (+239)</option>
                                            <option data-countryCode="SA" @if( $user->profile->country == "966" ) selected @endif value = "966" >Saudi Arabia (+966)</option>
                                            <option data-countryCode="SN" @if( $user->profile->country == "221" ) selected @endif value = "221" >Senegal (+221)</option>
                                            <option data-countryCode="CS" @if( $user->profile->country == "381" ) selected @endif value = "381" >Serbia (+381)</option>
                                            <option data-countryCode="SC" @if( $user->profile->country == "248" ) selected @endif value = "248" >Seychelles (+248)</option>
                                            <option data-countryCode="SL" @if( $user->profile->country == "232" ) selected @endif value = "232" >Sierra Leone (+232)</option>
                                            <option data-countryCode="SG" @if( $user->profile->country == "65"  ) selected @endif value = "65" >Singapore (+65)</option>
                                            <option data-countryCode="SK" @if( $user->profile->country == "421" ) selected @endif value = "421" >Slovak Republic (+421)</option>
                                            <option data-countryCode="SI" @if( $user->profile->country == "386" ) selected @endif value = "386" >Slovenia (+386)</option>
                                            <option data-countryCode="SB" @if( $user->profile->country == "677" ) selected @endif value = "677" >Solomon Islands (+677)</option>
                                            <option data-countryCode="SO" @if( $user->profile->country == "252" ) selected @endif value = "252" >Somalia (+252)</option>
                                            <option data-countryCode="ZA" @if( $user->profile->country == "27"  ) selected @endif value = "27" >South Africa (+27)</option>
                                            <option data-countryCode="ES" @if( $user->profile->country == "34"  ) selected @endif value = "34" >Spain (+34)</option>
                                            <option data-countryCode="LK" @if( $user->profile->country == "94"  ) selected @endif value = "94" >Sri Lanka (+94)</option>
                                            <option data-countryCode="SH" @if( $user->profile->country == "290" ) selected @endif value = "290" >St. Helena (+290)</option>
                                            <option data-countryCode="KN" @if( $user->profile->country == "1869") selected @endif value = "1869" >St. Kitts (+1869)</option>
                                            <option data-countryCode="SC" @if( $user->profile->country == "1758") selected @endif value = "1758" >St. Lucia (+1758)</option>
                                            <option data-countryCode="SD" @if( $user->profile->country == "249" ) selected @endif value = "249" >Sudan (+249)</option>
                                            <option data-countryCode="SR" @if( $user->profile->country == "597" ) selected @endif value = "597" >Suriname (+597)</option>
                                            <option data-countryCode="SZ" @if( $user->profile->country == "268" ) selected @endif value = "268" >Swaziland (+268)</option>
                                            <option data-countryCode="SE" @if( $user->profile->country == "46"  ) selected @endif value = "46" >Sweden (+46)</option>
                                            <option data-countryCode="CH" @if( $user->profile->country == "41"  ) selected @endif value = "41" >Switzerland (+41)</option>
                                            <option data-countryCode="SI" @if( $user->profile->country == "963" ) selected @endif value = "963" >Syria (+963)</option>
                                            <option data-countryCode="TW" @if( $user->profile->country == "886" ) selected @endif value = "886" >Taiwan (+886)</option>
                                            <option data-countryCode="TJ" @if( $user->profile->country == "7"   ) selected @endif value = "7" >Tajikstan (+7)</option>
                                            <option data-countryCode="TH" @if( $user->profile->country == "66"  ) selected @endif value = "66" >Thailand (+66)</option>
                                            <option data-countryCode="TG" @if( $user->profile->country == "228" ) selected @endif value = "228" >Togo (+228)</option>
                                            <option data-countryCode="TO" @if( $user->profile->country == "676" ) selected @endif value = "676" >Tonga (+676)</option>
                                            <option data-countryCode="TT" @if( $user->profile->country == "1868") selected @endif value = "1868" >Trinidad &amp; Tobago (+1868)</option>
                                            <option data-countryCode="TN" @if( $user->profile->country == "216" ) selected @endif value = "216" >Tunisia (+216)</option>
                                            <option data-countryCode="TR" @if( $user->profile->country == "90"  ) selected @endif value = "90" >Turkey (+90)</option>
                                            <option data-countryCode="TM" @if( $user->profile->country == "7"   ) selected @endif value = "7" >Turkmenistan (+7)</option>
                                            <option data-countryCode="TM" @if( $user->profile->country == "993" ) selected @endif value = "993" >Turkmenistan (+993)</option>
                                            <option data-countryCode="TC" @if( $user->profile->country == "1649") selected @endif value = "1649" >Turks &amp; Caicos Islands (+1649)</option>
                                            <option data-countryCode="TV" @if( $user->profile->country == "688" ) selected @endif value = "688" >Tuvalu (+688)</option>
                                            <option data-countryCode="UG" @if( $user->profile->country == "256" ) selected @endif value = "256" >Uganda (+256)</option>
                                            <option data-countryCode="GB" @if( $user->profile->country == "44"  ) selected @endif value = "44" >UK (+44)</option>
                                            <option data-countryCode="UA" @if( $user->profile->country == "380" ) selected @endif value = "380" >Ukraine (+380)</option>
                                            <option data-countryCode="AE" @if( $user->profile->country == "971" ) selected @endif value = "971" >United Arab Emirates (+971)</option>
                                            <option data-countryCode="UY" @if( $user->profile->country == "598" ) selected @endif value = "598" >Uruguay (+598)</option>
                                            <option data-countryCode="US" @if( $user->profile->country == "1"   ) selected @endif value = "1" >USA (+1)</option>
                                            <option data-countryCode="UZ" @if( $user->profile->country == "7"   ) selected @endif value = "7" >Uzbekistan (+7)</option>
                                            <option data-countryCode="VU" @if( $user->profile->country == "678" ) selected @endif value = "678" >Vanuatu (+678)</option>
                                            <option data-countryCode="VA" @if( $user->profile->country == "379" ) selected @endif value = "379" >Vatican City (+379)</option>
                                            <option data-countryCode="VE" @if( $user->profile->country == "58"  ) selected @endif value = "58" >Venezuela (+58)</option>
                                            <option data-countryCode="VN" @if( $user->profile->country == "84"  ) selected @endif value = "84" >Vietnam (+84)</option>
                                            <option data-countryCode="VG" @if( $user->profile->country == "84"  ) selected @endif value = "84" >Virgin Islands - British (+1284)</option>
                                            <option data-countryCode="VI" @if( $user->profile->country == "84"  ) selected @endif value = "84" >Virgin Islands - US (+1340)</option>
                                            <option data-countryCode="WF" @if( $user->profile->country == "681" ) selected @endif value = "681" >Wallis &amp; Futuna (+681)</option>
                                            <option data-countryCode="YE" @if( $user->profile->country == "969" ) selected @endif value = "969" >Yemen (North)(+969)</option>
                                            <option data-countryCode="YE" @if( $user->profile->country == "967" ) selected @endif value = "967" >Yemen (South)(+967)</option>
                                            <option data-countryCode="ZM" @if( $user->profile->country == "260" ) selected @endif value = "260" >Zambia (+260)</option>
                                            <option data-countryCode="ZW" @if( $user->profile->country == "263" ) selected @endif value = "263" >Zimbabwe (+263)</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                    <label for="email" class="col-sm-2 control-label">Email *</label>
                                    <div class="col-sm-10">
                                        <input id="email" name="email" placeholder="E-mail" type="text"
                                               class="form-control required email" value="{{$user->email}}" readonly/>
                                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <h3><b>Address</b></h3>

                                <div class="form-group {{ $errors->first('address', 'has-error') }}">
                                    <label for="address" class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-10">
                                        <input id="address" name="address" type="text" class="form-control"
                                               value="{{$user->profile->address}}"/>
                                        <span class="help-block">{{ $errors->first('address', ':message') }}</span>

                                    </div>
                                </div>

                                <div class="form-group {{ $errors->first('city', 'has-error') }}">
                                    <label for="city" class="col-sm-2 control-label">City</label>
                                    <div class="col-sm-10">
                                        <input id="city" name="city" type="text" class="form-control"
                                               value="{{$user->profile->city}}"/>
                                        <span class="help-block">{{ $errors->first('city', ':message') }}</span>

                                    </div>
                                </div>

                                <div class="form-group {{ $errors->first('state', 'has-error') }}">
                                    <label for="state" class="col-sm-2 control-label">State/Province</label>
                                    <div class="col-sm-10">
                                        <input id="state" name="state" type="text"
                                               class="form-control"
                                               value="{{$user->profile->state}}"/>
                                        <span class="help-block">{{ $errors->first('state', ':message') }}</span>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->first('postal', 'has-error') }}">
                                    <label for="postal" class="col-sm-2 control-label">Zip Code</label>
                                    <div class="col-sm-10">
                                        <input id="postal" name="postal" type="text" class="form-control"
                                               value="{{$user->profile->postal}}"/>
                                        <span class="help-block">{{ $errors->first('postal', ':message') }}</span>

                                    </div>
                                </div>
                                {{--</div>--}}
                                {{--<div class="tab-pane" id="tab4" disabled="disabled">--}}
                                <h3><b>My Services</b></h3>

                                <p class="text-danger"><strong>Be careful with role selection, if you give admin
                                        access.. they can access admin section</strong></p>
                                <div class="form-group required {{ $errors->first('role', 'has-error') }}">
                                    <label for="group" class="col-sm-2 control-label">Services</label>
                                    <div class="col-sm-10">
                                        {{--<select class="form-control required selectpicker" title="Select role..." name="role"--}}
                                        {{--id="role" multiple>--}}
                                        {{--<option value="">Select</option>--}}
                                        {{--@foreach($roles as $role)--}}
                                        {{--@if($role->id == 1)--}}
                                        {{--@continue;--}}
                                        {{--@else--}}
                                        {{--<option value="{{ $role->id }}" @if(in_array($role->id,$user->roles()->pluck('id')->toArray())) selected="selected" @endif >@if($role->name == 'user') Admin @else {{ $role->name}} @endif</option>--}}
                                        {{--@endif--}}
                                        {{--@endforeach--}}
                                        {{--</select>--}}
                                        <input type="checkbox" name="vendorType[]" id="customer" value="customer" @if($user->hasRole('customer')) checked @endif>
                                        <label for="customer">Customer - Regular customer user.</label><br>
                                        <input type="checkbox" name="vendorType[]" id="package" value="packagedeals" @if($user->hasRole('PackagesAdmin')) checked @endif>
                                        <label for="package">Package Deals - I am an agent/owner of travel agency.</label><br>
                                        <input type="checkbox" name="vendorType[]" id="hotel" value="hotels"@if($user->hasRole('HotelsAdmin')) checked @endif>
                                        <label for="hotel"> Hotels - I am an agent/owner of Hotel/Residence for rental.</label><br>
                                        <input type="checkbox" name="vendorType[]" id="transport" value="transport" @if($user->hasRole('TransportAdmin')) checked @endif>
                                        <label for="transport"> Transports - I am an agent/owner of Transportation </label><br>
                                        <input type="checkbox" name="vendorType[]" id="guestpass" value="guestspass" @if($user->hasRole('GuestsPassAdmin')) checked @endif>
                                        <label for="guestpass"> Shrine Programs - I arrange program and events at Holy Shrines in Iraq.</label><br>
                                        <input type="checkbox" name="vendorType[]" id="guide" value="guide" @if($user->hasRole('GuideAdmin')) checked @endif>
                                        <label for="guide"> Guide - I am a guide / I manage guides.</label><br>
                                        @if(Auth::user()->hasRole('SuperAdmin'))
                                            <input type="checkbox" name="vendorType[]" id="admin" value="admin" @if($user->hasRole('user')) checked @endif>
                                            <label for="admin"> Application Admin - This user is an application administrator</label><br>
                                        @endif
                                        <span class="help-block">{{ $errors->first('role', ':message') }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{--<label for="activate" class="col-sm-2 control-label"> Activate User *</label>--}}
                                    {{--<div class="col-sm-10">--}}
                                    {{--<input id="activate" name="activate" type="checkbox"--}}
                                    {{--class="pos-rel p-l-30 custom-checkbox"--}}
                                    {{--value="1" @if(old('activate')) checked="checked" @endif >--}}
                                    {{--<span>To activate user account automatically, click the check box</span></div>--}}

                                    {{--</div>--}}
                                </div>
                                {{--<ul class="pager wizard">--}}
                                {{--<li class="previous"><a href="#">Previous</a></li>--}}
                                {{--<li class="next"><a href="#">Next</a></li>--}}
                                {{--<li class="next finish" style="display:none;"><a href="javascript:;">Finish</a></li>--}}
                                {{--</ul>--}}
                                <div class="form-group text-right">
                                    <button class=" btn btn-warning" type="submit">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">Errors! Please fill form with proper details</div>
                    @endif

                </div>
            </div>
        </div>

        @include('layouts.partials.right-sidebar')
    </div>
@endsection

@push('js')
<script src="{{ asset('plugins/components/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
<script src="{{asset('plugins/components/icheck/icheck.min.js')}}"></script>
<script src="{{asset('plugins/components/icheck/icheck.init.js')}}"></script>
<script src="{{asset('plugins/components/moment/moment.js')}}"></script>
{{--<script src="{{asset('plugins/components/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>--}}
<script src="{{asset('plugins/components/jqueryui/jquery-ui.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"
        type="text/javascript"></script>
<script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
<script src="{{ asset('js/edituser.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>
    @if(\Session::has('message'))
$.toast({
        heading: 'Success!',
        position: 'top-center',
        text: '{{session()->get('message')}}',
        loaderBg: '#ff6849',
        icon: 'success',
        hideAfter: 3000,
        stack: 6
    });
    @endif
</script>
<script>
    $("#dob").datepicker({
        dateFormat: 'yy-m-d',
        SetDate:"{{$user->profile->dob}}",
        widgetPositioning:{
            vertical:'bottom'
        },
        keepOpen:false,
        useCurrent: false,
        maxDate: moment().add(1,'h').toDate()
    });
    $('.selectpicker').selectpicker();
</script>
<script>
    $( "#customer" ).click(function() {
        $('#package').prop('checked', false);
        $('#hotel').prop('checked', false);
        $('#transport').prop('checked', false);
        $('#guestpass').prop('checked', false);
        $('#guide').prop('checked', false);
        $('#admin').prop('checked', false);
    });
    $( "#admin" ).click(function() {
        $('#package').prop('checked', false);
        $('#hotel').prop('checked', false);
        $('#transport').prop('checked', false);
        $('#guestpass').prop('checked', false);
        $('#guide').prop('checked', false);
        $('#customer').prop('checked', false);
    });
    $( "#package").click(function() {
        $('#admin').prop('checked', false);
        $('#customer').prop('checked', false);
    });
    $( "#hotel" ).click(function() {
        $('#admin').prop('checked', false);
        $('#customer').prop('checked', false);
    });
    $( "#transport" ).click(function() {
        $('#admin').prop('checked', false);
        $('#customer').prop('checked', false);
    });
    $( "#guestpass" ).click(function() {
        $('#admin').prop('checked', false);
        $('#customer').prop('checked', false);
    });
    $( "#guide" ).click(function() {
        $('#admin').prop('checked', false);
        $('#customer').prop('checked', false);
    });
</script>
@endpush