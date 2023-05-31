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
    <div class="page-main">
	<form method="POST" action="<?php $_PHP_SELF ?>" id='msform'>
		<fieldset>
		<input type="text" name="name" placeholder="Име на група услуги"><br>
		<input type="submit" name="create" value="Създай">
		</fieldset>
	</form>
	</div>
	<?php
		include '../config.php';
		if (isset($_POST['create'])) {
			$name = $_POST['name'];

	        try {
	      		$dbConn->query("INSERT INTO `Service_groups`(name) VALUES ('$name')");
	      		header("Location: index.php");
	        }
			catch (mysqli_sql_exception $e) {
				if(str_contains($e, 'Duplicate entry'))
	        		echo "<script> alert(\"Грешка при създаване на нова група: Групата вече съществува!\")</script>";
	        }

		}
	 ?>
<script src="../functions.js"></script>
</body>
</html>