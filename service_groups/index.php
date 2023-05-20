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
			<th>Група на услуга</th>
			<th>Редактирай</th>
			<th>Изтрий</th>
		</tr>
		<?php 
			include '../config.php'; 
			$result = $dbConn->query("SELECT id_group, name FROM `Service_groups`");
			while ($row = mysqli_fetch_assoc($result)) {
				$id = $row['id_group'];
				echo "<tr>\n\t\t";
				echo "<td>".$row['name']."</td>\n\t\t";
				echo '<td><button onclick="redirectToPage(\'update\','.$id.')">Редактирай</button></td>'."\n\t\t";
				echo '<td><button onclick="redirectToPage(\'delete\','.$id.')">Изтрий</button></td>'."\n\t\t";
				echo "</tr>\n\t\t";
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