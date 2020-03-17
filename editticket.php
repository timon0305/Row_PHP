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
$title="Edit Ticket ";

include('includes/dashboard/dashboard_header.php');
include 'includes/site_config.php';

?>
<p></p>
<?php 
  if(isset($_POST['edit'])){
    $customer_id=$_POST['customerid'];
    $ticket_id=$_POST['ticketid'];

    $sql="select Customer_fname, customer_tickets.ticket_id, ticket_paid,payment_type,total_balance, total_payment,
            total_deposit,customers_info.customer_id, ticket_date, Customer_lname, ticket_comment, 
            Customer_phone,ticket_num,ticket_courtdate,ticket_trialdate,customers_info.customer_id 
            from customers_info 
            inner join customer_tickets on customers_info.customer_id=customer_tickets.customer_id 
            inner join customer_payments on customer_tickets.ticket_id=customer_payments.ticket_id 
            where customers_info.customer_id='$customer_id' and customer_tickets.ticket_id='$ticket_id'";
  
    $sql_result=mysqli_query($sql_connect,$sql);
    $sql_f_result=mysqli_fetch_assoc($sql_result);
    ?>
    <?php
          list($ticket1,$ticket2,$ticket3,$ticket4,$ticket5,$ticket6)=explode(" ",$sql_f_result['ticket_num']);
          $first_name=$sql_f_result['Customer_fname'];
          $last_name=$sql_f_result['Customer_lname'];
          $phone_num=$sql_f_result['Customer_phone'];
          $court_date=$sql_f_result['ticket_courtdate'];
          $trial_date=$sql_f_result['ticket_trialdate'];
          $ticket_comment=$sql_f_result['ticket_comment'];
          $total_payment=$sql_f_result['total_payment'];
          $total_deposit=$sql_f_result['total_deposit'];
          $total_balance=$sql_f_result['total_balance'];
          $payment_type=$sql_f_result['payment_type'];
          $ticket_date= new datetime();
        ?>

    <div class="page-header">
        <div class="jumbotron">
            <div align="center" class="container">
                <h1>Edit a Ticket</h1>
                <hr />
                <h2> Edit a ticket information for : <font color="red"><?php echo $first_name. " ". $last_name;?></font></h2>
                <hr />
                <p>
                    <strong>Ticket created on:</strong> <?php echo date_format($ticket_date,'l, d M, Y  h:i A'); ?>
                </p>
            </div>
        </div>
        <div class="well well-lg">
            <form id="ticketinfo" role="form" method="POST" action="editsuccess.php">
                <div class="form-group input">
                    <label for="exampleInputticket">Ticket Number(s)</label>
                    <div class="row">
                        <div class="col-xs-8 col-md-2">
                            <input type="text" maxlength="10"  autocomplete="off" name="tn1" class="form-control input-lg"  placeholder="Ticket 1" value="<?php echo $ticket1;?>" required>
                        </div>
                        <div class="col-xs-8 col-md-2">
                            <input type="text" maxlength="10"  autocomplete="off" name="tn2" class="form-control input-lg"  placeholder="Ticket 2" value="<?php echo $ticket2;?>">
                        </div>
                        <div class="col-xs-8 col-md-2">
                            <input type="text" maxlength="10"  autocomplete="off" name="tn3" class="form-control input-lg"  placeholder="Ticket 3" value="<?php echo $ticket3;?>">
                        </div>
                         <div class="col-xs-8 col-md-2">
                             <input type="text" maxlength="10"  autocomplete="off" name="tn4" class="form-control input-lg"  placeholder="Ticket 4" value="<?php echo $ticket4;?>">
                        </div>
                         <div class="col-xs-8 col-md-2">
                             <input type="text" maxlength="10"  autocomplete="off" name="tn5" class="form-control input-lg"  placeholder="Ticket 5" value="<?php echo $ticket5;?>">
                        </div>
                         <div class="col-xs-8 col-md-2">
                             <input type="text" maxlength="10"  autocomplete="off" name="tn6" class="form-control input-lg"  placeholder="Ticket 6" value="<?php echo $ticket6;?>">
                        </div>
                    </div>
                </div>
               <div class="form-group">
                    <label for="exampleInputCDate">Court Date</label>
                        <input type="date" autocomplete="off" name="cdate" class="form-control input-lg" id="exampleInputCdate" placeholder="Enter Court Date" value="<?php echo $court_date;?>" required>
                  </div>
                   <div class="form-group">
                        <label for="exampleInputTDate">Trial Date</label>
                        <input type="date" autocomplete="off" name="tdate" class="form-control input-lg" id="exampleInputTdate" placeholder="Enter Trial Date" value="<?php echo $trial_date;?>" >
                  </div>
                  <div class="form-group">
                        <label for="exampleInputTDate">Total Amount ($)</label>
                        <input type="text" autocomplete="off" id="tamount" name="tamount" class="form-control input-lg" placeholder="00.00" value="<?php echo $total_payment;?>">
                  </div>

                <div class="form-group">
                    <label for="exampleInputTDate">Paid Amount ($)</label>
                    <input type="text" autocomplete="off" id="pamount" name="pamount" class="form-control input-lg" placeholder="00.00" value="<?php echo $total_deposit;?>">
                 </div>

                <div class="form-group">
                    <label for="exampleInputTDate">Remaining Balance ($)</label>
                    <input type="text" readonly autocomplete="off" id="ramount" name="ramount" class="form-control input-lg" placeholder="00.00" onclick="fnCalculate()"/ value="<?php echo $total_balance;?>">
                  </div>

                <div class="form-group">
                    <label for="exampleInputTDate">Payment Method</label>
                    <select name="pmethod" class="form-control input-lg">
                          <option value="0" <?php if($payment_type==0){echo "selected";} ?>>None</option>
                          <option value="1" <?php if($payment_type==1){echo "selected";} ?>>Credit Card</option>
                          <option value="2" <?php if($payment_type==2){echo "selected";} ?>>Debit Card</option>
                          <option value="3" <?php if($payment_type==3){echo "selected";} ?>>Cash</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputComment">Comment</label>
                    <textarea name="comments" autocomplete="off" class="form-control input-lg" rows="5" ><?php echo $ticket_comment;?></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" hidden autocomplete="off" name="cid" class="form-control input-lg" id="exampleInputCdate" value="<?php echo $customer_id; ?>">
                </div>
                <div class="form-group">
                    <input type="hidden" hidden autocomplete="off" name="tickid" class="form-control input-lg" id="exampleInputCdate" value="<?php echo $ticket_id; ?>">
                </div>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg btn-block">
            </form>
            <?php

            }
            else{
                header('Location:dashboard.php');
                }
            ?>
        </div>
    </div>
  
      <!-- Site footer -->
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="js/jquery.formatter.js"></script>
    <script src="js/accounting.js"></script>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/dynamicfields.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php include('includes/site_footer.php');

    ?>