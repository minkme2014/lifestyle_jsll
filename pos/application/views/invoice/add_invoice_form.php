<?php
    $CI =& get_instance();
    $CI->load->model('Web_settings');
    $Web_settings = $CI->Web_settings->retrieve_setting_editdata();
?>

<!-- Customer js php -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/json/customer.js.php" ></script>
<!-- Product invoice js -->
<!--script src="<?php echo base_url()?>my-assets/js/admin_js/json/product_invoice.js.php" ></script-->
<script src="<?php echo base_url()?>my-assets/js/admin_js/json/product_list_invoice.js.php" ></script>
<!-- Invoice js -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/invoice.js" type="text/javascript"></script>

<!-- Add new invoice start -->
<style>
.select_list span.select2.select2-container {
    width: 100% !important;
}
    #bank_info_hide
    {
        display:none;
    }
    #payment_from_2
    {
        display:none;
    }
</style>
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

    /*added by jeevan start*/
 .search_drop1 .filterData li {
    list-style-type: none;
}                          
       .search_drop1 {
    position: absolute;
    z-index: 900;
    height: 200px;
    overflow: scroll;
    background: #ffff;
}

</style>
<!-- Customer type change by javascript start -->
<script type="text/javascript">
    function bank_info_show(payment_type)
    {
        if(payment_type.value=="1"){
            document.getElementById("bank_info_hide").style.display="none";
        }
        else{ 
            document.getElementById("bank_info_hide").style.display="block";  
        }
    }
        
    function active_customer(status)
    {
        if(status=="payment_from_2"){
            document.getElementById("payment_from_2").style.display="none";
            document.getElementById("payment_from_1").style.display="block";
            document.getElementById("myRadioButton_2").checked = false;
            document.getElementById("myRadioButton_1").checked = true;
        }
        else{
            document.getElementById("payment_from_1").style.display="none";
            document.getElementById("payment_from_2").style.display="block";
            document.getElementById("myRadioButton_2").checked = false;
            document.getElementById("myRadioButton_1").checked = true;
        }
    }
</script>
<!-- Customer type change by javascript end -->

<!-- Add New Invoice Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <div class="col-md-6 col-sm-6 ">
            <h1><?php echo display('new_invoice') ?></h1>
            <small><?php echo display('add_new_invoice') ?></small>
                </div>
            <div class="col-md-6 col-sm-6">
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('invoice') ?></a></li>
                <li class="active"><?php echo display('new_invoice') ?></li>
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
        <!--Add Invoice -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <!--div class="panel-heading">
                        <div class="panel-title">
                            <h4><--?php echo display('new_invoice') ?></h4>
                        </div>
                    </div-->
                    <?php echo form_open_multipart('Cinvoice/insert_invoice',array('class' => 'form-vertical', 'id' => '','name' => ''))?>
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-sm-12 col-md-12" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="customer_name" class="col-sm-4 col-md-2 col-form-label"><?php echo
                                     display('customer_name') ?> <i class="text-danger"><?php if($Web_settings[0]['customer_required']=="1") { echo "*";} ?></i></label>
                                    <div class="col-sm-8  col-md-3">
                                       <input type="text" size="100"  name="customer_name" class="customerSelection form-control margon_btm" placeholder='<?php echo display('customer_name') ?>' id="customer_name" tabindex="1" />

                                        <input id="customer_id" class="customer_hidden_value" type="hidden" name="customer_id">
                                    </div>
                                    
                                    
                                    
                                     <label for="date" class="col-sm-4 col-md-2 col-form-label"><?php echo display('date') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8  col-md-3">
                                       <?php date_default_timezone_set("Asia/Dhaka"); $date = date('Y-m-d'); ?>
                                        <input class="datepicker form-control margon_btm" type="text" size="50" name="invoice_date" id="date" required value="<?php echo $date; ?>" tabindex="3" />
                                    </div>
                                    <div  class=" col-sm-6  col-md-2">
                                        <!--input id="myRadioButton_1" type="button" onClick="active_customer('payment_from_1')" id="myRadioButton_1" class="btn btn-success checkbox_account" name="customer_confirm" checked="checked" value="<?php echo display('new_customer') ?>" tabindex="2"-->
                                        
							<?php 
							if($this->session->userdata('user_type')!=1) 
							{
								if($created)
								{
									if($created!==0)
									{?>
										<button type="button" class="btn btn-success" data-toggle="modal" data-target="#customer_modal"><?php echo display('new_customer') ?></button>
                                    <?php }
								}	
							}else{?>
										<button type="button" class="btn btn-success" data-toggle="modal" data-target="#customer_modal"><?php echo display('new_customer') ?></button>
                                    
							<?php }?>
									</div>
                                </div>
                            </div>

                            <div class="col-sm-12  col-md-12" id="payment_from_2">
                               <div class="form-group row">
                                    <label for="customer_name_others" class="col-sm-4  col-md-2 col-form-label"><?php echo display('payee_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8  col-md-3">
                                       <input  autofill="off" type="text"  size="100" name="customer_name_others " placeholder='<?php echo display('payee_name') ?>' id="customer_name_others" class="form-control margon_btm" />
                                    </div>
                                      <label for="customer_name_others_address" class="col-sm-4  col-md-2 col-form-label"><?php echo display('address') ?> </label>
                                    <div class="col-sm-8 col-md-3">
                                       <input type="text"  size="100" name="customer_name_others_address" class=" form-control margon_btm" placeholder='<?php echo display('address') ?>' id="customer_name_others_address" />
                                    </div>

                                    <div  class="col-sm-6  col-md-2">
                                        <input  onClick="active_customer('payment_from_2')" type="button" id="myRadioButton_2" class="checkbox_account btn btn-success" name="customer_confirm_others" value="<?php echo display('old_customer') ?>">
                                    </div>
                                </div>

                              
                            </div>
                            
                        <?php if($Web_settings[0]['usr_commission']=="1") { 
                     	?> 
                            <div class="col-sm-12 col-md-12" >
                                <div class="form-group row">
                                    <label for="sales_prsn" class="col-sm-4 col-md-2 col-form-label"><?php echo display('select_sales_person');?></label>
                                    <div class="col-sm-8  col-md-3">
                                       <select class="customerSelection form-control margon_btm" name="sales_prsn">
                                           <option value="0">-- Select --</option>
                                           <?php if($sales_person){ foreach($sales_person as $sp){?>  
                                           <option value="<?php echo $sp['id'];?>"><?php echo $sp['first_name']." ".$sp['last_name'];?></option>
                                           <?php } } ?>
                                       </select>
                                    </div>
                                
                                </div>
                            </div>
                            <?php } ?>

                        </div>


                        <div class="table-responsive" style="margin-top: 10px">
                            <table class="table table-bordered table-hover" id="normalinvoice">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_information') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('uom') ?> </th>
                                        <th class="text-center"><?php echo display('available_ctn') ?></th>
                                        <th class="text-center"><?php echo display('Carton/Qty') ?></th>
                                        <th class="text-center"><?php echo display('item') ?></th>
                                        <th class="text-center"><?php echo display('quantity') ?></th>
                                        <th class="text-center"><?php echo display('rate') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('discount')." Rs." ?> </th>
                                        <th class="text-center">Discount % </th>
                                        <th class="text-center"><?php echo display('tax') ?>%</th>
                                        <th class="text-center"><?php echo display('total') ?> 
                                        </th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="addinvoiceItem">
                                    <tr>
                                        <td style="width: 14%">
                                            <!--input type="text" name="product_name" onkeypress="<?php if($Web_settings[0]['cust_price']=="1") { echo 'invoice_productList2(1)'; }else{ echo 'invoice_productList(1)';}?> ;" class="form-control productSelection" 
                                            placeholder='<?php echo display('product_name') ?>' required="" id="product_name" tabindex="4" <?php if($Web_settings[0]['customer_required']=="1") {  ?>disabled <?php } ?> -->
                                            
                                            <input type="text" name="product_name" onkeyup="<?php if($Web_settings[0]['cust_price']=="1") { echo 'invoice_productList2(this,1)'; }else{ echo 'invoice_productList(this,1)';}?> ;" class="form-control productSelection" 
                                            placeholder='<?php echo display('product_name') ?>' required="" id="product_name" tabindex="4" <?php if($Web_settings[0]['customer_required']=="1") {  ?>disabled <?php } ?> >   
                                            
                                            <?php if($Web_settings[0]['customer_required']=="1") {  ?>
											<span class="text-danger" id="warning"><?php echo display('please_select_customer_befor_selecting_product');?></span>
											<?php }?>

                                            <input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id[]" id="SchoolHiddenId"/>

                                            <input type="hidden" class="baseUrl" value="<?php echo base_url();?>" />
                                        </td>
                                        <td style="width: 10%">
                                            <input type="text" name="uom[]" class="form-control text-right uom_1" value="" readonly="" style="width:100px;text-align: left;"/>
                                        </td>
                                        <td style="width: 14%">
                                            <input type="text" name="available_quantity[]" class="form-control text-right available_quantity_1" value="" readonly="" />
                                        </td>
                                        <td style="width: 14%">
                                            <input type="text" name="cartoon[]" onkeyup="quantity_calculate(1);" onchange="quantity_calculate(1);" class="quantity_1 form-control text-right" value="" min="1" tabindex="5" placeholder="0.00" />
                                        </td>
                                        <td style="width: 14%">
                                            <input type="text" name="" class="ctnqntt_1 form-control text-right" readonly="" />
                                        </td>
                                        <td style="width: 14%">
                                            <input type="text" name="product_quantity[]" class="total_qntt_1 form-control text-right" readonly=""  placeholder="0.00"/>
                                        </td>
                                        <td  style="width: 14%">
                                            <input type="text" name="product_rate[]" value="" id="price_item_1" class="price_item1 price_item form-control text-right" tabindex="6" required="" onkeyup="quantity_calculate(1);" onchange="quantity_calculate(1);" style="width: 67px;"/>
                                        </td>
                                        <!-- Discount -->
                                        <td style="width: 14%">
                                            <input type="text" name="discount[]" onkeyup="quantity_calculate(1);" onchange="quantity_calculate(1);" id="discount_1" class="discount_1 form-control text-right" value="" min="0" tabindex="7" placeholder="0.00"/>
                                        </td>
                                        <td style="width: 14%">
                                            <input type="text" onkeyup="quantity_calculate_per(1);" onchange="quantity_calculate_per(1);" id="discount_per_1" class="discount_per_1 form-control text-right" value="" min="0" tabindex="7" placeholder="0.00"/>
                                        </td>
                                       <!-- tax -->
                                        <td class="text-center" width="16%">
                                            <label class="switch">
											  <input type="checkbox" id="tax_1" class="tax_1" name="tax_1" onchange="quantity_calculate(1);" checked>
											  <span class="slider round"></span>
											</label><br>
												<div id="cgst_tax_1">
												  <?php echo display('cgst');?>-<input type="text" id="cgst_1" class="cgst_1" name="cgst[]" onkeyup="quantity_calculate(1);"  onchange="quantity_calculate(1);" style="width:20px;border:none;">
												</div>
												<div id="sgst_tax_1">
												  <?php echo display('sgst');?>-<input type="text" id="sgst_1" class="sgst_1" name="sgst[]" onkeyup="quantity_calculate(1);"  onchange="quantity_calculate(1);" style="width:20px;border:none;">
												</div>
												<div id="igst_tax_1">
												  <?php echo display('igst');?>-<input type="text" id="igst_1" class="igst_1" name="igst[]" onkeyup="quantity_calculate(1);"  onchange="quantity_calculate(1);" style="width:20px;border:none;">
												</div>
												<div id="utgst_tax_1">
												  <?php echo display('utgst');?>-<input type="text" id="utgst_1" class="utgst_1" name="utgst[]" onkeyup="quantity_calculate(1);"  onchange="quantity_calculate(1);" style="width:20px;border:none;">
												</div>
									   </td>
										
                                        <td  style="width: 14%">
                                            <input class="total_price form-control text-right" type="text" name="total_price[]" id="total_price_1" value="" tabindex="-1" readonly="readonly" />
                                        </td>

                                        <td>
                                            <!-- Tax calculate start-->
                                            <input type="hidden" id="total_tax_1" class="total_tax_1" />
                                            <input type="hidden" id="type_1" name="type[]" class="type_1" />
                                            <input type="hidden" id="all_tax_1" class="total_tax"/>
                                            <!-- Tax calculate end -->

                                            <!-- Discount calculate start-->
                                            <input type="hidden" id="total_discount_1" class="total_discount_1" />
                                            <input type="hidden" id="all_discount_1" class="total_discount" value='discount'  name="discount_row[]" />
                                            <!-- Discount calculate end -->
											
                                            <!-- total after discount and tax-->
                                            <input type="hidden" id="total_row_1" class="total_row_1" value='total'/>
                                            <input type="hidden" id="tax_row_1" class="tax_row" name="tax_row[]" value='tax'/>
                                            <!-- total after discount and tax end -->

                                            <button style="text-align: right;" class="btn btn-danger" type="button" value="<?php echo display('delete')?>" onclick="deleteRow(this)" tabindex="8"><?php echo display('delete')?></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    
                                    <tr>
                                        <td style="text-align:right;" colspan="10"><b><?php echo display('total_discount') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="total_discount_ammount" class="form-control text-right" name="total_discount" tabindex="" value="0.00" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right;" colspan="10"><b><?php echo display('total_tax') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="total_tax_ammount" class="form-control text-right" name="total_tax" tabindex="" value="0.00" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="10"  style="text-align:right;"><b><?php echo display('delivery_charges') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" onkeyup="calculateSum();" id="delivery_charges" tabindex="" class="form-control text-right" name="delivery_charges" placeholder="0.00"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="10"  style="text-align:right;"><b><?php echo display('freight_charges') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" onkeyup="calculateSum();" id="freight_charges" tabindex="" class="form-control text-right" name="freight_charges" placeholder="0.00"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="10"  style="text-align:right;"><b><?php echo display('packaging') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" onkeyup="calculateSum();" id="packaging" tabindex="" class="form-control text-right" name="packaging" placeholder="0.00"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="10"  style="text-align:right;"><b><?php echo display('grand_total') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal" tabindex="" class="form-control text-right" name="grand_total_price" value="0.00" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="10"  style="text-align:right;"><b><?php echo display('transaction_mode') ?>:</b></td>
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
                                            <input type="button" id="add-invoice-item" class="btn btn-info" name="add-invoice-item"  onClick="addnewInputField('addinvoiceItem');" value="<?php echo display('add_new_item') ?>" tabindex="9"  <?php if($Web_settings[0]['customer_required']=="1") {  ?>disabled <?php } ?>/>

                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/>
                                        </td>
                                        <td style="text-align:right;" colspan="9"><b><?php echo display('paid_ammount') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="number" id="paidAmount" 
                                            onkeyup="invoice_paidamount();" class="form-control text-right" name="paid_amount" value="" placeholder='0.00' tabindex=""/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="display_flx" align="center">
										
										<?php 
										if($this->session->userdata('user_type')!=1) 
										{
											if($created)
											{
												if($created!==0)
												{?>
												<input type="submit" id="add-invoice" class="btn btn-success" name="add-invoice" value="<?php echo display('submit') ?>" tabindex=""/>
												<?php }
											}	
										}else{?>
												 <input type="submit" id="add-invoice" class="btn btn-success" name="add-invoice" value="<?php echo display('submit') ?>" tabindex=""/>

										<?php }?>
														
                                            <input type="button" id="full_paid_tab" class="btn btn-warning" name="" value="<?php echo display('full_paid') ?>" tabindex="" onClick="full_paid();"/>
                                        </td>

                                        
                                      
                                        <td style="text-align:right;" colspan="9"><b><?php echo display('due') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="dueAmmount" class="form-control text-right" name="due_amount" value="0.00" readonly="readonly"/>
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
<!-- Modal -->
  <div class="modal fade" id="customer_modal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo display('add_customer') ?></h4>
        </div>
        <div class="modal-body">
        
                    	<div class="form-group row">
                            <div class="col-sm-2 margon_btm">
                             <label><?php echo display('salutation') ?></label>
							</div>
                            <div class="col-sm-4 margon_btm select_list">
                             <select class="form-control" id="salutation" name="salutation"  tabindex='1' required>
								<option value="0">-- <?php echo display('salutation') ?> --</option>
									<option value="Mr.">Mr.</option>
									<option value="Mrs.">Mrs.</option>
									<option value="Ms.">Ms.</option>
									<option value="Miss.">Miss.</option>
									<option value="Dr.">Dr.</option>
								</select>
							</div>
                             <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="cust_name" id="cust_name" type="text" placeholder="<?php echo display('customer_name') ?>"  required=""  tabindex='1'>
                            </div>
                        </div>
                    	<div class="form-group row">
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="company" id="company" type="text" placeholder="<?php echo display('company') ?>"  required=""  tabindex='2'>
                            </div>
                              <div class="col-sm-6">
                                <input class="form-control" name ="email" id="email" type="email" placeholder="<?php echo display('customer_email') ?>" tabindex='2'>
                            </div>
                        </div>
   
                        <div class="form-group row">
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="mobile" id="mobile" type="number" placeholder="<?php echo display('customer_mobile') ?>" min="0" max="10" tabindex='3' required="">
                            </div>
                              <div class="col-sm-6">
                                <input class="form-control" name ="gst_no" id="gst_no" placeholder="GST Number" tabindex='3'>
                            </div>
                        </div>
						
                        <div class="form-group row">
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="state_code" id="state_code" placeholder="State Code " tabindex='3'>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control" name="previous_balance" id="previous_balance" type="number" placeholder="<?php echo display('previous_balance') ?>" tabindex='5'>
                            </div>
                        </div>
   
                        <div class="form-group row">
                            <!--label for="mobile" class="col-sm-3 col-form-label"><--?php echo display('customer_mobile') ?></label-->
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="website" id="website" type="text" placeholder="<?php echo display('website') ?>" tabindex='3'>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control" name ="facebook" id="facebook" placeholder="<?php echo display('facebook') ?>" tabindex='3'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <!--label for="mobile" class="col-sm-3 col-form-label"><--?php echo display('customer_mobile') ?></label-->
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="twitter" id="twitter" type="text" placeholder="<?php echo display('twitter') ?>" tabindex='3'>
                            </div>
                        </div>
                        <div class="form-group row" hidden>
                            <div class="col-sm-12">
                                <textarea class="form-control" name="address" id="address" rows="3" placeholder="<?php echo display('customer_address') ?>" tabindex='4'></textarea>
                            </div>
                          
                        </div>
                         <!--div class="form-group row">
                            <div class="col-sm-12">
                                <textarea class="form-control" name="bill" id="bill" rows="3" placeholder="<?php echo 'Billing Address'; ?>" tabindex='4'></textarea>
                            </div>
                          
                        </div>
						<div class="form-group row">
                            <div class="col-sm-12">
                                <textarea class="form-control" name="delivery" id="delivery" rows="3" placeholder="<?php echo 'Delivery Address'; ?>" tabindex='4'></textarea>
                            </div>
                          
                        </div-->
						
                        <div class="form-group row">
                            <!--label for="address " class="col-sm-3 col-form-label"><--?php echo display('customer_address') ?></label-->
                            <div class="col-sm-6">
								<label for="address " class="col-sm-6 col-form-label"><?php echo display('billing_address') ?></label>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('attention') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<input class="form-control" name ="attention_billing" id="attention_billing" type="text" placeholder="<?php echo display('attention') ?>" tabindex='3'>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('country') ?></label>
									</div>
									<div class="col-sm-10 margon_btm select_list">
									<?php $countries=$this->db->get('countries')->result_array();
										//print_r($countries);								
										?>
                                       <select class=" form-control margon_btm" id="country_billing" name="country_billing" onchange="get_states(this,'state_billing')">
                                           <option value="0">-- Select Country--</option>
                                           <?php if($countries){ foreach($countries as $c){?>  
                                           <option value="<?php echo $c['id'];?>"><?php echo $c['name'];?></option>
                                           <?php } } ?>
                                       </select>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('state') ?></label>
									</div>
									<div class="col-sm-10 margon_btm select_list">
                                       <select class="customerSelection form-control margon_btm" name="state_billing" id="state_billing" onchange="get_cities(this,'city_billing')">
                                           <option value="0">-- Select State--</option>
                                       </select>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('city') ?></label>
									</div>
									<div class="col-sm-10 margon_btm select_list">
                                       <select class="customerSelection form-control margon_btm" name="city_billing" id="city_billing">
                                           <option value="0">-- Select City--</option>
                                       </select>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('billing_address') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<textarea class="form-control" name="bill" id="bill_add" rows="3" placeholder="<?php echo display('billing_address') ?>" ></textarea>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('zip_code') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<input class="form-control" name ="billing_zip_code" id="billing_zip_code" type="text" placeholder="<?php echo display('zip_code') ?>" tabindex='3'>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('fax') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<input class="form-control" name ="billing_fax" id="billing_fax" type="text" placeholder="<?php echo display('fax') ?>" tabindex='3'>
									</div>
									</div>
								</div>
                            </div>
                           <div class="col-sm-6">
								<label for="address " class="col-sm-6 col-form-label"><?php echo display('delivery_address') ?></label>
                                <div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('attention') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<input class="form-control" name ="attention_shipping" id="attention_shipping" type="text" placeholder="<?php echo display('attention') ?>" >
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('country') ?></label>
									</div>
									<div class="col-sm-10 margon_btm select_list">
									<?php $countries=$this->db->get('countries')->result_array();
										//print_r($countries);								
										?>
                                       <select class="customerSelection form-control margon_btm" id="country_shipping" name="country_shipping" onchange="get_states(this,'state_shipping')">
                                           <option value="0">-- Select Country--</option>
                                           <?php if($countries){ foreach($countries as $c){?>  
                                           <option value="<?php echo $c['id'];?>"><?php echo $c['name'];?></option>
                                           <?php } } ?>
                                       </select>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('state') ?></label>
									</div>
									<div class="col-sm-10 margon_btm select_list">
                                       <select class="customerSelection form-control margon_btm" name="state_shipping" id="state_shipping" onchange="get_cities(this,'city_shipping')">
                                           <option value="0">-- Select State--</option>
                                       </select>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('city') ?></label>
									</div>
									<div class="col-sm-10 margon_btm select_list">
                                       <select class="customerSelection form-control margon_btm" name="city_shipping" id="city_shipping">
                                           <option value="0">-- Select City--</option>
                                       </select>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('delivery_address') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<textarea class="form-control" name="delivery" id="delivery_add" rows="3" placeholder="<?php echo display('delivery_address') ?>" ></textarea>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('zip_code') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<input class="form-control" name ="shipping_zip_code" id="shipping_zip_code" type="text" placeholder="<?php echo display('zip_code') ?>" tabindex='3'>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('fax') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<input class="form-control" name ="shipping_fax" id="shipping_fax" type="text" placeholder="<?php echo display('fax') ?>" tabindex='3'>
									</div>
									</div>
								</div>
                            </div>
                        </div>
                 <input type="text" class="form-control" name="redirect" id="redirect"  value="invoice" style="display:none;" />

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="submit" id="inv_cust" onclick="addcustomer();" class="btn btn-primary btn-large" name="add-customer" value="<?php echo display('save') ?>"  tabindex='6'/>
                            </div>
                        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Modal -->
<div id="cat_sale_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Category wise sale</h4>
      </div>
      <div class="modal-body">
	  
		<table id="cat_sale_list" class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th><?php echo display('sl') ?></th>
					<th>Category Name</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Invoice Report End -->

<script>

function get_states(obj,select_list)
{
	var country_id=$(obj).val();
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('Ccustomer/get_states'); ?>",
		data: {'country_id':country_id},
		success: function (response) {
		//	alert(response);
			 $('#'+select_list).children().remove().end().append(response) ;
		}
	});
}
function get_cities(obj,select_list)
{
	var state_id=$(obj).val();
	//alert(state_id);
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('Ccustomer/get_cities'); ?>",
		data: {'state_id':state_id},
		success: function (response) {
		//	alert(response);
			 $('#'+select_list).children().remove().end().append(response) ;
		}
	});
}

$(document).ready(function () {
 //   getProduct();
   $(document).on("keyup", function (e) {
    //   console.log("e.keyCode  : "+(e.keyCode));
       if (e.altKey && e.keyCode === 65) { //key alt+a //add row
          addnewInputField('addinvoiceItem');
     }
      if (e.altKey && e.keyCode === 83) { //key alt+s  to submit
          //done done yet
          $("#add-invoice").click();
     }
        if (e.altKey && e.keyCode === 87) { //key alt+w  to show category wise sale
            getCategoryWiseSale();
        }
    })
    });

function addcustomer()
{
    var customer_name=$("#cust_name").val();
    var salutation=$("#salutation").val();
    $("#customer_name").val(customer_name);
    var email=$("#email").val();
    var mobile=$("#mobile").val();
    var gst_no=$("#gst_no").val();
    var state_code=$("#state_code").val();
    var previous_balance=$("#previous_balance").val();
    var website=$("#website").val();
    var facebook=$("#facebook").val();
    var twitter=$("#twitter").val();
    var bill=$("#bill_add").val();
    var delivery=$("#delivery_add").val();
    var address=$("#address").val();
    var attention_billing=$("#attention_billing").val();
    var attention_shipping=$("#attention_shipping").val();
    var country_billing=$("#country_billing").val();
    var country_shipping=$("#country_shipping").val();
    var state_billing=$("#state_billing").val();
    var state_shipping=$("#state_shipping").val();
    var city_billing=$("#city_billing").val();
    var city_shipping=$("#city_shipping").val();
    var billing_zip_code=$("#billing_zip_code").val();
    var shipping_zip_code=$("#shipping_zip_code").val();
    var billing_fax=$("#billing_fax").val();
    var company=$("#company").val();
    var shipping_fax=$("#shipping_fax").val();
    var redirect=$("#redirect").val();
    if(customer_name=="")
    {
        alert("Plese fill Name");
    }else if(mobile=="")
    {
        alert("Plese fill Mobile");
    }else{
             
    var data = new FormData();
    data.append('customer_name',customer_name);
    data.append('salutation',salutation);
    data.append('company',company);
    data.append('email',email);
    data.append('mobile',mobile);
    data.append('gst_no',gst_no);
    data.append('state_code',state_code);
    data.append('previous_balance',previous_balance);
    data.append('website',website);
    data.append('twitter',twitter);
    data.append('facebook',facebook);
    data.append('bill',bill);
    data.append('delivery',delivery);
    data.append('address',address);
    data.append('attention_billing',attention_billing);
    data.append('attention_shipping',attention_shipping);
    data.append('country_billing',country_billing);
    data.append('country_shipping',country_shipping);
    data.append('state_billing',state_billing);
    data.append('state_shipping',state_shipping);
    data.append('city_billing',city_billing);
    data.append('city_shipping',city_shipping);
    data.append('billing_zip_code',billing_zip_code);
    data.append('shipping_zip_code',shipping_zip_code);
    data.append('billing_fax',billing_fax);
    data.append('shipping_fax',shipping_fax);
    data.append( 'redirect',redirect);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Ccustomer/insertCustomer'); ?>",
            data: data,
            processData: false,
            contentType: false,
            success: function (response) {
                if(response=="Already Exists !")
                {
                    alert(response);
                }else{
                    alert("Successfully Added");
                    $("#customer_id").val(response);
                }
                    $('#customer_modal').modal('toggle');
             
            }
        });
    }
}
function addnewInputField(t) {
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
          var a = "product_name" + count;
            tabindex = count * 5 ;
            e = document.createElement("tr");
            tab1 = tabindex + 1;
            tab2 = tabindex + 2;
            tab3 = tabindex + 3;
            tab4 = tabindex + 4;
            tab5 = tabindex + 5;
            tab6 = tabindex + 6;
            tab7 = tabindex + 7;
            tab8 = tabindex + 8;
            tab9 = tabindex + 9;
 
        e.innerHTML = "<td>"+
        "<input type='text' name='product_name' onkeyup='<?php if($Web_settings[0]["cust_price"]=="1") { ?>invoice_productList2(this," + count + ")<?php  }else{ ?> invoice_productList(this," + count + ") <?php } ?>' class='form-control productSelection' placeholder='Product Name' id='" + a + "' required tabindex='"+tab1+"'>"+
        "<input type='hidden' class='autocomplete_hidden_value product_id_" + count + "' name='product_id[]' id='SchoolHiddenId_" + count + "'/></td>"+
        "<td><input type='text' name='uom[]' class='form-control text-right uom_" + count + "'  value='' readonly='readonly' style='width:50px;'/></td>"+
        "<td><input type='text' name='available_quantity[]' id='' class='form-control text-right available_quantity_" + count + "' value='' readonly='readonly' /></td>"+
        "<td>"+
        "<input type='text'  placeholder='0.00' name='cartoon[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' class='quantity_" + count + " form-control text-right' value='' min='1' tabindex='"+tab2+"'/></td>"+
        "<td>"+
        "<input type='text' class='ctnqntt_" + count + " form-control text-right' readonly='readonly' /></td>"+
        "<td>"+
        "<input type='text' placeholder='0.00' name='product_quantity[]' class='total_qntt_" + count + " form-control text-right' readonly='readonly' /></td>"+
        "<td>"+
        "<input type='text' name='product_rate[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' value='' id='price_item_" + count + "' class='price_item"+count+" form-control text-right' required tabindex='"+tab3+"' style='width:67px;' /></td>"+
       
         "<td>"+
        "<input type='text' placeholder='0.00' name='discount[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='discount_" + count + "' class='form-control text-right' placeholder='Discount' value='' min='0' tabindex='"+tab4+"'/></td>"+
		
         "<td>"+
        "<input type='text' placeholder='0.00' onkeyup='quantity_calculate_per(" + count + ");' onchange='quantity_calculate_per(" + count + ");' id='discount_per_" + count + "' class='form-control text-right' placeholder='Discount %' value='' min='0' tabindex='"+tab4+"'/></td>"+
		
        "<td class='text-center' width='16%'>"+
        "<label class='switch'>"+
		"<input type='checkbox' id='tax_" + count + "' class='tax_" + count + "' name='tax_" + count + "' onchange='quantity_calculate(" + count + ");' checked>"+
		"<span class='slider round'></span>"+
		"</label><br>"+
		"<div id='cgst_tax_" + count + "'>CGST-<input type='text' id='cgst_" + count + "' class='cgst_" + count + "' name='cgst[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ")' style='width:20px;border:none;'></div>"+
		"<div id='sgst_tax_" + count + "'>SGST-<input type='text' id='sgst_" + count + "' class='sgst_" + count + "' name='sgst[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ")' style='width:20px;border:none;'></div>"+
		"<div id='igst_tax_" + count + "'>IGST-<input type='text' id='igst_" + count + "' class='igst_" + count + "' name='igst[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ")' style='width:20px;border:none;'></div>"+
		"<div id='utgst_tax_" + count + "'>UTGST-<input type='text' id='utgst_" + count + "' class='utgst_" + count + "' name='utgst[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ")' style='width:20px;border:none;'></div></td>"+
        "<td class='text-right'>"+
        "<input class='total_price form-control text-right' type='text' name='total_price[]' id='total_price_" + count + "' value='' readonly='readonly'/></td>"+
        "<td>"+
        "<input type='hidden' id='total_tax_" + count + "' class='total_tax_" + count + "' />"+
        "<input type='hidden' name='type[]' id='type_" + count + "' class='type_" + count + "' />"+
        "<input type='hidden' id='all_tax_" + count + "' class=' total_tax' />"+
        "<input type='hidden' id='all_discount_" + count + "' class='total_discount'  name='discount_row[]' value='discount' />"+
		"<input type='hidden' id='total_row_" + count + "' class='total_row_" + count + "'  value='total' />"+
		"<input type='hidden' id='tax_row_" + count + "' class='tax_row'  name='tax_row[]'  value='tax' />"+
        "<button style='text-align: right;' class='btn btn-danger' type='button' tabindex='"+tab5+"' value='Delete' onclick='deleteRow(this)'>Delete</button></td>";

        document.getElementById(t).appendChild(e); 
        document.getElementById(a).focus();
        document.getElementById("add-invoice-item").setAttribute("tabindex", tab6);
        document.getElementById("paidAmount").setAttribute("tabindex", tab7);
        document.getElementById("full_paid_tab").setAttribute("tabindex", tab8);
        document.getElementById("add-invoice").setAttribute("tabindex", tab9);
	//	debugger;
        count++;

    }
}

</script>