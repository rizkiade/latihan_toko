<?php
	require_once("./config/database.php");
	session_start();

	$user_id = $_SESSION['user_id'];
	$keyword = "";
	if(isset($_GET['keyword'])){
		$keyword = $_GET['keyword'];
	}

	$orders = mysqli_query($conn, "SELECT *, orders.id as order_id FROM orders JOIN products ON orders.product_id = products.id WHERE user_id = $user_id AND address LIKE '%$keyword%' ORDER BY created_at DESC ");



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Order History</title>
</head>
<body>
	<?php if(mysqli_num_rows($orders) == 0) { ?>
		<h2>Anda Belum memiliki Order</h2>
	<?php } else { ?>
		<form method="GET">
			<input type="text" name="keyword" placeholder="Cari Order">
		</form>
		<table border="1" cellspacing="0" cellpadding="5">
			<thead>
				<th>Order ID</th>
				<th>Product Name</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Address</th>
				<th>Date</th>
			</thead>
			<tbody>
				<?php while($order = mysqli_fetch_assoc($orders)) {?>
				<tr>
					<td><?= $order['order_id']; ?></td>
					<td><?= $order['name']; ?></td>
					<td><?= $order['quantity']; ?></td>
					<td><?= number_format($order['price'], 0, ",", "."); ?></td>
					<td><?= $order['address']; ?></td>
					<td><?= $order['created_at']; ?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	<?php } ?>
</body>
</html>