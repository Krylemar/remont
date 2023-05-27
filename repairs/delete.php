<?php 
	include '../config.php';

	$id = $_GET['id'];
	$dbConn->query("DELETE FROM `Repairs` WHERE id_repair = $id");
	header("Location: index.php");
 ?>