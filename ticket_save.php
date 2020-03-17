<?php 

session_start();

  if(!isset($_SESSION['user'])){
    header('Location:index.php');
  }

    $title="Ticket Paid";
    include('includes/dashboard/dashboard_header.php');
    include('includes/site_config.php');

?>

<p></p>
    <div align="center" class="page-header">
    <div class="jumbotron">
    <div align="center" class="container">
   <h1>Ticket Information</h1>
    <hr />
			<?php

             $ticket_save_get=$_POST['ticket_save'];
             $ticket_id_get=$_POST['ticket_get_id'];
             $customer_id_get=$_POST['customer_get_id'];

             $sql_get_ticketid="select ticket_id from customer_tickets where customer_id='$customer_id_get' and ticket_id='$ticket_id_get'";
             $sql_get_paid= mysqli_query($sql_connect,$sql_get_ticketid);
             $sql_get_ticketrows=mysqli_num_rows($sql_get_paid);



		if($sql_get_ticketrows!=0){
                if($ticket_save_get=="Yes"){
               $sql="update customer_payments set ticket_paid='1' where customer_id='$customer_id_get' and ticket_id='$ticket_id_get'";
               $sql_paid= mysqli_query($sql_connect,$sql);
                   if(!$sql_paid){?>
                   <div align="center" class="alert alert-danger" role="alert"><h4>Sorry, Ticket has not been paid successfully !</h4></div>
                 <?php }
                 else?>
                 <br />
                   <div align="center" class="alert alert-success" role="alert"><h2>Success, Ticket has been paid !</h2></div>
	<br />
	<hr />
	<p>Want to search another customer ?</p>
	<a class="btn btn-primary btn-lg" href="dashboard.php"> Click to search another customer</a>
                 <?php }

}
else{ ?>
  
   <div align="center" class="alert alert-danger" role="alert"><h4>Sorry, We can't save the ticket payment !</h4></div>

<?php 
}
?>   
</div>
</div>
</div>   
<script src="js/bootstrap.min.js"></script>
    <?php include('includes/site_footer.php');

    ?>
