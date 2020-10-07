<?php
    $CI =& get_instance();
    $CI->load->model('Web_settings');
    $Web_settings = $CI->Web_settings->retrieve_setting_editdata();
?>

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
            <h1><?php echo display('add_purchase') ?></h1>
            <small><?php echo display('add_new_purchase') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('purchase') ?></a></li>
                <li class="active"><?php echo display('add_purchase') ?></li>
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
										<h4><?php echo display('add_purchase') ?></h4>
									</div>
									<div class="col-md-6">
										<!--<a href="<?php echo base_url();?>/Cproduct" target="_blank">Add Product</a>-->
										<?php 
										if($this->session->userdata('user_type')!=1) 
										{
											if($created)
											{
												if($created!==0)
												{?>
													<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><?php echo display('add_product') ?></button>
												<?php }
											}	
										}else{?>
													<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><?php echo display('add_product') ?></button>
									
										<?php }?>
									</div>
								</div>
							</div>
                        </div>
                    </div>

                    <div class="panel-body">
                    <?php echo form_open_multipart('Cpurchase/insert_purchase',array('class' => 'form-vertical', 'id' => 'insert_purchase','name' => 'insert_purchase'))?>
                        

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                               <div class="form-group row">
                                    <label for="supplier_sss" class="col-sm-3 col-form-label"><?php echo display('supplier') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                        <select name="supplier_id" id="supplier_sss" class="form-control " required tabindex="1"/> 
                                            <option value=""><?php echo display('select_one') ?></option>
                                            {all_supplier}
                                            <option value="{supplier_id}">{supplier_name}</option>
                                            {/all_supplier}
                                        </select>
                                    </div>

                                    <div class="col-sm-3">
										<?php 
										if($this->session->userdata('user_type')!=1) 
										{
											if($created)
											{
												if($created!==0)
												{?>
												    <a href="<?php echo base_url('Csupplier'); ?>"><?php echo display('add_supplier') ?></a>
												<?php }
											}	
										}else{?>
												    <a href="<?php echo base_url('Csupplier'); ?>"><?php echo display('add_supplier') ?></a>
                                    
										<?php }?>
                                    </div>
                                </div> 
                            </div>

                             <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('purchase_date') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <?php $date = date('Y-m-d'); ?>
                                        <input type="text" class="form-control datepicker" name="purchase_date" value="<?php echo $date; ?>" id="date" required />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="invoice_no" class="col-sm-3 col-form-label"><?php echo display('invoice_no') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="chalan_no" placeholder="<?php echo display('invoice_no') ?>" id="invoice_no" required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                               <div class="form-group row">
                                    <label for="adress" class="col-sm-4 col-form-label"><?php echo display('details') ?>
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="adress" name="purchase_details" placeholder=" <?php echo display('details') ?>" rows="1" ></textarea>
                                    </div>
                                </div> 
                            </div>
                        </div>

                        <div class="table-responsive" style="margin-top: 10px">
                            <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_information') ?><i class="text-danger">*</i></th> 
                                        <th class="text-center"><?php echo display('available_stock_qty') ?></th>
                                        <th class="text-center"><?php echo display('item') ?> <?php echo display('qty') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('uom') ?></th>
                                        <th class="text-center">Rack</th>
                                        <th class="text-center"><?php echo display('updated_stock_qty') ?> </th>
                                        <th class="text-center"><?php echo display('rate') ?><i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('discount_all') ?>%</th>
                                        <th class="text-center"><?php echo display('tax') ?>%</th>
                                        <th class="text-center"><?php echo display('total') ?></th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <!--tbody id="addPurchaseItem">
                                    <tr>
                                        <td class="span3 supplier" width="12%">
                                            <?php echo display('please_select_supplier') ?>
                                        </td>

                                        <td width="10%">
                                            <input type="text" class="form-control text-right available_stk_qty" name="available_stk_qty[]" id="available_stk_qty" placeholder="Available stock"  readonly="readonly" tabindex='6' />
                                        </td>

                                        <td class="text-right" width="12%">
                                            <input type="text" name="qty[]"  required  id="qty" class="form-control text-right qty" onkeyup="cal_price(this);" onblur="cal_price(this);" placeholder="0.00" value="" min="0" tabindex="7"/>
											<input type="text" name="com_qty[]"  id="com_qty" class="form-control text-right com_qty"  onkeyup="upd_stk(this);" onblur="upd_stk(this);" placeholder="Comp Qty" value="" min="0" tabindex="7"/>
                                        </td>
                                        <td width="10%">
                                            <input type="text" class="form-control text-right uom" name="uom[]" id="uom" placeholder="UOM"  readonly="readonly"  tabindex="8"/>
                                        </td>

                                        <td class="text-right" width="10%">
                                            <input type="text" name="updated_stock_qty[]" readonly="readonly" id="updated_stock_qty" class="form-control text-right updated_stock_qty" placeholder="0.00"  tabindex="9"/>
                                        </td>
                                        <td class="" width="10%">
                                            <input type="text" name="price[]" id="price" class="form-control price text-right" placeholder="0.00" value="" min="0" tabindex="10"/>
                                        </td>
                                        <td class="text-right" width="10%">
                                            <input class="form-control discount text-right" type="text" name="discount[]" id="discount" onkeyup="cal_total(this);" onblur="cal_total(this);" value="0.00" tabindex="11" />
                                        </td>
                                        <td class="text-center" width="20%">
                                            <label class="switch">
											  <input type="checkbox" id="tax" class="tax" name="tax" onchange="cal_total_t(this)" checked >
											  <span class="slider round"></span>
											</label><br>
											  CGST-<input type="text" id="cgst" class="cgst" name="cgst[]" style="width:10%;border:none;" tabindex="13">
											  SGST-<input type="text" id="sgst" class="sgst" name="sgst[]" style="width:10%;border:none;" tabindex="13">
											  IGST-<input type="text" id="igst" class="igst" name="igst[]" style="width:10%;border:none;" tabindex="13">
                                        </td>
                                        <td class="text-right" width="10%">
                                            <input class="form-control total text-right" type="text" name="total[]" id="total" value="0.00" readonly="readonly" tabindex="14"/>
                                        </td>
                                        <td width="10%">
                                            <button style="text-align: right;" class="btn btn-danger red" type="button" value="<?php echo display('delete')?>" onclick="deleteRow(this)" tabindex="15"><?php echo display('delete')?></button>
                                        </td>
                                    </tr>
                                </tbody-->
                                
                                <tbody id="addPurchaseItem">
                                    <tr>
                                        <td class="span3" width="12%">
                                            <!--input type="text" name="product_name" onkeypress="purchase_productList(1);" class="form-control productSelection" placeholder='<?php echo display('product_name') ?>' required="" id="product_name" -->
                                            <!--input type="text" name="product_name" onkeyup="purchase_product_List(this,1);" class="form-control productSelection" placeholder='<?php echo display('product_name') ?>' required="" id="prd_name" -->
                                            <input type="text" name="product_name" onkeyup="<?php if($Web_settings[0]['supplier_price']=="1") { echo 'purchase_product_List2(this,1)'; }else{ echo 'purchase_product_List(this,1)';}?> ;" class="form-control productSelection" placeholder='<?php echo display('product_name') ?>' required="" id="prd_name" <?php if($Web_settings[0]['supplier_price']=="1") {echo "disabled";}?>>
											<?php if($Web_settings[0]['supplier_price']=="1") { ?>
											<span class="text-danger" id="warning"><?php echo display('please_select_supp_befor_selecting_product');?></span>
											<?php } ?>
                                            <input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id[]" id="SchoolHiddenId"/>
                                        </td>

                                        <td width="10%">
                                            <input type="text" class="form-control text-right available_stk_qty_1" name="available_stk_qty[]" placeholder="Available stock"  readonly="readonly"  />
                                        </td>

                                        <td class="text-right" width="12%">
                                            <input type="text" name="qty[]" id="qty" required class="form-control text-right qty_1" onkeyup="cal_price(this,1);" onblur="cal_price(this,1);" placeholder="0.00" value="" min="0" />
											<input type="text" name="com_qty[]"  id="com_qty" class="form-control text-right com_qty_1"  onkeyup="upd_stk(this,1);" onblur="upd_stk(this,1);" placeholder="Comp Qty" value="" min="0" />
                                        </td>
                                        <td width="13%">
                                            <input type="text" style='text-align: left;     padding: 0;    width: 100px;' class="form-control text-right uom_1 uom_puch" name="uom[]" placeholder="UOM"  readonly="readonly" />
                                        </td>
                                        <td width="10%">
                                            <input type="text" class="form-control text-right rack_1" placeholder="Rack"  readonly="readonly" />
                                        </td>

                                        <td class="text-right" width="10%">
                                            <input type="text" name="updated_stock_qty[]" readonly="readonly" class="form-control text-right updated_stock_qty_1" placeholder="0.00" />
                                        </td>
                                        <td class="" width="10%">
                                            <input type="text" name="price[]" class="form-control price_1 text-right" placeholder="0.00" value="" min="0" onkeyup="cal_price_change(this,1);" onblur="cal_price_change(this,1);" />
                                        </td>
                                        <td class="text-right" width="10%">
                                            <input class="form-control discount_1 text-right" type="text" name="discount[]" onkeyup="cal_total(this,1);" onblur="cal_total(this,1);" placeholder="0.00" />
                                        </td>
                                        <td class="text-center" width="20%">
                                            <label class="switch">
											  <input type="checkbox" id="tax" class="tax_1" name="tax" onchange="cal_total_t(this,1)" checked >
											  <span class="slider round"></span>
											</label><br>
												<div id="cgst_tax_1">
												  <?php echo display('cgst');?>-<input type="text" class="cgst_1" name="cgst[]" style="width:10%;border:none;" ></div>
												<div id="sgst_tax_1">
 												  <?php echo display('sgst');?>-<input type="text" class="sgst_1" name="sgst[]" style="width:10%;border:none;" ></div>
												<div id="igst_tax_1">
												  <?php echo display('igst');?>-<input type="text" class="igst_1" name="igst[]" style="width:10%;border:none;" ></div>
												<div id="utgst_tax_1">
												  <?php echo display('utgst');?>-<input type="text" class="utgst_1" name="utgst[]" style="width:10%;border:none;"></div>
                                        </td>
                                        <td class="text-right" width="10%">
                                            <input class="total form-control text-right" id="total_1" type="text" name="total[]" value="0" readonly="readonly" style="width: 80px;"/>
                                        </td>
                                        <td width="10%">
                                            <button style="text-align: right;" class="btn btn-danger red" type="button" value="<?php echo display('delete')?>" onclick="deleteRow(this)" ><?php echo display('delete')?></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">
                                            <input type="button" id="add-invoice-item" class="btn btn-info" name="add-invoice-item" onClick="addnewPurchaseInputField('addPurchaseItem');" value="<?php echo display('add_new_item') ?>" <?php if($Web_settings[0]['supplier_price']=="1") {echo "disabled";}?> />

                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/>
                                        </td>
                                        <td style="text-align:right;" colspan="7"><b><?php echo display('grand_total') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal" class="text-right form-control grandTotal" name="grand_total_price" value="0.00" readonly="readonly" />
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
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
											<input type="submit" id="add-purchase" class="btn btn-primary btn-large" name="add-purchase" value="<?php echo display('submit') ?>" />
											<input type="submit" value="<?php echo display('submit_and_add_another') ?>" name="add-purchase-another" class="btn btn-large btn-success" id="add-purchase-another" >
                            
										<?php }
									}	
								}else{?>
										    <input type="submit" id="add-purchase" class="btn btn-primary btn-large" name="add-purchase" value="<?php echo display('submit') ?>" />
											<input type="submit" value="<?php echo display('submit_and_add_another') ?>" name="add-purchase-another" class="btn btn-large btn-success" id="add-purchase-another" >
                            
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
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo display('add_product') ?></h4>
        </div>
        <div class="modal-body">
            <!-- Add Product -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('new_product') ?></h4>
                        </div>
                    </div>
                    <?php //echo form_open_multipart('Cproduct/insert_product',array('class' => 'form-vertical', 'id' => 'insert_product','name' => 'insert_product'))?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="type" class="col-sm-4 col-md-2  col-form-label"><?php echo display('type') ?> </label>
                                    <div class="col-sm-4  col-md-2">
                                        <label><input type="radio" name="type" id="type" value="<?php echo display('goods') ?>" checked><?php echo display('goods') ?> </label>
                                    </div>
                                    <div class="col-sm-4  col-md-2">
                                        <label><input type="radio" name="type" id="type" value="<?php echo display('services') ?>"><?php echo display('services') ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-4 col-form-label"><?php echo display('product_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="product_name" type="text" id="product_name" placeholder="<?php echo display('product_name') ?>" required  tabindex='1'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                               <div class="form-group row">
                                    <label for="description" class="col-sm-4 col-form-label"><?php echo display('details') ?></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="<?php echo display('details') ?>" tabindex='2'></textarea>
                                    </div>
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-4 col-form-label"><?php echo display('category') ?></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="category_id" name="category_id"  tabindex='3'>
                                        <option value=""><?php echo display('select_one') ?></option>
                                        <?php
                                            foreach($all_prd_category as $cat) {
                                        ?>
										
											<option value="<?php echo $cat['category_id'];?>"><?php echo $cat['category_name']; ?></option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                               <div class="form-group row">
                                    <label for="image" class="col-sm-4 col-form-label"><?php echo display('image') ?> </label>
                                    <div class="col-sm-8">
                                        <input type="file" name="image" class="form-control" id="image" tabindex='4'>
                                    </div>
                                </div> 
                            </div>
                        </div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group row">
									<label for="code" class="col-sm-4 col-md-2  col-form-label"><?php echo display('code') ?>  </label>
									<div class="col-sm-8  col-md-4">
										<input class="form-control margon_btm" name="code" type="text" id="code" placeholder="<?php echo display('code') ?>" >
									</div>
						 
								</div>
							</div>
						</div>

                        <div class="table-responsive" style="margin-top: 10px">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_quantity') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('ROL') ?></th>
                                        <th class="text-center"><?php echo display('uom') ?> </th>
                                        <th class="text-center">Rack </th>
                                        <th class="text-center"><?php echo display('mrp') ?></th>
                                        <th class="text-center"><?php echo display('sell_price') ?></th>
                                        <th class="text-center"><?php echo display('purchase_price') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('manufacturer_name') ?></th>
                                        <th class="text-center"><?php echo display('supplier') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('tax') ?>%</th>
                                        <th class="text-center"><?php echo display('total') ?> <?php echo display('purchase_price') ?><i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('total') ?> <?php echo display('sales_price') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="form-actions">
                                    <tr class="">
                                        <td class="" style="width:14%">
                                            <input class="form-control text-right" id="prd_qty" name="cartoon_quantity" type="number" onkeyup="prd_cal_total();" onblur="prd_cal_total();" required="" placeholder="<?php echo display('item_quantity') ?>" tabindex="5" min="0">
                                        </td>  
                                        <td class="" style="width:8%">
                                            <input class="form-control text-right" id="rol" name="rol" type="number" onkeyup="cal_total();" onblur="cal_total();"  placeholder="<?php echo "ROL"; ?>" tabindex="5" min="0">
                                        </td> 
                                        <td class="" style="width:5%">
                                            
                                            <!--select name="uom" id="uom" class="form-control" required="" tabindex='6'>
                                            <?php
                                                if ($uom_list){
                                            ?>
                                                <option value=""><?php echo display('select_one')?> 
                                                </option>
                                            {uom_list}
                                                <option value="{uom_id}">{uom_name} 
                                                </option>
                                            {/uom_list}
                                            <?php
                                                }
                                            ?>
                                            </select-->
                                            <div class="chk-all">
												<div class="btn-group">
													<input type="text" id="uom_name" data-toggle="modal" data-target="#today_act_modal" placeholder="Select UOM" class="form-control input_type" >
													<input type="text" name="uom" id="uom" hidden>
													<!--i class="fa fa-angle-down"></i-->
												</div>
											</div>
                                        </td>  
                                        <td class="" style="width:8%">
                                            <input class="form-control text-right" name="rack" id="rack" type="text" placeholder="Rack" tabindex="6">
                                        </td> 
                                        <td class="" style="width:10%">
                                            <input style="width: 80px;" class="form-control text-right" name="mrp" id="mrp" type="number" step="0.01" placeholder="<?php echo display('mrp') ?>" tabindex="7" min="0">
                                        </td> 
                                        <td class="" style="width:10%">
                                            <input style="width: 80px;" class="form-control text-right" name="price" id="sell_price" type="number" step="0.01" placeholder="<?php echo display('sell_price') ?>" tabindex="8" min="0" onkeyup="prd_cal_total();" onblur="prd_cal_total();" >
                                        </td>
                                        <td class="" style="width:10%">
                                            <input type="number" style="width: 80px;" tabindex="9" id="prd_price" class="form-control text-right" onkeyup="prd_cal_total();" onblur="prd_cal_total();" name="supplier_price" step="0.01" placeholder="Purchase Price"  required  min="0" >
                                        </td>
                                        <td class="text-right" style="width:19%">
                                            <input type="text" tabindex="10" class="form-control" name="model" id="model" placeholder="<?php echo display('manufacturer_name') ?>" />
                                        </td>
                                        
                                        <td class="text-right" style="width:12%">
                                            <select name="supplier_id" id="supplier_id" class="form-control" required="" tabindex='11'>
                                           
                                                <option value=""><?php echo display('select_one')?>  </option>
                                            <?php 
												foreach($all_supplier as $supp){
											?>
												<option value="<?php echo $supp['supplier_id'];?>"><?php echo $supp['supplier_name']; ?></option>
                                                
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </td>
                                        <td class="text-right" style="width:14%">
                                            <input type="number" tabindex="12" class="form-control" id="prd_cgst" name="prd_cgst" step="0.01" onkeyup="prd_cal_total();" onblur="prd_cal_total();" placeholder="<?php echo display('cgst') ?>" style="width:45%; display:inline;padding:0;"/>
											<input type="number" tabindex="13" class="form-control" id="prd_sgst" name="prd_sgst" step="0.01" onkeyup="prd_cal_total();" onblur="prd_cal_total();" placeholder="<?php echo display('sgst') ?>" style="width:45%; display:inline;padding:0;" />
											<input type="number" tabindex="14" class="form-control" id="prd_igst" name="prd_igst" step="0.01" onkeyup="prd_cal_total();" onblur="prd_cal_total();" placeholder="<?php echo display('igst') ?>" style="width:45%; display:inline;padding:0;" />
											<input type="number" tabindex="14" class="form-control" id="prd_utgst" name="prd_utgst" step="0.01" onkeyup="prd_cal_total();" onblur="prd_cal_total();" placeholder="<?php echo display('utgst') ?>" style="width:45%; display:inline;padding:0;" />
                                        </td>
                                        <td class="text-right" style="width:10%">
                                            <input type="number" style="width: 80px;" tabindex="15" class="form-control" id="prd_total" name="total" placeholder="<?php echo display('total') ?>" step="0.01" onkeyup="rev_cal_purchase();" required />
                                        </td>
                                        <td class="text-right" style="width:10%">
                                            <input  type="number" style="width: 80px;" tabindex="15" class="form-control" id="total_sell" name="total_sell" placeholder="<?php echo display('total') ?>" onkeyup="rev_cal_purchase();"  step="0.01"  />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                                            <input type="text" class="form-control" name="redirect" id="redirect"  value="purchase" style="display:none;" />
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="button" id="add-product" onclick="addproduct();" class="btn btn-primary btn-large" name="add-product" value="<?php echo display('save') ?>"  tabindex='16'/>
                            </div>
                        </div>
                    </div>
                    <?php //echo form_close()?>
                </div>
            </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo display('close') ?></button>
        </div>
      </div>
      
    </div>
  </div>

<!-- Modal -->
<div class="modal fade uom_list_po" id="today_act_modal"  role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title col-md-11  col-xs-11" id="exampleModalLabel">UOM</h5>
        <button type="button" class="close col-md-1  col-xs-1" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<!--ul class="">
				<?php
					if ($uom_list){
				?>
				<input type="search" class="form-control search_box_po"  placeholder="search">
				{uom_list} 
				<li><a href="#">{uom_name}</a></li>
				{/uom_list} 
				<?php
				}
				?>
			</ul-->		            
			<select id="select_uom" class="form-control search_box_po" onchange="get_uom();" required="" style="width:100%">
				<?php
					if ($uom_list){
				?>
					<option value=""><?php echo display('select_one')?> 
					</option>
				{uom_list}
					<option value="{uom_id}">{uom_name} 
					</option>
				{/uom_list}
				<?php
					}
				?>
			</select>
      </div>
    </div>
  </div>
</div>
<style type="text/css">
    .btn:focus {
      background-color: #6A5ACD;
    }
</style>

<!-- JS -->
<script type="text/javascript">
function get_uom()
{
	//debugger;
	var uom=$("#select_uom").val();
	var uom_name=$("#select_uom option:selected").html().replace( /[\s\n\r]+/g, ' ' );
//	alert(uom_name);
	$("#uom").val(uom);
	$("#uom_name").val(uom_name);
}
$(document).ready(function () {
   $(document).on("keyup", function (e) {
      // console.log("e.keyCode  : "+(e.keyCode));
       if (e.altKey && e.keyCode === 65) { //key alt+a //add row
          addPurchaseInputField('addPurchaseItem');
     }
      if (e.altKey && e.keyCode === 83) { //key alt+s  to submit
          //done done yet
          $("#add-purchase").click();
     }
    })
});

   $('body').on('change','#supplier_sss',function(event){
	   $('#prd_name').prop("disabled", false);
	   $('#add-invoice-item').prop("disabled", false);
	   $("#warning").hide();
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
 /*   $('body').on('change', '#product_id', function(){
        var product_id = $(this).val();  
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
		var price = $(this).parent().next().next().next().next().next().children().val();
		var total_price = parseFloat(price)*parseFloat(qty);
		var total_tax_per = parseFloat(sgst) + parseFloat(cgst) + parseFloat(igst);
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
    });*/
	// function cal_total(){
		// var product_id = $('.product_id').val();  
        // var base_url = $('.baseUrl').val();
		// if(isNaN($('.qty').val()) || $('.qty').val() == "" || $('.qty').val() == 0){
			// var qty = 0 ;
		// }else{
			// var qty = $(".qty").val();
		// }
		// var available_stk_qty = $(".available_stk_qty").val();
		// var updated_stock_qty = $(".updated_stock_qty").val();
		// if(isNaN($('.cgst').val()) || $('.cgst').val() == "" || $('.cgst').val() == 0){
			// var cgst = 0;
		// }else{
			// var cgst = $(".cgst").val();
		// }
		// if(isNaN($('.sgst').val()) || $('.sgst').val() == "" || $('.sgst').val() == 0){
			// var sgst = 0;
		// }else{
			// var sgst = $(".sgst").val();
		// }
		// if(isNaN($('.igst').val()) || $('.igst').val() == "" || $('.igst').val() == 0){
			// var igst = 0;
		// }else{
			// var igst = $(".igst").val();
		// }
		// var updated_stk = parseInt(available_stk_qty)+parseInt(qty);
		// $(".updated_stock_qty").val(updated_stk);
		// var price = $(".price").val();
		// var total_price = parseFloat(price)*parseFloat(qty);
		// var discount_per = $(".discount").val();
		// if( isNaN($('.discount').val()) || $('.discount').val() == "" || $('.discount').val() == 0.00 ){
			// var discount = 0;
		// }else{
			// var discount = (parseFloat(discount_per)/100) * total_price;
		// }
		// if($("#tax").prop('checked') == true){
			// var total_tax_per = parseFloat(sgst) + parseFloat(cgst) + parseFloat(igst);
		// }else{
			// var total_tax_per = 0;
		// }
		// var total_tax = (total_price-discount) * (total_tax_per/100);
		// var total = parseFloat(total_price)-parseFloat(discount)+parseFloat(total_tax);
		// $(".total").val(total);
		 // var e = 0;
        // $(".total").each(function() {
            // isNaN(this.value) || 0 == this.value.length || (e += parseFloat(this.value))
        // }), 
        // $("#grandTotal").val(e.toFixed(2))
	// }
    //Product selection end
	
	function upd_stk(current,val){
		debugger;
		var com_qty =  $(current).parent().children('.com_qty_'+val).val();
		if(com_qty=="")
		{
		    com_qty=0;
		}
		var av_qty =  $(current).parent().prev().children().val();
		var qty =  $(current).parent().children('.qty_'+val).val();
		if(qty=="")
		{
		    qty=0;
		}
		var updated_stock_qty = parseInt(qty) + parseInt(com_qty) + parseInt(av_qty);
		var updated_stock_qty1 =  $(current).parent().next().next().next().children();
		updated_stock_qty1.val(updated_stock_qty);
	}
	
	function cal_price(current,val){
	    //debugger;
		var quantity = $(current).val();
		var available_stk_qty = $(current).parent().prev().children().val();
		var updated_stock_qty1 = $(current).parent().next().next().next().children();
		var updated_stock_qty = parseInt(quantity) + parseInt(available_stk_qty);
		updated_stock_qty1.val(updated_stock_qty);
		var discount_per = $(current).parent().next().next().next().next().next().children();
		var price = $(current).parent().next().next().next().next().children().val();
		var total_price = quantity * price;
		var total1 = $(current).parent().next().next().next().next().next().next().next().children();
		if( isNaN(discount_per) || discount_per == "" || discount_per == 0.00 ){
			var discount = 0;
		}else{
			var discount = parseFloat(total_price) * (parseFloat(discount_per)/100);
		}
		var total = parseFloat(total_price) - parseFloat(discount);
		var cgst1 =  $(current).parent().next().next().next().next().next().next().children().children('.cgst_'+val);
		var sgst1 =  $(current).parent().next().next().next().next().next().next().children().children('.sgst_'+val);
		var igst1 =  $(current).parent().next().next().next().next().next().next().children().children('.igst_'+val);
		var utgst1 =  $(current).parent().next().next().next().next().next().next().children().children('.utgst_'+val);
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
		var tax1 = $(current).parent().next().next().next().next().next().next().children().children('.tax_'+val);
		if(tax1.prop('checked') == true){
			var total_tax_per = parseFloat(cgst) + parseFloat(sgst) + parseFloat(igst) + parseFloat(utgst);
		}else{
			var total_tax_per = 0;
		}
		// debugger;
		var total_tax = parseFloat(total) * (parseFloat(total_tax_per)/100);
		var tt = total+total_tax;
		total1.val(tt.toFixed(2));
		 var e = 0;
        $(".total").each(function() {
            isNaN(this.value) || 0 == this.value.length || (e += parseFloat(this.value))
        });
	
        $("#grandTotal").val(e.toFixed(2));
	}
	
	function cal_price_change(current,val){
		//debugger;
		var price = $(current).val();
		var quantity = $(current).parent().prev().prev().prev().children().val();
		if(quantity==""){
		    quantity=0;
		}
		var discount_per = $(current).parent().next().children().val();
		if(discount_per==""){
		    discount_per=0;
		}
		var total_price = quantity * price;
		var total1 = $(current).parent().next().next().next().children();
		var discount = parseFloat(total_price) * (parseFloat(discount_per)/100); 
		var total = parseFloat(total_price) - parseFloat(discount);
		var cgst1 =  $(current).parent().next().next().children().children('.cgst_'+val);
		var sgst1 =  $(current).parent().next().next().children().children('.sgst_'+val);
		var igst1 =  $(current).parent().next().next().children().children('.igst_'+val);
		var utgst1 =  $(current).parent().next().next().children().children('.utgst_'+val);
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
		var tax1 = $(current).parent().next().next().children().children('.tax_'+val);
		if(tax1.prop('checked') == true){
			var total_tax_per = parseFloat(cgst) + parseFloat(sgst) + parseFloat(igst) + parseFloat(utgst);
		}else{
			var total_tax_per = 0;
		}
		var total_tax = parseFloat(total) * (parseFloat(total_tax_per)/100);
		var tt = total+total_tax;
		total1.val(tt.toFixed(2));
		 var e = 0;
        $(".total").each(function() {
            isNaN(this.value) || 0 == this.value.length || (e += parseFloat(this.value))
        }), 
        $("#grandTotal").val(e.toFixed(2))
	}
	
	function cal_total(current,val){
		debugger;
		var discount_per = $(current).val();
		if(discount_per==""){
		    discount_per=0;
		}
		var price = $(current).parent().prev().children().val();
		var quantity = $(current).parent().prev().prev().prev().prev().prev().children().val();
		var total_price = quantity * price;
		var total1 = $(current).parent().next().next().children();
		var discount = parseFloat(total_price) * (parseFloat(discount_per)/100); 
		var total = parseFloat(total_price) - parseFloat(discount);
		var cgst1 =  $(current).parent().next().children().children('.cgst_'+val);
		var sgst1 =  $(current).parent().next().children().children('.sgst_'+val);
		var igst1 =  $(current).parent().next().children().children('.igst_'+val);
		var utgst1 =  $(current).parent().next().children().children('.utgst_'+val);
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
		var tax1 = $(current).parent().next().children().children('.tax_'+val);
		if(tax1.prop('checked') == true){
			var total_tax_per = parseFloat(cgst) + parseFloat(sgst) + parseFloat(igst) + parseFloat(utgst);
		}else{
			var total_tax_per = 0;
		}
		var total_tax = parseFloat(total) * (parseFloat(total_tax_per)/100);
		var tt = total+total_tax;
		total1.val(tt.toFixed(2));
		 var e = 0;
        $(".total").each(function() {
            isNaN(this.value) || 0 == this.value.length || (e += parseFloat(this.value))
        }), 
        $("#grandTotal").val(e.toFixed(2))
	}
	
	function cal_total_t(current,val){
		debugger;
		var discount_per = $(current).parent().parent().prev().children().val();
		if(discount_per=="")
		{
		    discount_per=0;
		}
		var tax1 = $(current).parent().parent().children().children('.tax_'+val);
		var price = $(current).parent().parent().prev().prev().children().val();
		var quantity = $(current).parent().parent().prev().prev().prev().prev().prev().prev().children().val();
		var total_price = parseFloat(quantity) * parseFloat(price);
		var total1 = $(current).parent().parent().next().children();
		var discount = parseFloat(total_price) * (parseFloat(discount_per)/100); 
		var total = parseFloat(total_price) - parseFloat(discount);
		var cgst1 =  $(current).parent().parent().children().children('.cgst_'+val);
		var sgst1 =  $(current).parent().parent().children().children('.sgst_'+val);
		var igst1 =  $(current).parent().parent().children().children('.igst_'+val);
		var utgst1 =  $(current).parent().parent().children().children('.utgst_'+val);
		
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
		total1.val(tt.toFixed(2));
		 var e = 0;
        $(".total").each(function() {
            isNaN(this.value) || 0 == this.value.length || (e += parseFloat(this.value))
        }), 
        $("#grandTotal").val(e.toFixed(2))
	}
	function prd_cal_total()
	{
		var qty = $('#prd_qty').val();
		var price = $('#prd_price').val();
		var sell_price = $('#sell_price').val();
		if(isNaN($('#prd_cgst').val()) || $('#prd_cgst').val() == "" || $('#prd_cgst').val() == 0){
			var prd_cgst = 0 ;
		}else{
			var prd_cgst = $('#prd_cgst').val();
		}
		if(isNaN($('#prd_sgst').val()) || $('#prd_sgst').val() == "" || $('#prd_sgst').val() == 0){
			var prd_sgst = 0 ;
		}else{
			var prd_sgst = $('#prd_sgst').val();
		}
		if(isNaN($('#prd_igst').val()) || $('#prd_igst').val() == "" || $('#prd_igst').val() == 0){
			var prd_igst = 0 ;
		}else{
			var prd_igst = $('#prd_igst').val();
		}
		if(isNaN($('#prd_utgst').val()) || $('#prd_utgst').val() == "" || $('#prd_utgst').val() == 0){
			var prd_utgst = 0 ;
		}else{
			var prd_utgst = $('#prd_utgst').val();
		}
		var total_price = qty*price;
		var total_sellprice = qty*sell_price;
		var total_tax_per = parseFloat(prd_cgst)+parseFloat(prd_sgst)+parseFloat(prd_igst)+parseFloat(prd_utgst);
		var total_tax = parseFloat(total_price)*(parseFloat(total_tax_per)/100);
		var total = parseFloat(total_price)+parseFloat(total_tax);
		var total_sell_tax = parseFloat(total_sellprice)*(parseFloat(total_tax_per)/100);
		var total_sell = parseFloat(total_sellprice)+parseFloat(total_sell_tax);
		$('#total_sell').val(total_sell);
		$('#prd_total').val(total);
	}

function rev_cal_purchase()
{
 //   debugger;
	var total = $('#prd_total').val();
	var total_sell = $('#total_sell').val();
    var cgst=sgst=igst=qty=0;
    	if(isNaN($('#prd_qty').val()) || $('#prd_qty').val() == "" || $('#prd_qty').val() == 0){
		 qty = 0 ;
	}else{
		 qty = $('#prd_qty').val();
	}
	if(isNaN($('#prd_cgst').val()) || $('#prd_cgst').val() == "" || $('#prd_cgst').val() == 0){
		 cgst = 0 ;
	}else{
		 cgst = $('#prd_cgst').val();
	}
	if(isNaN($('#prd_sgst').val()) || $('#prd_sgst').val() == "" || $('#prd_sgst').val() == 0){
		 sgst = 0 ;
	}else{
		 sgst = $('#prd_sgst').val();
	}
	if(isNaN($('#prd_igst').val()) || $('#prd_igst').val() == "" || $('#prd_igst').val() == 0){
		 igst = 0 ;
	}else{
		 igst = $('#prd_igst').val();
	}
	if(isNaN($('#prd_utgst').val()) || $('#prd_utgst').val() == "" || $('#prd_utgst').val() == 0){
		 utgst = 0 ;
	}else{
		 utgst = $('#prd_utgst').val();
	}
	var tax=parseFloat(cgst)+parseFloat(sgst)+parseFloat(igst)+parseFloat(utgst);
	var new_total=(parseFloat(total)/(100+tax))*100;
	var pp=new_total/parseFloat(qty);
	$("#prd_price").val(pp.toFixed(2));
	
	var new_total_sell=(parseFloat(total_sell)/(100+tax))*100;
	var sp=new_total_sell/parseFloat(qty);
	$("#sell_price").val(sp.toFixed(2));
	
}
function addproduct()
{
	var type=$("input[name=type]").filter(":checked").val();
    var product_name=$("#product_name").val();
    var description=$("#description").val();
    var category_id=$("#category_id").val();
    var image=$("#image").val();
    var prd_qty=$("#prd_qty").val();
    var mrp=$("#mrp").val();
    var price=$("#sell_price").val();
    var prd_price=$("#prd_price").val();
    var model=$("#model").val();
    var supplier_id=$("#supplier_id").val();
    var prd_cgst=$("#prd_cgst").val();
    var prd_sgst=$("#prd_sgst").val();
    var prd_igst=$("#prd_igst").val();
    var prd_utgst=$("#prd_utgst").val();
    var prd_total=$("#prd_total").val();
    var rol=$("#rol").val();
    var tax=$("#tax").val();
    var rack=$("#rack").val();
    var total_sell=$("#total_sell").val();
    var redirect=$("#redirect").val();
    var uom=$("#uom").val();
    var code=$("#code").val();
    if(product_name=="")
    {
        alert("Plese fill Product Name");
    }else if(prd_qty=="")
    {
        alert("Plese fill Product Quantity");
    }else if(prd_price=="")
    {
        alert("Plese fill Purchase Price");
    }else if(supplier_id=="")
    {
        alert("Plese Select Supplier");
    }else if(prd_total=="")
    {
        alert("Plese Fill Product Total");
    }else{
             
    var data = new FormData();
    data.append('product_name',product_name);
    data.append('supplier_id',supplier_id);
    data.append('category_id',category_id);
    data.append('mrp',mrp);
    data.append('price',price);
    data.append('supplier_price',prd_price);
    data.append('cartoon_quantity',prd_qty);
    data.append('rol',rol);
    data.append( 'tax',tax);
    data.append('cgst',prd_cgst);
    data.append('sgst',prd_sgst);
    data.append('igst',prd_igst);
    data.append('utgst',prd_utgst);
    data.append('total',prd_total);
    data.append('model',model);
    data.append('description',description);
    data.append( 'uom',uom);
    data.append( 'rack',rack);
    data.append('type',type);
    data.append('total_sell',total_sell);
    data.append('code',code);
    data.append( 'redirect',redirect);
    data.append('image', document.getElementById('image').files[0]);
    
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Cproduct/insert_product'); ?>",
            data: data,
            processData: false,
            contentType: false,
            success: function (response) {
               //alert(response);
				$('#myModal').modal('toggle');
				 var supplier_id=$('#supplier_sss').val();
				 var csrf_test_name=  $("[name=csrf_test_name]").val();
				 $.ajax({
					 url: '<?php echo base_url('Cpurchase/product_search_by_supplier_purchase')?>',
					 type: 'post',
					 data: {supplier_id:supplier_id,csrf_test_name:csrf_test_name}, 
					 success: function (msg){
					//     alert(msg);
						 $('.productSelection').append(msg);
					 },
					 error: function (xhr, desc, err){
						  alert('failed');
					 }
				 }); 
            }
        });
    }
}

     function addnewPurchaseInputField(divName){
	//	 debugger;
		// alert("here");
         //var param = "$(this).attr(name)";
          if (count == limits)  {
               alert("You have reached the limit of adding " + count + " inputs");
          }
          else {
             // alert(count);
               var newdiv = document.createElement('tr');
               var tabin="prd_name"+count;
               newdiv.innerHTML ="<td>"+
               "<input type='text' name='product_name'  onkeyup='<?php if($Web_settings[0]["supplier_price"]=="1") { ?>purchase_product_List2(this," + count + ")<?php  }else{ ?> purchase_product_List(this," + count + ") <?php } ?>' class='form-control productSelection' placeholder='Product Name' required='' id='"+tabin+"' >"+

               "<input type='hidden' class='autocomplete_hidden_value product_id_" + count + "' name='product_id[]' id='SchoolHiddenId'/>"+
               "</td><td>"+
               "<input type='text' class='form-control text-right available_stk_qty_" + count + "' name='available_stk_qty[]' placeholder='Available stock'  readonly='readonly'  />"+
               "</td><td class='text-right'>"+
               "<input type='text' name='qty[]'  required class='form-control text-right qty_" + count + "' onkeyup='cal_price(this," + count + ");' onblur='cal_price(this," + count + ");' placeholder='0.00' value='' min='0' />"+
			   "<input type='text' name='com_qty[]'  id='com_qty' class='form-control text-right com_qty_" + count + "'  onkeyup='upd_stk(this," + count + ");' onblur='upd_stk(this," + count + ");' placeholder='Comp Qty' value='' min='0' />"+
			   "</td><td>"+
               "<input type='text' class='form-control text-right uom_" + count + "' name='uom[]' placeholder='UOM'  readonly='readonly' />"+
               "</td><td>"+
			   "<input type='text' class='form-control text-right rack_" + count + "' placeholder='Rack'  readonly='readonly' />"+
               "</td><td class='text-right'>"+
               "<input type='text' name='updated_stock_qty[]' readonly='readonly' class='form-control text-right updated_stock_qty_" + count + "' placeholder='0.00' />"+
               "</td><td class='text-right'>"+
               "<input type='text' name='price[]' class='form-control price_" + count + " text-right' placeholder='0.00' value='' min='0' onkeyup='cal_price_change(this," + count + ");' onblur='cal_price_change(this," + count + ");' />"+
               "</td><td>"+
               "<input class='form-control discount_" + count + " text-right' type='text' name='discount[]' onkeyup='cal_total(this," + count + ");' onblur='cal_total(this," + count + ");' placeholder='0.00' />"+
               "</td><td class='text-center' width='20%'>"+
               "<label class='switch'>"+
											  "<input type='checkbox' id='tax' class='tax_" + count + "' name='tax' onchange='cal_total_t(this," + count + ")' checked >"+
											  "<span class='slider round'></span>"+
											"</label><br>"+
											"<div id='cgst_tax_" + count + "'>"+
											  "CGST-<input type='text' class='cgst_" + count + "' name='cgst[]' style='width:10%;border:none;'>"+
											"</div><div id='sgst_tax_" + count + "'>"+
											  "SGST-<input type='text' class='sgst_" + count + "' name='sgst[]' style='width:10%;border:none;' >"+
											"</div><div id='igst_tax_" + count + "'>"+
 											  "IGST-<input type='text' class='igst_" + count + "' name='igst[]' style='width:10%;border:none;' >"+
											"<div id='utgst_tax_" + count + "'>"+
											  "UTGST-<input type='text' class='utgst_" + count + "' name='utgst[]' style='width:10%;border:none;' >"+
              
               "</div></td><td class='text-right'>"+
               "<input id='total_" + count + "' class='total form-control text-right' text-right' type='text' name='total[]' value='0.00' readonly='readonly' />"+
               "</td><td>"+
               "<button style='text-align: right;' class='btn btn-danger red' type='button' value='Delete' onclick='deleteRow(this)' >Delete</button>"+
               "</td>";
               document.getElementById(divName).appendChild(newdiv);
               document.getElementById(tabin).focus();
                count++;
          //    alert(count);
          }
     }

</script>


