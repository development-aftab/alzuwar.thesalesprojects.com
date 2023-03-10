@extends('layouts.master')

@push('css')
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
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
                    <h3 class="box-title pull-left">Edit Hotel/Property</h3>
                    <div class="pull-right">
                        <a class="btn btn-success" href="@if(Auth::user()->hasRole('SuperAdmin')){{URL('allproperties')}}@else{{URL('myhotels')}}@endif">View All Hotels</a>
                        <a class="btn btn-success" href="{{URL('myrooms')}}/{{$data['property']->PropertyID??0}}">View All Rooms</a>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    {{--<br/>--}}
                    <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
                    <form  class="form-horizontal" method="POST" action="{{route('update-hotel')}}" enctype='multipart/form-data'  >

                        {{csrf_field()}}
                        <input type="hidden" name="PropertyID" class="form-control" placeholder="" value="{{$data['property']->PropertyID}}">
                        <div class="row">
                            <label class="col-md-2">Hotel/Property Name</label>
                            <div class="col-md-4">
                                <input type="text" name="HotelName" class="form-control" value="{{ $data['property']->Name??old('HotelName')??'' }}" placeholder="Hotel/Property Name">
                            </div>

                            <label class="col-md-2">Hotel/Property Type</label>
                            <div class="col-md-4">
                                <select class="form-control" name="propertytype">
                                    @foreach($data['propertytype'] as $mypropertytype)
                                        <option value="{{$mypropertytype->PropertyTypeID}}" @if($data['property']->PropertyTypeID == $mypropertytype->PropertyTypeID) selected @endif>{{$mypropertytype->PropertyTypeDesc}}</option>
                                    @endforeach

                                </select>
                            </div>

                        </div>
                        <br/>
                        <div class="form-group">


                            <label class="col-md-2" >Hotel/Property Country</label>

                            <div class="col-md-4">

                                <input type="text" name="HotelCountry" class="form-control" value="{{ $data['property']->Country??old('HotelCountry')??'' }}" placeholder="Hotel/Property Country">

                            </div>


                            <label class="col-md-2" >Hotel/Property City</label>

                            <div class="col-md-4">
                                <select class="form-control" name="HotelCity" required>
                                    @foreach($data['cities'] as $mycity)
                                        <option value="{{$mycity->GuestPassLocation}}" @if($data['property']->City == $mycity->GuestPassLocation) selected @endif>{{$mycity->GuestPassLocation}}</option>
                                    @endforeach

                                </select>
                            </div>

                        </div>

                        <div class="form-group">

                        <!--<label class="col-md-2">Hotel/Property Price</label>
                        <div class="col-md-4">
                            <input type="number" name="HotelPrice" class="form-control" value="{{ old('Price') }}" placeholder="Hotel/Property Price"> 
						</div>-->

                            {{--<label class="col-md-2">Hotel/Property Postal Code</label>--}}
                            {{--<div class="col-md-4">--}}
                                <input type="hidden" name="HotelPostalCode" class="form-control" value="{{ $data['property']->PostalCode??old('HotelPostalCode')??'' }}" placeholder="Hotel/Property Postal Code">
                            {{--</div>--}}

                        </div>

                        <div class="form-group">

                            <label class="col-md-2">Hotel/Property Providing Shuttle Service</label>
                            <div class="col-md-1">
                                <label>Yes</label>
                            </div>
                            <div class="col-md-1">
                                <input type="radio" name="HotelShuttleService" class="form-control" @if($data['property']->PropertyShuttle == 1) checked @endif value = "1" placeholder="Hotel/Property Price">
                            </div>
                            <div class="col-md-1">
                                <label>No</label>
                            </div>
                            <div class="col-md-1">
                                <input type="radio" name="HotelShuttleService" class="form-control" @if($data['property']->PropertyShuttle == 0) checked @endif value = "0"  placeholder="Hotel/Property Price">
                            </div>
                            <!--<select name="hotelDistancetype" >
                                <option value="">Select Option</option>
                                <option value=""></option>
                                <option value=""></option>
                            </select>-->


                            <label class="col-md-2">Distance Between Hotel/Property and Location </label>
                            <div class="col-md-4">
                                <input type="number" name="HotelDistance" class="form-control" value="{{ $data['property']->PropertyDistance??old('HotelDistance')??'' }}">Km
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Hotel/Property Address</label>
                            <div class="col-md-12">

                                <input type="type" name="HotelAddress" class="form-control" value="{{ $data['property']->Address??old('HotelAddress')??'' }}" placeholder="Hotel/Property Address"> </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Hotel/Property Description</label>
                            <div class="col-md-12">
                                <textarea maxlength="1000" class="form-control" name="HotelDesc"  rows="5">{{ $data['property']->Description??old('HotelDesc')??'' }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Hotel/Property HouseRules</label>
                            <div class="col-md-12">
                                <textarea maxlength="1000" class="form-control summerhousehours" name="HotelHouseRules" rows="5">{{ $data['property']->HouseRules??old('HotelHouseRules')??'' }}</textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-12">Hotel/Property General</label>
                            <div class="col-md-12">
                                <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenaryGeneral" rows="5">{{ $data['property']->getHotelFeaturesAndAmenities->generl??old('HotelItenaryGeneral')??'' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Hotel/Property Food and Drink</label>
                            <div class="col-md-12">
                                <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenaryfood_and_drink" rows="5">{{ $data['property']->getHotelFeaturesAndAmenities->food_and_drink??old('HotelItenaryfood_and_drink')??'' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Hotel/Property Front Desk Services</label>
                            <div class="col-md-12">
                                <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenaryfront_desk_services" rows="5">{{ $data['property']->getHotelFeaturesAndAmenities->front_desk_services??old('HotelItenaryfront_desk_services')??'' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Hotel/Property Entertainment and Family Services</label>
                            <div class="col-md-12">
                                <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenaryentertainment_and_family_services" rows="5">{{ $data['property']->getHotelFeaturesAndAmenities->entertainment_and_family_services??old('HotelItenaryentertainment_and_family_services')??'' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Hotel/Property Living Area</label>
                            <div class="col-md-12">
                                <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenaryliving_area" rows="5">{{ $data['property']->getHotelFeaturesAndAmenities->living_area??old('HotelItenaryliving_area')??'' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Hotel/Property Health Facility</label>
                            <div class="col-md-12">
                                <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenaryhealth_facility" rows="5">{{ $data['property']->getHotelFeaturesAndAmenities->health_facility??old('HotelItenaryhealth_facility')??'' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Hotel/Property Safety and Security</label>
                            <div class="col-md-12">
                                <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenarysafety_and_security" rows="5">{{  $data['property']->getHotelFeaturesAndAmenities->safety_and_security??old('HotelItenarysafety_and_security')??'' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Hotel/Property Bussiness Facility</label>
                            <div class="col-md-12">
                                <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenarybussiness_facility"  rows="5">{{ $data['property']->getHotelFeaturesAndAmenities->bussiness_facility??old('HotelItenarybussiness_facility')??'' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Hotel/Property Accessibility</label>
                            <div class="col-md-12">
                                <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenaryaccessibility"  rows="5">{{ $data['property']->getHotelFeaturesAndAmenities->accessibility??old('HotelItenaryaccessibility')??'' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Hotel/Property Languages Spoken</label>
                            <div class="col-md-12">
                                <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenarylanguages_spoken" rows="5">{{ $data['property']->getHotelFeaturesAndAmenities->languages_spoken??old('HotelItenarylanguages_spoken')??'' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Hotel/Property Cleaning Services</label>
                            <div class="col-md-12">
                                <textarea maxlength="1000" class="form-control summerhousehours " name="HotelItenarycleaning_service" rows="5">{{ $data['property']->getHotelFeaturesAndAmenities->cleaning_service??old('HotelItenarycleaning_service')??'' }}</textarea>
                            </div>
                        </div>

                    <!--<div class="form-group">
                        <label class="col-md-12">Hotel/Property Start Time</label>
                        <div class="col-md-12">
                            <input type="time" class="form-control" name="GuestPassstartTime" placeholder="GuestPass Time" value="{{ old('GuestPassstartTime') }}"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Hotel/Property End Time</label>
                        <div class="col-md-12">
                            <input type="time" class="form-control" name="GuestPassendTime" placeholder="GuestPass Time" value="{{ old('GuestPassendTime') }}"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12">File upload</label>
                        <div class="col-sm-12">
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                        <input type="file" name="[]"> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                        </div>
                    </div>-->
                        <div class="form-group">
                            <div class="payroll-table card">
                                <div class="table-responsive">

                                    {{--<div class="row">--}}
                                        {{--<div class="col-md-12">--}}
                                            {{--<div class="card mb-0">--}}
                                                {{--<div class="card-header">--}}
                                                    {{--<h4 class="card-title mb-0">PHOTO RECORD</h4>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="card-body">

                                        {{--<div class="text-right" style="margin-bottom : 2%">--}}
                                            {{--<button type="button" onclick="addedudetails()" class="btn btn-primary">+ Add Photo</button>--}}
                                            {{--<br />--}}
                                        {{--</div>--}}
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="preempform">
                                                <thead>
                                                <p>PHOTOS AND DETAILS OF PHOTOS</p>
                                                <tr>
                                                    <th  style="white-space: nowrap;">S.NO.</th>
                                                    <th  style="white-space: nowrap;">Photo Title</th>
                                                    <th  style="white-space: nowrap;">AltText</th>
                                                    <th  style="white-space: nowrap;">Photo</th>
                                                    <th  style="white-space: nowrap;">PhotoLocation</th>
                                                    <th  style="white-space: nowrap;">Default Image</th>
                                                    <th>Action</th>
                                                </tr>
                                                <tr>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data['property']->getHotelPics as $key => $myphotos)
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

                    <!--<div class="form-group">
                        <div class="payroll-table card">
                        <div class="table-responsive">
                            
                            <div class="row">
                            <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">PROGRAM DETAILS</h4>
                                </div>
                            </div>
                            </div>
                            </div>
                                <div class="card-body">
                                    
                                    <div class="text-right" style="margin-bottom : 2%">
                                        <button type="button" onclick="addprogramdetails()" class="btn btn-primary">+ Add Program Detail</button>
                                    <br />
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="prodetail">
                                            <thead>
                                            <p>PROGRAM DETAILS A/C TO THE TIME RANGE</p>
                                            <tr>
                                                <th  style="white-space: nowrap;">S.NO.</th>
                                                <th  style="white-space: nowrap;">Program Time</th>
                                                <th  style="white-space: nowrap;">Program Short Description</th>
                                                <th>Action</th>
                                            </tr>
                                            <tr>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php $cnt=1; ?>
                            <tr>
                            <td><input type='number' step='any' class='form-control required_colom' required='required' placeholder='' value="{{$cnt}}" readonly /></td>
                                                <td><input type='time' step='any' name='programtime[]'    class='form-control required_colom' required='required'></td>
                                                <td><input type='text' step='any' name='programtimedes[]' id="can_edu_year"   class='form-control required_colom'  placeholder="Short Description" required='required'></td>
                                                <td>
                                                @if($cnt != 1)
                        <button onclick="removeRow(1)"  type='button' class='btn btn-danger remove' >remove</button>
@endif
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>--->
                        <div class="form-group">
                            <input class="btn btn-primary" type='submit' value="Update">
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
        $('#summernote').summernote({
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
        $('.summerhousehours').summernote({
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
                    $.get('{{ URL::to("hotel-image-remove")}}/'+id,function(data){});
                    swal("Your Image has been removed!", {
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
    </script>
@endpush