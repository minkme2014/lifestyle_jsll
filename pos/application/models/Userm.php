<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userm extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    #============Count Company=============#

    public function count_user() {
        return $this->db->count_all("users");
    }

    #=============User List=============#

    public function user_list() {
        $this->db->select('*');
        $this->db->from('user_login');
        $this->db->join('users', 'users.user_id = user_login.user_id');
        $this->db->join('tbl_user_role', 'user_login.user_type = tbl_user_role.role_id','left');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    #=============Rloe List=============#

    public function role_list() {
        $this->db->select('*');
        $this->db->from('tbl_user_role');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    #==============User search list==============#

    public function user_search_item($user_id) {
        $this->db->select('users.*,user_login.user_type');
        $this->db->from('user_login');
        $this->db->join('users', 'users.user_id = user_login.user_id');
        $this->db->where('users.user_id', $user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    #============Insert user to database========#

    public function user_entry($data) {
        $users = array(
            'user_id' => $data['user_id'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'status' => $data['status'],
            'commission' => $data['commission'],
        );
        $this->db->insert('users', $users);


        $user_login = array(
            'user_id' => $data['user_id'],
            'username' => $data['email'],
            'password' => $data['password'],
            'user_type' => $data['user_type'],
            'status' => $data['status'],
        );

        $this->db->insert('user_login', $user_login);
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('status', 1);

        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $json_product[] = array('label' => $row->first_name, 'value' => $row->user_id);
        }
        $cache_file = './my-assets/js/admin_js/json/user.json';
        $productList = json_encode($json_product);
        file_put_contents($cache_file, $productList);
    }

    #==============User edit data===============#

    public function retrieve_user_editdata($user_id) {

        $this->db->select('users.*,user_login.*');
        $this->db->from('user_login');
        $this->db->join('users', 'users.user_id = user_login.user_id');
        $this->db->where('users.user_id', $user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    #==============Update company==================#

    public function update_user($user_id) {
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'status' => $this->input->post('status'),
            'commission' => $this->input->post('commission')
        );
//        echo '<pre>';        print_r($data);die();
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);

        if ($this->input->post('password')) {
            $user_login = array(
                'username' => $this->input->post('username'),
                'password' => md5('gef'.$this->input->post('password')),
                'status' => $this->input->post('status')
            );
        } else {
            $user_login = array(
                'username' => $this->input->post('username'),
                'status' => $this->input->post('status')
            );
        }
        $this->db->where('user_id', $user_id);
        $this->db->update('user_login', $user_login);

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('status', 1);
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $json_product[] = array('label' => $row->first_name, 'value' => $row->user_id);
        }
        $cache_file = './my-assets/js/admin_js/json/user.json';
        $productList = json_encode($json_product);
        file_put_contents($cache_file, $productList);
        return true;
    }

    #===========Delete user item========#

    public function delete_user($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->delete('users');

        $this->db->where('user_id', $user_id);
        $this->db->delete('user_login');

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('status', 1);
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $json_product[] = array('label' => $row->first_name, 'value' => $row->user_id);
        }
        $cache_file = './my-assets/js/admin_js/json/user.json';
        $productList = json_encode($json_product);
        file_put_contents($cache_file, $productList);
        return true;
    }
	

    #===========Delete role item========#

    public function delete_role($role_id) {
        $this->db->where('role_id', $role_id);
        $this->db->delete('tbl_user_role');

        $this->db->where('usr_role_id', $role_id);
        $this->db->delete('tbl_user_role_permission');
		
        return true;
    }
	
	public function insert_role($data)
	{
		$this->db->insert('tbl_user_role',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	
	public function update_role($data,$role_id)
	{
		$this->db->where('role_id',$role_id);
		return $this->db->update('tbl_user_role',$data);
	}
	public function insert_permission($data)
	{
		//print_r($data);
		return $this->db->insert('tbl_user_role_permission',$data);
	}
	public function delete_permission($role_id)
	{
		$this->db->where('usr_role_id',$role_id);
		return $this->db->delete('tbl_user_role_permission');
	}
	public function get_role_by_id($role_id)
	{
		$this->db->select('*')->from('tbl_user_role')->where('role_id',$role_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
	}
    public function select_user_roll_by_id($role_id) {
        $this->db->select('tbl_user_role_permission.*', false);
        $this->db->select('tbl_menu.*', false);
        $this->db->from('tbl_user_role_permission');
        $this->db->join('tbl_menu', 'tbl_user_role_permission.menu_id = tbl_menu.menu_id', 'left');
        $this->db->where('tbl_user_role_permission.usr_role_id', $role_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
		//echo $this->db->last_query();
		//print_r($result);die;
        return $result;
    }
	public function get_permission($label)
	{
		$role_id = $this->session->userdata('user_type');
        $this->db->select('p.*', false);
        $this->db->select('tbl_menu.*', false);
        $this->db->from('tbl_user_role_permission p');
        $this->db->join('tbl_menu', 'p.menu_id = tbl_menu.menu_id', 'left');
        $this->db->where(array('p.usr_role_id'=> $role_id,'tbl_menu.label'=>$label));
        $query_result = $this->db->get();
        $result = $query_result->row();
		//echo $this->db->last_query();
		//print_r($result);die;
        return $result;
	}
	

}
