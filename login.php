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
if(isset($_SESSION['user'])){
	header('Location:dashboard.php');
}
include('includes/site_header.php');
?>
<body>
<div id="wrap">
<style type="text/css">

body {
	
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="username"] {
  margin-bottom: 10px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}</style>
 <div class="container">
<div class="panel panel-primary">
  <div align="center" class="panel-heading">
        <h2>Traffic Ticket Management System</h2>
  </div>
  <div class="panel-footer">
    <?php
if(isset($_POST['submit'])){
  $username=$_POST['username'];
  $password=$_POST['password'];
  if(($username=='')|| ($password=='')){ ?>
    <div align="center" class="alert alert-info" role="alert"><h4>Your username or password is empty !</h4></div>
  <?php }
else {
include 'includes/site_config.php';
  if($sql_connect){
  $sql="select admin_username, admin_password from administration where admin_username='$username' and admin_password=md5('$password')";
  $sql_query=mysqli_query($sql_connect,$sql);
  $sql_result= mysqli_num_rows($sql_query);

      if($sql_result!=1){?>
      <div align="center" class="alert alert-danger" role="alert"><h4>Your username or password is incorrect !</h4></div>
  <?php }
        
    else{
     		$_SESSION['user']=$username;
			if(isset($_SESSION['user'])){
				header('Location:dashboard.php');
			}else{
				echo "We have some technical problem. Please try again later !";
	}
	mysqli_close($sql_connect);

      }
}

  }
}
else{ ?>
    <div align="center" class="alert alert-info" role="alert"><h4>Please enter you login information below:</h4></div>
<?php 
}
    ?>
      <form class="form-signin" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input name="username" autocomplete="off" type="text" class="form-control" placeholder="Username"  autofocus>
        <input name="password" autocomplete="off" type="password" class="form-control" placeholder="Password" >
        <input name="submit" class="btn btn-lg btn-primary btn-block" type="submit">
      </form>
</div>
</div>   
 </div> <!-- /container -->

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

<?php include('includes/site_footer.php');
?>
