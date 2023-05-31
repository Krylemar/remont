
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
	$result = $dbConn->query("SELECT * FROM Service_groups WHERE id_group = $id");
	$row = mysqli_fetch_assoc($result);
	global $name;
	$name = $row['name'];
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
			<h3 class="fs-subtitle">Ново име на категория услуга</h3>
			<?php include '../config.php'; 
			echo "<input type='text' name='name' value='$name'>"; ?><br>
			<input type="submit" name="update" value="Редактирай">
		</fieldset>
	</form>	
	
	<?php  
	if (isset($_POST['update'])) {
		include '../config.php';
		$name = $_POST['name'];
		$dbConn->query("UPDATE Service_groups SET name = '$name' WHERE id_group = $id");
		header("Location: index.php");
		$dbConn->close();
	}

?>
<script src="../functions.js"></script>
</body>
</html>