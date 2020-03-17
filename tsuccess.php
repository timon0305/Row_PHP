<?php
session_start();

if(!isset($_SESSION['user'])){
  header('Location:index.php');
}
$title="Create a New Ticket ";

include('includes/dashboard/dashboard_header.php');
?>
<p></p>
<div class="page-header">
    <div class="jumbotron">
      <div align="center" class="container">
        <h1>Ticket Submission</h1>
        <hr />
      </div>
    </div>
    <div class="well well-lg">
        <?php
        if($_POST['submit']){
        $ticket1=$_POST['tn1'];
        $ticket2=$_POST['tn2'];
        $ticket3=$_POST['tn3'];
        $ticket4=$_POST['tn4'];
        $ticket5=$_POST['tn5'];
        $ticket6=$_POST['tn6'];

        $addtickets=$ticket1." ".$ticket2." ".$ticket3." ".$ticket4." ".$ticket5." ".$ticket6;

		$courtdate=$_POST['cdate'];
		$trialdate=$_POST['tdate'];
		$comments=$_POST['comments'];
		$customer_id=$_POST['cid'];
		$customer_payment=$_POST['tamount'];
		$customer_deposit=$_POST['pamount'];
		$customer_balance=$_POST['ramount'];
		$payment_method=$_POST['pmethod'];

		$today=date('Y-m-d H:i:s');
		$ticket_e_date=date('Y-m-d');
		$ticket_id=md5(microtime());

		include 'includes/site_config.php';
		$sql="insert into customer_tickets values ('$customer_id','$ticket_id','$addtickets','$courtdate','$trialdate','$comments','$today','$ticket_e_date')";
		$sql_payments="insert into customer_payments values ('','$customer_id','$ticket_id','$payment_method','$customer_payment','$customer_deposit','$customer_balance','0')";
        $sql_final= mysqli_query($sql_connect,$sql);
        $sql_final_payment= mysqli_query($sql_connect,$sql_payments);

        if((!$sql_final)||(!$sql_final_payment)){?>
            <div align="center" class="alert alert-danger" role="alert"><h4>Sorry, We are not able to record the ticket information at this time !</h4></div>
                <a href="customer.php">Please Try Again ! </a>
	    <?php }
	    else{ ?>
            <div align="center" class="alert alert-warning" role="alert"><h4>New Ticket information has been added !</h4> <br />
                <a href="dashboard.php">Go To Dashboard </a>
            </div>
        <?php  }
        } else{
	        header('Location:dashboard.php');
        }
        ?>
    </div>
</div>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/jquery.formatter.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/dynamicfields.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<?php include('includes/site_footer.php');

?>