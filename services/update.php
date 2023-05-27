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
	$result = $dbConn->query("SELECT * FROM `Services` WHERE id_service = $id");
	$row = mysqli_fetch_assoc($result);
	global $name, $price,$group_id;
	$name = $row['name'];
	$price = $row['price'];
	$group_id = $row['service_group'];
	 ?>
</head>
<body>
	<form method="POST" action="<?php $_PHP_SELF ?>">
		<?php include '../config.php'; 
			echo "<label>Име на услуга</label><input type='text' name='name' value='$name'><br>";
			echo "<label>Цена на услуга</label><input type='number' step='0.01' name='price' value='$price'><br>";
			echo "<label>Категория</label>
				  <select name='group_id'>";
			$result = $dbConn->query("SELECT * FROM `Service_groups`");
			while ($row = mysqli_fetch_assoc($result)) {
				$groupId = $row['id_group'];
				$groupName = $row['name'];
				if ($groupId == $group_id) {
					echo "<option value='$groupId' selected>$groupName</option>";
				}
				else echo "<option value='$groupId'>$groupName</option>";
			}
			echo "</select>";
			?>
		<input type="submit" name="update" value="Редактирай">
	</form>
	<?php  
	if (isset($_POST['update'])) {
		include '../config.php';
		$name = $_POST['name'];
		$price = $_POST['price'];
		$group_id = $_POST['group_id'];
		$dbConn->query("UPDATE Services SET name = '$name',
											price = '$price',
											service_group = '$group_id'
											WHERE id_service = $id");
		header("Location: index.php");
		$dbConn->close();
	}

?>
</body>
</html>