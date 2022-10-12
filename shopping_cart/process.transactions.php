<?php
session_start();
if (!file_exists("connect.php")){
	echo "Unable to locate <strong>connect.php</strong>";
	exit();
}
include("connect.php");

$txt_price = 0;
$txt_qty = 0;

$sql_check = "SELECT COUNT(ID) as ctr, price, qty FROM products WHERE ID = ?";
if ($statement_check = mysqli_prepare($conn, $sql_check)){
	mysqli_stmt_bind_param($statement_check, "i", $ID);
	
	$ID = $_GET['product_id'];
	mysqli_stmt_execute($statement_check);
	mysqli_stmt_bind_result($statement_check, $ctr, $price, $qty);
	while(mysqli_stmt_fetch($statement_check)){
        $txt_price = $price;
        $txt_qty = $qty;
		if ($qty <= 0){
            header("location: product.details.php?product_id=".$_GET['product_id']);
            exit();
		}
	}
}

$sql_insert = "INSERT INTO Transactions 
				(members_ID,
				products_ID,
				qty,
				total_price)
				VALUES (?, ?, ?, ?)";

if ($statement = mysqli_prepare($conn, $sql_insert)){
	mysqli_stmt_bind_param($statement, "sssd",
	$members_ID, $products_ID, $qty, $total_price);
	
	//echo "test ".$_POST['email_address'];
	
	$members_ID = $_SESSION['ID'];
	$products_ID = $_GET['product_id'];
	$qty = 1;
    $total_price = $qty * $txt_price;
	
	mysqli_stmt_execute($statement);
    //
    //
    $new_qty = $txt_qty - $qty;
    $sql_update_qty = "UPDATE products SET qty=".$new_qty." WHERE ID = ".$_GET['product_id'];
    $qry_update_qty = mysqli_query($conn, $sql_update_qty);
    if ($qry_update_qty) {
        header("location: dashboard.php");
        exit();
    
    }
}
