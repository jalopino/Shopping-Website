<?php
if (!file_exists("connect.php")){
	echo "Unable to locate <strong>connect.php</strong>";
	exit();
}
include("connect.php");

$sql_check = "SELECT COUNT(ID) as ctr FROM members WHERE email_address = ?";
if ($statement_check = mysqli_prepare($conn, $sql_check)){
	mysqli_stmt_bind_param($statement_check, "s", $email_address);
	
	$email_address = $_POST['email_address'];
	mysqli_stmt_execute($statement_check);
	
	mysqli_stmt_bind_result($statement_check, $ctr);
	while(mysqli_stmt_fetch($statement_check)){
		if ($ctr > 0){

			exit();
		}
	}
}

$sql_insert = "INSERT INTO members 
				(email_address,
				password,
				first_name,
				last_name,
				contact_number)
				VALUES (?, ?, ?, ?, ?)";

if ($statement = mysqli_prepare($conn, $sql_insert)){
	mysqli_stmt_bind_param($statement, "sssss",
	$email_address, $password, $first_name, $last_name, $contact_number);
	
	//echo "test ".$_POST['email_address'];
	
	$email_address = $_POST['email_address'];
	$password = md5($_POST['password']);
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$contact_number = $_POST['contact_number'];
	
	mysqli_stmt_execute($statement);
}
else {
	echo "Unable to prepare query : ". $sql_insert . " " . mysql_error($link). "<br />";
	exit();
}

