<?php $__env->startSection('title'); ?>
	MRA | Pricon Microelectronics, Inc.
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
	<?php /* <link rel="stylesheet" type="text/css" href="<?php echo e(asset(Config::get('constants.PUBLIC_PATH').'assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css')); ?>"/> */ ?>
	<?php /* <style type="text/css">
		.highlight { background-color: red; color: "#000000";}
	</style> */ ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	
	<?php echo $__env->make('includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php ini_set('max_input_vars', 999999);?>
	<?php $state = ""; $readonly = ""; ?>
	<?php foreach($userProgramAccess as $access): ?>
		<?php if($access->program_code == Config::get('constants.MODULE_CODE_MRA')): ?>  <!-- Please update "2001" depending on the corresponding program_code -->
			<?php if($access->read_write == "2"): ?>
			<?php $state = "disabled"; $readonly = "readonly"; ?>
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
	
	<div class="page-content">
		
		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN EXAMPLE TABLE PORTLET-->
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-bar-chart-o"></i> MATERIAL REQUIREMENTS ANALYSIS (MRA)
						</div>
					</div>
					<div class="portlet-body portlet-empty">
						<dv class="row">
							<div class="col-md-12">
								<a href="javascript:;" class="btn green" id="btn_generate">Generate Material Requirements</a>
								<span class="pull-right" style="color:#cb5a5e">Note: Data will load at least 3-10 minutes.</span >
							</div>
						</dv>
						<br>
						<div class="row">
							<div class="col-md-12">
								<div class="scroller" data-rail-visible="1" style="height: 500px">
									<table class="table table-striped table-bordered table-hover order-column tbl_scroll" style="font-size: 11px"><!-- id="sample_3"  -->
										<thead>
											<tr>
												<td>
													ITEM CODE
												</td>
												<td width="20%">
													ITEM NAME
												</td>
												<td>
													BUNR
												</td>
												<td>
													TOTAL REQUIRED
												</td>
												<td>
													TOTAL COMPLETED
												</td>
												<td>
													REQ TO COMPLETE
												</td>
												<td>
													WHS100
												</td>
												<td>
													WHS102
												</td>
												<td>
													WHSNON
												</td>
												<td>
													ASSY100
												</td>
												<td>
													ASSY102
												</td>
												<td>
													WHSSM
												</td>
												<td>
													TOTAL ON HAND
												</td>
												<td>
													ORDER BALANCE
												</td>
												<td>
													FOR ORDERING
												</td>
												<td>
													MAINBUMO
												</td>
											</tr>
										</thead>
										<tbody id="tblMra">
											
										</tbody>
									</table>
									
									<?php /* <div class="row" id="loading" style="display: none">
										<div class="col-sm-6"></div>
										<div class="col-sm-6">
											<img src="<?php echo e(seet(Config::get('constants.PUBLIC_PATH').'assets/global/img/loading-spinner-blue.gif')); ?>" class="img-responsive">
										</div>
									</div> */ ?>

								</div>
								<span id="count"></span>
							</div>
						</div>
						
						<br/>
						<div class="row">
							<div class="col-md-12">
								<?php /* <form method="GET" action="<?php echo e(url('/mraPrint')); ?>"> */ ?>
									<a href="<?php echo e(url('/mraPrint')); ?>" id="btn_excel" class="btn green input-sm pull-right">
										<i class="fa fa-file-excel-o"></i> Export To Excel
									</a>
								<?php /* </form> */ ?>
								
							</div>
						</div>


					</div>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
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
	<!-- AJAX LOADER -->
    <div id="loading" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-sm gray-gallery">
            <div class="modal-content ">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <img src="<?php echo e(asset(Config::get('constants.PUBLIC_PATH').'assets/images/ajax-loader.gif')); ?>" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
	<?php /* <script type="text/javascript" src="<?php echo e(asset(Config::get('constants.PUBLIC_PATH').'assets/admin/pages/scripts/table-datatables-scroller.js')); ?>"></script> */ ?>
	<script>
		var token = '<?php echo e(Session::token()); ?>';
		var urlgeneratemra = '<?php echo e(url('/generatemra')); ?>';
		var urlmraload = "<?php echo e(url('/mraload')); ?>";

		
	</script>
	<script src="<?php echo e(asset(Config::get('constants.PUBLIC_PATH').'assets/global/scripts/mra.js')); ?>" type="text/javascript"></script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>