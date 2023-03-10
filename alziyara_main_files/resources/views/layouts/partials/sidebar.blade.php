<aside class="sidebar">
    <div class="scroll-sidebar">
        @if(session()->get('theme-layout') != 'fix-header')
            <div class="user-profile">
                <div class="dropdown user-pro-body ">
                    <div class="profile-image">
                        @if(auth()->user()->profile->pic == null)
                            <img src="{{asset('storage/uploads/users/no_avatar.jpg')}}" alt="user-img" class="img-circle">
                        @else
                            <img src="{{asset('website/ProfileImage').'/'.auth()->user()->profile->pic}}" alt="user-img" class="img-circle">
                        @endif
                        {{--@if((Auth::user() != null) && Auth::user()->hasRole('GuideAdmin'))--}}
                        {{--@elseif((Auth::user() != null) && Auth::user()->hasRole('SuperAdmin'))--}}
                        <a href="javascript:void(0);" class="dropdown-toggle u-dropdown text-blue" data-toggle="dropdown"
                           role="button" aria-haspopup="true" aria-expanded="false">
							<span class="badge badge-danger">
                            <i class="fa fa-angle-down"></i>
                        </span>
                        </a>
                        <ul class="dropdown-menu animated flipInY" >
                            {{--<li><a href="{{url('profile')}}"><i class="fa fa-user"></i> Profile</a></li>--}}
                            {{--<li><a href="javascript:void(0);"><i class="fa fa-inbox"></i> Inbox</a></li>--}}
                            {{--<li role="separator" class="divider"></li>--}}
                            <li><a href="{{url('account-settings')}}"><i class="fa fa-cog"></i> Account Settings</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{url('logout')}}"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                        {{--@else--}}
                        {{--@endif--}}
                    </div>
                    <p class="profile-text m-t-15 font-16"><a href="javascript:void(0);"> {{auth()->user()->name}}</a></p>
                </div>
            </div>
        @endif
        @php $url = Request::segment(2); @endphp
        {{--{{ Request::segment(1) === 'manageSetting'  ? 'active' : null }}--}}
        @if(Request::segment(1) === 'user' || Request::segment(1) === 'manageSetting')
            <nav class="sidebar-nav active">
                @else
                    <nav class="sidebar-nav">
                        @endif

                        <ul id="side-menu">
                            <li><a class="waves-effect" href="{{url('dashboard')}}" aria-expanded="false"><i
                                            class="icon-screen-desktop fa-fw"></i> <span class="hide-menu"> Dashboard </span></a></li>
                            @if((Auth::user() != null) && ( Auth::user()->hasRole('SuperAdmin') != 1 ))
                                <li class="two-column">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                class="fa fa-ticket fa-fw"></i> <span class="hide-menu">Bookings</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        @if((Auth::user() != null) && Auth::user()->hasRole('PackagesAdmin'))
                                            <li><a class="waves-effect" href="{{route('my_package_booking_calendar')}}" aria-expanded="false"><i class="fa fa-envelope  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Packages Deal</span></a></li>
                                        @endif
                                        @if((Auth::user() != null) && Auth::user()->hasRole('HotelsAdmin'))
                                            <li><a class="waves-effect" href="{{route('roombooking')}}" aria-expanded="false"><i class="fa fa-building  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Hotel</span></a></li>
                                        @endif
                                        @if((Auth::user() != null) && Auth::user()->hasRole('GuestsPassAdmin'))
                                            <li><a class="waves-effect" href="{{route('guestpassbooking')}}" aria-expanded="false"><i class="fa fa-home  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Shrine Programs</span></a></li>
                                        @endif
                                        @if((Auth::user() != null) && Auth::user()->hasRole('TransportAdmin'))
                                            <li><a class="waves-effect" href="{{route('transportbooking')}}" aria-expanded="false"><i class="fa fa-bus  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Transportation</span></a></li>
                                        @endif
                                        @if((Auth::user() != null) && Auth::user()->hasRole('GuideAdmin'))
                                            <li><a class="waves-effect" href="{{route('guidebooking')}}" aria-expanded="false"><i class="fa fa-street-view  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Guide</span></a></li>
                                        @endif
                                    </ul>
                                </li>
                            

                                <li class="two-column{{ request()->is('manageSetting/manage-setting/*/edit') ? 'active' : '' }}">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                class="fa fa-gear fa-fw"></i> <span class="hide-menu">Settings</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        @if((Auth::user() != null) && Auth::user()->hasRole('PackagesAdmin'))
                                            <li><a  href="{{url('manageSetting/manage-setting')}}"><i class="fa fa-envelope  fa-fw" aria-hidden="true"></i>Packages Deal</a></li>
                                        @endif
                                        @if((Auth::user() != null) && Auth::user()->hasRole('HotelsAdmin'))
                                            <li><a class="waves-effect" href="{{route('myhotel')}}" aria-expanded="false"><i class="fa fa-building  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Hotel</span></a></li>
                                        @endif
                                        @if((Auth::user() != null) && Auth::user()->hasRole('GuestsPassAdmin'))
                                            <li><a  href="{{route('myguestspass')}}"><i class="fa fa-home fa-fw"></i>Shrine Programs</a></li>
                                        @endif
                                        @if((Auth::user() != null) && Auth::user()->hasRole('TransportAdmin'))
                                            <li><a class="waves-effect" href="{{URL('transportation/transportation')}}" aria-expanded="false"><i class="fa fa-bus  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Transportations</span></a></li>
                                        @endif
                                        @if((Auth::user() != null) && Auth::user()->hasRole('GuideAdmin'))
                                            <li><a class="waves-effect" href="{{url('guid/guid')}}" aria-expanded="false"><i class="fa fa-street-view fa-fw"></i> <span class="hide-menu">Guide</span></a></li>
                                        @endif
                                    </ul>
                                </li>
                                <li class="two-column">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                class="icon-notebook fa-fw"></i> <span class="hide-menu">Sales</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        @if((Auth::user() != null) && Auth::user()->hasRole('PackagesAdmin'))
                                            <li><a class="waves-effect" href="{{url('search/search')}}" aria-expanded="false"><i class="fa fa-envelope  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Packages Deal</span></a></li>
                                        @endif
                                        @if((Auth::user() != null) && Auth::user()->hasRole('HotelsAdmin'))
                                            <li><a class="waves-effect" href="{{route('roomordersreservations')}}" aria-expanded="false"><i class="fa fa-building-o fa-fw"></i> <span class="hide-menu">Hotels</span></a></li>
                                        @endif
                                        @if((Auth::user() != null) && Auth::user()->hasRole('GuestsPassAdmin'))
                                            <li><a class="waves-effect" href="{{route('guestpassordersreservations')}}" aria-expanded="false"><i class="fa fa-home fa-fw"></i> <span class="hide-menu">Shrine Programs</span></a></li>
                                        @endif
                                        @if((Auth::user() != null) && Auth::user()->hasRole('TransportAdmin'))
                                            <li><a class="waves-effect" href="{{route('transportordersreservations')}}" aria-expanded="false"><i class="fa fa-bus  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Transportation</span></a></li>
                                        @endif
                                        @if((Auth::user() != null) && Auth::user()->hasRole('GuideAdmin'))
                                            <li><a class="waves-effect" href="{{route('guideordersreservations')}}" aria-expanded="false"><i class="fa fa-street-view fa-fw"></i> <span class="hide-menu">Guide</span></a></li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                            @if((Auth::user() != null) && Auth::user()->hasRole('GuideAdmin'))

                                {{--<a class="waves-effect" href="{{url('dashboard')}}" aria-expanded="false"><i
                                class="icon-screen-desktop fa-fw"></i> <span class="hide-menu">Add Guide Profile</span></a>
                                <li class="two-column">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                class="fa fa-gear fa-fw"></i> <span class="hide-menu">Settings</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a class="waves-effect" href="{{url('guid/guid')}}" aria-expanded="false"><i
                                                        class="icon-screen-desktop fa-fw"></i> <span class="hide-menu">All Guides</span></a></li>

                                    </ul>
                                </li>
                                <li class="two-column">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                class="fa fa-gear fa-fw"></i> <span class="hide-menu">Bookings</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a class="waves-effect" href="{{route('guidebooking')}}" aria-expanded="false"><i
                                                        class="icon-docs fa-fw"></i> <span class="hide-menu">Guide Bookings</span></a></li>
                                    </ul>
                                </li>
                                <li class="two-column">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                class="icon-notebook fa-fw"></i> <span class="hide-menu">Sales</span></a>
                                    <ul aria-expanded="false" class="collapse">

                                        <li><a class="waves-effect" href="{{route('guideordersreservations')}}" aria-expanded="false"><i
                                                        class="icon-screen-desktop fa-fw"></i> <span class="hide-menu">My Guides Orders</span></a></li>
                                    </ul>
                                </li>--}}
                            @endif
                            @if((Auth::user() != null) && Auth::user()->hasRole('SuperAdmin'))
                                <li class="two-column {{ Request::segment(1) === 'user' ? 'active' : null }}">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="true">
                                        <i class="icon-user fa-fw"></i><span class="hide-menu">Manage Users</span>
                                    </a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="{{route('allusers')}}" > <i class="fa fa-circle"></i> All Users</a></li>
                                        <li><a href="{{route('service-provider-request')}}" > <i class="fa fa-circle"></i> New Account Activations</a></li>
                                    </ul>
                                </li>
                                <li class="two-column">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                class="fa fa-ticket fa-fw"></i> <span class="hide-menu">Bookings</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a class="waves-effect" href="{{route('packagebookingsd')}}" aria-expanded="false">
                                                <i class="fa fa-envelope  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Packages Deal</span></a></li>
                                        <li><a class="waves-effect" href="{{route('roombookingsd')}}" aria-expanded="false">
                                                <i class="fa fa-building  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Hotel</span></a></li>
                                        <li><a class="waves-effect" href="{{route('guestpassbookingsd')}}" aria-expanded="false">
                                                <i class="fa fa-home  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Shrine Programs</span></a></li>
                                        <li><a class="waves-effect" href="{{route('transportbookingsd')}}" aria-expanded="false">
                                                <i class="fa fa-bus  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Transportation</span></a></li>
                                        <li><a class="waves-effect" href="{{route('guidebookingsd')}}" aria-expanded="false">
                                                <i class="fa fa-street-view  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Guide</span></a></li>
                                    </ul>
                                </li>
                                <li class="two-column">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                class="fa fa-gear fa-fw"></i> <span class="hide-menu">Settings</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a class="waves-effect" href="{{ url('manageSetting/manage-setting') }}" aria-expanded="false"><i class="fa fa-envelope  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Packages Deal</span></a></li>
                                        <li><a class="waves-effect" href="{{route('allproperty')}}" aria-expanded="false"><i class="fa fa-building  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Hotel</span></a></li>
                                        <li><a class="waves-effect" href="{{route('allguestspass')}}" aria-expanded="false"><i class="fa fa-home  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Shrine Programs</span></a></li>
                                        <li><a class="waves-effect" href="{{URL('transportation/transportation')}}" aria-expanded="false"><i class="fa fa-bus  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Transportation</span></a></li>
                                        <li><a class="waves-effect" href="{{URL('guid/guid')}}" aria-expanded="false"><i class="fa fa-street-view  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Guide</span></a></li>
                                    </ul>
                                </li>
                                <li class="two-column">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                class="icon-notebook fa-fw"></i> <span class="hide-menu">Sales</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a  href="{{ url('search/search') }}" ><i class="fa fa-envelope  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Packages Deal</span></a></li>
                                        <li><a  href="{{route('myallroomreservation')}}" ><i class="fa fa-building  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Hotel</span></a></li>
                                        <li><a  href="{{route('myallguestpassreservation')}}" ><i class="fa fa-home  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Shrine Programs</span></a></li>
                                        <li><a  href="{{route('myalltransportreservation')}}" ><i class="fa fa-bus  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Transportation</span></a></li>
                                        <li><a  href="{{route('myallguidereservation')}}" ><i class="fa fa-street-view  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Guide</span></a></li>
                                    </ul>
                                </li>
                                <li class="two-column"><a class="waves-effect" href="{{route('refundrequest')}}" aria-expanded="false"><i class="fa fa-globe fa-fw"></i><span class="hide-menu">Refund Requests</span></a></li>

                            @endif

                            @if((Auth::user() != null) && Auth::user()->hasRole('TransportAdmin'))
                                {{--<li>
                                        <a class="waves-effect" href="{{URL('transportation/transportation')}}" aria-expanded="false">
                                            <i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu">All Transportations</span>
                                        </a>
                                </li>
                                <li class="two-column">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                class="fa fa-gear fa-fw"></i> <span class="hide-menu">Settings</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a class="waves-effect" href="{{URL('transportation/transportation')}}" aria-expanded="false">
                                                <i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu">My Transportations</span></a></li>
                                    </ul>
                                </li>
                                <li class="two-column">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                class="fa fa-gear fa-fw"></i> <span class="hide-menu">Bookings</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a class="waves-effect" href="{{route('transportbooking')}}" aria-expanded="false"><i
                                                        class="icon-docs fa-fw"></i> <span class="hide-menu">Transport Bookings</span></a></li>
                                    </ul>
                                </li>
                                <li class="two-column">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                class="icon-notebook fa-fw"></i> <span class="hide-menu">Sales</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a class="waves-effect" href="{{route('transportordersreservations')}}" aria-expanded="false"><i
                                                        class="icon-screen-desktop fa-fw"></i> <span class="hide-menu">My Transportation Orders</span></a></li>
                                    </ul>
                                </li>--}}
                            @endif



                            @if((Auth::user() != null) && Auth::user()->hasRole('GuestsPassAdmin'))

                                {{--<li class="two-column">
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                    class="fa fa-gear fa-fw"></i> <span class="hide-menu">Bookings</span></a>
                                        <ul aria-expanded="false" class="collapse">

                                            <li><a class="waves-effect" href="{{route('guestpassbooking')}}" aria-expanded="false"><i
                                                            class="icon-docs fa-fw"></i> <span class="hide-menu">GuestsPass Bookings</span></a></li>

                                        </ul>
                                    </li>

                                    <li class="two-column">
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                    class="fa fa-gear fa-fw"></i> <span class="hide-menu">Settings</span></a>
                                        <ul aria-expanded="false" class="collapse">

                                            <li><a class="waves-effect" href="{{route('addguestspass')}}" aria-expanded="false"><i
                                                            class="icon-docs fa-fw"></i> <span class="hide-menu">Add GuestsPass</span></a></li>

                                            <li><a  href="{{route('myguestspass')}}"><i class="icon-equalizer fa-fw"></i>My GuestsPass</a></li>

                                        </ul>
                                    </li>

                                    <li class="two-column">
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                    class="icon-notebook fa-fw"></i> <span class="hide-menu">Sales</span></a>
                                        <ul aria-expanded="false" class="collapse">

                                            <li><a class="waves-effect" href="{{route('guestpassordersreservations')}}" aria-expanded="false"><i
                                                            class="icon-screen-desktop fa-fw"></i> <span class="hide-menu">My GuestsPass Orders</span></a></li>

                                        </ul>

                                </li>--}}

                            @endif

                            @if((Auth::user() != null) && Auth::user()->hasRole('HotelsAdmin'))


                                {{--<li class="two-column">
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                    class="fa fa-gear fa-fw"></i> <span class="hide-menu">Bookings</span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a class="waves-effect" href="{{route('roombooking')}}" aria-expanded="false"><i class="icon-docs fa-fw"></i> <span class="hide-menu">Room Bookings</span></a></li>
                                        </ul>
                                    </li>
                                    <li class="two-column">
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="fa fa-gear fa-fw"></i> <span class="hide-menu">Settings</span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a class="waves-effect" href="{{route('createhotel')}}" aria-expanded="false"><i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu">Add Hotel/Property</span></a></li>
                                            <li><a class="waves-effect" href="{{route('myhotel')}}" aria-expanded="false"><i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu">My Properties</span></a></li>
                                            <li><a class="waves-effect" href="{{route('createroom')}}" aria-expanded="false"><i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu">Add Rooms</span></a></li>
                                            <li><a class="waves-effect" href="{{route('myroom')}}" aria-expanded="false"><i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu">My Rooms</span></a></li>
                                        </ul>
                                    </li>
                                    <li class="two-column">
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-notebook fa-fw"></i> <span class="hide-menu">Sales</span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a class="waves-effect" href="{{route('roomordersreservations')}}" aria-expanded="false"><i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu">My Room Orders</span></a></li>
                                        </ul>
                                </li>--}}
                            @endif
                            @if(auth()->user()->isAdmin() == true)
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="{{asset('dashboard')}}">Modern Version</a></li>
                                    <li><a href="{{asset('index2')}}">Clean Version</a></li>
                                    <li><a href="{{asset('index3')}}">Analytical Version</a></li>
                                    <li>
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span class="hide-menu"> eCommerce </span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="{{asset('index4')}}">Dashboard</a></li>
                                            <li><a href="{{asset('products')}}">Products</a></li>
                                            <li><a href="{{asset('product-detail')}}">Product Detail</a></li>
                                            <li><a href="{{asset('product-edit')}}">Product Edit</a></li>
                                            <li><a href="{{asset('product-orders')}}">Product Orders</a></li>
                                            <li><a href="{{asset('product-cart')}}">Product Cart</a></li>
                                            <li><a href="{{asset('product-checkout')}}">Product Checkout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                @endif
                                </li>
                                @if(auth()->user()->isAdmin() == true)
                                    <li><a class="waves-effect" href="{{asset('role-management')}}">
                                            <i class=" icon-layers fa-fw"></i><span class="hide-menu"> Roles </span></a>
                                    </li>
                                    <li class="two-column">
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="fa fa-user fa-fw"></i> <span class="hide-menu"> Users</span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="{{asset('users')}}">Manage Users</a></li>
                                            <li><a href="{{asset('user/create')}}">Add New User</a></li>
                                            <li><a href="{{asset('user/deleted')}}">Deleted Users</a></li>

                                        </ul>
                                    </li>
                                    <li>
                                        <hr />
                                    </li>
                                    {{--<li><a class="waves-effect" href="{{asset('permission-management')}}"> <i--}}
                                    {{--class="icon-list fa-fw"></i><span class="hide-menu"> Permissions</span></a></li>--}}
                                    <li><a class="waves-effect" href="{{asset('crud-generator')}}">
                                            <i class="icon-drawar fa-fw"></i><span class="hide-menu"> CRUD Generator</span></a>
                                    </li>
                                    <li class="two-column">
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-eye fa-fw"></i> <span class="hide-menu"> Logs</span></a>
                                        <ul aria-exzpanded="false" class="collapse">
                                            <li><a href="{{asset('log-viewer')}}">Laravel Log</a></li>
                                            <li><a href="{{asset('activity-log')}}">Activity Log</a></li>
                                        </ul>
                                    </li>
                                @endif
                                {{--@foreach($laravelAdminMenus->menus as $section)--}}
                                {{--@if(count(collect($section->items)) > 0)--}}
                                {{--@foreach($section->items as $menu)--}}
                                {{--@if(auth()->user()->hasrole('PackagesAdmin'))--}}
                                {{--@if($menu->title == 'Search')--}}
                                {{--<li class="two-column">--}}
                                {{--<a class="waves-effect" href="javascript:void(0);" aria-expanded="false"> <i class="icon-docs fa-fw"></i> <span class="hide-menu"> Package Deals</span></a>--}}
                                {{--<ul aria-expanded="false" class="collapse">--}}
                                {{--<li><a href="{{ route('my_package_booking_calendar') }}">Calendar</a></li>--}}
                                {{--<li><a href="{{ url('search/search') }}">Search</a></li>--}}
                                {{--<li><a href="{{ url('manageSetting/manage-setting') }}">Settings</a></li>--}}
                                {{--</ul>--}}
                                {{--</li>--}}
                                {{--@endif--}}
                                {{--@else--}}

                                {{--@if($menu->title == 'Search' || $menu->title == 'ManageSetting' )--}}
                                {{--@continue--}}
                                {{--@endif--}}
                                {{--@can('view-'.str_slug($menu->title))--}}
                                {{--<li>--}}
                                {{--<a class="waves-effect" href="{{ url($menu->url) }}">--}}
                                {{--<i class="glyphicon {{$menu->icon}} fa-fw"></i>--}}
                                {{--<span class="hide-menu"> {{ $menu->title }}</span>--}}
                                {{--</a>--}}
                                {{--</li>--}}
                                {{--@endcan--}}
                                {{--@endif--}}
                                {{--@endforeach--}}
                                {{--@endif--}}
                                {{--@endforeach--}}
                                @if((Auth::user() != null) && Auth::user()->hasRole('PackagesAdmin'))
                                    {{--<li class="two-column">
                                            <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="fa fa-gear fa-fw"></i> <span class="hide-menu">Bookings</span></a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li><a class="waves-effect" href="{{route('my_package_booking_calendar')}}" aria-expanded="false"><i class="icon-docs fa-fw"></i> <span class="hide-menu">PackageDeals Bookings</span></a></li>
                                            </ul>
                                        </li>
                                        <li class="two-column">
                                            <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="fa fa-gear fa-fw"></i> <span class="hide-menu">Settings</span></a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li><a class="waves-effect" href="{{url('manageSetting/manage-setting/create')}}" aria-expanded="false"><i class="icon-docs fa-fw" ></i> <span class="hide-menu">Add Package Deals</span></a></li>
                                                <li><a  href="{{url('manageSetting/manage-setting')}}"><i class="icon-equalizer fa-fw"></i>My Package Deals</a></li>
                                            </ul>
                                        </li>
                                        <li class="two-column">
                                            <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                        class="icon-notebook fa-fw"></i> <span class="hide-menu">Sales</span></a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li><a class="waves-effect" href="{{url('search/search')}}" aria-expanded="false"><i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu">My Package Deals Orders</span></a></li>
                                            </ul>
                                    </li>--}}
                                @endif
                                @if(Auth::User()->hasRole('SuperAdmin'))
                                    <li>
                                        <a class="waves-effect" href="javascript:void(0);"  aria-expanded="false">
                                            <i class="fa fa-dollar fa-fw"></i> <span class="hide-menu"> Withdrawal Requests </span>
                                        </a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li>
                                                <a class="waves-effect" href="javascript:void(0);"  aria-expanded="false">&nbsp;
                                                    <i class="fa fa-envelope fa-fw"></i> <span class="hide-menu"> Packages Deal</span>
                                                </a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="{{URL('accepted-withdrawal-packages-deal')}}"> <i class="fa fa-check"></i> &nbsp;Accepted</a></li>
                                                    <li><a href="{{URL('pending-withdrawal-packages-deal')}}"> <i class="fa fa-ban"></i>  Pending</a></li>
                                                    <li><a href="{{URL('rejected-withdrawal-packages-deal')}}"> <i class="fa fa-close"></i>  Rejected</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect" href="javascript:void(0);"  aria-expanded="false">&nbsp;
                                                    <i class="fa fa-building  fa-fw"></i> <span class="hide-menu"> Hotel</span>
                                                </a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="{{URL('accepted-withdrawal-hotel')}}"><i class="fa fa-check"></i>&nbsp;Accepted</a></li>
                                                    <li><a href="{{URL('pending-withdrawal-hotel')}}"><i class="fa fa-ban"></i> Pending</a></li>
                                                    <li><a href="{{URL('rejected-withdrawal-hotel')}}"><i class="fa fa-close"></i> Rejected</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect" href="javascript:void(0);"  aria-expanded="false">&nbsp;
                                                    <i class="fa fa-home fa-fw"></i> <span class="hide-menu"> Shrine Programs</span>
                                                </a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="{{URL('accepted-withdrawal-shrine-programs')}}"><i class="fa fa-check"></i>&nbsp;Accepted</a></li>
                                                    <li><a href="{{URL('pending-withdrawal-shrine-programs')}}"><i class="fa fa-ban"></i> Pending</a></li>
                                                    <li><a href="{{URL('rejected-withdrawal-shrine-programs')}}"><i class="fa fa-close"></i> Rejected</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect" href="javascript:void(0);"  aria-expanded="false">&nbsp;
                                                    <i class="fa fa-bus fa-fw"></i> <span class="hide-menu"> Transportation</span>
                                                </a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="{{URL('accepted-withdrawal-transportation')}}"><i class="fa fa-check"></i>&nbsp;Accepted</a></li>
                                                    <li><a href="{{URL('pending-withdrawal-transportation')}}"><i class="fa fa-ban"></i> Pending</a></li>
                                                    <li><a href="{{URL('rejected-withdrawal-transportation')}}"><i class="fa fa-close"></i> Rejected</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect" href="javascript:void(0);"  aria-expanded="false">&nbsp;
                                                    <i class="fa fa-street-view fa-fw"></i> <span class="hide-menu"> Guide</span>
                                                </a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="{{URL('accepted-withdrawal-guide')}}" ><i class="fa fa-check"></i>&nbsp;Accepted</a></li>
                                                    <li><a href="{{URL('pending-withdrawal-guide')}}" ><i class="fa fa-ban"></i> Pending</a></li>
                                                    <li><a href="{{URL('rejected-withdrawal-guide')}}" ><i class="fa fa-close"></i> Rejected</a></li>
                                                </ul>
                                            </li>

                                        </ul>
                                    </li>
                                    <li class="two-column">
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="true">
                                            <i class="icon-arrow-down-circle fa-fw"></i><span class="hide-menu">Content Management</span>
                                        </a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="{{asset('about/about')}}" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Pages</a></li>
                                            <li><a href="{{asset('travelAgency/travel-agency')}}" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Travel Agencies</a></li>
                                            <li><a href="{{asset('agencyImage/agency-image')}}" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Travel Images</a></li>
                                            <li><a href="{{asset('visaArrival/visa-arrival')}}" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Visa Arrivals</a></li>
                                            <li><a href="{{asset('contact/contact')}}">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Contact Requests</a></li>
                                            <li><a href="{{asset('fAQ/f-a-q')}}">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;FAQ's</a></li>
                                            <li><a href="{{asset('sPFAQ/s-p-f-a-q')}}">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Super Admin FAQ's</a></li>
                                            <li><a href="{{asset('askAQuestion/ask-a-question')}}">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Ask A Questions</a></li>
                                            <li><a href="{{asset('contactDetail/contact-detail')}}">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Contact Details</a></li>
                                            <li><a href="{{asset('tourTrip/tour-trip')}}">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Tour Trips</a></li>
                                            <li><a href="{{asset('testimonial/testimonial')}}">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Testimonials</a></li>
                                            <li><a href="{{asset('discover/discover')}}">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Discover</a></li>
                                            <li><a href="{{asset('blog/blog')}}">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Blogs</a></li>
                                            <li><a href="{{asset('about/about/26/edit')}}">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Return and Refunds</a></li>
                                            <li><a href="{{asset('about/about/27/edit')}}">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Careers</a></li>
                                            <li><a href="{{asset('about/about/28/edit')}}">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Cookies Policy</a></li>
                                            <li><a href="{{asset('about/about/30/edit')}}">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Media</a></li>
                                            <li><a href="{{asset('about/about/31/edit')}}">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Why AlZuwar</a></li>
                                            <li><a href="{{asset('about/about/32/edit')}}">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Advertise With Us</a></li>
                                            <li><a href="{{asset('about/about/43/edit')}}"><i class="fa fa-circle"></i> Homepage Message</a></li>
                                            <li class="two-column">
                                                <a class="waves-effect" href="javascript:void(0);" aria-expanded="true">
                                                    <i class="fa fa-map-marker fa-fw" aria-hidden="true"></i><span class="hide-menu">Destinations</span>
                                                </a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="{{asset('about/about/33/edit')}}" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Mecca</a></li>
                                                    <li><a href="{{asset('about/about/34/edit')}}" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Medina</a></li>
                                                    <li><a href="{{asset('about/about/35/edit')}}" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Karbala</a></li>
                                                    <li><a href="{{asset('about/about/37/edit')}}" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Najaf</a></li>
                                                    <li><a href="{{asset('about/about/38/edit')}}" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Samarrah</a></li>
                                                    <li><a href="{{asset('about/about/39/edit')}}" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;kadhmain</a></li>
                                                    <li><a href="{{asset('about/about/40/edit')}}" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Kufa</a></li>
                                                    <li><a href="{{asset('about/about/41/edit')}}" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Damascus</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                                @endif
                                <li>
                                    <a class="waves-effect" href="{{ url('account-settings') }}">
                                        <i class="fa fa-gear fa-fw"></i>
                                        <span class="hide-menu">My Account</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="waves-effect" href="{{ url('logout') }}">
                                        <i class="fa fa-sign-out fa-fw"></i>
                                        <span class="hide-menu">Logout</span>
                                    </a>
                                </li>
                                @if(auth()->user()->isAdmin() == true)
                                    <li>
                                        <hr />
                                    </li>

                                    <li class="two-column">
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                    class="icon-equalizer fa-fw"></i> <span class="hide-menu"> UI Elements</span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="{{asset('panels-wells')}}">Panels and Wells</a></li>
                                            <li><a href="{{asset('panel-ui-block')}}">Panels With BlockUI</a></li>
                                            <li><a href="{{asset('portlet-draggable')}}">Draggable Portlet</a></li>
                                            <li><a href="{{asset('buttons')}}">Buttons</a></li>
                                            <li><a href="{{asset('tabs')}}">Tabs</a></li>
                                            <li><a href="{{asset('modals')}}">Modals</a></li>
                                            <li><a href="{{asset('progressbars')}}">Progress Bars</a></li>
                                            <li><a href="{{asset('notification')}}">Notifications</a></li>
                                            <li><a href="{{asset('carousel')}}">Carousel</a></li>
                                            <li><a href="{{asset('user-cards')}}">User Cards</a></li>
                                            <li><a href="{{asset('timeline')}}">Timeline</a></li>
                                            <li><a href="{{asset('timeline-horizontal')}}">Horizontal Timeline</a></li>
                                            <li><a href="{{asset('range-slider')}}">Range Slider</a></li>
                                            <li><a href="{{asset('ribbons')}}">Ribbons</a></li>
                                            <li><a href="{{asset('steps')}}">Steps</a></li>
                                            <li><a href="{{asset('session-idle-timeout')}}">Session Idle Timeout</a></li>
                                            <li><a href="{{asset('session-timeout')}}">Session Timeout</a></li>
                                            <li><a href="{{asset('bootstrap-ui')}}">Bootstrap UI</a></li>
                                        </ul>
                                    </li>
                                    <li class="two-column">
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                    class="icon-docs fa-fw"></i> <span class="hide-menu"> Pages</span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="{{asset('starter-page')}}">Starter Page</a></li>
                                            <li><a href="{{asset('blank')}}">Blank Page</a></li>
                                            <li><a href="{{asset('search-result')}}">Search Result</a></li>
                                            <li><a href="{{asset('custom-scroll')}}">Custom Scrolls</a></li>
                                            <li><a href="{{asset('login')}}">Login Page</a></li>
                                            <li><a href="{{asset('lock-screen')}}">Lock Screen</a></li>
                                            <li><a href="{{asset('recoverpw')}}">Recover Password</a></li>
                                            <li><a href="{{asset('animation')}}">Animations</a></li>
                                            <li><a href="{{asset('profile')}}">Profile</a></li>
                                            <li><a href="{{asset('invoice')}}">Invoice</a></li>
                                            <li><a href="{{asset('gallery')}}">Gallery</a></li>
                                            <li><a href="{{asset('pricing')}}">Pricing</a></li>
                                            <li><a href="{{asset('register')}}">Register</a></li>
                                            <li><a href="{{asset('400')}}">Error-400</a></li>
                                            <li><a href="{{asset('403')}}">Error-403</a></li>
                                            <li><a href="{{asset('404')}}">Error-404</a></li>
                                            <li><a href="{{asset('500')}}">Error-500</a></li>
                                            <li><a href="{{asset('503')}}">Error-503</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-notebook fa-fw"></i> <span class="hide-menu"> Forms </span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="{{asset('form-basic')}}">Basic Forms</a></li>
                                            <li><a href="{{asset('form-layout')}}">Form Layout</a></li>
                                            <li><a href="{{asset('icheck-control')}}">Icheck Control</a></li>
                                            <li><a href="{{asset('form-advanced')}}">Form Addons</a></li>
                                            <li><a href="{{asset('form-upload')}}">File Upload</a></li>
                                            <li><a href="{{asset('form-dropzone')}}">File Dropzone</a></li>
                                            <li><a href="{{asset('form-pickers')}}">Form-pickers</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-grid fa-fw"></i> <span class="hide-menu"> Tables</span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="{{asset('basic-table')}}">Basic Tables</a></li>
                                            <li><a href="{{asset('table-layouts')}}">Table Layouts</a></li>
                                            <li><a href="{{asset('data-table')}}">Data Table</a></li>
                                            <li><a href="{{asset('bootstrap-tables')}}">Bootstrap Tables</a></li>
                                            <li><a href="{{asset('responsive-tables')}}">Responsive Tables</a></li>
                                            <li><a href="{{asset('editable-tables')}}">Editable Tables</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                    class="icon-layers fa-fw"></i> <span class="hide-menu"> Extra</span></a>
                                        <ul aria-expanded="false" class="collapse extra">
                                            <li>
                                                <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span class="hide-menu"> Inbox </span></a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="{{asset('inbox')}}">Mail Box</a></li>
                                                    <li><a href="{{asset('inbox-detail')}}">Mail Details</a></li>
                                                    <li><a href="{{asset('compose')}}">Compose Mail</a></li>
                                                    <li><a href="{{asset('contact')}}">Contact</a></li>
                                                    <li><a href="{{asset('contact-detail')}}">Contact Detail</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="{{asset('calendar')}}" aria-expanded="false"><span class="hide-menu">Calendar</span></a>
                                            </li>
                                            <li>
                                                <a href="{{asset('widgets')}}" aria-expanded="false"><span class="hide-menu"> Widgets</span></a>
                                            </li>
                                            <li>
                                                <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span class="hide-menu"> Charts</span></a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="{{asset('morris-chart')}}">Morris Chart</a></li>
                                                    <li><a href="{{asset('peity-chart')}}">Peity Charts</a></li>
                                                    <li><a href="{{asset('knob-chart')}}">Knob Charts</a></li>
                                                    <li><a href="{{asset('sparkline-chart')}}">Sparkline charts</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span class="hide-menu"> Icons</span></a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="{{asset('simple-line')}}">Simple Line</a></li>
                                                    <li><a href="{{asset('fontawesome')}}">Fontawesome</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span
                                                            class="hide-menu"> Maps</span></a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="{{asset('map-google')}}">Google Map</a></li>
                                                    <li><a href="{{asset('map-vector')}}">Vector Map</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                                @endif

                        </ul>
                    </nav>
    </div>
</aside>