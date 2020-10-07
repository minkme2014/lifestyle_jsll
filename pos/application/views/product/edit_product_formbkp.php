<!-- Edit Product Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('product_edit') ?></h1>
            <small><?php echo display('edit_your_product') ?></small>
            <ol class="breadcrumb">
                <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('product') ?></a></li>
                <li class="active"><?php echo display('product_edit') ?></li>
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
                    <!--div class="panel-heading">
                        <div class="panel-title">
                            <h4><--?php echo display('product_edit') ?> </h4>
                        </div>
                    </div-->
                    <?php echo form_open_multipart('Cproduct/product_update', array('class' => 'form-vertical', 'id' => 'product_update', 'name' => 'product_update')) ?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="type" class="col-sm-4 col-md-2  col-form-label"><?php echo display('type') ?> </label>
                                    <div class="col-sm-4  col-md-2">
                                        <label><input type="radio" name="type" value="<?php echo display('goods') ?>" <?php if($type=="Goods"){echo "checked";}?>><?php echo display('goods') ?></label>
                                    </div>
                                    <div class="col-sm-4  col-md-2">
                                        <label><input type="radio" name="type" value="<?php echo display('services') ?>" <?php if($type=="Services"){echo "checked";}?>><?php echo display('services') ?></label>
                                    </div>
                         
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-4 col-form-label"><?php echo display('product_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="product_name" type="text" id="product_name" placeholder="<?php echo display('product_name') ?>" value="{product_name}" required>

                                        <input type="hidden" name="product_id" value="{product_id}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="description" class="col-sm-4 col-form-label"><?php echo display('details') ?> <i class="text-danger"></i></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="description" id="description" rows="3" >{product_details}</textarea>
                                    </div>
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="description" class="col-sm-4 col-form-label"><?php echo display('category') ?></label>
                                    <div class="col-sm-8">
                                        <?php // echo '<pre>';                                print_r($category_selected); ?>
                                        <select name="category_id" class="form-control">
                                            <?php
                                            foreach ($category_list as $category) {
                                                if ($category_selected[0]['category_id'] == $category['category_id']) {
                                                    echo "<option selected value=" . $category['category_id'] . ">" . $category['category_name'] . "</option>";
                                                } else {
                                                    echo "<option value=" . $category['category_id'] . ">" . $category['category_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                            <!--                                            {category_list}
                                                                                        <option value="{category_id}">{category_name} </option>
                                                                                        {/category_list}-->
                                            <?php
//                                            if ($category_selected) {
                                            ?>
                                            <!--                                                {category_selected}
                                                                                            <option selected value="{category_id}">{category_name} </option>-->
                                            {/category_selected}
                                            <?php
//                                            } else {
                                            ?>
                                            <!--<option selected value="0"><?php // echo display('category_not_selected') ?></option>-->
                                            <?php
//                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group row">
                                    <label for="description" class="col-sm-4 col-form-label"><?php echo display('image') ?></label>
                                    <div class="col-sm-8">
                                        <input type="file" name="image" class="form-control">
                                        <img class="img img-responsive text-center" src="{image}" height="80" width="80" style="padding: 5px;">
                                        <input type="hidden" value="{image}" name="old_image">
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="code" class="col-sm-4 col-md-2  col-form-label"><?php echo display('code') ?> </label>
                                    <div class="col-sm-8  col-md-4">
                                        <input class="form-control margon_btm" name="code" type="text" id="code" placeholder="Code" value="{code}" >
                                    </div>
                         
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive" style="margin-top: 10px">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_quantity') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('ROL') ?> </th>
                                        <th class="text-center"><?php echo display('UOM') ?></th>
                                        <th class="text-center">Rack</th>
                                        <th class="text-center"><?php echo display('sell_price') ?> </th>
                                        <th class="text-center"><?php echo display('supplier_price') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('manufacturer_name') ?></th>
                                        <th class="text-center"><?php echo display('supplier') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('tax') ?>%</th>
                                        <th class="text-center"><?php echo display('total') ?> <?php echo display('purchase_price') ?><i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('total') ?> <?php echo display('sales_price') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="form-actions">
                                    <tr class="">
                                        <td class="">
                                            <input class="form-control text-right" name="cartoon_quantity" id="qty" onkeyup="cal_total();" onblur="cal_total();" type="number" value="{cartoon_quantity}" required="" placeholder="<?php echo display('item_quantity') ?>" tabindex="3" min="0">
                                        </td>
                                        <td class="">
                                            <input class="form-control text-right" name="rol" id="rol" onkeyup="cal_total();" onblur="cal_total();" type="number" value="{rol}" placeholder="<?php echo 'ROL'; ?>" tabindex="3" min="0">
                                        </td>
                                        <td class="text-right" style="width:10%">
                                            
                                            <div class="chk-all">
														<div class="btn-group">
															 <input type="text" data-toggle="modal" data-target="#today_act_modal"   placeholder="Select One" class="form-control input_type" ><i class="fa fa-angle-down"></i>
														
														
														</div>
													</div>
                                            
                                            
                                            <!--<select name="uom" class="form-control">
                                                <?php foreach($uom_list as $uom) { ?>
                                                <option value="<?php echo $uom['uom_id']; ?>" <?php if($uom['uom_id']==$uom_selected): echo "selected";endif;?>><?php echo $uom['uom_name'];?> </option>
                                                <?php } ?>
                                            </select>-->
                                            
                                        </td>            
                                        <td class="">
                                            <input class="form-control text-right" name="rack" type="text" value="{rack}" placeholder="Rack" tabindex="3" >
                                        </td>        
                                        <td class="">
                                            <input class="form-control text-right" name="price" id="sell_price" type="number" value="{price}" placeholder="<?php echo display('sell_price') ?>" tabindex="3" min="0" onkeyup="cal_total();" onblur="cal_total();" >
                                        </td>
                                        <td class="text-right">
                                            <input type="number" tabindex="4" class="form-control text-right" id="supplier_price" value="{supplier_price}" name="supplier_price" onkeyup="cal_total();" onblur="cal_total();" placeholder="<?php echo display('supplier_price') ?>"  required min="0"/>
                                        </td>
                                        <td class="text-right">
                                            <input type="text" tabindex="5" class="form-control" value="{product_model}" name="model" placeholder="<?php echo display('manufacturer_name') ?>" />
                                        </td>

                                        <td class="text-right">
                                            <select name="supplier_id" class="form-control">
                                                {supplier_list}
                                                <option value="{supplier_id}">{supplier_name} </option>
                                                {/supplier_list}
                                                <?php
                                                if ($supplier_selected) {
                                                    ?>
                                                    {supplier_selected}
                                                    <option selected value="{supplier_id}">{supplier_name} </option>
                                                    {/supplier_selected}
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option selected value="0"><?php echo display('supplier_not_selected') ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td class="text-right display_flx">
                                            SGST <input type="text" tabindex="6" class="form-control text-right" value="{cgst}" id="cgst" name="cgst" onkeyup="cal_total();" onblur="cal_total();" placeholder="<?php echo display('cgst') ?>" min="0" style="width:40px;" />
                                            CGST <input type="text" tabindex="7" class="form-control text-right" value="{sgst}" id="sgst" name="sgst" onkeyup="cal_total();" onblur="cal_total();" placeholder="<?php echo display('sgst') ?>" min="0" style="width:40px;"  />
                                            IGST <input type="text" tabindex="8" class="form-control text-right" value="{igst}" id="igst" name="igst" onkeyup="cal_total();" onblur="cal_total();" placeholder="<?php echo display('igst') ?>"  min="0" style="width:40px;" />
                                            UTGST <input type="text" tabindex="8" class="form-control text-right" value="{utgst}" id="utgst" name="utgst" onkeyup="cal_total();" onblur="cal_total();" placeholder="<?php echo display('utgst') ?>"  min="0" style="width:40px;" />
                                        </td>
                                        <td class="text-right">
                                            <input type="text" tabindex="9" class="form-control" id="total" value="{total}" name="total" placeholder="<?php echo display('total') ?>" min="0" onkeyup="rev_cal_purchase();" required />
                                        </td>
                                        <td class="text-right">
                                            <input type="text" tabindex="12" class="form-control" id="total_sell" value="{total_sell_price}" name="total_sell" placeholder="<?php echo display('total') ?>" onkeyup="rev_cal_purchase();" step="0.01" style="width:100px;" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="submit" id="add-product" class="btn btn-success btn-large" name="add-product" value="<?php echo display('save_changes') ?>" />
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
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
			<ul class="">
															    <?php
                                                                    if ($uom_list){
                                                                ?>
                                                                
                                                                <input type="search" class="form-control search_box_po"  placeholder="search">
                                                             <?php foreach($uom_list as $uom) { ?>
																<li><a href="#"><?php echo $uom['uom_name'];?></a></li>
																<?php } 
                                                }
                                            ?>
															</ul>		            
   
                                               
      </div>
    </div>
  </div>
</div>
<!-- Edit Product End -->
<script>
function rev_cal_purchase()
{
 //   debugger;
	var total = $('#total').val();
	var total_sell = $('#total_sell').val();
    var cgst=sgst=igst=qty=0;
    	if(isNaN($('#qty').val()) || $('#qty').val() == "" || $('#qty').val() == 0){
		 qty = 0 ;
	}else{
		 qty = $('#qty').val();
	}
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
	if(isNaN($('#utgst').val()) || $('#utgst').val() == "" || $('#utgst').val() == 0){
		 utgst = 0 ;
	}else{
		 utgst = $('#utgst').val();
	}
	var tax=parseFloat(cgst)+parseFloat(sgst)+parseFloat(igst)+parseFloat(utgst);
	var new_total=(parseFloat(total)/(100+tax))*100;
	var pp=new_total/parseFloat(qty);
	$("#supplier_price").val(pp.toFixed(2));
	
	var new_total_sell=(parseFloat(total_sell)/(100+tax))*100;
	var sp=new_total_sell/parseFloat(qty);
	$("#sell_price").val(sp.toFixed(2));
	
}
function cal_total(){
	var qty = $('#qty').val();
	var price = $('#supplier_price').val();
	var sell_price = $('#sell_price').val();
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
	if(isNaN($('#utgst').val()) || $('#utgst').val() == "" || $('#utgst').val() == 0){
		var utgst = 0 ;
	}else{
		var utgst = $('#utgst').val();
	}
	var total_price = qty*price;
	var total_sellprice = qty*sell_price;
	var total_tax_per = parseInt(cgst)+parseInt(sgst)+parseInt(igst)+parseInt(utgst);
	var total_tax = parseInt(total_price)*(parseInt(total_tax_per)/100);
	var total = parseInt(total_price)+parseInt(total_tax);
	var total_sell_tax = parseFloat(total_sellprice)*(parseFloat(total_tax_per)/100);
	var total_sell = parseFloat(total_sellprice)+parseFloat(total_sell_tax);
	$('#total').val(total);
	$('#total_sell').val(total_sell);
}
</script>