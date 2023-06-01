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

		$sql = "SELECT e.first_name AS fname, e.last_name AS lname, COUNT(*) AS repair_count
				FROM `Repairs` AS r 
				JOIN `Employees` AS e ON r.employee = e.id_employee
				GROUP BY r.employee
				ORDER BY repair_count DESC
				LIMIT 5";
		$result = $dbConn->query($sql);
		echo "<table>";
		echo "<tr>
				<th colspan='2'>Топ 5 служителя с най-много ремонти</th>
			  </tr>";
		while ($row = mysqli_fetch_assoc($result)) {
			echo "
				<tr>
					<td>".$row['fname']." ".$row['lname']."</td>
					<td>".$row['repair_count']."</td>
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