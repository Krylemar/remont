<?php 
	include '../config.php';

	$id = $_GET['id'];
	$dbConn->query("DELETE FROM `Service_groups` WHERE id_group = $id");
	header("Location: index.php");
 ?>