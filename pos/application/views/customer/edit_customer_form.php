<!--Edit customer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('customer_edit') ?></h1>
            <small><?php echo display('customer_edit') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('customer') ?></a></li>
                <li class="active"><?php echo display('customer_edit') ?></li>
            </ol>
        </div>
    </section>

    <section class="content">
        <!-- alert message -->
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

        <!-- New customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <!--div class="panel-heading">
                        <div class="panel-title">
                            <h4><--?php echo display('customer_edit') ?> </h4>
                        </div>
                    </div-->
                  <?php echo form_open_multipart('Ccustomer/customer_update',array('class' => 'form-vertical', 'id' => 'customer_update'))?>
                    <div class="panel-body">
                    	<div class="form-group row">
                            <div class="col-sm-2 margon_btm">
                             <label><?php echo display('salutation') ?></label>
							</div>
                            <div class="col-sm-4 margon_btm">
                             <select class="form-control" id="salutation" name="salutation"  tabindex='1' required>
								<option value="0">-- <?php echo display('salutation') ?> --</option>
									<option value="Mr." <?php if($salutation=="Mr."){echo "selected"; } ?>>Mr.</option>
									<option value="Mrs."<?php if($salutation=="Mrs."){echo "selected"; } ?>>Mrs.</option>
									<option value="Ms."<?php if($salutation=="Ms."){echo "selected"; } ?>>Ms.</option>
									<option value="Miss."<?php if($salutation=="Miss."){echo "selected"; } ?>>Miss.</option>
									<option value="Dr."<?php if($salutation=="Dr."){echo "selected"; } ?>>Dr.</option>
								</select>
							</div>
                             <div class="col-sm-6 margon_btm">
                                   <input class="form-control margon_btm" name ="customer_name" id="customer_name" type="text" placeholder="<?php echo display('customer_name') ?>"  required="" value="{customer_name}" tabindex='1'>
                             </div>
                        </div>

                    	<div class="form-group row">
                            <!--label for="customer_name" class="col-sm-3 col-form-label"><--?php echo display('customer_name') ?> <i class="text-danger">*</i></label-->
                            <div class="col-sm-6">
                                <input class="form-control" name ="company" id="company" type="text" value="{company}" placeholder="<?php echo display('company') ?>"  required=""  tabindex='2'>
                            </div>
                             <!--label for="email" class="col-sm-3 col-form-label"><--?php echo display('customer_email') ?></label-->
                            <div class="col-sm-6">
                                <input class="form-control" name ="email" value="{customer_email}" id="email" type="email" placeholder="<?php echo display('customer_email') ?>" tabindex='2'>
                            </div>
                        </div>
   
                   

                        <div class="form-group row">
                            <!--label for="mobile" class="col-sm-3 col-form-label"><--?php echo display('customer_mobile') ?></label-->
                            <div class="col-sm-6">
                                <input class="form-control margon_btm" name ="mobile" value="{customer_mobile}" id="mobile" type="number" placeholder="<?php echo display('customer_mobile') ?>" min="0" tabindex='3'>
                            </div>
                              <!--label for="gst_no" class="col-sm-3 col-form-label">GST Number </label-->
                            <div class="col-sm-6">
                                <input class="form-control" name ="gst_no" id="gst_no" placeholder="<?php echo display('GST_number') ?>" tabindex='3' value="{gst_no}" >
                            </div>
                        </div>
   
                      
                        <div class="form-group row">
                            <!--label for="state_code" class="col-sm-3 col-form-label">State Code </label-->
                            <div class="col-sm-6">
                                <input class="form-control margon_btm" name ="state_code" id="state_code" placeholder="<?php echo display('state_code') ?>" tabindex='3' value="{state_code}" >
                            </div>
                               <!--label for="address " class="col-sm-3 col-form-label"><--?php echo display('customer_address') ?></label-->
                            <div class="col-sm-6" hidden>
                                <textarea class="form-control" name="address" id="address " rows="3" placeholder="<?php echo display('customer_address') ?>" tabindex='4'>{customer_address} </textarea>
                             <input type="hidden" value="{customer_id}" name="customer_id">
                            </div>
							 <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="twitter" id="twitter" value="{twitter}" type="text" placeholder="<?php echo display('twitter') ?>" tabindex='3'>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <!--label for="mobile" class="col-sm-3 col-form-label"><--?php echo display('customer_mobile') ?></label-->
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="website" id="website" value="{website}" type="text" placeholder="<?php echo display('website') ?>" tabindex='3'>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control" name ="facebook" id="facebook" value="{facebook}" placeholder="<?php echo display('facebook') ?>" tabindex='3'>
                            </div>
                        </div>
						                        <div class="form-group row">
                            <!--label for="address " class="col-sm-3 col-form-label"><--?php echo display('customer_address') ?></label-->
                            <div class="col-sm-6">
								<label for="address " class="col-sm-6 col-form-label"><?php echo display('billing_address') ?></label>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('attention') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<input class="form-control" name ="attention_billing" value="{attention_billing}" id="attention_billing" type="text" placeholder="<?php echo display('attention') ?>" tabindex='3'>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('country') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
									<?php $countries=$this->db->get('countries')->result_array();
										//print_r($countries);								
										?>
                                       <select class="customerSelection form-control margon_btm" id="country_billing" name="country_billing" onchange="get_states(this,'state_billing')">
                                           <option value="0">-- Select Country--</option>
                                           <?php if($countries){ foreach($countries as $c){?>  
                                           <option value="<?php echo $c['id'];?>" <?php if($country_billing==$c['id']){echo "selected";}?>><?php echo $c['name'];?></option>
                                           <?php } } ?>
                                       </select>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('state') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
                                       <select class="customerSelection form-control margon_btm" id="state_billing" name="state_billing" onchange="get_cities(this,'city_billing')">
                                           <option value="0">-- Select State--</option>
                                           <?php if($billing_states){ foreach($billing_states as $c){?>  
                                           <option value="<?php echo $c['id'];?>" <?php if($state_billing==$c['id']){echo "selected";}?>><?php echo $c['name'];?></option>
                                           <?php } } ?>
                                       </select>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('city') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
                                       <select class="customerSelection form-control margon_btm" id="city_billing" name="city_billing" >
                                           <option value="0">-- Select City--</option>
                                           <?php if($billing_cities){ foreach($billing_cities as $c){?>  
                                           <option value="<?php echo $c['id'];?>" <?php if($city_billing==$c['id']){echo "selected";}?>><?php echo $c['name'];?></option>
                                           <?php } } ?>
                                       </select>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('billing_address') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<textarea class="form-control" name="bill" id="bill" rows="3" placeholder="<?php echo display('billing_address') ?>" >{bill}</textarea>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('zip_code') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<input class="form-control" name ="billing_zip_code" value="{billing_zip_code}" id="billing_zip_code" type="text" placeholder="<?php echo display('zip_code') ?>" tabindex='3'>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('fax') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<input class="form-control" name ="billing_fax" id="billing_fax" value="{billing_fax}" type="text" placeholder="<?php echo display('fax') ?>" tabindex='3'>
									</div>
									</div>
								</div>
                            </div>
                           <div class="col-sm-6">
								<label for="address " class="col-sm-6 col-form-label"><?php echo display('delivery_address') ?></label>
                                <div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('attention') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<input class="form-control" name ="attention_shipping" value ="{attention_shipping}" id="attention_shipping" type="text" placeholder="<?php echo display('attention') ?>" >
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('country') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
									<?php $countries=$this->db->get('countries')->result_array();
										//print_r($countries);								
										?>
                                       <select class="customerSelection form-control margon_btm" id="country_shipping" name="country_shipping" onchange="get_states(this,'state_shipping')">
                                           <option value="0">-- Select Country--</option>
                                           <?php if($countries){ foreach($countries as $c){?>  
                                           <option value="<?php echo $c['id'];?>" <?php if($country_shipping==$c['id']){echo "selected";}?>><?php echo $c['name'];?></option>
                                           <?php } } ?>
                                       </select>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('state') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
                                       <select class="customerSelection form-control margon_btm" id="state_shipping" name="state_shipping" onchange="get_cities(this,'city_shipping')">
                                           <option value="0">-- Select State--</option>
                                           <?php if($shipping_states){ foreach($shipping_states as $c){?>  
                                           <option value="<?php echo $c['id'];?>" <?php if($state_shipping==$c['id']){echo "selected";}?>><?php echo $c['name'];?></option>
                                           <?php } } ?>
                                       </select>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('city') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
                                       <select class="customerSelection form-control margon_btm" id="city_shipping" name="city_shipping" >
                                           <option value="0">-- Select City--</option>
                                           <?php if($shipping_cities){ foreach($shipping_cities as $c){?>  
                                           <option value="<?php echo $c['id'];?>" <?php if($city_shipping==$c['id']){echo "selected";}?>><?php echo $c['name'];?></option>
                                           <?php } } ?>
                                       </select>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('delivery_address') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<textarea class="form-control" name="delivery" id="delivery " rows="3" placeholder="<?php echo display('delivery_address') ?>" >{delivery}</textarea>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('zip_code') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<input class="form-control" name ="shipping_zip_code" id="shipping_zip_code" value="{shipping_zip_code}" type="text" placeholder="<?php echo display('zip_code') ?>" tabindex='3'>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('fax') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<input class="form-control" name ="shipping_fax" id="shipping_fax" value="{shipping_fax}" type="text" placeholder="<?php echo display('fax') ?>" tabindex='3'>
									</div>
									</div>
								</div>
                            </div>
                        </div>

                       <div class="form-group row">
                            <!--label for="example-text-input" class="col-sm-4 col-form-label"></label-->
                            <div class="col-sm-6">
                                <input type="submit" id="add-Customer" class="btn btn-success btn-large" name="add-Customer" value="<?php echo display('save_changes') ?>"  tabindex='5'/>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Edit customer end -->
<script>
function get_states(obj,select_list)
{
	var country_id=$(obj).val();
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('Ccustomer/get_states'); ?>",
		data: {'country_id':country_id},
		success: function (response) {
		//	alert(response);
			 $('#'+select_list).children().remove().end().append(response) ;
		}
	});
}
function get_cities(obj,select_list)
{
	var state_id=$(obj).val();
	//alert(state_id);
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('Ccustomer/get_cities'); ?>",
		data: {'state_id':state_id},
		success: function (response) {
		//	alert(response);
			 $('#'+select_list).children().remove().end().append(response) ;
		}
	});
}
</script>

