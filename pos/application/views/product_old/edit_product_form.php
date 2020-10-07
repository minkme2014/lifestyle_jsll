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
                                    <label for="type" class="col-sm-4 col-md-2  col-form-label">Type </label>
                                    <div class="col-sm-4  col-md-2">
                                        <label><input type="radio" name="type" value="Goods" <?php if($type=="Goods"){echo "checked";}?>>Goods</label>
                                    </div>
                                    <div class="col-sm-4  col-md-2">
                                        <label><input type="radio" name="type" value="Services" <?php if($type=="Services"){echo "checked";}?>>Services</label>
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

                        <div class="table-responsive" style="margin-top: 10px">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_quantity') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center">UOM</th>
                                        <th class="text-center"><?php echo display('sell_price') ?> </th>
                                        <th class="text-center"><?php echo display('supplier_price') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('manufacturer_name') ?></th>
                                        <th class="text-center"><?php echo display('supplier') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('tax') ?>%</th>
                                        <th class="text-center"><?php echo display('total') ?> <i class="text-danger">*</i></th>
                                    </tr>
                                </thead>
                                <tbody id="form-actions">
                                    <tr class="">
                                        <td class="">
                                            <input class="form-control text-right" name="cartoon_quantity" id="qty" onkeyup="cal_total();" onblur="cal_total();" type="number" value="{cartoon_quantity}" required="" placeholder="<?php echo display('item_quantity') ?>" tabindex="3" min="0">
                                        </td>
                                        <td class="text-right" style="width:10%">
                                            <select name="uom" class="form-control">
                                                <?php foreach($uom_list as $uom) { ?>
                                                <option value="<?php echo $uom['uom_id']; ?>" <?php if($uom['uom_id']==$uom_selected): echo "selected";endif;?>><?php echo $uom['uom_name'];?> </option>
                                                <?php } ?>
                                            </select>
                                        </td>            
                                        <td class="">
                                            <input class="form-control text-right" name="price" type="number" value="{price}" placeholder="<?php echo display('sell_price') ?>" tabindex="3" min="0">
                                        </td>
                                        <td class="text-right">
                                            <input type="number" tabindex="4" class="form-control text-right" id="supplier_price" value="{supplier_price}" name="supplier_price" onkeyup="cal_total();" onblur="cal_total();" placeholder="<?php echo display('supplier_price') ?>"  required min="0"/>
                                        </td>
                                        <td class="text-right">
                                            <input type="text" tabindex="5" class="form-control" value="{product_model}" name="model" placeholder="<?php echo display('manufacturer_name') ?>"  required />
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
                                            SGST <input type="text" tabindex="6" class="form-control text-right" value="{cgst}" id="cgst" name="cgst" onkeyup="cal_total();" onblur="cal_total();" placeholder="<?php echo display('cgst') ?>" min="0" style="width:60%;" />
                                            CGST <input type="text" tabindex="7" class="form-control text-right" value="{sgst}" id="sgst" name="sgst" onkeyup="cal_total();" onblur="cal_total();" placeholder="<?php echo display('sgst') ?>" min="0" style="width:60%;"  />
                                            IGST <input type="text" tabindex="8" class="form-control text-right" value="{igst}" id="igst" name="igst" onkeyup="cal_total();" onblur="cal_total();" placeholder="<?php echo display('igst') ?>"  min="0" style="width:60%;" />
                                        </td>
                                        <td class="text-right">
                                            <input type="text" tabindex="9" class="form-control" id="total" value="{total}" name="total" placeholder="<?php echo display('total') ?>" min="0" required />
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
<!-- Edit Product End -->
<script>
function cal_total(){
	var qty = $('#qty').val();
	var price = $('#supplier_price').val();
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
	var total_tax_per = parseInt(cgst)+parseInt(sgst)+parseInt(igst);
	var total_tax = parseInt(total_price)*(parseInt(total_tax_per)/100);
	var total = parseInt(total_price)+parseInt(total_tax);
	$('#total').val(total);
}
</script>