<!-- Manage Category Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('manage_manualconsumption') ?></h1>
	        <small><?php echo display('manage_your_manualconsumption') ?></small>
	        <ol class="breadcrumb">
	            <li><a href=""><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('manualconsumption') ?></a></li>
	            <li class="active"><?php echo display('manage_manualconsumption') ?></li>
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

		<!-- Manage Category -->
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('manage_category') ?></h4>
		                </div>
						<div class="panel-body"> 
							<?php echo form_open_multipart('Cmanualconsumption/manage_manualconsumption', array('class' => 'form-inline', 'id' => 'manualconsumption')) ?>

							<?php
							date_default_timezone_set("Asia/Dhaka");
							$today = date('Y-m-d');
							?>
							<label class="select"><?php echo display('date') ?></label>
							<input type="text" name="stock_date" class="datepicker form-control productSelection " required/> 
							<button type="submit" class="btn btn-primary"><?php echo display('search') ?></button>
							<a  class="btn btn-warning" href="#" onclick="printDiv('printableArea')"><?php echo display('print') ?></a>
							<?php echo form_close() ?>
						</div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive">
		                    <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th class="text-center"><?php echo display('sl') ?></th>
										<th class="text-center"><?php echo display('product') ?></th>
										<th class="text-center"><?php echo display('quantity') ?></th>
										<th class="text-center"><?php echo display('reason') ?></th>
										<th class="text-center"><?php echo display('action') ?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									if ($manualconsumption_list) {
								?>
								{manualconsumption_list}
									<tr>
										<td class="text-center">{sl}</td>
										<td class="text-center">{product_name}</td>
										<td class="text-center">{qty}</td>
										<td class="text-center">{reason}</td>
										<td>
											<center>
											<?php echo form_open()?>
											<?php 
											if($this->session->userdata('user_type')!=1) 
											{
												if($edited)
												{
													if($edited!==0)
													{?>
														<a href="<?php echo base_url().'Cmanualconsumption/manualconsumption_update_form/{manualconsumption_id}'; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
													<?php }
												}	
											}else{?>
													 <a href="<?php echo base_url().'Cmanualconsumption/manualconsumption_update_form/{manualconsumption_id}'; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

											<?php }?>
											<?php 
											if($this->session->userdata('user_type')!=1) 
											{
												if($deleted)
												{
													if($deleted!==0)
													{?>
														<a href="" class="DeleteCategory btn btn-danger btn-sm" name="{manualconsumption_id}" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
													<?php }
												}	
											}else{?>
													<a href="" class="DeleteCategory btn btn-danger btn-sm" name="{manualconsumption_id}" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
											
											<?php }?>
												
												<?php echo form_close()?>
											</center>
										</td>
									</tr>
								{/manualconsumption_list}
								<?php
									}
								?>
								</tbody>
		                    </table>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</section>
</div>
<!-- Manage Category End -->

<!-- Delete Category ajax code -->
<script type="text/javascript">
	//Delete Category 
	$(".DeleteCategory").click(function()
	{	
		var manualconsumption_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("<?php echo display('are_you_sure') ?> ?");
		if (x==true){
		$.ajax
		   ({
				type: "POST",
				url: '<?php echo base_url('Cmanualconsumption/manualconsumption_delete')?>',
				data: {manualconsumption_id:manualconsumption_id,csrf_test_name:csrf_test_name},
				cache: false,
				success: function(datas)
				{
					alert(datas);
				} 
			});
		}
	});
</script>



