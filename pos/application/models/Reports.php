<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class reports extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //Count report
    public function count_stock_report() {
        $this->db->select("a.product_name,a.product_id,a.cartoon_quantity,a.price,a.product_model,sum(b.quantity) as 'totalSalesQnty',(select sum(product_purchase_details.quantity) from product_purchase_details where product_id= `a`.`product_id`) as 'totalBuyQnty'");
        $this->db->from('product_information a');
        $this->db->join('invoice_details b', 'b.product_id = a.product_id');
        $this->db->where(array('a.status' => 1, 'b.status' => 1));
        $this->db->group_by('a.product_id');
        $query = $this->db->get();
        //echo $this->db->last_query();		
        return $query->num_rows();
    }

    //Retrieve Single Item Stock Stock Report
    public function stock_report($limit, $page) {
        //$today = date('Y-m-d');
        $this->db->select("a.product_name,a.product_id,a.cartoon_quantity,a.price,a.product_model,sum(b.quantity) as 'totalSalesQnty',(select sum(product_purchase_details.quantity) from product_purchase_details where product_id= `a`.`product_id`) as 'totalBuyQnty'");
        $this->db->from('product_information a');
        $this->db->join('invoice_details b', 'b.product_id = a.product_id');
        $this->db->where(array('a.status' => 1, 'b.status' => 1));
        $this->db->group_by('a.product_id');
        $this->db->order_by('a.product_id', 'desc');
        $this->db->limit($limit, $page);
        $query = $this->db->get();
        return $query->result_array();
    }

    //Retrieve Single Item Stock Stock Report
    public function stock_report_single_item($product_id) {
        $this->db->select("a.product_name,a.cartoon_quantity,a.price,a.product_model,sum(b.quantity) as 'totalSalesQnty',sum(c.quantity) as 'totalBuyQnty'");
        $this->db->from('product_information a');
        $this->db->join('invoice_details b', 'b.product_id = a.product_id');
        $this->db->join('product_purchase_details c', 'c.product_id = a.product_id');
        $this->db->where(array('a.product_id' => $product_id, 'a.status' => 1, 'b.status' => 1));
        $this->db->group_by('a.product_id');
        $this->db->order_by('a.product_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Stock Report by date
    public function stock_report_bydate($product_id, $date,$category_id, $limit, $page) {
//        echo $product_id; die();
        $this->db->select("
				a.product_name,
				a.cartoon_quantity,
				a.product_id,
				a.price,
				a.rack,
				a.supplier_price,
				a.product_model,
				u.uom_name,
				sum(b.sell) as 'totalSalesQnty',
				sum(b.Purchase) as 'totalPurchaseQnty',
				(select sum(product_purchase_details.quantity) from product_purchase_details left join product_purchase on product_purchase.purchase_id=product_purchase_details.purchase_id where product_id= `a`.`product_id` and purchase_date <= '$date') as 'totalPurchaseQnty',
				(select sum(invoice_details.quantity) from invoice_details left join invoice on invoice_details.invoice_id = invoice.invoice_id where product_id= `a`.`product_id` and date <= '$date') as 'totalSalesQnty',
				(select sum(manualconsumption.qty) from manualconsumption where product_id= `a`.`product_id` and cast(created_on as date) <= '$date' ) as 'totalConsumedQnty'
				");
        $this->db->from('product_information a');
        $this->db->join('uom_list u', 'a.uom = u.uom_id', 'left');
        $this->db->join('stock_history b', 'b.product_id = a.product_id', 'left');
  /*       if (empty($product_id)) {
            $this->db->where(array('a.status' => 1,'a.type'=>'Goods'));
        } else {
            //Single product information 
            $this->db->where(array('a.status' => 1, 'a.product_id' => $product_id,'a.type'=>'Goods'));
        }  */

         if (empty($product_id) && !empty($category_id)) {
            $this->db->where(array('a.status' => 1,'a.type'=>'Goods','category_id'=>$category_id));
        } else if(!empty($product_id) && empty($category_id)) {
            //Single product information 
            $this->db->where(array('a.status' => 1, 'a.product_id' => $product_id,'a.type'=>'Goods'));
        }else if(!empty($product_id) && !empty($category_id)) {
            //Single product information 
            $this->db->where(array('a.status' => 1,'a.type'=>'Goods', 'a.product_id' => $product_id,'category_id'=>$category_id));
        }else {
            $this->db->where(array('a.status' => 1,'a.type'=>'Goods'));
            //Single product information 
        } 
		
        $this->db->group_by('a.product_id');
        //$this->db->order_by('a.product_id', 'desc');
        $this->db->order_by('a.product_name', 'asc');
        //$this->db->limit($limit, $page);
        $query = $this->db->get();

        //$this->db->last_query(); //Testing purpose
        return $query->result_array();
    }

    //Stock report supplier by date
    public function stock_report_supplier_bydate($product_id, $supplier_id, $date, $perpage, $page) {

        $this->db->select("
				a.product_name,
				a.cartoon_quantity,
				a.product_id,
				a.price,
				a.supplier_price,
				a.product_model,
				sum(b.sell) as 'totalSalesQnty',
				sum(b.Purchase) as 'totalPurchaseQnty',
				b.vdate as date
				");
        $this->db->from('product_information a');
        $this->db->join('stock_history b', 'b.product_id = a.product_id', 'left');

        if (empty($supplier_id)) {
            $this->db->where(array('a.status' => 1));
        } else {
            $this->db->where('a.status', 1);
            $this->db->where('b.vdate <=', $date);
            $this->db->where('a.supplier_id', $supplier_id);
        }

        $this->db->group_by('a.product_id');
        $this->db->order_by('a.product_id', 'asc');
        $this->db->limit($perpage, $page);
        $query = $this->db->get();

        // echo "<pre>";
        // print_r($query->result());
        // exit();

        return $query->result_array();
    }

    //Stock report supplier by date
    public function stock_report_product_bydate($product_id, $supplier_id, $from_date, $to_date, $per_page, $page) {

        $this->db->select("
				a.product_name,
				a.cartoon_quantity,
				a.product_id,
				a.price,
				a.supplier_price,
				a.product_model,
				sum(b.sell) as 'totalSalesQnty',
				sum(b.Purchase) as 'totalPurchaseQnty',
				b.vdate as date
				");
        $this->db->from('product_information a');
        $this->db->join('stock_history b', 'b.product_id = a.product_id', 'left');
        $this->db->order_by('b.vdate', 'ASC');

        if (empty($supplier_id)) {
            $this->db->where(array('a.status' => 1));
        } else {
            $this->db->where(
                    array(
                        'a.status' => 1,
                        'a.supplier_id' => $supplier_id,
                        'a.product_id' => $product_id
                    )
            );
            $this->db->where('b.vdate 		>=', $from_date);
            $this->db->where('b.vdate 		<=', $to_date);
        }

        $this->db->group_by('b.product_id');
        $this->db->group_by('b.vdate');
        $this->db->order_by('a.product_id', 'asc');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();

        //$this->db->last_query(); //Testing purpose
        return $query->result_array();
    }

    //Stock report supplier by date
    public function stock_report_product_bydate_count($product_id, $supplier_id, $from_date, $to_date) {

        $this->db->select("
				a.product_name,
				a.product_model,
				a.cartoon_quantity,
				a.product_id,
				a.price,
				a.supplier_price,
				a.product_model,
				sum(b.sell) as 'totalSalesQnty',
				sum(b.Purchase) as 'totalPurchaseQnty',
				b.vdate as date
				");
        $this->db->from('product_information a');
        $this->db->join('stock_history b', 'b.product_id = a.product_id', 'left');

        if (empty($supplier_id)) {
            $this->db->where(array('a.status' => 1));
        } else {
            $this->db->where(
                    array(
                        'a.status' => 1,
                        'a.supplier_id' => $supplier_id,
                        'a.product_id' => $product_id
                    )
            );
        }

        $this->db->group_by('b.product_id');
        $this->db->group_by('b.vdate');
        $this->db->order_by('a.product_id', 'asc');
        $query = $this->db->get();

        //$this->db->last_query(); //Testing purpose
        return $query->num_rows();
    }

    //Counter of unique product histor which has been affected
    public function product_counter($product_id) {
        $this->db->select('DISTINCT(product_id)');
        $this->db->from('product_information');
        if (!empty($product_id)) {
            $this->db->where('product_id =', $product_id);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function product_filter($product_id=null, $category_id=null) {
        $this->db->select('DISTINCT(product_id)');
        $this->db->from('product_information');
        if (!empty($product_id) && !empty($category_id)) {
            $this->db->where(array('product_id'=>$product_id,'category_id'=>$category_id));
        }else if(!empty($product_id) && empty($category_id)) {
            $this->db->where('product_id =', $product_id);
        }else if(empty($product_id) && !empty($category_id)) {
            $this->db->where('category_id =', $category_id);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    //Counter of unique product histor which has been affected
    public function product_counter_by_supplier($supplier_id) {
        $this->db->select('DISTINCT(product_id)');
        $this->db->from('product_information');
        if (!empty($supplier_id)) {
            $this->db->where('supplier_id =', $supplier_id);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    //Retrieve todays_sales_report
    public function todays_total_sales_report() {
        $today = date('d-m-Y');
        $this->db->select("a.date,a.invoice,b.invoice_id,sum(total_price) as total_sale");
        $this->db->select('sum(`quantity`*`supplier_rate`) as total_supplier_rate', FALSE);
        $this->db->select("(SUM(total_price) - SUM(`quantity`*`supplier_rate`)) AS total_profit");
        $this->db->from('invoice a');
        $this->db->join('invoice_details b', 'b.invoice_id = a.invoice_id');
        $this->db->where('a.date', $today);
        $this->db->order_by('a.invoice_id', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Retrieve todays_sales_report
    public function todays_sales_report() {
        $today = date('Y-m-d');
        $this->db->select("a.*,b.customer_id,b.customer_name");
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->where('a.date', $today);
        $this->db->order_by('a.invoice_id', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Retrieve todays_consumption_report
    public function todays_consumption_report() {
        $today = date('Y-m-d');
        $this->db->select("sum(b.qty) as consumed_qty, a.product_name as p_name, b.reason as p_reason, sum(a.cartoon_quantity) as qty, sum(a.cartoon_quantity-b.qty) as available_qty, b.created_on as consumption_date");
        $this->db->from('manualconsumption b');
        $this->db->join('product_information a', 'b.product_id = a.product_id','left');
        $this->db->group_by('b.manualconsumption_id', 'desc');
        $this->db->order_by('b.created_on', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Retrieve todays_commission_report
    public function todays_commission_report() {
        $today = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('invoice i');
        $this->db->join('users u', 'i.user_id=u.id','left');
        $this->db->where('i.date', $today);
        $this->db->where('i.user_id !=','');
        $query = $this->db->get();
      //  echo $this->db->last_query();
        return $query->result_array();
    }

    //Retrieve todays_purchase_report
    public function todays_purchase_report() {
        $today = date('Y-m-d');
        $this->db->select("a.*,b.supplier_id,b.supplier_name");
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->where('a.purchase_date', $today);
        $this->db->order_by('a.purchase_id', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Total profit report
    public function total_profit_report($perpage, $page) {

        $this->db->select("a.date,a.invoice,b.invoice_id,
			CAST(sum(total_price) AS DECIMAL(16,2)) as total_sale");
        $this->db->select('CAST(sum(`quantity`*`supplier_rate`) AS DECIMAL(16,2)) as total_supplier_rate', FALSE);
        $this->db->select("CAST(SUM(total_price) - SUM(`quantity`*`supplier_rate`) AS DECIMAL(16,2)) AS total_profit");
        $this->db->from('invoice a');
        $this->db->join('invoice_details b', 'b.invoice_id = a.invoice_id');
        $this->db->group_by('b.invoice_id');
        $this->db->order_by('a.invoice', 'desc');
        $this->db->limit($perpage, $page);
        $query = $this->db->get();
        return $query->result_array();
    }

    //Total profit report
    public function total_profit_report_count() {

        $this->db->select("a.date,a.invoice,b.invoice_id,sum(total_price) as total_sale");
        $this->db->select('sum(`quantity`*`supplier_rate`) as total_supplier_rate', FALSE);
        $this->db->select("(SUM(total_price) - SUM(`quantity`*`supplier_rate`)) AS total_profit");
        $this->db->from('invoice a');
        $this->db->join('invoice_details b', 'b.invoice_id = a.invoice_id');
        $this->db->group_by('b.invoice_id');
        $this->db->order_by('a.invoice', 'desc');
        $query = $this->db->get();
        return $query->num_rows();
    }

    //Retrieve Monthly Sales Report
    public function monthly_sales_report() {
        $query1 = $this->db->query("
			SELECT 
				date,
				EXTRACT(MONTH FROM date) as month, 
				COUNT(invoice_id) as total
			FROM 
				invoice
			WHERE 
				EXTRACT(YEAR FROM date)  >= EXTRACT(YEAR FROM NOW())
			GROUP BY 
				EXTRACT(YEAR_MONTH FROM date)
			ORDER BY
				month ASC
		")->result();

        $query2 = $this->db->query("
			SELECT 
				purchase_date,
				EXTRACT(MONTH FROM purchase_date) as month, 
				COUNT(purchase_id) as total_month
			FROM 
				product_purchase
			WHERE 
				EXTRACT(YEAR FROM purchase_date)  >= EXTRACT(YEAR FROM NOW())
			GROUP BY 
				EXTRACT(YEAR_MONTH FROM purchase_date)
			ORDER BY
				month ASC
		")->result();

        return [$query1, $query2];
    }

    //Retrieve all Report
    public function retrieve_dateWise_SalesReports($start_date, $end_date) {
//        echo $start_date. " ". $end_date;
        $dateRange = "a.date BETWEEN '$start_date' AND '$end_date'";
//echo $dateRange;die();
        $this->db->select("a.*,b.customer_id,b.customer_name");
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id','left');
        //$this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->where($dateRange, NULL, FALSE);
        $this->db->order_by('a.date', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Retrieve all Report
    public function retrieve_dateWise_ConsumptionReports($start_date, $end_date) {
//        echo $start_date. " ". $end_date;
        $dateRange = "CAST(b.created_on AS DATE) BETWEEN '$start_date' AND '$end_date'";
//echo $dateRange;die();
        $today = date('Y-m-d');
        $this->db->select("sum(b.qty) as consumed_qty, a.product_name as p_name, b.reason as p_reason, sum(a.cartoon_quantity) as qty, sum(a.cartoon_quantity-b.qty) as available_qty, b.created_on as consumption_date");
        $this->db->from('manualconsumption b');
        $this->db->join('product_information a', 'b.product_id = a.product_id','left');
        $this->db->where($dateRange, NULL, FALSE);
        $this->db->group_by('b.manualconsumption_id', 'desc');
        $this->db->order_by('b.created_on', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //Retrieve all Report
    public function retrieve_dateWise_CommissionReports($start_date=null, $end_date=null ,$emp_id=null) {
//        echo $start_date. " ". $end_date;
        $dateRange = "i.date BETWEEN '$start_date' AND '$end_date'";
        $today = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('invoice i');
        $this->db->join('users u', 'i.user_id=u.id','left');
        if($start_date)
        {
            $this->db->where($dateRange, NULL, FALSE);
        }
        
        if($emp_id)
        {
            $this->db->where('i.user_id',$emp_id);
        }else{
            $this->db->where('i.user_id !=','');
        }
        $query = $this->db->get();
       // echo $this->db->last_query();
        //print_r($query->result_array());
        return $query->result_array();
    }
    //Retrieve all Report
    public function retrieve_dateWise_PurchaseReports($start_date, $end_date) {
        $dateRange = "b.created_date BETWEEN '$start_date' AND '$end_date'";

        $this->db->select("sum(b.qty) as consumed_qty, a.product_name as p_name, b.reason as p_reason, sum(a.cartoon_quantity) as qty, sum(a.cartoon_quantity-b.qty) as available_qty");
        $this->db->from('product_information a');
        $this->db->join('manualconsumption b', 'b.product_id = a.product_id');
        $this->db->order_by('id', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Retrieve date wise profit report
    public function retrieve_dateWise_profit_report($start_date, $end_date, $per_page, $page) {
        // $dateRange = "a.date BETWEEN '$start_date%' AND '$end_date%'";


        $this->db->select("a.date,a.invoice,b.invoice_id,
			CAST(sum(total_price) AS DECIMAL(16,2)) as total_sale");
        $this->db->select('CAST(sum(`quantity`*`supplier_rate`) AS DECIMAL(16,2)) as total_supplier_rate', FALSE);
        $this->db->select("CAST(SUM(total_price) - SUM(`quantity`*`supplier_rate`) AS DECIMAL(16,2)) AS total_profit");

        $this->db->from('invoice a');
        $this->db->join('invoice_details b', 'b.invoice_id = a.invoice_id');

        // $this->db->where($dateRange, NULL, FALSE); 
        $this->db->where('a.date >=', $start_date);
        $this->db->where('a.date <=', $end_date);

        $this->db->group_by('b.invoice_id');
        $this->db->order_by('a.invoice', 'desc');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();
        return $query->result_array();
    }

    //Retrieve date wise profit report
    public function retrieve_dateWise_profit_report_count($start_date, $end_date) {
        // $dateRange = "a.date BETWEEN '$start_date%' AND '$end_date%'";


        $this->db->select("a.date,a.invoice,b.invoice_id,sum(total_price) as total_sale");
        $this->db->select('sum(`quantity`*`supplier_rate`) as total_supplier_rate', FALSE);
        $this->db->select("(SUM(total_price) - SUM(`quantity`*`supplier_rate`)) AS total_profit");

        $this->db->from('invoice a');
        $this->db->join('invoice_details b', 'b.invoice_id = a.invoice_id');

        // $this->db->where($dateRange, NULL, FALSE); 
        $this->db->where('a.date >=', $start_date);
        $this->db->where('a.date <=', $end_date);

        $this->db->group_by('b.invoice_id');
        $this->db->order_by('a.invoice', 'desc');
        $query = $this->db->get();
        return $query->num_rows();
    }

    //Product wise sales report
    public function product_wise_report() {
        $today = date('Y-m-d');
        $this->db->select("a.*,b.customer_id,b.customer_name");
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->where('a.date', $today);
        $this->db->order_by('a.invoice_id', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        return $query->result_array();
    }

    //RETRIEVE DATE WISE SINGE PRODUCT REPORT
    public function retrieve_product_sales_report($perpage, $page) {
        $this->db->select("a.*,b.product_name,b.product_model,c.date,c.total_amount,d.customer_name");
        $this->db->from('invoice_details a');
        $this->db->join('product_information b', 'b.product_id = a.product_id');
        $this->db->join('invoice c', 'c.invoice_id = a.invoice_id');
        $this->db->join('customer_information d', 'd.customer_id = c.customer_id');
        $this->db->order_by('c.date', 'desc');
        $this->db->limit($perpage, $page);
        $query = $this->db->get();
        return $query->result_array();
    }

    //RETRIEVE DATE WISE SINGE PRODUCT REPORT
    public function retrieve_product_sales_report_count() {
        $today = date('Y-m-d');
        $this->db->select("a.*,b.product_name,b.product_model,c.date,c.total_amount,d.customer_name");
        $this->db->from('invoice_details a');
        $this->db->join('product_information b', 'b.product_id = a.product_id');
        $this->db->join('invoice c', 'c.invoice_id = a.invoice_id');
        $this->db->join('customer_information d', 'd.customer_id = c.customer_id');
        $this->db->where('c.date', $today);
        $this->db->order_by('c.date', 'desc');
        $query = $this->db->get();
        return $query->num_rows();
    }

    //RETRIEVE DATE WISE SEARCH SINGLE PRODUCT REPORT
    public function retrieve_product_search_sales_report($start_date, $end_date, $category_id, $perpage, $page) {
        $dateRange = "c.date BETWEEN '$start_date%' AND '$end_date%'";
//        echo $dateRange;die();
//        $this->db->select("a.*,b.product_name,b.product_model,c.date,d.customer_name");
        $this->db->select("a.*,b.product_name,b.product_model,c.date,c.total_amount,d.customer_name");
        $this->db->from('invoice_details a');
        $this->db->join('product_information b', 'b.product_id = a.product_id');
        $this->db->join('invoice c', 'c.invoice_id = a.invoice_id');
        $this->db->join('customer_information d', 'd.customer_id = c.customer_id');
        $this->db->where($dateRange, NULL, FALSE);
		if(!empty($category_id))
		{
			$this->db->where('category_id=',$category_id);
		}
        $this->db->order_by('c.date', 'desc');
      //  $this->db->limit($perpage, $page);
        $query = $this->db->get();
		//echo "<br>";
		//echo $this->db->last_query();
        return $query->result_array();

        //$this->db->group_by('b.product_model');
    }

    //RETRIEVE DATE WISE SEARCH SINGLE PRODUCT REPORT
    //public function retrieve_product_search_sales_report_count($start_date, $end_date) {
    public function retrieve_product_search_sales_report_count($start_date, $end_date,$category_id=null) {
        $dateRange = "c.date BETWEEN '$start_date%' AND '$end_date%'";
        $this->db->select("a.*,b.product_name,b.product_model,c.date,d.customer_name");
        $this->db->from('invoice_details a');
        $this->db->join('product_information b', 'b.product_id = a.product_id');
        $this->db->join('invoice c', 'c.invoice_id = a.invoice_id');
        $this->db->join('customer_information d', 'd.customer_id = c.customer_id');
        $this->db->where($dateRange, NULL, FALSE);
		if(!empty($category_id))
		{
			$this->db->where('category_id=',$category_id);
		}
        $this->db->order_by('c.date', 'desc');
        $query = $this->db->get();
      //  echo $query->num_rows();
		//echo "<br>";
		//echo $this->db->last_query();
        return $query->num_rows();
    }

    //Retrieve company Edit Data
    public function retrieve_company() {
        $this->db->select('*');
        $this->db->from('company_information');
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function odr_manufacturing_costing($start_date, $end_date) {
        $dateRange = "a.date BETWEEN '$start_date' AND '$end_date'";
        $this->db->select("a.*,b.customer_id,b.customer_name,ii.product_id,ii.id as i_detail_id,p.product_name,u.uom_name");
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id','left');
        //$this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->join('invoice_details ii', 'ii.invoice_id = a.invoice_id','left');
        $this->db->join('product_information p', 'p.product_id = ii.product_id','left');
        $this->db->join('uom_list u', 'u.uom_id = p.uom','left');
        $this->db->where($dateRange, NULL, FALSE);
        $this->db->where('manufacturing_costing', '0');
        $this->db->order_by('a.date', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
	//	echo $this->db->last_query();die;
        return $query->result_array();
    }  

	public function sales_record($start_date, $end_date) 
	{
        $dateRange = "a.date BETWEEN '$start_date' AND '$end_date'";
        $this->db->select("u.first_name,u.last_name,a.*,b.*,sum(ii.quantity) qty ,GROUP_CONCAT(ii.product_id SEPARATOR ', ') AS product_id , GROUP_CONCAT(p.product_name SEPARATOR ', ') AS product_name,
		(select receipt_no from customer_ledger where invoice_no=a.invoice_id and d_c='c')receipt_no,
		(select payment_type from customer_ledger where invoice_no=a.invoice_id and d_c='c')payment_type,
		(select date from customer_ledger where invoice_no=a.invoice_id and d_c='c')payment_date ");
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id','left');
        $this->db->join('invoice_details ii','ii.invoice_id=a.invoice_id','left');
        $this->db->join('product_information p','p.product_id=ii.product_id','left');
        $this->db->join('users u','a.user_id=u.id','left');
        $this->db->where($dateRange, NULL, FALSE);
        $this->db->where('sales_record', '0');
        $this->db->group_by('ii.invoice_id');
        $this->db->order_by('a.invoice', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
		//echo $this->db->last_query();die;
        return $query->result_array();
    }
	public function sales_record_report($start_date, $end_date) 
	{
        $dateRange = "a.date BETWEEN '$start_date' AND '$end_date'";
        $this->db->select("u.first_name,u.last_name,a.*,b.*,sum(ii.quantity) qty ,GROUP_CONCAT(ii.product_id SEPARATOR ', ') AS product_id , GROUP_CONCAT(p.product_name SEPARATOR ', ') AS product_name,
		(select receipt_no from customer_ledger where invoice_no=a.invoice_id and d_c='c')receipt_no,
		(select payment_type from customer_ledger where invoice_no=a.invoice_id and d_c='c')payment_type,
		(select date from customer_ledger where invoice_no=a.invoice_id and d_c='c')payment_date,
		(select count(customer_id) from invoice where customer_id=b.customer_id) customer ");
        $this->db->from('invoice a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id','left');
        $this->db->join('invoice_details ii','ii.invoice_id=a.invoice_id','left');
        $this->db->join('product_information p','p.product_id=ii.product_id','left');
        $this->db->join('users u','a.user_id=u.id','left');
        $this->db->where($dateRange, NULL, FALSE);
        $this->db->group_by('ii.invoice_id');
        $this->db->order_by('a.invoice', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
		//echo $this->db->last_query();die;
        return $query->result_array();
    }
	public function manufacturing_cost_report($start_date, $end_date) 
	{
		$start_date= date ("Y-m-d", strtotime($start_date));
		$end_date= date ("Y-m-d", strtotime($end_date));
        $dateRange = "date(a.m_created_at) BETWEEN '$start_date' AND '$end_date'";
        $this->db->select("a.*,b.customer_name,u.first_name,u.last_name");
        $this->db->from('manufacturing_costing a');
        $this->db->join('customer_information b', 'a.customer_id = b.customer_id','left');
        $this->db->join('users u','a.user_id=u.id','left');
        $this->db->where($dateRange, NULL, FALSE);
        $this->db->order_by('a.m_created_at', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
		//echo $this->db->last_query();die;
        return $query->result_array();
    }
    public function odr_manufacturing_report($start_date, $end_date) {

		//$start_date= date ("Y-m-d", strtotime($start_date));
		//$end_date= date ("Y-m-d", strtotime($end_date));
       // $dateRange = "date(o.created_at) BETWEEN '$start_date' AND '$end_date'";
        $dateRange = "a.date BETWEEN '$start_date' AND '$end_date'";
        $this->db->select("a.*,a.invoice_id as inv_id,o.*,o.created_at as odr_date,b.customer_id,b.customer_name,ii.product_id,ii.id as i_detail_id,p.product_name,u.uom_name");
       // $this->db->from('odr_manufacturing_costing o');
        $this->db->from('invoice a');
      //  $this->db->join('invoice a', 'o.invoice_id = a.invoice_id','left');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id','left');
        //$this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->join('invoice_details ii', 'ii.invoice_id = a.invoice_id','left');
        $this->db->join('odr_manufacturing_costing o', 'ii.id = o.invoice_detail_id','left');
        $this->db->join('product_information p', 'p.product_id = ii.product_id','left');
        $this->db->join('uom_list u', 'u.uom_id = p.uom','left');
        $this->db->where($dateRange, NULL, FALSE);
        $this->db->order_by('a.date', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
		//echo $this->db->last_query();die;
        return $query->result_array();
    }
	
    public function profit_sheet($start_date, $end_date) {
		//echo "wqwe";die;
	/* 	$start_date= date ("Y-m-d", strtotime($start_date));
		$end_date= date ("Y-m-d", strtotime($end_date));
        $dateRange = "date(o.created_at) BETWEEN '$start_date' AND '$end_date'"; */
        $dateRange = "a.date BETWEEN '$start_date' AND '$end_date'";
        //$this->db->select("o.*,o.id as oid,sum(o.actual_costing) cost,o.created_at as odr_date,a.*,b.customer_id,b.customer_name,ii.*,ii.id as i_detail_id,p.product_name,u.uom_name");
        $this->db->select(" `a`.*, `b`.`customer_id`, `b`.`customer_name`, `ii`.*, `p`.`product_name`, `u`.`uom_name`,
						(select sum(actual_costing) from odr_manufacturing_costing where invoice_id=a.invoice_id) cost");
       // $this->db->from('odr_manufacturing_costing o');
        $this->db->from('invoice a');
       // $this->db->join('invoice a', 'o.invoice_id = a.invoice_id','left');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id','left');
      //  $this->db->join('invoice_details ii', 'ii.id = o.invoice_detail_id','left');
        $this->db->join('invoice_details ii', 'ii.invoice_id = a.invoice_id','left');
        $this->db->join('product_information p', 'p.product_id = ii.product_id','left');
        $this->db->join('uom_list u', 'u.uom_id = p.uom','left');
        $this->db->where($dateRange, NULL, FALSE);
        $this->db->group_by('a.invoice_id');
        $this->db->order_by('a.date', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
		//echo $this->db->last_query();
        return $query->result_array();
    }
	public function edit_embroidery_cost($data,$invoice)
	{
		//echo "wqwe";die;
		$this->db->where('invoice',$invoice);
		return $this->db->update('invoice',$data);
	}
	
	public function purchase_return_report($start_date, $end_date) 
	{
		$start_date= date ("Y-m-d", strtotime($start_date));
		$end_date= date ("Y-m-d", strtotime($end_date));
        $dateRange = "date(a.created_at) BETWEEN '$start_date' AND '$end_date'";
        //$dateRange = "date(a.created_at) BETWEEN '2020-04-01' AND '2020-04-30'";
        $this->db->select('a.*,
						b.*,
						c.product_id,
						c.product_name,
						c.product_model,
						c.cartoon_quantity'
        );
        $this->db->from('return_product_purchase a');
        $this->db->join('return_product_purchase_details b', 'b.return_id =a.return_id');
        $this->db->join('product_information c', 'c.product_id =b.product_id');
        $this->db->where($dateRange, NULL, FALSE);
        $this->db->order_by('a.created_at', 'desc');
        $query = $this->db->get();
        return $query->result_array();
		//echo $this->db->last_query();
		//return $query;
		//print_r($this->db->error());die;
    }
	
	public function invoice_return_report($start_date, $end_date) 
	{
		$start_date= date ("Y-m-d", strtotime($start_date));
		$end_date= date ("Y-m-d", strtotime($end_date));
        $dateRange = "date(a.created_at) BETWEEN '$start_date' AND '$end_date'";
        //$dateRange = "date(a.created_at) BETWEEN '2020-04-01' AND '2020-04-30'";
        $this->db->select('a.*,
						b.*,
						p.product_id,
						p.product_name,
						p.product_model,
						p.cartoon_quantity'
        );
        $this->db->from('return_invoice a');
        $this->db->join('return_invoice_details b', 'b.return_id =a.return_id');
        $this->db->join('product_information p', 'p.product_id =b.product_id');
        $this->db->join('customer_information c', 'c.customer_id =a.customer_id','left');
        $this->db->where($dateRange, NULL, FALSE);
        $this->db->order_by('a.created_at', 'desc');
        $query = $this->db->get();
        return $query->result_array();
		//echo $this->db->last_query();
		//return $query;
		//print_r($this->db->error());die;
    }
}
