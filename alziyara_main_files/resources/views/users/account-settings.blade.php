@extends('layouts.master')

@push('css')
<link href="{{ asset('plugins/components/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
<link href="{{asset('plugins/components/icheck/skins/all.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet"/>
{{--<link href="{{asset('plugins/components/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">--}}
<link href="{{asset('plugins/components/jqueryui/jquery-ui.min.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css">
<!-- <link href="{{ asset('plugins/components/dashboard/css/customstyle.css') }}" rel="stylesheet" /> -->
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box sales_chart_border">
                    <h1 class="box-title pull-left"><b>My Account</b></h1>
                    <div class="clearfix"></div>
                    <form id="commentForm" action="{{url('account-settings')}}"
                          method="POST" enctype="multipart/form-data" class="form-horizontal">
                        <!-- CSRF Token -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <div id="rootwizard">
                            {{--<ul class="nav nav-tabs">--}}
                            {{--<li class="active"><a href="#tab1" data-toggle="tab">User Profile</a></li>--}}
                            {{--<li><a href="#tab2" data-toggle="tab">Bio</a></li>--}}
                            {{--<li><a href="#tab3" data-toggle="tab">Address</a></li>--}}
                            {{--</ul>--}}
                            {{--<div class="tab-content">--}}
                            {{--<div class="tab-pane active" id="tab1">--}}
                            <h2 class="hidden"> </h2>
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
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <h6><b>If you don't want to change password... please leave them empty</b></h6>
                                </div>
                            </div>
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

                            {{--<h2><b>Picture</b></h2>--}}
                            <h3><b>Picture</b></h3>
                            <div class="form-group {{ $errors->first('pic_file', 'has-error') }}">
                                <label for="pic" class="col-sm-2 control-label">Profile picture</label>
                                <div class="col-sm-10">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail"
                                             style="width: 200px; height: 200px;">
                                            @if($user->profile->pic != null)
                                                <img src="{{asset('website/ProfileImage').'/'.auth()->user()->profile->pic}}" alt="profile pic">
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
                            <h3><b>Contact Information</b></h3>
                            <div class="form-group {{ $errors->first('country', 'has-error') }}">
                                <label for="country" class="col-sm-2 control-label">Country</label>
                                <div class="col-sm-10">
                                    <input id="countries" name="country" type="text"
                                           class="form-control"
                                           value="{{$user->profile->country}}"/>
                                    <span class="help-block">{{ $errors->first('country', ':message') }}</span>

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
                            {{--<h2><b>Contact Information</b></h2>--}}
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
                            @if(!Auth::user()->hasRole('SuperAdmin') && !Auth::user()->hasRole('customer'))
                                <div class="form-group">
                                    <label for="postal" class="col-sm-2 control-label">My Services</label>
                                    <div class="col-sm-10">
                                        <input type="checkbox" name="vendorType[]" id="package" value="packagedeals" @if(Auth::user()->hasRole('PackagesAdmin')) checked @endif disabled>
                                        <label for="package">Package Deals - I am an agent/owner of travel agency.</label><br>
                                        <input type="checkbox" name="vendorType[]" id="hotel" value="hotels"@if(Auth::user()->hasRole('HotelsAdmin')) checked @endif disabled>
                                        <label for="hotel"> Hotels - I am an agent/owner of Hotel/Residence for rental.</label><br>
                                        <input type="checkbox" name="vendorType[]" id="transport" value="transport" @if(Auth::user()->hasRole('TransportAdmin')) checked @endif disabled>
                                        <label for="transport"> Transports - I am an agent/owner of Transportation </label><br>
                                        <input type="checkbox" name="vendorType[]" id="guestpass" value="guestspass" @if(Auth::user()->hasRole('GuestsPassAdmin')) checked @endif disabled>
                                        <label for="guestpass"> Shrine Programs - I arrange program and events at Holy Shrines in Iraq.</label><br>
                                        <input type="checkbox" name="vendorType[]" id="guide" value="guide" @if(Auth::user()->hasRole('GuideAdmin')) checked @endif disabled>
                                        <label for="guide"> Guide - I am a guide / I manage guides.</label><br>
                                        <span class="text-danger">Please contact ALZuwar team if you want to sign up for additional services.</span>
                                    </div>
                                </div>
                            @endif
                            {{--<p> {{Auth::user()->roles[0]->name}}</p>--}}
                            {{--</div>--}}

                            {{--<ul class="pager wizard">--}}
                            {{--<li class="previous"><a href="#">Previous</a></li>--}}
                            {{--<li class="next"><a href="#">Next</a></li>--}}
                            {{--<li class="next finish" style="display:none;"><a href="javascript:;">Finish</a></li>--}}
                            {{--</ul>--}}
                            <div class="form-group text-right">
                                <button class=" btn btn-warning" type="submit">Update</button>
                            </div>
                        </div>
                        {{--</div>--}}
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
</script>
@endpush