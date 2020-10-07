<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchases extends CI_Model {

    public function __construct() {
        parent::__construct();
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

    //purchase List
    public function purchase_list($per_page, $page) {
        $this->db->select('a.*,b.supplier_name');
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->order_by('a.purchase_date', 'desc');
        $this->db->order_by('purchase_id', 'desc');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();

        $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
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

    //Count purchase
    public function purchase_entry() {
        $purchase_id = date('YmdHis');

        $p_id = $this->input->post('product_id');
        $supplier_id = $this->input->post('supplier_id');

/*         //supplier & product id relation ship checker.
        for ($i = 0, $n = count($p_id); $i < $n; $i++) {
            $product_id = $p_id[$i];
            $value = $this->product_supplier_check($product_id, $supplier_id);
            if ($value == 0) {
                $this->session->set_userdata(array('message' => "product_and_supplier_did_not_match"));
                redirect(base_url('Cpurchase'));
                exit();
            }
        } */

        $data = array(
            'purchase_id' => $purchase_id,
            'chalan_no' => $this->input->post('chalan_no'),
            'supplier_id' => $this->input->post('supplier_id'),
            'grand_total_amount' => $this->input->post('grand_total_price'),
            'purchase_date' => $this->input->post('purchase_date'),
            'purchase_details' => $this->input->post('purchase_details'),
            'status' => 1
        );
        $this->db->insert('product_purchase', $data);

        $ledger = array(
            'transaction_id' => $purchase_id,
            'chalan_no' => $this->input->post('chalan_no'),
            'supplier_id' => $this->input->post('supplier_id'),
            'amount' => $this->input->post('grand_total_price'),
            'date' => $this->input->post('purchase_date'),
            'description' => $this->input->post('purchase_details'),
            'status' => 1,
            'd_c' => 'c'
        );
        $this->db->insert('supplier_ledger', $ledger);

        // Account Information for purchase
        // $account=array(
        // 	'transaction_id'		=>	$purchase_id,
        // 	'transection_category'	=>	1,
        // 	'relation_id'			=>	$this->input->post('supplier_id'),
        // 	'pay_amount'			=>	$this->input->post('grand_total_price'),
        // 	'date_of_transection'	=> date('d-m-Y'),
        // 	'description'			=>	$this->input->post('purchase_details'),
        // 	'transection_type'		=>	1,
        // 	'transection_mood'      =>1
        // );
        // $this->db->insert('transection',$account);

        $rate = $this->input->post('price');
        $quantity = $this->input->post('qty');
        $com_quantity = $this->input->post('com_qty');
        $t_price = $this->input->post('total');
		$available_stk_qty = $this->input->post('available_stk_qty');
		$updated_stk_qty = $this->input->post('updated_stock_qty');
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
			$product_available_stk_qty = $available_stk_qty[$i];
            $product_quantity = $quantity[$i];
            $product_com_quantity = $com_quantity[$i];
			$product_updated_stk_qty = $updated_stk_qty[$i];
            $product_rate = $rate[$i];
            $product_discount = $discount[$i];
            $product_tax = $tax[$i];
            $product_cgst = $cgst[$i];
            $product_sgst = $sgst[$i];
            $product_igst = $igst[$i];
            $product_utgst = $utgst[$i];
            $product_id = $p_id[$i];
            $total_price = $t_price[$i];
			$purchase_detail_id = $this->generator(15);

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
                'purchase_id' => $purchase_id,
                'product_id' => $product_id,
				'available_stk_qty' => $product_available_stk_qty,
                'item_qty' => $product_quantity,
                'comp_qty' => $product_com_quantity,
                'updated_stk_qty' => $product_updated_stk_qty,
                'rate' => $product_rate,
				'discount' => $product_discount,
				'tax' => $product_tax,
				'cgst' => $product_cgst,
				'sgst' => $product_sgst,
				'igst' => $product_igst,
				'utgst' => $product_utgst,
                'total_amount' => $total_price,
                'status' => 1
            );
			
            if (!empty($quantity)) {
                $this->db->insert('product_purchase_details', $data1);
				$this->db->insert('product_purchase_details_edit', $data2);
            }
        }
		
        return true;
    }

    //Retrieve purchase Edit Data
    public function retrieve_purchase_editdata($purchase_id) {
        $this->db->select('a.*,
						b.*,
						c.product_id,
						c.product_name,
						c.product_model,
						c.cartoon_quantity,
						d.supplier_id,
						d.supplier_name,
						u.uom_name'
        );
        $this->db->from('product_purchase a');
        $this->db->join('product_purchase_details_edit b', 'b.purchase_id =a.purchase_id');
        $this->db->join('product_information c', 'c.product_id =b.product_id');
        $this->db->join('uom_list u', 'c.uom =u.uom_id','left');
        $this->db->join('supplier_information d', 'd.supplier_id = a.supplier_id');
        $this->db->where('a.purchase_id', $purchase_id);
        $this->db->order_by('a.purchase_details', 'asc');
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

    //Update Categories
    public function update_purchase() {
        $purchase_id = $this->input->post('purchase_id');

        $data = array(
            'chalan_no' => $this->input->post('chalan_no'),
            'supplier_id' => $this->input->post('supplier_id'),
            'grand_total_amount' => $this->input->post('grand_total_price'),
            'purchase_date' => $this->input->post('purchase_date'),
            'purchase_details' => $this->input->post('purchase_details')
        );

        if ($purchase_id != '') {
            $this->db->where('purchase_id', $purchase_id);
            $this->db->update('product_purchase', $data);
        }

        $ledger = array(
            'chalan_no' => $this->input->post('chalan_no'),
            'supplier_id' => $this->input->post('supplier_id'),
            'amount' => $this->input->post('grand_total_price'),
            'date' => $this->input->post('purchase_date'),
            'description' => $this->input->post('purchase_details'),
        );
            $this->db->where('transaction_id', $purchase_id);
        $this->db->update('supplier_ledger', $ledger);
		
        $rate = $this->input->post('price');
        $p_id = $this->input->post('product_id');
        $quantity = $this->input->post('qty');
        $t_price = $this->input->post('total');
        $purchase_d_id = $this->input->post('purchase_detail_id');
        $com_quantity = $this->input->post('com_qty');
		
        for ($i = 0, $n = count($purchase_d_id); $i < $n; $i++) {
            $product_quantity = $quantity[$i];
            $product_rate = $rate[$i];
            $product_id = $p_id[$i];
            $total_price = $t_price[$i];
            $purchase_detail_id = $purchase_d_id[$i];
            $product_com_quantity = $com_quantity[$i];

            $data1 = array(
                'product_id' => $product_id,
                'quantity' => $product_quantity+$product_com_quantity,
				'comp_quantity' => $product_com_quantity,
                'rate' => $product_rate,
                'total_amount' => $total_price
            );
			//echo '<pre>'; print_r($data1); echo '</pre>';die;

            if (($quantity)) {
                $this->db->where('purchase_detail_id', $purchase_detail_id);
                $this->db->update('product_purchase_details', $data1);
            }
        }
		//echo $this->db->last_query(); die;
		 $available_stk_qty = $this->input->post('available_stk_qty');
		 $updated_stk_qty = $this->input->post('updated_stock_qty');
		 $discount = $this->input->post('discount');
		 $tax = $this->input->post('tax');
		 $cgst = $this->input->post('cgst');
		 $sgst = $this->input->post('sgst');
		 $igst = $this->input->post('igst');
         $com_quantity = $this->input->post('com_qty');
        $purchase_d_id = $this->input->post('purchase_detail_id');

        for ($i = 0, $n = count($purchase_d_id); $i < $n; $i++) {
			$product_available_stk_qty = $available_stk_qty[$i];
			$product_updated_stk_qty = $updated_stk_qty[$i];
            $product_quantity = $quantity[$i];
            $product_com_quantity = $com_quantity[$i];
			$updated_stk_qty = $updated_stk_qty[$i];
            $product_rate = $rate[$i];
            $product_discount = $discount[$i];
            $product_tax = $tax[$i];
            $product_cgst = $cgst[$i];
            $product_sgst = $sgst[$i];
            $product_igst = $igst[$i];
            $product_id = $p_id[$i];
            $total_price = $t_price[$i];
            $purchase_detail_id = $purchase_d_id[$i];

            $data2 = array(
				'available_stk_qty' => $product_available_stk_qty,
                'item_qty' => $product_quantity,
                'comp_qty' => $product_com_quantity,
                'updated_stk_qty' => $product_updated_stk_qty,
                'rate' => $product_rate,
				'discount' => $product_discount,
				'tax' => $product_tax,
				'cgst' => $product_cgst,
				'sgst' => $product_sgst,
				'igst' => $product_igst,
                'total_amount' => $total_price
            );
			//echo '<pre>'; print_r($data2); echo '</pre>';die;
			
            if (($quantity)) {
                $this->db->where('purchase_detail_id', $purchase_detail_id);
                $this->db->update('product_purchase_details_edit', $data2);
				//echo $this->db->last_query(); die;
            }
        }
		//----------------------------new entry----------------------------

        $p_id = $this->input->post('product_id1');
        $rate = $this->input->post('price1');
        $quantity = $this->input->post('qty1');
        $com_quantity = $this->input->post('com_qty1');
        $t_price = $this->input->post('total1');
		$available_stk_qty = $this->input->post('available_stk_qty1');
		$updated_stk_qty = $this->input->post('updated_stock_qty1');
		$discount = $this->input->post('discount1');
		$tax = $this->input->post('tax1');
		$cgst = $this->input->post('cgst1');
		$sgst = $this->input->post('sgst1');
		$igst = $this->input->post('igst1');

        for ($i = 0, $n = count($p_id); $i < $n; $i++) {
            $product_quantity = $quantity[$i];
            $product_com_quantity = $com_quantity[$i];
            $product_rate = $rate[$i];
            $product_id = $p_id[$i];
            $total_price = $t_price[$i];
			$product_available_stk_qty = $available_stk_qty[$i];
            $product_quantity = $quantity[$i];
            $product_com_quantity = $com_quantity[$i];
			$product_updated_stk_qty = $updated_stk_qty[$i];
            $product_rate = $rate[$i];
            $product_discount = $discount[$i];
            $product_tax = $tax[$i];
            $product_cgst = $cgst[$i];
            $product_sgst = $sgst[$i];
            $product_igst = $igst[$i];
            $product_id = $p_id[$i];
            $total_price = $t_price[$i];

            $data4 = array(
                'purchase_detail_id' => $this->generator(15),
                'purchase_id' => $purchase_id,
                'product_id' => $product_id,
                'quantity' => $product_quantity+$product_com_quantity,
                'comp_quantity' => $product_com_quantity,
                'rate' => $product_rate,
                'total_amount' => $total_price,
                'status' => 1
            );
			$data5 = array(
                'purchase_detail_id' => $this->generator(15),
                'purchase_id' => $purchase_id,
                'product_id' => $product_id,
				'available_stk_qty' => $product_available_stk_qty,
                'item_qty' => $product_quantity,
                'comp_qty' => $product_com_quantity,
                'updated_stk_qty' => $product_updated_stk_qty,
                'rate' => $product_rate,
				'discount' => $product_discount,
				'tax' => $product_tax,
				'cgst' => $product_cgst,
				'sgst' => $product_sgst,
				'igst' => $product_igst,
                'total_amount' => $total_price,
                'status' => 1
            );
			
            if (!empty($quantity)) {
                $this->db->insert('product_purchase_details', $data4);
				$this->db->insert('product_purchase_details_edit', $data5);
            }
        }
		//echo '1<pre>'; print_r($data1); echo '</pre>';
		//echo '2<pre>'; print_r($data2); echo '</pre>';
		//echo '3<pre>'; print_r($data3); echo '</pre>';
		//echo '4<pre>'; print_r($data4); echo '</pre>';
		//echo '5<pre>'; print_r($data5); echo '</pre>';die;
        return true;
    }

    // Delete purchase Item
    public function delete_purchase($purchase_id) {
        //Delete product_purchase table
        $this->db->where('purchase_id', $purchase_id);
        $this->db->delete('product_purchase');
        //Delete product_purchase_details table
        $this->db->where('purchase_id', $purchase_id);
        $this->db->delete('product_purchase_details');
        $this->db->where('purchase_id', $purchase_id);
        $this->db->delete('product_purchase_details_edit');
		
        $this->db->where('transaction_id', $purchase_id);
        $this->db->delete('supplier_ledger');
		
        return true;
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
	

    //Get total product
    public function retrieve_product_purchase($product_id) {
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
			'rack' => $product_information->rack,
			'uom' =>$uom->uom_name,
        );

        return $data2;
    }
	public function getProductInformation($select)
	{
		if(is_numeric($select))
		{
			$condition=array(
			'code'=>$select,
			'type!='=>'Services',
			);
			$this->db->where($condition);
			$query=$this->db->get('product_information');
		}else{
			$this->db->where('type!=','Services');
			$this->db->like('product_name',$select);
			$query=$this->db->get('product_information');
		}
		//echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = array('label' => $row->product_name . "-(" . $row->product_model . ")". "-(" . $row->code . ")", 'value' => $row->product_id);
            }
        }
		return $data;
	    //return $this->db->get('product_information')->result_array();
	}
	
	public function purchase_return(){
        $return_id = date('YmdHis');
        $purchase_detail_id = $this->input->post('purchase_detail_id');
        $r_total = $this->input->post('r_total');
        $item_qty = $this->input->post('item_qty');
        $return_item = $this->input->post('return_item');
        $r_total_amount = $this->input->post('r_total_amount');
        $reason = $this->input->post('reason');
        $purchase_id = $this->input->post('purchase_id');
        $product_id = $this->input->post('product_id');
        $discount = $this->input->post('discount');
        $tax = $this->input->post('tax');
        $rate = $this->input->post('rate');

		$data=array(
            'return_id' 		=>  $return_id,
            'purchase_id' 		=>  $purchase_id,
			'reason'			=>	$reason
			);
			
        $this->db->insert('return_product_purchase', $data);
		 
		$update_purchase=array(
			'grand_total_amount'=>	$r_total_amount,
		);
		
		$this->db->where('purchase_id', $purchase_id);
		$this->db->update('product_purchase',$update_purchase);
					
        $ledger = array(
            'amount' => $r_total_amount,
        );
            $this->db->where('transaction_id', $purchase_id);
			$this->db->update('supplier_ledger', $ledger);
		
        for ($i = 0, $n = count($purchase_detail_id); $i < $n; $i++) {
			
            $purchase_d_id = $purchase_detail_id[$i];
            $p_total = $r_total[$i];
            $a_item_qty = $item_qty[$i];
            $r_item_qty = $return_item[$i];
            $grand_total_amount = $r_total_amount[$i];
            $p_id = $purchase_id;
			
			if($r_item_qty=='')
			{
				$r_item_qty=0;
			}
			if($r_item_qty!=0){
				
				$amount=$r_item_qty*$rate[$i];
				if($discount[$i]!=0)
				{
					$total_amount=$amount*(100-$discount[$i])/100;
				}else{
					$total_amount=$amount;
				}
				if($tax[$i]!=0)
				{
					$total_amount=$total_amount*(100+$tax[$i])/100;
				}
				
				$data1 = array(
					'return_id' => $return_id,
					'purchase_detail_id' => $purchase_d_id,
					'purchase_id' => $p_id,
					'quantity' => $r_item_qty,
					'rate' => $rate[$i],
					'product_id' => $product_id[$i],
					'discount' => $discount[$i],
					'tax' => $tax[$i],
					'total_amount' => $total_amount,
					
				);
					$this->db->insert('return_product_purchase_details', $data1); 
				
				$this->db->select('*')->from('product_purchase_details')->where('purchase_detail_id', $purchase_d_id);
				$purchase=$this->db->get()->row();
				$qty= $purchase->quantity - $r_item_qty;
				
				 $p_detail = array(
					'quantity' => $qty,
					'total_amount' => $p_total
				);
					$this->db->where('purchase_detail_id', $purchase_d_id);
					$this->db->update('product_purchase_details',$p_detail); 
					
					
				$this->db->select('*')->from('product_purchase_details_edit')->where('purchase_detail_id', $purchase_d_id);
				$p_edit=$this->db->get()->row();
				$available_stk_qty= $p_edit->available_stk_qty - $r_item_qty;
				$item_qty= $p_edit->item_qty - $r_item_qty;
				$updated_stk_qty= $p_edit->updated_stk_qty - $r_item_qty;
				
				 $p_detail_edit = array(
					'available_stk_qty' => $available_stk_qty,
					'item_qty' => $item_qty,
					'updated_stk_qty' => $updated_stk_qty,
					'total_amount' => $p_total
				);
					$this->db->where('purchase_detail_id', $purchase_d_id);
					$this->db->update('product_purchase_details_edit',$p_detail_edit); 
			}
		}
		return true;
	}
    
	public function check_product_price($product_id,$supplier_id)
	{
		$this->db->select('rate');
		$this->db->from('product_purchase_details p');
        $this->db->join('product_purchase i', 'p.purchase_id=i.purchase_id');
        $this->db->where(array('i.supplier_id'=>$supplier_id,'p.product_id'=>$product_id));
        $this->db->order_by('p.id','desc');
		$query=$this->db->limit(1)->get()->row(); 
	//	echo $this->db->last_query();
		return $query->rate;
	}
	
	/* 
	public function purchase_return($purchase_id,$reason){
		$purchase=$this->retrieve_purchase_editdata($purchase_id);
		$data=array(
            'purchase_id' 		=>  $purchase[0]['purchase_id'],
			'chalan_no'		    =>	$purchase[0]['chalan_no'],
			'supplier_id'		=>	$purchase[0]['supplier_id'],
			'grand_total_amount'=>	$purchase[0]['grand_total_amount'],
			'po_id'	        	=>	$purchase[0]['po_id'],
			'purchase_date'	    =>	$purchase[0]['purchase_date'],
			'purchase_details'	=>	$purchase[0]['purchase_details'],
			'delivery_charges'	=>	$purchase[0]['delivery_charges'],
			'freight_charges'	=>	$purchase[0]['freight_charges'],
			'reason'			=>	$reason,
            'status' 			=>  1
			);
        $this->db->insert('return_product_purchase', $data);
 
         $this->db->where('purchase_id', $purchase_id);
        $this->db->delete('product_purchase');
		
        $this->db->where('transaction_id', $purchase_id);
        $this->db->delete('supplier_ledger');  
		
		foreach($purchase as $p)
		{
            $product_quantity = $p['item_qty'];
            $product_com_quantity = $p['comp_qty'];
            $product_rate = $p['rate'];
            $product_id = $p['product_id'];
            $total_price = $p['total_amount'];
            $product_discount = $p['discount'];
            $product_cgst = $p['cgst'];
            $product_sgst = $p['sgst'];
            $product_igst = $p['igst'];
            $product_utgst = $p['utgst'];
            $product_tax = $p['tax'];
			$purchase_detail_id = $p['purchase_detail_id'];
			$product_available_stk_qty = $p['available_stk_qty'];
			$product_updated_stk_qty = $p['updated_stk_qty'];
			
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
					$this->db->insert('return_product_purchase_details', $data1);
					$this->db->insert('return_product_purchase_details_edit', $data2);
					//Delete product_purchase_details table
				  	$this->db->where('purchase_id', $purchase_id);
					$this->db->delete('product_purchase_details');
					
					$this->db->where('purchase_id', $purchase_id);
					$this->db->delete('product_purchase_details_edit');  

		}
		
	} */
}
