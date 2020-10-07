<!-- Sales Report Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('manufacturing_cost_report') ?></h1>
	        <small><?php echo display('manufacturing_cost_report') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('report') ?></a></li>
	            <li class="active"><?php echo display('manufacturing_cost_report') ?></li>
	        </ol>
	    </div>
	</section>

	<section class="content">
		<!-- Sales report -->
		<div class="row">
			<div class="col-sm-12">
		        <div class="panel panel-default">
		            <div class="panel-body"> 
		                <?php echo form_open('Admin_dashboard/manufacturing_cost_report',array('class' => 'form-inline'))?>
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
		                    <h4><?php echo display('manufacturing_cost_report') ?> </h4>
		                </div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive">
		                    <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
		                        <thead>
		                            <tr>
		                                <th><?php echo display('date') ?></th>
		                                <th><?php echo display('day') ?></th>
		                                <th><?php echo display('user') ?></th>
										<th><?php echo display('customer_name') ?></th>
										<th><?php echo display('total_working_hr') ?></th>
										<th><?php echo display('sample_work') ?></th>
										<th><?php echo display('sample_hr') ?></th>
										<th><?php echo display('rate_per_hour') ?></th>
										<th><?php echo display('individual_price') ?></th>
										<th><?php echo display('odr_work') ?></th>
										<th><?php echo display('odr_hr') ?></th>
										<th><?php echo display('rate_per_hr') ?></th>
										<th><?php echo display('total_hr_worked') ?></th>
										<th><?php echo display('total_price_per_day') ?></th>
										<th><?php echo display('work_from_home') ?></th>
										<th><?php echo display('price_paid') ?></th>
		                            </tr>
		                        </thead>
		                        <tfoot>
									<tr>
										<!--td colspan="3" style="text-align: right;"><b><?php echo display('total_sales') ?></b></td>
										<td style="text-align: right;"><b><?php echo (($position==0)?"$currency {sales_amount}":"{sales_amount} $currency") ?></b></td-->
									</tr>
								</tfoot>
		                        <tbody>
		                        <?php
		                        	if ($manufacturing_cost_report) 
									//	print_r($sales_record);
								//$i=1;
										foreach($manufacturing_cost_report as $sr)
										{
											?>
											
									<tr>
										<td><?php echo $sr['m_date'];?></td>
										<td><?php echo date('D', strtotime($sr['m_date']));?></td>
										<td><?php echo $sr['first_name'].' '.$sr['last_name'];?></td>
										<td><?php echo $sr['customer_name'];?></td>
										<td><?php echo $sr['total_working_hr'];?></td>
										<td><?php echo $sr['sample_work'];?></td>
										<td><?php echo $sr['sample_hr'];?></td>
										<td><?php echo $sr['rate_per_hour'];?></td>
										<td><?php echo $sr['individual_price'];?></td>
										<td><?php echo $sr['odr_work'];?></td>
										<td><?php echo $sr['odr_hr'];?></td>
										<td><?php echo $sr['rate_per_hr'];?></td>
										<td><?php echo $sr['total_hr_worked'];?></td>
										<td><?php echo $sr['total_price_per_day'];?></td>
										<td><?php echo $sr['work_from_home'];?></td>
										<td><?php echo $sr['price_paid'];?></td>
										
									</tr>
											<?php
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