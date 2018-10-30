<?php $__env->startSection('title'); ?>
	WBS | Pricon Microelectronics, Inc.
<?php $__env->stopSection(); ?>

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
	<?php $state = ""; $readonly = ""; ?>
	<?php foreach($userProgramAccess as $access): ?>
		<?php if($access->program_code == Config::get('constants.MODULE_CODE_WBS')): ?>  <!-- Please update "2001" depending on the corresponding program_code -->
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
				<?php echo $__env->make('includes.message-block', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<div class="portlet box blue" >
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-navicon"></i>  WBS Local Material Receiving
						</div>
					</div>
        			<div class="portlet-body">
                        <div class="row">
                            <form action="" class="form-horizontal">
                            	<div class="col-md-4">
                            		<div class="form-group">
                            			<label class="control-label col-md-3">Control No.</label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control input-sm" id="loc_info_id" name="loc_info_id"/>
                                            <div class="input-group">
                                                <input type="text" class="form-control input-sm clear" id="controlno" name="controlno">

                                                <span class="input-group-btn">
                                                    <a href="javascript:navigate('first');" id="btn_min" class="btn blue input-sm"><i class="fa fa-fast-backward"></i></a>
                                                    <a href="javascript:navigate('prev');" id="btn_prv" class="btn blue input-sm"><i class="fa fa-backward"></i></a>
                                                    <a href="javascript:navigate('next');" id="btn_nxt" class="btn blue input-sm"><i class="fa fa-forward"></i></a>
                                                    <a href="javascript:navigate('last');" id="btn_max" class="btn blue input-sm"><i class="fa fa-fast-forward"></i></a>
                                                </span>
                                            </div>

                                            
                                        </div>
                            		</div>
                                    <div class="form-group">
                                        <label for="" class="control-label col-sm-3">Invoice No.</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control input-sm clear" id="invoice_no" name="invoice_no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label col-sm-3">Orig. Invoice</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control input-sm clear" id="orig_invoice" name="orig_invoice">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Invoice Date</label>
                                        <div class="col-md-9">
                                            <input class="form-control clear clearinv input-sm date-picker" size="16" type="text" name="invoicedate" id="invoicedate"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Receive Date</label>
                                        <div class="col-md-9">
                                            <input class="form-control clear clearinv input-sm date-picker" size="16" type="text" name="receivingdate" id="receivingdate"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="control-label col-sm-3">Total Qty</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control input-sm clear" id="total" name="total" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                            		<div class="form-group">
                                        <label for="" class="control-label col-sm-3">Created By</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="clear form-control input-sm" id="create_user" name="create_user" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label col-sm-3">Created Date</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="clear form-control input-sm" id="created_at" name="created_at" readonly>
                                        </div>
                                    </div>
                            		<div class="form-group">
                            			<label for="" class="control-label col-sm-3">Updated By</label>
                            			<div class="col-sm-9">
                            				<input type="text" class="clear form-control input-sm" id="update_user" name="update_user" readonly>
                            			</div>
                            		</div>
                        			<div class="form-group">
                            			<label for="" class="control-label col-sm-3">Updated Date</label>
                            			<div class="col-sm-9">
                            				<input type="text" class="clear form-control input-sm" id="updated_at" name="updated_at" readonly>
                            			</div>
                            		</div>
                        		</div>
                            </form>
                        </div>

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <form class="form-horizontal" method="POST" enctype="multipart/form-data" id="uploadbatchfiles" action="<?php echo e(url('/wbsuploadlocmat')); ?>">
                                   <div class="form-group">
                                        <label class="control-label col-sm-3">Upload Batch Items</label>
                                        <div class="col-sm-6">
                                            <?php echo e(csrf_field()); ?>

                                            <input type="file" class="filestyle" data-buttonName="btn-primary" name="localitems" id="localitems" <?php echo e($readonly); ?>>
                                            <?php /* batchfiles */ ?>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit" id="btn_upload" class="btn btn-success" <?php echo($state); ?>>
                                                <i class="fa fa-upload"></i> Upload
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                        	<div class="col-md-12">
                        		<table class="table table-bordered table-fixedheader table-striped" id="tbl_batch" style="font-size:10px;">
                                    <thead id="th_batch">
                                        <tr>
                                            <td class="table-checkbox" width="2.66%">
                                                <input type="checkbox" class="group-checkable"/>
                                            </td>
                                            <td width="4.66%"></td>
                                            <td width="3.66%">ID</td>
                                            <td width="8.66%">Item No.</td>
                                            <td width="16.66%">Item Description</td>
                                            <td width="5.66%">Quantity</td>
                                            <td width="6.66%">Pckg. Category</td>
                                            <td width="5.66%">Pckg. Qty.</td>
                                            <td width="10.66%">Lot No.</td>
                                            <td width="7.66%">Location</td>
                                            <td width="7.66%">Supplier</td>
                                            <td width="6.66%">Exp. Date</td>
                                            <td width="4.66%">Not Reqd</td>
                                            <td width="3.66%">Printed</td>
                                            <td width="4.66%"></td>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_batch_body"></tbody>
                                </table>
                                <input type="hidden" name="save_type" id="save_type">
                        	</div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="button" class="btn btn-sm green" id="btn_addDetails">
                                    <i class="fa fa-plus"></i> Add Batch Item
                                </button>
                                <button type="button" class="btn btn-sm red" id="btn_deleteDetails">
                                    <i class="fa fa-trash"></i> Delete Batch Item
                                </button>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                        	<div class="col-md-12 text-center">
                        		<button type="button" onclick="javascript:addstate();" class="btn btn-sm green" id="btn_add">
									<i class="fa fa-plus"></i> Add
								</button>
								<button type="button" onclick="javascript:editstate();" class="btn btn-sm blue" id="btn_edit">
									<i class="fa fa-pencil"></i> Edit
								</button>
								<button type="button" class="btn btn-sm green" id="btn_save">
									<i class="fa fa-floppy-o"></i> Save
								</button>
								<button type="button" onclick="javascript:getLocalMaterialData();" class="btn btn-sm red" id="btn_back">
									<i class="fa fa-times"></i> Back
								</button>
                                <button type="button" class="btn grey-gallery input-sm" id="btn_print_iqc">
                                    <i class="fa fa-print"></i> Apply to IQC
                                </button>
								<button type="button" class="btn btn-sm green-jungle" id="btn_excel">
									<i class="fa fa-file-excel-o"></i> Export To Excel
								</button>

							</div>
                        </div>
        			</div>
                                
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>



    <?php echo $__env->make('includes.localreceiving-modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('includes.modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script type="text/javascript">
        var savematlocURL = "<?php echo e(url('/savelocamat')); ?>";
        var user = "<?php echo e(Auth::user()->user_id); ?>";
        var datenow = "<?php echo e(date('Y-m-d')); ?>";
        var token = "<?php echo e(Session::token()); ?>";
        var LocalMaterialDataURL = "<?php echo e(url('/wbslocmatgetdata')); ?>";
        var LocalSummaryReport = "<?php echo e(url('/wbslocmatsummaryreport')); ?>";
        var localBarcodeURL = '<?php echo e(url("/wbslocalprintbarcode")); ?>';
        var updateBatchItemURL = "<?php echo e(url('/wbslocupdatebatchitem')); ?>"
        var LocalIQCURL= "<?php echo e(url('/wbslociqc')); ?>";
        var getPackageCategoryURL= "<?php echo e(url('/wbslocpackagecategory')); ?>";
        var DeleteBatchItemURL = "<?php echo e(url('/wbslocaldeletebatchitem')); ?>";
        var getTotalURL = "<?php echo e(url('/wbslocgettotal')); ?>";
    </script>
    <script src="<?php echo e(asset(config('constants.PUBLIC_PATH').'assets/global/scripts/common.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset(config('constants.PUBLIC_PATH').'assets/global/scripts/localreceiving.js')); ?>" type="text/javascript"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>