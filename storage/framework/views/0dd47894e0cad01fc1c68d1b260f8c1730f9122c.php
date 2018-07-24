<?php $__env->startSection('title'); ?>
    Home | Pricon Microelectronics, Inc.
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    
    <div class="page-content">
        
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box grey-gallery">
                    <div class="portlet-title">
                        <div class="caption">
                            YPICS SUBSYSTEM
                        </div>
                    </div>
                    <div class="portlet-body blue">
                        <p style="color:#fff;">
                            <strong>DISCLAIMER :</strong> Information appearing on PMI YPICS Sub System intranet application are copyrighted by Pricon Microelectronics, Inc. (PMI). Permission to reprint or electronically reproduce any document or graphic in part or in its entirely for any reason other than personal use is expressly prohibited, unless prior written consent is obtained from PMI staff and the proper entities.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-comments"></i> NOTIFICATIONS
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_3" style="font-size:10px;">

                            <thead>
                                <tr>
                                    <td width="20%">
                                        ITEM CODE
                                    </td>
                                    <td>
                                        ITEM NAME
                                    </td>
                                    <td width="20%">
                                        FOR ORDERING
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($datas as $data): ?>
                                <tr>
                                    <td><?php echo e($data->itemcode); ?></td>
                                    <td><?php echo e($data->itemname); ?></td>
                                    <td><?php echo e($data->forordering); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script type="text/javascript">
        // $('#inventory').DataTable({
        //     'bDestroy': true,
        //     'processing': true,
        //     'serverSide': true,
        //     'ajax': '/home/list',
        //     'columns': [
        //         {data: 'itemcode'},
        //         {data: 'itemname'},
        //         {data: 'forordering'}
        //     ]
        // });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>