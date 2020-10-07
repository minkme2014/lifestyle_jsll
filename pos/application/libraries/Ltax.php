<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ltax {

    //Sub Category Add
    public function tax_add_form() {
        $CI = & get_instance();
        $CI->load->model('Userm');
		$permission = $CI->Userm->get_permission("add_tax");
        $data = array(
            'title' => 'Add Tax',
            'edited' => $permission->edited,
            'deleted' => $permission->deleted,
            'created' => $permission->created,
            'view' => $permission->view,
        );
        $customerForm = $CI->parser->parse('tax/add_tax_form.php', $data, true);
        return $customerForm;
    }
    
    //Retrieve tax List	
    public function tax_list($links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('Tax');
        $CI->load->model('Web_settings');
        $CI->load->model('Userm');
		$permission = $CI->Userm->get_permission("manage_tax");
        $tax_list = $CI->Tax->tax_list($per_page, $page);
        $i = 0;
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title' => 'Tax List',
            'tax_list' => $tax_list,
            'links' => $links,
            'edited' => $permission->edited,
            'deleted' => $permission->deleted,
            'created' => $permission->created,
            'view' => $permission->view,
        );
        $taxList = $CI->parser->parse('tax/tax_list', $data, true);
        return $taxList;
    }

    //tax Edit Data
    public function tax_edit_data($tax_id) {
        $CI = & get_instance();
        $tax_detail = $CI->Tax->retrieve_tax_editdata($tax_id);
        $data = array(
            'tax_id' => $tax_detail[0]['tax_id'],
            'tax_name' => $tax_detail[0]['tax_name'],
            'tax_per' => $tax_detail[0]['tax_per'],
        );
        $chapterList = $CI->parser->parse('tax/edit_tax_form', $data, true);
        return $chapterList;
    }

}

?>