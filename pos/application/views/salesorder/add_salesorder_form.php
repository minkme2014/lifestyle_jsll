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

<!-- Add new sales order start -->

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

<!-- Add New sales order Start -->
<div class="content-wrapper">

    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('new_sales_odr') ?></h1>
            <small><?php echo display('add_sales_odr') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('sales_order') ?></a></li>
                <li class="active"><?php echo display('add_sales_odr') ?></li>
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
        <!--Add Invoice -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <?php echo form_open_multipart('Csalesorder/insert_sales_order',array('class' => 'form-vertical', 'id' => '','name' => ''))?>
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-sm-12 col-md-12">
                                <div class="form-group row">
                                    <label for="customer_name" class="col-sm-4 col-md-2 col-form-label"><?php echo
                                     display('customer_name') ?> <i class="text-danger"><?php if($Web_settings[0]['customer_required']=="1") { echo "*";} ?></i></label>
                                    <div class="col-sm-8  col-md-3">
                                       <input type="text" size="100"  name="customer_name" class="customerSelection form-control margon_btm" placeholder='<?php echo display('customer_name') ?>' id="customer_name" tabindex="1" />

                                        <input id="customer_id" class="customer_hidden_value" type="hidden" name="customer_id">
                                    </div>
                                    
                                    
                                    
                                     <label for="date" class="col-sm- col-md-2 col-form-label text-right"><?php echo display('date') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8  col-md-3">
                                       <?php date_default_timezone_set("Asia/Dhaka"); $date = date('Y-m-d'); ?>
                                        <input class="datepicker form-control margon_btm" type="text" size="50" name="s_odr_date" id="date" required value="<?php echo $date; ?>" tabindex="3" />
                                    </div>
                           
                                </div>
                            </div>

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
                                
                                    <label for="odr_no" class="col-sm-4 col-md-2 col-form-label text-right"><?php echo display('sales_odr_no');?></label>
                                    <div class="col-sm-8  col-md-3">
                                       <input type="text" tabindex="2" class="form-control" name="odr_no" id="odr_no" value="{odr_no}" required  />
                                    </div>
                                
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group row">
                                     <label for="ref_no" class="col-sm- col-md-2 col-form-label"><?php echo display('ref_no') ?> </label>
                                    <div class="col-sm-8  col-md-3">
                                       <input type="text" tabindex="2" class="form-control" name="ref_no" id="ref_no" />
                                    </div>
                                    
                                     <label for="shipment_date" class="col-sm- col-md-2 col-form-label text-right"><?php echo display('shipment_date') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8  col-md-3">
                                       <?php date_default_timezone_set("Asia/Dhaka"); $date = date('Y-m-d'); ?>
                                        <input class="datepicker form-control margon_btm" type="text" size="50" name="shipment_date" id="shipment_date"  value="<?php echo $date; ?>" tabindex="3" />
                                    </div>
                           
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group row">
                                     <label for="ref_no" class="col-sm- col-md-2 col-form-label"><?php echo display('delivery_method') ?> </label>
                                    <div class="col-sm-8  col-md-3">
                                       <input type="text" class="form-control" name="delivery_method" id="delivery_method" />
                                    </div>
                                    
                                </div>
                            </div>

                        </div>


                        <div class="table-responsive" style="margin-top: 10px">
                            <table class="table table-bordered table-hover" id="normalinvoice">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_information') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('uom') ?> </th>
                                        <th class="text-center"><?php echo display('Carton/Qty') ?></th>
                                        <th class="text-center"><?php echo display('item') ?></th>
                                        <th class="text-center"><?php echo display('quantity') ?></th>
                                        <th class="text-center"><?php echo display('rate') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('discount')." Rs." ?> </th>
                                        <th class="text-center"><?php echo display('tax') ?>%</th>
                                        <th class="text-center"><?php echo display('total') ?> 
                                        </th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="addinvoiceItem">
                                    <tr>
                                        <td style="width: 14%">
                                           
                                            <input type="text" name="product_name" onkeyup="<?php if($Web_settings[0]['cust_price']=="1") { echo 'invoice_productList2(this,1)'; }else{ echo 'invoice_productList(this,1)';}?> ;" class="form-control productSelection" 
                                            placeholder='<?php echo display('product_name') ?>' required="" id="product_name" tabindex="4" <?php if($Web_settings[0]['customer_required']=="1") {  ?>disabled <?php } ?> >   
                                            
                                            <?php if($Web_settings[0]['customer_required']=="1") {  ?>
											<span class="text-danger" id="warning"><?php echo display('please_select_customer_befor_selecting_product');?></span>
											<?php }?>

                                            <input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id[]" id="SchoolHiddenId"/>

                                            <input type="hidden" class="baseUrl" value="<?php echo base_url();?>" />
                                        </td>
                                        <td style="width: 13%">
                                            <input type="text" name="uom[]" class="form-control text-right uom_1" value="" readonly="" style="width:100px;"/>
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
                                       <!-- tax -->
                                        <td class="text-center" width="16%">
                                            <label class="switch">
											  <input type="checkbox" id="tax_1" class="tax_1" name="tax_1" onchange="quantity_calculate(1);" checked>
											  <span class="slider round"></span>
											</label><br>
												<div id="cgst_tax_1" style="width:80px;">
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
                                        <td style="text-align:right;" colspan="9"><b><?php echo display('total_discount') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="total_discount_ammount" class="form-control text-right" name="total_discount" tabindex="" value="0.00" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right;" colspan="9"><b><?php echo display('total_tax') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="total_tax_ammount" class="form-control text-right" name="total_tax" tabindex="" value="0.00" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr hidden>
                                        <td colspan="9"  style="text-align:right;"><b><?php echo display('delivery_charges') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" onkeyup="calculateSum();" id="delivery_charges" tabindex="" class="form-control text-right" name="delivery_charges" placeholder="0.00"/>
                                        </td>
                                    </tr>
                                    <tr hidden>
                                        <td colspan="9"  style="text-align:right;"><b><?php echo display('freight_charges') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" onkeyup="calculateSum();" id="freight_charges" tabindex="" class="form-control text-right" name="freight_charges" placeholder="0.00"/>
                                        </td>
                                    </tr>
                                    <tr hidden>
                                        <td colspan="9"  style="text-align:right;"><b><?php echo display('packaging') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" onkeyup="calculateSum();" id="packaging" tabindex="" class="form-control text-right" name="packaging" placeholder="0.00"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9"  style="text-align:right;"><b><?php echo display('grand_total') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal" tabindex="" class="form-control text-right" name="grand_total_price" value="0.00" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr hidden>
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
                                            <input type="button" id="add-invoice-item" class="btn btn-info" name="add-invoice-item"  onClick="addnewInputField('addinvoiceItem');" value="<?php echo display('add_new_item') ?>" tabindex="9"  <?php if($Web_settings[0]['customer_required']=="1") {  ?>disabled <?php } ?>/>

                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
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
													
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </section>

</div>

<script>

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
        document.getElementById("add-invoice").setAttribute("tabindex", tab7);
	//	debugger;
        count++;

    }
}

</script>