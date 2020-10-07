<?php
    $CI =& get_instance();
    $CI->load->model('Web_settings');
    $Web_settings = $CI->Web_settings->retrieve_setting_editdata();
?>

<!-- Printable area start -->
<script type="text/javascript">
function printDiv(divName) {
    default_print=false;
    $(".modal-backdrop").remove();
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
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
            <h1><?php echo display('sale_odr_details') ?></h1>
            <small><?php echo display('sale_odr_details') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('sales_order') ?></a></li>
                <li class="active"><?php echo display('sale_odr_details') ?></li>
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
	                <div id="printableArea" style="margin: 20px auto;width: 80%;font-size: 11px;font-weight: 600;font-family: 'Roboto', sans-serif;">
	                    <div class="panel-body">
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
	                                 <img src="<?php if (isset($Web_settings[0]['invoice_logo'])) {echo $Web_settings[0]['invoice_logo']; }?>" class="" alt="" 
									 style="margin-bottom:20px;width: 60px; height: 60px;">
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
	                                <h3 class="text-right"><?php echo display('invoice');?></h3>
	                                <div class="text-right"><b><?php echo display('invoice_no') ?>: #{odr_no}</b></div>
									<div class="text-right"><b><?php echo display('total_amount') ?> : <?php echo (($position==0)?"$currency : {total_amount}":"{total_amount} : $currency") ?></b></div>
									
								</div>
							</div>
	                        <div class="row">
	                        	{company_info}
	                            <div class="col-xs-6 col-sm-6 col-md-6" style="">
	                                <address style="margin-top:10px">
	                                    <strong>{company_name}</strong><br>
	                                    {address}<br>
	                                    <abbr><b><?php echo display('mobile') ?>:</b></abbr> {mobile}<br>
	                                    <abbr><b><?php echo display('email') ?>:</b></abbr> 
	                                    {email}<br>
	                                    <abbr><b><?php echo display('website') ?>:</b></abbr> 
	                                    {website}
	                                </address>
	                            </div>
	                            {/company_info}
							</div>
							<div class="row">
	                            <div class="col-xs-6 col-sm-6 col-md-6" style="">
	                                
	                                <span class="label label-success-outline m-r-15 p-10"><?php echo display('billing_to') ?></span>
										
	                                  <address style="margin-top:10px">  
	                                    <strong>{customer_name} </strong><br>
	                                    <?php if ($bill) { ?>
		                                <!--strong>Billing Address : </strong>{bill}
		                                <?php } ?>
	                                    <br-->
	                                    <?php if ($delivery) { ?>
		                                <strong><?php echo display('place_of_supply') ?> : </strong>{delivery}
		                                <?php } ?>
	                                    <br>
	                                    <?php if ($customer_mobile) { ?>
	                                    <abbr><b><?php echo display('mobile') ?>:</b></abbr>
	                                    {customer_mobile}
	                                    <?php }if ($customer_email) {
	                                    ?>
	                                    <br>
	                                    <abbr><b><?php echo display('email') ?>:</b></abbr> 
	                                    {customer_email}
	                                   	<?php }if ($gst_no) {
	                                    ?>
	                                    <br>
	                                    <abbr><b><?php echo display('GST_number') ?>:</b></abbr> 
	                                    {gst_no}
	                                   	<?php }if ($state_code) {
	                                    ?>
	                                    <br>
	                                    <abbr><b><?php echo display('state_code') ?>:</b></abbr> 
	                                    {state_code}
	                                   	<?php } ?>
	                                </address>
	                            </div>
	                            <div class="col-xs-6 col-sm-6 col-md-6" style="">
	                                <div class="m-b-15 text-right"><?php echo display('billing_date') ?>: {final_date}</div>

	                            </div>
	                        </div> 

	                        <div class="table-responsive ">
	                            <table class="table table-striped table-bordered"  style="margin-bottom: 3px;">
	                                <thead>
	                                    <tr>
	                                        <th align="center"><?php echo display('sl') ?></th>
	                                        <th align="center"><?php echo display('product_name') ?></th>
	                                        <th align="center"><?php echo display('total_quantity') ?></th>
	                                        <th align="center"><?php echo display('Disc./Pcs.');?> </th>
	                                        <th align="center"><?php echo display('rate') ?></th>
	                                        <th align="center"><?php echo display('ammount') ?></th>
	                                    </tr>
	                                </thead>
	                                <tbody>
										{odr_all_data}
										<tr>
	                                    	<td align="">{sl}</td>
	                                        <td align=""><div><strong>{product_name} - ({product_model})</strong></div></td>
	                                        <td align="center">{quantity}</td>
	                                        <td align="center"><?php echo (($position==0)?"$currency {discount}":"{discount} $currency") ?></td>
	                                        <td align="center"><?php echo (($position==0)?"$currency {rate}":"{rate} $currency") ?></td>
	                                        <td align="center"><?php echo (($position==0)?"$currency {total_price}":"{total_price} $currency") ?></td>
	                                    </tr>
	                                    {/odr_all_data}
	                                </tbody>
	                                <tfoot>
	                                	<td align="center" colspan="2" style="border: 0px"><b><?php echo display('grand_total')?>:</b></td>


	                                	<td align="center"  style="border: 0px"><b>{subTotal_quantity}</b></td>

	                                	<td style="border: 0px"></td>
	                                	<td style="border: 0px"></td>
	                                	
	                                	<td align="center"  style="border: 0px"><b><?php echo (($position==0)?"$currency {subTotal_ammount}":"{subTotal_ammount} $currency") ?></b></td>
	                                </tfoot>
	                            </table>
	                        </div>
	                        <div class="row">
		                        
		                        	<div class="col-xs-6 col-sm-6 col-md-6" style="display: inline-block;">
		                              
		                            </div>
		                        <div class="col-xs-6 col-sm-6 col-md-6" style="display: inline-block;">
                                     <table class="table" style="margin-bottom: 3px;">
				                            <?php
			                                	if ($total_discount != 0) {
			                                ?>
				                            	<tr>
				                            		<th style="border-top: 0; border-bottom: 0;"><?php echo display('total_discount') ?> : </th>
				                            		<td style="border-top: 0; border-bottom: 0;"><?php echo (($position==0)?"$currency {total_discount}":"{total_discount} $currency") ?> </td>
				                            	</tr>
				                            <?php } 
				                            	if ($tax != 0) {
			                                ?>
				                            	<tr>
				                            		<th style="border-top: 0; border-bottom: 0;"><?php echo display('tax') ?> : </th>
				                            		<td style="border-top: 0; border-bottom: 0;"><?php echo (($position==0)?"$currency {tax}":"{tax} $currency") ?> </td>
				                            	</tr>
				                            <?php } 	if ($invoice_all_data[0]['delivery_charges'] != 0) {
			                                ?>
				                            	<tr>
				                            		<th style="border-top: 0; border-bottom: 0;"><?php echo display('delivery_charges') ?> : </th>
				                            		<td style="border-top: 0; border-bottom: 0;"><?php echo (($position==0)?"$currency {delivery_charges}":"{delivery_charges} $currency") ?> </td>
				                            	</tr>
				                            <?php } 	if ($invoice_all_data[0]['freight_charges'] != 0) {
			                                ?>
				                            	<tr>
				                            		<th style="border-top: 0; border-bottom: 0;"><?php echo display('freight_charges') ?> : </th>
				                            		<td style="border-top: 0; border-bottom: 0;"><?php echo (($position==0)?"$currency {freight_charges}":"{freight_charges} $currency") ?> </td>
				                            	</tr>
				                            <?php } 	if ($invoice_all_data[0]['packaging'] != 0) {
			                                ?>
				                            	<tr>
				                            		<th style="border-top: 0; border-bottom: 0;"><?php echo display('packaging') ?> : </th>
				                            		<td style="border-top: 0; border-bottom: 0;"><?php echo (($position==0)?"$currency {packaging}":"{packaging} $currency") ?> </td>
				                            	</tr>
				                            <?php } ?>
				                            	<tr>
				                            		<th class="grand_total"><?php echo display('grand_total') ?> :</th>
				                            		<td class="grand_total"><?php echo (($position==0)?"$currency {total_amount}":"{total_amount} $currency") ?></td>
				                            	</tr>
												
											<?php if($Web_settings[0]['invoice_view']=="1") { ?>
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
				                            		}}
				                            	?>
												<tr><td colspan="2"><?php echo display('total_in_words')." : ". AmountInWords($total_amount);?></td></tr>
			                            </table>
		                            
		                        </div>
								
	                        </div>
							<div class="row">
							
							<?php if($Web_settings[0]['invoice_view']=="1") { ?>
								
								<div>
									<!--p><?php echo display('invoice_description')?></p-->
									<p><?php if (isset($Web_settings[0]['invoice_terms'])) { echo $Web_settings[0]['invoice_terms']; }?></p>
									<p><strong><?php echo display('thank_you_for_choosing_us')?></strong></p>
									
								</div>
								<?php } ?>
								<div  style="float:left;width:90%;border-top:1px solid #e4e5e7;margin-top: 5px;font-weight: bold;">
										<?php echo display('authorised_by') ?>
								</div>
							</div>
	                    </div>
	                </div>
	     
					
	 
					
                     <div class="panel-footer text-left">
                     	<a  class="btn btn-danger" href="<?php echo base_url('Cinvoice');?>"><?php echo display('cancel') ?></a>
                     
						    <button  class="btn btn-info" onclick="printDiv('printableArea')" ><span class="fa fa-print"></span></button>
                     	
						
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->

<?php

function AmountInWords(float $amount)
{
   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
   // Check if there is any number after decimal
   $amt_hundred = null;
   $count_length = strlen($num);
   $x = 0;
   $string = array();
   $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
     3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
     7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
     10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
     13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
     16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
     19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
     40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
     70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $x < $count_length ) {
      $get_divider = ($x == 2) ? 10 : 100;
      $amount = floor($num % $get_divider);
      $num = floor($num / $get_divider);
      $x += $get_divider == 10 ? 1 : 2;
      if ($amount) {
       $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
       $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
       $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
       '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
       '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
        }
   else $string[] = null;
   }
   $implode_to_Rupees = implode('', array_reverse($string));
   $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
   return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
}
?>

