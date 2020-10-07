<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cpurchase extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'purchase';
    }
	public function index()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lpurchase');
		$content = $CI->lpurchase->purchase_add_form();
		$this->template->full_admin_html_view($content);
	}
	//Product Add Form
	public function manage_purchase()
	{
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->library('lpurchase');
		$CI->load->model('Purchases');

		#
        #pagination starts
        #
        $config["base_url"] = base_url('Cpurchase/manage_purchase/');
        $config["total_rows"] = $this->Purchases->count_purchase();
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
        $content =$this->lpurchase->purchase_list($links,$config["per_page"],$page);
      
		$this->template->full_admin_html_view($content);
	}
	//Insert Product and uload
	public function insert_purchase()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('Purchases');
		$CI->Purchases->purchase_entry();
		$this->session->set_userdata(array('message'=>display('successfully_added')));
		if(isset($_POST['add-purchase'])){
			redirect(base_url('Cpurchase/manage_purchase'));
			exit;
		}elseif(isset($_POST['add-purchase-another'])){
			redirect(base_url('Cpurchase'));
			exit;
		}
	}
	//purchase Update Form
	public function purchase_update_form($purchase_id)
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lpurchase');
		$content = $CI->lpurchase->purchase_edit_data($purchase_id);
		$this->template->full_admin_html_view($content);
	}
	// purchase Update
	public function purchase_update()
	{
	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('Purchases');
		$CI->Purchases->update_purchase();
		$this->session->set_userdata(array('message'=>display('successfully_updated')));
		redirect(base_url('Cpurchase/manage_purchase'));
		exit;
	}
	// product_delete
	public function purchase_delete()
	{	
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Purchases');
		$purchase_id =  $_POST['purchase_id'];
		$CI->Purchases->delete_purchase($purchase_id);
		$this->session->set_userdata(array('message'=>display('successfully_delete')));
		return true;
			
	}
	//Purchase item by search
	public function purchase_item_by_search()
	{
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->library('lpurchase');
		$supplier_id = $this->input->post('supplier_id');			
        $content = $CI->lpurchase->purchase_by_search($supplier_id);
		$this->template->full_admin_html_view($content);
	}
	//Product search by supplier id
	public function product_search_by_supplier(){

		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->library('lpurchase');
		$CI->load->model('Suppliers');
		$supplier_id = $this->input->post('supplier_id');			
        $content = $CI->Suppliers->product_search_item($supplier_id);

        if (empty($content)) {
        	echo display('product_not_found');
	    }else{
	    	// Select option created for product
	        echo "<select name=\"product_id[]\" class=\"productSelection form-control\" id=\"product_id\"  tabindex='5' >";
	        	echo "<option value=\"0\">".display('select_one')."</option>";
	        	foreach ($content as $product) {
	    			echo "<option value=".$product['product_id'].">";
	    			echo $product['product_name'];
	    			echo "</option>"; 
	        	}	
	        echo "</select>";
	    }
	}
	
	public function product_search_by_supplier1(){

		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->library('lpurchase');
		$CI->load->model('Suppliers');
		$supplier_id = $this->input->post('supplier_id');			
        $content = $CI->Suppliers->product_search_item($supplier_id);

        if (empty($content)) {
        	echo display('product_not_found');
	    }else{
	    	// Select option created for product
	        echo "<select name=\"product_id1[]\" class=\"productSelection form-control\" id=\"product_id\">";
	        	echo "<option value=\"0\">".display('select_one')."</option>";
	        	foreach ($content as $product) {
	    			echo "<option value=".$product['product_id'].">";
	    			echo $product['product_name'];
	    			echo "</option>"; 
	        	}	
	        echo "</select>";
	    }
	}
	public function product_search_by_supplier_purchase(){

		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->library('lpurchase');
		$CI->load->model('Suppliers');
		$supplier_id = $this->input->post('supplier_id');			
        $content = $CI->Suppliers->product_search_last_item($supplier_id);
        if (empty($content)) {
        	echo display('product_not_found');
	    }else{
	    			echo "<option value=".$content->product_id.">";
	    			echo $content->product_name;
	    			echo "</option>"; 
	    }
	}

	//Retrive right now inserted data to cretae html
	public function purchase_details_data($purchase_id)
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lpurchase');
		$content = $CI->lpurchase->purchase_details_data($purchase_id);	
		$this->template->full_admin_html_view($content);
	}
		
	// retrieve_product_data
	public function retrieve_product_purchase()
	{	
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Purchases');
		$product_id = $this->input->post('product_id');
		$product_info = $CI->Purchases->retrieve_product_purchase($product_id);

		echo json_encode($product_info);
	}
	
	public function getProductInformation()
	{
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Purchases');
		$search=$_POST['search'];
		$product_list = $CI->Purchases->getProductInformation($search);
		echo json_encode($product_list);
		die;
	}
	
	public function get_purchase()
	{	
		$purchase_id=$_POST['purchase_id'];
		$CI =& get_instance();
		$CI->load->model('Purchases');
		$purchase_detail = $CI->Purchases->retrieve_purchase_editdata($purchase_id);
		echo json_encode($purchase_detail);
	}
	
	public function purchase_return()
	{	
		$CI =& get_instance();
		$CI->load->model('Purchases');
		$purchase_detail = $CI->Purchases->purchase_return();
		$this->session->set_userdata(array('message'=>display('successfully_updated')));
		redirect(base_url('Cpurchase/manage_purchase'));
	/* 	die;
		$purchase_id=$_POST['purchase_id'];
		$reason=$_POST['reason'];
		$CI =& get_instance();
		$CI->load->model('Purchases');
		$purchase_detail = $CI->Purchases->purchase_return($purchase_id,$reason);
		$this->session->set_userdata(array('message'=>display('successfully_updated')));
		 */
	}
	// check_product_price
	public function check_product_price()
	{	
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Purchases');
		$product_id = $this->input->post('product_id');
		$supplier_id = $this->input->post('supplier_id');
		$product_price = $CI->Purchases->check_product_price($product_id,$supplier_id);
		if($product_price=="")
		{
			$product_price=0;
			echo $product_price;
		}else{
			echo $product_price;
		}
	}
}