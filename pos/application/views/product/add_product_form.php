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
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="type" class="col-sm-4 col-md-2  col-form-label"><?php echo display('type') ?> </label>
                                    <div class="col-sm-4  col-md-2">
                                        <label><input type="radio" name="type" value="<?php echo display('goods') ?>" checked><?php echo display('goods') ?> </label>
                                    </div>
                                    <div class="col-sm-4  col-md-2">
                                        <label><input type="radio" name="type" value="<?php echo display('services') ?>"><?php echo display('services') ?></label>
                                    </div>
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
                                <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="code" class="col-sm-4 col-md-2  col-form-label"><?php echo display('code') ?>  </label>
                                    <div class="col-sm-8  col-md-4">
                                        <input class="form-control margon_btm" name="code" type="text" id="code" placeholder="<?php echo display('code') ?>" >
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
                                        <th class="text-center"><?php echo display('ROL') ?></th>
                                        <th class="text-center"><?php echo display('uom') ?> </th>
                                        <th class="text-center">Rack </th>
                                        <th class="text-center"><?php echo display('mrp') ?> </th>
                                        <th class="text-center"><?php echo display('sell_price') ?> </th>
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
                                        <td class="" style="width:10%">
                                            <input class="form-control text-right" id="qty" name="cartoon_quantity" type="number" onkeyup="cal_total();" onblur="cal_total();" required="" placeholder="<?php echo display('item_quantity') ?>" tabindex="5" min="0">
                                        </td>
                                        	<td class="" style="width:8%">
                                            <input class="form-control text-right" id="rol" name="rol" type="number" onkeyup="cal_total();" onblur="cal_total();"  placeholder="<?php echo "ROL"; ?>" tabindex="5" min="0">
                                        </td>
                                        <td class="" style="width:8%">
                                            <!--<select name="uom" class="form-control" required="" tabindex='9'>
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
                                            </select>-->
                                            <div class="chk-all">
												<div class="btn-group">
													<input type="text" id="uom_name" data-toggle="modal" data-target="#today_act_modal" placeholder="Select UOM" class="form-control input_type" >
													<input type="text" name="uom" id="uom" hidden>
													<!--i class="fa fa-angle-down"></i-->
												</div>
											</div>
                                        </td> 
                                        <td class="" style="width:8%">
                                            <input class="form-control text-right" name="rack" type="text" placeholder="Rack" tabindex="6">
                                        </td> 
                                        <td class="" style="width:8%">
                                            <input class="form-control text-right" name="mrp" type="number" step="0.01" placeholder="<?php echo display('mrp') ?>" tabindex="6" min="0">
                                        </td> 
                                        <td class="" style="width:8%">
                                            <input class="form-control text-right" name="price" id="sell_price" type="number" step="0.01" placeholder="<?php echo display('sell_price') ?>" tabindex="6" min="0" onkeyup="cal_total();" onblur="cal_total();" >
                                        </td>
                                        <td class="" style="width:8%">
                                            <input type="number" tabindex="7" id="price" class="form-control text-right" onkeyup="cal_total();" onblur="cal_total();" name="supplier_price" step="0.01" placeholder="Purchase Price "  required  min="0"/>
                                        </td>
                                        <td class="text-right" style="width:10%">
                                            <input type="text" tabindex="8" class="form-control" name="model" placeholder="<?php echo display('manufacturer_name') ?>" />
                                        </td>
                                        
                                        <td class="text-right" style="width:10%">
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
                                        <td class="text-right" style="width:12%">
                                            <input type="number" tabindex="9" class="form-control" id="cgst" name="cgst" step="0.01" onkeyup="cal_total();" onblur="cal_total();" placeholder="<?php echo display('cgst') ?>" style="width:45%; display:inline;padding:0;"/>
											<input type="number" tabindex="10" class="form-control"id="sgst" name="sgst" step="0.01" onkeyup="cal_total();" onblur="cal_total();" placeholder="<?php echo display('sgst') ?>" style="width:45%; display:inline;padding:0;" />
											<input type="number" tabindex="11" class="form-control" id="igst" name="igst" step="0.01" onkeyup="cal_total();" onblur="cal_total();" placeholder="<?php echo display('igst') ?>" style="width:45%; display:inline;padding:0;" />
											<input type="number" tabindex="11" class="form-control" id="utgst" name="utgst" step="0.01" onkeyup="cal_total();" onblur="cal_total();" placeholder="<?php echo display('utgst') ?>" style="width:45%; display:inline;padding:0;" />
                                        </td>
                                        <td class="text-right" style="width:10%">
                                            <input type="number" tabindex="12" class="form-control" id="total" name="total" placeholder="<?php echo display('total') ?>" step="0.01" onkeyup="rev_cal_purchase();" required />
                                        </td>
                                        <td class="text-right" style="width:18%">
                                            <input type="number" tabindex="12" class="form-control" id="total_sell" name="total_sell" placeholder="<?php echo display('total') ?>" onkeyup="rev_cal_purchase();"  step="0.01"  />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                                            <input type="text" class="form-control" name="redirect"  value="product" style="display:none;" />
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
										    <input type="submit" id="add-product" class="btn btn-primary btn-large" name="add-product" value="<?php echo display('save') ?>"  tabindex='10'/>
											<input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-product-another" class="btn btn-large btn-success" id="add-product-another" tabindex='11'>
									<?php }
									}	
								}else{?>
										    <input type="submit" id="add-product" class="btn btn-primary btn-large" name="add-product" value="<?php echo display('save') ?>"  tabindex='10'/>
											<input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-product-another" class="btn btn-large btn-success" id="add-product-another" tabindex='11'>
                            
								<?php }?>
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
<script>
function get_uom()
{
	//debugger;
	var uom=$("#select_uom").val();
	var uom_name=$("#select_uom option:selected").html().replace( /[\s\n\r]+/g, ' ' );
//	alert(uom_name);
	$("#uom").val(uom);
	$("#uom_name").val(uom_name);
}
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
	$("#price").val(pp.toFixed(2));
	
	var new_total_sell=(parseFloat(total_sell)/(100+tax))*100;
	var sp=new_total_sell/parseFloat(qty);
	$("#sell_price").val(sp.toFixed(2));
	
}
function cal_total(){
    debugger;
	var qty = $('#qty').val();
	var price = $('#price').val();
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
	var total_tax_per = parseFloat(cgst)+parseFloat(sgst)+parseFloat(igst)+parseFloat(utgst);
	var total_tax = parseFloat(total_price)*(parseFloat(total_tax_per)/100);
	var total = parseFloat(total_price)+parseFloat(total_tax);
	var total_sell_tax = parseFloat(total_sellprice)*(parseFloat(total_tax_per)/100);
	var total_sell = parseFloat(total_sellprice)+parseFloat(total_sell_tax);
	$('#total').val(total);
	$('#total_sell').val(total_sell);
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