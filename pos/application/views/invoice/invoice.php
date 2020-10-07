<!-- Manage Invoice Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	         <div class="col-md-6 col-sm-6">
	        <h1><?php echo display('manage_invoice') ?></h1>
	        <small><?php echo display('manage_your_invoice') ?></small>
	        </div>
             <div class="col-md-6 col-sm-6">
    	        <ol class="breadcrumb">
    	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
    	            <li><a href="#"><?php echo display('invoice') ?></a></li>
    	            <li class="active"><?php echo display('manage_invoice') ?></li>
    	        </ol>
             </div>
	    </div>
	</section>

	<section class="content">
		<!-- Alert Message -->
	    <?php
	        $message = $this->session->userdata('message');
	        if (isset($message)) {
	    ?>
	    <div class="alert alert-info alert-dismissable">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	        <?php echo $message ?>                    
	    </div>
	    <?php 
	        $this->session->unset_userdata('message');
	        }
	        $error_message = $this->session->userdata('error_message');
	        if (isset($error_message)) {
	    ?>
	    <div class="alert alert-danger alert-dismissable">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	        <?php echo $error_message ?>                    
	    </div>
	    <?php 
	        $this->session->unset_userdata('error_message');
	        }
	    ?>
		<!-- Manage Invoice report -->
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <!--div class="panel-heading">
		                <div class="panel-title">
		                    <h4><--?php echo display('manage_invoice') ?></h4>
		                </div>
		            </div-->
		            <div class="panel-body">
		                <div class="table-responsive">
		                    <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
		                    	<thead>
									<tr>
										<th><?php echo display('sl') ?></th>
										<th><?php echo display('invoice_no') ?></th>
										<th><?php echo display('customer_name') ?></th>
										<th><?php echo display('date') ?></th>
										<th><?php echo display('total_amount') ?></th>
										<?php 
										    if($this->session->userdata('user_email')=="spiink2018@gmail.com"){ ?>
										<th><?php echo display('source') ?></th>
										<?php }?>
										<th><?php echo display('action') ?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									if ($invoices_list) {
									    foreach($invoices_list as $i){
								?>
									<tr>
										<td><?php echo $i['sl']; ?></td>
										<td>
											<a href="<?php echo base_url().'Cinvoice/invoice_inserted_data/'.$i['invoice_id']; ?>">
											<?php echo $i['invoice']; ?>
											</a>
										</td>
										<td>
											<a href="<?php echo base_url().'Ccustomer/customerledger/'.$i['customer_id']; ?>"><?php echo $i['customer_name']; ?></a>				
										</td>

										<td><?php echo $i['final_date']; ?></td>
										<td style="text-align: right;"><?php echo (($position==0)?"$currency ".$i['total_amount']:$i['total_amount']."$currency") ?></td>
										
										<?php 
										    if($this->session->userdata('user_email')=="spiink2018@gmail.com"){ 
										    if($i['source']=="1"){?>
										        <td> Manual </td>
										   <?php }else{ ?>
										        <td> Retail </td>
										   <?php }
										    ?>
										<?php }?>
										<td class="display_flx">
										
												<?php echo form_open()?>

													<a href="<?php echo base_url().'Cinvoice/invoice_inserted_data/'.$i['invoice_id']; ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('invoice') ?>"><i class="fa fa-window-restore" aria-hidden="true"></i></a>

													<a href="<?php echo base_url().'Cinvoice/pos_invoice_inserted_data/'.$i['invoice_id']; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('pos_invoice') ?>"><i class="fa fa-fax" aria-hidden="true"></i></a>
	                                                <?php 
													if($this->session->userdata('user_type')!=1){
														
														if($edited)
														{
															if($edited!==0)
															{?>
																<a href="<?php echo base_url().'Cinvoice/invoice_update_form/'.$i['invoice_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

															<?php }
														}?>
														<?php if($deleted)
														{
															if($deleted!==0)
															{?>
																<a href="" class="deleteInvoice btn btn-danger btn-sm" name="<?php echo $i['invoice_id'];?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
														
															<?php }
														}
													}else{?>
															<a href="<?php echo base_url().'Cinvoice/invoice_update_form/'.$i['invoice_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
															<a href="" class="deleteInvoice btn btn-danger btn-sm" name="<?php echo $i['invoice_id'];?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
														
													<?php }?>
													<!--a href="<?php echo base_url().'Cinvoice/invoice_update_form/'.$i['invoice_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

													<a href="" class="deleteInvoice btn btn-danger btn-sm" name="<?php echo $i['invoice_id']?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a-->
													
													<a href="<?php echo base_url().'Cinvoice/invoice_challan/'.$i['invoice_id']; ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Challan"><i class="fa fa-file-o" aria-hidden="true"></i></a>
													
													<a class="btn btn-info btn-sm" onclick="return_invoice(this,'<?php echo $i['invoice_id'];?>');" data-toggle="tooltip" data-placement="left" title="<?php echo display('return') ?> "><i class="fa fa-undo" aria-hidden="true"></i></a>
											
												<?php echo form_close()?>
										
										</td>
									</tr>
								<?php
									    }
									}
								?>
								</tbody>
								<div id="a"></div>
		                    </table>
		                    <div class="text-right"><?php echo $links?></div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</section>
</div>
<!-- Manage Invoice End -->

<div id="return" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo display('return');?></h4>
      </div>
      <div class="modal-body">
				<?php echo form_open_multipart('Cinvoice/invoice_return', array('class' => 'form-vertical','id' => 'return_invoice'))?>
		          
		                <div class="table-responsive">
						<input type="hidden" id="invoice_id" name="invoice_id" >
						<input type="hidden" id="customer_id" name="customer_id" >
		                   <br> <table id="return_tbl" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
                                        <th class="text-center"><?php echo display('sl') ?></th> 
                                        <th class="text-center"><?php echo display('item_information') ?></th>
                                        <th class="text-center"><?php echo display('cartoon') ?></th>
                                        <th class="text-center"><?php echo display('item') ?></th>
                                        <th class="text-center"><?php echo display('rate') ?></th>
                                        <th class="text-center"><?php echo display('discount')." Rs." ?> </th>
                                        <th class="text-center"><?php echo display('tax') ?>%</th>
                                        <th class="text-center"><?php echo display('return')." ".display('cartoon') ?></th>
                                        <th class="text-center"><?php echo display('total') ?></th>
									</tr>
								</thead>
								<tbody>
								
								</tbody>
		                    </table>
		                </div>
						<div class="row">
							<div class="col-md-2"><label><?php echo display('reason');?></label></div>
							<div class="col-md-10"><input type="text" id="reason" name="reason"></div>
						</div>
						<br>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo display('close');?></button>
						<button type="submit" class="btn btn-primary"><?php echo display('return');?></button>
					  </div>
                    <?php echo form_close()?>
      </div>
    </div>

  </div>
</div>
<!-- Delete Invoice ajax code -->
<script type="text/javascript">
	//Delete Invoice Item 
	$(".deleteInvoice").click(function()
	{	
		var invoice_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("<?php echo display('are_you_sure') ?>");
		if (x==true){
		$.ajax
		   ({
				type: "POST",
				url: '<?php echo base_url('Cinvoice/invoice_delete')?>',
				data: {invoice_id:invoice_id,csrf_test_name:csrf_test_name},
				cache: false,
				success: function(datas)
				{
					window.reload();
				} 
			});
		}
	});
	
	function return_invoice(obj,invoice_id)
	{
		
				  $('#return').modal('show'); 
 		$.ajax
	   ({
			type: "POST",
			url: '<?php echo base_url('Cinvoice/get_invoice')?>',
			data: {invoice_id:invoice_id},
			cache: false,
			success: function(data)
			{
				//alert(data);
                obj = JSON.parse(data);
				//$("#a").html(data);
				 	var row="";
					var j=1;
					var grand_total_amount="";
					var total_discount="";
					var total_tax="";
				  $.each(obj, function(i, item) {
					var tax=parseFloat(item.cgst)+parseFloat(item.sgst)+parseFloat(item.igst)+parseFloat(item.utgst);
					var this_price=parseFloat(item.total_price)-parseFloat(item.this_discount)+parseFloat(item.this_tax);
					
					row +="<tr><td>"+j+"</td><td>"+item.product_name+" <input type='hidden' name='invoice_details_id[]' value='"
						+item.invoice_details_id+"'/><input type='hidden' name='product_id[]' value='"+item.product_id+"'/></td><td>"
						+item.cartoon+"<input type='hidden' id='cartoon-"+j+"' name='cartoon[]' value='"
						+item.cartoon+"'/></td><td>"+item.quantity+"<input type='hidden' id='qty-"+j+"' name='quantity[]' value='"
						+item.quantity+"'/></td><td>"+item.rate+"<input type='hidden' id='rate-"+j+"' name='rate[]' value='"
						+item.rate+"'/></td><td>"+item.discount+"<input type='hidden' id='discount-"+j+"' name='discount[]' value='"
						+item.discount+"'/><input type='hidden' id='this_discount-"+j+"' name='this_discount[]' value='"
						+item.this_discount+"'/></td><td>"+tax+"<input type='hidden' id='tax-"+j+"' name='tax[]' value='"+tax
						+"'/><input type='hidden' id='this_tax-"+j+"' name='this_tax[]' value='"+item.this_tax
						+"'/></td><td><input type='text' name='return_item[]' value='0' onkeyup='cal_return(this,"+j
						+")'></td><td id='total_price-"+j+"'>"+item.total_price
						+"</td><td hidden><input type='hidden' id='r_total_price-"+j
						+"' name='r_total_price[]' value='"+item.total_price+
						"'/><input type='hidden' id='this_price-"+j
						+"' name='this_price[]' value='"+this_price+"'/></td></tr>";
					j++;
					grand_total_amount=item.total_amount;
					total_discount=item.total_discount;
					total_tax=item.total_tax;
					$("#invoice_id").val(item.invoice_id);
					$("#customer_id").val(item.customer_id);
				  });
				  row +="<tr><td colspan='8'></td><td><input id='r_amount' value='"+grand_total_amount+
				  "' disabled></td><td hidden><input type='hidden' id='r_total_amount' name='r_total_amount' value='"+grand_total_amount+"'></td></tr>";
				  $("#return_tbl tbody").empty().append(row);
				 
				 // $('#return').modal('show'); 
			} 
		}); 
	}
	
	function cal_return(obj,id)
	{
		var r_qty=$(obj).val();
		if(r_qty=='')
		{
			r_qty=0;
		}
			var qty=$("#qty-"+id).val();
			var cartoon=$("#cartoon-"+id).val();
			var rate=$("#rate-"+id).val();
			var discount=$("#discount-"+id).val();
			var this_discount=$("#this_discount-"+id).val();
			var tax=$("#tax-"+id).val();
			var this_tax=$("#this_tax-"+id).val();
			var r_amount=$("#r_amount").val();
			var r_total=$("#this_price-"+id).val();
			var total_amount=0;
			var grand_total_amount=0;
			var p_discount=0;
			var per_cartoon=parseFloat(qty)/parseFloat(cartoon);
			var n_qty=parseFloat(cartoon)-parseFloat(r_qty);
			var amount=parseFloat(n_qty)*parseFloat(per_cartoon)*parseFloat(rate);
			if(discount!=0)
			{
				p_discount=parseFloat(n_qty)*parseFloat(per_cartoon)*discount;
				total_amount=parseFloat(amount)-parseFloat(p_discount);
			}else{
				total_amount=parseFloat(amount);
			}
			if(tax!=0)
			{
				p_tax=total_amount*(parseFloat(tax))/100;;
				total_amount=total_amount*(100+(parseFloat(tax)))/100;
			}
			grand_total_amount=parseFloat(r_amount)-parseFloat(r_total)+parseFloat(total_amount);
			
			/* alert("r_qty="+r_qty);
			alert("rate="+rate);
			alert("discount="+discount);
			alert("tax="+tax);
			alert("r_amount="+r_amount); */
			$("#this_price-"+id).val(total_amount.toFixed(2));
			$("#r_amount").val(grand_total_amount.toFixed(2));
			$("#r_total_amount").val(grand_total_amount.toFixed(2));
			$("#total_price-"+id).html(amount.toFixed(2));
			$("#r_total_price-"+id).val(amount.toFixed(2));
			$("#this_discount-"+id).val(p_discount.toFixed(2));
			$("#this_tax-"+id).val(p_tax.toFixed(2));
		//}
		
	}
	
/* 	$(".returninvoice").click(function()
	{	
		var invoice_id=$("#invoice_id").val();
		var reason=$("#reason").val();
		//alert(reason);
		var x = confirm("<?php echo display('are_you_sure_for_return') ?> ?");
 		if (x==true){
		$.ajax
	   ({
			type: "POST",
			url: '<?php echo base_url('Cinvoice/invoice_return')?>',
			data: {invoice_id:invoice_id,reason:reason},
			cache: false,
			success: function(data)
			{
				//$("#a").html(data);
				location.reload();
			} 
		});
		} 
	}); */
</script>