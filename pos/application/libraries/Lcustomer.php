<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lcustomer {

    //Retrieve  Customer List	
    public function customer_list($links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Customers');
        $CI->load->model('Web_settings');
        $CI->load->model('Userm');
		$permission = $CI->Userm->get_permission("manage_customer");
        $customers_list = $CI->Customers->customer_list($per_page, $page);
        $all_customer_list = $CI->Customers->all_customer_list();
//                echo '<pre>';     print_r($customers_list);die();
        $i = 0;
        $total = 0;
//        if (!empty($customers_list)) {
//            foreach ($customers_list as $k => $v) {
//                $i++;
//                $customers_list[$k]['sl'] = $i;
//                $total += $customers_list[$k]['customer_balance'];
//            }
//        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Customers List',
            'customers_list' => $customers_list,
            'all_customer_list' => $all_customer_list,
            'subtotal' => number_format($total, 2, '.', ','),
            'links' => $links,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
            'edited' => $permission->edited,
            'deleted' => $permission->deleted,
            'created' => $permission->created,
            'view' => $permission->view,
        );
        $customerList = $CI->parser->parse('customer/customer', $data, true);
        return $customerList;
    }

    //Retrieve  Credit Customer List	
    public function credit_customer_list($links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Customers');
        $CI->load->model('Web_settings');
        $CI->load->model('Userm');
		$permission = $CI->Userm->get_permission("credit_customer");
        $customers_list = $CI->Customers->credit_customer_list($per_page, $page);
        $all_credit_customer_list = $CI->Customers->all_credit_customer_list();
//        echo "<pre>";        print_r($all_credit_customer_list);die();

        //It will get only Credit Customers
        $i = 0;
        $total = 0;
        if (!empty($customers_list)) {
            foreach ($customers_list as $k => $v) {
                $i++;
                $customers_list[$k]['sl'] = $i;
                $total += $customers_list[$k]['customer_balance'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Customers List',
            'customers_list' => $customers_list,
            'all_credit_customer_list' => $all_credit_customer_list,
            'subtotal' => number_format($total, 2, '.', ','),
            'links' => $links,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
            'edited' => $permission->edited,
            'deleted' => $permission->deleted,
            'created' => $permission->created,
            'view' => $permission->view,
        );
        $customerList = $CI->parser->parse('customer/credit_customer', $data, true);
        return $customerList;
    }

    //##################  Paid  Customer List  ##########################	
    public function paid_customer_list($links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Customers');
        $CI->load->model('Web_settings');
        $CI->load->model('Userm');
		$permission = $CI->Userm->get_permission("paid_customer");
        $customers_list = $CI->Customers->paid_customer_list($per_page, $page);
        $all_paid_customer_list = $CI->Customers->all_paid_customer_list();
//        echo '<pre>';  echo "S";       print_r($customers_list);die();

        $i = 0;
        $total = 0;
        if (!empty($customers_list)) {
            foreach ($customers_list as $k => $v) {
                $i++;
                $customers_list[$k]['sl'] = $i;
                $total += $customers_list[$k]['customer_balance'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Customers List',
            'customers_list' => $customers_list,
            'all_paid_customer_list' => $all_paid_customer_list,
            'subtotal' => number_format($total, 2, '.', ','),
            'links' => $links,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
            'edited' => $permission->edited,
            'deleted' => $permission->deleted,
            'created' => $permission->created,
            'view' => $permission->view,
        );
        $customerList = $CI->parser->parse('customer/paid_customer', $data, true);
        return $customerList;
    }

    //Retrieve  Customer Search List	
    public function customer_search_item($customer_id) {
        $CI = & get_instance();
        $CI->load->model('Customers');
        $CI->load->model('Web_settings');
        $customers_list = $CI->Customers->customer_search_item($customer_id);
        $all_customer_list = $CI->Customers->all_customer_list();
        $i = 0;
        $total = 0;
        if ($customers_list) {
            foreach ($customers_list as $k => $v) {
                $i++;
                $customers_list[$k]['sl'] = $i;
                $total += $customers_list[$k]['customer_balance'];
            }
            $currency_details = $CI->Web_settings->retrieve_setting_editdata();
            $data = array(
                'title' => 'Customers Search Item',
                'subtotal' => number_format($total, 2, '.', ','),
                'all_customer_list' => $all_customer_list,
                'links' => "",
                'customers_list' => $customers_list,
                'currency' => $currency_details[0]['currency'],
                'position' => $currency_details[0]['currency_position'],
            );
            $customerList = $CI->parser->parse('customer/customer', $data, true);
            return $customerList;
        } else {
            redirect('Ccustomer/manage_customer');
        }
    }

    //Retrieve  Credit Customer Search List	
    public function credit_customer_search_item($customer_id) {
        $CI = & get_instance();
        $CI->load->model('Customers');
        $CI->load->model('Web_settings');
        $customers_list = $CI->Customers->credit_customer_search_item($customer_id);
        $all_credit_customer_list = $CI->Customers->all_credit_customer_list();

        $i = 0;
        $total = 0;
        if ($customers_list) {
            foreach ($customers_list as $k => $v) {
                $i++;
                $customers_list[$k]['sl'] = $i;
                $total += $customers_list[$k]['customer_balance'];
            }
            $currency_details = $CI->Web_settings->retrieve_setting_editdata();
            $data = array(
                'title' => 'Customers Search Item',
                'subtotal' => number_format($total, 2, '.', ','),
                'all_credit_customer_list' => $all_credit_customer_list,
                'links' => "",
                'customers_list' => $customers_list,
                'currency' => $currency_details[0]['currency'],
                'position' => $currency_details[0]['currency_position'],
            );
            $customerList = $CI->parser->parse('customer/credit_customer', $data, true);
            return $customerList;
        } else {
            redirect('Ccustomer/manage_customer');
        }
    }

    //Retrieve  Paid Customer Search List	
    public function paid_customer_search_item($customer_id) {
        $CI = & get_instance();
        $CI->load->model('Customers');
        $CI->load->model('Web_settings');
        $customers_list = $CI->Customers->paid_customer_search_item($customer_id);
        $all_paid_customer_list = $CI->Customers->all_paid_customer_list();
        $i = 0;
        $total = 0;
        if ($customers_list) {
            foreach ($customers_list as $k => $v) {
                $i++;
                $customers_list[$k]['sl'] = $i;
                $total += $customers_list[$k]['customer_balance'];
            }
            $currency_details = $CI->Web_settings->retrieve_setting_editdata();
            $data = array(
                'title' => 'Customers Search Item',
                'subtotal' => number_format($total, 2, '.', ','),
                'all_paid_customer_list' => $all_paid_customer_list,
                'links' => "",
                'customers_list' => $customers_list,
                'currency' => $currency_details[0]['currency'],
                'position' => $currency_details[0]['currency_position'],
            );
            $customerList = $CI->parser->parse('customer/paid_customer', $data, true);
            return $customerList;
        } else {
            redirect('Ccustomer/manage_customer');
        }
    }

    //Sub Category Add
    public function customer_add_form() {
        $CI = & get_instance();
        $CI->load->model('Customers');
        $CI->load->model('Userm');
		$permission = $CI->Userm->get_permission("add_customer");
        $data = array(
            'title' => 'Add Customer',
            'edited' => $permission->edited,
            'deleted' => $permission->deleted,
            'created' => $permission->created,
            'view' => $permission->view,
        );
        $customerForm = $CI->parser->parse('customer/add_customer_form', $data, true);
        return $customerForm;
    }

    public function insert_customer($data) {
        $CI = & get_instance();
        $CI->load->model('Customers');
        $CI->Customers->customer_entry($data);
        return true;
    }

    //Customer Previous Balance Adjustment.
    public function previous_balance_form() {
        $CI = & get_instance();
        $data = array(
            'title' => 'Previous Balance Adjustment'
        );
        $customerForm = $CI->parser->parse('customer/add_customer_pre_balance', $data, true);
        return $customerForm;
    }

    //customer Edit Data
    public function customer_edit_data($customer_id) {
        $CI = & get_instance();
        $CI->load->model('Customers');
        $customer_detail = $CI->Customers->retrieve_customer_editdata($customer_id);
		$country_billing=$customer_detail[0]['country_billing'];
		$country_shipping=$customer_detail[0]['country_shipping'];
		$state_billing=$customer_detail[0]['state_billing'];
		$state_shipping=$customer_detail[0]['state_shipping'];
        $billing_states = $CI->Customers->get_states($country_billing);
        $billing_cities = $CI->Customers->get_cities($state_billing);
        $shipping_states = $CI->Customers->get_states($country_shipping);
        $shipping_cities = $CI->Customers->get_cities($state_shipping);
		//print_r($customer_detail);
        $data = array(
            'customer_id' => $customer_detail[0]['customer_id'],
            'salutation' => $customer_detail[0]['salutation'],
            'customer_name' => $customer_detail[0]['customer_name'],
            'company' => $customer_detail[0]['company'],
            'customer_address' => $customer_detail[0]['customer_address'],
            'bill' => $customer_detail[0]['bill'],
            'delivery' => $customer_detail[0]['delivery'],
            'customer_mobile' => $customer_detail[0]['customer_mobile'],
            'customer_email' => $customer_detail[0]['customer_email'],
            'gst_no' => $customer_detail[0]['gst_no'],
            'state_code' => $customer_detail[0]['state_code'],
            'website' => $customer_detail[0]['website'],
            'facebook' => $customer_detail[0]['facebook'],
            'twitter' => $customer_detail[0]['twitter'],
            'attention_billing' => $customer_detail[0]['attention_billing'],
            'attention_shipping' => $customer_detail[0]['attention_shipping'],
            'billing_zip_code' => $customer_detail[0]['billing_zip_code'],
            'shipping_zip_code' => $customer_detail[0]['shipping_zip_code'],
            'billing_fax' => $customer_detail[0]['billing_fax'],
            'shipping_fax' => $customer_detail[0]['shipping_fax'],
            'country_billing' => $customer_detail[0]['country_billing'],
            'country_shipping' => $customer_detail[0]['country_shipping'],
            'state_billing' => $customer_detail[0]['state_billing'],
            'state_shipping' => $customer_detail[0]['state_shipping'],
            'city_billing' => $customer_detail[0]['city_billing'],
            'city_shipping' => $customer_detail[0]['city_shipping'],
            'status' => $customer_detail[0]['status'],
            'billing_states' => $billing_states,
            'shipping_states' => $shipping_states,
            'billing_cities' => $billing_cities,
            'shipping_cities' => $shipping_cities
        );
        $chapterList = $CI->parser->parse('customer/edit_customer_form', $data, true);
        return $chapterList;
    }

    //Customer ledger Data
    public function customer_ledger_data($customer_id) {
        $CI = & get_instance();
        $CI->load->model('Customers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $customer_detail = $CI->Customers->customer_personal_data($customer_id);
        $invoice_info = $CI->Customers->customer_invoice_data($customer_id);
        $invoice_amount = 0;
        if (!empty($invoice_info)) {
            foreach ($invoice_info as $k => $v) {
                $invoice_info[$k]['final_date'] = $CI->occational->dateConvert($invoice_info[$k]['date']);
                $invoice_amount = $invoice_amount + $invoice_info[$k]['amount'];
            }
        }
        $receipt_info = $CI->Customers->customer_receipt_data($customer_id);
        $receipt_amount = 0;
        if (!empty($receipt_info)) {
            foreach ($receipt_info as $k => $v) {
                $receipt_info[$k]['final_date'] = $CI->occational->dateConvert($receipt_info[$k]['date']);
                $receipt_amount = $receipt_amount + $receipt_info[$k]['amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'customer_id' => $customer_detail[0]['customer_id'],
            'customer_name' => $customer_detail[0]['customer_name'],
            'customer_address' => $customer_detail[0]['customer_address'],
            'bill' => $customer_detail[0]['bill'],
            'delivery' => $customer_detail[0]['delivery'],
            'customer_mobile' => $customer_detail[0]['customer_mobile'],
            'customer_email' => $customer_detail[0]['customer_email'],
            'receipt_amount' => number_format($receipt_amount, 2, '.', ','),
            'invoice_amount' => $invoice_amount,
            'invoice_info' => $invoice_info,
            'receipt_info' => $receipt_info,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
        $chapterList = $CI->parser->parse('customer/customer_details', $data, true);
        return $chapterList;
    }

    //Customer ledger Data
    public function customerledger_data($customer_id) {
        $CI = & get_instance();
        $CI->load->model('Customers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $customer_detail = $CI->Customers->customer_personal_data($customer_id);
        $ledger = $CI->Customers->customerledger_tradational($customer_id);
        $summary = $CI->Customers->customer_transection_summary($customer_id);
//                echo '<pre>';                print_r($ledger);die();
        $balance = 0;
        if (!empty($ledger)) {
            foreach ($ledger as $index => $value) {
                $ledger[$index]['final_date'] = $CI->occational->dateConvert($ledger[$index]['date']);

                if (!empty($ledger[$index]['invoice_no'])or $ledger[$index]['invoice_no'] == "NA") {
                    $ledger[$index]['credit'] = $ledger[$index]['amount'];
                    $ledger[$index]['balance'] = $balance + $ledger[$index]['amount'];
                    $ledger[$index]['debit'] = "";
                    $balance = $ledger[$index]['balance'];
                } else {
                    $ledger[$index]['debit'] = $ledger[$index]['amount'];
                    $ledger[$index]['balance'] = $balance - $ledger[$index]['amount'];
                    $ledger[$index]['credit'] = "";
                    $balance = $ledger[$index]['balance'];
                }
            }
        }

        $company_info = $CI->Customers->retrieve_company();
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'customer_id' => $customer_detail[0]['customer_id'],
            'customer_name' => $customer_detail[0]['customer_name'],
            'customer_address' => $customer_detail[0]['customer_address'],
            'bill' => $customer_detail[0]['bill'],
            'delivery' => $customer_detail[0]['delivery'],
            'customer_mobile' => $customer_detail[0]['customer_mobile'],
            'customer_email' => $customer_detail[0]['customer_email'],
            'ledgers' => $ledger,
            'total_credit' => number_format($summary[0][0]['total_credit'], 2, '.', ','),
            'total_debit' => number_format($summary[1][0]['total_debit'], 2, '.', ','),
            'total_balance' => number_format(-$summary[1][0]['total_debit'] + $summary[0][0]['total_credit'], 2, '.', ','),
            'company_info' => $company_info,
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
        );
//        echo '<pre>';        print_r($data);die();
        $singlecustomerdetails = $CI->parser->parse('customer/customer_ledger', $data, true);
        return $singlecustomerdetails;
    }

    //Search customer
    public function customer_search_list($cat_id, $company_id) {
        $CI = & get_instance();
        $CI->load->model('Customers');
        $category_list = $CI->Customers->retrieve_category_list();
        $customers_list = $CI->Customers->customer_search_list($cat_id, $company_id);
        $data = array(
            'title' => 'customers List',
            'customers_list' => $customers_list,
            'category_list' => $category_list
        );
        $customerList = $CI->parser->parse('customer/customer', $data, true);
        return $customerList;
    }

}

?>