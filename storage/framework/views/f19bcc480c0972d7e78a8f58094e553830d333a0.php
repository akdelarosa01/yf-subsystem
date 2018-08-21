<?php
/*******************************************************************************
     Copyright (c) <Company Name> All rights reserved.

     FILE NAME: OrderDataReport.blade.php
     MODULE NAME:  [3002] Order Data Report
     CREATED BY: MESPINOSA
     DATE CREATED: 2016.04.18
     REVISION HISTORY :

     VERSION     ROUND    DATE           PIC          DESCRIPTION
     100-00-01   1     2016.04.18     MESPINOSA       Initial Draft
     100-00-02   2     2016.10.27     AKDELAROSA      FIX BUGS
*******************************************************************************/
?>



<?php $__env->startSection('title'); ?>
Order Data Report | Pricon Microelectronics, Inc.
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script type="text/javascript">

	

</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('css'); ?>
	<style type="text/css">
        table.table-fixedheader {
            width: 100%;   
        }
        table.table-fixedheader, table.table-fixedheader>thead, table.table-fixedheader>tbody, table.table-fixedheader>thead>tr, table.table-fixedheader>tbody>tr, table.table-fixedheader>thead>tr>td, table.table-fixedheader>tbody>td {
            display: block;
        }
        table.table-fixedheader>thead>tr:after, table.table-fixedheader>tbody>tr:after {
            content:' ';
            display: block;
            visibility: hidden;
            clear: both;
        }
        table.table-fixedheader>tbody {
            overflow-y: scroll;
            height: 200px;
        }
        table.table-fixedheader>thead {
            overflow-y: scroll;
        }
        table.table-fixedheader>thead::-webkit-scrollbar {
            background-color: inherit;
        }

        table.table-fixedheader>thead>tr>td:after, table.table-fixedheader>tbody>tr>td:after {
            content:' ';
            display: table-cell;
            visibility: hidden;
            clear: both;
        }

        table.table-fixedheader>thead tr td, table.table-fixedheader>tbody tr td {
            float: left;    
            word-wrap:break-word;
            height: 40px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php $state = ""; $enabled=""; ?>
	<?php foreach($userProgramAccess as $access): ?>
		<?php if($access->program_code == Config::get('constants.MODULE_CODE_YPICS')): ?>
			<?php if($access->read_write == "2"): ?>
				<?php $state = "disabled"; $enabled="enabled" ?>
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>


	<div class="page-content">
		<div class="row">
			<div class="col-md-12">
				<?php echo $__env->make('includes.message-block', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-area-chart"></i>  YPICS R3 Order Data
						</div>
					</div>
					<div class="portlet-body">
						<div class="row">
							<div class="col-md-12">
								<form class="form-horizontal" role="form" method="POST" id="ypicsr3Form" action="<?php echo e(url('/ypicsr3/connect-orderdatareport')); ?>" >
									<?php echo csrf_field(); ?>

									<div class="row">
										<div class="col-md-12">
											<button type="button" onclick="javascript: actionStartStop('START'); " class="btn btn-success btn-sm" <?php echo($state); ?> >
												<i class="fa fa-play"></i> START USING YPICS
											</button>
											<button type="button" onclick="javascript: actionStartStop('STOP'); " class="btn btn-danger btn-sm" <?php echo($state); ?> >
												<i class="fa fa-stop"></i> STOP USING YPICS
											</button>
											<button type="button" id="btn_ypicsuser" class="btn grey-gallery pull-right btn-sm">
												<i class="fa fa-users"></i> YPICS USER
											</button>
										</div>
									</div>
									<hr/>

									<div class="row">
										<div class="col-md-4">
											<table class="table table-bordered">
												<thead>
													<tr style="color: #d6f5f3;background-color: #0ba8e2;">
														<td>Supplier Record</td>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															<?php
																if (Session::has('selected_supplier')){
																	$selected_supplier = Session::get('selected_supplier');
																}
															?>
															<select id="ddsupplier" name="supplier" class="form-control input-sm">
																<option selected="selected">-- Select --</option>
																	<?php foreach($suppliers as $supplier): ?>
																		<option value="<?php echo e($supplier->name); ?>" 
																		<?php if($selected_supplier == $supplier->name)
																		{
																			echo 'selected';
																		}
																		?> 
																		><?php echo e($supplier->name); ?></option>
																	<?php endforeach; ?>
																		<?php /* $supplier->code for value */ ?>
															</select>
														</td>
													</tr>
												</tbody>
											</table>
										</div>

										<div class="col-md-4">
											<table class="table table-bordered">
												<thead>
													<tr style="color: #d6f5f3;background-color: #0ba8e2;">
														<td>Product Line</td>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															<?php
																if (Session::has('dbconnection')){
																	$dbconnection = Session::get('dbconnection');
																}
															?>
															<select id="ddproductline" name="productline" class="form-control input-sm">
																<option selected="selected" value="0">-- Select --</option>
																<?php foreach($productlines as $productline): ?>
																	<option value="<?php echo e($productline->code); ?>" 
																	<?php if($dbconnection == $productline->code)
																	{
																		echo 'selected';
																	}
																	?> 
																	><?php echo e($productline->name); ?></option>
																<?php endforeach; ?>
															</select>
														</td>
													</tr>
												</tbody>
											</table>
										</div>

										<div class="col-md-4">
											<table class="table table-bordered">
												<thead>
													<tr style="color: #d6f5f3;background-color: #0ba8e2;">
														<td>Status</td>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															<div class="row">
																<div class="col-md-12">
																	<div class="pull-left" id="itemcount">
																		0 of 0
																	</div>
																	<div class="pull-right" id="percentage">
																		Percentage: 0%
																	</div>
																</div>
															</div>

															<br />

															<div class="row">
																<div class="col-md-12">

																	<div class="progress progress-striped active" id="progress_div">
																		<div class="progress-bar progress-bar-success" id='bar1'></div>
																		<div class='percent' id='percent1'></div>
																	</div>
																	<input type="hidden" id="progress_width" value="0">

																</div>
															</div>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>

									<div class="row">
										<div class="col-md-offset-2 col-md-3">
											<button type="submit" class="btn btn-warning btn-sm" ><i class="fa fa-refresh"></i> BU1(CN)</button>
										</div>
										<div class="col-md-3">
											<button type="submit" class="btn btn-warning btn-sm" ><i class="fa fa-refresh"></i> BU2(TS)</button>
										</div>
										<div class="col-md-3">
											<button type="submit" class="btn btn-warning btn-sm" ><i class="fa fa-refresh"></i> CONNECTORS(YF)</button>
										</div>
											<input type="text" id="action" placeholder="Id" name="dbconnect" hidden="true" value="<?php echo e(Auth::user()->productline); ?>">
									</div>

									<hr/>
								</form>
							</div>
						</div>


						<div class="row">
							<div class="col-md-12">
								<table class="table table-striped table-bordered table-hover" id="tbl_ypicsr3" style="font-size:10px;">
									<thead>
										<tr style="color: #d6f5f3;background-color: #0ba8e2;">
											<td colspan="19">Summary List</td>
										</tr>
										<tr>
											<td style="width:2.2%">SALES NO</td>
											<td style="width:5.2%">SALES TYPE</td>
											<td style="width:5.2%">SALES ORG</td>
											<td style="width:5.2%">COMMERCIAL</td>
											<td style="width:5.2%">SECTION</td>
											<td style="width:5.2%">SALES BRAND</td>
											<td style="width:5.2%">SALESG</td>
											<td style="width:5.2%">SUPPLIER</td>
											<td style="width:5.2%">DESTINATION</td>
											<td style="width:5.2%">PAYER</td>
											<td style="width:5.2%">ASSISTANT</td>
											<td style="width:7.2%">PURCHASE ORDER NO</td>
											<td style="width:5.2%">ISSUEDATE</td>
											<td style="width:5.2%">FLIGHTDATE</td>
											<td style="width:3.2%">HEADERTEXT</td>
											<td style="width:5.2%">CODE</td>
											<td style="width:8.2%">ITEMTEXT</td>
											<td style="width:5.2%">ORDERQUANTITY</td>
											<td style="width:5.2%">UNIT</td>
										</tr>
									</thead>

									<tbody></tbody>
								</table>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	

	<?php echo $__env->make('includes.ypicsr3-modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('includes.modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php if(Session::has('msg') && Session::get('msg') == 0): ?>
		<script src="<?php echo e(asset(Config::get('constants.PUBLIC_PATH').'assets/global/plugins/jquery.min.js')); ?>" type="text/javascript"></script>
		<script type="text/javascript">
			$( document ).ready(function() {
				$('#loading').modal('hide');
				$('#msgbox').modal('show');
			});
		</script>
	<?php endif; ?>

	<?php if(Session::has('msg') && Session::get('msg') > 0): ?>
		<script src="<?php echo e(asset(Config::get('constants.PUBLIC_PATH').'assets/global/plugins/jquery.min.js')); ?>" type="text/javascript"></script>
		<script type="text/javascript">
			$( document ).ready(function() {
				$('#loading').modal('hide');
				$('#success').modal('show');
			});
		</script>
	<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
	<script type="text/javascript">
		var YpicsUserURL = "<?php echo e(url('/ypicsr3/ypics-user-data')); ?>";
		var StartStopURL = "<?php echo e(url('/ypicsr3/mrpusers-orderdatareport')); ?>";
		var YpicsR3DataURL = "<?php echo e(url('/ypicsr3/ypicsr3datatable')); ?>";
	</script>
	<script src="<?php echo e(asset(config('constants.PUBLIC_PATH').'assets/global/scripts/common.js')); ?>" type="text/javascript"></script>
	<script src="<?php echo e(asset(config('constants.PUBLIC_PATH').'assets/global/scripts/ypicsr3.js')); ?>" type="text/javascript"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>