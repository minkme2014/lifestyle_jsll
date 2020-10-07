<!-- Sales Report Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('commission_report') ?></h1>
	        <small><?php echo 'Total '.display('commission_report') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('report') ?></a></li>
	            <li class="active"><?php echo display('commission_report') ?></li>
	        </ol>
	    </div>
	</section>

	<section class="content">
		<!-- Sales report -->
		<div class="row">
			<div class="col-sm-12">
		        <div class="panel panel-default">
		            <div class="panel-body"> 
		                <?php echo form_open('Admin_dashboard/retrieve_dateWise_CommissionReports',array('class' => 'form-inline'))?>
		                    <div class="form-group">
		                        <label class="sr-only" for="from_date"><?php echo display('start_date') ?></label>
		                        <input type="text" name="from_date" class="form-control datepicker" id="from_date" placeholder="<?php echo display('start_date') ?>" >
		                    </div> 

		                    <div class="form-group">
		                        <label class="sr-only" for="to_date"><?php echo display('end_date') ?></label>
		                        <input type="text" name="to_date" class="form-control datepicker" id="to_date" placeholder="<?php echo display('end_date') ?>">
		                    </div>  

		                    <div class="form-group">
		                        <label class="sr-only" for="sales_prsn">Sales Person</label>
                                       <select class="customerSelection form-control margon_btm" name="sales_prsn">
                                           <option value="">-- Select Employee --</option>
                                           <?php if($sales_person){ foreach($sales_person as $sp){?>  
                                           <option value="<?php echo $sp['id'];?>"><?php echo $sp['first_name']." ".$sp['last_name'];?></option>
                                           <?php } } ?>
                                       </select>
		                    </div>  
		                    <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
		               <?php echo form_close()?>
		            </div>
		        </div>
		    </div>
	    </div>

		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('commission_report') ?> </h4>
		                </div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive">
		                    <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
		                        <thead>
		                            <tr>
		                                <th><?php echo display('emp_name') ?></th>
										<th><?php echo display('invoice_no') ?>.</th>
										<th><?php echo display('total_amount') ?></th>
										<th><?php echo display('taxable_amount') ?></th>
										<th><?php echo display('commission') ?> %</th>
										<th><?php echo display('commission_value') ?></th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                        <?php
		                        if ($commission_report) { 
		                        	    foreach($commission_report as $ca){
		                        ?>
									<tr>
										<td><?php echo $ca['first_name']." ". $ca['last_name'];?></td>
										<td><?php echo $ca['invoice'];?></td>
										<td><?php echo $ca['total_amount'];?></td>
										<td><?php echo ($ca['total_amount']-$ca['total_tax']);?></td>
										<td><?php echo $ca['commission']."%";?></td>
										<td><?php echo ($ca['total_amount']-$ca['total_tax'])*$ca['commission']/100;?></td>
									</tr>
								
								<?php
								}	}
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
 <!-- Sales Report End -->