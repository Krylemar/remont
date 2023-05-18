<?php 
	phpinfo();
	$host = 'localhost';
	$dbUser = 'root';
	$dbPass = '';
	$dbName = 'repairs_schema';
	$dbConn = @new mysqli($host,$dbUser,$dbPass);
	if (!$dbConn) {
		die("Failed to connect to database");
	}
 ?>