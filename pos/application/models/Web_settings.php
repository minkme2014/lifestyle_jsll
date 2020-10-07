<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Web_settings extends CI_Model {

	private $table  = "language";
    private $phrase = "phrase";

	public function __construct()
	{
		parent::__construct();
	}
	//Retrieve customer Edit Data
	public function retrieve_setting_editdata()
	{
		$this->db->select('*');
		$this->db->from('web_setting');
		$this->db->where('setting_id',1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	//Update Categories
	public function update_setting($data)
	{
		$this->db->where('setting_id',1);
		$this->db->update('web_setting',$data);
		return true;
	}

    public function languages()
    { 
        if ($this->db->table_exists($this->table)) { 

                $fields = $this->db->field_data($this->table);

                $i = 1;
                foreach ($fields as $field)
                {  
                    if ($i++ > 2)
                    $result[$field->name] = ucfirst($field->name);
                }

                if (!empty($result)) return $result; 

        } else {
            return false; 
        }
    }
    
    public function get_po_num_series()
    {
        
		$po_bit=$this->db->select('po_bit')->from('web_setting')->get()->row();
		if( $po_bit->po_bit==0)
		{
		    $query=$this->db->get('purchase_odr');
            if ($query->num_rows() > 0) {
                $this->db->select('po_no');
                $this->db->from('purchase_odr');
                $this->db->order_by('po_id', 'desc');
                $this->db->limit(1);
                $po_no = $this->db->get()->row(); 
                return $po_no->po_no+1;
            }else{
                $po_no=$this->db->select('po_num_series')->from('web_setting')->get()->row();
                return $po_no->po_num_series;
            }
		}else{
                $po_no=$this->db->select('po_num_series')->from('web_setting')->get()->row();
                return $po_no->po_num_series;
            }
        
    }
    public function get_sales_odr_series()
    {
        
		$sales_odr_bit=$this->db->select('sales_odr_bit')->from('web_setting')->get()->row();
		if( $sales_odr_bit->sales_odr_bit==0)
		{
		    $query=$this->db->get('sales_order');
            if ($query->num_rows() > 0) {
                $this->db->select('odr_no');
                $this->db->from('sales_order');
                $this->db->order_by('id', 'desc');
                $this->db->limit(1);
                $sales_odr_series = $this->db->get()->row(); 
				//print_r($sales_odr_series);die;
                return $sales_odr_series->odr_no+1;
            }else{
                $sales_odr_series=$this->db->select('sales_odr_series')->from('web_setting')->get()->row();
                return $sales_odr_series->sales_odr_series;
            }
		}else{
                $sales_odr_series=$this->db->select('sales_odr_series')->from('web_setting')->get()->row();
                return $sales_odr_series->sales_odr_series;
            }
        
    }
	
}