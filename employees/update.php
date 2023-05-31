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
	$result = $dbConn->query("SELECT * FROM `Employees` WHERE id_employee = $id");
	$row = mysqli_fetch_assoc($result);
	global $fname, $lname,$phone,$email, $posId;
	$fname = $row['first_name'];
	$lname = $row['last_name'];
	$phone = $row['phone'];
	$email = $row['email'];
	$posId = $row['position'];
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
			echo "<label>Име</label><input placeholder='Име' type='text' name='fname' value='$fname'><br>";
			echo "<label>Фамилия</label><input placeholder='Фамилия' type='text' name='lname' value='$lname'><br>";
			echo "<label>Телефон</label><input placeholder='Телефон' type='text' name='phone' value='$phone'><br>";
			echo "<label>Имейл</label><input placeholder='Имейл' type='text' name='email' value='$email'><br>"; 
			echo "<label>Позиция</label>
				  <select name='posId'>";
			$result = $dbConn->query("SELECT * FROM Employee_positions");
			while ($row = mysqli_fetch_assoc($result)) {
				$positionId = $row['id_position'];
				$posName = $row['name'];
				if ($positionId == $posId) {
					echo "<option value='$positionId' selected>$posName</option>";
				}
				else echo "<option value='$positionId'>$posName</option>";
			}
			echo "</select>";
			?>
		<input type="submit" name="update" value="Редактирай">
		</fieldset>
	</form>
	<?php  
	if (isset($_POST['update'])) {
		include '../config.php';
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$posId = $_POST['posId'];
		$dbConn->query("UPDATE Employees SET first_name = '$fname',
											 last_name = '$lname',
											 phone = '$phone',
											 email = '$email',
											 position = '$posId'
											 WHERE id_employee = $id");
		header("Location: index.php");
		$dbConn->close();
	}

?>
</body>
</html>