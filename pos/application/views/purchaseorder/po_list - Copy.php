<!-- Manage Purchase Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('manage_po') ?></h1>
	        <small><?php echo display('manage_your_po') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('purchase_order') ?></a></li>
	            <li class="active"><?php echo display('manage_po') ?></li>
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


		<!-- Manage Purchase report -->
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('manage_po') ?></h4>
		                </div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive">
		                    <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th><?php echo display('sl') ?></th>
										<th><?php echo display('po_no') ?></th>
										<th><?php echo display('supplier_name') ?></th>
										<th><?php echo display('po_date') ?></th>
										<th><?php echo display('created_on') ?></th>
										<th><?php echo display('action') ?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									if ($po_list) {
								?>
								{po_list}
									<tr>
										<td>{sl}</td>
										<td>
												{po_no}
										</td>
										<td>
											<a href="<?php echo base_url().'Csupplier/supplier_details/{supp_id}'; ?>">
												{supplier_name}
											</a>
										</td>
										<td>{date}</td>
										<td>{po_created_at}</td>
										<td>
											<center>
											<?php echo form_open()?>
											
											<?php 
											if($this->session->userdata('user_type')!=1) 
											{
												if($view)
												{
													if($view!==0)
													{?>
														<a href="<?php echo base_url().'Cpurchaseorder/po_inserted_data/{po_id}'; ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
												
													<?php }
												}	
											}else{?>
													 <a href="<?php echo base_url().'Cpurchaseorder/po_inserted_data/{po_id}'; ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
												
											<?php }?>
											<?php 
											if($this->session->userdata('user_type')!=1) 
											{
												if($edited)
												{
													if($edited!==0)
													{?>
														<a href="<?php echo base_url().'Cpurchaseorder/po_update_form/{po_id}'; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

													<?php }
												}	
											}else{?>
													 <a href="<?php echo base_url().'Cpurchaseorder/po_update_form/{po_id}'; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

											<?php }?>
											<?php 
											if($this->session->userdata('user_type')!=1) 
											{
												if($deleted)
												{
													if($deleted!==0)
													{?>
													<a href="" class="deletePo btn btn-danger btn-sm" name="{po_id}" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
											
													<?php }
												}	
											}else{?>
													 <a href="" class="deletePo btn btn-danger btn-sm" name="{po_id}" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
											
											<?php }?>
											    
											</center>
											<?php echo form_close()?>
										</td>
									</tr>
								{/po_list}
								<?php
									}
								?>
								</tbody>
		                    </table>
		                </div>
		                <div class="text-right"><?php echo $links?></div>
		            </div>
		        </div>
		    </div>
		</div>
	</section>
</div>
<!-- Manage Purchase End -->

<!-- Delete Purchase ajax code -->
<script type="text/javascript">
	//Delete Po Item 
	$(".deletePo").click(function()
	{	
		var po_id=$(this).attr('name');
	//	var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("<?php echo display('are_you_sure') ?> ?");
		if (x==true){
		$.ajax
	   ({
			type: "POST",
			url: '<?php echo base_url('Cpurchaseorder/po_delete')?>',
			data: {'po_id':po_id},
			cache: false,
			success: function(datas)
			{
			   //alert(datas);
			} 
		});
		}
	});
</script>