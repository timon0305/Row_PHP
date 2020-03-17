<?php
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 1/31/2020
 * Time: 3:49 AM
 */


include('includes/site_config.php');

    $customer_id=$_POST['cid'];
    $ticket1=$_POST['tn1'];
    $ticket2=$_POST['tn2'];
    $ticket3=$_POST['tn3'];
    $ticket4=$_POST['tn4'];
    $ticket5=$_POST['tn5'];
    $ticket6=$_POST['tn6'];

    $addtickets=$ticket1." ".$ticket2." ".$ticket3." ".$ticket4." ".$ticket5." ".$ticket6;

    $court_date=$_POST['cdate'];
    $trial_date=$_POST['tdate'];
    $comments=$_POST['comments'];
    $customer_payment=$_POST['tamount'];
    $customer_deposit=$_POST['pamount'];
    $customer_balance=$_POST['ramount'];
    $payment_method=$_POST['pmethod'];

    $today=date('Y-m-d H:i:s');
    $ticket_id=$_POST['tickid'];


    if ($sql_connect->connect_error) {
        die("Connection failed: " . $sql_connect->connect_error);
    }

    $sql = "UPDATE customer_tickets SET  ticket_num ='$addtickets', ticket_courtdate ='$court_date', ticket_comment = '$comments',
         ticket_trialdate = '$trial_date', ticket_date = '$today'  WHERE customer_id= '$customer_id' and  ticket_id = '$ticket_id'";

    $sql_payment = "UPDATE customer_payments SET  payment_type ='$payment_method', total_payment ='$customer_payment',
         total_deposit = '$customer_deposit' , total_balance = '$customer_balance' WHERE customer_id= '$customer_id' and ticket_id = '$ticket_id'";

    if ($sql_connect->query($sql) === TRUE && $sql_connect->query($sql_payment) === TRUE) {
        echo $message = 'Ticket saved successfully';
        header('Location:/aaron/dashboard.php?msg='.$message);
    } else {
        echo "Error updating record: " . $sql_connect->error . "<br/>";
    }

    $sql_connect->close();