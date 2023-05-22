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
	$result = $dbConn->query("SELECT * FROM Clients WHERE id_client = $id");
	$row = mysqli_fetch_assoc($result);
	global $fname, $lname,$phone,$email;
	$fname = $row['first_name'];
	$lname = $row['last_name'];
	$phone = $row['phone'];
	$email = $row['email'];
	 ?>
</head>
<body>
	<form method="POST" action="<?php $_PHP_SELF ?>">
		<?php include '../config.php'; 
			echo "<label>Име</label><input type='text' name='fname' value='$fname'><br>";
			echo "<label>Фамилия</label><input type='text' name='lname' value='$lname'><br>";
			echo "<label>Телефон</label><input type='text' name='phone' value='$phone'><br>";
			echo "<label>Имейл</label><input type='text' name='email' value='$email'><br>"; ?>
		<input type="submit" name="update" value="Редактирай">
	</form>
	<?php  
	if (isset($_POST['update'])) {
		include '../config.php';
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$dbConn->query("UPDATE Clients SET first_name = '$fname',
											last_name = '$lname',
											phone = '$phone',
											email = '$email'  
											WHERE id_client = $id");
		header("Location: index.php");
		$dbConn->close();
	}

?>
</body>
</html>