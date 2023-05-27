<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<?php require 'create.php'; ?>
</head>
<body>
	<h1>Сами строй</h1>
	<table border="1">
		<tr>
			<th>Таблици\Операции</th>
			<th>Преглед</th>
			<th>Създай</th>
		</tr>
		<tr>
			<th>Тип услуга</th>
			<td><button type="button" onclick="redirectToPage('service_groups','index')">Преглед</button></td>
			<td><button type="button" onclick="redirectToPage('service_groups','create')">Създай</button></td>
		</tr>
		<tr>
			<th>Услуги</th>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<th>Позиции на служител</th>
			<td><button type="button" onclick="redirectToPage('employee_positions','index')">Преглед</button></td>
			<td><button type="button" onclick="redirectToPage('employee_positions','create')">Създай</button></td>
		</tr>
		<tr>
			<th>Служители</th>
			<td><button type="button" onclick="redirectToPage('employees','index')">Преглед</button></td>
			<td><button type="button" onclick="redirectToPage('employees','create')">Създай</button></td>
		</tr>
		<tr>
			<th>Клиенти</th>
			<td><button type="button" onclick="redirectToPage('clients','index')">Преглед</button></td>
			<td><button type="button" onclick="redirectToPage('clients','create')">Създай</button></td>
		</tr>
		<tr>
			<th>Ремонти</th>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<th>Ремонти на клиент</th>
			<td></td>
			<td></td>
		</tr>
	</table>

	<script type="text/javascript">
		function redirectToPage(table,page) {
			window.location.href = table+"/"+page+".php";
		};
	</script>

</body>
</html>