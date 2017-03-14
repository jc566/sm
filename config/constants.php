<?php
   // define your constants
	if($_SERVER['HTTP_HOST']=='cbf11'){ // local setting
		define("DB", "db_homeilearn");
		define("USER", "root");
		define("PW", "vertrigo");
		define("HOST", "localhost");
		$DOMAIN = 'http://'.$_SERVER['HTTP_HOST'].'/xampp/click/';
		$adminUrl = 'http://'.$_SERVER['HTTP_HOST'].'/xampp/solar/administrator/';
	}else{ // live setting 
		define("DB", "Db_solarsystem");
		define("USER", "user_solarsystem");
		define("PW", "pasL_+()&P0_@#~");
		define("HOST", "localhost");
		$DOMAIN = 'http://'.$_SERVER['HTTP_HOST'].'/solar';
		$adminUrl = 'http://'.$_SERVER['HTTP_HOST'].'/solar/administrator/';
		
	}

	define("ACTIVE", "1");
	define("INACTIVE", "0");
	
	/**Booking Status**/
	define("PENDING", "0");
	define("CONFIRM", "1");
	define("IN_PROGRESS", "2");
	/**Booking Status**/
	define("admin_url", $adminUrl);
	define("DOMAIN", $DOMAIN);
	define("IMAGES", DOMAIN.'/uploads');


?>