<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <a class="navbar-toggle font-20 hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse"
           data-target=".navbar-collapse">
            <i class="fa fa-bars"></i>
        </a>
        <div class="top-left-part">
            
                
                    
                
                
                    
                
            
        </div>
        <ul class="nav navbar-top-links navbar-left hidden-xs">
            <?php if(session()->get('theme-layout') != 'fix-header'): ?>
                <li class="sidebar-toggle">
                    <a href="javascript:void(0)" class="sidebartoggler font-20 waves-effect waves-light"><i class="icon-arrow-left-circle"></i></a>
                </li>
            <?php endif; ?>


            <!--<li>
                <form role="search" class="app-search hidden-xs">
                    <i class="icon-magnifier"></i>
                    <input type="text" placeholder="Search..." class="form-control">
                </form>
            </li>-->
        </ul>

            <div class="dashTopHead">
        `       <?php if(auth()->user()->hasrole('SuperAdmin')): ?>
                <div class="col-12">
                    <p>
                        ALZuwar.com -Super Admin
                    </p>
                </div>
                <div class="col-12">
                    <p>
                        Full Access to all management sections
                    </p>
                </div>
                <?php else: ?>
                    <div class="col-12">
                        <p>
                            ALZuwar.com - Service Provider
                        </p>
                    </div>
                    <div class="col-12">
                        <p>
                            Your Free Business Account to provide Services
                        </p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="dashTopImg">
                <img src="<?php echo e(asset('website/img/alziyara_white_background_logo.png')); ?>" style="height: 50px;" alt="home">
            </div>

        <ul class="nav navbar-top-links navbar-right pull-right">
            <!--<li class="dropdown">
                <a class="dropdown-toggle waves-effect waves-light font-20" data-toggle="dropdown"
                   href="javascript:void(0);">
                    <i class="icon-speech"></i>
                    <span class="badge badge-xs badge-danger">6</span>
                </a>
                <ul class="dropdown-menu mailbox animated bounceInDown">
                    <li>
                        <div class="drop-title">You have 4 new messages</div>
                    </li>
                    <li>
                        <div class="message-center">
                            <a href="javascript:void(0);">
                                <div class="user-img">
                                    <img src="<?php echo e(asset('plugins/images/users/1.jpg')); ?>" alt="user" class="img-circle">
                                    <span class="profile-status online pull-right"></span>
                                </div>
                                <div class="mail-contnet">
                                    <h5>Pavan kumar</h5>
                                    <span class="mail-desc">Just see the my admin!</span>
                                    <span class="time">9:30 AM</span>
                                </div>
                            </a>
                            <a href="javascript:void(0);">
                                <div class="user-img">
                                    <img src="<?php echo e(asset('plugins/images/users/2.jpg')); ?>" alt="user" class="img-circle">
                                    <span class="profile-status busy pull-right"></span>
                                </div>
                                <div class="mail-contnet">
                                    <h5>Sonu Nigam</h5>
                                    <span class="mail-desc">I've sung a song! See you at</span>
                                    <span class="time">9:10 AM</span>
                                </div>
                            </a>
                            <a href="javascript:void(0);">
                                <div class="user-img">
                                    <img src="<?php echo e(asset('plugins/images/users/3.jpg')); ?>" alt="user"
                                         class="img-circle"><span class="profile-status away pull-right"></span>
                                </div>
                                <div class="mail-contnet">
                                    <h5>Arijit Sinh</h5>
                                    <span class="mail-desc">I am a singer!</span>
                                    <span class="time">9:08 AM</span>
                                </div>
                            </a>
                            <a href="javascript:void(0);">
                                <div class="user-img">
                                    <img src="<?php echo e(asset('plugins/images/users/4.jpg')); ?>" alt="user" class="img-circle">
                                    <span class="profile-status offline pull-right"></span>
                                </div>
                                <div class="mail-contnet">
                                    <h5>Pavan kumar</h5>
                                    <span class="mail-desc">Just see the my admin!</span>
                                    <span class="time">9:02 AM</span>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <a class="text-center" href="javascript:void(0);">
                            <strong>See all notifications</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>-->
            <!--<li class="dropdown">
                <a class="dropdown-toggle waves-effect waves-light font-20" data-toggle="dropdown"
                   href="javascript:void(0);">
                    <i class="icon-calender"></i>
                    <span class="badge badge-xs badge-danger">3</span>
                </a>
                <ul class="dropdown-menu dropdown-tasks animated slideInUp">
                    <li>
                        <a href="javascript:void(0);">
                            <div>
                                <p>
                                    <strong>Task 1</strong>
                                    <span class="pull-right text-muted">40% Complete</span>
                                </p>
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                        <span class="sr-only">40% Complete (success)</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0);">
                            <div>
                                <p>
                                    <strong>Task 2</strong>
                                    <span class="pull-right text-muted">20% Complete</span>
                                </p>
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                        <span class="sr-only">20% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0);">
                            <div>
                                <p>
                                    <strong>Task 3</strong>
                                    <span class="pull-right text-muted">60% Complete</span>
                                </p>
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                        <span class="sr-only">60% Complete (warning)</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0);">
                            <div>
                                <p>
                                    <strong>Task 4</strong>
                                    <span class="pull-right text-muted">80% Complete</span>
                                </p>
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                        <span class="sr-only">80% Complete (danger)</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="javascript:void(0);">
                            <strong>See All Tasks</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>-->
            <li class="right-side-toggle">
                <a class="right-side-toggler waves-effect waves-light b-r-0 font-20" href="javascript:void(0)">
                    <i class="icon-settings"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>
<?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/layouts/partials/navbar.blade.php ENDPATH**/ ?>