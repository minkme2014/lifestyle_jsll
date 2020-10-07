<?php
$CI = & get_instance();
$CI->load->model('Web_settings');
$CI->load->model('Users');
$Web_settings = $CI->Web_settings->retrieve_setting_editdata();
$users = $CI->Users->profile_edit_data();
?>
<!-- Admin header end -->
<style type="text/css">
    .trnb:hover{
        background-color: green;
        color: white;

    }
    .trnb a:hover{

        color:white;
    }
</style>
<header class="main-header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
    <a href="<?php echo base_url() ?>" class="logo"> <!-- Logo -->
        <span class="logo-mini">
            <!--<b>A</b>BD-->
            <!--<b>A</b>BD-->
            <img src="<?php
           /*  if (isset($Web_settings[0]['favicon'])) {
                echo $Web_settings[0]['favicon'];
            } */
            ?>" alt="">
        </span>

        <span class="logo-lg">
            <!--<b>Admin</b>BD-->
            <img src="<?php
            /* if (isset($Web_settings[0]['logo'])) {
                echo $Web_settings[0]['logo'];
            } */
            ?>" alt="">
        </span>
    </a>
    <!-- Header Navbar -->


    <nav class="navbar navbar-static-top">
<div class="col-md-3 col-sm-2  col-xs-2" style="z-index: 9999999;"> 
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <!-- Sidebar toggle button-->
            <span class="sr-only">Toggle navigation</span>
            <span class="pe-7s-keypad"></span>
        </a>
          </div>
            <div class="col-md-6 col-sm-9  col-xs-8 head_btn">    
                <span class="btn btn-default trnb" style=""><a href="<?php echo base_url('Cinvoice') ?>"><i class="ti-layout-accordion-list"></i> <?php echo display('invoice') ?></a></span> 
                <span class="btn btn-default trnb" style=""><a href="<?php echo base_url('Cpayment/receipt_transaction') ?>"><i class="fa fa-money"></i> <?php echo display('receipt') ?> </a></span>
                <span class="btn btn-default trnb" style=""><a href="<?php echo base_url('Cpayment') ?>"><i class="fa fa-paypal" aria-hidden="true"></i>
                <?php echo display('payment') ?></a></span> <span class="btn btn-default trnb" style=""><a href="<?php echo base_url('Cpurchase') ?>"><i class="ti-shopping-cart"></i> <?php echo display('purchase') ?></a></span>
            </div>
        <div class="col-md-3 col-sm-1  col-xs-2 satting_icon"> 
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- settings -->
                <li class="dropdown dropdown-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="pe-7s-settings"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('Admin_dashboard/edit_profile') ?>"><i class="pe-7s-users"></i><?php echo display('user_profile') ?></a></li>
                        <li><a href="<?php echo base_url('Admin_dashboard/change_password_form') ?>"><i class="pe-7s-settings"></i><?php echo display('change_password') ?></a></li>
                        <li><a onclick="delete_cookie();"><i class="pe-7s-key"></i><?php echo display('logout') ?></a></li>
                      <!--  <li><a href="<?php echo base_url('Admin_dashboard/logout') ?>"><i class="pe-7s-key"></i><?php echo display('logout') ?></a></li>-->
                    </ul>
                </li>
            </ul>
        </div>
          </div>
    </nav>
</header>

<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel text-center">
            <div class="image">
                <!--img src="<--?php echo $users[0]['logo']; ?>" class="img-circle" alt="User Image"-->
                <img src="<?php if (isset($Web_settings[0]['invoice_logo'])) {echo  $Web_settings[0]['invoice_logo'] ; }
                else {echo "https://retail.minkchatter.com/billing/assets/dist/img/avatar.png";}?>" class="img-circle" alt="" 
									 style="width: 60px; height: 60px;">
            </div>
            <div class="info">
                <p><?php echo $this->session->userdata('user_name'); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> <?php echo display('online') ?></a>
            </div>
        </div>
        <!-- sidebar menu -->
        <ul class="sidebar-menu">

            <li class="<?php
            if ($this->uri->segment('1') == ("")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="<?php echo base_url() ?>"><i class="ti-dashboard"></i> <span><?php echo display('dashboard') ?></span>
                    <span class="pull-right-container">
                        <span class="label label-success pull-right"></span>
                    </span>
                </a>
            </li>

            <!-- Invoice menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Cinvoice")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-layout-accordion-list"></i><span><?php echo display('invoice') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Cinvoice') ?>"><?php echo display('new_invoice') ?></a></li>
                    <li><a href="<?php echo base_url('Cinvoice/manage_invoice') ?>"><?php echo display('manage_invoice') ?></a></li>
                    <li><a href="<?php echo base_url('Cinvoice/pos_invoice') ?>"><?php echo display('pos_invoice') ?></a></li>
                </ul>
            </li>
            <!-- Invoice menu end -->
            <!-- Category menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Ccategory")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-tag"></i><span><?php echo display('category') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Ccategory') ?>"><?php echo display('add_category') ?></a></li>
                    <li><a href="<?php echo base_url('Ccategory/manage_category') ?>"><?php echo display('manage_category') ?></a></li>
                </ul>
            </li>
            <!-- Category menu end -->
            <!-- Product menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Cproduct")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-bag"></i><span><?php echo display('product') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Cproduct') ?>"><?php echo display('add_product') ?></a></li>
                    <li><a href="<?php echo base_url('Cproduct/manage_product') ?>"><?php echo display('manage_product') ?></a></li>
                    <li><a href="<?php echo base_url('Cproduct/manage_rol') ?>"><?php echo 'ROL Product' ?></a></li>
                    <?php
                    if ($this->uri->segment(2) == "product_details") {
                        ?>
                        <li><a href="<?php echo base_url($product_statement) ?>"><?php echo display('product_statement') ?></a></li>
                    <?php }
                    ?>
                </ul>
            </li>
            <!-- Product menu end -->

            <!-- Customer menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Ccustomer")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="fa fa-handshake-o"></i><span><?php echo display('customer') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Ccustomer') ?>"><?php echo display('add_customer') ?></a></li>
                    <li><a href="<?php echo base_url('Ccustomer/manage_customer') ?>"><?php echo display('manage_customer') ?></a></li>
                    <li><a href="<?php echo base_url('Ccustomer/credit_customer') ?>"><?php echo display('credit_customer') ?></a></li>
                    <li><a href="<?php echo base_url('Ccustomer/paid_customer') ?>"><?php echo display('paid_customer') ?></a></li>
                </ul>
            </li>
            <!-- Customer menu end -->

            <!-- Supplier menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Csupplier")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-user"></i><span><?php echo display('supplier') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Csupplier') ?>"><?php echo display('add_supplier') ?></a></li>
                    <li><a href="<?php echo base_url('Csupplier/manage_supplier') ?>"><?php echo display('manage_supplier') ?></a></li>

                    <li><a href="<?php echo base_url('Csupplier/supplier_ledger_report') ?>"><?php echo display('supplier_ledger') ?></a></li>
<!--                    <li><a href="<?php echo base_url('Csupplier/supplier_actual_ledger') ?>"><?php echo display('supplier_actual_ledger_sup') ?></a></li>

                    <li><a href="<?php echo base_url('Csupplier/supplier_actual_ledger_sales_price') ?>"><?php echo display('supplier_actual_ledger_sale') ?></a></li>-->
                    <li><a href="<?php echo base_url('Csupplier/supplier_payment') ?>"><?php echo display('supplier_payment_ledger') ?></a></li>
                    <!-- <li><a href="<?php echo base_url('Csupplier/supplier_sales_details_all') ?>"><?php echo display('supplier_sales_details') ?></a></li> 
                  <li><a href="<?php echo base_url($supplier_sales_summary) ?>"><?php echo display('supplier_sales_summary') ?></a></li>
                   <li><a href="<?php echo base_url($sales_payment_actual) ?>"><?php echo display('supplier_payment_actual') ?></a></li> -->

                </ul>
            </li>
            <!-- Supplier menu end  -->

            <!-- Purchase menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Cpurchase")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-shopping-cart"></i><span><?php echo display('purchase') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Cpurchase') ?>"><?php echo display('add_purchase') ?></a></li>
                    <li><a href="<?php echo base_url('Cpurchase/manage_purchase') ?>"><?php echo display('manage_purchase') ?></a></li>
                </ul>
            </li>
            <!-- Purchase menu end -->

            <!-- Purchase order menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Cpurchaseorder")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-shopping-cart"></i><span><?php echo display('purchase_order') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Cpurchaseorder') ?>"><?php echo display('add_po') ?></a></li>
                    <li><a href="<?php echo base_url('Cpurchaseorder/manage_po') ?>"><?php echo display('manage_po') ?></a></li>
                </ul>
            </li>
            <!-- Purchase order menu end -->

            <!-- Manual Consumption menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Cmanualconsumption")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-hand-stop"></i><span><?php echo display('manualconsumption') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Cmanualconsumption') ?>"><?php echo display('add_manualconsumption') ?></a></li>
                    <li><a href="<?php echo base_url('Cmanualconsumption/manage_manualconsumption') ?>"><?php echo display('manage_manualconsumption') ?></a></li>
                </ul>
            </li>
            <!-- Purchase menu end -->
            <!-- Transection menu start -->

            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Cpayment") || $this->uri->segment('2') == ("manage_account") || $this->uri->segment('1') == ("Account_Controller") || $this->uri->segment('2') == ("manage_payment") || $this->uri->segment('3') == ("summaryy") || $this->uri->segment('3') == ("date_summary") || $this->uri->segment('3') == ("custom_report") || $this->uri->segment('3') == ("closing_report")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="fa fa-money"></i><span><?php echo display('accounts') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Account_Controller') ?>"><?php echo display('create_account') ?></a></li>
                    <li><a href="<?php echo base_url('Account_Controller/manage_account') ?>"><?php echo display('manage_account') ?></a></li>
                    <li><a href="<?php echo base_url('Cpayment') ?>"><?php echo display('payment') ?></a></li>
                    <li><a href="<?php echo base_url('Cpayment/receipt_transaction') ?>"><?php echo display('receipt') ?></a></li>
                    <li><a href="<?php echo base_url('Cpayment/manage_payment') ?>"><?php echo display('manage_transaction') ?></a></li>
                    <li><a href="" style="position: relative;"><?php echo display('report') ?>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('Cpayment/summaryy') ?>"><?php echo display('daily_summary') ?></a></li>
                            <li><a href="<?php echo base_url('Cpayment/date_summary') ?>"><?php echo display('daily_cashflow') ?></a></li>
                            <!--<li><a href="<?php echo base_url('Cpayment/custom_report') ?>"><?php echo display('custom_report') ?></a></li>-->
                            <li><a href="<?php echo base_url('Cpayment/closing_report/') ?>"><?php echo display('closing_report') ?></a></li>

                        </ul>
                    <li><a href="<?php echo base_url('Cpayment/closing/') ?>"><?php echo display('closing') ?></a></li>

            </li>

        </ul>
        </li>
        <!-- Transection menu End -->


        <!-- Stock menu start -->
        <li class="treeview <?php
        if ($this->uri->segment('1') == ("Creport")) {
            echo "active";
        } else {
            echo " ";
        }
        ?>">
            <a href="#">
                <i class="ti-bar-chart"></i><span><?php echo display('stock') ?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo base_url('Creport') ?>"><?php echo display('stock_report') ?></a></li>
               <!-- <li><a href="<?php echo base_url('Creport/stock_report_supplier_wise') ?>"><?php echo display('stock_report_supplier_wise') ?></a></li>
                <li><a href="<?php echo base_url('Creport/stock_report_product_wise') ?>"><?php echo display('stock_report_product_wise') ?></a></li>-->
            </ul>
        </li>
        <!-- Stock menu end -->

        <?php
        if ($this->session->userdata('user_type') == '1') {
            ?>



            <!-- Report menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('2') == ("all_report") || $this->uri->segment('2') == ("todays_sales_report") || $this->uri->segment('2') == ("todays_purchase_report") || $this->uri->segment('2') == ("product_sales_reports_date_wise") || $this->uri->segment('2') == ("retrieve_dateWise_PurchaseReports") || $this->uri->segment('2') == ("total_profit_report") || $this->uri->segment('2') == ("retrieve_dateWise_SalesReports")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-book"></i><span><?php echo display('report') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Admin_dashboard/all_report') ?>"><?php echo display('todays_report') ?></a></li>
                    <li><a href="<?php echo base_url('Admin_dashboard/todays_sales_report') ?>"><?php echo display('sales_report') ?></a></li>
                    <li><a href="<?php echo base_url('Admin_dashboard/todays_purchase_report') ?>"><?php echo display('purchase_report') ?></a></li>
                    <li><a href="<?php echo base_url('Admin_dashboard/product_sales_reports_date_wise') ?>"><?php echo display('sales_report_product_wise') ?></a></li>
                    <li><a href="<?php echo base_url('Admin_dashboard/total_profit_report') ?>"><?php echo display('profit_report') ?></a></li>
                    <li><a href="<?php echo base_url('Admin_dashboard/todays_consumption_report') ?>"><?php echo display('consumption_report') ?></a></li>
                </ul>
            </li>
            <!-- Report menu end -->

            <!-- Bank menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('2') == ("index") || $this->uri->segment('2') == ("bank_list") || $this->uri->segment('2') == ("bank_ledger") || $this->uri->segment('2') == ("bank_debit_credit_manage") || $this->uri->segment('2') == ("bank_transaction")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-briefcase"></i><span><?php echo display('bank') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Csettings/index') ?>"><?php echo display('add_new_bank') ?></a></li>
                    <li><a href="<?php echo base_url('Csettings/bank_transaction') ?>"><?php echo display('bank_transection') ?></a></li>
                    <li><a href="<?php echo base_url('Csettings/bank_list/') ?>"><?php echo display('manage_bank') ?></a></li>
                </ul>
            </li>
            <!-- Bank menu end -->

            <!-- Comission start -->
            <li class="treeview <?php
            if ($this->uri->segment('2') == ("commission") || $this->uri->segment('2') == ("commission_generate")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-layout-grid2"></i><span><?php echo display('commission') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Csettings/commission') ?>"><?php echo display('generate_commission') ?></a></li>
                </ul>
            </li>
            <!-- Comission end -->

            <!-- Personal loan start -->
            <!--li class="treeview <--?php
            if ($this->uri->segment('2') == ("add1_person") || $this->uri->segment('2') == ("manage1_person") || $this->uri->segment('2') == ("person_ledger") || $this->uri->segment('2') == ("person_edit")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="fa fa-university" aria-hidden="true"></i>

                    <span><--?php echo display('personal_loan') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<--?php echo base_url('Cloan/add1_person') ?>"><--?php echo display('add_person') ?></a></li>

                    <li><a href="<--?php echo base_url('Cloan/manage1_person') ?>"><--?php echo display('manage_loan') ?></a></li>
                </ul>
            </li-->
            <!-- Personal loan end -->
            <!--  loan start -->
            <!--li class="treeview <--?php
            if ($this->uri->segment('2') == ("add_person") || $this->uri->segment('2') == ("add_loan") || $this->uri->segment('2') == ("loan_edit") || $this->uri->segment('2') == ("add_payment") || $this->uri->segment('2') == ("person_loan_edit") || $this->uri->segment('2') == ("manage_person") || $this->uri->segment('2') == ("manage_loan") || $this->uri->segment('2') == ("person_loan_deails")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    <span><--?php echo display('personal_loan1') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<--?php echo base_url('Csettings/add_person') ?>"><--?php echo display('add_person') ?></a></li>
                    <li><a href="<--?php echo base_url('Csettings/manage_person') ?>"><--?php echo display('manage_person') ?></a></li>
                    <li><a href="<--?php echo base_url('Csettings/add_loan') ?>"><--?php echo display('add_loan') ?></a></li>
                    <li><a href="<--?php echo base_url('Csettings/manage_loan') ?>"><--?php echo display('manage_loan') ?></a></li>
                    <li><a href="<--?php echo base_url('Csettings/add_payment') ?>"><--?php echo display('add_payment') ?></a></li>

                </ul>
            </li-->
            <!-- loan end -->

            <!-- Synchronizer setting start -->
            <!--li class="treeview <?php
            if ($this->uri->segment('2') == ("form") || $this->uri->segment('2') == ("synchronize") || $this->uri->segment('1') == ("Backup_restore")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-reload"></i><span><?php echo display('data_synchronizer') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php
                    $localhost = false;
                    if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', 'localhost'))) {
                        ?>
                            <!--<li><a href="<?php echo base_url('data_synchronizer/form') ?>"><?php echo display('setting') ?></a></li>-->
                        <?php
                    }
                    ?>
        <!--<li><a href="<?php echo base_url('data_synchronizer/synchronize/') ?>"><?php echo display('synchronize') ?></a></li>-->
                    <!--li><a href="<?php echo base_url('Backup_restore/') ?>"><?php echo display('backup') ?></a></li>
                </ul>
            </li-->
            <!-- Synchronizer setting end -->

            <!-- Software Settings menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Company_setup") || $this->uri->segment('1') == ("User") || $this->uri->segment('1') == ("Cweb_setting") || $this->uri->segment('1') == ("Language")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-settings"></i><span><?php echo display('web_settings') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Company_setup/manage_company') ?>"><?php echo display('manage_company') ?></a></li>
                    <li><a href="<?php echo base_url('User') ?>"><?php echo display('add_user') ?></a></li>
                    <li><a href="<?php echo base_url('User/manage_user') ?>"><?php echo display('manage_users') ?> </a></li>
                    <li><a href="<?php echo base_url('Language') ?>"><?php echo display('language') ?> </a></li>
                    <li><a href="<?php echo base_url('Cweb_setting') ?>"><?php echo display('setting') ?> </a></li>
                </ul>
            </li>
            <!-- Software Settings menu end -->
            <?php
        }
        ?>

        </ul>
    </div> <!-- /.sidebar -->
</aside>
<script>
    		function delete_cookie()
{
	$.ajax({
							url:'<?php echo site_url('Admin_dashboard/logout'); ?>',
							type: 'GET', 
							success: function(data)
						{
							$.ajax({
							url:'https://<?php echo $_SERVER['SERVER_NAME']?>/billing/ajax-call-out.php',
							type: 'POST', 
							success: function(data)
						{
							window.location.replace("https://<?php echo $_SERVER['SERVER_NAME']?>/billing");
						}
		
						
				});
						}
		
						
				});
	
		
}

</script>