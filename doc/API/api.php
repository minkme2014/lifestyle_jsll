<?php

if(isset($_GET))
{
    if($_GET['f']=='upload_material_master')
    {
        upload_material_master();
    }else if($_GET['f']=='upload_mrp')
    {
        upload_mrp();
    }else if($_GET['f']=='upload_budget_update')
    {
        upload_budget_update();
    }else if($_GET['f']=='upload_so_to_inv')
    {
        upload_so_to_inv();
    }
}
//print_r($_POST);die;

     function get_auth()
    {
        print_r(getallheaders());die;
        $headers=array();
        foreach (getallheaders() as $name => $value) {
            $headers[$name] = $value;
        }
        print_r($headers);
        echo $headers['Authorization'];
    }
    
     function upload_material_master()
    {
        $hostname = "localhost";
        $database = "lifestyl_jsll";
        
        if($_SERVER['HTTP_HOST']=="localhost"){
        	$username = "root";
        	$password = "";		
        } else {
        	$username = "lifestyl_jsll";
        	$password = "lifestyl_jsll@321";		
        }
        $conn = mysqli_connect($hostname,$username,$password,$database);
        if(!$conn){
        	die("Server not connected");
        	
        } else {
            //print_r($_POST);
              //  $sql = "SELECT * FROM tbl_users where username='".$_POST['username']."' and password='".$_POST['password']."'";
            //    $result = mysqli_query($conn, $sql);
                
              //  if (mysqli_num_rows($result) > 0) {
                    
                    //if(isset($_FILES['file']['name']) &&  $_FILES['file']['name'] != '' && $_FILES['file']['name'] !="undefined" && $_FILES['file']['name'] !=null)   //for file
                    //{                                                                                                                                                 //for file
                    // $file_data = explode('.', $_FILES['file']['name']);                                                                                              //for file
                    // $file_extension = end($file_data);                                                                                                               //for file
                     //echo $file_extension;                                                                                                                         
                   //  if($file_extension=='xml')                                                                                                                       //for file
                    // {                                                                                                                                                //for file
 
                         $affectedRow = 0;
                                                 
                        $note=file_get_contents("php://input");
                        $note_final = explode('?>', $note);
                      //  $xml = simplexml_load_file($_FILES['file']['tmp_name']);                                                                                      //for file
                        //$xml = simplexml_load_string("<items>".$_POST['file']."</items>") or die("Error: Cannot create object");                                        //for text data
                        $xml = simplexml_load_string($note) or die("Error: Cannot create object"); 
                        foreach ($xml->children() as $row) {
                            $field_1 = $row->MANDT;
                            $field_2 = $row->MATNR;
                            $field_3 = $row->WERKS;
                            $field_4 = $row->LGORT;
                            $field_5 = $row->MTART;
                            $field_6 = $row->MATKL;
                            $field_7 = $row->MEINS;
                            $field_8 = $row->STEUC;
                            $field_9 = $row->MAKTX;
                            $field_10 = $row->BISMT;
                            $field_11= $row->ERNAM;
                            $field_12= $row->ERDAT;
                            $field_13= $row->ERZET;
                            
                            $sql = "INSERT INTO material_master(MANDT,MATNR,WERKS,LGORT,MTART,MATKL,MEINS,STEUC,MAKTX,BISMT,ERNAM,ERDAT,ERZET) 
                            VALUES ('" . $field_1 . "','" . $field_2 . "','" . $field_3 . "','" . $field_4 . "','" . $field_5 . "','" . $field_6 . "','" . $field_7 . "','" . $field_8 . "','" . $field_9 . "','" . $field_10 . "','" . $field_11 . "','" . $field_12 . "','" . $field_13 . "')";
                            
                            $result = mysqli_query($conn, $sql);
                            
                            if (! empty($result)) {
                                $affectedRow ++;
                            } else {
                                $error_message = mysqli_error($conn) . "\n";die;
                            }
                        }
                        if($affectedRow>0)
                        {
                            echo $affectedRow." rows inserted";
                        }
                        
                   //  }
                     //else
                     //{
                      //echo "Invalid File";die;
                     //}
                   // }
                   // else
                   // {
                    // $output = '<div class="alert alert-warning">Please Select XML File</div>';
                  //  }
                    
                    echo $output;
              //  } else {
                //  echo "Invalid username or password";
                //}
            
                   
        }
        mysqli_close($conn);
    }
    
     function upload_mrp()
    {
        $hostname = "localhost";
        $database = "lifestyl_jsll";
        
        if($_SERVER['HTTP_HOST']=="localhost"){
        	$username = "root";
        	$password = "";		
        } else {
        	$username = "lifestyl_jsll";
        	$password = "lifestyl_jsll@321";		
        }
        $conn = mysqli_connect($hostname,$username,$password,$database);
        if(!$conn){
        	die("Server not connected");
        	
        } else {
             $affectedRow = 0;
                                     
            $note=file_get_contents("php://input");
            $note_final = explode('?>', $note);
            $xml = simplexml_load_string($note) or die("Error: Cannot create object"); 
            foreach ($xml->children() as $row) {
                $field_1 = $row->MANDT;
                $field_2 = $row->KSCHL;
                $field_3 = $row->VKORG;
                $field_4 = $row->VTWEG;
                $field_5 = $row->MATNR;
                $field_6 = $row->DATBI;
                $field_7 = $row->DATAB;
                $field_8 = $row->KBETR;
                $field_9 = $row->ERNAM;
                $field_10 = $row->ERDAT;
                $field_11= $row->ERZET;
                
                $sql = "INSERT INTO mrp(MANDT,KSCHL,VKORG,VTWEG,MATNR,DATBI,DATAB,KBETR,ERNAM,ERDAT,ERZET) 
                VALUES ('" . $field_1 . "','" . $field_2 . "','" . $field_3 . "','" . $field_4 . "','" . $field_5 . "','" . $field_6 . "','" . $field_7 . "','" . $field_8 . "','" . $field_9 . "','" . $field_10 . "','" . $field_11 . "')";
                
                $result = mysqli_query($conn, $sql);
                
                if (! empty($result)) {
                    $affectedRow ++;
                } else {
                    $error_message = mysqli_error($conn) . "\n";die;
                }
            }
            if($affectedRow>0)
            {
                echo $affectedRow." rows inserted";
            }
        echo $output;    
        }
        mysqli_close($conn);
    }      
    
     function upload_budget_update()
    {
        $hostname = "localhost";
        $database = "lifestyl_jsll";
        
        if($_SERVER['HTTP_HOST']=="localhost"){
        	$username = "root";
        	$password = "";		
        } else {
        	$username = "lifestyl_jsll";
        	$password = "lifestyl_jsll@321";		
        }
        $conn = mysqli_connect($hostname,$username,$password,$database);
        if(!$conn){
        	die("Server not connected");
        	
        } else {
             $affectedRow = 0;
                                     
            $note=file_get_contents("php://input");
            $note_final = explode('?>', $note);
            $xml = simplexml_load_string($note) or die("Error: Cannot create object"); 
            foreach ($xml->children() as $row) {
                $field_1 = $row->MANDT;
                $field_2 = $row->VBUKR;
                $field_3 = $row->PROFL;
                $field_4 = $row->OBJNR;
                $field_5 = $row->PSPNR;
                $field_6 = $row->POST1;
                $field_7 = $row->POSID;
                $field_8 = $row->POST11;
                $field_9 = $row->PRCTR;
                $field_10 = $row->WERKS;
                $field_11= $row->SERDAT;
                $field_12= $row->TOTBUD;
                $field_13= $row->RELBUD;
                $field_14= $row->PRCOMM;
                $field_15= $row->POCOMM;
                $field_16= $row->TOCOMM;
                $field_17= $row->ACTCOS;
                $field_18= $row->ASSBUD;
                $field_19= $row->AVAL1;
                $field_20= $row->AVAL2;
                $field_21= $row->ERDAT;
                $field_22= $row->ERNAM;
                $field_23= $row->ERZET;
                
                $sql = "INSERT INTO budget_update(MANDT,VBUKR,PROFL,OBJNR,PSPNR,POST1,POSID,POST11,PRCTR,WERKS,SERDAT,TOTBUD,RELBUD,PRCOMM,POCOMM,TOCOMM,ACTCOS,ASSBUD,AVAL1,AVAL2,ERDAT,ERNAM,ERZET) 
                VALUES ('" . $field_1 . "','" . $field_2 . "','" . $field_3 . "','" . $field_4 . "','" . $field_5 . "','" . $field_6 . "','" . $field_7 . "','" . $field_8 . "','" . $field_9 . "','" . $field_10 . "','" . $field_11 . "',
                '" . $field_12 . "','" . $field_13 . "','" . $field_14 . "','" . $field_15 . "','" . $field_16 . "','" . $field_17 . "','" . $field_18 . "','" . $field_19 . "','" . $field_20 . "','" . $field_21 . "','" . $field_22 . "','" . $field_23 . "')";
                
                $result = mysqli_query($conn, $sql);
                
                if (! empty($result)) {
                    $affectedRow ++;
                } else {
                    $error_message = mysqli_error($conn) . "\n";die;
                }
            }
            if($affectedRow>0)
            {
                echo $affectedRow." rows inserted";
            }
        echo $output;    
        }
        mysqli_close($conn);
    }   
    
     function upload_so_to_inv()
    {
        $hostname = "localhost";
        $database = "lifestyl_jsll";
        
        if($_SERVER['HTTP_HOST']=="localhost"){
        	$username = "root";
        	$password = "";		
        } else {
        	$username = "lifestyl_jsll";
        	$password = "lifestyl_jsll@321";		
        }
        $conn = mysqli_connect($hostname,$username,$password,$database);
        if(!$conn){
        	die("Server not connected");
        	
        } else {
             $affectedRow = 0;
                                     
            $note=file_get_contents("php://input");
            $note_final = explode('?>', $note);
            $xml = simplexml_load_string($note) or die("Error: Cannot create object"); 
            foreach ($xml->children() as $row) {
                $field_1 = $row->MANDT;
                $field_2 = $row->VBELN;
                $field_3 = $row->POSNR;
                $field_4 = $row->DELIVERY;
                $field_5 = $row->DELIVERYI;
                $field_6 = $row->BILLD;
                $field_7 = $row->BILLDI;
                $field_8 = $row->SERNAM;
                $field_9 = $row->SERDAT;
                $field_10 = $row->ERZET;
                $field_11= $row->ERDAT;
                $field_12= $row->ERNAM;
                $field_13= $row->AUART;
                $field_14= $row->VKORG;
                $field_15= $row->VTWEG;
                $field_16= $row->SPART;
                $field_17= $row->KUNNR;
                $field_18= $row->LIFSK;
                $field_19= $row->FAKSK;
                $field_20= $row->AUTLF;
                $field_21= $row->WERKS;
                $field_22= $row->PS_PSP_PNR;
                $field_23= $row->MATNR;
                $field_24= $row->KWMENG;
                $field_25= $row->VRKME;
                $field_26= $row->ARKTX;
                $field_27= $row->ABGRU;
                $field_28= $row->MVGR3;
                $field_29= $row->MVGR4;
                $field_30= $row->MVGR5;
                $field_31= $row->VTEXT;
                $field_33= $row->BEZEI;
                $field_34= $row->VTEXT1;
                $field_35= $row->NAME1;
                $field_36= $row->SLDPRT;
                $field_37= $row->SHPPRT;
                $field_38= $row->SHPPRTD;
                $field_39= $row->PAYER;
                $field_40= $row->PAYERD;
                $field_41= $row->BILPRT;
                $field_42= $row->BILPRTD;
                $field_43= $row->CAMID;
                $field_44= $row->CAMIDD;
                $field_45= $row->COMAGN;
                $field_46= $row->COMAGND;
                $field_47= $row->BISMT;
                $field_48= $row->XBLNR;
                $field_49= $row->FKART;
                $field_50= $row->FKDAT;
                $field_51= $row->INCO1;
                $field_52= $row->INCO2;
                $field_53= $row->ZTERM;
                $field_54= $row->KURSK;
                $field_55= $row->PRSDT;
                $field_56= $row->FKIMG;
                $field_57= $row->MEINS;
                $field_58= $row->ERDAT1;
                $field_59= $row->LFIMG;
                $field_60= $row->TEXT1;
                $field_61= $row->VTEXT2;
                $field_62= $row->BASEPR;
                $field_63= $row->INSTAL;
                $field_64= $row->COMMIS;
                $field_65= $row->FREIGH;
                $field_66= $row->CGST;
                $field_67= $row->SGST;
                $field_68= $row->IGST;
                $field_69= $row->TGST;
                $field_70= $row->BASEPR1;
                $field_71= $row->INSTAL1;
                $field_72= $row->COMMIS1;
                $field_73= $row->FREIGH1;
                $field_74= $row->CGST1;
                $field_75= $row->SGST1;
                $field_76= $row->IGST1;
                $field_77= $row->TGST1;
                $field_78= $row->TTINV;
                $field_79= $row->PENDQTY;
                
                
                $sql = "INSERT INTO SO_to_inv(MANDT,VBELN,POSNR,DELIVERY,DELIVERYI,BILLD,BILLDI,SERNAM,SERDAT,ERZET,ERDAT,ERNAM,AUART,VKORG,VTWEG,SPART,KUNNR,LIFSK,FAKSK,AUTLF,WERKS,PS_PSP_PNR,MATNR,KWMENG,VRKME,ARKTX,ABGRU,MVGR3,MVGR4,MVGR5,VTEXT,BEZEI,VTEXT1,NAME1,SLDPRT,SHPPRT,SHPPRTD,PAYER,PAYERD,BILPRT,BILPRTD,CAMID,CAMIDD,COMAGN,COMAGND,BISMT,XBLNR,FKART,FKDAT,INCO1,INCO2,ZTERM,KURSK,PRSDT,FKIMG,MEINS,ERDAT1,LFIMG,TEXT1,VTEXT2,BASEPR,INSTAL,COMMIS,FREIGH,CGST,SGST,IGST,TGST,BASEPR1,INSTAL1,COMMIS1,FREIGH1,CGST1,SGST1,IGST1,TGST1,TTINV,PENDQTY) 
                VALUES ('" . $field_1 . "','" . $field_2 . "','" . $field_3 . "','" . $field_4 . "','" . $field_5 . "','" . $field_6 . "','" . $field_7 . "','" . $field_8 . "','" . $field_9 . "','" . $field_10 . "','" . $field_11 . "','" . $field_12 . "','" . $field_13 . "','" . $field_14 . "','" . $field_15 . "','" . $field_16 . "','" . $field_17 . "','" . $field_18 . "','" . $field_19 . "','" . $field_20 . "','" . $field_21 . "','" . $field_22 . "','" . $field_23 . "','" . $field_24 . "','" . $field_25 . "','" . $field_26 . "','" . $field_27 . "','" . $field_28 . "','" . $field_29 . "','" . $field_30 . "'
                ,'" . $field_31 . "','" . $field_33 . "','" . $field_34 . "','" . $field_35 . "','" . $field_36 . "','" . $field_37 . "','" . $field_38 . "','" . $field_39 . "','" . $field_40 . "','" . $field_41 . "','" . $field_42 . "','" . $field_43 . "','" . $field_44 . "','" . $field_45 . "','" . $field_46 . "','" . $field_47 . "','" . $field_48 . "','" . $field_49 . "','" . $field_50 . "','" . $field_51 . "','" . $field_52 . "','" . $field_53 . "','" . $field_54 . "','" . $field_55 . "','" . $field_56 . "','" . $field_57 . "','" . $field_58 . "','" . $field_59 . "','" . $field_60 . "','" . $field_61 . "'
                ,'" . $field_62 . "','" . $field_63 . "','" . $field_64 . "','" . $field_65 . "','" . $field_66 . "','" . $field_67 . "','" . $field_68 . "','" . $field_69 . "','" . $field_70 . "','" . $field_71 . "','" . $field_72 . "','" . $field_73 . "','" . $field_74 . "','" . $field_75 . "','" . $field_76 . "','" . $field_77 . "','" . $field_78 . "','" . $field_79 . "')";
                
                $result = mysqli_query($conn, $sql);
                
                if (! empty($result)) {
                    $affectedRow ++;
                } else {
                    $error_message = mysqli_error($conn) . "\n";die;
                }
            }
            if($affectedRow>0)
            {
                echo $affectedRow." rows inserted";
            }
        echo $output;    
        }
        mysqli_close($conn);
    }         
?>