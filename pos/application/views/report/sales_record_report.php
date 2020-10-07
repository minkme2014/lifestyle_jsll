<!-- Sales Report Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('sales_record_report') ?></h1>
	        <small><?php echo display('sales_record_report') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('invoice') ?></a></li>
	            <li class="active"><?php echo display('sales_record_report') ?></li>
	        </ol>
	    </div>
	</section>

	<section class="content">
		<!-- Sales report -->
		<div class="row">
			<div class="col-sm-12">
		        <div class="panel panel-default">
		            <div class="panel-body"> 
		                <?php echo form_open('Admin_dashboard/sales_record_report',array('class' => 'form-inline'))?>
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
		                    <h4><?php echo display('sales_record_report') ?> </h4>
		                </div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive">
		                    <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
		                        <thead>
		                            <tr>
		                                <th><?php echo display('date') ?></th>
		                                <th><?php echo display('day') ?></th>
		                                <th><?php echo display('invoice_no') ?></th>
										<th><?php echo display('customer_name') ?></th>
		                                <th><?php echo display('mobile') ?></th>
		                                <th><?php echo display('old_new_cust') ?></th>
										<th><?php echo display('qty') ?></th>
										<th><?php echo display('product_name') ?></th>
										<th><?php echo display('store_code') ?></th>
										<th><?php echo display('query_placement') ?></th>
										<th><?php echo display('any_influence') ?></th>
										<th><?php echo display('odr_placement') ?></th>
										<th><?php echo display('sale_closed_by') ?></th>
										<th><?php echo display('invoice_date') ?></th>
										<th><?php echo display('discount_per') ?></th>
										<th><?php echo display('discount_amount') ?></th>
										<th><?php echo display('gst_per') ?></th>
										<th><?php echo display('gst_amount') ?></th>
										<th><?php echo display('total_invoice_amt') ?></th>
										<th><?php echo display('cash_receipt_date') ?></th>
										<th><?php echo display('cash_recepit_no') ?></th>
										<th><?php echo display('mode_of_payment') ?></th>
										<th><?php echo display('bank_charges_per') ?></th>
										<th><?php echo display('bank_charges') ?></th>
										<th><?php echo display('shipping_date') ?></th>
										<th><?php echo display('shipping_through') ?></th>
										<th><?php echo display('weight') ?></th>
										<th><?php echo display('shipping_charges') ?></th>
										<th><?php echo display('packaging_charges') ?></th>
										<th><?php echo display('freight_charges') ?></th>
										<th><?php echo display('delivery_date') ?></th>
										<th><?php echo display('feedback') ?></th>
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
		                        	if ($sales_record_report) 
									//	print_r($sales_record);
								//$i=1;
										foreach($sales_record_report as $sr)
										{
											$total=(float)$sr['total_amount']-((float)$sr['delivery_charges']+(float)$sr['packaging']+(float)$sr['freight_charges'])+(float)$sr['total_discount']-(float)$sr['total_tax'];
											$discount_per=(float)$sr['total_discount']/$total*100;
											
											$tax_per=(float)$sr['total_tax']/($total-(float)$sr['total_discount'])*100;
											
											?>
											
									<tr>
										<td><?php echo $sr['date'];?></td>
										<td><?php echo date('D', strtotime($sr['date']));?></td>
										<td>
											<a href="<?php echo base_url().'cinvoice/invoice_inserted_data/'.$sr['invoice_id']; ?>">
												<?php echo $sr['invoice_id'];?>
											</a>				
										</td>
										<td><a href="<?php echo base_url().'ccustomer/customerledger/'.$sr['customer_id']; ?>"><?php echo $sr['customer_name'];?></a></td>
										<td><?php echo $sr['customer_mobile'];?></td>
										<td><?php if($sr['customer']=='1'){
											echo "New";
										}else{
											echo "Old";
										}
											?>
										</td>
										<td><?php echo $sr['qty'];?></td>
										<td><?php echo $sr['product_name'];?></td>
										<td>SKU</td>
										<td><?php echo $sr['query_placement'];?></td>
										<td><?php echo $sr['influence'];?></td>
										<td><?php if($sr['odr_placement']==0){
											echo "Manual";
										}else{
											echo "Shopify";
										}?></td>
										
										<td><?php echo $sr['first_name'].' '.$sr['last_name'];?></td>
										<td><?php echo $sr['date'];?></td>
										<td><?php echo round($discount_per,2);?>%</td>
										<td><?php echo $sr['total_discount'];?></td>
										<td><?php echo round($tax_per,2);?>%</td>
										<td><?php echo $sr['total_tax'];?></td>
										<td><?php echo $sr['total_amount'];?></td>
										<td><?php echo $sr['payment_date'];?></td>
										<td><?php echo $sr['receipt_no'];?></td>
										<td><?php 
												if($sr['payment_type']=='1')
												{
													echo display('cash');
												}else if($sr['payment_type']=='2')
												{
													echo display('cheque');
												}else if($sr['payment_type']=='3')
												{
													echo display('pay_order');
												}else if($sr['payment_type']=='4')
												{
													echo display('debit_card');
												}else if($sr['payment_type']=='5')
												{
													echo display('credit_card');
												}else if($sr['payment_type']=='6')
												{
													echo display('paytm');
												}else if($sr['payment_type']=='7')
												{
													echo display('gpay');
												}else if($sr['payment_type']=='8')
												{
													echo display('net_banking');
												}
												
												?>
										</td>
										<td><?php echo $sr['bank_charges_per'];?></td>
										<td><?php echo $sr['bank_charges'];?></td>
										<td><?php echo $sr['shipping_date'];?></td>
										<td><?php echo $sr['shipping_through'];?></td>
										<td><?php echo $sr['weight'];?></td>
										<td><?php echo $sr['delivery_charges'];?></td>
										<td><?php echo $sr['packaging'];?></td>
										<td><?php echo $sr['freight_charges'];?></td>
										<td><?php echo $sr['delivery_date'];?></td>
										<td><?php echo $sr['feedback'];?></td>
										
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