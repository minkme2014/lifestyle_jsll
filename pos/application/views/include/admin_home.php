<!-- Admin Home Start -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <section class="content-header ">
        <div class="header-icon">
            <i class="pe-7s-world"></i>

        </div>
        <div class="header-title">
            <div class="col-md-6 col-sm-6  col-xs-6"> <h1><?php echo display('dashboard')?></h1>
            <small><?php echo display('home')?></small></div>
            <div class="col-md-6 col-sm-6  col-xs-6">
                <ol class="breadcrumb">
                    <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home')?></a></li>
                    <li class="active"><?php echo display('dashboard')?></li>
                </ol>
            </div>
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
                                <img src="<?php echo base_url('my-assets/image/pos_invoice.png');?>" height="40" width="40" >
                             </span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Cinvoice/pos_invoice')?>"><?php echo display('create_pos_invoice')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                         <h2><span class="slight" style=""><img src="<?php echo base_url('my-assets/image/invoice.png');?>" height="40" width="40" > </span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Cinvoice')?>"><?php echo display('create_new_invoice')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                         <h2><span class="slight" style=""><img src="<?php echo base_url('my-assets/image/product.png');?>" height="40" width="40" > </span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Cproduct')?>"><?php echo display('add_product')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                         <h2><span class="slight" style=""><img src="<?php echo base_url('my-assets/image/customer.png');?>" height="40" width="40" > </span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Ccustomer')?>"><?php echo display('add_customer')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if($this->session->userdata('user_type') == '1'){?>
        <!-- Third Counter -->
        <div class="row">
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
                            <h2><span class="slight" style=""><img src="<?php echo base_url('my-assets/image/stock.png');?>" height="40"> </span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Creport')?>"><?php echo display('stock_report')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="slight" style=""><img src="<?php echo base_url('my-assets/image/account.png');?>" height="40"></span></h2>
                            <div class="small" style=""><a href="<?php echo base_url('Caccounts/summary')?>"><?php echo display('account_summary')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="row">
            <!-- This month progress -->
            <div class="col-sm-12 col-md-8">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4> <?php echo display('monthly_progress_report')?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <canvas id="lineChart" height="142"></canvas>
                    </div>
                </div>
            </div>
            <!-- Total Report -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('todays_report')?></h4>
                        </div>
                    </div>
						<?php
						$CI = & get_instance();
						$CI->load->model('Reports');

						$sales_report = $CI->Reports->todays_sales_report();
						$purchase_report = $CI->Reports->todays_purchase_report();
						
						$total_amount=0;
										foreach($sales_report as $sr)
										{
											$total_amount +=$sr['total_amount'];
										}
						$purchase_amount=0;
						
										foreach($purchase_report as $pr)
										{
											$purchase_amount +=$pr['grand_total_amount'];
										}
										?>
                    <div class="panel-body">
                        <div class="message_inner">
                            <div class="message_widgets">
                                
                                <table class="table table-bordered table-striped table-hover">
                                <tr>
                                    <th><?php echo display('todays_report')?></th>
                                    <th><?php echo display('money')?></th>
                                </tr>
                                    <tr>
                                        <th><?php echo display('total_sales')?></th>
                                        <td><?php echo (($position==0)?"$currency $total_amount":"$total_amount $currency") ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo display('total_purchase')?></th>
                                        <td><?php echo (($position==0)?"$currency $purchase_amount":"$purchase_amount $currency") ?></td>
                                    </tr>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="count-number"><?php echo $total_customer?></span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span></h2>
                            <div class="small"><?php echo display('total_customer')?></div>
                            <div class="sparkline1 text-center"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="count-number"><?php echo $total_product?></span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span></h2>
                            <div class="small"><?php echo display('total_product')?></div>
                            <div class="sparkline1 text-center"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="count-number"><?php echo $total_suppliers ?></span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> </span></h2>
                            <div class="small"><?php echo display('total_supplier')?></div>
                            <div class="sparkline1 text-center"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="count-number"><?php echo $total_sales ?></span><span class="slight"> <i class="fa fa-play fa-rotate-270 text-warning"> </i> </span></h2>
                            <div class="small"><?php echo display('total_invoice')?></div>
                            <div class="sparkline1 text-center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->
<!-- Admin Home end -->
<?php 
// Month wise patients data for Charts
$pats = array();
if (!empty($monthly_sales_report[0])) {
	for ($i=0; $i < 12 ; $i++) {
		
		if(!empty($monthly_sales_report[0][$i]->month)){
			$pats[$monthly_sales_report[0][$i]->month] = $monthly_sales_report[0][$i]->total;
		}
	}
	//echo "<pre>";print_r($pats);
}
$exitingMonth='';
foreach($pats as $k=>$p){
	//echo $k."=>".$p."<br>";
	$exitingMonth.="!".$k."!";
}
//echo $exitingMonth;
for($i=1;$i<=12;$i++){
	if (strpos($exitingMonth, "!".$i."!") === false) {
		$pats[$i]=0;
	}
}
ksort($pats);
$allSales = implode(",",$pats);
//echo $allPatients;


// Month wise patients data for Charts
$app = array();
if (!empty($monthly_sales_report[1])) {
	for ($i=0; $i < 12 ; $i++) {
		
		if(!empty($monthly_sales_report[1][$i]->month)){
			$app[$monthly_sales_report[1][$i]->month] = $monthly_sales_report[1][$i]->total_month;
		}
	}
	//echo "<pre>";print_r($pats);
}
$exitingMonth1='';
foreach($app as $k=>$p){
	//echo $k."=>".$p."<br>";
	$exitingMonth1.="!".$k."!";
}
//echo $exitingMonth1;
for($i=1;$i<=12;$i++){
	if (strpos($exitingMonth1, "!".$i."!") === false) {
		$app[$i]=0;
	}
}
ksort($app);
$allPurchases = implode(",",$app);
//echo $allAppointments;
//echo '<pre>'; print_r($chart[1]); echo '</pre>';

?> 
<!-- ChartJs JavaScript -->
<script src="<?php echo base_url()?>assets/plugins/chartJs/Chart.min.js" type="text/javascript"></script>

<script type="text/javascript"> 
    //line chart
    var ctx = document.getElementById("lineChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],
            datasets: [
                {
                    label: "Sales",
                    borderColor: "#2C3136",
                    borderWidth: "1",
                    backgroundColor: "rgba(0,0,0,.07)",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: [<?php echo $allSales;?>]
                },
                {
                    label: "Purchase",
                    borderColor: "#73BC4D",
                    borderWidth: "1",
                    backgroundColor: "#73BC4D",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: [<?php echo $allPurchases;?>]
                }
            ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }

        }
    }); 
</script>