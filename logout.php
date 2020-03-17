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
unset($_SESSION['user']);
session_destroy();
if(!isset($_SESSION['user'])){
	header('Location:index.php');
}
?>