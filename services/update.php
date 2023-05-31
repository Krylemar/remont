<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="../style.css">
	<?php 
	include '../config.php';
	global $id;
	$id = $_GET['id'];
	$result = $dbConn->query("SELECT * FROM `Services` WHERE id_service = $id");
	$row = mysqli_fetch_assoc($result);
	global $name, $price,$group_id;
	$name = $row['name'];
	$price = $row['price'];
	$group_id = $row['service_group'];
	 ?>
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
		<?php include '../config.php'; 
			echo "<label>Име на услуга</label><input type='text' name='name' value='$name'><br>";
			echo "<label>Цена на услуга</label><input type='number' step='0.01' name='price' value='$price'><br>";
			echo "<label>Категория</label>
				  <select name='group_id'>";
			$result = $dbConn->query("SELECT * FROM `Service_groups`");
			while ($row = mysqli_fetch_assoc($result)) {
				$groupId = $row['id_group'];
				$groupName = $row['name'];
				if ($groupId == $group_id) {
					echo "<option value='$groupId' selected>$groupName</option>";
				}
				else echo "<option value='$groupId'>$groupName</option>";
			}
			echo "</select>";
			?>
		<input type="submit" name="update" value="Редактирай">
		</fieldset>
	</form>
	<?php  
	if (isset($_POST['update'])) {
		include '../config.php';
		$name = $_POST['name'];
		$price = $_POST['price'];
		$group_id = $_POST['group_id'];
		$dbConn->query("UPDATE Services SET name = '$name',
											price = '$price',
											service_group = '$group_id'
											WHERE id_service = $id");
		header("Location: index.php");
		$dbConn->close();
	}

?>
<script src="../functions.js"></script>
</body>
</html>