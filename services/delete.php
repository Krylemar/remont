<?php 
	include '../config.php';

	$id = $_GET['id'];
	$dbConn->query("DELETE FROM `Services` WHERE id_service = $id");
	header("Location: index.php");
 ?>