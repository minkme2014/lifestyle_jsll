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
                            <!--label for="customer_name" class="col-sm-3 col-form-label"><--?php echo display('customer_name') ?> <i class="text-danger">*</i></label-->
                            <div class="col-sm-6">
                                <input class="form-control margon_btm" name ="customer_name" id="customer_name" type="text" placeholder="<?php echo display('customer_name') ?>"  required="" value="{customer_name}" tabindex='1'>
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
                        </div>
                        
                  <div class="form-group row">
                            <!--label for="state_code" class="col-sm-3 col-form-label">State Code </label-->
                            <div class="col-sm-6">
                                <textarea class="form-control" name="bill" id="bill " rows="3" placeholder="<?php echo display('billing_address') ?>" tabindex='5'>{bill}</textarea>
                            </div>
                               <!--label for="address " class="col-sm-3 col-form-label"><--?php echo display('customer_address') ?></label-->
                            <div class="col-sm-6">
                                <textarea class="form-control" name="delivery" id="delivery " rows="3" placeholder="<?php echo display('delivery_address') ?>"tabindex='6'>{delivery}</textarea>
                             
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

