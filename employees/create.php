<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<form method="POST" action="<?php $_PHP_SELF ?>">
		<label>Име</label><input type="text" name="fname"><br>
		<label>Фамилия</label><input type="text" name="lname"><br>
		<label>Телефон</label><input type="text" name="phone"><br>
		<label>Имейл</label><input type="text" name="email"><br>
		<label>Позиция</label>
		<select name="position_id">
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
</body>
</html>