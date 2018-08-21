

<?php $__env->startSection('title'); ?>
	Order Data Check | Pricon Microelectronics, Inc.
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<?php echo $__env->make('includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php $state = ""; $readonly = ""; ?>
	<?php foreach($userProgramAccess as $access): ?>
		<?php if($access->program_code == Config::get('constants.MODULE_CODE_CHECK')): ?>  <!-- Please update "2001" depending on the corresponding program_code -->
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
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-clipboard"></i>  ORDER DATA CHECK
						</div>
					</div>
					<div class="portlet-body">

						<div class="row">

							<div class="col-md-7">
								<div class="row">
									<div class="col-md-12">

										<div class="portlet box blue-hoki">

											<div class="portlet-body">
												<div class="row">
													<div class="col-md-12">
														<form method="POST" enctype="multipart/form-data" action="<?php echo e(url('/readfiles')); ?>" class="form-horizontal" id="readfileform" >
															<?php echo e(csrf_field()); ?>


															<div class="form-group">
																<label class="control-label col-md-4">MLP01UF</label>
																<div class="col-md-5">
																	<input type="file" class="filestyle" data-buttonName="btn-primary" name="mlp01uf" id="mlp01uf" <?php echo e($readonly); ?>>
																</div>
															</div>

															<div class="form-group">
																<label class="control-label col-md-4">MLP02UF</label>
																<div class="col-md-5">
																	<input type="file" class="filestyle" data-buttonName="btn-primary" name="mlp02uf" id="mlp02uf" <?php echo e($readonly); ?>>
																</div>
															</div>

															<div class="form-group">
																<label class="control-label col-md-4">Output Directory</label>
																<div class="col-md-5">
																	<input type="text" class="form-control" value="/public/Order_Data_Check/" disabled="disable">
																</div>
															</div>

															<div class="form-group">
																<div class="col-md-9">
																	<button type="submit" class="btn btn-md btn-warning pull-right" <?php echo e($state); ?>>
																		<i class="fa fa-refresh"></i> Process
																	</button>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>

										<div class="portlet box blue">
											<div class="portlet-title">
												<div class="caption">
													DETAIL SUMMARY
												</div>
											</div>
											<div class="portlet-body">
												<div class="row">
													<div class="col-md-6">
														<table class="table table-hover table-bordered">
															<thead>
																<tr style="color: #d6f5f3;background-color: #0ba8e2;">
																	<td colspan="3">
																		RECEIVED DATA DETAILS
																	</td>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td width="100px">TS</td>
																	<td>TS PO:</td>
																	<?php if(Session::has('PO')): ?>
																		<td style="font-weight: 900">
																			<?php if(Session::has('con') && Session::get('con') == 'TS'): ?>
																				<?php echo e(Session::get('PO')); ?>

																			<?php endif; ?>
																		</td>
																	<?php else: ?>
																		<td style="font-weight: 900">0</td>
																	<?php endif; ?>
																</tr>
																<tr>
																	<td>CN</td>
																	<td>CN PO:</td>
																	<?php if(Session::has('PO')): ?>
																		<td style="font-weight: 900">
																			<?php if(Session::has('con') && Session::get('con') == 'CN'): ?>
																				<?php echo e(Session::get('PO')); ?>

																			<?php endif; ?>
																		</td>
																	<?php else: ?>
																		<td style="font-weight: 900">0</td>
																	<?php endif; ?>
																</tr>
																<tr>
																	<td>YF</td>
																	<td>YF PO:</td>
																	<?php if(Session::has('PO')): ?>
																		<td style="font-weight: 900">
																			<?php if(Session::has('con') && Session::get('con') == 'YF'): ?>
																				<?php echo e(Session::get('PO')); ?>

																			<?php endif; ?>
																		</td>
																	<?php else: ?>
																		<td style="font-weight: 900">0</td>
																	<?php endif; ?>
																</tr>
																<tr>
																	<td colspan="2">TOTAL:</td>
																	<?php if(Session::has('PO')): ?>
																		<td style="font-weight: 900">
																			<?php echo e(Session::get('PO')); ?>

																		</td>
																	<?php elseif(Session::has('PO')): ?>
																		<td style="font-weight: 900">
																			<?php echo e(Session::get('PO')); ?>

																		</td>
																	<?php else: ?>
																		<td style="font-weight: 900">0</td>
																	<?php endif; ?>
																</tr>
															</tbody>
														</table>
													</div>
													<div class="col-md-6">
														<table class="table table-hover table-bordered">
															<thead>
																<tr style="color: #d6f5f3;background-color: #0ba8e2;">
																	<td colspan="2">
																		RECEIVED DATA DETAILS
																	</td>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td width="200px">RS PO</td>
																	<td style="font-weight: 900">0</td>
																</tr>
																<tr>
																	<td>NORMAL PO</td>
																	<?php if(Session::has('NormalPO')): ?>
																		<?php $NormalPO = Session::get('NormalPO'); ?>
																		<td style="font-weight: 900">
																			<?php echo e($NormalPO); ?>

																		</td>
																	<?php else: ?>
																		<td style="font-weight: 900">0</td>
																	<?php endif; ?>
																</tr>
																<tr>
																	<td>NEW PRODUCT</td>
																	<?php if(Session::has('Products')): ?>
																		<?php $Products = Session::get('Products'); ?>
																		<td style="font-weight: 900"><?php echo e($Products['nonexist']); ?></td>
																	<?php else: ?>
																		<td style="font-weight: 900">0</td>
																	<?php endif; ?>
																</tr>
																<tr>
																	<td>RS GENERATED</td>
																	<td style="font-weight: 900">0</td>
																</tr>
																<tr>
																	<td>FOR ORDER ENTRY</td>
																	<?php if(Session::has('PO') && Session::has('Products') && Session::has('Products')): ?>
																		<?php
																			$prodExist = Session::get('Products');
																			$prodNotExist = Session::get('Products');
																			$orderts = $prodExist['exist'] + $prodNotExist['nonexist'];
																		?>
																		<td style="font-weight: 900">
																			<?php echo e($orderts); ?>

																		</td>
																	<?php else: ?>
																		<td style="font-weight: 900">0</td>
																	<?php endif; ?>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>

										<div class="portlet box blue">
											<div class="portlet-title">
												<div class="caption">
													NUMBER OF DATA LOADING TO TPICS
												</div>
											</div>
											<div class="portlet-body">
												<div class="table-responsive">
													<table class="table table-hover table-bordered table-condensed">
														<thead>
															<tr style="color: #d6f5f3;background-color: #0ba8e2;">
																<td></td>
																<td>ITEM NAME MASTER</td>
																<td>ITEM MASTER</td>
																<td>UNIT PRICE MASTER</td>
																<td>PRICE MASTER</td>
																<td>BOM MASTER</td>
																<td>ORDER ENTRY</td>
															</tr>
														</thead>
														<tbody>
															<tr align="right">
																<td>PART</td>
															<?php if(Session::has('ItemNamePartCount') && Session::has('ItemPartCount') && Session::has('UnitCount') && Session::has('BOMCount') && Session::has('Order')): ?>
																<?php
																	$BOMCount = Session::get('BOMCount');
																	$UnitCount = Session::get('UnitCount');
																	$ItemNamePartCount = Session::get('ItemNamePartCount');
																	$ItemPartCount = Session::get('ItemPartCount');
																?>
																<td style="font-weight: 900"><?php echo e($ItemNamePartCount); ?></td>
																<td style="font-weight: 900"><?php echo e($ItemPartCount); ?></td>
																<td style="font-weight: 900"><?php echo e($UnitCount); ?></td>
																<td style="font-weight: 900"></td>
																<td style="font-weight: 900"><?php echo e($BOMCount); ?></td>
																<td style="font-weight: 900"></td>
															<?php else: ?>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
															<?php endif; ?>

															</tr>
															<tr align="right">
																<td>PROD</td>
															<?php if(Session::has('ItemNameProdCount') && Session::has('ItemProdCount') && Session::has('PriceCount') && Session::has('Order')): ?>
																<?php
																	$PriceCount = Session::get('PriceCount');
																	$ItemNameProdCount = Session::get('ItemNameProdCount');
																	$ItemProdCount = Session::get('ItemProdCount');
																	$prod_order = Session::get('Order');
																	$orderts = $prod_order['exist'] + $prod_order['non_exist'];
																?>
																<td style="font-weight: 900"><?php echo e($ItemNameProdCount); ?></td>
																<td style="font-weight: 900"><?php echo e($ItemProdCount); ?></td>
																<td style="font-weight: 900"></td>
																<td style="font-weight: 900"><?php echo e($PriceCount); ?></td>
																<td style="font-weight: 900"></td>
																<td style="font-weight: 900"><?php echo e($orderts); ?></td>
															<?php else: ?>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
															<?php endif; ?>

															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>

									</div>
								</div>

								<div class="row">
									<div class="col-md-12 text-center">
										<?php if(Session::has('PO')): ?>
											<a href="<?php echo e(url('/momscheck')); ?>" class="btn btn-sm blue">MOMS Check</a>
										<?php endif; ?>
									</div>
								</div>
								<!--<div class="row"></div>
								<div class="row"></div>-->
							</div>





							<div class="col-md-5">
								<div class="row">
									<div class="col-md-12">

										<div class="portlet box blue">
											<div class="portlet-body">
											<!-- MLP01UF -->
												<table class="table table-hover table-bordered">
													<thead>
														<tr style="color: #d6f5f3;background-color: #0ba8e2;">
															<td colspan="2">
																MLP01UF
															</td>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td width="100px">
																START:
															</td>
															<td style="font-weight: 900">
																<?php if(Session::has('partStartPO')): ?>
																	<?php echo e(Session::get('partStartPO')); ?>

																<?php endif; ?>
															</td>
														</tr>
														<tr>
															<td>
																END:
															</td>
															<td style="font-weight: 900">
																<?php if(Session::has('partEndPO')): ?>
																	<?php echo e(Session::get('partEndPO')); ?>

																<?php endif; ?>
															</td>
														</tr>
													</tbody>
												</table>
											<!-- MLP02UF -->
												<table class="table table-hover table-bordered">
													<thead>
														<tr style="color: #d6f5f3;background-color: #0ba8e2;">
															<td colspan="2">
																MLP02UF
															</td>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td width="100px">
																START:
															</td>
															<td style="font-weight: 900">
																<?php if(Session::has('prodStartPO')): ?>
																	<?php echo e(Session::get('prodStartPO')); ?>

																<?php endif; ?>
															</td>
														</tr>
														<tr>
															<td>
																END:
															</td>
															<td style="font-weight: 900">
																<?php if(Session::has('prodEndPO')): ?>
																	<?php echo e(Session::get('prodEndPO')); ?>

																<?php endif; ?>
															</td>
														</tr>
													</tbody>
												</table>
											<!-- MLP DATA COMPARISON -->
												<table class="table table-hover table-bordered">
													<thead>
														<tr style="color: #d6f5f3;background-color: #0ba8e2;">
															<td colspan="2">
																MLP DATA COMPARISON
															</td>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td width="100px">
																START:
															</td>
															<td style="font-weight: 900">
															<?php
																if (Session::has('partStartPO') && Session::has('prodStartPO')) {
																	if (Session::has('partStartPO') == Session::has('prodStartPO')) {
																		echo "OK";
																	} else {
																		echo "NG";
																	}
																} else {

																}
															?>
															</td>
														</tr>
														<tr>
															<td>
																END:
															</td>
															<td style="font-weight: 900">
															<?php
																if (Session::has('partEndPO') && Session::has('prodEndPO')) {
																	if (Session::has('partEndPO') && Session::has('prodEndPO')) {
																		echo "OK";
																	} else {
																		echo "NG";
																	}
																} else {

																}
															?>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>

										<div class="portlet box blue">
											<div class="portlet-title">
												<div class="caption">
													DATA UNMATCH YPICS vs R3
												</div>
											</div>
											<div class="portlet-body">
												<div id="msg" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
												<table class="table table-hover table-bordered">
													<thead>
														<tr style="color: #d6f5f3;background-color: #0ba8e2;">
															<td>NAME</td>
															<td>QUANTITY</td>
														</tr>
													</thead>
													<tbody>
														<tr>
															<?php if(Session::has('Item') && Session::has('Unit') && Session::has('Price') && Session::has('BOM')): ?>
																<?php
																	$BOM = Session::get('BOM');
																	$Price = Session::get('Price');
																	$Item = Session::get('Item');
																	$Unit = Session::get('Unit');
																?>
															<?php endif; ?>
															<?php if(Session::has('Price') && $Price['unmatch'] > 0): ?>
																<td>SALES PRICE</td>
																<td style="font-weight: 900">
																	<?php $sales = Session::get('uSalescount'); ?>
																	<a href="<?php echo e(url('/umSalesexcel')); ?>" class="btn btn-sm blue"><?php echo e($sales); ?></a>
																</td>
															<?php else: ?>
																<td>SALES PRICE</td>
																<td style="font-weight: 900">0</td>
															<?php endif; ?>
														</tr>
														<tr>
															<?php if(Session::has('uUnitcount') && Session::get('uUnitcount') > 0): ?>
																<td>UNIT PRICE</td>
																<td style="font-weight: 900">
																	<?php $unit = Session::get('uUnitcount');?>
																	<a href="<?php echo e(url('/umUnitexcel')); ?>" class="btn btn-sm blue"><?php echo e($unit); ?></a>
																</td>
															<?php else: ?>
																<td>UNIT PRICE</td>
																<td style="font-weight: 900">0</td>
															<?php endif; ?>
														</tr>
														<tr>
															<?php if(Session::has('BOM') && Session::get('uBOMcount') > 0): ?>
																<td>BOM</td>
																<td style="font-weight: 900">
																	<?php $bomcount = Session::get('uBOMcount');?>
																	<a href="<?php echo e(url('/umBOMexcel')); ?>" class="btn btn-sm blue"><?php echo e($bomcount); ?></a>
																</td>
															<?php else: ?>
																<td>BOM</td>
																<td style="font-weight: 900">0</td>
															<?php endif; ?>
														</tr>
														<tr>
															<?php if(Session::has('BOM') && Session::get('uUsagecount') > 0): ?>
																<td>USAGE</td>
																<td style="font-weight: 900">
																	<?php $usagecount = Session::get('uUsagecount');?>
																	<a href="<?php echo e(url('/umUsageexcel')); ?>" class="btn btn-sm blue"><?php echo e($usagecount); ?></a>
																</td>
															<?php else: ?>
																<td>USAGE</td>
																<td style="font-weight: 900">0</td>
															<?php endif; ?>
														</tr>
														<tr>
															<?php if(Session::has('uSuppcount') && Session::get('uSuppcount') > 0): ?>
																<td>SUPPLIER</td>
																<td style="font-weight: 900">
																	<?php $supplier = Session::get('uSuppcount'); ?>
																	<a href="<?php echo e(url('/umSuppexcel')); ?>" class="btn btn-sm blue"><?php echo e($supplier); ?></a>
																</td>
															<?php else: ?>
																<td>SUPPLIER</td>
																<td style="font-weight: 900">0</td>
															<?php endif; ?>
														</tr>
														<tr>
															<?php if(Session::has('Item') && Session::get('uPartNamecount') > 0): ?>
																<td>PART NAME</td>
																<td style="font-weight: 900">
																	<?php $partnamecount = Session::get('uPartNamecount'); ?>
																	<a href="<?php echo e(url('/umPartNameexcel')); ?>" class="btn btn-sm blue"><?php echo e($partnamecount); ?></a>
																</td>
															<?php else: ?>
																<td>PART NAME</td>
																<td style="font-weight: 900">0</td>
															<?php endif; ?>
														</tr>
														<tr>
															<?php if(Session::has('uProdNamecount') && Session::get('uProdNamecount') > 0): ?>
																<td>PRODUCT NAME</td>
																<td style="font-weight: 900">
																	<?php $prodName = Session::get('uProdNamecount'); ?>
																	<a href="<?php echo e(url('/umProdNameexcel')); ?>" class="btn btn-sm blue"><?php echo e($prodName); ?></a>
																</td>
															<?php else: ?>
																<td>PRODUCT NAME</td>
																<td style="font-weight: 900">0</td>
															<?php endif; ?>
														</tr>
														<tr>
															<?php if(Session::has('uProdDNcount') && Session::get('uProdDNcount') > 0): ?>
																<td>PRODUCT DN</td>
																<td style="font-weight: 900">
																	<?php $prodDN = Session::get('uProdDNcount'); ?>
																	<a href="<?php echo e(url('/umProdDNexcel')); ?>" class="btn btn-sm blue"><?php echo e($prodDN); ?></a>
																</td>
															<?php else: ?>
																<td>PRODUCT DN</td>
																<td style="font-weight: 900">0</td>
															<?php endif; ?>
														</tr>
														<tr>
															<?php if(Session::has('uPartDNcount') && Session::get('uPartDNcount') > 0): ?>
																<td>PARTS DN</td>
																<td style="font-weight: 900">
																	<?php $partDN = Session::get('uPartDNcount');?>
																	<a href="<?php echo e(url('/umPartDNexcel')); ?>" class="btn btn-sm blue"><?php echo e($partDN); ?></a>
																</td>
															<?php else: ?>
																<td>PARTS DN</td>
																<td style="font-weight: 900">0</td>
															<?php endif; ?>
														</tr>
													</tbody>
												</table>
											</div>
										</div>

									</div>
								</div>
								<!--<div class="row"></div>-->
							</div>

						</div>

					</div>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>

	<div id="processdone" class="modal fade" role="dialog" data-backdrop="static">
		<div class="modal-dialog modal-sm gray-gallery">
			<div class="modal-content ">
				<div class="modal-body">
					<center><h3>Process successful!</h3></center>
				</div>
				<div class="modal-footer">
					<form method="POST" action="<?php echo e(url('/order_data_generate_report')); ?>" class="form-horizontal" target="_blank" id="processform">
						<?php echo e(csrf_field()); ?>

						<?php if(Session::has('partStartPO')): ?>
							<input type="hidden" name="ml01start" value="<?php echo e(Session::get('partStartPO')); ?>">
						<?php endif; ?>
						<?php if(Session::has('partEndPO')): ?>
							<input type="hidden" name="ml01end" value="<?php echo e(Session::get('partEndPO')); ?>">
						<?php endif; ?>
						<?php if(Session::has('prodStartPO')): ?>
							<input type="hidden" name="ml02start" value="<?php echo e(Session::get('prodStartPO')); ?>">
						<?php endif; ?>
						<?php if(Session::has('prodEndPO')): ?>
							<input type="hidden" name="ml02end" value="<?php echo e(Session::get('prodEndPO')); ?>">
						<?php endif; ?>
						<?php
							if (Session::has('partStartPO') && Session::has('prodStartPO')) {
								if (Session::get('partStartPO') == Session::get('prodStartPO')) {
						?>
									<input type="hidden" name="matchstart" value="OK">
						<?php
								} else {
						?>
									<input type="hidden" name="matchstart" value="NG">
						<?php
								}
							}
							if (Session::has('partEndPO') && Session::has('prodEndPO')) {
								if (Session::get('partEndPO') == Session::get('prodEndPO')) {
						?>
									<input type="hidden" name="matchend" value="OK">
						<?php
								} else {
						?>
									<input type="hidden" name="matchend" value="NG">
						<?php
								}
							}
						?>

						<?php if(Session::has('ItemNamePartCount') && Session::has('ItemPartCount') && Session::has('UnitCount') && Session::has('BOMCount') && Session::has('Order') && Session::has('NormalPO') && Session::has('Products') && Session::has('ItemNameProdCount') && Session::has('ItemProdCount') && Session::has('PriceCount')): ?>
							<input type="hidden" name="po" value="<?php echo e(Session::get('PO')); ?>">
							<input type="hidden" name="normalpo" value="<?php echo e(Session::get('NormalPO')); ?>">
							<?php
								$PriceCount = Session::get('PriceCount');
								$ItemNameProdCount = Session::get('ItemNameProdCount');
								$ItemProdCount = Session::get('ItemProdCount');
								$BOMCount = Session::get('BOMCount');
								$UnitCount = Session::get('UnitCount');
								$ItemNamePartCount = Session::get('ItemNamePartCount');
								$ItemPartCount = Session::get('ItemPartCount');
								
								$Order = Session::get('Order');
								$prod_order = Session::get('Order');
								$Products = Session::get('Products');
								$orderts = $prod_order['exist'] + $prod_order['non_exist'];
								$dataentryts = $Products['exist'] + $Products['nonexist'];
							?>
							<input type="hidden" name="dataentryts" value="<?php echo e($dataentryts); ?>">
							<input type="hidden" name="newprod" value="<?php echo e($Products['nonexist']); ?>">
							<input type="hidden" name="itemnameparts" value="<?php echo e($ItemNamePartCount); ?>">
							<input type="hidden" name="itemmasterparts" value="<?php echo e($ItemPartCount); ?>">
							<input type="hidden" name="unitprice" value="<?php echo e($UnitCount); ?>">
							<input type="hidden" name="itemnameprod" value="<?php echo e($ItemNameProdCount); ?>">
							<input type="hidden" name="itemmasterprod" value="<?php echo e($ItemProdCount); ?>">
							<input type="hidden" name="price" value="<?php echo e($PriceCount); ?>">
							<input type="hidden" name="bom" value="<?php echo e($BOMCount); ?>">
							<input type="hidden" name="orderts" value="<?php echo e($orderts); ?>">
						<?php endif; ?>

						<?php /* <?php if(Session::has('CNPO')): ?>
							<input type="hidden" name="cnpo" value="<?php echo e(Session::get('CNPO')); ?>">
						<?php endif; ?> */ ?>

						<?php if(Session::has('MLP01name')): ?>
							<input type="hidden" name="mlp01name" value="<?php echo e(Session::get('MLP01name')); ?>">
						<?php endif; ?>

						<?php if(Session::has('MLP02name')): ?>
							<input type="hidden" name="mlp02name" value="<?php echo e(Session::get('MLP02name')); ?>">
						<?php endif; ?>

						<input type="hidden" name="poforrs" value="">
						<input type="hidden" name="rsgen" value="">
						<input type="hidden" name="ordercn" value="">

						<button type="submit" class="btn btn-success">OK</button>
						<button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
					</form>

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

	<!-- NEW PRODUCT -->
	<div id="newproduct" class="modal fade" role="dialog" data-backdrop="static">
		<div class="modal-dialog modal-sm gray-gallery">
			<div class="modal-content ">
				<div class="modal-body">
					<?php if(Session::has('Products')): ?>
						<?php $Products = Session::get('Products'); ?>
						<p>Today's new product is <?php echo e($Products['nonexist']); ?>.</p>
					<?php else: ?>
						<p>Today's new product is 0.</p>
					<?php endif; ?>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-primary">OK</button>
				</div>
			</div>
		</div>
	</div>

	<?php if(Session::has('PO')): ?>
		<script src="<?php echo e(asset(Config::get('constants.PUBLIC_PATH').'assets/global/plugins/jquery.min.js')); ?>" type="text/javascript"></script>
		<script type="text/javascript">
			$( document ).ready(function() {
				$('#processdone').modal('show');

			});
		</script>
	<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
	<script src="<?php echo e(asset(Config::get('constants.PUBLIC_PATH').'assets/global/scripts/orderdatacheck.js')); ?>" type="text/javascript"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>