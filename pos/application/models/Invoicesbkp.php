<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoices extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('auth');
        $this->load->library('lcustomer');
        $this->load->library('session');
        $this->load->model('Customers');
        $this->auth->check_admin_auth();
    }

    //Count invoice
    public function count_invoice() {
        return $this->db->count_all("invoice");
    }

    //invoice List
    public function invoice_list($perpage, $page) {
        $this->db->select('a.*,b.customer_name');
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->order_by('a.invoice', 'desc');
        $this->db->limit($perpage, $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //invoice List
    public function invoice_list_count() {
        $this->db->select('a.*,b.customer_name');
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->order_by('a.invoice', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    //invoice Search Item
    public function search_inovoice_item($customer_id) {
        $this->db->select('a.*,b.customer_name');
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->where('b.customer_id', $customer_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //POS invoice entry
    public function pos_invoice_setup($product_id) {
        $product_information = $this->db->select('*')
                ->from('product_information')
                ->where('product_id', $product_id)
                ->get()
                ->row();

        if ($product_information != null) {

            $this->db->select('SUM(a.quantity) as total_purchase');
            $this->db->from('product_purchase_details a');
            $this->db->where('a.product_id', $product_id);
            $total_purchase = $this->db->get()->row();

            $this->db->select('SUM(b.quantity) as total_sale');
            $this->db->from('invoice_details b');
            $this->db->where('b.product_id', $product_id);
            $total_sale = $this->db->get()->row();

            $available_quantity = ($total_purchase->total_purchase - $total_sale->total_sale) / $product_information->cartoon_quantity;

            $data2 = (object) array(
                        'total_product' => $available_quantity,
                        'supplier_price' => $product_information->supplier_price,
                        'price' => $product_information->price,
                        'supplier_id' => $product_information->supplier_id,
                        'tax' => $product_information->tax,
                        'product_id' => $product_information->product_id,
                        'product_name' => $product_information->product_name,
                        'product_model' => $product_information->product_model,
                        'cartoon_quantity' => $product_information->cartoon_quantity,
            );

            return $data2;
        } else {
            return false;
        }
    }
    

    //POS customer setup
    public function pos_customer_setup() {
        $query = $this->db->select('*')
                ->from('customer_information')
                ->where('customer_name', 'Walking Customer')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Count invoice
    public function invoice_entry() {

        $transection_id = $this->auth->generator(15);

        $invoice_id = $this->generator(10);
        $invoice_id = strtoupper($invoice_id);

        $quantity = $this->input->post('product_quantity');
        $available_quantity = $this->input->post('available_quantity');
        $cartoon = $this->input->post('cartoon');

        $result = array();
        foreach ($available_quantity as $k => $v) {
            if ($v < $cartoon[$k]) {
                $this->session->set_userdata(array('error_message' => display('you_can_not_buy_greater_than_available_cartoon')));
                redirect('Cinvoice');
            }
        }


        $product_id = $this->input->post('product_id');
        if ($product_id == null) {
            $this->session->set_userdata(array('error_message' => display('please_select_product')));
            redirect('Cinvoice/pos_invoice');
        }

        if (($this->input->post('customer_name_others') == null) && ($this->input->post('customer_id') == null ) && ($this->input->post('customer_name') == null )) {
            $this->session->set_userdata(array('error_message' => display('please_select_customer')));
            redirect(base_url() . 'Cinvoice');
        }


        if (($this->input->post('customer_id') == null ) && ($this->input->post('customer_name') == null )) {
            $customer_id = $this->auth->generator(15);
            //Customer  basic information adding.
            $data = array(
                'customer_id' => $customer_id,
                'customer_name' => $this->input->post('customer_name_others'),
                'customer_address' => $this->input->post('customer_name_others_address'),
                'customer_mobile' => "",
                'customer_email' => "",
                'status' => 2
            );


            $this->db->insert('customer_information', $data);



            //Previous balance adding -> Sending to customer model to adjust the data.
            $this->Customers->previous_balance_add(0, $customer_id);
        } else {
            $customer_id = $this->input->post('customer_id');
        }


        //Full or partial Payment record.
        $paid_amount = $this->input->post('paid_amount');
        if ($this->input->post('paid_amount') > 0) {

            $this->db->set('status', '1');
            $this->db->where('customer_id', $customer_id);

            $this->db->update('customer_information');


            //Insert to customer_ledger Table 
            //$customer_id=$this->auth->generator(15);
            $data2 = array(
                'transaction_id' => $transection_id,
                'invoice_no' => null,
                'customer_id' => $customer_id,
                'receipt_no' => $this->auth->generator(10),
                'date' => $this->input->post('invoice_date'),
                'amount' => $this->input->post('paid_amount'),
                'payment_type' => 1,
                'description' => 'Cash Paid By Customer',
                'status' => 1,
                'd_c' => 'c'
            );


            $this->db->insert('customer_ledger', $data2);
            // Account table info
            //$customer_id=$this->input->post('customer_id');
            $data3 = array(
                'transaction_id' => $transection_id,
                'relation_id' => $customer_id,
                'transection_type' => 2,
                'date_of_transection' => $this->input->post('invoice_date'),
                'transection_category' => 2,
                'amount' => $this->input->post('paid_amount'),
                'transection_mood' => 1,
                'description' => 'Cash Paid By Customer'
            );

            $this->db->insert('transection', $data3);


            // Inserting for Accounts adjustment.
            ############ default table :: customer_payment :: inflow_92mizdldrv #################
            //Insert to customer_ledger Table 
            $account_table = "inflow_92mizdldrv";
            //$customer_id=$this->input->post('customer_id');
            $account_adjustment = array(
                'transection_id' => $transection_id,
                'tracing_id' => $customer_id,
                'date' => $this->input->post('invoice_date'),
                'amount' => $this->input->post('paid_amount'),
                'payment_type' => 1,
                'description' => 'ITP',
                'status' => 1
            );
            $this->db->insert($account_table, $account_adjustment);
        }
        //$customer_id=$this->input->post('customer_id');
        //Data inserting into invoice table
        $datainv = array(
            'invoice_id' => $invoice_id,
            'customer_id' => $customer_id,
            'date' => $this->input->post('invoice_date'),
            'total_amount' => $this->input->post('grand_total_price'),
            'invoice' => $this->number_generator(),
            'total_discount' => $this->input->post('total_discount'),
            'status' => 1
        );

        $this->db->insert('invoice', $datainv);


        //Insert to customer_ledger Table 
        $datacre = array(
            'transaction_id' => $transection_id,
            'invoice_no' => $invoice_id,
            'customer_id' => $customer_id,
            'receipt_no' => NULL,
            'date' => $this->input->post('invoice_date'),
            'amount' => $this->input->post('grand_total_price'),
            'status' => 1,
            'd_c' => 'd'
        );
        $this->db->insert('customer_ledger', $datacre);


        $rate = $this->input->post('product_rate');
        $p_id = $this->input->post('product_id');
        $total_amount = $this->input->post('total_price');
        $discount_rate = $this->input->post('discount');


        for ($i = 0, $n = count($quantity); $i < $n; $i++) {
            $cartoon_quantity = $cartoon[$i];
            $product_quantity = $quantity[$i];
            $product_rate = $rate[$i];
            $product_id = $p_id[$i];
            $total_price = $total_amount[$i];
            $supplier_rate = $this->supplier_rate($product_id);
            $discount = $discount_rate[$i];

            $data1 = array(
                'invoice_details_id' => $this->generator(15),
                'invoice_id' => $invoice_id,
                'product_id' => $product_id,
                'cartoon' => $cartoon_quantity,
                'quantity' => $product_quantity,
                'rate' => $product_rate,
                'tax' => $this->input->post('total_tax'),
                'discount' => $discount,
                'paid_amount' => $this->input->post('paid_amount'),
                'due_amount' => $this->input->post('due_amount'),
                'supplier_rate' => $supplier_rate[0]['supplier_price'],
                'total_price' => $total_price,
                'status' => 1
            );

            if (!empty($quantity)) {
                $this->db->insert('invoice_details', $data1);
            }
        }
        return $invoice_id;
    }

    //Get Supplier rate of a product
    public function supplier_rate($product_id) {
        $this->db->select('supplier_price');
        $this->db->from('product_information');
        $this->db->where(array('product_id' => $product_id));
        $query = $this->db->get();
        return $query->result_array();
    }

    //Retrieve invoice Edit Data
    public function retrieve_invoice_editdata($invoice_id) {
        $this->db->select('a.*,b.customer_name,c.*,c.tax as total_tax,c.product_id,d.product_name,d.product_model,d.tax');
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->join('invoice_details c', 'c.invoice_id = a.invoice_id');
        $this->db->join('product_information d', 'd.product_id = c.product_id');
        $this->db->where('a.invoice_id', $invoice_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //update_invoice
    public function update_invoice() {
        $invoice_id = $this->input->post('invoice_id');
        $supplier_ledger = $this->db->select('*')->from('customer_ledger')->where('invoice_no', $invoice_id)->get()->result();
        $transection_id = $this->auth->generator(15);
        foreach ($supplier_ledger as $value) {
            $transaction_id = $value->transaction_id;

            $this->db->where('transaction_id', $transaction_id)
                    ->delete('transection');

            $this->db->where('invoice_no', $invoice_id)
                    ->delete('customer_ledger');
        }


        $data = array(
            'customer_id' => $this->input->post('customer_id'),
            'date' => $this->input->post('invoice_date'),
            'total_amount' => $this->input->post('grand_total_price'),
            'total_discount' => $this->input->post('total_discount'),
        );

        $data3 = array(
            'transaction_id' => $transection_id,
            'invoice_no' => null,
            'customer_id' => $this->input->post('customer_id'),
            'receipt_no' => $this->auth->generator(10),
            'date' => $this->input->post('invoice_date'),
            'amount' => $this->input->post('paid_amount'),
            'payment_type' => 1,
            'description' => 'Cash Paid By Customer',
            'status' => 1,
            'd_c' => 'c'
        );


        $this->db->insert('customer_ledger', $data3);
        // Account table info
        //$customer_id=$this->input->post('customer_id');
        $data4 = array(
            'transaction_id' => $transection_id,
            'relation_id' => $this->input->post('customer_id'),
            'transection_type' => 2,
            'date_of_transection' => $this->input->post('invoice_date'),
            'transection_category' => 2,
            'amount' => $this->input->post('paid_amount'),
            'transection_mood' => 1,
            'description' => 'Cash Paid By Customer'
        );

        $this->db->insert('transection', $data4);
        $datacre = array(
            'transaction_id' => $transection_id,
            'invoice_no' => $invoice_id,
            'customer_id' => $this->input->post('customer_id'),
            'receipt_no' => NULL,
            'date' => $this->input->post('invoice_date'),
            'amount' => $this->input->post('grand_total_price'),
            'status' => 1,
            'd_c' => 'd'
        );
        $this->db->insert('customer_ledger', $datacre);

        if ($invoice_id != '') {
            $this->db->where('invoice_id', $invoice_id);
            $this->db->update('invoice', $data);

            //Update Another table
            // $this->db->where('invoice_no',$invoice_id);
            // $this->db->update('customer_ledger',$data2); 
            //|Transaction update
            // $this->db->where('transection',$invoice_id);
            // $this->db->update('customer_ledger',$data2); 
        }

        $invoice_d_id = $this->input->post('invoice_details_id');
        $rate = $this->input->post('product_rate');
        $p_id = $this->input->post('product_id');
        $invoice_id = $this->input->post('invoice_id');
        $quantity = $this->input->post('product_quantity');
        $total_amount = $this->input->post('total_price');
        $discount_rate = $this->input->post('discount');

        $cartoon = $this->input->post('cartoon');
        $quantity = $this->input->post('product_quantity');

        for ($i = 0, $n = count($invoice_d_id); $i < $n; $i++) {
            $product_quantity = $quantity[$i];

            $cartoon_quantity = $cartoon[$i];

            $product_rate = $rate[$i];
            $product_id = $p_id[$i];
            $invoice_detail_id = $invoice_d_id[$i];
            $total_price = $total_amount[$i];
            $discount = $discount_rate[$i];

            $data1 = array(
                'invoice_id' => $invoice_id,
                'product_id' => $product_id,
                'cartoon' => $cartoon_quantity,
                'quantity' => $product_quantity,
                'rate' => $product_rate,
                'discount' => $discount,
                'total_price' => $total_price,
                'tax' => $this->input->post('total_tax'),
                'paid_amount' => $this->input->post('paid_amount'),
                'due_amount' => $this->input->post('due_amount'),
            );
            if (!empty($quantity)) {
                $this->db->where('invoice_details_id', $invoice_detail_id);
                $this->db->update('invoice_details', $data1);
            }
        }
        return $invoice_id;
    }

    //Retrieve invoice_html_data
    public function retrieve_invoice_html_data($invoice_id) {
        $this->db->select('
						a.*,
						b.*,
						c.*,
						d.product_id,
						d.product_name,
						d.product_details,
						d.product_model
					');
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->join('invoice_details c', 'c.invoice_id = a.invoice_id');
        $this->db->join('product_information d', 'd.product_id = c.product_id');
        $this->db->where('a.invoice_id', $invoice_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // Delete invoice Item
    public function retrieve_product_data($product_id) {
        $this->db->select('supplier_price,price,supplier_id,tax');
        $this->db->from('product_information');
        $this->db->where(array('product_id' => $product_id, 'status' => 1));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
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

    // websetting  web logo for payslip
    public function retript_web_logo() {
        $this->db->select('*');
        $this->db->from('web_setting');
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // Delete invoice Item
    public function delete_invoice($invoice_id) {


        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('invoice');
        //Delete invoice_details table
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('invoice_details');
        //Delete customer ledger table
        $this->db->where('invoice_no', $invoice_id);
        $this->db->delete('customer_ledger');





        return true;
    }

    public function invoice_search_list($cat_id, $company_id) {
        $this->db->select('a.*,b.sub_category_name,c.category_name');
        $this->db->from('invoices a');
        $this->db->join('invoice_sub_category b', 'b.sub_category_id = a.sub_category_id');
        $this->db->join('invoice_category c', 'c.category_id = b.category_id');
        $this->db->where('a.sister_company_id', $company_id);
        $this->db->where('c.category_id', $cat_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // GET TOTAL PURCHASE PRODUCT
    public function get_total_purchase_item($product_id) {
        $this->db->select('SUM(quantity) as total_purchase');
        $this->db->from('product_purchase_details');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // GET TOTAL SALES PRODUCT
    public function get_total_sales_item($product_id) {
        $this->db->select('SUM(quantity) as total_sale');
        $this->db->from('invoice_details');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    
    //POS invoice entry from pos barcode
    public function pos_invoice_setup_product_code($product_code) {
        $product_information = $this->db->select('*')
                ->from('product_information')
                ->where('product_code', $product_code)
                ->get()
                ->row();

        if ($product_information != null) {

            $this->db->select('SUM(a.quantity) as total_purchase');
            $this->db->from('product_purchase_details a');
            $this->db->where('a.product_id', $product_id);
            $total_purchase = $this->db->get()->row();

            $this->db->select('SUM(b.quantity) as total_sale');
            $this->db->from('invoice_details b');
            $this->db->where('b.product_id', $product_id);
            $total_sale = $this->db->get()->row();

            $available_quantity = ($total_purchase->total_purchase - $total_sale->total_sale) / $product_information->cartoon_quantity;

            $data2 = (object) array(
                        'total_product' => $available_quantity,
                        'supplier_price' => $product_information->supplier_price,
                        'price' => $product_information->price,
                        'supplier_id' => $product_information->supplier_id,
                        'tax' => $product_information->tax,
                        'product_id' => $product_information->product_id,
                        'product_name' => $product_information->product_name,
                        'product_model' => $product_information->product_model,
                        'cartoon_quantity' => $product_information->cartoon_quantity,
                        'product_code' => $product_information->product_code,
            );

            return $data2;
        } else {
            return false;
        }
    }

    //Get total product
    public function get_total_product($product_id) {
        $this->db->select('SUM(a.quantity) as total_purchase');
        $this->db->from('product_purchase_details a');
        $this->db->where('a.product_id', $product_id);
        $total_purchase = $this->db->get()->row();

        $this->db->select('SUM(b.quantity) as total_sale');
        $this->db->from('invoice_details b');
        $this->db->where('b.product_id', $product_id);
        $total_sale = $this->db->get()->row();

        $this->db->select('SUM(c.qty) as total_consumption');
        $this->db->from('manualconsumption c');
        $this->db->where('c.product_id', $product_id);
        $total_consumption = $this->db->get()->row();

        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where(array('product_id' => $product_id, 'status' => 1));
        $product_information = $this->db->get()->row();

        $available_quantity = ($total_purchase->total_purchase - $total_sale->total_sale - $total_consumption->total_consumption);

        $data2 = array(
            'total_product' => $available_quantity,
			'total_purchase' => $total_purchase->total_purchase,
            'supplier_price' => $product_information->supplier_price,
            'price' => $product_information->price,
            'supplier_id' => $product_information->supplier_id,
            'tax' => $product_information->tax,
            'cartoon_quantity' => $product_information->cartoon_quantity,
			'cgst' => $product_information->cgst,
			'sgst' => $product_information->sgst,
			'igst' => $product_information->igst,
        );

        return $data2;
    }

    //This function is used to Generate Key
    public function generator($lenth) {
        $number = array("1", "2", "3", "4", "5", "6", "7", "8", "9");

        for ($i = 0; $i < $lenth; $i++) {
            $rand_value = rand(0, 8);
            $rand_number = $number["$rand_value"];

            if (empty($con)) {
                $con = $rand_number;
            } else {
                $con = "$con" . "$rand_number";
            }
        }
        return $con;
    }

    //NUMBER GENERATOR
    public function number_generator() {
        $this->db->select_max('invoice', 'invoice_no');
        $query = $this->db->get('invoice');
        $result = $query->result_array();
        $invoice_no = $result[0]['invoice_no'];
        if ($invoice_no != '') {
            $invoice_no = $invoice_no + 1;
        } else {
            $invoice_no = 1000;
        }
        return $invoice_no;
    }

    //Retrieve invoice data by receipt id
    public function retrieve_receipt_html_data($receipt_id) {
        //$invoice_id=$this->uri->segment(3);
        $this->db->select('a.*,b.*,c.*,a.date as date,a.description as description,b.total_amount as total_amount');
        $this->db->from('customer_ledger a');
        $this->db->join('invoice b', 'a.invoice_no = b.invoice_id', 'left');
        $this->db->join('customer_information c', 'a.customer_id = c.customer_id', 'left');
        $this->db->where('a.receipt_no', $receipt_id);
        //$this->db->group_by('e.receipt_no');
        $query = $this->db->get();
        //print_r($query);exit;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

}
