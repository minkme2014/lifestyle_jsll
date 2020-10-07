<!-- Sales Report Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('purchase_return_report') ?></h1>
	        <small><?php echo display('purchase_return_report') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('report') ?></a></li>
	            <li class="active"><?php echo display('purchase_return_report') ?></li>
	        </ol>
	    </div>
	</section>

	<section class="content">
		<!-- Sales report -->
		<div class="row">
			<div class="col-sm-12">
		        <div class="panel panel-default">
		            <div class="panel-body"> 
		                <?php echo form_open('Admin_dashboard/purchase_return_report',array('class' => 'form-inline'))?>
		                    <div class="form-group">
		                        <label class="sr-only" for="from_date"><?php echo display('start_date') ?></label>
		                        <input type="text" name="from_date" class="form-control datepicker" id="from_date" placeholder="<?php echo display('start_date') ?>" >
		                    </div> 

		                    <div class="form-group">
		                        <label class="sr-only" for="to_date"><?php echo display('end_date') ?></label>
		                        <input type="text" name="to_date" class="form-control datepicker" id="to_date" placeholder="<?php echo display('end_date') ?>">
		                    </div>  

		                    <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
		               <?php echo form_close()?>
		            </div>
		        </div>
		    </div>
	    </div>

		<div class="row">`
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('purchase_return_report') ?> </h4>
		                </div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive">
		                    <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
		                        <thead>
		                            <tr>
										<th><?php echo display('sl') ?></th>
										<th><?php echo display('date') ?></th>
										<th><?php echo display('invoice_no') ?></th>
										<th><?php echo display('product') ?></th>
										<th><?php echo display('qty') ?></th>
										<th><?php echo display('total_amount') ?></th>
										<th><?php echo display('reason') ?></th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                        <?php
		                        	if ($purchase_return_report) 
									//	print_r($purchase_return_report);
										$i=1;
										foreach($purchase_return_report as $sr)
										{
											?>
											
									<tr>
										<td><?php echo $i;?></td>
										<td><?php echo date('Y-m-d',strtotime($sr['created_at']));?></td>
										<td><?php echo $sr['purchase_id'];?></td>
										<td><?php echo $sr['product_name'];?></td>
										<td><?php echo $sr['quantity'];?></td>
										<td><?php echo $sr['total_amount'];?></td>
										<td><?php echo $sr['reason'];?></td>
										
									</tr>
											<?php
											$i++;
										}
									{
		                        ?>
								<?php
									}
								?>
		                        </tbody>
		                    </table>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</section>
</div>
 <!-- Sales Report End -->
 
 <script>
 function add(invoice_id)
 {
	 var placement=$("#placement_"+invoice_id).val();
	 var influence=$("#influence_"+invoice_id).val();
	 var bank_charges_per=$("#bank_charges_per_"+invoice_id).val();
	 var bank_charges=$("#bank_charges_"+invoice_id).val();
	 var shipping_date=$("#shipping_date_"+invoice_id).val();
	 var shipping_through=$("#shipping_through_"+invoice_id).val();
	 var weight=$("#weight_"+invoice_id).val();
	 var delivery_date=$("#delivery_date_"+invoice_id).val();
	 var feedback=$("#feedback_"+invoice_id).val();
	 	$.ajax
				   ({
						type: "POST",
						url: "<?php echo base_url()?>Cinvoice/add_sale_record",
						data: {'placement':placement,'influence':influence,'bank_charges_per':bank_charges_per,'bank_charges':bank_charges,
						'shipping_date':shipping_date,'shipping_through':shipping_through,
								'weight':weight, 'delivery_date':delivery_date,'feedback':feedback,'invoice':invoice_id},
						cache: false,
						success: function(data)
						{
							alert(data);
							location.reload();
						}
				   });
 }
 
 </script>