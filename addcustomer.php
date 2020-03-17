<?php
session_start();

if(!isset($_SESSION['user'])){
  header('Location:index.php');
}
$title="Add a New Customer";

include('includes/dashboard/dashboard_header.php');
?>
<p></p>
   <div class="page-header">
       <div class="jumbotron">
            <div align="center" class="container">
                 <h1>Create a New Customer</h1>
                <hr />
            <h2> Enter the customer information below</h2>
            </div>
        </div>
        <div class="well well-lg">
            <form id="ticketinfo" role="form" method="POST" action="addsuccess.php">
                <div class="form-group">
                    <label for="exampleInputLName">Last Name</label>
                    <input type="text" autocomplete="off" name="lname" class="form-control input-lg" id="exampleInputLName" placeholder="Enter Last Name" required>
                </div>
                <div class="form-group">
                     <label for="exampleInputFName">First Name</label>
                    <input type="text" autocomplete="off" name="fname" class="form-control input-lg" id="exampleInputFName" placeholder="Enter First Name" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputLName">Phone Number</label>
                    <input type="text" autocomplete="off" maxlength="12" id="phone-input" name="phone" class="form-control input-lg" placeholder="Enter Phone Name" required >
                </div>
                <input type="submit" name="submit" value="Next Step >>" class="btn btn-primary btn-lg btn-block">
            </form>
         </div>
   </div>
    <script>
        $('#phone-input', '#ticketinfo')
            .keydown(function (e) {
                let key = e.charCode || e.keyCode || 0;
                $phone = $(this);

                // Auto-format- do not expose the mask as the user begins to type
                if (key !== 8 && key !== 9) {
                  if ($phone.val().length === 3) {
                    $phone.val($phone.val() + '-');
                  }
                  if ($phone.val().length === 7) {
                    $phone.val($phone.val() + '-');
                  }
                  if ($phone.val().length === 8) {
                    $phone.val($phone.val() + '');
                  }
                }

                // Allow numeric (and tab, backspace, delete) keys only
                return (key === 8 ||
                    key === 9 ||
                    key === 46 ||
                    (key >= 48 && key <= 57) ||
                    (key >= 96 && key <= 105));
              })

              .bind('focus click', function () {
                $phone = $(this);

                if ($phone.val().length === 0) {
                  $phone.val('');
                }
                else {
                  var val = $phone.val();
                  $phone.val('').val(val); // Ensure cursor remains at the end
                }
              })

              .blur(function () {
                $phone = $(this);

                if ($phone.val() === '') {
                  $phone.val('');
                }
              });
            </script>
              <!-- Site footer -->
            <script src="js/jquery-3.4.1.min.js"></script>
            <script src="js/jquery.formatter.js"></script>

            <script src="js/bootstrap.min.js"></script>
            <script src="js/dynamicfields.js"></script>

            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <?php include('includes/site_footer.php');

            ?>