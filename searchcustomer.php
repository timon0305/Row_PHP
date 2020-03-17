<?php
session_start();

if(!isset($_SESSION['user'])){
  header('Location:index.php');
}
$title="Search Customer";
include('includes/dashboard/dashboard_header.php');
?>

<p></p>
<div align="center" class="page-header">

    <div class="jumbotron">
      <div align="center" class="container">
        <h1>Search Customer</h1>
        <hr />
          <h2>Step 1</h2>
        <hr />
      <div align="center" class="container">
          <form class="form-horizontal" method="POST" action="newticket.php" role="form">
        <div class="form-group form-group-lg">
            <div class="col-sm-12">
                <input type="text" id="name" class="form-control" name="search" placeholder="Enter Customer First Name, Last Name, Phone" required />
                <input type="hidden" id="customer_id" name = "customer_id" value="">
            </div>
         <div class="col-sm-12">
            <br />
         </div>
            <div class="col-sm-12">

                <input type="submit" name="submit" value="Next Step >>" class="btn btn-danger btn-lg btn-block">
            </div>
        </div>

    </form>
      </div>
      </div>
    </div>  </div>
      <!-- Site footer -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="js/jquery-3.4.1.min.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->

    <!-- jQuery UI library -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="js/jquery-ui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!--    <script src="js/bootstrap.min.js"></script>-->
<!--   <script src="js/typeahead.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script>
        $('#name').typeahead({
            source:  function (query, process) {
                return $.get('includes/search.php', { term: query }, function (data) {
                    console.log(data);
                    data = $.parseJSON(data);

                    return process(data);
                });
            }
        });
    </script>

<?php include('includes/site_footer.php');

?>