<?php
/*******************************************************************************
     Copyright (c) <Company Name> All rights reserved.

     FILE NAME: wbsinventory.blade.php
     MODULE NAME:  [3039] WBS Inventory
     CREATED BY: AK.DELAROSA
     DATE CREATED: 2018.05.29
     REVISION HISTORY :

     VERSION     ROUND    DATE           PIC          DESCRIPTION
     100-00-01   1     2018.05.29     AK.DELAROSA      Initial Draft
*******************************************************************************/
?>



<?php $__env->startSection('title'); ?>
	WBS Inventory | Pricon Microelectronics, Inc.
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<?php $state = ""; $readonly = ""; ?>
	<?php foreach($userProgramAccess as $access): ?>
		<?php if($access->program_code == Config::get('constants.MODULE_WBS_INV')): ?>
			<?php if($access->read_write == "2"): ?>
				<?php $state = "disabled"; $readonly = "readonly"; ?>
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>


	<div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <?php echo $__env->make('includes.message-block', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <div class="portlet box blue" >
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-navicon"></i>  WBS Inventory
                        </div>
                    </div>
                    <div class="portlet-body">

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped" id="tbl_inventory">
                                    <thead>
                                        <tr>
                                            <td>
                                            	<input type="checkbox" name="check_all" class="check_all" id="check_all">
                                            </td>
                                            <td>Receiving Control #</td>
                                            <td>Invoice No.</td>
                                            <td>Item Code</td>
                                            <td>Description</td>
                                            <td>Qty.</td>
                                            <td>Lot No.</td>
                                            <td>Location</td>
                                            <td>Supplier</td>
                                            <td>IQC Status</td>
                                            <td>Received By</td>
                                            <td>Received Date</td>
                                            <td>Exp. Date</td>
                                            <td>Updated By</td>
                                            <td>Last Update</td>
											<td></td>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_inventory_body"></tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                        	<div class="col-md-12 text-center">
                        		<?php /* <button class="btn btn-sm green" id="btn_add">
                        			<i class="fa fa-plus"></i> Add
                        		</button> */ ?>

                        		<button class="btn btn-sm red" id="btn_delete" <?php echo e($state); ?>>
                        			<i class="fa fa-trash"></i> Delete
                        		</button>

                                <button class="btn btn-sm blue" id="btn_clean" <?php echo e($state); ?>>
                                    <i class="fa fa-refresh"></i> Clean Data
                                </button>
                                <a href="<?php echo e(url('/iqc-matrix-excel')); ?>" class="btn btn-sm grey-gallery">
                                    <i class="fa fa-file-excel-o"></i> Export to Excel
                                </a>
                        	</div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

	<?php echo $__env->make('includes.wbsinventory_modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('includes.modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
	<script>
		var token = '<?php echo e(Session::token()); ?>';
        var inventoryListURL = "<?php echo e(url('/wbs-inventory-list')); ?>";
        var deleteselected = "<?php echo e(url('/wbs-inventory-delete')); ?>";
        var cleanDataURL = "<?php echo e(url('/wbs-inventory-clean')); ?>";
	</script>
	<script src="<?php echo e(asset(Config::get('constants.PUBLIC_PATH').'assets/global/scripts/common.js')); ?>" type="text/javascript"></script>
	<script src="<?php echo e(asset(Config::get('constants.PUBLIC_PATH').'assets/global/scripts/wbsinventory.js')); ?>" type="text/javascript"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>