<?php
/*
#######################################################
Product Name : TTMS
Product Version: 1.0
Developer: Saransh Kalia
Web: www.99degreesnorth.com
Email: conteact@99degreesnorth.com
#######################################################
*/
include('site_config.php');
 $term=$_GET["term"];
 $query=mysqli_query($sql_connect,"select customer_fname,customer_lname, customer_phone,customer_id from customers_info where customer_fname like '%".$term."%' or customer_lname like '%".$term."%' or customer_phone like '%".$term."%' order by customer_fname ");
 $json=array();
 
    while($searchr=mysqli_fetch_assoc($query)){
//         $json[]=array(
//        'value'=> $searchr["customer_id"]." ".$searchr["customer_fname"]." ".$searchr["customer_lname"]." ".$searchr["customer_phone"],
//        'label'=> $searchr["customer_fname"]." ".$searchr["customer_lname"]."  | Phone: ".$searchr["customer_phone"],
//
//         );
        $data[] = $searchr["customer_id"]." ".$searchr["customer_fname"]." ".$searchr["customer_lname"]." ".$searchr["customer_phone"]  ;
    }
 
 echo json_encode($data);

// print $searchr["customers_info.customer_id"];
 
?>
