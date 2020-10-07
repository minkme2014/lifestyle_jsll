<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Csalesorder extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'memo';
    }
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lsalesorder');
		$content = $CI->lsalesorder->salesorder_add_form();
		$this->template->full_admin_html_view($content);
	}
	
	//Insert sales order 
	public function insert_sales_order()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('Salesorder');
		$invoice_id = $CI->Salesorder->sales_odr_entry();
		$this->session->set_userdata(array('message'=>display('successfully_added')));
        redirect(base_url('Csalesorder/manage_sales_odr'));
	}
	//Product Add Form
	public function manage_sales_odr()
	{	
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->library('lsalesorder');
		$CI->load->model('Salesorder');

		#
        #pagination starts
        #
        $config["base_url"] = base_url('Csalesorder/manage_sales_odr/');
        $config["total_rows"] = $this->Salesorder->sales_odr_list_count();
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
        $content =$this->lsalesorder->sales_odr_list($links,$config["per_page"],$page);
		$this->template->full_admin_html_view($content);
	}	
	
	// sales_order_delete
	public function sales_order_delete()
	{	
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Salesorder');
		$odr_id =  $_POST['odr_id'];
		
		$result = $CI->Salesorder->delete_salesorder($odr_id);
	
		if ($result) {
			$this->session->set_userdata(array('message'=>display('successfully_delete')));
			return true;
		}	
	}
	//Retrive right now inserted data to cretae html
	public function sales_odr_inserted_data($odr_id)
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lsalesorder');
		$content = $CI->lsalesorder->salesorder_html_data($odr_id);		
		$this->template->full_admin_html_view($content);
	}
	
}