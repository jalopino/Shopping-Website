<?php
if (!file_exists("../connect.php")){
	echo "Unable to locate <strong>connect.php</strong>";
	exit();
}
include("../connect.php");

if (@$_GET["action"] == "delete") {
	$sql_delete = "DELETE FROM products WHERE ID = ?";
	if ($delete_check = mysqli_prepare($conn, $sql_delete)){
		mysqli_stmt_bind_param($delete_check, "i", $id);
		$id = $_GET["id"];	
		mysqli_stmt_execute($delete_check);
		header("location: products.php");
		exit();
	}
}
else {
	if (empty($_POST["id"])) {
		$sql_check = "INSERT INTO products (category_id, color, description, dimensions, price, product_name, qty) VALUES (?, ?, ?, ?, ?, ?, ?)";
		if ($statement_check = mysqli_prepare($conn, $sql_check)) {
			mysqli_stmt_bind_param($statement_check, "isssdsi", $category_id, $color, $dimensions, $description, $price, $product_name, $qty);
			$category_id = $_POST['category_id'];
			$color = $_POST['color'];
            $description = $_POST['description'];
            $dimensions = $_POST['dimensions'];
			$price = $_POST['price'];
            $product_name = $_POST['product_name'];
			$qty = $_POST['qty'];
			mysqli_stmt_execute($statement_check);
		}
	} else {
		$sql_check = "UPDATE products SET category_id = ?, color = ?, description = ?, dimensions = ?, price = ?, product_name = ?, qty = ? WHERE ID = ?";
			if ($statement_check = mysqli_prepare($conn, $sql_check)) {
			mysqli_stmt_bind_param($statement_check, "isssdsii", $category_id, $color, $description, $dimensions, $price, $product_name, $qty, $id);

			$category_id = $_POST['category_id'];
			$color = $_POST['color'];
            $description = $_POST['description'];
            $dimensions = $_POST['dimensions'];
			$price = $_POST['price'];
            $product_name = $_POST['product_name'];
			$qty = $_POST['qty'];
			$id = $_POST['id'];

			mysqli_stmt_execute($statement_check);
		}
	}
}
	