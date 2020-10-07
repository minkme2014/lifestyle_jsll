<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lusers {
    #==============user list================#

    public function user_list() {
        $CI = & get_instance();
        $CI->load->model('Userm');
        $user_list = $CI->Userm->user_list();
		$permission = $CI->Userm->get_permission("manage_users");
        $i = 0;
        if (!empty($user_list)) {
            foreach ($user_list as $k => $v) {
                $i++;
                $user_list[$k]['sl'] = $i;
            }
        }
        $data = array(
            'title' => 'User List',
            'user_list' => $user_list,
			'edited' => $permission->edited,
            'deleted' => $permission->deleted,
            'created' => $permission->created,
            'view' => $permission->view,
        );
        $userList = $CI->parser->parse('users/user', $data, true);
        return $userList;
    }
    #==============Role list================#

    public function role_list() {
        $CI = & get_instance();
        $CI->load->model('Userm');
		$permission = $CI->Userm->get_permission("manage_role");
        $role_list = $CI->Userm->role_list();
        $i = 0;
        if (!empty($role_list)) {
            foreach ($role_list as $k => $v) {
                $i++;
                $role_list[$k]['sl'] = $i;
            }
        }
        $data = array(
            'title' => 'Role List',
            'role_list' => $role_list,
            'edited' => $permission->edited,
            'deleted' => $permission->deleted,
            'created' => $permission->created,
            'view' => $permission->view,
        );
        $userList = $CI->parser->parse('users/role', $data, true);
        return $userList;
    }

    #=============User Search item===============#

    public function user_search_item($user_id) {
        $CI = & get_instance();
        $CI->load->model('Userm');
        $user_list = $CI->Userm->user_search_item($user_id);
        $i = 0;
        foreach ($user_list as $k => $v) {
            $i++;
            $user_list[$k]['sl'] = $i;
        }
        $data = array(
            'title' => 'User Search Items',
            'user_list' => $user_list
        );
        $userList = $CI->parser->parse('users/user', $data, true);
        return $userList;
    }

    #==============User add form===========#

    public function user_add_form() {
        $CI = & get_instance();
        $CI->load->model('Userm');
		$role = $CI->Userm->role_list();
		$permission = $CI->Userm->get_permission("add_user");
        $data = array(
            'title' => 'Add user',
			'role'=>$role,
            'edited' => $permission->edited,
            'deleted' => $permission->deleted,
            'created' => $permission->created,
            'view' => $permission->view,
        );
        $userForm = $CI->parser->parse('users/add_user_form', $data, true);
        return $userForm;
    }

    public function role_add_form() {
        $CI = & get_instance();
        $CI->load->model('Userm');
		$permission = $CI->Userm->get_permission("add_role");
        $data = array(
            'title' => 'Add Role',
            'edited' => $permission->edited,
            'deleted' => $permission->deleted,
            'created' => $permission->created,
            'view' => $permission->view,
        );
        $roleForm = $CI->parser->parse('users/role_add_form', $data, true);
        return $roleForm;
    }

    #================Insert user==========#

    public function insert_user($data) {
        $CI = & get_instance();
        $CI->load->model('Userm');
        $CI->Userm->user_entry($data);
        return true;
    }

    #===============User edit form==============#

    public function user_edit_data($user_id) {
        $CI = & get_instance();
        $CI->load->model('Userm');
        $user_detail = $CI->Userm->retrieve_user_editdata($user_id);
        
        $data1 = (array)$CI->Userm->retrieve_user_editdata($user_id);
       
//        $data = array(
//            'user_id' => $user_detail[0]['user_id'],
//            'first_name' => $user_detail[0]['first_name'],
//            'last_name' => $user_detail[0]['last_name'],
//            'username' => $user_detail[0]['username'],
//            'password' => $user_detail[0]['password'],
//            'status' => $user_detail[0]['status']
//        );
      //echo '<pre>';        print_r($data1);die();

        $companyList = $CI->parser->parse('users/edit_users_form', $data1, true);
        return $companyList;
    }
    #===============Role edit form==============#

    public function role_edit_data($role_id) {
        $CI = & get_instance();
        $CI->load->model('Userm');
        $role = $CI->Userm->get_role_by_id($role_id);
        $usr_role = $CI->Userm->select_user_roll_by_id($role_id);
		if ($usr_role) {
			foreach ($usr_role as $value) {
				$result[$value->menu_id] = $value;
			}
		}
		$data=array(
			'role_id'=>$role->role_id,
			'role_name'=>$role->role_name,
			'roll'=>$result,
		); 
        $roleList = $CI->parser->parse('users/role_update_form', $data, true);
        return $roleList;
    }

}

?>