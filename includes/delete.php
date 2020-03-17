<?php
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 1/31/2020
 * Time: 4:37 AM
 */

include('site_config.php');

$custom_id = $_POST["customer_id"];

if ($sql_connect->connect_error) {
    die("Connection failed: " . $sql_connect->connect_error);
}

$sql = "DELETE FROM customers_info WHERE customer_id= '$custom_id'";
$sql_ticket = "DELETE FROM customer_tickets WHERE customer_id= '$custom_id'";
$sql_payment = "DELETE FROM customer_payments WHERE customer_id= '$custom_id'";

if ($sql_connect->query($sql) === TRUE && $sql_connect->query($sql_ticket) === TRUE && $sql_connect->query($sql_payment) === TRUE) {
    $msg = "Record deleted successfully";
    header('Location:/aaron/dashboard.php?msg='.$msg);
} else {
    echo "Error deleting record: " . $sql_connect->error;
}

$sql_connect->close();