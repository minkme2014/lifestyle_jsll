<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    public $user_id;

    function __construct() {
        parent::__construct();
        $this->load->library('auth');
        $this->load->library('lusers');
        $this->load->library('session');
        $this->load->model('Userm');
        $this->auth->check_admin_auth();
        $this->template->current_menu = 'settings';

        if ($this->session->userdata('user_type') == '2') {
            $this->session->set_userdata(array('error_message' => display('you_are_not_access_this_part')));
            redirect('Admin_dashboard');
        }
    }

    #==============User page load============#

    public function index() {
        $content = $this->lusers->user_add_form();
        $this->template->full_admin_html_view($content);
    }
	
    public function role() {
        $content = $this->lusers->role_add_form();
        $this->template->full_admin_html_view($content);
    }

    #===============User Search Item===========#

    public function user_search_item() {
        $user_id = $this->input->post('user_id');
        $content = $this->lusers->user_search_item($user_id);
        $this->template->full_admin_html_view($content);
    }

    #================Manage User===============#

    public function manage_user() {
        $content = $this->lusers->user_list();
        $this->template->full_admin_html_view($content);
    }

    #================Manage Role===============#

    public function manage_role() {
        $content = $this->lusers->role_list();
        $this->template->full_admin_html_view($content);
    }

    #==============Insert User==============#

    public function insert_user() {
        $data = array(
            'user_id' => $this->generator(15),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'password' => md5("gef" . $this->input->post('password')),
            'user_type' => $this->input->post('user_type'),
            'commission' => $this->input->post('commission'),
            'status' => 1
        );

        $this->lusers->insert_user($data);
        $this->session->set_userdata(array('message' => display('successfully_added')));
        if (isset($_POST['add-user'])) {
            redirect('User/manage_user');
        } elseif (isset($_POST['add-user-another'])) {
            redirect(base_url('User'));
        }
    }

    #===============User update form================#

    public function user_update_form($user_id) {
        $user_id = $user_id;
        $content = $this->lusers->user_edit_data($user_id);
        $this->template->full_admin_html_view($content);
    }
    #===============Role update form================#

    public function role_update_form($role_id) {
        $role_id = $role_id;
        $content = $this->lusers->role_edit_data($role_id);
        $this->template->full_admin_html_view($content);
    }

    #===============User update===================#

    public function user_update() {
        $user_id = $this->input->post('user_id');
        $this->Userm->update_user($user_id);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('User/manage_user'));
    }

    #============User delete===========#

    public function user_delete() {
        $user_id = $_POST['user_id'];
        $this->Userm->delete_user($user_id);
        $this->session->set_userdata(array('message' => display('successfully_delete')));
        return true;
    }

    #============Role delete===========#

    public function role_delete() {
        $role_id = $_POST['role_id'];
        $this->Userm->delete_role($role_id);
        $this->session->set_userdata(array('message' => display('successfully_delete')));
        return true;
    }

    // Random Id generator
    public function generator($lenth) {
        $number = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "N", "M", "O", "P", "Q", "R", "S", "U", "V", "T", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

        for ($i = 0; $i < $lenth; $i++) {
            $rand_value = rand(0, 61);
            $rand_number = $number["$rand_value"];

            if (empty($con)) {
                $con = $rand_number;
            } else {
                $con = "$con" . "$rand_number";
            }
        }
        return $con;
    }

    public function buildChild($parent, $menu)
    {
        if (isset($menu['parents'][$parent])) {
            foreach ($menu['parents'][$parent] as $ItemID) {
                if (!isset($menu['parents'][$ItemID->menu_id])) {
                    $result[$ItemID->label] = $ItemID->menu_id;
                }
                if (isset($menu['parents'][$ItemID->menu_id])) {
                    $result[$ItemID->label][$ItemID->menu_id] = self::buildChild($ItemID->menu_id, $menu);
                }
            }
        }
        return $result;
    }
	public function insert_role()
	{
		$role = $this->input->post('role');
		$data=array(
		'role_name'=>$role
		);
        $role_id = $this->Userm->insert_role($data);
		
		$menu = $this->array_from_post(array('menu'));
		if (!empty($menu['menu'])) {
			foreach ($menu['menu'] as $key => $v_menu) {
				if ($v_menu != 'undefined') {
						$view = $this->input->post('view_' . $v_menu, true);
						$created = $this->input->post('created_' . $v_menu, true);
						$edited = $this->input->post('edited_' . $v_menu, true);
						$deleted = $this->input->post('deleted_' . $v_menu, true);
						$mdata['view'] = (!empty($view) ? $view : 0);
						$mdata['created'] = (!empty($created) ? $created : 0);
						$mdata['edited'] = (!empty($edited) ? $edited : 0);
						$mdata['deleted'] = (!empty($deleted) ? $deleted : 0);
						$mdata['menu_id'] = $v_menu;
						$mdata['usr_role_id'] = $role_id;
						$this->Userm->insert_permission($mdata);
				}
			}
		}
        $this->session->set_userdata(array('message' => display('successfully_added')));
            redirect(base_url('User/manage_role'));
		
	}
	public function update_role()
	{
		$role = $this->input->post('role');
		$role_id = $this->input->post('role_id');
		$data=array(
		'role_name'=>$role
		);
        $this->Userm->update_role($data,$role_id);
		
        if($this->Userm->delete_permission($role_id)){
			$menu = $this->array_from_post(array('menu'));
			if (!empty($menu['menu'])) {
				foreach ($menu['menu'] as $key => $v_menu) {
					if ($v_menu != 'undefined') {
							$view = $this->input->post('view_' . $v_menu, true);
							$created = $this->input->post('created_' . $v_menu, true);
							$edited = $this->input->post('edited_' . $v_menu, true);
							$deleted = $this->input->post('deleted_' . $v_menu, true);
							$mdata['view'] = (!empty($view) ? $view : 0);
							$mdata['created'] = (!empty($created) ? $created : 0);
							$mdata['edited'] = (!empty($edited) ? $edited : 0);
							$mdata['deleted'] = (!empty($deleted) ? $deleted : 0);
							$mdata['menu_id'] = $v_menu;
							$mdata['usr_role_id'] = $role_id;
							$this->Userm->insert_permission($mdata);
					}
				}
			}
		}
        $this->session->set_userdata(array('message' => display('successfully_added')));
            redirect(base_url('User/manage_role'));
		
	}
	
    public function array_from_post($fields)
    {

        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field, true);
        }
        return $data;
    }
}
