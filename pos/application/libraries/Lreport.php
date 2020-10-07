<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lreport {

    // Retrieve All Stock Report
    public function stock_report($limit, $page, $links) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $stok_report = $CI->Reports->stock_report($limit, $page);

        if (!empty($stok_report)) {
            $i = $page;
            foreach ($stok_report as $k => $v) {
                $i++;
                $stok_report[$k]['sl'] = $i;
            }
            foreach ($stok_report as $k => $v) {
                $i++;
                $stok_report[$k]['stok_quantity'] = $stok_report[$k]['totalBuyQnty'] - $stok_report[$k]['totalSalesQnty'];
                $stok_report[$k]['totalSalesCtn'] = $stok_report[$k]['totalSalesQnty'] / $stok_report[$k]['cartoon_quantity'];
                $stok_report[$k]['totalPrhcsCtn'] = $stok_report[$k]['totalBuyQnty'] / $stok_report[$k]['cartoon_quantity'];

                $stok_report[$k]['stok_quantity_cartoon'] = $stok_report[$k]['stok_quantity'] / $stok_report[$k]['cartoon_quantity'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Stock List',
            'stok_report' => $stok_report,
            'links' => $links,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/stock_report', $data, true);
        return $reportList;
    }

    // Retrieve Single Item Stock Stock Report
    public function stock_report_single_item($product_id, $date, $category_id, $limit, $page, $link) {   //echo "$product_id,$date,$limit,$page";
       $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->library('occational');
        $stok_report = $CI->Reports->stock_report_bydate($product_id, $date, $category_id, $limit, $page);
        $stok_report1 = $CI->Reports->stock_report_bydate($product_id, $date, $category_id, 10000, 0);

        $sub_total_in = 0;
        $sub_total_out = 0;
        $sub_total_stock = 0;
        $sub_total_in1 = 0;
        $sub_total_out1 = 0;
        $sub_total_stock1 = 0;
        if (!empty($stok_report)) {
            $i = $page;
            foreach ($stok_report as $k => $v) {
                $i++;
                $stok_report[$k]['sl'] = $i;
            }

            foreach ($stok_report as $k => $v) {
                $i++;

                $stok_report[$k]['totalSalesCtn'] = round(($stok_report[$k]['totalSalesQnty'] + $stok_report[$k]['totalConsumedQnty']),2);

                $stok_report[$k]['totalPrhcsCtn'] = round($stok_report[$k]['totalPurchaseQnty'],2);

                $stok_report[$k]['stok_quantity_cartoon'] = round(($stok_report[$k]['totalPrhcsCtn'] - $stok_report[$k]['totalSalesQnty'] - $stok_report[$k]['totalConsumedQnty']),2);

                $stok_report[$k]['SubTotalOut'] = round(($sub_total_out + $stok_report[$k]['totalSalesCtn']),2);
                $sub_total_out = $stok_report[$k]['SubTotalOut'];


                $stok_report[$k]['SubTotalIn'] = round(($sub_total_in + $stok_report[$k]['totalPrhcsCtn']),2);
                $sub_total_in = round($stok_report[$k]['SubTotalIn'],2);

                $stok_report[$k]['SubTotalStock'] = round(($sub_total_stock + $stok_report[$k]['stok_quantity_cartoon']),2);
                $sub_total_stock = round($stok_report[$k]['SubTotalStock'],2);
            }
        } else {
            $CI->session->set_userdata(array('error_message' => display('product_not_found')));
            //redirect('Creport');
        }
  if (!empty($stok_report1)) {
            $i = 0;
            foreach ($stok_report1 as $k => $v) {
                $i++;
                $stok_report1[$k]['sl'] = $i;
            }

            foreach ($stok_report1 as $k => $v) {
                $i++;

                $stok_report1[$k]['totalSalesCtn'] = round(($stok_report1[$k]['totalSalesQnty'] + $stok_report1[$k]['totalConsumedQnty']),2);

                $stok_report1[$k]['totalPrhcsCtn'] = round($stok_report1[$k]['totalPurchaseQnty'],2);

                $stok_report1[$k]['stok_quantity_cartoon'] = round(($stok_report1[$k]['totalPrhcsCtn'] - $stok_report1[$k]['totalSalesQnty'] - $stok_report1[$k]['totalConsumedQnty']),2);

                $stok_report1[$k]['SubTotalOut'] = round(($sub_total_out1 + $stok_report1[$k]['totalSalesCtn']),2);
                $sub_total_out1 = $stok_report1[$k]['SubTotalOut'];


                $stok_report1[$k]['SubTotalIn'] = round(($sub_total_in1 + $stok_report1[$k]['totalPrhcsCtn']),2);
                $sub_total_in1 = round($stok_report1[$k]['SubTotalIn'],2);

                $stok_report1[$k]['SubTotalStock'] = round(($sub_total_stock1 + $stok_report1[$k]['stok_quantity_cartoon']),2);
                $sub_total_stock1 = round($stok_report1[$k]['SubTotalStock'],2);
            }
        }
        $CI->load->model('Categories');
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $company_info = $CI->Reports->retrieve_company();
        $category_list = $CI->Categories->category_list_product();
        $data = array(
            'title' => 'Stock Report',
            'stok_report' => $stok_report,
            'stok_report1' => $stok_report1,
            'product_model' => $stok_report[0]['product_model'],
            'link' => $link,
            'date' => $date,
            'sub_total_in' => $sub_total_in,
            'sub_total_out' => $sub_total_out,
            'sub_total_stock' => $sub_total_stock,
            'sub_total_in1' => $sub_total_in1,
            'sub_total_out1' => $sub_total_out1,
            'sub_total_stock1' => $sub_total_stock1,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
            'category_list' => $category_list,
        );

        $reportList = $CI->parser->parse('report/stock_report', $data, true);
        return $reportList;
    }

    // Retrieve Single Item Stock Stock Report
    public function stock_report_supplier_wise($product_id, $supplier_id, $date, $links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Suppliers');
        $CI->load->library('occational');
        $stok_report = $CI->Reports->stock_report_supplier_bydate($product_id, $supplier_id, $date, $per_page, $page);

        $supplier_list = $CI->Suppliers->supplier_list_report();
        $supplier_info = $CI->Suppliers->retrieve_supplier_editdata($supplier_id);

        $sub_total_in = 0;
        $sub_total_out = 0;
        $sub_total_stock = 0;

        if (!empty($stok_report)) {
            $i = $page;
            foreach ($stok_report as $k => $v) {
                $i++;
                $stok_report[$k]['sl'] = $i;
            }

            foreach ($stok_report as $k => $v) {
                $i++;

                $stok_report[$k]['totalSalesCtn'] = $stok_report[$k]['totalSalesQnty'] / $stok_report[$k]['cartoon_quantity'];

                $stok_report[$k]['totalPrhcsCtn'] = $stok_report[$k]['totalPurchaseQnty'] / $stok_report[$k]['cartoon_quantity'];

                $stok_report[$k]['stok_quantity_cartoon'] = ($stok_report[$k]['totalPrhcsCtn'] - $stok_report[$k]['totalSalesCtn']);

                $stok_report[$k]['SubTotalOut'] = ($sub_total_out + $stok_report[$k]['totalSalesCtn']);
                $sub_total_out = $stok_report[$k]['SubTotalOut'];


                $stok_report[$k]['SubTotalIn'] = ($sub_total_in + $stok_report[$k]['totalPrhcsCtn']);
                $sub_total_in = $stok_report[$k]['SubTotalIn'];

                $stok_report[$k]['SubTotalStock'] = ($sub_total_stock + $stok_report[$k]['stok_quantity_cartoon']);
                $sub_total_stock = $stok_report[$k]['SubTotalStock'];
            }
        } else {
            $CI->session->set_userdata(array('error_message' => display('product_not_found')));
            redirect('Creport/stock_report_supplier_wise');
        }


        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $company_info = $CI->Reports->retrieve_company();
        $data = array(
            'title' => 'Stock Report',
            'stok_report' => $stok_report,
            'product_model' => $stok_report[0]['product_model'],
            'links' => $links,
            'date' => $date,
            'sub_total_in' => $sub_total_in,
            'sub_total_out' => $sub_total_out,
            'sub_total_stock' => $sub_total_stock,
            'supplier_list' => $supplier_list,
            'supplier_info' => $supplier_info,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );

        $reportList = $CI->parser->parse('report/stock_report_supplier_wise', $data, true);
        return $reportList;
    }

    // Retrieve Single Item Stock Stock Report
    public function stock_report_product_wise($product_id, $supplier_id, $from_date, $to_date, $links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Suppliers');
        $CI->load->library('occational');
        $stok_report = $CI->Reports->stock_report_product_bydate($product_id, $supplier_id, $from_date, $to_date, $per_page, $page);

        $supplier_list = $CI->Suppliers->supplier_list_report();
        $supplier_info = $CI->Suppliers->retrieve_supplier_editdata($supplier_id);


        $sub_total_in = 0;
        $sub_total_out = 0;
        $sub_total_stock = 0;
        $sub_total_in_qnty = 0;
        $sub_total_out_qnty = 0;
        $sub_total_in_taka = 0;
        $sub_total_out_taka = 0;
        $stok_quantity_cartoon = 0;
        if (!empty($stok_report)) {
            $i = $page;
            foreach ($stok_report as $k => $v) {
                $i++;
                $stok_report[$k]['sl'] = $i;
            }

            foreach ($stok_report as $k => $v) {
                $i++;

                $stok_report[$k]['totalSalesCtn'] = $stok_report[$k]['totalSalesQnty'] / $stok_report[$k]['cartoon_quantity'];

                $stok_report[$k]['totalPrhcsCtn'] = $stok_report[$k]['totalPurchaseQnty'] / $stok_report[$k]['cartoon_quantity'];

                $stok_report[$k]['stok_quantity_cartoon'] = ($stok_report[$k]['totalPrhcsCtn'] - $stok_report[$k]['totalSalesCtn']);


                $stok_report[$k]['SubTotalOut'] = ($sub_total_out + $stok_report[$k]['totalSalesCtn']);
                $sub_total_out = $stok_report[$k]['SubTotalOut'];


                $stok_report[$k]['SubTotalIn'] = ($sub_total_in + $stok_report[$k]['totalPrhcsCtn']);
                $sub_total_in = $stok_report[$k]['SubTotalIn'];

                $stok_report[$k]['SubTotalStock'] = ($sub_total_stock + $stok_report[$k]['stok_quantity_cartoon']);
                $sub_total_stock = $stok_report[$k]['SubTotalStock'];

                $stok_report[$k]['in_taka'] = $stok_report[$k]['totalPurchaseQnty'] * $stok_report[$k]['supplier_price'];

                $stok_report[$k]['out_taka'] = $stok_report[$k]['totalSalesQnty'] * $stok_report[$k]['supplier_price'];


                $stok_report[$k]['SubTotalinQnty'] = ($sub_total_in_qnty + $stok_report[$k]['totalPurchaseQnty']);
                $sub_total_in_qnty = $stok_report[$k]['SubTotalinQnty'];

                $stok_report[$k]['SubTotaloutQnty'] = ($sub_total_out_qnty + $stok_report[$k]['totalSalesQnty']);
                $sub_total_out_qnty = $stok_report[$k]['SubTotaloutQnty'];


                $stok_report[$k]['SubTotalinTaka'] = ($sub_total_in_taka + $stok_report[$k]['in_taka']);
                $sub_total_in_taka = $stok_report[$k]['SubTotalinTaka'];

                $stok_report[$k]['SubTotalOutTaka'] = ($sub_total_out_taka + $stok_report[$k]['out_taka']);
                $sub_total_out_taka = $stok_report[$k]['SubTotalOutTaka'];
            }
        } else {
            $CI->session->set_userdata(array('error_message' => display('product_not_found')));
            redirect('Creport/stock_report_product_wise');
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $company_info = $CI->Reports->retrieve_company();
        $data = array(
            'title' => 'Stock Report',
            'stok_report' => $stok_report,
            'product_model' => $stok_report[0]['product_model'],
            'product_name' => $stok_report[0]['product_name'],
            'links' => $links,
            'date' => $to_date,
            'sub_total_in' => $sub_total_in,
            'sub_total_out' => $sub_total_out,
            'sub_total_stock' => $sub_total_stock,
            'SubTotalinQnty' => $sub_total_in_qnty,
            'SubTotaloutQnty' => $sub_total_out_qnty,
            'sub_total_in_taka' => number_format($sub_total_in_taka, 2, '.', ','),
            'sub_total_out_taka' => number_format($sub_total_out_taka, 2, '.', ','),
            'supplier_list' => $supplier_list,
            'supplier_info' => $supplier_info,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );

        $reportList = $CI->parser->parse('report/stock_report_product_wise', $data, true);
        return $reportList;
    }

    // Retrieve daily Report
    public function retrieve_all_reports() {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $sales_report = $CI->Reports->todays_sales_report();
//        echo '<pre>';        print_r($sales_report);die();
        $sales_amount = 0;
        if (!empty($sales_report)) {
            $i = 0;
            foreach ($sales_report as $k => $v) {
                $i++;
                $sales_report[$k]['sl'] = $i;
                $sales_report[$k]['sales_date'] = $CI->occational->dateConvert($sales_report[$k]['date']);
                $sales_amount = $sales_amount + $sales_report[$k]['total_amount'];
            }
        }
        $purchase_report = $CI->Reports->todays_purchase_report();
        $purchase_amount = 0;
        if (!empty($purchase_report)) {
            $i = 0;
            foreach ($purchase_report as $k => $v) {
                $i++;
                $purchase_report[$k]['sl'] = $i;
                $purchase_report[$k]['prchse_date'] = $CI->occational->dateConvert($purchase_report[$k]['purchase_date']);
                $purchase_amount = $purchase_amount + $purchase_report[$k]['grand_total_amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Todays report',
            'sales_report' => $sales_report,
            'sales_amount' => number_format($sales_amount, 2, '.', ','),
            'purchase_amount' => number_format($purchase_amount, 2, '.', ','),
            'purchase_report' => $purchase_report,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );

        // report/all_report
        $reportList = $CI->parser->parse('report/all_report', $data, true);
        return $reportList;
    }

    // Retrieve todays_sales_report
    public function todays_sales_report() {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $sales_report = $CI->Reports->todays_sales_report();
        $sales_amount = 0;
        if (!empty($sales_report)) {
            $i = 0;
            foreach ($sales_report as $k => $v) {
                $i++;
                $sales_report[$k]['sl'] = $i;
                $sales_report[$k]['sales_date'] = $CI->occational->dateConvert($sales_report[$k]['date']);
                $sales_amount = $sales_amount + $sales_report[$k]['total_amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Daily Sales Report',
            'sales_amount' => number_format($sales_amount, 2, '.', ','),
            'sales_report' => $sales_report,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/sales_report', $data, true);
        return $reportList;
    }

    public function retrieve_dateWise_SalesReports($start_date, $end_date) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $sales_report = $CI->Reports->retrieve_dateWise_SalesReports($start_date, $end_date);
        $sales_amount = 0;
        if (!empty($sales_report)) {
            $i = 0;
            foreach ($sales_report as $k => $v) {
                $i++;
                $sales_report[$k]['sl'] = $i;
                $sales_report[$k]['sales_date'] = $CI->occational->dateConvert($sales_report[$k]['date']);
                $sales_amount = $sales_amount + $sales_report[$k]['total_amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Sales Report',
            'sales_amount' => $sales_amount,
            'sales_report' => $sales_report,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/sales_report', $data, true);
        return $reportList;
    }

    // Retrieve todays_consumption_report
    public function todays_consumption_report() {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $consumption_report = $CI->Reports->todays_consumption_report();
        if (!empty($consumption_report)) {
            $i = 0;
            foreach ($consumption_report as $k => $v) {
                $i++;
                $consumption_report[$k]['sl'] = $i;
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Daily Consumption Report',
            'consumption_report' => $consumption_report,
        );
        $reportList = $CI->parser->parse('report/consumption_report', $data, true);
        return $reportList;
    }

    // Retrieve todays_commission_report
    public function todays_commission_report() {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $CI->load->model('Invoices');
        $sales_person= $CI->Invoices->get_sales_persons();
        $commission_report = $CI->Reports->todays_commission_report();
        if (!empty($commission_report)) {
            $i = 0;
            foreach ($commission_report as $k => $v) {
                $i++;
                $commission_report[$k]['sl'] = $i;
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Daily Commission Report',
            'commission_report' => $commission_report,
            'sales_person'=>$sales_person
        );
        $reportList = $CI->parser->parse('report/commission_report', $data, true);
        return $reportList;
    }

    public function retrieve_dateWise_ConsumptionReports($start_date, $end_date) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $consumption_report = $CI->Reports->retrieve_dateWise_ConsumptionReports($start_date, $end_date);
        if (!empty($consumption_report)) {
            $i = 0;
            foreach ($consumption_report as $k => $v) {
                $i++;
                $consumption_report[$k]['sl'] = $i;
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Consumption Report',
            'consumption_report' => $consumption_report,
        );
        $reportList = $CI->parser->parse('report/consumption_report', $data, true);
        return $reportList;
    }

    public function retrieve_dateWise_CommissionReports($start_date=null, $end_date=null,$emp_id=null) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $commission_report = $CI->Reports->retrieve_dateWise_CommissionReports($start_date, $end_date,$emp_id);
        if (!empty($commission_report)) {
            $i = 0;
            foreach ($commission_report as $k => $v) {
                $i++;
                $commission_report[$k]['sl'] = $i;
            }
        }
        $CI->load->model('Invoices');
        $sales_person= $CI->Invoices->get_sales_persons();
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Commission Report',
            'commission_report' => $commission_report,
            'sales_person'=>$sales_person
        );
        $reportList = $CI->parser->parse('report/commission_report', $data, true);
        return $reportList;
    }

    // Retrieve todays_purchase_report
    public function todays_purchase_report() {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $purchase_report = $CI->Reports->todays_purchase_report();
        $purchase_amount = 0;
        if (!empty($purchase_report)) {
            $i = 0;
            foreach ($purchase_report as $k => $v) {
                $i++;
                $purchase_report[$k]['sl'] = $i;
                $purchase_report[$k]['prchse_date'] = $CI->occational->dateConvert($purchase_report[$k]['purchase_date']);
                $purchase_amount = $purchase_amount + $purchase_report[$k]['grand_total_amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Purchase Report',
            'purchase_amount' => number_format($purchase_amount, 2, '.', ','),
            'purchase_report' => $purchase_report,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/purchase_report', $data, true);
        return $reportList;
    }

    //Total profit report
    public function total_profit_report($links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $total_profit_report = $CI->Reports->total_profit_report($per_page, $page);


        $profit_ammount = 0;
        $SubTotalSupAmnt = 0;
        $SubTotalSaleAmnt = 0;
        if (!empty($total_profit_report)) {
            $i = 0;
            foreach ($total_profit_report as $k => $v) {
                $total_profit_report[$k]['sl'] = $i;
                $total_profit_report[$k]['prchse_date'] = $CI->occational->dateConvert($total_profit_report[$k]['date']);

                $profit_ammount = $profit_ammount + $total_profit_report[$k]['total_profit'];

                $SubTotalSupAmnt = $SubTotalSupAmnt + $total_profit_report[$k]['total_supplier_rate'];

                $SubTotalSaleAmnt = $SubTotalSaleAmnt + $total_profit_report[$k]['total_sale'];
            }
        }


        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Profit Report',
            'profit_ammount' => number_format($profit_ammount, 2, '.', ','),
            'total_profit_report' => $total_profit_report,
            'SubTotalSupAmnt' => number_format($SubTotalSupAmnt, 2, '.', ','),
            'SubTotalSaleAmnt' => number_format($SubTotalSaleAmnt, 2, '.', ','),
            'links' => $links,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/profit_report', $data, true);
        return $reportList;
    }

    public function retrieve_dateWise_PurchaseReports($start_date, $end_date) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $purchase_report = $CI->Reports->retrieve_dateWise_PurchaseReports($start_date, $end_date);
        $purchase_amount = 0;
        if (!empty($purchase_report)) {
            $i = 0;
            foreach ($purchase_report as $k => $v) {
                $i++;
                $purchase_report[$k]['sl'] = $i;
                $purchase_report[$k]['prchse_date'] = $CI->occational->dateConvert($purchase_report[$k]['purchase_date']);
                $purchase_amount = $purchase_amount + $purchase_report[$k]['grand_total_amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Purchase Report',
            'purchase_amount' => $purchase_amount,
            'purchase_report' => $purchase_report,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/purchase_report', $data, true);
        return $reportList;
    }

    //Retrive date wise total profit report
    public function retrieve_dateWise_profit_report($start_date, $end_date, $links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $total_profit_report = $CI->Reports->retrieve_dateWise_profit_report($start_date, $end_date, $per_page, $page);

        $profit_ammount = 0;
        $SubTotalSupAmnt = 0;
        $SubTotalSaleAmnt = 0;
        if (!empty($total_profit_report)) {
            $i = 0;
            foreach ($total_profit_report as $k => $v) {
                $total_profit_report[$k]['sl'] = $i;
                $total_profit_report[$k]['prchse_date'] = $CI->occational->dateConvert($total_profit_report[$k]['date']);

                $profit_ammount = $profit_ammount + $total_profit_report[$k]['total_profit'];

                $SubTotalSupAmnt = $SubTotalSupAmnt + $total_profit_report[$k]['total_supplier_rate'];

                $SubTotalSaleAmnt = $SubTotalSaleAmnt + $total_profit_report[$k]['total_sale'];
            }
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Profit Report',
            'profit_ammount' => number_format($profit_ammount, 2, '.', ','),
            'total_profit_report' => $total_profit_report,
            'SubTotalSupAmnt' => number_format($SubTotalSupAmnt, 2, '.', ','),
            'SubTotalSaleAmnt' => number_format($SubTotalSaleAmnt, 2, '.', ','),
            'links' => $links,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/profit_report', $data, true);
        return $reportList;
    }

    public function get_products_report_sales_view($links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $product_report = $CI->Reports->retrieve_product_sales_report($per_page, $page);

        if (!empty($product_report)) {
            $i = 0;
            foreach ($product_report as $k => $v) {
                $i++;
                $product_report[$k]['sl'] = $i;
            }
        }
        $sub_total = 0;
        if (!empty($product_report)) {
            foreach ($product_report as $k => $v) {
                $product_report[$k]['sales_date'] = $CI->occational->dateConvert($product_report[$k]['date']);
                $sub_total = $sub_total + $product_report[$k]['total_amount'];
            }
        }
        $CI->load->model('Categories');
        $category_list = $CI->Categories->category_list_product();
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Product Wise Sales Report',
            'sub_total' => number_format($sub_total, 2, '.', ','),
            'product_report' => $product_report,
            'links' => $links,
            'category_list' => $category_list,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
//        echo '<pre>';        print_r($data);die();
        $reportList = $CI->parser->parse('report/product_report', $data, true);
        return $reportList;
    }

    public function get_products_search_report($from_date, $to_date, $category_id, $links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $product_report = $CI->Reports->retrieve_product_search_sales_report($from_date, $to_date, $category_id, $per_page, $page);
        
        if (!empty($product_report)) {
            $i = 0;
            foreach ($product_report as $k => $v) {
                $i++;
                $product_report[$k]['sl'] = $i;
            }
        }
        $sub_total = 0;
        if (!empty($product_report)) {
            foreach ($product_report as $k => $v) {
                $product_report[$k]['sales_date'] = $CI->occational->dateConvert($product_report[$k]['date']);
                $sub_total = $sub_total + $product_report[$k]['total_price'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $CI->load->model('Categories');
        $category_list = $CI->Categories->category_list_product();
        $data = array(
            'title' => 'Product Wise Sales Report',
            'sub_total' => number_format($sub_total, 2, '.', ','),
            'product_report' => $product_report,
            'links' => $links,
            'category_list' => $category_list,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/product_report', $data, true);
        return $reportList;
    }
    public function odr_manufacturing_costing($start_date, $end_date) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $sales_report = $CI->Reports->odr_manufacturing_costing($start_date, $end_date);
        $sales_amount = 0;
        if (!empty($sales_report)) {
            $i = 0;
            foreach ($sales_report as $k => $v) {
                $i++;
                $sales_report[$k]['sl'] = $i;
                $sales_report[$k]['sales_date'] = $CI->occational->dateConvert($sales_report[$k]['date']);
                $sales_amount = $sales_amount + $sales_report[$k]['total_amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Order Manufacturing Costing',
            'sales_amount' => $sales_amount,
            'sales_report' => $sales_report,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('invoice/odr_manufacturing_costing', $data, true);
        return $reportList;
    }
    public function sales_record($start_date, $end_date) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $sales_record = $CI->Reports->sales_record($start_date, $end_date);
        $sales_amount = 0;
        if (!empty($sales_record)) {
            $i = 0;
            foreach ($sales_record as $k => $v) {
                $i++;
                $sales_record[$k]['sl'] = $i;
                $sales_record[$k]['sales_date'] = $CI->occational->dateConvert($sales_record[$k]['date']);
                $sales_amount = $sales_amount + $sales_record[$k]['total_amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Sales Record',
            'sales_amount' => $sales_amount,
            'sales_record' => $sales_record,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('invoice/sales_record', $data, true);
        return $reportList;
    }
    public function sales_record_report($start_date, $end_date) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $sales_record_report = $CI->Reports->sales_record_report($start_date, $end_date);
        $sales_amount = 0;
        if (!empty($sales_record_report)) {
            $i = 0;
            foreach ($sales_record_report as $k => $v) {
                $i++;
                $sales_record_report[$k]['sl'] = $i;
                $sales_record_report[$k]['sales_date'] = $CI->occational->dateConvert($sales_record_report[$k]['date']);
                $sales_amount = $sales_amount + $sales_record_report[$k]['total_amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Sales Record Report',
            'sales_amount' => $sales_amount,
            'sales_record_report' => $sales_record_report,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/sales_record_report', $data, true);
        return $reportList;
    }
	
    public function odr_manufacturing_report($start_date, $end_date) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $odr_manufacturing_report = $CI->Reports->odr_manufacturing_report($start_date, $end_date);
        $sales_amount = 0;
        if (!empty($odr_manufacturing_report)) {
            $i = 0;
            foreach ($odr_manufacturing_report as $k => $v) {
                $i++;
                $odr_manufacturing_report[$k]['sl'] = $i;
                $odr_manufacturing_report[$k]['sales_date'] = $CI->occational->dateConvert($odr_manufacturing_report[$k]['date']);
                $sales_amount = $sales_amount + $odr_manufacturing_report[$k]['total_amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Order Manufacturing Costing',
            'sales_amount' => $sales_amount,
            'odr_manufacturing_report' => $odr_manufacturing_report,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/odr_manufacturing_report', $data, true);
        return $reportList;
    }
	
    public function profit_sheet($start_date, $end_date) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $profit_sheet = $CI->Reports->profit_sheet($start_date, $end_date);
		//echo "here";die;
        $sales_amount = 0;
        if (!empty($profit_sheet)) {
            $i = 0;
            foreach ($profit_sheet as $k => $v) {
                $i++;
                $profit_sheet[$k]['sl'] = $i;
                $profit_sheet[$k]['sales_date'] = $CI->occational->dateConvert($profit_sheet[$k]['date']);
                $sales_amount = $sales_amount + $profit_sheet[$k]['total_amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Profit Sheet',
            'sales_amount' => $sales_amount,
            'profit_sheet' => $profit_sheet,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/profit_sheet', $data, true);
        return $reportList;
    }
	
    public function manufacturing_cost_report($start_date, $end_date) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $manufacturing_cost_report = $CI->Reports->manufacturing_cost_report($start_date, $end_date);
        $sales_amount = 0;
        if (!empty($manufacturing_cost_report)) {
            $i = 0;
            foreach ($manufacturing_cost_report as $k => $v) {
                $i++;
                $manufacturing_cost_report[$k]['sl'] = $i;
                $manufacturing_cost_report[$k]['sales_date'] = $CI->occational->dateConvert($manufacturing_cost_report[$k]['date']);
                $sales_amount = $sales_amount + $manufacturing_cost_report[$k]['total_amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Sales Record Report',
            'sales_amount' => $sales_amount,
            'manufacturing_cost_report' => $manufacturing_cost_report,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $reportList = $CI->parser->parse('report/manufacturing_cost_report', $data, true);
        return $reportList;
    }
	
    public function purchase_return_report($start_date, $end_date) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $purchase_return_report = $CI->Reports->purchase_return_report($start_date, $end_date);
        $data = array(
            'title' => 'Purchase Return Report',
            'purchase_return_report' => $purchase_return_report,
        );
        $reportList = $CI->parser->parse('report/purchase_return_report', $data, true);
        return $reportList;
    }
	
    public function invoice_return_report($start_date, $end_date) {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $purchase_return_report = $CI->Reports->invoice_return_report($start_date, $end_date);
        $data = array(
            'title' => 'Invoice Return Report',
            'invoice_return_report' => $purchase_return_report,
        );
        $reportList = $CI->parser->parse('report/invoice_return_report', $data, true);
        return $reportList;
    }

}

?>