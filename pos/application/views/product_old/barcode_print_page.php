<!-- Barcode print js -->
<script type="text/javascript">
	function printDiv(divName) {
	   	var printContents = document.getElementById(divName).innerHTML;
	    var originalContents = document.body.innerHTML;
	    document.body.innerHTML = printContents;
		// document.body.style.marginTop="-45px";
	    window.print();
	    document.body.innerHTML = originalContents;
	}
</script>
<style>.br_redio {
    display: flex;
    padding: 0px 0px 14px;
    font-size: 18px;
    float: left;
    width: 80%;
}
.br_redio input[type="radio"] {
    width: 25px;
    height: 19px;
}
a.submit_btnn.btn-warning.con_btn_bar {
    padding: 4px;
    float: right;
}
a.btn-primary.br_print {
    padding: 6px;
    border-radius: 4px;
}
.pro_bar h4.modal-title {
    width: 80%;
    float: left;
}
.pro_bar button.close {
    float: right;
}

</style>

<!-- Barcode list start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php if(empty($qr_image)){echo display('barcode');}else{echo display('qr_code');}?></h1>
            <small><?php if(empty($qr_image)){echo display('barcode');}else{echo display('qr_code');}?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('product') ?></a></li>
                <li class="active"><?php if(empty($qr_image)){echo display('barcode');}else{echo display('qr_code');}?></li>
            </ol>
        </div>
    </section>

    <section class="content">
        <!-- Product Barcode and QR code -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php if(empty($qr_image)){echo display('barcode');}else{echo display('qr_code');}?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('Cproduct/insert_product')?>
                    <div class="panel-body">

                		<?php
						if ( !empty($product_id) || !empty($qr_image)) {
						?>
							<div style="float: center">
								<!--a  class="btn btn-info" href="#" onclick="printDiv('printableArea')"><?php echo display('print')?></a-->
								<a  class="btn btn-danger" href="<?php echo base_url('Cproduct');?>"><?php echo display('cancel')?></a>
								<a  class="btn btn-success" data-toggle="modal" data-target="#barcode_edit" >Edit</a>
								<?php
								if($product_code!="")
								{
								?>
								<a  class="btn btn-success"  onclick="show_product_barcode_detail('{product_code}','{price}','{company_name}/{product_name_for_barcode}', '', '');">Generate Barcode</a>
								<?php
					         	}
						       ?>
							</div>
						<?php
						}
						?>
                        <!--div class="table-responsive" style="margin-top: 10px">
                            <?php
							if (isset($product_id)) {
							?>
								<div id="printableArea">
									<table  id="" class="table table-bordered " style=" border-collapse: collapse;">
									<?php
									$counter = 0;
									for ($i=0; $i < 60 ; $i++) { 
									?>
									<?php if($counter == 5) { ?>
									<tr> 
									<?php $counter = 0; ?>
									<?php } ?>
										<td style="border: 1px solid black ;padding: 5px">		
											
											<div class="barcode-inner" style="font-family: 'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;text-align: center; position: relative;">
												<div class="product-name" style="text-transform: uppercase;line-height: 10px;font-weight: 600;font-size: 12px;margin-bottom: 3px;">
													{company_name}
												</div>
												<span class="model-name" style="font-weight: 600;
													font-size: 8px;
													position: absolute;
													top: 0;
													right: 0;">{product_model}</span>
												<img src="<?php echo base_url('Cbarcode/barcode_generator/{product_code}')?>" class="img-responsive center-block" alt="" style="display: block;margin-left: auto;margin-right: auto;height: 58px;width: 100%;">
												<div class="product-name-details" style="font-size: 11px;letter-spacing: 0.5px;font-weight: 600;text-transform: uppercase;line-height: 8px;">{product_name}</div>
												<div class="price" style="font-weight: 500;line-height: 10px;margin-top: 5px;">MRP {price}
													<small style="font-weight: 600;font-size: 9px;">Incl GST</small>
												</div>
											</div>
											
										</td>
										<?php if($counter == 5) { ?>
											</tr> 
											<?php $counter = 0; ?>
										<?php } ?>
										<?php $counter++; ?>
									<?php
									}
									?>
									</table>
								</div>
							<?php
							}else{
							?>
							<div id="printableArea">
								<table class="table table-bordered"  style=" border-collapse: collapse;">
								<?php
								$counter = 0;
								for ($i=0; $i < 30 ; $i++) { 
								?>
								<?php if($counter == 5) { ?>
								<tr> 
								<?php $counter = 0; ?>
								<?php } ?>
									<td style="border: 1px solid black ;padding: 5px">	
										<div class="barcode-inner" style="font-family: 'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;text-align: center; position: relative;">
											<div class="product-name" style="text-transform: uppercase;line-height: 10px;font-weight: 600;font-size: 12px;margin-bottom: 3px;">
												{company_name}
											</div>
											<span class="model-name" style="font-weight: 600;
												font-size: 8px;
												position: absolute;
												top: 0;
												right: 0;">{product_model}</span>
											<img src="<?php echo base_url('my-assets/image/qr/{qr_image}')?>" class="img-responsive center-block" alt="" style="display: block;margin-left: auto;margin-right: auto;height:150px">
											<div class="product-name-details" style="font-size: 11px;letter-spacing: 0.5px;font-weight: 600;text-transform: uppercase;line-height: 8px;">{product_name}</div>
											<div class="price" style="font-weight: 500;line-height: 10px;margin-top: 5px;"><?php echo display('money')?>. {price}. <small style="font-weight: 600;font-size: 9px;"><?php echo display('incl_vat')?></small>
											</div>
										</div>
									</td>
									<?php if($counter == 5) { ?>
										</tr> 
										<?php $counter = 0; ?>
									<?php } ?>
									<?php $counter++; ?>
								<?php
								}
								?>
								</table>
							</div>
							<?php
							}
							?>
                        </div-->
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </section>
	
  <!-- Modal -->
  <div class="modal fade" id="barcode_edit" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Barcode</h4>
        </div>
                    <?php echo form_open_multipart('Cbarcode/edit_barcode/'.$product_id,array('class' => 'form-vertical', 'id' => 'edit_barcode','name' => 'edit_barcode'))?>
        <div class="modal-body">
		   <div class="row">
				<div class="col-sm-12">
					<div class="form-group row">
						<label for="company_name" class="col-sm-4 col-form-label">Company Name</label>
						<div class="col-sm-8">
							<input class="form-control" name="company_name" type="text" id="company_name" placeholder="company_name" value={company_name} />
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
				   <div class="form-group row">
						<label for="product_code" class="col-sm-4 col-form-label">Product Name for Barcode</label>
						<div class="col-sm-8">
							<input class="form-control" name="product_name_for_barcode" rows="3" placeholder="Product Name for Barcode" value={product_name_for_barcode} />
						</div>
					</div> 
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
				   <div class="form-group row">
						<label for="product_code" class="col-sm-4 col-form-label">Product Code</label>
						<div class="col-sm-8">
							<input class="form-control" name="product_code" id="product_code" rows="3" placeholder="Product Code" value={product_code} />
							 <i class="text-danger" id="code_exist" hidden>This code is alerady exist</i>
						</div>
					</div> 
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-6">
					<input type="submit" class="btn btn-primary btn-large" id="save" value="<?php echo display('save') ?>" />
				</div>
			</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
<!-- Barcode list End -->

<!-- start generate barcode modal -->

<div class="modal" id="generate_barcode">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header pro_bar">
                        <h4 class="modal-title">Product Barcode</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div id="barcode_div" style="">                            
                            <div class="form_bar"> 
                                <div class="title_barcode">
                                   <!-- <span class="title_mink">MinkFoodiee</span> <span class="title_res"><?php echo $this->session->userdata('user_name') ?></span>-->
                                     <span class="title_res text-center"><?php echo $this->session->userdata('user_name') ?></span>
                                </div>
                                <div class="img_bar">
                                    <img id="barcode1" src="">
                                </div>  
                                <div class="col-md-12 col-sm-12"> 
                                    <label> Left label : </label><input class="form-control" type="text" id="barcode_lable_input_1" value="" maxlength="20">
                                    <label> Right label  : </label><input class="form-control" type="text" id="barcode_lable_input_2" value="" maxlength="20">
                                    <label>Barcode print count : </label><input class="form-control" type="number" id="barcode_print_count" value="1" min="1" max="100">
                                    <label>Barcode print in row : </label>
                                    <div class="br_redio">
                                    <input class="" type="radio" name="barcode_print_count" value="1">1
                                   <input class="" type="radio" name="barcode_print_count" value="2" checked="">2
                                    <input type="hidden" id="barcode_product_name" />
                                    <input type="hidden" id="barcode_product_price" />
                                    <input type="hidden" id="barcode_product_id" />
                                    </div>
                                    <a class="submit_btnn  btn-warning con_btn_bar" style="cursor:pointer" onclick="confirm_product_barcode_detail();">Confirm</a>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 bar_codes" id="barcode_print_div" style="display:none;margin-top:80px;">
                                <div style="width: 380px; height: 90px; overflow: hidden; max-height: 90px; margin-top: -2px;">
                                    <div  style="width: 48%; float: left;" class="image_code">
                                        <div style="overflow: hidden; width: 100%; margin: 0 auto;"  class="main_bar_txt"> 
                                         <!--    <span style="width: 44%; display: inline-block; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis; font-size: 9px;    text-align: center;" class="title_mink">MinkFoodiee</span>-->
                                            <span style="width: 100%; display: inline-block; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis; font-size: 9px;    text-align: center;" class="title_res"><?php echo $this->session->userdata('user_name') ?></span>
                                        </div> 
                                        <div class="img_bar" style="text-align: center;">
                                            <img id="double_barcode_img_1" style="width: 75%; height: 55px;" src="">
                                           <!-- <p id="double_barcode_product_name_1" style="margin: 0; line-height: 14px; font-size: 10px; width: 62%; display: inline-block; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis;text-align: center;"></p>-->
                                            <p id="double_barcode_product_price_1" style="margin: 0; line-height: 14px; font-size: 10px; width: 62%; display: inline-block; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis;text-align: center;"></p>
                                        </div> 
                                        <div  style="text-align: center;position: relative;"  class="barcode_txt">
                                            <p id="double_barcode_left_label_1" style="transform: rotate(90deg); float: left; position: absolute; left: -10%; bottom: 32px; margin: 0; width: 36%; display: inline-block; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis; font-size: 12px; text-align: center;"></p>
                                            <p id="double_barcode_right_label_1" style="float: right; right: -11%; bottom: 31px; transform: rotate(90deg); position: absolute; margin: 0; width: 36%; display: inline-block; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis; font-size: 12px; text-align: center;"></p>  
                                        </div>
                                    </div>



                                    <div style="width: 48%; float: right;"  class="image_code">
                                        <div style="overflow: hidden; width: 100%; margin: 0 auto;" class="main_bar_txt"> 
                                         <!--    <span style="width: 44%; display: inline-block; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis; font-size: 9px;    text-align: center;" class="title_mink">MinkFoodiee</span>-->
                                            <span style="width: 100%; display: inline-block; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis; font-size: 9px;     text-align: center;" class="title_res"><?php echo $this->session->userdata('user_name') ?></span>
                                        </div>  
                                        <div class="img_bar" style="text-align: center;">
                                            <img id="double_barcode_img_2" style="width: 75%; height:55px;"  id="barcode1" src="">
                                            <!--<p id="double_barcode_product_name_2" style="margin: 0; line-height: 14px; font-size: 10px; width: 62%; display: inline-block; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis;text-align: center;"></p>-->
                                            <p id="double_barcode_product_price_2" style="margin: 0; line-height: 14px; font-size: 10px; width: 62%; display: inline-block; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis;text-align: center;"></p>
                                        </div> 
                                        <div style="text-align: center;position: relative;" class="barcode_txt">
                                            <p  id="double_barcode_left_label_2" style="transform: rotate(90deg); float: left; position: absolute; left: -10%; bottom: 32px; margin: 0; width: 36%; display: inline-block; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis; font-size: 12px; text-align: center;"></p>
                                            <p id="double_barcode_right_label_2" style="float: right; right: -11%; bottom: 31px; transform: rotate(90deg); position: absolute; margin: 0; width: 36%; display: inline-block; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis; font-size: 12px; text-align: center;"></p>  
                                        </div>
                                    </div>  
                                </div>

                            </div>

                            <div class="col-md-12 col-sm-12 bar_codes" id="single_barcode_print_div" style="display:none;margin-top:80px;">
                                <div style="width: 380px; height: 90px; overflow: hidden; max-height: 90px; margin-top: -80px;">
                                    <div  style="overflow: hidden; width: 100%; float: left;" class="image_code">
                                        <div style="overflow: hidden;width: 71%; margin: 0 auto;"  class="main_bar_txt"> 
                                          <!--  <span style="width: 49%; display: inline-block; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis;" class="title_mink">MinkFoodiee</span>-->
                                            <span style="width: 51%; display: inline-block; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis;text-align: right;" class="title_res"><?php echo $this->session->userdata('user_name') ?></span>
                                        </div> 
                                        <div class="img_bar">
                                            <img style="width: 72%; height: 55px;" id="single_barcode_img" src="">
                                          <!--  <p id="single_barcode_product_name" style="margin: 0; line-height: 14px; font-size: 10px; width: 62%; display: inline-block; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis;"></p>-->
                                            <p id="single_barcode_product_price" style="margin: 0; line-height: 14px; font-size: 10px; width: 62%; display: inline-block; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis;"></p>
                                        </div> 
                                        <div  style="text-align: center;position: relative;"  class="barcode_txt">
                                            <div>
                                            <p id="single_barcode_left_label" style="transform: rotate(90deg); text-align: left; float: left; position: absolute; left: 7%;bottom: 47px;"></p>
                                          
                                            </div>
                                            <div>
                                            
                                           
                                                <p id="single_barcode_right_label" style="transform: rotate(90deg); text-align: right; float: right; position: absolute;right: 7%;bottom:  47px;"></p>  
                                        </div>
</div>                                    </div>                            
                                </div>                                
                            </div>
                                <div id="barcode_print_btn" class="col-md-6 col-sm-6 btn_barpri" style="display:none;">
                                <a class=" btn-primary br_print" style="cursor:pointer" onclick="print_barcode();">Print</a>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
<!-- end generate barcode modal -->        
        
<script>
$(document).ready(function(){
  	$("#product_code").keyup(function(){
		debugger;
		var value= $(this).val();
		
		 $.ajax({
			 url: '<?php echo base_url('Cproduct/check_prd_code')?>',
            type: 'post',
            data: {data:value}, 
			success: function(result)
			{
				if(result!=0)
				{
					$("#code_exist").show();
					$("#save").attr("disabled", true);
				}else{
					$("#code_exist").hide();
					$("#save").attr("disabled", false);
				}
			}});
	});
});
</script>
<script src="<?=base_url()?>assets/js/barcode/JsBarcode.all.js"></script> 
<script src="<?=base_url()?>assets/js/barcode/barcode.js"></script>
