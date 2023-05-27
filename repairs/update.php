<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<?php 
	include '../config.php';
	global $id;
	$id = $_GET['id'];
	$result = $dbConn->query("SELECT * FROM `Repairs` WHERE id_repair = $id");
	$row = mysqli_fetch_assoc($result);
	global $date, $price,$client,$employee;
	$date = $row['date'];
	$price = $row['price'];
	$client = $row['client'];
	$employee = $row['employee'];
	 ?>
</head>
<body>
	<form method="POST" action="<?php $_PHP_SELF ?>">
		<?php include '../config.php'; 
			echo "<label>Дата</label><input type='text' name='date' value='$date'><br>";
			echo "<label>Цена</label><input type='text' name='price' value='$price'><br>";
			echo "<label>Клиент</label>";
			echo "<select name='client'>";
			$result = $dbConn->query("SELECT * FROM `Clients`");
			while ($row = mysqli_fetch_assoc($result)) {
				$id_rep = $row['id_client'];
				$name = $row['first_name']." ".$row['last_name'];
				if ($row['id_repair'] == $id) {
					echo "<option value='$id_rep' selected>$name</option>";
				}
				else echo "<option value='$id_rep'>$name</option>";
				
			}
			echo "</select><br>";
			echo "<label>Служител</label>";
			echo "<select name='employee'>";
			$result = $dbConn->query("SELECT * FROM `Employees`");
			while ($row = mysqli_fetch_assoc($result)) {
				$id = $row['id_employee'];
				$name = $row['first_name']." ".$row['last_name'];
				if ($row['id_repair'] == $id) {
					echo "<option value='$id_rep' selected>$name</option>";
				}
				else echo "<option value='$id_rep'>$name</option>";
			}
			echo "</select>"; 
			?>
		<input type="submit" name="update" value="Редактирай">
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