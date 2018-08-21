<?php $__env->startSection('title'); ?>
	YPICS Invoicing | Pricon Microelectronics, Inc.
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
	<style>
		div.dataTable_wrapper {
			width: 800px;
			margin: 0 auto;
		}
	</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

	<?php echo $__env->make('includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php $state = ""; $readonly = ""; ?>
	<?php foreach($userProgramAccess as $access): ?>
		<?php if($access->program_code == Config::get('constants.MODULE_CODE_INVCING')): ?>  <!-- Please update "2001" depending on the corresponding program_code -->
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
							<i class="fa fa-file-text"></i>  YPICS Invoicing
						</div>
					</div>
					<div class="portlet-body">

						<div class="row">

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

								<div class="tabbable-custom">
                                    <ul class="nav nav-tabs nav-tabs-lg" id="tabslist" role="tablist">
                                        <li class="active" id="pakinglist_tab">
                                            <a href="#packinglist_pane" data-toggle="tab" data-toggle="tab" aria-expanded="true">Packing List</a>
                                        </li>
                                        <li id="invoice_tab">
                                            <a href="#invoice_pane" data-toggle="tab" data-toggle="tab" aria-expanded="true">Invoices</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="tab-subcontents">
                                        <div class="tab-pane fade in active" id="packinglist_pane">
                                        	<div class="row">
	                                            <div class="col-sm-12 table-responsive">
	                                                <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="tbl_packinglist">
	                                                    <thead>
	                                                        <tr>
	                                                            <td></td>
	                                                            <td>CTR #</td>
																<td>Invoice Date</td>
																<td>Remarks</td>
																<td>Sold To</td>
																<td>Ship To</td>
																<td>Date Ship</td>
																<td>Port of Destination</td>
																<td>Shipping Instruction</td>
																<td>Case Marks</td>
																<td>Note</td>
																<td>Status</td>
	                                                        </tr>
	                                                    </thead>
	                                                    <tbody id="tbl_packinglist_body"></tbody>
	                                                </table>
	                                            </div>
	                                        </div>
                                        </div>

                                        <div class="tab-pane fade" id="invoice_pane">
                                        	<div class="row">
	                                            <div class="col-sm-12 table-responsive">
	                                                <table class="table table-bordered display " id="tbl_invoice">
	                                                    <thead>
	                                                        <tr>
	                                                            <td></td>
	                                                            <td>Invoice No.</td>
																<td>Invoice Date</td>
																<td>Packing List</td>
																<td>Customer</td>
																<td>Description</td>
																<td>Quantity</td>
																<td>Amount</td>
																<td>Destination</td>
	                                                        </tr>
	                                                    </thead>
	                                                    <tbody id="tbl_invoice_body"></tbody>
	                                                </table>
	                                            </div>
	                                        </div>
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



	<?php echo $__env->make('includes.modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
	<script src="<?php echo e(asset(config('constants.PUBLIC_PATH').'assets/global/scripts/common.js')); ?>" type="text/javascript"></script>
	<script>
		$(function() {
		    packinglist("<?php echo e(url('/getpackinglistdatatable')); ?>");
		    invoice();

			$('#btn_search').on('click', function() {
				$('#SearchModal').modal('show');
			});

			$('#tbl_packinglist_body').on('click', '.btn_edit',function() {
				var ctrl = $(this).attr('data-ctrl');
				window.location = '<?php echo e(url("/detailsypicsinvoicing")); ?>'+'/'+ctrl;
			});

			$('#tbl_invoice_body').on('click', '.btn_delete_invoice',function() {
				var id = $(this).attr('data-id');
				$('#confirm_id').val(id);
				confirm_modal("Are you sure to delete this Invoice?");
			});

			$('#btn_confirm').on('click', function() {
				var data = {
					_token: "<?php echo e(Session::token()); ?>",
					id: $('#confirm_id').val()
				}
				var urls = "<?php echo e(url('/deleteinvoicedetails')); ?>";

				$('#confirm_modal').modal('hide');
				$.ajax({
					url: urls,
					type: 'POST',
					dataType: 'JSON',
					data: data,
				}).done(function(data,textStatus,jqXHR) {
					msg(data.msg,data.status);
					invoice();
				}).fail(function(data,textStatus,jqXHR) {
					msg("There's an error occurred while processing.",'error');
				});
			});

		});

		function packinglist(url) {
	    	$('#tbl_packinglist').dataTable().fnClearTable();
            $('#tbl_packinglist').dataTable().fnDestroy();
            $('#tbl_packinglist').DataTable({
                processing: true,
                serverSide: true,
                scrollY: 500,
                ajax: url,
                columns: [
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                    { data: function(data) {
                    	return data.control_no;
                    }, name: 'control_no' },
					{ data: 'invoice_date', name: 'invoice_date' },
					{ data: function(data) {
						return '<strong>TIME:</strong> '+data.remarks_time+
						'<br><strong>PICKUP DATE:</strong> '+data.remarks_pickupdate+
						'<br><strong>NO:</strong> '+data.remarks_s_no;
					}, name: 'remarks_time' },
					{ data: 'sold_to', name: 'sold_to' },
					{ data: 'ship_to', name: 'ship_to' },
					{ data: 'date_ship', name: 'date_ship' },
					{ data: 'port_destination', name: 'port_destination' },
					{ data: function(data) {
						return '<strong>FROM:</strong> '+data.from+
						'<br><strong>TO:</strong> '+data.to+
						'<br><strong>FREIGHT:</strong> '+data.freight;
					}, name: 'from' },
					{ data: 'case_marks', name: 'case_marks' },
					{ data: 'note', name: 'note' },
					{ data: 'invoicing_status', name: 'invoicing_status' }
                ],
                aoColumnDefs: [
                    {
                        aTargets:[5],
                        fnCreatedCell: function(nTd, sData, oData, iRow, iCol) {
                            $(nTd).css('white-space', 'pre-wrap');
                        },

                        aTargets:[6],
                        fnCreatedCell: function(nTd, sData, oData, iRow, iCol) {
                            $(nTd).css('white-space', 'pre-wrap');
                        },

                        aTargets:[11],
                        fnCreatedCell: function(nTd, sData, oData, iRow, iCol) {
                        	$(nTd).css('font-weight', '700');

                        	if (sData == 'Complete') {
                        		$(nTd).css('background-color', '#1BA39C');
                            	$(nTd).css('color', '#fff');
                        	}

                        	if (sData == 'Revised') {
                        		$(nTd).css('background-color', '#cb5a5e');
                            	$(nTd).css('color', '#fff');
                        	}
                            
                        },
                    }
                ]
            });
	    }

	    function invoice() {
	    	$('#tbl_invoice').dataTable().fnClearTable();
            $('#tbl_invoice').dataTable().fnDestroy();
            $('#tbl_invoice').DataTable({
                processing: true,
                serverSide: true,
                ajax: "<?php echo e(url('/getinvoicedatatable')); ?>",
                columns: [
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                    { data: 'invoice_no', name: 'invoice_no' },
                    { data: 'invoice_date', name: 'invoice_date' },
                    { data: 'packinglist_ctrl', name: 'packinglist_ctrl' },
					{ data: 'customer', name: 'customer' },
					{ data: 'description_of_goods', name: 'description_of_goods' },
					{ data: 'quantity', name: 'quantity' },
					{ data: 'amount', name: 'amount' },
					{ data: 'destination', name: 'destination' }

                ]
            });
	    }
	</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>