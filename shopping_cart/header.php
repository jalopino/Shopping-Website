<?php 
if (!file_exists("connect.php")){
	echo "Unable to locate <strong>connect.php</strong>";
	exit();
}
include("connect.php");
?>
<html>
	<head>
		<title>Shopping Cart</title>
		<link rel = "stylesheet" type = "text/css" href = "bootstrap/css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "styles/styles.css" />
		<script language = "javascript" src = "bootstrap/js/bootstrap.js"></script>
		<script language = "javascript" src = "js/jquery.js"></script>
	</head>
	<body>