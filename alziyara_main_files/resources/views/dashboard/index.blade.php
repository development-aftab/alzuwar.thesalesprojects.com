@extends('layouts.master')

@push('css')
    <style>
        .info-box .info-count {
            margin-top: 0px !important;
        }
    .canvasjs-chart-credit{
        display: none;
    }
    .order-chart-widget{
        height:500px;
    }
    .user-count-countries{
        height:500px;
    }
    </style>
<link href="{{asset('plugins/components/calendar/dist/fullcalendar.css')}}" rel="stylesheet" />
<link href="{{asset('plugins/components/morrisjs/morris.css')}}" rel="stylesheet"/>

<!-- <link href="{{ asset('plugins/components/dashboard/css/customstyle.css') }}" rel="stylesheet" /> -->
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />

@endpush
@section('content')
    @if(auth()->user()->hasRole('admin'))
        <div class="row m-0">
            <div class="col-md-3 col-sm-6 info-box">
                <div class="media">
                    <div class="media-left">
                        <span class="icoleaf bg-primary text-white"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span>
                    </div>
                    <div class="media-body">
                        <h3 class="info-count text-blue">154</h3>
                        <p class="info-text font-12">Bookings</p>
                        <span class="hr-line"></span>
                        <p class="info-ot font-15">Target<span class="label label-rounded label-success">300</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 info-box">
                <div class="media">
                    <div class="media-left">
                        <span class="icoleaf bg-primary text-white"><i class="mdi mdi-comment-text-outline"></i></span>
                    </div>
                    <div class="media-body">
                        <h3 class="info-count text-blue">68</h3>
                        <p class="info-text font-12">Complaints</p>
                        <span class="hr-line"></span>
                        <p class="info-ot font-15">Total Pending<span
                                    class="label label-rounded label-danger">154</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 info-box">
                <div class="media">
                    <div class="media-left">
                        <span class="icoleaf bg-primary text-white"><i class="mdi mdi-coin"></i></span>
                    </div>
                    <div class="media-body">
                        <h3 class="info-count text-blue">&#36;9475</h3>
                        <p class="info-text font-12">Earning</p>
                        <span class="hr-line"></span>
                        <p class="info-ot font-15">March : <span class="text-blue font-semibold">&#36;514578</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 info-box b-r-0">
                <div class="media">
                    <div class="media-left p-r-5">
                        <div id="earning" class="e" data-percent="60">
                            <div id="pending" class="p" data-percent="55"></div>
                            <div id="booking" class="b" data-percent="50"></div>
                        </div>
                    </div>
                    <div class="media-body">
                        <h2 class="text-blue font-22 m-t-0">Report</h2>
                        <ul class="p-0 m-b-20">
                            <li><i class="fa fa-circle m-r-5 text-primary"></i>60% Earnings</li>
                            <li><i class="fa fa-circle m-r-5 text-primary"></i>55% Pending</li>
                            <li><i class="fa fa-circle m-r-5 text-info"></i>50% Bookings</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="white-box stat-widget">
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <h4 class="box-title">Statistics</h4>
                            </div>
                            <div class="col-md-9 col-sm-9">
                                <select class="custom-select">
                                    <option selected value="0">Feb 04 - Mar 03</option>
                                    <option value="1">Mar 04 - Apr 03</option>
                                    <option value="2">Apr 04 - May 03</option>
                                    <option value="3">May 04 - Jun 03</option>
                                </select>
                                <ul class="list-inline">
                                    <li>
                                        <h6 class="font-15"><i class="fa fa-circle m-r-5 text-success"></i>New Sales
                                        </h6>
                                    </li>
                                    <li>
                                        <h6 class="font-15"><i class="fa fa-circle m-r-5 text-primary"></i>Existing
                                            Sales</h6>
                                    </li>
                                </ul>
                            </div>
                            <div class="stat chart-pos"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="white-box">
                        <h4 class="box-title">Task Progress</h4>
                        <div class="task-widget t-a-c">
                            <div class="task-chart" id="sparklinedashdb"></div>
                            <div class="task-content font-16 t-a-c">
                                <div class="col-sm-6 b-r">
                                    Urgent Tasks
                                    <h1 class="text-primary">05 <span class="font-16 text-muted">Tasks</span></h1>
                                </div>
                                <div class="col-sm-6">
                                    Normal Tasks
                                    <h1 class="text-primary">03 <span class="font-16 text-muted">Tasks</span></h1>
                                </div>
                            </div>
                            <div class="task-assign font-16">
                                Assigned To
                                <ul class="list-inline">
                                    <li class="p-l-0">
                                        <img src="{{asset('plugins/images/users/1.png')}}" alt="user"
                                             data-toggle="tooltip"
                                             data-placement="top" title="" data-original-title="Steave">
                                    </li>
                                    <li>
                                        <img src="{{asset('plugins/images/users/2.png')}}" alt="user"
                                             data-toggle="tooltip"
                                             data-placement="top" title="" data-original-title="Steave">
                                    </li>
                                    <li>
                                        <img src="{{asset('plugins/images/users/3.png')}}" alt="user"
                                             data-toggle="tooltip"
                                             data-placement="top" title="" data-original-title="Steave">
                                    </li>
                                    <li class="p-r-0">
                                        <a href="javascript:void(0);" class="btn btn-success font-16">3+</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="white-box bg-primary color-box">
                        <h1 class="text-white font-light">&#36;6547 <span class="font-14">Revenue</span></h1>
                        <div class="ct-revenue chart-pos"></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="white-box bg-success color-box">
                        <h1 class="text-white font-light m-b-0">5247</h1>
                        <span class="hr-line"></span>
                        <p class="cb-text">current visits</p>
                        <h6 class="text-white font-semibold">+25% <span class="font-light">Last Week</span></h6>
                        <div class="chart">
                            <div class="ct-visit chart-pos"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="white-box bg-danger color-box">
                        <h1 class="text-white font-light m-b-0">25%</h1>
                        <span class="hr-line"></span>
                        <p class="cb-text">Finished Tasks</p>
                        <h6 class="text-white font-semibold">+15% <span class="font-light">Last Week</span></h6>
                        <div class="chart">
                            <input class="knob" data-min="0" data-max="100" data-bgColor="#f86b4a"
                                   data-fgColor="#ffffff" data-displayInput=false data-width="96" data-height="96"
                                   data-thickness=".1" value="25" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box user-table">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="box-title">Table Format/User Data</h4>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-inline">
                                    <li>
                                        <a href="javascript:void(0);" class="btn btn-default btn-outline font-16"><i
                                                    class="fa fa-trash" aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="btn btn-default btn-outline font-16"><i
                                                    class="fa fa-commenting" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                                <select class="custom-select">
                                    <option selected>Sort by</option>
                                    <option value="1">Name</option>
                                    <option value="2">Location</option>
                                    <option value="3">Type</option>
                                    <option value="4">Role</option>
                                    <option value="5">Action</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="checkbox checkbox-info">
                                            <input id="c1" type="checkbox">
                                            <label for="c1"></label>
                                        </div>
                                    </th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Type</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="checkbox checkbox-info">
                                            <input id="c2" type="checkbox">
                                            <label for="c2"></label>
                                        </div>
                                    </td>
                                    <td><a href="javascript:void(0);" class="text-link">Daniel Kristeen</a></td>
                                    <td>Texas, US</td>
                                    <td>Posts 564</td>
                                    <td><span class="label label-success">Admin</span></td>
                                    <td>
                                        <select class="custom-select">
                                            <option value="1">Modulator</option>
                                            <option value="2">Admin</option>
                                            <option value="3">Staff</option>
                                            <option value="4">User</option>
                                            <option value="5">General</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox checkbox-info">
                                            <input id="c3" type="checkbox">
                                            <label for="c3"></label>
                                        </div>
                                    </td>
                                    <td><a href="javascript:void(0);" class="text-link">Hanna Gover</a></td>
                                    <td>Los Angeles, US</td>
                                    <td>Posts 451</td>
                                    <td><span class="label label-info">Staff</span></td>
                                    <td>
                                        <select class="custom-select">
                                            <option value="1">Modulator</option>
                                            <option value="2">Admin</option>
                                            <option value="3">Staff</option>
                                            <option value="4">User</option>
                                            <option value="5">General</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox checkbox-info">
                                            <input id="c4" type="checkbox">
                                            <label for="c4"></label>
                                        </div>
                                    </td>
                                    <td><a href="javascript:void(0);" class="text-link">Jeffery Brown</a></td>
                                    <td>Houston, US</td>
                                    <td>Posts 978</td>
                                    <td><span class="label label-danger">User</span></td>
                                    <td>
                                        <select class="custom-select">
                                            <option value="1">Modulator</option>
                                            <option value="2">Admin</option>
                                            <option value="3">Staff</option>
                                            <option value="4">User</option>
                                            <option value="5">General</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox checkbox-info">
                                            <input id="c5" type="checkbox">
                                            <label for="c5"></label>
                                        </div>
                                    </td>
                                    <td><a href="javascript:void(0);" class="text-link">Elliot Dugteren</a></td>
                                    <td>San Antonio, US</td>
                                    <td>Posts 34</td>
                                    <td><span class="label label-warning">General</span></td>
                                    <td>
                                        <select class="custom-select">
                                            <option value="1">Modulator</option>
                                            <option value="2">Admin</option>
                                            <option value="3">Staff</option>
                                            <option value="4">User</option>
                                            <option value="5">General</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox checkbox-info">
                                            <input id="c6" type="checkbox">
                                            <label for="c6"></label>
                                        </div>
                                    </td>
                                    <td><a href="javascript:void(0);" class="text-link">Sergio Milardovich</a></td>
                                    <td>Jacksonville, US</td>
                                    <td>Posts 31</td>
                                    <td><span class="label label-primary">Partial</span></td>
                                    <td>
                                        <select class="custom-select">
                                            <option value="1">Modulator</option>
                                            <option value="2">Admin</option>
                                            <option value="3">Staff</option>
                                            <option value="4">User</option>
                                            <option value="5">General</option>
                                        </select>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <ul class="pagination">
                            <li class="disabled"><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                        </ul>
                        <a href="javascript:void(0);" class="btn btn-success pull-right m-t-10 font-20">+</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="white-box">
                        <div class="task-widget2">
                            <div class="task-image">
                                <img src="{{asset('plugins/images/task.jpg')}}" alt="task" class="img-responsive">
                                <div class="task-image-overlay"></div>
                                <div class="task-detail">
                                    <h2 class="font-light text-white m-b-0">07 April</h2>
                                    <h4 class="font-normal text-white m-t-5">Your tasks for today</h4>
                                </div>
                                <div class="task-add-btn">
                                    <a href="javascript:void(0);" class="btn btn-success">+</a>
                                </div>
                            </div>
                            <div class="task-total">
                                <p class="font-16 m-b-0"><strong>5</strong> Tasks for <a href="javascript:void(0);"
                                                                                         class="text-link">Jon Doe</a>
                                </p>
                            </div>
                            <div class="task-list">
                                <ul class="list-group">
                                    <li class="list-group-item bl-info">
                                        <div class="checkbox checkbox-success">
                                            <input id="c7" type="checkbox">
                                            <label for="c7">
                                                <span class="font-16">Create invoice for customers and email each customers.</span>
                                            </label>
                                            <h6 class="p-l-30 font-bold">05:00 PM</h6>
                                        </div>
                                    </li>
                                    <li class="list-group-item bl-warning">
                                        <div class="checkbox checkbox-success">
                                            <input id="c8" type="checkbox" checked>
                                            <label for="c8">
                                                <span class="font-16">Send payment of <strong>&#36;500 invoised</strong> on 23 May to <a
                                                            href="javascript:void(0);"
                                                            class="text-link">Daniel Kristeen</a> via paypal.</span>
                                            </label>
                                            <h6 class="p-l-30 font-bold">03:00 PM</h6>
                                        </div>
                                    </li>
                                    <li class="list-group-item bl-danger">
                                        <div class="checkbox checkbox-success">
                                            <input id="c9" type="checkbox">
                                            <label for="c9">
                                                <span class="font-16">It is a long established fact that a reader will be distracted by the readable.</span>
                                            </label>
                                            <h6 class="p-l-30 font-bold">04:45 PM</h6>
                                        </div>
                                    </li>
                                    <li class="list-group-item bl-success">
                                        <div class="checkbox checkbox-success">
                                            <input id="c10" type="checkbox">
                                            <label for="c10">
                                                <span class="font-16">It is a long established fact that a reader will be distracted by the readable.</span>
                                            </label>
                                            <h6 class="p-l-30 font-bold">05:30 PM</h6>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="task-loadmore">
                                <a href="javascript:void(0);" class="btn btn-default btn-outline btn-rounded">Load
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="white-box chat-widget">
                        <a href="javascript:void(0);" class="pull-right"><i class="icon-settings"></i></a>
                        <h4 class="box-title">Chat</h4>
                        <ul class="chat-list slimscroll" style="overflow: hidden;" tabindex="5005">
                            <li>
                                <div class="chat-image"><img alt="male"
                                                             src="{{asset('plugins/images/users/hanna.jpg')}}"></div>
                                <div class="chat-body">
                                    <div class="chat-text">
                                        <p><span class="font-semibold">Hanna Gover</span> Hey Daniel, This is just a
                                            sample chat. </p>
                                    </div>
                                    <span>2 Min ago</span>
                                </div>
                            </li>
                            <li class="odd">
                                <div class="chat-body">
                                    <div class="chat-text">
                                        <p> buddy </p>
                                    </div>
                                    <span>2 Min ago</span>
                                </div>
                            </li>
                            <li>
                                <div class="chat-image"><img alt="male"
                                                             src="{{asset('plugins/images/users/hanna.jpg')}}"></div>
                                <div class="chat-body">
                                    <div class="chat-text">
                                        <p><span class="font-semibold">Hanna Gover</span> Bye now. </p>
                                    </div>
                                    <span>1 Min ago</span>
                                </div>
                            </li>
                            <li class="odd">
                                <div class="chat-body">
                                    <div class="chat-text">
                                        <p> We have been busy all the day to make your website proposal and finally came
                                            with the super excited offer. </p>
                                    </div>
                                    <span>5 Sec ago</span>
                                </div>
                            </li>
                        </ul>
                        <div class="chat-send">
                            <input type="text" class="form-control" placeholder="Write your message">
                            <i class="fa fa-camera"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ===== Right-Sidebar ===== -->
        {{--@include('layouts.partials.right-sidebar')--}}
        <!-- ===== Right-Sidebar-End ===== -->
        </div>
    @else
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12">
                <div class="white-box sales_chart_border">
                    <div id="chartContainer" style="height: 500px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                </div>
            </div>
        </div>
        @if(Auth::user()->hasRole('SuperAdmin'))
            <div class="row">
                <div class="col-md-12 col-lg-6 col-sm-12">
                    <div class="white-box order-chart-widget sales_chart_border">
                        <h4 class="box-title">ACCOUNTS BY ROLES</h4>
                        <div id="order-status-chart3" style="height: 250px;"></div>
                        <ul class="list-inline m-b-0 m-t-20 t-a-c">
                            <li>
                                <h6 class="font-15"><i class="fa fa-circle m-r-5 text-primary"></i>Packages</h6>
                            </li>
                            <li>
                                <h6 class="font-15"><i class="fa fa-circle m-r-5 text-danger"></i>Hotels/Property</h6>
                            </li>
                            <li>
                                <h6 class="font-15"><i class="fa fa-circle m-r-5 text-success" style="color: yellow !important;"></i>Transport</h6>
                            </li>
                            <li>
                                <h6 class="font-15"><i class="fa fa-circle m-r-5 text-primary" style="color: #28C83F !important;" ></i>Guestpass</h6>
                            </li>
                            <li>
                                <h6 class="font-15"><i class="fa fa-circle m-r-5 text-danger" style="color: #4AFF33 !important;"></i>Guide</h6>
                            </li>
                            <li>
                                <h6 class="font-15"><i class="fa fa-circle m-r-5 text-success" style="color: #FF33E0 !important;"></i>Customer</h6>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xs-12">
                    <div class="white-box user-count-countries sales_chart_border">
                        <h3 class="box-title">ACCOUNTS BY COUNTRIES</h3>
                        <div id="morris-donut-chart"></div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12 col-lg-6 col-xs-12">
                <div class="white-box sales_chart_border">
                    <h3 class="box-title">Total Sales</h3>
                    <div id="top_service_provider"></div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xs-12">
                <div class="white-box sales_chart_border">
                    <h3 class="box-title">Total Orders</h3>
                    <div id="Product_Order"></div>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('js')
<!--Morris JavaScript -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
{{--<script src="{{asset('js/db4.js')}}"></script>--}}
{{--<script src="{{asset('js/db2.js')}}"></script>--}}
<script src="{{asset('js/db1.js')}}"></script>
<script src="{{asset('plugins/components/calendar/jquery-ui.min.js')}}"></script>
<script src="{{asset('plugins/components/moment/moment.js')}}"></script>
<script src="{{asset('plugins/components/calendar/dist/fullcalendar.min.js')}}"></script>
<script src="{{asset('plugins/components/calendar/dist/jquery.fullcalendar.js')}}"></script>
<script src="{{asset('plugins/components/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('plugins/components/sparkline/jquery.charts-sparkline.js')}}"></script>
<script src="{{asset('plugins/components/raphael/raphael-min.js')}}"></script>
<script src="{{asset('plugins/components/morrisjs/morris.js')}}"></script>
{{--<script src="{{asset('js/morris-data.js')}}"></script>--}}
<script type="text/javascript">
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [
                @foreach($country_users_count as $item)
            {
                label: "{{$item->country??''}}",
                value: {{$item->total??''}},

            },
            {{--{--}}
            {{--label: "IRAN",--}}
            {{--value: {{$packages??''}}--}}
            {{--}, {--}}
            {{--label: "SAUDI ARABIA",--}}
            {{--value: {{$hotels??''}}--}}
            {{--}--}}
            @endforeach
        ],
        resize: true,
        colors: ['#FF33E0 ','#0283cc','#e74a25','#ffff66','#28C83F ','#4AFF33 ','#ccffff','#ccffcc','#ccff99','#ccff66','#ccff33','#ccff00','#99ffff','#99ffcc','#99ff99','#99ff66','#99ff33','#99ff00','#66ffff','#66ffcc','#66ff99','#66ff66','#66ff33','#66ff00','#33ffff','#33ffcc','#33ff99','#33ff66','#33ff33','#33ff00','#00ffff','#00ffcc','#00ff99','#00ff66','#00ff33','#00ff00','#00ccff','#00cccc','#00cc99','#00cc66','#00cc33','#00cc00','#33ccff','#33cccc','#33cc99','#33cc66','#33cc33','#33cc00','#66ccff','#66cccc','#66cc99','#66cc66','#66cc33','#66cc00','#99ccff','#99cccc','#99cc99','#99cc66','#99cc33','#99cc00','#ccccff','#cccccc','#cccc99','#cccc66','#cccc33','#cccc00','#ffccff','#ffcccc','#ffcc99','#ffcc66','#ffcc33','#ffcc00','#ff99ff','#ff99cc','#ff9999','#ff9966','#ff9933','#ff9900','#cc99ff','#cc99cc','#cc9999','#cc9966','#cc9933','#cc9900','#9999ff','#9999cc','#999999','#999966','#999933','#999900','#6699ff','#6699cc','#669999','#669966','#669933','#669900','#3399ff','#3399cc','#339999','#339966','#339933','#339900','#0099ff','#0099cc','#009999','#009966','#009933','#009900','#0066ff','#0066cc','#006699','#006666','#006633','#006600','#3366ff','#3366cc','#336699','#336666','#336633','#336600','#6666ff','#6666cc','#666699','#666666','#666633','#666600','#9966ff','#9966cc','#996699','#996666','#996633','#996600','#cc66ff','#cc66cc','#cc6699','#cc6666','#cc6633','#cc6600','#cc33ff','#cc33cc','#cc3399','#cc3366','#cc3333','#cc3300','#ff66ff','#ff66cc','#ff6699','#ff6666','#ff6633','#ff6600','#ff33ff','#ff33cc','#ff3399','#ff3366','#ff3333','#ff3300','#ff00ff','#ff00cc','#ff0099','#ff0066','#ff0033','#ff0000','#cc00ff','#cc00cc','#cc0099','#cc0066','#cc0033','#cc0000','#9900ff','#9900cc','#990099','#990066','#990033','#990000','#9933ff','#9933cc','#993399','#993366','#993333','#993300','#6633ff','#6633cc','#663399','#663366','#663333','#663300','#6600ff','#6600cc','#660099','#660066','#660033','#660000','#3300ff','#3300cc','#330099','#330066','#330033','#330000','#3333ff','#3333cc','#333399','#333366','#333333','#333300','#0033ff','#0033cc','#003399','#003366','#003333','#003300','#0000ff','#0000cc','#000099','#000066','#000033','#000000']
    });
</script>

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(totalSales);
    function totalSales() {

        var options = {
            chart: {
                title: '',
//                            subtitle: 'Top Sales Order',
            },
            bars: 'horizontal', // Required for Material Bar Charts.
            hAxis: {
                format: '$#,###'
            },
            height: 500,
            //
            colors: ['#25a3ea', '#d95f02', '#7570b3']
        };
        var data = google.visualization.arrayToDataTable([
            ['Products', 'Sales'],
//                        ['', ''],
            @if(Auth::user()->hasRole('SuperAdmin'))
            ['Hotels/Properties', {{$hotelsSales??''}} ],
            ['PackegesDeals', {{$packagesSales??''}}],
            ['ShrinePrograms', {{$guestpassSales??''}}],
            ['Guides', {{$guideSales??''}}],
            ['Transportations', {{$transportSales??''}}]
            @else
                @if(Auth::user()->hasRole('HotelsAdmin'))
                    ['Hotels/Properties', {{$hotelsSales??''}} ],
                @endif
                @if(Auth::user()->hasRole('PackagesAdmin'))
                    ['PackegesDeals', {{$packagesSales??''}}],
                @endif
                @if(Auth::user()->hasRole('GuestsPassAdmin'))
                    ['ShrinePrograms', {{$guestpassSales??''}}],
                @endif
                @if(Auth::user()->hasRole('GuideAdmin'))
                    ['Guides', {{$guideSales??''}}],
                @endif
                @if(Auth::user()->hasRole('TransportAdmin'))
                    ['Transportations', {{$transportSales??''}}]
                @endif
            @endif
        ]);
        var chart = new google.charts.Bar(document.getElementById('top_service_provider'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
        var btns = document.getElementById('btn-group');
        btns.onclick = function(e) {
            if (e.target.tagName === 'BUTTON') {
                options.hAxis.format = e.target.id === 'none' ? '' : e.target.id;
                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        }
    }
    google.charts.setOnLoadCallback(totalOrders);
    function totalOrders() {
        var data = google.visualization.arrayToDataTable([
            ['Products', 'Orders'],
//                        ['', ''],
            @if(Auth::user()->hasRole('SuperAdmin'))
            ['Hotels/Properties', {{$hotelsCounts??''}}],
            ['PackegesDeals', {{$packagesCounts??''}}],
            ['ShrinePrograms', {{$guestpassCounts??""}}],
            ['Guides', {{$guideCounts??''}}],
            ['Transportations', {{$transportCounts??''}}]
            @else
                @if(Auth::user()->hasRole('HotelsAdmin'))
                    ['Hotels/Properties', {{$hotelsCounts??''}}],
                @endif
                @if(Auth::user()->hasRole('PackagesAdmin'))
                    ['PackegesDeals', {{$packagesCounts??''}}],
                @endif
                @if(Auth::user()->hasRole('GuestsPassAdmin'))
                    ['ShrinePrograms', {{$guestpassCounts??""}}],
                @endif
                @if(Auth::user()->hasRole('GuideAdmin'))
                    ['Guides', {{$guideCounts??''}}],
                @endif
                @if(Auth::user()->hasRole('TransportAdmin'))
                    ['Transportations', {{$transportCounts??''}}]
                @endif

            @endif
        ]);
        var options = {
            chart: {
                title: '',
//                            subtitle: 'Top Sales Order',
            },
            bars: 'horizontal', // Required for Material Bar Charts.
            hAxis: {
                format: 'decimal'
            },
            height: 500,
            colors: ['#1b9e77', '#d95f02', '#7570b3']
        };
        var chart = new google.charts.Bar(document.getElementById('Product_Order'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
        var btns = document.getElementById('btn-group');
        btns.onclick = function(e) {
            if (e.target.tagName === 'BUTTON') {
                options.hAxis.format = e.target.id === 'none' ? '' : e.target.id;
                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        }
    }
</script>
<script>
    @if(Auth::user()->hasRole('SuperAdmin'))
Morris.Donut({
        element: 'order-status-chart3',
        data: [{
            label: "Packages",
            value: {{$packages??''}}
        }, {
            label: "Hotel/Property",
            value: {{$hotels??''}}
        }, {
            label: "Guestpass",
            value: {{$guestpass??''}}
        },{
            label: "Guide",
            value: {{$guides??''}}

        }, {
            label: "Customer",
            value: {{$customers??''}}
        }, {
            label: "Transport",
            value: {{$transports??''}}
        }],
        resize: true,
        colors: ['#0283cc', '#e74a25', '#2ecc71','#4AFF33','#FF33E0','#FFFB33']
    });
    @endif
</script>
<script>
    @if(Auth::user()->hasRole('SuperAdmin'))
        window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            title: {
                text: "Sales Chart"
            },
            axisX: {
                valueFormatString: "MMM YYYY"
            },
            axisY: {
                title: "Price",
                prefix: "$",
                suffix: ""
            },
            toolTip: {
                shared: true
            },
            legend: {
                cursor: "pointer",
                verticalAlign: "top",
                horizontalAlign: "center",
                dockInsidePlotArea: true,
                itemclick: toogleDataSeries
            },
            data: [{
                type:"line",
                axisYType: "secondary",
                name: "Packages",
                showInLegend: true,
                markerSize: 0,
                yValueFormatString: "$#,###",
                dataPoints: [
                    { x: new Date(2021, 01, 01), y: 0 },
                        @foreach($mothly_sales_data['packages_monthly_sales'] as $data)
                    { x: new Date({{$data->new_date}}), y: {{$data->total}} },
                    @endforeach
                ]
            },
                {
                    type: "line",
                    axisYType: "secondary",
                    name: "Hotels",
                    showInLegend: true,
                    markerSize: 0,
                    yValueFormatString: "$#,###",
                    dataPoints: [
                        {
                            x: new Date(2021, 01, 01), y: 0 },
                            @foreach($mothly_sales_data['hotel_monthly_sales'] as $data)
                                { x: new Date({{$data->new_date}}), y: {{$data->total}} },
                            @endforeach
                    ]
                },
                {
                    type: "line",
                    axisYType: "secondary",
                    name: "Transport",
                    showInLegend: true,
                    markerSize: 0,
                    yValueFormatString: "$#,###",
                    dataPoints: [
                        { x: new Date(2021, 01, 01), y: 0 },
                            @foreach($mothly_sales_data['transport_monthly_sales'] as $data)
                        { x: new Date({{$data->new_date}}), y: {{$data->total}} },
                        @endforeach
                    ]
                },
                {
                    type: "line",
                    axisYType: "secondary",
                    name: "Shrine Programs",
                    showInLegend: true,
                    markerSize: 0,
                    yValueFormatString: "$#,###",
                    dataPoints: [
                        { x: new Date(2021, 01, 01), y: 0 },
                            @foreach($mothly_sales_data['shrines_monthly_sales'] as $data)
                        { x: new Date({{$data->new_date}}), y: {{$data->total}} },
                        @endforeach
                    ]
                },
                {
                    type: "line",
                    axisYType: "secondary",
                    name: "Guide",
                    showInLegend: true,
                    markerSize: 0,
                    yValueFormatString: "$#,###",
                    dataPoints: [
                        { x: new Date(2021, 01, 01), y: 0 },
                            @foreach($mothly_sales_data['guide_monthly_sales'] as $data)
                        { x: new Date({{$data->new_date}}), y: {{$data->total}} },
                        @endforeach
                    ]
                }]
        });
        chart.render();

        function toogleDataSeries(e){
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else{
                e.dataSeries.visible = true;
            }
            chart.render();
        }

    }
    {{--@endif--}}
    @else
        window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            title: {
                text: "Sales Chart"
            },
            axisX: {
                valueFormatString: "MMM YYYY"
            },
            axisY: {
                title: "Price",
                prefix: "$",
                suffix: ""
            },
            toolTip: {
                shared: true
            },
            legend: {
                cursor: "pointer",
                verticalAlign: "top",
                horizontalAlign: "center",
                dockInsidePlotArea: true,
                itemclick: toogleDataSeries
            },
            data: [
                    @if(Auth::user()->hasRole('PackagesAdmin'))
                {

                    type:"line",
                    axisYType: "secondary",
                    name: "Packages",
                    showInLegend: true,
                    markerSize: 0,
                    yValueFormatString: "$#,###",
                    dataPoints: [
                        { x: new Date(2021, 01, 01), y: 0 },
                            @foreach($mothly_sales_data['packages_monthly_sales'] as $data)
                        { x: new Date({{$data->new_date}}), y: ${{$data->total}} },
                        @endforeach
                    ]
                },
                @endif
                @if(Auth::user()->hasRole('HotelsAdmin'))
                {
                    type: "line",
                    axisYType: "secondary",
                    name: "Hotels",
                    showInLegend: true,
                    markerSize: 0,
                    yValueFormatString: "$#,###",
                    dataPoints: [
                        { x: new Date(2021, 01, 01), y: 0 },
                            @foreach($mothly_sales_data['hotel_monthly_sales'] as $data)
                        { x: new Date({{$data->new_date}}), y: {{$data->total}} },
                        @endforeach
                    ]
                },
                @endif
                @if(Auth::user()->hasRole('TransportAdmin'))
                {
                    type: "line",
                    axisYType: "secondary",
                    name: "Transport",
                    showInLegend: true,
                    markerSize: 0,
                    yValueFormatString: "$#,###",
                    dataPoints: [
                        { x: new Date(2021, 01, 01), y: 0 },
                            @foreach($mothly_sales_data['transport_monthly_sales'] as $data)
                        { x: new Date({{$data->new_date}}), y: {{$data->total}} },
                        @endforeach
                    ]
                },
                @endif
                @if(Auth::user()->hasRole('GuestsPassAdmin'))
                {
                    type: "line",
                    axisYType: "secondary",
                    name: "Shrine Programs",
                    showInLegend: true,
                    markerSize: 0,
                    yValueFormatString: "$#,###",
                    dataPoints: [
                        { x: new Date(2021, 01, 01), y: 0 },
                            @foreach($mothly_sales_data['shrines_monthly_sales'] as $data)
                        { x: new Date({{$data->new_date}}), y: {{$data->total}} },
                        @endforeach
                    ]
                },
                    @endif
                    @if(Auth::user()->hasRole('GuideAdmin'))
                {
                    type: "line",
                    axisYType: "secondary",
                    name: "Guide",
                    showInLegend: true,
                    markerSize: 0,
                    yValueFormatString: "$#,###",
                    dataPoints: [
                        { x: new Date(2021, 01, 01), y: 0 },
                            @foreach($mothly_sales_data['guide_monthly_sales'] as $data)
                        { x: new Date({{$data->new_date}}), y: {{$data->total}} },
                        @endforeach
                    ]
                }
                @endif
            ]
        });
        chart.render();

        function toogleDataSeries(e){
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else{
                e.dataSeries.visible = true;
            }
            chart.render();
        }

    }
    @endif
</script>
@endpush