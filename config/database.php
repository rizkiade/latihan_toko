<?php  
	// echo "Konfigurasi database";
	$conn = mysqli_connect('localhost', 'root', '', 'crud_toko');

	if(!$conn){
		echo "Failed Connect Database";
	}
?>