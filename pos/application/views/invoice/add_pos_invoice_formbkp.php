<?php
    $CI =& get_instance();
    $CI->load->model('Web_settings');
    $Web_settings = $CI->Web_settings->retrieve_setting_editdata();
?>

<!-- Customer js php -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/customer.js.php" ></script>
<!-- Product invoice js -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/product_invoice.js.php" ></script>
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
                                        <input type="text" name="product_name" class="form-control margon_btm" placeholder='<?php echo display('barcode_qrcode_scan_here') ?>' id="add_item" autocomplete='off'>
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

                                        <input id="SchoolHiddenId" class="customer_hidden_value" type="hidden" name="customer_id" value="{customer_id}">
                                        <?php
                                        if (empty($customer_name)) {
                                            ?>
                                            <small id="emailHelp" class="text-danger"><?php echo display('please_add_walking_customer_for_default_customer') ?></small>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div  class="col-sm-4 col-md-2">
                                        <input id="myRadioButton_1" type="button" onClick="active_customer('payment_from_1')" id="myRadioButton_1" class="btn btn-success checkbox_account" name="customer_confirm" checked="checked" value="<?php echo display('new_customer') ?> ">
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
                                           <option>-- Select Sales Person --</option>
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
                                        <th class="text-center">UOM</th>
                                        <th class="text-center"><?php echo display('available_ctn') ?></th>
                                        <th class="text-center"><?php echo display('cartoon') ?></th>
                                        <th class="text-center"><?php echo display('item') ?></th>
                                        <th class="text-center"><?php echo display('quantity') ?></th>
                                        <th class="text-center"><?php echo display('rate') ?></th>
                                        <th class="text-center"><?php echo display('discount') ?></th>
                                        <th class="text-center">Tax</th>
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
                                        <td style="text-align:right;" colspan="10"><b>Total Tax:</b></td>
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
                                        <td style="text-align:right;" colspan="10"><b><?php echo display('grand_total') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url(); ?>"/>
                                            <input type="text" id="grandTotal" tabindex="-1" class="form-control text-right" name="grand_total_price" value="0.00" min="0" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input type="button" id="add-invoice-item" class="btn btn-info text-center" name="add-invoice-item"  onClick="addInputField('addinvoiceItem');" value="<?php echo display('add_new_item') ?>" />
                                        </td>
                                        <td style="text-align:right;" colspan="9"><b><?php echo display('paid_amount') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="paidAmount" 
                                                   onkeyup="invoice_paidamount();"  tabindex="-1" class="form-control text-right" name="paid_amount" value="0.00" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="display_flx" align="center">
                                            <input type="submit" id="add-invoice" class="btn btn-success" name="add-invoice" value="<?php echo display('submit') ?>" />
											
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
    </section>
</div>
<!-- POS Invoice Report End -->

<script type="text/javascript">

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
            $.ajax({
                type: "post",
                async: false,
                url: '<?php echo base_url('Cinvoice/insert_pos_invoice') ?>',
                data: {product_id: product_id},
                success: function (data) {
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
</script>
