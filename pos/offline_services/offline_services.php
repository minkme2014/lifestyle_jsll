<?php

	if($_REQUEST['f'] == 'access'){
		access();
	}
	else if($_REQUEST['f'] == 'add_invoice'){
		add_invoice();
	}
 function access()
{
   
    $hostname = "localhost";
    $database = "retailmi_demo_vendors";
    
    if($_SERVER['HTTP_HOST']=="localhost"){
    	$username = "root";
    	$password = "";		
    } else {
    	$username = "retailmi_vendors";
    	$password = "retailmi_vendors@321";		
    }
    
    $conn = mysqli_connect($hostname,$username,$password,$database);
    if(!$conn){
    	die("Server not connected");

    } else {
        if(isset($_REQUEST) && !empty($_REQUEST)){
            $data = $_REQUEST;
            $sql = 'SELECT * FROM connect where email="'.$data['email'].'"and userpass="'.md5($data['userpass']).'"';
          //  $sql = 'SELECT * FROM connect where email="parmod@indianmesh.com" and userpass="'.md5('123456').'"';
          //  //echo $sql; die;
            $res = mysqli_query($conn, $sql);
            if($data['bit']==1)
            {
            if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
                $id = $row['id'];
                $email = $row['email'];
                $user= $row['dbuser'];
                $pass= $row['dbpass'];
                $db = $row['dbname'];
                $conn2 = mysqli_connect("localhost",$user,$pass,$db);
                 if (!$conn2) {
                    // //echo "if";
					    $data['status']='failure';	
                        die("Connection failed: " . mysqli_connect_error());
                    }else{
                      //  //echo "else";
                        $data=array();
                        $sql1="SELECT a.*, u.uom_name,
                                (IFNULL((select sum(product_purchase_details.quantity) from product_purchase_details left join product_purchase on 
                                product_purchase.purchase_id=product_purchase_details.purchase_id where product_id= a.product_id and purchase_date <= DATE(CURRENT_TIMESTAMP)),0)
                                -IFNULL((select sum(invoice_details.quantity) from invoice_details left join invoice on invoice_details.invoice_id = invoice.invoice_id
                                where product_id= a.product_id and date <= DATE(CURRENT_TIMESTAMP)),0)-IFNULL((select sum(manualconsumption.qty) from manualconsumption 
                                where product_id= a.product_id and cast(created_on as date) <= DATE(CURRENT_TIMESTAMP) ),0)) as 'available_qty'
                                FROM product_information a LEFT JOIN uom_list u ON a.uom = u.uom_id LEFT JOIN stock_history b ON b.product_id = a.product_id WHERE a.status = 1 
                                GROUP BY a.product_id ORDER BY a.product_id DESC";
                       // $sql1='SELECT * FROM product_information';
                    //    $sql2='SELECT * FROM product_purchase_details';
                    //    $sql3='SELECT * FROM invoice_details';
                   //     $sql4='SELECT * FROM manualconsumption';
                        $sql5='SELECT * FROM uom_list';
                        $sql6='SELECT * FROM customer_information';
                    //    $sql7='SELECT * FROM customer_ledger';
                    //    $sql8='SELECT * FROM transection';
                    //    $sql9='SELECT * FROM inflow_92mizdldrv';
                    //    $sql10='SELECT * FROM invoice';
                        $sql11='SELECT * FROM web_setting';
                        $sql12='SELECT * FROM company_information';
                        $sql13='SELECT * FROM user_login';
                        $sql14='SELECT * FROM product_category';
                        
                        $res1 = mysqli_query($conn2, $sql1);
                        if ($res1->num_rows > 0) {
                            // output data of each row
                             while($row = $res1->fetch_assoc()) {
                                $data['product_information'][]= $row ;
                            }
                        } 
                      /* $res2 = mysqli_query($conn2, $sql2);
                        if ($res2->num_rows > 0) {
                            // output data of each row
                             while($row2 = $res2->fetch_assoc()) {
                                $data['product_purchase_details'][] = $row2 ;
                            }
                        }   
                        $res3 = mysqli_query($conn2, $sql3);
                        if ($res3->num_rows > 0) {
                            // output data of each row
                             while($row3 = $res3->fetch_assoc()) {
                                $data['invoice_details'][] = $row3 ;
                            }
                        }   
                        $res4 = mysqli_query($conn2, $sql4);
                        if ($res4->num_rows > 0) {
                            // output data of each row
                             while($row4 = $res4->fetch_assoc()) {
                                $data['manualconsumption'][] = $row4 ;
                            }
                        }   */
                        $res5 = mysqli_query($conn2, $sql5);
                        if ($res5->num_rows > 0) {
                            // output data of each row
                            while($row5 = $res5->fetch_assoc()) {
                                $data['uom_list'][] = $row5 ;
                            }
                        }   
                        $res6 = mysqli_query($conn2, $sql6);
                        if ($res6->num_rows > 0) {
                            // output data of each row
                            while($row6 = $res6->fetch_assoc()) {
                                $data['customer_information'][] = $row6 ;
                            }
                        }   
                        /*
                        $res7 = mysqli_query($conn2, $sql7);
                        if ($res7->num_rows > 0) {
                            // output data of each row
                            while($row7 = $res7->fetch_assoc()) {
                                $data['customer_ledger'][] = $row7 ;
                            }
                        }   
                        $res8 = mysqli_query($conn2, $sql8);
                        if ($res8->num_rows > 0) {
                            // output data of each row
                            while($row8 = $res8->fetch_assoc()) {
                                $data['transection'][] = $row8 ;
                            }
                        }   
                        $res9 = mysqli_query($conn2, $sql9);
                        if ($res9->num_rows > 0) {
                            // output data of each row
                            while($row9 = $res9->fetch_assoc()) {
                                $data['inflow_92mizdldrv'][] = $row9 ;
                            }
                        }   
                        $res10 = mysqli_query($conn2, $sql10);
                        if ($res10->num_rows > 0) {
                            // output data of each row
                            while($row10 = $res10->fetch_assoc()) {
                                $data['invoice'][] = $row10 ;
                            }
                        }   
                        */
                        $res11 = mysqli_query($conn2, $sql11);
                        if ($res11->num_rows > 0) {
                            // output data of each row
                            while($row11 = $res11->fetch_assoc()) {
                                $data['web_setting'][] = $row11 ;
                            }
                        }   
                        $res12 = mysqli_query($conn2, $sql12);
                        if ($res12->num_rows > 0) {
                            // output data of each row
                            while($row12 = $res12->fetch_assoc()) {
                                $data['company_information'][] = $row12 ;
                            }
                        }  
                        $res13 = mysqli_query($conn2, $sql13);
                        if ($res13->num_rows > 0) {
                            // output data of each row
                            while($row13 = $res13->fetch_assoc()) {
                                $data['user_login'][] = $row13 ;
                            }
                        }
                        
                        $res14 = mysqli_query($conn2, $sql14);
                        if ($res14->num_rows > 0) {
                            // output data of each row
                            while($row14 = $res14->fetch_assoc()) {
                                $data['product_category'][] = $row14 ;
                            }
                        }
						 $data['status']='success';	
                    }
            }
            else{
            	
                $data['status']='failure';	
            }  
            }
        }
    }
   // print_r($data);
    echo json_encode($data);
}

function add_invoice()
{
	$returndata=array();
    $insertedInvoice=array();
    $hostname = "localhost";
    $database = "retailmi_demo_vendors";
    
    if($_SERVER['HTTP_HOST']=="localhost"){
    	$username = "root";
    	$password = "";		
    } else {
    	$username = "retailmi_vendors";
    	$password = "retailmi_vendors@321";		
    }
    
    $conn = mysqli_connect($hostname,$username,$password,$database);
    if(!$conn){
    	die("Server not connected");
        $returndata['status']='failure';
		$returndata['data']=$insertedInvoice;
    } else {
    
			//echo "here"; 
         if(isset($_REQUEST) && !empty($_REQUEST)){
            $data = $_REQUEST;
			//echo "here";
			 //echo $data['data'];
			  $data2=json_decode($data['data']);
			  // echo $data2->email;
			  
			 
               $mail= $data2->email ;
			
            $sql = 'SELECT * FROM connect where email="'.$mail.'"';
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
                $id = $row['id'];
                $email = $row['email'];
                $user= $row['dbuser'];
                $pass= $row['dbpass'];
                $db = $row['dbname'];
                $conn2 = mysqli_connect("localhost",$user,$pass,$db);
                 if (!$conn2) {
                    // //echo "if";
                        die("Connection failed: " . mysqli_connect_error());
						$returndata['status']='failure';
						$returndata['data']=$insertedInvoice;
                    }else{
						   $allcheck=true;
						   $data3=$data2->offlineInvoice;
							foreach($data3 as $c)
							   {  
								// print_r($c);
								 //echo "<br>";
								 $check=true;
								 $invoiceId=0;
								 $invoiceStatus=0;
								 if($c->invoice)
								  { 
							        $invoiceId=$c->invoice->invoice_id;
									//echo  "<br>IVOICE NUMBER : ".$invoiceId;
									//echo "<br>";
									$checkInvoice=get_invoice_id_by_offline_invoice_id($conn2,$invoiceId);
									 //echo  $checkInvoice;
									  if($checkInvoice>0){
										 $invoiceStatus=1; 
										 $insertedInvoice[''.$invoiceId]=2;
                                         //echo "hello $invoiceStatus"	;									 
									  }
								  }
								 if($invoiceStatus==0){
								 if(isset($c->customer_information) &&  $check)
								 {
									 $customer=$c->customer_information;
									 if($customer->customer_mobile){
										// echo $customer->customer_mobile;
										 $sql1='SELECT * FROM customer_information where customer_mobile='.$customer->customer_mobile;
										 $res1 = mysqli_query($conn2, $sql1);
										 if ($res1->num_rows > 0) 
										 {
											$sqlu="UPDATE customer_information SET offline_customer_id='".$customer->customer_id."', offline_cust_id='".$customer->id."' where customer_mobile=".$customer->customer_mobile;
											$res2 = mysqli_query($conn2, $sqlu);
											// print_r($res2);
											 if($res2){
												 $check=true;
											}
											 else{
												 $check=false;
												 $allcheck=false;
												
											 }
										 }
										 else
										 {
											$customer_id=generator(15);
											$data='"'.$customer_id.'", "'.$customer->customer_name .'", "'.$customer->customer_address .'", "'.$customer->customer_mobile.'", "'.$customer->customer_email .'", "'. $customer->status .'", "'.$customer->gst_no.'", "'.$customer->state_code.'", "'.$customer->bill .'", "'.$customer->delivery 
											.'", "'.$customer->customer_id .'", "'.$customer->id .'"';
											
												$sqlu="INSERT into customer_information (customer_id, customer_name, customer_address, customer_mobile, customer_email, status, gst_no, state_code, bill, delivery, offline_customer_id, offline_cust_id) VALUES ("
												.$data. ")";
												$res2 = mysqli_query($conn2, $sqlu);
												
												 if($res2){
													 $check=true;
												}
												 else{
													 $check=false;
													 $allcheck=false;
												 }
												
										}
									   }
								  }
								  if($c->invoice &&  $check)
								  {
									  $invoice=$c->invoice;
									  $invoice_no=number_generator($conn2);
								      $invoice_id=generate_invoice_id($conn2);
									  $customer_id="";
									  if($invoice->cust_id!=0){
									   $customer_id=get_customer_id_by_cust_id($conn2,$invoice->cust_id);
									  }
									  $idata='"'.$invoice_id .'","'.$customer_id.'","'.$invoice->date.'","'.$invoice->total_amount.'","'.$invoice_no.'","'.$invoice->total_discount.'","'.$invoice->total_tax
									       .'","'.$invoice->status .'","'.$invoice->delivery_charges .'","'.$invoice->freight_charges .'","'.$invoice->user_id.'","'.$invoice->invoice_id .'"';
									   $sqlI="INSERT INTO invoice (invoice_id, customer_id, date, total_amount, invoice, total_discount, total_tax, 
								       status, delivery_charges, freight_charges, user_id, offline_invoice_id) VALUES(".$idata." )";
									   //commented code to insert data into table uncomment before upload on server
								       $res3 = mysqli_query($conn2, $sqlI);
											
											 if($res3){
												 $check=true;
											}
											 else{
												 $check=false;
												 $allcheck=false;
												 break;
											 }
								//commented code to insert data into table uncomment before upload on server end
								}
								
								if($c->transection &&  $check)
							    {
								   $transection=$c->transection;	
								   $transaction_id =generator(15);
								   $customer_id="";
								    if($transection->cust_id!=0){
								     $customer_id=get_customer_id_by_cust_id($conn2,$transection->cust_id);
									}
								   $tdata='"'. $transaction_id .'","'.$transection->date_of_transection .'","'.$transection->transection_type
									.'","'.$transection->transection_category .'","'.$transection->transection_mood .'","'.$transection->amount
									.'","'.$transection->pay_amount .'","'.$transection->description .'","'.$customer_id
									.'","'.$transection->create_date.'","'.$transection->transaction_id .'"';
									 $sqlT="INSERT INTO transection(transaction_id, date_of_transection, 
									transection_type, transection_category, transection_mood, amount, 
									pay_amount, description, relation_id, create_date, offline_trans_id)
									VALUES (".$tdata.")";
									//commented code to insert data into table uncomment before upload on server
									  $res4 = mysqli_query($conn2, $sqlT);
											
											 if($res4){
												 $check=true;
											}
											 else{
												 $check=false;
												 $allcheck=false;
												 break;
											 }
							 	//commented code to insert data into table uncomment before upload on server end
									
								}
								
								
								if($c->customer_ledger && $check )
							    {
									    foreach($c->customer_ledger as $b)
							             {
											   $transaction_id =get_transection_id_by_offline_trans_id($conn2, $b->transaction_id);
											   $customer_id="";
											    if($b->cust_id!=0){
											      $customer_id=get_customer_id_by_cust_id($conn2,$b->cust_id);
												}
											  // //echo  "customer_id".$customer_id."<br>"; 
											   $invoice=null;
											   if($b->d_c=="d")
											   {
												 $invoice=get_invoice_id_by_offline_invoice_id($conn2,$b->invoice_no); 
											   }
												$ldata='"'. $transaction_id .'","'.$customer_id.'","'.$invoice
												.'","'.$b->receipt_no .'","'.$b->amount .'","'.$b->description
												.'","'.$b->payment_type .'","'.$b->cheque_no .'","'.$b->date 
												.'","'.$b->status.'","'.$b->d_c .'"';
												
												$sqlL="INSERT INTO customer_ledger(transaction_id, customer_id, 
												invoice_no, receipt_no, amount, description, payment_type, 
												cheque_no, date, status, d_c) VALUES (".$ldata.")";
												
												//commented code to insert data into table uncomment before upload on server
												   $res5 = mysqli_query($conn2, $sqlL);
														
														 if($res5){
															 $check=true;
														}
														 else{
															 $check=false;
															 $allcheck=false;
															 break;
														 }
											//commented code to insert data into table uncomment before upload on server end
									     }
								}
								if($c->inflow_92mizdldrv &&  $check)
							    {
									 $inflow=$c->inflow_92mizdldrv;
									 $transection_id =get_transection_id_by_offline_trans_id($conn2, $inflow->transection_id);
								     $tracing_id="";
									  if($inflow->cust_id!=0){
									    $tracing_id=get_customer_id_by_cust_id($conn2,$inflow->cust_id);
									  }
									 $indata='"'. $transection_id .'","'.$tracing_id.'","'.$inflow->payment_type
									 .'","'.$inflow->date .'","'.$inflow->amount .'","'.$inflow->description
									 .'","'.$inflow->status.'"';
									$sqlIn="INSERT INTO inflow_92mizdldrv(transection_id, tracing_id, payment_type, 
									date, amount, description, status) VALUES (".$indata.")";
									//commented code to insert data into table uncomment before upload on server
									   $res5 = mysqli_query($conn2, $sqlIn);
											
											 if($res5){
												 $check=true;
											}
											 else{
												 $check=false;
												 $allcheck=false;
												
											 }
							 	//commented code to insert data into table uncomment before upload on server end
									
								}
								
								if($c->invoice_details && $check)
								{
								  foreach($c->invoice_details as $b)
									{
									   $invoice_id =get_invoice_id_by_offline_invoice_id($conn2, $b->invoice_id);
									   $invoice_details_id =generate_invoice_details_id($conn2);
									   
									   $iddata='"'.$invoice_details_id .'","'.$invoice_id.'","'.$b->product_id
										.'","'.$b->cartoon .'","'.$b->quantity .'","'.$b->rate.'","'.$b->supplier_rate.'","'
										.$b->total_price.'","'.$b->discount.'","'.$b->this_discount.'","'.$b->tax
										.'","'.$b->this_tax.'","'.$b->paid_amount.'","'.$b->due_amount.'","'.$b->status.'","'
										.$b->cgst.'","'.$b->sgst.'","'.$b->igst.'"';
										$sqlId="INSERT INTO invoice_details(invoice_details_id, invoice_id, 
										product_id, cartoon, quantity, rate, supplier_rate, total_price, 
										discount, this_discount, tax, this_tax, paid_amount, due_amount, 
										status, cgst, sgst, igst) VALUES (".$iddata.")";
									    //commented code to insert data into table uncomment before upload on server
									    $res6 = mysqli_query($conn2, $sqlId);
											
											 if($res6){
												 $check=true;
											}
											 else{
												 $check=false;
												 $allcheck=false;
												 break;
											 }
							 	//commented code to insert data into table uncomment before upload on server end
									
									}
								}
								if($check)
								{
									
									$insertedInvoice[''.$invoiceId]=1;
								}
								else
								{
									$insertedInvoice[''.$invoiceId]=3;
								}
							  }
							  
						    }
							if($allcheck)
							{
							 $returndata['status']='success';
                             $returndata['data']=$insertedInvoice;
							
                             $dataR=array();
							 $sql1="SELECT a.*, u.uom_name,
										(IFNULL((select sum(product_purchase_details.quantity) from product_purchase_details left join product_purchase on 
										product_purchase.purchase_id=product_purchase_details.purchase_id where product_id= a.product_id and purchase_date <= DATE(CURRENT_TIMESTAMP)),0)
										-IFNULL((select sum(invoice_details.quantity) from invoice_details left join invoice on invoice_details.invoice_id = invoice.invoice_id
										where product_id= a.product_id and date <= DATE(CURRENT_TIMESTAMP)),0)-IFNULL((select sum(manualconsumption.qty) from manualconsumption 
										where product_id= a.product_id and cast(created_on as date) <= DATE(CURRENT_TIMESTAMP) ),0)) as 'available_qty'
										FROM product_information a LEFT JOIN uom_list u ON a.uom = u.uom_id LEFT JOIN stock_history b ON b.product_id = a.product_id WHERE a.status = 1 
										GROUP BY a.product_id ORDER BY a.product_id DESC";
						
							   $sql2='SELECT * FROM uom_list';
						       $sql4='SELECT * FROM web_setting';
							   $sql5='SELECT * FROM company_information';
							   //$sql6='SELECT * FROM user_login';
							   $sql7='SELECT max(invoice) as invoice_no FROM invoice';
                                                           $sql18='SELECT * FROM product_category';
							   $res1 = mysqli_query($conn2, $sql1);
							   if ($res1->num_rows > 0) {
									// output data of each row
									 while($row = $res1->fetch_assoc()) {
										$returndata['product_information'][]= $row ;
									}
							    }
                                $res5 = mysqli_query($conn2, $sql2);
								if ($res5->num_rows > 0) {
									// output data of each row
									while($row5 = $res5->fetch_assoc()) {
										$returndata['uom_list'][] = $row5 ;
									}
								}   
								$res11 = mysqli_query($conn2, $sql4);
								if ($res11->num_rows > 0) {
									// output data of each row
									while($row11 = $res11->fetch_assoc()) {
										$returndata['web_setting'][] = $row11 ;
									}
								}   
								$res12 = mysqli_query($conn2, $sql5);
								if ($res12->num_rows > 0) {
									// output data of each row
									while($row12 = $res12->fetch_assoc()) {
										$returndata['company_information'][] = $row12 ;
									}
								} 
								
								$res13 = mysqli_query($conn2, $sql7);
								if ($res13->num_rows > 0){
									// output data of each row
									$res13 = $res13->fetch_assoc();
										 ////echo "<br>abcd<br>";
										 $returndata['invoice_no']=$res13['invoice_no'];
										 ////echo $res13['invoice_no'];
									
								}
                                                                
                                                                $res18 = mysqli_query($conn2, $sql18);
								if ($res18->num_rows > 0) {
									// output data of each row
									while($row18 = $res18->fetch_assoc()) {
										$returndata['product_category'][] = $row18 ;
									}
								}
                                                                
                                                                
								
							}
						   else{
						     $returndata['status']='failure';
                             $returndata['data']=$insertedInvoice;
							}
						
			            }
						
		}else{
		  $returndata['status']='failure';
		 $returndata['data']=$insertedInvoice;		  
		}
    }
  }
	//ob_end_clean();
	////echo  "<br> return data :  ";
    echo json_encode($returndata);	
}

    //This function is used to Generate Key
 function generator($lenth) {
        $number = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "N", "M", "O", "P", "Q", "R", "S", "U", "V", "T", "W", "X", "Y", "Z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

        for ($i = 0; $i < $lenth; $i++) {
            $rand_value = rand(0, 34);
            $rand_number = $number["$rand_value"];

            if (empty($con)) {
                $con = $rand_number;
            } else {
                $con = "$con" . "$rand_number";
            }
        }
        return $con;
    }
	
	//NUMBER GENERATOR
     function number_generator($connDb) {
		$sql1='SELECT max(invoice) as invoice_no FROM invoice';
		$res = mysqli_query($connDb, $sql1);
        if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
				$invoice_no = $row['invoice_no'] + 1;
            }else{   
            $invoice_no = 1000;
             }
        return $invoice_no;
    }
	
	//NUMBER GENERATOR
     function generate_invoice_id($connDb) {
		$sql1='SELECT max(invoice_id) as invoice_id FROM invoice';
		$res = mysqli_query($connDb, $sql1);
        if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
				$invoice_id = $row['invoice_id'] + 1;
            }else{   
             $invoice_id = 1;
             }
        return $invoice_id;
    }
	
	function get_customer_id_by_cust_id($connDb, $cust_id)
	{
		//echo  "<br>get_customer_id_by_cust_id".$cust_id."<br>";
	    $sql1='SELECT customer_id FROM customer_information where offline_cust_id="'.$cust_id.'"';
		$res = mysqli_query($connDb, $sql1);
        if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
				$customer_id =$row['customer_id'];
            }
		 return $customer_id;
	}
	function get_customer_id_by_mobile($connDb, $mobile)
	{
		//echo  "<br>get_customer_id_by_cust_id".$cust_id."<br>";
	    $sql1='SELECT customer_id FROM customer_information where customer_mobile="'.$mobile.'"';
		$res = mysqli_query($connDb, $sql1);
        if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
				$customer_id =$row['customer_id'];
            }
		 return $customer_id;
	}
	
	
	function get_transection_id_by_offline_trans_id($connDb, $trans_id)
	{
		//echo  "<br>get_transection_id_by_offline_trans_id by".$trans_id."<br>";
		//echo $trans_id;
	    $sql1='SELECT transaction_id FROM transection where offline_trans_id="'.$trans_id.'"';
		$res = mysqli_query($connDb, $sql1);
        if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
				$transaction_id =$row['transaction_id'];
            }
		 return $transaction_id;
		
	}
	
	function get_invoice_id_by_offline_invoice_id($connDb, $invo_id)
	{
		$invoice_id=0;
		//echo  "<br>get_invoice_id_by_offline_invoice_id".$invoice_id."<br>";
	    $sql1='SELECT invoice_id FROM invoice where offline_invoice_id="'.$invo_id.'"';
		$res = mysqli_query($connDb, $sql1);
        if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
				$invoice_id =$row['invoice_id'];
            }
		 return $invoice_id;
		
	}
	
	//NUMBER GENERATOR
     function generate_invoice_details_id($connDb) {
		$sql1='SELECT max(invoice_details_id) as invoice_details_id FROM invoice_details';
		$res = mysqli_query($connDb, $sql1);
        if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
				$invoice_details_id = $row['invoice_details_id'] + 1;
            }else{   
             $invoice_details_id = 1;
             }
        return $invoice_details_id;
    }


?>

