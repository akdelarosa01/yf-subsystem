<?php $__env->startSection('title'); ?>
    QC Database | Pricon Microelectronics, Inc.
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $state = ""; $readonly = ""; ?>
    <?php foreach($userProgramAccess as $access): ?>
        <?php if($access->program_code == Config::get('constants.MODULE_CODE_QCDB')): ?>  <!-- Please update "2001" depending on the corresponding program_code -->
            <?php if($access->read_write == "2"): ?>
            <?php $state = "disabled"; $readonly = "readonly"; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <div class="page-content">

        <div class="row">
            <div class="col-md-12">
                <div class="btn-group pull-right">
                    <a href="javascript:;" class="btn green" id="btn_addnew" onclick="javascript:NewInspection();">
                        <i class="fa fa-plus"></i> Add New
                    </a>
                    <button type="button" class="btn blue" id="btn_groupby" onclick="javascript:GroupBy();">
                        <i class="fa fa-group"></i> Group By
                    </button>
                    <button type="button" class="btn red" id="btn_delete" onclick="javascript:DeleteInspection();">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                    <a href="javascript:;" class="btn purple" id="btn_search" onclick="javascript:Search();">
                        <i class="fa fa-search"></i> Search
                    </a>
                    <a href="javascript:;" class="btn yellow-gold" id="btn_report" onclick="javascript:Report();">
                        <i class="fa fa-file-text-o"></i> Reports
                    </a>
                </div>
            </div>
        </div>
        <hr>
        
        <div class="row">
            <div class="col-md-12" id="main_pane">

                <table class="table table-hover table-bordered table-striped" id="tbl_oqc" style="font-size: 11px;">
                    <thead>
                        <tr>
                            <td class="table-checkbox">
                                <input type="checkbox" class="group-checkable" />
                            </td>
                            <td width="5%"></td>
                            <td>FY-WW</td>
                            <td>Date Inspected</td>
                            <td>Device Name</td>
                            <td>From</td>
                            <td>To</td>
                            <td># of Sub</td>
                            <td>Lot Size</td>
                            <td>Sample Size</td>
                            <td>No of Defective</td>
                            <td>Lot No</td>
                            <td>Mode of Defects</td>
                            <td>Qty</td>
                            <td>Judgement</td>
                            <td>Inspector</td>
                            <td>Remarks</td>
                            <td>Type</td>
                        </tr>
                    </thead>
                    <tbody id="tbl_oqc_body">

                    </tbody>
                </table>
            </div>

            <div class="col-md-12" id="group_by_pane"></div>
        </div>

    </div>

    <?php echo $__env->make('includes.oqc_inspection-modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('includes.modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script type="text/javascript">
    var token = "<?php echo e(Session::token()); ?>";
    var author = "<?php echo e(Auth::user()->firstname); ?>";
    var loadSelectInputURL = "<?php echo e(url('/oqc-initiatedata')); ?>";
    var getWorkWeekURL = "<?php echo e(url('/oqc-workweek')); ?>";
    var getPOdetailsURL = "<?php echo e(url('/getpodetails')); ?>";
    var oqcDataTableURL = "<?php echo e(url('/oqc-datatable')); ?>";
    var DeleteInspectionURL = "<?php echo e(url('/oqc-delete-inspection')); ?>";
    var modDataTableURL = "<?php echo e(url('/oqc-mod-datatable')); ?>";
    var DeleteModeOfDefectsURL = "<?php echo e(url('/oqc-delete-mod')); ?>";
    var PDFReportURL = "<?php echo e(url('/oqc-pdf')); ?>";
    var ExcelReportURL = "<?php echo e(url('/oqc-excel')); ?>";
    var GroupByURL = "<?php echo e(url('/oqc-groupby-values')); ?>";
    var GetProbeProductURL = "<?php echo e(url('/getprobeproduct')); ?>";
    var SamplingPlanURL = "<?php echo e(url('/get-sampling-plan')); ?>";
    var getNumOfDefectivesURL  = "<?php echo e(url('/oqc-num-of-defects')); ?>";
    var getShiftURL = "<?php echo e(url('/oqc-shift')); ?>";
    var PDFGroupByReportURL = "<?php echo e(url('/oqc-groupby-pdf')); ?>";
    var ExcelGroupByReportURL = "<?php echo e(url('/oqc-groupby-excel')); ?>";
    var GetSingleGroupByURL = "<?php echo e(url('/oqc-groupby-dppmgroup1')); ?>";
    var GetdoubleGroupByURL = "<?php echo e(url('/oqc-groupby-dppmgroup2')); ?>";
    var GettripleGroupByURL = "<?php echo e(url('/oqc-groupby-dppmgroup3')); ?>";
    var GetdoubleGroupByURLdetails = "<?php echo e(url('/oqc-groupby-dppmgroup2_Details')); ?>";
    var GettripleGroupByURLdetails = "<?php echo e(url('/oqc-groupby-dppmgroup3_Details')); ?>";

    
</script>
<script src="<?php echo e(asset(config('constants.PUBLIC_PATH').'assets/global/scripts/common.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset(config('constants.PUBLIC_PATH').'assets/global/scripts/oqc_inspection.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset(config('constants.PUBLIC_PATH').'assets/global/scripts/oqc_inspection_groupby.js')); ?>" type="text/javascript"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>