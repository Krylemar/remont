<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="style.css">
	<?php require 'create.php'; ?>
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
            <li><button type="button" onclick="redirectToPage('service_groups','index')">Категории услуги</button></li>
            <li><button type="button" onclick="redirectToPage('services','index')">Услуги</button></li>
            <li><button type="button" onclick="redirectToPage('employee_positions','index')">Позиции на служители</button></li>
            <li><button type="button" onclick="redirectToPage('employees','index')">Служители</button></li>
            <li><button type="button" onclick="redirectToPage('clients','index')">Клиенти</button></li>
            <li><button type="button" onclick="redirectToPage('repairs','index')">Ремонти</button></li>
        </ul>
    </section>
    <div class="page-main">
	<table >
		<tr>
			<th>Таблици\Операции</th>
			<th>Преглед</th>
			<th>Създай</th>
		</tr>
		<tr>
			<th>Категории услуги</th>
			<td><button class="button" type="button" onclick="redirectToPage('service_groups','index')">Преглед</button></td>
			<td><button class="button" type="button" onclick="redirectToPage('service_groups','create')">Създай</button></td>
		</tr>
		<tr>
			<th>Услуги</th>
			<td><button class="button" type="button" onclick="redirectToPage('services','index')">Преглед</button></td>
			<td><button class="button" type="button" onclick="redirectToPage('services','create')">Създай</button></td>
		</tr>
		<tr>
			<th>Позиции на служител</th>
			<td><button class="button" type="button" onclick="redirectToPage('employee_positions','index')">Преглед</button></td>
			<td><button class="button" type="button" onclick="redirectToPage('employee_positions','create')">Създай</button></td>
		</tr>
		<tr>
			<th>Служители</th>
			<td><button class="button" type="button" onclick="redirectToPage('employees','index')">Преглед</button></td>
			<td><button class="button" type="button" onclick="redirectToPage('employees','create')">Създай</button></td>
		</tr>
		<tr>
			<th>Клиенти</th>
			<td><button class="button" type="button" onclick="redirectToPage('clients','index')">Преглед</button></td>
			<td><button class="button" type="button" onclick="redirectToPage('clients','create')">Създай</button></td>
		</tr>
		<tr>
			<th>Ремонти</th>
			<td><button class="button" type="button" onclick="redirectToPage('repairs','index')">Преглед</button></td>
			<td><button class="button" type="button" onclick="redirectToPage('repairs','create')">Създай</button></td>
		</tr>
	</table>
	</div>
	<script src="functions.js"></script>
	<script type="text/javascript">
		
	</script>
</body>
</html>