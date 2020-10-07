<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salesorder extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('auth');
        $this->load->library('lcustomer');
        $this->load->library('session');
        $this->load->model('Customers');
        $this->auth->check_admin_auth();
    }

    //insert sales order
    public function sales_odr_entry() {

        $odr_id = date('YmdHis');

        $quantity = $this->input->post('product_quantity');
        $available_quantity = $this->input->post('available_quantity');
        $cartoon = $this->input->post('cartoon');


        $product_id = $this->input->post('product_id');
        if ($product_id == null) {
            $this->session->set_userdata(array('error_message' => display('please_select_product')));
            redirect('Csalesorder');
        }
        
		$customer_id = $this->input->post('customer_id');

        //Data inserting into invoice table
        $sales_odr = array(
            'odr_id' => $odr_id,
            'customer_id' => $customer_id,
            'date' => $this->input->post('s_odr_date'),
            'total_amount' => $this->input->post('grand_total_price'),
            'odr_no' => $this->input->post('odr_no'),
            'total_discount' => $this->input->post('total_discount'),
            'total_tax' => $this->input->post('total_tax'),
            'user_id' => $this->input->post('sales_prsn'),
            'reference_no' => $this->input->post('ref_no'),
            'shipping_date' => $this->input->post('shipment_date'),
            'delivery_method' => $this->input->post('delivery_method'),
        );

        $this->db->insert('sales_order', $sales_odr);

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
            $discount = $discount_rate[$i];
            $cgst_per = $cgst[$i];
            $sgst_per = $sgst[$i];
            $igst_per = $igst[$i];
            $utgst_per = $utgst[$i];
            $tax = $tax_row[$i];
            $this_discount = $discount_row[$i];

            $data = array(
                'odr_id' => $odr_id,
                'product_id' => $product_id,
                'cartoon' => $cartoon_quantity,
                'quantity' => $product_quantity,
                'rate' => $product_rate,
                'total_price' => $total_price,
                'this_tax' => $tax,
                'this_discount' => $this_discount,
                'cgst' => $cgst_per,
                'sgst' => $sgst_per,
                'igst' => $igst_per,
                'utgst' => $utgst_per,
                'discount' => $discount
            );

                $this->db->insert('sales_order_detail', $data);
          
        }
		//die;
        return true;
    }

    public function get_sales_persons()
    {
        $this->db->where('status','1');
        return $this->db->get('users')->result_array();
    }
    
    public function get_sales_odr_no()
    {
        
		$sales_odr_bit=$this->db->select('sales_odr_bit')->from('web_setting')->get()->row();
		if( $sales_odr_bit->sales_odr_bit==0)
		{
		    $query=$this->db->get('sales_order');
            if ($query->num_rows() > 0) {
                $this->db->select('odr_no');
                $this->db->from('sales_order');
                $this->db->order_by('id', 'desc');
                $this->db->limit(1);
                $sales_odr_series = $this->db->get()->row(); 
				//print_r($sales_odr_series);die;
                return $sales_odr_series->odr_no+1;
            }else{
                $sales_odr_series=$this->db->select('sales_odr_series')->from('web_setting')->get()->row();
                return $sales_odr_series->sales_odr_series;
            }
		}else{
                $sales_odr_series=$this->db->select('sales_odr_series')->from('web_setting')->get()->row();
				$data=array('sales_odr_bit'=>0);
        		$this->db->update('web_setting',$data);
                return $sales_odr_series->sales_odr_series;
            }
        
    }
	
    //count sales order List
    public function sales_odr_list_count() {
        $this->db->select('a.*,b.customer_name');
        $this->db->from('sales_order a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->order_by('a.id', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
	
    //sales order List
    public function sales_odr_list($perpage, $page) {
        $this->db->select('a.*,b.customer_name');
        $this->db->from('sales_order a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id','left');
        $this->db->order_by('a.id', 'desc');
        $this->db->limit($perpage, $page);
        $query = $this->db->get();
       // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	
    // Delete salesorder 
    public function delete_salesorder($odr_id) {

        $this->db->where('odr_id', $odr_id);
        $this->db->delete('sales_order');
        //Delete sales_order_detail table
        $this->db->where('odr_id', $odr_id);
        $this->db->delete('sales_order_detail');

        return true;
    }
    //Retrieve invoice_html_data
    public function retrieve_salesorder_html_data($odr_id) {
        $this->db->select("
						a.*,
						b.*,
						c.*,
						d.product_id,
						d.product_name,
						d.product_details,
						d.product_model,
						u.uom_name
					");
        $this->db->from('sales_order a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id','left');
        $this->db->join('sales_order_detail c', 'c.odr_id = a.odr_id');
        $this->db->join('product_information d', 'd.product_id = c.product_id');
        $this->db->join('uom_list u', 'd.uom = u.uom_id','left');
        $this->db->where('a.odr_id', $odr_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
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


}
