<!-- Account List Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('manage_loan') ?></h1>
	        <small><?php echo display('manage_loan') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('personal_loan') ?></a></li>
	            <li class="active"><?php echo display('manage_loan') ?></li>
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

		<!-- Account List -->
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('manage_loan') ?> </h4>
		                </div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive">
		                    <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
			           			<thead>
									<tr>
										<th><?php echo display('name') ?></th>
										<th><?php echo display('date') ?></th>
										<th><?php echo display('debit') ?></th>
										<th><?php echo display('credit') ?></th>
									</tr>
									</thead>
									<tbody>
									<?php
										if ($person_list) {
									?>
									{person_list}
										<tr>
											<td>{person_name}<a href="
											<?php echo base_url('Csettings/person_loan_deails/{person_id}');?>"></a></td>
											<td>{date}</td>
											<td>{debit}</td>
											<td>{credit}</td>
											<td>
												<center>
													<?php echo form_open()?>
													<a href="<?php echo base_url('Csettings/loan_edit/{per_loan_id}'); ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
													<?php echo form_close()?>	
												</center>
											</td>
										</tr>
									{/person_list}
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
<!-- Account List End -->

