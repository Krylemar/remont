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
            <li><button type="button" onclick="redirectToPage('service_groups','index')">Категории услуги</button></li>
            <li><button type="button" onclick="redirectToPage('services','index')">Услуги</button></li>
            <li><button type="button" onclick="redirectToPage('employee_positions','index')">Позиции на служители</button></li>
            <li><button type="button" onclick="redirectToPage('employees','index')">Служители</button></li>
            <li><button type="button" onclick="redirectToPage('clients','index')">Клиенти</button></li>
            <li><button type="button" onclick="redirectToPage('repairs','index')">Ремонти</button></li>
        </ul>
    </section>
	<form method="POST" action="<?php $_PHP_SELF ?>" id="msform">
		
		<fieldset>
		<label class="fs-title">Създай услуга</label>
		<input type="text" name="name" placeholder="Име на услуга"><br>
		<input type="number" step="0.01" name="price" placeholder="Цена на услуга"><br>
		<select name="id_group">
			 <option value="" disabled selected>Категория на услуга</option>
			<?php include "../config.php"; 
			$result = $dbConn->query("SELECT * FROM `Service_groups`");
			while ($row = mysqli_fetch_assoc($result)) {
				print_r($row);
				$id = $row['id_group'];
				$name = $row['name'];
				echo "<option value='$id'>$name</option>";
			}
			?>
		</select><br>
		<input type="submit" name="create" value="Създай">
		</fieldset>
	</form>
	<?php 
	include '../config.php';
	if (isset($_POST['create'])) {
		$name = $_POST['name'];
		$price = $_POST['price'];
		$service_group_id = $_POST['id_group'];

		$dbConn->query("INSERT INTO `Services`(name, price, service_group) VALUES ('$name','$price', '$service_group_id')");

		header("Location: index.php");
	}
	?>
</body>
</html>