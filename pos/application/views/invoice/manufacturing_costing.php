<!-- Add new manufacturing_costing start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('manufacturing_costing') ?></h1>
            <small><?php echo display('manufacturing_costing') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('invoice') ?></a></li>
                <li class="active"><?php echo display('manufacturing_costing') ?></li>
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
                  <?php echo form_open('Cinvoice/insert_manufacturing_costing', array('class' => 'form-vertical','id' => 'insert_activity'))?>
                    <div class="panel-body">

                    	<div class="form-group row">
                            <div class="col-sm-2 margon_btm">
								<label><?php echo display('user') ?></label>
							
							</div>
                            <div class="col-sm-6 margon_btm">
                                       <select class="customerSelection form-control margon_btm" name="user">
                                           <option value="0">-- Select --</option>
                                           <?php if($user){ foreach($user as $u){?>  
                                           <option value="<?php echo $u['id'];?>"><?php echo $u['first_name']." ".$u['last_name'];?></option>
                                           <?php } } ?>
                                       </select>
                            </div>
                        </div>
                    	<div class="form-group row">
                            <div class="col-sm-2 margon_btm">
								<label><?php echo display('customer') ?></label>
							
							</div>
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
                            <div class="col-sm-2 margon_btm">
								<label><?php echo display('date') ?></label>
							</div>
                            <div class="col-sm-6 margon_btm">
							   <?php date_default_timezone_set("Asia/Dhaka"); $date = date('Y-m-d'); ?>
								<input class="datepicker form-control margon_btm" type="text" size="50" name="date" id="date" required value="<?php echo $date; ?>" />
							</div>
                    	</div>
						<div class="form-group row">
                            <div class="col-sm-2 margon_btm">
								<label><?php echo display('total_working_hr') ?></label>
							</div>
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="total_working_hr" id="total_working_hr" type="text" placeholder="<?php echo display('total_working_hr') ?>" >
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-sm-2 margon_btm">
								<label><?php echo display('sample_work') ?></label>
							</div>
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="sample_work" id="sample_work" type="text" placeholder="<?php echo display('sample_work') ?>" >
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-sm-2 margon_btm">
								<label><?php echo display('sample_hr') ?></label>
							</div>
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="sample_hr" id="sample_hr" type="text" placeholder="<?php echo display('sample_hr') ?>" >
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-sm-2 margon_btm">
								<label><?php echo display('rate_per_hour') ?></label>
							</div>
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="rate_per_hour" id="rate_per_hour" type="text" placeholder="<?php echo display('rate_per_hour') ?>" >
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-sm-2 margon_btm">
								<label><?php echo display('individual_price') ?></label>
							</div>
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="individual_price" id="individual_price" type="text" placeholder="<?php echo display('individual_price') ?>" >
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-sm-2 margon_btm">
								<label><?php echo display('odr_work') ?></label>
							</div>
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="odr_work" id="odr_work" type="text" placeholder="<?php echo display('odr_work') ?>" >
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-sm-2 margon_btm">
								<label><?php echo display('odr_hr') ?></label>
							</div>
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="odr_hr" id="odr_hr" type="text" placeholder="<?php echo display('odr_hr') ?>" >
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-sm-2 margon_btm">
								<label><?php echo display('rate_per_hr') ?></label>
							</div>
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="rate_per_hr" id="rate_per_hr" type="text" placeholder="<?php echo display('rate_per_hr') ?>" >
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-sm-2 margon_btm">
								<label><?php echo display('total_hr_worked') ?></label>
							</div>
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="total_hr_worked" id="total_hr_worked" type="text" placeholder="<?php echo display('total_hr_worked') ?>" >
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-sm-2 margon_btm">
								<label><?php echo display('total_price_per_day') ?></label>
							</div>
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="total_price_per_day" id="total_price_per_day" type="text" placeholder="<?php echo display('total_price_per_day') ?>" >
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-sm-2 margon_btm">
								<label><?php echo display('work_from_home') ?></label>
							</div>
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="work_from_home" id="work_from_home" type="text" placeholder="<?php echo display('work_from_home') ?>" >
                            </div>
                        </div>
						<div class="form-group row">
                            <div class="col-sm-2 margon_btm">
								<label><?php echo display('price_paid') ?></label>
							</div>
                            <div class="col-sm-6 margon_btm">
                                <input class="form-control" name ="price_paid" id="price_paid" type="text" placeholder="<?php echo display('price_paid') ?>" >
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
										 <input type="submit" id="add" class="btn btn-primary btn-large" name="add" value="<?php echo display('save') ?>" />
									<?php }
								}	
							}else{?>
									 <input type="submit" id="add" class="btn btn-primary btn-large" name="add" value="<?php echo display('save') ?>" />
									
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
<!-- Add new manufacturing_costing end -->



