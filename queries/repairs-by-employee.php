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
	<form method="POST" action="<?php $_PHP_SELF ?>" id="msform">
		<fieldset>
			<label class="fs-title">Ремонти на служител, подредени по дата</label>
			<select name="employee">
				<option value="" disabled selected>Изберете служител</option>
				<?php include '../config.php';
				$result = $dbConn->query("SELECT * FROM `Employees`");
				while ($row = mysqli_fetch_assoc($result)) {
					$id = $row['id_employee'];
					$name = $row['first_name']." ".$row['last_name'];
					echo "<option value='$id'>$name</option>";
				}
				?>
			</select><br>
			<input type="submit" name="run" value="Изпълни">
		</fieldset>
	</form>
	<?php 
		if (isset($_POST['run'])) {
			include 'config.php';
			$id = $_POST['employee'];

			$sql = "SELECT r.id_repair, r.date, r.price, c.first_name AS fname, c.last_name AS lname
					FROM `Repairs` AS r 
					JOIN `Clients` AS c ON r.client = c.id_client
					WHERE r.employee = '$id'
					ORDER BY r.date ASC";
			$result = $dbConn->query($sql);
			$employee_names_result = $dbConn->query("SELECT first_name AS fname, last_name AS lname FROM `Employees` WHERE id_employee = '$id'");
			$employee_names = mysqli_fetch_assoc($employee_names_result);
			echo "<table style='background-color: rgba(220,220,220,0.55); border-radius: 15px; margin-top: 150px'>";
			echo "<tr>
					<th colspan='3' style='font-size: 28px;'>Ремонти на:".$employee_names['fname']." ".$employee_names['lname']."</th>
				  </tr>
				  <tr>
					<th>Дата</th>
					<th>Цена</th>
					<th>Клиент</th>
				  </tr>";
			while ($row = mysqli_fetch_assoc($result)) {
				echo "
					<tr>
						<td>".$row['date']."</td>
						<td>".$row['price']."</td>
						<td>".$row['fname']." ".$row['lname']."</td>
					</tr>";
			}
			echo "</table>";
		}
	?>
	<div class="button-container">
		<button type="below-table-button" class="button" onclick="redirectToMainPage('../index')">Назад</button>
	</div>
<script src="../functions.js"></script>
</body>
</html>