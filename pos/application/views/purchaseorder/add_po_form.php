<!-- Product Purchase js -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/json/product_purchase.js.php" ></script>
<!-- Supplier Js -->
<script src="<?php echo base_url(); ?>my-assets/js/admin_js/json/supplier.js.php" ></script>
<!-- Purchase js -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/purchase.js" type="text/javascript"></script>
<style type="text/css">
    .close{color:white;}
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
<!-- Add New Purchase Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('add_po') ?></h1>
            <small><?php echo display('add_po') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('purchase_order') ?></a></li>
                <li class="active"><?php echo display('add_po') ?></li>
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
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
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

        <!-- Purchase report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">							
							<div class="container">
								<div class="row">
									<div class="col-md-6">
										<h4><?php echo display('add_po') ?></h4>
									</div>
								</div>
							</div>
                        </div>
                    </div>

                    <div class="panel-body">
                    <?php echo form_open_multipart('Cpurchaseorder/insert_po',array('class' => 'form-vertical', 'id' => 'insert_po','name' => 'insert_po'))?>
                    
                          <div class="row">
                             <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('po_date') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <?php $date = date('Y-m-d'); ?>
                                        <input type="text" tabindex="2" class="form-control datepicker" name="po_date" value="<?php echo $date; ?>" id="po_date" required  tabindex='2'/>
                                    </div>
                                </div>
                            </div>
                        </div>

                          <div class="row">
                             <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="po_no" class="col-sm-4 col-form-label"><?php echo display('po_no') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" tabindex="2" class="form-control" name="po_no" id="po_no" value="{po_no}" required  />
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                               <div class="form-group row">
                                    <label for="supplier_sss" class="col-sm-4 col-form-label"><?php echo display('supplier') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="supplier_id" id="supplier_sss" class="form-control " required=""  tabindex='1'> 
                                            <option value=" "><?php echo display('select_one') ?></option>
                                            {all_supplier}
                                            <option value="{supplier_id}">{supplier_name}</option>
                                            {/all_supplier}
                                        </select>
                                    </div>

                                </div> 
                            </div>

                        </div>

           
                        <div class="table-responsive" style="margin-top: 10px">
                            <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_information') ?><i class="text-danger">*</i></th> 
                                        <th class="text-center" hidden><?php echo display('available_stock_qty') ?></th>
                                        <th class="text-center"><?php echo display('item') ?> <?php echo display('Qty') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('uom') ?></th>
                                        <th class="text-center" hidden><?php echo display('updated_stock_qty') ?> </th>
                                        <th class="text-center"><?php echo display('rate') ?><i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('discount_all') ?>%</th>
                                        <th class="text-center"><?php echo display('tax') ?>%</th>
                                        <th class="text-center"><?php echo display('total') ?></th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                    <tr>
                                        <td class="span3 supplier" width="12%">
                                            <?php echo display('please_select_supplier') ?>
                                            <!-- <select class="form-control supplier"></select> -->
                                        </td>

                                        <td width="10%" hidden>
                                            <input type="text" class="form-control text-right available_stk_qty" name="available_stk_qty[]" id="available_stk_qty" placeholder="Available stock"  readonly="readonly" />
                                        </td>

                                        <td class="text-right" width="12%">
                                            <input type="text" name="qty[]"  required  id="qty" class="form-control text-right qty" onkeyup="cal_price(this);" onblur="cal_price(this);" placeholder="0.00" value="" min="0" tabindex="6"/>
                                        </td>
                                        <td width="10%">
                                            <input type="text" class="form-control text-right uom" name="uom[]" id="uom" placeholder="UOM"  readonly="readonly" />
                                        </td>

                                        <td class="text-right" width="10%" hidden>
                                            <input type="text" name="updated_stock_qty[]" readonly="readonly" id="updated_stock_qty" class="form-control text-right updated_stock_qty" placeholder="0.00" />
                                        </td>
                                        <td class="" width="10%">
                                            <input type="text" name="price[]" id="price" class="form-control price text-right" placeholder="0.00" value="" min="0" tabindex="7" onkeyup="cal_price_change(this);" onblur="cal_price_change(this);" />
                                        </td>
                                        <td class="text-right" width="10%">
                                            <input class="form-control discount text-right" type="number" name="discount[]" id="discount" onkeyup="cal_total(this);" onblur="cal_total(this);" placeholder="0.00" tabindex="-1" />
                                        </td>
                                        <td class="text-center" width="20%">
                                            <label class="switch">
											  <input type="checkbox" id="tax" class="tax" name="tax" onchange="cal_total_t(this)" checked>
											  <span class="slider round"></span>
											</label><br>
											  <?php echo display('cgst');?>-<input type="text" id="cgst" class="cgst" name="cgst[]" style="width:10%;border:none;">
											  <?php echo display('sgst');?>-<input type="text" id="sgst" class="sgst" name="sgst[]" style="width:10%;border:none;">
											  <?php echo display('igst');?>-<input type="text" id="igst" class="igst" name="igst[]" style="width:10%;border:none;">
											  <?php echo display('utgst');?>-<input type="text" id="utgst" class="utgst" name="utgst[]" style="width:10%;border:none;">
                                        </td>
                                        <td class="text-right" width="10%">
                                            <input class="form-control total text-right" type="text" name="total[]" id="total" value="0.00" tabindex="-1"  readonly="readonly" />
                                        </td>
                                        <td width="10%">
                                            <button style="text-align: right;" class="btn btn-danger red" type="button" value="<?php echo display('delete')?>" onclick="deleteRow(this)" tabindex="8"><?php echo display('delete')?></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">
                                            <input type="button" id="add-invoice-item" class="btn btn-info" name="add-invoice-item" onClick="addPurchaseInputField2('addPurchaseItem');" value="<?php echo display('add_new_item') ?>" tabindex="9"/>

                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/>
                                        </td>
                                        <td style="text-align:right;" colspan="4"><b><?php echo display('grand_total') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal" tabindex="-1" class="text-right form-control grandTotal" name="grand_total_price" tabindex="-1" value="0.00" readonly="readonly" />
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                          <div class="row">
                             <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="payment_terms" class="col-sm-4 col-form-label"><?php echo display('enter_payment_terms') ?>
                                    </label>
                                    <div class="col-sm-8">
                                     
                                        <textarea tabindex="3" class="form-control" name="payment_terms" ></textarea>
                                     </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="delivery_charges" class="col-sm-4 col-form-label"><?php echo display('delivery_charges') ?>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="number" tabindex="2" class="form-control" name="delivery_charges" id="delivery_charges"  />
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="freight_charges" class="col-sm-4 col-form-label"><?php echo display('freight_charges') ?>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="number" tabindex="2" class="form-control" name="freight_charges" id="freight_charges"  />
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
								<?php 
								if($this->session->userdata('user_type')!=1) 
								{
									if($created)
									{
										if($created!==0)
										{?>
										    <input type="submit" id="add-purchase" class="btn btn-primary btn-large" name="add-purchase" value="<?php echo display('submit') ?>" tabindex="10"/>
											<input type="submit" value="<?php echo display('submit_and_add_another') ?>" name="add-purchase-another" class="btn btn-large btn-success" id="add-purchase-another" tabindex="11">
										<?php }
									}	
								}else{?>
										    <input type="submit" id="add-purchase" class="btn btn-primary btn-large" name="add-purchase" value="<?php echo display('submit') ?>" tabindex="10"/>
											<input type="submit" value="<?php echo display('submit_and_add_another') ?>" name="add-purchase-another" class="btn btn-large btn-success" id="add-purchase-another" tabindex="11">
                            
								<?php }?>
                            </div>
                        </div>
                    <?php echo form_close()?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Purchase Report End -->
<?php 

		$CI =& get_instance();
		$CI->load->model('Purchases');
		$all_prd_category = $CI->Purchases->all_prd_category();
		$all_supplier = $CI->Purchases->all_supplier();
		//$all_product = $CI->Purchases->select_all_product();
?>

<style type="text/css">
    .btn:focus {
      background-color: #6A5ACD;
    }
</style>

<!-- JS -->
<script type="text/javascript">
   $('body').on('change','#supplier_sss',function(event){
        event.preventDefault(); 
        var supplier_id=$('#supplier_sss').val();
        var csrf_test_name=  $("[name=csrf_test_name]").val();
        $.ajax({
            url: '<?php echo base_url('Cpurchase/product_search_by_supplier')?>',
            type: 'post',
            data: {supplier_id:supplier_id,csrf_test_name:csrf_test_name}, 
            success: function (msg){
                $(".supplier").html(msg);
            },
            error: function (xhr, desc, err){
                 alert('failed');
            }
        });        
    });
    //Product select by ajax end

   // Product selection start
    $('body').on('change', '#product_id', function(){
        var product_id = $(this).val();  
        var supp_id = $("#supplier_sss").val();  
        var base_url = $('.baseUrl').val(); 
        var stock = $(this).parent().next().children();	
		var available_stk_qty1 = $(this).parent().next().children();
        
        
        var target = $(this).parent().parent().children().next().next().next().next().children();
        var item_cartoon = $(this).parent().next().next().next().next().children();
        var uom1 = $(this).parent().next().next().next().children();
		var quantity = $(this).parent().next().next().children().val();	
		if(isNaN(quantity) || quantity == "" || quantity == 0){
			var qty = 0 ;
		}else{
			var qty = qty;
		}
		var supplier_price = $(this).parent().next().next().next().next().next().children();
		var updated_stock_qty1 = $(this).parent().next().next().next().next().children();
		var cgst1 =  $(this).parent().next().next().next().next().next().next().next().children('.cgst');
		var sgst1 =  $(this).parent().next().next().next().next().next().next().next().children('.sgst');
		var igst1 =  $(this).parent().next().next().next().next().next().next().next().children('.igst');
		var utgst1 =  $(this).parent().next().next().next().next().next().next().next().children('.utgst');
		//var igst1 = $(this).parent().next().next().next().next().next().next().next().children();
		if(isNaN(cgst1.val()) || cgst1.val() == "" || cgst1.val() == 0){
			var cgst = 0;
		}else{
			var cgst = cgst1.val();
		}
		if(isNaN(sgst1.val()) || sgst1.val() == "" || sgst1.val() == 0){
			var sgst = 0;
		}else{
			var sgst = sgst1.val();
		}
		if(isNaN(igst1.val()) || igst1.val() == "" || igst1.val() == 0){
			var igst = 0;
		}else{
			var igst =igst1.val();
		}
		if(isNaN(utgst1.val()) || utgst1.val() == "" || utgst1.val() == 0){
			var utgst = 0;
		}else{
			var utgst =utgst1.val();
		}
		var price = $(this).parent().next().next().next().next().next().children().val();
		var total_price = parseFloat(price)*parseFloat(qty);
		var total_tax_per = parseFloat(sgst) + parseFloat(cgst) + parseFloat(igst) + parseFloat(utgst);
		var total_tax = total_price * (total_tax_per/100);
		var total = parseFloat(total_price)+parseFloat(total_tax);
        $.ajax
        ({
            url: base_url+"Cinvoice/po_retrieve_product_data",
            data: {product_id:product_id,supp_id:supp_id},
            type: "post",
            success: function(data)
            {
                obj = JSON.parse(data);
				if(isNaN(obj.total_purchase) || obj.total_purchase == null){
                    available_stk_qty1.val(0);
				}else{
					available_stk_qty1.val(obj.total_product);
				}
				supplier_price.val(obj.supplier_price);
                cgst1.val(obj.cgst);
                sgst1.val(obj.sgst);
                igst1.val(obj.igst);
                utgst1.val(obj.utgst);
                uom1.val(obj.uom);
                var cartoon = $('.qty_calculate').val();
                var item = $('.qty_calculate').parent().next().children().val();

                // set quantity
                $('.qty_calculate').parent().next().next().children().val(cartoon * item);

                var rate = $('.qty_calculate').parent().next().next().next().children().val();
                //set total
                $('.qty_calculate').parent().next().next().next().next().children().val(rate * cartoon * item);
                calculateSum();
            } 
        });
    });

	function upd_stk(current){
		var com_qty =  $(current).parent().children('.com_qty').val();
		var av_qty =  $(current).parent().prev().children().val();
		var qty =  $(current).parent().children('.qty').val();
		var updated_stock_qty = parseInt(qty) + parseInt(com_qty) + parseInt(av_qty);
		var updated_stock_qty1 =  $(current).parent().next().children();
		updated_stock_qty1.val(updated_stock_qty);
	}
	
	function cal_price(current){
		var quantity = $(current).val();
		var available_stk_qty = $(current).parent().prev().children().val();
		var updated_stock_qty1 = $(current).parent().next().next().children();
		var updated_stock_qty = parseInt(quantity) + parseInt(available_stk_qty);
		updated_stock_qty1.val(updated_stock_qty);
		var discount_per = $(current).parent().next().next().next().next().children();
		var price = $(current).parent().next().next().next().children().val();
		var total_price = quantity * price;
		var total1 = $(current).parent().next().next().next().next().next().next().children();
		if( isNaN(discount_per) || discount_per == "" || discount_per == 0.00 ){
			var discount = 0;
		}else{
			var discount = parseFloat(total_price) * (parseFloat(discount_per)/100);
		}
		var total = parseFloat(total_price) - parseFloat(discount);
		var cgst1 =  $(current).parent().next().next().next().next().next().children('.cgst');
		var sgst1 =  $(current).parent().next().next().next().next().next().children('.sgst');
		var igst1 =  $(current).parent().next().next().next().next().next().children('.igst');
		var utgst1 =  $(current).parent().next().next().next().next().next().children('.utgst');
		if(isNaN(cgst1.val()) || cgst1.val() == "" || cgst1.val() == 0){
			var cgst = 0;
		}else{
			var cgst = cgst1.val();
		}
		if(isNaN(sgst1.val()) || sgst1.val() == "" || sgst1.val() == 0){
			var sgst = 0;
		}else{
			var sgst = sgst1.val();
		}
		if(isNaN(igst1.val()) || igst1.val() == "" || igst1.val() == 0){
			var igst = 0;
		}else{
			var igst = igst1.val();
		}
		if(isNaN(utgst1.val()) || utgst1.val() == "" || utgst1.val() == 0){
			var utgst = 0;
		}else{
			var utgst = utgst1.val();
		}
		var tax1 = $(current).parent().next().next().next().next().next().children().children('.tax');
		if(tax1.prop('checked') == true){
			var total_tax_per = parseFloat(cgst) + parseFloat(sgst) + parseFloat(igst) + parseFloat(utgst);
		}else{
			var total_tax_per = 0;
		}
		var total_tax = parseFloat(total) * (parseFloat(total_tax_per)/100);
		var tt = total+total_tax;
		total1.val(tt);
		 var e = 0;
        $(".total").each(function() {
            isNaN(this.value) || 0 == this.value.length || (e += parseFloat(this.value))
        }), 
        $("#grandTotal").val(e.toFixed(2))
	}
	
	function cal_total(current){
		debugger;
		var discount_per = $(current).val();
		var price = $(current).parent().prev().children().val();
		var quantity = $(current).parent().prev().prev().prev().prev().children().val();
		var total_price = quantity * price;
		var total1 = $(current).parent().next().next().children();
		var discount = parseFloat(total_price) * (parseFloat(discount_per)/100); 
		var total = parseFloat(total_price) - parseFloat(discount);
		var cgst1 =  $(current).parent().next().children('.cgst');
		var sgst1 =  $(current).parent().next().children('.sgst');
		var igst1 =  $(current).parent().next().children('.igst');
		var utgst1 =  $(current).parent().next().children('.utgst');
		if(isNaN(cgst1.val()) || cgst1.val() == "" || cgst1.val() == 0){
			var cgst = 0;
		}else{
			var cgst = cgst1.val();
		}
		if(isNaN(sgst1.val()) || sgst1.val() == "" || sgst1.val() == 0){
			var sgst = 0;
		}else{
			var sgst = sgst1.val();
		}
		if(isNaN(igst1.val()) || igst1.val() == "" || igst1.val() == 0){
			var igst = 0;
		}else{
			var igst = igst1.val();
		}
		if(isNaN(utgst1.val()) || utgst1.val() == "" || utgst1.val() == 0){
			var utgst = 0;
		}else{
			var utgst = utgst1.val();
		}
		var tax1 = $(current).parent().next().children().children('.tax');
		if(tax1.prop('checked') == true){
			var total_tax_per = parseFloat(cgst) + parseFloat(sgst) + parseFloat(igst) + parseFloat(utgst);
		}else{
			var total_tax_per = 0;
		}
		var total_tax = parseFloat(total) * (parseFloat(total_tax_per)/100);
		var tt = total+total_tax;
		total1.val(tt);
		 var e = 0;
        $(".total").each(function() {
            isNaN(this.value) || 0 == this.value.length || (e += parseFloat(this.value))
        }), 
        $("#grandTotal").val(e.toFixed(2))
	}
	
	function cal_price_change(current){
		//debugger;
		
		var price =  $(current).val();
		var quantity = $(current).parent().prev().prev().prev().children().val();
		if(quantity=="")
		{
			quantity=0;
		}
		var total_price = quantity * price;
		var discount_per = $(current).parent().next().children().val();
		if(discount_per=="")
		{
			discount_per=0;
		}
		var total1 = $(current).parent().next().next().next().children();
		var discount = parseFloat(total_price) * (parseFloat(discount_per)/100); 
		var total = parseFloat(total_price) - parseFloat(discount);
		var cgst1 =  $(current).parent().next().next().children('.cgst');
		var sgst1 =  $(current).parent().next().next().children('.sgst');
		var igst1 =  $(current).parent().next().next().children('.igst');
		var utgst1 =  $(current).parent().next().next().children('.utgst');
		if(isNaN(cgst1.val()) || cgst1.val() == "" || cgst1.val() == 0){
			var cgst = 0;
		}else{
			var cgst = cgst1.val();
		}
		if(isNaN(sgst1.val()) || sgst1.val() == "" || sgst1.val() == 0){
			var sgst = 0;
		}else{
			var sgst = sgst1.val();
		}
		if(isNaN(igst1.val()) || igst1.val() == "" || igst1.val() == 0){
			var igst = 0;
		}else{
			var igst = igst1.val();
		}
		if(isNaN(utgst1.val()) || utgst1.val() == "" || utgst1.val() == 0){
			var utgst = 0;
		}else{
			var utgst = utgst1.val();
		}
		var tax1 = $(current).parent().next().next().children().children('.tax');
		if(tax1.prop('checked') == true){
			var total_tax_per = parseFloat(cgst) + parseFloat(sgst) + parseFloat(igst) + parseFloat(utgst);
		}else{
			var total_tax_per = 0;
		}
		var total_tax = parseFloat(total) * (parseFloat(total_tax_per)/100);
		var tt = total+total_tax;
		total1.val(tt);
		 var e = 0;
        $(".total").each(function() {
            isNaN(this.value) || 0 == this.value.length || (e += parseFloat(this.value))
        }), 
        $("#grandTotal").val(e.toFixed(2))
	}
	
	function cal_total_t(current){
	    debugger;
		var discount_per = $(current).parent().parent().prev().children().val();	
		if(isNaN(discount_per) || discount_per == "" || discount_per == 0){
			discount_per = 0;
		}
		var tax1 = $(current).parent().parent().children().children('.tax');
		var price = $(current).parent().parent().prev().prev().children().val();
		var quantity = $(current).parent().parent().prev().prev().prev().prev().prev().children().val();
		var total_price = parseFloat(quantity) * parseFloat(price);
		var total1 = $(current).parent().parent().next().children();
		var discount = parseFloat(total_price) * (parseFloat(discount_per)/100); 
		var total = parseFloat(total_price) - parseFloat(discount);
		var cgst1 =  $(current).parent().parent().children('.cgst');
		var sgst1 =  $(current).parent().parent().children('.sgst');
		var igst1 =  $(current).parent().parent().children('.igst');
		var utgst1 =  $(current).parent().parent().children('.utgst');
		
		if(isNaN(cgst1.val()) || cgst1.val() == "" || cgst1.val() == 0){
			var cgst = 0;
		}else{
			var cgst = cgst1.val();
		}
		if(isNaN(sgst1.val()) || sgst1.val() == "" || sgst1.val() == 0){
			var sgst = 0;
		}else{
			var sgst = sgst1.val();
		}
		if(isNaN(igst1.val()) || igst1.val() == "" || igst1.val() == 0){
			var igst = 0;
		}else{
			var igst = igst1.val();
		}
		if(isNaN(utgst1.val()) || utgst1.val() == "" || utgst1.val() == 0){
			var utgst = 0;
		}else{
			var utgst = utgst1.val();
		}
		if(tax1.prop('checked') == true){
			var total_tax_per = parseFloat(cgst) + parseFloat(sgst) + parseFloat(igst) + parseFloat(utgst);
		}else{
			var total_tax_per = 0;
		}
		var total_tax = parseFloat(total) * (parseFloat(total_tax_per)/100);
		var tt = parseFloat(total)+parseFloat(total_tax);
		total1.val(tt);
		 var e = 0;
        $(".total").each(function() {
            isNaN(this.value) || 0 == this.value.length || (e += parseFloat(this.value))
        }), 
        $("#grandTotal").val(e.toFixed(2))
	}

</script>


