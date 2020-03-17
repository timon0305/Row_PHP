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

//if(!isset($_SESSION['user'])){
//    header('Location:index.php');
//}
$title="Create Ticket ";

include('includes/dashboard/dashboard_header.php');
include 'includes/site_config.php';

?>
    <p></p>
<?php

$ticket1 = $ticket2 = $ticket3 = $ticket4 =$ticket5 = $ticket6= "";
$court_date = $trial_date =  $ticket_comment =  $ticket_date= $ticket_id="";
$payment_type = $total_balance = $total_deposit = $total_payment = "";

$sql="select customer_fname, customer_id, customer_lname, customer_phone from customers_info ";
$sql_result=mysqli_query($sql_connect,$sql);
$sql_f_result=mysqli_fetch_assoc($sql_result);

$first_name=$sql_f_result['customer_fname'];
$last_name=$sql_f_result['customer_lname'];
$ticket_date = new DateTime();

if(isset($_SESSION['user'])){
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if( isset($_POST["tn1"]) && isset($_POST['cdate']) && isset($_POST['tdate']) && isset($_POST['comments']) &&isset($_POST['cid'])) {
        $ticket1=$_POST['tn1'];
        $ticket2=$_POST['tn2'];
        $ticket3=$_POST['tn3'];
        $ticket4=$_POST['tn4'];
        $ticket5=$_POST['tn5'];
        $ticket6=$_POST['tn6'];

        $addtickets=$ticket1." ".$ticket2." ".$ticket3." ".$ticket4." ".$ticket5." ".$ticket6;

        $comments=$_POST['comments'];
        $customer_id=$_POST['cid'];
        $customer_payment=$_POST['tamount'];
        $customer_deposit=$_POST['pamount'];
        $customer_balance=$_POST['ramount'];
        $payment_method=$_POST['pmethod'];
        $court_date = $_POST['cdate'];
        $trial_date = $_POST['tdate'];
        $ticket_comment = $_POST['comments'];
        $ticket_enter = $ticket_date->format('Y-m-d H:i:s') ;
        $ticket_entered_date = $ticket_date->format('Y-m-d H:i:s') ;
        $customer_id = $_POST['cid'];
        $ticket_id=md5(microtime());

        $sql_get = "select * from customer_tickets where customer_id = '$customer_id'";

        if ($sql_connect->query($sql_get) == true )
        {
            $result = $sql_connect->query($sql_get);
            $get_row = mysqli_fetch_assoc($result);
            $ticket_info = $get_row['ticket_num'];
            if ($ticket_info == $addtickets)
            {
                return false;
            }
            else
            {
                if ($sql_connect->connect_error) {
                    die("Connection failed: " . $sql_connect->connect_error);
                }

                $sql = "insert into customer_tickets values ('$customer_id','$ticket_id','$addtickets','$court_date','$trial_date','$ticket_comment','$ticket_enter','$ticket_entered_date')";

                $sql_payments="insert into customer_payments values ('','$customer_id','$ticket_id','$payment_method','$customer_payment','$customer_deposit','$customer_balance','0')";
                $sql_final= mysqli_query($sql_connect,$sql);
                $sql_final_payment= mysqli_query($sql_connect,$sql_payments);

                if ($sql_final === TRUE && $sql_final_payment === TRUE) {
                    // echo "New record created successfully";
                    $split = [$customer_id ,$sql_f_result['Customer_fname'], $sql_f_result['Customer_lname']];
                }

                $sql_connect->close();
                echo $msg = "New ticket Created";
                header('Location:/aaron/dashboard.php?msg='.$msg);
            }
        }


    }

    if (isset($_POST['search'])){
        $name = $_POST['search'];
        $split = explode(" ",  $name);
        $customer_id = $split[0];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET")
{
    $customer_id = $_GET['customer_id'];
    $sql="select * from customers_info where customer_id = '$customer_id'";
    $sql_result=mysqli_query($sql_connect,$sql);
    $sql_f_result=mysqli_fetch_assoc($sql_result);
    $split = [$customer_id ,$sql_f_result['Customer_fname'], $sql_f_result['Customer_lname']];
}
?>

    <div class="page-header">

        <div class="jumbotron">
            <div align="center" class="container">
                <h1>Create a Ticket</h1>
                <hr />
                <h2> Edit a ticket information for : <font color="red"><?php echo $split[1]. " ". $split[2];?></font></h2>
                <hr />
                <p><strong>Ticket created on:</strong> <?php echo date_format($ticket_date,'l, d M, Y  h:i A'); ?></p>
            </div>
        </div>
        <div class="well well-lg">
            <form id="ticketinfo" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group input">
                    <label for="exampleInputticket">Ticket Number(s)</label>
                    <div class="row">
                        <div class="col-xs-8 col-md-2">    <input type="text" maxlength="10"  autocomplete="off" name="tn1" class="form-control input-lg"  placeholder="Ticket 1" value="<?php echo $ticket1;?>" required>
                        </div>
                        <div class="col-xs-8 col-md-2">    <input type="text" maxlength="10"  autocomplete="off" name="tn2" class="form-control input-lg"  placeholder="Ticket 2" value="<?php echo $ticket2;?>">
                        </div>
                        <div class="col-xs-8 col-md-2">    <input type="text" maxlength="10"  autocomplete="off" name="tn3" class="form-control input-lg"  placeholder="Ticket 3" value="<?php echo $ticket3;?>">
                        </div>
                        <div class="col-xs-8 col-md-2">     <input type="text" maxlength="10"  autocomplete="off" name="tn4" class="form-control input-lg"  placeholder="Ticket 4" value="<?php echo $ticket4;?>">
                        </div>
                        <div class="col-xs-8 col-md-2">     <input type="text" maxlength="10"  autocomplete="off" name="tn5" class="form-control input-lg"  placeholder="Ticket 5" value="<?php echo $ticket5;?>">
                        </div>
                        <div class="col-xs-8 col-md-2">     <input type="text" maxlength="10"  autocomplete="off" name="tn6" class="form-control input-lg"  placeholder="Ticket 6" value="<?php echo $ticket6;?>">
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
                    <textarea name="comments" autocomplete="off" class="form-control input-lg" rows="5" ></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" hidden autocomplete="off" name="cid" class="form-control input-lg"  value="<?php echo $customer_id; ?>">
                </div>
                <div class="form-group">
                    <input type="hidden" hidden autocomplete="off" name="tickid" class="form-control input-lg" value="<?php echo $ticket_id; ?>">
                </div>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg btn-block">
            </form>
            <?php
            }
            ?>
        </div>
    </div>

    <!-- Site footer -->
    <script src="js/jquery-3.4.1.min.js"></script>
<!--    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>-->
    <script src="js/jquery.formatter.js"></script>
    <script src="js/accounting.js"></script>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/dynamicfields.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php include('includes/site_footer.php');

    ?>