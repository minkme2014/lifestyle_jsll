<?php
    $CI =& get_instance();
    $CI->load->model('Web_settings');
    $Web_settings = $CI->Web_settings->retrieve_setting_editdata();
?>

<!-- Printable area start -->
<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
	// document.body.style.marginTop="-45px";
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
<!-- Printable area end -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Challan</h1>
            <small>Invoice Challan</small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('invoice') ?></a></li>
                <li class="active">Invoice Challan</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
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
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
	                <div id="printableArea">
	                    <div class="panel-body overflow_scroll">
	                        <div class="row">
	                        	
	                            <!--div class="col-sm-6" style="">
	                                 <img src="<--?php if (isset($Web_settings[0]['invoice_logo'])) {echo ""; /* $Web_settings[0]['invoice_logo'] */ }?>" class="" alt="" 
									 style="margin-bottom:20px">
	                                
									<strong><u>Company Details :</u></strong>
	                                <address style="margin-top:10px">
	                                    <strong>{company_name}</strong><br>
	                                    {address}<br>
	                                    <abbr><b><--?php echo display('mobile') ?>:</b></abbr> {mobile}<br>
	                                    <abbr><b><--?php echo display('email') ?>:</b></abbr> 
	                                    {email}<br>
	                                    <abbr><b><--?php echo display('website') ?>:</b></abbr> 
	                                    {website}
	                                </address>
	                            </div>
	                            {/company_info}
	                            
	                            <div class="col-sm-6 text-left" style="">
	                                
										<strong><u>Customer Details :</u></strong><br>
										
	                                  <address style="margin-top:10px">  
	                                    <strong>{customer_name} </strong><br>
	                                    <--?php if ($customer_address) { ?>
		                                {customer_address}
		                                <--?php } ?>
	                                    <br>
	                                    <--?php if ($customer_mobile) { ?>
	                                    <abbr><b><?php echo display('mobile') ?>:</b></abbr>
	                                    {customer_mobile}
	                                    <--?php }if ($customer_email) {
	                                    ?>
	                                    <br>
	                                    <abbr><b><--?php echo display('email') ?>:</b></abbr> 
	                                    {customer_email}
	                                   	<--?php }if ($gst_no) {
	                                    ?>
	                                    <br>
	                                    <abbr><b>GST Number:</b></abbr> 
	                                    {gst_no}
	                                   	<--?php }if ($state_code) {
	                                    ?>
	                                    <br>
	                                    <abbr><b>State Code:</b></abbr> 
	                                    {state_code}
	                                   	<--?php } ?>
	                                </address>
	                                <div class="m-b-15"><strong><--?php echo display('billing_date') ?>:</strong> {final_date}</div>
	                            </div-->
	                        </div> 

	                        <div class="table-responsive m-b-20">
	                          
	                                
	                                
	                                  <table style="margin: 0;"  border=1  class="table table-striped table-bordered">
	                               
                                            <tr>
                                               
                                            {company_info}
                                              <td style="width: 37%;" rowspan=3 >
                                                  <img src="<?php if (isset($Web_settings[0]['invoice_logo'])) {echo  $Web_settings[0]['invoice_logo'] ; }?>" class="" alt="" 
									 style="width: 60px; height: 60px;">
                                                  <!--<img src="https://retail.minkchatter.com/billing/assets/images/admin-logo.png" style="width: 60px; height: 60px;">-->
                                                  <br>
                                                <b> Company Details :</b>
                                                {company_name}
                                                {address}<br>
                                                <b>Mobile:</b>  {mobile}<br>
                                                <b>Email:</b> {email}<br>
                                                <b>Website:</b> {website}
                                              </td>
	                                        {/company_info}
                                              <td style="width: 33%;" rowspan=3 >
                                                <b>Customer Name: </b>
                                                {customer_name}<br>
                                                <?php if ($customer_email) {?>
                                                <b>Customer Email:</b> {customer_email}<br>
                                                 <?php } ?>
                                                <?php if ($customer_mobile) { ?>
                                                <b>Customer Mobile:</b> {customer_mobile}<br>
                                                <?php } ?>
                                                 <b>Customer Address:</b><?php if ($customer_address) { ?>
		                                {customer_address}
		                                <?php } ?><br>
                                              </td>
                                              <td>
                                                <b>Billing Date:</b> {final_date}
                                              </td>
                                            </tr>
                                            <tr>
                                               
                                              <td valign=middle>
                                            <b>Document No CSP/HK/SOP-</b>
                                              </td>
                                            </tr>
                                              <tr>
                                               
                                              <td valign=middle>
                                            <b>CIN No : </b><?php if (isset($Web_settings[0]['cin_no'])) {echo  $Web_settings[0]['cin_no'] ; }?>
                                              </td>
                                            </tr>
                                          </table>
                                            <table style="margin: 0;" class="table table-striped table-bordered">
	                                <thead>
	                                    <tr>
	                                        <th align="center">S No </th>
	                                        <th align="center">Title/Content</th>
                                            <th align="center">Unit</th>
	                                        <th align="center"><?php echo display('quantity') ?></th>
	                                    </tr>
	                                </thead>
	                                <tbody>
										{invoice_all_data}
										<tr>
	                                    	<td align="">{sl}</td>
	                                        <td align=""><div>{product_name} - ({product_model})</div></td>
	                                        <td align=""></td>
	                                        <td align="">{quantity}</td>
	                                    </tr>
	                                    {/invoice_all_data}
	                                </tbody>
	                                <tfoot>
	                                <!--	<td align="center" colspan="2" style="border: 0px"><b><?php echo display('grand_total')?>:</b></td>

	                                	<td align="center"  style="border: 0px"><b>{subTotal_cartoon}</b></td>

	                                	<td style="border: 0px"></td>

	                                	<td align="center"  style="border: 0px"><b>{subTotal_quantity}</b></td>

	                                	<td style="border: 0px"></td>
	                                	<td style="border: 0px"></td>
	                                	
	                                	<td align="center"  style="border: 0px"><b><?php echo (($position==0)?"$currency {subTotal_ammount}":"{subTotal_ammount} $currency") ?></b></td>-->
	                                </tfoot>
	                            </table>
	                            <table style="margin: 0;"  border=1  class="table table-striped table-bordered">
	                               
                                            <tr>
                                               
                                              <td style="width: 37%;"><b>APPROVED By :- </b><?php echo $this->session->userdata('user_name');?></td>
                                              <td style="width: 33%;" rowspan=3 ><b>STANDARD OPERATING PRODUCTS</b></td>
                                              <td> <b>RECEIVER NAME :-</b> </td>
                                            </tr>
                                            <tr>
                                                <td> <b>ISSUED By :-  </b><?php echo $this->session->userdata('user_name');?></td>
                                              <td valign=middle><b>RECEIPT NO :- </b> {invoice_id}</td>
                                             
                                            </tr>
                                             <tr>
                                                <td> <b>ISSUE Date :- </b><?php echo date("d/m/Y");?> </td>
                                              <td valign=middle>
                                            <b>RECEIVER DATE :-</b></td>
                                             
                                            </tr>
                                          </table>
	                        </div>
	                       <!-- <div class="row">
		                        
		                        	<div class="col-xs-8" style="display: inline-block;width: 66%">
		                                <p><?php echo display('invoice_description')?></p>
		                                <p><strong><?php echo display('thank_you_for_choosing_us')?></strong></p>
		                                
		                            </div>
		                            <div class="col-xs-4" style="display: inline-block;">
										<table class="table">
				                            <?php
			                                	if ($invoice_all_data[0]['total_discount'] != 0) {
			                                ?>
				                            	<tr>
				                            		<th style="border-top: 0; border-bottom: 0;"><?php echo display('total_discount') ?> : </th>
				                            		<td style="border-top: 0; border-bottom: 0;"><?php echo (($position==0)?"$currency {total_discount}":"{total_discount} $currency") ?> </td>
				                            	</tr>
				                            <?php } 
				                            	if ($invoice_all_data[0]['tax'] != 0) {
			                                ?>
				                            	<tr>
				                            		<th style="border-top: 0; border-bottom: 0;"><?php echo display('tax') ?> : </th>
				                            		<td style="border-top: 0; border-bottom: 0;"><?php echo (($position==0)?"$currency {tax}":"{tax} $currency") ?> </td>
				                            	</tr>
				                            <?php } ?>
				                            	<tr>
				                            		<th class="grand_total"><?php echo display('grand_total') ?> :</th>
				                            		<td class="grand_total"><?php echo (($position==0)?"$currency {total_amount}":"{total_amount} $currency") ?></td>
				                            	</tr>
				                            	<tr>
				                            		<th style="border-top: 0; border-bottom: 0;"><?php echo display('paid_ammount') ?> : </th>
				                            		<td style="border-top: 0; border-bottom: 0;"><?php echo (($position==0)?"$currency {paid_amount}":"{paid_amount} $currency") ?></td>
				                            	</tr>				 
				                            	<?php
				                            		if ($invoice_all_data[0]['due_amount'] != 0) {
				                            	?>
				                            	<tr>
				                            		<th><?php echo display('due') ?> : </th>
				                            		<td><?php echo (($position==0)?"$currency {due_amount}":"{due_amount} $currency") ?></td>
				                            	</tr>
				                            	<?php
				                            		}
				                            	?>
			                            </table>
		                   
		                                <div  style="float:left;width:90%;text-align:center;border-top:1px solid #e4e5e7;margin-top: 100px;font-weight: bold;">
												<?php echo display('authorised_by') ?>
										</div>
		                            
		                        </div>
	                        </div>-->
	                    </div>
	                </div>

                     <div class="panel-footer text-left">
                     	<a  class="btn btn-danger" href="<?php echo base_url('Cinvoice');?>"><?php echo display('cancel') ?></a>
						<button  class="btn btn-info" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></button>
						
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->



