
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
	$result = $dbConn->query("SELECT * FROM Employee_positions WHERE id_position = $id");
	$row = mysqli_fetch_assoc($result);
	global $name;
	$name = $row['name'];
	 ?>
</head>
<body>
	<form method="POST" action="<?php $_PHP_SELF ?>">
		<label>Ново име на позиция</label>
		<?php include '../config.php'; 
			echo "<input type='text' name='name' value='$name'>"; ?><br>
		<input type="submit" name="update" value="Редактирай">
	</form>
	<?php  
	if (isset($_POST['update'])) {
		include '../config.php';
		$name = $_POST['name'];
		$dbConn->query("UPDATE Employee_positions SET name = '$name' WHERE id_position = $id");
		header("Location: index.php");
		$dbConn->close();
	}

?>
</body>
</html>