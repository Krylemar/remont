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
            <h1>Сами строй</h1>
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
	<table>
		<tr>
			<th>Име</th>
			<th>Цена</th>
			<th>Категория</th>
			<th>Редактирай</th>
			<th>Изтрий</th>
		</tr>
		<?php 
			include '../config.php';

			$result = $dbConn->query("SELECT s.name AS s_name, s.id_service, s.price,sg.name AS g_name FROM `Services` AS s JOIN `Service_groups` AS sg ON s.service_group = sg.id_group");
			while ($row = mysqli_fetch_assoc($result)) {
				$id = $row['id_service'];

				echo "<tr>";
				echo "<th>".$row['s_name']."</th>";
				echo "<th>".$row['price']."</th>";
				echo "<th>".$row['g_name']."</th>";
				echo '<td><button class="button" onclick="redirectToSubPageWithId(\'update\','.$id.')">Редактирай</button></td>'."\n\t\t";
				echo '<td><button class="button" onclick="redirectToSubPageWithId(\'delete\','.$id.')">Изтрий</button></td>'."\n\t\t";
				echo "</tr>";
			}
		 ?>
	</table>
	<div class="button-container">
		<button type="below-table-button" class="button" onclick="redirectToSubPageRelative('create')">Добави</button>
		<button type="below-table-button" class="button" onclick="redirectToMainPage('../index')">Назад</button>
		</div>
	</div>

	<script src="../functions.js"></script>

</body>
</html>