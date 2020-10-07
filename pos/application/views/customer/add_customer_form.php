<!-- Add new customer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('add_customer') ?></h1>
            <small><?php echo display('add_new_customer') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('customer') ?></a></li>
                <li class="active"><?php echo display('add_customer') ?></li>
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

        <!-- New customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <!--div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('add_customer') ?> </h4>
                        </div>
                    </div-->
                  <?php echo form_open('Ccustomer/insertCustomer', array('class' => 'form-vertical','id' => 'insert_customer'))?>
                    <div class="panel-body">

                    	<div class="form-group row">
                            <div class="col-sm-2 margon_btm">
                             <label><?php echo display('salutation') ?></label>
							</div>
                            <div class="col-sm-4 margon_btm">
                             <select class="form-control" id="salutation" name="salutation"  tabindex='1' required>
								<option value="0">-- <?php echo display('salutation') ?> --</option>
									<option value="Mr.">Mr.</option>
									<option value="Mrs.">Mrs.</option>
									<option value="Ms.">Ms.</option>
									<option value="Miss.">Miss.</option>
									<option value="Dr.">Dr.</option>
								</select>
							</div>
                             <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="customer_name" id="customer_name" type="text" placeholder="<?php echo display('customer_name') ?>"  required=""  tabindex='2'>
                            </div>
                        </div>
                    	<div class="form-group row">
                            <!--label for="customer_name" class="col-sm-3 col-form-label"><--?php echo display('customer_name') ?> <i class="text-danger">*</i></label-->
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="company" id="company" type="text" placeholder="<?php echo display('company') ?>" tabindex='2'>
                            </div>
                              <div class="col-sm-6">
                                <input class="form-control" name ="email" id="email" type="email" placeholder="<?php echo display('customer_email') ?>" tabindex='2'>
                            </div>
                        </div>
   
                       	<!--div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label"><--?php echo display('customer_email') ?></label>
                          
                        </div-->

                        <div class="form-group row">
                            <!--label for="mobile" class="col-sm-3 col-form-label"><--?php echo display('customer_mobile') ?></label-->
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="mobile" id="mobile" type="number" placeholder="<?php echo display('customer_mobile') ?>" min="0" tabindex='3' required="">
                            </div>
                              <div class="col-sm-6">
                                <input class="form-control" name ="gst_no" id="gst_no" placeholder="<?php echo display('GST_number') ?>" tabindex='3'>
                            </div>
                        </div>
						
                        <!--div class="form-group row">
                            <label for="gst_no" class="col-sm-3 col-form-label">GST Number </label>
                          
                        </div-->
						
                        <div class="form-group row">
                            <!--label for="state_code" class="col-sm-3 col-form-label">State Code </label-->
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="state_code" id="state_code" placeholder="<?php echo display('state_code') ?>" tabindex='3'>
                            </div>
                                <!--label for="previous_balance" class="col-sm-3 col-form-label"><--?php echo display('previous_balance') ?></label-->
                            <div class="col-sm-6">
                                <input class="form-control" name="previous_balance" id="previous_balance" type="number" placeholder="<?php echo display('previous_balance') ?>" tabindex='5'>
                            </div>
                        </div>
   
                        <div class="form-group row">
                            <!--label for="mobile" class="col-sm-3 col-form-label"><--?php echo display('customer_mobile') ?></label-->
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="website" id="website" type="text" placeholder="<?php echo display('website') ?>" tabindex='3'>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control" name ="facebook" id="facebook" placeholder="<?php echo display('facebook') ?>" tabindex='3'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <!--label for="mobile" class="col-sm-3 col-form-label"><--?php echo display('customer_mobile') ?></label-->
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="twitter" id="twitter" type="text" placeholder="<?php echo display('twitter') ?>" tabindex='3'>
                            </div>
                        </div>
                        <div class="form-group row" hidden>
                            <div class="col-sm-12">
                                <textarea class="form-control" name="address" id="address " rows="3" placeholder="<?php echo display('customer_address') ?>" tabindex='4'></textarea>
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
										<input class="form-control" name ="attention_billing" id="attention_billing" type="text" placeholder="<?php echo display('attention') ?>" tabindex='3'>
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
                                           <option value="<?php echo $c['id'];?>"><?php echo $c['name'];?></option>
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
                                       <select class="customerSelection form-control margon_btm" name="state_billing" id="state_billing" onchange="get_cities(this,'city_billing')">
                                           <option value="0">-- Select State--</option>
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
                                       <select class="customerSelection form-control margon_btm" name="city_billing" id="city_billing">
                                           <option value="0">-- Select City--</option>
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
										<textarea class="form-control" name="bill" id="bill " rows="3" placeholder="<?php echo display('billing_address') ?>" ></textarea>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('zip_code') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<input class="form-control" name ="billing_zip_code" id="billing_zip_code" type="text" placeholder="<?php echo display('zip_code') ?>" tabindex='3'>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('fax') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<input class="form-control" name ="billing_fax" id="billing_fax" type="text" placeholder="<?php echo display('fax') ?>" tabindex='3'>
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
										<input class="form-control" name ="attention_shipping" id="attention_shipping" type="text" placeholder="<?php echo display('attention') ?>" >
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
                                           <option value="<?php echo $c['id'];?>"><?php echo $c['name'];?></option>
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
                                       <select class="customerSelection form-control margon_btm" name="state_shipping" id="state_shipping" onchange="get_cities(this,'city_shipping')">
                                           <option value="0">-- Select State--</option>
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
                                       <select class="customerSelection form-control margon_btm" name="city_shipping" id="city_shipping">
                                           <option value="0">-- Select City--</option>
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
										<textarea class="form-control" name="delivery" id="delivery " rows="3" placeholder="<?php echo display('delivery_address') ?>" ></textarea>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('zip_code') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<input class="form-control" name ="shipping_zip_code" id="shipping_zip_code" type="text" placeholder="<?php echo display('zip_code') ?>" tabindex='3'>
									</div>
									</div>
								</div>
								<div class="col-sm-12 margon_btm">
									<div class="form-group row">
									<div class="col-sm-2 margon_btm">
										<label><?php echo display('fax') ?></label>
									</div>
									<div class="col-sm-10 margon_btm">
										<input class="form-control" name ="shipping_fax" id="shipping_fax" type="text" placeholder="<?php echo display('fax') ?>" tabindex='3'>
									</div>
									</div>
								</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <!--label for="example-text-input" class="col-sm-4 col-form-label"></label-->
                            <div class="col-sm-6">
								<?php 
								if($this->session->userdata('user_type')!=1) 
								{
									if($created)
									{
										if($created!==0)
										{?>
											<input type="submit" id="add-customer" class="btn btn-primary btn-large" name="add-customer" value="<?php echo display('save') ?>"  tabindex='6'/>
											<input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-customer-another" class="btn btn-large btn-success" id="add-customer-another" tabindex='7'>
                            
										<?php }
									}	
								}else{?>
										    <input type="submit" id="add-customer" class="btn btn-primary btn-large" name="add-customer" value="<?php echo display('save') ?>"  tabindex='6'/>
											<input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-customer-another" class="btn btn-large btn-success" id="add-customer-another" tabindex='7'>
                            
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
<!-- Add new customer end -->
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


