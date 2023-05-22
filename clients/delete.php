<?php 
	include '../config.php';

	$id = $_GET['id'];
	$dbConn->query("DELETE FROM `Clients` WHERE id_client = $id");
	header("Location: index.php");
 ?>