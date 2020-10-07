<!-- Add User start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('add_user') ?></h1>
            <small><?php echo display('add_new_user_information') ?></small>
            <ol class="breadcrumb">
                <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('web_settings') ?></a></li>
                <li class="active"><?php echo display('add_user') ?></li>
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

        <!-- New user -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('add_user') ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('User/insert_user', array('class' => 'form-vertical',)) ?>
                    <div class="panel-body">

                        <div class="form-group row">
                            <label for="first_name" class="col-sm-3  col-md-3 col-form-label"><?php echo display('first_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-9 col-md-6">
                                <input type="text" tabindex="1" class="form-control" name="first_name" id="first_name" placeholder="<?php echo display('first_name') ?>" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-sm-3  col-md-3 col-form-label"><?php echo display('last_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-9 col-md-6">
                                <input type="text" tabindex="2" class="form-control" name="last_name" id="last_name" placeholder="<?php echo display('last_name') ?>" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-3  col-md-3 col-form-label"><?php echo display('email') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-9 col-md-6">
                                <input type="email" tabindex="3" class="form-control" name="email" id="email" placeholder="<?php echo display('email') ?>"  />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-3  col-md-3 col-form-label"><?php echo display('password') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-9 col-md-6">
                                <input type="password" tabindex="4" class="form-control" id="password" name="password" placeholder="<?php echo display('password') ?>" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_type" class="col-sm-3  col-md-3 col-form-label"><?php echo display('user_type') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-9 col-md-6">
                                <select class="form-control" name="user_type" id="user_type" tabindex="5">
                                    <option value="0"><?php echo display('select_one') ?></option>
									<?php foreach($role as $r){
										?>
										<option value="<?php echo $r['role_id'];?>"><?php echo $r['role_name']; ?></option>
										<?php
									} ?>
                                    <!--option value="1"><?php echo display('admin') ?></option>
                                    <option value="2"><?php echo display('user') ?></option-->
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="commission" class="col-sm-3  col-md-3 col-form-label"><?php echo display('commission') ?> % </label>
                            <div class="col-sm-9 col-md-6">
                                <input type="number" tabindex="5" class="form-control" id="commission" name="commission" placeholder="Commission %"  min="0" max="100" value="0"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
								<?php 
								if($this->session->userdata('user_type')!=1) 
								{
									if($created)
									{
										if($created!==0)
										{?>
											<input type="submit" id="add-customer" class="btn btn-primary btn-large" name="add-user" value="<?php echo display('save') ?>"  tabindex="6"/>

											<input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-user-another" class="btn btn-success" id="add-customer-another" tabindex="7">
									<?php }
									}	
								}else{?>
										<input type="submit" id="add-customer" class="btn btn-primary btn-large" name="add-user" value="<?php echo display('save') ?>"  tabindex="6"/>

										<input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-user-another" class="btn btn-success" id="add-customer-another" tabindex="7">
                            
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
<!-- Edit user end -->



