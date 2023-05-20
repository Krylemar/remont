
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<?php 
	include '../config.php';
	global $id;
	$id = $_GET['id'];
	$result = $dbConn->query("SELECT * FROM Service_groups WHERE id_group = $id");
	$row = mysqli_fetch_assoc($result);
	global $name;
	$name = $row['name'];
	 ?>
</head>
<body>
	<form method="POST" action="<?php $_PHP_SELF ?>">
		<label>Ново име на група на услуга</label>
		<?php include '../config.php'; 
			echo "<input type='text' name='name' value='$name'>"; ?><br>
		<input type="submit" name="update" value="Редактирай">
	</form>
	<?php  
	if (isset($_POST['update'])) {
		include '../config.php';
		$name = $_POST['name'];
		$dbConn->query("UPDATE Service_groups SET name = '$name' WHERE id_group = $id");
		header("Location: index.php");
		$dbConn->close();
	}

?>
</body>
</html>