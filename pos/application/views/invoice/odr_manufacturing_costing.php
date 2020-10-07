<!-- Sales Report Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('odr_manufacturing_costing') ?></h1>
	        <small><?php echo display('odr_manufacturing_costing') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('invoice') ?></a></li>
	            <li class="active"><?php echo display('odr_manufacturing_costing') ?></li>
	        </ol>
	    </div>
	</section>

	<section class="content">
		<!-- Sales report -->
		<div class="row">
			<div class="col-sm-12">
		        <div class="panel panel-default">
		            <div class="panel-body"> 
		                <?php echo form_open('Cinvoice/odr_manufacturing_costing',array('class' => 'form-inline'))?>
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
		                    <h4><?php echo display('odr_manufacturing_costing') ?> </h4>
		                </div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive">
		                    <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
		                        <thead>
		                            <tr>
		                                <th><?php echo display('date') ?></th>
										<th><?php echo display('invoice_no') ?></th>
										<th><?php echo display('customer_name') ?></th>
										<th><?php echo display('product_name') ?></th>
										<th><?php echo display('uom') ?></th>
										<th><?php echo display('raw_material') ?></th>
										<th><?php echo display('expected_qty') ?></th>
										<th><?php echo display('expected_costing') ?></th>
										<th><?php echo display('actual_qty') ?></th>
										<th><?php echo display('actual_costing') ?></th>
										<th><?php echo display('embroidery_time') ?></th>
										<th><?php echo display('action') ?></th>
										<!--th><?php echo display('total_amount') ?></th-->
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
		                        	if ($sales_report) {
		                        ?>
		                            {sales_report}
									<tr>
										<td>{sales_date}</td>
										<td>
											<a href="<?php echo base_url().'cinvoice/invoice_inserted_data/{invoice_id}'; ?>">
												{invoice_id}
											</a>
										</td>
										<td><a href="<?php echo base_url().'ccustomer/customerledger/{customer_id}'; ?>">{customer_name}</a></td>
										<td>{product_name}</td>
										<td>{uom_name}</td>
										
										<td><input type="text" id="raw_material_{invoice_id}"></td>
										<td><input type="text" id="exp_qty_{invoice_id}"></td>
										<td><input type="text" id="exp_cost_{invoice_id}"></td>
										<td><input type="text" id="actual_qty_{invoice_id}"></td>
										<td><input type="text" id="act_cost_{invoice_id}"></td>
										<td><input type="text" id="embroidery_time_{invoice_id}"></td>
										<td><input type="button" value="add" class="btn-primary" onclick="add('{invoice_id}','{i_detail_id}','{product_id}','{customer_id}')"></td>
										<!--td style="text-align: right;"><?php echo (($position==0)?"$currency {total_amount}":"{total_amount} $currency") ?></td-->
									</tr>
								{/sales_report}
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
 function add(invoice_id,invoice_detail_id,product_id,customer_id)
 {
	 var raw_material=$("#raw_material_"+invoice_id).val();
	 var exp_qty=$("#exp_qty_"+invoice_id).val();
	 var exp_cost=$("#exp_cost_"+invoice_id).val();
	 var actual_qty=$("#actual_qty_"+invoice_id).val();
	 var act_cost=$("#act_cost_"+invoice_id).val();
	 var embroidery_time=$("#embroidery_time_"+invoice_id).val();
	 	$.ajax
				   ({
						type: "POST",
						url: "<?php echo base_url()?>Cinvoice/add_odr_manufacture",
						data: {'raw_material':raw_material,'exp_qty':exp_qty,'exp_cost':exp_cost,'actual_qty':actual_qty,'act_cost':act_cost,'customer_id':customer_id,
								'embroidery_time':embroidery_time,'invoice_id':invoice_id,'invoice_detail_id':invoice_detail_id,'product_id':product_id},
						cache: false,
						success: function(data)
						{
							alert(data);
							location.reload();
						}
				   });
 }
 
 </script>