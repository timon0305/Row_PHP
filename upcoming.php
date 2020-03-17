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
$title="Upcoming Court Dates ";

include('includes/dashboard/dashboard_header.php');
?>
<p></p>
   <div class="page-header">

 <div class="jumbotron">
      <div align="center" class="container">
        <h1>Weekly Court Dates</h1>
                <p>List of upcoming court dates within 7 days</p>
 <?php
  include('includes/site_config.php');
	$today=date('Y-m-d');

    $sql_query="select customer_fname, ticket_date, customer_lname, ticket_comment, customer_phone,ticket_num,ticket_courtdate,ticket_trialdate,customers_info.customer_id from customers_info inner join customer_tickets on customers_info.customer_id=customer_tickets.customer_id where ticket_courtdate between '$today' and DATE_ADD('$today',INTERVAL 7 DAY)";
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
<div class="table-responsive">
<table class="table table-bordered">
<tr class="info">
    <th><h4>Full Name</h4></th>
    <th><h4>Phone Number</h4></th>
    <th><h4>Ticket Numbers(s)</h4></th>
    <th><h4>Court Date</h4></th>
</tr>
  <td class="col-md-3">
   <strong><?php echo strtoupper($first_name);?> <?php echo strtoupper($last_name);?></strong>
  </td>
  <td class="col-md-3">
    <strong><?php echo $phone_num;?></strong>
  </td>
 <td class="col-md-3">
    <strong>Ticket 1 ->&nbsp;&nbsp;&nbsp;</strong><?php echo strtoupper($ticket1);?><br />
    <strong>Ticket 2 ->&nbsp;&nbsp;&nbsp;</strong><?php echo strtoupper($ticket2);?><br />
    <strong>Ticket 3 ->&nbsp;&nbsp;&nbsp;</strong><?php echo strtoupper($ticket3);?><br />
    <strong>Ticket 4 ->&nbsp;&nbsp;&nbsp;</strong><?php echo strtoupper($ticket4);?><br />
    <strong>Ticket 5 ->&nbsp;&nbsp;&nbsp;</strong><?php echo strtoupper($ticket5);?><br />
    <strong>Ticket 6 ->&nbsp;&nbsp;&nbsp;</strong><?php echo strtoupper($ticket6);?><br />
  </td>
  <td class="col-md-3">
  <strong><?php echo date_format(date_create($court_date),"F d, Y");?></strong>
  </td>

<?php
}
?>
</table>
</div>
      <!-- Site footer -->
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
   

    <script src="js/bootstrap.min.js"></script>
<script src="js/dynamicfields.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
<?php include('includes/site_footer.php');

?>