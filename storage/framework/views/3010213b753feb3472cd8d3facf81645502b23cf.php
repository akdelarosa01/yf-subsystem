<?php $__env->startSection('title'); ?>
	PR Change | Pricon Microelectronics, Inc.
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	<?php echo $__env->make('includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php $state = ""; $readonly = ""; ?>
	<?php foreach($userProgramAccess as $access): ?>
		<?php if($access->program_code == Config::get('constants.MODULE_CODE_PRCHANGE')): ?>  <!-- Please update "2001" depending on the corresponding program_code -->
			<?php if($access->read_write == "2"): ?>
			<?php $state = "disabled"; $readonly = "readonly"; ?>
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>

	
	<div class="page-content">
		
		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<!-- BEGIN EXAMPLE TABLE PORTLET-->
				<?php echo $__env->make('includes.message-block', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-file-o"></i>  PR CHANGE
						</div>
					</div>
					<div class="portlet-body">

						<div class="row">
							<div class="col-md-12">
								<div class="portlet box blue-hoki">
									<div class="portlet-body">
										<div class="row">
											<div class="col-md-12">
												<form method="POST" method="POST" action="<?php echo e(url('/uploadOrigPR')); ?>" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal" id="origPRform" >
													<?php echo e(csrf_field()); ?>


													<div class="form-group">
														<label class="control-label col-md-2">ORIGINAL PR</label>
														<div class="col-md-7">
															<input type="file" class="filestyle" data-buttonName="btn-primary" name="originalpr" id="originalpr" <?php echo e($readonly); ?>>
														</div>
														<div class="col-md-3">
															<button type="submit" id="origpr" class="btn btn-md btn-warning" <?php echo e($state); ?>>
																<i class="fa fa-upload"></i> Upload Original PR
															</button> <!-- type="submit" -->
														</div>
													</div>
												</form>
												<form method="POST" method="POST" action="<?php echo e(url('/uploadChangePR')); ?>" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal" id="changePRform" >
													<?php echo e(csrf_field()); ?>


													<div class="form-group">
														<label class="control-label col-md-2">CHANGE PR</label>
														<div class="col-md-7">
															<input type="file" class="filestyle" data-buttonName="btn-primary" name="changepr" id="changepr" <?php echo e($readonly); ?>>
														</div>
														<div class="col-md-3">
															<button type="submit" id="chpr" class="btn btn-md btn-warning" <?php echo e($state); ?>>
																<i class="fa fa-upload"></i> Upload Extract Change PR
															</button> <!-- type="submit" -->
														</div>
													</div>
												</form>
											</div>
										</div>

										<?php if(Session::has('download')): ?>
											<div class="row">
												<div class="col-md-3 col-md-offset-4">
													<a href="<?php echo e(url('/download-pr-output')); ?>" class="btn btn-success">Download Output File</a>
												</div>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>

						</div>

					</div>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>

	<!-- ORIG PR -->
	
		<div id="opr" class="modal fade" role="dialog" data-backdrop="static">
			<div class="modal-dialog modal-sm gray-gallery">
				<div class="modal-content ">
					<div class="modal-body">
						<p><?php echo e(Session::get('prorig_modal')); ?></p>
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-primary">OK</button>
					</div>
				</div>
			</div>
		</div>
	
		
	<!-- CHANGE PR -->
		<div id="cpr" class="modal fade" role="dialog" data-backdrop="static">
			<div class="modal-dialog modal-sm gray-gallery">
				<div class="modal-content ">
					<div class="modal-body">
						<p><?php echo e(Session::get('prchange_modal')); ?></p>
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-primary">OK</button>
					</div>
				</div>
			</div>
		</div>

	<!-- AJAX LOADER -->
		<div id="loading" class="modal fade" role="dialog" data-backdrop="static">
			<div class="modal-dialog modal-sm gray-gallery">
				<div class="modal-content ">
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-2"></div>
							<div class="col-sm-8">
								<img src="<?php echo e(asset(Config::get('constants.PUBLIC_PATH').'assets/images/ajax-loader.gif')); ?>" class="img-responsive">
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

<?php if(Session::has('prorig_modal')): ?>
	<script src="<?php echo e(asset(Config::get('constants.PUBLIC_PATH').'assets/global/plugins/jquery.min.js')); ?>" type="text/javascript"></script>
	<script type="text/javascript">
		$( document ).ready(function() {
			$('#opr').modal('show');
		});
	</script>
<?php endif; ?>

<?php if(Session::has('prchange_modal')): ?>
	<script src="<?php echo e(asset(Config::get('constants.PUBLIC_PATH').'assets/global/plugins/jquery.min.js')); ?>" type="text/javascript"></script>
	<script type="text/javascript">
		$( document ).ready(function() {
			$('#cpr').modal('show');
		});
	</script>
<?php endif; ?>

	<script src="<?php echo e(asset(Config::get('constants.PUBLIC_PATH').'assets/global/plugins/jquery.min.js')); ?>" type="text/javascript"></script>
	<script type="text/javascript">
		$( document ).ready(function() {
			$('#origPRform').on('submit', function(){
				$('#loading').modal('show');
			});
			$('#changePRform').on('submit', function(){
				$('#loading').modal('show');
			});
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>