<?php 
include "../config/config.php";
include "../models/solarModel.php";
global $config,$objSolarModel;
 // contact

  if(isset($_REQUEST['ajax_action']) && $_REQUEST['ajax_action']=='admin_login'){
	 
	 echo $objSolarModel->userLogin($_REQUEST);
  }
?>