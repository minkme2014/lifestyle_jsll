<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lmanualconsumption {
	//Retrieve  Customer List	
	public function manualconsumption_list($date)
	{
		$CI =& get_instance();
		$CI->load->model('Manualconsumption');
        $CI->load->model('Userm');
		$permission = $CI->Userm->get_permission("manage_manualconsumption");
		$manualconsumption_list = $CI->Manualconsumption->manualconsumption_list($date);  //It will get only Credit Customers
		$i=0;
		$total=0;
		if(!empty($manualconsumption_list)){	
			foreach($manualconsumption_list as $k=>$v){$i++;
			   $manualconsumption_list[$k]['sl']=$i;
			}
		}
		$data = array(
				'title' => 'Manualconsumption List',
				'manualconsumption_list' => $manualconsumption_list,
            'edited' => $permission->edited,
            'deleted' => $permission->deleted,
            'created' => $permission->created,
            'view' => $permission->view,
			);
		$customerList = $CI->parser->parse('manualconsumption/manualconsumption',$data,true);
		return $customerList;
	}
	//Sub Category Add
	public function manualconsumption_add_form()
	{
		$CI =& get_instance();
		$CI->load->model('Manualconsumption');
        $CI->load->model('Userm');
		$permission = $CI->Userm->get_permission("add_manualconsumption");
		$all_product = $CI->Manualconsumption->select_all_product();
		$all_manualconsumption_reason = $CI->Manualconsumption->select_all_manualconsumption_reason();
		$data = array(
				'title' => 'Add Manual Consumption',
				'all_product' => $all_product,
				'all_manualconsumption_reason'  => $all_manualconsumption_reason,
				'edited' => $permission->edited,
				'deleted' => $permission->deleted,
				'created' => $permission->created,
				'view' => $permission->view,
			);
		$customerForm = $CI->parser->parse('manualconsumption/add_manualconsumption_form',$data,true);
		return $customerForm;
	}

	//customer Edit Data
	public function manualconsumption_edit_data($manualconsumption_id)
	{
		$CI =& get_instance();
		$CI->load->model('Manualconsumption');
		$all_product = $CI->Manualconsumption->select_all_product();
		$all_manualconsumption_reason = $CI->Manualconsumption->select_all_manualconsumption_reason();
		$manualconsumption_detail = $CI->Manualconsumption->retrieve_manualconsumption_editdata($manualconsumption_id);
		$data=array(
			'manualconsumption_id' 			=> $manualconsumption_detail[0]['manualconsumption_id'],
			'product_id' 		            => $manualconsumption_detail[0]['product_id'],
			'qty' 				            => $manualconsumption_detail[0]['qty'],
			'reason' 				        => $manualconsumption_detail[0]['reason'],
			'all_product'				    => $all_product,
			'all_manualconsumption_reason'  => $all_manualconsumption_reason
			);
		$chapterList = $CI->parser->parse('manualconsumption/edit_manualconsumption_form',$data,true);
		return $chapterList;
	}
	//Search customer
	public function customer_search_list($cat_id,$company_id)
	{
		$CI =& get_instance();
		$CI->load->model('Customers');
		$category_list = $CI->Customers->retrieve_category_list();
		$customers_list = $CI->Customers->customer_search_list($cat_id,$company_id);
		$data = array(
				'title' => 'customers List',
				'customers_list' => $customers_list,
				'category_list' => $category_list
			);
		$customerList = $CI->parser->parse('customer/customer',$data,true);
		return $customerList;
	}
}
?>