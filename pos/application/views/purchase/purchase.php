<!-- Manage Purchase Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('manage_purchase') ?></h1>
	        <small><?php echo display('manage_your_purchase') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('purchase') ?></a></li>
	            <li class="active"><?php echo display('manage_purchase') ?></li>
	        </ol>
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


		<!-- Manage Purchase report -->
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('manage_purchase') ?></h4>
		                </div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive">
		                    <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th><?php echo display('sl') ?></th>
										<th><?php echo display('invoice_no') ?></th>
										<th><?php echo display('supplier_name') ?></th>
										<th><?php echo display('purchase_date') ?></th>
										<th><?php echo display('total_ammount') ?></th>
										<th><?php echo display('action') ?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									if ($purchases_list) {
								?>
								{purchases_list}
									<tr>
										<td>{sl}</td>
										<td>
											<a href="<?php echo base_url().'Cpurchase/purchase_details_data/{purchase_id}'; ?>">
												{chalan_no}
											</a>
										</td>
										<td>
											<a href="<?php echo base_url().'Csupplier/supplier_details/{supplier_id}'; ?>">
												{supplier_name}
											</a>
										</td>
										<td>{final_date}</td>
										<td style="text-align: right;"><?php echo (($position==0)?"$currency {grand_total_amount}":"{grand_total_amount} $currency") ?></td>
										<td>
											<center>
											<?php echo form_open()?>
															
											<?php 
											if($this->session->userdata('user_type')!=1) 
											{
												if($edited)
												{
													if($edited!==0)
													{?>
														<a href="<?php echo base_url().'Cpurchase/purchase_update_form/{purchase_id}'; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
													<?php }
												}	
											}else{?>
													<a href="<?php echo base_url().'Cpurchase/purchase_update_form/{purchase_id}'; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

											<?php }?>			
											<?php 
											if($this->session->userdata('user_type')!=1) 
											{
												if($deleted)
												{
													if($deleted!==0)
													{?>
														<a href="" class="deletePurchase btn btn-danger btn-sm" name="{purchase_id}" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
												<?php }
												}	
											}else{?>
														<a href="" class="deletePurchase btn btn-danger btn-sm" name="{purchase_id}" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
											
											<?php }?>
												<a class="btn btn-success btn-sm" onclick="return_purchanse(this,'{purchase_id}');" data-toggle="tooltip" data-placement="left" title="<?php echo display('return') ?> "><i class="fa fa-undo" aria-hidden="true"></i></a>
											
											</center>
											<?php echo form_close()?>
										</td>
									</tr>
								{/purchases_list}
								<?php
									}
								?>
								</tbody>
		                    </table>
							<div id="a"></div>
		                </div>
		                <div class="text-right"><?php echo $links?></div>
		            </div>
		        </div>
		    </div>
		</div>
	</section>
</div>

<!-- Manage Purchase End -->

<div id="return" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo display('return');?></h4>
      </div>
      <div class="modal-body">
                  <?php echo form_open_multipart('Cpurchase/purchase_return', array('class' => 'form-vertical','id' => 'return_purchase'))?>
		                <div class="table-responsive">
						<input type="hidden" id="purchase_id" name="purchase_id" >
		                   <br> <table id="return_tbl" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
                                        <th class="text-center"><?php echo display('sl') ?></th> 
                                        <th class="text-center"><?php echo display('item_information') ?></th> 
                                        <!--th class="text-center"><?php echo display('available_stock_qty') ?></th-->
                                        <th class="text-center"><?php echo display('item') ?> <?php echo display('qty') ?></th>
                                        <!--th class="text-center"><?php echo display('updated_stock_qty') ?> </th-->
                                        <th class="text-center"><?php echo display('rate') ?></th>
                                        <th class="text-center"><?php echo display('discount_all') ?>%</th>
                                        <th class="text-center"><?php echo display('tax') ?>%</th>
                                        <th class="text-center"><?php echo display('return')." ".display('qty') ?></th>
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
<!-- Delete Purchase ajax code -->
<script type="text/javascript">
	function return_purchanse(obj,purchase_id)
	{
		$.ajax
	   ({
			type: "POST",
			url: '<?php echo base_url('Cpurchase/get_purchase')?>',
			data: {purchase_id:purchase_id},
			cache: false,
			success: function(data)
			{
                obj = JSON.parse(data);
				//$("#a").html(data);
					var row="";
					var j=1;
					var grand_total_amount="";
				  $.each(obj, function(i, item) {
					var tax=parseFloat(item.cgst)+parseFloat(item.sgst)+parseFloat(item.igst)+parseFloat(item.utgst);
					//row +="<tr><td>"+j+"</td><td>"+item.product_name+"</td><td>"+item.item_qty+"</td><td>"+item.rate+"</td><td>"+item.discount+"</td><td>"+tax+"</td><td>"+item.total_amount+"</td></tr>";
					row +="<tr><td>"+j+"</td><td>"+item.product_name+"<input type='hidden' name='purchase_detail_id[]' value='"
					+item.purchase_detail_id+"'/><input type='hidden' name='product_id[]' value='"+item.product_id+"'/></td><td id='qty-"
					+j+"'>"+item.item_qty+"<input type='hidden' name='item_qty[]' value='"+item.item_qty+"'/></td><td id='rate-"+j+"'>"
					+item.rate+"<input type='hidden' name='rate[]' value='"+item.rate+"'/></td><td id='discount-"+j+"'>"+item.discount
					+"<input type='hidden' name='discount[]' value='"+item.discount+"'/></td><td id='tax-"+j+"'>"+tax
					+"<input type='hidden' name='tax[]' value='"+tax
					+"'/></td><td><input type='text' name='return_item[]' value='0' onkeyup='cal_return(this,"+j+")'></td><td id='r_total-"
					+j+"' >"+item.total_amount+"</td><td hidden><input type='text' id='return_total-"+j+"' name='r_total[]' value='"
					+item.total_amount+"' /></td></tr>";
					j++;
					grand_total_amount=item.grand_total_amount;
					$("#purchase_id").val(item.purchase_id);
				  });
				  row +="<tr><td colspan='7'></td><td><input id='r_amount' value='"+grand_total_amount+"' disabled></td><td hidden><input id='r_total_amount' name='r_total_amount' value='"+grand_total_amount+"'></td></tr>";
				  $("#return_tbl tbody").empty().append(row);
				/* alert(data);
				$('#r').html(data); */
				  $('#return').modal('show'); 
			} 
		});
	}
	
	function cal_return(obj,id)
	{
		debugger;
		var r_qty=$(obj).val();
		if(r_qty=='')
		{
			r_qty=0;
		}
			
			var qty=$("#qty-"+id).html();
			var rate=$("#rate-"+id).html();
			var discount=$("#discount-"+id).html();
			var tax=$("#tax-"+id).html();
			var r_amount=$("#r_amount").val();
			var r_total=$("#r_total-"+id).html();
			var total_amount=0;
			var grand_total_amount=0;
			var n_qty=parseFloat(qty)-parseFloat(r_qty)
			var amount=parseFloat(n_qty)*parseFloat(rate);
			if(discount!=0)
			{
				total_amount=parseFloat(amount)*(100-(parseFloat(discount)))/100;
			}else{
				total_amount=parseFloat(n_qty)*parseFloat(rate);
			}
			if(tax!=0)
			{
				total_amount=total_amount*(100+(parseFloat(tax)))/100;
			}
			grand_total_amount=parseFloat(r_amount)-parseFloat(r_total)+parseFloat(total_amount);
			
			/* alert("r_qty="+r_qty);
			alert("rate="+rate);
			alert("discount="+discount);
			alert("tax="+tax);
			alert("r_amount="+r_amount); */
			$("#r_amount").val(grand_total_amount.toFixed(2));
			$("#r_total_amount").val(grand_total_amount.toFixed(2));
			$("#r_total-"+id).html(total_amount.toFixed(2));
			$("#return_total-"+id).val(total_amount.toFixed(2));
		//}
		
	}
	
	//Delete Purchase Item 
	$(".deletePurchase").click(function()
	{	
		var purchase_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("<?php echo display('are_you_sure') ?> ?");
		if (x==true){
		$.ajax
	   ({
			type: "POST",
			url: '<?php echo base_url('Cpurchase/purchase_delete')?>',
			data: {purchase_id:purchase_id,csrf_test_name:csrf_test_name},
			cache: false,
			success: function(datas)
			{
			} 
		});
		}
	});
	
/* 	$(".returnpurchase").click(function()
	{	
		var purchase_id=$("#purchase_id").val();
		var reason=$("#reason").val();
		//alert(reason);
		var x = confirm("<?php echo display('are_you_sure_for_return') ?> ?");
		if (x==true){
		$.ajax
	   ({
			type: "POST",
			url: '<?php echo base_url('Cpurchase/purchase_return')?>',
			data: {purchase_id:purchase_id,reason:reason},
			cache: false,
			success: function(data)
			{
				location.reload();
			} 
		});
		}
	}); */
</script>