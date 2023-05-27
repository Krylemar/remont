<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<form method="POST" action="<?php $_PHP_SELF ?>">
		<label>Дата</label><input type="date" name="date"><br>
		<label>Клиент</label>
		<select name="client">
			<?php include '../config.php';
			$result = $dbConn->query("SELECT * FROM `Clients`");
			while ($row = mysqli_fetch_assoc($result)) {
				$id = $row['id_client'];
				$name = $row['first_name']." ".$row['last_name'];
				echo "<option value='$id'>$name</option>";
			}
			?>
		</select><br>
		<label>Служител</label>
		<select name="employee">
			<?php include '../config.php';
			$result = $dbConn->query("SELECT * FROM `Employees`");
			while ($row = mysqli_fetch_assoc($result)) {
				$id = $row['id_employee'];
				$name = $row['first_name']." ".$row['last_name'];
				echo "<option value='$id'>$name</option>";
			}
			?>
		</select><br>
		<select multiple="multiple" name="services[]">
			<?php include '../config.php';
			$result = $dbConn->query("SELECT * FROM `Services`");
			while ($row = mysqli_fetch_assoc($result)) {
				$id = $row['id_service'];
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
			$services_ids = $_POST['services'];
			$date = $_POST['date'];
			$client = $_POST['client'];
			$employee = $_POST['employee'];
			$price = 0.00;

			$dbConn->query("INSERT INTO `Repairs` (date, price, client, employee) VALUES ('$date','$price','$client','$employee')");

			$last_id = $dbConn->insert_id; // id of just inserted entry

			// Insert all services of this repair in repair_services
			foreach ($services_ids as $key => $value) {
				$dbConn->query("INSERT INTO `Repair_services` (repair_id,service_id) VALUES ('$last_id','$value')");	
			}

			// Sum total of all services
			$sql = "SELECT SUM(s.price) AS total_price
					FROM `Repair_services` AS rs
					JOIN `Services` AS s ON rs.service_id = s.id_service
					WHERE rs.repair_id = $last_id";
			$result = $dbConn->query($sql);
			if ($result != false) {
				$row = mysqli_fetch_assoc($result);
				$price = $row['total_price'];
			}

			// Write sum in corresponding entry
			$dbConn->query("UPDATE `Repairs` SET price = $price WHERE id_repair = $last_id");
			
			header("Location: index.php");
		}
	 ?>
</body>
</html>