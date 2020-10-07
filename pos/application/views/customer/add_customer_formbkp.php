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
                  <?php echo form_open('Ccustomer/insert_customer', array('class' => 'form-vertical','id' => 'insert_customer'))?>
                    <div class="panel-body">

                    	<div class="form-group row">
                            <!--label for="customer_name" class="col-sm-3 col-form-label"><--?php echo display('customer_name') ?> <i class="text-danger">*</i></label-->
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="customer_name" id="customer_name" type="text" placeholder="<?php echo display('customer_name') ?>"  required=""  tabindex='1'>
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
   
                        <div class="form-group row" hidden>
                            <div class="col-sm-12">
                                <textarea class="form-control" name="address" id="address " rows="3" placeholder="<?php echo display('customer_address') ?>" tabindex='4'></textarea>
                            </div>
                          
                        </div>
                         <div class="form-group row">
                            <!--label for="address " class="col-sm-3 col-form-label"><--?php echo display('customer_address') ?></label-->
                            <div class="col-sm-12">
                                <textarea class="form-control" name="bill" id="bill " rows="3" placeholder="<?php echo display('billing_address') ?>" tabindex='4'></textarea>
                            </div>
                          
                        </div>
						<div class="form-group row">
                            <!--label for="address " class="col-sm-3 col-form-label"><--?php echo display('customer_address') ?></label-->
                            <div class="col-sm-12">
                                <textarea class="form-control" name="delivery" id="delivery " rows="3" placeholder="<?php echo display('delivery_address') ?>" tabindex='4'></textarea>
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


