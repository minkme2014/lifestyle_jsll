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
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id','left');
        $this->db->order_by('a.invoice', 'desc');
        $this->db->limit($perpage, $page);
        $query = $this->db->get();
       // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function online_invoice_list($perpage, $page) {
        $this->db->select('a.*,b.customer_name');
        $this->db->from('online_invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id','left');
        $this->db->order_by('a.invoice', 'desc');
        $this->db->limit($perpage, $page);
        $query = $this->db->get();
       // echo $this->db->last_query();
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
    
    public function online_invoice_list_count() {
        $this->db->select('a.*,b.customer_name');
        $this->db->from('online_invoice a');
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
  /*  public function invoice_entry() {

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
    }*/


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
            if($type[$k]==="Goods")
            {
                if ($v < $cartoon[$k]) {
                    $this->session->set_userdata(array('error_message' => display('you_can_not_buy_greater_than_available_cartoon')));
                    redirect('Cinvoice');
                }
            }
        }


        $product_id = $this->input->post('product_id');
        if ($product_id == null) {
            $this->session->set_userdata(array('error_message' => display('please_select_product')));
            redirect('Cinvoice/pos_invoice');
        }

   /*     if (($this->input->post('customer_name_others') == null) && ($this->input->post('customer_id') == null ) && ($this->input->post('customer_name') == null )) {
            $this->session->set_userdata(array('error_message' => display('please_select_customer')));
            redirect(base_url() . 'Cinvoice');
        }*/


      /*  if (($this->input->post('customer_id') == null ) && ($this->input->post('customer_name') == null )) {
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
        }*/
            $customer_id = $this->input->post('customer_id');


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
               // 'invoice_no' => null,
                'invoice_no' => $invoice_id,
                'customer_id' => $customer_id,
                'receipt_no' => $this->auth->generator(10),
                'date' => $this->input->post('invoice_date'),
                'amount' => $this->input->post('paid_amount'),
                'payment_type' => $this->input->post('payment_type'),
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
                'transection_mood' => $this->input->post('payment_type'),
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
                'payment_type' => $this->input->post('payment_type'),
                'description' => 'ITP',
                'status' => 1
            );
            $this->db->insert($account_table, $account_adjustment);
        }
        //$customer_id=$this->input->post('customer_id');
        //Data inserting into invoice table
          $user_id=$this->input->post('sales_prsn');
        //echo "user_id1=".$user_id;
        if($user_id==null)
        {
            $user_id=0;
        }
        $datainv = array(
            'invoice_id' => $invoice_id,
            'customer_id' => $customer_id,
            'date' => $this->input->post('invoice_date'),
            'total_amount' => $this->input->post('grand_total_price'),
            'invoice' => $this->number_generator(),
            'total_discount' => $this->input->post('total_discount'),
            'total_tax' => $this->input->post('total_tax'),
            'freight_charges' => $this->input->post('freight_charges'),
            'delivery_charges' => $this->input->post('delivery_charges'),
            'packaging' => $this->input->post('packaging'),
            'user_id' => $user_id,
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
        $cgst = $this->input->post('cgst');
        $sgst = $this->input->post('sgst');
        $igst = $this->input->post('igst');
        $utgst = $this->input->post('utgst');
        $tax_row = $this->input->post('tax_row');
        $discount_row = $this->input->post('discount_row');


        for ($i = 0, $n = count($quantity); $i < $n; $i++) {
            $cartoon_quantity = $cartoon[$i];
            $product_quantity = $quantity[$i];
            $product_rate = $rate[$i];
            $product_id = $p_id[$i];
            $total_price = $total_amount[$i];
            $supplier_rate = $this->supplier_rate($product_id);
            $discount = $discount_rate[$i];
            $cgst_per = $cgst[$i];
            $sgst_per = $sgst[$i];
            $igst_per = $igst[$i];
            $utgst_per = $utgst[$i];
            $tax = $tax_row[$i];
            $this_discount = $discount_row[$i];

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
                'status' => 1,
                'cgst' => $cgst_per,
                'sgst' => $sgst_per,
                'igst' => $igst_per,
                'utgst' => $utgst_per,
                'this_tax' => $tax,
                'this_discount' => $this_discount,
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
        $this->db->select('a.*,b.customer_name,c.*,c.tax as total_tax,c.product_id,d.product_name,d.product_model,d.tax,u.uom_name,usr.first_name,usr.last_name');
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id','left');
        $this->db->join('invoice_details c', 'c.invoice_id = a.invoice_id');
        $this->db->join('product_information d', 'd.product_id = c.product_id');
        $this->db->join('uom_list u', 'd.uom = u.uom_id','left');
        $this->db->join('users usr', 'a.user_id = usr.id','left');
        $this->db->where('a.invoice_id', $invoice_id);
        $query = $this->db->get();
//echo $this->db->last_query();
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

			$delete=array(
			'invoice_no'=>$invoice_id,
          //  'd_c' => 'd'
			);
            //$this->db->where('invoice_no', $invoice_id)
            $this->db->where($delete)
                    ->delete('customer_ledger');
        }


        $data = array(
            'customer_id' => $this->input->post('customer_id'),
            'date' => $this->input->post('invoice_date'),
            'total_amount' => $this->input->post('grand_total_price'),
            'total_discount' => $this->input->post('total_discount'),
            'delivery_charges' => $this->input->post('delivery_charges'),
            'freight_charges' => $this->input->post('freight_charges'),
            'user_id' => $this->input->post('sales_prsn'),
            'total_tax' => $this->input->post('total_tax'),
            'packaging' => $this->input->post('packaging'),
        );

        $data3 = array(
            'transaction_id' => $transection_id,
            'invoice_no' => $invoice_id,
            'customer_id' => $this->input->post('customer_id'),
            'receipt_no' => $this->auth->generator(10),
            'date' => $this->input->post('invoice_date'),
            'amount' => $this->input->post('paid_amount'),
            'payment_type' => $this->input->post('payment_type'),
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
            'transection_mood' => $this->input->post('payment_type'),
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
        $tax_row = $this->input->post('tax_row');
        $cgst_per = $this->input->post('cgst');
        $sgst_per = $this->input->post('sgst');
        $igst_per = $this->input->post('igst');
        $utgst_per = $this->input->post('utgst');
        $discount_row = $this->input->post('discount_row');

        for ($i = 0, $n = count($invoice_d_id); $i < $n; $i++) {
            $product_quantity = $quantity[$i];

            $cartoon_quantity = $cartoon[$i];

            $product_rate = $rate[$i];
            $product_id = $p_id[$i];
            $invoice_detail_id = $invoice_d_id[$i];
            $total_price = $total_amount[$i];
            $discount = $discount_rate[$i];
            $tax = $tax_row[$i];
            $cgst = $cgst_per[$i];
            $sgst = $sgst_per[$i];
            $igst = $igst_per[$i];
            $utgst = $utgst_per[$i];
            $this_discount = $discount_row[$i];

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
                'this_tax' => $tax,
                'cgst' => $cgst,
                'sgst' => $sgst,
                'igst' => $igst,
                'utgst' => $utgst,
                'this_discount'=>$this_discount
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
        $this->db->select("
						a.*,
						b.*,
						c.*,
						d.product_id,
						d.product_name,
						d.product_details,
						d.product_model,
						d.rack,
						u.uom_name,
						(select payment_type from customer_ledger where invoice_no=a.invoice_id and d_c='c')payment_type
					");
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id','left');
        $this->db->join('invoice_details c', 'c.invoice_id = a.invoice_id');
        $this->db->join('product_information d', 'd.product_id = c.product_id');
        $this->db->join('uom_list u', 'd.uom = u.uom_id','left');
        $this->db->where('a.invoice_id', $invoice_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    
    public function retrieve_online_invoice_html_data($invoice_id) {
	   // echo "here";die;
        $this->db->select("
						a.*,
						b.*,
						c.*,
						d.product_id,
						d.product_name,
						d.product_details,
						d.product_model,
						u.uom_name,
						(select payment_type from customer_ledger where invoice_no=a.invoice_id and d_c='c')payment_type
					");
        $this->db->from('online_invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id','left');
        $this->db->join('online_invoice_details c', 'c.invoice_id = a.invoice_id');
        $this->db->join('online_product_information d', 'd.product_id = c.product_id');
        $this->db->join('uom_list u', 'd.uom = u.uom_id','left');
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

    // Delete invoice 
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
    // Delete invoice Item
    public function delete_invoice_item($invoice_details_id) {

        $this->db->where('invoice_details_id', $invoice_details_id);
        $this->db->delete('invoice_details');

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
        $product_id = $this->db->select('product_id')
                ->from('product_information')
                ->where('product_code', $product_code)
                ->get()
                ->row();
        if ($product_information != null) {

            $this->db->select('SUM(a.quantity) as total_purchase');
            $this->db->from('product_purchase_details a');
            $this->db->where('a.product_id', $product_id->product_id);
            $total_purchase = $this->db->get()->row();

            $this->db->select('SUM(b.quantity) as total_sale');
            $this->db->from('invoice_details b');
            $this->db->where('b.product_id', $product_id->product_id);
            $total_sale = $this->db->get()->row();
            
            
            $this->db->select('SUM(c.qty) as total_consumption');
            $this->db->from('manualconsumption c');
            $this->db->where('c.product_id', $product_id->product_id);
            $total_consumption = $this->db->get()->row();
            
            $uom=$this->db->select('uom_name')->from('uom_list')->where('uom_id',$product_information->uom)->get()->row();
          //  $available_quantity = ($total_purchase->total_purchase - $total_sale->total_sale) / $product_information->cartoon_quantity;
            $available_quantity = ($total_purchase->total_purchase - $total_sale->total_sale - $total_consumption->total_consumption);

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
                        'cgst' => $product_information->cgst,
                        'sgst' => $product_information->sgst,
                        'igst' => $product_information->igst,
                        'utgst' => $product_information->utgst,
                        'code' => $product_information->code,
                        'type' => $product_information->type,
                        'uom'=>$uom->uom_name,
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

        $this->db->select('*');
        $this->db->from('uom_list');
        $uom = $this->db->where('uom_id',$product_information->uom)->get()->row();
        
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
			'utgst' => $product_information->utgst,
			'type' => $product_information->type,
			'uom' =>$uom->uom_name,
        );

        return $data2;
    }
    //Get total product for po
    public function get_total_product_for_po($product_id,$supp_id) {
		$this->db->select('*');
		$this->db->from('web_setting');
		$this->db->where('setting_id',1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$Web_settings = $query->result_array();	
		}
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

        $this->db->select('*');
        $this->db->from('uom_list');
        $uom = $this->db->where('uom_id',$product_information->uom)->get()->row();
        
        $available_quantity = ($total_purchase->total_purchase - $total_sale->total_sale - $total_consumption->total_consumption);
		
		if($Web_settings[0]['supplier_price']=="1") 
		{
			console.log("here");
			$this->db->select('rate');
			$this->db->from('product_purchase_details p');
			$this->db->join('product_purchase i', 'p.purchase_id=i.purchase_id');
			$this->db->where(array('i.supplier_id'=>$supp_id,'p.product_id'=>$product_id));
			$this->db->order_by('p.id','desc');
			$query=$this->db->limit(1)->get()->row(); 
		//	echo $this->db->last_query();
			$product_price= $query->rate;
			if($product_price=="")
			{
				$product_price=$product_information->price;
			}
		}else{
			$product_price=$product_information->price;
		}
		//	echo '<script>console.log("price='.$product_price.'")</script>';
		
        $data2 = array(
            'total_product' => $available_quantity,
			'total_purchase' => $total_purchase->total_purchase,
            'supplier_price' => $product_price,
            'price' => $product_information->price,
            'supplier_id' => $product_information->supplier_id,
            'tax' => $product_information->tax,
            'cartoon_quantity' => $product_information->cartoon_quantity,
			'cgst' => $product_information->cgst,
			'sgst' => $product_information->sgst,
			'igst' => $product_information->igst,
			'utgst' => $product_information->utgst,
			'type' => $product_information->type,
			'uom' =>$uom->uom_name,
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
    
    public function get_sales_persons()
    {
        $this->db->where('status','1');
        return $this->db->get('users')->result_array();
    }
    
	public function check_product_price($product_id,$customer_id)
	{
		$this->db->select('rate');
		$this->db->from('invoice_details id');
        $this->db->join('invoice i', 'id.invoice_id=i.invoice_id');
        $this->db->where(array('i.customer_id'=>$customer_id,'id.product_id'=>$product_id));
        $this->db->order_by('id.id','desc');
		$query=$this->db->limit(1)->get()->row(); 
	//	echo $this->db->last_query();
		return $query->rate;
	}
	
	public function check_pos_product_price($product_code,$customer_id)
	{
	    
        $product_id = $this->db->select('product_id')
                ->from('product_information')
                ->where('product_code', $product_code)
                ->get()
                ->row();
                
		$this->db->select('rate');
		$this->db->from('invoice_details id');
        $this->db->join('invoice i', 'id.invoice_id=i.invoice_id');
        $this->db->where(array('i.customer_id'=>$customer_id,'id.product_id'=>$product_id->product_id));
        $this->db->order_by('id.id','desc');
		$query=$this->db->limit(1)->get()->row(); 
		//echo $this->db->last_query();
		return $query->rate;
	}
	public function getProductInformation($select)
	{
		if(is_numeric($select))
		{
			$this->db->where('code',$select);
			$query=$this->db->get('product_information');
		}else{
			$this->db->like('product_name',$select);
			$query=$this->db->get('product_information');
		}
	//	echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = array('label' => $row->product_name . "-(" . $row->product_model . ")". "-(" . $row->code . ")", 'value' => $row->product_id);
            }
        }
		return $data;
	    //return $this->db->get('product_information')->result_array();
	}
	
	public function getTotalSaleCategoryWise()
	{
		return $this->db->query("SELECT pc.category_name, sum(ids.total_price) as total FROM invoice_details ids 
							left join invoice inv on ids.invoice_id=inv.invoice_id 
							left join product_information pi on ids.product_id=pi.product_id 
							left join product_category pc on pi.category_id=pc.category_id
							where inv.date=DATE(CURRENT_TIMESTAMP)
							group by pc.category_id")->result_array();
							
	}
	
	public function add_odr_manufacture($data,$invoice_detail_id)
	{
		$this->db->insert('odr_manufacturing_costing',$data);
		$data2 = array( 
			'manufacturing_costing' => '1' 
		);

		$this->db->where('id', $invoice_detail_id);
		return $this->db->update('invoice_details',$data2);
	}
	
	public function add_sale_record($data,$invoice)
	{
		$this->db->where('invoice', $invoice);
		return $this->db->update('invoice',$data);
	}
	
    public function insert_manufacturing_costing($data)
    {
        return $this->db->insert('manufacturing_costing',$data);
    
	}
	public function invoice_return()
	{
        $return_id = date('YmdHis');
        $invoice_id = $this->input->post('invoice_id');
        $total_amount = $this->input->post('r_total_amount');
        $invoice_details_id = $this->input->post('invoice_details_id');
        $product_id = $this->input->post('product_id');
        $cartoon = $this->input->post('cartoon');
        $quantity = $this->input->post('quantity');
        $rate = $this->input->post('rate');
        $discount = $this->input->post('discount');
        $this_discount = $this->input->post('this_discount');
        $tax = $this->input->post('tax');
        $this_tax = $this->input->post('this_tax');
        $return_item = $this->input->post('return_item');
        $p_total_price = $this->input->post('r_total_price');
        $new_total_price = $this->input->post('total_price');
        $this_price = $this->input->post('this_price');
        $customer_id = $this->input->post('customer_id');
        $reason = $this->input->post('reason');
		$total_tax=0;
		$total_discount=0;
		$total_price=0;
		$r_total_tax=0;
		$r_total_discount=0;
			
		foreach($this_price as $p)
		{
			$r_total_price += $p;
		}
		foreach($this_tax as $t)
		{
			$total_tax += $t;
		}
		foreach($this_discount as $d)
		{
			$total_discount += $d;
		}
		
        for ($i = 0, $n = count($invoice_details_id); $i < $n; $i++)
		{
            $r_item_qty = $return_item[$i];
			
			if($r_item_qty=='')
			{
				$r_item_qty=0;
			}
			
			$cartoon_quantity=$cartoon[$i]-$r_item_qty;
			$per_carton=$quantity[$i]/$cartoon[$i];
			$total_price=$cartoon_quantity*$per_carton*$rate[$i];
			
			$product_quantity=$cartoon_quantity*$per_carton;
			$r_price=$r_item_qty*$per_carton*$rate[$i];
			$r_discount=$r_item_qty*$per_carton*$discount[$i];
			$r_tax=($r_price-$r_discount)*$tax[$i]/100;
			
			$r_total_tax += $r_tax;
			$r_total_discount += $r_discount;
				
			if($r_item_qty!=0){
				$data = array(
					'return_id' => $return_id,
					'invoice_details_id' => $invoice_details_id[$i],
					'invoice_id' => $invoice_id,
					'product_id' => $product_id[$i],
					'cartoon' => $r_item_qty,
					'quantity' => $r_item_qty*$per_carton,
					'rate' => $rate[$i],
					'discount' => $discount[$i],
					'total_price' => $r_price,
					'tax' => $tax[$i],
					'this_tax' => $r_tax,
					'this_discount' => $r_discount
				);
				$this->db->insert('return_invoice_details', $data);
				/* echo "<br>return_invoice_details-------------<br>";
				print_r($data); */
				$data1 = array(
					'cartoon' => $cartoon_quantity,
					'quantity' => $product_quantity,
					'rate' => $rate[$i],
					'tax' => $total_tax,
					'discount' => $discount[$i],
					'total_price' => $p_total_price[$i],
					'this_tax' => $this_tax[$i],
					'this_discount' => $this_discount[$i]
				);
				/* echo "<br>invoice_details-------------<br>";
				print_r($data1); */
				$this->db->where('invoice_details_id', $invoice_details_id[$i]);
				$this->db->update('invoice_details', $data1);
			}
		}
		
		$data2=array(
            'return_id' 		=>  $return_id,
            'invoice_id' 		=>  $invoice_id,
			'customer_id'		=>	$customer_id,
			'total_amount'		=>	$r_total_price,
			'total_discount'	=>	$r_total_discount,
			'total_tax'			=>	$r_total_tax,
			'reason'			=>	$reason,
			);
        $this->db->insert('return_invoice', $data2);
		
			/* 	echo "<br>return_invoice-------------<br>";
				print_r($data2); */
		$data3=array(
			'total_amount'		=>	$total_amount,
			'total_discount'	=>	$total_discount,
			'total_tax'			=>	$total_tax,
			);
			
			/* 	echo "<br>invoice-------------<br>";
				print_r($data3); */
        $this->db->where('invoice_id', $invoice_id);
        $this->db->update('invoice',$data3);
		 
		$cust_ledger = $this->db->select('*')->from('customer_ledger')->where('invoice_no', $invoice_id)->get()->result();
        
        foreach ($cust_ledger as $value) {
            $transaction_id = $value->transaction_id;
				if($value->d_c=='c')
				{
					if($value->amount>$total_amount){
						$cust_update=array(
							'transaction_id' => $transaction_id,
							'd_c'=>'c'
							);
						$cust_data=array('amount' => $total_amount);
			/* 	echo "<br>if-------------<br>";
				print_r($cust_data); */
					 	
						$this->db->where('transaction_id', $transaction_id);
						$this->db->update('transection', $cust_data);
						
						$this->db->where('transaction_id', $transaction_id);
						$this->db->update('inflow_92mizdldrv', $cust_data); 
					}
				}else{
					$cust_update=array(
						'transaction_id' => $transaction_id,
						'd_c'=>'d'
						);
					if($value->amount>$total_amount){
						$cust_data=array('amount' => $total_amount);
					}else{
						$amount = $value->amount;
						$due_amount=$total_amount-$value->amount;
						$cust_data=array('amount' => $due_amount);
					}
		/* 		echo "<br>else-------------<br>";
				print_r($cust_data); */
					
				}
			 	$this->db->where($cust_update);
				$this->db->update('customer_ledger',$cust_data); 
		}
		//die;
		

	}
/* 	public function invoice_return($invoice_id,$reason){
		$invoice=$this->retrieve_invoice_editdata($invoice_id);
		$data=array(
            'invoice_id' 		=>  $invoice[0]['invoice_id'],
			'customer_id'		=>	$invoice[0]['customer_id'],
			'date'				=>	$invoice[0]['date'],
			'total_amount'		=>	$invoice[0]['total_amount'],
			'invoice'			=>	$invoice[0]['invoice'],
			'total_discount'	=>	$invoice[0]['total_discount'],
			'total_tax'			=>	$invoice[0]['total_tax'],
			'freight_charges'	=>	$invoice[0]['freight_charges'],
			'delivery_charges'	=>	$invoice[0]['delivery_charges'],
			'packaging'			=>	$invoice[0]['packaging'],
			'user_id'			=>	$invoice[0]['user_id'],
			'reason'			=>	$reason,
            'status' 			=> 1
			);
        $this->db->insert('return_invoice', $data);

        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('invoice');
		
        $this->db->where('invoice_no', $invoice_id);
        $this->db->delete('customer_ledger');
		
		
		foreach($invoice as $p)
		{
            $cartoon_quantity = $p['cartoon'];
            $product_quantity = $p['quantity'];
            $product_rate = $p['rate'];
            $product_id = $p['product_id'];
            $total_price = $p['total_price'];
            $supplier_rate = $p['supplier_rate'];
            $discount = $p['discount'];
            $cgst_per = $p['cgst'];
            $sgst_per = $p['sgst'];
            $igst_per = $p['igst'];
            $utgst_per = $p['utgst'];
            $tax = $p['this_tax'];
            $invoice_details_id = $p['invoice_details_id'];
            $total_tax = $p['total_tax'];
            $paid_amount = $p['paid_amount'];
            $due_amount = $p['due_amount'];
            $product_quantity = $p['quantity'];
            $this_discount = $p['this_discount'];
			
            $data1 = array(
                'invoice_details_id' => $invoice_details_id,
                'invoice_id' => $invoice_id,
                'product_id' => $product_id,
                'cartoon' => $cartoon_quantity,
                'quantity' => $product_quantity,
                'rate' => $product_rate,
                'tax' => $total_tax,
                'discount' => $discount,
                'paid_amount' => $paid_amount,
                'due_amount' => $due_amount,
                'supplier_rate' => $supplier_rate,
                'total_price' => $total_price,
                'status' => 1,
                'cgst' => $cgst_per,
                'sgst' => $sgst_per,
                'igst' => $igst_per,
                'utgst' => $utgst_per,
                'this_tax' => $tax,
                'this_discount' => $this_discount,
            );
					$this->db->insert('return_invoice_details', $data1);
					//Delete product_purchase_details table
				  	$this->db->where('invoice_id', $invoice_id);
					$this->db->delete('invoice_details'); 
					
     // print_r($this->db->error());

		}
	} */

}
