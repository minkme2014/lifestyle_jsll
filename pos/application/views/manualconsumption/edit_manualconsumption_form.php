<!--Edit customer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('manualconsumption_edit') ?></h1>
            <small><?php echo display('manualconsumption_edit') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('manualconsumption') ?></a></li>
                <li class="active"><?php echo display('manualconsumption_edit') ?></li>
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
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('manualconsumption_edit') ?> </h4>
                        </div>
                    </div>
                  <?php echo form_open_multipart('Cmanualconsumption/manualconsumption_update',array('class' => 'form-vertical', 'id' => 'manualconsumption_update'))?>
                    <div class="panel-body">

                    	<div class="form-group row">
                            <label for="product_id" class="col-sm-3 col-form-label"><?php echo display('product') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name ="product_id" id="product_id"  required="" tabindex='1'>
								{all_product}
								<option value="{product_id}" selected>{product_name}</option>
								{/all_product}
								</select>
                            </div>
                        </div>
                    	<div class="form-group row">
                            <label for="qty" class="col-sm-3 col-form-label"><?php echo display('quantity') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="qty" id="qty" type="text" placeholder="<?php echo display('quantity') ?>"  required="" value="{qty}" tabindex='2'>
                            </div>
                        </div>
                       <div class="form-group row">
                            <label for="reason" class="col-sm-3 col-form-label"><?php echo display('reason') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="reason" id="reason" tabindex='3'>
								{all_manualconsumption_reason}
								<option value="{id}" selected>{reason}</option>
								{/all_manualconsumption_reason}
								</select>
                            </div>
                        </div>
                       <div class="form-group row" hidden>
                            <label for="manualconsumption_id" class="col-sm-3 col-form-label"><?php echo display('reason') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <div class="col-sm-6">
                                <input class="form-control" name ="manualconsumption_id" id="manualconsumption_id" type="text" placeholder="<?php echo display('quantity') ?>"  required="" value="{manualconsumption_id}" tabindex='2'>
                            </div>
                            </div>
                        </div>

                        <input type="hidden" value="{category_id}" name="category_id">

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-Customer" class="btn btn-success btn-large" name="add-Customer" value="<?php echo display('save_changes') ?>" />
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
$(document).ready(function() {
 
});
</script>