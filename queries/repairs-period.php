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
			<label>От дата</label>
			<input type="date" name="start_date"><br>
			<label>До дата</label>
			<input type="date" name="end_date">	
			<input type="submit" name="run" value="Изпълни">
		</fieldset>
	</form>
	<?php 
		if (isset($_POST['run'])) {
			include '../config.php';
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];

			$sql = "SELECT r.id_repair, r.date, r.price, c.first_name AS c_fname, c.last_name AS c_lname, e.first_name AS e_fname, e.last_name AS e_lname 
					FROM `Repairs` AS r
					JOIN `Clients` AS c ON r.client = c.id_client
					JOIN `Employees` AS e ON r.employee = e.id_employee
					WHERE r.date BETWEEN '$start_date' AND '$end_date'
					ORDER BY r.date ASC ";
			$repair_result = $dbConn->query($sql);
			echo "<table style='background-color: rgba(220,220,220,0.55); border-radius: 15px; margin-top: 150px'>";
			echo "<tr>
					<th>Дата</th>
					<th>Цена</th>
					<th>Клиент</th>
					<th>Служител</th>
					<th>Услуги</th>
				</tr>";

			while ($row = mysqli_fetch_assoc($repair_result)) {
				$id = $row['id_repair'];
				$sql2 = "SELECT s.name FROM `Repair_services` AS rs
						JOIN `Services` AS s ON rs.service_id = s.id_service
						WHERE rs.repair_id = '$id'";
				$service_result = $dbConn->query($sql2);
				$numServices = $service_result->num_rows+1;

				echo "<tr>
						<td rowspan='$numServices'>".$row['date']."</td>
						<td rowspan='$numServices'>".$row['price']."</td>
						<td rowspan='$numServices'>".$row['c_fname']." ".$row['c_lname']."</td>
						<td rowspan='$numServices'>".$row['e_fname']." ".$row['e_lname']."</td>
					  </tr>";

				while($row2 = mysqli_fetch_assoc($service_result)) { 
					echo "
						<tr>
							<td>".$row2['name']."</td>
						</tr>";
				}
			}
			echo "</table>";
		}
	?>
	<div class="button-container">
		<button type="below-table-button" class="button" onclick="redirectToMainPage('../index')">Назад</button>
	</div>
<script src="../functions.js"></script>
</body>
</html>