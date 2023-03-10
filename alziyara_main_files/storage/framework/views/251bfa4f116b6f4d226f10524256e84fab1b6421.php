<?php $__env->startPush('css'); ?>
<link href="<?php echo e(asset('css/customCss.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('css/responsive.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>



<?php $__env->startSection('content'); ?>



	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">



	<?php if($errors->any()): ?>

		<div class="alert alert-danger">

			<ul>

				<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

					<li><?php echo e($error); ?></li>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			</ul>

		</div>

	<?php endif; ?>





	<?php if(session('message')): ?>

		<!-- <div class="account-title"><?php echo e(session('message')); ?></div> -->

		<div class="account-title">



			<p class="alert alert-success"><?php echo e(session('message')); ?></p>



		</div>

	<?php endif; ?>





	<div class="container-fluid">

		<!-- .row -->

		<div class="row">

			<div class="col-sm-12">

				<div class="white-box">
					<h3 class="box-title pull-left">Settings - View Rooms in <?php echo e($room[0]->gethotelrooms->Name??''); ?></h3>
					<a class="btn btn-success pull-right" href="<?php echo e(URL('myhotels')); ?>">View All Hotels</a>
					<div class="pull-right">
					</div>
					<div class="clearfix"></div>
					<hr>
				

				<!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->

					<table id="myTable" class="table table-striped" style="width:100%">

						<thead>

						<tr>

							<th>S.No</th>

							<th>Room Image</th>

							

							<th>Room Name</th>

							<th>Room Type</th>

							<th>Room Status</th>

							<th>Price</th>

							<th>Action</th>

							<th>Edit</th>

						</tr>

						</thead>

						<tbody>

                        <?php $i = 1; ?>

						<?php $__currentLoopData = $room; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $myroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

							<?php if($myroom->gethotelrooms != null): ?>

								<tr>

									<td><?php echo e($i++); ?></td>


									<td>
										<img style="height: 80px; width: 80px; object-fit: cover;"	src="<?php echo e(asset('website').'/'.$myroom->RoomImage); ?>">
									</td>
									

									<td><?php echo e($myroom->RoomName); ?></td>

									<td><?php echo e($myroom->RoomType); ?></td>

									<td><?php echo e($myroom->RoomStatus); ?></td>

									<td>$ <?php echo number_format($myroom->Price??0, 2); ?></td>

									<td>
										<div class="dropdown">
											<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
												Change Status
											</button>
											<div class="dropdown-menu">
												<li>
													<a class="dropdown-item" onclick="roomstatus(<?php echo e($myroom->id); ?>,'active')">READY</a>
												</li>
												<li>
													<a class="dropdown-item" onclick="roomstatus(<?php echo e($myroom->id); ?>,'notactive')">NOT READY</a>
												</li>
											</div>
										</div>
									</td>
									<td>
										<a type="button" href="<?php echo e(route('myeditrooms',$myroom->id)); ?>" class="btn btn-warning btn-s add-tooltip"><i class="fa fa-pencil "></i></a></td>

								</tr>

							<?php endif; ?>

						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						</tbody>

					</table>

				</div>

			</div>

		</div>


		<!-- ===== Right-Sidebar ===== -->

		<?php echo $__env->make('layouts.partials.right-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	</div>

<?php $__env->stopSection(); ?>



<?php $__env->startPush('js'); ?>



<script>
    $('#myTable').DataTable();
    function roomstatus(id, status) {
        swal({
            title: "Are you sure?",
            text: "Do you really want to change the status!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.get("<?php echo e(url('roomstatus')); ?>"+'/'+id+'/'+status,function(data){
//                    console.log(data);
                    window.location.reload();
                });
                swal("Your Room status has been updated!", {
                    icon: "success",
                });
            } else {
                swal("Your Room status has not changed!");
            }
        });
    }
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/hotelsviews/myallrooms.blade.php ENDPATH**/ ?>