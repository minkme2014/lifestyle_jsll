<!-- Add new supplier start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('add_supplier') ?></h1>
            <small><?php echo display('add_new_supplier') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('supplier') ?></a></li>
                <li class="active"><?php echo display('add_supplier') ?></li>
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

        <!-- New supplier -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <!--div class="panel-heading">
                        <div class="panel-title">
                            <h4><--?php echo display('add_supplier') ?> </h4>
                        </div>
                    </div-->
                    <?php echo form_open_multipart('Csupplier/insert_supplier', array('id' => 'insert_supplier')) ?>
                    <div class="panel-body">

                        <div class="form-group row">
                            <!--label for="supplier_name" class="col-sm-3 col-form-label"><--?php echo display('supplier_name') ?> <i class="text-danger">*</i></label-->
                            <div class="col-sm-6">
                                <input class="form-control" name ="supplier_name" id="supplier_name" type="text" placeholder="<?php echo display('supplier_name') ?>"  required="" tabindex="1">
                            </div>
                             <!--label for="mobile" class="col-sm-3 col-form-label"><--?php echo display('supplier_mobile') ?> <i class="text-danger">*</i></label-->
                            <div class="col-sm-6">
                                <input class="form-control" name="mobile" id="mobile" type="number" placeholder="<?php echo display('supplier_mobile') ?>" required="" min="0" tabindex="2">
                            </div>
                        </div>

                      
                        <div class="form-group row">
                            <!--label for="address " class="col-sm-3 col-form-label"><--?php echo display('supplier_address') ?></label-->
                            <div class="col-sm-6">
                                <textarea class="form-control" name="address" id="address " rows="3" placeholder="<?php echo display('supplier_address') ?>" tabindex="3"></textarea>
                            </div>
                                <!--label for="details" class="col-sm-3 col-form-label"><--?php echo display('supplier_details') ?></label-->
                            <div class="col-sm-6">
                                <textarea class="form-control" name="details" id="details" rows="3" placeholder="<?php echo display('supplier_details') ?>" tabindex="4"></textarea>
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <!--label for="address " class="col-sm-3 col-form-label"><--?php echo display('supplier_address') ?></label-->
                            <div class="col-sm-6">
                                <input class="form-control" name="tin_no" id="tin_no " rows="3" placeholder="<?php echo display('TIN/CST_number') ?>" tabindex="3" >
                            </div>
                                <!--label for="details" class="col-sm-3 col-form-label"><--?php echo display('supplier_details') ?></label-->
                            <div class="col-sm-6">
                                <input class="form-control" name="pan_no" id="pan_no" rows="3" placeholder="<?php echo display('PAN_number') ?>" tabindex="4" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <!--label for="address " class="col-sm-3 col-form-label"><--?php echo display('supplier_address') ?></label-->
                            <div class="col-sm-6">
                                <input class="form-control" name="cin_no" id="cin_no " rows="3" placeholder="<?php echo display('CIN_number') ?>" tabindex="3" >
                            </div>
                                <!--label for="details" class="col-sm-3 col-form-label"><--?php echo display('supplier_details') ?></label-->
                            <div class="col-sm-6">
                                <input class="form-control" name="gstin" id="gstin" rows="3" placeholder="<?php echo display('GSTIN') ?>" tabindex="4" >
                            </div>
                        </div>

                     
                        <div class="form-group row">
                            <!--label for="details" class="col-sm-3 col-form-label"><--?php echo display('previous_balance'); ?></label-->
                            <div class="col-sm-12">
                                <input class="form-control" name="previous_balance" placeholder="<?php echo display('previous_balance') ?>" tabindex="5" type="number">
                            </div>
                        </div>

                        <div class="form-group row">
                            <!--label for="example-text-input" class="col-sm-4 col-form-label"></label-->
                            <div class="col-sm-6 btn_display">
							
								<?php 
								if($this->session->userdata('user_type')!=1) 
								{
									if($created)
									{
										if($created!==0)
										{?>
											    <input type="submit" id="add-supplier" class="btn btn-primary btn-large" name="add-supplier" value="<?php echo display('save') ?>"  tabindex="6"/>
												<input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-supplier-another" class="btn btn-large btn-success" id="add-supplier-another" tabindex="7">
										
										<?php }
									}	
								}else{?>
										    <input type="submit" id="add-supplier" class="btn btn-primary btn-large" name="add-supplier" value="<?php echo display('save') ?>"  tabindex="6"/>
											<input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-supplier-another" class="btn btn-large btn-success" id="add-supplier-another" tabindex="7">
                            
								<?php }?>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Add new supplier end -->



