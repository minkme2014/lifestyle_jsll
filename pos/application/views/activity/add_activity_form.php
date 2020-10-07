<!-- Add new customer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('add_activity') ?></h1>
            <small><?php echo display('add_new_activity') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('activity') ?></a></li>
                <li class="active"><?php echo display('add_activity') ?></li>
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
                  <?php echo form_open('Cactivity/insert_activity', array('class' => 'form-vertical','id' => 'insert_activity'))?>
                    <div class="panel-body">

                    	<div class="form-group row">
                            <div class="col-sm-6 margon_btm">
                                       <select class="customerSelection form-control margon_btm" name="customer">
                                           <option value="0">-- Select Customer --</option>
                                           <?php if($customer){ foreach($customer as $c){?>  
                                           <option value="<?php echo $c['customer_id'];?>"><?php echo $c['customer_name']." (".$c['customer_mobile'].")";?></option>
                                           <?php } } ?>
                                       </select>
                            </div>
                        </div>
                    	<div class="form-group row">
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="service_name" id="service_name" type="text" placeholder="<?php echo display('activity_name') ?>" required="" tabindex='1'>
                            </div>
                        </div>
   
                    	<div class="form-group row">
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="sales_prsn" id="sales_prsn" type="text" placeholder="<?php echo display('sales_person_name') ?>" tabindex='1'>
                            </div>
                        </div>
   
                    	<div class="form-group row">
                              <div class="col-sm-6">
                                <input class="form-control" name ="amount" id="amount" type="number" placeholder="<?php echo display('ammount') ?>" tabindex='2'>
                            </div>
                        </div>

                    	<div class="form-group row">
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="remarks" id="remarks" type="text" placeholder="<?php echo display('remarks') ?>" tabindex='4'>
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
											<input type="submit" id="add-activity" class="btn btn-primary btn-large" name="add-activity" value="<?php echo display('save') ?>"  tabindex='6'/>
											<input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-activity-another" class="btn btn-large btn-success" id="add-activity-another" tabindex='7'>
                            
										<?php }
									}	
								}else{?>
										<input type="submit" id="add-activity" class="btn btn-primary btn-large" name="add-activity" value="<?php echo display('save') ?>"  tabindex='6'/>
										<input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-activity-another" class="btn btn-large btn-success" id="add-activity-another" tabindex='7'>
                            
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



