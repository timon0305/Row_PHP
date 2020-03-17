<?php
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 1/31/2020
 * Time: 3:49 AM
 */


include('site_config.php');
$lname=$_POST["lname"];
$fname=$_POST["fname"];
$phone=$_POST["phone"];
$custom_id = $_POST["customer_id"];

if ($sql_connect->connect_error) {
    die("Connection failed: " . $sql_connect->connect_error);
}

$sql = "UPDATE customers_info SET Customer_fname='$fname', Customer_lname ='$lname', Customer_phone ='$phone'  WHERE customer_id= '$custom_id'";

if ($sql_connect->query($sql) === TRUE) {
    $msg = "Record updated successfully";
    header('Location:/aaron/dashboard.php?msg='.$msg);

} else {
    echo "Error updating record: " . $sql_connect->error;
}

$sql_connect->close();