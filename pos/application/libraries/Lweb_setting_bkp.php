<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lweb_setting {
	//Sub Category Add
	public function setting_add_form()
	{
		$CI =& get_instance();
		$CI->load->model('Web_settings');
		$setting_detail = $CI->Web_settings->retrieve_setting_editdata();
		$language = $CI->Web_settings->languages();
		$data = array(
			'title' 		=> 'Update Setting',
			'logo' 			=> $setting_detail[0]['logo'],
			'invoice_logo' 	=> $setting_detail[0]['invoice_logo'],
			'currency'		=> $setting_detail[0]['currency'],
			'currency_position'	=> $setting_detail[0]['currency_position'],
		//	'favicon'		=> $setting_detail[0]['favicon'],
			'footer_text'	=> $setting_detail[0]['footer_text'],
			'language'		=> $language,
			'rtr'			=> $setting_detail[0]['rtr'],
			'cin_no'			=> $setting_detail[0]['cin_no'],
			'invoice_terms'			=> $setting_detail[0]['invoice_terms'],
			'thermal_print'			=> $setting_detail[0]['thermal_print'],
			'custom_billing'			=> $setting_detail[0]['custom_billing'],
			'usr_commission'			=> $setting_detail[0]['usr_commission'],
			'print_kot'			=> $setting_detail[0]['print_kot'],
			'po_terms'			=> $setting_detail[0]['po_terms'],
			'po_num_series'			=> $setting_detail[0]['po_num_series'],
			//'captcha'			=> $setting_detail[0]['captcha'],
			//'site_key'		=> $setting_detail[0]['site_key'],
			//'secret_key'	=> $setting_detail[0]['secret_key'],
		);
		$setting = $CI->parser->parse('web_setting/web_setting',$data,true);
		return $setting;
	}

	//customer Edit Data
	public function category_edit_data($category_id)
	{
		$CI =& get_instance();
		$CI->load->model('Categories');
		$category_detail = $CI->Categories->retrieve_category_editdata($category_id);
		$data=array(
			'category_id' 			=> $category_detail[0]['category_id'],
			'category_name' 		=> $category_detail[0]['category_name'],
			'status' 				=> $category_detail[0]['status']
			);
		$chapterList = $CI->parser->parse('category/edit_category_form',$data,true);
		return $chapterList;
	}
}
?>