<?php

include('site_config.php');
$term=$_GET["custom_id"];
$query=mysqli_query($sql_connect,"select customer_fname,customer_lname, customer_phone from customers_info where $term = customer_id ");
$json=array();

while($searchr=mysqli_fetch_assoc($query))
{
    $data = $searchr;
}
echo json_encode($data);
?>
