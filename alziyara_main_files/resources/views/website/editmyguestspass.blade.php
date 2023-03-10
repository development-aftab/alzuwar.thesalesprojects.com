@extends('layouts.master')

@push('css')
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
<style>
    label{
        color: #000;
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
                <h3 class="box-title pull-left">Settings - Edit Shrine Programs</h3>
                <div class="pull-right">
                </div>
                <div class="clearfix"></div>
                <hr>
                <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
                <form  class="form-horizontal" method="POST" action="{{route('updateguestspass')}}" enctype='multipart/form-data'  >

                {{csrf_field()}}

                <input type="hidden" name="GuestPassid" class="form-control" placeholder="GuestPass Name" value="{{$data['guestPass']->GuestPassID}}">
                    <div class="form-group">
                        <label class="col-md-1"> Name</label>
                        <div class="col-md-11">
                            <input type="text" name="GuestPassName" class="form-control" placeholder="GuestPass Name" value="{{$data['guestPass']->GuestPassName}}">
						</div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-1"> Price</label>
                        <div class="col-md-3">
                            {{--<input type="number" name="Price" class="form-control" placeholder="GuestsPass Price" value="{{$data['guestPass']->Price}}" @if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('SuperAdmin')) readonly @endif>--}}
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                <input type="number" name="Price" class="form-control" placeholder="GuestsPass Price" value="{{number_format((float)$data['guestPass']->Price, 2, '.', '')}}" @if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('SuperAdmin')) readonly @endif>
                                <span class="input-group-addon">.00</span>
                            </div>
                        </div>
                        <label class="col-md-1"> Max Occupancy</label>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="MaxOccupancy" placeholder="GuestPass Max Occupancy" value="{{$data['guestPass']->MaxOccupancy}}">
                        </div>
                        <label class="col-md-1" > City @if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('user')) <a href="{{url('allcity')}}">manage cities </a>@endif</label>
                        <div class="col-md-3">
                            {{--<input type="text" name="GuestPassLocation" class="form-control" placeholder="GuestsPass Location" value="{{$data['guestPass']->GuestPassLocation}}">--}}
                            <select class="form-control" name="GuestPassLocation" required>
                                @foreach($data['cities'] as $mycity)
                                    <option value="{{$mycity->GuestPassLocation}}" @if($data['guestPass']->GuestPassLocation == $mycity->GuestPassLocation) selected @endif>{{$mycity->GuestPassLocation}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <h4 class="card-title mb-0">DESCRIPTION</h4>
                        {{--<label class="col-md-12"> Description</label>--}}
                        <div class="col-md-12">
                            <textarea class="form-control" name="GuestPassDesc" id="summernote" rows="5">{!!$data['guestPass']->GuestPassDesc!!}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <h4 class="card-title mb-0">HOUSE RULES</h4>
                        {{--<label class="col-md-12"> HouseRules</label>--}}
                        <div class="col-md-12">
                            <textarea class="form-control" name="HouseRules" id="summerhousehours" rows="5">{!!$data['guestPass']->HouseRules!!}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                    <?php   $days = explode(',',$data['guestPass']->ScheduleDays);
                            $time = explode(' to ',$data['guestPass']->GuestPassTime);
                            $starttime = date("H:i", strtotime($time[0])); $endtime = date("H:i", strtotime($time[1])); ?>
                        <h4 class="card-title mb-0">SCHEDULE</h4>
                        <label class="col-sm-12"> Schedule Days</label>
                        <div class="col-sm-12">                            
                            <select class="form-control selectpicker" multiple name="scheduledays[]" >
                                
                                    <option value=2 >Monday</option>
                                    <option value=3 >Tuesday</option>
                                    <option value=4 >Wednesday</option>
                                    <option value=5 >Thursday</option>
                                    <option value=6 >Friday</option>
                                    <option value=7 >Saturday</option>
                                    <option value=1 >Sunday</option>
                               
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                        <label> Start Time</label>
                            <input type="time" class="form-control" name="GuestPassstartTime" placeholder="GuestPass Time" value="{{$starttime}}">
                        </div>
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        <div class="col-md-6">
                        <label> End Time</label>
                            <input type="time" class="form-control" name="GuestPassendTime" placeholder="GuestPass Time" value="{{$endtime}}">
                        </div>
                    </div>
                    <!--<div class="form-group">
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
                            
                            <div class="row">
                            <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">PHOTO RECORD</h4>
                                </div>
                            </div>
                            </div>
                            </div>
                                <div class="card-body">
                                    
                                    <div class="text-right" style="margin-bottom : 2%">
                                        <button type="button" onclick="addedudetails()" class="btn btn-primary">+ Add Photo</button>
                                    <br />
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="preempform">
                                            <thead>
                                            <p>PHOTOS AND DETAILS OF PHOTOS</p>
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
                                                
                                                @foreach($data['guestPass']->getGuestPassDetails as $key => $myphotos)
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
                                                        @if($key != 0)
                                                        <button onclick="guestpassimageremove({{$cnt}})"  type='button' class='btn btn-danger removeimage' >remove</button>
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

                    <div class="form-group">
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
                                            @foreach($data['guestPass']->getGuestPassprogramDetails as $prokey => $myprogramdetails)
                                                <?php $cnt=$prokey+1; ?>
                                                <tr id="myprogramremoverrow-{{$myprogramdetails->GuestProDetail_id}}" >
                                                <td>
                                                    <input type='hidden' step='any' class='form-control required_colom' required='required' placeholder='' name="programidupload[]" value="{{$myprogramdetails->GuestProDetail_id}}" readonly />
                                                    <input type='number' step='any' class='form-control required_colom' required='required' placeholder='' value="{{$cnt}}" readonly />
                                                </td>
                                                <td>
                                                    <input type='time' step='any' name='programtimeupload[]' class='form-control required_colom' required='required' value="{{$myprogramdetails->GuestProDetailTime}}">
                                                </td>
                                                <td>
                                                    <input type='text' step='any' name='programtimedesupload[]' id="can_edu_year"   class='form-control required_colom'  placeholder="Short Description" required='required' value="{{$myprogramdetails->GuestProDetailDis}}">
                                                </td>
                                                <td>
                                                @if($cnt != 1)
                                                <button onclick="guestpassprogramdetailremove({{$myprogramdetails->GuestProDetail_id}})"  type='button' class='btn btn-danger removeprogram' >remove</button>
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
                    <div class="form-group">
                        <input class="btn btn-primary" type='submit' >
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
	   



       $('#summerhousehours').summernote({
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

    function guestpassprogramdetailremove(id){

        // console.log(id);

        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Program!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {


                    // console.log($('.removeimage').closest('tr'));
                    
                    var rowid = "#myprogramremoverrow-"+id;

                    console.log(rowid);

                    jQuery(rowid).remove();
                
                    

                    $.get('{{ URL::to("guestprogramdetailpassremove")}}/'+id,function(data){

                        // window.location.reload();

                    });


                    swal("Your Program status has been removed!", {
                        icon: "success",
                    });
                } else {
                    swal("Your Program status has not changed!");
                }
            });

    }


    function guestpassimageremove(id) {

        // console.log(id);

        // console.log(status);

        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Photo!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {


                    // console.log($('.removeimage').closest('tr'));
                    
                    var rowid = "#myphotoremoverrow-"+id;

                    // console.log(rowid);

                    jQuery(rowid).remove();
                
                    

                    $.get('{{ URL::to("guestphotopassremove")}}/'+id,function(data){

                        // window.location.reload();

                    });


                    swal("Your Image status has been removed!", {
                        icon: "success",
                    });
                } else {
                    swal("Your Image status has not changed!");
                }
            });

    }


        function addedudetails(){
                var table = document.getElementById("preempform");
                var rowCount = $('#preempform tr').length;
                var row = table.insertRow(rowCount);
                // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                var hotelLocationId = "HotelLocation"+rowCount;
                    
                    
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                var cell6 = row.insertCell(5);				
				var cell7 = row.insertCell(6);
                
                var jaja = 1 ;
                var pappu =  rowCount;
                    var jhama = pappu -  jaja ;
					
					var indexrowcount = jhama - jaja;
                        
                        // console.log(jhama) ;

                cell1.innerHTML = "<input type='number' step='any'  class='form-control required_colom' required='required' placeholder='' value="+ jhama +" readonly />";
                cell2.innerHTML = "<input type='text' step='any' name='PhotoTitle[]'    class='form-control required_colom' required='required' />";
                cell3.innerHTML = "<input type='text' step='any' name='AltText[]' id='can_edu_year'  class='form-control required_colom datepick' required='required' placeholder='Alternate Text' />";
                cell4.innerHTML = "";
                cell5.innerHTML = "<input type='file' step='any' name='PhotoLocation[]'   class='form-control required_colom address' required='required' />";
				cell6.innerHTML = "<input type='radio' step='any' name='Showimage[]' value="+ indexrowcount +" class='form-control required_colom address' required='required' />";
                
                    $("#can_edu_year").each(function() {
                    
            });
                if(jhama == 1){
                        cell7.innerHTML = "<button  type='button' class='btn btn-danger ' >remove</button>";
                }else{
                    cell7.innerHTML = "<button  type='button' class='btn btn-danger remove' >remove</button>";
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
                        cell4.innerHTML = "<button  type='button' class='btn btn-danger ' >remove</button>";
                }else{
                    cell4.innerHTML = "<button  type='button' class='btn btn-danger remove' >remove</button>";
                }

                }

                $('#prodetail').on('click', '.remove', function(e){
			   $(this).closest('tr').remove();
			})

            

            

            var myselectvalue = "[{{$data['guestPass']->ScheduleDays}}]";

             var selectmydata = jQuery.parseJSON( myselectvalue );

            // console.log(selectmydata);

            $('.selectpicker').selectpicker('val',selectmydata);

    </script>
@endpush