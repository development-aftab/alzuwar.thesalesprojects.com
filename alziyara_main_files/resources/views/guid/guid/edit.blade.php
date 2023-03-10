{{--@extends('layouts.master')--}}
{{--@section('content')--}}
    {{--<div class="container-fluid">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-12">--}}
                {{--<div class="white-box">--}}
                    {{--<h3 class="box-title pull-left">Edit Guid #{{ $guid->GuidesID }}</h3>--}}
                    {{--@can('view-'.str_slug('Guid'))--}}
                        {{--<a class="btn btn-success pull-right" href="{{ url('/guid/guid') }}">--}}
                            {{--<i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>--}}
                    {{--@endcan--}}
                    {{--<div class="clearfix"></div>--}}
                    {{--<hr>--}}
                    {{--@if ($errors->any())--}}
                        {{--<ul class="alert alert-danger">--}}
                            {{--@foreach ($errors->all() as $error)--}}
                                {{--<li>{{ $error }}</li>--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}
                    {{--@endif--}}

                    {{--<form method="POST" action="{{ url('/guid/guid/' . $guid->GuidesID) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">--}}
                        {{--{{ method_field('PATCH') }}--}}
                        {{--{{ csrf_field() }}--}}

                        {{--@include ('guid.guid.form', ['submitButtonText' => 'Update'])--}}

                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}
{{--@extends('layouts.master')--}}
{{--@section('content')--}}
{{--<div class="container-fluid">--}}
{{--<div class="row">--}}
{{--<div class="col-md-12">--}}
{{--<div class="white-box">--}}
{{--<h3 class="box-title pull-left">Edit Transportation #{{ $transportation->id }}</h3>--}}
{{--@can('view-'.str_slug('Transportation'))--}}
{{--<a class="btn btn-success pull-right" href="{{ url('/transportation/transportation') }}">--}}
{{--<i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>--}}
{{--@endcan--}}
{{--<div class="clearfix"></div>--}}
{{--<hr>--}}
{{--@if ($errors->any())--}}
{{--<ul class="alert alert-danger">--}}
{{--@foreach ($errors->all() as $error)--}}
{{--<li>{{ $error }}</li>--}}
{{--@endforeach--}}
{{--</ul>--}}
{{--@endif--}}

{{--<form method="POST" action="{{ url('/transportation/transportation/' . $transportation->VehicleRouteID) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">--}}
{{--{{ method_field('PATCH') }}--}}
{{--{{ csrf_field() }}--}}

{{--@include ('transportation.transportation.form', ['submitButtonText' => 'Update'])--}}
{{--</form>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--@endsection--}}
@extends('layouts.master')
@push('css')
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
    <style>.add-photo{width:-webkit-fill-available;}
        .fa-input {
            font-family: FontAwesome, 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }
        label{
            color:#000;
        }
    </style>
@endpush
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
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
            <p class="alert alert-success" >{{session('message')}}</p>
        </div>
    @endif

    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Edit Guide</h3>
                    <hr>
                    <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
                    <form  class="form-horizontal" method="POST" action="{{route('update-guide')}}" enctype='multipart/form-data'  >
                        {{csrf_field()}}
                        <input class="form-control" name="GuidesID" type="hidden" id="GuidesID" value="{{ $guid->GuidesID}}">

                        <div class="form-group {{ $errors->has('GuidesName') ? 'has-error' : ''}}">
                            <label for="GuidesName" class="col-md-2 control-label">{{ 'Guides Name' }}</label>
                            <div class="col-md-10">
                                <input class="form-control" name="GuidesName" type="text" id="GuidesName" value="{{ $guid->GuidesName??''}}" required>
                                {!! $errors->first('GuidesName', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('GuidesDesc') ? 'has-error' : ''}}">
                            <label for="GuidesDesc" class="col-md-2 control-label">{{ 'Guides Description' }}</label>
                            <div class="col-md-10">
                                <textarea maxlength="1000" class="form-control" rows="5" name="GuidesDesc" type="textarea" id="GuidesDesc" >{{ $guid->GuidesDesc??''}}</textarea>
                                {!! $errors->first('GuidesDesc', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        {{--<div class="form-group {{ $errors->has('Admin_status') ? 'has-error' : ''}}">--}}
                        {{--<label for="Admin_status" class="col-md-4 control-label">{{ 'Admin Status' }}</label>--}}
                        {{--<div class="col-md-6">--}}
                        {{--<input class="form-control" name="Admin_status" type="number" id="Admin_status" value="{{ $guid->Admin_status??''}}" required>--}}
                        {{--{!! $errors->first('Admin_status', '<p class="help-block">:message</p>') !!}--}}
                        {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group {{ $errors->has('PricePerDay') ? 'has-error' : ''}}">
                            <label for="PricePerDay" class="col-md-2 control-label">{{ 'Price Per Day' }}</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-addon" title="Dollars">$</span>
                                    <input class="form-control" name="PricePerDay" type="number" id="PricePerDay" value="{{ $guid->PricePerDay??''}}" @if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('user')) readonly @endif>
                                    {!! $errors->first('PricePerDay', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('MaxOccupancy') ? 'has-error' : ''}}">
                            <label for="MaxOccupancy" class="col-md-2 control-label">{{ 'Maximum Occupancy' }}</label>
                            <div class="col-md-10">
                                <input class="form-control" name="MaxOccupancy" type="number" id="MaxOccupancy" value="{{ $guid->MaxOccupancy??''}}" >
                                {!! $errors->first('MaxOccupancy', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('GuidesLocation') ? 'has-error' : ''}}">
                            <label for="GuidesLocation" class="col-md-2 control-label">{{ 'Guides Based at City' }} @if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('user')) (<a href="{{'/guideCity/guide-city/'}}">Manage</a>) @endif </label>
                            <div class="col-md-10">
                                <select class="form-control" name="GuidesLocation" id="GuidesLocation" required>
                                    @foreach($cities as $city)
                                        <option value="{{$city->city_name??''}}" @if(isset($guid->GuidesLocation)) @if($city->city_name == $guid->GuidesLocation) selected @endif @endif>{{$city->city_name??''}}</option>
                                    @endforeach
                                </select>
                                {{--<input class="form-control" name="GuidesLocation" type="text" id="GuidesLocation" value="{{ $guid->GuidesLocation??''}}" >--}}
                                {!! $errors->first('GuidesLocation', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('GuidePhoneno') ? 'has-error' : ''}}">
                            <label for="GuidePhoneno" class="col-md-2 control-label">{{ 'Guide Phone no' }}</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <input class="form-control" name="GuidePhoneno" type="text" id="GuidePhoneno" value="{{ $guid->GuidePhoneno??''}}" >
                                    <!--<span class="input-group-addon" title="Days">Days</span>-->
                                    {!! $errors->first('GuidePhoneno', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>

						{{--<div class="form-group {{ $errors->has('guide_startdate') ? 'has-error' : ''}}">
                            <label for="guide_startdate" class="col-md-2 control-label">{{ 'Guide Start Date' }}</label>
                            <div class="col-md-10">
                                <input class="form-control" name="guide_startdate" type="date" id="guide_startdate" value="{{ $guid->guide_startdate??''}}" >
                                {!! $errors->first('guide_startdate', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('guide_enddate') ? 'has-error' : ''}}">
                            <label for="guide_enddate" class="col-md-2 control-label">{{ 'Guide End Date' }}</label>
                            <div class="col-md-10">
                                <input class="form-control" name="guide_enddate" type="date" id="guide_enddate" value="{{ $guid->guide_enddate??''}}" >
                                {!! $errors->first('guide_enddate', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('guide_deadlinedate') ? 'has-error' : ''}}">
                            <label for="guide_deadlinedate" class="col-md-2 control-label">{{ 'Guide Deadline Date' }}</label>
                            <div class="col-md-10">
                                <input class="form-control" name="guide_deadlinedate" type="date" id="guide_deadlinedate" value="{{ $guid->guide_deadlinedate??''}}" >
                                {!! $errors->first('guide_deadlinedate', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>--}}

                        <div class="form-group {{ $errors->has('HouseRules') ? 'has-error' : ''}}">
                            <label for="HouseRules" class="col-md-2 control-label">{{ 'Houserules (Rules,Meeting Location and Time)' }}</label>
                            <div class="col-md-10">
                                <textarea maxlength="1000" class="form-control" rows="5" name="HouseRules" type="textarea" id="HouseRules" >{{ $guid->HouseRules??''}}</textarea>
                                {!! $errors->first('HouseRules', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('Languages') ? 'has-error' : ''}}">
                            <label for="FeatureID" class="col-md-2 control-label">{{ 'Languages' }}</label>
                            <div class="col-md-10">
                                <div class="row">
                                    @foreach($languages as $language)
                                        <div class="col-md-4">
                                            <input type="checkbox" id="Languages" name="Languages[]" value="{{$language->language_name??''}}"
                                                   @if(isset($guid->Languages)) @if(in_array($language->language_name, preg_split ("/\,/", $guid->Languages))) checked @endif @endif
                                            >
                                            <label for="" title="{{ucfirst($language->language_name??'')}}"> {{ucfirst($language->language_name??'')}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                {!! $errors->first('Languages', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>




                        @if(Auth::user()->hasrole('SuperAdmin') || Auth::user()->hasrole('admin'))
                            <div class="form-group {{ $errors->has('Admin_status') ? 'has-error' : ''}}">

                                <label for="Status" class="col-md-2 control-label">{{ 'Status' }}</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="Admin_status" id="Admin_status" required>
                                        <option value="1" @if(isset($guid->Admin_status)) @if($guid->Admin_status == "1") selected @endif @endif>Active</option>
                                        <option value="0" @if(isset($guid->Admin_status)) @if($guid->Admin_status == "0") selected @endif @endif>Inactive</option>
                                    </select>
                                    <input class="form-control" name="GuidesStatus" type="hidden" id="GuidesStatus" value="{{ $guid->GuidesStatus??''}}" >
                                    {!! $errors->first('Status', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        @else
                        <div class="form-group {{ $errors->has('Status') ? 'has-error' : ''}}">
                            @if(isset($guid->Admin_status)) @if($guid->Admin_status == "0")
                            <p class="col-md-12 text-center text-danger">This guide is inactive by SuperAdmin, please contact our support.</p>
                            @endif @endif
                            <label for="GuidesStatus" class="col-md-2 control-label">{{ 'Status' }}</label>
                            <div class="col-md-10">
                                <select class="form-control" name="GuidesStatus" id="GuidesStatus" required>
                                    <option value="1" @if(isset($guid->GuidesStatus)) @if($guid->GuidesStatus == "1") selected @endif @endif>Active</option>
                                    <option value="0" @if(isset($guid->GuidesStatus)) @if($guid->GuidesStatus == "0") selected @endif @endif>Inactive</option>
                                </select>
                                <input class="form-control" name="Admin_status" type="hidden" id="Admin_status" value="{{ $guid->Admin_status??''}}" >
                                {{--<input class="form-control" name="Status" type="number" id="Status" value="{{ $guid->GuidesStatus??''}}" >--}}
                                {!! $errors->first('GuidesStatus', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                            {{--<div class="form-group {{ $errors->has('Status') ? 'has-error' : ''}}">--}}
                                {{--@if(isset($transportation->status_from_admin)) @if($transportation->status_from_admin == "0")--}}
                                    {{--<p class="col-md-12 text-center text-danger">This transport is inactive by SuperAdmin, please contact our support.</p>--}}
                                {{--@endif @endif--}}
                                {{--<label for="Status" class="col-md-2 control-label">{{ 'Status' }}</label>--}}
                                {{--<div class="col-md-10">--}}
                                    {{--<select class="form-control" name="Status" id="Status" required>--}}
                                        {{--<option value="1" @if(isset($transportation->Status)) @if($transportation->Status == "1") selected @endif @endif>Active</option>--}}
                                        {{--<option value="0" @if(isset($transportation->Status)) @if($transportation->Status == "0") selected @endif @endif>Inactive</option>--}}
                                    {{--</select>--}}
                                    {{--<input class="form-control" name="status_from_admin" type="hidden" id="status_from_admin" value="{{ $transportation->status_from_admin??''}}" >--}}
                                    {{--{!! $errors->first('Status', '<p class="help-block">:message</p>') !!}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        @endif
                        <div class="form-group">
                            <label for="Status" class="col-md-2 control-label">{{ 'Guide Images' }}</label>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <div class="payroll-table card">
                                        <div class="table-responsive">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="preempform">
                                                        <thead>
                                                        <tr>
                                                            <th  style="white-space: nowrap;">S.NO.</th>
                                                            <th  style="white-space: nowrap;">Photo Title</th>
                                                            <th  style="white-space: nowrap;">AltText</th>
                                                            <th  style="white-space: nowrap;">Photo</th>
                                                            <th  style="white-space: nowrap;">PhotoLocation</th>																								<th  style="white-space: nowrap;">Default Image</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        <tr>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($guid->getGuidePics as $key => $myphotos)
                                                            <?php $cnt=$myphotos->PhotoID; ?>
                                                            <tr id="myphotoremoverrow-{{$cnt}}">
                                                                <td>
                                                                    <input type='hidden' name="photoidupload[]" step='any' class='form-control required_colom' required='required' placeholder='' value="{{$cnt}}" readonly />

                                                                    <input type='number' name="photoid[]" step='any' class='form-control required_colom' required='required' placeholder='' value="{{$key}}" readonly />
                                                                </td>
                                                                <td>
                                                                    <input type='text' step='any' name='PhotoTitleupload[]' class='form-control required_colom' value="{{$myphotos->PhotoTitle}}" required='required'>
                                                                </td>
                                                                <td>
                                                                    <input type='text' step='any' name='AltTextupload[]' id="can_edu_year"   class='form-control required_colom' value="{{$myphotos->AltText}}"  placeholder="Alternate Text" required='required'>
                                                                </td>
                                                                <td>
                                                                    <img style="height:100px;width:100px;" src="{{asset('website').'/'.$myphotos->PhotoLocation}}">
                                                                </td>
                                                                <td>
                                                                    <input type='file'  step='any' name='PhotoLocationupload[]'  class='form-control required_colom address' >
                                                                </td>
                                                                <td>
                                                                    <input type='radio'  step='any' name='Showimage[]' value="{{$key}}" @if($myphotos->DefaultFlag == "1") checked="checked" @endif value='{{$key}}'  class='form-control required_colom address' >
                                                                </td>
                                                                <td>
                                                                    @if($key == 0)
                                                                        <div class="text-right" style="margin-bottom : 2%">
                                                                            <button type="button" onclick="addedudetails()" class="btn btn-primary add-photo">+ Add Photo</button>
                                                                            <br />
                                                                        </div>
                                                                    @else
                                                                        <button onclick="transportationImageRemove({{$cnt}})"  type='button' class='btn btn-danger removeimage' > - Remove Photo</button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <input class="btn btn-primary fa-input" type='submit' value="&#xf021; UPDATE">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ===== Right-Sidebar ===== -->
        @include('layouts.partials.right-sidebar')
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="{{asset('js/jasny-bootstrap.js')}}"></script>
    <script>
        $('#GuidesDesc,#HouseRules').summernote({
            minHeight: null,             // set minimum height of editor
            maxHeight: 200,
            tabsize: 2,
            height: 200,
            blockquoteBreakingLevel: 0,
            disableDragAndDrop: true,
            toolbar: [
                // [groupName, [list of button]]
                ['fontname', ['fontname']],
                ['style', ['bold', 'italic', 'underline']],
                ['fontsize', ['fontsize']],
                ['fontNames', ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['color', ['color']],
                ['view', ['fullscreen', 'codeview']]
            ],
            placeholder: 'Write here...',
            insertOrderedList:true,
        });
    </script>
    <script>
        function transportationImageRemove(id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Photo!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                if (willDelete) {
                    var rowid = "#myphotoremoverrow-"+id;
                    jQuery(rowid).remove();
                    $.get('{{ URL::to("guide-image-remove")}}/'+id,function(data){});
                    swal("Your Image status has been removed!", {
                        icon: "success",
                    });
                } else {
                    swal("Your Image status has not changed!");
        }
        });
        }
        function addedudetails() {
            if($('#preempform tr').length<7){
                var table = document.getElementById("preempform");
                var rowCount = $('#preempform tr').length;
                var row = table.insertRow(rowCount);
                // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                var hotelLocationId = "HotelLocation" + rowCount;
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                var cell6 = row.insertCell(5);
                var cell7 = row.insertCell(6);
                var jaja = 1;
                var pappu = rowCount;
                var jhama = pappu - jaja;
                var indexrowcount = jhama - jaja;
                // console.log(jhama) ;
                cell1.innerHTML = "<input type='number' step='any'  class='form-control required_colom' required='required' placeholder='' value=" + jhama + " readonly />";
                cell2.innerHTML = "<input type='text' step='any' name='PhotoTitle[]'    class='form-control required_colom' required='required' />";
                cell3.innerHTML = "<input type='text' step='any' name='AltText[]' id='can_edu_year'  class='form-control required_colom datepick' required='required' placeholder='Alternate Text' />";
                cell4.innerHTML = "";
                cell5.innerHTML = "<input type='file' step='any' name='PhotoLocation[]' accept='image/png, image/gif, image/jpeg' class='form-control required_colom address' required='required' />";
                cell6.innerHTML = "<input type='radio' step='any' name='Showimage[]' value=" + indexrowcount + " class='form-control required_colom address' required='required' />";
                $("#can_edu_year").each(function () {
                });
                if (jhama == 1) {
                    cell7.innerHTML = "<button  type='button' class='btn btn-danger'>- Remove Photo</button>";
                } else {
                    cell7.innerHTML = "<button  type='button' class='btn btn-danger remove'>- Remove Photo</button>";
                }
            }else {
                alert('You can not add more than 5 images');
            }
        }
        $('#preempform').on('click', '.remove', function(e){
            $(this).closest('tr').remove();
        })
        function addprogramdetails(){
            var table = document.getElementById("prodetail");
            var rowCount = $('#prodetail tr').length;
            var row = table.insertRow(rowCount);
            // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
            var hotelLocationId = "HotelLocation"+rowCount;
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var jaja = 1 ;
            var pappu =  rowCount;
            var jhama = pappu -  jaja ;
            // console.log(jhama) ;
            cell1.innerHTML = "<input type='number' step='any'  class='form-control required_colom' required='required' placeholder='' value="+ jhama +" readonly />";
            cell2.innerHTML = "<input type='time' step='any' name='programtime[]'    class='form-control required_colom' required='required' />";
            cell3.innerHTML = "<input type='text' step='any' name='programtimedes[]' id='can_edu_year'  class='form-control required_colom datepick' required='required' placeholder='Short Description' />";
            $("#can_edu_year").each(function() {
            });
            if(jhama == 1){
                cell4.innerHTML = "<button  type='button' class='btn btn-danger'>- Remove Photo</button>";
            }else{
                cell4.innerHTML = "<button  type='button' class='btn btn-danger remove'>- Remove Photo</button>";
            }
        }
        $('#prodetail').on('click', '.remove', function(e){
            $(this).closest('tr').remove();
        })
    </script>
@endpush