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
			<input type="text" name="fname" placeholder="Име"><br>
			<input type="text" name="lname" placeholder="Презиме"><br>
			<input type="text" name="phone" placeholder="Телефон"><br>
			<input type="text" name="email" placeholder="Имейл"><br>
			<select name="position_id">
				<option value="" disabled selected>Позиция на служител</option>
				<?php 
				include '../config.php';
				$result = $dbConn->query("SELECT * FROM Employee_positions");
				while ($row = mysqli_fetch_assoc($result))
				{
					$id = $row['id_position'];
					$name = $row['name'];
					echo "<option value='$id'>$name";
					echo "</option>";
				}
				 ?>
				}
			</select>
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
			$posId = $_POST['position_id'];

			$dbConn->query("INSERT INTO `Employees` (first_name, last_name, phone, email,position)
							VALUES ('$fname','$lname','$phone','$email','$posId')");
			header("Location: index.php");

		}
	 ?>
<script src="../functions.js"></script>
</body>
</html>