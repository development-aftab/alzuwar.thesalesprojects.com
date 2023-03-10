<aside class="sidebar">
    <div class="scroll-sidebar">
        <?php if(session()->get('theme-layout') != 'fix-header'): ?>
            <div class="user-profile">
                <div class="dropdown user-pro-body ">
                    <div class="profile-image">
                        <?php if(auth()->user()->profile->pic == null): ?>
                            <img src="<?php echo e(asset('storage/uploads/users/no_avatar.jpg')); ?>" alt="user-img" class="img-circle">
                        <?php else: ?>
                            <img src="<?php echo e(asset('website/ProfileImage').'/'.auth()->user()->profile->pic); ?>" alt="user-img" class="img-circle">
                        <?php endif; ?>
                        
                        
                        <a href="javascript:void(0);" class="dropdown-toggle u-dropdown text-blue" data-toggle="dropdown"
                           role="button" aria-haspopup="true" aria-expanded="false">
							<span class="badge badge-danger">
                            <i class="fa fa-angle-down"></i>
                        </span>
                        </a>
                        <ul class="dropdown-menu animated flipInY" >
                            
                            
                            
                            <li><a href="<?php echo e(url('account-settings')); ?>"><i class="fa fa-cog"></i> Account Settings</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo e(url('logout')); ?>"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                        
                        
                    </div>
                    <p class="profile-text m-t-15 font-16"><a href="javascript:void(0);"> <?php echo e(auth()->user()->name); ?></a></p>
                </div>
            </div>
        <?php endif; ?>
        <?php $url = Request::segment(2); ?>
        
        <?php if(Request::segment(1) === 'user' || Request::segment(1) === 'manageSetting'): ?>
            <nav class="sidebar-nav active">
                <?php else: ?>
                    <nav class="sidebar-nav">
                        <?php endif; ?>

                        <ul id="side-menu">
                            <li><a class="waves-effect" href="<?php echo e(url('dashboard')); ?>" aria-expanded="false"><i
                                            class="icon-screen-desktop fa-fw"></i> <span class="hide-menu"> Dashboard </span></a></li>
                            <?php if((Auth::user() != null) && ( Auth::user()->hasRole('SuperAdmin') != 1 )): ?>
                                <li class="two-column">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                class="fa fa-ticket fa-fw"></i> <span class="hide-menu">Bookings</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <?php if((Auth::user() != null) && Auth::user()->hasRole('PackagesAdmin')): ?>
                                            <li><a class="waves-effect" href="<?php echo e(route('my_package_booking_calendar')); ?>" aria-expanded="false"><i class="fa fa-envelope  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Packages Deal</span></a></li>
                                        <?php endif; ?>
                                        <?php if((Auth::user() != null) && Auth::user()->hasRole('HotelsAdmin')): ?>
                                            <li><a class="waves-effect" href="<?php echo e(route('roombooking')); ?>" aria-expanded="false"><i class="fa fa-building  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Hotel</span></a></li>
                                        <?php endif; ?>
                                        <?php if((Auth::user() != null) && Auth::user()->hasRole('GuestsPassAdmin')): ?>
                                            <li><a class="waves-effect" href="<?php echo e(route('guestpassbooking')); ?>" aria-expanded="false"><i class="fa fa-home  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Shrine Programs</span></a></li>
                                        <?php endif; ?>
                                        <?php if((Auth::user() != null) && Auth::user()->hasRole('TransportAdmin')): ?>
                                            <li><a class="waves-effect" href="<?php echo e(route('transportbooking')); ?>" aria-expanded="false"><i class="fa fa-bus  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Transportation</span></a></li>
                                        <?php endif; ?>
                                        <?php if((Auth::user() != null) && Auth::user()->hasRole('GuideAdmin')): ?>
                                            <li><a class="waves-effect" href="<?php echo e(route('guidebooking')); ?>" aria-expanded="false"><i class="fa fa-street-view  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Guide</span></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                            

                                <li class="two-column<?php echo e(request()->is('manageSetting/manage-setting/*/edit') ? 'active' : ''); ?>">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                class="fa fa-gear fa-fw"></i> <span class="hide-menu">Settings</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <?php if((Auth::user() != null) && Auth::user()->hasRole('PackagesAdmin')): ?>
                                            <li><a  href="<?php echo e(url('manageSetting/manage-setting')); ?>"><i class="fa fa-envelope  fa-fw" aria-hidden="true"></i>Packages Deal</a></li>
                                        <?php endif; ?>
                                        <?php if((Auth::user() != null) && Auth::user()->hasRole('HotelsAdmin')): ?>
                                            <li><a class="waves-effect" href="<?php echo e(route('myhotel')); ?>" aria-expanded="false"><i class="fa fa-building  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Hotel</span></a></li>
                                        <?php endif; ?>
                                        <?php if((Auth::user() != null) && Auth::user()->hasRole('GuestsPassAdmin')): ?>
                                            <li><a  href="<?php echo e(route('myguestspass')); ?>"><i class="fa fa-home fa-fw"></i>Shrine Programs</a></li>
                                        <?php endif; ?>
                                        <?php if((Auth::user() != null) && Auth::user()->hasRole('TransportAdmin')): ?>
                                            <li><a class="waves-effect" href="<?php echo e(URL('transportation/transportation')); ?>" aria-expanded="false"><i class="fa fa-bus  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Transportations</span></a></li>
                                        <?php endif; ?>
                                        <?php if((Auth::user() != null) && Auth::user()->hasRole('GuideAdmin')): ?>
                                            <li><a class="waves-effect" href="<?php echo e(url('guid/guid')); ?>" aria-expanded="false"><i class="fa fa-street-view fa-fw"></i> <span class="hide-menu">Guide</span></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <li class="two-column">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                class="icon-notebook fa-fw"></i> <span class="hide-menu">Sales</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <?php if((Auth::user() != null) && Auth::user()->hasRole('PackagesAdmin')): ?>
                                            <li><a class="waves-effect" href="<?php echo e(url('search/search')); ?>" aria-expanded="false"><i class="fa fa-envelope  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Packages Deal</span></a></li>
                                        <?php endif; ?>
                                        <?php if((Auth::user() != null) && Auth::user()->hasRole('HotelsAdmin')): ?>
                                            <li><a class="waves-effect" href="<?php echo e(route('roomordersreservations')); ?>" aria-expanded="false"><i class="fa fa-building-o fa-fw"></i> <span class="hide-menu">Hotels</span></a></li>
                                        <?php endif; ?>
                                        <?php if((Auth::user() != null) && Auth::user()->hasRole('GuestsPassAdmin')): ?>
                                            <li><a class="waves-effect" href="<?php echo e(route('guestpassordersreservations')); ?>" aria-expanded="false"><i class="fa fa-home fa-fw"></i> <span class="hide-menu">Shrine Programs</span></a></li>
                                        <?php endif; ?>
                                        <?php if((Auth::user() != null) && Auth::user()->hasRole('TransportAdmin')): ?>
                                            <li><a class="waves-effect" href="<?php echo e(route('transportordersreservations')); ?>" aria-expanded="false"><i class="fa fa-bus  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Transportation</span></a></li>
                                        <?php endif; ?>
                                        <?php if((Auth::user() != null) && Auth::user()->hasRole('GuideAdmin')): ?>
                                            <li><a class="waves-effect" href="<?php echo e(route('guideordersreservations')); ?>" aria-expanded="false"><i class="fa fa-street-view fa-fw"></i> <span class="hide-menu">Guide</span></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if((Auth::user() != null) && Auth::user()->hasRole('GuideAdmin')): ?>

                                
                            <?php endif; ?>
                            <?php if((Auth::user() != null) && Auth::user()->hasRole('SuperAdmin')): ?>
                                <li class="two-column <?php echo e(Request::segment(1) === 'user' ? 'active' : null); ?>">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="true">
                                        <i class="icon-user fa-fw"></i><span class="hide-menu">Manage Users</span>
                                    </a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="<?php echo e(route('allusers')); ?>" > <i class="fa fa-circle"></i> All Users</a></li>
                                        <li><a href="<?php echo e(route('service-provider-request')); ?>" > <i class="fa fa-circle"></i> New Account Activations</a></li>
                                    </ul>
                                </li>
                                <li class="two-column">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                class="fa fa-ticket fa-fw"></i> <span class="hide-menu">Bookings</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a class="waves-effect" href="<?php echo e(route('packagebookingsd')); ?>" aria-expanded="false">
                                                <i class="fa fa-envelope  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Packages Deal</span></a></li>
                                        <li><a class="waves-effect" href="<?php echo e(route('roombookingsd')); ?>" aria-expanded="false">
                                                <i class="fa fa-building  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Hotel</span></a></li>
                                        <li><a class="waves-effect" href="<?php echo e(route('guestpassbookingsd')); ?>" aria-expanded="false">
                                                <i class="fa fa-home  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Shrine Programs</span></a></li>
                                        <li><a class="waves-effect" href="<?php echo e(route('transportbookingsd')); ?>" aria-expanded="false">
                                                <i class="fa fa-bus  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Transportation</span></a></li>
                                        <li><a class="waves-effect" href="<?php echo e(route('guidebookingsd')); ?>" aria-expanded="false">
                                                <i class="fa fa-street-view  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Guide</span></a></li>
                                    </ul>
                                </li>
                                <li class="two-column">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                class="fa fa-gear fa-fw"></i> <span class="hide-menu">Settings</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a class="waves-effect" href="<?php echo e(url('manageSetting/manage-setting')); ?>" aria-expanded="false"><i class="fa fa-envelope  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Packages Deal</span></a></li>
                                        <li><a class="waves-effect" href="<?php echo e(route('allproperty')); ?>" aria-expanded="false"><i class="fa fa-building  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Hotel</span></a></li>
                                        <li><a class="waves-effect" href="<?php echo e(route('allguestspass')); ?>" aria-expanded="false"><i class="fa fa-home  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Shrine Programs</span></a></li>
                                        <li><a class="waves-effect" href="<?php echo e(URL('transportation/transportation')); ?>" aria-expanded="false"><i class="fa fa-bus  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Transportation</span></a></li>
                                        <li><a class="waves-effect" href="<?php echo e(URL('guid/guid')); ?>" aria-expanded="false"><i class="fa fa-street-view  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Guide</span></a></li>
                                    </ul>
                                </li>
                                <li class="two-column">
                                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                class="icon-notebook fa-fw"></i> <span class="hide-menu">Sales</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a  href="<?php echo e(url('search/search')); ?>" ><i class="fa fa-envelope  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Packages Deal</span></a></li>
                                        <li><a  href="<?php echo e(route('myallroomreservation')); ?>" ><i class="fa fa-building  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Hotel</span></a></li>
                                        <li><a  href="<?php echo e(route('myallguestpassreservation')); ?>" ><i class="fa fa-home  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Shrine Programs</span></a></li>
                                        <li><a  href="<?php echo e(route('myalltransportreservation')); ?>" ><i class="fa fa-bus  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Transportation</span></a></li>
                                        <li><a  href="<?php echo e(route('myallguidereservation')); ?>" ><i class="fa fa-street-view  fa-fw" aria-hidden="true"></i> <span class="hide-menu">Guide</span></a></li>
                                    </ul>
                                </li>
                                <li class="two-column"><a class="waves-effect" href="<?php echo e(route('refundrequest')); ?>" aria-expanded="false"><i class="fa fa-globe fa-fw"></i><span class="hide-menu">Refund Requests</span></a></li>

                            <?php endif; ?>

                            <?php if((Auth::user() != null) && Auth::user()->hasRole('TransportAdmin')): ?>
                                
                            <?php endif; ?>



                            <?php if((Auth::user() != null) && Auth::user()->hasRole('GuestsPassAdmin')): ?>

                                

                            <?php endif; ?>

                            <?php if((Auth::user() != null) && Auth::user()->hasRole('HotelsAdmin')): ?>


                                
                            <?php endif; ?>
                            <?php if(auth()->user()->isAdmin() == true): ?>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?php echo e(asset('dashboard')); ?>">Modern Version</a></li>
                                    <li><a href="<?php echo e(asset('index2')); ?>">Clean Version</a></li>
                                    <li><a href="<?php echo e(asset('index3')); ?>">Analytical Version</a></li>
                                    <li>
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span class="hide-menu"> eCommerce </span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="<?php echo e(asset('index4')); ?>">Dashboard</a></li>
                                            <li><a href="<?php echo e(asset('products')); ?>">Products</a></li>
                                            <li><a href="<?php echo e(asset('product-detail')); ?>">Product Detail</a></li>
                                            <li><a href="<?php echo e(asset('product-edit')); ?>">Product Edit</a></li>
                                            <li><a href="<?php echo e(asset('product-orders')); ?>">Product Orders</a></li>
                                            <li><a href="<?php echo e(asset('product-cart')); ?>">Product Cart</a></li>
                                            <li><a href="<?php echo e(asset('product-checkout')); ?>">Product Checkout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <?php endif; ?>
                                </li>
                                <?php if(auth()->user()->isAdmin() == true): ?>
                                    <li><a class="waves-effect" href="<?php echo e(asset('role-management')); ?>">
                                            <i class=" icon-layers fa-fw"></i><span class="hide-menu"> Roles </span></a>
                                    </li>
                                    <li class="two-column">
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="fa fa-user fa-fw"></i> <span class="hide-menu"> Users</span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="<?php echo e(asset('users')); ?>">Manage Users</a></li>
                                            <li><a href="<?php echo e(asset('user/create')); ?>">Add New User</a></li>
                                            <li><a href="<?php echo e(asset('user/deleted')); ?>">Deleted Users</a></li>

                                        </ul>
                                    </li>
                                    <li>
                                        <hr />
                                    </li>
                                    
                                    
                                    <li><a class="waves-effect" href="<?php echo e(asset('crud-generator')); ?>">
                                            <i class="icon-drawar fa-fw"></i><span class="hide-menu"> CRUD Generator</span></a>
                                    </li>
                                    <li class="two-column">
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-eye fa-fw"></i> <span class="hide-menu"> Logs</span></a>
                                        <ul aria-exzpanded="false" class="collapse">
                                            <li><a href="<?php echo e(asset('log-viewer')); ?>">Laravel Log</a></li>
                                            <li><a href="<?php echo e(asset('activity-log')); ?>">Activity Log</a></li>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                

                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                <?php if((Auth::user() != null) && Auth::user()->hasRole('PackagesAdmin')): ?>
                                    
                                <?php endif; ?>
                                <?php if(Auth::User()->hasRole('SuperAdmin')): ?>
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
                                                    <li><a href="<?php echo e(URL('accepted-withdrawal-packages-deal')); ?>"> <i class="fa fa-check"></i> &nbsp;Accepted</a></li>
                                                    <li><a href="<?php echo e(URL('pending-withdrawal-packages-deal')); ?>"> <i class="fa fa-ban"></i>  Pending</a></li>
                                                    <li><a href="<?php echo e(URL('rejected-withdrawal-packages-deal')); ?>"> <i class="fa fa-close"></i>  Rejected</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect" href="javascript:void(0);"  aria-expanded="false">&nbsp;
                                                    <i class="fa fa-building  fa-fw"></i> <span class="hide-menu"> Hotel</span>
                                                </a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="<?php echo e(URL('accepted-withdrawal-hotel')); ?>"><i class="fa fa-check"></i>&nbsp;Accepted</a></li>
                                                    <li><a href="<?php echo e(URL('pending-withdrawal-hotel')); ?>"><i class="fa fa-ban"></i> Pending</a></li>
                                                    <li><a href="<?php echo e(URL('rejected-withdrawal-hotel')); ?>"><i class="fa fa-close"></i> Rejected</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect" href="javascript:void(0);"  aria-expanded="false">&nbsp;
                                                    <i class="fa fa-home fa-fw"></i> <span class="hide-menu"> Shrine Programs</span>
                                                </a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="<?php echo e(URL('accepted-withdrawal-shrine-programs')); ?>"><i class="fa fa-check"></i>&nbsp;Accepted</a></li>
                                                    <li><a href="<?php echo e(URL('pending-withdrawal-shrine-programs')); ?>"><i class="fa fa-ban"></i> Pending</a></li>
                                                    <li><a href="<?php echo e(URL('rejected-withdrawal-shrine-programs')); ?>"><i class="fa fa-close"></i> Rejected</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect" href="javascript:void(0);"  aria-expanded="false">&nbsp;
                                                    <i class="fa fa-bus fa-fw"></i> <span class="hide-menu"> Transportation</span>
                                                </a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="<?php echo e(URL('accepted-withdrawal-transportation')); ?>"><i class="fa fa-check"></i>&nbsp;Accepted</a></li>
                                                    <li><a href="<?php echo e(URL('pending-withdrawal-transportation')); ?>"><i class="fa fa-ban"></i> Pending</a></li>
                                                    <li><a href="<?php echo e(URL('rejected-withdrawal-transportation')); ?>"><i class="fa fa-close"></i> Rejected</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect" href="javascript:void(0);"  aria-expanded="false">&nbsp;
                                                    <i class="fa fa-street-view fa-fw"></i> <span class="hide-menu"> Guide</span>
                                                </a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="<?php echo e(URL('accepted-withdrawal-guide')); ?>" ><i class="fa fa-check"></i>&nbsp;Accepted</a></li>
                                                    <li><a href="<?php echo e(URL('pending-withdrawal-guide')); ?>" ><i class="fa fa-ban"></i> Pending</a></li>
                                                    <li><a href="<?php echo e(URL('rejected-withdrawal-guide')); ?>" ><i class="fa fa-close"></i> Rejected</a></li>
                                                </ul>
                                            </li>

                                        </ul>
                                    </li>
                                    <li class="two-column">
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="true">
                                            <i class="icon-arrow-down-circle fa-fw"></i><span class="hide-menu">Content Management</span>
                                        </a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="<?php echo e(asset('about/about')); ?>" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Pages</a></li>
                                            <li><a href="<?php echo e(asset('travelAgency/travel-agency')); ?>" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Travel Agencies</a></li>
                                            <li><a href="<?php echo e(asset('agencyImage/agency-image')); ?>" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Travel Images</a></li>
                                            <li><a href="<?php echo e(asset('visaArrival/visa-arrival')); ?>" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Visa Arrivals</a></li>
                                            <li><a href="<?php echo e(asset('contact/contact')); ?>">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Contact Requests</a></li>
                                            <li><a href="<?php echo e(asset('fAQ/f-a-q')); ?>">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;FAQ's</a></li>
                                            <li><a href="<?php echo e(asset('sPFAQ/s-p-f-a-q')); ?>">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Super Admin FAQ's</a></li>
                                            <li><a href="<?php echo e(asset('askAQuestion/ask-a-question')); ?>">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Ask A Questions</a></li>
                                            <li><a href="<?php echo e(asset('contactDetail/contact-detail')); ?>">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Contact Details</a></li>
                                            <li><a href="<?php echo e(asset('tourTrip/tour-trip')); ?>">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Tour Trips</a></li>
                                            <li><a href="<?php echo e(asset('testimonial/testimonial')); ?>">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Testimonials</a></li>
                                            <li><a href="<?php echo e(asset('discover/discover')); ?>">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Discover</a></li>
                                            <li><a href="<?php echo e(asset('blog/blog')); ?>">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Blogs</a></li>
                                            <li><a href="<?php echo e(asset('about/about/26/edit')); ?>">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Return and Refunds</a></li>
                                            <li><a href="<?php echo e(asset('about/about/27/edit')); ?>">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Careers</a></li>
                                            <li><a href="<?php echo e(asset('about/about/28/edit')); ?>">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Cookies Policy</a></li>
                                            <li><a href="<?php echo e(asset('about/about/30/edit')); ?>">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Media</a></li>
                                            <li><a href="<?php echo e(asset('about/about/31/edit')); ?>">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Why AlZuwar</a></li>
                                            <li><a href="<?php echo e(asset('about/about/32/edit')); ?>">&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Advertise With Us</a></li>
                                            <li><a href="<?php echo e(asset('about/about/43/edit')); ?>"><i class="fa fa-circle"></i> Homepage Message</a></li>
                                            <li class="two-column">
                                                <a class="waves-effect" href="javascript:void(0);" aria-expanded="true">
                                                    <i class="fa fa-map-marker fa-fw" aria-hidden="true"></i><span class="hide-menu">Destinations</span>
                                                </a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="<?php echo e(asset('about/about/33/edit')); ?>" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Mecca</a></li>
                                                    <li><a href="<?php echo e(asset('about/about/34/edit')); ?>" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Medina</a></li>
                                                    <li><a href="<?php echo e(asset('about/about/35/edit')); ?>" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Karbala</a></li>
                                                    <li><a href="<?php echo e(asset('about/about/37/edit')); ?>" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Najaf</a></li>
                                                    <li><a href="<?php echo e(asset('about/about/38/edit')); ?>" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Samarrah</a></li>
                                                    <li><a href="<?php echo e(asset('about/about/39/edit')); ?>" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;kadhmain</a></li>
                                                    <li><a href="<?php echo e(asset('about/about/40/edit')); ?>" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Kufa</a></li>
                                                    <li><a href="<?php echo e(asset('about/about/41/edit')); ?>" >&nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;Damascus</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                                <?php endif; ?>
                                <li>
                                    <a class="waves-effect" href="<?php echo e(url('account-settings')); ?>">
                                        <i class="fa fa-gear fa-fw"></i>
                                        <span class="hide-menu">My Account</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="waves-effect" href="<?php echo e(url('logout')); ?>">
                                        <i class="fa fa-sign-out fa-fw"></i>
                                        <span class="hide-menu">Logout</span>
                                    </a>
                                </li>
                                <?php if(auth()->user()->isAdmin() == true): ?>
                                    <li>
                                        <hr />
                                    </li>

                                    <li class="two-column">
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                    class="icon-equalizer fa-fw"></i> <span class="hide-menu"> UI Elements</span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="<?php echo e(asset('panels-wells')); ?>">Panels and Wells</a></li>
                                            <li><a href="<?php echo e(asset('panel-ui-block')); ?>">Panels With BlockUI</a></li>
                                            <li><a href="<?php echo e(asset('portlet-draggable')); ?>">Draggable Portlet</a></li>
                                            <li><a href="<?php echo e(asset('buttons')); ?>">Buttons</a></li>
                                            <li><a href="<?php echo e(asset('tabs')); ?>">Tabs</a></li>
                                            <li><a href="<?php echo e(asset('modals')); ?>">Modals</a></li>
                                            <li><a href="<?php echo e(asset('progressbars')); ?>">Progress Bars</a></li>
                                            <li><a href="<?php echo e(asset('notification')); ?>">Notifications</a></li>
                                            <li><a href="<?php echo e(asset('carousel')); ?>">Carousel</a></li>
                                            <li><a href="<?php echo e(asset('user-cards')); ?>">User Cards</a></li>
                                            <li><a href="<?php echo e(asset('timeline')); ?>">Timeline</a></li>
                                            <li><a href="<?php echo e(asset('timeline-horizontal')); ?>">Horizontal Timeline</a></li>
                                            <li><a href="<?php echo e(asset('range-slider')); ?>">Range Slider</a></li>
                                            <li><a href="<?php echo e(asset('ribbons')); ?>">Ribbons</a></li>
                                            <li><a href="<?php echo e(asset('steps')); ?>">Steps</a></li>
                                            <li><a href="<?php echo e(asset('session-idle-timeout')); ?>">Session Idle Timeout</a></li>
                                            <li><a href="<?php echo e(asset('session-timeout')); ?>">Session Timeout</a></li>
                                            <li><a href="<?php echo e(asset('bootstrap-ui')); ?>">Bootstrap UI</a></li>
                                        </ul>
                                    </li>
                                    <li class="two-column">
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                    class="icon-docs fa-fw"></i> <span class="hide-menu"> Pages</span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="<?php echo e(asset('starter-page')); ?>">Starter Page</a></li>
                                            <li><a href="<?php echo e(asset('blank')); ?>">Blank Page</a></li>
                                            <li><a href="<?php echo e(asset('search-result')); ?>">Search Result</a></li>
                                            <li><a href="<?php echo e(asset('custom-scroll')); ?>">Custom Scrolls</a></li>
                                            <li><a href="<?php echo e(asset('login')); ?>">Login Page</a></li>
                                            <li><a href="<?php echo e(asset('lock-screen')); ?>">Lock Screen</a></li>
                                            <li><a href="<?php echo e(asset('recoverpw')); ?>">Recover Password</a></li>
                                            <li><a href="<?php echo e(asset('animation')); ?>">Animations</a></li>
                                            <li><a href="<?php echo e(asset('profile')); ?>">Profile</a></li>
                                            <li><a href="<?php echo e(asset('invoice')); ?>">Invoice</a></li>
                                            <li><a href="<?php echo e(asset('gallery')); ?>">Gallery</a></li>
                                            <li><a href="<?php echo e(asset('pricing')); ?>">Pricing</a></li>
                                            <li><a href="<?php echo e(asset('register')); ?>">Register</a></li>
                                            <li><a href="<?php echo e(asset('400')); ?>">Error-400</a></li>
                                            <li><a href="<?php echo e(asset('403')); ?>">Error-403</a></li>
                                            <li><a href="<?php echo e(asset('404')); ?>">Error-404</a></li>
                                            <li><a href="<?php echo e(asset('500')); ?>">Error-500</a></li>
                                            <li><a href="<?php echo e(asset('503')); ?>">Error-503</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-notebook fa-fw"></i> <span class="hide-menu"> Forms </span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="<?php echo e(asset('form-basic')); ?>">Basic Forms</a></li>
                                            <li><a href="<?php echo e(asset('form-layout')); ?>">Form Layout</a></li>
                                            <li><a href="<?php echo e(asset('icheck-control')); ?>">Icheck Control</a></li>
                                            <li><a href="<?php echo e(asset('form-advanced')); ?>">Form Addons</a></li>
                                            <li><a href="<?php echo e(asset('form-upload')); ?>">File Upload</a></li>
                                            <li><a href="<?php echo e(asset('form-dropzone')); ?>">File Dropzone</a></li>
                                            <li><a href="<?php echo e(asset('form-pickers')); ?>">Form-pickers</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-grid fa-fw"></i> <span class="hide-menu"> Tables</span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="<?php echo e(asset('basic-table')); ?>">Basic Tables</a></li>
                                            <li><a href="<?php echo e(asset('table-layouts')); ?>">Table Layouts</a></li>
                                            <li><a href="<?php echo e(asset('data-table')); ?>">Data Table</a></li>
                                            <li><a href="<?php echo e(asset('bootstrap-tables')); ?>">Bootstrap Tables</a></li>
                                            <li><a href="<?php echo e(asset('responsive-tables')); ?>">Responsive Tables</a></li>
                                            <li><a href="<?php echo e(asset('editable-tables')); ?>">Editable Tables</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                                    class="icon-layers fa-fw"></i> <span class="hide-menu"> Extra</span></a>
                                        <ul aria-expanded="false" class="collapse extra">
                                            <li>
                                                <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span class="hide-menu"> Inbox </span></a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="<?php echo e(asset('inbox')); ?>">Mail Box</a></li>
                                                    <li><a href="<?php echo e(asset('inbox-detail')); ?>">Mail Details</a></li>
                                                    <li><a href="<?php echo e(asset('compose')); ?>">Compose Mail</a></li>
                                                    <li><a href="<?php echo e(asset('contact')); ?>">Contact</a></li>
                                                    <li><a href="<?php echo e(asset('contact-detail')); ?>">Contact Detail</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="<?php echo e(asset('calendar')); ?>" aria-expanded="false"><span class="hide-menu">Calendar</span></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo e(asset('widgets')); ?>" aria-expanded="false"><span class="hide-menu"> Widgets</span></a>
                                            </li>
                                            <li>
                                                <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span class="hide-menu"> Charts</span></a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="<?php echo e(asset('morris-chart')); ?>">Morris Chart</a></li>
                                                    <li><a href="<?php echo e(asset('peity-chart')); ?>">Peity Charts</a></li>
                                                    <li><a href="<?php echo e(asset('knob-chart')); ?>">Knob Charts</a></li>
                                                    <li><a href="<?php echo e(asset('sparkline-chart')); ?>">Sparkline charts</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span class="hide-menu"> Icons</span></a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="<?php echo e(asset('simple-line')); ?>">Simple Line</a></li>
                                                    <li><a href="<?php echo e(asset('fontawesome')); ?>">Fontawesome</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span
                                                            class="hide-menu"> Maps</span></a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="<?php echo e(asset('map-google')); ?>">Google Map</a></li>
                                                    <li><a href="<?php echo e(asset('map-vector')); ?>">Vector Map</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                                <?php endif; ?>

                        </ul>
                    </nav>
    </div>
</aside><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/layouts/partials/sidebar.blade.php ENDPATH**/ ?>