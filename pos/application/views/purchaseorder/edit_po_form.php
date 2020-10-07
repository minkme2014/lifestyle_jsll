<!-- Product Purchase js -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/json/product_purchase.js.php" ></script>
<!-- Supplier Js -->
<script src="<?php echo base_url(); ?>my-assets/js/admin_js/json/supplier.js.php" ></script>
<!-- Purchase js -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/purchase.js" type="text/javascript"></script>


<!-- Edit Purchase Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('po_edit') ?></h1>
            <small><?php echo display('po_edit') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('purchase_order') ?></a></li>
                <li class="active"><?php echo display('po_edit') ?></li>
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

        <!-- Purchase report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('po_edit') ?></h4>
                        </div>
                    </div>
                   <?php echo form_open_multipart('Cpurchaseorder/po_update',array('class' => 'form-vertical', 'id' => 'po_update'))?>
                    <div class="panel-body">


                          <div class="row">
                             <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('po_date') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <?php $date = date('Y-m-d'); ?>
                                        <input type="text" tabindex="2" class="form-control datepicker" name="po_date" value="{po_date}" id="po_date" required  tabindex='2'/>
                                        <input type="hidden" name="po_id" value="{po_id}">
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
                                        <input type="text" tabindex="2" class="form-control" name="po_no" id="po_no" value="{po_no}" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                               <div class="form-group row">
                                    <label for="description" class="col-sm-4 col-form-label"><?php echo display('supplier') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="supplier_name" value="{supplier_name}" class="form-control supplierSelection" placeholder='Type your Supplier Name' id="supplier_name" >
                                        <input type="hidden" class="supplier_hidden_value" name="supplier_id" value="{supplier_id}" id="suppluerHiddenId"/>
                                    </div>
                                </div> 
								
                               <div class="form-group row">
                                    <label for="supplier_sss" class="col-sm-4 col-form-label"><?php echo display('supplier') ?>
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="supplier_id1" id="supplier_sss" class="form-control "  tabindex='1'> 
                                            <option value=" "><?php echo display('select_one') ?></option>
                                            {all_supplier}
                                            <option value="{supplier_id}">{supplier_name}</option>
                                            {/all_supplier}
                                        </select>
                                    </div>

                                </div> 
                            </div>

                                    <div class="col-sm-3">
                                        <?php echo display('for_new_item') ?>
                                    </div>
                        </div>

                        <div class="table-responsive" style="margin-top: 10px">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_information') ?><i class="text-danger">*</i></th> 
                                        <th class="text-center" hidden><?php echo display('available_stock_qty') ?></th>
                                        <th class="text-center"><?php echo display('item') ?> <?php echo display('qty') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('uom') ?></th>
                                        <th class="text-center" hidden><?php echo display('updated_stock_qty') ?> </th>
                                        <th class="text-center"><?php echo display('rate') ?><i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('discount_all') ?>%</th>
                                        <th class="text-center"><?php echo display('tax') ?>%</th>
                                        <th class="text-center"><?php echo display('total') ?></th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>

                				<tbody id="addPurchaseItem1">
        						{po_info}
        			                
                                    <tr>
                                        <td class="span3 supplier" width="12%">
										<input type="hidden" name="po_items_id[]" value="{po_items_id}"/>
											<input type="text" name="product_name" onclick="purchase_productList({sl});" value="{product_name}" required class="form-control productSelection" placeholder='Type your Product Name' id="product_name_{sl}">
											<input type="hidden" class="product_id_{sl} autocomplete_hidden_value product_id_{sl}" name="product_id[]" value="{product_id}" id="SchoolHiddenId"/>
											<input type="hidden" class="baseUrl" value="<?php echo base_url();?>" />
                                        </td>

                                        <td width="10%" hidden>
                                            <input type="text" id="" class="form-control text-right available_stk_qty" name="available_stk_qty[]" id="available_stk_qty" placeholder="Available stock" value={available_stk_qty} readonly />
                                        </td>

                                        <td class="text-right" width="12%">
                                            <input type="text" name="qty[]"  required  id="qty" class="form-control text-right qty" onkeyup="cal_price(this);" onblur="cal_price(this);" placeholder="0.00" value={quantity} min="0" tabindex="6"/>
                                        </td>

                                        <td class="text-right" width="10%">
                                            <input type="text" name="uom[]" readonly="readonly" id="uom" class="form-control text-right uom" value="{uom_name}" placeholder="UOM" />
                                        </td>

                                        <td class="text-right" width="10%" hidden>
                                            <input type="text" name="updated_stock_qty[]" readonly="readonly" id="updated_stock_qty" class="form-control text-right updated_stock_qty" value={updated_stk_qty} placeholder="0.00" />
                                        </td>
                                        <td class="" width="10%">
                                            <input type="text" name="price[]" id="price" class="form-control price text-right" placeholder="0.00" value={unit_cost} min="0" tabindex="7" onkeyup="cal_price_change(this);" onblur="cal_price_change(this);" />
                                        </td>
                                        <td class="text-right" width="10%">
                                            <input class="form-control discount text-right" type="text" name="discount[]" id="discount" onkeyup="cal_total(this);" onblur="cal_total(this);" value={dis_per} tabindex="-1" />
                                        </td>
                                        <td class="text-center" width="20%">
                                            <label class="switch">
											  <input type="checkbox" id="tax" class="tax" name="tax" onchange="cal_total_t(this)" <?php echo "checked"?> >
											  <span class="slider round"></span>
											</label><br>
											  CGST-<input type="text" id="cgst" class="cgst" name="cgst[]" style="width:10%;border:none;" value={cgst}>
											  SGST-<input type="text" id="sgst" class="sgst" name="sgst[]" style="width:10%;border:none;" value={sgst}>
											  IGST-<input type="text" id="igst" class="igst" name="igst[]" style="width:10%;border:none;" value={igst}>
											  UTGST-<input type="text" id="utgst" class="utgst" name="utgst[]" style="width:10%;border:none;" value={utgst}>
                                        </td>
                                        <td class="text-right" width="10%">
                                            <input class="form-control total text-right" type="text" name="total[]" id="total" value={total_cost} tabindex="-1"  readonly="readonly" />
                                        </td>
                                        <td width="10%">
                                            <button style="text-align: right;" class="btn btn-danger red" type="button" value="<?php echo display('delete')?>" onclick="deleteRow(this)" tabindex="8"><?php echo display('delete')?></button>
                                        </td>
                                    </tr>
        						{/po_info}
        						</tbody>
								
                                <tbody id="addPurchaseItem">
                                    <tr>
                                        <td class="span3 supplier1" width="12%">
                                            <?php echo display('please_select_supplier') ?>
                                            <!-- <select class="form-control supplier"></select> -->
                                        </td>

                                        <td width="10%" hidden>
                                            <input type="text" id="" class="form-control text-right available_stk_qty" name="available_stk_qty1[]" id="available_stk_qty" placeholder="Available stock"  readonly="readonly" />
                                        </td>

                                        <td class="text-right" width="12%">
                                            <input type="text" name="qty1[]"  id="qty" class="form-control text-right qty" onkeyup="cal_price(this);" onblur="cal_price(this);" placeholder="0.00" value="" min="0" tabindex="6"/>
                                        </td>
                                        
                                        <td class="text-right" width="10%">
                                            <input type="text" name="uom1[]" readonly="readonly" id="uom" class="form-control text-right uom" placeholder="UOM" />
                                        </td>

                                        <td class="text-right" width="10%" hidden>
                                            <input type="text" name="updated_stock_qty1[]" readonly="readonly" id="updated_stock_qty" class="form-control text-right updated_stock_qty" placeholder="0.00" />
                                        </td>
                                        <td class="" width="10%">
                                            <input type="text" name="price1[]" id="price" class="form-control price text-right" placeholder="0.00" value="" min="0" tabindex="7"/>
                                        </td>
                                        <td class="text-right" width="10%">
                                            <input class="form-control discount text-right" type="text" name="discount1[]" id="discount" onkeyup="cal_total(this);" onblur="cal_total(this);" value="0.00" tabindex="-1" />
                                        </td>
                                        <td class="text-center" width="20%">
                                            <label class="switch">
											  <input type="checkbox" id="tax" class="tax" name="tax1" onchange="cal_total_t(this)" checked>
											  <span class="slider round"></span>
											</label><br>
											  CGST-<input type="text" id="cgst" class="cgst" name="cgst1[]" style="width:10%;border:none;">
											  SGST-<input type="text" id="sgst" class="sgst" name="sgst1[]" style="width:10%;border:none;">
											  IGST-<input type="text" id="igst" class="igst" name="igst1[]" style="width:10%;border:none;">
											  UTGST-<input type="text" id="utgst" class="utgst" name="utgst1[]" style="width:10%;border:none;">
                                        </td>
                                        <td class="text-right" width="10%">
                                            <input class="form-control total text-right" type="text" name="total1[]" id="total" value="0.00" tabindex="-1"  readonly="readonly" />
                                        </td>
                                        <td width="10%">
                                            <button style="text-align: right;" class="btn btn-danger red" type="button" value="<?php echo display('delete')?>" onclick="deleteRow(this)" tabindex="8" disabled><?php echo display('delete')?></button>
                                        </td>
                                    </tr>
                                </tbody>
        						<tfoot>
        							<tr>
                                        <td colspan="4">
                                            <input type="button" id="add-invoice-item" class="btn btn-info" name="add-invoice-item" onClick="addPurchaseInputField2('addPurchaseItem');" value="<?php echo display('add_new_item') ?>" tabindex="9"/>

                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/>
                                        </td>
        								<td>
        									<input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/>
        								</td>
        								<td style="text-align:right;" ><b><?php echo display('grand_total') ?>:</b></td>
        								<td class="text-right">
                                            <input type="text" id="grandTotal" value="{grand_total}" tabindex="-1" class="text-right form-control" name="grand_total_price" tabindex="-1" value="0.00" readonly="readonly" />
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
                                     
                                        <textarea tabindex="3" class="form-control" name="payment_terms" >{payment_terms}</textarea>
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
                                        <input type="number" tabindex="2" class="form-control" name="delivery_charges" id="delivery_charges" value="{delivery_charges}" />
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
                                        <input type="number" tabindex="2" class="form-control" name="freight_charges" id="freight_charges" value="{freight_charges}" />
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="submit" id="add-purchase" class="btn btn-success btn-large" name="add-purchase" value="<?php echo display('save_changes') ?>" tabindex="8" />
                            </div>
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Edit Purchase End -->

<style type="text/css">
    .btn:focus {
      background-color: #6A5ACD;
    }
</style>


<!-- JS -->
<script type="text/javascript">
    //Product select by ajax start
    $('body').on('change','#supplier_sss',function(event){
        event.preventDefault(); 
        var supplier_id=$('#supplier_sss').val();
        var csrf_test_name=  $("[name=csrf_test_name]").val();
        $.ajax({
            url: '<?php echo base_url('Cpurchase/product_search_by_supplier1')?>',
            type: 'post',
            data: {supplier_id:supplier_id,csrf_test_name:csrf_test_name}, 
            success: function (msg){
                $(".supplier1").html(msg);
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
        var base_url = $('.baseUrl').val(); 
        var stock = $(this).parent().next().children();	
		var available_stk_qty1 = $(this).parent().next().children();
        var uom1 = $(this).parent().next().next().next().children();
        
        var target = $(this).parent().parent().children().next().next().next().next().children();
        var item_cartoon = $(this).parent().next().next().next().next().children();
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
            url: base_url+"Cinvoice/retrieve_product_data",
            data: {product_id:product_id},
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
		var discount_per = $(current).parent().next().next().next().next().val();
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
	
	function cal_total_t(current){
	    
		
		var discount_per = $(current).parent().parent().prev().children().val();
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
    //Product selection end
</script>
