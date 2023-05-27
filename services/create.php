<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<form method="POST" action="<?php $_PHP_SELF ?>">
		<label>Име на услуга</label><input type="text" name="name"><br>
		<label>Цена на услуга</label><input type="number" step="0.01" name="price"><br>
		<label>Категория на услуга</label>
		<select name="id_group">
			<?php include "../config.php"; 
			$result = $dbConn->query("SELECT * FROM `Service_groups`");
			while ($row = mysqli_fetch_assoc($result)) {
				print_r($row);
				$id = $row['id_group'];
				$name = $row['name'];
				echo "<option value='$id'>$name</option>";
			}
			?>
		</select><br>
		<input type="submit" name="create" value="Създай">
	</form>
	<?php 
	include '../config.php';
	if (isset($_POST['create'])) {
		$name = $_POST['name'];
		$price = $_POST['price'];
		$service_group_id = $_POST['id_group'];

		$dbConn->query("INSERT INTO `Services`(name, price, service_group) VALUES ('$name','$price', '$service_group_id')");

		header("Location: index.php");
	}
	?>
</body>
</html>