<?php
    $CI =& get_instance();
    $CI->load->model('Web_settings');
    $Web_settings = $CI->Web_settings->retrieve_setting_editdata();
?>

<!-- Customer js php -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/customer.js.php" ></script>
<!-- Product invoice js -->
<!--script src="<?php echo base_url()?>my-assets/js/admin_js/json/product_invoice.js.php" ></script-->
<script src="<?php echo base_url()?>my-assets/js/admin_js/json/product_list_invoice.js.php" ></script>
<!-- Invoice js -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/invoice.js" type="text/javascript"></script>

<!-- Add new invoice start -->
<style>
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
</style>
<!-- Customer type change by javascript start -->
<script type="text/javascript">
    function bank_info_show(payment_type)
    {
        if (payment_type.value == "1") {
            document.getElementById("bank_info_hide").style.display = "none";
        } else {
            document.getElementById("bank_info_hide").style.display = "block";
        }
    }

    function active_customer(status)
    {
        if (status == "payment_from_2") {
            document.getElementById("payment_from_2").style.display = "none";
            document.getElementById("payment_from_1").style.display = "block";
            document.getElementById("myRadioButton_2").checked = false;
            document.getElementById("myRadioButton_1").checked = true;
        } else {
            document.getElementById("payment_from_1").style.display = "none";
            document.getElementById("payment_from_2").style.display = "block";
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
            <h1><?php echo display('new_pos_invoice') ?></h1>
            <small><?php echo display('add_new_pos_invoice') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('Invoice') ?></a></li>
                <li class="active"><?php echo display('new_pos_invoice') ?></li>
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

        <!-- POS Invoice report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <!--div class="panel-heading">
                        <div class="panel-title">
                            <h4><--?php echo display('new_pos_invoice') ?></h4>
                        </div>
                    </div-->

                        <?php echo form_open_multipart('Cinvoice/insert_invoice', array('class' => 'form-vertical', 'id' => '', 'name' => 'insert_pos_invoice')) ?>
                   
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                   
                                    <div class="col-sm-6  col-md-3">
                                        <input type="text" name="product_name" class="form-control margon_btm" placeholder='<?php echo display('barcode_qrcode_scan_here') ?>' id="add_item" autocomplete='off'  <?php if($Web_settings[0]['customer_required']=="1") {  ?>disabled <?php } ?> >
                                        <input type="hidden" id="product_value" name="">
                                    </div>
                             
                                    <div class="col-sm-6  col-md-3">
                                        <?php date_default_timezone_set("Asia/Dhaka");
                                        $date = date('Y-m-d');
                                        ?>
                                        <input class="form-control margon_btm" type="text" size="50" id="invoice_date" name="invoice_date" required value="<?php echo $date; ?>" required/>
                                    </div>
                                        <div class="col-sm-8 col-md-4">
                                        <input type="text" size="100"  name="customer_name" class="customerSelection form-control margon_btm" placeholder='<?php echo display('customer_name') ?>' id="customer_name1" value="{customer_name}" />

                                        <input id="customer_id" class="customer_hidden_value" type="hidden" name="customer_id" value="{customer_id}">
                                        <?php
                                        if (empty($customer_name)) {
                                            ?>
                                            <!--small id="emailHelp" class="text-danger"><?php echo display('please_add_walking_customer_for_default_customer') ?></small-->
                                            <small id="emailHelp" class="text-danger"><?php if($Web_settings[0]['customer_required']=="1") { echo display('please_select_customer_befor_selecting_product');}?></small>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div  class="col-sm-4 col-md-2">
                                        <!--input id="myRadioButton_1" type="button" onClick="active_customer('payment_from_1')" id="myRadioButton_1" class="btn btn-success checkbox_account" name="customer_confirm" checked="checked" value="<?php echo display('new_customer') ?> "-->
                                        
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
                        </div>


                        <div class="row">
                            <div class="col-sm-12" id="payment_from_1">
                                <!--div class="form-group row">
                                    <label for="customer_name1" class="col-sm-4  col-form-label"><--?php echo display('customer_name') ?> <i class="text-danger">*</i></label>
                                
                                </div-->
                            </div>

                            <div class="col-sm-12" id="payment_from_2">
                                <div class="form-group row">
                                    <!--label for="customer_name_others" class="col-sm-4 col-form-label"><--?php echo display('payee_name') ?> <i class="text-danger">*</i></label-->
                                    <div class="col-sm-4">
                                        <input  autofill="off" type="text"  size="100" name="customer_name_others" placeholder='<?php echo display('payee_name') ?>' id="customer_name_others" class="form-control margon_btm"/>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text"  size="100" name="customer_name_others_address" class=" form-control margon_btm" placeholder='<?php echo display('address') ?>' id="customer_name_others_address" />
                                    </div>
                                    <div  class="col-sm-3">
                                        <input  onClick="active_customer('payment_from_2')" type="button" id="myRadioButton_2" class="btn btn-success checkbox_account" name="customer_confirm_others" value="<?php echo display('old_customer') ?> ">
                                    </div>
                              
                                    <!--label for="customer_name_others_address" class="col-sm-4 col-form-label"><--?php echo display('address') ?></label-->
                                   
                                </div> 
                            </div>
                        </div>
                        <?php if($Web_settings[0]['usr_commission']=="1") { 
                     	?> 
                        <div class="row">
                            <div class="col-sm-12" >
                                <div class="form-group row">
                                    <div class="col-sm-8  col-md-3">
                                       <select class="customerSelection form-control margon_btm" name="sales_prsn">
                                           <option>-- <?php echo display('select_sales_person') ?> --</option>
                                           <?php if($sales_person){ foreach($sales_person as $sp){?>  
                                           <option value="<?php echo $sp['id'];?>"><?php echo $sp['first_name']." ".$sp['last_name'];?></option>
                                           <?php } } ?>
                                       </select>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                        <?php } ?>
        

                        <div class="table-responsive" style="margin-top: 10px">
                            <table class="table table-bordered table-hover" id="addinvoice">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_information') ?></th>
                                        <th class="text-center"><?php echo display('uom') ?></th>
                                        <th class="text-center"><?php echo display('available_ctn') ?></th>
                                        <th class="text-center"><?php echo display('cartoon') ?></th>
                                        <th class="text-center"><?php echo display('item') ?></th>
                                        <th class="text-center"><?php echo display('quantity') ?></th>
                                        <th class="text-center"><?php echo display('rate') ?></th>
                                        <th class="text-center"><?php echo display('discount') ?></th>
                                        <th class="text-center"><?php echo display('tax');?></th>
                                        <th class="text-center"><?php echo display('total') ?></th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="addinvoiceItem">
                                    <tr></tr>
                                </tbody>
                                <tfoot>

                                    <tr style="width: 85px">
                                        <td style="text-align:right;" colspan="10"><b><?php echo display('total_discount') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="total_discount_ammount" class="form-control text-right" name="total_discount" tabindex="-1" value="0.00" readonly="readonly" />
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
                                        <td style="text-align:right;" colspan="10"><b><?php echo display('grand_total') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url(); ?>"/>
                                            <input type="text" id="grandTotal" tabindex="-1" class="form-control text-right" name="grand_total_price" value="0.00" min="0" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input type="button" id="add-invoice-item" class="btn btn-info text-center" name="add-invoice-item"  onClick="addnewInputField('addinvoiceItem');" value="<?php echo display('add_new_item') ?>"  <?php if($Web_settings[0]['customer_required']=="1") {  ?>disabled <?php } ?> />
                                        </td>
                                        <td style="text-align:right;" colspan="9"><b><?php echo display('paid_amount') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="paidAmount" 
                                                   onkeyup="invoice_paidamount();"  tabindex="-1" class="form-control text-right" name="paid_amount" value="0.00" />
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
                                        <td class="display_flx" align="center">
										
										<?php 
										if($this->session->userdata('user_type')!=1) 
										{
											if($created)
											{
												if($created!==0)
												{?>
												 <input type="submit" id="add-invoice" class="btn btn-success" name="add-invoice" value="<?php echo display('submit') ?>" />
													<?php }
													}	
												}else{?>
														 <input type="submit" id="add-invoice" class="btn btn-success" name="add-invoice" value="<?php echo display('submit') ?>" />
													
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
                        
<?php echo form_close() ?>

                    </div>
                </div>
            </div>
        </div>
        
<!-- Modal -->
  <div class="modal fade" id="customer_modal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Customer</h4>
        </div>
        <div class="modal-body">
        
                    	<div class="form-group row">
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="cust_name" id="cust_name" type="text" placeholder="<?php echo display('customer_name') ?>"  required=""  tabindex='1'>
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
   
                        <div class="form-group row" hidden>
                            <div class="col-sm-12">
                                <textarea class="form-control" name="address" id="address" rows="3" placeholder="<?php echo display('customer_address') ?>" tabindex='4'></textarea>
                            </div>
                          
                        </div>
                         <div class="form-group row">
                            <div class="col-sm-12">
                                <textarea class="form-control" name="bill" id="bill" rows="3" placeholder="<?php echo 'Billing Address'; ?>" tabindex='4'></textarea>
                            </div>
                          
                        </div>
						<div class="form-group row">
                            <div class="col-sm-12">
                                <textarea class="form-control" name="delivery" id="delivery" rows="3" placeholder="<?php echo 'Delivery Address'; ?>" tabindex='4'></textarea>
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
    </section>
</div>
<!-- POS Invoice Report End -->

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
<script type="text/javascript">

$(document).ready(function () {
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

    //Onload filed select
    window.onload = function () {
        var text_input = document.getElementById('add_item');
        text_input.focus();
        text_input.select();
    }


    //Invoice js
    var scanned_barcode="";
    $('#add_item').keydown(function (e) {
        if (e.keyCode == 13) {
            var product_id = $(this).val();
          //  alert(product_id);
            var customer_id=$("#customer_id").val();
            $.ajax({
                type: "post",
                async: false,
                url: '<?php echo base_url('Cinvoice/insert_pos_invoice') ?>',
                data: {product_id: product_id,customer_id:customer_id},
                success: function (data) {
                  //  alert(data);
                    if (data == false) {
                        alert('This Product Not Found !');
                        document.getElementById('add_item').value = '';
                        document.getElementById('add_item').focus();
                        calculateSum();
                        invoice_paidamount();
                    } else {
                        if(scanned_barcode.indexOf("product_code_"+product_id)>-1 && $("#product_code_"+product_id).length>0)
                        {
                            var qty=$("#product_code_"+product_id).val();
                            $("#product_code_"+product_id).val(parseFloat(qty)+1);
                            document.getElementById('add_item').value = '';
                            document.getElementById('add_item').focus();
                            $("#product_code_"+product_id).keyup();
                            calculateSum();
                            invoice_paidamount();
                            return false;
                        }
                        else
                        {
                          scanned_barcode=scanned_barcode+"product_code_"+product_id+"^";  
                        }
                        
                        $("#hidden_tr").css("display", "none");
                        document.getElementById('add_item').value = '';
                        document.getElementById('add_item').focus();
                        $('#addinvoice tbody').append(data);
                        calculateSum();
                        invoice_paidamount();
                    }
                },
                error: function () {
                    alert('Request Failed, Please check your code and try again!');
                }
            });
            return false;
        }
    });
    
function addcustomer()
{
    var customer_name=$("#cust_name").val();
    $("#customer_name1").val(customer_name);
    var email=$("#email").val();
    var mobile=$("#mobile").val();
    var gst_no=$("#gst_no").val();
    var state_code=$("#state_code").val();
    var previous_balance=$("#previous_balance").val();
    var bill=$("#bill").val();
    var delivery=$("#delivery").val();
    var address=$("#address").val();
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
    data.append('email',email);
    data.append('mobile',mobile);
    data.append('gst_no',gst_no);
    data.append('state_code',state_code);
    data.append('previous_balance',previous_balance);
    data.append('bill',bill);
    data.append('delivery',delivery);
    data.append('address',address);
    data.append( 'redirect',redirect);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Ccustomer/insert_customer'); ?>",
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
            tab9 = tabindex + 10;

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
