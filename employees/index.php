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
			<th>Име</th>
			<th>Презиме</th>
			<th>Телефон</th>
			<th>Имейл</th>
			<th>Позиция</th>
			<th>Редактирай</th>
			<th>Изтрий</th>
		</tr>
		<?php 
			include '../config.php';

			$result = $dbConn->query("SELECT e.id_employee, e.first_name, e.last_name, e.phone, e.email, ep.name FROM `Employees`AS e JOIN `Employee_positions` AS ep ON e.position = ep.id_position");
			while ($row = mysqli_fetch_assoc($result)) {
				$id = $row['id_employee'];

				echo "<tr>";
				echo "<td>".$row['first_name']."</td>";
				echo "<td>".$row['last_name']."</td>";
				echo "<td>".$row['phone']."</td>";
				echo "<td>".$row['email']."</td>";
				echo "<td>".$row['name']."</td>";
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