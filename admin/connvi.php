<?php


define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'onlinecourse');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
mysqli_set_charset($con, 'utf8');



	if(!$con){
		die("Error: Failed to connect to database!");
	}
?>