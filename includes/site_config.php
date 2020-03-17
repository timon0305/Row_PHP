<?php
/*
#######################################################
Product Name : TTMS
Product Version: 1.0
Developer: Saransh Kalia
Web: www.99degreesnorth.com
Email: conteact@99degreesnorth.com
#######################################################


	$site_name="TTMS";
	$site_version="V:1.0";

	$db_connection="localhost";
	$db_username="systemp1_aarontt";
	$db_password="W-O6N?vGu&fp";
	$db_name="systemp1_aaronttms";
*/



	$site_name="TTMS";
	$site_version="V:1.0";

	$db_connection="localhost";
	$db_username="root";
	$db_password="";
	$db_name="ttms";

	$sql_connect= mysqli_connect($db_connection,$db_username,$db_password,$db_name);

	if(!$sql_connect){
		echo "Sorry, We are not able to connect with database !";
		return False;
	}

?>