<!-- Add new customer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('add_tax') ?></h1>
            <small><?php echo display('add_new_tax') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('tax') ?></a></li>
                <li class="active"><?php echo display('add_tax') ?></li>
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

        <!-- New activity -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                  <?php echo form_open('Ctax/insert_tax', array('class' => 'form-vertical','id' => 'insert_activity'))?>
                    <div class="panel-body">

                    	<div class="form-group row">
						 <label for="tax" class="col-sm-2 col-form-label"><?php echo display('tax_name');?></label>
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="tax_name" id="tax_name" type="text" placeholder="<?php echo display('tax_name') ?>" required="" tabindex='1'>
                            </div>
                        </div>
   
                    	<div class="form-group row">
						 <label for="tax_per" class="col-sm-2 col-form-label"><?php echo display('tax_per');?></label>
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="tax_per" id="tax_per" type="number" maxlength="100" placeholder="<?php echo display('tax_per') ?>" tabindex='2'>
                            </div>
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
											<input type="submit" id="add-tax" class="btn btn-primary btn-large" name="add-tax" value="<?php echo display('save') ?>"  tabindex='3'/>
											<input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-tax-another" class="btn btn-large btn-success" id="add-tax-another" tabindex='4'>
                            
										<?php }
									}	
								}else{?>
										<input type="submit" id="add-tax" class="btn btn-primary btn-large" name="add-tax" value="<?php echo display('save') ?>"  tabindex='3'/>
										<input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-tax-another" class="btn btn-large btn-success" id="add-tax-another" tabindex='4'>
                            
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
<!-- Add new activity end -->



