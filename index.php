<?php
	require_once("./config/database.php");
	session_start();

	$products = mysqli_query($conn, "SELECT * FROM products ORDER BY id ASC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="./style/home.css">
</head>
<body>
	<h1>Home</h1>
	<div>
		<?php if(isset($_SESSION['user_id'])){ ?>

			<a href="logout.php">Logout</a> || <a href="order-history.php">Order History</a>
		
		<?php }else{ ?>

			<a href="login.php">Login</a> || <a href="register.php">Register</a>
		
		<?php } ?>
		
	</div>
	<hr>

	<div id="container">
		<?php while($product = mysqli_fetch_assoc($products)) { ?>
			<div class="product">
				<div class="cover">
					<img src="http://placehold.jp/150x150.png" >
				</div>
				<div class="title">
					<?= $product['name']; ?>
				</div>
				<div class="price">
					<?= number_format($product['price'], 0, ",", "."); ?>
				</div>
				<div class="stock">
					<?= $product['stock']; ?>
				</div>
				<div>
					<a href="detail.php?id=<?= $product['id']; ?>">
						<button>Detail</button>
					</a>
				</div>
			</div>
		<?php } ?>
	</div>
</body>
</html>