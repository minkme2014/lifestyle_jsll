<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
</style>
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
<!-- Add Product Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('new_product') ?></h1>
            <small><?php echo display('add_new_product') ?></small>
            <ol class="breadcrumb">
                <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('product') ?></a></li>
                <li class="active"><?php echo display('new_product') ?></li>
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

        <!-- Add Product -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <!--div class="panel-heading">
                        <div class="panel-title">
                            <h4><--?php echo display('new_product') ?></h4>
                        </div>
                    </div--->
                    <?php echo form_open_multipart('Cproduct/insert_product',array('class' => 'form-vertical', 'id' => 'insert_product','name' => 'insert_product'))?>
                    <div class="panel-body">
                        <div class="row">
                            
                                <div class="form-group row">
                                    <label for="type" class="col-sm-4 col-md-2  col-form-label">Type </label>
                                    <div class="col-sm-4  col-md-2">
                                        <label><input type="radio" name="type" value="Goods" checked>Goods</label>
                                    </div>
                                    <div class="col-sm-4  col-md-2">
                                        <label><input type="radio" name="type" value="Services">Services</label>
                                    </div>
                         
                                </div>
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-4 col-md-2  col-form-label"><?php echo display('product_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8  col-md-4">
                                        <input class="form-control margon_btm" name="product_name" type="text" id="product_name" placeholder="<?php echo display('product_name') ?>" required  tabindex='1'>
                                    </div>
                         
                                    <label for="description" class="col-sm-4  col-md-2 col-form-label"><?php echo display('details') ?></label>
                                    <div class="col-sm-8  col-md-4">
                                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="<?php echo display('details') ?>" tabindex='2'></textarea>
                                    </div>
                                </div>
                               <div class="form-group row">
                                    <label for="category_id" class="col-sm-4  col-md-2 col-form-label"><?php echo display('category') ?></label>
                                    <div class="col-sm-8  col-md-4 margon_btm">
                                        <select class="form-control " id="category_id" name="category_id"  tabindex='3'>
                                        <option value=""><?php echo display('select_one') ?></option>
                                        <?php
                                            if ($category_list) {
                                        ?>
                                        {category_list}
                                            <option value="{category_id}">{category_name}</option>
                                        {/category_list}
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                            
                                    <label for="image" class="col-sm-4  col-md-2 col-form-label"><?php echo display('image') ?> </label>
                                    <div class="col-sm-8  col-md-4">
                                        <input type="file" name="image" class="form-control" id="image" tabindex='4'>
                                    </div>
                                     </div>
                                </div> 
                            </div>
                        </div>

                        <div class="table-responsive" style="margin-top: 10px">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_quantity') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center">UOM </th>
                                        <th class="text-center"><?php echo display('mrp') ?> </th>
                                        <th class="text-center"><?php echo display('sell_price') ?> </th>
                                        <th class="text-center">Purchase Price <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('manufacturer_name') ?></th>
                                        <th class="text-center"><?php echo display('supplier') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('tax') ?>%</th>
                                        <th class="text-center"><?php echo display('total') ?> <i class="text-danger">*</i></th>
                                    </tr>
                                </thead>
                                <tbody id="form-actions">
                                    <tr class="">
                                        <td class="" style="width:14%">
                                            <input class="form-control text-right" id="qty" name="cartoon_quantity" type="number" onkeyup="cal_total();" onblur="cal_total();" required="" placeholder="<?php echo display('item_quantity') ?>" tabindex="5" min="0">
                                        </td>    
                                        <td class="" style="width:12%">
                                            
                                                  <select name="uom" class="form-control" required="" tabindex='9'>
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
                                        </td> 
                                        <td class="" style="width:10%">
                                            <input class="form-control text-right" name="mrp" type="number" step="0.01" placeholder="<?php echo display('mrp') ?>" tabindex="6" min="0">
                                        </td> 
                                        <td class="" style="width:10%">
                                            <input class="form-control text-right" name="price" type="number" step="0.01" placeholder="<?php echo display('sell_price') ?>" tabindex="6" min="0">
                                        </td>
                                        <td class="" style="width:10%">
                                            <input type="number" tabindex="7" id="price" class="form-control text-right" onkeyup="cal_total();" onblur="cal_total();" name="supplier_price" step="0.01" placeholder="Purchase Price "  required  min="0"/>
                                        </td>
                                        <td class="text-right" style="width:12%">
                                            <input type="text" tabindex="8" class="form-control" name="model" placeholder="<?php echo display('manufacturer_name') ?>" />
                                        </td>
                                        
                                        <td class="text-right" style="width:12%">
                                            <select name="supplier_id" class="form-control" required="" tabindex='9'>
                                            <?php
                                                if ($supplier){
                                            ?>
                                                <option value=""><?php echo display('select_one')?> 
                                                </option>
                                            {supplier}
                                                <option value="{supplier_id}">{supplier_name} 
                                                </option>
                                            {/supplier}
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </td>
                                        
                                     <!--   <td class="text-center" width="16%">
                                            <label class="switch">
											  <input type="checkbox" id="tax" class="tax" name="tax" onchange="cal_total()" checked>
											  <span class="slider round"></span>
											</label><br>
											  CGST-<input type="text" id="cgst" class="cgst" name="cgst" style="width:10%;border:none;" onkeyup="cal_total();" onblur="cal_total();" >
											  SGST-<input type="text" id="sgst" class="sgst" name="sgst" style="width:10%;border:none;" onkeyup="cal_total();" onblur="cal_total();" >
											  IGST-<input type="text" id="igst" class="igst" name="igst" style="width:10%;border:none;" onkeyup="cal_total();" onblur="cal_total();" >
                                        </td>-->
                                        <td class="text-right" style="width:14%">
                                            <input type="number" tabindex="9" class="form-control" id="cgst" name="cgst" step="0.01" onkeyup="cal_total();" onblur="cal_total();" placeholder="<?php echo display('cgst') ?>" style="width:31%; display:inline;padding:0;"/>
											<input type="number" tabindex="10" class="form-control"id="sgst" name="sgst" step="0.01" onkeyup="cal_total();" onblur="cal_total();" placeholder="<?php echo display('sgst') ?>" style="width:31%; display:inline;padding:0;" />
											<input type="number" tabindex="11" class="form-control" id="igst" name="igst" step="0.01" onkeyup="cal_total();" onblur="cal_total();" placeholder="<?php echo display('igst') ?>" style="width:31%; display:inline;padding:0;" />
                                        </td>
                                        <td class="text-right" style="width:15%">
                                            <input type="number" tabindex="12" class="form-control" id="total" name="total" placeholder="<?php echo display('total') ?>" step="0.01" required />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                                            <input type="text" class="form-control" name="redirect"  value="product" style="display:none;" />
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="submit" id="add-product" class="btn btn-primary btn-large" name="add-product" value="<?php echo display('save') ?>"  tabindex='10'/>
                                <input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-product-another" class="btn btn-large btn-success" id="add-product-another" tabindex='11'>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Add Product End -->
<script>

function cal_total(){
	var qty = $('#qty').val();
	var price = $('#price').val();
	if(isNaN($('#cgst').val()) || $('#cgst').val() == "" || $('#cgst').val() == 0){
		var cgst = 0 ;
	}else{
		var cgst = $('#cgst').val();
	}
	if(isNaN($('#sgst').val()) || $('#sgst').val() == "" || $('#sgst').val() == 0){
		var sgst = 0 ;
	}else{
		var sgst = $('#sgst').val();
	}
	if(isNaN($('#igst').val()) || $('#igst').val() == "" || $('#igst').val() == 0){
		var igst = 0 ;
	}else{
		var igst = $('#igst').val();
	}
	var total_price = qty*price;
	var total_tax_per = parseFloat(cgst)+parseFloat(sgst)+parseFloat(igst);
	var total_tax = parseFloat(total_price)*(parseFloat(total_tax_per)/100);
	var total = parseFloat(total_price)+parseFloat(total_tax);
	$('#total').val(total);
}
/*function cal_total(){
	var qty = $('#qty').val();
	var price = $('#price').val();
	var cgst = 0 ;
	var sgst = 0 ;
	var igst = 0 ;
	 if ($(".tax").is(':checked')) {
	     
    	if(isNaN($('#cgst').val()) || $('#cgst').val() == "" || $('#cgst').val() == 0){
	    	 cgst = 0 ;
    	}else{
    		 cgst = $('#cgst').val();
    	}
    	if(isNaN($('#sgst').val()) || $('#sgst').val() == "" || $('#sgst').val() == 0){
	    	 sgst = 0 ;
    	}else{
    		 sgst = $('#sgst').val();
    	}
    	if(isNaN($('#igst').val()) || $('#igst').val() == "" || $('#igst').val() == 0){
    		 igst = 0 ;
    	}else{
    		 igst = $('#igst').val();
    	}
	     
	 }else{
	     cgst = 0 ;
	     sgst = 0 ;
	     igst = 0 ;
	 }
	var total_price = qty*price;
	var total_tax_per = parseFloat(cgst)+parseFloat(sgst)+parseFloat(igst);
	var total_tax = parseFloat(total_price)*(parseFloat(total_tax_per)/100);
	var total = parseFloat(total_price)+parseFloat(total_tax);
	$('#total').val(total);
}*/
</script>