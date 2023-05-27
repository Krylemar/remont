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
	$result = $dbConn->query("SELECT * FROM `Repairs` WHERE id_repair = $id");
	$row = mysqli_fetch_assoc($result);
	global $date, $price,$client,$employee;
	$date = $row['date'];
	$price = $row['price'];
	$client = $row['client'];
	$employee = $row['employee'];
	 ?>
</head>
<body>
	<form method="POST" action="<?php $_PHP_SELF ?>">
		<?php include '../config.php'; 
			echo "<label>Дата</label><input type='date' name='date' value='$date'><br>";
			echo "<label>Клиент</label>";
			echo "<select name='client'>";
			$result = $dbConn->query("SELECT * FROM `Clients`");
			while ($row = mysqli_fetch_assoc($result)) {
				$id_rep = $row['id_client'];
				$name = $row['first_name']." ".$row['last_name'];
				if ($row['id_client'] == $id) {
					echo "<option value='$id_rep' selected>$name</option>";
				}
				else echo "<option value='$id_rep'>$name</option>";
				
			}
			echo "</select><br>";
			echo "<label>Служител</label>";
			echo "<select name='employee'>";
			$result = $dbConn->query("SELECT * FROM `Employees`");
			while ($row = mysqli_fetch_assoc($result)) {
				$id_rep = $row['id_employee'];
				$name = $row['first_name']." ".$row['last_name'];
				if ($row['id_employee'] == $id) {
					echo "<option value='$id_rep' selected>$name</option>";
				}
				else echo "<option value='$id_rep'>$name</option>";
			}
			echo "</select><br>"; 
			echo "<select multiple='multiple' name='services[]'>";
			
			$result = $dbConn->query("SELECT * FROM `Services`");
			while ($row = mysqli_fetch_assoc($result)) {
				$id_rep = $row['id_service'];
				$name = $row['name'];
				echo "<option value='$id_rep'>$name</option>";
			}
			echo "</select><br>";
			?>
		<input type="submit" name="update" value="Редактирай">
	</form>
	<?php  
	if (isset($_POST['update'])) {
		include '../config.php';
		$date = $_POST['date'];
		$client = $_POST['client'];
		$employee = $_POST['employee'];
		$services = $_POST['services'];
		$dbConn->query("UPDATE `Repairs` SET  date = '$date',
											  client = '$client',
											  employee = '$employee'
										 WHERE id_repair = '$id'");

		// Delete old services of this repair
		$dbConn->query("DELETE FROM `Repair_services` WHERE repair_id = $id");

		// Insert new services of this repair
		foreach ($services as $key => $value) {
			$dbConn->query("INSERT INTO `Repair_services` (repair_id,service_id) VALUES ('$id','$value')");	
		}

		// Sum total of all services
		$sql = "SELECT SUM(s.price) AS total_price
				FROM `Repair_services` AS rs
				JOIN `Services` AS s ON rs.service_id = s.id_service
				WHERE rs.repair_id = $id";
		$result = $dbConn->query($sql);
		$price = 0.00;
		if ($result != false) {
			$row = mysqli_fetch_assoc($result);
			$price = $row['total_price'];
		}
		// Write sum in corresponding entry
		$dbConn->query("UPDATE `Repairs` SET price = $price WHERE id_repair = $id");

		header("Location: index.php");
		$dbConn->close();
	}

?>
</body>
</html>