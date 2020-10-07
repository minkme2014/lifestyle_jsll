<!-- Edit activity start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('edit_tax') ?></h1>
            <small><?php echo display('edit_tax') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('tax') ?></a></li>
                <li class="active"><?php echo display('edit_tax') ?></li>
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
                  <?php echo form_open('Ctax/update_tax', array('class' => 'form-vertical','id' => 'update_tax'))?>
                    <div class="panel-body">

                    	<div class="form-group row">
                                <input type="hidden" value="<?php echo $tax_id;?>" name="tax_id">
						 <label for="tax" class="col-sm-2 col-form-label"><?php echo display('tax_name');?></label>
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="tax_name" id="tax_name" type="text" placeholder="<?php echo display('tax_name') ?>" value="<?php echo $tax_name; ?>" required="" tabindex='1'>
                                <input class="form-control" name ="old_name" id="tax_name" type="hidden" placeholder="<?php echo display('tax_name') ?>" value="<?php echo $tax_name; ?>" required="" tabindex='1'>
                            </div>
                        </div>
   
                    	<div class="form-group row">
						 <label for="tax_per" class="col-sm-2 col-form-label"><?php echo display('tax_per');?></label>
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="tax_per" id="tax_per" type="number" maxlength="100" value="<?php echo $tax_per; ?>" placeholder="<?php echo display('tax_per') ?>" tabindex='2'>
                            </div>
                        </div>
   
                        <div class="form-group row">
                            <!--label for="example-text-input" class="col-sm-4 col-form-label"></label-->
                            <div class="col-sm-6">
                                <input type="submit" id="edit-tax" class="btn btn-primary btn-large" name="edit-tax" value="<?php echo display('save') ?>"  tabindex='6'/>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Edit activity end -->



