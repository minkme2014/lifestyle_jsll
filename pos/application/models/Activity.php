<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Activity extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //get customers
    public function get_customers()
    {
        return $this->db->get("customer_information")->result_array();
    }
    
    //add activity
    public function insert_activity($data)
    {
        return $this->db->insert('customer_activity',$data);
    }
    
    //activity List
    public function activity_list($per_page, $page) {
        $this->db->select('*');
        $this->db->from('customer_activity ca');
        $this->db->join('customer_information ci', 'ca.customer_id = ci.customer_id','left');
        $this->db->order_by('ca.act_created_at', 'desc');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // Delete activity
    public function delete_activity($act_id) {
        $this->db->where('act_id', $act_id);
        $this->db->delete('customer_activity');
        return true;
    }

    //activity List
    public function activity_list_count() {
        $this->db->select('*');
        $this->db->from('customer_activity ca');
        $this->db->join('customer_information ci', 'ca.customer_id = ci.customer_id','left');
        $this->db->order_by('ca.act_created_at', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
    
    //Retrieve activity Edit Data
    public function retrieve_activity_editdata($act_id) {
        $this->db->select('*');
        $this->db->from('customer_activity');
        $this->db->where('act_id', $act_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    //Update activity
    public function update_activity($data, $act_id) {
        $this->db->where('act_id', $act_id);
        $this->db->update('customer_activity', $data);
        return true;
    }
    //customer List
    public function customer_list_count() {
        $this->db->select('customer_information.*,sum(customer_transection_summary.amount) as customer_balance');
        $this->db->from('customer_information');
        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');
        $this->db->group_by('customer_transection_summary.customer_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    //all customer List
    public function all_customer_list() {
        $this->db->select('customer_information.*,sum(customer_transection_summary.amount) as customer_balance');
        $this->db->from('customer_information');
        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');
        $this->db->group_by('customer_transection_summary.customer_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Credit customer List
    public function credit_customer_list($per_page, $page) {
         $this->db->select('customer_information.*,
			sum(customer_transection_summary.amount) as customer_balance
			');
        $this->db->from('customer_information');
        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');
        //$this->db->where('customer_information.status',2);
        $this->db->group_by('customer_transection_summary.customer_id');
        $this->db->having('customer_balance < 0', NULL, FALSE);
        $this->db->limit($per_page, $page);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //All Credit customer List
    public function all_credit_customer_list() {
        $this->db->select('customer_information.*,
			CAST(sum(customer_transection_summary.amount) AS DECIMAL(16,2)) as customer_balance
			');
        $this->db->from('customer_information');
        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');
//        $this->db->where('customer_information.status', 2);
        $this->db->group_by('customer_transection_summary.customer_id');
        $this->db->having('customer_balance != 0', NULL, FALSE);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Credit customer List
    public function credit_customer_list_count() {
        $this->db->select('customer_information.*,sum(customer_transection_summary.amount) as customer_balance');
        $this->db->from('customer_information');
        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');
        $this->db->where('customer_information.status', 2);
        $this->db->group_by('customer_transection_summary.customer_id');
        $this->db->having('customer_balance != 0', NULL, FALSE);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    //Paid Customer list
    public function paid_customer_list($per_page = null, $page = null) {
        $this->db->select('customer_information.*,
			sum(customer_transection_summary.amount) as customer_balance
			');
        $this->db->from('customer_information');
        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');
        //$this->db->where('customer_information.status',1);
        $this->db->having('customer_balance >= 0', NULL, FALSE);
        $this->db->group_by('customer_transection_summary.customer_id');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;

    }

    //All Paid Customer list
    public function all_paid_customer_list() {
        $this->db->select('customer_information.*,sum(customer_transection_summary.amount) as customer_balance');
        $this->db->from('customer_information');
        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');
        $this->db->where('customer_information.status', 1);
        $this->db->group_by('customer_transection_summary.customer_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Paid Customer list
    public function paid_customer_list_count() {
        $this->db->select('customer_information.*,sum(customer_transection_summary.amount) as customer_balance');
        $this->db->from('customer_information');
        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');
        $this->db->where('customer_information.status', 1);
        $this->db->where('customer_transection_summary.amount >', 0);
        $this->db->group_by('customer_transection_summary.customer_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    //Customer Search List
    public function customer_search_item($customer_id) {

        $this->db->select('customer_information.*,
			CAST(sum(customer_transection_summary.amount) AS DECIMAL(16,2)) as customer_balance');
        $this->db->from('customer_information');
        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');
        $this->db->where('customer_information.customer_id', $customer_id);
        $this->db->group_by('customer_transection_summary.customer_id');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Credit Customer Search List
    public function credit_customer_search_item($customer_id) {

        $this->db->select('customer_information.*,
			CAST(sum(customer_transection_summary.amount) AS DECIMAL(16,2)) as customer_balance
			');
        $this->db->from('customer_information');
        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');
        $this->db->where('customer_information.status', 2);
        $this->db->group_by('customer_transection_summary.customer_id');
        $this->db->where('customer_information.customer_id', $customer_id);
        $this->db->having('customer_balance != 0', NULL, FALSE);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            $this->session->set_userdata(array('error_message' => display('this_is_not_credit_customer')));
            redirect('Ccustomer/credit_customer');
        }
    }

    //Paid Customer Search List
    public function paid_customer_search_item($customer_id) {

        $this->db->select('customer_information.*,CAST(sum(customer_transection_summary.amount) AS DECIMAL(16,2)) as customer_balance');
        $this->db->from('customer_information');
        $this->db->join('customer_transection_summary', 'customer_transection_summary.customer_id= customer_information.customer_id');
        $this->db->where('customer_information.status', 1);
        $this->db->where('customer_information.customer_id', $customer_id);
        $this->db->group_by('customer_transection_summary.customer_id');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Count customer
    public function customer_entry($data) {

        $this->db->select('*');
        $this->db->from('customer_information');
        $this->db->where('customer_mobile', $data['customer_mobile']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            $this->db->insert('customer_information', $data);

            $this->db->select('*');
            $this->db->from('customer_information');
            $query = $this->db->get();
            foreach ($query->result() as $row) {
                $json_customer[] = array('label' => $row->customer_name, 'value' => $row->customer_id);
            }
            $cache_file = './my-assets/js/admin_js/json/customer'.$_COOKIE['dbid'].'.json';
            $customerList = json_encode($json_customer);
            file_put_contents($cache_file, $customerList);
            return TRUE;
        }
    }

    //Customer Previous balance adjustment
    public function previous_balance_add($balance, $customer_id) {
        $this->load->library('auth');
        $transaction_id = $this->auth->generator(10);
        $data = array(
            'transaction_id' => $transaction_id,
            'customer_id' => $customer_id,
            'invoice_no' => "NA",
            'receipt_no' => NULL,
            'amount' => $balance,
            'description' => "Previous adjustment with software",
            'payment_type' => "NA",
            'cheque_no' => "NA",
            'date' => date("d-m-Y"),
            'status' => 1,
            'd_c' => "d"
        );

        $this->db->insert('customer_ledger', $data);
    }

    //Retrieve company Edit Data
    public function retrieve_company() {
        $this->db->select('*');
        $this->db->from('company_information');
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve customer Edit Data
    public function retrieve_customer_editdata($customer_id) {
        $this->db->select('*');
        $this->db->from('customer_information');
        $this->db->where('customer_id', $customer_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve customer Personal Data 
    public function customer_personal_data($customer_id) {
        $this->db->select('*');
        $this->db->from('customer_information');
        $this->db->where('customer_id', $customer_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve customer Invoice Data 
    public function customer_invoice_data($customer_id) {
        $this->db->select('*');
        $this->db->from('customer_ledger');
        $this->db->where(array('customer_id' => $customer_id, 'receipt_no' => NULL, 'status' => 1));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve customer Receipt Data 
    public function customer_receipt_data($customer_id) {
        $this->db->select('*');
        $this->db->from('customer_ledger');
        $this->db->where(array('customer_id' => $customer_id, 'invoice_no' => NULL, 'status' => 1));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

//Retrieve customer All data 
    public function customerledger_tradational($customer_id) {
        $query = $this->db->select('*')
                ->from('customer_ledger cl')
                ->join('customer_information ci', 'ci.customer_id = cl.customer_id')
//                ->join('product_purchase pp', 'pp.chalan_no = sl.chalan_no')
                ->where('cl.customer_id', $customer_id)
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

    }

//Retrieve customer total information
    public function customer_transection_summary($customer_id) {
        $result = array();

        $this->db->select('sum(amount) as total_credit');
        $this->db->from('customer_ledger');
        $this->db->where('customer_id', $customer_id);
        $this->db->where('receipt_no', NULL);
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result[] = $query->result_array();
        }


        $this->db->select('sum(amount) as total_debit');
        $this->db->from('customer_ledger');
        $this->db->where('customer_id', $customer_id);
        $this->db->where('invoice_no', NULL);
        $this->db->where('status', 1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result[] = $query->result_array();
        }
        return $result;
    }

    //Update Categories
    public function update_customer($data, $customer_id) {
        $this->db->where('customer_id', $customer_id);
        $this->db->update('customer_information', $data);


        $this->db->select('*');
        $this->db->from('customer_information');
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $json_customer[] = array('label' => $row->customer_name, 'value' => $row->customer_id);
        }
        $cache_file = './my-assets/js/admin_js/json/customer'.$_COOKIE['dbid'].'.json';
        $customerList = json_encode($json_customer);
        file_put_contents($cache_file, $customerList);
        return true;
    }

// custromer transection delete
    public function delete_transection($customer_id) {
        $this->db->where('relation_id', $customer_id);
        $this->db->delete('transection');
    }

    // custromer invoicedetails delete
    public function delete_invoicedetails($customer_id) {
        $this->db->where('customer_id', $customer_id);
        $this->db->delete('invoice_details');
    }

    // custromer invoice delete
    public function delete_invoic($customer_id) {
        $this->db->where('customer_id', $customer_id);
        $this->db->delete('invoice');
    }

    // delete customer ledger 
    public function delete_customer_ledger($customer_id) {
        $this->db->where('customer_id', $customer_id);
        $this->db->delete('customer_ledger');
    }

    // Delete customer Item
    public function delete_customer($customer_id) {
        $this->db->where('customer_id', $customer_id);
        $this->db->delete('customer_information');

        $this->db->select('*');
        $this->db->from('customer_information');
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $json_customer[] = array('label' => $row->customer_name, 'value' => $row->customer_id);
        }
        $cache_file = './my-assets/js/admin_js/json/customer'.$_COOKIE['dbid'].'.json';
        $customerList = json_encode($json_customer);
        file_put_contents($cache_file, $customerList);
        return true;
    }

    public function customer_search_list($cat_id, $company_id) {
        $this->db->select('a.*,b.sub_category_name,c.category_name');
        $this->db->from('customers a');
        $this->db->join('customer_sub_category b', 'b.sub_category_id = a.sub_category_id');
        $this->db->join('customer_category c', 'c.category_id = b.category_id');
        $this->db->where('a.sister_company_id', $company_id);
        $this->db->where('c.category_id', $cat_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

}
