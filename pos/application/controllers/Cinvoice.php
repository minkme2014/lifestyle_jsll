<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cinvoice extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'memo';
    }
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('linvoice');
		$content = $CI->linvoice->invoice_add_form();
		$this->template->full_admin_html_view($content);
	}
	//Search Inovoice Item
	public function search_inovoice_item()
	{
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->library('linvoice');
		
		$customer_id = $this->input->post('customer_id');
        $content = $CI->linvoice->search_inovoice_item($customer_id);
		$this->template->full_admin_html_view($content);
	}
	//Product Add Form
	public function manage_invoice()
	{	
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->library('linvoice');
		$CI->load->model('Invoices');

		#
        #pagination starts
        #
        $config["base_url"] = base_url('Cinvoice/manage_invoice/');
        $config["total_rows"] = $this->Invoices->invoice_list_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config["num_links"] = 5; 
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $links = $this->pagination->create_links();
        #
        #pagination ends
        #  
        $content =$this->linvoice->invoice_list($links,$config["per_page"],$page);
		$this->template->full_admin_html_view($content);
	}	
	
	public function manage_online_invoice()
	{	
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->library('linvoice');
		$CI->load->model('Invoices');

		#
        #pagination starts
        #
        $config["base_url"] = base_url('Cinvoice/manage_online_invoice/');
        $config["total_rows"] = $this->Invoices->online_invoice_list_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config["num_links"] = 5; 
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $links = $this->pagination->create_links();
        #
        #pagination ends
        #  
        $content =$this->linvoice->online_invoice_list($links,$config["per_page"],$page);
		$this->template->full_admin_html_view($content);
	}	
	
	
	//POS invoice page load
	public function pos_invoice(){
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('linvoice');
		$content = $CI->linvoice->pos_invoice_add_form();
		$this->template->full_admin_html_view($content);
	}


	//Insert Product and uload
	public function insert_invoice()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('Invoices');
		$invoice_id = $CI->Invoices->invoice_entry();
		$this->session->set_userdata(array('message'=>display('successfully_added')));
		$this->invoice_inserted_data($invoice_id);
	}
	//invoice Update Form
	public function invoice_update_form($invoice_id)
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('linvoice');
		$content = $CI->linvoice->invoice_edit_data($invoice_id);
		$this->template->full_admin_html_view($content);
	}
	// invoice Update
	public function invoice_update()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('Invoices');
		$invoice_id = $CI->Invoices->update_invoice();
		$this->session->set_userdata(array('message'=>display('successfully_updated')));
		$this->invoice_inserted_data($invoice_id);
	}
	//Retrive right now inserted data to cretae html
	public function invoice_inserted_data($invoice_id)
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('linvoice');
		$content = $CI->linvoice->invoice_html_data($invoice_id);		
		$this->template->full_admin_html_view($content);
	}
	
	public function online_invoice_inserted_data($invoice_id)
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('linvoice');
		$content = $CI->linvoice->online_invoice_html_data($invoice_id);		
		$this->template->full_admin_html_view($content);
	}
	
	public function invoice_challan($invoice_id)
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('linvoice');
		$content = $CI->linvoice->invoice_challan($invoice_id);		
		$this->template->full_admin_html_view($content);
	}
	//Retrive invoice by receipt id
	public function receipt_inserted_data($receipt_id)
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('linvoice');
		
		$content = $CI->linvoice->receipt_html_data($receipt_id);		
		$this->template->full_admin_html_view($content);
	}
	//Retrive right now inserted data to cretae html
	public function pos_invoice_inserted_data($invoice_id)
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('linvoice');
		$content = $CI->linvoice->pos_invoice_html_data($invoice_id);		
		$this->template->full_admin_html_view($content);
	}
	
	// retrieve_product_data
	public function retrieve_product_data()
	{	

		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Invoices');
		$product_id = $this->input->post('product_id');
		//$product_info = $CI->Invoices->retrieve_product_data($product_id);
		//$product_stock_check = $this->product_stock_check($product_id);

		$product_info = $CI->Invoices->get_total_product($product_id);

		echo json_encode($product_info);
	}
	public function po_retrieve_product_data()
	{	

		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Invoices');
		$product_id = $this->input->post('product_id');
		$supp_id = $this->input->post('supp_id');
		$product_info = $CI->Invoices->get_total_product_for_po($product_id,$supp_id);

		echo json_encode($product_info);
	}
	
	
	//Insert pos invoice
		public function insert_pos_invoice()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('Invoices');
        $CI->load->model('Web_settings');
        $Web_settings = $CI->Web_settings->retrieve_setting_editdata();
		$product_id = $this->input->post('product_id');
		$customer_id = $this->input->post('customer_id');
		
		
		$product_details = $CI->Invoices->pos_invoice_setup_product_code($product_id);
		
        $rate=0;
		if($Web_settings[0]['cust_price']=="1")
		{
	    	$p_rate=$CI->Invoices->check_pos_product_price($product_id,$customer_id);
            if($p_rate!="" || $p_rate!=null)
            {
                $rate=$p_rate;
            }else{
                $rate=$product_details->price;
            }
		}else
		{
		    $rate=$product_details->price;
		    
		}
		$tr = " ";
		if (!empty($product_details)){
			$product_id = $this->generator(5);
			$prd_qty=0;
			if($product_details->type==="Services")
			{
			    $prd_qty=0;
			}else{
			    $prd_qty=$product_details->total_product;
			}
			if($product_details->cgst!=0)
			{
				$cgst="CGST-<input type=\"text\" id=\"cgst_".$product_id."\" class=\"cgst_".$product_id."\" name=\"cgst[]\" onkeyup=\"quantity_calculate('".$product_id."');\"  onchange=\"quantity_calculate('".$product_id."');\" style=\"width:20px;border:none;\" value='".$product_details->cgst."' >";
			}else{
				$cgst="";
			}
			if($product_details->sgst!=0)
			{
				$sgst="SGST-<input type=\"text\" id=\"sgst_".$product_id."\" class=\"sgst_".$product_id."\" name=\"sgst[]\" onkeyup=\"quantity_calculate('".$product_id."');\"  onchange=\"quantity_calculate('".$product_id."');\" style=\"width:20px;border:none;\" value='".$product_details->sgst."' >";
			}else{
				$sgst="";
			}
			if($product_details->igst!=0)
			{
				$igst="IGST-<input type=\"text\" id=\"igst_".$product_id."\" class=\"igst_".$product_id."\" name=\"igst[]\" onkeyup=\"quantity_calculate('".$product_id."');\"  onchange=\"quantity_calculate('".$product_id."');\" style=\"width:20px;border:none;\" value='".$product_details->igst."' >";
			}else{
				$igst="";
			}
			if($product_details->utgst!=0)
			{
				$utgst="UTGST-<input type=\"text\" id=\"utgst_".$product_id."\" class=\"utgst_".$product_id."\" name=\"utgst[]\" onkeyup=\"quantity_calculate('".$product_id."');\"  onchange=\"quantity_calculate('".$product_id."');\" style=\"width:20px;border:none;\" value='".$product_details->utgst."' >";
			}else{
				$utgst="";
			}  			  	  
						
				
			$tr .= "<tr id=\"row_".$product_id."\">
						<td class=\"\" style=\"width:220px\">
							
							<input type=\"text\" name=\"product_name\" onkeypress=\"invoice_productList(1);\" class=\"form-control productSelection \" value='".$product_details->product_name."-(".$product_details->product_model.")"."-(".$product_details->code.")"."' placeholder='".display('product_name')."' required=\"\" id=\"product_name\" >


							<input type=\"hidden\" class=\"form-control autocomplete_hidden_value product_id_".$product_id."\" name=\"product_id[]\" id=\"SchoolHiddenId_".$product_id."\" value = \"$product_details->product_id\" />
							
						</td>
						<td>
						    <input type=\"text\" name=\"uom[]\" class=\"form-control text-right uom_1\" readonly=\"\" value='".$product_details->uom."' style='width:50px;'/>
                        </td>
						<td>
                            <input type=\"text\" name=\"available_quantity[]\" id=\"\" class=\"form-control text-right available_quantity_'".$product_id."'\" value='".$prd_qty."' readonly=\"\"/>
                        </td>

                       	<td>
                            <input type=\"number\" id='product_code_".$product_id."' name=\"cartoon[]\" onkeyup=\"quantity_calculate('".$product_id."');\" onchange=\"quantity_calculate('".$product_id."');\" class=\"quantity_".$product_id." form-control text-right\" value='".$product_details->cartoon_quantity."' min=\"1\" required/>
                        </td>
                        <td>
                            <input type=\"text\" value='".$product_details->cartoon_quantity."' class=\"ctnqntt_".$product_id." form-control text-right\" readonly=\"\" />
                        </td>
                        <td>
                            <input type=\"text\" name=\"product_quantity[]\" value='".$product_details->cartoon_quantity."' class=\"total_qntt_".$product_id." form-control text-right\" readonly=\"\" />
                        </td>


						<td style=\"width:85px\">
							<input type=\"text\" name=\"product_rate[]\" onkeyup=\"quantity_calculate('".$product_id."');\" onchange=\"quantity_calculate('".$product_id."');\" value='".$rate."' id=\"price_item_".$product_id."\" class=\"price_item1 form-control text-right\" style='width:67px;' required  />
						</td>

						<td class=\"\">
							<input type=\"number\" name=\"discount[]\" onkeyup=\"quantity_calculate('".$product_id."');\" onchange=\"quantity_calculate('".$product_id."');\" id=\"discount_".$product_id."\" class=\"form-control text-right\" value =\"0.00\" min=\"0\"/>
						</td>
						
						<td class=\"text-center\" width=\"16%\">
							<label class=\"switch\">
							  <input type=\"checkbox\" id=\"tax_".$product_id."\" class=\"tax_".$product_id."\" name=\"tax_".$product_id."\" onchange=\"quantity_calculate('".$product_id."');\" checked>
							  <span class=\"slider round\"></span>
							</label><br>".$cgst." ".$sgst." ".$igst." ".$utgst."
							
						</td>
						
						<td class=\"text-right\" style=\"width:100px\">
							<input class=\"total_price form-control text-right\" type=\"text\" name=\"total_price[]\" id=\"total_price_".$product_id."\" value='".$product_details->price."' tabindex=\"-1\" readonly=\"readonly\"/>
						</td>

						<td>
							<input type=\"hidden\" id=\"total_tax_".$product_id."\" class=\"total_tax_".$product_id."\" value='".$product_details->tax."'/>
							<input type=\"hidden\" id=\"type_".$product_id."\" name=\"type[]\" class=\"type_".$product_id."\" value='".$product_details->type."'/>
                            <input type=\"hidden\" id=\"all_tax_".$product_id."\" class=\" total_tax\" value='".($product_details->tax * $product_details->cartoon_quantity)."'/>

							<input type=\"hidden\" id=\"total_discount_".$product_id."\" class=\"total_tax_".$product_id."\" />
							<input type=\"hidden\" id=\"all_discount_".$product_id."\" class=\"total_discount\"/>
							<input type=\"hidden\" id=\"total_row_".$product_id."\" class=\"total_row_".$product_id."\" />
							<input type=\"hidden\" id=\"tax_row_".$product_id."\" class=\"tax_row\" name=\"tax_row[]\" />


							<button style=\"text-align: right;\" class=\"btn btn-danger\" type=\"button\" value='".display('delete')."' onclick=\"deleteRow(this)\">".display('delete')."</button>
						</td>
					</tr>";
			echo $tr;

		}else{
			return false;
		}
	}
/*	public function insert_pos_invoice()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('Invoices');
		$product_id = $this->input->post('product_id');
		
		$product_details = $CI->Invoices->pos_invoice_setup_product_code($product_id);

		$tr = " ";
		if (!empty($product_details)){
			$product_id = $this->generator(5);
			$prd_qty=0;
			if($product_details->type==="Services")
			{
			    $prd_qty=0;
			}else{
			    $prd_qty=$product_details->total_product;
			}
			$tr .= "<tr id=\"row_".$product_id."\">
						<td class=\"\" style=\"width:220px\">
							
							<input type=\"text\" name=\"product_name\" onkeypress=\"invoice_productList(1);\" class=\"form-control productSelection \" value='".$product_details->product_name."-(".$product_details->product_model.")"."-(".$product_details->code.")"."' placeholder='".display('product_name')."' required=\"\" id=\"product_name\" >


							<input type=\"hidden\" class=\"form-control autocomplete_hidden_value product_id_".$product_id."\" name=\"product_id[]\" id=\"SchoolHiddenId_".$product_id."\" value = \"$product_details->product_id\" />
							
						</td>
						<td>
						    <input type=\"text\" name=\"uom[]\" class=\"form-control text-right uom_1\" readonly=\"\" value='".$product_details->uom."' style='width:50px;'/>
                        </td>
						<td>
                            <input type=\"text\" name=\"available_quantity[]\" id=\"\" class=\"form-control text-right available_quantity_'".$product_id."'\" value='".$prd_qty."' readonly=\"\"/>
                        </td>

                       	<td>
                            <input type=\"number\" id='product_code_".$product_id."' name=\"cartoon[]\" onkeyup=\"quantity_calculate('".$product_id."');\" onchange=\"quantity_calculate('".$product_id."');\" class=\"quantity_".$product_id." form-control text-right\" value='".$product_details->cartoon_quantity."' min=\"1\" required/>
                        </td>
                        <td>
                            <input type=\"text\" value='".$product_details->cartoon_quantity."' class=\"ctnqntt_".$product_id." form-control text-right\" readonly=\"\" />
                        </td>
                        <td>
                            <input type=\"text\" name=\"product_quantity[]\" value='".$product_details->cartoon_quantity."' class=\"total_qntt_".$product_id." form-control text-right\" readonly=\"\" />
                        </td>


						<td style=\"width:85px\">
							<input type=\"text\" name=\"product_rate[]\" onkeyup=\"quantity_calculate('".$product_id."');\" onchange=\"quantity_calculate('".$product_id."');\" value='".$product_details->price."' id=\"price_item_".$product_id."\" class=\"price_item1 form-control text-right\" style='width:67px;' required  />
						</td>

						<td class=\"\">
							<input type=\"number\" name=\"discount[]\" onkeyup=\"quantity_calculate('".$product_id."');\" onchange=\"quantity_calculate('".$product_id."');\" id=\"discount_".$product_id."\" class=\"form-control text-right\" value =\"0.00\" min=\"0\"/>
						</td>
						
						<td class=\"text-center\" width=\"16%\">
							<label class=\"switch\">
							  <input type=\"checkbox\" id=\"tax_".$product_id."\" class=\"tax_".$product_id."\" name=\"tax_".$product_id."\" onchange=\"quantity_calculate('".$product_id."');\" checked>
							  <span class=\"slider round\"></span>
							</label><br>
							  CGST-<input type=\"text\" id=\"cgst_".$product_id."\" class=\"cgst_".$product_id."\" name=\"cgst[]\" onkeyup=\"quantity_calculate('".$product_id."');\"  onchange=\"quantity_calculate('".$product_id."');\" style=\"width:20px;border:none;\" value='".$product_details->cgst."' >
							  SGST-<input type=\"text\" id=\"sgst_".$product_id."\" class=\"sgst_".$product_id."\" name=\"sgst[]\" onkeyup=\"quantity_calculate('".$product_id."');\"  onchange=\"quantity_calculate('".$product_id."');\" style=\"width:20px;border:none;\" value='".$product_details->sgst."' >
							  IGST-<input type=\"text\" id=\"igst_".$product_id."\" class=\"igst_".$product_id."\" name=\"igst[]\" onkeyup=\"quantity_calculate('".$product_id."');\"  onchange=\"quantity_calculate('".$product_id."');\" style=\"width:20px;border:none;\" value='".$product_details->igst."' >
						</td>
						
						<td class=\"text-right\" style=\"width:100px\">
							<input class=\"total_price form-control text-right\" type=\"text\" name=\"total_price[]\" id=\"total_price_".$product_id."\" value='".$product_details->price."' tabindex=\"-1\" readonly=\"readonly\"/>
						</td>

						<td>
							<input type=\"hidden\" id=\"total_tax_".$product_id."\" class=\"total_tax_".$product_id."\" value='".$product_details->tax."'/>
							<input type=\"hidden\" id=\"type_".$product_id."\" name=\"type[]\" class=\"type_".$product_id."\" value='".$product_details->type."'/>
                            <input type=\"hidden\" id=\"all_tax_".$product_id."\" class=\" total_tax\" value='".($product_details->tax * $product_details->cartoon_quantity)."'/>

							<input type=\"hidden\" id=\"total_discount_".$product_id."\" class=\"total_tax_".$product_id."\" />
							<input type=\"hidden\" id=\"all_discount_".$product_id."\" class=\"total_discount\"/>
							<input type=\"hidden\" id=\"total_row_".$product_id."\" class=\"total_row_".$product_id."\" />
							<input type=\"hidden\" id=\"tax_row_".$product_id."\" class=\"tax_row\" name=\"tax_row[]\" />


							<button style=\"text-align: right;\" class=\"btn btn-danger\" type=\"button\" value='".display('delete')."' onclick=\"deleteRow(this)\">".display('delete')."</button>
						</td>
					</tr>";
			echo $tr;

		}else{
			return false;
		}
	}*/
	// product_delete
	public function invoice_delete()
	{	
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Invoices');
		$invoice_id =  $_POST['invoice_id'];
		
		// $tran_id = $this->db->select('transaction_id')->from('customer_ledger')->where('invoice_no', $invoice_id)->get()->result();
		
		$result = $CI->Invoices->delete_invoice($invoice_id);
	
		if ($result) {
			$this->session->set_userdata(array('message'=>display('successfully_delete')));
			return true;
		}	
	}
	// invoice_item_delete
	public function invoice_item_delete()
	{	
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Invoices');
		$invoice_details_id =  $_POST['invoice_details_id'];
		
		$result = $CI->Invoices->delete_invoice_item($invoice_details_id);
	
		if ($result) {
			$this->session->set_userdata(array('message'=>display('successfully_delete')));
			return true;
		}	
	}
	//AJAX INVOICE STOCKs
	public function product_stock_check($product_id)
	{
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Invoices');
		//$product_id =  $this->input->post('product_id');

		$purchase_stocks = $CI->Invoices->get_total_purchase_item($product_id);	
		$total_purchase = 0;		
		if(!empty($purchase_stocks)){	
			foreach($purchase_stocks as $k=>$v){
				$total_purchase = ($total_purchase + $purchase_stocks[$k]['quantity']);
			}
		}
		$sales_stocks = $CI->Invoices->get_total_sales_item($product_id);
		$total_sales = 0;	
		if(!empty($sales_stocks)){	
			foreach($sales_stocks as $k=>$v){
				$total_sales = ($total_sales + $sales_stocks[$k]['quantity']);
			}
		}
		
		$final_total = ($total_purchase - $total_sales);
		return $final_total ;
	}

	//This function is used to Generate Key
	public function generator($lenth)
	{
		$number=array("1","2","3","4","5","6","7","8","9");
	
		for($i=0; $i<$lenth; $i++)
		{
			$rand_value=rand(0,8);
			$rand_number=$number["$rand_value"];
		
			if(empty($con))
			{ 
			$con=$rand_number;
			}
			else
			{
			$con="$con"."$rand_number";}
		}
		return $con;
	}
	// check_product_price
	public function check_product_price()
	{	
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Invoices');
		$product_id = $this->input->post('product_id');
		$customer_id = $this->input->post('customer_id');
		$product_price = $CI->Invoices->check_product_price($product_id,$customer_id);
		if($product_price=="")
		{
			$product_price=0;
			echo $product_price;
		}else{
			echo $product_price;
		}
	}
	public function getProductInformation()
	{
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Invoices');
		$search=$_POST['search'];
		$product_list = $CI->Invoices->getProductInformation($search);
		echo json_encode($product_list);
		die;
	}
	
	public function getTotalSaleCategoryWise()
	{
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Invoices');
		$totalSale = $CI->Invoices->getTotalSaleCategoryWise();
		echo json_encode($totalSale);
		die;
	}
	
	public function odr_manufacturing_costing()
	{	
        if ($this->session->userdata('user_type') == '2') {
            $this->session->set_userdata(array('error_message' => display('you_are_not_access_this_part')));
            redirect('Admin_dashboard');
        }
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lreport');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $content = $CI->lreport->odr_manufacturing_costing($from_date, $to_date);
        $this->template->full_admin_html_view($content);
	}
	
	public function sales_record()
	{	
        if ($this->session->userdata('user_type') == '2') {
            $this->session->set_userdata(array('error_message' => display('you_are_not_access_this_part')));
            redirect('Admin_dashboard');
        }
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lreport');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $content = $CI->lreport->sales_record($from_date, $to_date);
        $this->template->full_admin_html_view($content);
	}
	
	public function add_odr_manufacture()
	{
		$invoice_detail_id=$_POST['invoice_detail_id'];
		$data=array(
		'row_material'=>$_POST['raw_material'],
		'invoice_detail_id'=>$_POST['invoice_detail_id'],
		'exp_qty'=>$_POST['exp_qty'],
		'exp_cost'=>$_POST['exp_cost'],
		'actual_qty'=>$_POST['actual_qty'],
		'actual_costing'=>$_POST['act_cost'],
		'embroidery_time'=>$_POST['embroidery_time'],
		'invoice_id'=>$_POST['invoice_id'],
		'product_id'=>$_POST['product_id'],
		'cust_id'=>$_POST['customer_id'],
		);
		
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Invoices');
		$response=$CI->Invoices->add_odr_manufacture($data,$invoice_detail_id);
		if($response==true)
		{
			echo "successfully added";
		}else{
			echo "Something went wrong";
		}
		//echo $response;
		die;
	}
	
	public function add_sale_record()
	{
		$invoice=$_POST['invoice'];
		$data=array(
		'query_placement'=>$_POST['placement'],
		'influence'=>$_POST['influence'],
		'bank_charges_per'=>$_POST['bank_charges_per'],
		'bank_charges'=>$_POST['bank_charges'],
		'shipping_date'=>$_POST['shipping_date'],
		'shipping_through'=>$_POST['shipping_through'],
		'weight'=>$_POST['weight'],
		'delivery_date'=>$_POST['delivery_date'],
		'feedback'=>$_POST['feedback'],
		'sales_record'=>'1',
		);
		
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Invoices');
		$response=$CI->Invoices->add_sale_record($data,$invoice);
		if($response==true)
		{
			echo "successfully added";
		}else{
			echo "Something went wrong";
		}
		//echo $response;
		die;
	}

    public function manufacturing_costing() {
        $this->load->library('linvoice');
        $content = $this->linvoice->manufacturing_costing();
        $this->template->full_admin_html_view($content);
    }
	
    public function insert_manufacturing_costing() {
        $data = array(
            'user_id' => $this->input->post('user'),
            'customer_id' => $this->input->post('customer'),
            'm_date' => $this->input->post('date'),
            'total_working_hr' => $this->input->post('total_working_hr'),
            'sample_work' => $this->input->post('sample_work'),
            'sample_hr' => $this->input->post('sample_hr'),
            'rate_per_hour' => $this->input->post('rate_per_hour'),
            'individual_price' => $this->input->post('individual_price'),
            'odr_work' => $this->input->post('odr_work'),
            'odr_hr' => $this->input->post('odr_hr'),
            'rate_per_hr' => $this->input->post('rate_per_hr'),
            'total_hr_worked' => $this->input->post('total_hr_worked'),
            'total_price_per_day' => $this->input->post('total_price_per_day'),
            'work_from_home' => $this->input->post('work_from_home'),
            'price_paid' => $this->input->post('price_paid'),
        );
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Invoices');
        $result = $this->Invoices->insert_manufacturing_costing($data);
        if ($result == TRUE) {
            
            $this->session->set_userdata(array('message' => display('successfully_added')));
            if (isset($_POST['add'])) {
                redirect(base_url('Cinvoice/manufacturing_costing'));
                exit;
            } 
        } else {
            
                $this->session->set_userdata(array('error_message' => "Something Wrong"));
                redirect(base_url('Cinvoice/manufacturing_costing'));
        }
    }
	
	public function get_invoice()
	{	
		$invoice_id=$_POST['invoice_id'];
		$CI =& get_instance();
		$CI->load->model('Invoices');
		$invoice_detail = $CI->Invoices->retrieve_invoice_editdata($invoice_id);
		echo json_encode($invoice_detail);
	}
	
	public function invoice_return()
	{	
		$CI =& get_instance();
		$CI->load->model('Invoices');
		$invoice_detail = $CI->Invoices->invoice_return();
		$this->session->set_userdata(array('message'=>display('successfully_updated')));
        redirect(base_url('Cinvoice/manage_invoice'));
		/* $invoice_id=$_POST['invoice_id'];
		$reason=$_POST['reason'];
		$CI =& get_instance();
		$CI->load->model('Invoices');
		$invoice_detail = $CI->Invoices->invoice_return($invoice_id,$reason);
		$this->session->set_userdata(array('message'=>display('successfully_updated')));
		return true; */
	}
	
	
}