<?php
if (!file_exists("../connect.php")){
	echo "Unable to locate <strong>connect.php</strong>";
	exit();
}
include("../connect.php");

$sql_check = "SELECT 
	COUNT(ID) as ctr, 
		ID, 
        username
	FROM 
		user 
	WHERE 
		username = ? AND password = ?";
if ($statement_check = mysqli_prepare($conn, $sql_check)){
	mysqli_stmt_bind_param($statement_check, "ss",
	$username,
	$password);
	
	$username = $_POST['uname'];
	$password = md5($_POST['pword']);
	
	mysqli_stmt_execute($statement_check);
	
	mysqli_stmt_bind_result($statement_check, 
		$ctr, $ID, $username);
	while(mysqli_stmt_fetch($statement_check)){
		if ($ctr == 1){
			session_start();
			$_SESSION['session_id'] = session_id();
			$_SESSION['ID'] = $ID;
			$_SESSION['username'] = $username;
			$_SESSION['status'] = 1;
		} else {
			sessio_start();
			$_SESSION['session_id'] = "null";
			$_SESSION['status'] = 0;
		}
	}
}
