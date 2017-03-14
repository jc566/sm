<?php
 global $con;
if(! isset($_SESSION)){
	session_start();
}
	if(isset($_REQUEST['ajax_action']))
		include "../config/constants.php"; 
	else
		include "config/constants.php"; 

	$host = HOST;
	$user = USER;
	$pass = PW;
	$db = DB;
	//@mysql_connect($host,$user,$pass) or die("UNABLE To Connect to the server | Check The file config.php, 1");
	//@mysql_select_db($db) or die("Unable to select a database, 2");
    $con =  mysqli_connect($host,$user,$pass,$db) or die("UNABLE To Connect to the server | Check The file config.php, 1");
?> 
  
  


