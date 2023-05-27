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
				echo "<td>".$row['s_name']."</td>";
				echo "<td>".$row['price']."</td>";
				echo "<td>".$row['g_name']."</td>";
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