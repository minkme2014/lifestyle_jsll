<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cproduct extends CI_Controller {

    public $product_id;

    function __construct() {
        parent::__construct();

        $this->template->current_menu = 'product';
    }

    //Index page load
    public function index() {
        
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->library('lproduct');
        $CI->load->model('Products');
        $content = $CI->lproduct->product_add_form();
        $this->template->full_admin_html_view($content);
    }

    //Product Add Form
    public function manage_product() {

        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lproduct');
        $CI->load->model('Products');

        #
        #pagination starts
        #
        $config["base_url"] = base_url('Cproduct/manage_product/');
        $config["total_rows"] = $this->Products->product_list_count();
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
        $content = $this->lproduct->product_list($links, $config["per_page"], $page);

        $this->template->full_admin_html_view($content);
    }
    
    	public function manage_rol() {

        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lproduct');
        $CI->load->model('Products');

        #
        #pagination starts
        #
        $config["base_url"] = base_url('Cproduct/manage_rol/');
        $config["total_rows"] = $this->Products->product_list_count_rol();
        
		//print_r($config["total_rows"]);die;;
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
        $content = $this->lproduct->product_rol($links, $config["per_page"], $page);

        $this->template->full_admin_html_view($content);
    }

    //Insert Product and upload image
     public function insert_product() {
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->library('lproduct');
		$redirect= $this->input->post('redirect');
        //Supplier check
        if ($this->input->post('supplier_id') == null) {
            $this->session->set_userdata(array('error_message' => display('please_select_supplier')));
            redirect(base_url('Cproduct'));
        }

        if ($_FILES['image']['name']) {
            //Chapter chapter add start
            $config['upload_path'] = './my-assets/image/product/';
            $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp|tiff';
            $config['max_size'] = "*";
            $config['max_width'] = "*";
            $config['max_height'] = "*";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => display('Image Not Uploaded!')));
                redirect(base_url('Cproduct'));
            } else {
                $image = $this->upload->data();
                $image_url = base_url() . "my-assets/image/product/" . $image['file_name'];
            }
        }

        $price = $this->input->post('price');
        $tax_percentage = $this->input->post('tax');
        $tax = ($price * $tax_percentage) / 100;
        $product_id=$this->generator(8);
        $data = array(
            'product_id' => $product_id,
            'product_name' => $this->input->post('product_name'),
            'supplier_id' => $this->input->post('supplier_id'),
            'category_id' => $this->input->post('category_id'),
            'mrp' => $this->input->post('mrp'),
            'price' => $price,
            'supplier_price' => $this->input->post('supplier_price'),
            'cartoon_quantity' => $this->input->post('cartoon_quantity'),
            'rol' => $this->input->post('rol'),
            'tax' => $tax,
            'cgst' => $this->input->post('cgst'),
            'sgst' => $this->input->post('sgst'),
            'igst' => $this->input->post('igst'),
            'utgst' => $this->input->post('utgst'),
            'total' => $this->input->post('total'),
            'product_model' => $this->input->post('model'),
            'product_details' => $this->input->post('description'),
            'image' => (!empty($image_url) ? $image_url : base_url('my-assets/image/product.png')),
            'status' => 1,
            'product_code' => $product_id,
            'product_name_for_barcode' => $this->input->post('product_name'),
            'uom' => $this->input->post('uom'),
            'rack' => $this->input->post('rack'),
            'type' => $this->input->post('type'),
            'total_sell_price' => $this->input->post('total_sell'),
            'code' => $this->input->post('code'),
        );

        $result = $CI->lproduct->insert_product($data);
        if ($result == 1) {
            $this->session->set_userdata(array('message' => display('successfully_added')));
			
			if($redirect=="purchase")
			{
				
                echo "Success";
                die;
			}elseif (isset($_POST['add-product'])) {
                redirect(base_url('Cproduct/manage_product'));
                exit;
            } elseif (isset($_POST['add-product-another'])) {
                redirect(base_url('Cproduct'));
                exit;
            }
        } else {
            $this->session->set_userdata(array('error_message' => display('product_model_already_exist')));
            redirect(base_url('Cproduct'));
        }
    } 
	
	/*  public function insert_product() {
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->library('lproduct');
		$redirect= $this->input->post('redirect');
        //Supplier check
        if ($this->input->post('supplier_id') == null) {
            $this->session->set_userdata(array('error_message' => display('please_select_supplier')));
            redirect(base_url('Cproduct'));
        }

        if ($_FILES['image']['name']) {
            //Chapter chapter add start
            $config['upload_path'] = './my-assets/image/product/';
            $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp|tiff';
            $config['max_size'] = "*";
            $config['max_width'] = "*";
            $config['max_height'] = "*";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => display('Image Not Uploaded!')));
                redirect(base_url('Cproduct'));
            } else {
                $image = $this->upload->data();
                $image_url = base_url() . "my-assets/image/product/" . $image['file_name'];
            }
        }
		
        $tax_list = $CI->db->select('*')
                ->from('tbl_taxes')
                ->get()
                ->result();
		$tax_name="";
		
		foreach($tax_list as $t)
		{
			$tax_name .= $t->tax_id.",";
		}
		//echo $tax_name;die;
        $price = $this->input->post('price');
        $tax_percentage = $this->input->post('tax');
        $tax = ($price * $tax_percentage) / 100;
        $product_id=$this->generator(8);
        $data = array(
            'product_id' => $product_id,
            'product_name' => $this->input->post('product_name'),
            'supplier_id' => $this->input->post('supplier_id'),
            'category_id' => $this->input->post('category_id'),
            'mrp' => $this->input->post('mrp'),
            'price' => $price,
            'supplier_price' => $this->input->post('supplier_price'),
            'cartoon_quantity' => $this->input->post('cartoon_quantity'),
            'rol' => $this->input->post('rol'),
            'tax' => $tax,
            //'cgst' => $this->input->post('cgst'),
            //'sgst' => $this->input->post('sgst'),
            //'igst' => $this->input->post('igst'),
            //'utgst' => $this->input->post('utgst'), 
            'total' => $this->input->post('total'),
            'product_model' => $this->input->post('model'),
            'product_details' => $this->input->post('description'),
            'image' => (!empty($image_url) ? $image_url : base_url('my-assets/image/product.png')),
            'status' => 1,
            'product_code' => $product_id,
            'product_name_for_barcode' => $this->input->post('product_name'),
            'uom' => $this->input->post('uom'),
            'type' => $this->input->post('type'),
            'total_sell_price' => $this->input->post('total_sell'),
            'code' => $this->input->post('code'),
			'tax_name'=>$tax_name
			//$tax_data
        );
		
        $result = $CI->lproduct->insert_product($data);
		
		foreach($tax_list as $t)
		{
			$tax_data=array(
				strtolower($t->tax_name)  => $this->input->post(strtolower($t->tax_name)),
			);
			$CI->Products->add_tax($tax_data,$product_id);
		}
		
        if ($result == 1) {
            $this->session->set_userdata(array('message' => display('successfully_added')));
			
			if($redirect=="purchase")
			{
				
                echo "Success";
                die;
			}elseif (isset($_POST['add-product'])) {
                redirect(base_url('Cproduct/manage_product'));
                exit;
            } elseif (isset($_POST['add-product-another'])) {
                redirect(base_url('Cproduct'));
                exit;
            }
        } else {
            $this->session->set_userdata(array('error_message' => display('product_model_already_exist')));
            redirect(base_url('Cproduct'));
        }
    }*/

    //Insert Product on purchase page and upload image
/*    public function insert_product_on_purchase() {
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->library('lproduct');
		
		$redirect= $this->input->post('redirect');
        //Supplier check
        if ($this->input->post('supplier_id') == null) {
            $this->session->set_userdata(array('error_message' => display('please_select_supplier')));
            redirect(base_url('Cproduct'));
        }

        if ($_FILES['image']['name']) {
            //Chapter chapter add start
            $config['upload_path'] = './my-assets/image/product/';
            $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp|tiff';
            $config['max_size'] = "*";
            $config['max_width'] = "*";
            $config['max_height'] = "*";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => display('Image Not Uploaded!')));
                redirect(base_url('Cproduct'));
            } else {
                $image = $this->upload->data();
                $image_url = base_url() . "my-assets/image/product/" . $image['file_name'];
            }
        }

        $price = $this->input->post('price');
        $tax_percentage = $this->input->post('tax');
        $tax = ($price * $tax_percentage) / 100;
        $product_id=$this->generator(8);
        $data = array(
            'product_id' => $product_id,
            'product_name' => $this->input->post('product_name'),
            'supplier_id' => $this->input->post('supplier_id'),
            'category_id' => $this->input->post('category_id'),
            'mrp' => $this->input->post('mrp'),
            'price' => $price,
            'supplier_price' => $this->input->post('supplier_price'),
            'cartoon_quantity' => $this->input->post('cartoon_quantity'),
            'tax' => $tax,
            'cgst' => $this->input->post('cgst'),
            'sgst' => $this->input->post('sgst'),
            'igst' => $this->input->post('igst'),
            'total' => $this->input->post('total'),
            'product_model' => $this->input->post('model'),
            'product_details' => $this->input->post('description'),
            'image' => (!empty($image_url) ? $image_url : base_url('my-assets/image/product.png')),
            'status' => 1,
            'product_code' => $product_id,
            'product_name_for_barcode' => $this->input->post('product_name')
        );

        $result = $CI->lproduct->insert_product($data);
        if ($result == 1) {
            $this->session->set_userdata(array('message' => display('successfully_added')));
			
                echo "Success";
                die;
		
        } else {
            $this->session->set_userdata(array('error_message' => display('product_model_already_exist')));
            redirect(base_url('Cproduct'));
        }
    }*/

    //Product Update Form
    public function product_update_form($product_id) {
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->library('lproduct');
        $content = $CI->lproduct->product_edit_data($product_id);
        $this->template->full_admin_html_view($content);
    }

    // Product Update
    public function product_update() {
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->model('Products');

        $product_id = $this->input->post('product_id');

        // configure for upload 
        $config = array(
            'upload_path' => "./my-assets/image/product/",
            'allowed_types' => "png|jpg|jpeg|gif|bmp|tiff",
            'overwrite' => TRUE,
//                'file_name' => "IST" . time(),
            'max_size' => '0',
        );
        $image_data = array();
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('image')) {
            $image_data = $this->upload->data();
//                print_r($image_data); die();
            $image_name = base_url() . "my-assets/image/product/".$image_data['file_name'];
            $config['image_library'] = 'gd2';
            $config['source_image'] = $image_data['full_path']; //get original image
            $config['maintain_ratio'] = TRUE;
            $config['height'] = '*';
            $config['width'] = '*';
//                $config['quality'] = 50;
            $this->load->library('image_lib', $config);
            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }
        } else {
            $image_name = $this->input->post('old_image');
        }

//        if ($_FILES['image']['name']) {
//            //Chapter chapter add start
//            $config['upload_path'] = './my-assets/image/product/';
//            $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp|tiff';
//            $config['max_size'] = "*";
//            $config['max_width'] = "*";
//            $config['max_height'] = "*";
//            $config['encrypt_name'] = TRUE;
//
//            $this->load->library('upload', $config);
//            if (!$this->upload->do_upload('image')) {
//                $error = array('error' => $this->upload->display_errors());
//                $this->session->set_userdata(array('error_message' => display('image_not_uploaded!')));
//                redirect(base_url('Cproduct'));
//            } else {
//                $image = $this->upload->data();
//                $old_image = $this->input->post('old_image');
//                $image_url = base_url() . "my-assets/image/product/" . $image['file_name'];
//            }
//        }
//        echo "SX".$old_image; die();

        $data = array(
            //'product_id' => $this->generator(8),
            'product_name' => $this->input->post('product_name'),
            'supplier_id' => $this->input->post('supplier_id'),
            'category_id' => $this->input->post('category_id'),
            'price' => $this->input->post('price'),
            'supplier_price' => $this->input->post('supplier_price'),
            'cartoon_quantity' => $this->input->post('cartoon_quantity'),
            'rol' => $this->input->post('rol'),
            'product_model' => $this->input->post('model'),
            'product_details' => $this->input->post('description'),
            'tax' => $this->input->post('tax'),
            'cgst' => $this->input->post('cgst'),
            'sgst' => $this->input->post('sgst'),
            'igst' => $this->input->post('igst'),
            'utgst' => $this->input->post('utgst'),
            'total' => $this->input->post('total'),
            'uom' => $this->input->post('uom'),
            'type' => $this->input->post('type'),
            'total_sell_price' => $this->input->post('total_sell'),
            'code' => $this->input->post('code'),
            'rack' => $this->input->post('rack'),
            'image' => $image_name,
//            'image' => (!empty($image_url) ? $image_url : $old_image),
            'status' => 1
        );
//        echo '<pre>';        print_r($data);        die();
        $result = $CI->Products->update_product($data, $product_id);
        if ($result == true) {
            $this->session->set_userdata(array('message' => display('successfully_updated')));
            redirect(base_url('Cproduct/manage_product'));
        } else {
            $this->session->set_userdata(array('error_message' => display('product_model_already_exist')));
            redirect(base_url('Cproduct/manage_product'));
        }
    }

    // product_delete
    public function product_delete() {
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->model('Products');
        $product_id = $_POST['product_id'];
        $result = $CI->Products->delete_product($product_id);
        return true;
    }

    //Retrieve Single Item  By Search
    public function product_by_search() {
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lproduct');
        $product_id = $this->input->post('product_id');

        $content = $CI->lproduct->product_search_list($product_id);
        $sub_menu = array(
            array('label' => 'Manage Product', 'url' => 'Cproduct', 'class' => 'active'),
            array('label' => 'Add Product', 'url' => 'Cproduct/manage_product')
        );
        $this->template->full_admin_html_view($content, $sub_menu);
    }

    //Retrieve Single Item  By Search
    public function product_details($product_id) {
        $this->product_id = $product_id;
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lproduct');
        $content = $CI->lproduct->product_details($product_id);
        $this->template->full_admin_html_view($content);
    }

    //Retrieve Single Item  By Search
    public function product_sales_supplier_rate($product_id = null, $startdate = null, $enddate = null) {
        if ($startdate == null) {
            $startdate = date('d-m-Y', strtotime('-30 days'));
        }
        if ($enddate == null) {
            $enddate = date('d-m-Y');
        }
        $product_id_input = $this->input->post('product_id');
        if (!empty($product_id_input)) {
            $product_id = $this->input->post('product_id');
            $startdate = $this->input->post('from_date');
            $enddate = $this->input->post('to_date');
        }

        $this->product_id = $product_id;

        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lproduct');
        $content = $CI->lproduct->product_sales_supplier_rate($product_id, $startdate, $enddate);
        $this->template->full_admin_html_view($content);
    }

    //This function is used to Generate Key
    public function generator($lenth) {
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->model('Products');

        $number = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        for ($i = 0; $i < $lenth; $i++) {
            $rand_value = rand(0, 8);
            $rand_number = $number["$rand_value"];

            if (empty($con)) {
                $con = $rand_number;
            } else {
                $con = "$con" . "$rand_number";
            }
        }

        $result = $this->Products->product_id_check($con);

        if ($result === true) {
            $this->generator(8);
        } else {
            return $con;
        }
    }
	public function check_prd_code()
	{
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->model('Products');

		$data=$_POST['data'];
		$result= $this->Products->check_prd_code($data);
		echo $data;
		die;
	}

}
