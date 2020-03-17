<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location:index.php');
}
$title = "Add or Choose Existing Customer";

include('includes/dashboard/dashboard_header.php');
?>
    <p></p>
    <div class="page-header">

        <div class="jumbotron">
            <div align="center" class="container">
                <h1>Adding New Ticket</h1>
                <hr/>
                <h2></h2>
            </div>
        </div>
        <div align="center" class="well well-lg">
            <h2>Is it a new customer or for existing customer ?</h2>
            <p><br/></p>
            <a class="btn btn-lg btn-danger" href="searchcustomer.php"><font color="white">Existing Customer</font></a>&nbsp;
            &nbsp;
            <a class="btn btn-lg btn-danger" href="addcustomer.php"><font color="white">New Customer </font></a>
            <p><br/></p>
            <p><br/></p>
        </div>
    </div>
    <!-- Site footer -->
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="js/jquery.formatter.js"></script>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/dynamicfields.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
<?php include('includes/site_footer.php');

?>