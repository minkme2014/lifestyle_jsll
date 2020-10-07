<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ctax extends CI_Controller {

    public $menu;

    function __construct() {
        parent::__construct();
        $this->load->library('auth');
        $this->load->library('ltax');
        $this->load->library('session');
        $this->load->model('Tax');
    }

    public function index() {
        $content = $this->ltax->tax_add_form();
        $this->template->full_admin_html_view($content);
    }

    //Insert Activity
    public function insert_tax() {

        //activity  basic information adding.
        $data = array(
            'tax_name' => $this->input->post('tax_name'),
            'tax_per' => $this->input->post('tax_per'),
        );
        $result = $this->Tax->insert_tax($data);
        if ($result == TRUE) {
            
            $this->session->set_userdata(array('message' => display('successfully_added')));
            if (isset($_POST['add-tax'])) {
                redirect(base_url('Ctax/manage_tax'));
                exit;
            } elseif (isset($_POST['add-tax-another'])) {
                redirect(base_url('Ctax'));
                exit;
            }
        } else {
            
                $this->session->set_userdata(array('error_message' => display('already_exists')));
                redirect(base_url('Cactivity'));
        }
    }

    //Manage tax
    public function manage_tax() {
        #
        #pagination starts
        #
        $config["base_url"] = base_url('Ctax/manage_tax/');
        $config["total_rows"] = $this->Tax->tax_list_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config["num_links"] = 5;
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $links = $this->pagination->create_links();
        #
        #pagination ends
        #  
        $content = $this->ltax->tax_list($links, $config["per_page"], $page);

        $this->template->full_admin_html_view($content);
        ;
    }

    // tax delete
    public function tax_delete() {
        $tax_id = $_POST['tax_id'];
        $this->Tax->delete_tax($tax_id);
        $this->session->set_userdata(array('message' => display('successfully_delete')));
        return true;
    }
	
    //tax Update Form
    public function tax_update_form($tax_id) {
        $content = $this->ltax->tax_edit_data($tax_id);
        $this->menu = array('label' => 'Edit Tax', 'url' => 'Ctax');
        $this->template->full_admin_html_view($content);
    }

    // activity Update
    public function update_tax() {
        $tax_id = $this->input->post('tax_id');
        $data = array(
            'tax_name' => $this->input->post('tax_name'),
            'tax_per' => $this->input->post('tax_per'),
        );
        $this->Tax->update_tax($data, $tax_id);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Ctax/manage_tax'));
        exit;
    }
        
}
