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

session_start();

if(!isset($_SESSION['user'])){
  header('Location:index.php');
}
$title="Today's Tickets ";

include('includes/dashboard/dashboard_header.php');
?>
<p></p>
   <div class="page-header">

 <div class="jumbotron">
      <div align="center" class="container">
        <h1>Today's Tickets</h1>
 <?php
  include('includes/site_config.php');
	$today= date('y-m-d');

    $sql_query="select customer_fname, ticket_date, customer_lname, ticket_entered_date, ticket_comment, customer_phone,ticket_num,ticket_courtdate,ticket_trialdate,customers_info.customer_id from customers_info inner join customer_tickets on customers_info.customer_id=customer_tickets.customer_id where ticket_entered_date='$today'";
    $sql_result=mysqli_query($sql_connect,$sql_query);
    $ticket_count=mysqli_num_rows($sql_result);?>
        <p>Total Number of Tickets: <?php echo $ticket_count; ?></p>
        </div>

<?php
while($get_row=mysqli_fetch_assoc($sql_result)){
    $ticket_info= $get_row['ticket_num'];
?>
</div>
</div>
	
   <?php
    list($ticket1,$ticket2,$ticket3,$ticket4,$ticket5,$ticket6)=explode(" ",$ticket_info);
    
    $first_name=$get_row['customer_fname'];
    $customer_id=$get_row['customer_id'];
    $last_name=$get_row['customer_lname'];
    $phone_num=$get_row['customer_phone'];
    $court_date=$get_row['ticket_courtdate'];
    $trial_date=$get_row['ticket_trialdate'];
    $ticket_comment=$get_row['ticket_comment'];
    $ticket_date=$get_row['ticket_date'];
  ?>



        <div class="row">

	<div class="panel panel-primary">
		  <div class="panel-heading"><h3><?php echo $first_name;?> <?php echo $last_name;?></h3></div>
 <div class="panel-body">
  <div class="col-xs-6 col-sm-4"><h4>Phone #: <?php echo $phone_num;?><br /><br />Court Date: <?php echo date_format(date_create($court_date),"d/m/Y");?><br /><br />
 Trial Date: <?php echo date_format(date_create($trial_date),"d/m/Y");?><br /><br />
 <div class="form-group">
    <label for="exampleInputComment">Comments</label>
 <textarea name="comments" readonly autocomplete="off" class="form-control input-lg" rows="3"><?php echo $ticket_comment ?></textarea>
  </div>
</h4></div>
  <div class="col-xs-6 col-sm-4"><h4>Ticket 1: <?php echo $ticket1;?> <br /><br />
 Ticket 2: <?php echo $ticket2;?><br /><br />Ticket 3: <?php echo $ticket3;?><br /><br />
 Ticket 4: <?php echo $ticket4;?><br /><br /> Ticket 5: <?php echo $ticket5;?><br /><br />
 Ticket 6: <?php echo $ticket6;?></h4></div>
  <div class="clearfix visible-xs-block"></div>
  <div class="col-xs-6 col-sm-4"><h3><br /><br /><br />
</h3></div>
</div>
<?php
}
?>
</div>
</div>



      <!-- Site footer -->
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
   

    <script src="js/bootstrap.min.js"></script>
<script src="js/dynamicfields.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
<?php include('includes/site_footer.php');

?>