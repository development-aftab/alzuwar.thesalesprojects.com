@extends('layouts.master')

@push('css')
<link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
      type="text/css"/>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Search</h3>
                    @can('add-'.str_slug('Search'))
                    <a class="btn btn-success pull-right" href="{{ url('/search/search/create') }}"><i
                                class="icon-plus"></i> Add Search</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Receipt Num</th><th>Package Deals Id</th><th>Qty</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($search as $item)
                                <tr>
                                    <td>{{ $loop->iteration??$item->id }}</td>
                                    <td>{{ $item->receipt_num }}</td><td>{{ $item->package_deals_id }}</td><td>{{ $item->qty }}</td>
                                    <td>
                                        @can('view-'.str_slug('Search'))
                                        <a href="{{ url('/search/search/' . $item->id) }}"
                                           title="View Search">
                                            <button class="btn btn-info btn-sm">
                                                <i class="fa fa-eye" aria-hidden="true"></i> View
                                            </button>
                                        </a>
                                        @endcan

                                        @can('edit-'.str_slug('Search'))
                                        <a href="{{ url('/search/search/' . $item->id . '/edit') }}"
                                           title="Edit Search">
                                            <button class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                            </button>
                                        </a>
                                        @endcan

                                        @can('delete-'.str_slug('Search'))
                                        <form method="POST"
                                              action="{{ url('/search/search' . '/' . $item->id) }}"
                                              accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    title="Delete Search"
                                                    onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                            </button>
                                        </form>
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $search->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>

<script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
<!-- start - This is for export functionality only -->
<!-- end - This is for export functionality only -->
<script>
    $(document).ready(function () {

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
    })

    $(function () {
        $('#myTable').DataTable({
            'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': [-1] /* 1st one, start by the right */
            }]
        });

    });
</script>

@endpush




////BAckup form

@extends('layouts.master')

@push('css')
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
                    <h3 class="box-title m-b-0">Add Reservation </h3>
                    <br/>
                    <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
                    <form  class="form-horizontal" method="POST" action="{{route('createguestspass')}}" enctype='multipart/form-data'  >

                        {{csrf_field()}}
                        <div class="row">
                            <label class="col-md-2">GuestPass Name</label>
                            <div class="col-md-4">
                                <input type="text" name="GuestPassName" class="form-control" value="{{ old('GuestPassName') }}" placeholder="GuestPass Name"> </div>

                            <label class="col-md-2" >GuestsPass City</label>
                            <div class="col-md-4">
                                <input type="text" name="GuestPassLocation" class="form-control" value="{{ old('GuestPassLocation') }}" placeholder="GuestsPass Location">
                            </div>
                        </div>
                        <br/>
                        <div class="form-group">
                            <label class="col-md-2">GuestPass Price</label>
                            <div class="col-md-4">
                                <input type="number" name="Price" class="form-control" value="{{ old('Price') }}" placeholder="GuestsPass Price"> </div>

                            <label class="col-md-2">GuestPass Max Occupancy</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="MaxOccupancy" value="{{ old('MaxOccupancy') }}" placeholder="GuestPass Max Occupancy"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">GuestPass Description</label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="GuestPassDesc" id="summernote" rows="5">{{ old('GuestPassDesc') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">GuestPass HouseRules</label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="HouseRules" id="summerhousehours" rows="5">{{ old('HouseRules') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12">GuestPass ScheduleDays</label>
                            <div class="col-sm-12">
                                <select class="form-control selectpicker" multiple name="scheduledays[]">
                                    <option value=2>Monday</option>
                                    <option value=3>Tuesday</option>
                                    <option value=4>Wednesday</option>
                                    <option value=5>Thursday</option>
                                    <option value=6>Friday</option>
                                    <option value=7>Saturday</option>
                                    <option value=1>Sunday</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">GuestPass Start Time</label>
                            <div class="col-md-12">
                                <input type="time" class="form-control" name="GuestPassstartTime" placeholder="GuestPass Time" value="{{ old('GuestPassstartTime') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">GuestPass End Time</label>
                            <div class="col-md-12">
                                <input type="time" class="form-control" name="GuestPassendTime" placeholder="GuestPass Time" value="{{ old('GuestPassendTime') }}">
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
                                                    <th  style="white-space: nowrap;">PhotoLocation</th>
                                                    <th  style="white-space: nowrap;">Default Image</th>
                                                    <th>Action</th>
                                                </tr>
                                                <tr>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php $cnt=1; ?>
                                                <tr>
                                                    <td><input type='number' step='any' class='form-control required_colom' required='required' placeholder='' value="{{$cnt}}" readonly /></td>
                                                    <td><input type='text' step='any' name='PhotoTitle[]'    class='form-control required_colom' required='required'></td>
                                                    <td><input type='text' step='any' name='AltText[]' id="can_edu_year"   class='form-control required_colom'  placeholder="Alternate Text" required='required'></td>
                                                    <td><input type='file'  step='any' name='PhotoLocation[]'   class='form-control required_colom address' required='required'></td>


                                                    <td><input type='radio' value='0' checked="checked"  name='Showimage[]' class='form-control required_colom address' required='required'></td>
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

        var jaja = 1 ;
        var pappu =  rowCount;
        var jhama = pappu -  jaja ;

        var indexrowcount = jhama - jaja;

        console.log(indexrowcount) ;

        cell1.innerHTML = "<input type='number' step='any'  class='form-control required_colom' required='required' placeholder='' value="+ jhama +" readonly />";
        cell2.innerHTML = "<input type='text' step='any' name='PhotoTitle[]'    class='form-control required_colom' required='required' />";
        cell3.innerHTML = "<input type='text' step='any' name='AltText[]' id='can_edu_year'  class='form-control required_colom datepick' required='required' placeholder='Alternate Text' />";
        cell4.innerHTML = "<input type='file' step='any' name='PhotoLocation[]'   class='form-control required_colom address' required='required' />";
        cell5.innerHTML = "<input type='radio'  name='Showimage[]' value="+ indexrowcount +" class='form-control required_colom address' required='required'>"
        $("#can_edu_year").each(function() {

        });
        if(jhama == 1){
            cell6.innerHTML = "<button  type='button' class='btn btn-danger ' >remove</button>";
        }else{
            cell6.innerHTML = "<button  type='button' class='btn btn-danger remove' >remove</button>";
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
</script>
@endpush