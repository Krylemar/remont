<?php 
	include '../config.php';

	$id = $_GET['id'];
	$dbConn->query("DELETE FROM `Employee_positions` WHERE id_position = $id");
	header("Location: index.php");
 ?>