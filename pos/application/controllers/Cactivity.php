<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cactivity extends CI_Controller {

    public $menu;

    function __construct() {
        parent::__construct();
        $this->load->library('auth');
        $this->load->library('lcustomer');
        $this->load->library('lactivity');
        $this->load->library('session');
        $this->load->model('Activity');
        $this->load->model('Customers');
        $this->auth->check_admin_auth();
        $this->template->current_menu = 'customer';
    }

    public function index() {
        $content = $this->lactivity->activity_add_form();
        $this->template->full_admin_html_view($content);
    }

    //Insert Activity
    public function insert_activity() {

        //activity  basic information adding.
        $data = array(
            'customer_id' => $this->input->post('customer'),
            'sales_prsn' => $this->input->post('sales_prsn'),
            'service_name' => $this->input->post('service_name'),
            'amount' => $this->input->post('amount'),
            'remarks' => $this->input->post('remarks'),
        );
        $result = $this->Activity->insert_activity($data);
        if ($result == TRUE) {
            
            $this->session->set_userdata(array('message' => display('successfully_added')));
            if (isset($_POST['add-activity'])) {
                redirect(base_url('Cactivity/manage_activity'));
                exit;
            } elseif (isset($_POST['add-activity-another'])) {
                redirect(base_url('Cactivity'));
                exit;
            }
        } else {
            
                $this->session->set_userdata(array('error_message' => display('already_exists')));
                redirect(base_url('Cactivity'));
        }
    }

    // activity Update
    public function update_activity() {
        $this->load->model('Customers');
        $act_id = $this->input->post('act_id');
        $data = array(
            'customer_id' => $this->input->post('customer'),
            'sales_prsn' => $this->input->post('sales_prsn'),
            'service_name' => $this->input->post('service_name'),
            'amount' => $this->input->post('amount'),
            'remarks' => $this->input->post('remarks'),
        );
        $this->Activity->update_activity($data, $act_id);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Cactivity/manage_activity'));
        exit;
    }

    //Manage activity
    public function manage_activity() {
        #
        #pagination starts
        #
        $config["base_url"] = base_url('Cactivity/manage_activity/');
        $config["total_rows"] = $this->Activity->activity_list_count();
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
        $content = $this->lactivity->activity_list($links, $config["per_page"], $page);

        $this->template->full_admin_html_view($content);
        ;
    }

    // activity delete
    public function activity_delete() {
        $act_id = $_POST['act_id'];
        $this->Activity->delete_activity($act_id);
        $this->session->set_userdata(array('message' => display('successfully_delete')));
        return true;
    }
        
    //activity Update Form
    public function activity_update_form($act_id) {
        $content = $this->lactivity->activity_edit_data($act_id);
        $this->menu = array('label' => 'Edit Activity', 'url' => 'Cactivity');
        $this->template->full_admin_html_view($content);
    }

    //activity Update Form
    public function customer_update_form($customer_id) {
        $content = $this->lcustomer->customer_edit_data($customer_id);
        $this->menu = array('label' => 'Edit Customer', 'url' => 'Ccustomer');
        $this->template->full_admin_html_view($content);
    }

    
    
    // product_delete
    public function customer_delete() {
        $this->load->model('Customers');
        $customer_id = $_POST['customer_id'];
        $this->Activity->delete_customer($customer_id);
        $this->Customers->delete_transection($customer_id);
        $this->Customers->delete_customer_ledger($customer_id);
        $this->Customers->delete_customer_ledger($customer_id);
        $this->Customers->delete_invoic($customer_id);
        $this->session->set_userdata(array('message' => display('successfully_delete')));
        return true;
    }
    //customer_search_item
    public function customer_search_item() {
        $customer_id = $this->input->post('customer_id');
        $content = $this->lcustomer->customer_search_item($customer_id);
        $this->template->full_admin_html_view($content);
    }

    //credit customer_search_item
    public function credit_customer_search_item() {
        $customer_id = $this->input->post('customer_id');
        $content = $this->lcustomer->credit_customer_search_item($customer_id);
        $this->template->full_admin_html_view($content);
    }

    //paid customer_search_item
    public function paid_customer_search_item() {
        $customer_id = $this->input->post('customer_id');
        $content = $this->lcustomer->paid_customer_search_item($customer_id);
        $this->template->full_admin_html_view($content);
    }

    //Product Add Form
    public function credit_customer() {
        $this->load->model('Customers');

        #
        #pagination starts
        #
        $config["base_url"] = base_url('Ccustomer/credit_customer/');
        $config["total_rows"] = $this->Customers->credit_customer_list_count();
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
        $content = $this->lcustomer->credit_customer_list($links, $config["per_page"], $page);

        $this->template->full_admin_html_view($content);
        ;
    }

    //Paid Customer list. The customer who will pay 100%.
    public function paid_customer() {
        $this->load->model('Customers');

        #
        #pagination starts
        #
        $config["base_url"] = base_url('Ccustomer/paid_customer/');
        $config["total_rows"] = $this->Customers->paid_customer_list_count();
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
        $content = $this->lcustomer->paid_customer_list($links, $config["per_page"], $page);
        $this->template->full_admin_html_view($content);
        ;
    }

    //Customer Ledger
    public function customer_ledger($customer_id) {

        $content = $this->lcustomer->customer_ledger_data($customer_id);
        $this->menu = array('label' => 'Customer Ledger', 'url' => 'Ccustomer');
        $this->template->full_admin_html_view($content);
    }

    //Customer Final Ledger
    public function customerledger($customer_id) {
        $content = $this->lcustomer->customerledger_data($customer_id);
        $this->menu = array('label' => 'Customer Ledger', 'url' => 'Ccustomer');
        $this->template->full_admin_html_view($content);
    }

    //Customer Previous Balance
    public function previous_balance_form() {
        $content = $this->lcustomer->previous_balance_form();
        $this->template->full_admin_html_view($content);
    }

    // customer Update
    public function customer_update() {
        $this->load->model('Customers');
        $customer_id = $this->input->post('customer_id');
        $data = array(
            'customer_name' => $this->input->post('customer_name'),
            'customer_address' => $this->input->post('address'),
            'bill' => $this->input->post('bill'),
            'delivery' => $this->input->post('delivery'),
            'customer_mobile' => $this->input->post('mobile'),
            'customer_email' => $this->input->post('email')
        );
        $this->Customers->update_customer($data, $customer_id);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Ccustomer'));
        exit;
    }


}
