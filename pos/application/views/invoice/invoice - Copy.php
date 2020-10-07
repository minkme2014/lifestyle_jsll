<!-- Manage Invoice Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	         <div class="col-md-6 col-sm-6">
	        <h1><?php echo display('manage_invoice') ?></h1>
	        <small><?php echo display('manage_your_invoice') ?></small>
	        </div>
             <div class="col-md-6 col-sm-6">
    	        <ol class="breadcrumb">
    	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
    	            <li><a href="#"><?php echo display('invoice') ?></a></li>
    	            <li class="active"><?php echo display('manage_invoice') ?></li>
    	        </ol>
             </div>
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
		<!-- Manage Invoice report -->
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <!--div class="panel-heading">
		                <div class="panel-title">
		                    <h4><--?php echo display('manage_invoice') ?></h4>
		                </div>
		            </div-->
		            <div class="panel-body">
		                <div class="table-responsive">
		                    <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
		                    	<thead>
									<tr>
										<th><?php echo display('sl') ?></th>
										<th><?php echo display('invoice_no') ?></th>
										<th><?php echo display('customer_name') ?></th>
										<th><?php echo display('date') ?></th>
										<th><?php echo display('total_amount') ?></th>
										<?php 
										    if($this->session->userdata('user_email')=="spiink2018@gmail.com"){ ?>
										<th><?php echo display('source') ?></th>
										<?php }?>
										<th><?php echo display('action') ?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									if ($invoices_list) {
									    foreach($invoices_list as $i){
								?>
									<tr>
										<td><?php echo $i['sl']; ?></td>
										<td>
											<a href="<?php echo base_url().'Cinvoice/invoice_inserted_data/'.$i['invoice_id']; ?>">
											<?php echo $i['invoice']; ?>
											</a>
										</td>
										<td>
											<a href="<?php echo base_url().'Ccustomer/customerledger/'.$i['customer_id']; ?>"><?php echo $i['customer_name']; ?></a>				
										</td>

										<td><?php echo $i['final_date']; ?></td>
										<td style="text-align: right;"><?php echo (($position==0)?"$currency ".$i['total_amount']:$i['total_amount']."$currency") ?></td>
										
										<?php 
										    if($this->session->userdata('user_email')=="spiink2018@gmail.com"){ 
										    if($i['source']=="1"){?>
										        <td>Manual </td>
										   <?php }else{ ?>
										        <td>Retail</td>
										   <?php } 
										    ?>
										<?php }?>
										<td class="display_flx">
										
												<?php echo form_open()?>

													<a href="<?php echo base_url().'Cinvoice/invoice_inserted_data/'.$i['invoice_id']; ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('invoice') ?>"><i class="fa fa-window-restore" aria-hidden="true"></i></a>

													<a href="<?php echo base_url().'Cinvoice/pos_invoice_inserted_data/'.$i['invoice_id']; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('pos_invoice') ?>"><i class="fa fa-fax" aria-hidden="true"></i></a>
	                                                <?php 
													if($this->session->userdata('user_type')!=1){
														
														if($edited)
														{
															if($edited!==0)
															{?>
																<a href="<?php echo base_url().'Cinvoice/invoice_update_form/'.$i['invoice_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

															<?php }
														}?>
														<?php if($deleted)
														{
															if($deleted!==0)
															{?>
																<a href="" class="deleteInvoice btn btn-danger btn-sm" name="<?php echo $i['invoice_id'];?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
														
															<?php }
														}
													}else{?>
															<a href="<?php echo base_url().'Cinvoice/invoice_update_form/'.$i['invoice_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
															<a href="" class="deleteInvoice btn btn-danger btn-sm" name="<?php echo $i['invoice_id'];?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
														
													<?php }?>
													<!--a href="<?php echo base_url().'Cinvoice/invoice_update_form/'.$i['invoice_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

													<a href="" class="deleteInvoice btn btn-danger btn-sm" name="<?php echo $i['invoice_id']?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a-->
													
													<a href="<?php echo base_url().'Cinvoice/invoice_challan/'.$i['invoice_id']; ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Challan"><i class="fa fa-file-o" aria-hidden="true"></i></a>
												<?php echo form_close()?>
										
										</td>
									</tr>
								<?php
									    }
									}
								?>
								</tbody>
		                    </table>
		                    <div class="text-right"><?php echo $links?></div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</section>
</div>
<!-- Manage Invoice End -->

<!-- Delete Invoice ajax code -->
<script type="text/javascript">
	//Delete Invoice Item 
	$(".deleteInvoice").click(function()
	{	
		var invoice_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("<?php echo display('are_you_sure') ?>");
		if (x==true){
		$.ajax
		   ({
				type: "POST",
				url: '<?php echo base_url('Cinvoice/invoice_delete')?>',
				data: {invoice_id:invoice_id,csrf_test_name:csrf_test_name},
				cache: false,
				success: function(datas)
				{
					window.reload();
				} 
			});
		}
	});
</script>