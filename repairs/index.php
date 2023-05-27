<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<table border="1">
		<tr>
			<th>Дата</th>
			<th>Цена</th>
			<th>Клиент</th>
			<th>Служител</th>
			<th>Редактирай</th>
			<th>Изтрий</th>
		</tr>
		<?php 
			include '../config.php';
			$result = $dbConn->query("SELECT r.id_repair, r.`date`, r.price, e.first_name AS e_fname, e.last_name AS e_lname, c.first_name AS c_fname, c.last_name AS c_lname FROM `Repairs` AS r
									JOIN `Employees` AS e ON r.employee = e.id_employee
									JOIN `Clients` AS c ON r.client = c.id_client");
			while ($row = mysqli_fetch_assoc($result)) {
				$id = $row['id_repair'];

				echo "<tr>";
				echo "<td>".$row['date']."</td>";
				echo "<td>".$row['price']."</td>";
				echo "<td>".$row['c_fname']." ".$row['c_lname']."</td>";
				echo "<td>".$row['e_fname']." ".$row['e_lname']."</td>";
				echo '<td><button onclick="redirectToPage(\'update\','.$id.')">Редактирай</button></td>'."\n\t\t";
				echo '<td><button onclick="redirectToPage(\'delete\','.$id.')">Изтрий</button></td>'."\n\t\t";
				echo "</tr>";
			}
		 ?>
	</table>
	<button type="button" onclick="redirectToCreatePage()">Добави</button>


	<script type="text/javascript">

		function redirectToCreatePage() {
			window.location.href = "create.php";
		};

		function redirectToPage(page,id) {
			window.location.href = page+".php?id="+id;
		};
	</script>
</body>
</html>