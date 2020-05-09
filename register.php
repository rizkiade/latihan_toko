<?php  
	require_once("./config/database.php");
	session_start();

	if(isset($_SESSION['user_id'])){
		header('Location: index.php');
	}

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		// echo "yaak didaftar";
		// exit();
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(!$name || !$email || !$password){
			echo "masih pada kosong di isi dlu";
		}else{
			$user = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
			$user = mysqli_fetch_assoc($user);

			if($user){
				echo "User sudah terdaftar";
			}else{
				mysqli_query($conn, "INSERT INTO users(name,email,password) VALUES ('$name', '$email', '$password')");
				header('Location: index.php');
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
</head>
<body>
	<h1>Register User</h1>
	<form action="#" method="POST">
		<p>
			<label>Name</label><br>
			<input type="text" name="name" />
		</p>
		<p>
			<label>Email</label><br>
			<input type="text" name="email" />
		</p>
		<p>
			<label>Password</label><br>
			<input type="password" name="password" />
		</p>
		<p>
			<input type="submit" name="Register" />
		</p>
	</form>
</body>
</html>
