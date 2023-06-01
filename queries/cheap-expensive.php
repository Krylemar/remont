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
    <div class="page-main">
	<?php 
		include '../config.php';

		$expensive_sql = "SELECT r.id_repair, r.date, r.price, c.first_name AS c_fname, c.last_name AS c_lname, e.first_name AS e_fname, e.last_name AS e_lname 
					FROM `Repairs` AS r
					JOIN `Clients` AS c ON r.client = c.id_client
					JOIN `Employees` AS e ON r.employee = e.id_employee
					ORDER BY r.price DESC
					LIMIT 1";

		$cheap_sql = "SELECT r.id_repair, r.date, r.price, c.first_name AS c_fname, c.last_name AS c_lname, e.first_name AS e_fname, e.last_name AS e_lname 
					FROM `Repairs` AS r
					JOIN `Clients` AS c ON r.client = c.id_client
					JOIN `Employees` AS e ON r.employee = e.id_employee
					ORDER BY r.price ASC
					LIMIT 1";

		$exp_result = $dbConn->query($expensive_sql);
		$chp_result = $dbConn->query($cheap_sql);
		echo "<table>";
		echo "<tr>
				<th colspan='5' style='font-size: 28px'>Най скъп ремонт</th>
			  </tr>
			  <tr>
				<th>Дата</th>
				<th>Цена</th>
				<th>Клиент</th>
				<th>Служител</th>
				<th>Ремонти</th>
			  </tr>";

		$exp_row = mysqli_fetch_assoc($exp_result);

		$id = $exp_row['id_repair'];
		$sql2 = "SELECT s.name FROM `Repair_services` AS rs
				JOIN `Services` AS s ON rs.service_id = s.id_service
				WHERE rs.repair_id = '$id'";
		$service_result = $dbConn->query($sql2);
		$numServices = $service_result->num_rows+1;

		echo "<tr>
				<td rowspan='$numServices'>".$exp_row['date']."</td>
				<td rowspan='$numServices'>".$exp_row['price']."</td>
				<td rowspan='$numServices'>".$exp_row['c_fname']." ".$exp_row['c_lname']."</td>
				<td rowspan='$numServices'>".$exp_row['e_fname']." ".$exp_row['e_lname']."</td>
			  </tr>";

		while($row2 = mysqli_fetch_assoc($service_result)) { 
			echo "
				<tr>
					<td>".$row2['name']."</td>
				</tr>";
		}

		echo "<tr>
				<th colspan='5' style='font-size: 28px'>Най евтин ремонт</th>
			  </tr>
			  <tr>
				<th>Дата</th>
				<th>Цена</th>
				<th>Клиент</th>
				<th>Служител</th>
				<th>Ремонти</th>
			  </tr>";
		$chp_row = mysqli_fetch_assoc($chp_result);

		$id = $chp_row['id_repair'];
		$sql2 = "SELECT s.name FROM `Repair_services` AS rs
				JOIN `Services` AS s ON rs.service_id = s.id_service
				WHERE rs.repair_id = '$id'";
		$service_result = $dbConn->query($sql2);
		$numServices = $service_result->num_rows+1;

		echo "<tr>
				<td rowspan='$numServices'>".$chp_row['date']."</td>
				<td rowspan='$numServices'>".$chp_row['price']."</td>
				<td rowspan='$numServices'>".$chp_row['c_fname']." ".$chp_row['c_lname']."</td>
				<td rowspan='$numServices'>".$chp_row['e_fname']." ".$chp_row['e_lname']."</td>
			  </tr>";

		while($row2 = mysqli_fetch_assoc($service_result)) { 
			echo "
				<tr>
					<td>".$row2['name']."</td>
				</tr>";
		}

		echo "</table>";
	?>
	<div class="button-container">
		<button type="below-table-button" class="button" onclick="redirectToMainPage('../index')">Назад</button>
	</div>
	</div>
<script src="../functions.js"></script>
</body>
</html>