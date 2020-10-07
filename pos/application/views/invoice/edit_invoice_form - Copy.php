<?php
    $CI =& get_instance();
    $CI->load->model('Web_settings');
    $Web_settings = $CI->Web_settings->retrieve_setting_editdata();
?>

<!-- Customer js php -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/json/customer.js.php" ></script>
<!-- Product invoice js -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/json/product_invoice.js.php" ></script>
<!-- Invoice js -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/invoice.js" type="text/javascript"></script>

<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<!-- Edit Invoice Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('invoice_edit') ?></h1>
            <small><?php echo display('invoice_edit') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('invoice') ?></a></li>
                <li class="active"><?php echo display('invoice_edit') ?></li>
            </ol>
        </div>
    </section>

    <section class="content">
        <!-- Invoice report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <!--div class="panel-heading">
                        <div class="panel-title">
                            <h4><--?php echo display('invoice_edit') ?></h4>
                        </div>
                    </div-->
                    <?php echo form_open('Cinvoice/invoice_update',array('class' => 'form-vertical','id'=>'invoice_update' ))?>
                    <div class="panel-body">
             
                        <div class="row">
                        	<div class="col-sm-6 edit_update_in" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-4 col-form-label"><?php echo display('customer_name') ?> <i class="text-danger"><?php if($Web_settings[0]['customer_required']=="1") { echo "*";} ?></i></label>
                                    <div class="col-sm-8">
                                       <input type="text" name="customer_name" value="{customer_name}" class="form-control customerSelection" placeholder='<?php echo display('customer_name') ?>'  id="customer_name" tabindex="1">

										<input type="hidden" class="customer_hidden_value" name="customer_id" value="{customer_id}" id="SchoolHiddenId"/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 edit_update_in">
                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-4 col-form-label"><?php echo display('date') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" tabindex="2" class="form-control datepicker" name="invoice_date" value="{date}"  required />
                                    </div>
                                </div>
                            </div>
                                  
                        <?php if($Web_settings[0]['usr_commission']=="1") { 
                     	?>    
                            <div class="col-sm-6 edit_update_in" >
                                <div class="form-group row">
                                    <label for="customer_name" class="col-sm-4 col-form-label"><?php echo display('select_sales_person') ?></label>
                                    <div class="col-sm-8">
                                       <select class="customerSelection form-control margon_btm" name="sales_prsn">
                                           <option>-- Select --</option>
                                           <?php if($sales_person){ foreach($sales_person as $sp){?>  
                                           <option value="<?php echo $sp['id'];?>"  <?php if($sp['id']==$user_id): echo "selected";endif;?>><?php echo $sp['first_name']." ".$sp['last_name'];?></option>
                                           <?php } } ?>
                                       </select>
                                    </div>
                                
                                </div>
                            </div>
                            <?php } ?>
                        </div>

                        

                        <div class="table-responsive" style="margin-top: 10px">
                            <table class="table table-bordered table-hover">
         						<thead>
									<tr>
                                        <th class="text-center"><?php echo display('item_information') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('uom') ?></th>
                                        <th class="text-center"><?php echo display('cartoon') ?></th>
                                        <th class="text-center"><?php echo display('item') ?></th>
                                        <th class="text-center"><?php echo display('quantity') ?></th>
                                        <th class="text-center"><?php echo display('rate') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('discount')." Rs." ?> </th>
                                        <th class="text-center"><?php echo display('tax') ?>%</th>
                                        <th class="text-center"><?php echo display('total') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
								</thead>
								<tbody id="addinvoiceItem">
								<?php foreach($invoice_all_data as $invoice){?>
									<tr>
										<td class="" style="width: 200px;">
											<input type="text" name="product_name" onclick="invoice_productList(<?php echo $invoice['sl']?>);" value="<?php echo $invoice['product_name'].'-('.$invoice['product_model'].')';?>" class="form-control productSelection" required placeholder='<?php echo display('product_name') ?>' id="product_names" tabindex="3">

											<input type="hidden" class="product_id_<?php echo $invoice['sl']?> autocomplete_hidden_value" name="product_id[]" value="<?php echo $invoice['product_id']?>" id="SchoolHiddenId"/>
										</td>
                                        <td>
                                            <input type="text" name="uom[]" class="uom_<?php echo $invoice['sl']?> form-control text-right" value="<?php echo $invoice['uom_name']?>"  readonly />
                                        </td>
                                        <td>
                                            <input type="text" name="cartoon[]" onkeyup="quantity_calculate(<?php echo $invoice['sl']?>);" onchange="quantity_calculate(<?php echo $invoice['sl']?>);" class="quantity_<?php echo $invoice['sl']?> form-control text-right" value="<?php echo $invoice['cartoon']?>" min="1" tabindex="4"/>
                                        </td>
                                        <td>
                                            <input type="text" class="ctnqntt_<?php echo $invoice['sl']?> form-control text-right" readonly="" value="<?php echo $invoice['per_cartoon']?>" />
                                        </td>
									
                                        <td>
                                            <input type="text" name="product_quantity[]" value="<?php echo $invoice['quantity']?>" class="total_qntt_<?php echo $invoice['sl']?> form-control text-right" readonly="" />
                                        </td>

										<td>
											<input type="text" name="product_rate[]" onkeyup="quantity_calculate(<?php echo $invoice['sl']?>);" onchange="quantity_calculate(<?php echo $invoice['sl']?>);" value="<?php echo $invoice['rate']?>" id="price_item_<?php echo $invoice['sl']?>" class="price_item<?php echo $invoice['sl']?> form-control text-right" min="0" tabindex="5" required="" />
										</td>
                                        <!-- Discount -->
                                        <td>
                                            <input type="text" name="discount[]" onkeyup="quantity_calculate(<?php echo $invoice['sl']?>);"  onchange="quantity_calculate(<?php echo $invoice['sl']?>);" id="discount_<?php echo $invoice['sl']?>" class="form-control text-right" placeholder="<?php echo display('discount')?>" value="<?php echo $invoice['discount']?>" min="0" tabindex="6"/>
                                        </td>
                                       <!-- tax -->
                                        <td class="text-center" width="16%">
                                            <label class="switch">
											  <input type="checkbox" id="tax_<?php echo $invoice['sl']?>" class="tax_<?php echo $invoice['sl']?>" name="tax_<?php echo $invoice['sl']?>" onchange="quantity_calculate(<?php echo $invoice['sl']?>);" checked>
											  <span class="slider round"></span>
											</label><br>
											<?php if($invoice['cgst']!=0 ){ ?>
											  <?php echo display('cgst');?>-<input type="text" id="cgst_<?php echo $invoice['sl']?>" value="<?php echo $invoice['cgst']?>" class="cgst_<?php echo $invoice['sl']?>" name="cgst[]" onkeyup="quantity_calculate(<?php echo $invoice['sl']?>);"  onchange="quantity_calculate(<?php echo $invoice['sl']?>);" style="width:10%;border:none;">
											<?php } if($invoice['sgst']!=0 ){ ?>
											  <?php echo display('sgst');?>-<input type="text" id="sgst_<?php echo $invoice['sl']?>" value="<?php echo $invoice['sgst']?>" class="sgst_<?php echo $invoice['sl']?>" name="sgst[]" onkeyup="quantity_calculate(<?php echo $invoice['sl']?>);"  onchange="quantity_calculate(<?php echo $invoice['sl']?>);" style="width:10%;border:none;">
											<?php } if($invoice['igst']!=0 ){ ?> 
											  <?php echo display('igst');?>-<input type="text" id="igst_<?php echo $invoice['sl']?>" value="<?php echo $invoice['igst']?>" class="igst_<?php echo $invoice['sl']?>" name="igst[]" onkeyup="quantity_calculate(<?php echo $invoice['sl']?>);"  onchange="quantity_calculate(<?php echo $invoice['sl']?>);" style="width:10%;border:none;">
											<?php } if($invoice['utgst']!=0 ){ ?>
											  <?php echo display('utgst');?>-<input type="text" id="utgst_<?php echo $invoice['sl']?>" value="<?php echo $invoice['utgst']?>" class="utgst_<?php echo $invoice['sl']?>" name="utgst[]" onkeyup="quantity_calculate(<?php echo $invoice['sl']?>);"  onchange="quantity_calculate(<?php echo $invoice['sl']?>);" style="width:10%;border:none;">
											<?php } ?>
										</td>
										

										<td>
											<input class="total_price form-control text-right" type="text" name="total_price[]" id="total_price_<?php echo $invoice['sl']?>" value="<?php echo $invoice['total_price']?>" readonly="readonly" />

											<input type="hidden" name="invoice_details_id[]" id="invoice_details_id" value="<?php echo $invoice['invoice_details_id']?>"/>
										</td>
                                         <td>

                                           

                                            <!-- Discount calculate start-->
                                            <input type="hidden" id="total_discount_<?php echo $invoice['sl']?>" class="total_tax_<?php echo $invoice['sl']?>" value="<?php echo $invoice['discount']?>"/>

                                            <input type="hidden" id="all_discount_<?php echo $invoice['sl']?>" class="total_discount" name="discount_row[]"  value="<?php echo $invoice['this_discount']?>" />
                                            <!-- Discount calculate end -->

                                            <!-- total after discount and tax-->
                                            <input type="hidden" id="total_row_<?php echo $invoice['sl']?>" class="total_row_<?php echo $invoice['sl']?>" value=''/>
                                            <input type="hidden" id="tax_row_<?php echo $invoice['sl']?>" class="tax_row" name="tax_row[]" value='<?php echo $invoice['this_tax']?>'/>
                                            <!-- total after discount and tax end -->
											
                                            <button style="text-align: right;" class="deleteInvoice btn btn-danger" name="<?php echo $invoice['invoice_details_id']?>" type="button" value="<?php echo display('delete')?>" tabindex="7"><?php echo display('delete')?></button>
                                            <!--button style="text-align: right;" class="btn btn-danger" type="button" value="<?php echo display('delete')?>" onclick="deleteRow(this)" tabindex="7"><?php echo display('delete')?></button-->
                                        </td>
									</tr>
								<?php } ?>
								</tbody>
                                
								<tfoot>
								
                                    <tr>
                                        <td style="text-align:right;" colspan="9"><b><?php echo display('total_discount') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="total_discount_ammount" class="form-control text-right" name="total_discount" value="<?php echo $invoice['total_discount']?>" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right;" colspan="9"><b><?php echo display('total_tax') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="total_tax_ammount" class="form-control text-right" name="total_tax" value="<?php echo $invoice['total_tax']?>" tabindex="" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9"  style="text-align:right;"><b><?php echo display('delivery_charges') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" onkeyup="calculateSum();" id="delivery_charges" tabindex="" class="form-control text-right" name="delivery_charges" value="<?php echo $invoice['delivery_charges']?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9"  style="text-align:right;"><b><?php echo display('freight_charges') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" onkeyup="calculateSum();" id="freight_charges" tabindex="" class="form-control text-right" name="freight_charges" value="<?php echo $invoice['freight_charges']?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9"  style="text-align:right;"><b><?php echo display('packaging') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" onkeyup="calculateSum();" id="packaging" tabindex="" class="form-control text-right" name="packaging" value="<?php echo $invoice['packaging']?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9"  style="text-align:right;"><b><?php echo display('grand_total') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal" class="form-control text-right" name="grand_total_price" value="<?php echo $invoice['total_amount']?>" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9"  style="text-align:right;"><b><?php echo display('transaction_mode') ?>:</b></td>
                                        <td class="text-right">
                                               <div class="col-sm-8  col-md-4 margon_btm">
													<select onchange="bank_info_show(this)" name="payment_type" id="Transection_mood" class="form-control"  tabindex='5' style='width:90px;'>
														<option value="1"> <?php echo display('cash') ?> </option>
														<option value="2"> <?php echo display('cheque') ?> </option>
														<option value="3"> <?php echo display('pay_order') ?> </option>
														<option value="4"> <?php echo display('debit_card') ?> </option>
														<option value="5"> <?php echo display('credit_card') ?> </option>
														<option value="6"> <?php echo display('paytm') ?> </option>
														<option value="7"> <?php echo display('gpay') ?> </option>
														<option value="8"> <?php echo display('net_banking') ?> </option>
													</select>
										</td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/>
                                            <input type="hidden" name="invoice_id" id="invoice_id" value="<?php echo $invoice['invoice_id']?>"/>

                                        </td>
                                        <td style="text-align:right;" colspan="8"><b><?php echo display('paid_ammount') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="paidAmount" 
                                            onkeyup="invoice_paidamount();" class="form-control text-right" name="paid_amount" value="<?php echo $invoice['paid_amount']?>" tabindex="8"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input type="submit" id="add-invoice" class="btn btn-success btn-large" name="add-invoice" value="<?php echo display('save_changes') ?>" tabindex="9"/>
                                        </td>
                                      
                                        <td style="text-align:right;" colspan="8"><b><?php echo display('due') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="dueAmmount" class="form-control text-right" name="due_amount" value="<?php echo $invoice['due_amount']?>" readonly="readonly"/>
                                        </td>
                                    </tr>
								</tfoot>
                            </table>
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Edit Invoice End -->

<style type="text/css">
    .btn:focus {
      background-color: #6A5ACD;
    }
</style>

<script type="text/javascript">
	//Delete Invoice Item 
	
	$(".deleteInvoice").click(function()
	{	
	    var element=this;
		var invoice_details_id=$(this).attr('name');
		var x = confirm("Are You Sure,Want to Delete ?");
		if (x==true){
		$.ajax
		   ({
				type: "POST",
				url: '<?php echo base_url('Cinvoice/invoice_item_delete')?>',
				data: {invoice_details_id:invoice_details_id},
				cache: false,
				success: function(datas)
				{
					deleteRow(element);
				} 
			});
		}
	});
</script>

