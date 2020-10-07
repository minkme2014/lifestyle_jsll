<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchases_order extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //Add PO
    public function po_entry() {
        $p_id = $this->input->post('product_id');
        $supplier_id = $this->input->post('supplier_id');

        $data = array(
            'po_no' => $this->input->post('po_no'),
            'date' => $this->input->post('po_date'),
            'supp_id' => $supplier_id,
            'payment_terms' => $this->input->post('payment_terms'),
            'delivery_charges' => $this->input->post('delivery_charges'),
            'freight_charges' => $this->input->post('freight_charges'),
            'po_amount' => $this->input->post('grand_total_price'),
        );
        $this->db->insert('purchase_odr', $data);
        $po_id = $this->db->insert_id();
        
        $rate = $this->input->post('price');
        $quantity = $this->input->post('qty');
        $com_quantity = $this->input->post('com_qty');
        $t_price = $this->input->post('total');
	//	$available_stk_qty = $this->input->post('available_stk_qty');
	//	$updated_stk_qty = $this->input->post('updated_stock_qty');
		$discount = $this->input->post('discount');
		$tax = $this->input->post('tax');
		$cgst = $this->input->post('cgst');
		$sgst = $this->input->post('sgst');
		$igst = $this->input->post('igst');
		$utgst = $this->input->post('utgst');

        for ($i = 0, $n = count($p_id); $i < $n; $i++) {
            $product_quantity = $quantity[$i];
            $product_com_quantity = $com_quantity[$i];
            $product_rate = $rate[$i];
            $product_id = $p_id[$i];
            $total_price = $t_price[$i];
		//	$product_available_stk_qty = $available_stk_qty[$i];
            $product_quantity = $quantity[$i];
            $product_com_quantity = $com_quantity[$i];
		//	$product_updated_stk_qty = $updated_stk_qty[$i];
            $product_rate = $rate[$i];
            $product_discount = $discount[$i];
           // $product_tax = $tax[$i];
            $product_cgst = $cgst[$i];
            $product_sgst = $sgst[$i];
            $product_igst = $igst[$i];
            $product_utgst = $utgst[$i];
            $product_id = $p_id[$i];
            $total_price = $t_price[$i];
        
			$data1 = array(
			    
			    'po_id'=>$po_id,
                'saved_items_id' => $product_id,
                'quantity' => $product_quantity,
                'unit_cost' => $product_rate,
			//	'tax' => $product_tax,
				'cgst' => $product_cgst,
				'sgst' => $product_sgst,
				'igst' => $product_igst,
				'utgst' => $product_utgst,
                'total_cost' => $total_price,
				'dis_per' => $product_discount,
				
            ); 
            $this->db->insert('tbl_po_items', $data1);
        }
		
        return true;
    }

    //po List
    public function po_list($per_page, $page) {
        $this->db->select('a.po_id,a.po_no,a.date,a.supp_id,a.date,a.po_created_at,a.convert_bill,,b.supplier_name');
        $this->db->from('purchase_odr a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supp_id');
        $this->db->order_by('a.date', 'desc');
        $this->db->order_by('po_id', 'desc');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();

        $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    
    // Delete po Item
    public function delete_po($po_id) {
        //Delete purchase_odr table
        $this->db->where('po_id', $po_id);
        $this->db->delete('purchase_odr');
        //Delete tbl_po_items table
        $this->db->where('po_id', $po_id);
        $this->db->delete('tbl_po_items');
        return true;
    }
    
    //Retrieve purchase Edit Data
    public function retrieve_po_editdata($po_id) {
        $this->db->select('a.*,
						b.*,
						c.product_id,
						c.product_name,
						c.product_model,
						c.cartoon_quantity,
						d.supplier_id,
						d.supplier_name,
						d.address,
						d.tin_no as sup_tin_no,
						d.pan_no as sup_pan_no,
						d.cin_no as sup_cin_no,
						d.gstin as sup_gstin,
						u.uom_name,
						sum(b.cgst+b.sgst+b.igst+b.utgst)as total_tax'
        );
        $this->db->from('purchase_odr  a');
        $this->db->join('tbl_po_items  b', 'b.po_id =a.po_id');
        $this->db->join('product_information c', 'c.product_id =b.saved_items_id');
        $this->db->join('uom_list u', 'c.uom =u.uom_id','left');
        $this->db->join('supplier_information d', 'd.supplier_id = a.supp_id');
        $this->db->where('a.po_id', $po_id);
        $this->db->group_by('b.po_items_id');
        $this->db->order_by('a.po_id', 'desc');
        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    
    //Update Categories
    public function update_po() {
        $po_id = $this->input->post('po_id');
		$data = array(
            'po_no' => $this->input->post('po_no'),
            'date' => $this->input->post('po_date'),
            'payment_terms' => $this->input->post('payment_terms'),
            'delivery_charges' => $this->input->post('delivery_charges'),
            'freight_charges' => $this->input->post('freight_charges'),
            'po_amount' => $this->input->post('grand_total_price'),
        );
      
        if ($po_id != '') {
            
            $this->db->where('po_id', $po_id);
            $this->db->update('purchase_odr', $data);
        }

        $po_items_id = $this->input->post('po_items_id');
        $rate = $this->input->post('price');
        $p_id = $this->input->post('product_id');
        $quantity = $this->input->post('qty');
        $t_price = $this->input->post('total');
		 $discount = $this->input->post('discount');
		 $tax = $this->input->post('tax');
		 $cgst = $this->input->post('cgst');
		 $sgst = $this->input->post('sgst');
		 $igst = $this->input->post('igst');
		 $utgst = $this->input->post('utgst');

		//echo $this->db->last_query(); die;

        for ($i = 0, $n = count($po_items_id); $i < $n; $i++) {
            $product_quantity = $quantity[$i];
            $product_com_quantity = $com_quantity[$i];
			$updated_stk_qty = $updated_stk_qty[$i];
            $product_rate = $rate[$i];
            $product_discount = $discount[$i];
            $product_tax = $tax[$i];
            $product_cgst = $cgst[$i];
            $product_sgst = $sgst[$i];
            $product_igst = $igst[$i];
            $product_utgst = $utgst[$i];
            $product_id = $p_id[$i];
            $total_price = $t_price[$i];
            $po_detail_id = $po_items_id[$i];

            $data2 = array(
                
                'saved_items_id' => $product_id,
                'quantity' => $product_quantity,
                'unit_cost' => $product_rate,
				'cgst' => $product_cgst,
				'sgst' => $product_sgst,
				'igst' => $product_igst,
				'utgst' => $product_utgst,
                'total_cost' => $total_price,
				'dis_per' => $product_discount,
                
            );
			//echo '<pre>'; print_r($data2); echo '</pre>';die;
			
            if (($quantity)) {
                $this->db->where('po_items_id', $po_detail_id);
                $this->db->update('tbl_po_items', $data2);
				//echo $this->db->last_query(); die;
            }
        }
		//----------------------------new entry----------------------------
     

        $p_id = $this->input->post('product_id1');
        $rate = $this->input->post('price1');
        $quantity = $this->input->post('qty1');
        $com_quantity = $this->input->post('com_qty1');
        $t_price = $this->input->post('total1');
	//	$available_stk_qty = $this->input->post('available_stk_qty1');
	//	$updated_stk_qty = $this->input->post('updated_stock_qty1');
		$discount = $this->input->post('discount1');
		$tax = $this->input->post('tax1');
		$cgst = $this->input->post('cgst1');
		$sgst = $this->input->post('sgst1');
		$igst = $this->input->post('igst1');
		$utgst = $this->input->post('utgst1');

        for ($i = 0, $n = count($p_id); $i < $n; $i++) {
            $product_quantity = $quantity[$i];
            $product_com_quantity = $com_quantity[$i];
            $product_rate = $rate[$i];
            $product_id = $p_id[$i];
            $total_price = $t_price[$i];
		//	$product_available_stk_qty = $available_stk_qty[$i];
            $product_quantity = $quantity[$i];
            $product_com_quantity = $com_quantity[$i];
		//	$product_updated_stk_qty = $updated_stk_qty[$i];
            $product_rate = $rate[$i];
            $product_discount = $discount[$i];
            $product_tax = $tax[$i];
            $product_cgst = $cgst[$i];
            $product_sgst = $sgst[$i];
            $product_igst = $igst[$i];
            $product_utgst = $utgst[$i];
            $product_id = $p_id[$i];
            $total_price = $t_price[$i];

      
			$data5 = array(
                'po_id' => $po_id,
                'saved_items_id' => $product_id,
                'quantity' => $product_quantity,
                'unit_cost' => $product_rate,
				'dis_per' => $product_discount,
				'cgst' => $product_cgst,
				'sgst' => $product_sgst,
				'igst' => $product_igst,
				'utgst' => $product_utgst,
                'total_cost' => $total_price,
            );
			
            if (!empty($quantity)) {
                $this->db->insert('tbl_po_items', $data5);
            }
        }
        return true;
    }
    
    
    //Count purchase
    public function count_purchase() {
        $this->db->select('a.*,b.supplier_name');
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->order_by('a.purchase_date', 'desc');
        $this->db->order_by('purchase_id', 'desc');
        $query = $this->db->get();

        $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }


    //Select All Supplier List
    public function select_all_supplier() {
        $query = $this->db->select('*')
                ->from('supplier_information')
                ->where('status', '1')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Select All Supplier List
    public function select_all_product() {
        $query = $this->db->select('*')
                ->from('product_information')
                ->where('status', '1')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //purchase Search  List
    public function purchase_by_search($supplier_id) {
        $this->db->select('a.*,b.supplier_name');
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->where('b.supplier_id', $supplier_id);
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



    public function purchase_search_list($cat_id, $company_id) {
        $this->db->select('a.*,b.sub_category_name,c.category_name');
        $this->db->from('purchases a');
        $this->db->join('purchase_sub_category b', 'b.sub_category_id = a.sub_category_id');
        $this->db->join('purchase_category c', 'c.category_id = b.category_id');
        $this->db->where('a.sister_company_id', $company_id);
        $this->db->where('c.category_id', $cat_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve purchase_details_data
    public function purchase_details_data($purchase_id) {
        $this->db->select('a.*,b.*,c.*,e.purchase_details,d.product_id,d.product_name,d.product_model,d.cartoon_quantity,u.uom_name');
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->join('product_purchase_details c', 'c.purchase_id = a.purchase_id');
        $this->db->join('product_information d', 'd.product_id = c.product_id');
        $this->db->join('product_purchase e', 'e.purchase_id = c.purchase_id');
        $this->db->join('uom_list u', 'd.uom = u.uom_id', 'left');
        $this->db->where('a.purchase_id', $purchase_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //This function will check the product & supplier relationship.
    public function product_supplier_check($product_id, $supplier_id) {
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where('product_id', $product_id);
        $this->db->where('supplier_id', $supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        }
        return 0;
    }

    //This function is used to Generate Key
    public function generator($lenth) {
        $number = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "N", "M", "O", "P", "Q", "R", "S", "U", "V", "T", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

        for ($i = 0; $i < $lenth; $i++) {
            $rand_value = rand(0, 61);
            $rand_number = $number["$rand_value"];

            if (empty($con)) {
                $con = $rand_number;
            } else {
                $con = "$con" . "$rand_number";
            }
        }
        return $con;
    }

	public function all_prd_category()
	{
		$this->db->where('status','1');
		return $this->db->get('product_category')->result_array();
	}
	
	public function all_supplier()
	{
		$this->db->where('status','1');
		return $this->db->get('supplier_information')->result_array();
	}
	
	public function get_po_no()
	{
		$po_bit=$this->db->select('po_bit')->from('web_setting')->get()->row();
		if( $po_bit->po_bit==0)
		{
		    $query=$this->db->get('purchase_odr');
            if ($query->num_rows() > 0) {
                $this->db->select('po_no');
                $this->db->from('purchase_odr');
                $this->db->order_by('po_id', 'desc');
                $this->db->limit(1);
                $po_no = $this->db->get()->row(); 
                return $po_no->po_no+1;
            }else{
                $po_no=$this->db->select('po_num_series')->from('web_setting')->get()->row();
                return $po_no->po_num_series;
            }
		}else{
                $po_no=$this->db->select('po_num_series')->from('web_setting')->get()->row();
                $data=array('po_bit'=>0);
        		$this->db->update('web_setting',$data);
                return $po_no->po_num_series;
            }
	}

		
	public function convert_in_bill($po_id)
	{
        $purchase_id = date('YmdHis');
		$po_detail = $this->retrieve_po_editdata($po_id);
		$data=array(
            'purchase_id' 		=>  $purchase_id,
			'chalan_no'		    =>	'po'.$po_detail[0]['po_no'],
			'supplier_id'		=>	$po_detail[0]['supplier_id'],
			'grand_total_amount'=>	$po_detail[0]['po_amount'],
			'po_id'	        	=>	$po_detail[0]['po_id'],
			'purchase_date'	    =>	$po_detail[0]['date'],
			'purchase_details'	=>	$po_detail[0]['payment_terms'],
			'delivery_charges'	=>	$po_detail[0]['delivery_charges'],
			'freight_charges'	=>	$po_detail[0]['freight_charges'],
            'status' 			=>  1
			);
        $this->db->insert('product_purchase', $data);
		
        $ledger = array(
            'transaction_id' => $purchase_id,
			'chalan_no'		 =>	'po'.$po_detail[0]['po_no'],
            'supplier_id'    => $po_detail[0]['supplier_id'],
            'amount' 		 => $po_detail[0]['po_amount'],
            'date' 			 => $po_detail[0]['date'],
            'description' 	 => $po_detail[0]['payment_terms'],
            'status' => 1,
            'd_c' => 'c'
        );
        $this->db->insert('supplier_ledger', $ledger);
		foreach($po_detail as $p)
		{
			
			$this->db->select('SUM(a.quantity) as total_purchase');
			$this->db->from('product_purchase_details a');
			$this->db->where('a.product_id', $p['product_id']);
			$total_purchase = $this->db->get()->row();

			$this->db->select('SUM(b.quantity) as total_sale');
			$this->db->from('invoice_details b');
			$this->db->where('b.product_id', $p['product_id']);
			$total_sale = $this->db->get()->row();

			$this->db->select('SUM(c.qty) as total_consumption');
			$this->db->from('manualconsumption c');
			$this->db->where('c.product_id', $p['product_id']);
			$total_consumption = $this->db->get()->row();
			
			$available_quantity = ($total_purchase->total_purchase - $total_sale->total_sale - $total_consumption->total_consumption);

            $product_quantity = $p['quantity'];
            $product_com_quantity = 0;
            $product_rate = $p['unit_cost'];
            $product_id = $p['product_id'];
            $total_price = $p['total_cost'];
            $product_discount = $p['dis_per'];
            $product_cgst = $p['cgst'];
            $product_sgst = $p['sgst'];
            $product_igst = $p['igst'];
            $product_utgst = $p['utgst'];
            $product_tax = $p['tax'];
			$purchase_detail_id = $this->generator(15);
			$product_available_stk_qty = $available_quantity;
			$product_updated_stk_qty = $available_quantity+$p['quantity'];
			
            $data1 = array(
                'purchase_detail_id' => $purchase_detail_id,
                'purchase_id' => $purchase_id,
                'product_id' => $product_id,
                'quantity' => $product_quantity+$product_com_quantity,
                'comp_quantity' => $product_com_quantity,
                'rate' => $product_rate,
                'total_amount' => $total_price,
                'status' => 1
            );
			$data2 = array(
                'purchase_detail_id' => $purchase_detail_id,
                'purchase_id'   	 => $purchase_id,
                'product_id'		 => $product_id,
				'available_stk_qty'  => $product_available_stk_qty,
                'item_qty' 			 => $product_quantity,
                'comp_qty' 			 => $product_com_quantity,
                'updated_stk_qty'	 => $product_updated_stk_qty,
                'rate' 				 => $product_rate,
				'discount'			 => $product_discount,
				//'tax' 				 => $product_tax,
				'cgst' 				 => $product_cgst,
				'sgst'				 => $product_sgst,
				'igst'				 => $product_igst,
				'utgst'				 => $product_utgst,
                'total_amount'		 => $total_price,
                'status'			 => 1
            );
				/* 	print_r($data1);
					echo "<br>";
					print_r($data2);
					echo "<br>"; */
					$this->db->insert('product_purchase_details', $data1);
					$this->db->insert('product_purchase_details_edit', $data2);
     // print_r($this->db->error());

		}
		$convert_bill=array('convert_bill'=>1);
		$this->db->where('po_id',$po_id);
		$this->db->update('purchase_odr',$convert_bill);
		//die;
        return true;
	}


}
