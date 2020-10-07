<!-- Admin Home Start -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <section class="content-header ">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>

        </div>
        <div class="header-title">
		<h1><?php echo display('reports')?></h1>
            <small><?php echo display('reports')?></small>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home')?></a></li>
                    <li class="active"><?php echo display('reports')?></li>
                </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content admin_home_page">
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
        <!-- First Counter -->
      
        
        <!-- Second Counter -->
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="slight" style="">
                                <img src="<?php echo base_url('my-assets/image/today_reports.png');?>" height="40" width="40" >
                             </span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Admin_dashboard/all_report')?>"><?php echo display('todays_report')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="slight" style=""><img src="<?php echo base_url('my-assets/image/sale.png');?>" height="40"> </span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Admin_dashboard/todays_sales_report')?>"><?php echo display('sales_report')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="slight" style=""><img src="<?php echo base_url('my-assets/image/purchase.png');?>" height="40"> </span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Admin_dashboard/todays_purchase_report')?>"><?php echo display('purchase_report')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                         <h2><span class="slight" style=""><img src="<?php echo base_url('my-assets/image/product.png');?>" height="40" width="40" > </span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Admin_dashboard/product_sales_reports_date_wise')?>"><?php echo display('sales_report_product_wise')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Third Counter -->
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                         <h2><span class="slight" style=""><img src="<?php echo base_url('my-assets/image/profit.png');?>" height="40" width="40" > </span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Admin_dashboard/total_profit_report')?>"><?php echo display('profit_report')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                         <h2><span class="slight" style=""><img src="<?php echo base_url('my-assets/image/consumption.png');?>" height="40" width="40" > </span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Admin_dashboard/todays_consumption_report')?>"><?php echo display('consumption_report')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="slight" style=""><img src="<?php echo base_url('my-assets/image/commission.png');?>" height="40"> </span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Admin_dashboard/todays_commission_report')?>"><?php echo display('commission_report')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="slight" style=""><img src="<?php echo base_url('my-assets/image/manufacturing.png');?>" height="40"></span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Admin_dashboard/odr_manufacturing_report')?>"><?php echo display('odr_manufacturing_report')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                         <h2><span class="slight" style=""><img src="<?php echo base_url('my-assets/image/stock.png');?>" height="40" width="40" > </span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Admin_dashboard/profit_sheet')?>"><?php echo display('profit_sheet')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                         <h2><span class="slight" style=""><img src="<?php echo base_url('my-assets/image/customer.png');?>" height="40" width="40" > </span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Admin_dashboard/sales_record_report')?>"><?php echo display('sales_record_report')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="slight" style=""><img src="<?php echo base_url('my-assets/image/purchase.png');?>" height="40"> </span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Admin_dashboard/manufacturing_cost_report')?>"><?php echo display('manufacturing_cost_report')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="slight" style=""><img src="<?php echo base_url('my-assets/image/purchase_return.png');?>" height="40"></span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Admin_dashboard/purchase_return_report')?>"><?php echo display('purchase_return_report')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                         <h2><span class="slight" style=""><img src="<?php echo base_url('my-assets/image/invoice_return.png');?>" height="40" width="40" > </span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Admin_dashboard/invoice_return_report')?>"><?php echo display('invoice_return_report')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                         <h2><span class="slight" style=""><img src="<?php echo base_url('my-assets/image/stock.png');?>" height="40" width="40" > </span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Creport')?>"><?php echo display('stock_report')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
    
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->