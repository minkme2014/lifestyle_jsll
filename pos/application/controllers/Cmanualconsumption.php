<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cmanualconsumption extends CI_Controller {
	public $menu;
	function __construct() {
      parent::__construct();
		$this->load->library('auth');
		$this->load->library('lmanualconsumption');
		$this->load->library('session');
		$this->load->model('Manualconsumption');
		$this->auth->check_admin_auth();
		$this->template->current_menu = 'manualconsumption';
	  
    }
	//Default loading for Category system.
	public function index()
	{
	//Calling Customer add form which will be loaded by help of "lcustomer,located in library folder"
		$content = $this->lmanualconsumption->manualconsumption_add_form();
	//Here ,0 means array position 0 will be active class
		$this->template->full_admin_html_view($content);
	}
	//Product Add Form
	public function manage_manualconsumption()
	{
		$date = $this->input->post('stock_date') ? $this->input->post('stock_date') : "";
        $content =$this->lmanualconsumption->manualconsumption_list($date);
		$this->template->full_admin_html_view($content);;
	}
	//Insert Product and upload
	public function insert_manualconsumption()
	{
		$manualconsumption_id=$this->auth->generator(15);

	  	//Customer  basic information adding.
		$data=array(
			'manualconsumption_id' 		=> $manualconsumption_id,
			'product_id' 		        => $this->input->post('product_id'),
			'qty' 		                => $this->input->post('qty'),
			'reason' 		            => $this->input->post('reason'),
			);

		$result=$this->Manualconsumption->manualconsumption_entry($data);
		if ($result == TRUE) {
			//Previous balance adding -> Sending to customer model to adjust the data.			
			$this->session->set_userdata(array('message'=>display('successfully_added')));
			if(isset($_POST['add-manualconsumption'])){
				redirect(base_url('Cmanualconsumption/manage_manualconsumption'));
				exit;
			}elseif(isset($_POST['add-manualconsumption-another'])){
				redirect(base_url('Cmanualconsumption'));
				exit;
			}
		}else{
			$this->session->set_userdata(array('error_message'=>display('already_inserted')));
			redirect(base_url('Cmanualconsumption'));
		}
	}
	//customer Update Form
	public function manualconsumption_update_form($manualconsumption_id)
	{	
		$content = $this->lmanualconsumption->manualconsumption_edit_data($manualconsumption_id);
		$this->menu=array('label'=> 'Edit Manual Consumption', 'url' => 'Cmanualconsumption');
		$this->template->full_admin_html_view($content);
	}
	// customer Update
	public function manualconsumption_update()
	{
		$this->load->model('Manualconsumption');
		$manualconsumption_id  = $this->input->post('manualconsumption_id');
		$data=array(
			'product_id' => $this->input->post('product_id'),
			'qty' 		=> $this->input->post('qty'),
			'reason' 		=> $this->input->post('reason'),
			);

		$this->Manualconsumption->update_manualconsumption($data,$manualconsumption_id);
		$this->session->set_userdata(array('message'=>display('successfully_updated')));
		redirect(base_url('Cmanualconsumption/manage_manualconsumption'));
		exit;
	}
	// product_delete
	public function manualconsumption_delete()
	{	
		$this->load->model('Manualconsumption');
		$manualconsumption_id =  $_POST['manualconsumption_id'];
		$this->Manualconsumption->delete_manualconsumption($manualconsumption_id);
		$this->session->set_userdata(array('message'=>display('successfully_delete')));
		return true;
			
	}
}