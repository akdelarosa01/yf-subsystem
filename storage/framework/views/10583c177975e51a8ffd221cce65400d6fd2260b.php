<?php $__env->startSection('title'); ?>
	User Master | Pricon Microelectronics, Inc.
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php $state = ""; $readonly = ""; ?>
	<?php foreach($userProgramAccess as $access): ?>
		<?php if($access->program_code == Config::get('constants.MODULE_CODE_USERS')): ?>
			<?php if($access->read_write == "2"): ?>
				<?php $state = "disabled"; $readonly = "readonly"; ?>
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
	
	<div class="page-content">
		
		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12">
				<?php echo $__env->make('includes.message-block', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<!-- BEGIN EXAMPLE TABLE PORTLET-->
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-users"></i> USER MASTER
						</div>
					</div>
					<div class="portlet-body">

						<?php /* <div class="row">
							<div class="col-md-8">
								<h3 class="pull-left">SEARCH</h3>
							</div>
							<div class="col-md-4">
								<a href="<?php echo e(url('/getexcel')); ?>" class="btn btn-warning pull-right"><i class="fa fa-users"></i> MRP USER</a>
							</div>
						</div> */ ?>
						<div class="row">
							
							<div class="col-md-offset-1 col-md-10">
								<table class="table table-striped table-bordered table-hover" id="sample_3">

									<thead>
										<tr>
											<td class="table-checkbox">
												<input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes"/>
											</td>
											<td>User ID</td>
											<td>Last Name</td>
											<td>First Name</td>
											<td>Middle Name</td>
											<td>Product Line</td>
											<td>Last Date Logged In</td>
											<td width="15%">Actions</td>
										</tr>
									</thead>

									<tbody>
										<?php foreach($users as $user): ?>
											<tr class="odd gradeX" data-id="<?php echo e($user->id); ?>">
												<td>
													<input type="checkbox" class="checkboxes" id="check_id" name="check_id[]" value="<?php echo e($user->id); ?>" data-userid="<?php echo e($user->user_id); ?>" data-lname="<?php echo e($user->lastname); ?>" data-fname="<?php echo e($user->firstname); ?>" data-mname="<?php echo e($user->middlename); ?>" data-pword="<?php echo e($user->actual_password); ?>" data-locked="<?php echo e($user->locked); ?>"/>
													<?php echo csrf_field(); ?>

												</td>
												
												<td>
													<a href="<?php echo e(url('/usermaster/'.$user->id)); ?>"><?php echo e($user->user_id); ?></a>
													<input type="hidden" name="user_id[]" value="<?php echo e($user->user_id); ?>" />
												</td>
												<td>
													<?php echo e($user->lastname); ?>

													<input type="hidden" name="lastname[]" value="<?php echo e($user->lastname); ?>" />
												</td>
												<td>
													<?php echo e($user->firstname); ?>

													<input type="hidden" name="firstname[]" value="<?php echo e($user->firstname); ?>" />
												</td>
												<td>
													<?php echo e($user->middlename); ?>

													<input type="hidden" name="middlename[]" value="<?php echo e($user->middlename); ?>" />
												</td>
												<td>
													<?php echo e($user->productline); ?>

													<input type="hidden" name="productline[]" value="<?php echo e($user->productline); ?>" />
												</td>
												<td>
													<?php echo e($user->last_date_loggedin); ?>

												</td>
												<td>
													<?php if(Auth::user()->user_id != $user->user_id): ?>
														<a href="<?php echo e(url('/usermaster/'.$user->id)); ?>" class="btn btn-sm blue" <?php echo($state);?>>
															<i class="fa fa-edit"></i>
														</a>
														<a href="javascript:;" class="btn btn-sm red btn_delete" data-id="<?php echo e($user->id); ?>" <?php echo($state);?>>
															<i class="fa fa-trash"></i>
														</a>
													<?php endif; ?>
												</td>
											</tr>
										<?php endforeach; ?>
										
									</tbody>
								</table>
							</div>
							
						</div>

						<br/>

						<div class="row">
							<div class="col-md-12 text-center">
								<a href="<?php echo e(url('usermaster/create')); ?>" class="btn btn-success btn-sm" <?php echo($state); ?> id="btn_add" ><i class="fa fa-plus-square-o"></i> ADD</a>
							</div>
						</div>

					</div>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>

	<div id="confirm" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm gray-gallery">
			<form role="form" action="" id="form_del" method="post">
				<div class="modal-content ">
					<div class="modal-body">
						<p>Are you sure you want to delete this user?</p>
						<?php echo csrf_field(); ?>

						<input type="hidden" name="id"/>
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-primary btn-sm" id="delete_now">Delete</a>
						<button type="button" data-dismiss="modal" class="btn red btn-sm">Cancel</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<!--msg-->
    <div id="msg" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-sm gray-gallery">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 id="title" class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <p id="err_msg"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--msg_success-->
    <div id="msg_success" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-sm gray-gallery">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 id="success_title" class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <p id="success_msg"></p>
                </div>
                <div class="modal-footer">
                    <?php /* <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button> */ ?>
                    <a href="<?php echo e(url('/usermaster')); ?>" class="btn btn-success" id="success_done">Done</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
	<script type="text/javascript">
		$('.btn_delete').on('click', function() {
			var id = $(this).attr('data-id');
			var action = '<?php echo e(url("/destory")); ?>'+'/'+id;
			$('#confirm').modal('show');
			$('input[name="id"]').val(id);
			$('#form_del').attr('action', action);
		});

		$('#delete_now').on('click', function() {
			var id = $('input[name="id"]').val();
			var url = '<?php echo e(url("/destory")); ?>'+'/'+id;
            var token = "<?php echo e(Session::token()); ?>";

            var data = {
                _token: token,
                id: id,
            };

        	$.ajax({
                url: url,
                type: "POST",
                data: data,
            }).done( function(data, textStatus, jqXHR) {
            	if (data.status == 'success') {
            		$('#success_title').html('<strong><i class="fa fa-check"></i></strong> Success!')
					$('#success_msg').html(data.msg);
					$('#msg_success').modal('show');
            	} else {
            		$('#msg').modal('show');
	                $('#title').html('<strong><i class="fa fa-exclamation-triangle"></i></strong> Failed!')
	                $('#err_msg').html(data.msg);
	                $('#confirm').modal('hide');
            	}
				
            }).fail( function(data, textStatus, jqXHR) {
                $('#msg').modal('show');
                $('#title').html('<strong><i class="fa fa-exclamation-triangle"></i></strong> Failed!')
                $('#err_msg').html("There's some error while processing.");
            });
		});
	</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>