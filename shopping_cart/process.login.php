<?php
if (!file_exists("connect.php")){
	echo "Unable to locate <strong>connect.php</strong>";
	exit();
}
include("connect.php");

$sql_check = "SELECT 
	COUNT(ID) as ctr, 
		ID, 
		first_name, 
		last_name, 
		contact_number, 
		address, 
		email_address
	FROM 
		members 
	WHERE 
		email_address = ? AND password = ?";
if ($statement_check = mysqli_prepare($conn, $sql_check)){
	mysqli_stmt_bind_param($statement_check, "ss",
	$email_address,
	$password);
	
	$email_address = $_POST['email_address'];
	$password = md5($_POST['password']);
	
	mysqli_stmt_execute($statement_check);
	
	mysqli_stmt_bind_result($statement_check, 
		$ctr, $ID, $first_name, $last_name, $contact_number, $address, $email_address);
	while(mysqli_stmt_fetch($statement_check)){
		if ($ctr == 1){
			session_start();
			$_SESSION['session_id'] = session_id();
			$_SESSION['ID'] = $ID;
			$_SESSION['first_name'] = $first_name;
			$_SESSION['last_name'] = $last_name;
			$_SESSION['contact_number'] = $contact_number;
			$_SESSION['address'] = $address;
			$_SESSION['email_address'] = $email_address;
			}
		}
	}

