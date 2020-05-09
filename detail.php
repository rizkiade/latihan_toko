<?php
	require_once("./config/database.php");
	session_start();

	$id = $_GET['id'];
	$product = mysqli_query($conn, "SELECT * FROM products WHERE id= $id");
	$product = mysqli_fetch_assoc($product);

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$quantity = $_POST['quantity'];
		$address = $_POST['address'];

		if($quantity > $product['stock']){
			echo "Stock tidak mencukupi";
		}else{
			$user_id = $_SESSION['user_id'];
			$product_id = $product['id'];
			$product_price = $product['price'];
			mysqli_query($conn, "INSERT INTO orders (user_id, product_id, quantity, address, price) VALUES ($user_id, $product_id, $quantity,'$address', $product_price)");

			$new_stock = $product['stock'] - $quantity;
			mysqli_query($conn, "UPDATE products SET stock = $new_stock WHERE id = $product_id");
			$product['stock'] = $new_stock;
			echo "Pembelian Sukses";
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $product['name']; ?></title>
</head>
<body>
	<h1>Detail <?= $product['name']; ?></h1>
	<a href="index.php"> Kembali</a>
	<hr>
	<div>
		Stok : <?= $product['stock']; ?> Unit
	</div>
	<div>
		Price : <?= number_format($product['price'], 0, ",", "."); ?>
	</div>
	
	<?php if(isset($_SESSION['user_id'])) { ?>
		
		<form action="#" method="POST">
			<p>
				<label>Jumlah</label>
				<input type="text" name="quantity">
			</p>
			<p>
				<label>Alamat</label>
				<textarea name="address"></textarea>
			</p>
			<p>
				<input type="submit" value="Beli">
			</p>
		</form>
	
	<?php } else{ ?>
		Maaf, anda belum login. Silahkan login terlebih dahulu sebelum melakukan pembelian.
		<a href="login.php"> Login Disini</a>
	<?php } ?>

</body>
</html>