<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lpurchaseorder {
    
    
	//Sub Category Add
	public function po_add_form()
	{
		$CI =& get_instance();
		$CI->load->model('Purchases');
		$CI->load->model('Products');
		$CI->load->model('Purchases_order');
		$CI->load->model('Web_settings');
        $CI->load->model('Userm');
		$permission = $CI->Userm->get_permission("add_po");
		$all_supplier = $CI->Purchases->select_all_supplier();
		$all_product = $CI->Purchases->select_all_product();
        $uom_list = $CI->Products->uom_list();
        $po_no = $CI->Purchases_order->get_po_no();
		$data = array(
				'title' => 'Add PO',
				'all_supplier' => $all_supplier,
				'all_product' => $all_product,
                'uom_list' => $uom_list,
                'po_no'=>$po_no,
				'edited' => $permission->edited,
				'deleted' => $permission->deleted,
				'created' => $permission->created,
				'view' => $permission->view,
				
			);
		$poForm = $CI->parser->parse('purchaseorder/add_po_form',$data,true);
		return $poForm;
	}
    
	// Retrieve  Quize List From DB
	public function po_list($links,$per_page,$page)
	{
		$CI =& get_instance();
		$CI->load->model('Purchases_order');
		$CI->load->model('Web_settings');
		$CI->load->library('occational');
        $CI->load->model('Userm');
		$permission = $CI->Userm->get_permission("manage_po");
		$po_list = $CI->Purchases_order->po_list($per_page,$page);
		if(!empty($po_list)){	
		
			$i=0;
			foreach($po_list as $k=>$v){$i++;
			   $po_list[$k]['sl']=$i;
			}
		}
		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$data = array(
				'title' => 'PO List',
				'po_list' => $po_list,
				'links' => $links,
				'currency' => $currency_details[0]['currency'],
				'position' => $currency_details[0]['currency_position'],
				'edited' => $permission->edited,
				'deleted' => $permission->deleted,
				'created' => $permission->created,
				'view' => $permission->view,
			);

		$poList = $CI->parser->parse('purchaseorder/po_list',$data,true);
		return $poList;
	}
	//po Edit Data
	public function po_edit_data($po_id)
	{
		$CI =& get_instance();
		$CI->load->model('Purchases_order');
		$CI->load->model('Suppliers');

		$po_detail = $CI->Purchases_order->retrieve_po_editdata($po_id);
		$all_supplier = $CI->Purchases_order->select_all_supplier();
		$supplier_id = $po_detail[0]['supplier_id'];
		$supplier_list=$CI->Suppliers->supplier_list("110","0");
		$supplier_selected=$CI->Suppliers->supplier_search_item($supplier_id);
		
		$data=array(
			'title'				=>	"PO edit",
			'po_id'	        	=>	$po_detail[0]['po_id'],
			'supplier_name'		=>	$po_detail[0]['supplier_name'],
			'supplier_id'		=>	$po_detail[0]['supplier_id'],
			'grand_total'		=>	$po_detail[0]['po_amount'],
			'po_date'	    	=>	$po_detail[0]['date'],
			'po_no'		        =>	$po_detail[0]['po_no'],
			'payment_terms'		=>	$po_detail[0]['payment_terms'],
			'delivery_charges'	=>	$po_detail[0]['delivery_charges'],
			'freight_charges'	=>	$po_detail[0]['freight_charges'],
			'po_info'	    	=>	$po_detail,
			'supplier_list'		=>	$supplier_list,
			'supplier_selected'	=>	$supplier_selected,
			'all_supplier'      => $all_supplier,

			);

		$chapterList = $CI->parser->parse('purchaseorder/edit_po_form',$data,true);
		return $chapterList;
	}
	
	
    //po html Data
    public function po_html_data($po_id) {
        $CI = & get_instance();
		$CI->load->model('Purchases_order');
		$CI->load->model('Suppliers');

		$po_detail = $CI->Purchases_order->retrieve_po_editdata($po_id);
		
        $CI->load->model('Invoices');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');

        $subTotal_quantity = 0;
        $subTotal_cartoon = 0;
        $subTotal_discount = 0;
        $subTotal_ammount = 0;
        if (!empty($po_detail)) {
   
            $i = 0;
            foreach ($po_detail as $k => $v) {
                $i++;
                $po_detail[$k]['sl'] = $i;
            }
        }
		$all_supplier = $CI->Purchases_order->select_all_supplier();
		$supplier_id = $po_detail[0]['supplier_id'];
		$supplier_list=$CI->Suppliers->supplier_list("110","0");
		$supplier_selected=$CI->Suppliers->supplier_search_item($supplier_id);
		
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $company_info = $CI->Invoices->retrieve_company();
        $data = array(
            'ttile' => "PO Details",
            'company_info'      => $company_info,
            'comp_name'      => $company_info[0]['company_name'],
			'po_id'	        	=>	$po_detail[0]['po_id'],
			'supplier_name'		=>	$po_detail[0]['supplier_name'],
			'supplier_address'	=>	$po_detail[0]['address'],
			'supplier_id'		=>	$po_detail[0]['supplier_id'],
			'grand_total'		=>	$po_detail[0]['po_amount'],
			'po_date'	    	=>	$po_detail[0]['date'],
			'po_no'		        =>	$po_detail[0]['po_no'],
			'payment_terms'		=>	$po_detail[0]['payment_terms'],
			'delivery_charges'	=>	$po_detail[0]['delivery_charges'],
			'freight_charges'	=>	$po_detail[0]['freight_charges'],
			'po_info'	    	=>	$po_detail,
			'supplier_list'		=>	$supplier_list,
			'supplier_selected'	=>	$supplier_selected,
			'all_supplier'      => $all_supplier,
			'delivery_address'  =>  $company_info[0]['address'],
			'delivery_address'  =>  $company_info[0]['address'],
			'sup_tin_no'    	=>	$po_detail[0]['sup_tin_no'],
			'sup_pan_no'    	=>	$po_detail[0]['sup_pan_no'],
			'sup_cin_no'	    =>	$po_detail[0]['sup_cin_no'],
			'sup_gstin'     	=>	$po_detail[0]['sup_gstin'],

        );

        $chapterList = $CI->parser->parse('purchaseorder/po_html', $data, true);
        return $chapterList;
    }
    //po html Data
	
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
	public function insert_purchase($data)
	{
		$CI =& get_instance();
		$CI->load->model('Purchases');
        $CI->Purchases->purchase_entry($data);
		return true;
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