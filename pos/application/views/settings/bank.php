<!-- Bank List Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('bank_list') ?></h1>
	        <small><?php echo display('bank_list') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('settings') ?></a></li>
	            <li class="active"><?php echo display('bank_list') ?></li>
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

		<!-- Bank List -->
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('bank_list') ?> </h4>
		                </div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive">
		                    <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
			           			<thead>
									<tr>
										<th><?php echo display('sl') ?></th>
										<th><?php echo display('bank_name') ?></th>
										<th><?php echo display('ac_name') ?></th>
										<th><?php echo display('ac_number') ?></th>
										<th><?php echo display('branch') ?></th>
										<th><?php echo display('signature_pic') ?></th>
										<th><?php echo display('action') ?></th>
										
									</tr>
								</thead>
								<tbody>
								<?php
									if ($bank_list) {
								?>
								{bank_list}
									<tr>
										<td>{sl}</td>
										<td><a href="<?php echo base_url("Csettings/bank_ledger/{bank_id}");?>" >{bank_name}</a></td>
										<td>{ac_name}</td>
										<td>{ac_number}</td>
										<td>{branch}</td>
										<td>
										<img src="{signature_pic}" class="img img-responsive" height="80" width="100"></td>
										<td>
										<?php echo form_open()?>
										<?php 
										if($this->session->userdata('user_type')!=1) 
										{
											if($edited)
											{
												if($edited!==0)
												{?>
													 <a href="<?php echo base_url().'Csettings/edit_bank/{bank_id}'; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
												<?php }
											}	
										}else{?>
												<a href="<?php echo base_url().'Csettings/edit_bank/{bank_id}'; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
											
										<?php }?>
										<?php 
										if($this->session->userdata('user_type')!=1) 
										{
											if($view)
											{
												if($view!==0)
												{?>
													 <a href="<?php echo base_url("Csettings/bank_ledger/{bank_id}");?>" class="btn btn-default btn-sm" ><i class="fa fa-eye" aria-hidden="true"></i></a>
												<?php }
											}	
										}else{?>
												<a href="<?php echo base_url("Csettings/bank_ledger/{bank_id}");?>" class="btn btn-default btn-sm" ><i class="fa fa-eye" aria-hidden="true"></i></a>
										
										<?php }?>
											<?php echo form_close()?>
										
										</td>
									</tr>
								{/bank_list}
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
<!-- Bank List End -->
