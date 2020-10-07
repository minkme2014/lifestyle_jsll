<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manualconsumption extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	//customer List
	public function manualconsumption_list($date)
	{
		$this->db->select('*');
		$this->db->from('manualconsumption');
		$this->db->join('product_information','product_information.product_id = manualconsumption.product_id');
		$this->db->join('manualconsumption_reason','manualconsumption_reason.id = manualconsumption.reason');
		$this->db->where('manualconsumption.reason!=0');
		if (!empty($date)) {
            $this->db->where('created_on like "%'.$date.'%"');
        }
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}	
	//customer List
	public function manualconsumption_list_product()
	{
		$this->db->select('*');
		$this->db->from('manualconsumption');
		$this->db->where('manualconsumption.reason!=0');
		$this->db->where('status',1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	

    //Select All product List
    public function select_all_product() {
        $query = $this->db->select('*')
                ->from('product_information')
                ->where('status', '1')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	

    //Select All manualconsumption reason List
    public function select_all_manualconsumption_reason() {
        $query = $this->db->select('*')
                ->from('manualconsumption_reason')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	
	//customer List
	public function manualconsumption_list_count()
	{
		$this->db->select('*');
		$this->db->from('manualconsumption');
		$this->db->where('reason!=0');
		$this->db->where('status',1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();	
		}
		return false;
	}
	//Category Search Item
	public function manualconsumption_search_item($category_id)
	{
		$this->db->select('*');
		$this->db->from('manualconsumption');
		$this->db->where('manualconsumption_id',$manualconsumption_id);
		$this->db->limit('500');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Count customer
	public function manualconsumption_entry($data)
	{
		$this->db->select('*');
		$this->db->from('manualconsumption');
		$this->db->where('manualconsumption_id',$data['manualconsumption_id']);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return FALSE;
		}else{
			$this->db->insert('manualconsumption',$data);
			return TRUE;
		}
	}
	//Retrieve customer Edit Data
	public function retrieve_manualconsumption_editdata($manualconsumption_id)
	{
		$this->db->select('*');
		$this->db->from('manualconsumption');
		$this->db->where('manualconsumption_id',$manualconsumption_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	//Update Categories
	public function update_manualconsumption($data,$manualconsumption_id)
	{
		$this->db->where('manualconsumption_id',$manualconsumption_id);
		$this->db->update('manualconsumption',$data);
		return true;
	}
	// Delete customer Item
	public function delete_manualconsumption($manualconsumption_id)
	{
		$this->db->where('manualconsumption_id',$manualconsumption_id);
		$this->db->delete('manualconsumption'); 	
		return true;
	}
}