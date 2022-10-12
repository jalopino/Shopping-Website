<?php
if (!file_exists("../connect.php")){
	echo "Unable to locate <strong>connect.php</strong>";
	exit();
}
include("../connect.php");

if (@$_GET["action"] == "delete") {
	$sql_delete = "DELETE FROM categories WHERE ID = ?";
	if ($delete_check = mysqli_prepare($conn, $sql_delete)){
		mysqli_stmt_bind_param($delete_check, "i", $id);
		$id = $_GET["id"];	
		mysqli_stmt_execute($delete_check);
		header("location: categories.php");
		exit();
	}
}
else {
	if (empty($_POST["id"])) {
		$sql_check = "INSERT INTO categories (category, description) VALUES (?, ?)";
		if ($statement_check = mysqli_prepare($conn, $sql_check)) {
			mysqli_stmt_bind_param($statement_check, "ss", $category, $description);
			$category = $_POST['category'];
			$description = $_POST['description'];
			mysqli_stmt_execute($statement_check);
		}
	} else {
		$sql_check = "UPDATE categories SET category = ?, descripton = ? WHERE ID = ?";
			if ($statement_check = mysqli_prepare($conn, $sql_check)) {
			mysqli_stmt_bind_param($statement_check, "ssi", $category, $description, $id);
			$category = $_POST['category'];
			$description = $_POST['description'];
			$id = $_POST['id'];
			mysqli_stmt_execute($statement_check);
		}
	}
}
	