<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lpurchase {
	// Retrieve  Quize List From DB
	public function purchase_list($links,$per_page,$page)
	{
		$CI =& get_instance();
		$CI->load->model('Purchases');
		$CI->load->model('Web_settings');
		$CI->load->library('occational');
        $CI->load->model('Userm');
		$permission = $CI->Userm->get_permission("manage_purchase");
		$purchases_list = $CI->Purchases->purchase_list($per_page,$page);
		if(!empty($purchases_list)){	
			$j=0;
			foreach($purchases_list as $k=>$v){
				$purchases_list[$k]['final_date'] = $CI->occational->dateConvert($purchases_list[$j]['purchase_date']);
			  $j++;
			}
		
			$i=0;
			foreach($purchases_list as $k=>$v){$i++;
			   $purchases_list[$k]['sl']=$i;
			}
		}
		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$data = array(
				'title' => 'Purchases List',
				'purchases_list' => $purchases_list,
				'links' => $links,
				'currency' => $currency_details[0]['currency'],
				'position' => $currency_details[0]['currency_position'],
				'edited' => $permission->edited,
				'deleted' => $permission->deleted,
				'created' => $permission->created,
				'view' => $permission->view,
			);

		$purchaseList = $CI->parser->parse('purchase/purchase',$data,true);
		return $purchaseList;
	}
	//Purchase Item By Search
	public function purchase_by_search($supplier_id)
	{
		$CI =& get_instance();
		$CI->load->model('Purchases');
		$CI->load->library('occational');
		$purchases_list = $CI->Purchases->purchase_by_search($supplier_id);
		$j=0;
		if(!empty($purchases_list)){
			foreach($purchases_list as $k=>$v){
				$purchases_list[$k]['final_date'] = $CI->occational->dateConvert($purchases_list[$j]['purchase_date']);
			  $j++;
			}
			$i=0;
			foreach($purchases_list as $k=>$v){$i++;
			   $purchases_list[$k]['sl']=$i;
			}
		}
		$data = array(
				'purchases_list' => $purchases_list
			);
		$purchaseList = $CI->parser->parse('purchase/purchase',$data,true);
		return $purchaseList;
	}
	//Sub Category Add
	public function purchase_add_form()
	{
		$CI =& get_instance();
		$CI->load->model('Purchases');
		$CI->load->model('Products');
        $CI->load->model('Userm');
		$permission = $CI->Userm->get_permission("add_purchase");
		$all_supplier = $CI->Purchases->select_all_supplier();
		$all_product = $CI->Purchases->select_all_product();
        $uom_list = $CI->Products->uom_list();

		$data = array(
				'title' => 'Add Purchase',
				'all_supplier' => $all_supplier,
				'all_product' => $all_product,
                'uom_list' => $uom_list,
				'edited' => $permission->edited,
				'deleted' => $permission->deleted,
				'created' => $permission->created,
				'view' => $permission->view,
				
			);
		$purchaseForm = $CI->parser->parse('purchase/add_purchase_form',$data,true);
		return $purchaseForm;
	}
	public function insert_purchase($data)
	{
		$CI =& get_instance();
		$CI->load->model('Purchases');
        $CI->Purchases->purchase_entry($data);
		return true;
	}
	//purchase Edit Data
	public function purchase_edit_data($purchase_id)
	{
		$CI =& get_instance();
		$CI->load->model('Purchases');
		$CI->load->model('Suppliers');

		$purchase_detail = $CI->Purchases->retrieve_purchase_editdata($purchase_id);
		$supplier_id = $purchase_detail[0]['supplier_id'];
		$supplier_list=$CI->Suppliers->supplier_list("110","0");
		$supplier_selected=$CI->Suppliers->supplier_search_item($supplier_id);
		$all_supplier = $CI->Purchases->select_all_supplier();

		//if(!empty($purchase_detail)){
			//foreach($purchase_detail as $k=>$val){
				//$purchase_detail[$k]['cartoon'] = ($val['quantity']/$val['cartoon_quantity']);
			//}
			//$i=0;
			//foreach($purchase_detail as $k=>$v){$i++;
			   //$purchase_detail[$k]['sl']=$i;
			//}
		//}
		
		$data=array(
			'title'				=>	"Purchase edit",
			'purchase_id'		=>	$purchase_detail[0]['purchase_id'],
			'chalan_no'			=>	$purchase_detail[0]['chalan_no'],
			'supplier_name'		=>	$purchase_detail[0]['supplier_name'],
			'supplier_id'		=>	$purchase_detail[0]['supplier_id'],
			'grand_total'		=>	$purchase_detail[0]['grand_total_amount'],
			'purchase_details'	=>	$purchase_detail[0]['purchase_details'],
			'purchase_date'		=>	$purchase_detail[0]['purchase_date'],
			'purchase_info'		=>	$purchase_detail,
			'supplier_list'		=>	$supplier_list,
			'supplier_selected'	=>	$supplier_selected,
			'all_supplier'      =>  $all_supplier,

			);

		$chapterList = $CI->parser->parse('purchase/edit_purchase_form',$data,true);
		return $chapterList;
	}
	//Search purchase
	public function purchase_search_list($cat_id,$company_id)
	{
		$CI =& get_instance();
		$CI->load->model('Purchases');
		$category_list = $CI->Purchases->retrieve_category_list();
		$purchases_list = $CI->Purchases->purchase_search_list($cat_id,$company_id);
		$data = array(
				'title' => 'Purchases List',
				'purchases_list' => $purchases_list,
				'category_list' => $category_list
			);
		$purchaseList = $CI->parser->parse('purchase/purchase',$data,true);
		return $purchaseList;
	}
	//Purchase html Data
	
	public function purchase_details_data($purchase_id)
	{
	
		$CI =& get_instance();
		$CI->load->model('Purchases');
		$CI->load->model('Web_settings');
		$CI->load->library('occational');
	
		$purchase_detail = $CI->Purchases->purchase_details_data($purchase_id);
		
		if(!empty($purchase_detail)){
			$i = 0;
			foreach($purchase_detail as $k=>$v){$i++;
			   $purchase_detail[$k]['sl']=$i;
			   $purchase_detail[$k]['cartoon']=$purchase_detail[$k]['quantity']/$purchase_detail[$k]['cartoon_quantity'];
			}
			
			foreach($purchase_detail as $k=>$v){
			   $purchase_detail[$k]['convert_date'] = $CI->occational->dateConvert($purchase_detail[$k]['purchase_date']);
			}
			
		}
		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$company_info = $CI->Purchases->retrieve_company();
		$data=array(
			'purchase_id'		=>	$purchase_detail[0]['purchase_id'],
			'purchase_details'	=>	$purchase_detail[0]['purchase_details'],
			'supplier_name'		=>	$purchase_detail[0]['supplier_name'],
			'final_date'		=>	$purchase_detail[0]['convert_date'],
			'sub_total_amount'	=>	number_format($purchase_detail[0]['grand_total_amount'], 2, '.', ','),
			'chalan_no'			=>	$purchase_detail[0]['chalan_no'],
			'purchase_all_data'	=>	$purchase_detail,
			'company_info'		=>	$company_info,
			'currency' 			=> $currency_details[0]['currency'],
			'position' 			=> $currency_details[0]['currency_position'],
			);
	
		$chapterList = $CI->parser->parse('purchase/purchase_detail',$data,true);
		return $chapterList;
	}
}
?>