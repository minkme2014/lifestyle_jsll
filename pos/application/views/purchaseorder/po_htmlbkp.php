<?php
    $CI =& get_instance();
    $CI->load->model('Web_settings');
    $Web_settings = $CI->Web_settings->retrieve_setting_editdata();
?>

<!-- Printable area start -->
<script src="https://kendo.cdn.telerik.com/2017.2.621/js/jquery.min.js"></script> 
<script src="https://kendo.cdn.telerik.com/2017.2.621/js/jszip.min.js"></script>
<script src="https://kendo.cdn.telerik.com/2017.2.621/js/kendo.all.min.js"></script>
<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
	// document.body.style.marginTop="-45px";
    window.print();
    document.body.innerHTML = originalContents;
}
function downlad_report_pdf(report)
{
    //show_foodiee_alert('called');
    //function() {

    kendo.drawing.drawDOM("#" + report,
            {
                paperSize: "A4",
                margin: {top: "1cm", bottom: "1cm"},
                scale: 0.5,
                height: 500

            }).then(function (group) {

        kendo.drawing.pdf.saveAs(group, report);



    });

}
</script>
   <style>
		.table_order th 
		{
			text-align: center;
			font-size: 20px;
		}
h4.headinh_h {
    text-align: center;
    border: 1px solid #000;
    padding-top: 10px;
    margin: 0;
    padding-bottom: 9px;
}
tr.border_tr {
    border: 1px solid #000;
}
.table_order .border_tr td {
    padding: 0;
}
.border_left {
    border-right: 1px solid #000;
}
.purch {
    overflow: hidden;
}
.col-md-6.border_main {
   
    margin: 0;
    padding: 0;

}
.padding_null {
    padding: 0;
}
.margin_btm p {
    margin: 0;
}
.purch .border_main {
    border-bottom: 1px solid;
}
tr.bordermain {

}
.table_main{
width:100%;
}
table.table.table_main {
    margin-bottom: 0;
}
.margin_null{
 margin: 0;
}
th, td {
    font-size: 13px;
}
.watermark {
  background-image: linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.7)),url("<?php if (isset($Web_settings[0]['logo'])) {echo  $Web_settings[0]['logo'] ; }?>");
  
  height: 100%;

  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
  filter: grayscale(100%);
  
}
.ul_list_none li {
    list-style-type: none;
}
	</style>

<!-- Printable area end -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('PO_details');?></h1>
            <small><?php echo display('PO_details');?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('purchase_order') ?></a></li>
                <li class="active"><?php echo display('PO_details');?></li>
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

            <div class="row">
                <div class="col-lg-12">
     

                <table border="1" cellpadding="4" class="table table_main">
	                       
                <tbody>
	                        	{company_info}
                    <tr>
                        <td class="">
                            <span class="col-md-2"    style=" width: 16.66666667%;float: left;"><img src="<?php if (isset($Web_settings[0]['logo'])) {echo  $Web_settings[0]['logo'] ; }?>" class="" alt="" 
									 style="width: 150px; height: 60px;"></span>
                                <span class="col-md-8"   style=" width: 66.66666667%;"><h1 class="margin_null" style=' margin-top: 0;'><center><u><strong>{company_name}</strong></u></center></h1>
                               <h4 class="margin_null txt_space"><center><span style='margin-right: 20px;'>{address},</span> <span style='margin-right: 20px;'>{mobile},</span> <span style='margin-right: 20px;'> {email},</span> <span style='margin-right: 20px;'> {website}</span> </center></h4></span>
                        </td>
                       
                    </tr>
	                            {/company_info}
                </tbody>
                </table>
            <div class="watermark">
                <h4 class="headinh_h" style='    text-align: center;'><?php echo display('supplier');?></h4>
                
                
                
                
                <table border="1" cellpadding="4" class="table table_main">
                    <tbody>
                        <div class="" style='display: flex;'>
                        	<ul class="col-md-6 ul_list_none"  style='    width: 50%; list-style-type: none;'>
                    	    <li><b><?php echo display('supplier');?> :</b><span> {supplier_name}</span></li>
                    	    <li><b><?php echo display('address');?> :</b><span>{sup_tin_no}</span></li>
                    	    <li><b><?php echo display('TIN/CST_number');?> :</b><span>{sup_pan_no}</span></li>
                    	    <li><b><?php echo display('PAN_number');?> :</b><span>{pan_no}</span></li>
                    	    <li><b><?php echo display('CIN_number');?> :</b><span>{sup_cin_no}</span></li>
                    	    <li><b><?php echo display('GSTIN');?> :</b><span>{po_date}</span></li>
                    	    <li><b><?php echo display('po_date');?> :</b><span>{sup_gstin}</span></li>
                    	    
                    	</ul>
                    	<ul class="col-md-6 ul_list_none "  style='    width: 50%; list-style-type: none;'>
                    	    <li><b><?php echo display('po_no');?></b><span> {po_no}</span></li>
                    	    <li><b><?php echo display('po_date');?> :</b><span>{po_date}</span></li>
                    	    <li><b><?php echo display('delivery_address');?> :</b><span>{delivery_address}</span></li>
                    	    <li><b><?php echo display('po_date');?> :</b><span>{po_date}</span></li>
                    	    
                    	</ul>
                 
                   </div>
                </table>
                <!--<table border="1" cellpadding="4" class="table table_main">
                    <tbody>
                    	
                    <tr>
                    <td bgcolor="" rowspan="3"><strong> : </strong><br><b>{supplier_name}</b><br>
                    <?php if($supplier_address){?>
	                            <strong> :</strong>{supplier_address}</br>
	                            <?php }
	                            
	                            if($sup_tin_no){?>
	                            <strong> :</strong></br>
	                            <?php }
	                            if($sup_pan_no){?>
	                            <strong> :</strong></br>
	                            <?php }
	                            if($sup_cin_no){?>
	                            <strong> :</strong></br>
	                            <?php }
	                            if($sup_gstin){?>
	                            <strong> :</strong></br>
	                            <?php }
	                            ?></td>
	                
                    <td bgcolor="" rowspan="3"> <strong><?php echo display('delivery_address');?> : </strong>{delivery_address}<br>
                                              <?php	if ($delivery_charges) { ?><strong><?php echo display('delivery_charges'); ?>: </strong><?php echo (($position==0)?"$currency {delivery_charges}":"{delivery_charges} $currency"); }?><br>
                                              <?php if ($freight_charges) { ?><strong><?php echo display('freight_charges'); ?>: </strong><?php echo (($position==0)?"$currency {freight_charges}":"{freight_charges} $currency");} ?> <br>
                                              <?php 
	                            if($payment_terms){?>
	                            <strong><?php echo display('payment_terms');?> : </strong> {payment_terms}</br>
	                            <?php } ?><br>
                    </td>
                    
                    	
                    </tr>
                    
                    </tbody>
                </table>-->
                         
	                        <div class="table-responsive m-b-20">
	                            <table  border="1" cellpadding="4" class="table table_main">
	                                       <thead>
                                    <tr>
	                                        <th align="center"><?php echo display('sl') ?></th>
                                        <th class="text-center"><?php echo display('item_information') ?></th> 
                                        <th class="text-center"><?php echo display('item') ?> <?php echo display('Qty') ?> </th>
                                        <th class="text-center"><?php echo display('uom') ?></th>
                                        <th class="text-center"><?php echo display('rate') ?></th>
                                        <th class="text-center"><?php echo display('discount_all') ?>%</th>
                                        <th class="text-center"><?php echo display('tax') ?>%</th>
                                        <th class="text-center"><?php echo display('total') ?></th>
                                    </tr>
                                </thead>
	                                <tbody>
										{po_info}
										<tr>
	                                    	<td align="">{sl}</td>
	                                        <td align=""><div><strong>{product_name} - ({product_model})</strong></div></td>
	                                        <td align=""><div>{quantity}</div></td>
	                                        <td align="center">{uom_name}</td>
	                                        <td align="center">{unit_cost}</td>
	                                        <td align="center"> {dis_per} %</td>
	                                        <td align="center">{total_tax} %</td>
	                                        <td align="center"><?php echo (($position==0)?"$currency {total_cost}":"{total_cost} $currency") ?></td>
	                                    </tr>
	                                    {/po_info}
	                                </tbody>
	                                <tfoot>
	                                	<td align="center" colspan="2" style="border: 0px"><b><?php echo display('grand_total')?>:</b></td>

	                                	<td align="center"  style="border: 0px"></td>

	                                	<td style="border: 0px"></td>

	                                	<td align="center"  style="border: 0px"></td>

	                                	<td style="border: 0px"></td>
	                                	<td style="border: 0px"></td>
	                                	
	                                	<td align="center"  style="border: 0px"><b><?php echo (($position==0)?"$currency {grand_total}":"{grand_total} $currency") ?></b></td>
	                                </tfoot>
	                            </table>
	                        </div>

                	<ul class="col-md-6 ul_list_none "  style='    width: 50%; list-style-type: none;'>
                    	     <?php	if ($delivery_charges) { ?><li><b><?php echo display('delivery_charges');?></b><span> <?php echo (($position==0)?"$currency {delivery_charges}":"{delivery_charges} $currency"); }?></span></li>
                    	    <?php if ($freight_charges) { ?> <li><b><?php echo display('freight_charges');?> :</b><span><?php echo (($position==0)?"$currency {freight_charges}":"{freight_charges} $currency");} ?></span></li>
                    	    <?php if($payment_terms){?><li><b><?php echo display('payment_terms');?> :</b><span>{payment_terms}</span></li><?php } ?>
                    	    
                    	</ul>

                            <table border="1" cellpadding="4" class="table table_main">
                                <tbody>
                                	
                                    <tr>
                                        <th bgcolor="" colspan="5" style="width: 50%;">
                                            
                                            <p><?php if (isset($Web_settings[0]['po_terms'])) { echo $Web_settings[0]['po_terms']; }?></p>
                                        "<span style="font-weight: 700; text-align: right;">
                                            <?php echo display('this_po');?> "
                                            </th>
                                        <th bgcolor="" colspan="3">{comp_name}<br><br><br><?php echo display('authorised_signatory');?></th>
                                        	
                                    </tr>
                                    
                                
                                </tbody>
                            </table>


                    </div>
                </div>
            </div>

                        
                        
                    </div>
	                <!--div id="printableArea">
	                    <div class="panel-body overflow_scroll">
	                        <div class="row">
	                        	{company_info}
	                            <div class="col-sm-4" style="">
	                                 <img src="<?php if (isset($Web_settings[0]['invoice_logo'])) {echo  $Web_settings[0]['invoice_logo'] ; }?>" class="" alt="" 
									 style="width: 60px; height: 60px;">
	                                <br>
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
	                            SERVICE PURCHASE ORDER</br>
	                            <strong>PO NO. :</strong>{po_no}</br>
	                            <strong>PO DATE :</strong>{po_date}</br>
	                        </div>
	                               <div class="row">
	                            <strong>Supplier Name :</strong>{supplier_name}</br>
	                            <?php 
	                            if($supplier_address){?>
	                            <strong>Address :</strong>{supplier_address}</br>
	                            <?php }
	                            
	                            if($sup_tin_no){?>
	                            <strong>TIN/CSTNumber :</strong>{sup_tin_no}</br>
	                            <?php }
	                            if($sup_pan_no){?>
	                            <strong>PAN Number :</strong>{sup_pan_no}</br>
	                            <?php }
	                            if($sup_cin_no){?>
	                            <strong>CIN Number :</strong>{sup_cin_no}</br>
	                            <?php }
	                            if($sup_gstin){?>
	                            <strong>GSTIN :</strong>{sup_gstin}</br>
	                            <?php }
	                            ?>
	                            
	                            <?php 
	                            if($payment_terms){?>
	                            <strong>Payment terms :</strong>{payment_terms}</br>
	                            <?php } ?>
	                        </div>
                       
	                        <div class="table-responsive m-b-20">
	                            <table class="table table-striped table-bordered">
	                                       <thead>
                                    <tr>
	                                        <th align="center"><?php echo display('sl') ?></th>
                                        <th class="text-center"><?php echo display('item_information') ?></th> 
                                        <th class="text-center"><?php echo display('item') ?> Qty </th>
                                        <th class="text-center">UOM</th>
                                        <th class="text-center"><?php echo display('rate') ?></th>
                                        <th class="text-center"><?php echo display('discount_all') ?>%</th>
                                        <th class="text-center"><?php echo display('tax') ?>%</th>
                                        <th class="text-center"><?php echo display('total') ?></th>
                                    </tr>
                                </thead>
	                                <tbody>
										{po_info}
										<tr>
	                                    	<td align="">{sl}</td>
	                                        <td align=""><div><strong>{product_name} - ({product_model})</strong></div></td>
	                                        <td align=""><div>{quantity}</div></td>
	                                        <td align="center">{uom_name}</td>
	                                        <td align="center">{unit_cost}</td>
	                                        <td align="center"> {dis_per} %</td>
	                                        <td align="center">{total_tax} %</td>
	                                        <td align="center"><?php echo (($position==0)?"$currency {total_cost}":"{total_cost} $currency") ?></td>
	                                    </tr>
	                                    {/po_info}
	                                </tbody>
	                                <tfoot>
	                                	<td align="center" colspan="2" style="border: 0px"><b><?php echo display('grand_total')?>:</b></td>

	                                	<td align="center"  style="border: 0px"></td>

	                                	<td style="border: 0px"></td>

	                                	<td align="center"  style="border: 0px"></td>

	                                	<td style="border: 0px"></td>
	                                	<td style="border: 0px"></td>
	                                	
	                                	<td align="center"  style="border: 0px"><b><?php echo (($position==0)?"$currency {grand_total}":"{grand_total} $currency") ?></b></td>
	                                </tfoot>
	                            </table>
	                        </div>
	                        <div class="row">
		                        
		                            <div class="col-xs-4" style="display: inline-block;">
                                    <table class="table">
				                            <?php	if ($delivery_charges) {
			                                ?>
				                            	<tr>
				                            		<th style="border-top: 0; border-bottom: 0;"><?php echo display('delivery_charges') ?> : </th>
				                            		<td style="border-top: 0; border-bottom: 0;"><?php echo (($position==0)?"$currency {delivery_charges}":"{delivery_charges} $currency") ?> </td>
				                            	</tr>
				                            <?php } 	if ($freight_charges) {
			                                ?>
				                            	<tr>
				                            		<th style="border-top: 0; border-bottom: 0;"><?php echo display('freight_charges') ?> : </th>
				                            		<td style="border-top: 0; border-bottom: 0;"><?php echo (($position==0)?"$currency {freight_charges}":"{freight_charges} $currency") ?> </td>
				                            	</tr>
				                            <?php } 
				                            		if ($delivery_address) {
				                            	?>
				                            	<tr>
				                            		<th style="border-top: 0; border-bottom: 0;">Delivery Address : </th>
				                            		<td style="border-top: 0; border-bottom: 0;">{delivery_address}</td>
				                            	</tr>
				                            	<?php
				                            		}
				                            	?>
			                            </table>
		                   
		                                <div  style="float:left;width:90%;text-align:center;border-top:1px solid #e4e5e7;margin-top: 100px;font-weight: bold;">
												<?php echo display('authorised_by') ?>
										</div>
		                            
		                        </div>
	                        </div>
	                        <div class="row">
	                            
		                        	<div class="col-xs-8" style="display: inline-block;width: 66%">
		                                <!--p><?php echo display('invoice_description')?></p>
		                                <p><?php if (isset($Web_settings[0]['invoice_terms'])) { echo $Web_settings[0]['invoice_terms']; }?></p>
		                                <p><strong><?php echo display('thank_you_for_choosing_us')?></strong></p>
		                                
		                            </div>
	                        </div>
	                    </div>
	                </div-->

                     <div class="panel-footer text-left">
                     	<a  class="btn btn-danger" href="<?php echo base_url('Cinvoice');?>"><?php echo display('cancel') ?></a>
						<button  class="btn btn-info" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></button>
						<button  class="btn btn-success" onclick="downlad_report_pdf('printableArea')"><span class="fa fa-download"></span></button>
						
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->



