<?php $__env->startPush('css'); ?>
<link href="<?php echo e(asset('plugins/components/datatables/jquery.dataTables.min.css')); ?>" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('plugins/components/dashboard/css/customstyle.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('css/customCss.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- .row -->

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <?php
                    $route = Request::segments();
                ?>
                    
                    <?php if($route[0] == 'service-provider-request'): ?>
                        <h3 class="box-title pull-left">Manage Users – Service Providers Account Activations</h3>
                            <?php else: ?>
                        <h3 class="box-title pull-left">Manage Users – All Users</h3>
                    <?php endif; ?>
                
                <div class="clearfix"></div>
                <hr>
                <div class="table-responsive">

                    <div class="container">
                        <table class="table table-hover table-condensed" id="myTable">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Register Date</th>
                                    <th>Name, Email , Phone</th>
                                    <th>Company Name</th>
                                    <th>Role</th>
                                    <th>Email Confirmed?</th>
                                    <th>Status, Actions</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $allusers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+1); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($user->created_at??'' )->toFormattedDateString()); ?></td>
                                    <td><?php echo e($user->name??''); ?><br><?php echo e($user->email??''); ?><br><?php echo e($user->profile->phone??''); ?></td>
                                    <td><?php echo e($user->profile->company_name??''); ?></td>
                                    <td><?php echo $user->roles()->pluck('name')->implode('<br> ')??''; ?></td>
                                    <?php if($user->email_verify_status == 1): ?>
                                    <td class="text-success">Confirmed</td>
                                    <?php else: ?>
                                    <td class="text-warning">Pending</td>
                                    <?php endif; ?>
                                    <?php if($user->status == 1): ?>
                                    <td class="text-center">Active
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                Change User Status
                                            </button>
                                            <div class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" onclick="userstatus(<?php echo e($user->id); ?>,'active')">ACTIVE</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" onclick="userstatus(<?php echo e($user->id); ?>,'notactive')">NOT ACTIVE</a>
                                                </li>
                                            </div>
                                        </div>
                                    </td>
                                    <?php else: ?>
                                    <td class="text-danger text-center">Not Active
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                Change User Status
                                            </button>
                                            <div class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" onclick="userstatus(<?php echo e($user->id); ?>,'active')">ACTIVE</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" onclick="userstatus(<?php echo e($user->id); ?>,'notactive')">NOT ACTIVE</a>
                                                </li>
                                            </div>
                                        </div>
                                    </td>
                                    <?php endif; ?>
                                    
                                    <td><a href="<?php echo e(url('user/edit/'.$user->id)); ?>"><i class="icon-pencil"></i> Edit</a></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('layouts.partials.right-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('plugins/components/toast-master/js/jquery.toast.js')); ?>"></script>


<script>
    $(document).ready(function() {
            var table = $('#myTable').DataTable({
                aLengthMenu: [
                    [15,25, 50,100,500, -1],
                    [15,25, 50,100,500,"All"]
                ],
                iDisplayLength:100,
                stateSave: true,
                order: [0, 'asc']

            });

    });
    $(document).ready(function() {
        $(document).on('click', '.delete', function(e) {
            if (confirm('Are you sure want to delete?')) {} else {
                return false;
            }
        });
        <?php if(\Session::has('message')): ?>
        $.toast({   
            heading: 'Success!',
            position: 'top-center',
            text: '<?php echo e(session()->get('
            message ')); ?>',
            loaderBg: '#ff6849',
            icon: 'success',
            hideAfter: 3000,
            stack: 6
        });

        <?php endif; ?>
    })
    $(document).ready(function() {
        $('#example').DataTable();
    });

    function userstatus(id, status) {
        swal({
                title: "Are you sure?",
                text: "Do you really want to change the status!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.get('<?php echo e(URL::to("userstatus")); ?>/' + id + '/' + status, function(data) {
                        window.location.reload();
                    });
                    swal("Your user status has been updated!", {
                        icon: "success",

                    });
                } else {
                    swal("Your user status has not changed!");
                }
            });
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/superadminviews/allusers.blade.php ENDPATH**/ ?>