<!-- Edit activity start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Edit Activity</h1>
            <small>Edit activity</small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#">Activity</a></li>
                <li class="active">Edit Activity</li>
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
                  <?php echo form_open('Cactivity/update_activity', array('class' => 'form-vertical','id' => 'update_activity'))?>
                    <div class="panel-body">

                    	<div class="form-group row">
                            <div class="col-sm-6 margon_btm">
                                <input type="hidden" value="<?php echo $act_id;?>" name="act_id">
                                       <select class="customerSelection form-control margon_btm" name="customer">
                                           <option value="0">-- Select Customer --</option>
                                           <?php if($customer){ foreach($customer as $c){?>  
                                           <option value="<?php echo $c['customer_id'];?>" <?php if($c['customer_id']==$customer_id): echo "selected";endif;?>><?php echo $c['customer_name']." (".$c['customer_mobile'].")";?></option>
                                           <?php } } ?>
                                       </select>
                            </div>
                        </div>
                    	<div class="form-group row">
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="service_name" id="service_name" type="text" placeholder="Service Name" required="" tabindex='1' value="<?php echo $service_name;?>">
                            </div>
                        </div>
   
                    	<div class="form-group row">
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="sales_prsn" id="sales_prsn" type="text" placeholder="Sales Person Name" tabindex='1' value="<?php echo $sales_prsn;?>">
                            </div>
                        </div>
   
                    	<div class="form-group row">
                              <div class="col-sm-6">
                                <input class="form-control" name ="amount" id="amount" type="number" placeholder="Amount" tabindex='2' value="<?php echo $amount;?>">
                            </div>
                        </div>

                    	<div class="form-group row">
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="remarks" id="remarks" type="text" placeholder="Remarks" tabindex='4' value="<?php echo $remarks;?>">
                            </div>
                        </div>
   
                        <div class="form-group row">
                            <!--label for="example-text-input" class="col-sm-4 col-form-label"></label-->
                            <div class="col-sm-6">
                                <input type="submit" id="edit-activity" class="btn btn-primary btn-large" name="edit-activity" value="<?php echo display('save') ?>"  tabindex='6'/>
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



