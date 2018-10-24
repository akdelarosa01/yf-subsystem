<?php $__env->startSection('title'); ?>
	Packing List Settings | Pricon Microelectronics, Inc.
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<?php echo $__env->make('includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php $state = ""; $readonly = ""; ?>
	<?php foreach($userProgramAccess as $access): ?>
		<?php if($access->program_code == Config::get('constants.MODULE_CODE_PLSET')): ?>  <!-- Please update "2001" depending on the corresponding program_code -->
			<?php if($access->read_write == "2"): ?>
			<?php $state = "disabled"; $readonly = "readonly"; ?>
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>


	
	<div class="page-content">

		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-sm-12">
				<!-- BEGIN EXAMPLE TABLE PORTLET-->
				<?php echo $__env->make('includes.message-block', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<div class="portlet box blue" >
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-barcode"></i>  Packing List Settings
						</div>
					</div>
					<div class="portlet-body">

						<div class="row">
							<div class="col-md-8 col-md-offset-2 col-sm-12 table-responsive" >
								<table class="table table-striped table-bordered table-hover" id="sample_3">
										<thead>
											<tr>
												<th class="table-checkbox" style="width: 5%">
													<input type="checkbox" class="group-checkable checkAllitems" data-set="#sample_3 .checkboxes"/>
												</th>

												<th></th>
												<th>Assignment</th>
												<th>User</th>
												<th>Product</th>
											</tr>
										</thead>

										<tbody id="tbldetails">
											<?php foreach($tableData as $td): ?>
												<tr>
													<td>
														<input type="checkbox" class="checkboxes" data-id="<?php echo e($td->id); ?>">
													</td>
													<td style="width: 5%">
														<a href="javascript:;" class="btn input-sm blue btn_edit" data-id="<?php echo e($td->id); ?>" data-assign="<?php echo e($td->assign); ?>" data-user="<?php echo e($td->user); ?>" data-prodline="<?php echo e($td->prodline); ?>">
															<i class="fa fa-edit"></i>
														</a>
													</td>
													<td><?php echo e($td->assign); ?></td>
													<td><?php echo e($td->user); ?></td>
													<td><?php echo e($td->prodline); ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>

							</div>
						</div>

						<div class="row">
							<div class="col-md-12 text-center">
								<a href="javascript:;" id="btn_add" class="btn btn-success btn-sm">
									<i class="fa fa-plus-square-o"></i> Add
								</a>
								<a href="javascript:;" class="btn btn-danger btn-sm deleteAll-task" id="btn_delete">
									<i class="fa fa-trash"></i> Delete
								</a>
							</div>
						</div>


					</div>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>



	<!-- Add Modal -->
	<div id="ControlModal" class="modal fade" role="dialog" data-backdrop="static">
		<div class="modal-dialog gray-gallery">
			<div class="modal-content ">
				<div class="modal-header">
					<h4 class="modal-title" id="ctrlTitle"></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							<form method="POST" class="form-horizontal" id="wbsfrmsml">
								<?php echo e(csrf_field()); ?>

								<div class="form-group">
									<div class="col-sm-12">
										<p>
											All fields are required.
										</p>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3">Assignment</label>
									<div class="col-sm-9">
										<input type="hidden" id="id">
										<select  class="form-control input-sm" id="assign" name="assign">
											<option value="preparedby">preparedby</option>
											<option value="checkedby">checkedby</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3">User's Name</label>
									<div class="col-sm-9">
										<input type="text" class="form-control input-sm" id="user" name="user" maxlength="100" >
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3">Product Line</label>
									<div class="col-sm-9">
										<select name="prodline" id="prodline" class="form-control">
											<option value=""></option>
											<option value="CN">CN</option>
											<option value="TS">TS</option>
											<option value="YF">YF</option>
											<option value="PROBE">PROBE</option>
											<option value="MOLDING">MOLDING</option>
										</select>
										<input type="hidden" id="ctrl">
									</div>

								</div>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<a href="javascript: save();" class="btn green">Save</a>
					<button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
				</div>
			</div>
			</form>
		</div>
	</div>
	<!-- End of Add Modal -->


	<!--delete all modal-->
	<div id="deleteAllModal" class="modal fade" role="dialog" data-backdrop="static">
		<div class="modal-dialog modal-sm gray-gallery">
			<div class="modal-content ">
				<div class="modal-header">
					<h4 class="deleteAll-title">Delete Packing List Settings</h4>
				</div>
				<div class="modal-body">
					<div class="row">

						<?php echo csrf_field(); ?>

						<div class="col-sm-12">
							<label for="inputname" class="col-sm-12 control-label text-center">
							Are you sure you want to delete record/s?
							</label>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<a href="javascript: deleteDetails();" class="btn btn-success" id="modaldelete" ><i class="fa fa-save"></i> Yes</a>
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
				</div>
			</div>
		</div>
	</div>

	<!--msg-->
	<div id="msgModal" class="modal fade" role="dialog" data-backdrop="static">
		<div class="modal-dialog modal-sm gray-gallery">
			<div class="modal-content ">
				<div class="modal-header">
					<h4 id="msgtitle" class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<p id="msg"></p>
				</div>
				<div class="modal-footer">
					<a href="<?php echo e(url('/plsetting')); ?>" class="btn btn-danger">Close</a>
				</div>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
	<script type="text/javascript">
		$(function() {
			$('#btn_add').on('click', function() {
				$('#ctrl').val('add');
				$('#ctrlTitle').html('Add Details');
				$('#ControlModal').modal('show');
			});

			$('.btn_edit').on('click', function() {
				var id = $(this).attr('data-id');
				var assign = $(this).attr('data-assign');
				var user = $(this).attr('data-user');
				var prodline = $(this).attr('data-prodline');

				$('#id').val(id);
				$('#assign').val(assign);
				$('#user').val(user);
				$('#prodline').val(prodline);

				$('#ctrl').val('edit');
				$('#ctrlTitle').html('Edit Details');
				$('#ControlModal').modal('show');
			});

			$('#btn_delete').on('click', function() {
				$('#deleteAllModal').modal('show');
			});
		});

		function save() {
			var formURL = "<?php echo e(url('/save-plsetting')); ?>";
			var token = '<?php echo e(Session::token()); ?>';
			var id = $('#id').val();
			var assign = $('#assign').val();
			var user = $('#user').val();
			var ctrl = $('#ctrl').val();
			var prodline = $('#prodline').val();
			var formData = {
				_token : token,
				id : id,
				assign : assign,
				user : user,
				prodline : prodline,
				ctrl : ctrl
			};

			$.ajax({
				url: formURL,
				method: 'POST',
				data:  formData,
			}).done( function(data, textStatus, jqXHR) {
				$('#ControlModal').modal('hide');
				$('#msgtitle').html("<i class='fa fa-exclamation-circle'></i> Success!");
				$('#msg').html(data.msg);
				$('#msgModal').modal('show');
			}).fail( function(data, textStatus, jqXHR) {
				$('#ControlModal').modal('hide');
				$('#msgtitle').html("<i class='fa fa-exclamation-circle'></i> Failed!");
				$('#msg').html("There's an error while proccessing.");
				$('#msgModal').modal('show');
			});
		}

		function deleteDetails() {
			var id = [];
			$(".checkboxes:checked").each(function() {
				id.push($(this).attr('data-id'));
			});

			var formURL = "<?php echo e(url('/delete-plsetting')); ?>";
			var token = '<?php echo e(Session::token()); ?>';
			var formData = {
				_token : token,
				id : id
			};

			$.ajax({
				url: formURL,
				method: 'POST',
				data:  formData,
			}).done( function(data, textStatus, jqXHR) {
				$('#deleteAllModal').modal('hide');
				$('#msgtitle').html("<i class='fa fa-exclamation-circle'></i> Success!");
				$('#msg').html(data.msg);
				$('#msgModal').modal('show');
			}).fail( function(data, textStatus, jqXHR) {
				$('#deleteAllModal').modal('hide');
				$('#msgtitle').html("<i class='fa fa-exclamation-circle'></i> Failed!");
				$('#msg').html("There's an error while proccessing.");
				$('#msgModal').modal('show');
			});
		}

		
	</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>