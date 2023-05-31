<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="../style.css">
</head>
<body>
	<section class="top-nav">
        <div>
            <h1 onclick="redirectToSubPageRelative('index')">Сами строй</h1>
        </div>
        <input id="menu-toggle" type="checkbox" />
        <label class='menu-button-container' for="menu-toggle">
            <div class='menu-button'></div>
        </label>
        <ul class="menu">
            <li><button type="button" onclick="redirectToPage('../service_groups','index')">Категории услуги</button></li>
            <li><button type="button" onclick="redirectToPage('../services','index')">Услуги</button></li>
            <li><button type="button" onclick="redirectToPage('../employee_positions','index')">Позиции на служители</button></li>
            <li><button type="button" onclick="redirectToPage('../employees','index')">Служители</button></li>
            <li><button type="button" onclick="redirectToPage('../clients','index')">Клиенти</button></li>
            <li><button type="button" onclick="redirectToPage('../repairs','index')">Ремонти</button></li>
        </ul>
    </section>
	<form method="POST" action="<?php $_PHP_SELF ?>" id="msform">
		<fieldset>
			<input type="date" name="date"><br>
			<select name="client">
				<option value="" disabled selected>Изберете клиент</option>
				<?php include '../config.php';
				$result = $dbConn->query("SELECT * FROM `Clients`");
				while ($row = mysqli_fetch_assoc($result)) {
					$id = $row['id_client'];
					$name = $row['first_name']." ".$row['last_name'];
					echo "<option value='$id'>$name</option>";
				}
				?>
			</select><br>
			<select name="employee">
				<option value="" disabled selected>Изберете служител</option>
				<?php include '../config.php';
				$result = $dbConn->query("SELECT * FROM `Employees`");
				while ($row = mysqli_fetch_assoc($result)) {
					$id = $row['id_employee'];
					$name = $row['first_name']." ".$row['last_name'];
					echo "<option value='$id'>$name</option>";
				}
				?>
			</select><br>
			<label>Изберете услуги</label>
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
		</fieldset>
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
<script src="../functions.js"></script>
</body>
</html>