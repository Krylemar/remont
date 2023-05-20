<?php 
	$host = 'localhost';
	$dbUser = 'root';
	$dbPass = '';
	$dbName = 'repairs_schema';
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$dbConn = @new mysqli($host,$dbUser,$dbPass);
	if (!$dbConn) {
		die("Failed to connect to database");
	}
	
	// Check if database exists
	$result = $dbConn->query("SHOW DATABASES");
	$databaseExists = false;
	while ($row = $result->fetch_array()) {
	    if ($row[0] == $dbName) {
	        $databaseExists = true;
	        break;
	    }
	}

	// If doesn't exist, create
	if (!$databaseExists) {
	    $sql = "CREATE DATABASE ".$dbName;
	    $dbConn->query($sql);
	}

	$dbConn->select_db($dbName);
 ?>