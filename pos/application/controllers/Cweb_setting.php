<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cweb_setting extends CI_Controller {

    public $menu;

    function __construct() {
        parent::__construct();
        $this->load->library('auth');
        $this->load->library('lweb_setting');
        $this->load->library('session');
        $this->load->model('Web_settings');
        $this->auth->check_admin_auth();
        $this->template->current_menu = 'web_setting';

        if ($this->session->userdata('user_type') == '2') {
            $this->session->set_userdata(array('error_message' => display('you_are_not_access_this_part')));
            redirect('Admin_dashboard');
        }
    }

    //Default loading for Category system.
    public function index() {
        //Calling Customer add form which will be loaded by help of "lcustomer,located in library folder"
        $content = $this->lweb_setting->setting_add_form();
        //Here ,0 means array position 0 will be active class
        $this->template->full_admin_html_view($content);
    }

    // customer Update
    public function update_setting() {
		$print_kot= $this->input->post('print_kot');
        if($print_kot=="on")
        {
            $print_kot=1;
        }
        $thermal_print = $this->input->post('thermal_print');
        $print=0;
        $custom_billing = $this->input->post('custom_billing');
        $billing=0;
        if($thermal_print=="on")
        {
            $print=1;
        }
        if($custom_billing=="on")
        {
            $billing=1;
        }
        
        $this->load->model('Web_settings');
        if ($_FILES['logo']['name']) {
            //Chapter chapter add start
            $config['upload_path'] = './my-assets/image/logo/';
            $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp|tiff';
            $config['max_size'] = "*";
            $config['max_width'] = "*";
            $config['max_height'] = "*";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('logo')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => display('logo_not_uploaded')));
                redirect(base_url('Cweb_setting'));
            } else {
                $image = $this->upload->data();
                $logo = base_url() . "my-assets/image/logo/" . $image['file_name'];
            }
        }

        if ($_FILES['favicon']['name']) {
            //Chapter chapter add start
            $config['upload_path'] = './my-assets/image/logo/';
            $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp|tiff';
            $config['max_size'] = "*";
            $config['max_width'] = "*";
            $config['max_height'] = "*";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('favicon')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => 'Favicon Did Not Uploaded'));
                redirect(base_url('Cweb_setting'));
            } else {
                $image = $this->upload->data();
                $favicon = base_url() . "my-assets/image/logo/" . $image['file_name'];
            }
        }

        if ($_FILES['invoice_logo']['name']) {
            //Chapter chapter add start
            $config['upload_path'] = './my-assets/image/logo/';
            $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp|tiff';
            $config['max_size'] = "*";
            $config['max_width'] = "*";
            $config['max_height'] = "*";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('invoice_logo')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => 'Invoice Logo did Not upload'));
                redirect(base_url('Cweb_setting'));
            } else {
                $image = $this->upload->data();
                $invoice_logo = base_url() . "my-assets/image/logo/" . $image['file_name'];
            }
        }

        $old_logo = $this->input->post('old_logo');
        $old_invoice_logo = $this->input->post('old_invoice_logo');
        $old_favicon = $this->input->post('old_favicon');

        $data = array(
            'logo' => (!empty($logo) ? $logo : $old_logo),
            'invoice_logo' => (!empty($invoice_logo) ? $invoice_logo : $old_invoice_logo),
            'favicon' => (!empty($favicon) ? $favicon : $old_favicon),
            'currency' => $this->input->post('currency'),
            'currency_position' => $this->input->post('currency_position'),
            'footer_text' => $this->input->post('footer_text'),
            'language' => $this->input->post('language'),
            'rtr' => $this->input->post('rtr'),
            'captcha' => $this->input->post('captcha'),
            'site_key' => $this->input->post('site_key'),
            'secret_key' => $this->input->post('secret_key'),
            'cin_no' => $this->input->post('cin_no'),
            'invoice_terms' => $this->input->post('invoice_terms'),
            'po_terms' => $this->input->post('po_terms'),
            'usr_commission' => $this->input->post('usr_commission'),
            'po_num_series' => $this->input->post('po_num_series'),
            'sales_odr_series' => $this->input->post('sales_odr_series'),
            'po_bit' => 1,
            'sales_odr_bit' => 1,
            'print_kot' => $print_kot,
            'thermal_print' => $print,
            'custom_billing' => $billing,
            'cust_price' => $this->input->post('cust_price'),
            'supplier_price' => $this->input->post('supp_price'),
            'customer_required' => $this->input->post('customer_required'),
            'invoice_view' => $this->input->post('invoice_view'),
        );
//        echo '<pre>';        print_r($data);        die();
        $this->Web_settings->update_setting($data);

        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Cweb_setting'));
        exit;
    }

}
