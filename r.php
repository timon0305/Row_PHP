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

if (!isset($_SESSION['user'])) {
    header('Location:index.php');
}

$title = "Search Result";
include('includes/dashboard/dashboard_header.php');
include('includes/site_config.php');

?>
<body class="container"></body>
<p></p>
<div align="center" class="page-header">
    <div class="jumbotron">
        <div align="center" class="container">
            <h1>Ticket Information</h1>
            <hr/>

            <?php

            if (isset($_POST['submit'])){
            $search = $_POST['search'];

            if ($search != ""){
            list($customerid, $fname, $lname, $phone) = explode(" ", $search);
            $sql_query = "select Customer_fname, customer_tickets.ticket_id, ticket_paid,payment_type,total_balance, total_payment,
                        total_deposit,customers_info.customer_id, ticket_date, Customer_lname, ticket_comment, 
                        Customer_phone,ticket_num,ticket_courtdate,ticket_trialdate,customers_info.customer_id 
                        from customers_info 
                        inner join customer_tickets on customers_info.customer_id=customer_tickets.customer_id 
                        inner join customer_payments on customer_tickets.ticket_id=customer_payments.ticket_id 
                        where customers_info.Customer_fname='$fname' and customers_info.Customer_lname='$lname' and customers_info.Customer_phone='$phone' 
                        order by ticket_date DESC";

            $sql_result = mysqli_query($sql_connect, $sql_query);
            ?>
        </div>

        <p id="custom_id"> Total Number of Records Found:<?php echo mysqli_num_rows($sql_result); ?>
            <input type="hidden" name="id" value="<?php echo $customerid ?>">
        </p>
        <div align="center" class="alert alert-warning" role="alert"><h2>Below are all the tickets
                for: <?php echo strtoupper($fname) . " " . strtoupper($lname); ?> </h2></div>
        <p>
            <a href="dashboard.php">Search Again</a>
        </p>

        <p style="cursor: pointer;">
            <span id="edit" style="margin-right:20px; color: red; font-size: 16px;" data-toggle="modal"
                  data-target="#exampleModal" data-whatever="@mdo">Edit Customer</span>
             <span id="delete" style="margin-left: 20px; color: red; font-size: 16px;">Delete Customer</span>
        </p>

        <?php if (mysqli_num_rows($sql_result) === 0) { ?>

            <span class="btn btn-danger"><a style="color: white;"
                                            href="newticket.php?customer_id=<?php echo $customerid ?>" id="new_ticket">Create a new Ticket</a> </span>
            <span class="btn btn-primary"><a style="color: white;"
                                             href="addcustomer.php">Create a new customer</a> </span>

        <?php } else { ?>
            <span class="btn btn-danger"><a style="color: white;"
                                            href="newticket.php?customer_id=<?php echo $customerid ?>">Create a New Ticket</a></span>
        <?php } ?>

        <?php
        while ($get_row = mysqli_fetch_assoc($sql_result)){
        $ticket_info = $get_row['ticket_num']; ?>
    </div>
    <div class="container">

    </div>
</div>

<?php
list($ticket1, $ticket2, $ticket3, $ticket4, $ticket5, $ticket6) = explode(" ", $ticket_info);
$customer_id = $get_row['customer_id'];
$first_name = $get_row['Customer_fname'];
$last_name = $get_row['Customer_lname'];
$phone_num = $get_row['Customer_phone'];
$court_date = $get_row['ticket_courtdate'];
$trial_date = $get_row['ticket_trialdate'];
$ticket_comment = $get_row['ticket_comment'];
$total_payment = $get_row['total_payment'];
$total_deposit = $get_row['total_deposit'];
$total_balance = $get_row['total_balance'];
$payment_type = $get_row['payment_type'];
$ticket_paid = $get_row['ticket_paid'];
$ticket_id = $get_row['ticket_id'];
$ticket_date = $get_row['ticket_date'];
?>

<div class="row">
<div class="panel panel-primary">
<div class="panel-heading"><h3>Ticket Created on: <font
                color="yellow"><?php echo $ticket_date; ?></font></h3>
    <h3 align="right">

        <?php
        if ($total_balance != "") {
            if ($ticket_paid == 0) {
                echo "Remaining Balance: $" . number_format($total_balance, 2);
            } else {
                ?>
                <div align="center" class="alert alert-danger" role="alert"><h2>This Ticket has already been PAID
                        ! </h2></div>
            <?php }

        } else {
            echo "Remaining Balance: NONE";
        }

        ?>
    </h3>
</div>

<div class="panel-body">
    <div class="col-xs-6 col-sm-4">
        <h4>Court Date: <?php echo date_format(date_create($court_date), "d/m/Y"); ?><br/><br/>
            Trial Date: <?php echo date_format(date_create($trial_date), "d/m/Y"); ?><br/><br/>
            <div class="form-group">
                <label for="exampleInputComment">Comments</label>
                <textarea name="comments" readonly autocomplete="off" class="form-control input-lg"
                          rows="3"><?php echo $ticket_comment ?></textarea>
            </div>
            <?php if ($ticket_paid == 0){ ?>

            <form name="edit" method="POST" action="editticket.php">
                <div class="form-group">
                    <input type="hidden" autocomplete="off" name="customerid" class="form-control input-lg"
                           id="exampleInputCdate" value="<?php echo stripslashes($customer_id); ?>">
                </div>
                <div class="form-group">
                    <input type="hidden" autocomplete="off" name="ticketid" class="form-control input-lg"
                           id="exampleInputCdate" value="<?php echo stripslashes($ticket_id); ?>">
                </div>
                <input type="submit" name="edit" class="btn btn-lg btn-primary" value="Edit Ticket"/>

            </form>
        </h4>
        <?php }
        else {
            echo "";
        } ?>
    </div>
    <div class="col-xs-6 col-sm-4">
        <table class="table table-bordered">
            <td><h4>Ticket 1->&nbsp; <?php echo strtoupper($ticket1); ?> <br/><br/>
                    Ticket 2->&nbsp; <?php echo strtoupper($ticket2); ?><br/><br/>Ticket
                    3->&nbsp; <?php echo strtoupper($ticket3); ?><br/><br/>
                    Ticket 4->&nbsp; <?php echo strtoupper($ticket4); ?><br/><br/> Ticket
                    5->&nbsp; <?php echo strtoupper($ticket5); ?><br/><br/>
                    Ticket 6->&nbsp; <?php echo strtoupper($ticket6); ?></h4></td>
        </table>
    </div>
    <div class="clearfix visible-xs-block"></div>
    <div class="col-xs-6 col-sm-4">
        <div class="well">
            <h3 align="center">
                <?php
                if ($total_payment != "") {
                    ?>
                    Ticket Cost: $<?php echo number_format($total_payment, 2);
                } else {
                    echo "Ticket Cost: NONE";
                }
                ?></h3>
            <h3 align="center"> &nbsp; &nbsp;
                <?php
                if ($total_deposit != "") {
                    ?>
                    Total Paid: $<?php echo number_format($total_deposit, 2);
                } else {
                    echo "  Total Paid: NONE";
                }

                ?>
            </h3>
            <h3 align="center">Paid Method:
                <?php
                switch ($payment_type) {
                    case 0:
                        echo "None";
                        break;
                    case 1:
                        echo "Credit Card";
                        break;
                    case 2:
                        echo "Debit Card";
                        break;
                    case 3:
                        echo "Cash";
                        break;
                }

                ?>
            </h3>
        </div>

        <?php
        if ($ticket_paid == 0) { ?>
            <div class="well">
                <h3 align="center">IS IT PAID? <br/><br/></h3>

                <form method="POST" action="ticket_save.php">

                    <input type="hidden" autocomplete="off" name="customer_get_id" class="form-control input-lg"
                           id="exampleInputCdate" value="<?php echo $customer_id; ?>">
                    <input type="hidden" autocomplete="off" name="ticket_get_id" class="form-control input-lg"
                           id="exampleInputCdate" value="<?php echo $ticket_id; ?>">
                    <input type="submit" autocomplete="off" name="ticket_save" class="btn btn-block btn-lg btn-danger"
                           value="Yes">
                </form>

            </div>
            <?php

        } else {
            echo "";
        }

        ?>
    </div>
</div>
<?php
}
?>
</div>
</div>

<?php
}
            else {
    ?>
    <div align="center" class="alert alert-danger" role="alert"><h4>We couldn't find any customerc!</h4></div>
    <div align="center" role="alert"><a href="dashboard.php"><h4>Go Back And Search Again</h4></a></div>

    <?php
}
            }
            else {
    ?>
    <div align="center" class="alert alert-danger" role="alert"><h4>You can't search the customer without enter the
            search query !</h4></div>
    <div align="center" role="alert"><a href="dashboard.php"><h4>Go Back And Search Again</h4></a></div>

    <?php
}
                ?>
</div>
</div>
</div>
<!-- Site footer -->
<!-- Include all compiled plugins (below), or include individual files as needed -->

<!--        <script src="js/bootstrap.min.js"></script>-->
<?php include('includes/site_footer.php');

?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="includes/edit.php" role="form">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">Edit Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="customer_id" value="<?php echo $customerid ?>">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Last Name:</label>
                        <input type="text" name="lname" id="lname" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">First Name:</label>
                        <input type="text" class="form-control" name="fname" id="fname" value="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Phone Number:</label>
                        <input type="text" maxlength="12" id="phone" name="phone" class="form-control" value="">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#edit').click(function () {
        let custom_id = $('#custom_id>input').val();
        $.ajax({
            method: 'GET',
            data: {
                custom_id: custom_id,
            },
            url: 'includes/ajax.php',
            success: function (result) {
                let results = JSON.parse(result);
                console.log(results);
                let fname = results.customer_fname;
                let lname = results.customer_lname;
                let phone = results.customer_phone;
                $('#fname').val(fname);
                $('#lname').val(lname);
                $('#phone').val(phone);
            }
        })
    })
</script>
<script>
    $('#delete').click(function () {
        let custom_id = $('#custom_id>input').val();
        if (confirm("Do you really delete?")) {
            $.ajax({
                method: 'POST',
                data: {
                    customer_id: custom_id,
                },
                url: 'includes/delete.php',
                success: function (result) {

                }
            })
        }
    })
</script>

