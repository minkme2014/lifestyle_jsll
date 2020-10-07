<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lsalesorder {

    //salesorder add form
   
    public function salesorder_add_form() {
        $CI = & get_instance();
        $CI->load->model('Salesorder');
        $sales_person= $CI->Salesorder->get_sales_persons();
        $CI->load->model('Userm');
		$permission = $CI->Userm->get_permission("add_sales_odr");
        $s_odr_no = $CI->Salesorder->get_sales_odr_no();
        $data = array(
            'title' => 'Add Sales Order',
            'sales_person'=>$sales_person,
            'edited' => $permission->edited,
            'deleted' => $permission->deleted,
            'created' => $permission->created,
            'view' => $permission->view,
            'odr_no'=>$s_odr_no,
        );
        $invoiceForm = $CI->parser->parse('salesorder/add_salesorder_form', $data, true);
        return $invoiceForm;
    }
	
    //Retrieve  Invoice List
    public function sales_odr_list($links, $perpage, $page) {

        $CI = & get_instance();
        $CI->load->model('Salesorder');
        $CI->load->model('Userm');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');

        $sales_odr_list = $CI->Salesorder->sales_odr_list($perpage, $page);
        if (!empty($sales_odr_list)) {
            foreach ($sales_odr_list as $k => $v) {
                $sales_odr_list[$k]['final_date'] = $CI->occational->dateConvert($sales_odr_list[$k]['date']);
            }
            $i = 0;
            foreach ($sales_odr_list as $k => $v) {
                $i++;
                $sales_odr_list[$k]['sl'] = $i;
            }
        }
		$permission = $CI->Userm->get_permission("manage_invoice");
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Sales order List',
            'sales_odr_list' => $sales_odr_list,
            'links' => $links,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
            'edited' => $permission->edited,
            'deleted' => $permission->deleted,
            'created' => $permission->created,
            'view' => $permission->view,
			
        );
        $invoiceList = $CI->parser->parse('salesorder/salesorder', $data, true);
        return $invoiceList;
    }

    //invoice html Data
    public function salesorder_html_data($odr_id) {
        $CI = & get_instance();
        $CI->load->model('Salesorder');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $salesorder_detail = $CI->Salesorder->retrieve_salesorder_html_data($odr_id);
        $subTotal_quantity = 0;
        $subTotal_cartoon = 0;
        $subTotal_discount = 0;
        $subTotal_ammount = 0;
        if (!empty($salesorder_detail)) {
            foreach ($salesorder_detail as $k => $v) {
                $salesorder_detail[$k]['final_date'] = $CI->occational->dateConvert($salesorder_detail[$k]['date']);

                $salesorder_detail[$k]['per_cartoon'] = $salesorder_detail[$k]['quantity'] / $salesorder_detail[$k]['cartoon'];

                $subTotal_quantity = $subTotal_quantity + $salesorder_detail[$k]['quantity'];

                $subTotal_ammount = $subTotal_ammount + $salesorder_detail[$k]['total_price'];

                $subTotal_cartoon = $subTotal_cartoon + $salesorder_detail[$k]['cartoon'];
            }

            $i = 0;
            foreach ($salesorder_detail as $k => $v) {
                $i++;
                $salesorder_detail[$k]['sl'] = $i;
            }
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $company_info = $CI->Salesorder->retrieve_company();
		//print_r($salesorder_detail);
        $data = array(
            'ttile' => "Salesorder View",
            'odr_id' => $salesorder_detail[0]['odr_id'],
            'odr_no' => $salesorder_detail[0]['odr_no'],
            'customer_name' => $salesorder_detail[0]['customer_name'],
            'customer_address' => $salesorder_detail[0]['customer_address'],
            'customer_mobile' => $salesorder_detail[0]['customer_mobile'],
            'customer_email' => $salesorder_detail[0]['customer_email'],
            'final_date' => $salesorder_detail[0]['final_date'],
           // 'total_amount' => number_format($salesorder_detail[0]['total_amount'], 2, '.', ','),
            'total_amount' => $salesorder_detail[0]['total_amount'],
            'subTotal_cartoon' => $subTotal_cartoon,
            'subTotal_quantity' => $subTotal_quantity,
            'total_discount' => number_format($salesorder_detail[0]['total_discount'], 2, '.', ','),
            'subTotal_ammount' => number_format($subTotal_ammount, 2, '.', ','),
            'tax' => number_format($salesorder_detail[0]['total_tax'], 2, '.', ','),
            'paid_amount' => number_format($salesorder_detail[0]['paid_amount'], 2, '.', ','),
            'due_amount' => number_format($salesorder_detail[0]['due_amount'], 2, '.', ','),
            'odr_all_data' => $salesorder_detail,
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
            'gst_no' => $salesorder_detail[0]['gst_no'],
            'state_code' => $salesorder_detail[0]['state_code'],
        );

        $chapterList = $CI->parser->parse('salesorder/salesorder_html', $data, true);
        return $chapterList;
    }
	
}

?>