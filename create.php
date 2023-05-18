<?php 
	include 'config.php';


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

	// CREATE TABLES

	// Employee_positions
	try {
	$result = $dbConn->query("SELECT 1 FROM Employee_positions LIMIT 1");	    
	} catch (Exception $e){
		$sql = "CREATE TABLE Employee_positions (
			id_position INTEGER PRIMARY KEY AUTO_INCREMENT,
			name VARCHAR(30) NOT NULL);";
		$dbConn->query($sql);
	}


	// Employees
	try {
	$result = $dbConn->query("SELECT 1 FROM Employees LIMIT 1");	    
	} catch (Exception $e){
		$sql = "CREATE TABLE Employees (
			id_employee INTEGER PRIMARY KEY AUTO_INCREMENT,
			first_name VARCHAR(30) NOT NULL,
			last_name VARCHAR(30) NOT NULL,
			phone VARCHAR(20) NOT NULL,
			email VARCHAR(50) NOT NULL,
			position INTEGER NOT NULL,
			FOREIGN KEY (position) REFERENCES Employee_positions(id_position));";
		$dbConn->query($sql);
	}

	// Service_groups
	try {
	$result = $dbConn->query("SELECT 1 FROM Service_groups LIMIT 1");
	} catch (Exception $e) {
		$sql = "CREATE TABLE Service_groups (
			id_group INTEGER PRIMARY KEY AUTO_INCREMENT,
			name VARCHAR(30) NOT NULL);";
		$dbConn->query($sql);
	}

	// Services
	try {
	$result = $dbConn->query("SELECT 1 FROM Services LIMIT 1");	    
	} catch (Exception $e){
		$sql = "CREATE TABLE Services (
			id_service INTEGER PRIMARY KEY AUTO_INCREMENT,
			price DOUBLE(8,2) NOT NULL,
			service_group INTEGER,
			FOREIGN KEY (service_group) REFERENCES Service_groups(id_group));";
		$dbConn->query($sql);
	}


	// Clients
	try {
	$result = $dbConn->query("SELECT 1 FROM Clients LIMIT 1");
	} catch (Exception $e) {
		$sql = "CREATE TABLE Clients(
			id_client INTEGER PRIMARY KEY AUTO_INCREMENT,
			first_name VARCHAR(30) NOT NULL,
			last_name VARCHAR(30) NOT NULL,
			phone VARCHAR(20) NOT NULL,
			email VARCHAR(50) NOT NULL);";
		$dbConn->query($sql);
	}


	// Repairs
	try {
	$result = $dbConn->query("SELECT 1 FROM Repairs LIMIT 1");
	} catch (Exception $e) {
		$sql = "CREATE TABLE Repairs(
			id_repair INTEGER PRIMARY KEY AUTO_INCREMENT,
			`date` DATE NOT NULL,
			price DOUBLE(8,2) NOT NULL,
			client INTEGER NOT NULL,
			employee INTEGER NOT NULL,
			FOREIGN KEY (client) REFERENCES Clients(id_client),
			FOREIGN KEY (employee) REFERENCES Employees(id_employee));";
		$dbConn->query($sql);
	}

	// Repair_services (M:M table between Repairs && Services)
	try {
	$result = $dbConn->query("SELECT 1 FROM Repair_services LIMIT 1");
	} catch (Exception $e) {
		$sql = "CREATE TABLE Repair_services(
			repair_id INTEGER,
			service_id INTEGER,
			PRIMARY KEY(repair_id,service_id),
			FOREIGN KEY (repair_id) REFERENCES Repairs(id_repair),
			FOREIGN KEY (service_id) REFERENCES Services(id_service));";
		$dbConn->query($sql);
	}

	$dbConn->close();
 ?>