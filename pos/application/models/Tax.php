<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tax extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    //add tax
    public function insert_tax($data)
    {
		$this->db->query("ALTER TABLE product_information ADD ".strtolower($data['tax_name'])." float DEFAULT 0");
		/* echo $this->db->last_query();
		die;  */
        return $this->db->insert('tbl_taxes',$data);
    }
    //tax List
    public function tax_list_count() {
        $this->db->select('*');
        $this->db->from('tbl_taxes');
        $this->db->order_by('tax_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
    
    
    //tax List
    public function tax_list($per_page, $page) {
        $this->db->select('*');
        $this->db->from('tbl_taxes');
        $this->db->order_by('tax_id', 'desc');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // Delete activity
    public function delete_tax($tax_id) {
        $this->db->where('tax_id', $tax_id);
        $this->db->delete('tbl_taxes');
        return true;
    }

    //Retrieve activity Edit Data
    public function retrieve_tax_editdata($tax_id) {
        $this->db->select('*');
        $this->db->from('tbl_taxes');
        $this->db->where('tax_id', $tax_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    //Update activity
    public function update_tax($data, $tax_id) {
		
		$old_name= $this->input->post('old_name');
		$this->db->query("ALTER TABLE product_information CHANGE ".$old_name." ".strtolower($data['tax_name'])." FLOAT NULL DEFAULT '0';");
		//$this->db->query("ALTER TABLE product_information CHANGE  ".$old_name." ".strtolower($data['tax_name']));
		//echo $this->db->last_query();die;
        $this->db->where('tax_id', $tax_id);
        $this->db->update('tbl_taxes', $data);
        return true;
    }
	

}
