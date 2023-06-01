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
            <h1 onclick="redirectToSubPageRelative('index')">Сами строй</h1>
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
			<th>Таблици</th>
			<th>Преглед</th>
			<th>Създай</th>
		</tr>
		<tr>
			<td>Категории услуги</td>
			<td><button class="button" type="button" onclick="redirectToPage('service_groups','index')">Преглед</button></td>
			<td><button class="button" type="button" onclick="redirectToPage('service_groups','create')">Създай</button></td>
		</tr>
		<tr>
			<td>Услуги</td>
			<td><button class="button" type="button" onclick="redirectToPage('services','index')">Преглед</button></td>
			<td><button class="button" type="button" onclick="redirectToPage('services','create')">Създай</button></td>
		</tr>
		<tr>
			<td>Позиции на служител</td>
			<td><button class="button" type="button" onclick="redirectToPage('employee_positions','index')">Преглед</button></td>
			<td><button class="button" type="button" onclick="redirectToPage('employee_positions','create')">Създай</button></td>
		</tr>
		<tr>
			<td>Служители</td>
			<td><button class="button" type="button" onclick="redirectToPage('employees','index')">Преглед</button></td>
			<td><button class="button" type="button" onclick="redirectToPage('employees','create')">Създай</button></td>
		</tr>
		<tr>
			<td>Клиенти</td>
			<td><button class="button" type="button" onclick="redirectToPage('clients','index')">Преглед</button></td>
			<td><button class="button" type="button" onclick="redirectToPage('clients','create')">Създай</button></td>
		</tr>
		<tr>
			<td>Ремонти</td>
			<td><button class="button" type="button" onclick="redirectToPage('repairs','index')">Преглед</button></td>
			<td><button class="button" type="button" onclick="redirectToPage('repairs','create')">Създай</button></td>
		</tr>
		<tr>
			<th>Заявки</th>
			<th>Преглед</th>
		</tr>
		<tr>
			<td>Ремонти за определен период</td>
			<td><button class="button" type="button" onclick="redirectToPage('queries','repairs-period')">Преглед</button></td>
		</tr>
		<tr>
			<td>Ремонти на служител</td>
			<td><button class="button" type="button" onclick="redirectToPage('queries','repairs-by-employee')">Преглед</button></td>
		</tr>
		<tr>
			<td>Ремонти на клиент</td>
			<td><button class="button" type="button" onclick="redirectToPage('queries','repairs-by-client')">Преглед</button></td>
		</tr>
		<tr>
			<td>Топ 5 служителя по брой ремонти</td>
			<td><button class="button" type="button" onclick="redirectToPage('queries','count-of-repairs-by-employee')">Преглед</button></td>
		</tr>
		<tr>
			<td>Най-евтин/Най-скъп ремонт</td>
			<td><button class="button" type="button" onclick="redirectToPage('queries','cheap-expensive')">Преглед</button></td>
		</tr>
	</table>
	</div>
	<script src="functions.js"></script>
	<script type="text/javascript">
		
	</script>
</body>
</html>