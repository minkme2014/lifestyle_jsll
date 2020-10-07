<!-- Sales Report Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('profit_sheet') ?></h1>
	        <small><?php echo display('profit_sheet') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('invoice') ?></a></li>
	            <li class="active"><?php echo display('profit_sheet') ?></li>
	        </ol>
	    </div>
	</section>

	<section class="content">
		<!-- Sales report -->
		<div class="row">
			<div class="col-sm-12">
		        <div class="panel panel-default">
		            <div class="panel-body"> 
		                <?php echo form_open('Admin_dashboard/profit_sheet',array('class' => 'form-inline'))?>
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
		                    <h4><?php echo display('profit_sheet') ?> </h4>
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
										<th><?php echo display('store_code') ?></th>
										<th><?php echo display('selling_price') ?></th>
										<th><?php echo display('manufacturing_cost') ?></th>
										<th><?php echo display('embroidery_cost') ?></th>
										<th><?php echo display('packaging') ?></th>
										<th><?php echo display('delivery_charges') ?></th>
										<th><?php echo display('gst') ?></th>
										<th><?php echo display('total_cost') ?></th>
										<th><?php echo display('profit') ?></th>
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
		                        	if ($profit_sheet) {
									//	print_r($profit_sheet);
										foreach($profit_sheet as $p){
											$total_cost=(float)$p['cost']+(float)$p['embroidery_cost']+(float)$p['packaging']+(float)$p['delivery_charges']+(float)$p['total_tax'];
											?>
											
									<tr>
										<td><?php echo $p['date'];?></td>
										<td>
											<a href="<?php echo base_url().'cinvoice/invoice_inserted_data/'.$p["invoice_id"]; ?>">
												<?php echo $p['invoice_id'];?>
											</a>
										</td>
										<td><a href="<?php echo base_url().'ccustomer/customerledger/'.$p["customer_id"]; ?>"><?php echo $p['customer_name'];?></a></td>
										<td><?php echo $p['product_name'];?></td>
										<td><?php echo $p['uom_name'];?></td>
										<td>SKU<!--input id="store_code_<?php echo $p['invoice'];?>" value="<?php echo $p['store_code'];?>"--></td>
										<td id="total_amount_<?php echo $p['invoice'];?>"><?php echo $p['total_amount'];?></td>
										<td id="cost_<?php echo $p['invoice'];?>"><?php echo $p['cost'];?></td>
										<td><input id="emb_cost" type="text" onfocusout="update_total(this,<?php echo $p['invoice'];?>)" value="<?php echo $p['embroidery_cost'];?>"></td>
										<td id="packaging_<?php echo $p['invoice'];?>"><?php echo $p['packaging'];?></td>
										<td id="delivery_<?php echo $p['invoice'];?>"><?php echo $p['delivery_charges'];?></td>
										<td id="tax_<?php echo $p['invoice'];?>"><?php echo $p['total_tax'];?></td>
										<td id="toatl_cost_<?php echo $p['invoice'];?>"><?php echo round($total_cost,2);?></td>
										<td id="profit_<?php echo $p['invoice'];?>"><?php echo round($p['total_amount']-$total_cost,2);?></td>
										
									</tr>
											<?php
										}
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
 function update_total(obj,id)
 {
	 var value=$(obj).val();
	 var total_amount=$("#total_amount_"+id).html();
	// var toatl_cost=$("#toatl_cost_"+id).html();
	 //var profit=$("#profit_"+id).html();
	 var packaging=$("#packaging_"+id).html();
	 var tax=$("#tax_"+id).html();
	 var delivery=$("#delivery_"+id).html();
	 var cost=$("#cost_"+id).html();
	 var total=parseFloat(cost)+parseFloat(value)+parseFloat(packaging)+parseFloat(delivery)+parseFloat(tax);
	 var profit_price=parseFloat(total_amount)-parseFloat(total);
	 $("#toatl_cost_"+id).html(total);
	 $("#profit_"+id).html(profit_price);
 	 	$.ajax
				   ({
						type: "POST",
						url: "<?php echo base_url()?>Admin_dashboard/edit_embroidery_cost",
						data: {'embroidery_cost':value,'invoice':id},
						cache: false,
						success: function(data)
						{
							alert(data);
							//location.reload();
						}
				   }); 
 }
 
 </script>