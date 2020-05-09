<?php 
	require_once("./config/database.php");
	session_start();

	if(isset($_SESSION['user_id'])){
		header('Location: index.php');
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$email = $_POST['email'];
		$password = $_POST['password'];

		$user = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");
		$user = mysqli_fetch_assoc($user);

		if($user){
			$_SESSION['user_id'] = $user['id'];
			header('Location: index.php');
		}else{
			echo "Email / Password salah";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>
	<h1>Login</h1>
	<form action="#" method="POST">
		<p>
			<label>Email</label><br>
			<input type="text" name="email" >
		</p>
		<p>
			<label>Password</label><br>
			<input type="password" name="password"> 
		</p>
		<input type="checkbox" name="remember" > Remember
		<input type="submit" value="Login">
	</form>
	
</body>
</html>