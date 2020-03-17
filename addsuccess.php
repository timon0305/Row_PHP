<?php
session_start();

if(!isset($_SESSION['user'])){
  header('Location:index.php');
}
$title="Create a New Customer ";

include('includes/dashboard/dashboard_header.php');
?>
<p></p>
   <div class="page-header">
     <div class="jumbotron">
          <div align="center" class="container">
              <h1>Create a New Customer</h1>
                <hr />
          </div>
     </div>
     <div class="well well-lg">

     <?php
        if($_POST['submit']){

            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
	        $phone=$_POST['phone'];

            include('includes/site_config.php');

            if ($sql_connect->connect_error) {
                die("Connection failed: " . $sql_connect->connect_error);
            }

            $sql_get = "SELECT * FROM customers_info where Customer_phone = '$phone'";

            $result = [];

            if ($sql_connect->query($sql_get) == true ) {
                $result = $sql_connect->query($sql_get);

            } else {
                echo "Error updating record: " . $sql_connect->error . "<br/>";
            }

            if ( $result->num_rows > 0 ) {?>

                <div align="center" class="alert alert-warning" role="alert"><h3>Sorry this customer exists</h3> <br />
                </div>
                <hr />
                <div align="center"><a class="btn btn-primary btn-lg btn-block" href="dashboard.php">Please search the customer and create a ticket</a></div>

            <?php } else {


            $sql="insert into customers_info values (null,'$fname','$lname','$phone')";
            $sql_final= mysqli_query($sql_connect,$sql);

	        if(!$sql_final){?>
      	        <div align="center" class="alert alert-danger" role="alert">
                    <h4>Sorry, We are not able to add a new customer.</h4>
                </div>
                 <a href="addcustomer.php">Please Try Again ! </a>
            <?php }
            else{ ?>
                <div align="center" class="alert alert-warning" role="alert"><h3>Success, New Customer information has been added !</h3> <br />
		      	</div>
                <hr />
                <div align="center"><a class="btn btn-primary btn-lg btn-block" href="searchcustomer.php">Click Here to Enter the New Ticket Information</a></div>
	        <?php  }
        }}
        else{
            header('Location:dashboard.php');
        }
        ?>
    </div>
   </div>
  
      <!-- Site footer -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/jquery.formatter.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/dynamicfields.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php include('includes/site_footer.php');

    ?>