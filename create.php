<?php 
	include 'config.php';




	// CREATE TABLES

	// Employee_positions
	try {
	$result = $dbConn->query("SELECT 1 FROM Employee_positions LIMIT 1");	    
	} catch (Exception $e){
		$sql = "CREATE TABLE Employee_positions (
			id_position INTEGER PRIMARY KEY AUTO_INCREMENT,
			name VARCHAR(30) NOT NULL UNIQUE);";
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
			position INTEGER DEFAULT NULL,
			FOREIGN KEY (position) REFERENCES Employee_positions(id_position) ON DELETE SET NULL);";
		$dbConn->query($sql);
	}

	// Service_groups
	try {
	$result = $dbConn->query("SELECT 1 FROM Service_groups LIMIT 1");
	} catch (Exception $e) {
		$sql = "CREATE TABLE Service_groups (
			id_group INTEGER PRIMARY KEY AUTO_INCREMENT,
			name VARCHAR(30) NOT NULL UNIQUE);";
		$dbConn->query($sql);
	}

	// Services
	try {
	$result = $dbConn->query("SELECT 1 FROM Services LIMIT 1");	    
	} catch (Exception $e){
		$sql = "CREATE TABLE Services (
			id_service INTEGER PRIMARY KEY AUTO_INCREMENT,
			name VARCHAR(50) NOT NULL,
			price DOUBLE(8,2) NOT NULL,
			service_group INTEGER DEFAULT NULL,
			FOREIGN KEY (service_group) REFERENCES Service_groups(id_group) ON DELETE SET NULL);";
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
			employee INTEGER DEFAULT NULL,
			FOREIGN KEY (client) REFERENCES Clients(id_client) ON DELETE CASCADE,
			FOREIGN KEY (employee) REFERENCES Employees(id_employee) ON DELETE SET NULL);";
		$dbConn->query($sql);
	}

	// Repair_services (M:M table between Repairs && Services)
	try {
	$result = $dbConn->query("SELECT 1 FROM Repair_services LIMIT 1");
	} catch (Exception $e) {
		$sql = "CREATE TABLE Repair_services(
			repair_id INTEGER DEFAULT NULL,
			service_id INTEGER DEFAULT NULL,
			UNIQUE(repair_id,service_id),
			FOREIGN KEY (repair_id) REFERENCES Repairs(id_repair) ON DELETE CASCADE,
			FOREIGN KEY (service_id) REFERENCES Services(id_service) ON DELETE SET NULL);";
		$dbConn->query($sql);
	}

	$dbConn->close();
 ?>