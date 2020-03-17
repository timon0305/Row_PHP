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
$title="Dashboard";
include('includes/dashboard/dashboard_header.php');
?>

<p></p>
   <div align="center" class="page-header">
     <div class="jumbotron">
          <div align="center" class="container">
            <h1>Search Traffic Tickets</h1>
            <hr />
            <h2>Enter Your Search Query Below</h2>
            <hr />
            <div class="well well-lg">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div align="center" class="container">
                            <form class="form-horizontal" method="POST"  action="r.php" role="form">
                                <div class="form-group form-group-lg">
                                    <div class="col-sm-11">
                                        <input type="text" id="total_name" class="form-control" name="search" placeholder="Search by First Name, Last Name, Phone" required />

                                    </div>
                                    <input type="submit" name="submit" value="GO" class="btn btn-primary btn-lg">

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <span class="btn btn-danger"><a  style="color: white;"  href="addcustomer.php">Create a New Customer</a></span>
          </div>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
    <!--<script src="js/bootstrap.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script>
        $(function() {
            $('#total_name').typeahead({
                source:  function (query, process) {
                    return $.get('includes/search.php', { term: query }, function (data) {
                    console.log(data);
                    data = $.parseJSON(data);
                    return process(data);
                });
            }
        });
    });
    </script>
    <script>
        let msg = location.href.split("=",-1)[1];
        alert(msg.replace(/%20/g, ' '))
    </script>
<?php include('includes/site_footer.php');

?>