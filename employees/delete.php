<?php 
	include '../config.php';

	$id = $_GET['id'];
	$dbConn->query("DELETE FROM `Employees` WHERE id_employee = $id");
	header("Location: index.php");
 ?>