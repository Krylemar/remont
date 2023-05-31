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
			<input placeholder="Име" type="text" name="fname"><br>
			<input placeholder="Фамилия" type="text" name="lname"><br>
			<input placeholder="Телефон" type="text" name="phone"><br>
			<input placeholder="Имейл" type="text" name="email"><br>
			<input type="submit" name="create" value="Създай">
		</fieldset>
	</form>
	<?php 
		include '../config.php';
		if (isset($_POST['create'])) {
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];

			$dbConn->query("INSERT INTO `Clients` (first_name, last_name, phone, email)
							VALUES ('$fname','$lname','$phone','$email')");
			header("Location: index.php");

		}
	 ?>
<script src="../functions.js"></script>
</body>
</html>