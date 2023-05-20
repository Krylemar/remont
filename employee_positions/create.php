<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<form method="POST" action="<?php $_PHP_SELF ?>">
		<label>Име позиция</label>
		<input type="text" name="name"><br>
		<input type="submit" name="create" value="Създай">
	</form>
	<?php
		include '../config.php';
		if (isset($_POST['create'])) {
			$name = $_POST['name'];

	        try {
	      		$dbConn->query("INSERT INTO `Employee_positions`(name) VALUES ('$name')");
	      		header("Location: index.php");
	        }
			catch (mysqli_sql_exception $e) {
				if(str_contains($e, 'Duplicate entry'))
	        		echo "<script> alert(\"Грешка при създаване на нова група: Групата вече съществува!\")</script>";
	        }

		}
	 ?>
</body>
</html>