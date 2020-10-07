<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cpurchaseorder extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'purchase_order';
    }
	public function index()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lpurchaseorder');
		$content = $CI->lpurchaseorder->po_add_form();
		$this->template->full_admin_html_view($content);
	}
	//Insert Po
	public function insert_po()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('Purchases_order');
		$CI->Purchases_order->po_entry();
		$this->session->set_userdata(array('message'=>display('successfully_added')));
		if(isset($_POST['add-purchase'])){
			redirect(base_url('Cpurchaseorder/manage_po'));
			exit;
		}elseif(isset($_POST['add-purchase-another'])){
			redirect(base_url('Cpurchaseorder'));
			exit;
		}
	}
	//Po listing
	public function manage_po()
	{
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->library('lpurchaseorder');
		$CI->load->model('Purchases_order');

		#
        #pagination starts
        #
        $config["base_url"] = base_url('Cpurchaseorder/manage_po/');
        $config["total_rows"] = $this->Purchases_order->count_purchase();
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
        $content =$this->lpurchaseorder->po_list($links,$config["per_page"],$page);
      
		$this->template->full_admin_html_view($content);
	}
	
	
	// po_delete
	public function po_delete()
	{	
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Purchases_order');
		$po_id =  $_POST['po_id'];
		$CI->Purchases_order->delete_po($po_id);
		$this->session->set_userdata(array('message'=>display('successfully_delete')));
		return true;
			
	}
	
	
	//po Update Form
	public function po_update_form($po_id)
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lpurchaseorder');
		$content = $CI->lpurchaseorder->po_edit_data($po_id);
		$this->template->full_admin_html_view($content);
	}
	// po Update
	public function po_update()
	{
	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('Purchases_order');
		$CI->Purchases_order->update_po();
		$this->session->set_userdata(array('message'=>display('successfully_updated')));
		redirect(base_url('Cpurchaseorder/manage_po'));
		exit;
	}
	//Retrive right now inserted data to cretae html
	public function po_inserted_data($po_id)
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lpurchaseorder');
		$content = $CI->lpurchaseorder->po_html_data($po_id);		
		$this->template->full_admin_html_view($content);
	}


}