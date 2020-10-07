<!-- Add new customer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('update_setting') ?></h1>
            <small><?php echo display('update_your_web_setting') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('web_settings') ?></a></li>
                <li class="active"><?php echo display('update_setting') ?></li>
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
                            <h4><?php echo display('update_setting') ?> </h4>
                        </div>
                    </div>
                  <?php echo form_open_multipart('Cweb_setting/update_setting', array('class' => 'form-vertical','id' => 'insert_setting'))?>
                    <div class="panel-body">

                        <div class="form-group row">
                            <label for="logo" class="col-sm-3 col-form-label"><?php echo display('logo') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="logo" id="logo" type="file">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="logo" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-6">
                                 <img src="{logo}" class="img img-responsive" height="100" width="100">
                                <input name ="old_logo" type="hidden" value="{logo}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="invoice_logo" class="col-sm-3 col-form-label"><?php echo display('invoice_logo') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="invoice_logo" id="invoice_logo" type="file">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="invoice_logo" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-6">
                                 <img src="{invoice_logo}" class="img img-responsive" height="100" width="100">
                                <input name ="old_invoice_logo" type="hidden" value="{invoice_logo}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="favicon" class="col-sm-3 col-form-label"><?php echo "";/* display('favicon') */ ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="favicon" id="favicon" type="file" >
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="favicon" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-6">
                                <img src="" class="img img-responsive" height="100" width="100">
                                <input name ="old_favicon" type="hidden" value="{favicon}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="currency" class="col-sm-3 col-form-label"><?php echo display('currency') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="currency" id="currency">
                                    <option value=""><?php echo display('select_one') ?></option>
                                    <option value="$" <?php if ($currency == '$') { echo "selected";}?>>$ USD</option>
                                    <option value="AU$" <?php if ($currency == 'AU$') { echo "selected";}?>>$ AUD</option>
                                    <option value="ƒ" <?php if ($currency == 'ƒ') { echo "selected";}?>>ƒ AWD</option>
                                    <option value="R$" <?php if ($currency == 'R$') { echo "selected";}?>>R$ BRL</option>
                                    <option value="¥" <?php if ($currency == '¥') { echo "selected";}?>>¥ CNY</option>
                                    <option value="₡" <?php if ($currency == '₡') { echo "selected";}?>>₡ CRC</option>
                                    <option value="kn" <?php if ($currency == 'kn') { echo "selected";}?>>kn HRK</option>
                                    <option value="£" <?php if ($currency == '£') { echo "selected";}?>>£ EGP</option>
                                    <option value="€" <?php if ($currency == '€') { echo "selected";}?>>€ EUR</option>
                                    <option value="Rs" <?php if ($currency == 'Rs') { echo "selected";}?>>Rs INR</option>
                                    <option value="R" <?php if ($currency == 'R') { echo "selected";}?>>R ZAR</option>
                                    <option value="₩" <?php if ($currency == '₩') { echo "selected";}?>>₩ KRW</option>
                                    <option value="৳" <?php if ($currency == '৳') { echo "selected";}?>>৳ BDT</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="currency_position" class="col-sm-3 col-form-label"><?php echo display('currency_position') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="currency_position" id="currency_position">
                                    <option value=""><?php echo display('select_one') ?></option>
                                    <option value="0" <?php if ($currency_position == 0) { echo "selected";}?>><?php echo display('left') ?></option>
                                    <option value="1" <?php if ($currency_position == 1) {echo "selected";}?>><?php echo display('right') ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="footer_text" class="col-sm-3 col-form-label"><?php echo display('footer_text') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="footer_text" id="footer_text" type="text" placeholder="Foter Text" value="{footer_text}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="language" class="col-sm-3 col-form-label"><?php echo display('language') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                               <?php 
                                echo form_dropdown('language', $language, '','class="form-control" id="language"');
                                ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lrt" class="col-sm-3 col-form-label"><?php echo display('ltr_or_rtr') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="rtr" id="lrt">
                                    <option value=""><?php echo display('select_one') ?></option>
                                    <option value="0" <?php if ($rtr == 0) {echo "selected";}?>><?php echo display('ltr') ?></option>
                                    <option value="1" <?php if ($rtr == 1) {echo "selected";}?>><?php echo display('rtr') ?></option>
                                </select>
                            </div>
                        </div>

                       <!-- <div class="form-group row">
                            <label for="captcha" class="col-sm-3 col-form-label"><?php echo display('captcha') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="captcha" id="captcha">
                                    <option value=""><?php echo display('select_one') ?></option>
                                    <option value="0" <?php if ($captcha == 0) {echo "selected";}?>><?php echo display('active') ?></option>
                                    <option value="1" <?php if ($captcha == 1) {echo "selected";}?>><?php echo display('inactive') ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="site_key" class="col-sm-3 col-form-label"><?php echo display('site_key') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="site_key" id="site_key" type="text" placeholder="<?php echo display('site_key') ?> " value="{site_key}">
                            </div>
                        </div>    
                        
                        <div class="form-group row">
                            <label for="secret_key" class="col-sm-3 col-form-label"><?php echo display('secret_key') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="secret_key" id="secret_key" type="text" placeholder="<?php echo display('secret_key') ?>" value="{secret_key}">
                            </div>
                        </div> -->
                        
                        
                        <div class="form-group row">
                            <label for="cin_no" class="col-sm-3 col-form-label"><?php echo display('CIN_Number') ?> <i class="text-danger"></i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="cin_no" id="cin_no" type="text" placeholder="<?php echo display('CIN_Number') ?>" value="{cin_no}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="invoice_terms" class="col-sm-3 col-form-label"><?php echo display('invoice_terms') ?> <i class="text-danger"></i></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name ="invoice_terms" id="invoice_terms" type="text" placeholder="<?php echo display('terms_conditions') ?>">{invoice_terms}</textarea>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="po_terms" class="col-sm-3 col-form-label"><?php echo display('PO_terms') ?> <i class="text-danger"></i></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name ="po_terms" id="po_terms" type="text" placeholder="<?php echo display('terms_conditions') ?>">{po_terms}</textarea>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="po_num_series" class="col-sm-3 col-form-label"><?php echo display('PO_series') ?> <i class="text-danger"></i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name="po_num_series" id="po_num_series" type="text" value="{po_num_series}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sales_odr_series" class="col-sm-3 col-form-label"><?php echo display('sales_odr_series') ?> <i class="text-danger"></i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name="sales_odr_series" id="sales_odr_series" type="text" value="{sales_odr_series}" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="thermal_print" class="col-sm-3 col-form-label"><?php echo display('print_thermal_invoice') ?></label>
                            <div class="col-sm-6">
                                <input type="checkbox" id="thermal_print" name="thermal_print" <?php if($thermal_print=="1"){echo "checked";}?>>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="custom_billing" class="col-sm-3 col-form-label"><?php echo display('offline_billing_software') ?></label>
                            <div class="col-sm-6">
                                <input type="checkbox" id="custom_billing" name="custom_billing" <?php if($custom_billing=="1"){echo "checked";}?>>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="usr_commission" class="col-sm-3 col-form-label"><?php echo display('activate_user_commission') ?></label>
                            <div class="col-sm-6">
                                <input type="checkbox" id="usr_commission" name="usr_commission" <?php if($usr_commission=="1"){echo "checked";}?>>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="print_kot" class="col-sm-3 col-form-label"><?php echo display('print_KOT') ?></label>
                            <div class="col-sm-6">
                                <input type="checkbox" id="print_kot" name="print_kot" <?php if($print_kot=="1"){echo "checked";}?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cust_price" class="col-sm-3 col-form-label"><?php echo display('price_according_customer') ?></label>
                            <div class="col-sm-6">
                                <input type="checkbox" id="cust_price" name="cust_price" <?php if($cust_price=="1"){echo "checked";}?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="supp_price" class="col-sm-3 col-form-label"><?php echo display('price_according_supp') ?></label>
                            <div class="col-sm-6">
                                <input type="checkbox" id="supp_price" name="supp_price" <?php if($supplier_price=="1"){echo "checked";}?>>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="customer_required" class="col-sm-3 col-form-label"><?php echo display('customer_required') ?></label>
                            <div class="col-sm-6">
                                <input type="checkbox" id="customer_required" name="customer_required" <?php if($customer_required=="1"){echo "checked";}?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="invoice_view" class="col-sm-3 col-form-label"><?php echo display('invoice_view') ?></label>
                            <div class="col-sm-6">
                                <input type="checkbox" id="invoice_view" name="invoice_view" <?php if($invoice_view=="1"){echo "checked";}?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
								<?php 
								if($this->session->userdata('user_type')!=1) 
								{
									if($edited)
									{
										if($edited!==0)
										{?>
											<input type="submit" id="add-customer" class="btn btn-success btn-large" name="add-customer" value="<?php echo display('save_changes') ?>" />
										<?php }
									}	
								}else{?>
										<input type="submit" id="add-customer" class="btn btn-success btn-large" name="add-customer" value="<?php echo display('save_changes') ?>" />
                            
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



